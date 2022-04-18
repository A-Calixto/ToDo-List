$(function(){
	var taskType; /* variable booleana: 1 = tareas pendientes, 0 = tareas completadas */
	$("#contenedor").off("click","#task_View");
	$("#contenedor").on("click","#task_View",homework);

	Tooltip();
	homework();

	function homework(){
		var template = $("#task_View").data('ope');
		var data = loadTemplate(template).responseText;
		$("#templateContainer").empty().append(data);

		$("#btnGetPendingTask").off("click");
		$("#btnGetPendingTask").on("click",this,function(){
			$("#btnGetPendingTask").removeClass().addClass('btn btn-primary');
			$("#btnGetFinishTask").removeClass().addClass('btn btn-default');
			$("#btnAddTask").attr('style','display:block');
			$("#btnDeleteAllTask").attr('style','display:none');
			$("#containerFilterByOrder").empty().append('<select id="taskOrdering"><option value="">  Ordenar por  </option><option value="1"> titulo (Orden alfabético) </option><option value="2"> Fecha de creación (Última creación) </option><option value="3"> Fecha de edición (Última edición) </option></select>');
			$("#taskOrdering").multiselect({
				onChange: function(option,checked,select){
					var selected=$(option).val();
					if (selected != "") showTable(selected);
				}
			});
			taskType = 1;
			showTable();
		});
		$("#btnGetFinishTask").off("click");
		$("#btnGetFinishTask").on("click",this,function(){
			$("#btnGetPendingTask").removeClass().addClass('btn btn-default');
			$("#btnGetFinishTask").removeClass().addClass('btn btn-primary');
			$("#btnAddTask").attr('style','display:none');
			$("#btnDeleteAllTask").attr('style','display:block');
			$("#containerFilterByOrder").empty().append('<select id="taskOrdering"><option value="">  Ordenar por  </option><option value="1"> titulo (Orden alfabético) </option><option value="2"> Fecha de creación (Última creación) </option><option value="3"> Fecha de edición (Última edición) </option></select>');
			$("#taskOrdering").multiselect({
				onChange: function(option,checked,select){
					var selected=$(option).val();
					if (selected != "") showTable(selected);
				}
			});
			taskType = 0;
			showTable();
		});	
	}

	/*
		showTable: muestra la lista de tareas
		Recibe como parametro el tipo de ordenamiento, si la variable es null, no hay ordenamiento
		verifica el estatus de la variable taskType para filtrar por el tipo de tarea (1=pendiente/0=competado)
	*/
	function showTable( ordering = null ){
		var caseType = (ordering == null)?'getTaskList':'getTaskListFilterByOrder';
			
		$('#DT_pendingTask').dataTable({
			dom:'Bfrtip',
			lengthMenu    : [[ 10, 25, 50, -1 ],[ '10 filas', '25 filas', '50 filas', 'Todos' ]],
			buttons:[
				'pageLength',
				'excelHtml5'
			],
			responsive: true,
			iDisplayLength:10,
			bDestroy: true,
			bProcessing: true,
			ordering: false,
			oLanguage :languaje_table,
			ajax: {
				url :"../../tareas/controllers/TaskController.php",
				type:"POST",
				data:{
					casee:caseType,
					parameter:taskType+'||'+ordering
				}
			},
			aoColumnDefs: [

				{
					aTargets: [0],
					bSortable : false,
					mData: 'idtarea'
				},
				{
					aTargets: [1],
					bSortable : false,
					mData: 'titulo'
				},
				{
					aTargets: [2],
					bSortable : false,
					mData : 'descripcion'
				},
				{
					aTargets: [3],
					bSortable : false,
					mData: 'fecha_crea'
				},
				{
					aTargets: [4],
					bSortable : false,
					mData: 'fecha_edicion'
				},
				{
					aTargets: [5],
					bSortable : false,
					mData: function(data){
						if (taskType == 1) {
							var btnEdit = '<button class="btn btn-info btn-sm editTask" data-ope="'+data.idtarea+'||'+data.titulo+'||'+data.descripcion+'" data-toggle="tooltip" data-placement="top" data-original-title="Editar"> <i class="fa fa-edit"></i></button>';
							var btnDone = '<button class="btn btn-success btn-sm finishHomework" data-ope="'+data.idtarea+'" data-toggle="tooltip" data-placement="top" data-original-title="Terminar"> <i class="fa fa-check"></i></button>';
						} else{
							var btnEdit = "";
							var btnDone = "";
						}
						var btnDelete = '<button class="btn btn-danger btn-sm deleteTask" data-ope="'+data.idtarea+'" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"> <i class="fa fa-trash"></i></button>';	
						return btnDelete+' '+btnEdit+' '+btnDone;
					}
				}
					

			],
			fnRowCallback: function(nRow,aData,iDisplayIndex){
			},
			drawCallback: function( settings ){
				Tooltip();
			}
		});

		$("#btnAddTask").off("click");
		$("#btnAddTask").on("click",addTask);

		$("#btnDeleteAllTask").off("click");
		$("#btnDeleteAllTask").on("click",deleteAllCompletedTask);

		$('#DT_pendingTask').off("click",".deleteTask");
		$('#DT_pendingTask').on("click",".deleteTask",this,deleteTask);

		$('#DT_pendingTask').off("click",".editTask");
		$('#DT_pendingTask').on("click",".editTask",this,editTask);

		$("#DT_pendingTask").off("click",".finishHomework");
		$("#DT_pendingTask").on("click",".finishHomework",this,finishHomework);

	}


	function addTask(){
		emptyTaskForm();
		$("#modal_homework").modal('show');

		$("#btnSaveAddTask").off("click");
		$("#btnSaveAddTask").on("click",function (){
			var isCorrect = validateTaskForm();
			if (!isCorrect) {
				$.ajax({
					type:'POST',
					url:'../../tareas/controllers/TaskController.php',
					data: {
						casee:'saveTask',
						parameter: $("#taskTitle").val()+'||'+$("#taskDescription").val()
					},
					success: function(data){
						if (data==1) {
							$('#DT_pendingTask').dataTable()._fnAjaxUpdate();
							$("#modal_homework").modal('hide');
							emptyTaskForm();
							Swal.fire('Se agregó una nueva tarea','','success');
						} else{
							Swal.fire('Ocurrió un error... No se pudo agregar la nueva tarea','','error');
						}
					}
				});
			} else{
				Swal.fire('Falta llenar el formulario','','warning');
			}
		});
	}

	function editTask(){
		var parameters = $(this).data('ope').split("||");
		emptyTaskForm();
		var idTask = parameters[0];
		$("#taskTitle").val( parameters[1] );
		$("#taskDescription").val( parameters[2] );
		$("#modal_homework").modal('show');

		$("#btnSaveAddTask").off("click");
		$("#btnSaveAddTask").on("click",function (){
			var isCorrect = validateTaskForm();
			Swal.fire({
				title: '¿Estás seguro que quieres actualizar la información?',
				showDenyButton: true,
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si',
				cancelButtonText: 'No',
			}).then((result) => {
				if (result.value != undefined && result.value) {
					if (!isCorrect) {
						$.ajax({
							type:'POST',
							url:'../../tareas/controllers/TaskController.php',
							data: {
								casee:'saveTaskEditing',
								parameter: idTask+'||'+$("#taskTitle").val()+'||'+$("#taskDescription").val()
							},
							success: function(data){
								if (data==1) {
									$('#DT_pendingTask').dataTable()._fnAjaxUpdate();
									$("#modal_homework").modal('hide');
									emptyTaskForm();
									Swal.fire('Se actualizó la información de la tarea '+idTask+' con éxito','','success');
								} else{
									Swal.fire('Ocurrió un error... No se pudo actualizar la información','','error');
								}
							}
						});
					} else{
						Swal.fire('Falta llenar el formulario','','warning');
					}
				}
			})
					
		});
	}

	function finishHomework(){
		var idTask = $(this).data('ope');
		Swal.fire({
			title: '¿Quieres dar por terminada esta la tarea?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
			// denyButtonText: 'No',
		}).then((result) => {
			if (result.value != undefined && result.value) {
				$.ajax({
					type:'POST',
					url:'../../tareas/controllers/TaskController.php',
					data: {
						casee:'finishHomework',
						parameter: idTask
					},
					success: function(data){
						if (data==1) {
							$('#DT_pendingTask').dataTable()._fnAjaxUpdate();
							Swal.fire('La tarea '+idTask+' se realizó con éxito','','success');
						} else{
							Swal.fire('Ocurrió un error... No se pudo terminar la tarea','','error');
						}
					}
				});
			}
		})
	}

	function deleteTask(){
		var idTask = $(this).data('ope');
		Swal.fire({
			title: '¿Seguro que quieres eliminar esta tarea?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
			// denyButtonText: 'No',
		}).then((result) => {
			if (result.value != undefined && result.value) {
				$.ajax({
					type:'POST',
					url:'../../tareas/controllers/TaskController.php',
					data: {
						casee:'deleteTask',
						parameter: idTask
					},
					success: function(data){
						if (data==1) {
							$('#DT_pendingTask').dataTable()._fnAjaxUpdate();
							Swal.fire('La tarea se eliminó con éxito','','success');
						} else{
							Swal.fire('Ocurrió un error... No se pudo eliminar la tarea','','error');
						}
					}
				});
			}
		})
	}

	function deleteAllCompletedTask(){
		Swal.fire({
			title: '¿Seguro que quiere eliminar todas las tareas completadas?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
			// denyButtonText: 'No',
		}).then((result) => {
			if (result.value != undefined && result.value) {
				$.ajax({
					type:'POST',
					url:'../../tareas/controllers/TaskController.php',
					data: {
						casee:'deleteAllCompletedTast'
					},
					success: function(data){
						if (data==1) {
							$('#DT_pendingTask').dataTable()._fnAjaxUpdate();
							Swal.fire('Se eliminaron todas las tareas completadas con éxito','','success');
						} else{
							Swal.fire('Ocurrió un error... No se pudieron eliminar las tareas completadas','','error');
						}
					}
				});
			}
		})
	}


	function emptyTaskForm(){
		$("#taskTitle").val("");
		$("#taskDescription").val("");
		var parentInputtaskTitle=$("#taskTitle").parent().parent();
		$(parentInputtaskTitle).removeClass().addClass("form-group");
		$(parentInputtaskTitle).children('div').children('span.required').text("").hide();
		$(parentInputtaskTitle).children('div').children('span#spanNameTitleRemove').removeClass();

		var parentInputTaskDescription=$("#taskDescription").parent().parent();
		$(parentInputTaskDescription).removeClass().addClass("form-group");
		$(parentInputTaskDescription).children('div').children('span.required').text("").hide();
		$(parentInputTaskDescription).children('div').children('span#spanNameDescriptionRemove').removeClass();
	}

	function validateTaskForm(){
		errors=false;

		var parentInputtaskTitle=$("#taskTitle").parent().parent();
		if ( $("#taskTitle").val() == "" ) {
			$(parentInputtaskTitle).attr("class","form-group has-error has-feedback");
			$(parentInputtaskTitle).children('div').children('span.required').text("campo requerido").show();
			$(parentInputtaskTitle).children('div').children('span#spanNameTitleRemove').attr("class","glyphicon glyphicon-remove form-control-feedback").show();

			errors=true;
		} else{
			$(parentInputtaskTitle).attr("class","form-group has-success has-feedback");
			$(parentInputtaskTitle).children('div').children('span.required').hide();
			$(parentInputtaskTitle).children('div').children('span#spanNameTitleRemove').attr("class","glyphicon glyphicon-ok form-control-feedback");
		}

		var parentInputTaskDescription=$("#taskDescription").parent().parent();
		if ( $("#taskDescription").val() == "" ) {
			$(parentInputTaskDescription).attr("class","form-group has-error has-feedback");
			$(parentInputTaskDescription).children('div').children('span.required').text("campo requerido").show();
			$(parentInputTaskDescription).children('div').children('span#spanNameDescriptionRemove').attr("class","glyphicon glyphicon-remove form-control-feedback").show();

			errors=true;
		} else{
			$(parentInputTaskDescription).attr("class","form-group has-success has-feedback");
			$(parentInputTaskDescription).children('div').children('span.required').hide();
			$(parentInputTaskDescription).children('div').children('span#spanNameDescriptionRemove').attr("class","glyphicon glyphicon-ok form-control-feedback");
		}

		return errors;
	}


	
});



