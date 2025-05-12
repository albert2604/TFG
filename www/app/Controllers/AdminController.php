<?php
namespace App\Controllers;

class AdminController extends LoggedController
{
    public function __construct()
    {
        parent::__construct();
        
        if($this->loggedUser['usuario_rol'] != 'admin'){
            die("403");
        }
    }

} 