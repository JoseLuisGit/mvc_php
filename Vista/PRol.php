<?php

session_start();
if ($_SESSION["rol_usuario"] != 1) {
    header("Location: ?controlador=CHome");
}

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
    <title>Rol</title>
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
                    <h1 class="mt-4">Rol</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>

                            <div class="container ">

                                <h3><?php if (isset($_POST['cargar']))
                                        echo 'Modificar';
                                    else echo 'Agregar';
                                    ?> Rol</h3>
                                <br>
                                <!-- Formulario -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" value="CRol" name="controlador">
                                    <input type="hidden" name="id" value="<?php if (isset($_POST["cargar"])) echo $_POST["i"]; ?>">
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" required class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php if (isset($_POST["cargar"])) echo $_POST["n"]; ?>">
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" value="<?php if (isset($_POST["cargar"])) echo $_POST["d"]; ?>"">
                                            </div>
                                        </div>

                                        





                                            <div class=" form-group row ">

                                                <?php
                                                if (isset($_POST['cargar'])) {
                                                    echo '
                                            <div class=" col-sm-6">
                                            <button type="submit" name="accion" value="modificar" class="btn btn-primary">Modificar</button>
                                           </div> 
                                               <div class="col-sm-6">
                                                <a type="button" class="btn btn-info" href="?controlador=CRol">Cancelar</a>
                                                </div>';
                                                } else {
                                                    echo '
                                            <div class=" col-sm-6">          
                                            <button type="submit" name="accion" value="agregar" class="btn btn-primary">Agregar</button>
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
                                                            <th>Opciones</th>

                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Descripcion</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>


                                                        <?php


                                                        $res = $this->rol->listar();

                                                        $html = '';

                                                        while ($reg = $res->fetch_object()) {
                                                            $html = $html . '
                                            <tr >
                                               <td>' . $reg->nombre . '</td>
                                              <td>' . $reg->descripcion . '</td>
                                               <td class="row"> 
                                               <form  method="POST">
                                                   <input type="hidden" name="i" id="i" value="' . $reg->id . '">
                                                    <input type="hidden" name="n" id="n" value="' . $reg->nombre . '">
                                                    <input type="hidden" name="d" id="d" value="' . $reg->descripcion . '">
                                                    <button type="submit" value="cargar" name="cargar" id="cargar" class="btn btn-info" role="button"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                                  
                                                     </form>
                                                  </tr>';
                                                        }
                                                        echo $html
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