<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbarmenu extends Model
{
    use HasFactory;
    protected $table = 'navbarmenus';
    protected $fillable = ['name' , 'url'];
}
