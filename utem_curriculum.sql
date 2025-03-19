-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-01-2025 a las 03:43:05
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
-- Base de datos: `utem_curriculum`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `carrera_id` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `duracion_semanas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id`, `nombre`, `carrera_id`, `semestre`, `duracion_semanas`, `created_at`) VALUES
(3, 'Cálculo 1', 3, 4, 16, '2024-12-26 18:14:15'),
(8, 'Evaluación y Planificación del Fitness', 4, 1, 16, '2025-01-01 22:13:59'),
(9, 'Entrenamiento Funcional del Movimiento', 4, 1, 16, '2025-01-01 22:14:43'),
(10, 'Evaluación y Entrenamiento Motriz', 4, 1, 16, '2025-01-01 22:15:08'),
(11, 'Acondicionamiento Físico Formativo', 4, 1, 16, '2025-01-01 22:15:23'),
(12, 'Entrenamiento en Fitness', 4, 2, 16, '2025-01-01 22:15:37'),
(13, 'Selección y Adaptación de Ejercicios', 4, 2, 16, '2025-01-01 22:16:01'),
(14, 'Planificación Deporte Formativo', 4, 2, 16, '2025-01-01 22:17:10'),
(15, 'Entrenamiento Metabólico', 4, 2, 16, '2025-01-01 22:17:30'),
(16, 'Evaluación Poblaciones Especiales', 4, 3, 16, '2025-01-01 22:18:01'),
(17, 'Actividad Física para Personas con Discapacidad', 4, 3, 16, '2025-01-01 22:18:28'),
(18, 'Evaluación del Rendimiento Físico', 4, 3, 16, '2025-01-01 22:19:22'),
(19, 'Entrenamiento de Resistencia', 4, 3, 16, '2025-01-01 22:19:41'),
(20, 'Servicios Freelance', 4, 3, 16, '2025-01-01 22:19:56'),
(21, 'Primeros Auxilios', 4, 3, 16, '2025-01-01 22:20:06'),
(22, 'Programación de Actividad Física', 4, 4, 16, '2025-01-01 22:20:30'),
(23, 'Acondicionamiento Físico para Poblaciones Especiales', 4, 4, 16, '2025-01-01 22:20:56'),
(24, 'Orientaciones Nutricionales', 4, 4, 16, '2025-01-01 22:21:09'),
(25, 'Periodización Deportiva', 4, 4, 16, '2025-01-01 22:21:27'),
(26, 'Entrenamiento de Fuerza y Velocidad', 4, 4, 16, '2025-01-01 22:21:46'),
(27, 'Gestión de Planificación', 4, 4, 16, '2025-01-01 22:22:02'),
(28, 'Portafolio de Título', 4, 5, 16, '2025-01-01 22:22:16'),
(29, 'Práctica Profesional', 4, 5, 16, '2025-01-01 22:22:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atributos`
--

CREATE TABLE `atributos` (
  `id` int(11) NOT NULL,
  `tipo` enum('Dominio','Competencia','Resultado Aprendizaje') NOT NULL,
  `descripcion` text NOT NULL,
  `carrera_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `atributos`
--

INSERT INTO `atributos` (`id`, `tipo`, `descripcion`, `carrera_id`, `created_at`) VALUES
(2, 'Dominio', 'Uso del 2+2', 3, '2025-01-25 02:26:54'),
(3, 'Competencia', 'No copiar', 3, '2025-01-25 02:27:04'),
(4, 'Resultado Aprendizaje', 'Lograr calcular la masa del sol', 3, '2025-01-25 02:28:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `jornada` enum('Diurna','Vespertina') NOT NULL,
  `duracion_semestres` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `jornada`, `duracion_semestres`, `anio`, `created_at`) VALUES
(3, 'Química y Farmacia', 'Diurna', 12, 2024, '2024-12-26 18:13:24'),
(4, 'Preparador Físico', 'Diurna', 5, 2025, '2024-12-29 17:43:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `creditos` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `asignatura_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matrices_coherencia`
--

CREATE TABLE `matrices_coherencia` (
  `id` int(11) NOT NULL,
  `asignatura_id` int(11) NOT NULL,
  `dominio` varchar(100) NOT NULL,
  `competencia` varchar(100) NOT NULL,
  `resultado_aprendizaje` text NOT NULL,
  `actividad_curricular` text DEFAULT 'N/A',
  `criterios_logro` text NOT NULL,
  `contenidos` text DEFAULT NULL,
  `bibliografia` text DEFAULT NULL,
  `metodologias` text DEFAULT NULL,
  `evaluacion` text DEFAULT NULL,
  `evidencias` text DEFAULT NULL,
  `sct_chile` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matrices_coherencia`
--

INSERT INTO `matrices_coherencia` (`id`, `asignatura_id`, `dominio`, `competencia`, `resultado_aprendizaje`, `actividad_curricular`, `criterios_logro`, `contenidos`, `bibliografia`, `metodologias`, `evaluacion`, `evidencias`, `sct_chile`, `created_at`) VALUES
(1, 3, 'Uso de matemáticas', 'Ingenio', 'Que aprendan', 'Calcular XD', 'Sumar 2+2 = 4', 'Aritmética', '--', '--', '--', 'Lapiz y papel', 58, '2024-12-29 18:07:24'),
(2, 3, 'Uso del 2+2', 'No copiar', 'Lograr calcular la masa del sol', 'N/A', 'XD', 'XD', '', 'XD', 'XD?', '', 0, '2025-01-25 02:37:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Ivonne', 'test@test.cl', '$2y$10$8vomR.gu3T0uOwwkc.aPZOoFiullzF8UDCGdod.w4kvSGFB8J2Ngi', 1, '2024-12-13 01:12:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera_id` (`carrera_id`);

--
-- Indices de la tabla `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrera_id` (`carrera_id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignatura_id` (`asignatura_id`);

--
-- Indices de la tabla `matrices_coherencia`
--
ALTER TABLE `matrices_coherencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignatura_id` (`asignatura_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `atributos`
--
ALTER TABLE `atributos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matrices_coherencia`
--
ALTER TABLE `matrices_coherencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `atributos`
--
ALTER TABLE `atributos`
  ADD CONSTRAINT `atributos_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `asignaturas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `matrices_coherencia`
--
ALTER TABLE `matrices_coherencia`
  ADD CONSTRAINT `matrices_coherencia_ibfk_1` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
