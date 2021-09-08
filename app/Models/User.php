<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'gender',
        'marital_status',
        'address',
        'status',
        'phone',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function adminlte_image()
    {
        $user = Auth::user();
        if($user->foto != 'user.png'){
            return 'https://picsum.photos/300/300';
        }
        return 'https://picsum.photos/300/300';
        //return '/storage/users/'.$user->foto;
        //return 'https://picsum.photos/300/300'; //{{ asset ('/storage/users/'.$user->foto)}}
    }

    public static function adminlte_desc()
    {
        return 'ADMINISTRADOR';
    }
    public function adminlte_profile_url()
    {
        return 'admin/profile';
    }
}
