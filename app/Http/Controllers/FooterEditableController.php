<?php

namespace App\Http\Controllers;

use App\Models\FooterEditContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterEditableController extends Controller
{
    public function index()
    {
        $footer = FooterEditContent::first();
        return view('admin.footer.footer-editable-content', compact('footer'));
    }

    public function StoreUpdate(Request $request)
    {
        $request->validate([
            'Image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'Text' => 'nullable|string',
            'TelPhone' => 'nullable|string|max:20',
            'Phone' => 'nullable|string|max:20',
            'Email' => 'nullable|string|max:100',
            'Copyright' => 'nullable|string|max:100',
        ],[
            'Image.image' =>'file should be img',
            'Image.mimes' =>'image should be in jpg png jpeg webp',
            'Image.max' =>'image should be less then 5mb'
        ]
    );

        $footer = FooterEditContent::first();
        $imagePath = $footer?->Image; // Keep old image if no new one

        if ($request->hasFile('Image')) {
            // Delete old image
            if ($footer && $footer->Image && Storage::disk('public')->exists($footer->Image)) {
                Storage::disk('public')->delete($footer->Image);
            }

            $image = $request->file('Image');
            $imagePath = $image->storeAs(
                'uploads/Footer',
                uniqid() . '.' . $image->getClientOriginalExtension(),
                'public'
            );
        }

        $data = [
            'Image' => $imagePath,
            'Text' => $request->Text,
            'TelPhone' => $request->TelPhone,
            'Phone' => $request->Phone,
            'Email' => $request->Email,
            'Copyright' => $request->Copyright,
        ];

        if ($footer) {
            $footer->update($data);
            return redirect()->back()->with('success', 'Footer content updated successfully.');
        } else {
            FooterEditContent::create($data);
            return redirect()->back()->with('success', 'Footer content created successfully.');
        }
    }
}
