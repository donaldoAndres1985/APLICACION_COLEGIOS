<?php
session_start();
include_once('dbconeccion.php');

	$database = new Connection();
	$db = $database->open();


try {		
	
			$idColegioV= $_POST["colegio"];
            $idAlumno= $_POST["alumno"];
            $anoLectivo= $_POST["anoLectivo"];

			$sqlBusqueda = "SELECT * FROM matricula WHERE idAlumnos='".$idAlumno."' AND idColegios='".$idColegioV."' and anoLectivo='".$anoLectivo."'";

			echo("<script>console.log('PHP: idColegioV  ".$idColegioV."');</script>");
			echo("<script>console.log('PHP: idDocente  ".$idAlumno."');</script>");
			echo("<script>console.log('PHP: fE  ".$anoLectivo."');</script>");

			$query = $db -> prepare($sqlBusqueda); 			
			$query -> execute(); 
			$results = $query -> fetchAll(PDO::FETCH_OBJ); 

			if($query -> rowCount() > 0){
				
				$_SESSION['message'] = 'Un Alumno solo puede pertenecer a un colegio, El alumno actual ya esta matriculado para el año lectivo.';

				echo("<script>console.log('PHP: 2  ".$_SESSION['message']."');</script>");
				header('location: /php/MatricularAluno.php');
	
			}else{
				//--------------------guarda el docente si noy otro con la misma cedual
				try{

					$stmt = $db->prepare("INSERT INTO matricula (idAlumnos, idColegios, idJornada, idGrado, grupo,anoLectivo) VALUES
															    (:idAlumnos, :idColegios, :idJornada,:idGrado,:grupo,:anoLectivo)");
			
					$_SESSION['message'] = ( $stmt->execute(array(':idAlumnos' => $_POST['alumno'] , 
																  ':idColegios' => $_POST['colegio'] , 
                                                                  ':idJornada' => $_POST['jornada'] , 
                                                                  ':idGrado' => $_POST['grado'] , 
                                                                  ':grupo' => $_POST['grupo'] , 
																  ':anoLectivo' => $_POST['anoLectivo'])) ) ? 'Alumno matriculado correctamente.' : 'Algo salió mal. No se puede agregar matricula.';	
				
				}catch(PDOException $e){
					$_SESSION['message'] = $e->getMessage();
				}
				$database->close();
			
				header('location: /php/MatricularAluno.php');
				//----------------------------------------------------------------------								
				//header('location: /php/NuevoDocente.php');
				echo("<script>console.log('PHP: 2  ".'me dirijo a insertar.'."');</script>");
			}

		} catch (PDOException $e) {
			echo "Hubo un problema en la consulta: " . $e->getMessage();
	  }

?>