<?php
namespace App\Classes;

use App\Libraries\DirectusApi;

class Funcion {
    private $id;
    private $pelicula_id;
    private $sala_id;
    private $fecha;
    private $hora_inicio;
    private $hora_fin;
    private $precio;
    private $status;
    protected $directusApi;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->pelicula_id = $data['pelicula_id'] ?? null;
        $this->sala_id = $data['sala_id'] ?? null;
        $this->fecha = $data['fecha'] ?? null;
        $this->hora_inicio = $data['hora_inicio'] ?? 0;
        $this->hora_fin = $data['hora_fin'] ?? 0;
        $this->precio = $data['precio'] ?? 0;
        $this->status = $data['status'] ?? 'activo';
        $this->directusApi = new DirectusApi();
    }

    public function getId() { return $this->id; }
    public function getPeliculaId() { return $this->pelicula_id; }
    public function getSalaId() { return $this->sala_id; }
    public function getFecha() { return $this->fecha; }
    public function getHoraInicio() { return $this->hora_inicio; }
    public function getHoraFin() { return $this->hora_fin; }
    public function getPrecio() { return $this->precio; }
    public function getStatus() { return $this->status; }

    public function getPelicula() { return new Pelicula($this->directusApi->getItemById('peliculas', $this->pelicula_id)); }
    public function getSala() { return new Sala($this->directusApi->getItemById('salas', $this->sala_id)); }

    public function setPeliculaId($pelicula_id) { $this->pelicula_id = $pelicula_id; }
    public function setSalaId($sala_id) { $this->sala_id = $sala_id; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setHoraInicio($hora_inicio) { $this->hora_inicio = $hora_inicio; }
    public function setHoraFin($hora_fin) { $this->hora_fin = $hora_fin; }
    public function setPrecio($precio) { $this->precio = $precio; }
    public function setStatus($status) { $this->status = $status; }

    public function toArray() {
        return [
            'id' => $this->id,
            'pelicula_id' => $this->pelicula_id,
            'sala_id' => $this->sala_id,
            'fecha' => $this->fecha,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'precio' => $this->precio,
            'status' => $this->status
        ];
    }

    public function estaActivo() {
        return $this->status === 'activo';
    }
    
    public function getFechaFormateada() {
        return date('d/m/Y', strtotime($this->fecha . ' ' . $this->hora_inicio));
    }

    public function yaPaso() {
        $fechaHora = strtotime($this->fecha . ' ' . $this->hora_inicio);
        return $fechaHora < time();
    }

    
    public function getPrecioBaseFormateado() {
        return number_format($this->precio, 2, ',', '.') . '€';
    }
}