<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_names',
        'position_title',
        'member_number',
        'join_year',
        'photo_path',
        'user_id',
    ];
}


