<?php

namespace App;

use App\model\Contratos;
use App\model\Faturas;
use App\model\Numeros;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'endereco', 'cidade', 'data_nasc', 'cpf', 'rg', 'situacao', 'tipo', 'num_func'
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


    public function get_roles()
    {
        $roles = [];
        foreach ($this->getRoleNames() as $key => $role) {
            $roles[$key] = $role;
        }

        return $roles;
    }

    public function numeros()
    {
        return $this->hasMany(Numeros::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contratos::class);
    }

    public function user()
    {
        return $this->hasMany(Faturas::class);
    }
}
