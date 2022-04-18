<?php

	/**
	 * 
	 */
	class Homework {
		
		public $title;
		public $description;

		public function __construct( $title, $description ){
			$this->title = $title;
			$this->description = $description;
		}

		public function saveNewTask($pdo){
			$taskTitle = $this->title;
			$description = $this->description;
			$sql = "INSERT into tareas(titulo,descripcion) values(?,?)";
			$sentencia = $pdo->prepare( $sql );
			$response = $sentencia->execute( [$taskTitle, $description] );
			if ($response === TRUE) {
				echo "se guardo con éxito";
			} else{
				echo "algo salio mal... No se pudo guardar";
			}
		}

		/*
			Recibe como parametro;
			Tipo de tarea (1=pendiente/0=completadas)
			link: http://localhost/restTareas/index.php?pendientes=1
		*/
		public static function getPendingTask( $pending,$pdo ){
			$arrayData = array();
			$sql = "SELECT * from tareas where pendiente=? order by idtarea;";
			$sentencia = $pdo->prepare( $sql );
			$sentencia->execute(array($pending));
			while ( $response = $sentencia->fetch(PDO::FETCH_ASSOC) ) {
				$data=array_map('utf8_encode',$response);
				$datos['idtarea'] = $data['idtarea'];
				$datos['titulo'] = $data['titulo'];
				$datos['descripcion'] = $data['descripcion'];
				$datos['fecha_crea'] = $data['fecha_crea'];
				$datos['fecha_edicion'] = $data['fecha_edicion'];
				$datos['pendiente'] = $data['pendiente'];
				array_push($arrayData, $datos);
			}
			echo json_encode($arrayData);
		}

		/*
			Recibe como parametro;
			Tipo de tarea (1=pendiente/0=completadas)
			Tipo de ordenamiento (1=por titulo, 2= última fecha de creación, 3=Última fecha de edición)
			link: http://localhost/restTareas/index.php?pendientes=1&tipoOrdenamiento=1
		*/	
		public static function getTaskByShortType( $pending, $orderingType, $pdo ){
			if ( $orderingType == 1 ) {
				$filterByOrdering = "order by titulo";
			} else if( $orderingType == 2 ){
				$filterByOrdering = "order by fecha_crea desc";
			} else if ( $orderingType == 3 ){
				$filterByOrdering = "order by fecha_edicion desc";
			}
			$arrayData = array();
			$sql = "SELECT * from tareas where pendiente=? $filterByOrdering;";
			$sentencia = $pdo->prepare( $sql );
			$sentencia->execute(array($pending));
			while ( $response = $sentencia->fetch(PDO::FETCH_ASSOC) ) {
				$data=array_map('utf8_encode',$response);
				$datos['idtarea'] = $data['idtarea'];
				$datos['titulo'] = $data['titulo'];
				$datos['descripcion'] = $data['descripcion'];
				$datos['fecha_crea'] = $data['fecha_crea'];
				$datos['fecha_edicion'] = $data['fecha_edicion'];
				$datos['pendiente'] = $data['pendiente'];
				array_push($arrayData, $datos);
			}
			echo json_encode($arrayData);
		}

		public function getTasksDone(){
			
		}

		public function editTask( $idtarea, $pdo ){
			$taskTitle = $this->title;
			$description = $this->description;
			$sql = "UPDATE tareas set titulo=?, descripcion=?, fecha_edicion=now() where idtarea=?";
			$sentencia = $pdo->prepare( $sql );
			$response = $sentencia->execute( [$taskTitle, $description, $idtarea] );
			if ($response === TRUE) {
				echo "se actualizó con éxito";
			} else{
				echo "algo salio mal";
			}
		}

		public function deleteTask(){

		}

	}

?>