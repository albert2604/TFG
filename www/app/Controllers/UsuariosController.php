<?php
namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Classes\Usuario;
use CodeIgniter\HTTP\RedirectResponse;

class UsuariosController extends LoggedController
{
    protected $usuarioModel;

    public function __construct()
    {
        parent::__construct();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index(){
        return view('home/index');
    }

    public function ver($id)
    {   
        if($id !== $this->loggedUser['usuario_id']){
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        $usuario = $this->usuarioModel->getUsuarioById($id);
        
        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        return view('usuarios/ver', ['usuario' => new Usuario($usuario)]);
    }
} 