<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;
    protected $table = 'tanamen';

    protected $fillable = [
        'nama_tanaman',
        'username',
        'desk',
        'latin',
        'lokasi',
        'khasiat',
        'kategori',
        'gambar',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username')->withTrashed();
    }

    public function kategori()
    {
        return $this->belongsTo(User::class, 'kategori', 'kategori')->withTrashed();
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class, 'tanaman_id', 'id')->withTrashed();
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'tanaman_id', 'id');
    }
}
