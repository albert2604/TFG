<?php
namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $apiUrl = 'http://localhost:8055/items/peliculas';

    public function getPeliculas()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            $data['data'] = array_map(function($peliculaData) {
                return new Pelicula($peliculaData);
            }, $data['data']);
        }
        return $data;
    }

    public function getPeliculaById($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl . '/' . $id);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            return new Pelicula($data['data']);
        }
        return null;
    }

    public function crearPelicula(Pelicula $pelicula)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->post($this->apiUrl, [
            'json' => $pelicula->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function actualizarPelicula(Pelicula $pelicula)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->patch($this->apiUrl . '/' . $pelicula->getId(), [
            'json' => $pelicula->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function eliminarPelicula($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->delete($this->apiUrl . '/' . $id);
        return json_decode($response->getBody(), true);
    }
}