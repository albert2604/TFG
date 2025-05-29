<?php

namespace App\Controllers;

use App\Classes\Reserva;
use App\Models\CineModel;
use App\Models\SalaModel;
use App\Models\FuncionModel;
use App\Models\UsuarioModel;
use App\Models\ReservaModel;


class WizardController extends LoggedController
{
    protected $cineModel;
    protected $salaModel;
    protected $funcionModel;
    protected $usuarioModel;
    protected $reservaModel;

    public function __construct()
    {
        parent::__construct();
        $this->cineModel = new CineModel();
        $this->salaModel = new SalaModel();
        $this->funcionModel = new FuncionModel();
        $this->usuarioModel = new UsuarioModel();
        $this->reservaModel = new ReservaModel();
    }
    public function index()
    {
        $cines = $this->cineModel->getCines();
        $reserva = $this->reservaModel->getReservas();
        return view('wizard/index', ['cines' => $cines, 'reserva'=> $reserva, 'usuario_id' => $this->loggedUser['usuario_id']]);
    }

    public function filtrarFunciones($cineId, $peliculaId = null)
    {
        $funciones = $this->funcionModel->filtrarFunciones($cineId, $peliculaId);

        return $this->response->setJSON($funciones);
    }

    public function obtenerEstructura($salaId, $funcionId)
    {
        $sala = $this->salaModel->getSalaById($salaId);

        if (!$sala) {
            die("No existe la sala");
        }

        $butacasTotales = [];

        if ($funcionId) {
            $reservas = $this->reservaModel->getReservasByFuncion($funcionId);
            foreach ($reservas as $reserva) {
                // Decodificamos el string JSON de butacas (ej: "[[2,2]]")
                $butacas = json_decode($reserva['butacas'], true);

                if (is_array($butacas)) {
                    // Fusionamos las butacas con el array total
                    $butacasTotales = array_merge($butacasTotales, $butacas);
                }
            }
        }
        $sala['butacas_reservadas'] = json_encode($butacasTotales);
        return $this->response->setJSON($sala);
    }

    public function doCrear()
    {
        //VALIDAMOS LA ENTRADA DE LA RESERVA
        $validation = \Config\Services::validation();
        $validation->setRules([
            'funcion_id' => 'required',
            'usuario_id' => 'required',
            'total' => 'required',
            'butacas' => 'required',
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            $funciones = $this->funcionModel->getFunciones();
            $usuarios = $this->usuarioModel->getUsuarios();
            $cines = $this->cineModel->getCines();
            return view('wizard/index', [
                'validation' => $validation,
                'funciones' => $funciones,
                'usuarios' => $usuarios,
                'cines' => $cines
            ]);
        }


        //SI TODO ES CORRECTO CREAMOS LA RESERVA
        $data = [
            'funcion_id' => $this->request->getPost('funcion_id'),
            'usuario_id' => $this->request->getPost('usuario_id'),
            'butacas' => $this->request->getPost('butacas'),
            'total' => $this->request->getPost('total'),
            'status' => $this->request->getPost('status') ?? 'pendiente'
        ];

        $reserva = $this->reservaModel->crearReserva($data);
        if ($reserva['id']) {
            return $this->response->setJSON(array(
                'url' => site_url('payment/'.$reserva['id'].'/create')
            ));
        }
    }
}
