<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class MarcaRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selecaoAttrsModelosRelacionados($attr)
    {
        $this->model = $this->model->with($attr);
    }

    public function filtro($filtro)
    {
        $filtros = explode(';', $filtro);

        foreach ($filtros as $key => $condicao) {

            $condicoes = explode(':', $condicao);
            $this->model = $this->model->where($condicoes[0], $condicoes[1], $condicoes[2]);
        }
    }

    public function selecaoAttrs($attrs)
    {
        $this->model = $this->model->selectRaw($attrs);
    }

    public function getResultado()
    {
        return $this->model->get();
    }
}