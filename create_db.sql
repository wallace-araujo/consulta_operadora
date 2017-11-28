CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `ult_acesso` timestamp NOT NULL,
  `adm` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


INSERT INTO `usuario` (`id_usuario`, `nome`, `usuario`, `senha`, `ult_acesso`, `adm`) VALUES
(1, 'Administrador', 'admin', '202cb962ac59075b964b07152d234b70', '2016-01-01 00:00:00', 1);