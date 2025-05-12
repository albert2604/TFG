<?php
namespace App\Controllers;

use App\Models\SalaModel;
use App\Models\CineModel;
use App\Classes\Sala;

class SalasController extends BaseController
{
    protected $salaModel;
    protected $cineModel;

    public function __construct()
    {
        $this->salaModel = new SalaModel();
        $this->cineModel = new CineModel();
    }

    public function index()
    {
        $data = $this->salaModel->getSalas();
        return view('salas/index', ['salas' => $data['data']]);
    }

    public function crear()
    {
        if ($this->request->getMethod() === 'post') {
            $sala = new Sala([
                'cine_id' => $this->request->getPost('cine_id'),
                'nombre' => $this->request->getPost('nombre'),
                'capacidad' => $this->request->getPost('capacidad'),
                'tipo' => $this->request->getPost('tipo'),
                'estado' => $this->request->getPost('estado') ?? 'activo'
            ]);

            $resultado = $this->salaModel->crearSala($sala);
            
            if ($resultado) {
                return redirect()->to('/salas')->with('mensaje', 'Sala creada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al crear la sala');
        }

        $cines = $this->cineModel->getCines()['data'];
        return view('salas/crear', ['cines' => $cines]);
    }

    public function editar($id)
    {
        $sala = $this->salaModel->getSalaById($id);
        
        if (!$sala) {
            return redirect()->to('/salas')->with('error', 'Sala no encontrada');
        }

        if ($this->request->getMethod() === 'post') {
            $sala->setCineId($this->request->getPost('cine_id'));
            $sala->setNombre($this->request->getPost('nombre'));
            $sala->setCapacidad($this->request->getPost('capacidad'));
            $sala->setTipoSala($this->request->getPost('tipo'));
            $sala->setEstado($this->request->getPost('estado'));

            $resultado = $this->salaModel->actualizarSala($sala);
            
            if ($resultado) {
                return redirect()->to('/salas')->with('mensaje', 'Sala actualizada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al actualizar la sala');
        }

        $cines = $this->cineModel->getCines()['data'];
        return view('salas/editar', ['sala' => $sala, 'cines' => $cines]);
    }

    public function eliminar($id)
    {
        $resultado = $this->salaModel->eliminarSala($id);
        
        if ($resultado) {
            return redirect()->to('/salas')->with('mensaje', 'Sala eliminada exitosamente');
        }
        
        return redirect()->back()->with('error', 'Error al eliminar la sala');
    }

    public function ver($id)
    {
        $sala = $this->salaModel->getSalaById($id);
        
        if (!$sala) {
            return redirect()->to('/salas')->with('error', 'Sala no encontrada');
        }

        return view('salas/ver', ['sala' => $sala]);
    }
} 