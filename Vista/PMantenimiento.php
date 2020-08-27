<?php

session_start();

// if ($_SESSION["rol_usuario"] != 1) {
//     header("Location: PLogin.php");
// }


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="Vista/assets/css/styles.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <title>Mantenimiento</title>
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
                    <h1 class="mt-4">Mantenimiento</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>

                            <div class="container ">

                                <h3><?php if (isset($_POST['cargar']))
                                        echo 'Modificar';
                                    else echo 'Agregar';
                                    ?> Mantenimiento</h3>
                                <br>
                                <!-- Formulario -->
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="controlador" value="CMantenimiento">
                                    <input type="hidden" name="id" value="<?php if (isset($_POST["cargar"])) echo $_POST["id"]; ?>">
                                    <div class="form-group row">
                                        <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                                        <div class="col-sm-10">
                                            <input type="date" required class="form-control" id="fecha" name="fecha" value="<?php if (isset($_POST["cargar"])) echo $_POST["fecha"]; ?>">
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <label for="total" class="col-sm-2 col-form-label">Total</label>
                                        <div class="col-sm-10">
                                            <input type="number" step="any" class="form-control" id="total" name="total" placeholder="Total" value="<?php if (isset($_POST["cargar"])) echo $_POST["total"];
                                                                                                                                                    else echo '0' ?>">
                                        </div>
                                    </div>




                                    <div class=" form-group row">
                                        <label for="idmaquina" class="col-sm-2 col-form-label">Maquina</label>
                                        <div class="col-sm-10">
                                            <select name="idmaquina" class="form-control" id="idmaquina">
                                                <?php
                                                $res = $this->maquina->listar();
                                                $html = '';
                                                while ($reg = $res->fetch_object()) {
                                                    $html = $html . ' <option value="' . $reg->id . '"';

                                                    if (isset($_POST["cargar"])) {
                                                        if ($_POST["idmaquina"] == $reg->id) {
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


                                    <div class=" form-group row">
                                        <label for="idtecnico" class="col-sm-2 col-form-label">Tecnico</label>
                                        <div class="col-sm-10">
                                            <select name="idtecnico" class="form-control" id="idtecnico">
                                                <?php
                                                $res = $this->tecnico->listar();
                                                $html = '';
                                                while ($reg = $res->fetch_object()) {
                                                    $html = $html . ' <option value="' . $reg->id . '"';

                                                    if (isset($_POST["cargar"])) {
                                                        if ($_POST["idtecnico"] == $reg->id) {
                                                            $html = $html . 'selected';
                                                        }
                                                    }

                                                    $html = $html . ' >' . $reg->nombre . ' ' . $reg->apellido . '</option>';
                                                }
                                                echo $html;
                                                ?>


                                            </select>
                                        </div>
                                    </div>







                                    <div class=" form-group row ">

                                        <?php
                                        if (isset($_POST['cargar'])) {
                                            echo '
                                            <div class=" col-sm-6">
                                            <button type="submit" name="accion" value="modificar" id="modificar" class="btn btn-primary">Modificar</button>
                                           </div> 
                                               <div class="col-sm-6">
                                                <a type="button" class="btn btn-info" href="?controlador=CMantenimiento">Cancelar</a>
                                                </div>';
                                        } else {
                                            echo '
                                            <div class=" col-sm-6">
                                            <button type="submit" name="accion" value="agregar" id="agregar" class="btn btn-primary">Agregar</button>
                                           </div> ';
                                        }

                                        ?>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class=" card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Maquina</th>
                                            <th>Tecnico</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Maquina</th>
                                            <th>Tecnico</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>


                                        <?php


                                        $res = $this->mantenimiento->listar();
                                        $html = '';

                                        while ($reg = $res->fetch_object()) {
                                            $html = $html . '
                                            <tr >
                                               <td>' . $reg->fecha . '</td>
                                              <td>' . $reg->total . '</td>
                                              <td>' . $reg->idmaquina . '</td>
                                               <td>' . $reg->idtecnico . '</td>
                                              ';

                                            $html = $html . '
                                               <td class="row"> 
                                               <form  method="POST">
                                                   <input type="hidden" name="id" value="' . $reg->id . '">
                                                    <input type="hidden" name="fecha" value="' . $reg->fecha . '">
                                                    <input type="hidden" name="total" value="' . $reg->total . '">
                                                    
                                                    <input type="hidden" name="idmaquina" value="' . $reg->idmaquina . '">
                                                    <input type="hidden" name="idtecnico" value="' . $reg->idtecnico . '">
                                                    <button type="submit" value="cargar" name="cargar"  class="btn btn-info" role="button"><i class="fa fa-edit" aria-hidden="true"></i></button>

                                                    </form>

                                                     <form method= "POST" action="">
                                                <input type="hidden" value="CMantenimiento" name="controlador">
                                                <input type="hidden" name="id" value="' . $reg->id . '">

                                                 ';

                                            $html = $html . '  <button type="submit" value="eliminar" name="accion"  class="btn btn-danger" role="button"><i class="fa fa-trash" aria-hidden="true"></i></button>';


                                            $html = $html . '
                                                     </form>
                                                     </td>
                                                  </tr>';
                                        }
                                        echo $html;
                                        ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
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