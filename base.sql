/****
**/

CREATE TABLE `dispositivos` (
  `id` int(5) NOT NULL,
  `nd` varchar(20) NOT NULL,
  `lugar` varchar(3) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombredeusuario` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `estado` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombredeusuario` (`nombredeusuario`);

ALTER TABLE `dispositivos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

ALTER TABLE `usuarios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*INSERT INTO `usuarios` (`id`, `nombre`, `nombredeusuario`, `contraseña`, `estado`) VALUES
(1, 'Thomas Orozco', 'ThomasORZG', '6b8dfb572a284bd3710723575688b7aec73f7556', 'activo');*/