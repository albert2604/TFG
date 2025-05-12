<?php
namespace App\Models;

use CodeIgniter\Model;

class FuncionModel extends Model
{
    protected $apiUrl = 'http://localhost:8055/items/funciones';

    public function getFunciones()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            $data['data'] = array_map(function($funcionData) {
                return new Funcion($funcionData);
            }, $data['data']);
        }
        return $data;
    }

    public function getFuncionById($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl . '/' . $id);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            return new Funcion($data['data']);
        }
        return null;
    }

    public function crearFuncion(Funcion $funcion)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->post($this->apiUrl, [
            'json' => $funcion->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function actualizarFuncion(Funcion $funcion)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->patch($this->apiUrl . '/' . $funcion->getId(), [
            'json' => $funcion->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function eliminarFuncion($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->delete($this->apiUrl . '/' . $id);
        return json_decode($response->getBody(), true);
    }
} 