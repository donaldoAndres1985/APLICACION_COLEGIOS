<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,700&display=swap" rel="stylesheet">

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- jQuery -->
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
                    <form id="formColegio" method="post" action="/php/AgregarColegios.php">
                        <h1 class="page-header text-center">Nuevo Colegio</h1>
                        <fieldset>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="nNombre" name="nombre" type="text" placeholder="Nombre del Colegio" class="form-control item" maxlength="100" minlength="4" required>
                                </div>
                            </div>

                            <div class="form-group">
                            <div class="col-md-8">
                                <select class="custom-select custom-select-sm form-control item"  name="sector" >
                                    <option value="Publico">Publico</option>
                                    <option value="Privado">Privado</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="nCiudad" name="ciudad" type="text" placeholder="Ciudad" class="form-control item" value="Sincelejo" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" name="agregar">Guardar</button>
                                    <a href="GestionarColegios.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Regresar</a>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                     </div>
                </div>
            </div>


            <!-- fin Page Content ---------------------------------------------------------------------------------->


</body>

</html>