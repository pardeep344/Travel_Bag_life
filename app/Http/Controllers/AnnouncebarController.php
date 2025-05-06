<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnounceBar;

class AnnouncebarController extends Controller
{
    // Show the AnnounceBar edit form

    
    public function edit()
    {
        $announce = AnnounceBar::first();
        return view('admin.header.announcebar', compact('announce'));
    }

    // Handle the AnnounceBar update
    public function update(Request $request)
    {
        $request->validate([
            'phoneno' => 'nullable|string|max:10',
            'text' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:50',
        ],[
            'phoneno.string'=>'must be add proper number',
            'phoneno.max'=>'Must be ten digit',

            'text.string'=>'must be add proper number',
            'text.max'=>'The leght should be 50',

            'address.string'=>'must be add proper number',
            'address.max'=>'The leght should be 50',


        ]);

        $announce = AnnounceBar::first();

        if (!$announce) {
            // Optionally create a new one if it doesn't exist
            $announce = new AnnounceBar();
        }

        $announce->phoneno = $request->phoneno;
        $announce->text = $request->text;
        $announce->address = $request->address;
        $announce->save();

        return redirect()->route('admin.announcebar')->with('success', 'Announce Bar updated successfully.');
    }
  
}
