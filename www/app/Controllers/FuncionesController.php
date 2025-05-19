<?php
namespace App\Controllers;

use App\Models\FuncionModel;
use App\Models\PeliculaModel;
use App\Models\SalaModel;
use App\Classes\Funcion;

class FuncionesController extends AdminController
{
    protected $funcionModel;
    protected $peliculaModel;
    protected $salaModel;

    public function __construct()
    {

        parent::__construct();
        $this->funcionModel = new FuncionModel();
        $this->peliculaModel = new PeliculaModel();
        $this->salaModel = new SalaModel();
    }

    public function index()
    {
        $funciones = $this->funcionModel->getFunciones();
        return view('funciones/index', ['funciones' => $funciones]);
    }

    public function crear()
    {
        $peliculas = $this->peliculaModel->getPelicula();
        $salas = $this->salaModel->getSalas();

        return view('funciones/crear', ['peliculas' => $peliculas, 'salas'=> $salas]);
    }

    public function doCrear()
    {
       //VALIDAMOS LA ENTRADA DE LA SALA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'pelicula_id' => 'required',
            'sala_id' => 'required',
            'fecha' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'precio' => 'required',
            'status' => 'required',
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $peliculas = $this->peliculaModel->getPelicula();
            $salas = $this->salaModel->getSalas();
            return view('salas/crear', [
                'validation' => $validation,
                'salas' => $salas,
                'peliculas' => $peliculas
            ]);
        }

        //SI TODO ES CORRECTO CREAMOS LA sala
        $data = [
            'pelicula_id' => $this->request->getPost('pelicula_id'),
            'sala_id' => $this->request->getPost('sala_id'),
            'fecha' => $this->request->getPost('fecha'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fin' => $this->request->getPost('hora_fin'),
            'precio' => $this->request->getPost('precio'),
            'status' => $this->request->getPost('status') ?? 'activo'
        ];

        $funcion = $this->funcionModel->crearFuncion($data);
        if ($funcion['id']) {
            return redirect()->to('funciones/admin/list/');
        }
    }


    public function editar($id){
         $funcion = $this->funcionModel->getFuncionById($id);
         $salas = $this->salaModel->getsalas();
         $peliculas = $this->peliculaModel->getPelicula();

        if (!$funcion) {
            return redirect()->to('/funciones/admin/list')->with('error', 'Funcion no encontrado');
        }

        return view('funciones/editar', ['funcion' => new Funcion($funcion), 'salas' => $salas, 'peliculas' => $peliculas]);
    }

    public function doEditar($id)
    {

        $funcion = $this->funcionModel->getFuncionById($id);
        
        if (!$funcion) {
            return redirect()->to('/funciones/admin/list')->with('error', 'Función no encontrada');
        }

        //VALIDAMOS LA ENTRADA DE LA SALA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'pelicula_id' => 'required',
            'sala_id' => 'required',
            'fecha' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'precio' => 'required',
            'status' => 'required',
        ]);

        //SI TODO ES CORRECTO CREAMOS LA sala
        $data = [
            'pelicula_id' => $this->request->getPost('pelicula_id'),
            'sala_id' => $this->request->getPost('sala_id'),
            'fecha' => $this->request->getPost('fecha'),
            'hora_inicio' => $this->request->getPost('hora_inicio'),
            'hora_fin' => $this->request->getPost('hora_fin'),
            'precio' => $this->request->getPost('precio'),
            'status' => $this->request->getPost('status') ?? 'activo'
        ];

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $peliculas = $this->peliculaModel->getPelicula();
            $salas = $this->salaModel->getSalas();
            return view('salas/crear', [
                'funcion' => new Funcion($data),
                'validation' => $validation,
                'salas' => $salas,
                'peliculas' => $peliculas
            ]);
        }

        $funcion = $this->funcionModel->editarFuncion($id,$data);
        if ($funcion['id']) {
            return redirect()->to('funciones/admin/list/');
        }
    }

    public function doEliminar($id)
    {
       $funcionId = $this->funcionModel->getFuncionById($id);

        if (!$funcionId) {
            return redirect()->to('/funciones/admin/list')->with('error', 'Funcion no encontrado');
        }

        $funcion = $this->funcionModel->eliminarFuncion($id, ['status' => 'eliminado']);

        if ($funcion['id']) {
            return redirect()->to('funciones/admin/list');
        }
    }

    public function ver($id)
    {
         $funcion = $this->funcionModel->getFuncionById($id);

        if (!$funcion) {
            return redirect()->to('/funciones/admin/list')->with('error', 'funcion no encontrado');
        }

        return view('funciones/ver', ['funcion' => new Funcion($funcion)]);
    }
} 