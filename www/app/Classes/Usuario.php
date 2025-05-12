<?php
namespace App\Classes;

class Usuario {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $telefono;
    private $rol;
    private $estado;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'] ?? '';
        $this->apellidos = $data['apellidos'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->telefono = $data['telefono'] ?? '';
        $this->rol = $data['rol'] ?? 'cliente';
        $this->estado = $data['estado'] ?? 'activo';
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getTelefono() { return $this->telefono; }
    public function getRol() { return $this->rol; }
    public function getEstado() { return $this->estado; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellidos($apellidos) { $this->apellidos = $apellidos; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setRol($rol) { $this->rol = $rol; }
    public function setEstado($estado) { $this->estado = $estado; }

    public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'password' => $this->password,
            'telefono' => $this->telefono,
            'rol' => $this->rol,
            'estado' => $this->estado
        ];
    }

    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellidos;
    }

    public function esAdmin() {
        return $this->rol === 'admin';
    }

    public function estaActivo() {
        return $this->estado === 'activo';
    }
} 