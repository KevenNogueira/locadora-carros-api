<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'nom_modelo',
        'imagem',
        'num_porta',
        'num_assento',
        'air_bag',
        'abs',
    ];

    public function marca(): BelongsTo
    {
        // Um modelo pertence a uma marca
        return $this->belongsTo(Marca::class, 'cnpj_marca');
    }
}