<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Classes\Usuario;
use CodeIgniter\HTTP\RedirectResponse;

class UsuariosAdminController extends AdminController
{
    protected $usuarioModel;

    public function __construct()
    {
        parent::__construct();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $usuarios = $this->usuarioModel->getUsuarios();
        return view('usuarios/index', ['usuarios' => $usuarios]);
    }

    public function crear()
    {
        return view('usuarios/crear');
    }

    public function doCrear()
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
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'telefono' => $this->request->getPost('telefono'),
            'rol' => $this->request->getPost('rol'),
            'status' => $this->request->getPost('status')
        ];

        $user = $this->usuarioModel->crearUsuario($data);
        if ($user['id']) {
            return redirect()->to('usuarios/admin/list');
        }
    }

    public function editar($id)
    {
        $usuario = $this->usuarioModel->getUsuarioById($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        return view('usuarios/editar', ['usuario' => new Usuario($usuario)]);
    }

    public function doEditar($id)
    {
        $usuario = $this->usuarioModel->getUsuarioById($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        //VALIDAMOS LA ENTRADA DEL USUARIO
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|valid_email',
            'telefono' => 'required',
        ]);

        //SI FALLA MOSTRAMOS ERROR
        if (!$validation->withRequest($this->request)->run()) {
            return view('usuarios/editar', [
                'validation' => $validation
            ]);
        }

        //SI TODO ES CORRECTO CREAMOS USUARIO
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'rol' => $this->request->getPost('rol'),
            'status' => $this->request->getPost('status')
        ];

        // Si nos mandan password, lo cambiamos
        if($this->request->getPost('password') != ''){
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $user = $this->usuarioModel->editarUsuario($id, $data);
        if ($user['id']) {
            return redirect()->to('usuarios/admin/list');
        }
    }

    public function doEliminar($id)
    {
        $usuario = $this->usuarioModel->getUsuarioById($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        $user = $this->usuarioModel->eliminarUsuario($id, ['status' => 'eliminado']);

        if ($user['id']) {
            return redirect()->to('usuarios/admin/list');
        }
    }

    public function ver($id)
    {
        $usuario = $this->usuarioModel->getUsuarioById($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        return view('usuarios/ver', ['usuario' => new Usuario($usuario)]);
    }
}
