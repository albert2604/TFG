<?php

namespace App\Controllers;

use App\Models\SalaModel;
use App\Models\CineModel;
use App\Classes\Sala;

class SalasController extends AdminController
{
    protected $salaModel;
    protected $cineModel;

    public function __construct()
    {
        parent::__construct();
        $this->salaModel = new SalaModel();
        $this->cineModel = new CineModel();
    }

    public function index()
    {   
        $tipos = $this->salaModel->getTiposSalas();
        $salas = $this->salaModel->getSalas();
        return view('salas/index', ['salas' => $salas,'tipos'=> $tipos]);
    }

    public function crear()
    {
        $cines = $this->cineModel->getCines();
        $tipos = $this->salaModel->getTiposSalas();

        return view('salas/crear', ['cines' => $cines, 'tipos'=> $tipos]);
    }

    public function doCrear()
    {
        //VALIDAMOS LA ENTRADA DE LA SALA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'cine_id' => 'required',
            'nombre' => 'required',
            'capacidad' => 'required',
            'tipo_sala' => 'required',
            'status' => 'required',
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $cines = $this->cineModel->getCines();
            $tipos = $this->salaModel->getTiposSalas();
            return view('salas/crear', [
                'validation' => $validation,
                'tipos' => $tipos,
                'cines' => $cines
            ]);
        }

        //SI TODO ES CORRECTO CREAMOS LA sala
        $data = [
            'cine_id' => $this->request->getPost('cine_id'),
            'nombre' => $this->request->getPost('nombre'),
            'capacidad' => $this->request->getPost('capacidad'),
            'tipo_sala' => $this->request->getPost('tipo'),
            'status' => $this->request->getPost('status') ?? 'activo'
        ];

        $sala = $this->salaModel->crearSala($data);
        if ($sala['id']) {
            return redirect()->to('salas/admin/list/');
        }
    }

    public function editar($id){
         $sala = $this->salaModel->getSalaById($id);
         $cines = $this->cineModel->getCines();
         $tipos = $this->salaModel->getTiposSalas();

        if (!$sala) {
            return redirect()->to('/salas/admin/list')->with('error', 'sala no encontrado');
        }

        return view('salas/editar', ['sala' => new Sala($sala), 'cines' => $cines, 'tipos' => $tipos]);
   
    }

    public function doEditar($id)
    {
        $sala = $this->salaModel->getSalaById($id);

        if (!$sala) {
            return redirect()->to('/salas/admin/list')->with('error', 'Sala no encontrada');
        }

        //VALIDAMOS LA ENTRADA DE LA SALA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'cine_id' => 'required',
            'nombre' => 'required',
            'capacidad' => 'required',
            'tipo_sala' => 'required',
            'status' => 'required',
        ]);

        
        //SI TODO ES CORRECTO CREAMOS LA SALA
        $data = [
            'cine_id' => $this->request->getPost('cine_id'),
            'nombre' => $this->request->getPost('nombre'),
            'capacidad' => $this->request->getPost('capacidad'),
            'tipo_sala' => $this->request->getPost('tipo'),
            'status' => $this->request->getPost('estado') ?? 'activo'
        ];

         //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $cines = $this->cineModel->getCines();
            $tipos = $this->salaModel->getTiposSalas();
            return view('salas/editar', [
                'sala' => new Sala($data),
                'validation' => $validation,
                'tipos' => $tipos,
                'cines' => $cines
            ]);
        }

        $sala = $this->salaModel->editarSala($id,$data);
        if ($sala['id']) {
            return redirect()->to('salas/admin/list/');
        }
    }

    public function doEliminar($id)
    {
        $salaId = $this->salaModel->getSalaById($id);

        if (!$salaId) {
            return redirect()->to('/salas')->with('error', 'sala no encontrado');
        }

        $sala = $this->salaModel->eliminarSala($id, ['status' => 'eliminado']);

        if ($sala['id']) {
            return redirect()->to('salas/admin/list');
        }
    }

    public function ver($id)
    {
        $sala = $this->salaModel->getSalaById($id);

        if (!$sala) {
            return redirect()->to('/salas')->with('error', 'sala no encontrado');
        }

        return view('salas/ver', ['sala' => new Sala($sala)]);
    }
    
}
