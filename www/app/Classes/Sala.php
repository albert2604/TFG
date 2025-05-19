<?php
namespace App\Classes;

use App\Libraries\DirectusApi;

class Sala {
    private $id;
    private $cine_id;
    private $nombre;
    private $capacidad;
    private $tipo_sala;
    private $numero_filas;
    private $numero_columnas;
    private $filas_excluidas;
    private $columnas_excluidas;
    private $butacas_excluidas;
    private $status;
    protected $directusApi;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->cine_id = $data['cine_id'] ?? null;
        $this->nombre = $data['nombre'] ?? '';
        $this->capacidad = $data['capacidad'] ?? 0;
        $this->tipo_sala = $data['tipo_sala'] ?? 'normal';
        $this->numero_columnas = $data['numero_columnas'] ?? 0;
        $this->numero_filas = $data['numero_filas'] ?? 0;
        $this->filas_excluidas = $data['filas_excluidas'] ?? '';
        $this->columnas_excluidas = $data['columnas_excluidas'] ?? '';
        $this->butacas_excluidas = $data['butacas_excluidas'] ?? '';
        $this->status = $data['status'] ?? 'activo';
        $this->directusApi = new DirectusApi();
    }

    public function getId() { return $this->id; }
    public function getCineId() { return $this->cine_id; }
    public function getNombre() { return $this->nombre; }
    public function getCapacidad() { return $this->capacidad; }
    public function getTipoSala() { return $this->tipo_sala; }
    public function getNumeroColumnas() { return $this->numero_columnas; }
    public function getNumeroFilas() { return $this->numero_filas; }
    public function getFilasExcluidas() { return $this->filas_excluidas; }
    public function getColumnasExcluidas() { return $this->columnas_excluidas; }
    public function getButacasExcluidas() { return $this->butacas_excluidas; }
    public function getStatus() { return $this->status; }

    public function getCine() { return new Cine($this->directusApi->getItemById('cines', $this->cine_id)); }
    public function getFunciones() 
    {
        $funciones = $this->directusApi->searchManyItems('funciones', array( 
            'filter[sala_id][_eq]' => $this->id 
        ));

        $funciones = array_map(fn($funcionData) => new Funcion($funcionData), $funciones);
        
        return $funciones; 
    }

    public function setCineId($cine_id) { $this->cine_id = $cine_id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCapacidad($capacidad) { $this->capacidad = $capacidad; }
    public function setTipoSala($tipo_sala) { $this->tipo_sala = $tipo_sala; }
    public function setNumeroColumnas($numero_columnas) { $this->$numero_columnas; }
    public function setNumeroFilas($numero_filas) { $this->$numero_filas; }
    public function setFilasExcluidas($filas_excluidas) { $this->$filas_excluidas; }
    public function setColumnasExcluidas($columnas_excluidas) { $this->$columnas_excluidas; }
    public function setButacasExcluidas($butacas_excluidas) { $this->$butacas_excluidas; }

    public function setStatus($status) { $this->status = $status; }

    public function toArray() {
        return [
            'id' => $this->id,
            'cine_id' => $this->cine_id,
            'nombre' => $this->nombre,
            'capacidad' => $this->capacidad,
            'tipo_sala' => $this->tipo_sala,
            'numero_filas' => $this->numero_filas,
            'numero_columnas' => $this->numero_columnas,
            'filas_excluidas' => $this->filas_excluidas,
            'columnas_excluidas' => $this->columnas_excluidas,
            'butacas_excluidas' => $this->butacas_excluidas,
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