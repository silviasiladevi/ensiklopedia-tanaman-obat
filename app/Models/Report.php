<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'tanaman_id',
        'username',
        'pesan',
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username')->withTrashed();
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id', 'id');
    }
}
