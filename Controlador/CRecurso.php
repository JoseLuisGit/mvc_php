<?php
require_once(__DIR__ . './../Modelo/Negocio/NRecurso.php');
class CRecurso
{
    public $recurso;

    public function __construct()
    {
        $this->recurso = new NRecurso();
    }

    public function actualizar()
    {
        require_once 'Vista/Precurso.php';
    }

    public function agregar()
    {
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $medida = $_REQUEST['medida'];
        $cantidad = $_REQUEST['cantidad'];
        $this->recurso->agregar($nombre, $descripcion, $medida, $cantidad);
        require_once 'Vista/Precurso.php';
    }

    public function modificar()
    {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $medida = $_REQUEST['medida'];
        $cantidad = $_REQUEST['cantidad'];
        $this->recurso->modificar($id, $nombre, $descripcion, $medida, $cantidad);
        require_once 'Vista/Precurso.php';
    }
}
