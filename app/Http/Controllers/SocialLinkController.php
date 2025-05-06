<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index(){
        $socialLinks=SocialLink::all();
        return view('admin.SocialLink-Page.SocialLink',compact('socialLinks'));
    }

    public function store(Request $request){
        $request->validate([
            'Image' => 'nullable|image|mimes:jpg,jpeg,png|dimensions:max_width=1000,max_height=1000|max:10240',
            'Url' => 'required|string|max:100',
        ],[
            'Image.required' => 'The image field is required.',
            'Image.image' => 'The file must be an image.',
            'Image.mimes' => 'The logo must be a file of type: jpg, jpeg, png, gif.',
            'Image.max' => 'The logo may not be greater than 2MB.',
                     
            'Url.required' => 'The Url field is required.',
        ]);
        $imagePath = $request->file('Image')->storeAs(
            'uploads/socialLink',
            uniqid() . '.' . $request->file('Image')->getClientOriginalExtension(),
            'public'
        );

        SocialLink::create([
            'Image'=>$imagePath,
            'Url'=>$request->Url,
           ]);
          
           return redirect()->route('admin.socialLink.index')->with('success','New socialLink data is created');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Image' => 'nullable|image|mimes:jpg,jpeg,png|dimensions:max_width=1000,max_height=1000|max:10240',
            'Url' => 'nullable|string|max:100',
        ],[
             
            'Image.image' => 'The file must be an image.',
            'Image.mimes' => 'The logo must be a file of type: jpg, jpeg, png, gif.',
            'Image.max' => 'The logo may not be greater than 2MB.',
                     
             
        ]);
         
        $social_link = SocialLink::findOrFail($id);
  
         
        if ($request->hasFile('Image')) {
            if ($social_link->Image && \Storage::disk('public')->exists($social_link->Image)) {
                \Storage::disk('public')->delete($social_link->Image);
            }
        
            $imagePath = $request->file('Image')->storeAs(
                'uploads/socialLink',
                uniqid() . '.' . $request->file('Image')->getClientOriginalExtension(),
                'public'
            );
        } else {
            $imagePath = $social_link->Image;
        }

        $social_link->update([
            'Image' => $imagePath,
            'Url' => $request->Url,
        ]);

        return redirect()->route('admin.socialLink.index')->with('success', 'Slider data updated successfully.');
    }

    public function edit($id) {
        $socialLinks=SocialLink::all();
        $social = SocialLink::findOrFail($id);
        return view('admin.SocialLink-Page.SocialLink',compact('social','socialLinks'));
    }

    public function delete($id){
        $social= SocialLink::findOrFail($id);
        $social->delete();
        if ($social->image && \Storage::disk('public')->exists($social->image)) {
            \Storage::disk('public')->delete($social->image);
        }
        return redirect()->route('admin.socialLink.index')->with('success','socialLink data is delete');

    }
}
