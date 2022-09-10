<?php

namespace App\Models;

use App\Domain\RegisterNotFoundException;
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
        static public function crearUsuario($data): User
        {
            if(User::query()->where('email', $data->email)->exists()){
                throw new RegisterNotFoundException('El email ya existe');
            }
        try {
            $user = new User();
            $user->name = $data->nombre;
            $user->email = $data->email;
            $user->password =  hash ('sha256' , $data->password);
            $user->save();
        }catch (Exception $e)
        {
            throw new RegisterNotFoundException();
        }

        return $user;

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
