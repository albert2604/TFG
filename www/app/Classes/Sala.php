<?php
namespace App\Classes;

use App\Libraries\DirectusApi;

class Sala {
    private $id;
    private $cine_id;
    private $nombre;
    private $capacidad;
    private $tipo_sala;
    private $status;
    protected $directusApi;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->cine_id = $data['cine_id'] ?? null;
        $this->nombre = $data['nombre'] ?? '';
        $this->capacidad = $data['capacidad'] ?? 0;
        $this->tipo_sala = $data['tipo_sala'] ?? 'normal';
        $this->status = $data['status'] ?? 'activo';
        $this->directusApi = new DirectusApi();
    }

    public function getId() { return $this->id; }
    public function getCineId() { return $this->cine_id; }
    public function getNombre() { return $this->nombre; }
    public function getCapacidad() { return $this->capacidad; }
    public function getTipoSala() { return $this->tipo_sala; }
    public function getStatus() { return $this->status; }

    public function getCine() { return new Cine($this->directusApi->getItemById('cines', $this->cine_id)); }

    public function setCineId($cine_id) { $this->cine_id = $cine_id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCapacidad($capacidad) { $this->capacidad = $capacidad; }
    public function setTipoSala($tipo_sala) { $this->tipo_sala = $tipo_sala; }
    public function setStatus($status) { $this->status = $status; }

    public function toArray() {
        return [
            'id' => $this->id,
            'cine_id' => $this->cine_id,
            'nombre' => $this->nombre,
            'capacidad' => $this->capacidad,
            'tipo_sala' => $this->tipo_sala,
            'status' => $this->status
        ];
    }

    public function estaActivo() {
        return $this->status === 'activo';
    }

    public function es3D() {
        return $this->tipo_sala === '3d';
    }
} 