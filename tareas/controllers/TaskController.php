<?php
include_once('../conexion.php');
include_once('../models/TaskModel.php');

$taskObj = new TaskModel();

$case=$_POST['casee'];

switch ($case){

	case 'getTaskList':
		$parameter=$_POST['parameter'];
		$datas = $taskObj->getTaskList($pdo,$parameter);
		echo $datas;
		break;

	case 'getTaskListFilterByOrder':
		$parameter=$_POST['parameter'];
		$datas = $taskObj->getTaskListFilterByOrder($pdo,$parameter);
		echo $datas;
		break;

	case 'saveTask':
		$parameter=$_POST['parameter'];
		$response = $taskObj->saveTask($pdo,$parameter);
		echo $response;
		break;

	case 'saveTaskEditing':
		$parameter = $_POST['parameter'];
		$response = $taskObj->saveTaskEditing($pdo,$parameter);
		echo $response;
		break;

	case 'finishHomework':
		$parameter = $_POST['parameter'];
		$response = $taskObj->finishHomework($pdo,$parameter);
		echo $response;
		break;

	case 'deleteTask':
		$parameter = $_POST['parameter'];
		$response = $taskObj->deleteTask($pdo,$parameter);
		echo $response;
		break;

	case 'deleteAllCompletedTast':
		$response = $taskObj->deleteAllCompletedTast($pdo);
		echo $response;
		break;

	default:
		echo "No se encontró el tipo de caso";
		break;
}


?>