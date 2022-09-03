-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-09-2022 a las 14:44:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'Equipos Electromecánicos', '2017-12-21 20:53:29'),
(2, 'Taladros', '2017-12-21 20:53:29'),
(3, 'Andamios', '2017-12-21 20:53:29'),
(4, 'Generadores de energía', '2017-12-21 20:53:29'),
(5, 'Equipos para construcción', '2017-12-21 20:53:29'),
(6, 'Martillos mecánicos', '2017-12-21 23:06:40'),
(7, 'Laptops', '2021-06-30 04:13:19'),
(8, 'INYECTORES', '2022-09-01 02:05:26'),
(9, 'NOI ME GUSTA', '2022-09-01 03:02:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) NOT NULL DEFAULT 0,
  `ultima_compra` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `fecha`) VALUES
(3, 'Juan Villegas', 2147483647, 'juan@hotmail.com', '(300) 341-2345', 'Calle 23 # 45 - 56', '1980-11-02', 7, '2018-02-06 17:47:02', '2018-02-06 22:47:02'),
(4, 'Pedro Pérez', 2147483647, 'pedro@gmail.com', '(399) 876-5432', 'Calle 34 N33 -56', '1970-08-07', 25, '2022-08-31 21:55:50', '2022-09-01 02:55:50'),
(5, 'Miguel Murillo', 325235235, 'miguel@hotmail.com', '(254) 545-3446', 'calle 34 # 34 - 23', '1976-03-04', 32, '2017-12-26 17:27:13', '2017-12-27 04:38:13'),
(6, 'Margarita Londoño', 34565432, 'margarita@hotmail.com', '(344) 345-6678', 'Calle 45 # 34 - 56', '1976-11-30', 14, '2017-12-26 16:26:51', '2021-06-30 04:19:52'),
(7, 'Julian Ramirez', 786786545, 'julian@hotmail.com', '(675) 674-5453', 'Carrera 45 # 54 - 56', '1980-04-05', 14, '2017-12-26 17:26:28', '2017-12-26 22:26:28'),
(8, 'Stella Jaramillo', 65756735, 'stella@gmail.com', '(435) 346-3463', 'Carrera 34 # 45- 56', '1956-06-05', 18, '2022-09-02 12:15:58', '2022-09-02 17:15:58'),
(9, 'Eduardo López', 2147483647, 'eduardo@gmail.com', '(534) 634-6565', 'Carrera 67 # 45sur', '1978-03-04', 12, '2017-12-26 17:25:33', '2017-12-26 22:25:33'),
(10, 'Ximena Restrepo', 436346346, 'ximena@gmail.com', '(543) 463-4634', 'calle 45 # 23 - 45', '1956-03-04', 18, '2017-12-26 17:25:08', '2017-12-26 22:25:08'),
(11, 'David Guzman', 43634643, 'david@hotmail.com', '(354) 574-5634', 'carrera 45 # 45 ', '1967-05-04', 10, '2017-12-26 17:24:50', '2017-12-26 22:24:50'),
(12, 'Gonzalo Pérez', 436346346, 'gonzalo@yahoo.com', '(235) 346-3464', 'Carrera 34 # 56 - 34', '1967-08-09', 24, '2017-12-25 17:24:24', '2017-12-27 00:30:12'),
(13, 'Jaqueline QR', 55555, 'jaque@youmail.com', '(222) 333-4444', 'Av. Brasil 23', '1992-05-05', 0, NULL, '2021-07-01 18:41:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(1, 1, '101', 'Aspiradora Industrial ', 'vistas/img/productos/101/105.png', 13, 1000, 1200, 2, '2017-12-24 01:11:04'),
(2, 1, '102', 'Plato Flotante para Allanadora', 'vistas/img/productos/102/940.jpg', 5, 4500, 6300, 4, '2022-09-02 17:15:58'),
(3, 1, '103', 'Compresor de Aire para pintura', 'vistas/img/productos/103/763.jpg', 7, 3000, 4200, 13, '2022-09-02 17:15:58'),
(4, 1, '104', 'Cortadora de Adobe sin Disco ', 'vistas/img/productos/104/957.jpg', 16, 4000, 5600, 4, '2017-12-26 15:03:22'),
(5, 1, '105', 'Cortadora de Piso sin Disco ', 'vistas/img/productos/105/630.jpg', 13, 1540, 2156, 7, '2017-12-26 15:03:22'),
(6, 1, '106', 'Disco Punta Diamante ', 'vistas/img/productos/106/635.jpg', 15, 1100, 1540, 5, '2017-12-26 15:04:38'),
(7, 1, '107', 'Extractor de Aire ', 'vistas/img/productos/107/848.jpg', 12, 1540, 2156, 8, '2017-12-26 15:04:11'),
(8, 1, '108', 'Guadañadora ', 'vistas/img/productos/108/163.jpg', 13, 1540, 2156, 7, '2017-12-26 15:03:52'),
(9, 1, '109', 'Hidrolavadora Eléctrica ', 'vistas/img/productos/109/769.jpg', 15, 2600, 3640, 5, '2022-09-01 02:57:59'),
(10, 1, '110', 'Hidrolavadora Gasolina', 'vistas/img/productos/110/582.jpg', 18, 2210, 3094, 2, '2022-09-01 02:57:59'),
(11, 1, '111', 'Motobomba a Gasolina', 'vistas/img/productos/default/anonymous.png', 20, 2860, 4004, 0, '2017-12-21 21:56:28'),
(12, 1, '112', 'Motobomba El?ctrica', 'vistas/img/productos/default/anonymous.png', 20, 2400, 3360, 0, '2017-12-21 21:56:28'),
(13, 1, '113', 'Sierra Circular ', 'vistas/img/productos/default/anonymous.png', 20, 1100, 1540, 0, '2017-12-21 21:56:28'),
(14, 1, '114', 'Disco de tugsteno para Sierra circular', 'vistas/img/productos/default/anonymous.png', 20, 4500, 6300, 0, '2017-12-21 21:56:28'),
(15, 1, '115', 'Soldador Electrico ', 'vistas/img/productos/default/anonymous.png', 20, 1980, 2772, 0, '2017-12-21 21:56:28'),
(16, 1, '116', 'Careta para Soldador', 'vistas/img/productos/default/anonymous.png', 20, 4200, 5880, 0, '2017-12-21 21:56:28'),
(17, 1, '117', 'Torre de iluminacion ', 'vistas/img/productos/default/anonymous.png', 20, 1800, 2520, 0, '2017-12-21 21:56:28'),
(18, 2, '201', 'Martillo Demoledor de Piso 110V', 'vistas/img/productos/default/anonymous.png', 20, 5600, 7840, 0, '2017-12-21 21:56:28'),
(19, 2, '202', 'Muela o cincel martillo demoledor piso', 'vistas/img/productos/default/anonymous.png', 20, 9600, 13440, 0, '2017-12-21 21:56:28'),
(20, 2, '203', 'Taladro Demoledor de muro 110V', 'vistas/img/productos/default/anonymous.png', 20, 3850, 5390, 0, '2017-12-21 21:56:28'),
(21, 2, '204', 'Muela o cincel martillo demoledor muro', 'vistas/img/productos/default/anonymous.png', 20, 9600, 13440, 0, '2017-12-21 21:56:28'),
(22, 2, '205', 'Taladro Percutor de 1/2 Madera y Metal', 'vistas/img/productos/default/anonymous.png', 20, 8000, 11200, 0, '2017-12-21 22:28:24'),
(23, 2, '206', 'Taladro Percutor SDS Plus 110V', 'vistas/img/productos/default/anonymous.png', 20, 3900, 5460, 0, '2017-12-21 21:56:28'),
(24, 2, '207', 'Taladro Percutor SDS Max 110V (Mineria)', 'vistas/img/productos/default/anonymous.png', 20, 4600, 6440, 0, '2017-12-21 21:56:28'),
(25, 3, '301', 'Andamio colgante', 'vistas/img/productos/default/anonymous.png', 20, 1440, 2016, 0, '2017-12-21 21:56:28'),
(26, 3, '302', 'Distanciador andamio colgante', 'vistas/img/productos/default/anonymous.png', 20, 1600, 2240, 0, '2017-12-21 21:56:28'),
(27, 3, '303', 'Marco andamio modular ', 'vistas/img/productos/default/anonymous.png', 20, 900, 1260, 0, '2017-12-21 21:56:28'),
(28, 3, '304', 'Marco andamio tijera', 'vistas/img/productos/default/anonymous.png', 20, 100, 140, 0, '2017-12-21 21:56:28'),
(29, 3, '305', 'Tijera para andamio', 'vistas/img/productos/default/anonymous.png', 20, 162, 226, 0, '2017-12-21 21:56:28'),
(30, 3, '306', 'Escalera interna para andamio', 'vistas/img/productos/default/anonymous.png', 20, 270, 378, 0, '2017-12-21 21:56:28'),
(31, 3, '307', 'Pasamanos de seguridad', 'vistas/img/productos/default/anonymous.png', 20, 75, 105, 0, '2017-12-21 21:56:28'),
(32, 3, '308', 'Rueda giratoria para andamio', 'vistas/img/productos/default/anonymous.png', 20, 168, 235, 0, '2017-12-21 21:56:28'),
(33, 3, '309', 'Arnes de seguridad', 'vistas/img/productos/default/anonymous.png', 20, 1750, 2450, 0, '2017-12-21 21:56:28'),
(34, 3, '310', 'Eslinga para arnes', 'vistas/img/productos/default/anonymous.png', 20, 175, 245, 0, '2017-12-21 21:56:28'),
(35, 3, '311', 'Plataforma Met?lica', 'vistas/img/productos/default/anonymous.png', 20, 420, 588, 0, '2017-12-21 21:56:28'),
(36, 4, '401', 'Planta Electrica Diesel 6 Kva', 'vistas/img/productos/default/anonymous.png', 20, 3500, 4900, 0, '2017-12-21 21:56:28'),
(37, 4, '402', 'Planta Electrica Diesel 10 Kva', 'vistas/img/productos/default/anonymous.png', 20, 3550, 4970, 0, '2017-12-21 21:56:28'),
(38, 4, '403', 'Planta Electrica Diesel 20 Kva', 'vistas/img/productos/default/anonymous.png', 20, 3600, 5040, 0, '2017-12-21 21:56:28'),
(39, 4, '404', 'Planta Electrica Diesel 30 Kva', 'vistas/img/productos/default/anonymous.png', 20, 3650, 5110, 0, '2017-12-21 21:56:28'),
(40, 4, '405', 'Planta Electrica Diesel 60 Kva', 'vistas/img/productos/default/anonymous.png', 9, 3700, 5180, 11, '2022-09-02 17:15:58'),
(41, 4, '406', 'Planta Electrica Diesel 75 Kva', 'vistas/img/productos/default/anonymous.png', 20, 3750, 5250, 0, '2017-12-21 21:56:28'),
(42, 4, '407', 'Planta Electrica Diesel 100 Kva', 'vistas/img/productos/default/anonymous.png', 20, 3800, 5320, 0, '2017-12-21 21:56:28'),
(43, 4, '408', 'Planta Electrica Diesel 120 Kva', 'vistas/img/productos/default/anonymous.png', 20, 3850, 5390, 0, '2017-12-21 21:56:28'),
(44, 5, '501', 'Escalera de Tijera Aluminio ', 'vistas/img/productos/default/anonymous.png', 20, 350, 490, 0, '2017-12-21 21:56:28'),
(45, 5, '502', 'Extension Electrica ', 'vistas/img/productos/default/anonymous.png', 20, 370, 518, 0, '2017-12-21 21:56:28'),
(46, 5, '503', 'Gato tensor', 'vistas/img/productos/default/anonymous.png', 20, 380, 532, 0, '2017-12-21 21:56:28'),
(47, 5, '504', 'Lamina Cubre Brecha ', 'vistas/img/productos/default/anonymous.png', 20, 380, 532, 0, '2017-12-21 21:56:28'),
(48, 5, '505', 'Llave de Tubo', 'vistas/img/productos/default/anonymous.png', 20, 480, 672, 0, '2022-09-01 02:57:59'),
(49, 5, '506', 'Manila por Metro', 'vistas/img/productos/default/anonymous.png', 20, 600, 840, 0, '2017-12-21 21:56:28'),
(50, 5, '507', 'Polea 2 canales', 'vistas/img/productos/default/anonymous.png', 20, 900, 1260, 0, '2017-12-21 21:56:28'),
(51, 5, '508', 'Tensor', 'vistas/img/productos/508/500.jpg', 19, 100, 140, 1, '2017-12-26 22:26:51'),
(52, 5, '509', 'Bascula ', 'vistas/img/productos/509/878.jpg', 12, 130, 182, 8, '2017-12-26 22:26:51'),
(53, 5, '510', 'Bomba Hidrostatica', 'vistas/img/productos/510/870.jpg', 7, 770, 1078, 13, '2022-09-02 17:15:58'),
(54, 5, '511', 'Chapeta', 'vistas/img/productos/511/239.jpg', 16, 660, 924, 4, '2017-12-26 22:27:42'),
(55, 5, '512', 'Cilindro muestra de concreto', 'vistas/img/productos/512/266.jpg', 15, 400, 560, 5, '2022-09-01 02:29:49'),
(56, 5, '513', 'Cizalla de Palanca', 'vistas/img/productos/513/445.jpg', 2, 450, 630, 18, '2022-09-02 17:15:58'),
(57, 5, '514', 'Cizalla de Tijera', 'vistas/img/productos/514/249.jpg', 0, 580, 812, 14, '2022-09-02 17:15:58'),
(58, 5, '515', 'Coche llanta neumatica', 'vistas/img/productos/515/174.jpg', 16, 420, 588, 4, '2022-09-01 02:55:50'),
(59, 5, '516', 'Cono slump', 'vistas/img/productos/516/228.jpg', 14, 140, 196, 6, '2022-09-01 02:55:50'),
(60, 5, '517', 'Cortadora de Baldosin', 'vistas/img/productos/517/746.jpg', 11, 930, 1302, 11, '2022-09-02 17:15:58'),
(61, 7, 'vivo35776568', 'Asus Laptop VivoBook Flip Core i3 10th 8GB RAM 256SSD', 'vistas/img/productos/vivo35776568/690.jpg', 1, 15000, 21000, 4, '2022-09-02 17:15:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `proveedor` text COLLATE latin1_spanish_ci NOT NULL,
  `telefono` text COLLATE latin1_spanish_ci NOT NULL,
  `mail` text COLLATE latin1_spanish_ci NOT NULL,
  `razon_social` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `proveedor`, `telefono`, `mail`, `razon_social`) VALUES
(1, 'ACCE-GAS', '', '', ''),
(2, 'A.T', '', '', ''),
(3, 'ABXXXX', '', '', ''),
(4, 'ACCE-GAS', '', '', ''),
(5, 'AFLA', '', '', ''),
(6, 'AIRMONT DURBAN', '', '', ''),
(7, 'ALARSA', '', '', ''),
(8, 'ALARSA-FLEXIBLES', '', '', ''),
(9, 'GISA', '', '', ''),
(10, 'ALBE', '', '', ''),
(11, 'ALBERTO SERVICIOS', '', '', ''),
(12, 'AMANCO', '', '', ''),
(13, 'ROWA2', '', '', ''),
(14, 'ARIEL', '', '', ''),
(15, 'AT', '', '', ''),
(16, 'BAGNARA-INTERFORMNG S.A', '', '', ''),
(17, 'BENIPLAST', '', '', ''),
(18, 'BETHULAR ALBE', '', '', ''),
(19, 'BETHULAR ORKLI', '', '', ''),
(20, 'BIZANTINA', '', '', ''),
(21, 'BOSCH', '', '', ''),
(22, 'BOZSO HNOS', '', '', ''),
(23, 'BRAGANZA', '', '', ''),
(24, 'BRAGANZA S.R.L', '', '', ''),
(25, 'BRAGGIO', '', '', ''),
(26, 'BROGAS', '', '', ''),
(27, 'CAF', '', '', ''),
(28, 'CAFLA', '', '', ''),
(29, 'CAMPAGNUCCI', '', '', ''),
(30, 'CANTALUPI AYACUCHO', '', '', ''),
(31, 'CANTALUPI PARISOL', '', '', ''),
(32, 'CARBIZ', '', '', ''),
(33, 'CARLOS', '', '', ''),
(34, 'CARLOS PETRINI', '', '', ''),
(35, 'CAROSIO', '', '', ''),
(36, 'CARREÃ‘O', '', '', ''),
(37, 'CASA VELMEN', '', '', ''),
(38, 'CAVAI-OSCAR LEBRERO', '', '', ''),
(39, 'CHICOTE', '', '', ''),
(40, 'CINTAS', '', '', ''),
(41, 'CLIMAT.HEIL', '', '', ''),
(42, 'COFLEX', '', '', ''),
(43, 'FIBON', '', '', ''),
(44, 'CRUPIER', '', '', ''),
(45, 'CUROTO', '', '', ''),
(46, 'D\"ACCORD', '', '', ''),
(47, 'D.G.C. S.R.L', '', '', ''),
(48, 'D.M.A', '', '', ''),
(49, 'DANIEL', '', '', ''),
(50, 'DE LA PALANQUITA', '', '', ''),
(51, 'DEALER', '', '', ''),
(52, 'DECKER', '', '', ''),
(53, 'DELTA', '', '', ''),
(54, 'DEMA', '', '', ''),
(55, 'DERPLA', '', '', ''),
(56, 'DI-SA', '', '', ''),
(57, 'DI-SA SECCION A2', '', '', ''),
(58, 'DIEGO', '', '', ''),
(59, 'DINATECNICA', '', '', ''),
(60, 'DISAPLA S.A', '', '', ''),
(61, 'DISTRITOOLS', '', '', ''),
(62, 'DUFF', '', '', ''),
(63, 'DUKE', '', '', ''),
(64, 'ECOCLIMA', '', '', ''),
(65, 'ECOTERMO', '', '', ''),
(66, 'ECOTERMO REPUESTOS', '', '', ''),
(67, 'EGA', '', '', ''),
(68, 'EGEO', '', '', ''),
(69, 'EL PORVENIR', '', '', ''),
(70, 'ELECCER', '', '', ''),
(71, 'ELEKTRIM', '', '', ''),
(72, 'EPEPE', '', '', ''),
(73, 'ESKABE', '', '', ''),
(74, 'FABIAN', '', '', ''),
(75, 'FAL GAS', '', '', ''),
(76, 'FAMEIM', '', '', ''),
(77, 'FAUSTINO BOTTA', '', '', ''),
(78, 'FERNANDES', '', '', ''),
(79, 'FERNANDO', '', '', ''),
(80, 'FERRABUL', '', '', ''),
(81, 'FERRUM', '', '', ''),
(82, 'FERRUM NETO', '', '', ''),
(83, 'FERRUM REPUESTOS', '', '', ''),
(84, 'FLUVIAL', '', '', ''),
(85, 'FORCADE', '', '', ''),
(86, 'FOURCADE', '', '', ''),
(87, 'FRANCEL', '', '', ''),
(88, 'FRANCI GAS', '', '', ''),
(89, 'FRANKE', '', '', ''),
(90, 'FULMINANTE', '', '', ''),
(91, 'FV S.A.', '', '', ''),
(92, 'FV S.A.REPUESTOS', '', '', ''),
(93, 'GALANTE', '', '', ''),
(94, 'GALI', '', '', ''),
(95, 'GALOTA', '', '', ''),
(96, 'GARIBOTTI', '', '', ''),
(97, 'GENABRE', '', '', ''),
(98, 'GENEBRE', '', '', ''),
(99, 'GIANNOTTI', '', '', ''),
(100, 'GRIFERIA LATINA', '', '', ''),
(101, 'GRUNDFOS', '', '', ''),
(102, 'GRUNDFOS-', '', '', ''),
(103, 'GUILLERMO ALCORTA', '', '', ''),
(104, 'GUNDIN SA', '', '', ''),
(105, 'H3 CALEFACCION', '', '', ''),
(106, 'HANDYMAN', '', '', ''),
(107, 'HIDROMET', '', '', ''),
(108, 'HIDROMET PUEYO', '', '', ''),
(109, 'HIDROQUIL', '', '', ''),
(110, 'HILDA', '', '', ''),
(111, 'HORACIO', '', '', ''),
(112, 'HUENCO', '', '', ''),
(113, 'I.A.R.S.A', '', '', ''),
(114, 'I.P.LI S.R.L', '', '', ''),
(115, 'IB', '', '', ''),
(116, 'IC', '', '', ''),
(117, 'IDEAL', '', '', ''),
(118, 'IL GABINETTO', '', '', ''),
(119, 'IMIX', '', '', ''),
(120, 'IMPORT FITTINGS', '', '', ''),
(121, 'INDULONG', '', '', ''),
(122, 'ITURRIA', '', '', ''),
(123, 'JIT', '', '', ''),
(124, 'JORGE', '', '', ''),
(125, 'JORMAR', '', '', ''),
(126, 'KO-BO', '', '', ''),
(127, 'KURZROK', '', '', ''),
(128, 'LISBOA', '', '', ''),
(129, 'LIZARRAGA', '', '', ''),
(130, 'LOS MELLIZOS', '', '', ''),
(131, 'LOSUNG', '', '', ''),
(132, 'LUBRI ATLANTICO', '', '', ''),
(133, 'LUCAS', '', '', ''),
(134, 'MA-HE', '', '', ''),
(135, 'MACROFER', '', '', ''),
(136, 'MAGARI-OSCAR', '', '', ''),
(137, 'MALLOL HNOS', '', '', ''),
(138, 'MALVAR', '', '', ''),
(139, 'MAR-PAT', '', '', ''),
(140, 'MARINELLI', '', '', ''),
(141, 'MARZINI', '', '', ''),
(142, 'MASTERLY', '', '', ''),
(143, 'MATERIALES DEL PARQUE', '', '', ''),
(144, 'MAYEROT', '', '', ''),
(145, 'MEGAPOL', '', '', ''),
(146, 'MELILLO', '', '', ''),
(147, 'MERCORIEGO', '', '', ''),
(148, 'MERMACO', '', '', ''),
(149, 'MERMACO-GRIFERIA', '', '', ''),
(150, 'INYECT-GAS', '', '', ''),
(151, 'METALURIGCA A.', '', '', ''),
(152, 'MI PILETA', '', '', ''),
(153, 'MI-RE S.A.', '', '', ''),
(154, 'MINASSIAN', '', '', ''),
(155, 'MIRABELLI', '', '', ''),
(156, 'MONICA GABAY', '', '', ''),
(157, 'MOTORMECH', '', '', ''),
(158, 'MSB', '', '', ''),
(159, 'MUNDO CAÃ‘O', '', '', ''),
(160, 'N.CRETA', '', '', ''),
(161, 'NAGEL', '', '', ''),
(162, 'NEXO', '', '', ''),
(163, 'NN', '', '', ''),
(164, 'NN AYACUCHO', '', '', ''),
(165, 'NODEMA', '', '', ''),
(166, 'ORBIS', '', '', ''),
(167, 'OSCAR', '', '', ''),
(168, 'OSCAR LEVRERO', '', '', ''),
(169, 'OSCAR ORKLI', '', '', ''),
(170, 'OSCAR RBM', '', '', ''),
(171, 'OSCAR YORK', '', '', ''),
(172, 'OSCAR-LUIS', '', '', ''),
(173, 'PALYP S.A.', '', '', ''),
(174, 'PARSECS', '', '', ''),
(175, 'PAZ', '', '', ''),
(176, 'PEREIRA', '', '', ''),
(177, 'PETRINI', '', '', ''),
(178, 'PETRINI-', '', '', ''),
(179, 'PIPI GRANIER', '', '', ''),
(180, 'PLASTIFLEX', '', '', ''),
(181, 'POLI', '', '', ''),
(182, 'POLIMEX', '', '', ''),
(183, 'POLIMEX-', '', '', ''),
(184, 'POX', '', '', ''),
(185, 'PRINGLES SAN LUIS S.A', '', '', ''),
(186, 'PROPIO', '', '', ''),
(187, 'PURFIL S.A', '', '', ''),
(188, 'QUIMICA OESTE S.A', '', '', ''),
(189, 'RAUL', '', '', ''),
(190, 'RBM', '', '', ''),
(191, 'RG GROUP', '', '', ''),
(192, 'ROCAFLOR S.A.', '', '', ''),
(193, 'ROJAS', '', '', ''),
(194, 'ROS', '', '', ''),
(195, 'ROTOPLAS', '', '', ''),
(196, 'ROWA1', '', '', ''),
(197, 'S.L', '', '', ''),
(198, 'S.LUCAS', '', '', ''),
(199, 'SAL-BOM', '', '', ''),
(200, 'SALADILLO', '', '', ''),
(201, 'SALUSTRI', '', '', ''),
(202, 'SAN MARCOS', '', '', ''),
(203, 'SAN MARTIN', '', '', ''),
(204, 'SANITARIOS', '', '', ''),
(205, 'SANITARIOS RESTA', '', '', ''),
(206, 'SANTILLI S.A.', '', '', ''),
(207, 'SARABIA', '', '', ''),
(208, 'SCHRAIBER S.R.L.', '', '', ''),
(209, 'SER-DIS', '', '', ''),
(210, 'SERVI FER', '', '', ''),
(211, 'SERVIFER', '', '', ''),
(212, 'SIBOREIRO', '', '', ''),
(213, 'SOLDALUM', '', '', ''),
(214, 'SONCA HNOS', '', '', ''),
(215, 'SPIRO', '', '', ''),
(216, 'STAL GRIFF', '', '', ''),
(217, 'SUMINISTROS INDUSTRIALES S.A', '', '', ''),
(218, 'TABARLY', '', '', ''),
(219, 'TAMALET', '', '', ''),
(220, 'TAMBASCO', '', '', ''),
(221, 'TAMBASCO EDELL', '', '', ''),
(222, 'TANDILITA S.R.L', '', '', ''),
(223, 'TECNOCOM', '', '', ''),
(224, 'TINACOS', '', '', ''),
(225, 'TITO CAF', '', '', ''),
(226, 'TODO RIEGO', '', '', ''),
(227, 'TONON', '', '', ''),
(228, 'TREBINI', '', '', ''),
(229, 'TREBINI I', '', '', ''),
(230, 'TRICOLOR', '', '', ''),
(231, 'TROVA', '', '', ''),
(232, 'TUPY', '', '', ''),
(233, 'URIARTE TALDEA', '', '', ''),
(234, 'VANITORIS', '', '', ''),
(235, 'VELMEN', '', '', ''),
(236, 'VENTILGAS', '', '', ''),
(237, 'WIL-GAS', '', '', ''),
(238, 'ZAMORANO', '', '', ''),
(239, 'ZIPEN S.A.', '', '', ''),
(240, 'ZUMARRAGA', '', '', ''),
(241, 'FLEXAS HUGO HORACIO', '', '', ''),
(242, 'TUBERIAS MDP', '', '', ''),
(243, 'TERMOINDUSTRIAL', '', '', ''),
(244, 'PLASTIFERRO', '', '', ''),
(245, 'ESKABE-CALDERAS', '', '', ''),
(246, 'FERRUM SIN DESC.EXC 7%', '', '', ''),
(247, 'DISTRIMAR', '', '', ''),
(248, 'BIDEMATIC', '', '', ''),
(249, 'FIBRAINDUSTRIA', '', '', ''),
(250, 'BADEN', '', '', ''),
(251, 'SAAVEDRA', '', '', ''),
(252, 'SALADILLO AWADUCT', '', '', ''),
(253, 'DI-SA SECCION A0', '', '', ''),
(254, 'WATERVAN', '', '', ''),
(255, 'COPPENS', '', '', ''),
(256, 'MONDIALE', '', '', ''),
(257, 'TAFS', '', '', ''),
(258, 'IDEAL IMPORTADOS', '', '', ''),
(259, 'SOPORTECK EL SIMETRICO', '', '', ''),
(260, 'BOIERO', '', '', ''),
(262, 'proveedor', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Administrador', 'admin', '52d43559549d87ee74ac07a09c5f951b', 'Administrador', 'vistas/img/usuarios/admin/191.jpg', 1, '2022-09-03 12:40:07', '2022-09-03 17:40:07'),
(58, 'Julio Gómez', 'julio', '3214c8a4b00740b4bd2963ed339d8655', 'Especial', 'vistas/img/usuarios/julio/100.png', 1, '2022-08-31 22:01:37', '2022-09-01 03:01:37'),
(59, 'Anita Nunez', 'ana', '7f46a2e2ca42b879dc7bc2b62f2f2b55', 'Vendedor', 'vistas/img/usuarios/ana/260.png', 1, '2021-06-25 14:44:54', '2021-07-01 18:33:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `fecha`) VALUES
(17, 10001, 3, 1, '[{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial \",\"cantidad\":\"2\",\"stock\":\"13\",\"precio\":\"1200\",\"total\":\"2400\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"2\",\"stock\":\"7\",\"precio\":\"6300\",\"total\":\"12600\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"4200\",\"total\":\"4200\"}]', 3648, 19200, 22848, 'Efectivo', '2018-02-02 01:11:04'),
(18, 10002, 4, 59, '[{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"2156\",\"total\":\"4312\"},{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"6\",\"descripcion\":\"Disco Punta Diamante \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"1540\",\"total\":\"1540\"},{\"id\":\"7\",\"descripcion\":\"Extractor de Aire \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2156\",\"total\":\"2156\"}]', 2585.52, 13608, 16193.5, 'TC-34346346346', '2018-02-02 14:57:20'),
(19, 10003, 5, 59, '[{\"id\":\"8\",\"descripcion\":\"Guadañadora \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2156\",\"total\":\"2156\"},{\"id\":\"9\",\"descripcion\":\"Hidrolavadora Eléctrica \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"3640\",\"total\":\"3640\"},{\"id\":\"7\",\"descripcion\":\"Extractor de Aire \",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"2156\",\"total\":\"2156\"}]', 1510.88, 7952, 9462.88, 'Efectivo', '2018-01-18 14:57:40'),
(20, 10004, 5, 59, '[{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"5\",\"stock\":\"14\",\"precio\":\"4200\",\"total\":\"21000\"},{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"2156\",\"total\":\"2156\"}]', 5463.64, 28756, 34219.6, 'TD-454475467567', '2018-01-25 14:58:09'),
(21, 10005, 6, 57, '[{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"2156\",\"total\":\"2156\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"5\",\"stock\":\"9\",\"precio\":\"4200\",\"total\":\"21000\"}]', 5463.64, 28756, 34219.6, 'TC-6756856867', '2018-01-09 14:59:07'),
(22, 10006, 10, 1, '[{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"4200\",\"total\":\"4200\"},{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"3\",\"stock\":\"13\",\"precio\":\"2156\",\"total\":\"6468\"},{\"id\":\"6\",\"descripcion\":\"Disco Punta Diamante \",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"1540\",\"total\":\"1540\"}]', 3383.52, 17808, 21191.5, 'Efectivo', '2018-01-26 15:03:22'),
(23, 10007, 9, 1, '[{\"id\":\"6\",\"descripcion\":\"Disco Punta Diamante \",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"1540\",\"total\":\"1540\"},{\"id\":\"7\",\"descripcion\":\"Extractor de Aire \",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"2156\",\"total\":\"2156\"},{\"id\":\"8\",\"descripcion\":\"Guadañadora \",\"cantidad\":\"6\",\"stock\":\"13\",\"precio\":\"2156\",\"total\":\"12936\"},{\"id\":\"9\",\"descripcion\":\"Hidrolavadora Eléctrica \",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"3640\",\"total\":\"3640\"}]', 3851.68, 20272, 24123.7, 'TC-357547467346', '2017-11-30 15:03:53'),
(24, 10008, 12, 1, '[{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"1\",\"stock\":\"6\",\"precio\":\"6300\",\"total\":\"6300\"},{\"id\":\"7\",\"descripcion\":\"Extractor de Aire \",\"cantidad\":\"5\",\"stock\":\"12\",\"precio\":\"2156\",\"total\":\"10780\"},{\"id\":\"6\",\"descripcion\":\"Disco Punta Diamante \",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"1540\",\"total\":\"1540\"},{\"id\":\"9\",\"descripcion\":\"Hidrolavadora Eléctrica \",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"3640\",\"total\":\"3640\"}]', 4229.4, 22260, 26489.4, 'TD-35745575', '2017-12-25 15:04:11'),
(25, 10009, 11, 1, '[{\"id\":\"10\",\"descripcion\":\"Hidrolavadora Gasolina\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"3094\",\"total\":\"3094\"},{\"id\":\"9\",\"descripcion\":\"Hidrolavadora Eléctrica \",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"3640\",\"total\":\"3640\"},{\"id\":\"6\",\"descripcion\":\"Disco Punta Diamante \",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"1540\",\"total\":\"1540\"}]', 1572.06, 8274, 9846.06, 'TD-5745745745', '2017-08-15 15:04:38'),
(26, 10010, 8, 1, '[{\"id\":\"9\",\"descripcion\":\"Hidrolavadora Eléctrica \",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"3640\",\"total\":\"3640\"},{\"id\":\"10\",\"descripcion\":\"Hidrolavadora Gasolina\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"3094\",\"total\":\"3094\"},{\"id\":\"61\",\"descripcion\":\"Asus Laptop VivoBook Flip Core i3 10th 8GB RAM 256SSD\",\"cantidad\":\"1\",\"stock\":\"2\",\"precio\":\"21000\",\"total\":\"21000\"}]', 5269.46, 27734, 33003.5, 'TD-21313123123', '2022-09-01 02:57:59'),
(27, 10011, 7, 1, '[{\"id\":\"60\",\"descripcion\":\"Cortadora de Baldosin\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"1302\",\"total\":\"1302\"},{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"196\",\"total\":\"196\"},{\"id\":\"58\",\"descripcion\":\"Coche llanta neumatica\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"588\",\"total\":\"588\"},{\"id\":\"57\",\"descripcion\":\"Cizalla de Tijera\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"812\",\"total\":\"812\"}]', 550.62, 2898, 3448.62, 'Efectivo', '2017-12-25 22:23:38'),
(28, 10012, 12, 57, '[{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"196\",\"total\":\"196\"},{\"id\":\"58\",\"descripcion\":\"Coche llanta neumatica\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"588\",\"total\":\"588\"},{\"id\":\"54\",\"descripcion\":\"Chapeta\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"924\",\"total\":\"924\"},{\"id\":\"53\",\"descripcion\":\"Bomba Hidrostatica\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"1078\",\"total\":\"1078\"}]', 529.34, 2786, 3315.34, 'TC-3545235235', '2017-12-25 22:24:24'),
(29, 10013, 11, 57, '[{\"id\":\"54\",\"descripcion\":\"Chapeta\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"924\",\"total\":\"924\"},{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"196\",\"total\":\"196\"},{\"id\":\"60\",\"descripcion\":\"Cortadora de Baldosin\",\"cantidad\":\"5\",\"stock\":\"14\",\"precio\":\"1302\",\"total\":\"6510\"}]', 1449.7, 7630, 9079.7, 'TC-425235235235', '2017-12-26 22:24:50'),
(30, 10014, 10, 57, '[{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"196\",\"total\":\"196\"},{\"id\":\"54\",\"descripcion\":\"Chapeta\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"924\",\"total\":\"924\"},{\"id\":\"53\",\"descripcion\":\"Bomba Hidrostatica\",\"cantidad\":\"10\",\"stock\":\"9\",\"precio\":\"1078\",\"total\":\"10780\"}]', 2261, 11900, 14161, 'Efectivo', '2017-12-26 22:25:09'),
(31, 10015, 9, 57, '[{\"id\":\"57\",\"descripcion\":\"Cizalla de Tijera\",\"cantidad\":\"3\",\"stock\":\"16\",\"precio\":\"812\",\"total\":\"2436\"}]', 462.84, 2436, 2898.84, 'Efectivo', '2017-12-26 22:25:33'),
(32, 10016, 8, 57, '[{\"id\":\"58\",\"descripcion\":\"Coche llanta neumatica\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"588\",\"total\":\"588\"},{\"id\":\"57\",\"descripcion\":\"Cizalla de Tijera\",\"cantidad\":\"5\",\"stock\":\"11\",\"precio\":\"812\",\"total\":\"4060\"},{\"id\":\"56\",\"descripcion\":\"Cizalla de Palanca\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"630\",\"total\":\"630\"}]', 1002.82, 5278, 6280.82, 'TD-4523523523', '2017-12-26 22:25:55'),
(33, 10017, 7, 57, '[{\"id\":\"57\",\"descripcion\":\"Cizalla de Tijera\",\"cantidad\":\"4\",\"stock\":\"7\",\"precio\":\"812\",\"total\":\"3248\"},{\"id\":\"52\",\"descripcion\":\"Bascula \",\"cantidad\":\"3\",\"stock\":\"17\",\"precio\":\"182\",\"total\":\"546\"},{\"id\":\"55\",\"descripcion\":\"Cilindro muestra de concreto\",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"560\",\"total\":\"1120\"},{\"id\":\"56\",\"descripcion\":\"Cizalla de Palanca\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"630\",\"total\":\"630\"}]', 1053.36, 5544, 6597.36, 'Efectivo', '2017-12-26 22:26:28'),
(34, 10018, 6, 57, '[{\"id\":\"51\",\"descripcion\":\"Tensor\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"140\",\"total\":\"140\"},{\"id\":\"52\",\"descripcion\":\"Bascula \",\"cantidad\":\"5\",\"stock\":\"12\",\"precio\":\"182\",\"total\":\"910\"},{\"id\":\"53\",\"descripcion\":\"Bomba Hidrostatica\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"1078\",\"total\":\"1078\"}]', 404.32, 2128, 2532.32, 'Efectivo', '2017-12-26 22:26:51'),
(35, 10019, 5, 57, '[{\"id\":\"56\",\"descripcion\":\"Cizalla de Palanca\",\"cantidad\":\"15\",\"stock\":\"3\",\"precio\":\"630\",\"total\":\"9450\"},{\"id\":\"55\",\"descripcion\":\"Cilindro muestra de concreto\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"560\",\"total\":\"560\"}]', 1901.9, 10010, 11911.9, 'Efectivo', '2017-12-26 22:27:13'),
(36, 10020, 4, 57, '[{\"id\":\"55\",\"descripcion\":\"Cilindro muestra de concreto\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"560\",\"total\":\"560\"},{\"id\":\"54\",\"descripcion\":\"Chapeta\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"924\",\"total\":\"924\"}]', 281.96, 1484, 1765.96, 'TC-46346346346', '2017-12-26 22:27:42'),
(37, 10021, 3, 1, '[{\"id\":\"60\",\"descripcion\":\"Cortadora de Baldosin\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"1302\",\"total\":\"1302\"},{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"196\",\"total\":\"196\"}]', 149.8, 1498, 1647.8, 'Efectivo', '2018-02-06 22:47:02'),
(39, 10022, 4, 1, '[{\"id\":\"40\",\"descripcion\":\"Planta Electrica Diesel 60 Kva\",\"cantidad\":\"10\",\"stock\":\"10\",\"precio\":\"5180\",\"total\":\"51800\"},{\"id\":\"61\",\"descripcion\":\"Asus Laptop VivoBook Flip Core i3 10th 8GB RAM 256SSD\",\"cantidad\":\"1\",\"stock\":\"4\",\"precio\":\"21000\",\"total\":\"21000\"},{\"id\":\"60\",\"descripcion\":\"Cortadora de Baldosin\",\"cantidad\":\"2\",\"stock\":\"13\",\"precio\":\"1302\",\"total\":\"2604\"},{\"id\":\"55\",\"descripcion\":\"Cilindro muestra de concreto\",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"560\",\"total\":\"560\"}]', 15952.4, 75964, 91916.4, 'TC-123123131', '2022-09-01 02:29:49'),
(40, 10023, 4, 1, '[{\"id\":\"61\",\"descripcion\":\"Asus Laptop VivoBook Flip Core i3 10th 8GB RAM 256SSD\",\"cantidad\":\"1\",\"stock\":\"3\",\"precio\":\"21000\",\"total\":\"21000\"},{\"id\":\"60\",\"descripcion\":\"Cortadora de Baldosin\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"1302\",\"total\":\"1302\"},{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"196\",\"total\":\"196\"},{\"id\":\"58\",\"descripcion\":\"Coche llanta neumatica\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"588\",\"total\":\"588\"}]', 3693.76, 23086, 26779.8, 'Efectivo', '2022-09-01 02:55:50'),
(41, 10024, 8, 1, '[{\"id\":\"57\",\"descripcion\":\"Cizalla de Tijera\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"812\",\"total\":\"812\"},{\"id\":\"61\",\"descripcion\":\"Asus Laptop VivoBook Flip Core i3 10th 8GB RAM 256SSD\",\"cantidad\":\"1\",\"stock\":\"1\",\"precio\":\"21000\",\"total\":\"21000\"},{\"id\":\"56\",\"descripcion\":\"Cizalla de Palanca\",\"cantidad\":\"1\",\"stock\":\"2\",\"precio\":\"630\",\"total\":\"630\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"1\",\"stock\":\"5\",\"precio\":\"6300\",\"total\":\"6300\"},{\"id\":\"53\",\"descripcion\":\"Bomba Hidrostatica\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"1078\",\"total\":\"1078\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"4200\",\"total\":\"4200\"},{\"id\":\"40\",\"descripcion\":\"Planta Electrica Diesel 60 Kva\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"5180\",\"total\":\"5180\"},{\"id\":\"60\",\"descripcion\":\"Cortadora de Baldosin\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"1302\",\"total\":\"1302\"}]', 6480.32, 40502, 46982.3, 'Efectivo', '2022-09-02 17:15:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
