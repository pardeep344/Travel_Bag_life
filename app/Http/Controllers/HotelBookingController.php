<?php

namespace App\Http\Controllers;

use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Storage;

class HotelBookingController extends Controller
{
    public function index(){
        $bookingdetails = HotelBooking::all();
        return view('admin.Destination-Booking.Destination',compact('bookingdetails'));
    }

    public function store(Request $request){
        $request->validate([
            'image'=>'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'placeName'=>'nullable|string|max:50',
            'location'=>'nullable|string|max:50',
            'member'=>'nullable|string|max:20',
            'rating'=>'nullable|string|max:20',
            'price'=>'nullable|string',
            'duration'=>'nullable|string|max:20',
        ],
        [
            'image.image'=>"only image are required",
            'image.mimes'=>"only jpg png and jpeg are required",
            'image.max'=>'image size should be below of 5mb',

            'placeName.string'=>'only string and charater are required',
            'placeName.max'=>'Place Name length should be below of 20 are required',

            'location.string'=>'only string and charater are required',
            'location.max'=>'location length should be below of 20 are required',

            'member.string'=>'only string and charater are required',
            'member.max'=>'member length should be below of 20 are required',

            'rating.string'=>'only string and charater are required',
            'rating.max'=>'rating length should be below of 20 are required',

            'price.string'=>'only string and charater are required',
             
            'duration.string'=>'only string and charater are required',
             
        ]);

        $image_path=$request->file('image')->storeAs(
            'uploads/HotelImg',
            uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
            'public'       
        );

        HotelBooking::create(
            [
                'image'=>$image_path,
                'placeName'=>$request->placeName,
                'location'=>$request->location,
                'member'=>$request->member,
                'rating'=>$request->rating,
                'price'=>$request->price,
                'duration'=>$request->duration
            ]);
           return redirect()->back()->with('success','data is added');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'placeName' => 'nullable|string|max:50',
        'location' => 'nullable|string|max:50',
        'member' => 'nullable|string|max:20',
        'rating' => 'nullable|string|max:20',
        'price' => 'nullable|string',
        'duration' => 'nullable|string|max:20',
    ],
[
    'image.image'=>"only image are required",
    'image.mimes'=>"only jpg png and jpeg are required",
    'image.max'=>'image size should be below of 5mb',

    'placeName.string'=>'only string and charater are required',
    'placeName.max'=>'Place Name length should be below of 20 are required',

    'location.string'=>'only string and charater are required',
    'location.max'=>'location length should be below of 20 are required',

    'member.string'=>'only string and charater are required',
    'member.max'=>'member length should be below of 20 are required',

    'rating.string'=>'only string and charater are required',
    'rating.max'=>'rating length should be below of 20 are required',

    'price.string'=>'only string and charater are required',
     
    'duration.string'=>'only string and charater are required',
]);

    $hotel = HotelBooking::findOrFail($id);

    // If a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($hotel->image && Storage::disk('public')->exists($hotel->image)) {
            Storage::disk('public')->delete($hotel->image);
        }

        // Store the new image
        $image_path = $request->file('image')->storeAs(
            'uploads/HotelImg',
            uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
            'public'
        );
        $hotel->image = $image_path;
    }

    // Update other fields
    
    $hotel->placeName = $request->placeName;
    $hotel->location = $request->location;
    $hotel->member = $request->member;
    $hotel->rating = $request->rating;
    $hotel->price = $request->price;
    $hotel->duration = $request->duration;

    $hotel->save();

    return redirect()->route('admin.hotel')->with('success', 'Hotel updated successfully');
}

public function edit($id)
{
    $hoteldetail = HotelBooking::findOrFail($id);
    return view('admin.Destination-Booking.Destination', compact('hoteldetail'));
}

public function delete($id)
{
    $hotel = HotelBooking::findOrFail($id);
    $hotel->delete();

    return redirect()->back()->with('success', 'Hotel deleted successfully');
}
}
