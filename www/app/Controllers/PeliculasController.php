<?php
namespace App\Controllers;

use App\Models\PeliculaModel;
use App\Classes\Pelicula;

class PeliculasController extends BaseController
{
    protected $peliculaModel;

    public function __construct()
    {
        $this->peliculaModel = new PeliculaModel();
    }

    public function index()
    {
        $data = $this->peliculaModel->getPeliculas();
        return view('peliculas/index', ['peliculas' => $data['data']]);
    }

    public function crear()
    {
        if ($this->request->getMethod() === 'post') {
            $pelicula = new Pelicula([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'duracion' => $this->request->getPost('duracion'),
                'genero' => $this->request->getPost('genero'),
                'clasificacion' => $this->request->getPost('clasificacion'),
                'poster_url' => $this->request->getPost('poster_url'),
                'trailer_url' => $this->request->getPost('trailer_url'),
                'estado' => $this->request->getPost('estado') ?? 'activo'
            ]);

            $resultado = $this->peliculaModel->crearPelicula($pelicula);
            
            if ($resultado) {
                return redirect()->to('/peliculas')->with('mensaje', 'Película creada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al crear la película');
        }

        return view('peliculas/crear');
    }

    public function editar($id)
    {
        $pelicula = $this->peliculaModel->getPeliculaById($id);
        
        if (!$pelicula) {
            return redirect()->to('/peliculas')->with('error', 'Película no encontrada');
        }

        if ($this->request->getMethod() === 'post') {
            $pelicula->setTitulo($this->request->getPost('titulo'));
            $pelicula->setDescripcion($this->request->getPost('descripcion'));
            $pelicula->setDuracion($this->request->getPost('duracion'));
            $pelicula->setGenero($this->request->getPost('genero'));
            $pelicula->setClasificacion($this->request->getPost('clasificacion'));
            $pelicula->setPosterUrl($this->request->getPost('poster_url'));
            $pelicula->setTrailerUrl($this->request->getPost('trailer_url'));
            $pelicula->setEstado($this->request->getPost('estado'));

            $resultado = $this->peliculaModel->actualizarPelicula($pelicula);
            
            if ($resultado) {
                return redirect()->to('/peliculas')->with('mensaje', 'Película actualizada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al actualizar la película');
        }

        return view('peliculas/editar', ['pelicula' => $pelicula]);
    }

    public function eliminar($id)
    {
        $resultado = $this->peliculaModel->eliminarPelicula($id);
        
        if ($resultado) {
            return redirect()->to('/peliculas')->with('mensaje', 'Película eliminada exitosamente');
        }
        
        return redirect()->back()->with('error', 'Error al eliminar la película');
    }

    public function ver($id)
    {
        $pelicula = $this->peliculaModel->getPeliculaById($id);
        
        if (!$pelicula) {
            return redirect()->to('/peliculas')->with('error', 'Película no encontrada');
        }

        return view('peliculas/ver', ['pelicula' => $pelicula]);
    }
}