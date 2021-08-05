<?php
session_start();
include_once('dbconeccion.php');

	$database = new Connection();
	$db = $database->open();


try {		
	
			$nombreC= $_POST["nombre"];
			$sqlBusqueda = "SELECT * from colegios where nombre='".$nombreC."'";

			echo("<script>console.log('PHP: 1  ".$nombreC."');</script>");
			echo("<script>console.log('PHP: 2  ".$sqlBusqueda."');</script>");

			$query = $db -> prepare($sqlBusqueda); 			
			$query -> execute(); 
			$results = $query -> fetchAll(PDO::FETCH_OBJ); 

			if($query -> rowCount() > 0){
				
				$_SESSION['message'] = 'El colegio que intenta guardar ya existe.';
				//header('location: /php/NuevoDocente.php');
				echo("<script>console.log('PHP: 2  ".$_SESSION['message']."');</script>");
				header('location: /GestionarColegios.php');
	
			}else{
				//--------------------guarda el docente si noy otro con la misma cedual
				try{

					$stmt = $db->prepare("INSERT INTO colegios (nombre, sector, ciudad) VALUES
																(:nombre, :sector, :ciudad)");
			
					$_SESSION['message'] = ( $stmt->execute(array(':nombre' => $_POST['nombre'] , 
																  ':sector' => $_POST['sector'] , 
																  ':ciudad' => $_POST['ciudad'])) ) ? 'Colegio guardado correctamente.' : 'Algo salió mal. No se puede agregar Colegio.';	
				
				}catch(PDOException $e){
					$_SESSION['message'] = $e->getMessage();
				}
				$database->close();
			
				header('location: /php/GestionarColegios.php');
				//----------------------------------------------------------------------								
				//header('location: /php/NuevoDocente.php');
				echo("<script>console.log('PHP: 2  ".'me dirijo a insertar.'."');</script>");
			}

				

				
			

		} catch (PDOException $e) {
			echo "Hubo un problema en la consulta: " . $e->getMessage();
	  }

?>