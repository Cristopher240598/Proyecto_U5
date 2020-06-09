CREATE TABLE IF NOT EXISTS usuarios(
id                  int(255) auto_increment not null, 
nombre              varchar(50),
usuario             varchar(150),
contrasenia         varchar(255),
rol                 boolean,
imagen              varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS temas_discos(
id                  int(255) auto_increment not null, 
genero              varchar(255),
CONSTRAINT pk_temas_discos PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS temas_peliculas(
id                  int(255) auto_increment not null, 
genero              varchar(255),
CONSTRAINT pk_temas_peliculas PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS discos(
id                  int(255) auto_increment not null, 
id_temaDisco        int(255),
titulo              varchar(200),
artista             varchar(200),
disquera            varchar(200),
numeroCanciones     int(2),
imagen              varchar(255),
descripcion         mediumtext,
CONSTRAINT pk_tutores PRIMARY KEY(id),
CONSTRAINT fk_disco_tema FOREIGN KEY(id_temaDisco) REFERENCES temas_discos(id) ON DELETE CASCADE
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS peliculas(
id                  int(255) auto_increment not null, 
id_temaPelicula     int(255),
titulo              varchar(200),
reparto             varchar(200),
director            varchar(200),
imagen              varchar(255),
descripcion         mediumtext,
CONSTRAINT pk_peliculas PRIMARY KEY(id),
CONSTRAINT fk_pelicula_tema FOREIGN KEY(id_temaPelicula) REFERENCES temas_peliculas(id) ON DELETE CASCADE
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS audifonos(
id                  int(255) auto_increment not null,
marca               varchar(200),
modelo              varchar(200),
potenciaMaxima      int(5),
peso                int(4),
imagen              varchar(255),
descripcion         mediumtext,
CONSTRAINT pk_audifonos PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS productos(
id                  int(255) auto_increment not null,
nombre              varchar(200),
marca               varchar(200),
imagen              varchar(255),
descripcion         mediumtext,
CONSTRAINT pk_productos PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS comentarios_discos(
id                  int(255) auto_increment not null, 
id_disco            int(255),
id_usuario          int(255),
comentario          mediumtext,
CONSTRAINT pk_com_discos PRIMARY KEY(id),
CONSTRAINT fk_cdisco_disco FOREIGN KEY(id_disco) REFERENCES discos(id) ON DELETE CASCADE,
CONSTRAINT fk_cdisco_usuario FOREIGN KEY(id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS comentarios_peliculas(
id                  int(255) auto_increment not null, 
id_pelicula         int(255),
id_usuario          int(255),
comentario          mediumtext,
CONSTRAINT pk_com_peliculas PRIMARY KEY(id),
CONSTRAINT fk_cpelicula_pelicula FOREIGN KEY(id_pelicula) REFERENCES peliculas(id) ON DELETE CASCADE,
CONSTRAINT fk_cpelicula_usuario FOREIGN KEY(id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS comentarios_audifonos(
id                  int(255) auto_increment not null, 
id_audifonos        int(255),
id_usuario          int(255),
comentario          mediumtext,
CONSTRAINT pk_com_audifonos PRIMARY KEY(id),
CONSTRAINT fk_caudifonos_audifonos FOREIGN KEY(id_audifonos) REFERENCES audifonos(id) ON DELETE CASCADE,
CONSTRAINT fk_caudifonos_usuario FOREIGN KEY(id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS comentarios_productos(
id                  int(255) auto_increment not null, 
id_producto         int(255),
id_usuario          int(255),
comentario          mediumtext,
CONSTRAINT pk_com_producto PRIMARY KEY(id),
CONSTRAINT fk_cproducto_producto FOREIGN KEY(id_producto) REFERENCES productos(id) ON DELETE CASCADE,
CONSTRAINT fk_cproducto_usuario FOREIGN KEY(id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
)ENGINE=InnoDb;