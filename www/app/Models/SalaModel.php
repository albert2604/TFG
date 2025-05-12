<?php
namespace App\Models;

use CodeIgniter\Model;

class SalaModel extends Model
{
    protected $apiUrl = 'http://localhost:8055/items/salas';

    public function getSalas()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            $data['data'] = array_map(function($salaData) {
                return new Sala($salaData);
            }, $data['data']);
        }
        return $data;
    }

    public function getSalaById($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl . '/' . $id);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            return new Sala($data['data']);
        }
        return null;
    }

    public function crearSala(Sala $sala)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->post($this->apiUrl, [
            'json' => $sala->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function actualizarSala(Sala $sala)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->patch($this->apiUrl . '/' . $sala->getId(), [
            'json' => $sala->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function eliminarSala($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->delete($this->apiUrl . '/' . $id);
        return json_decode($response->getBody(), true);
    }
} 