<?php
require_once(__DIR__ . './../Modelo/Negocio/NPedido.php');
require_once(__DIR__ . './../Modelo/Negocio/NServicio.php');
class CPedido
{
    public $pedido;
    public $servicio;

    public function __construct()
    {
        $this->pedido = new NPedido();
        $this->servicio = new NServicio();
    }

    public function actualizar()
    {
        require_once 'Vista/PPedido.php';
    }

    public function agregar()
    {
        $fecha = date("Y") . '-' . date("m") . '-' . date("d");
        $descripcion = $_REQUEST["descripcion"];
        $total = $_REQUEST["total"];
        $cantidad = $_REQUEST["cantidad"];
        $fechafin = $_REQUEST["fechafin"];
        $idservicio = $_REQUEST["idservicio"];
        $idusuario = $_REQUEST["idusuario"];

        $ext = explode(".", $_FILES["muestra"]["name"]);
        if ($_FILES['muestra']['type'] == "image/jpg" || $_FILES['muestra']['type'] == "image/jpeg" || $_FILES['muestra']['type'] == "image/png") {
            // vamos a renombrar la imagen para evitar que se repitan
            $muestra = round(microtime(true)) . '.' . end($ext);
            // ahora cargar el archivo en el proyecto
            move_uploaded_file($_FILES["muestra"]["tmp_name"], "Vista/assets/img/" . $muestra);
            $this->pedido->agregar($fecha, $descripcion, $muestra, $total, $cantidad, $idusuario, $idservicio, $fechafin);
        }

        require_once 'Vista/PPedido.php';
    }

    public function modificar()
    {
        $id = $_REQUEST['id'];
        $fecha = date("Y") . '-' . date("m") . '-' . date("d");
        $descripcion = $_REQUEST["descripcion"];
        $total = $_REQUEST["total"];
        $cantidad = $_REQUEST["cantidad"];
        $fechafin = $_REQUEST["fechafin"];
        $idservicio = $_REQUEST["idservicio"];
        $idusuario = $_REQUEST["idusuario"];

        if ($_REQUEST["muestraactual"] != "") {
            $muestra = $_REQUEST["muestraactual"];
        } else {
            // sacamos la extension del archivo
            $ext = explode(".", $_FILES["muestra"]["name"]);
            if ($_FILES['muestra']['type'] == "image/jpg" || $_FILES['muestra']['type'] == "image/jpeg" || $_FILES['muestra']['type'] == "image/png") {
                // vamos a renombrar la imagen para evitar que se repitan
                $muestra = round(microtime(true)) . '.' . end($ext);
                // ahora cargar el archivo en el proyecto
                move_uploaded_file($_FILES["muestra"]["tmp_name"], "Vista/assets/img/" . $muestra);
            }
        }
        if ($muestra != null)
            $this->pedido->modificar($id, $fecha, $descripcion, $muestra, $total, $cantidad, $idusuario, $idservicio, $fechafin);
        require_once 'Vista/PPedido.php';
    }

    public function habilitar()
    {
        $id = $_REQUEST['id'];
        $this->pedido->habilitar($id);
        require_once 'Vista/PPedido.php';
    }


    public function deshabilitar()
    {
        $id = $_REQUEST['id'];
        $this->pedido->deshabilitar($id);
        require_once 'Vista/PPedido.php';
    }

    public function terminar()
    {
        $id = $_REQUEST['id'];
        $this->pedido->terminar($id);
        require_once 'Vista/PPedido.php';
    }
}
