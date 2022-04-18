<?php 

	class TaskModel {

		public function getTaskList($pdo,$parameter){
			$parameter = explode("||",$parameter);
			$idTask = $parameter[0];
			$datas = json_decode( file_get_contents( 'http://localhost/restTareas/index.php?pendientes='.$idTask ),true );
			echo '{"aaData":    '.json_encode($datas).'}';
		}

		public function getTaskListFilterByOrder($pdo,$parameter){
			$parameter = explode("||",$parameter);
			$idTask = $parameter[0];
			$orderingType = $parameter[1];
			$datas = json_decode( file_get_contents( 'http://localhost/restTareas/index.php?pendientes='.$idTask.'&tipoOrdenamiento='.$orderingType ),true );
			echo '{"aaData":    '.json_encode($datas).'}';
		}

		public function saveTask($pdo,$parameter){
			$parameter = explode("||",$parameter);
			$title = $parameter[0];
			$description = $parameter[1];
			$sql = "INSERT into tareas(titulo,descripcion) values(?,?)";
			$sentencia = $pdo->prepare( $sql );
			$response = $sentencia->execute( [$title, $description] );
			return ($response === TRUE)?true:false;
		}

		public function saveTaskEditing($pdo,$parameter){
			$parameter = explode("||",$parameter);
			$idTask = $parameter[0];
			$title = $parameter[1];
			$description = $parameter[2];
			$sql = "UPDATE tareas set titulo=?, descripcion=?, fecha_edicion=now() where idtarea=?";
			$sentencia = $pdo->prepare( $sql );
			$response = $sentencia->execute( [$title, $description, $idTask] );
			return ($response === TRUE)?true:false;
		}

		public function finishHomework($pdo,$id){
			$sql = "UPDATE tareas set pendiente=0 where idtarea=?";
			$sentencia = $pdo->prepare( $sql );
			$response = $sentencia->execute( [$id] );
			return ($response === TRUE)?true:false;
		}

		public function deleteTask($pdo,$id){
			$sql = "DELETE from tareas where idtarea=?";
			$sentencia = $pdo->prepare( $sql );
			$response = $sentencia->execute( [$id] );
			return ($response === TRUE)?true:false;
		}

		public function deleteAllCompletedTast($pdo){
			$sql = "DELETE from tareas where pendiente=?";
			$sentencia = $pdo->prepare( $sql );
			$response = $sentencia->execute( [0] );
			return ($response === TRUE)?true:false;
		}


	}

?>