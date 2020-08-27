<?php

session_start();
$_SESSION["id_usuario"] = 1;
$_SESSION["rol_usuario"] = 2;
$idusuario = $_SESSION["id_usuario"];
$idrol = $_SESSION["rol_usuario"];
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="vista/assets/css/styles.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <title>Pedido</title>
</head>

<body class="sb-nav-fixed">

    <!-- heaader -->
    <?php
    include 'layouts/header.php'
    ?>
    <div id="layoutSidenav">
        <!-- sidebar -->
        <?php
        include 'layouts/sidebar.php';
        ?>

        <div id="layoutSidenav_content">

            <!-- CONTENIDO -->


            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Pedido</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>

                            <div class="container ">

                                <h3><?php if (isset($_POST['cargar']))
                                        echo 'Modificar';
                                    else echo 'Agregar';
                                    ?> Pedido</h3>
                                <br>
                                <!-- Formulario -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" value="CPedido" name="controlador">
                                    <input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
                                    <input type="hidden" name="id" value="<?php if (isset($_POST["cargar"])) echo $_POST["id"]; ?>">
                                    <div class="form-group row">
                                        <label for="fecha" class="col-sm-2 col-form-label">Fecha Entrega</label>
                                        <div class="col-sm-10">
                                            <input type="date" required class="form-control" id="fechafin" name="fechafin" value="<?php if (isset($_POST["cargar"])) echo $_POST["fechafin"]; ?>">
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" value="<?php if (isset($_POST["cargar"])) echo $_POST["descripcion"]; ?>">
                                        </div>
                                    </div>

                                    <div class=" form-group row">
                                        <label for="muestra" class="col-sm-2 col-form-label">Muestra</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="muestra" name="muestra">
                                            <input type="hidden" name="muestraactual" value="<?php if (isset($_POST["cargar"])) echo $_POST["muestra"]; ?>">
                                            <?php
                                            if (isset($_POST["cargar"])) {
                                                echo ' <img src="Vista/assets/img/' . $_POST["muestra"] . '" width="150px" height="120px" >';
                                            }
                                            ?>



                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <label for="total" class="col-sm-2 col-form-label">Cantidad</label>
                                        <div class="col-sm-10">
                                            <input type="number" required class="form-control" id="cantidad" name="cantidad" placeholder="cantidad" value="<?php if (isset($_POST["cargar"])) echo $_POST["cantidad"];
                                                                                                                                                            else echo '0'; ?>">
                                        </div>
                                    </div>

                                    <div class=" form-group row">
                                        <label for="total" class="col-sm-2 col-form-label">Total</label>
                                        <div class="col-sm-10">
                                            <input type="number" step="any" required class="form-control" id="total" name="total" placeholder="total" value="<?php if (isset($_POST["cargar"])) echo $_POST["total"];
                                                                                                                                                                else echo '0'; ?>">
                                        </div>
                                    </div>

                                    <div class=" form-group row">
                                        <label for="genero" class="col-sm-2 col-form-label">Servicio</label>
                                        <div class="col-sm-10">
                                            <select name="idservicio" class="form-control" id="idservicio">
                                                <?php
                                                $res = $this->servicio->listar();
                                                $html = '';
                                                while ($reg = $res->fetch_object()) {
                                                    $html = $html . ' <option value="' . $reg->id . '"';

                                                    if (isset($_POST["cargar"])) {
                                                        if ($_POST["idservicio"] == $reg->id) {
                                                            $html = $html . 'selected';
                                                        }
                                                    }

                                                    $html = $html . ' >' . $reg->nombre . '</option>';
                                                }
                                                echo $html;
                                                ?>


                                            </select>
                                        </div>
                                    </div>





                                    <div class=" form-group row ">


                                        <?php
                                        if ($idrol == 2) {
                                            if (isset($_POST['cargar'])) {
                                                echo '
                                            <div class=" col-sm-6">
                                            <button type="submit" name="accion" value="modificar" id="modificar" class="btn btn-primary">Modificar</button>
                                           </div> 
                                               <div class="col-sm-6">
                                                <a type="button" class="btn btn-info" href="?controlador=CPedido">Cancelar</a>
                                                </div>';
                                            } else {
                                                echo '
                                            <div class=" col-sm-6">
                                            <button type="submit" name="accion" value="agregar" id="agregar" class="btn btn-primary">Agregar</button>
                                           </div> ';
                                            }
                                        }

                                        ?>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Fecha Entrega</th>
                                    <th>Total</th>
                                    <th>Muestra</th>
                                    <th>Servicio</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                    <th>Catalogo</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Fecha Entrega</th>
                                    <th>Total</th>
                                    <th>Muestra</th>
                                    <th>Servicio</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                    <th>Catalogo</th>
                                </tr>
                            </tfoot>
                            <tbody>


                                <?php


                                $res = $this->pedido->listar();
                                $html = '';

                                while ($reg = $res->fetch_object()) {
                                    $html = $html . '
                                            <tr >
                                               <td>' . $reg->fecha . '</td>
                                              <td>' . $reg->descripcion . '</td>
                                               <td>' . $reg->cantidad . '</td>
                                                 <td>' . $reg->fechafin . '</td>
                                              <td>' . $reg->total . '</td>
                                                <td>  <img src="Vista/assets/img/' . $reg->muestra . '" width="150px" height="120px" > </td>
                                                  <td>' . $reg->idservicio . '</td>
                                                   <td>' . $reg->idusuario . '</td>
                                              <td>';
                                    if ($reg->estado == 1) {
                                        $html = $html . '<span class="badge badge-success">Activado</span>';
                                    } else {
                                        $html = $html . '<span class="badge badge-danger">Desactivado</span>';
                                    }
                                    if ($reg->terminado == 1) {
                                        $html = $html . '<span class="badge badge-success">Terminado</span>';
                                    } else {
                                        $html = $html . '<span class="badge badge-danger">No Terminado</span>';
                                    }
                                    $html = $html . '</td>
                                               <td class="row"> 
                                               <form  method="POST">
                                                   <input type="hidden" name="id" value="' . $reg->id . '">
                
                                                    <input type="hidden" name="descripcion" value="' . $reg->descripcion . '">
                                                      <input type="hidden" name="total" value="' . $reg->total . '">
                                                    <input type="hidden" name="muestra" value="' . $reg->muestra . '">
                                                     <input type="hidden" name="cantidad" value="' . $reg->cantidad . '">
                                                       <input type="hidden" name="idservicio" value="' . $reg->idservicio . '">
                                                          <input type="hidden" name="fechafin" value="' . $reg->fechafin . '">';
                                    if ($reg->terminado == 0 && $idrol == 2) {
                                        $html = $html . '
                                                    <button type="submit" value="cargar" name="cargar"  class="btn btn-info" role="button"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                                 ';
                                    }
                                    $html = $html . '</form>
                                     <form method= "POST" action="">
                                                <input type="hidden" value="CPedido" name="controlador">
                                                <input type="hidden" name="id" value="' . $reg->id . '">
                                    ';
                                    if ($reg->estado == 1 && $idrol == 2) {
                                        $html = $html . '  <button type="submit" value="deshabilitar" name="accion"  class="btn btn-danger" role="button"><i class="fa fa-minus" aria-hidden="true"></i></button>';
                                    } elseif ($reg->estado == 0 && $idrol == 2) {

                                        $html = $html . '  <button type="submit" value="habilitar" name="accion"  class="btn btn-success" role="button"><i class="fa fa-check" aria-hidden="true"></i></button>';
                                    }
                                    if ($reg->terminado == 0 && $idrol == 1) {
                                        $html = $html . '  <button type="submit" value="terminar" name="accion"  class="btn btn-warning" role="button"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></button>';
                                    }

                                    $html = $html . '
                                                     
                                                     </form>
                                                     </td>
d
                                                     <td>
                                                     <form method="POST" action="?controlador=CDisenio">
                                                        <input type="hidden" name="idpedido" value="' . $reg->id . '">
                                                         <button type="submit" class="btn btn-success" role="button"><i class="fa fa-image" aria-hidden="true"></i></button>
                                                     <form>
                                                     </td>
                                                  </tr>';
                                }
                                echo $html;
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </main>

            <!-- footer -->

            <?php
            include 'layouts/footer.php'
            ?>


        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="Vista/assets/js/scripts.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

</body>

</html>