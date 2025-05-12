<?php
namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $apiUrl = 'http://localhost:8055/items/reservas';

    public function getReservas()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            $data['data'] = array_map(function($reservaData) {
                return new Reserva($reservaData);
            }, $data['data']);
        }
        return $data;
    }

    public function getReservaById($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get($this->apiUrl . '/' . $id);
        $data = json_decode($response->getBody(), true);
        if (isset($data['data'])) {
            return new Reserva($data['data']);
        }
        return null;
    }

    public function crearReserva(Reserva $reserva)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->post($this->apiUrl, [
            'json' => $reserva->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function actualizarReserva(Reserva $reserva)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->patch($this->apiUrl . '/' . $reserva->getId(), [
            'json' => $reserva->toArray()
        ]);
        return json_decode($response->getBody(), true);
    }

    public function eliminarReserva($id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->delete($this->apiUrl . '/' . $id);
        return json_decode($response->getBody(), true);
    }
} 