<?php

namespace App\Models;

use App\Libraries\DirectusApi;
use CodeIgniter\Model;
use App\Classes\Sala;

class SalaModel extends Model
{
    protected $directusApi;

    public function __construct()
    {
        $this->directusApi = new DirectusApi();
    }

    public function getSalas()
    {
        $salas = $this->directusApi->getAllItems('salas');

        if ($salas === null) {
            return null;
        }
        $salas = array_map(fn($salaData) => new Sala($salaData), $salas);

        return $salas;
    }

    public function getSalaById($id)
    {
        $result = $this->directusApi->getItemById("salas", $id);
        return $result;
    }

    public function getTiposSalas()
    {
        $fields = $this->directusApi->getFields("salas");

        $filtered = array_values(array_filter($fields, function ($field) {
            return isset($field['field']) && $field['field'] === 'tipo_sala';
        }));

        return $filtered[0]['meta']['options']['choices'] ?? [];
    }

    public function crearSala($sala)
    {
        $result = $this->directusApi->createItem("salas", $sala);
        return $result;
    }

    public function editarSala($id, $sala)
    {
        $result = $this->directusApi->updateItemById("salas", $id, $sala);
        return $result;
    }

    public function eliminarSala($id, $sala)
    {
        $result = $this->directusApi->deleteItemById("salas", $id, $sala);
        return $result;
    }
}
