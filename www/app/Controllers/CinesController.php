<?php

namespace App\Controllers;

use App\Models\CineModel;
use App\Classes\Cine;

class CinesController extends AdminController
{
    protected $cineModel;

    public function __construct()
    {
        parent::__construct();
        $this->cineModel = new CineModel();
    }

    public function index()
    {
        $cines = $this->cineModel->getCines();
        return view('cines/index', ['cines' => $cines]);
    }

    public function crear()
    {

        return view('cines/crear');
    }

    public function doCrear()
    {

        //VALIDAMOS LA ENTRADA DE LA PELICULA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'status' => 'required'
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            return view('cines/crear', [
                'validation' => $validation
            ]);
        }

        //SI TODO ES CORRECTO CREAMOS LA PELICULA
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'direccion' => $this->request->getPost('direccion'),
            'ciudad' => $this->request->getPost('ciudad'),
            'telefono' => $this->request->getPost('telefono'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status') ?? 'activo'
        ];

        $cine = $this->cineModel->crearCine($data);
        if ($cine['id']) {
            return redirect()->to('cines/admin/list/');
        }
    }

    public function editar($id)
    {

        $cine = $this->cineModel->getCineById($id);

        if (!$cine) {
            return redirect()->to('/cines/admin/list')->with('error', 'Cine no encontrado');
        }

        return view('cines/editar', ['cine' => new Cine($cine)]);
    }

    public function doEditar($id)
    {
        $cine = $this->cineModel->getCineById($id);

        //VALIDAMOS LA ENTRADA DE LA PELICULA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'status' => 'required'
        ]);

        //SI TODO ES CORRECTO CREAMOS LA PELICULA
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'direccion' => $this->request->getPost('direccion'),
            'ciudad' => $this->request->getPost('ciudad'),
            'telefono' => $this->request->getPost('telefono'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status') ?? 'activo'
        ];

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            return view('cines/editar', [
                'cine' => new Cine($data),
                'validation' => $validation
            ]);
        }

        $cine = $this->cineModel->editarCine($id, $data);
        if ($cine['id']) {
            return redirect()->to('cines/admin/list/');
        }
    }

    public function doEliminar($id)
    {
        $cineId = $this->cineModel->getCineById($id);

        if (!$cineId) {
            return redirect()->to('/cines/admin/list')->with('error', 'cine no encontrado');
        }

        $cine = $this->cineModel->eliminarCine($id, ['status' => 'eliminado']);

        if ($cine['id']) {
            return redirect()->to('cines/admin/list');
        }
    }

    public function ver($id)
    {
        $cine = $this->cineModel->getCineById($id);

        if (!$cine) {
            return redirect()->to('/cines')->with('error', 'cine no encontrado');
        }

        return view('cines/ver', ['cine' => new Cine($cine)]);
    }
}
