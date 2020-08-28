<?php
require_once(__DIR__ . './../Modelo/Negocio/NRol.php');
class CRol
{
    public $rol;

    public function __construct()
    {
        $this->rol = new NRol();
    }

    public function actualizar()
    {
        require_once 'Vista/PRol.php';
    }

    public function agregar()
    {
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $this->rol->agregar($nombre, $descripcion);
        require_once 'Vista/PRol.php';
    }

    public function modificar()
    {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $this->rol->modificar($id, $nombre, $descripcion);
        require_once 'Vista/PRol.php';
    }
}
