<?php
namespace App\Controllers;

class LoggedController extends BaseController
{
    protected $loggedUser;

    public function __construct()
    {
        $this->loggedUser = [
            'usuario_id' => session()->get('usuario_id'),
            'usuario_nombre' => session()->get('usuario_nombre'),
            'usuario_rol' => session()->get('usuario_rol'),
            'isLoggedIn' => session()->get('isLoggedIn')
        ];

        if($this->loggedUser['isLoggedIn'] !== true){
            die("403");
        }
    }

} 