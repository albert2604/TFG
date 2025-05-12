<?php
namespace App\Models;

use CodeIgniter\Model;

class ButacaModel extends Model
{
    protected $apiUrl = 'http://localhost:8055/items/butacas';

    public function getButacas()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            $data['data'] = array_map(function($butacaData) {
                return new Butaca($butacaData);
            }, $data['data']);
        }
        return $data;
    }

    public function getButacaById($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl . '/' . $id);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            return new Butaca($data['data']);
        }
        return null;
    }

    public function crearButaca(Butaca $butaca)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->post($this->apiUrl, [
            'json' => $butaca->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function actualizarButaca(Butaca $butaca)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->patch($this->apiUrl . '/' . $butaca->getId(), [
            'json' => $butaca->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function eliminarButaca($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->delete($this->apiUrl . '/' . $id);
        return json_decode($response->getBody(), true);
    }
} 