-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Nov-2020 às 23:35
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `ID` char(36) NOT NULL,
  `NOME` varchar(100) DEFAULT NULL,
  `DESCRICAO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`ID`, `NOME`, `DESCRICAO`) VALUES
('14b63877-25b8-11eb-8195-d094669e5b9b', 'Tecnologia', ' Habilidades, métodos e processos usados na produção de bens ou serviços'),
('24732c4d-25b7-11eb-8195-d094669e5b9b', 'Casa e Eletrodomésticos', 'Eletrodomésticos em oferta e com os melhores preços'),
('2ec1ee33-25b5-11eb-8195-d094669e5b9b', 'Joias e Relógios', 'Joias com design exclusivo e sofisticado'),
('554b883c-25b5-11eb-8195-d094669e5b9b', 'Brinquedos e Bebês', 'Aqui você encontra Boneca Barbie, Baby Alive, Carrinho Hot Wheels, Lego e muito mais.'),
('59a0dc8e-25b7-11eb-8195-d094669e5b9b', 'Ferramentas e Indústria', 'As ferramentas são materiais essenciais não só para os profissionais'),
('5eb253b4-26ad-11eb-a874-d094669e5b9b', 'Esporte e Lazer', 'Atividade Física, Saúde'),
('c2389622-274b-11eb-95f6-d094669e5b9b', 'Celulares e Telefones', 'Departamento de Celulares e Smartphones com as melhores Ofertas e Promoções');

--
-- Acionadores `categoria`
--
DELIMITER $$
CREATE TRIGGER `UUID_CATEGORIA` BEFORE INSERT ON `categoria` FOR EACH ROW SET new.ID = uuid()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `ID` char(36) NOT NULL,
  `ID_CATEGORIA` char(36) NOT NULL,
  `NOME` varchar(100) DEFAULT NULL,
  `DESCRICAO` varchar(100) DEFAULT NULL,
  `VALOR` decimal(15,2) DEFAULT NULL,
  `ESTOQUE` int(11) DEFAULT NULL,
  `CADASTRO` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`ID`, `ID_CATEGORIA`, `NOME`, `DESCRICAO`, `VALOR`, `ESTOQUE`, `CADASTRO`) VALUES
('92b24785-26ad-11eb-a874-d094669e5b9b', '5eb253b4-26ad-11eb-a874-d094669e5b9b', 'Bicicleta 29 Sutton', 'Bicicleta Sutton aro 29 em alumínio com freio a disco Hidráulico.', '1799.00', 7, '2020-11-14 16:14:09'),
('f34c1101-274b-11eb-95f6-d094669e5b9b', 'c2389622-274b-11eb-95f6-d094669e5b9b', 'iPhone 11 64 GB Branco', 'Fotos amplas e perfeitas dia e noite.', '4199.00', 6, '2020-11-15 11:07:52');

--
-- Acionadores `produto`
--
DELIMITER $$
CREATE TRIGGER `UUID_PRODUTO` BEFORE INSERT ON `produto` FOR EACH ROW SET new.ID = uuid()
$$
DELIMITER ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`ID`,`ID_CATEGORIA`),
  ADD KEY `FK_PRODUTO_CATEGORIA` (`ID_CATEGORIA`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `FK_PRODUTO_CATEGORIA` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
