<?php

namespace App\Http\Controllers;

use App\Models\LogoImg; // Import the LogoImg model
use App\Models\Navbarmenu; // Import the Navbarmenu model
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    // Fetch the existing logo record from the database and display
    public function index()
    {
        $logo = LogoImg::first(); // Fetch the first logo record
        $menus = Navbarmenu::all(); // Fetch all menu items
        return view('admin.header.navbar', compact('logo', 'menus'));
    }

    // Update the logo functionality
    public function updatelogo(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $logo = LogoImg::first();
    
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($logo && $logo->logoimg && file_exists(public_path('storage/' . $logo->logoimg))) {
                unlink(public_path('storage/' . $logo->logoimg));
            }
    
            // Generate unique file name
            $fileName = time() . '.' . $request->logo->getClientOriginalExtension();
    
            // Store the file in storage/app/public/uploads/logos
            $path = $request->file('logo')->storeAs('uploads/logos', $fileName, 'public');
    
            // Save relative path to DB (e.g., uploads/logos/12345.jpg)
            if ($logo) {
                $logo->update(['logoimg' => $path]);
            } else {
                LogoImg::create(['logoimg' => $path]);
            }
    
            return redirect()->route('admin.navbar')->with('success', 'Logo updated successfully!');
        }
    
        return back()->withErrors(['logo' => 'No logo uploaded.']);
    }
    
    // Handle creating, updating, or deleting a menu item
      // Show the edit form for the menu item
    public function edit($id)
    {
        $menu = Navbarmenu::find($id);
        $menus = Navbarmenu::all(); 
        $logo = LogoImg::first(); 
        return view('admin.header.navbar', compact('menu','logo','menus'));  // Assuming 'edit.blade.php' is the view for editing
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'url' => 'required|string',
    ]);

    Navbarmenu::create([
        'name' => $request->name,
        'url' => $request->url,
    ]);

    return redirect()->route('admin.navbar')->with('success', 'Menu item added successfully!');
}

    // Update the menu item
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string',
        ]);

        $menu = Navbarmenu::findOrFail($id);
        $menu->update([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        return redirect()->route('admin.navbar')->with('success', 'Menu item updated successfully!');
    }

    // Delete the menu item
    public function destroy($id)
    {
        $menu = Navbarmenu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.navbar')->with('success', 'Menu item deleted successfully!');
    }
    
}

