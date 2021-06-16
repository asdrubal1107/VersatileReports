<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_rol',
        'tipo_documento',
        'documento',
        'password',
        'estado'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static $rules = [
        'id_rol' => 'required|exists:roles,id_rol',
        'tipo_documento' => 'required',
        'documento' => 'required|numeric|min:1000000|max:20000000000|unique:usuarios,documento',
        'password' => 'required|min:8|max:20',
        'estado' => 'in:1,0'
    ];

    /* protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */
}
