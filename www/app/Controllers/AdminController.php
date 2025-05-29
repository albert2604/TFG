<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class AdminController extends LoggedController
{
    public function __construct()
    {
        parent::__construct();

        if ($this->loggedUser['usuario_rol'] != 'admin') {
            throw PageNotFoundException::forPageNotFound('Acceso denegado');
        }
    }
}
