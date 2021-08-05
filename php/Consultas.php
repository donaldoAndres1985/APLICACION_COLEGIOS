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
                <a href="/php/GestionarColegios.php" class="d-block text-light p-1 border-0"><i class="icon ion-md-people lead mr-2"></i>
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
                        <form id="formDocente">
                            <h1 class="page-header text-center"> Respuestas a Preguntas </h1>
                            <fieldset>
                                <div class="form-group">
                                    <LABEL for="nombre">1. ¿Cuántos niños entre 3 y 7 años están matriculados en la ciudad?</LABEL>

                                    <div class="col-md-8">


                                        <LABEL for="nombre_">Niños entre 3 y 7 tenemos un total de =   </LABEL>


                                        <?php

                                        include_once('dbconeccion.php');

                                        $database = new Connection();
                                        $db = $database->open();

                                        try {

                                            $sql = 'SELECT SUM(CASE WHEN TIMESTAMPDIFF(YEAR,fechaNacimiento,CURDATE()) BETWEEN 3 AND 7 THEN 1 ELSE 0 end ) as 3entre7
                                            FROM alumnos WHERE alumnos.id in (SELECT matricula.idAlumnos as id  FROM matricula,configuracion WHERE matricula.anoLectivo= configuracion.anoLectivo) ';

                                            foreach ($db->query($sql) as $row) {
                                                echo ($row["3entre7"]." Niños.");
                                            }
                                        } catch (PDOException $e) {
                                            echo "Hubo un problema en la conexión: " . $e->getMessage();
                                        }

                                        //Cerrar la Conexion
                                        $database->close();

                                        ?>

                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <LABEL for="nombre">2. ¿Cuántos niños hay entre 3 y 7 años, cuántos hay entre 8 y 12 años y cuántos niños hay mayores a 12 años?</LABEL>
                                    <div class="col-md-8">

                                        <?php

                                        include_once('dbconeccion.php');

                                        $database = new Connection();
                                        $db = $database->open();

                                        try {

                                            $sql = 'SELECT SUM(CASE WHEN TIMESTAMPDIFF(YEAR,fechaNacimiento,CURDATE()) BETWEEN 3 AND 7 THEN 1 ELSE 0 end ) as 3entre7,
                                                           SUM(CASE WHEN TIMESTAMPDIFF(YEAR,fechaNacimiento,CURDATE()) BETWEEN 8 AND 12 THEN 1 ELSE 0 end ) as 8entre12,
                                                           SUM(CASE WHEN TIMESTAMPDIFF(YEAR,fechaNacimiento,CURDATE()) > 12 THEN 1 ELSE 0 end ) as mayor12
                                                    FROM alumnos WHERE alumnos.id in (SELECT matricula.idAlumnos as id  FROM matricula,configuracion WHERE matricula.anoLectivo= configuracion.anoLectivo)';

                                            foreach ($db->query($sql) as $row) {
                                            
                                                echo ("Niños entre 3 y 7 tenemos un total de  =   ".$row["3entre7"]." Niños.<br>");
                                                echo ("Niños entre 8 y 12 tenemos un total de  =   ".$row["8entre12"]." Niños.<br>");
                                                echo ("Niños mayor 12 tenemos un total de  =   ".$row["mayor12"]." Niños.");

                                            }
                                        } catch (PDOException $e) {
                                            echo "Hubo un problema en la conexión: " . $e->getMessage();
                                        }

                                        //Cerrar la Conexion
                                        $database->close();

                                        ?>

                                    </div>
                                </div>    

                                <div class="form-group">
                                    <LABEL for="nombre">3. ¿Cuántos docentes han sido contratados para el sector público y cuántos en el sector privado?</LABEL>
                                    <div class="col-md-8">

                                        <?php

                                        include_once('dbconeccion.php');

                                        $database = new Connection();
                                        $db = $database->open();

                                        try {

                                            $sql = "SELECT  SUM(CASE WHEN colegios.sector ='Publico' THEN 1 ELSE 0 end ) as Publico,
                                                    SUM(CASE WHEN colegios.sector ='Privado' THEN 1 ELSE 0 end ) as Privado
                                                    FROM contratos,docentes,colegios
                                                    WHERE contratos.idDocente = docentes.id AND
                                                    contratos.estado = 'Vigente' AND 
                                                    contratos.idColegio = colegios.id";

                                            foreach ($db->query($sql) as $row) {
                                            
                                                echo ("Docentes contratados sector público tenemos un total de  =   ".$row["Publico"]." Docentes.<br>");
                                                echo ("Docentes contratados sector privado tenemos un total de  =   ".$row["Privado"]." Docentes.<br>");


                                            }
                                        } catch (PDOException $e) {
                                            echo "Hubo un problema en la conexión: " . $e->getMessage();
                                        }

                                        //Cerrar la Conexion
                                        $database->close();

                                        ?>

                                    </div>
                                </div>                                   


                                <div class="form-group">
                                    <LABEL for="nombre">4. ¿Cuál es el colegio con mayor número de estudiantes?</LABEL>
                                    <div class="col-md-8">

                                        <?php

                                        include_once('dbconeccion.php');

                                        $database = new Connection();
                                        $db = $database->open();

                                        try {

                                            $sql = "SELECT UPPER(colegios.nombre) as nombre, COUNT(matricula.idAlumnos) as cantidad
                                                    FROM colegios,matricula,configuracion
                                                    WHERE matricula.idColegios = colegios.id AND
                                                          matricula.anoLectivo = configuracion.anoLectivo
                                                    GROUP BY matricula.idColegios LIMIT 1";

                                            foreach ($db->query($sql) as $row) {                                 
                                                echo ("El colegio con mayor número de estudiantes es  =  <b> ".$row["nombre"]." .</b><br>");
                                                echo ("Con un total de alumnos matriculados de  =   ".$row["cantidad"]." Alumnos.<br>");
                                            }
                                        } catch (PDOException $e) {
                                            echo "Hubo un problema en la conexión: " . $e->getMessage();
                                        }

                                        //Cerrar la Conexion
                                        $database->close();

                                        ?>

                                    </div>
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