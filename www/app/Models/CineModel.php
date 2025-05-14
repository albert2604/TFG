<?php
namespace App\Models;

use App\Libraries\DirectusApi;
use CodeIgniter\Model;
use App\Classes\Cine;

class CineModel extends Model
{
    protected $directusApi;

    public function __construct()
    {
        $this->directusApi = new DirectusApi();
    }

    public function getCines(){

        $cines = $this->directusApi->getAllItems('cines');

        if ($cines === null){
            return null;
        }
        $cines = array_map(fn($cineData) => new Cine($cineData), $cines);

        return $cines;
    }

    public function getCineById($id)
    {
        $result = $this->directusApi->getItemById('cines', $id);
        return $result;
    }

    public function crearCine($cine)
    {
        $result = $this->directusApi->createItem('cines', $cine);
        return $result;
    }

   
    public function editarCine($id, $cine)
    {
        $result = $this->directusApi->updateItemById('cines', $id, $cine);
        return $result;
    }

    public function eliminarCine($id, $cine)
    {
        $result = $this->directusApi->deleteItemById('cines', $id, $cine);
        return $result;
    }
} 