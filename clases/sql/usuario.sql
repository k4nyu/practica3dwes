CREATE TABLE usuario (
    login VARCHAR(30) NOT NULL PRIMARY KEY,
    clave VARCHAR(40) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    fechaalta DATE NOT NULL,
    isactivo TINYINT(1) NOT NULL DEFAULT 0,
    isroot TINYINT(1) NOT NULL DEFAULT 0,
    rol ENUM('administrador', 'usuario') NOT NULL DEFAULT 'usuario',
    fechalogin DATETIME
)   engine=innodb charset=utf8 collate=utf8_unicode_ci;
