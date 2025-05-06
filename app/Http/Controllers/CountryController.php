<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        $countryGroups = Country::all(); // or ->first()
        return view('admin.Country-Showcase.Card-Groups',compact('countryGroups'));
    }

    public function store(Request $request){

        $request->validate([
            'image'=>'required|image|mimes:jpg,jpeg,png|max:10240',
            'countryName'=>'required|string|max:20',
            'url'=>'required|string|max:250',
        ],
        
        [
            'image.required'=>'image are required',
            'image.mimes'=>'image should be in this formet jpg jpeg png',
            'image.max'=>'image should be less then 5mb',

            'countryName.required'=>'countryName should be required',
            'countryName.string'=>'countryName should in string',
            'countryName.max'=>'countryName lenght should be in 20',

            'url.required'=>'url should be required',
            'url.string'=>'url should in string',
            'url.max'=>'url lenght should be in 100'
        ]);

        $image_path= $request->file('image')->storeAs(
            'uploads/country-cards',
            uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
            'public'
        );

        country::create([
            'image'=>$image_path,
            'countryName'=>$request->countryName,
            'url'=>$request->url,
        ]);

        return redirect()->back()->with('sucess','data is added success full');
    }

    public function update(Request $request, $id)
{
    // Validation
    $request->validate([
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'countryName' => 'required|string|max:20',
        'url' => 'required|string|max:250',
    ], [
        'image.required' => 'Image is required.',
        'image.mimes' => 'Image should be in jpg, jpeg, or png format.',
        'image.max' => 'Image should be less than 10MB.',
        'countryName.required' => 'Country name is required.',
        'countryName.string' => 'Country name should be a string.',
        'countryName.max' => 'Country name length should be less than 20 characters.',
        'url.required' => 'URL is required.',
        'url.string' => 'URL should be a string.',
        'url.max' => 'URL length should be less than 250 characters.'
    ]);

    // Find the country group by ID
    $cardData = Country::findOrFail($id);

    // If a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($cardData->image && \Storage::disk('public')->exists($cardData->image)) {
            \Storage::disk('public')->delete($cardData->image);
        }

        // Store the new image
        $imagePath = $request->file('image')->storeAs(
            'uploads/sliders',
            uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
            'public'
        );
    } else {
        // If no new image is uploaded, keep the existing image
        $imagePath = $cardData->image;
    }

    // Update the country group record
    $cardData->update([
        'image' => $imagePath,
        'countryName' => $request->countryName,
        'url' => $request->url,
    ]);

    // Redirect back with success message
    return redirect()->route('admin.countryshowcase')->with('success', 'Data has been updated.');
}

        public function edit($id)
        {
            // Retrieve the country group using the ID
            $countryGroup = Country::findOrFail($id);

            // Return the edit view and pass the country group to it
            return view('admin.Country-Showcase.Card-Groups', compact('countryGroup'));
        }


        public function delete($id)
        {
            // Find the country group by ID
            $countryGroup = Country::findOrFail($id);
        
            // If the country has an image, delete the image from storage
            if ($countryGroup->image && \Storage::disk('public')->exists($countryGroup->image)) {
                \Storage::disk('public')->delete($countryGroup->image);
            }
        
            // Delete the country group record
            $countryGroup->delete();
        
            // Redirect back with a success message
            return redirect()->route('admin.countryshowcase')->with('success', 'Country group has been deleted.');
        }
}
