<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcebar extends Model
{
    use HasFactory;

    protected $table='announcebar';

    protected $fillable = ['phoneno','text','address'];
    
}
