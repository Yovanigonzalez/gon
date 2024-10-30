-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2024 a las 07:36:43
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `distribuidora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas_recibidas`
--

CREATE TABLE `cajas_recibidas` (
  `id` int(11) NOT NULL,
  `caja` int(11) NOT NULL,
  `tapa` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cajas_recibidas`
--

INSERT INTO `cajas_recibidas` (`id`, `caja`, `tapa`, `fecha`) VALUES
(1, 100, 100, '2024-10-19 18:14:13'),
(2, 50, 34, '2024-10-19 18:14:34'),
(3, 10, 10, '2024-10-19 18:15:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_enviada`
--

CREATE TABLE `caja_enviada` (
  `id` int(11) NOT NULL,
  `caja` int(11) NOT NULL,
  `tapa` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja_enviada`
--

INSERT INTO `caja_enviada` (`id`, `caja`, `tapa`, `fecha`) VALUES
(2, 10, 10, '2024-10-19 18:15:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canastilla`
--

CREATE TABLE `canastilla` (
  `id` int(11) NOT NULL,
  `caja` int(11) NOT NULL,
  `tapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `canastilla`
--

INSERT INTO `canastilla` (`id`, `caja`, `tapa`) VALUES
(1, -50, -50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `direccion`) VALUES
(1, 'FABRICIA ROMERO', 'GC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudores`
--

CREATE TABLE `deudores` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `cantidad_deuda` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudores`
--

INSERT INTO `deudores` (`id`, `id_cliente`, `nombre_cliente`, `direccion`, `cantidad_deuda`) VALUES
(1, 1, 'FABRICIA ROMERO', 'GC', '2492.32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudores_cajas`
--

CREATE TABLE `deudores_cajas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `cantidad_cajas` int(11) DEFAULT NULL,
  `cantidad_tapas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudores_cajas`
--

INSERT INTO `deudores_cajas` (`id`, `id_cliente`, `nombre_cliente`, `direccion`, `cantidad_cajas`, `cantidad_tapas`) VALUES
(1, 1, 'FABRICIA ROMERO', 'GC', 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_nombre` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `kilos` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `producto_id`, `producto_nombre`, `stock`, `kilos`) VALUES
(1, 1, 'RTC-10', 30, '21.21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_con_fecha`
--

CREATE TABLE `entradas_con_fecha` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_nombre` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `kilos` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas_con_fecha`
--

INSERT INTO `entradas_con_fecha` (`id`, `producto_id`, `producto_nombre`, `stock`, `kilos`, `fecha`) VALUES
(1, 1, 'RTC-10', 100, '100.10', '2024-10-30 05:57:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_menudencia`
--

CREATE TABLE `entradas_menudencia` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_nombre` varchar(255) NOT NULL,
  `kilos` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas_menudencia`
--

INSERT INTO `entradas_menudencia` (`id`, `producto_id`, `producto_nombre`, `kilos`) VALUES
(1, 1, 'ALA NATURAL', '0.89');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_menudencia_con_fecha`
--

CREATE TABLE `entradas_menudencia_con_fecha` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_nombre` varchar(255) NOT NULL,
  `kilos` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas_menudencia_con_fecha`
--

INSERT INTO `entradas_menudencia_con_fecha` (`id`, `producto_id`, `producto_nombre`, `kilos`, `fecha`) VALUES
(1, 1, 'ALA NATURAL', '89.23', '2024-10-30 05:57:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `descripcion`, `monto`, `fecha`, `ruta_archivo`, `fecha_registro`) VALUES
(1, 'pc', '8900.00', '2024-10-30', '', '2024-10-30 06:20:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_deudas`
--

CREATE TABLE `historial_deudas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `deuda_restante` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial_deudas`
--

INSERT INTO `historial_deudas` (`id`, `id_cliente`, `nombre_cliente`, `direccion`, `deuda_restante`, `fecha`) VALUES
(1, 1, 'FABRICIA ROMERO', 'GC', '10000.00', '2024-10-30 00:20:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_cajas_tapas`
--

CREATE TABLE `movimientos_cajas_tapas` (
  `id_movimiento` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cajas` int(11) NOT NULL,
  `tapas` int(11) NOT NULL,
  `fecha_movimiento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `subtotal_vendido` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deuda_pendiente` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `caja_deudora` int(11) NOT NULL DEFAULT 0,
  `tapa_deudora` int(11) NOT NULL DEFAULT 0,
  `caja_enviada` int(11) NOT NULL DEFAULT 0,
  `tapa_enviada` int(11) NOT NULL DEFAULT 0,
  `caja_pendiente` int(11) NOT NULL DEFAULT 0,
  `tapa_pendiente` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `estatus` varchar(20) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `cliente`, `direccion`, `subtotal_vendido`, `deuda_pendiente`, `total`, `caja_deudora`, `tapa_deudora`, `caja_enviada`, `tapa_enviada`, `caja_pendiente`, `tapa_pendiente`, `created_at`, `estatus`) VALUES
(1, 'FABRICIA ROMERO', 'GC', '2658.32', '0.00', '2658.32', 0, 0, 1, 1, 1, 1, '2024-10-30 05:58:23', 'pendiente'),
(2, 'FABRICIA ROMERO', 'GC', '400.00', '2658.32', '3058.32', 1, 1, 1, 1, 2, 2, '2024-10-30 06:18:54', 'entregado'),
(3, 'FABRICIA ROMERO', 'GC', '4450.00', '3058.32', '7508.32', 2, 2, 1, 1, 3, 3, '2024-10-30 06:19:33', 'entregado'),
(4, 'FABRICIA ROMERO', 'GC', '4984.00', '7508.32', '12492.32', 3, 3, 1, 1, 4, 4, '2024-10-30 06:19:55', 'entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `estatus` varchar(20) DEFAULT 'PENDIENTE',
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_lista`
--

CREATE TABLE `pedido_lista` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `cantidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`) VALUES
(1, 'RTC-10'),
(2, 'R10'),
(3, 'PRODUCTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_menudencia`
--

CREATE TABLE `productos_menudencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_menudencia`
--

INSERT INTO `productos_menudencia` (`id`, `nombre`) VALUES
(1, 'ALA NATURAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_nota`
--

CREATE TABLE `productos_nota` (
  `id` int(11) NOT NULL,
  `nota_id` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `piezas` int(11) NOT NULL DEFAULT 0,
  `kilos` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estatus` varchar(20) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_nota`
--

INSERT INTO `productos_nota` (`id`, `nota_id`, `producto`, `piezas`, `kilos`, `precio`, `subtotal`, `estatus`) VALUES
(1, 1, 'RTC-10', 20, '28.89', '54.00', '1560.06', 'pendiente'),
(2, 1, 'ALA NATURAL', 0, '12.34', '89.00', '1098.26', 'pendiente'),
(3, 2, 'ALA NATURAL', 0, '20.00', '20.00', '400.00', 'entregado'),
(4, 3, 'RTC-10', 50, '50.00', '89.00', '4450.00', 'entregado'),
(5, 4, 'ALA NATURAL', 0, '56.00', '89.00', '4984.00', 'entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id` int(11) NOT NULL,
  `nota_id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `piezas` int(11) NOT NULL,
  `kilos` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('admin','empleado','super_admin') NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `contrasena`, `rol`, `fecha_creacion`) VALUES
(3, 'super@gmail.com', '$2y$10$3HmJ04bPeVNgFOmc9KtBaeIu1s3.Q2LZ0JwEHsSATS0YDItfpkTsu', 'super_admin', '2024-10-19 18:03:34'),
(4, 'admin@gmail.com', '$2y$10$z4AnQF004XtWaXjDY/YBTOeLGrR7UYpWdfeeNPdgIqgPbJkDs2KJe', 'admin', '2024-10-19 18:03:43'),
(5, 'mostrador@gmail.com', '$2y$10$KC3.cIb7iHY807bTc5dgT.aZKMVl1aPPho8MGg7iUbj/6/R85cfta', 'empleado', '2024-10-19 18:03:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cajas_recibidas`
--
ALTER TABLE `cajas_recibidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_enviada`
--
ALTER TABLE `caja_enviada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `canastilla`
--
ALTER TABLE `canastilla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deudores`
--
ALTER TABLE `deudores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `deudores_cajas`
--
ALTER TABLE `deudores_cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `entradas_con_fecha`
--
ALTER TABLE `entradas_con_fecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `entradas_menudencia`
--
ALTER TABLE `entradas_menudencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `entradas_menudencia_con_fecha`
--
ALTER TABLE `entradas_menudencia_con_fecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_deudas`
--
ALTER TABLE `historial_deudas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `movimientos_cajas_tapas`
--
ALTER TABLE `movimientos_cajas_tapas`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_lista`
--
ALTER TABLE `pedido_lista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_menudencia`
--
ALTER TABLE `productos_menudencia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `productos_nota`
--
ALTER TABLE `productos_nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_id` (`nota_id`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_id` (`nota_id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cajas_recibidas`
--
ALTER TABLE `cajas_recibidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `caja_enviada`
--
ALTER TABLE `caja_enviada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `canastilla`
--
ALTER TABLE `canastilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `deudores`
--
ALTER TABLE `deudores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `deudores_cajas`
--
ALTER TABLE `deudores_cajas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas_con_fecha`
--
ALTER TABLE `entradas_con_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas_menudencia`
--
ALTER TABLE `entradas_menudencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas_menudencia_con_fecha`
--
ALTER TABLE `entradas_menudencia_con_fecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial_deudas`
--
ALTER TABLE `historial_deudas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `movimientos_cajas_tapas`
--
ALTER TABLE `movimientos_cajas_tapas`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_lista`
--
ALTER TABLE `pedido_lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos_menudencia`
--
ALTER TABLE `productos_menudencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos_nota`
--
ALTER TABLE `productos_nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `deudores`
--
ALTER TABLE `deudores`
  ADD CONSTRAINT `deudores_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `entradas_con_fecha`
--
ALTER TABLE `entradas_con_fecha`
  ADD CONSTRAINT `entradas_con_fecha_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `entradas_menudencia`
--
ALTER TABLE `entradas_menudencia`
  ADD CONSTRAINT `entradas_menudencia_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos_menudencia` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `entradas_menudencia_con_fecha`
--
ALTER TABLE `entradas_menudencia_con_fecha`
  ADD CONSTRAINT `entradas_menudencia_con_fecha_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos_menudencia` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial_deudas`
--
ALTER TABLE `historial_deudas`
  ADD CONSTRAINT `historial_deudas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `deudores` (`id`);

--
-- Filtros para la tabla `movimientos_cajas_tapas`
--
ALTER TABLE `movimientos_cajas_tapas`
  ADD CONSTRAINT `movimientos_cajas_tapas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `pedido_lista`
--
ALTER TABLE `pedido_lista`
  ADD CONSTRAINT `pedido_lista_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos_nota`
--
ALTER TABLE `productos_nota`
  ADD CONSTRAINT `productos_nota_ibfk_1` FOREIGN KEY (`nota_id`) REFERENCES `notas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD CONSTRAINT `salidas_ibfk_1` FOREIGN KEY (`nota_id`) REFERENCES `notas` (`id`),
  ADD CONSTRAINT `salidas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
