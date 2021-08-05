<?php
session_start();
include_once('dbconeccion.php');

	$database = new Connection();
	$db = $database->open();

    try {		
				//--------------------
				try{

					$stmt = $db->prepare("INSERT INTO cargaacademica (idDocente, idColegio, idJornada, idGrado, grupo,idAsignatura,dia) VALUES
															    (:idDocente, :idColegio, :idJornada,:idGrado,:grupo,:idAsignatura,:dia )");
			
					$_SESSION['message'] = ( $stmt->execute(array(':idDocente' => $_POST['docente'] , 
																  ':idColegio' => $_POST['colegio'] , 
                                                                  ':idJornada' => $_POST['jornada'] , 
                                                                  ':idGrado' => $_POST['grado'] , 
                                                                  ':grupo' => $_POST['grupo'] , 
                                                                  ':idAsignatura' => $_POST['asignatura'] , 
																  ':dia' => $_POST['dia'])) ) ? 'Carga Academica guardada correctamente.' : 'Algo salió mal. No se puede agregar Carga Academica.';	
				
				}catch(PDOException $e){
					$_SESSION['message'] = $e->getMessage();
				}
				$database->close();
			
				header('location: /php/CargaAcademica.php');
				//----------------------------------------------------------------------								
				//header('location: /php/NuevoDocente.php');
				echo("<script>console.log('PHP: 2  ".'me dirijo a insertar.'."');</script>");
			

		} catch (PDOException $e) {
			echo "Hubo un problema en la consulta: " . $e->getMessage();
	  }
