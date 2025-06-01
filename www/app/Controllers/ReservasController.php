<?php

namespace App\Controllers;

use App\Models\ReservaModel;
use App\Models\FuncionModel;
use App\Models\UsuarioModel;
use App\Classes\Reserva;

class ReservasController extends AdminController
{
    protected $reservaModel;
    protected $funcionModel;
    protected $usuarioModel;

    public function __construct()
    {
        parent::__construct();
        $this->reservaModel = new ReservaModel();
        $this->funcionModel = new FuncionModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $reservas = $this->reservaModel->getReservas();
        $funciones = $this->funcionModel->getFunciones();
        return view('reservas/index', ['reservas' => $reservas, 'funciones' => $funciones]);
    }

    public function editar($id)
    {
        $reserva = $this->reservaModel->getReservaById($id);
        $funcion = $this->funcionModel->getFunciones();
        $usuario = $this->usuarioModel->getUsuarios();

        if (!$reserva) {
            return redirect()->to('/reservas/admin/list')->with('error', 'Reserva no encontrado');
        }

        return view('reservas/editar', ['reserva' => new Reserva($reserva), 'funciones' => $funcion, 'usuarios' => $usuario]);
    }

    public function doEditar($id)
    {
        $reserva = $this->reservaModel->getReservaById($id);

        if (!$reserva) {
            return redirect()->to('/reservas/admin/list')->with('error', 'Reserva no encontrada');
        }


        //VALIDAMOS LA ENTRADA DE LA RESERVA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'funcion_id' => 'required',
            'usuario_id' => 'required',
            'total' => 'required',
        ]);

        //SI TODO ES CORRECTO CREAMOS LA RESERVA
        $data = [
            'funcion_id' => $this->request->getPost('funcion_id'),
            'usuario_id' => $this->request->getPost('usuario_id'),
            'total' => $this->request->getPost('total'),
            'butacas' => $this->request->getPost('butacas'),
            'status' => $this->request->getPost('status') ?? 'pendiente'
        ];

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $funciones = $this->funcionModel->getFunciones();
            $usuarios = $this->usuarioModel->getUsuarios();
            return view('reservas/admin/editar', [
                'reserva' => new Reserva($data),
                'validation' => $validation,
                'funciones' => $funciones,
                'usuarios' => $usuarios
            ]);
        }

        $reserva = $this->reservaModel->editarReserva($id, $data);
        if ($reserva['id']) {
            return redirect()->to('reservas/admin/list/');
        }
    }

    public function doEliminar($id)
    {
        $reservaId = $this->reservaModel->getReservaById($id);

        if (!$reservaId) {
            return redirect()->to('/reservas/admin/list')->with('error', 'Reserva no encontrado');
        }

        $reserva = $this->reservaModel->eliminarReserva($id, ['status' => 'cancelada', 'butacas' => []]);

        if ($reserva['id']) {
            return redirect()->to('reservas/admin/list');
        }
    }

    public function ver($id)
    {
        $reserva = $this->reservaModel->getReservaById($id);

        if (!$reserva) {
            return redirect()->to('/reservas/admin/list')->with('error', 'Reserva no encontrado');
        }

        return view('reservas/ver', ['reserva' => new Reserva($reserva)]);
    }
}
