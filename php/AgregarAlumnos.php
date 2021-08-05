<?php
session_start();
include_once('dbconeccion.php');

	$database = new Connection();
	$db = $database->open();


try {		
	
			$cc = $_POST["documento"];
			$sqlBusqueda = "SELECT * from alumnos where numeroDocumento='".$cc."'";

			echo("<script>console.log('PHP: 1  ".$cc."');</script>");
			echo("<script>console.log('PHP: 2  ".$sqlBusqueda."');</script>");

			$query = $db -> prepare($sqlBusqueda); 			
			$query -> execute(); 
			$results = $query -> fetchAll(PDO::FETCH_OBJ); 

			if($query -> rowCount() > 0){
				
				$_SESSION['message'] = 'El documento del Alumno que intenta guardar ya existe.';
				echo("<script>console.log('PHP: 2  ".$_SESSION['message']."');</script>");
				header('location: /php/GestionarAlumnos.php');
	
			}else{
				//--------------------guarda el docente si noy otro con la misma cedual
				try{

					$stmt = $db->prepare("INSERT INTO alumnos (numeroDocumento, nombres, apellidos, sexo, fechaNacimiento) VALUES
																(:numeroDocumento, :nombres, :apellidos, :sexo, :fechaNacimiento)");
			
					$_SESSION['message'] = ( $stmt->execute(array(':numeroDocumento' => $_POST['documento'] , 
																  ':nombres' => $_POST['nombres'] , 
																  ':apellidos' => $_POST['apellidos'],
																  ':sexo' => $_POST['sexo'], 
																  ':fechaNacimiento' => $_POST['fechaNacimiento'])) ) ? 'Alumno guardado correctamente.' : 'Algo salió mal. No se puede agregar Alumno.';	
				
				}catch(PDOException $e){
					$_SESSION['message'] = $e->getMessage();
				}
				$database->close();
			
				header('location: /php/GestionarAlumnos.php');
				//----------------------------------------------------------------------								
				//header('location: /php/NuevoDocente.php');
				echo("<script>console.log('PHP: 2  ".'me dirijo a insertar.'."');</script>");
			}

				

				
			

		} catch (PDOException $e) {
			echo "Hubo un problema en la consulta: " . $e->getMessage();
	  }

?>