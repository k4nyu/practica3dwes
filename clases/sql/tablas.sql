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
);

CREATE TABLE foto (
idfoto int NOT NULL auto_increment,
idanuncio int NOT NULL,    
urlfoto varchar(255)NOT NULL,
CONSTRAINT PK_id_foto PRIMARY KEY(idfoto),
CONSTRAINT FK_id_anuncio FOREIGN KEY (idanuncio) REFERENCES anuncio(idanuncio) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `NewTable` (
`login`  varchar(255) NOT NULL ,
`clave`  varchar(255) NOT NULL ,
`nombre`  varchar(255) NOT NULL ,
`apellido`  varchar(255) NOT NULL ,
`email`  varchar(255) NOT NULL ,
`fechaalta`  date NOT NULL ,
`isactivo`  tinyint(1) NOT NULL DEFAULT 0 ,
`isroot`  tinyint(1) NOT NULL DEFAULT 0 ,
`rol`  enum('administrador','usuario') NOT NULL DEFAULT 'usuario' ,
`fechalogin`  datetime NULL ,
PRIMARY KEY (`login`)
)engine=innodb charset=utf8 collate=utf8_unicode_ci;