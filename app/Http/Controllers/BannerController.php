<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.header.banner', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bannerimg' => 'required|image|mimes:jpg,jpeg,png,gif|max:10240',
            'url' => 'nullable|string'
        ]);

        if ($request->hasFile('bannerimg') && $request->file('bannerimg')->isValid()) {
            $file = $request->file('bannerimg');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

            // Store the file in storage/app/public/uploads/banners
            $file->storeAs('uploads/banners', $filename, 'public');

            Banner::create([
                'image' => 'uploads/banners/' . $filename,
                'url' => $request->url
            ]);

            return redirect()->route('admin.banner')->with('success', 'Banner uploaded successfully.');
        }

        return back()->withErrors(['bannerimg' => 'No file was uploaded or it was invalid.']);
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.header.banner', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'bannerimg' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'url' => 'nullable|url'
        ]);

        if ($request->hasFile('bannerimg') && $request->file('bannerimg')->isValid()) {
            // Delete old image if exists
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $file = $request->file('bannerimg');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/banners', $filename, 'public');

            $banner->image = 'uploads/banners/' . $filename;
        }

        $banner->url = $request->url;
        $banner->save();

        return redirect()->route('admin.banner')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banner')->with('success', 'Banner deleted successfully.');
    }
}