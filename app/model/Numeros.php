<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Numeros extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "numeros";
    public $timestamps = true;
    protected $fillable = [
        'numero', 'sim', 'cpf', 'deleted_at', 'created_at', 'updated_at', 'user_id', 'dt_cadastro'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contratos()
    {
        return $this->belongsTo(Contratos::class);
    }
}
