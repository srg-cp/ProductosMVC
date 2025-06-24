CREATE DATABASE IF NOT EXISTS `mvc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `mvc`;

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `precio` decimal(20,6) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `estado` enum('Habilitado','Deshabilitado') DEFAULT 'Habilitado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productos` (`id`, `nombre`, `precio`, `foto`, `estado`) VALUES
	(1, 'Mouse Logitech', 433.990000, 'uploads/productos/1.jpg', 'Habilitado'),
	(2, 'Teclado Mecanico', 123.000000, 'uploads/productos/2.jpeg', 'Habilitado'),
	(3, 'Gorilas', 12.000000, 'uploads/productos/3.jpeg', 'Habilitado');

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` enum('Habilitado','Deshabilitado') DEFAULT 'Habilitado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `nombre`, `estado`) VALUES
	(1, 'srgcp', 'sergio', 'Sergio Colque', 'Habilitado'),
	(2, 'diego', 'diego', 'Diego Castillo', 'Deshabilitado');

