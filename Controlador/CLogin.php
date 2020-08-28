<?php
session_start();
session_destroy();
require_once(__DIR__ . './../Modelo/Negocio/NUsuario.php');
class CLogin
{

    private $usuario;

    public function __construct()
    {

        $this->usuario = new NUsuario();
    }
    public function actualizar()
    {

        require_once 'Vista/PLogin.php';
    }
    public function login()
    {

        $usuario = $_REQUEST['usuario'];
        $password = $_REQUEST['password'];
        $user = $this->usuario->login($usuario, $password);
        if ($user != null) {

            require_once 'Vista/PHome.php';
        } else {
            require_once 'Vista/PLogin.php';
        }
    }
}
