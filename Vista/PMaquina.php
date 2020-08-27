<?php

session_start();

// if($_SESSION["rol_usuario"]!=1){
//   header("Location: PHome.php");
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
    <title>Maquina</title>
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
                    <h1 class="mt-4">Maquina</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>

                            <div class="container ">

                                <h3><?php if (isset($_POST['cargar']))
                                        echo 'Modificar';
                                    else echo 'Agregar';
                                    ?> Maquina</h3>
                                <br>
                                <!-- Formulario -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" value="CMaquina" name="controlador">
                                    <input type="hidden" name="id" value="<?php if (isset($_POST["cargar"])) echo $_POST["id"]; ?>">
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" required class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php if (isset($_POST["cargar"])) echo $_POST["nombre"]; ?>">
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" value="<?php if (isset($_POST["cargar"])) echo $_POST["descripcion"]; ?>"">
                                            </div>
                                        </div>

                                         <div class=" form-group row">
                                            <label for="modelo" class="col-sm-2 col-form-label">Modelo</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="modelo" value="<?php if (isset($_POST["cargar"])) echo $_POST["modelo"]; ?>"">


                                        
                                            </div>
                                        </div>

                                        <div class=" form-group row">
                                                <label for="capacidad" class="col-sm-2 col-form-label">Capacidad</label>
                                                <div class="col-sm-10">
                                                    <input type="number" step="any" required class="form-control" id="capacidad" name="capacidad" placeholder="capacidad" value="<?php if (isset($_POST["cargar"])) echo $_POST["capacidad"];
                                                                                                                                                                                    else echo '0'; ?>">
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
                                                <a type="button" class="btn btn-info" href="PMaquina.php">Cancelar</a>
                                                </div>';
                                                } else {
                                                    echo '
                                            <div class=" col-sm-6">
                                            <button type="submit"  name="accion" value="agregar" id="agregar" class="btn btn-primary">Agregar</button>
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
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Capacidad</th>
                                            <th>Modelo</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Capacidad</th>
                                            <th>Modelo</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>


                                        <?php


                                        $res = $this->maquina->listar();
                                        $html = '';

                                        while ($reg = $res->fetch_object()) {
                                            $html = $html . '
                                            <tr >
                                               <td>' . $reg->nombre . '</td>
                                              <td>' . $reg->descripcion . '</td>
                                               <td>' . $reg->capacidad . '</td>
                                              <td>' . $reg->modelo . '</td>
                                              <td>';
                                            if ($reg->estado == 1) {
                                                $html = $html . '<span class="badge badge-success">Activado</span>';
                                            } else {
                                                $html = $html . '<span class="badge badge-danger">Desactivado</span>';
                                            }
                                            $html = $html . '</td>
                                               <td class="row"> 
                                               <form method="POST">
                                                   <input type="hidden" name="id" value="' . $reg->id . '">
                                                    <input type="hidden" name="nombre" value="' . $reg->nombre . '">
                                                    <input type="hidden" name="descripcion" value="' . $reg->descripcion . '">
                                                      <input type="hidden" name="capacidad" value="' . $reg->capacidad . '">
                                                    <input type="hidden" name="modelo" value="' . $reg->modelo . '">
                                                    <button type="submit" value="cargar" name="cargar"  class="btn btn-info" role="button"><i class="fa fa-edit" aria-hidden="true"></i></button> 
                                                    </form>
                                                <form method= "POST" action="">
                                                <input type="hidden" value="CMaquina" name="controlador">
                                                <input type="hidden" name="id" value="' . $reg->id . '">
                                                 ';
                                            if ($reg->estado == 1) {
                                                $html = $html . '  <button type="submit" value="deshabilitar" name="accion"  class="btn btn-danger" role="button"><i class="fa fa-minus" aria-hidden="true"></i></button>';
                                            } else {
                                                $html = $html . '  <button type="submit" value="habilitar" name="accion"  class="btn btn-success" role="button"><i class="fa fa-check" aria-hidden="true"></i></button>';
                                            }

                                            $html = $html . '
                                                    </form>
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