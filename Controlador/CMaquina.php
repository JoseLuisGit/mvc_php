<?php
require_once(__DIR__ . './../Modelo/Negocio/NMaquina.php');
class CMaquina
{
    public $maquina;

    public function __construct()
    {
        $this->maquina = new NMaquina();
    }

    public function actualizar()
    {
        require_once 'Vista/PMaquina.php';
    }

    public function agregar()
    {
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $modelo = $_REQUEST['modelo'];
        $capacidad = $_REQUEST['capacidad'];
        $this->maquina->agregar($nombre, $descripcion, $modelo, $capacidad);
        $this->actualizar();
    }

    public function modificar()
    {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $modelo = $_REQUEST['modelo'];
        $capacidad = $_REQUEST['capacidad'];
        $this->maquina->modificar($id, $nombre, $descripcion, $modelo, $capacidad);
        $this->actualizar();
    }

    public function habilitar()
    {
        $id = $_REQUEST['id'];
        $this->maquina->habilitar($id);
        $this->actualizar();
    }


    public function deshabilitar()
    {
        $id = $_REQUEST['id'];
        $this->maquina->deshabilitar($id);
        $this->actualizar();
    }
}
