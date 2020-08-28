<?php
require_once(__DIR__ . './../Modelo/Negocio/NProveedor.php');
class CProveedor
{
    public $proveedor;

    public function __construct()
    {
        $this->proveedor = new NProveedor();
    }

    public function actualizar()
    {
        require_once 'Vista/Pproveedor.php';
    }

    public function agregar()
    {
        $nombre = $_REQUEST["nombre"];
        $apellido = $_REQUEST["apellido"];
        $genero = $_REQUEST["genero"];
        $telefono = $_REQUEST["telefono"];
        $direccion = $_REQUEST["direccion"];
        $email = $_REQUEST["email"];
        $empresa = $_REQUEST["empresa"];
        $telefonoempresa = $_REQUEST["telefonoempresa"];
        $this->proveedor->agregar($nombre, $apellido, $genero, $telefono, $direccion, $email, $empresa, $telefonoempresa);
        require_once 'Vista/Pproveedor.php';
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
        $empresa = $_REQUEST["empresa"];
        $telefonoempresa = $_REQUEST["telefonoempresa"];
        $this->proveedor->modificar($id, $nombre, $apellido, $genero, $telefono, $direccion, $email, $empresa, $telefonoempresa);
        require_once 'Vista/Pproveedor.php';
    }
}
