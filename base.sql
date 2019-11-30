drop schema gauchorocket;
create database gauchorocket;
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
  ADD id int(11) AUTO_INCREMENT, AUTO_INCREMENT=2;
  
INSERT INTO  Avion  ( id ,  modelo ,  matricula ) VALUES
(1, 'Aguila','AA1'),
(2, 'Aguilucho','BA8'),
(3, 'Calandria','O1'),
(4, 'Canario','BA13'),
(5, 'Carancho','BA4'),
(6, 'Colibri','O3'),
(7, 'Condor','AA2'),
(8, 'Guanaco','AA4'),
(9, 'Halcon','AA3'),
(10, 'Zorzal','BA1');


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
(1, 'Orbital', 20, 30, 50, 1),
(2, 'baja aceleracion', 25	, 50, 125, 2),
(3, 'alta aceleracion', NULL, 88, NULL, 5),
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
(2, 'suite', 15),
(3,'auriculares',3);

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
('nico', 'nico@gmail.com', '123456', 'x', 5, 2, '5983d85c15deda0eca25d78218a4fde7');

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
(1, 'Vuelo a la luna', 1200, '2019-11-15', '2020-02-02', 2, 1, 1, 'El vuelo mas groso del universo', 1),
(3, 'Vuelo a la luna', 1200, '2019-11-15', '2020-02-02', 2, 1, 1, 'El vuelo mas groso del universo',5),
(2, 'sarasa', 1200000, '2019-11-15', '2019-11-30', 1, 2, 1, 'blablbala', 2);

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




/*-----------------------------------------------	INSERCION DE ALGUNOS DATOS	----------------------------------------------------------*/
-- paso1 buscar la reserva
	select * 
    from reserva 
	where codigo='QWERTY'  & usuario_id=5;
-- paso1.1 si no está paga,mostrar un modal que le indique que tiene que abonar la reserva

-- paso 2 esta reserva esta " PAGA "...por lo tanto se puede ir al paso 
INSERT INTO reserva(id,codigo,fecha,vuelo_id,servicio_id,usuario_id,precio_final,pagada,tipo_de_cabina)
		VALUES  (1,'QWERTY','2019-11-20',1,1,5,25000,1,'G'),
        (2,'QWERTY','2015-01-01',1,1,5,25000,0,'G'),
        (3,'QWERTY','2015-01-01',1,1,5,25000,0,'G'),
        (5,'ABM','2015-01-01',1,1,5,25000,1,'F'),
        (4,'QWE5RTY','2015-01-01',1,1,5,25000,1,'G');

update reserva
set fecha='2019-11-22' -- acà iria un valor que lo generamos en php,sumando 
where id=1;

select * from reserva;
-- paso 3
 
 

/*-----------------------------------------------	CONSULTA DE ASIENTOS	----------------------------------------------------------*/
-- le pasamos el vuelo_id asociado al codigo ---ejemplo 1
SELECT tipo_de_cabina,count(*)
FROM reserva
WHERE vuelo_id=1 && tipo_de_cabina = 'G'
GROUP BY tipo_de_cabina;
-- para ese vuelo,hay 4 asientos ocupados en general
-- ahora debemos traer el general del avion o del equipo

SELECT e.general
FROM  avion a join equipo e on a.id=e.avion_id
			  join vuelo v on v.avion_id=a.id;
-- insert en la tabla pasandole el id del avion

-- linea importante si no no me deja actualizar la tabla s
SET SQL_SAFE_UPDATES = 0;

-- esta sentencia me va a actualizar la tabla de generales para un tipo de avion 
-- el 21 va a ser la variable que me van a mandar desde php con autoincremental o algo asi 
update equipo
	join avion ON equipo.avion_id= avion.id
    join vuelo ON vuelo.avion_id=avion.id
set equipo.general=21 -- acà iria un valor que lo generamos en php,sumando 
where avion.id=1;

-- para pasarle los numeros,lo que haremos es ,realizar un switch en php que realice una consulta para las suites,otra
-- para las generales y otra para las familiares...de acuerdo al idvuelo,codigo rever, id_reserva
-- agarramos ese codigo_de_cabina y lo sumamos a ese valor de la consulta que me trae los disponibles (boton final de checkin) 

select *
from equipo
where equipo.avion_id=1;


-- antes de este paso tendria que elegir los asientos 
-- de manera individual

/*-----------------------------------------------RESTAR EN LA CAPACIDAD DEL equipo para ese avion----------------------------------------------------------------------------*/
SET @cant_cabinaG_porReserva = 	(	SELECT /*tipo_de_cabina,*/count(*)
									FROM reserva
									WHERE vuelo_id=1 && tipo_de_cabina = 'G'
									GROUP BY tipo_de_cabina
                                    );

select @cant_cabinaG_porReserva;



create table asiento(		
							id int (11) primary key,
							asiento varchar(10),
							vuelo_id  int(11) NOT NULL,
                            usuario_id int(11)                            
						);

ALTER TABLE   asiento ADD FOREIGN KEY (vuelo_id) REFERENCES Vuelo(id);
-- ALTER TABLE   asiento ADD FOREIGN KEY (usuario_id) REFERENCES Usuario(id);

-- insert de registros                         
INSERT INTO asiento(id,asiento,vuelo_id,usuario_id)
		VALUES (5,'G2',1,5),
				(6,'G2',1,6),
                (4,'G2',3,8),
                (2,'G2',1,9),
                (8,'G2',2,8),
                (10,'G2',2,8);

-- update asiento 
-- set asiento='g8',vuelo_id=2 
-- where vuelo_id=1 && asiento='g2';
        
	
--  borrado de registros 

 delete from asiento
 where asiento ='G8'&& vuelo_id=2;

select * from asiento;



-- desde la pestaña donde se elige el asiento me tienen que mandar el vuelo,la reserva y el usuario---pero mas importante es el usuario y la reserva lo verificamos en el where
select u.estado,v.fecha_salida,u.nombre_de_usuario,u.id,r.tipo_de_cabina,a.asiento,O.destino as Origen,D.destino as Destino,v.id as vuelo_id
from usuario u join reserva r on u.id=r.usuario_id
join asiento a on a.vuelo_id=r.vuelo_id 
join vuelo v on a.vuelo_id=v.id
join Destino O on O.id = v.origen_id
join Destino D on D.id = v.destino_id
where r.pagada=1 && r.id=1;

select MAX(cantidad) from
	(
	select count(*) cantidad
	from reserva
	where pagada=1 
	group by tipo_de_cabina 
	order by cantidad desc
    )as grande ;
        
        -- tasa de ocupacion por viaje significa que cuantos asientos ocupados hay ,un porcentaje sobre la cantidad de vuelo
	select sum(cantidad),count(vuelo_id) from(
				select vuelo_id,count(*) cantidad
				from asiento
				group by vuelo_id)as cantidad;

select sum(cantidad),count(cantidad) from(
				select count(vuelo_id) cantidad,vuelo.avion_id,equipo.id equipo
				from asiento join vuelo on asiento.vuelo_id=vuelo.id
                join equipo on  vuelo.avion_id=equipo.avion_id
				 group by vuelo_id)as cantidad;
                 
                 select vuelo_id,count(vuelo_id) cantidad,vuelo.avion_id as id_avion,equipo.id equipo,equipo.general,equipo.familiar,equipo.suite,(equipo.general+equipo.familiar+equipo.suite) as totalEquipo
				from asiento join vuelo on asiento.vuelo_id=vuelo.id
                join equipo on  vuelo.avion_id=equipo.avion_id
				 group by vuelo_id;

				 select *
				from asiento join vuelo on asiento.vuelo_id=vuelo.id
                join equipo on  vuelo.avion_id=equipo.avion_id
				 group by vuelo_id
                 having count(*);
                 
                 
                 select u.estado,v.fecha_salida,u.nombre_de_usuario,u.id,r.tipo_de_cabina,a.asiento,O.destino as Origen,D.destino as Destino,v.id as vuelo_id,u.email,r.id as reserva_id
              from usuario u join reserva r on u.id=r.usuario_id
              join asiento a on a.vuelo_id=r.vuelo_id 
              join vuelo v on a.vuelo_id=v.id
              join Destino O on O.id = v.origen_id
              join Destino D on D.id = v.destino_id
              where r.pagada=1 && r.id=1; 