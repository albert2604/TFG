<?php
namespace App\Controllers;

use App\Models\ReservaModel;
use App\Models\FuncionModel;
use App\Models\UsuarioModel;
use App\Classes\Reserva;

class ReservasController extends BaseController
{
    protected $reservaModel;
    protected $funcionModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->reservaModel = new ReservaModel();
        $this->funcionModel = new FuncionModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $data = $this->reservaModel->getReservas();
        return view('reservas/index', ['reservas' => $data['data']]);
    }

    public function crear()
    {
        if ($this->request->getMethod() === 'post') {
            $reserva = new Reserva([
                'funcion_id' => $this->request->getPost('funcion_id'),
                'usuario_id' => $this->request->getPost('usuario_id'),
                'fecha_reserva' => $this->request->getPost('fecha_reserva'),
                'total' => $this->request->getPost('total'),
                'estado' => $this->request->getPost('estado') ?? 'pendiente'
            ]);

            $resultado = $this->reservaModel->crearReserva($reserva);
            
            if ($resultado) {
                return redirect()->to('/reservas')->with('success', 'Reserva creada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al crear la reserva');
        }

        $funciones = $this->funcionModel->getFunciones()['data'];
        $usuarios = $this->usuarioModel->getUsuarios()['data'];
        return view('reservas/crear', ['funciones' => $funciones, 'usuarios' => $usuarios]);
    }

    public function editar($id)
    {
        $reserva = $this->reservaModel->getReservaById($id);
        
        if (!$reserva) {
            return redirect()->to('/reservas')->with('error', 'Reserva no encontrada');
        }

        if ($this->request->getMethod() === 'post') {
            $reserva->setFuncionId($this->request->getPost('funcion_id'));
            $reserva->setUsuarioId($this->request->getPost('usuario_id'));
            $reserva->setFechaReserva($this->request->getPost('fecha_reserva'));
            $reserva->setTotal($this->request->getPost('total'));
            $reserva->setEstado($this->request->getPost('estado'));

            $resultado = $this->reservaModel->actualizarReserva($reserva);
            
            if ($resultado) {
                return redirect()->to('/reservas')->with('success', 'Reserva actualizada exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al actualizar la reserva');
        }

        $funciones = $this->funcionModel->getFunciones()['data'];
        $usuarios = $this->usuarioModel->getUsuarios()['data'];
        return view('reservas/editar', ['reserva' => $reserva, 'funciones' => $funciones, 'usuarios' => $usuarios]);
    }

    public function eliminar($id)
    {
        $resultado = $this->reservaModel->eliminarReserva($id);
        
        if ($resultado) {
            return redirect()->to('/reservas')->with('success', 'Reserva eliminada exitosamente');
        }
        
        return redirect()->back()->with('error', 'Error al eliminar la reserva');
    }

    public function ver($id)
    {
        $reserva = $this->reservaModel->getReservaById($id);
        
        if (!$reserva) {
            return redirect()->to('/reservas')->with('error', 'Reserva no encontrada');
        }

        return view('reservas/ver', ['reserva' => $reserva]);
    }
} 