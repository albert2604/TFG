<?php
namespace App\Controllers;

use App\Models\CineModel;
use App\Classes\Cine;

class CinesController extends BaseController
{
    protected $cineModel;

    public function __construct()
    {
        $this->cineModel = new CineModel();
    }

    public function index()
    {
        $data = $this->cineModel->getCines();
        return view('cines/index', ['cines' => $data['data']]);
    }

    public function crear()
    {
        if ($this->request->getMethod() === 'post') {
            $cine = new Cine([
                'nombre' => $this->request->getPost('nombre'),
                'direccion' => $this->request->getPost('direccion'),
                'ciudad' => $this->request->getPost('ciudad'),
                'telefono' => $this->request->getPost('telefono'),
                'email' => $this->request->getPost('email'),
                'estado' => $this->request->getPost('estado') ?? 'activo'
            ]);

            $resultado = $this->cineModel->crearCine($cine);
            
            if ($resultado) {
                return redirect()->to('/cines')->with('mensaje', 'Cine creado exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al crear el cine');
        }

        return view('cines/crear');
    }

    public function editar($id)
    {
        $cine = $this->cineModel->getCineById($id);
        
        if (!$cine) {
            return redirect()->to('/cines')->with('error', 'Cine no encontrado');
        }

        if ($this->request->getMethod() === 'post') {
            $cine->setNombre($this->request->getPost('nombre'));
            $cine->setDireccion($this->request->getPost('direccion'));
            $cine->setCiudad($this->request->getPost('ciudad'));
            $cine->setTelefono($this->request->getPost('telefono'));
            $cine->setEmail($this->request->getPost('email'));
            $cine->setEstado($this->request->getPost('estado'));

            $resultado = $this->cineModel->actualizarCine($cine);
            
            if ($resultado) {
                return redirect()->to('/cines')->with('mensaje', 'Cine actualizado exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al actualizar el cine');
        }

        return view('cines/editar', ['cine' => $cine]);
    }

    public function eliminar($id)
    {
        $resultado = $this->cineModel->eliminarCine($id);
        
        if ($resultado) {
            return redirect()->to('/cines')->with('mensaje', 'Cine eliminado exitosamente');
        }
        
        return redirect()->back()->with('error', 'Error al eliminar el cine');
    }

    public function ver($id)
    {
        $cine = $this->cineModel->getCineById($id);
        
        if (!$cine) {
            return redirect()->to('/cines')->with('error', 'Cine no encontrado');
        }

        return view('cines/ver', ['cine' => $cine]);
    }
} 