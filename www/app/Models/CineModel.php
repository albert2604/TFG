<?php
namespace App\Models;

use CodeIgniter\Model;

class CineModel extends Model
{
    protected $apiUrl = 'http://localhost:8055/items/cines'; // Cambia la URL si es necesario

    public function getCines()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            $data['data'] = array_map(function($cineData) {
                return new Cine($cineData);
            }, $data['data']);
        }
        return $data;
    }

    public function getCineById($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl . '/' . $id);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            return new Cine($data['data']);
        }
        return null;
    }

    public function crearCine(Cine $cine)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->post($this->apiUrl, [
            'json' => $cine->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function actualizarCine(Cine $cine)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->patch($this->apiUrl . '/' . $cine->getId(), [
            'json' => $cine->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function eliminarCine($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->delete($this->apiUrl . '/' . $id);
        return json_decode($response->getBody(), true);
    }
} 