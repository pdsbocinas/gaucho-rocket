drop database gauchorocket;
create database gauchorocket;
use gauchorocket;

create table centroMedico(
							id int primary key not null AUTO_INCREMENT,
                            nombre varchar(60),
                            ubicacion varchar(60)
							);
                            
insert into centroMedico(id,nombre,ubicacion)
				values	(1,'Santa Rosa','Buenos Aires'),
						(2,'Los Cedros','Cordoba'),
                        (3,'Ferreti','Santa Fe');
--        UPDATE centroMedico
--          SET id = 4, nombre = "la casa da Ann",ubicacion = "la matanza"
--        	WHERE id=1;
                
		
select * from centroMedico;




CREATE TABLE Cabina (
  id int(11) NOT NULL,
  descripcion varchar(255) DEFAULT NULL,
  porcentaje int(255) NOT NULL
);

CREATE TABLE Usuario (
  nombre_de_usuario varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  rol varchar(255) NOT NULL,
  id int(255) NOT NULL,
  nivel int(11) DEFAULT NULL
);

INSERT INTO Usuario (nombre_de_usuario, email, password, rol, id, nivel) VALUES
('pepe', 'pds.gomez@gmail.com', '123456', 'admin', 1, 1);

INSERT INTO Cabina (id, descripcion, porcentaje) VALUES
(1, 'general', 5),
(2, 'general', 5),
(3, 'familiar', 7),
(4, 'suite', 12);

CREATE TABLE Destino (
  id int(255) NOT NULL,
  destino varchar(255) DEFAULT NULL
);


INSERT INTO Destino (id, destino) VALUES
(1, 'Luna'),
(2, 'Marte');


CREATE TABLE Equipo (
  id int(11) NOT NULL,
  descripcion varchar(255) NOT NULL
);

INSERT INTO Equipo (id, descripcion) VALUES
(1, 'orbitales'),
(2, 'baja aceleracion'),
(3, 'alta aceleracion');

CREATE TABLE Reserva (
  id int(11) NOT NULL,
  codigo varchar(255) DEFAULT NULL,
  fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  vuelo_id int(11) NOT NULL,
  cabina_id int(11) DEFAULT NULL,
  servicio_id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  precio_final int(11) DEFAULT NULL
);

INSERT INTO Reserva (id, codigo, fecha, vuelo_id, cabina_id, servicio_id, usuario_id, precio_final) VALUES
(7, 'fse4634b', '2019-12-12 23:57:08', 1, 1, 1, 1, 123456),
(8, 'fse4634b', '2019-10-22 00:00:14', 1, 1, 1, 1, 123456),
(9, 'fse4634b', '2019-10-22 00:00:35', 1, 1, 1, 1, 123456),
(10, 'fse4634b', '2019-10-25 20:09:06', 1, 1, 1, 1, 123456),
(11, '3b05c626688e7f68336dad4e43fb7ee3', '2019-10-25 20:54:54', 1, 1, 1, 1, 123456);

CREATE TABLE Servicio (
  id int(11) NOT NULL,
  descripcion varchar(255) NOT NULL,
  porcentaje int(11) NOT NULL
);

INSERT INTO Servicio (id, descripcion, porcentaje) VALUES
(1, 'base', 10),
(2, 'suite', 15);


CREATE TABLE Tarifa (
  id int(11) NOT NULL,
  cantidad_de_dias int(11) NOT NULL,
  porcentaje int(11) NOT NULL
);


INSERT INTO Tarifa (id, cantidad_de_dias, porcentaje) VALUES
(1, 5, 10),
(2, 10, 15);

CREATE TABLE Vuelo (
  id int(11) NOT NULL,
  titulo varchar(255) DEFAULT NULL,
  precio int(11) DEFAULT NULL,
  fecha_salida date DEFAULT NULL,
  fecha_llegada date DEFAULT NULL,
  origen_id int(11) DEFAULT NULL,
  destino_id int(11) DEFAULT NULL,
  tarifa_id int(11) DEFAULT NULL,
  equipo_id int(11) DEFAULT NULL,
  descripcion varchar(255) DEFAULT NULL
);

INSERT INTO Vuelo (id, titulo, precio, fecha_salida, fecha_llegada, origen_id, destino_id, tarifa_id, equipo_id, descripcion) VALUES
(1, 'Vuelo a la luna', 1200, '2019-10-01', '2019-10-09', 2, 1, 1, 6, 'El vuelo mas groso del universo');
-- (2, 'Marte', 1200, '2019-10-01', '2019-10-09', 2, 1, 1, 6, 'El vuelo mas groso del universo'),
-- (3, 'Vuelo a todo el sistema solar', 1200, '2019-10-01', '2019-10-09', 2, 1, 1, 6, 'Nos vimo en disney');

ALTER TABLE Cabina
  ADD PRIMARY KEY (id);

ALTER TABLE Destino
  ADD PRIMARY KEY (id);

ALTER TABLE Equipo
  ADD PRIMARY KEY (id);

ALTER TABLE Reserva
  ADD PRIMARY KEY (id);

ALTER TABLE Usuario
  ADD PRIMARY KEY (id);

ALTER TABLE Reserva
  ADD PRIMARY KEY (cabina_id);

ALTER TABLE Reserva
  ADD PRIMARY KEY (id),  
  ADD KEY vuelo_id (vuelo_id),
  ADD KEY cabina_id (cabina_id),
  ADD KEY servicio_id (servicio_id);

--
-- Indices de la tabla Servicio
--
ALTER TABLE Servicio
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla Tarifa
--
ALTER TABLE Tarifa
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla Usuario
--
ALTER TABLE Usuario
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla Vuelo
--
ALTER TABLE Vuelo
  ADD PRIMARY KEY (id),
  ADD KEY origen_id (origen_id),
  ADD KEY destino_id (destino_id),
  ADD KEY tarifa_id (tarifa_id),
  ADD KEY equipo_id (equipo_id);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla Cabina
--
ALTER TABLE Cabina
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla Destino
--
ALTER TABLE Destino
  MODIFY id int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla Equipo
--
ALTER TABLE Equipo
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla Reserva
--
ALTER TABLE Reserva
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla Servicio
--
ALTER TABLE Servicio
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla Tarifa
--
ALTER TABLE Tarifa
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla Usuario
--
ALTER TABLE Usuario
  MODIFY id int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla Vuelo
--
ALTER TABLE Vuelo
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla Reserva
--
ALTER TABLE Reserva
  ADD CONSTRAINT reserva_ibfk_1 FOREIGN KEY (vuelo_id) REFERENCES Vuelo (id),
  ADD CONSTRAINT reserva_ibfk_2 FOREIGN KEY (cabina_id) REFERENCES Cabina (id),
  ADD CONSTRAINT reserva_ibfk_3 FOREIGN KEY (cabina_id) REFERENCES Cabina (id),
  ADD CONSTRAINT reserva_ibfk_4 FOREIGN KEY (servicio_id) REFERENCES Servicio (id),
  ADD CONSTRAINT reserva_ibfk_5 FOREIGN KEY (usuario_id) REFERENCES Usuario (id);

--
-- Filtros para la tabla Vuelo
--
ALTER TABLE Vuelo
  ADD CONSTRAINT vuelo_ibfk_1 FOREIGN KEY (origen_id) REFERENCES Destino (id),
  ADD CONSTRAINT vuelo_ibfk_2 FOREIGN KEY (destino_id) REFERENCES Destino (id),
  ADD CONSTRAINT vuelo_ibfk_3 FOREIGN KEY (tarifa_id) REFERENCES Tarifa (id),
  ADD CONSTRAINT vuelo_ibfk_4 FOREIGN KEY (equipo_id) REFERENCES Equipo (id);
  
  
