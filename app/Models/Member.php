<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'first_name',
        'last_name',
        'contact_1',
        'contact_2',
        'location',
        'department',
        'image',
    ];
}
