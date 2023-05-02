<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'username';
    protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'username',
        'nomor_hp',
        'email',
        'password',
        'jabatan'
    ];
    protected static function boot()
    {
        parent::boot();

        User::creating(function ($model) {
            $model->jabatan = 'user registered';
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];




    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tanaman()
    {
        return $this->hasMany(Tanaman::class, 'tanaman_id', 'id')->withTrashed();
    }

    public function report()
    {
        return $this->hasMany(Report::class)->withTrashed();
    }


    public function bookmark()
    {
        return $this->hasMany(Bookmark::class, 'username', 'username');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'username', 'username');
    }
}
