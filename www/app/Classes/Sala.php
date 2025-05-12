<?php
namespace App\Classes;

class Sala {
    private $id;
    private $cine_id;
    private $nombre;
    private $capacidad;
    private $tipo_sala;
    private $estado;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->cine_id = $data['cine_id'] ?? null;
        $this->nombre = $data['nombre'] ?? '';
        $this->capacidad = $data['capacidad'] ?? 0;
        $this->tipo_sala = $data['tipo_sala'] ?? 'normal';
        $this->estado = $data['estado'] ?? 'activo';
    }

    public function getId() { return $this->id; }
    public function getCineId() { return $this->cine_id; }
    public function getNombre() { return $this->nombre; }
    public function getCapacidad() { return $this->capacidad; }
    public function getTipoSala() { return $this->tipo_sala; }
    public function getEstado() { return $this->estado; }

    public function setCineId($cine_id) { $this->cine_id = $cine_id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCapacidad($capacidad) { $this->capacidad = $capacidad; }
    public function setTipoSala($tipo_sala) { $this->tipo_sala = $tipo_sala; }
    public function setEstado($estado) { $this->estado = $estado; }

    public function toArray() {
        return [
            'id' => $this->id,
            'cine_id' => $this->cine_id,
            'nombre' => $this->nombre,
            'capacidad' => $this->capacidad,
            'tipo_sala' => $this->tipo_sala,
            'estado' => $this->estado
        ];
    }

    public function estaActiva() {
        return $this->estado === 'activo';
    }

    public function esVIP() {
        return $this->tipo_sala === 'vip';
    }

    public function es3D() {
        return $this->tipo_sala === '3d';
    }
} 