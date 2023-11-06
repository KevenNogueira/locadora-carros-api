<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'num_modelo';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = [
        'num_modelo',
        'cnpj_marca',
        'imagem',
        'numero_portas',
        'lugares',
        'air_bag',
        'abs',
    ];
}