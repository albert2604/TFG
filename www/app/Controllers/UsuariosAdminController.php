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
        if ($this->request->getMethod() === 'post') {
            $usuario = new Usuario([
                'nombre' => $this->request->getPost('nombre'),
                'apellidos' => $this->request->getPost('apellidos'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'telefono' => $this->request->getPost('telefono'),
                'rol' => $this->request->getPost('rol'),
                'estado' => $this->request->getPost('estado') ?? 'activo'
            ]);

            $resultado = $this->usuarioModel->crearUsuario($usuario);
            
            if ($resultado) {
                return redirect()->to('/usuarios')->with('success', 'Usuario creado exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al crear el usuario');
        }

        return view('usuarios/crear');
    }

    public function editar($id)
    {
        $usuario = $this->usuarioModel->getUsuarioById($id);
        
        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }

        if ($this->request->getMethod() === 'post') {
            $usuario->setNombre($this->request->getPost('nombre'));
            $usuario->setApellidos($this->request->getPost('apellidos'));
            $usuario->setEmail($this->request->getPost('email'));
            $usuario->setTelefono($this->request->getPost('telefono'));
            $usuario->setRol($this->request->getPost('rol'));
            $usuario->setEstado($this->request->getPost('estado'));

            // Si se proporciona una nueva contraseña, actualizarla
            if ($password = $this->request->getPost('password')) {
                $usuario->setPassword(password_hash($password, PASSWORD_DEFAULT));
            }

            $resultado = $this->usuarioModel->actualizarUsuario($usuario);
            
            if ($resultado) {
                return redirect()->to('/usuarios')->with('success', 'Usuario actualizado exitosamente');
            }
            
            return redirect()->back()->with('error', 'Error al actualizar el usuario');
        }

        return view('usuarios/editar', ['usuario' => $usuario]);
    }

    public function eliminar($id)
    {
        $resultado = $this->usuarioModel->eliminarUsuario($id);
        
        if ($resultado) {
            return redirect()->to('/usuarios')->with('success', 'Usuario eliminado exitosamente');
        }
        
        return redirect()->back()->with('error', 'Error al eliminar el usuario');
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