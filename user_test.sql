CREATE DATABASE IF NOT EXISTS agentes_informaticos DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE user_test;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla HASH
--

CREATE TABLE IF NOT EXISTS HASH (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  hash varchar(80) NOT NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla USUARIO
--

CREATE TABLE IF NOT EXISTS USUARIO (
  id int(5) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(100) NOT NULL,
  apellido varchar(100) NOT NULL,
  sexo varchar(1) NOT NULL,
  email varchar(140) NOT NULL UNIQUE,
  password varchar(50) NOT NULL,
  foto varchar(255) DEFAULT NULL
);

INSERT INTO USUARIO (id,nombre,apellido,sexo,email,password,foto) VALUES(NULL,'admin','istrador','M','mail@mail.com','202cb962ac59075b964b07152d234b70',NULL);