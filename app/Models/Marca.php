<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'cnpj';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['cnpj', 'nome', 'e-mail', 'imagem'];
}