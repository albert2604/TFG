<?php

namespace App\Controllers;

use App\Models\PeliculaModel;

class HomeController extends BaseController
{
    protected $peliculaModel;

    public function __construct()
    {
        $this->peliculaModel = new PeliculaModel();
    }
    public function index()
    {
        $peliculas = $this->peliculaModel->getPelicula();
        return view('home/index', ['peliculas' => $peliculas]);
    }
}
