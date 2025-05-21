<?php
namespace App\Models;

use App\Libraries\DirectusApi;
use CodeIgniter\Model;
use App\Classes\Reserva;


class ReservaModel extends Model
{
    protected $directusApi;

    public function __construct()
    {
        $this->directusApi = new DirectusApi();
    }

    public function getReservas()
    {
         $reservas = $this->directusApi->getAllItems('reservas');

        if ($reservas === null) {
            return null;
        }
        $reservas = array_map(fn($reservaData) => new Reserva($reservaData), $reservas);

        return $reservas;
    }

    public function getReservaById($id)
    {
        $result = $this->directusApi->getItemById("reservas", $id);
        return $result;
    }

    public function crearReserva($reserva)
    {
        $result = $this->directusApi->createItem("reservas", $reserva);
        return $result;
    }

    public function editarReserva($id, $reserva)
    {
        
        $result = $this->directusApi->updateItemById("reservas", $id, $reserva);
        return $result;
    }

     public function eliminarReserva($id, $reserva)
    {
        $result = $this->directusApi->deleteItemById("reservas", $id, $reserva);
        return $result;
    }
} 