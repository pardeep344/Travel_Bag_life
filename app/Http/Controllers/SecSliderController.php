<?php

namespace App\Http\Controllers;

use App\Models\secSlider;
use Illuminate\Http\Request;

class SecSliderController extends Controller
{
    public function index(){
        $secSliders= secSlider::all();
        return view('admin.Sec-Slider.Second-Slider',compact('secSliders'));
    }
    public function store(Request $request){
        

        $request->validate(
            [
                'image'=>'required|image|mimes:jpg,jpeg,png|max:10240',
                'title'=>'required|string|max:100',
                'description'=>'required|string|max:500',
                'price'=>'required|string|max:100',
                'rating'=>'required|string|max:100',
                'duration'=>'required|string|max:100'
            ],
       
            
            [
                'image.required' => 'The image field is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The logo must be a file of type: jpg, jpeg, png, gif.',
                'image.max' => 'The logo may not be greater than 2MB.',
                'image.dimensions' => 'The logo may not be larger than 1000x1000 pixels.',

                'title.required' => 'The title field is required.',
                'title.string' => 'The title should be string.',
                'title.max' => 'The title should be less then 20.',

                'description.required' => 'The description field is required.',
                'description.string' => 'The description should be string.',
                'description.max' => 'The description should be less then 500.',

                'price.required' => 'The price field is required.',
                'price.string' => 'The price should be string.',
                'price.max' => 'The price should be less then 100.',

                'rating.required' => 'The rating field is required.',
                'rating.string' => 'The rating should be string.',
                'rating.max' => 'The rating should be less then 100.',

                'duration.required' => 'The duration field is required.',
                'duration.string' => 'The duration should be string.',
                'duration.max' => 'The duration should be less then 100.',
            ]);

            $imagePath = $request->file('image')->storeAs(
                'uploads/sliders',
                uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
                'public'
            );
          
            secSlider::create([
            'image'=>$imagePath,
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'rating'=>$request->rating,
            'duration'=>$request->duration
           ]);
          
           return redirect()->route('admin.secSlider.index')->with('success','New slider data is created');
}

        public function update(Request $request, $id)
        {
            $request->validate(
                [
                    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
                    'title' => 'required|string|max:100',
                    'description' => 'required|text|max:500',
                    'price' => 'required|string|max:100',
                    'rating' => 'required|string|max:100',
                    'duration' => 'required|string|max:100',
                ],
                [
                    'image.required' => 'The image field is required.',
                    'image.image' => 'The file must be an image.',
                    'image.mimes' => 'The logo must be a file of type: jpg, jpeg, png, gif.',
                    'image.max' => 'The logo may not be greater than 2MB.',
                    'image.dimensions' => 'The logo may not be larger than 1000x1000 pixels.',

                    'title.required' => 'The title field is required.',
                    'title.string' => 'The title should be string.',
                    'title.max' => 'The title should be less then 20.',

                    'description.required' => 'The description field is required.',
                    'description.string' => 'The description should be string.',
                    'description.max' => 'The description should be less then 500.',

                    'price.required' => 'The price field is required.',
                    'price.string' => 'The price should be string.',
                    'price.max' => 'The price should be less then 20.',

                    'rating.required' => 'The rating field is required.',
                    'rating.string' => 'The rating should be string.',
                    'rating.max' => 'The rating should be less then 20.',

                    'duration.required' => 'The duration field is required.',
                    'duration.string' => 'The duration should be string.',
                    'duration.max' => 'The duration should be less then 20.',
                ]);

            $slider_var = secSlider::findOrFail($id);
      
            if ($request->hasFile('image')) {
                // Delete old image from storage
                if ($slider_var->image && \Storage::disk('public')->exists($slider_var->image)) {
                    \Storage::disk('public')->delete($slider_var->image);
                }

                //Store new image
                $imagePath = $request->file('image')->storeAs(
                    'uploads/sliders',
                    uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
                    'public'
                );
            } else {
                $imagePath = $slider_var->image; // keep old image
            }

            $slider_var->update([
                'image' => $imagePath,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'rating' => $request->rating,
                'duration' => $request->duration,
            ]);

            return redirect()->route('admin.secSlider.index')->with('success', 'Slider data updated successfully.');
        }

        public function edit($id) {
            $secSlider = secSlider::find($id);
            $secSliders= secSlider::all();
            return view('admin.Sec-Slider.Second-Slider',compact('secSlider','secSliders'));
        }

        public function delete($id){
            $slider= secSlider::findOrFail($id);
            $slider->delete();
            if ($slider->image && \Storage::disk('public')->exists($slider->image)) {
                \Storage::disk('public')->delete($slider->image);
            }
            return redirect()->route('admin.secSlider.index')->with('success','slider data is delete');

        }
}
