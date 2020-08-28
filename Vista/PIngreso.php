<?php


if ($_SESSION["rol_usuario"] != 1) {
    header("Location: ?controlador=CHome");
}
if (isset($_POST["limpiar"])) {
    $_SESSION["detalle"] = [];
}

$detalle = array();

if (!isset($_SESSION["detalle"])) {
    $_SESSION["detalle"] = [];
}
if ($_SESSION["detalle"] != []) {
    $detalle = $_SESSION["detalle"];
}
if (isset($idrecurso)) {

    agregarDetalle($idrecurso, $cantidad, $costo);
    $detalle = $_SESSION["detalle"];
}

function listarDetalle($id)
{
    $nIngreso = new NIngreso();
    return $nIngreso->listardetalle($id);
}

function listar()
{
    $nIngreso = new NIngreso();
    return $nIngreso->listar();
}
function listarProveedores()
{
    $nProveedor = new NProveedor();
    return $nProveedor->listar();
}


function agregarDetalle($idrecurso, $costo, $cantidad)
{
    $nRecurso = new NRecurso();
    if ($idrecurso != null) {
        $rec = $nRecurso->obtener($idrecurso);
        if ($rec != null) {
            $rec["cantidad"] = $cantidad;
            $rec["costo"] = $costo;
            $_SESSION["detalle"][] = $rec;
        }
    }
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
    <title>Ingreso</title>
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
                    <h1 class="mt-4">Ingreso</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>

                            <div class="container ">

                                <h3>Agregar Ingreso</h3>
                                <br>
                                <!-- Formulario -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="controlador" value="CIngreso">
                                    <div class="form-group row">
                                        <label for="nombre" class="col-sm-2 col-form-label">Fecha</label>
                                        <div class="col-sm-10">
                                            <input type="date" required class="form-control" id="fecha" name="fecha" value="<?php if (isset($_POST["fecha"])) echo $_POST["fecha"] ?>">
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <label for="genero" class="col-sm-2 col-form-label">Proveedor</label>
                                        <div class="col-sm-10">
                                            <select name="idproveedor" class="form-control" id="idproveedor">
                                                <?php


                                                $res = listarProveedores();
                                                $html = '';
                                                while ($reg = $res->fetch_object()) {
                                                    $html = $html . ' <option value="' . $reg->id . '"';

                                                    if (isset($idrecurso)) {
                                                        if ($_POST["idproveedor"] == $reg->id) {
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


                                    <h3>Detalle Recurso</h3>


                                    <div class="form-group row">

                                        <label for="nombre" class="col-sm-2 col-form-label"># Recurso</label>
                                        <div class="col-sm-2">
                                            <input type="number" name="idrecurso" class="form-control" id="idrecurso" placeholder="Numero Recurso">
                                        </div>
                                        <label for="nombre" class="col-sm-2 col-form-label"> Cantidad</label>
                                        <div class="col-sm-2">
                                            <input type="number" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad">
                                        </div>
                                        <label for="nombre" class="col-sm-2 col-form-label"> Costo</label>
                                        <div class="col-sm-2">
                                            <input type="number" name="costo" class="form-control" id="costo" placeholder="Costo">
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="accion" value="agregarDetalle">Agregar Detalle</button>
                                        <button type="submit" class="btn btn-danger" name="limpiar">Limpiar</button>


                                    </div>



                                    <table class="table table-dark table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>Costo</th>
                                                <th>Subtotal</th>

                                            </tr>
                                        </thead>
                                        <?php

                                        $total = 0;
                                        foreach ($detalle as $det) {
                                            echo '<tr><td>' . $det["id"] . '</td>
                                            <td>' . $det["nombre"] . '</td>
                                            <td>' . $det["descripcion"] . '</td>
                                            <td>' . $det["cantidad"] . '</td>
                                            <td>' . $det["costo"] . '</td>
                                            <td>' . $det["costo"] * $det["cantidad"] . '</td>
                                            </tr>
                                            ';
                                            $total = $total + $det["costo"] * $det["cantidad"];
                                        }
                                        ?>


                                    </table>
                                    <div class=" form-group row">

                                        <h3>Total <?php echo $total; ?> Bs.</h3>

                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" id="total" name="total" value="<?php echo $total; ?>">
                                        </div>
                                    </div>

                                    <div class=" col-sm-6">
                                        <button type="submit" name="accion" value="agregar" id="agregar" class="btn btn-primary">Agregar</button>
                                    </div>





                                </form>
                            </div>
                        </div>
                        <div class=" card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Proveedor</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Proveedor</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>


                                        <?php


                                        $res = listar();
                                        $html = '';

                                        while ($reg = $res->fetch_object()) {
                                            $html = $html . '
                                            <tr >
                                                 <td>' . $reg->id . '</td>
                                               <td>' . $reg->fecha . '</td>
                                              <td>' . $reg->total . '</td>
                                               <td>' . $reg->idProveedor . '</td>
                                              ';

                                            $html = $html . '</td>
                                               <td class="row"> 
                                               <form action="" method="POST">
                                                   <input type="hidden" name="id" value="' . $reg->id . '">
                                                    <input type="hidden" name="fecha" value="' . $reg->fecha . '">
                                                    <input type="hidden" name="total" value="' . $reg->total . '">
                                                      <input type="hidden" name="idproveedor" value="' . $reg->idProveedor . '">
                                                    <button type="submit" value="listarDetalle" name="accion"  class="btn btn-info" role="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                     </form>
                                                  </tr>';
                                        }

                                        echo $html;
                                        ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php

                        if (isset($id)) {


                            $html = ' <div class=" card-body">
                            <div class="table-responsive">
                                <h3>Detalle Ingreso</h3>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                          
                                            <th scope="col">Recurso</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Costo</th>
                                            <th scope="col">SubTotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>';
                            $listardetalle = listarDetalle($id);
                            while ($reg = $listardetalle->fetch_object()) {
                                $html = $html . '
                                <th scope="row">' . $reg->idingreso . '</th>
                                
                                <td>' . $reg->idrecurso . '</td>
                                <td>' . $reg->cantidad . '</td>
                                <td>' . $reg->costo . '</td>
                                <td>' . $reg->costo * $reg->cantidad . ' Bs</td>
                                
                                </tr>';
                            }

                            $html = $html . '


                                </tbody>
                        </table>
                    </div>
                </div>

                                ';

                            echo $html;
                        }




                        ?>





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