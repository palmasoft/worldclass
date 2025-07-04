<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getRole($user)
    {
        $rol = @DB::table('role_user')->where('user_id','=',$user)->get()[0]->role_id;
        return Role::find($rol);
    }
    
    public static function getCliente($user)
    {
        return Cliente::where('user_id','=',$user)->get()[0];
    }
}
