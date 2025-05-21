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
        return view('reservas/index', ['reservas' => $reservas]);
    }

    public function misReservas()
    {
        
        $reserva = $this->reservaModel->getReservas();
        $funcion = $this->funcionModel->getFunciones();
        $usuario = $this->usuarioModel->getUsuarios();

        if (!$reserva) {
            return redirect()->to('/reservas/admin/list')->with('error', 'Reserva no encontrado');
        }

        return view('reservas/mis_reservas', ['reservas' => new Reserva($reserva), 'funciones' => $funcion, 'usuarios' => $usuario]);
    }

    public function crear()
    {

        $funciones = $this->funcionModel->getFunciones();
        $usuarios = $this->usuarioModel->getUsuarios();

        return view('reservas/crear', ['funciones' => $funciones, 'usuarios' => $usuarios]);
    }

    public function doCrear()
    {
        //VALIDAMOS LA ENTRADA DE LA RESERVA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'funcion_id' => 'required',
            'usuario_id' => 'required',
            'fecha_hora' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $funciones = $this->funcionModel->getFunciones();
            $usuarios = $this->usuarioModel->getUsuarios();
            return view('reservas/crear', [
                'validation' => $validation,
                'funciones' => $funciones,
                'usuarios' => $usuarios
            ]);
        }
        

        //SI TODO ES CORRECTO CREAMOS LA RESRVA
        $data = [
            'funcion_id' => $this->request->getPost('funcion_id'),
            'usuario_id' => $this->request->getPost('usuario_id'),
            'fecha_hora' => $this->request->getPost('fecha_hora'),
            'total' => $this->request->getPost('total'),
            'status' => $this->request->getPost('status') ?? 'pendiente'
        ];

        $reserva = $this->reservaModel->crearReserva($data);
        if ($reserva['id']) {
            return redirect()->to('/reservas/admin/list/');
        }
    }

    public function editar($id)
    {
        $reserva = $this->reservaModel->getReservaById($id);
        $funcion = $this->funcionModel->getFunciones();
        $usuario = $this->usuarioModel->getUsuarios();

        if (!$reserva) {
            return redirect()->to('/reservas/admin/list')->with('error', 'Reserva no encontrado');
        }

        return view('reservas/editar', ['reservas' => new Reserva($reserva), 'funciones' => $funcion, 'usuarios' => $usuario]);
    }

    public function doEditar($id)
    {
        $reserva = $this->reservaModel->getReservaById($id);

        if (!$reserva) {
            return redirect()->to('/reservas')->with('error', 'Reserva no encontrada');
        }


        //VALIDAMOS LA ENTRADA DE LA RESERVA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'funcion_id' => 'required',
            'usuario_id' => 'required',
            'fecha_hora' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);

        //SI TODO ES CORRECTO CREAMOS LA RESERVA
        $data = [
            'funcion_id' => $this->request->getPost('funcion_id'),
            'usuario_id' => $this->request->getPost('usuario_id'),
            'fecha_hora' => $this->request->getPost('fecha_hora'),
            'total' => $this->request->getPost('total'),
            'status' => $this->request->getPost('status') ?? 'pendiente'
        ];

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $funciones = $this->funcionModel->getFunciones();
            $usuarios = $this->usuarioModel->getUsuarios();
            return view('reservas/crear', [
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

        $reserva = $this->reservaModel->eliminarReserva($id, ['status' => 'cancelada']);

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
