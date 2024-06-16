-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2024 a las 16:50:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendawargames`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `name`) VALUES
(2, 'Warhammer 40K'),
(4, 'Warhammer Age of Sigmar'),
(5, 'The Horus Heresy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_pago`
--

CREATE TABLE `formas_pago` (
  `ID_FormaPago` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formas_pago`
--

INSERT INTO `formas_pago` (`ID_FormaPago`, `Descripcion`) VALUES
(1, 'Pago en mano'),
(2, 'PayPal'),
(3, 'Bizum'),
(4, 'Tarjeta de crédito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_torneo`
--

CREATE TABLE `inscripciones_torneo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  `fecha_inscripcion` timestamp NOT NULL DEFAULT current_timestamp(),
  `telefono` varchar(20) DEFAULT NULL,
  `id_aplicacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_Pedido` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Pais` varchar(100) NOT NULL,
  `Region` varchar(100) NOT NULL,
  `Ciudad` varchar(100) NOT NULL,
  `Codigo_Postal` varchar(20) NOT NULL,
  `Notas` text DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `ID_FormaPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ID_Pedido`, `ID_Usuario`, `Direccion`, `Pais`, `Region`, `Ciudad`, `Codigo_Postal`, `Notas`, `Fecha`, `Total`, `Estado`, `ID_FormaPago`) VALUES
(4, 78, 'Calle Falsa ', 'España', 'Madrid', 'Madrid', '28001', 'Entrega rápida por favor.', '2024-06-09 23:56:48', 150.00, 'Cancelado', 1),
(15, 78, 'Calle Obusera', 'España', 'Cadiz', 'Cadiz', '11100', 'afdaf', '2024-06-10 00:25:10', 638.00, 'Enviado', 1),
(16, 78, 'Calle Obusera', 'España', 'Andalucía', 'Sevilla', '11100', 'dejarlo en puerta', '2024-06-10 08:30:46', 12.00, 'Pendiente', 4),
(17, 78, 'Calle Obusera', 'España', 'Andalucía', 'Cádiz', '11100', 'hola', '2024-06-10 10:29:43', 414.00, 'Pendiente', 1),
(18, 78, 'Calle Obusera', 'España', 'Andalucía', 'Sevilla', '11100', '', '2024-06-10 11:09:13', 840.00, 'Pendiente', 2),
(19, 78, 'Calle Obusera', 'España', 'Andalucía', 'Sevilla', '11100', 'sdad', '2024-06-12 16:45:35', 1094.00, 'Pendiente', 1),
(20, 78, 'Calle Obusera', 'España', 'Andalucía', 'Córdoba', '11100', 'fafs', '2024-06-12 17:42:42', 120.00, 'Entregado', 1),
(21, 78, 'Calle Obusera', 'España', 'Andalucía', 'Sevilla', '11100', '', '2024-06-12 18:39:19', 238.00, 'Pendiente', 1),
(22, 78, 'Calle Obusera', 'España', 'Andalucía', 'Sevilla', '11100', '', '2024-06-13 20:14:39', 236.00, 'Pendiente', 1),
(23, 78, 'Calle Obusera', 'España', 'Aragón', 'Zaragoza', '11100', 'afaf', '2024-06-15 17:24:33', 250.00, 'Pendiente', 4),
(24, 78, 'Calle Obusera', 'España', 'Andalucía', 'Cádiz', '11100', 'af', '2024-06-15 17:24:53', 250.00, 'Pendiente', 4),
(25, 78, 'Calle Obusera', 'España', 'Andalucía', 'Sevilla', '11100', 'ada', '2024-06-15 17:37:20', 70.00, 'Pendiente', 2),
(26, 78, 'Calle Obusera', 'España', 'Aragón', 'Zaragoza', '11100', 'sadfa', '2024-06-15 17:37:58', 70.00, 'Pendiente', 4),
(27, 78, 'Calle Obusera', 'España', 'Aragón', 'Zaragoza', '11100', 'dasd', '2024-06-15 17:38:38', 70.00, 'Pendiente', 3),
(28, 78, 'Calle Obusera', 'España', 'Andalucía', 'Málaga', '11100', '', '2024-06-15 17:39:56', 35.00, 'Pendiente', 1),
(29, 78, 'Calle Obusera', 'España', 'Aragón', 'Zaragoza', '11100', 'a su puerta', '2024-06-15 17:42:54', 120.00, 'Enviado', 1),
(30, 78, 'Calle Obusera', 'España', 'Andalucía', 'Sevilla', '11100', 'ads', '2024-06-15 17:55:13', 70.00, 'Pendiente', 2),
(31, 78, 'Calle Obusera', 'España', 'Andalucía', 'Málaga', '11100', 'ada', '2024-06-15 18:15:32', 312.50, 'Pendiente', 2),
(32, 78, 'Calle Obusera', 'España', 'Aragón', 'Zaragoza', '11100', 'fafa', '2024-06-16 10:51:57', 260.00, 'Pendiente', 1),
(33, 78, 'Calle Obusera', 'España', 'Andalucía', 'Sevilla', '11100', '', '2024-06-16 11:14:43', 47.50, 'Pendiente', 2),
(34, 78, 'Calle Obusera', 'España', 'Andalucía', 'Málaga', '11100', '', '2024-06-16 11:27:08', 95.00, 'Pendiente', 1),
(35, 82, 'Calle Obusera', 'España', 'Andalucía', 'Córdoba', '11100', '', '2024-06-16 11:33:26', 35.00, 'Pendiente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `ID_Pedido` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`ID_Pedido`, `ID_Producto`, `Cantidad`) VALUES
(4, 2, 2),
(15, 2, 5),
(15, 3, 4),
(16, 3, 1),
(17, 2, 3),
(17, 3, 5),
(18, 3, 7),
(19, 2, 2),
(19, 3, 1),
(19, 4, 6),
(20, 3, 1),
(21, 2, 1),
(21, 3, 1),
(22, 2, 2),
(23, 8, 4),
(24, 8, 4),
(25, 7, 2),
(26, 7, 2),
(27, 7, 2),
(28, 6, 1),
(29, 3, 1),
(30, 7, 2),
(31, 8, 5),
(32, 9, 2),
(33, 5, 1),
(34, 5, 2),
(35, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `imagen1` varchar(255) DEFAULT NULL,
  `imagen2` varchar(255) DEFAULT NULL,
  `imagen3` varchar(255) DEFAULT NULL,
  `imagen4` varchar(255) DEFAULT NULL,
  `imagen5` varchar(255) DEFAULT NULL,
  `imagen6` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Nombre`, `Descripcion`, `Precio`, `Stock`, `imagen1`, `imagen2`, `imagen3`, `imagen4`, `imagen5`, `imagen6`, `category_id`, `subcategory_id`) VALUES
(2, 'Alpharius, Primarch of the Alpha Legion', 'De todos los primarcas, Alpharius es sin duda el más envuelto en misterio, leyenda, contradicción y falsificación deliberada. Al igual que la hidra que él y su Legión toman como símbolo, Alpharius ordena a su Legión luchar mediante ataques repetidos desde múltiples y inesperadas direcciones. Nadie puede predecir dónde o cómo atacará el primarca, qué armas utilizará o cuáles de sus muchas fuerzas diferentes lucharán a su lado.\r\n\r\nAlpharius está aquí vestido con las Escamas de Pythia, un conjunto de armadura única y hermosa. Alpharius está bien equipado para la batalla, con un paquete de granadas y un bláster de plasma de fabricación maestra en su cinturón, y la Lanza Pálida en sus manos. Su base escénica incluye a un desafortunado Marine Espacial intentando escapar de la ira del primarca.\r\n\r\nEste kit contiene 22 componentes de resina y se suministra con una base de juego redonda de 40 mm y una base escénica de 60 mm.\r\n\r\nLas reglas para Alpharius en tus juegos de Warhammer: La Herejía de Horus se pueden encontrar en Liber Hereticus – Libro del Ejército de las Legiones Astartes Traidoras. Esta miniatura se suministra sin pintar y requiere montaje. Recomendamos usar pinturas Citadel.\r\n\r\nEste kit de modelado de resina no es un juguete, es un artículo de colección y su construcción solo debe ser realizada por aficionados expertos de Warhammer mayores de 15 años.', 118.20, 20, 'Alpharius01.jpg', '01-01 (4).jpg', '01 (10).jpg', '99560102291_Alpharius05.jpg', '99560102291_Alpharius02.jpg', '99560102291_Alpharius07.jpg', 5, 16),
(3, 'PATRULLA: DEATHWATCH', 'Los Vigías de la Muerte son un extendido Capítulo de los Marines Espaciales y la mayor arma del Imperium contra las múltiples amenazas que representan las incontables razas xenos. Desde sus bases ocultas en fortalezas de vigilancia orbitales, los Vigías de la Muerte envían agentes cuidadosamente elegidos para dar caza y exterminar a presencias alienígenas allá donde se encuentren. Cada uno de estos guerreros poshumanos es un veterano de incontables batallas, un diezmo entregado por su Capítulo original para desempeñar la Larga Vigilia con los Vigías de la Muerte, protegiendo contra las', 120.00, 2, '99120109014_DeathwatchCombatPatrolStock.jpg', '99120109014_DeathwatchCombatPatrolLead.jpg', '01.jpg', '01 (2).jpg', '01 (1).jpg', '01-01.jpg', 2, 6),
(4, 'GUERRERO NECRONES', 'Este kit construye diez Guerreros Necrones, cada uno con dos opciones para la cabeza y la opción de un desollador gauss o un segador gauss, así como tres enjambres canópticos Escarabeo. Al ser de fácil montaje a presión no necesitarás ningún tipo de pegamento para montarlos. El kit consta de 70 piezas de plástico y viene con diez peanas redondas Citadel de 32 mm y tres peanas redondas Citadel de 40 mm con agujero hexagonal.', 41.00, 0, 'necron_warriors1.jpg', '01 (5).jpg', '01 (6).jpg', '99120110052_NecronWarriorsGroup.jpg', '99120110052_NecronsWarriorsSprue.jpg', '99120110052_NecronWarriorsStock.jpg', 2, 5),
(5, 'CODEX: SPACE MARINES (INGLÉS)', 'Dentro de este libro de tapa dura de 216 páginas, encontrarás: – Información de fondo extensa sobre los Marines Espaciales del Imperio, que abarca desde sus mejoras genéticas hasta las hazañas de los Capítulos famosos. – Arte emocionante que representa a los Adeptus Astartes en batallas épicas contra innumerables enemigos. – 93 hojas de datos que detallan los perfiles, equipo de guerra y habilidades únicas de cada unidad de los Marines Espaciales, desde los Scouts recién reclutados hasta los poderosos Dreadnoughts. – Siete destacamentos temáticos, como la Fuerza de Asedio del Yunque y la Vanguardia, cada uno con su propio conjunto de reglas especiales. – Reglas de Cruzada que verán a tus héroes cumplir poderosos juramentos mientras derrotan a los enemigos de la Humanidad, ganando gloria y honor. – Reglas de Patrulla de Combate autónomas y una guía de pintura, que te permiten jugar juegos rápidos con la Fuerza de Choque Octavius. – Una exhibición de \'Eavy Metal con miniaturas Citadel magníficamente pintadas para inspirarte, con una variedad de Capítulos de Marines Espaciales.  Este libro también contiene un código de un solo uso para desbloquear el contenido del Códex: Marines Espaciales en Warhammer 40,000: La App.', 47.50, 0, '60030101061_ENGSMCodex01.jpg', '60030101061_ENGSMCodex02.jpg', '60030101061_ENGSMCodex03.jpg', NULL, NULL, NULL, 2, 6),
(6, 'TOR GARADON', 'Tor Garadon es el Capitán de la Compañía de Batalla más antiguo de los Imperial Fists, un guerrero imparable en quien las lecciones del Primarca se personifican en su forma más punitiva. Con experiencia en miles de mundos, es un maestro del campo de batalla y un baluarte inflexible frente a quienes se enfrentan a la humanidad.\r\n\r\nArmado con un rifle grav montado en el generador dorsal y el puño de combate artesanal llamado la Mano del Desafío, Tor Garadon se cuenta entre los combatientes más formidables de los Imperial Fists. Incluso cuando las explosiones destrozan el suelo a su alrededor, el Capitán de la 3ª Compañía guía estoicamente el fuego de los guerreros a su alrededor con órdenes breves y la información de los blancos obtenida gracias a su dispositivo de señales.\r\n\r\nCon esta matriz de plástico de 21 piezas puedes montar un Capitán Tor Garadon e incluye una peana redonda Citadel de 40 mm.', 35.00, 9, '99120101258_SMIFTorGaradon01.jpg', '01 (3).jpg', '99120101258_SMIFTorGaradon02.jpg', '99120101258_SMIFTorGaradon04.jpg', '99120101342_SMIFTorGaradonStock.jpg', NULL, 2, 6),
(7, 'KILL TEAM: CÍRCULO DE HIEROTECNÓLOGOS', 'Este kit de plástico multicomponente permite montar un Círculo de Hierotecnólogos de ocho miniaturas de Necrones, que componen un comando completo de calculadores adquisidores mecánicos. Este set incluye un Tecnomante Criptecnólogo como líder, un Acelerador Plasmacita y un Reanimador para mejorar y reparar a los guerreros del Círculo, y cinco soldados Necrones que pueden montarse como certeros Omnicidas o como implacables Immortales. El kit incluye además componentes para mejorar un Inmortal a disciplinado agente Despotecnólogo, y otro a arcano asistente Aprentecnólogo.  Este kit contiene 125 componentes de plástico, 1 peana redonda de 50mm, 2 peanas redondas de 25mm y 5 peanas redondas de 32mm. Las miniaturas se suministran sin pintar y requieren montaje. Recomendamos usar pegamento para plástico Citadel y pinturas Citadel Colour.', 35.00, 0, '60010199049_EngKTShadowvaultGroup2.jpg', '01-01 (3).jpg', '01-01 (2).jpg', '01-01 (1).jpg', '01 (4).jpg', '99120110075_KT2NECHierotekCircle6.jpg', 2, 5),
(8, 'GHAZGHKULL THRAKA', 'Ghazghkull Mag Uruk Thraka es un poderoso profeta del ¡Waaagh!, capaz de llevar a miles de millones de Orkos a un frenesí de conquista y sangre. Es el pielverde más influyente de la galaxia, y lidera a millones a la guerra.\r\n\r\nLidera tu ejército Orko con este plato fuerte de miniatura. Se puede montar inclinado a su derecha mientras arrasa a sus enemigos con el arma de cuatro cañones Rugío de Mork, o inclinado a su izquierda, a punto de machakar a alguien con la devastadora Garra de Mork. Va acompañado a la batalla por su suertudo portaestandarte Makari. Ya estés buscando una completa bestia sobre el tablero o tu siguiente desafío de pintura, Ghazghkull Thraka es ideal. Sin duda es el profeta del ¡Waaagh!\r\n\r\nEse kit permite montar un Ghazghkull Thraka y un Makari. Viene provisto de 61 piezas de plástico y una peana redonda Citadel de 80 mm y una peana redonda Citadel de 25 mm.', 62.50, 0, '99120103079_ThrakaLead.jpg', '01 (8).jpg', '01 (9).jpg', '99120103079_ThrakaFeature1.jpg', '99120103079_ThrakaFeature2.jpg', '99120103079_ThrakaStock.jpg', 2, 7),
(9, 'PATRULLA DE COMBATE: TIRÁNIDOS', 'Los Tiránidos invaden la galaxia desde más allá del vacío intergaláctico. Sus flotas colmena se infiltran en cada sistema y en cada sector. El Enjambre Vardenghast es un cúmulo de organismos Tiránidos que ha segado una sangrienta cosecha entre sus víctimas. Los criptoeruditos imperiales los han categorizado como amenaza de clase alfa tras una serie de virulentas batallas a lo largo de la Línea Vardenghast. Estas violentas criaturas fluyen hacia el combate como un ente de conciencia única y cuerpos múltiples, donde se acercan al enemigo a toda velocidad y lo acribillan o lo descuartizan.  Consúmelo todo para mayor gloria de la Mente Colmena con Patrulla: Tiránidos. Esta caja contiene todas las unidades que necesitas para empezar tu ejército o expandir una colección ya existente. Estas miniatura proporcionan un enjambre fundamental sobre el que construir tu ejército Tiránido, aunque también se pueden usar como una fuerza completa para las partidas formato Patrulla de Warhammer 40,000. Las reglas de Patrulla ya están disponibles como descarga gratuita en el sitio web de Warhammer Community.  Esta caja incluye las siguientes miniaturas de plástico multicomponente: - 1 Tiránido Primus Alado - 1 Psicófago - 3 Saltadores de Von Ryan - 4 Espinogantes - 20 Termagantes, armados con perforacarnes - 2 Enjambres Devoradores  Todas las miniaturas vienen con sus correspondientes peanas. Estas miniaturas son de montaje a presión y por tanto pueden montarse sin pegamento. Las miniaturas vienen sin pintar, recomendamos usar pinturas Citadel Colour.', 130.00, 0, '60010199067_WH40kUltimateStarterSet3.jpg', '60010199057_LeviathanEXTRA10.jpg', '60010199057_LeviathanEXTRA17.jpg', '60010199057_LeviathanEXTRA13.jpg', '99120106063_TYRCP1.jpg', '99120106063_TYRCPStock.jpg', 2, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `category_id`, `name`) VALUES
(5, 2, 'Necrones'),
(6, 2, 'Marines Espaciales'),
(7, 2, 'Orkos'),
(8, 2, 'Tiranidos'),
(12, 4, 'Stormcast Eternals'),
(13, 4, 'Nighthaunt'),
(14, 4, 'Ironjawz'),
(15, 4, 'Sylvaneth'),
(16, 5, 'Alpha Legion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`id`, `nombre`, `fecha`, `descripcion`, `imagen`) VALUES
(5, 'Nexus Paria', '2024-06-29 20:18:00', '2000 puntos', 'rbjJwvMmDsRBPv0r.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `CodigoActivacion` varchar(100) DEFAULT NULL,
  `Activado` tinyint(1) DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Nombre`, `Apellido`, `Direccion`, `Telefono`, `Email`, `Password`, `Rol`, `Estado`, `imagen_perfil`, `fecha_registro`, `CodigoActivacion`, `Activado`, `reset_token`, `reset_token_expiration`) VALUES
(78, 'Mario', 'Conde Jimenez', 'Calle Obusera', '673260881', 'amconde1995@gmail.com', '$2y$10$iz4Cn08oZwB30gExI/c8p.HlGrN3/6F9iTyvJyTS7u0Yjik.899Xi', 'admin', 'activo', 'goku-dragon-ball-4k-wallpaper-uhdpaper.com-265@3@a.jpg', '2024-06-08 13:28:47', '5825', 1, '1243', '2024-06-16 12:08:38'),
(82, 'Juan', 'Jimenez', 'Calle Obusera', '673260881', 'templotfg24@gmail.com', '$2y$10$piI4AL6KO4BI7Uws5biL/.JsIADPtfQ9IEBplEvIk2HFrTUqAYN3O', 'cliente', 'activo', 'e9300db0fafaf90879fe707111da420d.png', '2024-06-10 08:38:16', NULL, 1, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  ADD PRIMARY KEY (`ID_FormaPago`);

--
-- Indices de la tabla `inscripciones_torneo`
--
ALTER TABLE `inscripciones_torneo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `torneo_id` (`torneo_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_FormaPago` (`ID_FormaPago`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`ID_Pedido`,`ID_Producto`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `fk_category` (`category_id`),
  ADD KEY `fk_subcategory` (`subcategory_id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `UQ_Email` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  MODIFY `ID_FormaPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inscripciones_torneo`
--
ALTER TABLE `inscripciones_torneo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones_torneo`
--
ALTER TABLE `inscripciones_torneo`
  ADD CONSTRAINT `inscripciones_torneo_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripciones_torneo_ibfk_2` FOREIGN KEY (`torneo_id`) REFERENCES `torneos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`ID_FormaPago`) REFERENCES `formas_pago` (`ID_FormaPago`);

--
-- Filtros para la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `pedidos_productos_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`),
  ADD CONSTRAINT `pedidos_productos_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategorias` (`id`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
