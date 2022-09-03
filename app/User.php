<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mockery\Exception;

class User extends Authenticatable
{
    use Notifiable;
    use hasFactory;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     * Creamos un usuario con los datos siguientes...
     *      $datos->nombre ,
     *      $datos->email ,
     *      $datos->password
     */
        static public function crearUsuario($datos)
    {
        try {
            $usuario = new User();
            $usuario->name = $datos->nombre;
            $usuario->email = $datos->email;
            $usuario->password =  hash ('sha256' , $datos->password);
            $usuario->save();
        }catch (Exception $e)
        {
            return response(
                $error = 'error al crear el usuario -> ' . $e,
                $status = 400
            );
        }

        return $usuario;

    }

    public function configuracion()
    {
        return $this->hasOne('App\ConfiguracionUsuario','userId');
    }

    public function parteDiario()
    {
        return $this->hasMany('App\ParteDiario','userId');
    }
}
