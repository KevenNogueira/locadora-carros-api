<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'vin';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'vin',
        'num_modelo',
        'placa',
        'disponivel',
        'km'
    ];

    public function modelo(): BelongsTo
    {
        return $this->belongsTo(Modelo::class, 'num_modelo');
    }
}