<?php

namespace App\Models;

use App\Libraries\DirectusApi;
use CodeIgniter\Model;
use App\Classes\Usuario;

class UsuarioModel extends Model
{
    protected $directusApi;

    public function __construct()
    {
        $this->directusApi = new DirectusApi();
    }

    public function getUsuarios()
    {
        $usuarios = $this->directusApi->getAllItems('usuarios');

        if ($usuarios === null) {
            return null;
        }
        $usuarios = array_map(fn($usuarioData) => new Usuario($usuarioData), $usuarios);

        return $usuarios;
    }

    public function autenticateUser($email, $password)
    {
        $result = $this->directusApi->searchOneItem("usuarios", array(
            'filter[email][_eq]' => $email,
            'filter[status][_eq]' => 'activo'

        ));

        if ($result != false && password_verify($password, $result['contrasena'])) {
            return $result;
        } else {
            return false;
        }
        
        return false;
    }

    public function getUsuarioById($id)
    {
        $result = $this->directusApi->getItemById("usuarios", $id);
        return $result;
    }

    public function crearUsuario($usuario)
    {
        $result = $this->directusApi->createItem("usuarios", $usuario);
        return $result;
    }

    public function editarUsuario($id, $usuario)
    {
        $result = $this->directusApi->updateItemById("usuarios", $id, $usuario);
        return $result;
    }

    public function eliminarUsuario($id, $usuario)
    {
        $result = $this->directusApi->deleteItemById("usuarios", $id, $usuario);
        return $result;
    }
}
