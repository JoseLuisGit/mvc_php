<?php
require_once(__DIR__ . './../Modelo/Negocio/NServicio.php');
class CServicio
{
    public $servicio;

    public function __construct()
    {
        $this->servicio = new NServicio();
    }

    public function actualizar()
    {
        require_once 'Vista/PServicio.php';
    }

    public function agregar()
    {
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $this->servicio->agregar($nombre, $descripcion);
        $this->actualizar();
    }

    public function modificar()
    {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $this->servicio->modificar($id, $nombre, $descripcion);
        $this->actualizar();
    }
}
