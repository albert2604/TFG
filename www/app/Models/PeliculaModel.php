<?php
namespace App\Models;

use App\Libraries\DirectusApi;
use CodeIgniter\Model;
use App\Classes\Pelicula;

class PeliculaModel extends Model
{
     protected $directusApi;

    public function __construct()
    {
        $this->directusApi = new DirectusApi();
    }

    public function getPelicula()
    {
        $peliculas = $this->directusApi->getAllItems('peliculas');

        if ($peliculas === null) {
            return null;
        }
        $peliculas = array_map(fn($peliculaData) => new Pelicula($peliculaData), $peliculas);

        return $peliculas;
    }

    public function getPeliculaById($id)
    {
        $result = $this->directusApi->getItemById("peliculas", $id);
        return $result;
    }

    public function crearPelicula($pelicula)
    {
        if($pelicula['poster_url']->getName() != ''){
            $posterId = $this->directusApi->createFile($pelicula["poster_url"]);
            $pelicula['poster_url'] = $posterId;
        }
        else{
            $pelicula['poster_url'] = null;
        }
        
        $result = $this->directusApi->createItem("peliculas", $pelicula);
        return $result;
    }

    public function editarPelicula($id, $pelicula)
    {
        if($pelicula['poster_url']->getName() != ''){
            $posterId = $this->directusApi->createFile($pelicula["poster_url"]);
            $pelicula['poster_url'] = $posterId;
        }
        else{
            $pelicula['poster_url'] = null;
        }
        
        $result = $this->directusApi->updateItemById("peliculas", $id, $pelicula);
        
        return $result;
    }

    public function eliminarPelicula($id, $pelicula)
    {
        $result = $this->directusApi->deleteItemById("peliculas", $id, $pelicula);
        return $result;
    }
}