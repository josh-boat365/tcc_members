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
        'gender',
        'contact_1',
        'contact_2',
        'location',
        'department',
        'group',
        'image',
        'year_joined',
    ];

    public function scopeSearchMembers($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('code', 'like', '%' . $search . '%')
                ->orWhere('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('gender', 'like', '%' . $search . '%')
                ->orWhere('contact_1', 'like', '%' . $search . '%')
                ->orWhere('contact_2', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->orWhere('department', 'like', '%' . $search . '%')
                ->orWhere('group', 'like', '%' . $search . '%')
                ->orWhere('year_joined', 'like', '%' . $search . '%');
        });
    }
}
