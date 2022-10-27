<?php

namespace App\model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aparelhos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "aparelhos";
    public $timestamps = true;
    protected $fillable = [
        'marca', 'modelo', 'num_serie', 'numero', 'estoque', 'dt_entrega', 'numero_id', 'deleted_at',
        'created_at', 'updated_at'
    ];

    public function numeros()
    {
        return $this->hasOne(Numeros::class);
    }
}
