<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,700&display=swap" rel="stylesheet">

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

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
        <div class="container" style="height: 600px; overflow-y: scroll;">
		<h1 class="page-header text-center">Alumnos Matriculados Año Lectivo</h1>
				<div class="row">
				<div class="col-sm-12 col-sm-offset-2">
				<a href="/php/NuevaMatricula.php" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Nueva Matricula</a>
				
				<?php
				session_start();
				if (isset($_SESSION['message'])) {
				?>
					<div class="alert alert-info text-center" style="margin-top:20px;">
						<?php echo $_SESSION['message']; ?>
					</div>
				<?php

					unset($_SESSION['message']);
				}
				?>
				
				<table class="table table-bordered table-striped" style="margin-top:20px;">
					<thead>
						<th>Nombres y Apellidos Alumno</th>
						<th>Nombre del Colegio</th>
						<th>Jornada</th>
						<th>Grado - Grupo</th>
						<th>Año Lectivo</th>
                        <th>Accion</th>
					</thead>
					<tbody>
						<?php
						//incluimos el fichero de conexion
						include_once('dbconeccion.php');

						$database = new Connection();
						$db = $database->open();
						try {
							$sql = 'SELECT matricula.id as id,
                            upper(CONCAT( alumnos.nombres ," ", alumnos.apellidos)) as nombreAlumnos,
                            upper(colegios.nombre) as nombreColegio,
                            upper(jornada.jornada) as jornada,
                            upper(CONCAT(grado.grado,"-", matricula.grupo)) as gradoGrupo,
                            matricula.anoLectivo 
                            FROM matricula,alumnos,colegios,jornada,grado,configuracion
               
                             WHERE matricula.idColegios = colegios.id AND
                             matricula.idAlumnos = alumnos.id AND
                             matricula.idJornada = jornada.id AND
                             matricula.idGrado = grado.id AND
                             matricula.anoLectivo = configuracion.anoLectivo';

							foreach ($db->query($sql) as $row) {
						?>
								<tr>
									<td><?php echo $row['nombreAlumnos']; ?></td>
									<td><?php echo $row['nombreColegio']; ?></td>
									<td><?php echo $row['jornada']; ?></td>
                                    <td><?php echo $row['gradoGrupo']; ?></td>
                                    <td><?php echo $row['anoLectivo']; ?></td>
									<td>
										<a href="#edit_<?php echo $row['idEmp']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Editar</a>
										<a href="#delete_<?php echo $row['idEmp']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
									</td>

								</tr>
						<?php
							}
						} catch (PDOException $e) {
							echo "Hubo un problema en la conexión: " . $e->getMessage();
						}

						//Cerrar la Conexion
						$database->close();

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
       

        <!-- fin Page Content ---------------------------------------------------------------------------------->


</body>

</html>