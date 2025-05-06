<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterEditContent extends Model
{
    use HasFactory;

    protected $table='footer_editable_contents';

    protected $fillable=['Image','Text','TelPhone','Phone','Email','Copyright'];
}
