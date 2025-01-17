<?php
require_once(__DIR__ . './../Modelo/Negocio/NUsuario.php');
require_once(__DIR__ . './../Modelo/Negocio/NRol.php');
class CUsuario
{
    public $usuario;


    public function __construct()
    {
        $this->usuario = new NUsuario();
    }

    public function index()
    {

        require_once 'Vista/PUsuario.php';
    }

    public function agregar()
    {
        $nombre = $_REQUEST["nombre"];
        $apellido = $_REQUEST["apellido"];
        $genero = $_REQUEST["genero"];
        $telefono = $_REQUEST["telefono"];
        $direccion = $_REQUEST["direccion"];
        $email = $_REQUEST["email"];
        $usuario = $_REQUEST["usuario"];
        $password = $_REQUEST["password"];
        $idrol = $_REQUEST["idrol"];
        $this->usuario->agregar($nombre, $apellido, $genero, $telefono, $direccion, $email, $usuario, $password, $idrol);
        require_once 'Vista/PUsuario.php';
    }

    public function modificar()
    {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST["nombre"];
        $apellido = $_REQUEST["apellido"];
        $genero = $_REQUEST["genero"];
        $telefono = $_REQUEST["telefono"];
        $direccion = $_REQUEST["direccion"];
        $email = $_REQUEST["email"];
        $usuario = $_REQUEST["usuario"];
        $password = $_REQUEST["password"];
        $idrol = $_REQUEST["idrol"];
        $this->usuario->modificar($id, $nombre, $apellido, $genero, $telefono, $direccion, $email, $usuario, $password, $idrol);
        require_once 'Vista/PUsuario.php';
    }

    public function habilitar()
    {
        $id = $_REQUEST['id'];
        $this->usuario->habilitar($id);
        require_once 'Vista/PUsuario.php';
    }


    public function deshabilitar()
    {
        $id = $_REQUEST['id'];
        $this->usuario->deshabilitar($id);
        require_once 'Vista/PUsuario.php';
    }
}
