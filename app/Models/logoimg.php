<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logoimg extends Model
{
    use HasFactory;
    protected $table = 'logoimgs'; 
    protected $fillable = ['logoimg'];
}
