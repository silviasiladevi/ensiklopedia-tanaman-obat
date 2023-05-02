<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'no_hp',
        'email',
        'instagram',
        'facebook',
        'info_aplikasi',
        'tentang',
        'gambar',
    ];
    use HasFactory;
}
