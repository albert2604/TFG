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
        return view('salas/index', ['salas' => $salas, 'tipos' => $tipos]);
    }

    public function crear()
    {
        $cines = $this->cineModel->getCines();
        $tipos = $this->salaModel->getTiposSalas();

        return view('salas/crear', ['cines' => $cines, 'tipos' => $tipos]);
    }

    public function doCrear()
    {
        //VALIDAMOS LA ENTRADA DE LA SALA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'cine_id' => 'required',
            'nombre' => 'required',
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
            'tipo_sala' => $this->request->getPost('tipo_sala'),
            'status' => $this->request->getPost('status') ?? 'activo'
        ];

        $sala = $this->salaModel->crearSala($data);
        if ($sala['id']) {
            return redirect()->to('salas/admin/list/');
        }
    }

    public function editar($id)
    {
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
            'tipo_sala' => 'required',
            'status' => 'required',
        ]);


        //SI TODO ES CORRECTO CREAMOS LA SALA
        $data = [
            'cine_id' => $this->request->getPost('cine_id'),
            'nombre' => $this->request->getPost('nombre'),
            'tipo_sala' => $this->request->getPost('tipo_sala'),
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

        $sala = $this->salaModel->editarSala($id, $data);
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

    public function estructura($id)
    {
        $sala = $this->salaModel->getSalaById($id);

        if (!$sala) {
            return redirect()->to('/salas/admin/list')->with('error', 'sala no encontrado');
        }
        else{
            $salaObj = new Sala($sala);
            
            if (count($salaObj->getFunciones()) > 0 ) {

                 return redirect()->to('/salas/admin/list')->with('error', 'La sala tiene funciones asignadas. No se puede modificar la estructura.');
            }
        }

        return view('salas/estructura', ['sala' => $salaObj]);
    }

    public function doEstructura($id)
    {
        $data = [
            'numero_filas' => $this->request->getPost('numero_filas'),
            'numero_columnas' => $this->request->getPost('numero_columnas'),
            'filas_excluidas' => $this->request->getPost('filas_excluidas'),
            'columnas_excluidas' => $this->request->getPost('columnas_excluidas'),
            'butacas_excluidas' => $this->request->getPost('butacas_excluidas'),
        ];

        $sala = $this->salaModel->editarSala($id, $data);



        if (isset($sala['id'])) {
            return redirect()->to('salas/admin/editar/'.$sala['id']);
        }
        else if (count($sala->getFunciones()) != 0 ) {
            die("La sala tiene funciones.... no se puede cambiar la estructura.");
        }
        else {
            // Manejo del error
            return redirect()->back()->with('error', 'No se pudo guardar la sala');
        }
    }
}
