<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faturas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "faturas";
    public $timestamps = true;
    protected $fillable = [
        'numero', 'data_insercao', 'mes', 'valor', 'numero_id', 'deleted_at', 'created_at', 'updated_at', 'user_id'
    ];

    public function numeros()
    {
        return $this->hasOne(Numeros::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
