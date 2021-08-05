<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- DatePiker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />


    <!-- Styles -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,700&display=swap" rel="stylesheet">

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- jQuery  -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
       


    <title>Administrar Colegios</title>
</head>

<body>

    <div class="d-flex" id="content-wrapper">

        <!-- Sidebar -->
        <div id="sidebar-container" class="bg-primary">
            <div class="logo">
                <h4 class="text-light font-weight-bold mb-0">Administrar Colegios</h4>
            </div>
            <div class="menu">
                <a href="/index.php" class="d-block text-light p-1 border-0"><i class="icon ion-md-apps lead mr-2"></i>
                    Gestionar Docente</a>
                <a href="GestionarColegios.php" class="d-block text-light p-1 border-0"><i class="icon ion-md-people lead mr-2"></i>
                    Gestionar Colegios</a>
                <a href="GestionarContratos.php" class="d-block text-light p-1 border-0"><i class="icon ion-md-stats lead mr-2"></i>
                    Contratos</a>
                <a href="CargaAcademica.php" class="d-block text-light p-1 border-0"><i class="icon ion-md-person lead mr-2"></i>
                    Carga Academica</a>
                <a href="GestionarAlumnos.php" class="d-block text-light p-1 border-0"> <i class="icon ion-md-settings lead mr-2"></i>
                    Gestionar Alumnos</a>
                <a href="MatricularAluno.php" class="d-block text-light p-1 border-0"> <i class="icon ion-md-settings lead mr-2"></i>
                    Matricular Alumnos</a>
                <a href="Consultas.php" class="d-block text-light p-1 border-0"> <i class="icon ion-md-settings lead mr-2"></i>
                    Consultas</a>
            </div>
        </div>
        <!-- Fin sidebar -->
        <div class="w-100">


            <!-- Page Content ---------------------------------------------------------------------------------->
            <br>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-sm-offset-2">
                        <form id="formContrato" method="post" action="/php/AgregarContratos.php">
                            <h1 class="page-header text-center">Nuevo Contrato</h1>
                            <fieldset>

                                <div class="form-group">
                                    <div class="col-md-8">
                                        <select class="custom-select custom-select-sm form-control item" name="colegio">

                                            <?php

                                            include_once('dbconeccion.php');

                                            $database = new Connection();
                                            $db = $database->open();

                                            try {

                                                $sql = 'SELECT id,upper(nombre) as nombre FROM colegios';

                                                foreach ($db->query($sql) as $row) {

                                                    echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
                                                }
                                            } catch (PDOException $e) {
                                                echo "Hubo un problema en la conexión: " . $e->getMessage();
                                            }

                                            //Cerrar la Conexion
                                            $database->close();

                                            ?>


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8">
                                        <select class="custom-select custom-select-sm form-control item" name="docente">
                                            
                                            <?php
                                            //incluimos el fichero de conexion 
                                            //<option selected>Open this select menu</option>
                                            include_once('dbconeccion.php');

                                            $database = new Connection();
                                            $db = $database->open();

                                            try {

                                                $sql = 'SELECT id,upper(CONCAT( docentes.nombres ," ", docentes.apellidos)) as nombreDocente FROM docentes';

                                                foreach ($db->query($sql) as $row) {

                                                    echo '<option value="' . $row["id"] . '">' . $row["nombreDocente"] . '</option>';
                                                }
                                            } catch (PDOException $e) {
                                                echo "Hubo un problema en la conexión: " . $e->getMessage();
                                            }

                                            //Cerrar la Conexion
                                            $database->close();

                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8">
                                        <LABEL for="nombre_">Fecha Inicial del Contrato: </LABEL>
                                        <input class="form-control item" data-date-format="yyyy-mm-dd" id="fechaEntrada" name="fechaEntrada">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <LABEL for="nombre_">Fecha Final del Contrato : </LABEL>
                                        <input class="form-control item" data-date-format="yyyy-mm-dd" id="fechaSalida" name="fechaSalida">
                                    </div>
                                </div>

                                <input id="nEstado" name="estado" class="form-control item" value="Vigente" type = "hidden">          

                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg" name="agregar">Guardar</button>
                                        <a href="GestionarContratos.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Regresar</a>
                                    </div>
                                </div>

                                

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>


            <!-- fin Page Content ---------------------------------------------------------------------------------->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
             <script type="text/javascript">
                $('#fechaEntrada').datepicker({
                    weekStart: 1,
                    daysOfWeekHighlighted: "6,0",
                    autoclose: true,
                    todayHighlight: true,
                });
                $('#fechaEntrada').datepicker("setDate", new Date());
            </script>

            <script type="text/javascript">
                $('#fechaSalida').datepicker({
                    weekStart: 1,
                    daysOfWeekHighlighted: "6,0",
                    autoclose: true,
                    todayHighlight: true,
                });
                $('#fechaSalida').datepicker("setDate", new Date());
            </script>

</body>
</html>