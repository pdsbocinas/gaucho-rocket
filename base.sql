drop schema gauchorocket;
create schema gauchorocket;
use gauchorocket;

--
-- Base de datos: `gauchoRocket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Avion`
--

CREATE TABLE Avion (
  id int(11)  PRIMARY KEY ,
  modelo varchar(255) DEFAULT NULL,
  matricula varchar(255) DEFAULT NULL
);

--
-- Volcado de datos para la tabla `Avion`
--
ALTER TABLE Avion
  MODIFY id int(11) AUTO_INCREMENT, AUTO_INCREMENT=2;
  
INSERT INTO  Avion  ( id ,  modelo ,  matricula ) VALUES
(1, 'gol', 'ac256');

SELECT * FROM aVION;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  centroMedico 
--

CREATE TABLE  centroMedico  (
   id  int(11)  PRIMARY KEY,
   nombre  varchar(255) DEFAULT NULL,
   ubicacion  varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE   centroMedico  
MODIFY   id   int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Volcado de datos para la tabla  centroMedico 
--

INSERT INTO  centroMedico  ( id ,  nombre ,  ubicacion ) VALUES
(1, 'Centro Medico Buenos Aires', 'CABA'),

(2, 'Centro Medico Ankara', 'Mordor');

INSERT INTO  centroMedico  ( id ,  nombre ,  ubicacion ) VALUES
(null, 'Centro Medico Buenos Aires', 'tu vieja'),
(null, 'Centro Medico Buenos Aires', 'tu vieja2'),
(null, 'Centro Medico Buenos Aires', 'tu vieja3');

SELECT * FROM centroMedico;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  Destino 
--

CREATE TABLE  Destino  (
   id  int(255) PRIMARY KEY,
   destino  varchar(255) DEFAULT NULL
);

ALTER TABLE   Destino  
  MODIFY   id   int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Volcado de datos para la tabla  Destino 
--

INSERT INTO  Destino  ( id ,  destino ) VALUES
(1, 'Luna'),
(2, 'Marte');



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  Equipo 
--

CREATE TABLE  Equipo  (
   id  int(11) PRIMARY KEY,
   tipo  varchar(255) NOT NULL,
   general  int(11) DEFAULT NULL,
   familiar  int(11) DEFAULT NULL,
   suite  int(11) DEFAULT NULL,
   avion_id  int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE   Equipo  
  MODIFY   id   int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Volcado de datos para la tabla  Equipo 
--

INSERT INTO  Equipo  ( id ,  tipo ,  general ,  familiar ,  suite ,  avion_id ) VALUES
(1, 'orbitales', 20, 30, 50, NULL),
(2, 'baja aceleracion', NULL, NULL, NULL, NULL),
(3, 'alta aceleracion', NULL, NULL, NULL, NULL),
(4, 'orbitales', NULL, NULL, NULL, NULL),
(5, 'baja aceleracion', NULL, NULL, NULL, NULL),
(6, 'alta aceleracion', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  Reserva 
-- 

CREATE TABLE  Reserva  (
   id  int(11) PRIMARY KEY,
   codigo  varchar(255) DEFAULT NULL,
   fecha  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   vuelo_id  int(11) NOT NULL,
   servicio_id  int(11) NOT NULL,
   usuario_id  int(11) NOT NULL,
   precio_final  int(11) DEFAULT NULL,
   pagada  tinyint(1) DEFAULT NULL,
   tipo_de_cabina  varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE   Reserva  
  MODIFY   id   int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  Servicio 
--

CREATE TABLE  Servicio  (
   id  int(11) PRIMARY KEY,
   descripcion  varchar(255) NOT NULL,
   porcentaje  int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE   Servicio  
  MODIFY   id   int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Volcado de datos para la tabla  Servicio 
--

INSERT INTO  Servicio  ( id ,  descripcion ,  porcentaje ) VALUES
(1, 'base', 10),
(2, 'suite', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  Tarifa 
--

CREATE TABLE    Tarifa    (
   id int(11) PRIMARY KEY,
   cantidad_de_dias  int(11) NOT NULL,
   porcentaje  int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE   Tarifa  
  MODIFY   id   int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Volcado de datos para la tabla  Tarifa 
--

INSERT INTO  Tarifa  ( id ,  cantidad_de_dias ,  porcentaje ) VALUES
(1, 5, 10),
(2, 10, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  Turno 
--

CREATE TABLE  Turno  (
   usuario_id  int(11) NOT NULL ,
   centro_id  int(11) NOT NULL,
   horario  timestamp NULL DEFAULT NULL,
   id  int(11) PRIMARY KEY
);

ALTER TABLE   Turno  
  MODIFY   id   int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Volcado de datos para la tabla  Turno 
-- 
INSERT INTO  Turno  ( usuario_id ,  centro_id ,  horario ,  id ) VALUES
(1, 2, '2019-11-09 17:55:56', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  Usuario 
--

CREATE TABLE  Usuario  (
   nombre_de_usuario  varchar(255) NOT NULL ,
   email  varchar(255) NOT NULL,
   password  varchar(255) NOT NULL,
   rol  varchar(255) NOT NULL,
   id  int(255)  PRIMARY KEY,
   nivel  varchar(255) DEFAULT NULL,
   estado  varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE   Usuario  
  MODIFY   id   int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Volcado de datos para la tabla  Usuario 
--

INSERT INTO  Usuario  ( nombre_de_usuario ,  email ,  password ,  rol ,  id ,  nivel ,  estado ) VALUES
('pablo', 'pds.gomez@gmail.com', '123456', 'admin', 1, '2', 'activo'),
('nico', 'nico@gmail.com', '123456', 'x', 5, NULL, '5983d85c15deda0eca25d78218a4fde7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla  Vuelo 
--

CREATE TABLE  Vuelo  (
   id  int(11) PRIMARY KEY,
   titulo  varchar(255) DEFAULT NULL,
   precio  int(11) DEFAULT NULL,
   fecha_salida  date DEFAULT NULL,
   fecha_llegada  date DEFAULT NULL,
   origen_id  int(11) DEFAULT NULL,
   destino_id  int(11) DEFAULT NULL,
   tarifa_id  int(11) DEFAULT NULL,
   descripcion  varchar(255) DEFAULT NULL,
   avion_id  int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE   Vuelo  
  MODIFY   id   int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Volcado de datos para la tabla  Vuelo 
--

INSERT INTO   Vuelo  ( id ,  titulo ,  precio ,  fecha_salida ,  fecha_llegada ,  origen_id ,  destino_id ,  tarifa_id ,  descripcion ,  avion_id ) VALUES
(1, 'Vuelo a la luna', 1200, '2020-01-01', '2020-02-02', 2, 1, 1, 'El vuelo mas groso del universo', NULL),
(2, 'sarasa', 1200000, '2019-11-01', '2019-11-30', 1, 2, 1, 'blablbala', 1);


-- ALTER TABLE Orders ADD FOREIGN KEY (PersonID) REFERENCES Persons(PersonID);

-- ----------------------- AGREGADO DE CLAVES FORANEAS ----------------------------------------------

-- TURNO
ALTER TABLE Turno ADD FOREIGN KEY (usuario_id) REFERENCES Usuario(id);
ALTER TABLE Turno ADD FOREIGN KEY (centro_id) REFERENCES centroMedico(id);

-- VUELO

ALTER TABLE Vuelo ADD FOREIGN KEY (origen_id) REFERENCES Destino(id);
ALTER TABLE Vuelo ADD FOREIGN KEY (destino_id) REFERENCES Destino(id);
ALTER TABLE Vuelo ADD FOREIGN KEY (tarifa_id) REFERENCES Tarifa(id);
ALTER TABLE Vuelo ADD FOREIGN KEY (avion_id) REFERENCES Avion(id);

	


ALTER TABLE   Reserva ADD FOREIGN KEY (vuelo_id) REFERENCES Vuelo(id);
ALTER TABLE   Reserva ADD FOREIGN KEY (servicio_id) REFERENCES Servicio(id);
ALTER TABLE   Reserva ADD FOREIGN KEY (usuario_id) REFERENCES Usuario(id);

--
-- Filtros para la tabla   Turno  
--
ALTER TABLE Turno ADD FOREIGN KEY (  usuario_id  ) REFERENCES Usuario(id);
ALTER TABLE Turno ADD FOREIGN KEY (centro_id) REFERENCES centroMedico(  id  );

--
-- Filtros para la tabla   Vuelo  
--

ALTER TABLE Vuelo ADD FOREIGN KEY (avion_id) REFERENCES Avion (id);
ALTER TABLE   Vuelo ADD FOREIGN KEY (origen_id) REFERENCES Destino (id);
ALTER TABLE   Vuelo ADD FOREIGN KEY (destino_id) REFERENCES Destino (id);
ALTER TABLE   Vuelo ADD FOREIGN KEY (tarifa_id) REFERENCES Tarifa (id);