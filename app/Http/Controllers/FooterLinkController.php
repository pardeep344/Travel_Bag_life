<?php

namespace App\Http\Controllers;

use App\Models\FooterLink;
use Illuminate\Http\Request;

class FooterLinkController extends Controller
{
     // Show the form to create a new footer link
     public function index()
     {  $Footerlinks=FooterLink::all();
         return view('admin.Footer.Footer-Link',compact('Footerlinks'));
     }
 
     // Store the new footer link in the database
     public function store(Request $request)
     {
         $request->validate([
             'Text' => 'required|string|max:255',
             'Url' => 'required|string|max:255',
             'Status' => 'required|in:active,inactive',
         ]);
 
         FooterLink::create([
             'Text' => $request->Text,
             'Url' => $request->Url,
             'Status' => $request->Status,
         ]);
 
         return redirect()->route('admin.footerLinks.index')->with('success', 'Footer link created successfully.');
     }
 
     // Show the form to edit an existing footer link
     public function edit($id)
     {
         $footerLink = FooterLink::findOrFail($id);
         $FooterLinks = FooterLink::all();
         return view('admin.Footer.Footer-Link', compact('footerLink','FooterLinks'));
     }
 
     // Update the existing footer link in the database
     public function update(Request $request, $id)
     {
         $request->validate([
             'Text' => 'required|string|max:255',
             'Url' => 'required|url|max:255',
             'Status' => 'required|in:active,inactive',
         ]);
 
         $footerLink = FooterLink::findOrFail($id);
         $footerLink->update([
             'Text' => $request->Text,
             'Url' => $request->Url,
             'Status' => $request->Status,
         ]);
 
         return redirect()->route('admin.footerLinks.index')->with('success', 'Footer link updated successfully.');
     }
 
     // Delete the footer link from the database
     public function destroy($id)
     {
         $footerLink = FooterLink::findOrFail($id);
         $footerLink->delete();
 
         return redirect()->route('admin.footerLinks.index')->with('success', 'Footer link deleted successfully.');
     }
    
}
