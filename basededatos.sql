-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-01-2023 a las 10:50:36
-- Versión del servidor: 5.7.24
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfgunir`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

CREATE TABLE `activos` (
  `id` int(11) NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `hostname` text,
  `ip` text,
  `descripcion` text,
  `so` text,
  `vulnerabilidades` text,
  `propuestas` text,
  `recomendaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`id`, `cliente`, `tipo`, `hostname`, `ip`, `descripcion`, `so`, `vulnerabilidades`, `propuestas`, `recomendaciones`) VALUES
(1, 1, 2, 'dc121', '192.168.20.254', 'Servidor DC principal', 'Windows Server 2022', '1,', 'Propuestas del activo', 'Recomendación del activo'),
(2, 1, 1, 'google.es', '44.4.4.4', 'Web', 'Apache', '11,', '', ''),
(3, 1, 2, 'SQL2023', '10.10.10.5', 'Servidor SQL principal', 'Microsoft SQL 2023', NULL, NULL, NULL),
(4, 1, 2, 'nginx01', '10.10.10.4', 'Servidor Nginx', 'nginx', '12,13,', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nombre` text,
  `web` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `web`) VALUES
(1, 'Google', 'https://www.google.es'),
(2, 'Facebook', 'https://www.facebook.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE `informes` (
  `id` int(11) NOT NULL,
  `nombre_informe` varchar(255) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `activos` text,
  `estado` text,
  `fecha` date DEFAULT NULL,
  `recomendaciones` text,
  `propuestas` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informes`
--

INSERT INTO `informes` (`id`, `nombre_informe`, `id_cliente`, `activos`, `estado`, `fecha`, `recomendaciones`, `propuestas`) VALUES
(2, 'Informe de auditoría de Enero 2023', 1, '1,2,3,4,', 'Terminado', '2023-01-11', 'Recomendaciones generales del informe', 'Propuestas generales del informe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vulnerabilidades`
--

CREATE TABLE `vulnerabilidades` (
  `id` int(11) NOT NULL,
  `cve` text,
  `descripcion` text,
  `solucion` text,
  `criticidad` int(11) DEFAULT NULL,
  `esfuerzo` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `recomendacion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vulnerabilidades`
--

INSERT INTO `vulnerabilidades` (`id`, `cve`, `descripcion`, `solucion`, `criticidad`, `esfuerzo`, `categoria`, `recomendacion`) VALUES
(1, 'CVE-2022-0778', 'The Palo Alto Networks Product Security Assurance team has evaluated the OpenSSL infinite loop vulnerability (CVE-2022-0778) as it relates to our products.This vulnerability causes the OpenSSL library to enter an infinite loop when parsing an invalid certificate and can result in a Denial-of-Service (DoS) to the application. An attacker does not need a verified certificate to exploit this vulnerability because parsing a bad certificate triggers the infinite loop before the verification process is completed.The Prisma Cloud and Cortex XSOAR products are not impacted by this vulnerability. However, PAN-OS, GlobalProtect app, and Cortex XDR agent software contain a vulnerable version of the OpenSSL library and product availability is impacted by this vulnerability. For PAN-OS software, this includes both hardware and virtual firewalls and Panorama appliances as well as Prisma Access customers. This vulnerability has reduced severity on Cortex XDR agent and GlobalProtect app as successful exploitation requires a meddler-in-the-middle attack (MITM): 5.9 Medium (CVSS:3.1/AV:N/AC:H/PR:N/UI:N/S:U/C:N/I:N/A:H).All fixed versions of Cortex XDR agent, GlobalProtect app, and PAN-OS are now available.This issue impacts the following versions of PAN-OS:PAN-OS 8.1 versions earlier than PAN-OS 8.1.23;PAN-OS 9.0 versions earlier than PAN-OS 9.0.16-h2;PAN-OS 9.1 versions earlier than PAN-OS 9.1.13-h3;PAN-OS 10.0 versions earlier than PAN-OS 10.0.10;PAN-OS 10.1 versions earlier than PAN-OS 10.1.5-h1;PAN-OS 10.2 versions earlier than PAN-OS 10.2.1.This issue impacts the following versions of GlobalProtect app:GlobalProtect app 5.1 versions earlier than GlobalProtect app 5.1.11;GlobalProtect app 5.2 versions earlier than GlobalProtect app 5.2.12;GlobalProtect app 5.3 versions earlier than GlobalProtect app 5.3.4;GlobalProtect app 6.0 versions earlier than GlobalProtect app 6.0.1 on Windows and macOS;GlobalProtect app 6.0 versions earlier than GlobalProtect app 6.0.2 on Android and iOS.This issue impacts the following versions and builds of Cortex XDR agent:Cortex XDR agent 6.1 versions earlier than Cortex XDR agent 6.1.9 hotfix build 6.1.9.61370 on Windows;Cortex XDR agent 6.1 versions earlier than Cortex XDR agent 6.1.7 hotfix build 6.1.7.1690 on macOS;Cortex XDR agent 6.1 versions earlier than Cortex XDR agent 6.1.7 hotfix build 6.1.7.60245 on Linux;All versions and builds of Cortex XDR agent 7.4;Cortex XDR agent 7.5-CE versions earlier than Cortex XDR agent 7.5.100-CE hotfix build 7.5.100.60642 on Windows;Cortex XDR agent 7.5-CE versions earlier than Cortex XDR agent 7.5.100-CE hotfix build 7.5.100.2276 on macOS;Cortex XDR agent 7.5-CE versions earlier than Cortex XDR agent 7.5.100-CE hotfix build 7.5.100.59687 on LinuxCortex XDR agent 7.5 versions earlier than Cortex XDR agent 7.5.3 build 7.5.3.60113 on Windows;Cortex XDR agent 7.5 versions earlier than Cortex XDR agent 7.5.3 build 7.5.3.2265 on macOS;Cortex XDR agent 7.5 versions earlier than Cortex XDR agent 7.5.3 build 7.5.3.59465 on Linux;Cortex XDR agent 7.6 versions earlier than Cortex XDR agent 7.6.2 hotfix build 7.6.2.60545 on Windows;Cortex XDR agent 7.6 versions earlier than Cortex XDR agent 7.6.2 hotfix build 7.6.2.2311 on macOS;Cortex XDR agent 7.6 versions earlier than Cortex XDR agent 7.6.2 hotfix build 7.6.2.59612 on Linux;Cortex XDR agent 7.7 versions earlier than Cortex XDR agent 7.7.0 hotfix build 7.7.0.60725 on Windows;Cortex XDR agent 7.7 versions earlier than Cortex XDR agent 7.7.0 hotfix build 7.7.0.2356 on macOS;Cortex XDR agent 7.7 versions earlier than Cortex XDR agent 7.7.0 hotfix build 7.7.0.59559 on Linux.This issue is addressed for Prisma Access customers in the Prisma Access patch rollout that will begin on May 7, 2022 and will be a phased rollout performed based on theaters. Palo Alto Networks will send an additional email notification through Prisma Access Insights one week before the rollout begins for affected tenant(s).', 'This issue is fixed in PAN-OS 8.1.23, PAN-OS 9.0.16-h2, PAN-OS 9.1.13-h3, PAN-OS 10.0.10, PAN-OS 10.1.5-h1, PAN-OS 10.2.1, and all later PAN-OS versions.This issue is fixed in GlobalProtect app 5.1.11, GlobalProtect app 5.2.12, GlobalProtect app 5.3.4, GlobalProtect app 6.0.1 on Window and macOS, GlobalProtect app 6.0.2 on Android and iOS, and all later GlobalProtect app versions.This issue is fixed in Cortex XDR agent 6.1.9 hotfix build 6.1.9.61370 on Windows, Cortex XDR agent 6.1.7 hotfix build 6.1.7.1690 on macOS, Cortex XDR agent 6.1.7 hotfix build 6.1.7.60245 on Linux, Cortex XDR agent 7.5.100-CE hotfix build 7.5.100.60642 on Windows, Cortex XDR agent 7.5.100-CE hotfix build 7.5.100.2276 on macOS, Cortex XDR agent 7.5.100-CE hotfix build 7.5.100.59687 on Linux, Cortex XDR agent 7.5.3 build 7.5.3.60113 on Windows, Cortex XDR agent 7.5.3 build 7.5.3.2265 on macOS, Cortex XDR agent 7.5.3 build 7.5.3.59465 on Linux, Cortex XDR agent 7.6.2 hotfix build 7.6.2.60545 on Windows, Cortex XDR agent 7.6.2 hotfix build 7.6.2.2311 on macOS, Cortex XDR agent 7.6.2 hotfix build 7.6.2.59612 hotfix on Linux, Cortex XDR agent 7.7.0 hotfix build 7.7.0.60725 on Windows, Cortex XDR agent 7.7.0 hotfix build 7.7.0.2356 on macOS, Cortex XDR agent 7.7.0 hotfix build 7.7.0.59559 on Linux, and all later versions and builds of Cortex XDR agent. Cortex XDR agent 7.4 is end-of-life on May 24, 2022 and is not expected to receive a fix for this issue.This issue is addressed for Prisma Access customers in the Prisma Access patch rollout that will begin on May 7, 2022 and will be a phased rollout performed based on theaters. Palo Alto Networks will send an additional email notification through Prisma Access Insights one week before the rollout begins for affected tenant(s).', 4, 3, 1, 'Customers with a Threat Prevention subscription can block known attacks for this vulnerability by enabling Threat IDs 92409 and 92411 (Applications and Threats content update 8552). This mitigation reduces the risk of exploitation from known exploits.Customers will need to upgrade their products to a fixed version to completely remove the risk of this issue.'),
(11, 'CVE-2022-32749', 'Improper Check for Unusual or Exceptional Conditions vulnerability handling requests in Apache Traffic Server allows an attacker to crash the server under certain conditions. This issue affects Apache Traffic Server: from 8.0.0 through 9.1.3.', 'Mitigation: 8.x users should upgrade to 8.1.6 or later versions 9.x users should upgrade to 9.1.4 or later versions', 3, 2, 3, 'Actualizar a la versión recomendada'),
(12, 'CVE-2022-30209', 'Windows IIS Server Elevation of Privilege Vulnerability https://msrc.microsoft.com/update-guide/en-US/vulnerability/CVE-2022-30209', 'A complete vendor solution is available. Either the vendor has issued an official patch, or an upgrade is available.', 3, 3, 6, 'A complete vendor solution is available. Either the vendor has issued an official patch, or an upgrade is available.'),
(13, 'CVE-2021-32588', 'FortiPortal - Authentication bypass and remote code execution as root. A use of hard-coded credentials (CWE-798) vulnerability in FortiPortal versions 5.2.5 and below, 5.3.5 and below, 6.0.4 and below, versions 5.1.x and 5.0.x may allow a remote and unauthenticated attacker to execute unauthorized commands as root by uploading and deploying malicious web application archive files using the default hard-coded Tomcat Manager username and password. ', 'Actualizar a la versión correspondiente', 4, 2, 3, 'Actualizar a la versión correspondiente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `vulnerabilidades`
--
ALTER TABLE `vulnerabilidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activos`
--
ALTER TABLE `activos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `informes`
--
ALTER TABLE `informes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vulnerabilidades`
--
ALTER TABLE `vulnerabilidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
