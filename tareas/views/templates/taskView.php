<div class="form-group col-md-12 col-sm-12 col-xs-12">
	<div class="form-group row">
		<div class="col-md-8 col-sm-8 col-xs-12">
			<button id="btnGetPendingTask" data-ope='1' class="btn btn-default"> Tareas pendientes </button>
			<button id="btnGetFinishTask" data-ope='0' class="btn btn-default"> Tareas completadas </button>	
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<button id="btnAddTask" class="btn btn-success col-md-offset-6" style="display: none;">
				<i class="fa fa-plus"></i> Agregar tarea
			</button>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<button id="btnDeleteAllTask" class="btn btn-danger col-md-offset-6" style="display: none;">
				<i class="fa fa-trash"></i> Borrar todo
			</button>
		</div>
	</div>
	<hr>

	<div class="form-group row">
		<div class="col-md-8 col-sm-8 col-xs-12">
			<div id="containerFilterByOrder" class="col-md-6 col-sm-6 col-xs-12"></div>
		</div>
	</div>
	<hr>

	<div id="modal_homework" class="modal fade" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-xs">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div id="modal_title">
						<h3>Favor de completar el formulario</h3>
					</div>
				</div>
				<div class="modal-body" id="modal_body">
					<div id="taskForm" class="row">
						<div class="form-group">
							<label class="control-label col-md-12 col-sm-12 col-xs-12">Título: </label>
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<input class="form-control" type="text" name="taskTitle" id="taskTitle" autocomplete="off">
								<span class="help-block required"></span>
								<span id="spanNameTitleRemove"></span>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-12 col-sm-12 col-xs-12">Descripción: </label>
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<textarea class="form-control" type="text" name="taskDescription" id="taskDescription" autocomplete="off" rows="3"></textarea>
								<span class="help-block required"></span>
								<span id="spanNameDescriptionRemove"></span>
							</div>
								
						</div>
					</div>
				</div>
				<div class="modal-footer" id="modal_footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancelar </button>
					<button id="btnSaveAddTask" class="btn btn-success col-md-offset-7">
						<i class="fa fa-save"></i> Guardar
					</button>
				</div>
			</div>
		</div>
	</div>

	<div>
		<table id="DT_pendingTask" class="table table-condensed table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id</th>
					<th>Título</th>
					<th>Descripción</th>
					<th>Creado</th>
					<th>Editado</th>
					<th> _____________ </th>
				</tr>
			</thead>
			
		</table>
	</div>
</div>