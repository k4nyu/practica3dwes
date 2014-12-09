create table anuncio (
   idanuncio int NOT NULL auto_increment,
   titulo varchar(40) NOT NULL,
   precio varchar(100) NOT NULL,
   descripcion varchar(200) NOT NULL,
   ciudad varchar(20) NOT NULL,
   direccion varchar(200) NOT NULL,
   habitaciones int NOT NULL,
   servicios int NOT NULL,
   longitud varchar(40) NOT NULL,
   CONSTRAINT PK_id_anuncio PRIMARY KEY(idanuncio)
)