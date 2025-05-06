<?php
namespace App\Http\Controllers;

use App\Models\Announcebar;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
         // Fetch the latest data
        return view('admin.index');
    }
    
     
}
