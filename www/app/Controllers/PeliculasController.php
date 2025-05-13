<?php

namespace App\Controllers;

use App\Classes\Pelicula;
use App\Models\PeliculaModel;


class PeliculasController extends AdminController
{
    protected $peliculaModel;

    public function __construct()
    {
        parent::__construct();
        $this->peliculaModel = new PeliculaModel();
    }

    public function index()
    {
        $peliculas = $this->peliculaModel->getPelicula();
        return view('peliculas/index', ['peliculas' => $peliculas]);
    }

    public function crear()
    {
        return view('peliculas/crear');
    }

    public function doCrear()
    {
        //VALIDAMOS LA ENTRADA DE LA PELICULA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'titulo' => 'required',
            'descripcion' => 'required',
            'duracion' => 'required',
            'genero' => 'required',
            'clasificacion' => 'required',
            'trailer_url' => 'required',
            'status' => 'required'
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            return view('peliculas/crear', [
                'validation' => $validation
            ]);
        }
 
        //SI TODO ES CORRECTO CREAMOS LA PELICULA
        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'duracion' => $this->request->getPost('duracion'),
            'genero' => $this->request->getPost('genero'),
            'clasificacion' => $this->request->getPost('clasificacion'),
            'poster_url' => $this->request->getFile('poster_url'),
            'trailer_url' => $this->request->getPost('trailer_url'),
            'status' => $this->request->getPost('status') ?? 'activo'
        ];

        $pelicula = $this->peliculaModel->crearPelicula($data);
        if ($pelicula['id']) {
            return redirect()->to('peliculas/admin/list/');
        }
    }

    public function editar($id)
    {
        $pelicula = $this->peliculaModel->getPeliculaById($id);

        if (!$pelicula) {
            return redirect()->to('/peliculas/admin/list')->with('error', 'Pelicula no encontrado');
        }

        return view('peliculas/editar', ['pelicula' => new Pelicula($pelicula)]);
    }
    
    public function doEditar($id)
    {
        $pelicula = $this->peliculaModel->getPeliculaById($id);

        if (!$pelicula) {
            return redirect()->to('peliculas/admin/list')->with('error', 'Película no encontrada');
        }

        //VALIDAMOS LA ENTRADA DE LA PELICULA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'titulo' => 'required',
            'descripcion' => 'required',
            'duracion' => 'required',
            'genero' => 'required',
            'clasificacion' => 'required',
            'trailer_url' => 'required',
            'status' => 'required'
        ]);

        //SI TODO ES CORRECTO CREAMOS LA PELICULA
        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'duracion' => $this->request->getPost('duracion'),
            'genero' => $this->request->getPost('genero'),
            'clasificacion' => $this->request->getPost('clasificacion'),
            'poster_url' => $this->request->getFile('poster_url'),
            'trailer_url' => $this->request->getPost('trailer_url'),
            'status' => $this->request->getPost('status') ?? 'activo'
        ];
        
        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            return view('peliculas/editar', [
                'pelicula' => new Pelicula($data),
                'validation' => $validation
            ]);
        }

        $pelicula = $this->peliculaModel->editarPelicula($id,$data);
        if ($pelicula['id']) {
            return redirect()->to('peliculas/admin/list/');
        }
    }

    public function doEliminar($id)
    {
        $peliculaId = $this->peliculaModel->getPeliculaById($id);

        if (!$peliculaId) {
            return redirect()->to('/peliculas')->with('error', 'pelicula no encontrado');
        }

        $pelicula = $this->peliculaModel->eliminarPelicula($id, ['status' => 'eliminado']);

        if ($pelicula['id']) {
            return redirect()->to('peliculas/admin/list');
        }
    }

    public function ver($id)
    {
        $pelicula = $this->peliculaModel->getPeliculaById($id);

        if (!$pelicula) {
            return redirect()->to('/peliculas')->with('error', 'pelicula no encontrado');
        }

        return view('peliculas/ver', ['pelicula' => new Pelicula($pelicula)]);
    }
}
