<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    // Este filtro verifica si el usuario está logueado y, opcionalmente, si es admin
    public function before(RequestInterface $request, $arguments = null)
    {
        // Si no está logueado, redirige a login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        // Si se requiere rol admin y el usuario no lo es, redirige a home
        if ($arguments && in_array('admin', $arguments) && session()->get('usuario_rol') !== 'admin') {
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No hace nada después de la petición
    }
} 