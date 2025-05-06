<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Storage;

class PartnerController extends Controller
{
    public function index()
{
    $images = Partner::all();
    $latestImage = Partner::latest()->first(); // Get the latest uploaded image
    return view('admin.Partner-page.company-partner', compact('images', 'latestImage'));
}

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:10240'
        ],[
            'image.max'=>'img should be less then 5mb',
            'image.mimes'=>'img should be in jpg jpeg png'
        ]);

        $imagePath = $request->file('image')->storeAs(
            'uploads/Partners-img',
            uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
            'public'
        );

        Partner::create([
            'image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Image uploaded successfully!');
    }

    public function destroy($id)
    {
        $image = Partner::findOrFail($id);

        // Check if file exists in the directory and delete it
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        // Delete the record from the database
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
