<?php
namespace App\Classes;

class Butaca {
    private $id;
    private $sala_id;
    private $fila;
    private $numero;
    private $estado;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->sala_id = $data['sala_id'] ?? null;
        $this->fila = $data['fila'] ?? '';
        $this->numero = $data['numero'] ?? 0;
        $this->estado = $data['estado'] ?? 'disponible';
    }

    public function getId() { return $this->id; }
    public function getSalaId() { return $this->sala_id; }
    public function getFila() { return $this->fila; }
    public function getNumero() { return $this->numero; }
    public function getEstado() { return $this->estado; }

    public function setSalaId($sala_id) { $this->sala_id = $sala_id; }
    public function setFila($fila) { $this->fila = $fila; }
    public function setNumero($numero) { $this->numero = $numero; }
    public function setEstado($estado) { $this->estado = $estado; }

    public function toArray() {
        return [
            'id' => $this->id,
            'sala_id' => $this->sala_id,
            'fila' => $this->fila,
            'numero' => $this->numero,
            'estado' => $this->estado
        ];
    }

    public function getIdentificador() {
        return $this->fila . $this->numero;
    }

    public function estaDisponible() {
        return $this->estado === 'disponible';
    }

    public function estaReservada() {
        return $this->estado === 'reservada';
    }

    public function estaOcupada() {
        return $this->estado === 'ocupada';
    }
}