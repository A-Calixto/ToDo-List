<?php

  include_once('conexion.php');
  include_once('clases/ClassTareas.php');

  switch( $_SERVER['REQUEST_METHOD'] ){
    case 'POST':
      $title = $_POST['titulo'];
      $description = $_POST['descripcion'];
      $obj = new Homework($title,$description);
      $obj->saveNewTask($pdo);
      break;

    case 'GET':
      $pending = $_GET['pendientes'];
      if ( isset( $_GET['tipoOrdenamiento'] ) ) {
        $orderingType = $_GET['tipoOrdenamiento'];
        Homework::getTaskByShortType( $pending, $orderingType, $pdo );
      } else{
        Homework::getPendingTask( $pending, $pdo );
      }
      break;

    case 'PUT':
      $idtarea = $_GET['id'];
      $title = $_GET['titulo'];
      $description = $_GET['descripcion'];
      $obj = new Homework($title,$description);
      $obj->editTask($idtarea,$pdo);
      break;

  }

?>