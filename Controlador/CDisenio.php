<?php
require_once(__DIR__ . './../Modelo/Negocio/NDisenio.php');
class CDisenio
{
    public $disenio;

    public function __construct()
    {
        $this->disenio = new NDisenio();
    }

    public function index()
    {
        require_once 'Vista/PDisenio.php';
    }

    public function agregar()
    {
        $idpedido = $_REQUEST['idpedido'];
        // $imagen = $_REQUEST['imagen'];

        $ext = explode(".", $_FILES["imagen"]["name"]);
        if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
            // vamos a renombrar la imagen para evitar que se repitan
            $imagen = round(microtime(true)) . '.' . end($ext);
            // ahora cargar el archivo en el proyecto
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "Vista/assets/img/" . $imagen);
            $this->disenio->agregar($idpedido, $imagen);
        }

        require_once 'Vista/PDisenio.php';
    }

    public function eliminar()
    {
        $id = $_REQUEST['id'];
        $imagen = $_REQUEST['imagen'];
        if (file_exists('Vista/assets/img/' . $imagen)) {
            unlink('Vista/assets/img/' . $imagen);
        }
        $this->disenio->eliminar($id);
        require_once 'Vista/PDisenio.php';
    }
}
