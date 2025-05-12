<?php
namespace App\Controllers;

use App\Models\FuncionModel;
use App\Models\PeliculaModel;
use App\Models\SalaModel;
use App\Classes\Funcion;

class FuncionesController extends BaseController
{
    protected $funcionModel;
    protected $peliculaModel;
    protected $salaModel;

    public function __construct()
    {
        $this->funcionModel = new FuncionModel();
        $this->peliculaModel = new PeliculaModel();
        $this->salaModel = new SalaModel();
    }

    public function index()
    {
        $data = $this->funcionModel->getFunciones();
        return view('funciones/index', ['funciones' => $data['data']]);
    }

    public function crear()
    {
        // Verificar si es administrador
        if (!session()->get('is_admin')) {
            return redirect()->to('/')->with('error', 'No tiene permisos para acceder a esta sección');
        }

        if ($this->request->getMethod() === 'post') {
            $funcion = new Funcion([
                'pelicula_id' => $this->request->getPost('pelicula_id'),
                'sala_id' => $this->request->getPost('sala_id'),
                'fecha' => $this->request->getPost('fecha'),
                'hora_inicio' => $this->request->getPost('hora_inicio'),
                'hora_fin' => $this->request->getPost('hora_fin'),
                'precio_base' => $this->request->getPost('precio_base'),
                'estado' => $this->request->getPost('estado') ?? 'activo'
            ]);

            $resultado = $this->funcionModel->crearFuncion($funcion);
            
            if ($resultado) {
                return redirect()->to('/funciones')->with('mensaje', 'Función creada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al crear la función');
        }

        $peliculas = $this->peliculaModel->getPeliculas()['data'];
        $salas = $this->salaModel->getSalas()['data'];
        return view('funciones/crear', ['peliculas' => $peliculas, 'salas' => $salas]);
    }

    public function editar($id)
    {
        // Verificar si es administrador
        if (!session()->get('is_admin')) {
            return redirect()->to('/')->with('error', 'No tiene permisos para acceder a esta sección');
        }

        $funcion = $this->funcionModel->getFuncionById($id);
        
        if (!$funcion) {
            return redirect()->to('/funciones')->with('error', 'Función no encontrada');
        }

        if ($this->request->getMethod() === 'post') {
            $funcion->setPeliculaId($this->request->getPost('pelicula_id'));
            $funcion->setSalaId($this->request->getPost('sala_id'));
            $funcion->setFecha($this->request->getPost('fecha'));
            $funcion->setHoraInicio($this->request->getPost('hora_inicio'));
            $funcion->setHoraFin($this->request->getPost('hora_fin'));
            $funcion->setPrecioBase($this->request->getPost('precio_base'));
            $funcion->setEstado($this->request->getPost('estado'));

            $resultado = $this->funcionModel->actualizarFuncion($funcion);
            
            if ($resultado) {
                return redirect()->to('/funciones')->with('mensaje', 'Función actualizada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al actualizar la función');
        }

        $peliculas = $this->peliculaModel->getPeliculas()['data'];
        $salas = $this->salaModel->getSalas()['data'];
        return view('funciones/editar', ['funcion' => $funcion, 'peliculas' => $peliculas, 'salas' => $salas]);
    }

    public function eliminar($id)
    {
        // Verificar si es administrador
        if (!session()->get('is_admin')) {
            return redirect()->to('/')->with('error', 'No tiene permisos para acceder a esta sección');
        }

        $resultado = $this->funcionModel->eliminarFuncion($id);
        
        if ($resultado) {
            return redirect()->to('/funciones')->with('mensaje', 'Función eliminada exitosamente');
        }
        
        return redirect()->back()->with('error', 'Error al eliminar la función');
    }

    public function ver($id)
    {
        $funcion = $this->funcionModel->getFuncionById($id);
        
        if (!$funcion) {
            return redirect()->to('/funciones')->with('error', 'Función no encontrada');
        }

        return view('funciones/ver', ['funcion' => $funcion]);
    }
} 