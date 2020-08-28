<?php
session_start();


$nDisenio = new NDisenio();

if (isset($_POST["idpedido"])) {
    $idpedido = $_POST["idpedido"];
} else {
    header("Location: ?controlador=CPedido");
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
    <title>Diseños</title>
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
                    <h1 class="mt-4">Diseños</h1>



                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>

                            <div class="container ">

                                <h3> Diseños</h3>
                                <br>
                                <!-- Formulario -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="controlador" value="CDisenio">
                                    <input type="hidden" name="idpedido" value="<?php echo $idpedido; ?>">
                                    <div class=" form-group row">
                                        <label for="muestra" class="col-sm-2 col-form-label">Imagen</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="imagen" name="imagen">



                                        </div>
                                    </div>






                                    <div class=" form-group row ">

                                        <?php
                                        if ($_SESSION["rol_usuario"] == 1) {
                                            echo ' <div class=" col-sm-6">
                                            <button type="submit" name="accion" value="agregar"  id="agregar" class="btn btn-primary">Agregar</button>
                                            <a href="?controlador=CPedido" class="btn btn-primary">Atras</a>
                                        </div>';
                                        }
                                        ?>

                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class=" card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>


                                        <?php


                                        $res = $this->disenio->listar($idpedido);
                                        $html = '';

                                        while ($reg = $res->fetch_object()) {
                                            $html = $html . '
                                            <tr >
                                               <td>' . $reg->id . '</td>
                                              <td>  <img src="vista/assets/img/' . $reg->imagen . '" height="400px"> </td>

                                               <td class="row"> ';

                                            if ($_SESSION["rol_usuario"] == 1) {

                                                $html = $html . '<form action"" method="POST">
                                                   <input type="hidden" name="id" id="id" value="' . $reg->id . '">
                                                   <input type="hidden" name="idpedido" id="idpedido" value="' . $reg->idpedido . '">
                                                   <input type="hidden" name="imagen" id="imagen" value="' . $reg->imagen . '">


                                                    <button type="submit" value="eliminar" name="accion" id="eliminar" class="btn btn-danger" role="button"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                                     </form>
                                                     </td>';
                                            }

                                            $html = $html . '
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