<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locacao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'locacoes';

    protected $fillable = [
        'cpf_cliente',
        'vin_carro',
        'data_inicio_periodo',
        'data_final_previsto_periodo',
        'data_final_realizado_periodo',
        'valor_diaria',
        'km_inicial',
        'km_final',
    ];
}