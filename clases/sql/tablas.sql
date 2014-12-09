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

CREATE TABLE foto (
idfoto int NOT NULL auto_increment,
idanuncio int NOT NULL,    
urlfoto varchar(255)NOT NULL,
CONSTRAINT PK_id_foto PRIMARY KEY(idfoto),
CONSTRAINT FK_id_anuncio FOREIGN KEY (idanuncio) REFERENCES anuncio(idanuncio) ON DELETE CASCADE ON UPDATE CASCADE
)