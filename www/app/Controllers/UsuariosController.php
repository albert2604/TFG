<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\FuncionModel;
use App\Models\ReservaModel;
use App\Models\CineModel;
use App\Models\PeliculaModel;
use App\Classes\Usuario;
use App\Classes\Pelicula;
use CodeIgniter\HTTP\RedirectResponse;

class UsuariosController extends LoggedController
{
    protected $usuarioModel;
    protected $funcionModel;
    protected $reservaModel;
    protected $cineModel;
    protected $peliculaModel;

    public function __construct()
    {
        parent::__construct();
        $this->usuarioModel = new UsuarioModel();
        $this->funcionModel = new FuncionModel();
        $this->reservaModel = new ReservaModel();
        $this->cineModel = new cineModel();
        $this->peliculaModel = new PeliculaModel();
    }

    public function index()
    {
        return view('home/index');
    }

    public function ver($id)
    {
        if ($id !== $this->loggedUser['usuario_id']) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        $usuario = $this->usuarioModel->getUsuarioById($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        return view('usuarios/ver', ['usuario' => new Usuario($usuario)]);
    }
    public function verCartelera()
    {
        $peliculas = $this->peliculaModel->getPelicula();
        return view('peliculas/index', ['peliculas' => $peliculas]);
    }
     public function verPelicula($id)
    {
        $pelicula = $this->peliculaModel->getPeliculaById($id);

        if (!$pelicula) {
            return redirect()->to('/peliculas')->with('error', 'pelicula no encontrado');
        }

        return view('peliculas/ver', ['pelicula' => new Pelicula($pelicula)]);
    }
    public function crear()
    {

        $cines = $this->cineModel->getCines();
        $reserva = $this->reservaModel->getReservas();
        return view('wizard/index', ['cines' => $cines, 'reserva' => $reserva, 'usuario_id' => $this->loggedUser['usuario_id']]);
    }

    public function doCrear()
    {
        //VALIDAMOS LA ENTRADA DE LA RESERVA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'funcion_id' => 'required',
            'usuario_id' => 'required',
            'total' => 'required',
            'butacas' => 'required',
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $funciones = $this->funcionModel->getFunciones();
            $usuarios = $this->usuarioModel->getUsuarios();
            $cines = $this->cineModel->getCines();
            return view('wizard/index', [
                'validation' => $validation,
                'funciones' => $funciones,
                'usuarios' => $usuarios,
                'cines' => $cines
            ]);
        }


        //SI TODO ES CORRECTO CREAMOS LA RESERVA
        $data = [
            'funcion_id' => $this->request->getPost('funcion_id'),
            'usuario_id' => $this->request->getPost('usuario_id'),
            'butacas' => $this->request->getPost('butacas'),
            'total' => $this->request->getPost('total'),
            'status' => $this->request->getPost('status') ?? 'pendiente'
        ];

        $reserva = $this->reservaModel->crearReserva($data);
        if ($reserva['id']) {
            return $this->response->setJSON(array(
                'url' => site_url('payment/' . $reserva['id'] . '/create')
            ));
        }
    }
}
