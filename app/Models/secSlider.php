<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class secSlider extends Model
{
    use HasFactory;

    protected $table ='Secsliders';

    protected $fillable =['image','title','description','price','rating','duration'];

}
