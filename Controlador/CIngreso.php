<?php
session_start();
require_once(__DIR__ . './../Modelo/Negocio/NIngreso.php');
require_once(__DIR__ . './../Modelo/Negocio/NRecurso.php');
require_once(__DIR__ . './../Modelo/Negocio/NProveedor.php');
class CIngreso
{
    public $ingreso;
    public $recurso;
    public $proveedor;

    public function __construct()
    {
        $this->ingreso = new NIngreso();
    }

    public function actualizar()
    {

        require_once 'Vista/Pingreso.php';
    }

    public function agregar()
    {
        $fecha = $_REQUEST['fecha'];
        $idproveedor = $_REQUEST['idproveedor'];
        $total = $_REQUEST['total'];
        $detalle = $_SESSION["detalle"];
        $this->ingreso->agregar($fecha, $idproveedor, $total, $detalle);
        $_SESSION["detalle"] = [];
        require_once 'Vista/Pingreso.php';
    }

    public function agregarDetalle()
    {
        $idrecurso = $_REQUEST['idrecurso'];
        $cantidad = $_REQUEST['cantidad'];
        $costo = $_REQUEST['costo'];
        require_once 'Vista/Pingreso.php';
    }

    public function listarDetalle()
    {
        $id = $_REQUEST["id"];
        require_once 'Vista/Pingreso.php';
    }
}
