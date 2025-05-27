<?php
namespace App\Classes;

use App\Libraries\DirectusApi;

class Reserva {
    private $id;
    private $usuario_id;
    private $funcion_id;
    private $status;
    private $butacas;
    private $total;
    protected $directusApi;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->usuario_id = $data['usuario_id'] ?? null;
        $this->funcion_id = $data['funcion_id'] ?? null;
        $this->butacas = $data['butacas'] ?? '';
        $this->status = $data['status'] ?? 'pendiente';
        $this->total = $data['total'] ?? 0.0;
        $this->directusApi = new DirectusApi();
    }

    public function getId() { return $this->id; }
    public function getUsuarioId() { return $this->usuario_id; }
    public function getFuncionId() { return $this->funcion_id; }
    public function getButacas() { return $this->butacas; }
    public function getStatus() { return $this->status; }
    public function getTotal() { return $this->total; }

    public function getUsuario() { return new Usuario($this->directusApi->getItemById('usuarios', $this->usuario_id));}
    public function getFuncion() { return new Funcion($this->directusApi->getItemById('funciones', $this->funcion_id));}

    public function setUsuarioId($usuario_id) { $this->usuario_id = $usuario_id; }
    public function setFuncionId($funcion_id) { $this->funcion_id = $funcion_id; }
    public function setButacas($butacas) { $this->butacas = $butacas; }
    public function setStatus($status) { $this->status = $status; }
    public function setTotal($total) { $this->total = $total; }

    public function toArray() {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'funcion_id' => $this->funcion_id,
            'butacas' => $this->butacas,
            'status' => $this->status,
            'total' => $this->total
        ];
    }

    public function estaPendiente() {
        return $this->status === 'pendiente';
    }

    public function estaCompletada() {
        return $this->status === 'completada';
    }

    public function estaCancelada() {
        return $this->status === 'cancelada';
    }
    
    public function getTotalFormateado() {
        return number_format($this->total, 2, ',', '.') . '€';
    }
} 