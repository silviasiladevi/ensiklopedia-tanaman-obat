<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey = 'kategori';
    protected $keyType = 'string';

    protected $fillable = [
        'kategori',

    ];

    public function tanaman()
    {
        return $this->hasMany(Tanaman::class, 'kategori', 'kategori');
    }
}
