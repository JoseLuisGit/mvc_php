<?php
require_once(__DIR__ . './../Modelo/Negocio/NMantenimiento.php');
require_once(__DIR__ . './../Modelo/Negocio/NMaquina.php');
require_once(__DIR__ . './../Modelo/Negocio/NTecnico.php');
class CMantenimiento
{
    public $mantenimiento;


    public function __construct()
    {
        $this->mantenimiento = new NMantenimiento();
    }

    public function actualizar()
    {
        require_once 'Vista/PMantenimiento.php';
    }

    public function agregar()
    {
        $idmaquina = $_REQUEST['idmaquina'];
        $idtecnico = $_REQUEST['idtecnico'];
        $total = $_REQUEST['total'];
        $fecha = $_REQUEST['fecha'];
        $this->mantenimiento->agregar($idmaquina, $idtecnico, $total, $fecha);
        $this->actualizar();
    }

    public function modificar()
    {
        $id = $_REQUEST['id'];
        $idmaquina = $_REQUEST['idmaquina'];
        $idtecnico = $_REQUEST['idtecnico'];
        $total = $_REQUEST['total'];
        $fecha = $_REQUEST['fecha'];
        $this->mantenimiento->modificar($id, $idmaquina, $idtecnico, $total, $fecha);
        $this->actualizar();
    }
    public function eliminar()
    {
        $id = $_REQUEST['id'];
        $this->mantenimiento->eliminar($id);
        $this->actualizar();
    }
}
