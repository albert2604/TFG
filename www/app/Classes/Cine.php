<?php
namespace App\Classes;

class Cine {
    private $id;
    private $nombre;
    private $direccion;
    private $ciudad;
    private $telefono;
    private $email;
    private $estado;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'] ?? '';
        $this->direccion = $data['direccion'] ?? '';
        $this->ciudad = $data['ciudad'] ?? '';
        $this->telefono = $data['telefono'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->estado = $data['estado'] ?? 'activo';
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getDireccion() { return $this->direccion; }
    public function getCiudad() { return $this->ciudad; }
    public function getTelefono() { return $this->telefono; }
    public function getEmail() { return $this->email; }
    public function getEstado() { return $this->estado; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setEmail($email) { $this->email = $email; }
    public function setEstado($estado) { $this->estado = $estado; }

    public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'ciudad' => $this->ciudad,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'estado' => $this->estado
        ];
    }

    public function getDireccionCompleta() {
        return $this->direccion . ', ' . $this->ciudad;
    }

    public function estaActivo() {
        return $this->estado === 'activo';
    }
} 