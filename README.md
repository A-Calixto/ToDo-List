# ToDo-List
1 .- Alojar la carpeta tareas en ambiente local.
2 .- Poner la carpeta restTareas en el mismo ambiente/repositorio que la carpeta tareas.
3 .- Crear base de datos llamada calixto en mysql.
4 .- Crear tabla tareas en mysql
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


Links para el servicio rest con postman:

Obtener tareas: 
Donde pendientes = 0 igual a tareas completadas y pendientes = 1 igual a tareas pendientes
http://localhost/restTareas/index.php?pendientes=1

Obtener tareas por tipo de ordenamiento:
Donde pendientes = 0 igual a tareas completadas y pendientes = 1 igual a tareas pendientes y
tipoOrdenamiento (1=ordenar por titulo, 2= ordenar por última fecha de creación y 3=Ordenar por última fecha de edición)
http://localhost/restTareas/index.php?pendientes=1&tipoOrdenamiento=1

Insertar nueva tareas:
Se mandan los parametros/variables (titulo y descripcion) seleccionando body y form-data en postman
http://localhost/restTareas/index.php
