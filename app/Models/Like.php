<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $primaryKey = 'username';
    protected $keyType = 'string';

    protected $fillable = [
        'tanaman_id',
        'username',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id', 'id');
    }
}
