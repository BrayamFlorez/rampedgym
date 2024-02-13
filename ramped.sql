-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2024 a las 00:04:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ramped`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_inicio_membresia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `email`, `telefono`, `fecha_inicio_membresia`) VALUES
(1, 'Juan', 'Pérez', 'juan@example.com', '1234567890', '2024-02-01'),
(2, 'María', 'González', 'maria@example.com', '9876543210', '2022-11-20'),
(3, 'Carlos', 'López', 'carlos@example.com', '5551234567', '2023-02-05'),
(4, 'Ana', 'Martínez', 'ana@example.com', '4449876543', '2022-12-10'),
(5, 'Pedro', 'Sánchez', 'pedro@example.com', '6665554321', '2023-03-08'),
(6, 'Laura', 'Hernández', 'laura@example.com', '3332226789', '2023-01-30'),
(7, 'Sofía', 'Díaz', 'sofia@example.com', '7778881234', '2022-10-25'),
(8, 'Pablo', 'Ramírez', 'pablo@example.com', '9991112222', '2023-02-20'),
(14, 'Brayam', 'Florez', '', '3202387718', '2024-01-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_maquinas`
--

CREATE TABLE `inventario_maquinas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `precio_adquisicion` decimal(10,2) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_maquinas`
--

INSERT INTO `inventario_maquinas` (`id`, `nombre`, `marca`, `modelo`, `estado`, `fecha_adquisicion`, `precio_adquisicion`, `ubicacion`) VALUES
(1, 'Cinta de Correr', 'MarcaA', 'Modelo1', 'En funcionamiento', '2023-01-15', 2000.00, 'Sala de Cardio'),
(2, 'Máquina de Pesas', 'MarcaB', 'Modelo2', 'En reparación', '2022-11-20', 1500.00, 'Sala de Pesas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas`
--

CREATE TABLE `rutinas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `duracion_semanas` int(11) DEFAULT NULL,
  `objetivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutinas`
--

INSERT INTO `rutinas` (`id`, `nombre`, `descripcion`, `duracion_semanas`, `objetivo`) VALUES
(1, 'Rutina de Fuerza', 'Esta rutina se enfoca en el desarrollo de fuerza muscular utilizando principalmente ejercicios de levantamiento de pesas.', 12, 'Aumento de masa muscular'),
(2, 'Rutina de Cardio', 'Una rutina diseñada para mejorar la resistencia cardiovascular mediante ejercicios aeróbicos como correr, nadar o andar en bicicleta.', 8, 'Pérdida de peso'),
(3, 'Rutina de Entrenamiento Funcional', 'Esta rutina se centra en mejorar el rendimiento en actividades cotidianas mediante ejercicios que involucran movimientos naturales del cuerpo.', 10, 'Mejora de la funcionalidad y la movilidad'),
(4, 'Rutina de Yoga', 'Una serie de posturas y ejercicios de respiración diseñados para mejorar la flexibilidad, la fuerza y la relajación mental.', 6, 'Bienestar general'),
(5, 'Rutina de CrossFit', 'Una rutina de entrenamiento de alta intensidad que combina ejercicios de levantamiento de pesas, cardio y gimnasia para mejorar la resistencia y la fuerza.', 16, 'Mejora del rendimiento físico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contraseña`, `nombre_completo`, `correo_electronico`, `fecha_registro`) VALUES
(1, 'admin', '$2y$10$L9eB7SKAocs/NEN1SMZkXeQEs6jsdtltGHyu96crS6lQLCutpl0bC', 'Ruben Dario', 'Pedraza', '2024-02-12 16:42:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario_maquinas`
--
ALTER TABLE `inventario_maquinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `inventario_maquinas`
--
ALTER TABLE `inventario_maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
