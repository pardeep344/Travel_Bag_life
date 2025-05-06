<?php

namespace App\Http\Controllers;

use App\Models\Aboutus;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function index() {
        $aboutData = Aboutus::first(); // Get the first (and only) about record
        return view('admin.Aboutus-Page.Aboutus', compact('aboutData'));
    }

    public function storeOrUpdate(Request $request) {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'text' => 'nullable|string'
        ], [
            'image.image' => 'Only image files are allowed',
            'image.mimes' => 'Image must be jpg, jpeg, or png',
            'image.max' => 'Image must be less than 10MB',

            'text.string' => 'Only string values are allowed',
            
        ]);

        $about = Aboutus::first(); // fetch the only record if it exists

        $imagePath = $about->image ?? null;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($about && $about->image && \Storage::disk('public')->exists($about->image)) {
                \Storage::disk('public')->delete($about->image);
            }

            // Store new image
            $imagePath = $request->file('image')->storeAs(
                'uploads/About-Img',
                uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
                'public'
            );
        }

        if ($about) {
            // Update existing
            $about->update([
                'image' => $imagePath,
                'text' => $request->text,
            ]);
            return redirect()->back()->with('success', 'About section updated successfully.');
        } else {
            // Create new
            Aboutus::create([
                'image' => $imagePath,
                'text' => $request->text,
            ]);
            return redirect()->back()->with('success', 'About section created successfully.');
        }
    }
}
