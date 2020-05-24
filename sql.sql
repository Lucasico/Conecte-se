-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Maio-2020 às 22:49
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `twitter_cloner`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tweet` varchar(140) DEFAULT NULL,
  `data` datetime DEFAULT current_timestamp(),
  `curtir` int(11) DEFAULT NULL,
  `naoCurtir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tweets`
--

INSERT INTO `tweets` (`id`, `id_usuario`, `tweet`, `data`, `curtir`, `naoCurtir`) VALUES
(4, 5, 'TErceiro', '2020-05-20 11:52:26', 3, 9),
(7, 4, 'new teste', '2020-05-20 12:44:09', 4, 6),
(8, 4, 'Lucas tweet', '2020-05-21 16:24:54', 6, 8),
(9, 6, 'john 123\r\n', '2020-05-21 16:25:12', 3, 2),
(11, 8, 'farlei\r\n', '2020-05-21 16:25:37', 10, 12),
(26, 4, 'tese', '2020-05-21 20:06:16', 9, 29),
(36, 4, 'lucas', '2020-05-22 11:41:29', 72, 69),
(37, 4, '', '2020-05-22 17:51:45', 10, 5),
(39, 4, 'lllllllllllll', '2020-05-22 20:53:54', 6, 5),
(41, 4, 'novo poster', '2020-05-23 17:19:37', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(4, 'lucas bezerra dos santos', 'lucassantoscrfbezerra@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'marcio sousa', 'marcio@gmail.com', '202cb962ac59075b964b07152d234b70'),
(6, 'johnLenon', 'john123@gmial.com', '202cb962ac59075b964b07152d234b70'),
(7, 'maria', 'maria123@gmail.com', '202cb962ac59075b964b07152d234b70'),
(8, 'farler', 'farte@gmail.com', '202cb962ac59075b964b07152d234b70'),
(9, 'lucia', 'xisom80523@ximtyl.com', '202cb962ac59075b964b07152d234b70'),
(10, 'luaan pererira', 'luan@gmial.com', '202cb962ac59075b964b07152d234b70'),
(11, 'liomar', 'lucasico85@gmail.com', '202cb962ac59075b964b07152d234b70'),
(12, 'luvian', 'lucia@gmail.com', '151d71ff5173c3e5ade51b51b1429c7c'),
(13, 'luck', 'luck@gmail.com', '64c31821603ab476a318839606743bd6'),
(14, 'asdfasdf', 'lucas@gmail.com', '202cb962ac59075b964b07152d234b70'),
(15, 'ddddddddd', 'addd@gmail.com', '912ec803b2ce49e4a541068d495ab570'),
(16, 'adfasdf', 'asdf', 'f0118e9bd2c4fb29c64ee03abce698b8');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_seguidores`
--

CREATE TABLE `usuarios_seguidores` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_seguindo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios_seguidores`
--

INSERT INTO `usuarios_seguidores` (`id`, `id_usuario`, `id_usuario_seguindo`) VALUES
(11, 4, 5),
(12, 4, 7),
(13, 4, 6),
(14, 4, 8),
(15, 5, 4),
(16, 4, 9);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios_seguidores`
--
ALTER TABLE `usuarios_seguidores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios_seguidores`
--
ALTER TABLE `usuarios_seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
