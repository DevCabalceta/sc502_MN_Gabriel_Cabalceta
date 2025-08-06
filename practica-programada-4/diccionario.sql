-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-08-2025 a las 07:35:35
-- Versión del servidor: 8.0.41
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `diccionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras`
--

CREATE TABLE `palabras` (
  `id` int NOT NULL,
  `palabra` varchar(255) NOT NULL,
  `definicion` text,
  `ejemplo` text,
  `audio_url` text,
  `fecha_guardado` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `palabras`
--

INSERT INTO `palabras` (`id`, `palabra`, `definicion`, `ejemplo`, `audio_url`, `fecha_guardado`) VALUES
(1, 'Auto', 'An automobile.', 'My brother is an auto mechanic.', '', '2025-08-05 23:30:22'),
(2, 'Doctor', 'A physician; a member of the medical profession; one who is trained and licensed to heal the sick or injured. The final examination and qualification may award a doctor degree in which case the post-nominal letters are D.O., DPM, M.D., DMD, DDS, in the US or MBBS in the UK.', 'If you still feel unwell tomorrow, see your doctor.', 'https://api.dictionaryapi.dev/media/pronunciations/en/doctor-uk.mp3', '2025-08-05 23:31:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `palabras`
--
ALTER TABLE `palabras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `palabras`
--
ALTER TABLE `palabras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
