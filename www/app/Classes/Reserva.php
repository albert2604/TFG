<?php
namespace App\Classes;

class Reserva {
    private $id;
    private $usuario_id;
    private $funcion_id;
    private $fecha_reserva;
    private $estado;
    private $total;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->usuario_id = $data['usuario_id'] ?? null;
        $this->funcion_id = $data['funcion_id'] ?? null;
        $this->fecha_reserva = $data['fecha_reserva'] ?? '';
        $this->estado = $data['estado'] ?? 'pendiente';
        $this->total = $data['total'] ?? 0.0;
    }

    public function getId() { return $this->id; }
    public function getUsuarioId() { return $this->usuario_id; }
    public function getFuncionId() { return $this->funcion_id; }
    public function getFechaReserva() { return $this->fecha_reserva; }
    public function getEstado() { return $this->estado; }
    public function getTotal() { return $this->total; }

    public function setUsuarioId($usuario_id) { $this->usuario_id = $usuario_id; }
    public function setFuncionId($funcion_id) { $this->funcion_id = $funcion_id; }
    public function setFechaReserva($fecha_reserva) { $this->fecha_reserva = $fecha_reserva; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setTotal($total) { $this->total = $total; }

    public function toArray() {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'funcion_id' => $this->funcion_id,
            'fecha_reserva' => $this->fecha_reserva,
            'estado' => $this->estado,
            'total' => $this->total
        ];
    }

    public function estaPendiente() {
        return $this->estado === 'pendiente';
    }

    public function estaCompletada() {
        return $this->estado === 'completada';
    }

    public function estaCancelada() {
        return $this->estado === 'cancelada';
    }

    public function getFechaReservaFormateada() {
        return date('d/m/Y H:i', strtotime($this->fecha_reserva));
    }

    public function getTotalFormateado() {
        return number_format($this->total, 2, ',', '.') . '€';
    }
} 