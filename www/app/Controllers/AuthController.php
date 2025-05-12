<?php
namespace App\Controllers;

use App\Classes\Usuario;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    private $usuariosModel;

    public function __construct(){
        $this->usuariosModel = new UsuarioModel();
    }
    // Muestra el formulario de login
    public function login()
    {
        return view('auth/login');
    }

    // Procesa el login
    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuario = $this->usuariosModel->autenticateUser($email, $password);
        
        // Si existe y la contraseña es correcta
        if ($usuario !== false) {
            // Guarda datos en la sesión
            session()->set([
                'usuario_id' => $usuario['id'],
                'usuario_nombre' => $usuario['nombre'],
                'usuario_rol' => $usuario['rol'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/');

        } else {
            return view('auth/login', ['error' => 'Email o contraseña incorrectos']);
        }

    }

    // Cierra la sesión
    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }

    // Muestra el formulario de registro
    public function register()
    {
        return view('auth/register');
    }

    // Procesa el registro
    public function doRegister()
    {
        //VALIDAMOS LA ENTRADA DEL USUARIO
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required',
            'telefono' => 'required',
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            return view('auth/register', [
                'validation' => $validation
            ]);
        }

        //SI TODO ES CORRECTO CREAMOS USUARIO
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'email' => $this->request->getPost('email'),
            'contrasena' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'telefono' => $this->request->getPost('telefono'),
            'rol' => 'cliente',
            'estado' => 'activo',
        ];

        $user = $this->usuariosModel->crearUsuario($data);  
        if ($user['id']){
            return redirect()->to('usuarios/ver/'.$user['id']);
        }
    }
} 