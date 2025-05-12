<?php
namespace App\Models;

class Funcion {
    private $id;
    private $pelicula_id;
    private $sala_id;
    private $fecha;
    private $hora_inicio;
    private $hora_fin;
    private $precio_base;
    private $estado;
    
    // Propiedades para las relaciones
    private $pelicula;
    private $sala;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->pelicula_id = $data['pelicula_id'] ?? null;
        $this->sala_id = $data['sala_id'] ?? null;
        $this->fecha = $data['fecha'] ?? '';
        $this->hora_inicio = $data['hora_inicio'] ?? '';
        $this->hora_fin = $data['hora_fin'] ?? '';
        $this->precio_base = $data['precio_base'] ?? 0.0;
        $this->estado = $data['estado'] ?? 'activo';
        
        // Inicializar las relaciones si se proporcionan en los datos
        if (isset($data['pelicula'])) {
            $this->pelicula = new Pelicula($data['pelicula']);
        }
        if (isset($data['sala'])) {
            $this->sala = new Sala($data['sala']);
        }
    }

    // Getters
    public function getId() { return $this->id; }
    public function getPeliculaId() { return $this->pelicula_id; }
    public function getSalaId() { return $this->sala_id; }
    public function getFecha() { return $this->fecha; }
    public function getHoraInicio() { return $this->hora_inicio; }
    public function getHoraFin() { return $this->hora_fin; }
    public function getPrecioBase() { return $this->precio_base; }
    public function getEstado() { return $this->estado; }
    
    // Getters para las relaciones
    public function getPelicula() { return $this->pelicula; }
    public function getSala() { return $this->sala; }

    // Setters
    public function setPeliculaId($pelicula_id) { $this->pelicula_id = $pelicula_id; }
    public function setSalaId($sala_id) { $this->sala_id = $sala_id; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setHoraInicio($hora_inicio) { $this->hora_inicio = $hora_inicio; }
    public function setHoraFin($hora_fin) { $this->hora_fin = $hora_fin; }
    public function setPrecioBase($precio_base) { $this->precio_base = $precio_base; }
    public function setEstado($estado) { $this->estado = $estado; }
    
    // Setters para las relaciones
    public function setPelicula($pelicula) { $this->pelicula = $pelicula; }
    public function setSala($sala) { $this->sala = $sala; }

    // Método para obtener la película relacionada
    public function getPelicula() {
        if ($this->pelicula_id) {
            $peliculaModel = new PeliculaModel();
            return $peliculaModel->getPeliculaById($this->pelicula_id);
        }
        return null;
    }

    // Método para obtener la sala relacionada
    public function getSala() {
        if ($this->sala_id) {
            $salaModel = new SalaModel();
            return $salaModel->getSalaById($this->sala_id);
        }
        return null;
    }

    // Método para convertir el objeto a array
    public function toArray() {
        return [
            'id' => $this->id,
            'pelicula_id' => $this->pelicula_id,
            'sala_id' => $this->sala_id,
            'fecha' => $this->fecha,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'precio_base' => $this->precio_base,
            'estado' => $this->estado
        ];
    }

    // Método para verificar si la función está activa
    public function estaActiva() {
        return $this->estado === 'activo';
    }

    // Método para obtener la fecha y hora de inicio formateada
    public function getFechaHoraInicioFormateada() {
        return date('d/m/Y H:i', strtotime($this->fecha . ' ' . $this->hora_inicio));
    }

    // Método para verificar si la función ya pasó
    public function yaPaso() {
        $fechaHora = strtotime($this->fecha . ' ' . $this->hora_inicio);
        return $fechaHora < time();
    }

    // Método para obtener el precio formateado
    public function getPrecioBaseFormateado() {
        return number_format($this->precio_base, 2, ',', '.') . '€';
    }
} 