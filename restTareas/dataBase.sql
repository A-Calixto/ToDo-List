--- Crear base de datos llamada calixto

create table tareas(
	idtarea integer AUTO_INCREMENT not null,
	titulo varchar(30),
	descripcion text,
	fecha_crea timestamp default now(),
	fecha_edicion datetime,
	fecha_fin datetime,
	pendiente boolean default true,
	primary key(idtarea)
);