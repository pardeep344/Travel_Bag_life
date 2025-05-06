<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Show all blogs
    public function index(){
        $blogs = Blog::all();
        return view('admin.Blog.Blog-card', compact('blogs'));
    }

    
    public function store(Request $request){
        $request->validate([
            'image'=>'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'description'=>'nullable|string|max:500',
            'publishDate'=>'nullable|string|max:20',
        ], [
            'image.image'=>'File should be an image.',
            'image.mimes'=>'Image should be jpg, png, jpeg.',
            'image.max'=>'Image size should be below 10MB.',
            'description.string'=>'Description should be a string.',
            'description.max'=>'Description length should be below 250 characters.',
        ]);

        // Handle image upload if present
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs(
                'uploads/BlogsImage',
                uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
                'public'
            );
        }

        Blog::create([
            'image' => $imagePath,
            'description' => $request->description,
            'publishDate' => $request->publishDate,
        ]);

        return redirect()->route('admin.blog')->with('success', 'Blog entry added successfully');
    }

    // Edit blog entry
    public function edit($id){
        $blog = Blog::findOrFail($id);
        return view('admin.Blog.Blog-card', compact('blog')); // Assuming you have a separate edit view
    }

    // Update blog entry
    public function update(Request $request, $id){
        $blog = Blog::findOrFail($id);

        $request->validate([
            'image'=>'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'description'=>'nullable|string|max:500',
            'publishDate'=>'nullable|string|max:20',
        ]);

        // Handle image upload if present
        $imagePath = $blog->image; // Keep the existing image unless a new one is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs(
                'uploads/BlogsImage',
                uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
                'public'
            );
        }

        // Update the blog post
        $blog->update([
            'image' => $imagePath,
            'description' => $request->description,
            'publishDate' => $request->publishDate,
        ]);

        return redirect()->route('admin.blog')->with('success', 'Blog entry updated successfully');
    }

    // Delete blog entry
    public function delete($id){
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blog')->with('success', 'Blog entry deleted successfully');
    }
}
