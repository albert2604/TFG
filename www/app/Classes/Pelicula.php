<?php
namespace App\Classes;

use App\Libraries\DirectusApi;

class Pelicula {
    private $id;
    private $titulo;
    private $descripcion;
    private $duracion;
    private $genero;
    private $clasificacion;
    private $poster_url;
    private $trailer_url;
    private $status;
    protected $directusApi;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->titulo = $data['titulo'] ?? '';
        $this->descripcion = $data['descripcion'] ?? '';
        $this->duracion = $data['duracion'] ?? 0;
        $this->genero = $data['genero'] ?? '';
        $this->clasificacion = $data['clasificacion'] ?? 'TP';
        $this->poster_url = $data['poster_url'] ?? '';
        $this->trailer_url = $data['trailer_url'] ?? '';
        $this->status = $data['status'] ?? 'activo';
        $this->directusApi = new DirectusApi();

    }

    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getDescripcion() { return $this->descripcion; }
    public function getDuracion() { return $this->duracion; }
    public function getGenero() { return $this->genero; }
    public function getClasificacion() { return $this->clasificacion; }
    public function getPosterUrl() {
        return env('DIRECTUS_HOST_URL')."assets/".$this->poster_url; 
    }
    public function getTrailerUrl() { return $this->trailer_url; }
    public function getStatus() { return $this->status; }

    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setDuracion($duracion) { $this->duracion = $duracion; }
    public function setGenero($genero) { $this->genero = $genero; }
    public function setClasificacion($clasificacion) { $this->clasificacion = $clasificacion; }
    public function setPosterUrl($poster_url) { $this->poster_url = $poster_url; }
    public function setTrailerUrl($trailer_url) { $this->trailer_url = $trailer_url; }
    public function setStatus($status) { $this->status = $status; }

    public function toArray() {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'duracion' => $this->duracion,
            'genero' => $this->genero,
            'clasificacion' => $this->clasificacion,
            'poster_url' => $this->poster_url,
            'trailer_url' => $this->trailer_url,
            'status' => $this->status
        ];
    }

    public function estaActivo() {
        return $this->status === 'activo';
    }

    public function getDuracionFormateada() {
        $horas = floor($this->duracion / 60);
        $minutos = $this->duracion % 60;
        return sprintf("%dh %02dm", $horas, $minutos);
    }

    public function esAptaTodoPublico() {
        return $this->clasificacion === 'TP';
    }
} 