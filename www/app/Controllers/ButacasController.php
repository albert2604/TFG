<?php
namespace App\Controllers;

use App\Models\ButacaModel;
use App\Models\SalaModel;
use App\Classes\Butaca;

class ButacasController extends BaseController
{
    protected $butacaModel;
    protected $salaModel;

    public function __construct()
    {
        $this->butacaModel = new ButacaModel();
        $this->salaModel = new SalaModel();
    }

    public function index()
    {
        $data = $this->butacaModel->getButacas();
        return view('butacas/index', ['butacas' => $data['data']]);
    }

    public function crear()
    {
        if ($this->request->getMethod() === 'post') {
            $butaca = new Butaca([
                'sala_id' => $this->request->getPost('sala_id'),
                'fila' => $this->request->getPost('fila'),
                'numero' => $this->request->getPost('numero'),
                'estado' => $this->request->getPost('estado') ?? 'disponible'
            ]);

            $resultado = $this->butacaModel->crearButaca($butaca);
            
            if ($resultado) {
                return redirect()->to('/butacas')->with('success', 'Butaca creada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al crear la butaca');
        }

        $salas = $this->salaModel->getSalas()['data'];
        return view('butacas/crear', ['salas' => $salas]);
    }

    public function editar($id)
    {
        $butaca = $this->butacaModel->getButacaById($id);
        
        if (!$butaca) {
            return redirect()->to('/butacas')->with('error', 'Butaca no encontrada');
        }

        if ($this->request->getMethod() === 'post') {
            $butaca->setSalaId($this->request->getPost('sala_id'));
            $butaca->setFila($this->request->getPost('fila'));
            $butaca->setNumero($this->request->getPost('numero'));
            $butaca->setEstado($this->request->getPost('estado'));

            $resultado = $this->butacaModel->actualizarButaca($butaca);
            
            if ($resultado) {
                return redirect()->to('/butacas')->with('success', 'Butaca actualizada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al actualizar la butaca');
        }

        $salas = $this->salaModel->getSalas()['data'];
        return view('butacas/editar', ['butaca' => $butaca, 'salas' => $salas]);
    }

    public function eliminar($id)
    {
        $resultado = $this->butacaModel->eliminarButaca($id);
        
        if ($resultado) {
            return redirect()->to('/butacas')->with('success', 'Butaca eliminada exitosamente');
        }
        
        return redirect()->back()->with('error', 'Error al eliminar la butaca');
    }

    public function ver($id)
    {
        $butaca = $this->butacaModel->getButacaById($id);
        
        if (!$butaca) {
            return redirect()->to('/butacas')->with('error', 'Butaca no encontrada');
        }

        return view('butacas/ver', ['butaca' => $butaca]);
    }

    public function porSala($salaId)
    {
        $butacas = $this->butacaModel->getButacasPorSala($salaId);
        return view('butacas/por_sala', ['butacas' => $butacas, 'salaId' => $salaId]);
    }
} 