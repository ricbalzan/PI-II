<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contratos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "contratos";
    public $timestamps = true;
    protected $fillable = [
        'cpf', 'numero', 'user_id', 'numero_id', 'deleted_at', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function numeros()
    {
        return $this->belongsTo(Numeros::class);
    }
}
