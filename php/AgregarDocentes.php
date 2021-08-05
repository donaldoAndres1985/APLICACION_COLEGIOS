<?php
session_start();
include_once('dbconeccion.php');

	$database = new Connection();
	$db = $database->open();


try {		
	
			$cc = $_POST["cedula"];
			$sqlBusqueda = "SELECT * from docentes where cedula='".$cc."'";

			echo("<script>console.log('PHP: 1  ".$cc."');</script>");
			echo("<script>console.log('PHP: 2  ".$sqlBusqueda."');</script>");

			$query = $db -> prepare($sqlBusqueda); 			
			$query -> execute(); 
			$results = $query -> fetchAll(PDO::FETCH_OBJ); 

			if($query -> rowCount() > 0){
				
				$_SESSION['message'] = 'La cedula del Docente ya existe.';
				//header('location: /php/NuevoDocente.php');
				echo("<script>console.log('PHP: 2  ".$_SESSION['message']."');</script>");
				header('location: /index.php');
	
			}else{
				//--------------------guarda el docente si noy otro con la misma cedual
				try{

					$stmt = $db->prepare("INSERT INTO docentes (cedula, nombres, apellidos, telefono, direccion) VALUES
																(:cedula, :nombres, :apellidos, :telefono, :direccion)");
			
					$_SESSION['message'] = ( $stmt->execute(array(':cedula' => $_POST['cedula'] , 
																  ':nombres' => $_POST['nombres'] , 
																  ':apellidos' => $_POST['apellidos'],
																  ':telefono' => $_POST['telefono'], 
																  ':direccion' => $_POST['direccion'])) ) ? 'Docente guardado correctamente.' : 'Algo salió mal. No se puede agregar direccion.';	
				
				}catch(PDOException $e){
					$_SESSION['message'] = $e->getMessage();
				}
				$database->close();
			
				header('location: /index.php');
				//----------------------------------------------------------------------								
				//header('location: /php/NuevoDocente.php');
				echo("<script>console.log('PHP: 2  ".'me dirijo a insertar.'."');</script>");
			}

				

				
			

		} catch (PDOException $e) {
			echo "Hubo un problema en la consulta: " . $e->getMessage();
	  }

?>