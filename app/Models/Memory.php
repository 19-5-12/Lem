<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    protected $fillable = ['image_path', 'caption', 'image_paths'];

    protected $casts = [
    'image_paths' => 'array',
    ];

}
