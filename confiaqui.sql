-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2023 a las 09:33:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `confiaqui`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendacitas`
--

CREATE TABLE `agendacitas` (
  `idcitas` int(11) NOT NULL,
  `IDUsuario` varchar(50) NOT NULL,
  `IDTerapeuta` varchar(50) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `agendacitas`
--

INSERT INTO `agendacitas` (`idcitas`, `IDUsuario`, `IDTerapeuta`, `Fecha`, `Hora`) VALUES
(1, 'utp0155388@alumno.utpuebla.edu.mx', 'PEFL0104027D0', '2023-11-01', '17:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroterapeuta`
--

CREATE TABLE `registroterapeuta` (
  `RFC` varchar(15) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Nombre` varchar(20) DEFAULT NULL,
  `Apellido_Paterno` varchar(20) DEFAULT NULL,
  `Apellido_Materno` varchar(20) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `CedulaProfesional` varchar(20) DEFAULT NULL,
  `IdentificacionOficial` blob NOT NULL,
  `ActaNacimiento` blob NOT NULL,
  `FotoProfesional` blob DEFAULT NULL,
  `Nacionalidad` varchar(20) DEFAULT NULL,
  `Especialidad` varchar(50) DEFAULT NULL,
  `LenguaMaterna` varchar(20) DEFAULT NULL,
  `HorasTrabajadas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registroterapeuta`
--

INSERT INTO `registroterapeuta` (`RFC`, `Correo`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Password`, `CedulaProfesional`, `IdentificacionOficial`, `ActaNacimiento`, `FotoProfesional`, `Nacionalidad`, `Especialidad`, `LenguaMaterna`, `HorasTrabajadas`) VALUES
('PEFL0104027D0', 'perezdelafuentesarai@gmail.com', 'Linda Saraí', 'Pérez', 'De La Fuente', '$2y$10$.VwUJUlC280JQ1Gp6zyvXem.UF3tMkfRTInoMeg4RMGOT5GC5kyY6', '1234568', '', '', NULL, 'México', 'Psicología clínica', 'idioma1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrousuario`
--

CREATE TABLE `registrousuario` (
  `CorreoElectronico` varchar(50) NOT NULL,
  `Nombre` varchar(20) DEFAULT 'Unknown',
  `Apellido_Paterno` varchar(20) DEFAULT NULL,
  `Apellido_Materno` varchar(20) DEFAULT NULL,
  `Password` varchar(60) NOT NULL,
  `Nacionalidad` varchar(20) DEFAULT NULL,
  `IdiomaPreferente` varchar(20) NOT NULL,
  `PreferenciaPronombre` varchar(10) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `RolUsuario` varchar(5) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registrousuario`
--

INSERT INTO `registrousuario` (`CorreoElectronico`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Password`, `Nacionalidad`, `IdiomaPreferente`, `PreferenciaPronombre`, `FechaNacimiento`, `RolUsuario`) VALUES
('ebervi117@gmail.com', 'Eber Omar', 'Villegas ', 'Fragoso', '$2y$10$hr.AXWTteW/.Urmt6mA2pe3NbhvF9DI0f', 'México', 'idioma1', 'El', '2001-09-01', 'User'),
('mesii10@gmail.com', 'Lionel', 'Messi', 'Cutini', '$2y$10$5IYKWjVcxivxcxBa14lS0upNpowapxY3E', 'Argentina', 'idioma1', 'El', '1990-10-01', 'User'),
('utp0155388@alumno.utpuebla.edu.mx', 'Eber Omar', 'Villegas', 'Fragoso', '$2y$10$SNcbeFRetVARYmhv9MaAj.KmeyC.SmtZ4', 'México', 'idioma1', 'él', '2001-09-01', 'User');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agendacitas`
--
ALTER TABLE `agendacitas`
  ADD PRIMARY KEY (`idcitas`),
  ADD KEY `fk_AgendaCitas_RegistroTerapeuta` (`IDTerapeuta`),
  ADD KEY `fk_AgendaCitas_RegistroUsuario1` (`IDUsuario`);

--
-- Indices de la tabla `registroterapeuta`
--
ALTER TABLE `registroterapeuta`
  ADD PRIMARY KEY (`RFC`);

--
-- Indices de la tabla `registrousuario`
--
ALTER TABLE `registrousuario`
  ADD PRIMARY KEY (`CorreoElectronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agendacitas`
--
ALTER TABLE `agendacitas`
  MODIFY `idcitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agendacitas`
--
ALTER TABLE `agendacitas`
  ADD CONSTRAINT `fk_AgendaCitas_RegistroTerapeuta` FOREIGN KEY (`IDTerapeuta`) REFERENCES `registroterapeuta` (`RFC`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AgendaCitas_RegistroUsuario1` FOREIGN KEY (`IDUsuario`) REFERENCES `registrousuario` (`CorreoElectronico`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
