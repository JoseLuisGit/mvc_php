<?php
require_once(__DIR__ . './../Modelo/Negocio/NTecnico.php');
class CTecnico
{
    public $tecnico;

    public function __construct()
    {
        $this->tecnico = new NTecnico();
    }

    public function actualizar()
    {
        require_once 'Vista/Ptecnico.php';
    }

    public function agregar()
    {
        $nombre = $_REQUEST["nombre"];
        $apellido = $_REQUEST["apellido"];
        $genero = $_REQUEST["genero"];
        $telefono = $_REQUEST["telefono"];
        $direccion = $_REQUEST["direccion"];
        $email = $_REQUEST["email"];
        $informacion = $_REQUEST["informacion"];
        $this->tecnico->agregar($nombre, $apellido, $genero, $telefono, $direccion, $email, $informacion);
        $this->actualizar();
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
        $informacion = $_REQUEST["informacion"];
        $this->tecnico->modificar($id, $nombre, $apellido, $genero, $telefono, $direccion, $email, $informacion);
        $this->actualizar();
    }
}
