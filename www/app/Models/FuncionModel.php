<?php

namespace App\Models;

use App\Libraries\DirectusApi;
use CodeIgniter\Model;
use App\Classes\Funcion;

class FuncionModel extends Model
{
    protected $directusApi;

    public function __construct()
    {
        $this->directusApi = new DirectusApi();
    }

    public function getFunciones()
    {
        $funciones = $this->directusApi->getAllItems('funciones');

        if ($funciones === null) {
            return null;
        }
        $funciones = array_map(fn($funcionData) => new Funcion($funcionData), $funciones);

        return $funciones;
    }

    public function getFuncionById($id)
    {
        $result = $this->directusApi->getItemById("funciones", $id);
        return $result;
    }

    public function crearFuncion($funcion)
    {
        $result = $this->directusApi->createItem("funciones", $funcion);
        return $result;
    }

    public function editarFuncion($id, $funcion)
    {
        $result = $this->directusApi->updateItemById("funciones", $id, $funcion);
        return $result;
    }

    public function eliminarFuncion($id, $funcion)
    {
        $result = $this->directusApi->deleteItemById("funciones", $id, $funcion);
        return $result;
    }
}
