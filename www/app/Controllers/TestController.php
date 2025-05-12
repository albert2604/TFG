<?php

namespace App\Controllers;
use App\Libraries\DirectusApi;
class TestController extends BaseController
{
    private $directusApi;

    public function __construct()
    {
        $this->directusApi = new DirectusApi();
    }

    public function index()
    {
        
        print_r($this->directusApi->createItem("cines",["nombre"=>"cinsesa"]));

        return "test";

    }
}
