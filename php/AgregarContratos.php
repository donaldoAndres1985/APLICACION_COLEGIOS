<?php
session_start();
include_once('dbconeccion.php');

	$database = new Connection();
	$db = $database->open();


try {		
	
			$idColegioV= $_POST["colegio"];
            $idDocente= $_POST["docente"];
			$fechai= $_POST["fechaEntrada"];
			$fechaf= $_POST["fechaSalida"];


			$sqlBusqueda = "SELECT * FROM contratos WHERE idColegio='".$idColegioV."' AND idDocente='".$idDocente."' and estado='vigente'";

			echo("<script>console.log('PHP: idColegioV  ".$idColegioV."');</script>");
			echo("<script>console.log('PHP: idDocente  ".$idDocente."');</script>");
			echo("<script>console.log('PHP: fE  ".$fechai."');</script>");
			echo("<script>console.log('PHP: fS  ".$fechaf."');</script>");

			$query = $db -> prepare($sqlBusqueda); 			
			$query -> execute(); 
			$results = $query -> fetchAll(PDO::FETCH_OBJ); 

			if($query -> rowCount() > 0){
				
				$_SESSION['message'] = 'El docente al que intenta guardar el contrato, ya tiene un contrato vigente con el colegio.';

				echo("<script>console.log('PHP: 2  ".$_SESSION['message']."');</script>");
				header('location: /php/GestionarContratos.php');
	
			}else{
				//--------------------guarda el docente si noy otro con la misma cedual
				try{

					$stmt = $db->prepare("INSERT INTO contratos (idColegio, idDocente, fechaEntrada, fechaSalida, estado) VALUES
															    (:idColegio, :idDocente, :fechaEntrada,:fechaSalida,:estado )");
			
					$_SESSION['message'] = ( $stmt->execute(array(':idColegio' => $_POST['colegio'] , 
																  ':idDocente' => $_POST['docente'] , 
                                                                  ':fechaEntrada' => $_POST['fechaEntrada'] , 
                                                                  ':fechaSalida' => $_POST['fechaSalida'] , 
																  ':estado' => $_POST['estado'])) ) ? 'Contrato guardado correctamente.' : 'Algo salió mal. No se puede agregar Contrato.';	
				
				}catch(PDOException $e){
					$_SESSION['message'] = $e->getMessage();
				}
				$database->close();
			
				header('location: /php/GestionarContratos.php');
				//----------------------------------------------------------------------								
				//header('location: /php/NuevoDocente.php');
				echo("<script>console.log('PHP: 2  ".'me dirijo a insertar.'."');</script>");
			}

		} catch (PDOException $e) {
			echo "Hubo un problema en la consulta: " . $e->getMessage();
	  }

?>