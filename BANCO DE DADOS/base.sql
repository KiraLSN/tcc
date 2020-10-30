-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 01-Out-2020 às 13:12
-- Versão do servidor: 10.1.45-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_sist_sis_pic_`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(255) NOT NULL,
  `id_orientador` varchar(500) DEFAULT NULL,
  `id_co_orientador` varchar(500) DEFAULT NULL,
  `nome` varchar(500) DEFAULT NULL,
  `curso` varchar(500) DEFAULT NULL,
  `faculdade` varchar(500) DEFAULT NULL,
  `cpf` varchar(500) DEFAULT NULL,
  `cr` varchar(500) DEFAULT NULL,
  `tipo` varchar(500) DEFAULT NULL,
  `arq_1` varchar(500) DEFAULT NULL,
  `arq_2` varchar(500) DEFAULT NULL,
  `arq_3` varchar(500) DEFAULT NULL,
  `arq_4` varchar(500) DEFAULT NULL,
  `arq_5` varchar(500) DEFAULT NULL,
  `arq_6` varchar(500) DEFAULT NULL,
  `arq_7` varchar(500) DEFAULT NULL,
  `arq_8` varchar(500) DEFAULT NULL,
  `arq_9` varchar(500) DEFAULT NULL,
  `data` varchar(20) DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `block` varchar(10) DEFAULT NULL,
  `arq_ori1` varchar(500) DEFAULT NULL,
  `arq_ori2` varchar(500) DEFAULT NULL,
  `arq_ori3` varchar(500) DEFAULT NULL,
  `arq_ori4` varchar(500) DEFAULT NULL,
  `arq_ori5` varchar(500) DEFAULT NULL,
  `arq_ori6` varchar(500) DEFAULT NULL,
  `arq_ori7` varchar(500) DEFAULT NULL,
  `arq_ori8` varchar(500) DEFAULT NULL,
  `arq_ori9` varchar(500) DEFAULT NULL,
  `arq_ori10` varchar(500) DEFAULT NULL,
  `arq_ori11` varchar(500) DEFAULT NULL,
  `arq_ori12` varchar(500) DEFAULT NULL,
  `nome_coorientado` varchar(500) DEFAULT NULL,
  `arq_co` varchar(500) DEFAULT NULL,
  `arq_co2` varchar(500) DEFAULT NULL,
  `arq_co3` varchar(500) DEFAULT NULL,
  `arq_co4` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `id_orientador`, `id_co_orientador`, `nome`, `curso`, `faculdade`, `cpf`, `cr`, `tipo`, `arq_1`, `arq_2`, `arq_3`, `arq_4`, `arq_5`, `arq_6`, `arq_7`, `arq_8`, `arq_9`, `data`, `hora`, `status`, `block`, `arq_ori1`, `arq_ori2`, `arq_ori3`, `arq_ori4`, `arq_ori5`, `arq_ori6`, `arq_ori7`, `arq_ori8`, `arq_ori9`, `arq_ori10`, `arq_ori11`, `arq_ori12`, `nome_coorientado`, `arq_co`, `arq_co2`, `arq_co3`, `arq_co4`) VALUES
(3, '2', '', 'Estudante A', 'Enfermagem', 'UFAM', '212.112.212-12', '98', '1', 'arquivos/2020/03/d3c0517f8689e5101389b943d4d6a845.PDF', 'arquivos/2020/03/7898411b76ae01d650938d7533269bc8.PDF', 'arquivos/2020/03/dcc3ea6ce29f68e9fffc19871aafe84d.PDF', 'arquivos/2020/03/101d58eb1292dc214cc9ebc4601a97d2.PDF', 'arquivos/2020/03/feb0bd2ede467903076f9fdcdca42ed1.PDF', 'arquivos/2020/03/c6c2a8361e46a972aee124f9e52f708a.PDF', 'arquivos/2020/03/30ca56e8c6fba6daddadcbbe207f514b.PDF', 'arquivos/2020/03/6592f83086fe2f08bc9189399c9e3a09.PDF', 'arquivos/2020/03/674eb40d2b624bc1d3a8ca38a59fb4d7.PDF', '2020-03-09', '13:05:00', '1', '1', '', '', '', '', 'arquivos/2020/03/fd146edd8e6def948e8157a5c11ed95b.PDF', 'arquivos/2020/03/94ab34d137d9f6a80652a3dca3d449b8.PDF', 'arquivos/2020/03/0dfb49ad228a71b410bd677bb55a1afa.PDF', 'arquivos/2020/03/a43eb2fd926806b9f36cfc7b4527f0a8.PDF', 'arquivos/2020/03/d28d4b36fc11343ffc5a2f5dcaeab7e5.PDF', 'arquivos/2020/03/fae064b6a1fbd68c61afc11b206a6830.PDF', 'arquivos/2020/03/31d616487bf64cb0948956f1ef57dd97.PDF', 'arquivos/2020/03/85bbafc61f05bc5cc3d3833f81559a34.PDF', 'Co-orientador A', 'arquivos/2020/03/72b75c6087eb4ab75a0dcf33c5bff6bc.PDF', 'arquivos/2020/03/5829d6a3ea1fbbd5fa4935bd2080f979.PDF', NULL, ''),
(4, '2', '', 'Estudande B', 'Biologia', 'IFAM', '454.545.545-45', '67', '1', 'arquivos/2020/03/172ed3a8556ca73207d1135e59b9a583.PDF', 'arquivos/2020/03/17bc889ee1fef7658a9bc66135393e0e.PDF', 'arquivos/2020/03/737afb6ad614afed7869db8fa27071d7.PDF', 'arquivos/2020/03/6a4958d8c49ba025d5343b629ad2e682.PDF', 'arquivos/2020/03/35a32da4bbfcb2cf4d0e4b78c2185cba.PDF', 'arquivos/2020/03/23205d494425bc11c437a58f514860a5.PDF', 'arquivos/2020/03/2fd15170cb48b796548afeaa66c4fa4e.PDF', 'arquivos/2020/03/90416a298c61d267ec90746c5c0a5f82.PDF', 'arquivos/2020/03/3aa365396cda0d4a75b1bae52c068804.PDF', '2020-03-09', '13:07:39', '1', '1', '', '', '', '', 'arquivos/2020/03/405df96dde1e070acde4ef3d91879896.PDF', 'arquivos/2020/03/56d49b64bb34243b37e52c1d59ad58fd.PDF', 'arquivos/2020/03/972582e6f9d33eb83dea0587da78f6cf.PDF', 'arquivos/2020/03/569f9197af7146c127d958e0def4f6f8.PDF', 'arquivos/2020/03/4d189386f4b8d7f30276653a7c8a548a.PDF', 'arquivos/2020/03/8afbea8f646daa8994bbced094403665.PDF', 'arquivos/2020/03/416985e3ec7f15cb28ab0198393761c9.PDF', 'arquivos/2020/03/1e3706133a89806974640e55591633bd.PDF', '', '', '', NULL, ''),
(5, '3', '', 'Sandrete Figueira', 'Biomedicina', 'UNIP', '212.144.554-45', '65', '1', '', 'arquivos/2020/03/8b380777dc1db9c84001eb17cc3084a9.PDF', 'arquivos/2020/03/74aa0b9ef28ad3633b5022fa9444bab3.PDF', 'arquivos/2020/03/cffdf1c2990ea62b4b7bd84b9ac31e8d.PDF', 'arquivos/2020/03/887dac927132a8c07bcfe3aa57f5b525.PDF', 'arquivos/2020/03/da152a7e55ffbc1be6fceb2c5d8e7f2b.PDF', 'arquivos/2020/03/b59e79805adfc9d0a701778a8ceddaaf.PDF', 'arquivos/2020/03/db8e48dd468a768967fe60adf1399e81.PDF', 'arquivos/2020/03/1cd89bcddb934e8af8c69a331a2ac510.PDF', '2020-03-09', '13:25:12', '1', '1', '', '', '', '', 'arquivos/2020/03/f8cfa90e36db9055a4702d3834401f74.PDF', 'arquivos/2020/03/1aa2935ba992398e191f6e4fac78c601.PDF', 'arquivos/2020/03/f9eee1e22b99f4ff6f993baa16e0e011.PDF', 'arquivos/2020/03/e198afffc36aa80ee7e267e3d273e326.PDF', 'arquivos/2020/03/c8797d27541dac2dc4454689d941b5e2.PDF', 'arquivos/2020/03/b8a589ebf6de4edcf8682654bd53d6a8.PDF', 'arquivos/2020/03/2cb5b74280d9d1bf4eaa47722cc67d97.PDF', 'arquivos/2020/03/2353284daaa5c1dde8d29747b606049e.PDF', 'Fabrício Chagas', 'arquivos/2020/03/5dd9d9d78dac0e612aa60708410987e9.PDF', 'arquivos/2020/03/dc435cf51ed45371de8f8e8c8a97c1b2.PDF', NULL, ''),
(6, '3', '', 'Tatyane Rabelo', 'Biotecnologia', 'Uninassau', '465.454.545-45', '7.6', '1', 'arquivos/2020/03/12bbd8dd7effcb7f3c0a1f701cbd6adf.PDF', 'arquivos/2020/03/99b83f8b7754b24b8a8df08945ecea0f.PDF', 'arquivos/2020/03/99bc4436e92e9a5f6ba7d6de0d0aa8d4.PDF', 'arquivos/2020/03/381398ad3f7c6aef56400723ba6466ac.PDF', 'arquivos/2020/03/69e9c97a22bd491a0110ccf79409bff1.PDF', 'arquivos/2020/03/4ad653c6f90046ed0d62854cc7db6a3c.PDF', 'arquivos/2020/03/358396a19c6ec31f47cfa019d086d87c.PDF', 'arquivos/2020/03/b28a17a34edc9316bdbfd922c1763bbf.PDF', 'arquivos/2020/03/0833e29588d92405ccc70e728bf92386.PDF', '2020-03-09', '13:30:14', '1', '1', '', '', '', '', 'arquivos/2020/03/f5df0b27325da842d528275a31518534.PDF', 'arquivos/2020/03/7bca33c9ca8ebcfeff6ad9f1f984b67a.PDF', 'arquivos/2020/03/68c838b563847ccddb0cacda20d5ba83.PDF', 'arquivos/2020/03/455e9616bce36ac8a8627151413ed3b5.PDF', 'arquivos/2020/03/7ca08cde14326ccc4a7e2d0dd1d477e0.PDF', 'arquivos/2020/03/61d66522e00251a585e0566342ac349c.PDF', 'arquivos/2020/03/30cc89b634f579aa096dfdeafe62e9f4.PDF', 'arquivos/2020/03/0fbcbccf30a4df53248c7f8edb8cc15f.PDF', '', '', '', NULL, ''),
(7, '2', '', 'Aluno C', 'Computação', 'Uninassau', '545.545.454-54', '65', '2', 'arquivos/2020/03/7b79e032a5edaf4648122a5ab491d865.PDF', 'arquivos/2020/03/b84e0290f91f7e672da40d81ab0921cd.PDF', 'arquivos/2020/03/967ab81c15a589f0e1da634a648cb3ed.PDF', 'arquivos/2020/03/1e02647c88267d25047527e6206df3c8.PDF', 'arquivos/2020/03/284ddf4ceb627a2ae1bc6b0ca00a6ad2.PDF', 'arquivos/2020/03/fc42766232cb2ee5ba5f14caac06df0d.PDF', 'arquivos/2020/03/86d788da05f0eafbd18022a3ebe95cde.PDF', 'arquivos/2020/03/0a50315d372802f4350f17803f93904b.PDF', '', '2020-03-10', '09:43:15', '1', '1', 'arquivos/2020/03/598b2908d2c8bab0ebf5d06498a3e875.PDF', 'arquivos/2020/03/a19cc2c8e5840fa9b7ce32aea7ab8ef6.PDF', 'arquivos/2020/03/e6da2efd14851b3daa938c02bc22aac6.PDF', 'arquivos/2020/03/3513d0296980e359ca90b438b2a97766.PDF', 'arquivos/2020/03/125f6aad17621b561d80474e61ec2666.PDF', 'arquivos/2020/03/48d10e13d122989bcfdc6d803c66f70c.PDF', 'arquivos/2020/03/e5be486887228f1311e1f7fd8a03c52f.PDF', 'arquivos/2020/03/e3135d81e470289ebd3d22c89de03567.PDF', 'arquivos/2020/03/47c4101759bae33aa5c4f05e472e6057.PDF', 'arquivos/2020/03/b8780cb82e2831105afd64f657d87e90.PDF', 'arquivos/2020/03/7edcca9a0a9376606a8a115bb338a84c.PDF', 'arquivos/2020/03/a7aaeb2b3cc00fb632eeb55f251aea77.PDF', 'Co-orientador C', '', '', NULL, ''),
(8, '4', '', 'Estudante F', 'Biotecnologia', 'UEA', '212.121.212-12', '87', '2', 'arquivos/2020/03/d2fd0438a772609181f49cd14883354e.PDF', 'arquivos/2020/03/0f0b028a16496309d184a166eb956198.PDF', 'arquivos/2020/03/71dda72651e04003360aef2aa48955d7.PDF', 'arquivos/2020/03/eae1fff1cd4066b31ad44784e204d709.PDF', 'arquivos/2020/03/3519d75082939b3ab5035f1b5371a1e2.PDF', 'arquivos/2020/03/dc612577537f2ad7c6ff15482acbd0af.PDF', 'arquivos/2020/03/137528c21d3ee411c644ea9d25c26dad.PDF', 'arquivos/2020/03/ff23d29b6d705a6525d03d2aae144535.PDF', '', '2020-03-10', '13:46:09', '1', '1', 'arquivos/2020/03/d6006b6c688519f94db90d2ce7917c16.PDF', 'arquivos/2020/03/e42159206d7a236e60e2f3be1976998c.PDF', 'arquivos/2020/03/e8f267be2e20d269a2307f67cb9acf78.PDF', 'arquivos/2020/03/2c944758f56c7e555b16c56959287c52.PDF', 'arquivos/2020/03/bd5b63e38f798275624dd26d52492a68.PDF', 'arquivos/2020/03/4f60bce7cfd7a77e0273d81f83fef255.PDF', 'arquivos/2020/03/0d245317073ccc82973236bff7d879f6.PDF', 'arquivos/2020/03/6e527528995d16f6b9849cac1c3f4cc4.PDF', 'arquivos/2020/03/c5942716d0f27caaff83f2eaddb235f0.PDF', 'arquivos/2020/03/6979790f82f39a85998a42873604b162.PDF', 'arquivos/2020/03/b05dde0b81c4e9e53a7ae6f05e50952b.PDF', 'arquivos/2020/03/09cad7f7233e43017bce333ed9fe9bdb.PDF', 'Co-orientador C', '', '', NULL, ''),
(9, '5', '', 'Estudante P', 'Enfermagem', 'UNIP', '454.654.654-54', '8,7', '1', 'arquivos/2020/03/d3fef14a47adb4e7a48f64ea7688c657.pdf', 'arquivos/2020/03/55b394125f0a985e1fcd4450dde95621.pdf', 'arquivos/2020/03/9768d97c8f31c377da7acf811dd5939c.pdf', 'arquivos/2020/03/0500bae5b333ad4ff7e1b20995a231bd.pdf', 'arquivos/2020/03/92834143989e1f612ad75a2519a94772.pdf', 'arquivos/2020/03/fbe9df15b90fabeb264eee1d1f1c74d8.pdf', 'arquivos/2020/03/7ff4a78283ae029aeca1d710ed62b7ef.pdf', 'arquivos/2020/03/4fee270e2a10738e096676a4ef7fe7a3.pdf', 'arquivos/2020/03/a329792bf64d3e4f5b70c893ff4b9102.pdf', '2020-03-10', '14:12:56', '1', '1', '', '', '', '', 'arquivos/2020/03/564e1f6cb6f6d98c080422260811cf82.pdf', 'arquivos/2020/03/5f95cae4aee9019a291a83359fb1d510.pdf', 'arquivos/2020/03/7beaf7c2f269dd40c8e2ff24e77197b0.pdf', 'arquivos/2020/03/30db28b54bdf9a623c045ac763396f9f.pdf', 'arquivos/2020/03/9b89dacbb55953fc2a907ebaf15f7be6.pdf', 'arquivos/2020/03/4b7a6dd9b9a963f183c586078f1dd5d5.pdf', 'arquivos/2020/03/b12c8d22d6dbbc731ef0876a6bc1b4a0.pdf', 'arquivos/2020/03/d5c99182c238a94b49a5a9af44292e2d.pdf', 'Co-orientador P', 'arquivos/2020/03/da3f31cbb5749fedbac9cbb2fc14d532.pdf', 'arquivos/2020/03/711e8ea5a0745165904e1a10bb2d7603.pdf', NULL, ''),
(11, '2', '', 'Aluno D', 'Fiosioterapia', 'UNIP', '868.456.857-86', '7,6', '2', '', 'arquivos/2020/04/e175d33aec7ec0688acb24b5a0987f8d.pdf', 'arquivos/2020/04/5d57f0b19672b452aee12ae5289f5b9f.pdf', 'arquivos/2020/04/a04367ee473b8fb7b97dfc7ba596c97a.pdf', 'arquivos/2020/04/6c2bb0d204959ef79830e7c96130056c.pdf', 'arquivos/2020/04/d79d2cbfd1d1a597fcdb336c195af089.pdf', 'arquivos/2020/04/1d89236ae666c6b782448e8f158b1431.pdf', 'arquivos/2020/04/e07a9840f734036e32772453af7a5760.pdf', 'arquivos/2020/04/996aac6f4f9e6b47fb3472f54f47756c.pdf', '2020-04-02', '16:57:11', '1', '1', '', '', '', 'arquivos/2020/04/87af97e479d54d885ec903ec4bcc4ca2.pdf', 'arquivos/2020/04/e7e011163b9bf6eb0b41322a48dff664.pdf', 'arquivos/2020/04/8755e98a0f7c8ebcda21999be5b1497e.pdf', 'arquivos/2020/04/36a85b6935744a08614a5d768c37f7ae.pdf', 'arquivos/2020/04/d8558a77ba036dbb005bec4a390cd923.pdf', 'arquivos/2020/04/266cb3b43928a36d10425334b0253cce.pdf', 'arquivos/2020/04/1eadb36d2125d1f62715a59f93995750.pdf', 'arquivos/2020/04/55501c25ac28995488cb8185e9a05a86.pdf', 'arquivos/2020/04/fdc3e3589965eea42b8d9669a77515f0.pdf', 'Agnaldo Lima Soares', 'arquivos/2020/04/dc6a88ecb236d487ab28903a9e552120.pdf', '', 'arquivos/2020/04/b54d884d075f236fd3a7ab2050dbc83e.doc', ''),
(12, '2', '', 'Aluno E', 'Biologia', 'Uninorte', '856.845.674-58', '7,7', '1', '', 'arquivos/2020/04/ebe12c2c8946c8a787d69c291f4f1863.pdf', 'arquivos/2020/04/185c970461e0f0570496fa246c6d30bc.pdf', 'arquivos/2020/04/3a8609791da03aa61a2df6e685ce26f5.pdf', 'arquivos/2020/04/130e1ec6954cb3593ab6a387a3811728.pdf', 'arquivos/2020/04/39788688ef854c4b723f7e003e0f3fe0.pdf', 'arquivos/2020/04/768eda476f56499195901a194be86387.pdf', 'arquivos/2020/04/127fb0cf172aef39b0d14b7f39a58135.pdf', 'arquivos/2020/04/92094bd1d8cd7ce64b8608c4d4510eca.pdf', '2020-04-02', '17:00:35', '1', '1', '', '', '', '', 'arquivos/2020/04/81f04a107efd785f3e21f1995874a146.pdf', 'arquivos/2020/04/a6ce427cb13addb4035a6919b28928f9.pdf', 'arquivos/2020/04/a068edd961fb638c7f6f7e46b79022d8.pdf', 'arquivos/2020/04/b121508e33aeca7fe69b66fcb6d95b3d.pdf', 'arquivos/2020/04/e0de5be36915a90226effef2ca8e24d2.pdf', 'arquivos/2020/04/146679b33528eaaa64f1f89212ffda80.pdf', 'arquivos/2020/04/6a7725c89fc62d2fd3205fb127d6f6e3.pdf', 'arquivos/2020/04/84bedaa542e74115ce0a36ff3f81f565.pdf', '', '', '', 'arquivos/2020/04/196d548debe26a05b0be0c6ef012b516.doc', ''),
(22, '2', '', 'efewwe', 'gewgwe', 'gewgewg', '000.000.000-00', '2,2', '2', '', 'arquivos/2020/04/bc4e53be1bda5c8353f5aaef702cd9e2.pdf', 'arquivos/2020/04/9a7925ecd2f74f68a0cbd0d4193fb642.pdf', 'arquivos/2020/04/c0fd2750ac1a515d3d51a1b4fd5fdf9c.pdf', 'arquivos/2020/04/915d73f3f7405a773fc5a31a75cf6441.pdf', 'arquivos/2020/04/8dc2f07df9275e7ece64ad11f6ce7e9e.pdf', 'arquivos/2020/04/72de90158c6acefa47ca5258860872f4.pdf', 'arquivos/2020/04/44c2f9a89063818f45e007542a98dd1d.pdf', 'arquivos/2020/04/611389c4c555be454e497eb77d0de09c.pdf', '2020-04-03', '13:14:50', '1', '1', '', '', '', 'arquivos/2020/04/08e0a27cb2a85bc15059ccb29a4b7a82.pdf', 'arquivos/2020/04/9cff4600640411ecca254301be9202ee.pdf', 'arquivos/2020/04/850ab879bdb7f097a1a48c1e77e29287.pdf', 'arquivos/2020/04/14908d13fbbf834162a83be297b83b6d.pdf', 'arquivos/2020/04/54a178bc343b4ee8c703af9f0461d242.pdf', 'arquivos/2020/04/157b21dce4f68f352f032c1fe2d7d6a8.pdf', 'arquivos/2020/04/5f09c1891b90b434553cee6bcecf0bd3.pdf', 'arquivos/2020/04/4dd71b0b9c85d460fddf918d79ad659c.pdf', 'arquivos/2020/04/ea32edb53b6090a22ed261872448bffc.pdf', 'teste', 'arquivos/2020/04/6f1dd1b91687e139124c77bae43ef82a.pdf', '', 'arquivos/2020/04/25f333719cf8097d14c0769ab12730f0.pdf', 'arquivos/2020/04/4ded9e51076a6ba14115db71768cc5ec.pdf'),
(23, '2', '', 'wfqfw', 'wfqwf', 'qwfqwf', '777.777.777-77', '7,7', '1', '', '', '', '', '', '', '', '', '', '2020-04-03', '13:18:26', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'arquivos/2020/04/74cac007610d0cfa975a31923c09f3bd.pdf', '', 'não entrei'),
(24, '2', '', 'Fabio Augusto', 'qwfwf', 'dwfwff', '888.888.888-88', '8,8', '2', '', 'arquivos/2020/04/28ffefe83951e68f8a389d2679e0916a.pdf', 'arquivos/2020/04/b47b900782ce0d02534f446447bb1d63.pdf', 'arquivos/2020/04/bf3387b0ad599db8432bc77a2eb10f3c.pdf', 'arquivos/2020/04/d6120bab9d40bae46efe889284c8a49b.pdf', 'arquivos/2020/04/18002ec838af83f3444baf0172271fa6.pdf', 'arquivos/2020/04/e3fd95a466cefe462279c5efd6c30ab7.pdf', 'arquivos/2020/04/f38b2f6b2c7e7d8c1bc0709a214efd1e.pdf', 'arquivos/2020/04/6b6e4d8da529fca18675a6b15f262ab9.pdf', '2020-04-03', '13:21:59', '1', '1', '', '', '', 'arquivos/2020/04/85e21996b72d1007f1af43831d159da6.pdf', 'arquivos/2020/04/7267434273e8dfb5230ac4ed78bc6d62.pdf', 'arquivos/2020/04/f9ca8a9afadf797cbdb09fdddc54f2f1.pdf', 'arquivos/2020/04/f0c3f2eba3a06479d3403be3843be5ac.pdf', 'arquivos/2020/04/3ad19b21e0495c198c53c05fff61b284.pdf', 'arquivos/2020/04/73a35e4dc14e8ffefb5cf90714631618.pdf', 'arquivos/2020/04/a9627018e93bfd010627a420f6afd1b2.pdf', 'arquivos/2020/04/ae3c22b862360f9826312babd77c0126.pdf', 'arquivos/2020/04/30f18bfd04ec97c922ba7a47d9195074.pdf', 'wwwwww', 'arquivos/2020/04/3a4513a39115a89dee1e24039d9a9cb0.pdf', '', 'arquivos/2020/04/9e67dbe3791c5b1a3cbbee96b0f28dee.docx', 'arquivos/2020/04/3e6fc65fa04d860af629ce329fa9f1be.pdf'),
(25, '2', '', 'fr3f2', 'f3f3', 'f3f3f', '222.222.222-22', '2,2', '1', '', '', '', '', '', '', '', '', '', '2020-04-03', '13:24:50', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'arquivos/2020/04/6c746cf53e8ab4218871e61c802ad4c9.pdf', '', 'não entrei'),
(26, '2', '', '24ty434', '43443', 'y4y4y', '555.555.555-55', '5,5', '2', '', 'arquivos/2020/04/2b8b81e87f23a4c3170f8b195ebc3f61.pdf', 'arquivos/2020/04/31b4b4332ea236f220e47e1d540ca3d5.pdf', 'arquivos/2020/04/bcc77fbf5430cae62a4a8912e139b36b.pdf', 'arquivos/2020/04/69ac1c11422aaaf8cedff7b100d60cf6.pdf', 'arquivos/2020/04/1bd3b523d783024ab82cddbfac4c6118.pdf', 'arquivos/2020/04/e832faf3632ef8c4f0787c48554ae1d5.pdf', 'arquivos/2020/04/2b7fc4132ade6c1807d34c7a7fabfa66.pdf', 'arquivos/2020/04/9f17903b857e190c85c92e9e5b7528a2.pdf', '2020-04-03', '13:27:33', '1', '1', '', '', '', 'arquivos/2020/04/d64aedd6bc0d8682dc909864be9c4e24.pdf', 'arquivos/2020/04/1c933f30c07d86d30840102d0ed5c424.pdf', 'arquivos/2020/04/145511f392d4213ed626cd6490b6098a.pdf', 'arquivos/2020/04/daefdf8ce64618a5ef67ea6c9eb282b8.pdf', 'arquivos/2020/04/47e3113fe347e61fc118d7f0044e261c.pdf', 'arquivos/2020/04/f1c77c3c883b184f969efdc1d9be2a43.pdf', 'arquivos/2020/04/8e6af76a991621950ea590f339b14312.pdf', 'arquivos/2020/04/f1b16506948c2419d7fd79c9a0a0c449.pdf', 'arquivos/2020/04/fd9eeeca763dfba2e262881d92db95ff.pdf', 'herhh', 'arquivos/2020/04/94e252bf1d484a0c3dceadacdefed76f.pdf', '', 'arquivos/2020/04/09808ca1dafeed6294a7690a702d411f.docx', 'arquivos/2020/04/460bd412dcca49f5115632ff8dfaae8e.pdf'),
(27, '2', '', 'd32321', 'r132r3r', 'r33r', '444.444.444-44', '4,4', '1', '', '', '', '', '', '', '', '', '', '2020-04-03', '13:59:54', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'arquivos/2020/04/08b13d83b8ac89e386b0c5f0f46ef4e6.pdf', '', ''),
(28, '2', '', 'Fabio Augusto', 'qwfwf', 'dwfwff', '555.555.555-55', '5,5', '2', '', 'arquivos/2020/04/4a301f2b81e9493aa49eccb1b7982dab.pdf', 'arquivos/2020/04/45150bc31f8cea5ad65607200c5f07e9.pdf', 'arquivos/2020/04/3b8eefdbc8165791697967d1d16b9342.pdf', 'arquivos/2020/04/622572372c741da5ec59b87de3fed3a7.pdf', 'arquivos/2020/04/edafbb1765fe21519b0f55fdce574b98.pdf', '', 'arquivos/2020/04/6db872234fe00389c340c0a3759078ca.pdf', 'arquivos/2020/04/fefeac81f89aa312d63abde05220a996.pdf', '2020-04-08', '15:59:29', '1', '1', '', '', '', 'arquivos/2020/04/f8cbe9dc7518eb88a6c16aceb5ceda05.pdf', 'arquivos/2020/04/426b491043a2d47342f3a0078cb96964.pdf', 'arquivos/2020/04/3686be98946921a179c8403b97ea75ea.pdf', 'arquivos/2020/04/ebc6611e3728a5606e2049431a706935.pdf', 'arquivos/2020/04/a8ffe6deb6f46ce145ad0500e76ce5ee.pdf', 'arquivos/2020/04/1cc767c271838fce6e844cbfcab68ca4.pdf', 'arquivos/2020/04/0ab7ace44b17e66bd8c30294f79f3d5a.pdf', 'arquivos/2020/04/02de2983058634a06fef68690b96db15.pdf', 'arquivos/2020/04/6d35e983b385d1e91773e59f12414fac.pdf', 'e4gt4', 'arquivos/2020/04/6c6c0ea37ab7b41d0b55a767e551c19a.pdf', 'arquivos/2020/04/1936a374de84b4644099c452ce543edb.pdf', 'arquivos/2020/04/6833d6e67f1039de1487cbfd7199dbc7.docx', 'arquivos/2020/04/0b565210c24f9bf6c99e710e78e52c76.pdf'),
(29, '7', '', 'Aluno AB', 'Enfermagem', 'Uninorte', '888.888.888-88', '8,6', '2', '', 'arquivos/2020/04/4cfd49fd1c0e9585f116cf822d8da1ea.pdf', 'arquivos/2020/04/8980c01f058f5f17e30267dcc0e652eb.pdf', 'arquivos/2020/04/1530334d797654d0cb9b8f0d407856f9.pdf', 'arquivos/2020/04/78d52cb5995ce966e4a1b9c6a8d1d374.pdf', 'arquivos/2020/04/2d28d714b7ba2e4b66b06418a44315a3.pdf', '', 'arquivos/2020/04/fdededd738c9ec829205af4ceba4f9be.pdf', 'arquivos/2020/04/cd5988778aa7bbeaf783e51fca88c1bf.pdf', '2020-04-24', '15:32:54', '1', '1', '', '', '', 'arquivos/2020/04/878a4518c5fb305225b59e239142f283.pdf', 'arquivos/2020/04/266994d01556e837b7eb8837af440305.pdf', 'arquivos/2020/04/a6e6143e298d38950c568a0de97e2e5c.pdf', 'arquivos/2020/04/0fc5806c7434e04281686ec44ee4927b.pdf', 'arquivos/2020/04/a58b3ec71c45b05b34a013bce149a297.pdf', 'arquivos/2020/04/771fe7df09dac717b918255468f671ea.pdf', 'arquivos/2020/04/a9acefd38dbd42c6b3d8413b39f037c9.pdf', 'arquivos/2020/04/5dce850e4ecfb5f16601520fb052b5c0.pdf', 'arquivos/2020/04/e6899905ca2740a0694b24da02431199.pdf', 'Luciano Oliveira', 'arquivos/2020/04/1f9e9b70fe2071348b4b611a9a97b27d.pdf', 'arquivos/2020/04/4c566d37956a06b2e9810c0d71af0414.pdf', 'arquivos/2020/04/25cc3f9439c8a6cfce5fcfd50ca05278.pdf', 'arquivos/2020/04/a9d84b1087c97dfedb63d9c1f438a12a.pdf'),
(30, '7', '', 'Aluno BC', 'Fisioterapia', 'Uninorte', '777.777.777-77', '7,7', '2', '', 'arquivos/2020/04/de4b48abee4617c35e0c3c3cc0eb9a1c.pdf', 'arquivos/2020/04/d967fdd1b298fc845e8e5fadc0ccd80f.pdf', 'arquivos/2020/04/04efdda6d8043c9beaef6a8447ba3350.pdf', 'arquivos/2020/04/17c65d5e01e51f1c8eeb0765cfe3cf54.pdf', 'arquivos/2020/04/80fd709a9b6451202b8fce5c59a8612b.pdf', '', 'arquivos/2020/04/377cdfb324e326bd5f0fe746a82acc5d.pdf', 'arquivos/2020/04/430cfe4727f3e2d08290b3d07d584b01.pdf', '2020-04-24', '15:39:33', '1', '1', '', '', '', 'arquivos/2020/04/8db75d838d46e681bb31c8064dd5cdb7.pdf', 'arquivos/2020/04/3440fb85f346f0700c6b6468eafc58a8.pdf', 'arquivos/2020/04/10865e11249a905f8173e1c07c3704cf.pdf', 'arquivos/2020/04/881116ebdc28e83efa83a66ab37255d5.pdf', 'arquivos/2020/04/3d6549ae109ff4223a9c86ae514559fd.pdf', 'arquivos/2020/04/e3d2e12bda625561bea528dbf4045767.pdf', 'arquivos/2020/04/fe775fe4fbbff17f26f2c500208303f9.pdf', 'arquivos/2020/04/639cb6791bedc7004c85e5466a0d8379.pdf', 'arquivos/2020/04/8f1a5ad5ce2cbb33bcfa46a8b69371b3.pdf', 'Luciano Nazareno', 'arquivos/2020/04/86fbd11d1db4cf107153cdadc262887e.pdf', 'arquivos/2020/04/84d934d7d337cee1baa8b2211cf72376.pdf', 'arquivos/2020/04/d9a8d610e79e48e6b0216afe6bdcd8fc.docx', 'arquivos/2020/04/86a3f65f9ed8dfe8a6c6537fe4b323ad.pdf'),
(31, '8', '', 'Aluna DF', 'Nutrição', 'Informática', '999.999.999-99', '7,7', '2', '', 'arquivos/2020/04/0b682495292230fa6484ac35ab0daa05.pdf', 'arquivos/2020/04/ed5c6d06257f7ffff45d73d62a293b98.pdf', 'arquivos/2020/04/7a642dd9eea949f93f9c7bc07dd746fe.pdf', 'arquivos/2020/04/52ae49451409a010530bc6f92c6fef73.pdf', 'arquivos/2020/04/852fcf58ad491efb629877ad6c15f373.pdf', '', 'arquivos/2020/04/ae53fa03bee68afd0ec2166f381884dc.pdf', 'arquivos/2020/04/3b25813ba55c6b3d1d3c3572b63a8e42.pdf', '2020-04-24', '16:32:45', '1', '1', '', '', '', 'arquivos/2020/04/3c948e2d03e036a782ff3bf1d6a4806a.pdf', 'arquivos/2020/04/976d93213e6ef425821a8b3eab5cab50.pdf', 'arquivos/2020/04/a23b0762ef856c21ba2be10a068f1abc.pdf', 'arquivos/2020/04/4a8ef2a6133face6febfb7e83bde55ba.pdf', 'arquivos/2020/04/3397d658b4de600533d65c0e1706c5ed.pdf', 'arquivos/2020/04/d1ee62fe88421c4d088ef8d8b1e0638d.pdf', 'arquivos/2020/04/78de8d3276a9ea4c2ee69346bfbc8222.pdf', 'arquivos/2020/04/aa6593f80e54d55420e10c01166dd99c.pdf', 'arquivos/2020/04/f932e0a5445cda7a6044b9a4a757b3c0.pdf', '', 'arquivos/2020/04/9409abfae22c1d3adac37c89487c63c9.pdf', 'arquivos/2020/04/ab5ea5b9f89e490b409d5eabf9df9460.pdf', 'arquivos/2020/04/dbc08bb52c7445219d720d076d850004.docx', 'arquivos/2020/04/9e09523002b53b55580c72f3f2b89eb7.pdf'),
(32, '2', '', 'Joana Ferreira Costa', 'Enfermagem', 'UNIP', '888.888.888-88', '7,7', '1', '', 'arquivos/2020/05/461cd88abc82b8af5ca35411727d5217.pdf', 'arquivos/2020/05/136620089c5a86b3d95b08a4f4b7f7e0.pdf', 'arquivos/2020/05/60ef9c8d3e586c13bd3064722759cf61.pdf', 'arquivos/2020/05/5746fd038c8b3dea9f3e909e19ba6e95.pdf', 'arquivos/2020/05/87fa57d0193af992c6183a72798bdb2e.pdf', '', 'arquivos/2020/05/c24dcd4d29e4e45132baf4811d5f1835.pdf', 'arquivos/2020/05/96e0542a11717a92c447d5870d2f51ad.pdf', '2020-05-08', '09:08:31', '1', '1', '', '', '', '', 'arquivos/2020/05/fb1b034869217fe2820937f840d4eb8b.pdf', 'arquivos/2020/05/9d7c9997bdb32dc746774c607e2c3746.pdf', 'arquivos/2020/05/5f05adaafd0682b9178438e178945925.pdf', 'arquivos/2020/05/67b8a8bdf662e0412e1b4e92779408e0.pdf', 'arquivos/2020/05/8d6b308cc9dedf70c151cf6b3172648e.pdf', 'arquivos/2020/05/355ea4c2757cdf23c78b5546aa05e245.pdf', 'arquivos/2020/05/f8dfd1114e2ce8c6e2a13cf85db2fe68.pdf', 'arquivos/2020/05/c9e6f95ec51d6c3efe2ad4bdc92fa62c.pdf', '', '', '', 'arquivos/2020/05/6509a78bb871914180ec3a95aa430e35.docx', 'arquivos/2020/05/fddb30261ba9eba17774af298139a420.pdf'),
(33, '9', '', 'Estudante A', 'Enfermagem', 'UEA', '888.888.888-88', '8,8', '1', '', 'arquivos/2020/05/fd57073006dbc3fa7736a7cd01d328a6.pdf', 'arquivos/2020/05/39df222b8aa4309396b73ce9ff40cbf3.pdf', 'arquivos/2020/05/34522691e31c9ef265ccf555bbbd863d.pdf', 'arquivos/2020/05/6c82b7430fd8e7337af08a7b6a5bfcd9.pdf', 'arquivos/2020/05/09db6d427d54d88e90d2f95009180581.pdf', '', 'arquivos/2020/05/4688de431b52cbf557f06b1bf572466b.pdf', 'arquivos/2020/05/b08fd1e6a0702e252363a9b9cb8ad43c.pdf', '2020-05-08', '09:19:29', '1', '1', '', '', '', '', 'arquivos/2020/05/a955f5663b977ccab15deb05bec2f64f.pdf', 'arquivos/2020/05/acb4290a32b8761f286bc5618f9a7dd6.pdf', 'arquivos/2020/05/2e9dd7547d346714e0d184c7b2b6e5f1.pdf', 'arquivos/2020/05/8309720199fe9b94785a00e42776b670.pdf', 'arquivos/2020/05/1143f219315e2490661ef65af8394349.pdf', 'arquivos/2020/05/ef9f10bebdcc4290cb683b247cae28a6.pdf', 'arquivos/2020/05/8cacbcf6bee66775a213aadd343c2223.pdf', 'arquivos/2020/05/86396a11752fa1fa5750c80e1b5fac1b.pdf', 'Orientador A', 'arquivos/2020/05/e18e1804124cb335a4dcb588a3066e69.pdf', 'arquivos/2020/05/b878e80991acee3c5998c4c41d3837f3.pdf', 'arquivos/2020/05/3bab3c9d720d153592ffc0ce46210c7f.docx', 'arquivos/2020/05/76ee5b1a02582348f179591aca603547.pdf'),
(34, '2', '', 'Teste Externo', 'Fisioterapia', 'Uninorte', '666.666.666-66', '8,8', '1', '', 'arquivos/2020/05/6c4136c441f84538b00c330f221bd0df.pdf', 'arquivos/2020/05/4905e74be40546ef9a127237ed1094b5.pdf', 'arquivos/2020/05/77122991a097a6fc4f1353059c855e91.pdf', 'arquivos/2020/05/080974a5f4672905400f8633a8f4f550.pdf', 'arquivos/2020/05/9e1285fcf56f11b320e108a19880cf36.pdf', '', 'arquivos/2020/05/a39922df02e43eaa92fed9b29e41ab8d.pdf', 'arquivos/2020/05/6c8f522472a062abf11adca1cbe30cec.pdf', '2020-05-08', '10:39:54', '1', '1', '', '', '', '', 'arquivos/2020/05/5e14baa5b5a14ae8a3fd7f2273af1225.pdf', 'arquivos/2020/05/75dc743a1893decc14ada724127b2bdf.pdf', 'arquivos/2020/05/bf23e319f010b967784e99fad78a8acc.pdf', 'arquivos/2020/05/ae68a8e388aa85a929d3b4973b02067b.pdf', 'arquivos/2020/05/b6f3d11f79ddc550cab2b82c9fcfb507.pdf', 'arquivos/2020/05/c681a9f574cc13218f4fd8429ac8c822.pdf', 'arquivos/2020/05/f1c2878871621671fae88166e3f13516.pdf', 'arquivos/2020/05/024c369a96496c2edf00ad711ab3a5e3.pdf', 'CoTeste', 'arquivos/2020/05/3ec47ef9bf172c6e1a8618261a9e7895.pdf', 'arquivos/2020/05/7c97b5ed34a9ae2ca89715446fa3a619.pdf', 'arquivos/2020/05/cb3faf1d2ed6c05e3f08c227ddd9a799.docx', 'arquivos/2020/05/f8b3218ef450ae34da1b98190d74f623.pdf'),
(35, '10', '', 'Stefanie Costa Pinto Lopes', 'Ciências Biológicas', 'centro universitario do norte', '322.515.668-05', '8', '1', '', 'arquivos/2020/05/c6b97fbd46a551be6c3be2a5d4e063b6.pdf', 'arquivos/2020/05/15ba0290bd1d268b806ee863314e7402.pdf', 'arquivos/2020/05/98e1eaf8cb1b42dac9fb78ffa1fd2175.pdf', 'arquivos/2020/05/8e67cafc62d7a36dd30f1c88338bfba6.pdf', 'arquivos/2020/05/705739f5fe29c72bd12a0e83bea81269.pdf', '', 'arquivos/2020/05/c8df90b73ab8deaf0a1c2cbbfd8d3a06.pdf', 'arquivos/2020/05/47bd783f59485e3fb5f6d515713e5e5f.pdf', '2020-05-08', '10:56:03', '1', '1', '', '', '', '', 'arquivos/2020/05/aa3f822d86f2442425b41a95c60f0602.pdf', 'arquivos/2020/05/80d17f94e04303faecb5b08199ed631c.pdf', 'arquivos/2020/05/1dc0a0f179c7a0d97ea76c63ee3a9f97.pdf', 'arquivos/2020/05/93827e16956a2fb1ccb8a2658f2ed0bd.pdf', 'arquivos/2020/05/9cbeaadb564cdf773df209d4eb40869a.pdf', 'arquivos/2020/05/e16b85f9f2c0316499757c318447cdaf.pdf', 'arquivos/2020/05/2cca7b6433758a5cc17d5dfd14aac533.pdf', 'arquivos/2020/05/d9e477f2e694586848681956ae010747.pdf', 'STEFANIE LOPES', 'arquivos/2020/05/327e06ffe61a4ee81c2c08e0af3ce0b2.pdf', 'arquivos/2020/05/eb0d0c2bab725684af1611908baef592.pdf', 'arquivos/2020/05/fd2c33d2ec375ed6a142cecf941ceaec.docx', 'arquivos/2020/05/de9b25cf2b6f7a755caad29da5d7a2a9.pdf'),
(36, '10', '', 'Stefanie Costa Pinto Lopes', 'Ciências Biológicas', 'centro universitario do norte', '012.345.678-90', '8', '1', '', '', '', '', '', '', '', '', '', '2020-05-08', '11:17:20', '1', '1', '', '', '', '', 'arquivos/2020/05/48de172b6153b1a175253c4a36d0014c.pdf', 'arquivos/2020/05/35bc937a8e4320d31f8920d4f45100ad.pdf', '', '', '', '', '', '', '', '', '', 'arquivos/2020/05/c50b993682c068aa8f2ca5d731de42d9.pdf', ''),
(37, '9', '', 'Quimica', 'Quimica', 'ufam', '000.000.000-00', '8,0', '1', '', 'arquivos/2020/05/37f57c27f133f489f6c618f73cc5ce5c.pdf', 'arquivos/2020/05/1420bb96dc7eedb132f42818be6a722b.pdf', 'arquivos/2020/05/3482f133589473cfeb9f140d9b31df86.pdf', 'arquivos/2020/05/3e08ac6f3dbac141b68438af81bb9843.pdf', 'arquivos/2020/05/916a4bfd16088a2bf47f5f999b94dabb.pdf', '', 'arquivos/2020/05/7e5369079cfa89b6c977ca07b34accfb.pdf', 'arquivos/2020/05/efe6fb3c1df11693ebc8f9e66c7f9926.pdf', '2020-05-08', '12:05:15', '1', '1', '', '', '', '', 'arquivos/2020/05/4314ba58a6c84acb2b0a5d301a2b8e06.pdf', '', '', '', 'arquivos/2020/05/e9e8dc3611459a1ccceac0ad4e77eb17.pdf', 'arquivos/2020/05/4d0ee376b6641373d39b628ce7161eac.pdf', 'arquivos/2020/05/1231e7c3cfe0827071ead661b7d58fa4.pdf', 'arquivos/2020/05/0246e5de7b99b1eb1b6d63f013f60b7c.pdf', '', '', '', 'arquivos/2020/05/a15123157f7f648f3e20fa680213dbbd.docx', 'arquivos/2020/05/9571d86874e6123f9effb2a34a1b03d4.pdf'),
(38, '2', '', 'Teste mesmo CPF', 'Enfermagem', 'Uninorte', '666.666.666-66', '6,6', '1', '', 'arquivos/2020/05/4a3b08825ecd2f0054381e3065934c59.pdf', 'arquivos/2020/05/ebbd581e710b095c51da6ea23f283924.pdf', 'arquivos/2020/05/ea26bd16bdf996ddd3e5c8f0a2ad8e16.pdf', 'arquivos/2020/05/cf810a70ea29ff8f3a8a2f3ed8866d1a.pdf', 'arquivos/2020/05/06d93c7c1fc5ca3ac607023856337408.pdf', '', 'arquivos/2020/05/cd4849fb35b5a6a6249636b494f14e17.pdf', 'arquivos/2020/05/48f5a8864e3eb0ad8bc1fa1f61291be5.pdf', '2020-05-08', '14:40:23', '1', '1', '', '', '', '', 'arquivos/2020/05/7ee210a235ed02f6cc684b09f57ee497.pdf', 'arquivos/2020/05/98b1dca1fa0466b30e1c31ba5ef42c65.pdf', 'arquivos/2020/05/05d5ab7eb71150ff282e338a445c2187.pdf', 'arquivos/2020/05/9aa3311c522df8820b09b03e96bed102.pdf', 'arquivos/2020/05/d6f9e5877e82ea0532d96e2b4bb175f9.pdf', 'arquivos/2020/05/f43f80638704b52573bf395d83cb509f.pdf', 'arquivos/2020/05/3b3eb2fdb7cf47eedb028f89c1292bc9.pdf', 'arquivos/2020/05/2f0db02128209fca5e3b1d797b394e11.pdf', 'Coorientador Teste', 'arquivos/2020/05/610745e1d33da00c552acaeab547e5a5.pdf', 'arquivos/2020/05/6fdd7a5ebecc1c414be3a6a0fd466a1f.pdf', 'arquivos/2020/05/6f8e08fcd2ef9a47968e43926e401cdc.docx', 'arquivos/2020/05/0894e933812694d57e013cb61d3c2041.pdf'),
(39, '2', '', 'Eduardo', 'Biologia', 'Unip', '222.222.222-22', '6,6', '1', '', 'arquivos/2020/05/dbe417b328ec92bd5758857ac41cf541.pdf', 'arquivos/2020/05/024445b5ab26c8f8a49f5c2da5df8831.pdf', 'arquivos/2020/05/0b99c383128599b027a654aa024b7989.pdf', 'arquivos/2020/05/8bcc66790b98d27300bc0562cc83023b.pdf', 'arquivos/2020/05/9833c67493723e8de335fbd25e75f6d4.pdf', '', 'arquivos/2020/05/2a274088098d4998ff454e9ab1727ec7.pdf', 'arquivos/2020/05/cd635e73acd55050dc75548f7acd3e0c.pdf', '2020-05-08', '14:42:12', '1', '1', '', '', '', '', 'arquivos/2020/05/0a416db3713f638787a96416db95fcd6.pdf', 'arquivos/2020/05/3bb69bc2dbe04f07522e663570e255fa.pdf', 'arquivos/2020/05/53805c10da19c61097b417d4cd9c5406.pdf', 'arquivos/2020/05/ceb919d4e9cd0fc767b3331b3ab408a8.pdf', 'arquivos/2020/05/9bc02dd9eef86ec6d78fa59380fe62d1.pdf', 'arquivos/2020/05/351a366b6ef6f85f4a638a00c554c7a3.pdf', 'arquivos/2020/05/19d92bf229c9557539c3fd1c1721cdad.pdf', 'arquivos/2020/05/9e1dd5d5141024993c8488a11eb1257a.pdf', '', '', '', 'arquivos/2020/05/4a4b366373697a5f6480e3c5a5eea06f.pdf', 'arquivos/2020/05/75f94d08005203b208045c5813b4ece5.pdf'),
(40, '9', '', 'Direito', 'direito', 'ufam', '010.101.010-10', '7,8', '1', '', 'arquivos/2020/05/57dbc524d151e184d73f8fd30281428d.pdf', 'arquivos/2020/05/6391280d54e719a6e7531cda4053be91.pdf', 'arquivos/2020/05/c2ef774289f3bdb5f65189a00b279fde.pdf', 'arquivos/2020/05/d47206986d9724c6dfbb08e14ead3e01.pdf', 'arquivos/2020/05/598b5ab3c1bc43960dc8e765e66d341b.pdf', '', 'arquivos/2020/05/b6f295d683f7226908cdc8c11bf66f76.pdf', 'arquivos/2020/05/4659d2760a42d9086e4fcfac26459bc3.pdf', '2020-05-08', '17:05:23', '1', '1', '', '', '', '', 'arquivos/2020/05/6440ca6dffc1482d65123206a3718d13.pdf', '', '', '', 'arquivos/2020/05/3f940996e08d2687afa8c20283b85169.pdf', 'arquivos/2020/05/4e3fe8a711acbe3b70fa04228fef34bf.pdf', 'arquivos/2020/05/3a91d82b8596798053d2b4aee888ea38.pdf', 'arquivos/2020/05/d681188dd96cee36440b9f9aa2648a8f.pdf', '', '', '', '', 'arquivos/2020/05/b2e6edea91cacc6a4b1b710244aa94d5.pdf'),
(41, '9', '', 'quimica', 'quimica', 'ufam', '000.000.000-01', '7,6', '2', '', 'arquivos/2020/05/5ff92096c4d84f64cff38f544292136e.pdf', 'arquivos/2020/05/3e083c7993c6dbe7ff12596bbb27855e.pdf', 'arquivos/2020/05/b5c2d7b11d45aeca948f3b2dac8ed7db.pdf', 'arquivos/2020/05/c1db757bf849f5e58304aca4dd758d3b.pdf', 'arquivos/2020/05/5002492a0c8c73c4dbbcd37912ead22a.pdf', '', 'arquivos/2020/05/672e053c854ed250961cb26c4ebf4dfd.pdf', 'arquivos/2020/05/0b3a5a740abfb6444f3ca6654f02382a.pdf', '2020-05-08', '17:09:27', '1', '1', '', '', '', '', 'arquivos/2020/05/1220c9acb8030bbaecbc6180b23d6bf3.pdf', 'arquivos/2020/05/64b682148c27061f8e3356e9b97ccd0a.pdf', '', '', 'arquivos/2020/05/359f5e1d17811a90c4969ea69c021c69.pdf', 'arquivos/2020/05/50c62de82e7ecf19b9ad727b00a0f337.pdf', 'arquivos/2020/05/7086f88b3a3d9b19cc5e0a117d959f01.pdf', 'arquivos/2020/05/6891743e7a0ac9a6cfd9d62b27ab0686.pdf', '', '', '', 'arquivos/2020/05/1596cd43da71000a861e0f5866715380.pdf', 'arquivos/2020/05/f6153de9ce7dff8f1a689f20ac99b5eb.pdf'),
(42, '10', '', 'Stefanie Costa Pinto Lopes', 'Ciências Biológicas', 'centro universitario do norte', '322.515.668-05', '8,0', '1', '', '', '', '', '', '', '', '', '', '2020-05-08', '18:12:58', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, '9', '', 'quimica', 'quimica', 'ufam', '000.000.000-01', '7,8', '1', '', '', '', '', '', '', '', '', '', '2020-05-09', '00:00:59', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(44, '2', '', 'Estudante W', 'Sistemas de Informação', 'Uninassau', '998.989.898-98', '9,9', '1', '', '', '', '', '', '', '', '', '', '2020-05-11', '17:10:18', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(45, '2', '', 'Estudante WW', 'Curso WW', 'Instituição WW', '999.999.999-99', '7,7', '1', '', 'arquivos/2020/05/84feaf480a8dcfcaab86b817d18c7e4c.pdf', 'arquivos/2020/05/3e830e0e2bb3b0a3cf41c97806e36248.pdf', 'arquivos/2020/05/da388eed27e17dc24ec95d24dc591e54.pdf', 'arquivos/2020/05/012521e540925352ae8142353e8e6460.pdf', 'arquivos/2020/05/58d2bd70de68473235318c2638880497.pdf', '', 'arquivos/2020/05/9bed79ad7fcd6333a039a78bf6037062.pdf', 'arquivos/2020/05/7dc37f6f4c3e033530e1af6446cd4f4c.pdf', '2020-05-12', '14:17:49', '1', '1', '', '', '', '', 'arquivos/2020/05/88a808ebee3e17abc1c8dc9a542feb5b.pdf', 'arquivos/2020/05/e34357d5d06cfee95bccb064e9e7ed64.pdf', 'arquivos/2020/05/4ed7920e8996f90c7a6b9934968c823f.pdf', 'arquivos/2020/05/7c5a4ca096ad4cf2113310c04053aa31.pdf', 'arquivos/2020/05/e841cb7dcc4aca1250883dc9e48b899d.pdf', 'arquivos/2020/05/30872f67858595b291d742e41b78e17a.pdf', 'arquivos/2020/05/5cbfc9c6135741b432d2e338ac37d118.pdf', 'arquivos/2020/05/de36e0a0eb6de8dcf5c67fcf74a403fb.pdf', '', '', '', 'arquivos/2020/05/5a64bc16f1149a0036c3642634c7e322.docx', 'arquivos/2020/05/06f694c75788d60a510ee68bd93a23e5.pdf'),
(46, '2', '', 'Estudante XX', 'Curso XX', 'Instituição XX', '888.888.888-88', '8,8', '2', '', 'arquivos/2020/05/d6a1951b3cf860828fb68db802167c61.pdf', 'arquivos/2020/05/0ea43b187b5896fdead419625946c5ca.pdf', 'arquivos/2020/05/792dd33c5a8a183d7ecd7807baa3e0f4.pdf', 'arquivos/2020/05/9ab52729451488d81407fa5d6bcbdd93.pdf', 'arquivos/2020/05/ba45961412056b9b9e8101fc9daf9d61.pdf', '', 'arquivos/2020/05/6a9070fc5ef5bc3a17011bdd18d90d9e.pdf', 'arquivos/2020/05/740868d56573c898344e63c8622e7cbd.pdf', '2020-05-12', '14:34:21', '1', '1', '', '', '', 'arquivos/2020/05/0daf71bead9a2b76b2c17543b9d5e600.pdf', 'arquivos/2020/05/dcdf0a146a5ad2523ab5d835bb30547a.pdf', 'arquivos/2020/05/4709633c2200e9188f816d28b3f5f9e9.pdf', 'arquivos/2020/05/dead9b3310a0687607aeae3811683722.pdf', 'arquivos/2020/05/df6e9a32841a7c6a2532b2bca19d1258.pdf', 'arquivos/2020/05/afaab3cc4c8aa5387352444f678b8871.pdf', 'arquivos/2020/05/3091b6e179a4c3613b3f7ea4bfbcb4e1.pdf', 'arquivos/2020/05/1c9ba0f566b890fae5e691dcbf4b56e8.pdf', 'arquivos/2020/05/f780e72314b2be3e4c63701645056592.pdf', 'Coorientador XX', 'arquivos/2020/05/30a3110611831704b6113be932014dcf.pdf', 'arquivos/2020/05/51383c3d8b4c97864991390fe4ba71a6.pdf', 'arquivos/2020/05/096641ad752cd174ffeb04abc712ed9e.pdf', 'arquivos/2020/05/0ef4847c7b712f5a937394eefc1889fc.pdf'),
(47, '2', '', 'Estudante YY', 'Curso YY', 'Instituição YY', '777.777.777-77', '6,6', '2', '', 'arquivos/2020/05/9af21370b67c683164871e4f89d0ecc6.pdf', 'arquivos/2020/05/6b016b348d026d6be36b939aaaf199d2.pdf', 'arquivos/2020/05/06eb662eeaad6bf65f2e7c504b68c057.pdf', 'arquivos/2020/05/5acd0239329c7f7ece507101cacb6b42.pdf', 'arquivos/2020/05/5e3075d211848ad16e96d6227d9c038c.pdf', '', 'arquivos/2020/05/20836195982b307db30a1a4935832dcc.pdf', 'arquivos/2020/05/78c5842050ca5a36ca0b1cb1d956748a.pdf', '2020-05-12', '14:36:33', '1', '1', '', '', '', 'arquivos/2020/05/d5c461fb96d227118f5e7367a0a099e2.pdf', 'arquivos/2020/05/d2fcf241b6027e458cb3c51e2efbb7b2.pdf', 'arquivos/2020/05/efcc66d770d81884e460216d00991f26.pdf', 'arquivos/2020/05/22e3c91b95f910f158924e2c827ca45b.pdf', 'arquivos/2020/05/201f01cd5019a319d234f50b25d5374b.pdf', 'arquivos/2020/05/8b8327a5d2db085191d3283898ada311.pdf', 'arquivos/2020/05/378bab30af04f2a3de104ed29ae81da4.pdf', 'arquivos/2020/05/4bc2e2bb3248bb3622e931ebf860dea1.pdf', 'arquivos/2020/05/5eee34becce9bfb6d1fcf056fa63fbd5.pdf', 'Coorientador YY', 'arquivos/2020/05/cdc96ae5c902b0660f5d05e9f43e4299.pdf', 'arquivos/2020/05/79024ac799e789c22727f3952e1fb0b4.pdf', 'arquivos/2020/05/cbe48789e13b6952aeadb3cf4f9e432b.docx', 'arquivos/2020/05/375595796172832b5fb99ab726d581f0.pdf'),
(48, '9', '', 'quimica 2', 'quimica', 'ufam', '019.100.019-99', '7,5', '1', '', 'arquivos/2020/05/9500f209dbc75e48cfb557f4da56966e.pdf', 'arquivos/2020/05/b81b27b1c397117845d6162ed77191ff.pdf', 'arquivos/2020/05/a9ea9d870cce9706a3bd1b9ffb0a138a.pdf', 'arquivos/2020/05/9a906354132d846f8e38fb542362c29e.pdf', 'arquivos/2020/05/7b5ca5f077d396a81b9c36710ceac1ec.pdf', '', 'arquivos/2020/05/ddd741c8058f6d776effdf932aabdcf0.pdf', 'arquivos/2020/05/189e589b911ae9ee56e73aef95cde748.pdf', '2020-05-12', '15:54:07', '1', '1', '', '', '', '', 'arquivos/2020/05/e2f71c9472ce1a32ab12fbb0dc86fa7f.pdf', 'arquivos/2020/05/fecf99f683438ac77f622d75c753a751.pdf', 'arquivos/2020/05/366ac9b3fa90169f4d810bec4210b01a.pdf', 'arquivos/2020/05/b043f6c97497b0454fc1ad86b4264aea.pdf', 'arquivos/2020/05/7c28d87393de9413888827c776234dd9.pdf', 'arquivos/2020/05/748e98d3c43b3bd3828a9224d9ef2ff7.pdf', 'arquivos/2020/05/581f51f391092e37a2d7ca5dbbf64a98.pdf', 'arquivos/2020/05/3a1a15af552c87a595905eb1856ffcf5.pdf', '', '', '', 'arquivos/2020/05/26ae7a17e756def716bf314de99f5a98.docx', 'arquivos/2020/05/60f0f65ba09d59524432ad42a42acbc9.pdf'),
(49, '9', '', 'quimica 1', 'quimica', 'uea', '000.000.000-01', '7,0', '2', '', 'arquivos/2020/05/9230ee13f91a8fcc85ec1142793b8169.pdf', 'arquivos/2020/05/a96af3793c26060a2ad457f5a74110ee.pdf', 'arquivos/2020/05/33003b74189e73da5619cc8674ee3078.pdf', 'arquivos/2020/05/339df09c2b11365a379b0789860b7122.pdf', 'arquivos/2020/05/933cfd0419eee08e666fb8848bf871e4.pdf', '', 'arquivos/2020/05/3b4c2174d5c229774b25d03ac9171800.pdf', 'arquivos/2020/05/9bc57f5a4a8336bde8ce888bdd1cddeb.pdf', '2020-05-12', '16:01:43', '1', '1', '', '', '', '', 'arquivos/2020/05/155ac4b9f58dbab1a3c0a7f6676e4e5e.pdf', 'arquivos/2020/05/7f4776020593e77c5db74bd6283ea27e.pdf', 'arquivos/2020/05/9d23a483fe5d1ff0a674e361fe9959f1.pdf', 'arquivos/2020/05/0ddde066abc66f1ac23804f298b74788.pdf', 'arquivos/2020/05/cba420a0fb4be9dfc2996956bcbe5b30.pdf', 'arquivos/2020/05/bd0e630a4fe011770b975fc02a896dbf.pdf', 'arquivos/2020/05/1256a3a857ac701b1a1c4a7253dd3cc2.pdf', 'arquivos/2020/05/751cdc8ae2d6238604d91a81e2c6724c.pdf', '', '', '', 'arquivos/2020/05/efc8bb8aacf8a3b0e07d996402125cef.pdf', 'arquivos/2020/05/e3ceb5f5592180922b3063b7600411b2.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `co_orientador`
--

CREATE TABLE `co_orientador` (
  `id` int(255) NOT NULL,
  `id_orientador` varchar(500) DEFAULT NULL,
  `nome` varchar(500) DEFAULT NULL,
  `arq_1` varchar(500) DEFAULT NULL,
  `arq_2` varchar(500) DEFAULT NULL,
  `data` varchar(20) DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `id_aluno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradas`
--

CREATE TABLE `entradas` (
  `id` int(255) NOT NULL,
  `data` varchar(500) DEFAULT NULL,
  `hora` varchar(500) DEFAULT NULL,
  `id_user` varchar(500) DEFAULT NULL,
  `ip` varchar(500) DEFAULT NULL,
  `navegador` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `entradas`
--

INSERT INTO `entradas` (`id`, `data`, `hora`, `id_user`, `ip`, `navegador`) VALUES
(1, '2020-03-09', '11:34:46', '1', '10.92.2.31', 'Chrome'),
(2, '2020-03-09', '11:37:36', '2', '10.92.2.31', 'Chrome'),
(3, '2020-03-09', '13:02:21', '1', '10.92.2.31', 'Chrome'),
(4, '2020-03-09', '13:02:51', '2', '10.92.2.31', 'Chrome'),
(5, '2020-03-09', '13:09:19', '1', '10.92.2.31', 'Chrome'),
(6, '2020-03-09', '13:15:48', '1', '10.92.2.31', 'Chrome'),
(7, '2020-03-09', '13:21:08', '1', '10.92.2.31', 'Chrome'),
(8, '2020-03-09', '13:22:25', '3', '10.92.2.31', 'Chrome'),
(9, '2020-03-09', '13:25:59', '1', '10.92.2.31', 'Chrome'),
(10, '2020-03-09', '13:42:47', '1', '10.92.2.31', 'Chrome'),
(11, '2020-03-09', '14:17:38', '1', '10.92.2.31', 'Chrome'),
(12, '2020-03-09', '14:28:42', '1', '10.92.2.31', 'Chrome'),
(13, '2020-03-09', '14:31:42', '2', '10.92.2.31', 'Chrome'),
(14, '2020-03-09', '14:32:50', '1', '10.92.2.31', 'Chrome'),
(15, '2020-03-10', '08:19:40', '2', '10.92.2.31', 'Chrome'),
(16, '2020-03-10', '09:16:59', '1', '10.92.2.31', 'Chrome'),
(17, '2020-03-10', '09:18:04', '4', '10.92.2.31', 'Chrome'),
(18, '2020-03-10', '09:19:45', '2', '10.92.2.31', 'Chrome'),
(19, '2020-03-10', '09:20:59', '2', '10.92.2.31', 'Chrome'),
(20, '2020-03-10', '09:24:14', '4', '10.92.2.31', 'Chrome'),
(21, '2020-03-10', '09:35:17', '1', '10.92.2.31', 'Chrome'),
(22, '2020-03-10', '09:37:43', '2', '10.92.2.31', 'Chrome'),
(23, '2020-03-10', '09:43:55', '1', '10.92.2.31', 'Chrome'),
(24, '2020-03-10', '13:36:08', '1', '10.92.2.31', 'Chrome'),
(25, '2020-03-10', '13:37:43', '4', '10.92.2.31', 'Chrome'),
(26, '2020-03-10', '13:59:27', '1', '10.92.3.47', 'Chrome'),
(27, '2020-03-10', '14:00:51', '1', '10.92.3.47', 'Chrome'),
(28, '2020-03-10', '14:04:04', '5', '10.92.3.47', 'Chrome'),
(29, '2020-03-10', '14:21:13', '1', '10.92.3.47', 'Chrome'),
(30, '2020-03-10', '14:29:39', '5', '10.92.3.47', 'Chrome'),
(31, '2020-03-12', '11:29:18', '1', '10.92.2.31', 'Chrome'),
(32, '2020-03-12', '11:29:41', '2', '10.92.2.31', 'Chrome'),
(33, '2020-03-12', '11:33:26', '2', '10.92.2.31', 'Chrome'),
(34, '2020-03-12', '13:32:18', '1', '10.92.2.31', 'Chrome'),
(35, '2020-03-26', '11:51:18', '1', '::1', 'Chrome'),
(36, '2020-03-30', '01:34:01', '1', '::1', 'Chrome'),
(37, '2020-03-30', '01:35:40', '1', '::1', 'Chrome'),
(38, '2020-03-30', '01:36:14', '2', '::1', 'Chrome'),
(39, '2020-03-30', '01:36:30', '2', '::1', 'Chrome'),
(40, '2020-03-30', '01:46:36', '3', '::1', 'Chrome'),
(41, '2020-03-30', '01:50:23', '3', '::1', 'Chrome'),
(42, '2020-03-30', '01:50:25', '3', '::1', 'Chrome'),
(43, '2020-03-30', '12:53:07', '3', '191.189.0.107', 'Chrome'),
(44, '2020-04-02', '10:15:06', '1', '191.189.0.107', 'Chrome'),
(45, '2020-04-02', '10:15:49', '2', '191.189.0.107', 'Chrome'),
(46, '2020-04-02', '13:50:30', '2', '191.189.0.107', 'Chrome'),
(47, '2020-04-02', '16:01:46', '2', '179.222.18.174', 'Chrome'),
(48, '2020-04-02', '16:02:04', '2', '179.222.18.174', 'Chrome'),
(49, '2020-04-02', '16:13:18', '2', '191.189.0.107', 'Chrome'),
(50, '2020-04-02', '16:28:32', '2', '179.222.18.174', 'Chrome'),
(51, '2020-04-02', '16:33:04', '2', '179.222.18.174', 'Chrome'),
(52, '2020-04-02', '16:54:02', '2', '179.222.18.174', 'Chrome'),
(53, '2020-04-03', '12:23:40', '2', '191.189.0.107', 'Chrome'),
(54, '2020-04-03', '13:59:03', '2', '191.189.0.107', 'Chrome'),
(55, '2020-04-06', '11:22:16', '5', '10.92.2.31', 'Chrome'),
(56, '2020-04-08', '15:47:56', '2', '191.189.0.107', 'Chrome'),
(57, '2020-04-08', '16:13:58', '1', '191.189.0.107', 'Chrome'),
(58, '2020-04-08', '17:15:44', '1', '191.189.0.107', 'Chrome'),
(59, '2020-04-08', '17:16:44', '1', '191.189.0.107', 'Chrome'),
(60, '2020-04-08', '17:17:57', '1', '191.189.0.107', 'Chrome'),
(61, '2020-04-08', '17:27:31', '1', '191.189.0.107', 'Chrome'),
(62, '2020-04-13', '16:30:17', '2', '191.189.0.107', 'Chrome'),
(63, '2020-04-15', '15:58:13', '2', '191.189.0.107', 'Chrome'),
(64, '2020-04-15', '16:08:41', '1', '191.189.0.107', 'Chrome'),
(65, '2020-04-22', '09:18:34', '1', '10.92.4.9', 'Chrome'),
(66, '2020-04-22', '09:23:27', '6', '10.92.4.9', 'Chrome'),
(67, '2020-04-24', '10:11:36', '1', '179.222.18.168', 'Chrome'),
(68, '2020-04-24', '15:09:43', '1', '10.92.4.9', 'Chrome'),
(69, '2020-04-24', '15:14:03', '7', '10.92.4.9', 'Chrome'),
(70, '2020-04-24', '15:26:15', '1', '10.92.4.9', 'Chrome'),
(71, '2020-04-24', '15:28:26', '7', '10.92.4.9', 'Chrome'),
(72, '2020-04-24', '15:41:12', '1', '10.92.4.9', 'Chrome'),
(73, '2020-04-24', '15:41:34', '1', '10.92.4.9', 'Chrome'),
(74, '2020-04-24', '15:53:10', '7', '10.92.4.9', 'Chrome'),
(75, '2020-04-24', '16:19:56', '1', '10.92.4.9', 'Chrome'),
(76, '2020-04-24', '16:21:04', '8', '10.92.4.9', 'Chrome'),
(77, '2020-04-24', '16:36:55', '1', '10.92.4.9', 'Chrome'),
(78, '2020-04-24', '16:39:32', '1', '10.92.4.9', 'Chrome'),
(79, '2020-05-06', '12:43:16', '2', '179.222.17.78', 'Outros'),
(80, '2020-05-07', '20:52:43', '1', '179.222.17.84', 'Chrome'),
(81, '2020-05-07', '20:53:12', '1', '179.222.17.84', 'Chrome'),
(82, '2020-05-07', '21:22:30', '1', '179.222.17.84', 'Chrome'),
(83, '2020-05-07', '21:28:45', '1', '179.222.17.84', 'Chrome'),
(84, '2020-05-07', '21:32:04', '1', '191.189.25.26', 'Chrome'),
(85, '2020-05-07', '21:34:58', '1', '179.222.17.84', 'Chrome'),
(86, '2020-05-07', '22:00:37', '1', '191.189.25.26', 'Chrome'),
(87, '2020-05-07', '22:02:20', '1', '191.189.25.26', 'Chrome'),
(88, '2020-05-07', '22:08:56', '9', '191.189.25.26', 'Chrome'),
(89, '2020-05-07', '22:27:15', '1', '191.189.25.26', 'Chrome'),
(90, '2020-05-07', '23:06:35', '9', '191.189.25.26', 'Chrome'),
(91, '2020-05-07', '23:07:43', '1', '191.189.25.26', 'Chrome'),
(92, '2020-05-08', '08:22:35', '10', '179.215.124.32', 'Firefox'),
(93, '2020-05-08', '08:32:23', '4', '10.92.4.9', 'Chrome'),
(94, '2020-05-08', '08:34:50', '9', '191.189.25.26', 'Chrome'),
(95, '2020-05-08', '09:02:05', '2', '10.92.4.9', 'Chrome'),
(96, '2020-05-08', '09:13:33', '1', '10.92.4.9', 'Chrome'),
(97, '2020-05-08', '09:17:15', '9', '10.92.4.9', 'Chrome'),
(98, '2020-05-08', '09:22:49', '9', '191.189.25.26', 'Chrome'),
(99, '2020-05-08', '09:22:57', '1', '10.92.4.9', 'Chrome'),
(100, '2020-05-08', '09:33:02', '1', '10.92.4.9', 'Chrome'),
(101, '2020-05-08', '09:33:58', '4', '10.92.4.9', 'Chrome'),
(102, '2020-05-08', '09:38:00', '4', '10.92.4.9', 'Chrome'),
(103, '2020-05-08', '09:38:08', '42', '191.189.25.26', 'Chrome'),
(104, '2020-05-08', '09:40:20', '4', '10.92.4.9', 'Chrome'),
(105, '2020-05-08', '09:43:55', '42', '191.189.25.26', 'Chrome'),
(106, '2020-05-08', '09:44:58', '4', '10.92.4.9', 'Chrome'),
(107, '2020-05-08', '09:48:21', '42', '191.189.25.26', 'Chrome'),
(108, '2020-05-08', '09:51:05', '4', '10.92.4.9', 'Chrome'),
(109, '2020-05-08', '09:51:39', '4', '10.92.4.9', 'Chrome'),
(110, '2020-05-08', '09:55:34', '2', '10.92.4.9', 'Chrome'),
(111, '2020-05-08', '09:59:18', '42', '191.189.25.26', 'Firefox'),
(112, '2020-05-08', '10:36:36', '2', '10.92.4.9', 'Chrome'),
(113, '2020-05-08', '10:56:13', '10', '179.215.124.32', 'Firefox'),
(114, '2020-05-08', '11:06:42', '42', '191.189.25.26', 'Firefox'),
(115, '2020-05-08', '11:15:54', '10', '179.215.124.32', 'Firefox'),
(116, '2020-05-08', '11:25:50', '9', '191.189.25.26', 'Chrome'),
(117, '2020-05-08', '11:57:16', '9', '191.189.25.26', 'Chrome'),
(118, '2020-05-08', '12:03:56', '42', '191.189.25.26', 'Firefox'),
(119, '2020-05-08', '14:17:36', '2', '10.92.4.9', 'Chrome'),
(120, '2020-05-08', '14:29:41', '4', '10.92.4.9', 'Chrome'),
(121, '2020-05-08', '14:30:38', '2', '10.92.4.9', 'Chrome'),
(122, '2020-05-08', '14:38:46', '9', '191.189.25.26', 'Chrome'),
(123, '2020-05-08', '14:38:46', '2', '10.92.4.9', 'Chrome'),
(124, '2020-05-08', '14:42:09', '9', '191.189.25.26', 'Chrome'),
(125, '2020-05-08', '14:47:07', '42', '191.189.25.26', 'Firefox'),
(126, '2020-05-08', '14:48:28', '42', '191.189.25.26', 'Firefox'),
(127, '2020-05-08', '14:54:14', '42', '191.189.25.26', 'Firefox'),
(128, '2020-05-08', '15:13:15', '2', '10.92.4.9', 'Chrome'),
(129, '2020-05-08', '15:14:36', '2', '10.92.4.9', 'Chrome'),
(130, '2020-05-08', '15:16:15', '2', '10.92.4.9', 'Chrome'),
(131, '2020-05-08', '15:18:35', '42', '191.189.25.26', 'Firefox'),
(132, '2020-05-08', '15:19:25', '2', '10.92.4.9', 'Chrome'),
(133, '2020-05-08', '15:32:26', '2', '10.92.4.9', 'Chrome'),
(134, '2020-05-08', '16:42:59', '1', '191.189.25.26', 'Firefox'),
(135, '2020-05-08', '16:50:54', '9', '191.189.25.26', 'Firefox'),
(136, '2020-05-08', '17:01:29', '9', '191.189.25.26', 'Chrome'),
(137, '2020-05-08', '18:07:26', '10', '179.215.124.32', 'Firefox'),
(138, '2020-05-08', '23:59:52', '9', '191.189.25.26', 'Chrome'),
(139, '2020-05-11', '10:40:32', '1', '10.92.4.9', 'Chrome'),
(140, '2020-05-11', '10:40:55', '2', '10.92.4.9', 'Chrome'),
(141, '2020-05-11', '11:52:26', '4', '10.92.4.9', 'Chrome'),
(142, '2020-05-11', '11:54:54', '1', '10.92.4.9', 'Chrome'),
(143, '2020-05-11', '14:19:16', '2', '10.92.4.9', 'Chrome'),
(144, '2020-05-11', '14:24:24', '2', '10.92.4.9', 'Chrome'),
(145, '2020-05-11', '14:25:05', '4', '10.92.4.9', 'Chrome'),
(146, '2020-05-11', '15:17:02', '2', '10.92.4.9', 'Chrome'),
(147, '2020-05-11', '15:20:50', '1', '10.92.4.9', 'Chrome'),
(148, '2020-05-11', '15:23:58', '2', '10.92.4.9', 'Chrome'),
(149, '2020-05-11', '15:34:46', '2', '10.92.4.9', 'Chrome'),
(150, '2020-05-11', '15:39:53', '2', '10.92.4.9', 'Chrome'),
(151, '2020-05-11', '16:26:57', '2', '10.92.4.9', 'Chrome'),
(152, '2020-05-11', '16:55:04', '1', '10.92.4.9', 'Chrome'),
(153, '2020-05-11', '16:55:26', '2', '10.92.4.9', 'Chrome'),
(154, '2020-05-11', '17:00:45', '4', '10.92.4.9', 'Chrome'),
(155, '2020-05-11', '17:03:47', '4', '10.92.4.9', 'Chrome'),
(156, '2020-05-11', '17:09:34', '2', '10.92.4.9', 'Chrome'),
(157, '2020-05-11', '17:12:49', '2', '10.92.4.9', 'Chrome'),
(158, '2020-05-12', '14:12:11', '2', '10.92.4.9', 'Chrome'),
(159, '2020-05-12', '14:19:20', '4', '10.92.4.9', 'Chrome'),
(160, '2020-05-12', '14:34:53', '2', '10.92.4.9', 'Chrome'),
(161, '2020-05-12', '14:36:59', '2', '10.92.4.9', 'Chrome'),
(162, '2020-05-12', '14:37:25', '4', '10.92.4.9', 'Chrome'),
(163, '2020-05-12', '15:45:36', '9', '191.189.25.26', 'Chrome'),
(164, '2020-05-12', '16:02:22', '1', '10.92.4.9', 'Chrome'),
(165, '2020-05-12', '16:02:42', '2', '10.92.4.9', 'Chrome'),
(166, '2020-05-12', '16:05:02', '2', '10.92.4.9', 'Chrome'),
(167, '2020-05-12', '16:13:16', '2', '10.92.4.9', 'Chrome'),
(168, '2020-05-12', '16:14:27', '2', '10.92.4.9', 'Chrome'),
(169, '2020-05-12', '16:17:28', '2', '10.92.4.9', 'Chrome'),
(170, '2020-05-12', '16:18:36', '4', '10.92.4.9', 'Chrome');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orientador`
--

CREATE TABLE `orientador` (
  `id` int(255) NOT NULL,
  `nome` varchar(500) DEFAULT NULL,
  `ilmd` varchar(500) DEFAULT NULL,
  `cpf` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `senha` varchar(500) DEFAULT NULL,
  `arq_1` varchar(500) DEFAULT NULL,
  `arq_2` varchar(500) DEFAULT NULL,
  `arq_3` varchar(500) DEFAULT NULL,
  `arq_4` varchar(500) DEFAULT NULL,
  `arq_5` varchar(500) DEFAULT NULL,
  `arq_6` varchar(500) DEFAULT NULL,
  `arq_7` varchar(500) DEFAULT NULL,
  `arq_8` varchar(500) DEFAULT NULL,
  `arq_9` varchar(500) DEFAULT NULL,
  `data` varchar(20) DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `orientador`
--

INSERT INTO `orientador` (`id`, `nome`, `ilmd`, `cpf`, `email`, `senha`, `arq_1`, `arq_2`, `arq_3`, `arq_4`, `arq_5`, `arq_6`, `arq_7`, `arq_8`, `arq_9`, `data`, `hora`, `status`) VALUES
(1, 'João Carlos', 'Analista (FIOTEC)', '021.594.665-89', 'joao.oliveira@fiocruz.br', 'Manaus@2019', '', '', '', '', '', '', '', '', '', '2020-01-10', '13:02:54', '1'),
(2, 'Usuário de Teste', 'Servidor', '648.558.992-91', 'jose.nogueira@fiocruz.br', 'Manaus@2019', '', '', '', '', '', '', '', '', NULL, '2020-03-09', '11:37:13', '1'),
(3, 'Williams cavalcante Oliveira', 'Servidor', '013.440.545-20', 'williams.oliveira@fiocruz.br', '013.440.545-20', '', '', '', '', '', '', '', '', '', '2020-03-09', '13:21:50', '3'),
(5, 'Stefanie Oliveira', 'Servidor', '545.454.545-54', 'stefanie.oliveira@fiocruz.br', '545.454.545-54', '', '', '', '', '', '', '', '', NULL, '2020-03-10', '14:00:19', '3'),
(7, 'Carlos Augusto Silva', 'Servidor', '555.555.555-55', 'carlos.augusto@fiocruz.br', 'Manaus@2019', '', '', '', '', '', '', '', '', NULL, '2020-04-24', '15:12:59', '3'),
(8, 'Kaio Castro', 'Servidor', '111.111.111-11', 'kaio.castro@fiocruz.br', 'manaus@2019', '', '', '', '', '', '', '', '', '', '2020-04-24', '16:20:34', '3'),
(9, 'Priscila Ferreira de Aquino', 'Pesquisador em saúde pública', '811.037.002-00', 'priscila.aquino@fiocruz.br', 'P!c!2020@', '', '', '', '', '', '', '', '', '', '2020-04-24', '16:40:12', '1'),
(10, 'Stefanie Pinto Lopes', '', '322.515.668-05', 'stefanie.lopes@fiocruz.br', '322.515.668-05', '', '', '', '', '', '', '', '', '', '2020-05-07', '21:56:48', '1'),
(11, 'Alessandra Ferreira Dales Nava', '', '278.752.598-94', 'alessandra.nava@fiocruz.br', '278.752.598-94', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:32:36', '1'),
(12, 'Amandia Braga Lima Sousa', '', '603.315.342-15', 'amandia.sousa@fiocruz.br', '603.315.342-15', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:33:16', '1'),
(13, 'Ani Beatriz Jackisch Matsuura ', '', '600.834.500-25', 'ani.matsuura@fiocruz.br', '600.834.500-25', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:33:57', '1'),
(14, 'Antonio Alcirley da Silva Balieiro', '', '614.075.342-20', 'antonio.balieiro@fiocruz.br', '614.075.342-20', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:34:40', '1'),
(15, 'Bárbara José Antunes Baptista', '', '124.997.957-94', 'barbara.bpt@yahoo.com.br', '124.997.957-94', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:35:17', '1'),
(16, 'Claudia Maria Rios Velasquez', '', '512.883.972-91', 'claudia.rios@fiocruz.br', '512.883.972-91', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:37:47', '1'),
(17, 'Evelyne Marie Therese Mainbourg', '', '494.509.052-15', 'evelyne.mainbourg@fiocruz.br', '494.509.052-15', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:39:32', '1'),
(18, 'Fabiane Vinente dos Santos', '', '508.787.942-04', 'fabiane.vinente@fiocruz.br', '508.787.942-04', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:40:41', '1'),
(19, 'Felipe Arley Costa Pessoa', '', '461.410.063-53', 'felipe.pessoa@fiocruz.br', '461.410.063-53', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:43:30', '1'),
(20, 'Felipe Gomes Naveca', '', '075.129.557-40', 'felipe.naveca@fiocruz.br', '075.129.557-40', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:44:33', '1'),
(21, 'Fernanda Rodrigues Fonseca', '', '057.635.186-59', 'fernanda.fonseca@fiocruz.br', '057.635.186-59', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:45:14', '1'),
(22, 'Fernando Jose Herkrath', '', '267.600.758-03', 'fernando.herkrath@fiocruz.br', '267.600.758-03', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:49:45', '1'),
(23, 'Flor Ernestina Martinez Espinosa', '', '508.278.632-68', 'flor.espinosa@fiocruz.br', '508.278.632-68', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:50:23', '1'),
(24, 'James Lee Crainey', '', '548.508.602-06', 'james.lee@fiocruz.br', '548.508.602-06', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:51:16', '1'),
(25, 'José Joaquín Carvajal Cortés ', '', '581.095.365-40', 'jose.carvajal@fiocruz.br', '581.095.365-40', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:52:01', '1'),
(26, 'Júlio Cesar Schweickardt', '', '428.595.060-04', 'julio.cesar@fiocruz.br', '428.595.060-04', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:53:16', '1'),
(27, 'Kátia Maria Lima de Menezes', '', '241.206.002-97', 'katia.lima@fiocruz.br', '241.206.002-97', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:54:11', '1'),
(28, 'Keillen Monick Martins Campos', '', '883.047.442-87', 'keillen.monick@gmail.com', '883.047.442-87', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:55:07', '1'),
(29, 'Lisiane Lappe dos Reis ', '', '909.253.000-04', 'lisiane.reis@fiocruz.br', '909.253.000-04', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:55:51', '1'),
(30, 'Luciete Almeida Silva', '', '253.872.433-34', 'luciete.silva@fiocruz.br', '253.872.433-34', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:56:34', '1'),
(31, 'Luis André Morais Mariúba', '', '758.520.552-04', 'andre.mariuba@fiocruz.br', '758.520.552-04', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:57:13', '1'),
(32, 'Marcilio Sandro de Medeiros', '', '485.687.084-04', 'marcilio.medeiros@fiocruz.br', '485.687.084-04', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:57:55', '1'),
(33, 'Marcus Vinicius Guimarães de Lacerda ', '', '599.247.051-49', 'marcus.lacerda@fiocruz.br', '599.247.051-49', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:58:52', '1'),
(34, 'Maria Jacirema Ferreira Gonçalves', '', '407.012.802-63', 'jacirema.goncalves@fiocruz.br', '407.012.802-63', '', '', '', '', '', '', '', '', '', '2020-05-07', '22:59:46', '1'),
(35, 'Michele Silva de Jesus', '', '645.744.662-00', 'michele.jesus@fiocruz.br', '645.744.662-00', '', '', '', '', '', '', '', '', '', '2020-05-07', '23:01:36', '1'),
(36, 'Ormezinda Celeste Cristo Fernandes', '', '984.800.577-34', 'ormezinda.fernandes@fiocruz.br', '984.800.577-34', '', '', '', '', '', '', '', '', '', '2020-05-07', '23:02:25', '1'),
(37, 'Paulo Afonso Nogueira', '', '119.334.468-97', 'paulo.afonso@fiocruz.br', '119.334.468-97', '', '', '', '', '', '', '', '', '', '2020-05-07', '23:03:10', '1'),
(38, 'Pritesh Jaychand Lalwani', '', '557.518.572-91', 'pritesh.lalwani@fiocruz.br', '557.518.572-91', '', '', '', '', '', '', '', '', '', '2020-05-07', '23:03:46', '1'),
(39, 'Rita Suely Bacuri de Queiroz', '', '122.774.602-49', 'rita.bacuri@fiocruz.br', '122.774.602-49', '', '', '', '', '', '', '', '', '', '2020-05-07', '23:04:21', '1'),
(40, 'Rodrigo Tobias de Sousa Lima', '', '666.433.921-87', 'rodrigo.sousa@fiocruz.br', '666.433.921-87', '', '', '', '', '', '', '', '', '', '2020-05-07', '23:04:57', '1'),
(41, 'Sérgio Luiz Bessa Luz', '', '806.520.777-49', 'sergio.luz@fiocruz.br', '806.520.777-49', '', '', '', '', '', '', '', '', '', '2020-05-07', '23:05:33', '1'),
(42, 'Teste', '', '999.999.999-99', 'teste.ilmd@fiocruz.br', '999.999.999-99', '', '', '', '', '', '', '', '', '', '2020-05-08', '09:36:28', '3'),
(43, 'Maria Luiza Pereira Garnelo', '', '112.003.242-34', 'luiza.garnelo@fiocruz.br', '112.003.242-34', '', '', '', '', '', '', '', '', '', '2020-05-08', '16:45:36', '1'),
(44, 'Michele Rocha de Araújo El Kadri', '', '520.402.082-91', 'michele.kadri@fiocruz.br', '520.402.082-91', '', '', '', '', '', '', '', '', '', '2020-05-08', '16:46:12', '1'),
(45, 'Rosana Cristina Pereira Parente', '', '078.092.982-91', 'rosana.parente@fiocruz.br', '078.092.982-91', '', '', '', '', '', '', '', '', '', '2020-05-08', '16:46:47', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` int(255) NOT NULL,
  `id_cadastrante` varchar(500) DEFAULT NULL,
  `nome` varchar(500) DEFAULT NULL,
  `cargo` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `cel` varchar(100) DEFAULT NULL,
  `senha` varchar(500) DEFAULT NULL,
  `data_cad` varchar(500) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id`, `id_cadastrante`, `nome`, `cargo`, `email`, `tel`, `cel`, `senha`, `data_cad`, `status`, `avatar`, `url`) VALUES
(1, '1', 'Priscila Aquino', 'Coordenadora', 'priscila.aquino@fiocruz.br', '(92)36212333', '(92)999999999', 'P!c!2020@', NULL, '1', 'foto_perfil/2020/05/perfil-1588970625.jpg', NULL),
(4, '4', 'João Oliveira', 'Analista (FIOTEC)', 'joao.oliveira@fiocruz.br', '(92)36212-625', '(92)99291-4321', 'Manaus@2019', '2020-05-07', '1', 'foto_perfil/2020/05/dd.png', NULL),
(5, '1', 'Marizete Duarte', 'Secretaria do PIC', 'marizete.duarte@fiocruz.br', '(92)36212337', '(92)99756620', 't0h9g', '2020-05-08', '1', '', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE `permissao` (
  `id` int(255) NOT NULL,
  `id_perfil` varchar(500) DEFAULT NULL,
  `permissao` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id`, `id_perfil`, `permissao`) VALUES
(234, '3', '1'),
(302, '2', '1'),
(303, '2', '2'),
(304, '2', '3'),
(305, '2', '4'),
(306, '2', '5'),
(307, '2', '6'),
(308, '2', '7'),
(309, '2', '9'),
(310, '2', '10'),
(311, '2', '11'),
(321, '1', '1'),
(322, '1', '6'),
(323, '1', '12'),
(327, '4', '1'),
(328, '4', '6'),
(329, '4', '12'),
(330, '5', '1'),
(331, '5', '12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_siteviews`
--

CREATE TABLE `ws_siteviews` (
  `siteviews_id` int(11) NOT NULL,
  `siteviews_date` date NOT NULL,
  `siteviews_users` decimal(10,0) NOT NULL,
  `siteviews_views` decimal(10,0) NOT NULL,
  `siteviews_pages` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_siteviews`
--

INSERT INTO `ws_siteviews` (`siteviews_id`, `siteviews_date`, `siteviews_users`, `siteviews_views`, `siteviews_pages`) VALUES
(1, '2020-03-30', '1', '1', '3'),
(2, '2020-04-02', '8', '10', '121'),
(3, '2020-04-03', '2', '3', '56'),
(4, '2020-04-06', '7', '7', '7'),
(5, '2020-04-08', '10', '10', '71'),
(6, '2020-04-13', '1', '1', '3'),
(7, '2020-04-15', '1', '1', '19'),
(8, '2020-04-22', '1', '1', '2'),
(9, '2020-04-24', '10', '10', '119'),
(10, '2020-04-28', '5', '6', '7'),
(11, '2020-04-29', '1', '2', '9'),
(12, '2020-05-05', '3', '3', '3'),
(13, '2020-05-06', '2', '2', '10'),
(14, '2020-05-07', '3', '4', '266'),
(15, '2020-05-08', '23', '33', '429'),
(16, '2020-05-11', '2', '4', '143'),
(17, '2020-05-12', '4', '6', '132'),
(18, '2020-05-13', '1', '1', '1'),
(19, '2020-05-14', '2', '2', '6'),
(20, '2020-05-18', '6', '6', '9'),
(21, '2020-05-20', '2', '2', '2'),
(22, '2020-05-29', '1', '1', '1'),
(23, '2020-05-31', '2', '2', '2'),
(24, '2020-06-01', '2', '2', '2'),
(25, '2020-06-05', '1', '1', '1'),
(26, '2020-06-06', '3', '3', '3'),
(27, '2020-06-09', '2', '2', '2'),
(28, '2020-06-11', '1', '1', '1'),
(29, '2020-06-12', '1', '1', '1'),
(30, '2020-06-14', '1', '1', '1'),
(31, '2020-06-15', '2', '2', '2'),
(32, '2020-06-17', '5', '5', '6'),
(33, '2020-06-21', '1', '1', '1'),
(34, '2020-06-25', '1', '1', '1'),
(35, '2020-07-01', '1', '1', '1'),
(36, '2020-07-04', '2', '2', '2'),
(37, '2020-07-05', '1', '1', '1'),
(38, '2020-07-10', '1', '1', '1'),
(39, '2020-07-11', '4', '4', '4'),
(40, '2020-07-12', '1', '1', '1'),
(41, '2020-07-15', '2', '2', '2'),
(42, '2020-07-17', '1', '1', '1'),
(43, '2020-07-19', '1', '1', '1'),
(44, '2020-07-20', '2', '2', '2'),
(45, '2020-07-23', '1', '1', '1'),
(46, '2020-07-27', '4', '4', '6'),
(47, '2020-07-29', '2', '2', '2'),
(48, '2020-07-30', '1', '1', '1'),
(49, '2020-08-02', '1', '1', '1'),
(50, '2020-08-03', '2', '2', '2'),
(51, '2020-08-05', '1', '1', '1'),
(52, '2020-08-08', '1', '1', '1'),
(53, '2020-08-11', '1', '1', '1'),
(54, '2020-08-12', '1', '1', '1'),
(55, '2020-08-14', '3', '3', '3'),
(56, '2020-08-15', '2', '2', '2'),
(57, '2020-08-16', '1', '1', '2'),
(58, '2020-08-20', '1', '1', '2'),
(59, '2020-08-23', '1', '1', '1'),
(60, '2020-08-24', '1', '1', '1'),
(61, '2020-08-28', '1', '3', '3'),
(62, '2020-08-29', '4', '4', '4'),
(63, '2020-08-31', '1', '1', '1'),
(64, '2020-09-01', '1', '1', '1'),
(65, '2020-09-03', '1', '1', '1'),
(66, '2020-09-09', '1', '1', '1'),
(67, '2020-09-13', '1', '1', '1'),
(68, '2020-09-14', '1', '1', '1'),
(69, '2020-09-17', '2', '2', '2'),
(70, '2020-09-18', '2', '2', '2'),
(71, '2020-09-29', '1', '1', '1'),
(72, '2020-10-01', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_siteviews_agent`
--

CREATE TABLE `ws_siteviews_agent` (
  `agent_id` int(11) NOT NULL,
  `agent_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `agent_views` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ws_siteviews_agent`
--

INSERT INTO `ws_siteviews_agent` (`agent_id`, `agent_name`, `agent_views`) VALUES
(1, 'Chrome', '135'),
(2, 'Outros', '45'),
(3, 'Firefox', '17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ws_siteviews_online`
--

CREATE TABLE `ws_siteviews_online` (
  `online_id` int(11) NOT NULL,
  `online_session` varchar(500) DEFAULT NULL,
  `online_startview` varchar(500) DEFAULT NULL,
  `online_endview` varchar(500) DEFAULT NULL,
  `online_ip` varchar(500) DEFAULT NULL,
  `online_url` varchar(500) DEFAULT NULL,
  `online_agent` varchar(500) DEFAULT NULL,
  `agent_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ws_siteviews_online`
--

INSERT INTO `ws_siteviews_online` (`online_id`, `online_session`, `online_startview`, `online_endview`, `online_ip`, `online_url`, `online_agent`, `agent_name`) VALUES
(1, 'de2339cdcbcd93caaa4f9949d1d7879a', '2020-03-29 04:31:02', '2020-03-30 02:11:16', '::1', '/Iniciacao_cientifica/projeto/', 'Chrome', NULL),
(2, '5256b7305d49d79d5329ecfee5d5ef92', '2020-03-30 12:52:12', '2020-03-30 13:13:11', '191.189.0.107', NULL, 'Chrome', NULL),
(3, '7e2ad4586d4afbea9ad5bfd294a01891', '2020-04-02 10:13:13', '2020-04-03 13:47:43', '191.189.0.107', NULL, 'Chrome', NULL),
(4, '7e2ad4586d4afbea9ad5bfd294a01891', '2020-04-02 13:50:00', '2020-04-03 13:47:43', '191.189.0.107', NULL, 'Chrome', NULL),
(5, '23f95ec4be421397c920b2dc883c34d4', '2020-04-02 14:01:28', '2020-04-02 14:21:28', '191.189.0.107', '/projeto/iniciacao_cientifica/projeto/dashboard', 'Outros', NULL),
(6, 'ae05cb1486925b8581eddb7d7a519870', '2020-04-02 14:01:30', '2020-04-02 14:21:30', '191.189.0.107', '/projeto/iniciacao_cientifica/projeto/dashbo', 'Outros', NULL),
(7, '594213584533768945ae719f96190559', '2020-04-02 14:01:33', '2020-04-02 14:21:33', '191.189.0.107', '/projeto/iniciacao_cientifica/projeto/', 'Outros', NULL),
(8, '169595b3d373726091f5fcbe1bdc6850', '2020-04-02 16:01:36', '2020-04-02 16:33:32', '179.222.18.174', NULL, 'Chrome', NULL),
(9, '7e2ad4586d4afbea9ad5bfd294a01891', '2020-04-02 16:12:59', '2020-04-03 13:47:43', '191.189.0.107', NULL, 'Chrome', NULL),
(10, '8a410816192a73373737fec87ba2743a', '2020-04-02 16:28:22', '2020-04-02 16:49:19', '179.222.18.174', NULL, 'Chrome', NULL),
(11, 'f16856486b8035b13a0f8dffa52626a4', '2020-04-02 16:32:56', '2020-04-02 17:22:06', '179.222.18.174', NULL, 'Chrome', NULL),
(12, '949e34e98ab99e058b8783c80f00f1c5', '2020-04-02 18:34:41', '2020-04-02 18:54:41', '177.43.115.136', '/projeto/iniciacao_cientifica/projeto/', 'Chrome', NULL),
(13, '7e2ad4586d4afbea9ad5bfd294a01891', '2020-04-03 12:16:59', '2020-04-03 13:47:43', '191.189.0.107', NULL, 'Chrome', NULL),
(14, 'a2fc3adba1f1e0b72c24e7c0f38f2d32', '2020-04-03 13:57:56', '2020-04-03 14:20:09', '191.189.0.107', NULL, 'Chrome', NULL),
(15, '4015d3e9bf6f654f09a9d2bb1c050997', '2020-04-03 16:00:48', '2020-04-03 16:20:48', '191.189.0.107', '/projeto/iniciacao_cientifica/projeto/', 'Outros', NULL),
(16, '12fc085794c7ec615bcc4b9dba1cb17c', '2020-04-06 10:51:50', '2020-04-06 11:11:50', '200.129.172.190', '/projeto/iniciacao_cientifica/projeto/php/php.php', 'Chrome', NULL),
(17, '56eb3a7290c50c184ab0cd2529da7ba7', '2020-04-06 10:52:21', '2020-04-06 11:12:21', '200.129.172.190', '/projeto/iniciacao_cientifica/projeto/php/php.php', 'Chrome', NULL),
(18, 'b0d76c126a8a30449fcdb25c6474a817', '2020-04-06 10:53:10', '2020-04-06 11:13:10', '200.129.172.190', '/projeto/iniciacao_cientifica/projeto/php/php.php', 'Chrome', NULL),
(19, '97fca97db72e27215dbee7f5416b8f30', '2020-04-06 10:55:29', '2020-04-06 11:15:29', '200.129.172.190', '/projeto/iniciacao_cientifica/projeto/php/php.php', 'Chrome', NULL),
(20, 'e6320d925a983f351a9c465affa2a7d6', '2020-04-06 11:21:24', '2020-04-06 11:41:24', '200.129.172.190', '/projeto/iniciacao_cientifica/projeto/php/php.php', 'Chrome', NULL),
(21, '144a28cd01fbcdd8eab15f975f87b503', '2020-04-06 11:21:39', '2020-04-06 11:41:39', '200.129.172.190', '/projeto/iniciacao_cientifica/projeto/php/php.php', 'Chrome', NULL),
(22, '7fade15e79fd720877c6b8fa6284839d', '2020-04-06 11:22:16', '2020-04-06 11:42:16', '200.129.172.190', '/projeto/iniciacao_cientifica/projeto/php/php.php', 'Chrome', NULL),
(23, '51e06750d27465858ff0030bafb5432d', '2020-04-08 15:43:20', '2020-04-08 17:33:37', '191.189.0.107', NULL, 'Chrome', NULL),
(24, '86c5be4711b2802787aad3842acdb814', '2020-04-08 17:15:19', '2020-04-08 17:46:02', '191.189.0.107', NULL, 'Chrome', NULL),
(25, '1a915f633f4562fed0d4eb08586f7331', '2020-04-08 17:15:44', '2020-04-08 17:35:44', '191.189.0.107', '/projeto/iniciacao_cientifica/gestao/php/php.php', 'Chrome', NULL),
(26, '51e8249941f8d18398b87c29dc229306', '2020-04-08 17:16:09', '2020-04-08 17:47:54', '191.189.0.107', NULL, 'Chrome', NULL),
(27, '9919cb80715dc6bdfcc24eac39525c4e', '2020-04-08 17:16:44', '2020-04-08 17:36:44', '191.189.0.107', '/projeto/iniciacao_cientifica/gestao/php/php.php', 'Chrome', NULL),
(28, 'e40d56bec6bc17c21e2a766d7d156e49', '2020-04-08 17:17:57', '2020-04-08 17:37:57', '191.189.0.107', '/projeto/iniciacao_cientifica/gestao/php/php.php', 'Chrome', NULL),
(29, '9dfafdb57e269180d48835822a5b5f95', '2020-04-08 17:20:04', '2020-04-08 17:40:04', '191.189.0.107', '/projeto/iniciacao_cientifica/gestao/php/php.php', 'Chrome', NULL),
(30, '285647bf1cd25cd3f7228f4719ff1180', '2020-04-08 17:24:03', '2020-04-08 17:44:03', '191.189.0.107', '/projeto/iniciacao_cientifica/gestao/php/php.php', 'Chrome', NULL),
(31, '5d291f890eb29d2cd9383180d889cad7', '2020-04-08 17:25:36', '2020-04-08 17:45:36', '191.189.0.107', '/projeto/iniciacao_cientifica/gestao/php/php.php', 'Chrome', NULL),
(32, 'd82bfc78d4fb8cc8f1d8d723ae6ddff4', '2020-04-08 17:26:13', '2020-04-08 17:46:13', '191.189.0.107', '/projeto/iniciacao_cientifica/gestao/php/php.php', 'Chrome', NULL),
(33, '8e011d284ceb5f2877ac3111194cd103', '2020-04-13 16:30:03', '2020-04-15 16:34:40', '191.189.0.107', NULL, 'Chrome', NULL),
(34, '8e011d284ceb5f2877ac3111194cd103', '2020-04-15 15:57:31', '2020-04-15 16:34:40', '191.189.0.107', NULL, 'Chrome', NULL),
(35, '6sf4na8q2hb7u1u6fn0ocg5745', '2020-04-22 09:11:58', '2020-04-24 15:36:11', '10.92.4.9', '/sistemas/sispic/projeto/php/php.php', 'Chrome', NULL),
(36, 'nqn5m8555f4r04io5i1np5ok74', '2020-04-22 14:20:28', '2020-04-22 14:40:34', '179.222.17.11', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(37, 'op9nv6kbs54g98q1kqbaqunkm4', '2020-04-24 10:11:07', '2020-04-24 10:32:25', '179.222.18.168', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(38, '6sf4na8q2hb7u1u6fn0ocg5745', '2020-04-24 15:06:55', '2020-04-24 15:36:11', '10.92.4.9', '/sistemas/sispic/projeto/php/php.php', 'Chrome', NULL),
(39, 'g9mrmvthjsejj5hhsbdue70fo3', '2020-04-24 15:20:20', '2020-04-24 15:40:20', '10.92.4.9', '/sistemas/sispic/projeto/sair', 'Chrome', NULL),
(40, 'v31vmq4k3r1ufu249atdmima87', '2020-04-24 15:20:20', '2020-04-24 15:40:28', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(41, 'bmlr65n7svjsv9pl69saf82lj3', '2020-04-24 15:20:22', '2020-04-24 15:40:22', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(42, 'm6svmm8507j13dmttfselsv940', '2020-04-24 15:20:28', '2020-04-24 15:40:28', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(43, 'jfe43hlokv39eg49uq3adugco2', '2020-04-24 15:22:14', '2020-04-24 17:00:14', '10.92.4.9', '/sistemas/sispic/gestao/orientador', 'Chrome', NULL),
(44, 'd63moolobeac2bo6c8go4nl623', '2020-04-24 15:46:09', '2020-04-24 16:06:09', '191.189.0.107', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(45, 'otj2pis495hjrtn6hu3rt45lk5', '2020-04-24 15:46:10', '2020-04-24 16:06:21', '191.189.0.107', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(46, '1n3s10esfd66gli4t8t6fq26v5', '2020-04-24 16:19:59', '2020-04-24 16:39:59', '187.115.167.202', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(47, '1lfosc11elqo79vhbkf11gt530', '2020-04-28 12:52:57', '2020-04-28 13:12:57', '191.189.25.26', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(48, '7fsrpvte7o88mmbf5p7gk81op4', '2020-04-28 12:52:57', '2020-04-28 13:13:08', '191.189.25.26', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(49, '2usj9s7cd7ucrmm0m7ngcu6a35', '2020-04-28 12:54:00', '2020-04-28 13:14:00', '191.189.25.26', '/sistemas/sispic/projeto/', 'Firefox', NULL),
(50, 'gs9omt2km8opp2osodhkkki0f2', '2020-04-28 12:58:21', '2020-04-28 13:18:21', '191.189.25.26', '/sistemas/sispic/projeto/', 'Firefox', NULL),
(51, 'ufmhq9cn6ekog0vh8letqkf0c6', '2020-04-28 13:12:19', '2020-04-28 13:32:19', '191.189.25.26', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(52, '2usj9s7cd7ucrmm0m7ngcu6a35', '2020-04-28 14:11:12', '2020-04-28 14:31:12', '191.189.25.26', '/sistemas/sispic/projeto/', 'Firefox', NULL),
(53, 'vjp304fqsu4fjjdci425gg6pg0', '2020-04-29 08:35:01', '2020-04-29 10:13:43', '10.92.4.9', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(54, 'vjp304fqsu4fjjdci425gg6pg0', '2020-04-29 09:53:13', '2020-04-29 10:13:43', '10.92.4.9', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(55, '4mhoknhnuvsr5edqj5efnmq297', '2020-04-29 10:45:15', '2020-04-29 11:08:52', '201.75.44.85', '/sistemas/sispic/projeto/', 'Firefox', NULL),
(56, '42f29qjj41hjebh4n3f93vace6', '2020-05-05 10:06:14', '2020-05-05 10:26:14', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(57, '42f29qjj41hjebh4n3f93vace6', '2020-05-05 10:53:25', '2020-05-05 11:13:25', '10.92.4.9', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(58, '3ifkpj8q8e1ofvunbdck9buv71', '2020-05-05 11:13:13', '2020-05-05 11:33:13', '191.189.25.26', '/sistemas/sispic/gestao/', 'Firefox', NULL),
(59, 'j7nmg9nlf455mp7je51t01cd75', '2020-05-06 12:42:06', '2020-05-06 13:08:52', '179.222.17.78', '/sistemas/sispic/projeto/', 'Outros', NULL),
(60, '18r6c6pbj7elamcff7futl5496', '2020-05-06 14:02:05', '2020-05-06 14:22:06', '179.222.17.78', '/sistemas/sispic/projeto/', 'Outros', NULL),
(61, '4rsuqs7md7agb17vpj8fqbp1h4', '2020-05-07 20:15:42', '2020-05-07 23:28:01', '191.189.25.26', '/sistemas/sispic/gestao/imagens_site/foto_perfil/2020/05/perfil.jpg', 'Chrome', NULL),
(62, 'f9gji4ghli751f0ipih4kkmij3', '2020-05-07 20:49:33', '2020-05-07 21:17:00', '179.222.17.84', '/sistemas/sispic/gestao/php/php.php', 'Chrome', NULL),
(63, '8j5msmsn68iu1aj1dscl4ubua7', '2020-05-07 20:50:16', '2020-05-07 21:10:16', '177.43.115.136', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(64, '4i2pdrrk4cn1s7r438erkjpi04', '2020-05-07 21:21:39', '2020-05-07 21:55:48', '179.222.17.84', '/sistemas/sispic/projeto/php/php.php', 'Chrome', NULL),
(65, 'bokhck3kt9sgn9ri6rm63tdtm3', '2020-05-08 08:00:05', '2020-05-08 11:09:07', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(66, 't8pdfua64kcu1g5n05cui1dfk4', '2020-05-08 08:21:09', '2020-05-08 18:33:06', '179.215.124.32', '/sistemas/sispic/projeto/php/php.php', 'Firefox', NULL),
(67, 'qpieqorun6oacmnt6s0hj4fk25', '2020-05-08 08:34:29', '2020-05-08 10:18:22', '191.189.25.26', '/sistemas/sispic/gestao/orientador', 'Chrome', NULL),
(68, 'qpieqorun6oacmnt6s0hj4fk25', '2020-05-08 09:22:04', '2020-05-08 10:18:22', '191.189.25.26', '/sistemas/sispic/gestao/orientador', 'Chrome', NULL),
(69, 't7nnc2lpckj3m26o7qn7ujklr1', '2020-05-08 09:58:40', '2020-05-08 11:31:21', '191.189.25.26', '/sistemas/sispic/projeto/php/php.php', 'Firefox', NULL),
(70, 't8pdfua64kcu1g5n05cui1dfk4', '2020-05-08 10:56:03', '2020-05-08 18:33:06', '179.215.124.32', '/sistemas/sispic/projeto/php/php.php', 'Firefox', NULL),
(71, 't7nnc2lpckj3m26o7qn7ujklr1', '2020-05-08 11:06:25', '2020-05-08 11:31:21', '191.189.25.26', '/sistemas/sispic/projeto/php/php.php', 'Firefox', NULL),
(72, 'cumejtp7nci68pb4r1tgs62v71', '2020-05-08 11:20:51', '2020-05-08 15:02:12', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Chrome', NULL),
(73, '5soqbkim9b5djv9c0bvuosv3k4', '2020-05-08 11:53:37', '2020-05-08 12:25:17', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Chrome', NULL),
(74, 'gl6vbjs5pqvfacuf5v2bhh86k0', '2020-05-08 12:03:47', '2020-05-08 12:34:57', '191.189.25.26', '/sistemas/sispic/projeto/php/php.php', 'Firefox', NULL),
(75, 'r23aeid0bj2m0j55ar9q7b4e70', '2020-05-08 14:17:24', '2020-05-08 14:43:23', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(76, '55pfq6u5evdhf17pugt4333lf3', '2020-05-08 14:21:49', '2020-05-08 14:41:57', '201.64.116.196', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(77, 'ht1oaa0i586sn22jsglrquj7g5', '2020-05-08 14:23:41', '2020-05-08 14:43:41', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(78, '8lr64obe637ut1hnvk7lkfs3h7', '2020-05-08 14:23:41', '2020-05-08 14:43:48', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(79, 'msf1chjfieau31enm5qobj5532', '2020-05-08 14:23:47', '2020-05-08 14:43:47', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(80, 'b8pc8thbcvslvpn999o3e63067', '2020-05-08 14:25:05', '2020-05-08 15:35:17', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(81, 'dfjgn39ae3jud3rp6db9k93d54', '2020-05-08 14:28:58', '2020-05-08 14:48:58', '177.21.96.68', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(82, 'cumejtp7nci68pb4r1tgs62v71', '2020-05-08 14:38:10', '2020-05-08 15:02:12', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Chrome', NULL),
(83, 'jki49dv8vi5bu55iolphi3vpn6', '2020-05-08 14:47:03', '2020-05-08 15:08:31', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Firefox', NULL),
(84, '7dp9lsv9sder12qrjmsb6v5ll3', '2020-05-08 14:53:53', '2020-05-08 15:44:37', '191.189.25.26', '/sistemas/sispic/projeto/php/php.php', 'Firefox', NULL),
(85, '5slc2jj53cnmgis599fm8qffn3', '2020-05-08 14:59:51', '2020-05-08 15:19:51', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Firefox', NULL),
(86, '9h2ort6o5hlhnlitm052p7rr76', '2020-05-08 14:59:52', '2020-05-08 15:19:52', '191.189.25.26', '/sistemas/sispic/projeto/', 'Firefox', NULL),
(87, 'b8pc8thbcvslvpn999o3e63067', '2020-05-08 15:12:57', '2020-05-08 15:35:17', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(88, 'cfk5o7d0hq2oqugplck7ps7is7', '2020-05-08 15:16:02', '2020-05-08 16:27:28', '10.92.4.9', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(89, 'rovjl8vhb0omr37po5cbf8go25', '2020-05-08 15:16:58', '2020-05-08 15:36:58', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Chrome', NULL),
(90, '6m27g5d5tknnr08guna01a3u25', '2020-05-08 15:16:58', '2020-05-08 15:38:22', '191.189.25.26', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(91, 'bgh7c2jlnm512rokg1gc4uakk6', '2020-05-08 15:16:58', '2020-05-08 15:36:58', '191.189.25.26', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(92, 'f4ve62ibtssfs710gv4mnan065', '2020-05-08 15:18:22', '2020-05-08 15:38:22', '191.189.25.26', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(93, 'nvp3u6cd0o3fn205qlv49babg1', '2020-05-08 16:42:23', '2020-05-08 17:10:56', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Firefox', NULL),
(94, 'gljm112240sgtaqr292fdkhcv2', '2020-05-08 17:00:33', '2020-05-09 00:21:01', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Chrome', NULL),
(95, 't8pdfua64kcu1g5n05cui1dfk4', '2020-05-08 18:07:21', '2020-05-08 18:33:06', '179.215.124.32', '/sistemas/sispic/projeto/php/php.php', 'Firefox', NULL),
(96, 't8pdfua64kcu1g5n05cui1dfk4', '2020-05-08 19:36:56', '2020-05-08 19:56:56', '179.215.124.32', '/sistemas/sispic/projeto/php/php.php', 'Firefox', NULL),
(97, 'gljm112240sgtaqr292fdkhcv2', '2020-05-08 23:59:26', '2020-05-09 00:21:01', '191.189.25.26', '/sistemas/sispic/projeto/dashboard', 'Chrome', NULL),
(98, 'us6b0p59dmj1ola9m99dek0ne0', '2020-05-11 10:15:59', '2020-05-11 15:26:22', '10.92.4.9', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(99, 'us6b0p59dmj1ola9m99dek0ne0', '2020-05-11 14:19:01', '2020-05-11 15:26:22', '10.92.4.9', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(100, '206phok7m6s4b6th8djjhj5cl7', '2020-05-11 15:16:42', '2020-05-11 16:47:04', '10.92.4.9', '/sistemas/sispic/projeto/php/php.php', 'Chrome', NULL),
(101, '206phok7m6s4b6th8djjhj5cl7', '2020-05-11 16:22:12', '2020-05-11 16:47:04', '10.92.4.9', '/sistemas/sispic/projeto/php/php.php', 'Chrome', NULL),
(102, '8tlmaa1u57nul3vj4jifm5b0t5', '2020-05-11 16:54:51', '2020-05-11 17:36:22', '10.92.4.9', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(103, '6pfpf4ib2b6c87510641nknct0', '2020-05-12 12:03:50', '2020-05-12 12:23:50', '191.189.16.86', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(104, 'ejprivu33hrae2vg5k9v0bgj45', '2020-05-12 12:03:50', '2020-05-12 12:29:14', '191.189.16.86', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(105, 'f65df3ai9r4hfueht6o6us36g0', '2020-05-12 12:09:14', '2020-05-12 12:29:14', '191.189.16.86', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(106, '6muklcjkg9q2go01ofrfnn6q36', '2020-05-12 14:12:00', '2020-05-12 16:45:43', '10.92.4.9', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(107, 'mqgfh20ld3miub0mru9hhbv5t2', '2020-05-12 15:44:56', '2020-05-12 16:22:10', '191.189.25.26', '/sistemas/sispic/projeto/php/php.php', 'Chrome', NULL),
(108, '6muklcjkg9q2go01ofrfnn6q36', '2020-05-12 16:01:48', '2020-05-12 16:45:43', '10.92.4.9', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(109, 'jkmt7hi17aumuolsf6qof2l385', '2020-05-13 16:15:20', '2020-05-13 16:35:20', '179.222.17.28', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(110, 'e6u3liho3jduhif9nrg63jtbl1', '2020-05-14 09:17:54', '2020-05-14 09:38:52', '191.189.17.150', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(111, 'r2hrri3sqaar1mrvcrflhupie3', '2020-05-14 16:55:37', '2020-05-14 17:22:59', '181.191.132.242', '/sistemas/sispic/gestao/', 'Firefox', NULL),
(112, 'mete96psr9cmk482sueqi3tcr2', '2020-05-18 14:36:43', '2020-05-18 14:57:03', '179.222.116.131', '/sistemas/sispic/projeto/php/php.php', 'Outros', NULL),
(113, '7e2g970bgraiq6j6p76uhieto6', '2020-05-18 18:37:04', '2020-05-18 18:57:04', '129.213.76.116', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(114, '66jnqk17dnhpbqol6hnv209h14', '2020-05-18 18:37:06', '2020-05-18 18:57:19', '129.213.76.116', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(115, '14addd1akonppgm23oge1ni7g3', '2020-05-18 18:37:09', '2020-05-18 18:57:09', '129.213.76.116', '/sistemas/sispic/projeto/', 'Outros', NULL),
(116, 'b82hsfnhrlf198hhv6hbl0hnd5', '2020-05-18 18:37:16', '2020-05-18 18:57:16', '129.213.76.116', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(117, 'a9po0d27uattnmb5gs4hqd1he0', '2020-05-18 18:37:21', '2020-05-18 18:57:21', '129.213.76.116', '/sistemas/sispic/gestao/', 'Outros', NULL),
(118, 'r633k0balhcqsekkh0qpqsgig0', '2020-05-20 14:55:39', '2020-05-20 15:15:39', '66.249.73.95', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(119, 'jkdsueh8j4ds2pqc961d46nj70', '2020-05-20 14:57:17', '2020-05-20 15:17:17', '66.249.73.95', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(120, 'l33menfbl391l6ea91lqhhpc05', '2020-05-29 19:16:39', '2020-05-29 19:36:39', '66.249.79.173', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(121, 'mio669hj2s8305lff0f2vchj36', '2020-05-31 02:30:17', '2020-05-31 02:50:17', '66.249.64.65', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(122, 'ohd5hi3ar5j348tll91kt4qmc6', '2020-05-31 09:11:11', '2020-05-31 09:31:11', '66.249.64.68', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(123, '2ap9f88o5utakd0g531a9s68g1', '2020-06-01 04:00:17', '2020-06-01 04:20:17', '66.249.64.68', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(124, 'qebdmajit24ik5oitpe3dvec25', '2020-06-01 04:33:00', '2020-06-01 04:53:00', '66.249.64.95', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(125, 'vu7936ai2uqpq65junudu4uu32', '2020-06-05 19:54:53', '2020-06-05 20:14:53', '46.229.168.146', '/sistemas/sispic/gestao/', 'Outros', NULL),
(126, '3ipu3jopnf9imgc5bf995d39v4', '2020-06-06 01:29:02', '2020-06-06 01:49:02', '46.229.168.143', '/sistemas/sispic/projeto/', 'Outros', NULL),
(127, 'fmvjnd0l7lu1bd1js5qo0b5ra0', '2020-06-06 02:51:23', '2020-06-06 03:11:23', '66.249.79.175', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(128, '2el4facth1fbomisb3breb0rh0', '2020-06-06 07:54:55', '2020-06-06 08:14:55', '66.249.79.175', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(129, 'i9qu89odjlrrvr86fti0buhhk4', '2020-06-09 05:50:29', '2020-06-09 06:10:29', '66.249.64.65', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(130, 'rrhn3l4gp3dov6846a51jkv1q7', '2020-06-09 12:52:21', '2020-06-09 13:12:21', '66.249.64.95', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(131, '19leglortmipd26drjo53qoh04', '2020-06-11 15:30:12', '2020-06-11 15:50:12', '66.249.64.95', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(132, 'ph2s6892skvo70dtb4g73q71a6', '2020-06-12 15:58:04', '2020-06-12 16:18:04', '46.229.168.133', '/sistemas/sispic/projeto/', 'Outros', NULL),
(133, '6as7234mue8ggfg1aabrovfe54', '2020-06-14 03:44:18', '2020-06-14 04:04:18', '66.249.65.2', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(134, 'ojurjcuvks0c62rf4gle675i52', '2020-06-15 08:28:33', '2020-06-15 08:48:33', '179.67.173.209', '/sistemas/sispic/projeto/', 'Outros', NULL),
(135, 'ma6auumbkp2bu9v9ms401cvpm2', '2020-06-15 15:30:15', '2020-06-15 15:50:15', '66.249.65.31', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(136, 'mgfbf5eku6t4m23qqtnt11taq5', '2020-06-17 19:51:09', '2020-06-17 20:11:09', '129.213.67.237', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(137, 'ssh05hejmp11of45gkdla1arb1', '2020-06-17 19:51:11', '2020-06-17 20:11:24', '129.213.67.237', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(138, 'fssnkabeq3vasfdshqps1u6mm4', '2020-06-17 19:51:14', '2020-06-17 20:11:14', '129.213.67.237', '/sistemas/sispic/projeto/', 'Outros', NULL),
(139, '1euo7k3nqmf5hgeq82tkoq9ss6', '2020-06-17 19:51:21', '2020-06-17 20:11:21', '129.213.67.237', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(140, 'fuvfksc13sbsqf64uuiibt9v10', '2020-06-17 19:51:26', '2020-06-17 20:11:26', '129.213.67.237', '/sistemas/sispic/gestao/', 'Outros', NULL),
(141, 's5f4rncflvqrveglrngr4n23p7', '2020-06-21 07:33:47', '2020-06-21 07:53:47', '66.249.79.173', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(142, 'm0nb228tmdg68eclg4ffolf254', '2020-06-25 05:38:35', '2020-06-25 05:58:35', '46.229.168.134', '/sistemas/sispic/gestao/', 'Outros', NULL),
(143, 'u5rg9reig5bub44f89fh422lq2', '2020-07-01 00:27:41', '2020-07-01 00:47:41', '46.229.168.147', '/sistemas/sispic/projeto/', 'Outros', NULL),
(144, '4n9hotb6js1c4aooqbt92kduf3', '2020-07-04 06:44:16', '2020-07-04 07:04:16', '66.249.68.63', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(145, '6tsp1bieqtgstbulfs074f9lt0', '2020-07-04 08:53:30', '2020-07-04 09:13:30', '66.249.68.33', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(146, '2kgp02soetr25bka3u8ugah3b7', '2020-07-05 23:48:51', '2020-07-06 00:08:51', '46.229.168.139', '/sistemas/sispic/gestao/', 'Outros', NULL),
(147, 'm41k9ujmknslajtpl9ojokjpk7', '2020-07-10 14:21:21', '2020-07-10 14:41:21', '66.249.64.68', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(148, '2jp543lav3k5eah3gqhd4n8g67', '2020-07-11 01:31:42', '2020-07-11 01:51:42', '66.249.64.65', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(149, 'lnhkbqpumtv8elfrk6861u5ej0', '2020-07-11 10:27:15', '2020-07-11 10:47:15', '46.229.168.132', '/sistemas/sispic/projeto/', 'Outros', NULL),
(150, 'ra74vkbkndfsq9ubjqsd7un1u0', '2020-07-11 12:39:20', '2020-07-11 12:59:20', '66.249.64.95', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(151, '51m353dr98s16b8slv0t7q9mv6', '2020-07-11 18:10:33', '2020-07-11 18:30:33', '66.249.64.68', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(152, 'vif5535p5q87bcl8327uco94b5', '2020-07-12 02:02:44', '2020-07-12 02:22:44', '66.249.64.95', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(153, '05ngksqflko2vu1hd5lobce4f6', '2020-07-15 10:37:56', '2020-07-15 10:57:56', '66.249.64.65', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(154, 'evaerjfbu1k2kpbfb7j6ib56s2', '2020-07-15 20:45:49', '2020-07-15 21:05:49', '66.249.75.33', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(155, '4oi9cmtvuqmjcd11csqd1k3lc3', '2020-07-17 16:47:31', '2020-07-17 17:07:31', '207.46.13.4', '/sistemas/sispic/gestao/', 'Outros', NULL),
(156, 'b6vqa7oa85jvtf5bu3br4nd6s0', '2020-07-19 22:08:37', '2020-07-19 22:28:37', '66.249.64.68', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(157, 'rv2m9k5naco9dolu52gfsil9n6', '2020-07-20 01:12:19', '2020-07-20 01:32:19', '46.229.168.137', '/sistemas/sispic/gestao/', 'Outros', NULL),
(158, 'jbsutb6eit8m8nrf88ksqdtci3', '2020-07-20 04:21:59', '2020-07-20 04:41:59', '46.229.168.150', '/sistemas/sispic/projeto/', 'Outros', NULL),
(159, 'i2cf2pkkj8h7r6l6kdh11qn633', '2020-07-23 11:16:40', '2020-07-23 11:36:40', '46.229.168.148', '/sistemas/sispic/projeto/', 'Outros', NULL),
(160, '5snttvt3v4ial1bkrkev9h0pn3', '2020-07-27 20:28:06', '2020-07-27 20:48:06', '129.213.67.237', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(161, 'rg1grcaep3ffk0imd6r18qlt40', '2020-07-27 19:23:34', '2020-07-27 20:48:21', '129.213.67.237', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(162, 'lamec3ou20k35cu95sobaif253', '2020-07-27 20:28:11', '2020-07-27 20:48:11', '129.213.67.237', '/sistemas/sispic/projeto/', 'Outros', NULL),
(163, 'ga0dnak3maj96v95dmdtsi8a12', '2020-07-27 20:28:19', '2020-07-27 20:48:19', '129.213.67.237', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(164, '1a1m3sajd8c5tgmvo9isf52d67', '2020-07-27 20:28:24', '2020-07-27 20:48:24', '129.213.67.237', '/sistemas/sispic/gestao/', 'Outros', NULL),
(165, 'udl23ol51llvgenob47crfai93', '2020-07-29 21:57:03', '2020-07-29 22:17:03', '46.229.168.142', '/sistemas/sispic/gestao/', 'Outros', NULL),
(166, 'k3b88octo1njkin6b03ahndrv5', '2020-07-29 23:09:58', '2020-07-29 23:29:58', '66.249.68.33', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(167, 'u0j7qjqdo0045hqpmrsr61ajb4', '2020-07-30 01:21:43', '2020-07-30 01:41:43', '46.229.168.150', '/sistemas/sispic/projeto/', 'Outros', NULL),
(168, '5ba1tl2j0n363r9mo62jbkkck7', '2020-08-02 08:16:19', '2020-08-02 08:36:19', '46.229.168.136', '/sistemas/sispic/projeto/', 'Outros', NULL),
(169, 'pun3optrb6hqu4cagh4ks9kqs6', '2020-08-03 04:16:44', '2020-08-03 04:36:44', '66.249.68.36', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(170, 'ljcup1d1767o4n4sgs82nbjue4', '2020-08-03 12:06:20', '2020-08-03 12:26:20', '190.2.70.205', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(171, 'fqd5c6p3rk9n7cdmsb6fcp9bu2', '2020-08-05 15:08:33', '2020-08-05 15:28:33', '66.249.64.95', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(172, 'plqijel46ib0h7e0ldo8is4926', '2020-08-08 18:20:37', '2020-08-08 18:40:37', '46.229.168.144', '/sistemas/sispic/gestao/', 'Outros', NULL),
(173, '7plsdu9q4o2j22lc69ibf678o3', '2020-08-11 22:00:41', '2020-08-11 22:20:41', '46.229.168.144', '/sistemas/sispic/gestao/', 'Outros', NULL),
(174, '1k117uhrgrndstelqbe3iffp82', '2020-08-12 02:34:19', '2020-08-12 02:54:19', '46.229.168.161', '/sistemas/sispic/projeto/', 'Outros', NULL),
(175, '0c2dudap41pok33jllbropg3j6', '2020-08-14 04:55:40', '2020-08-14 05:15:40', '66.249.68.63', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(176, 'v38lkgl0gse88rp8ki4c3k7106', '2020-08-14 07:00:03', '2020-08-14 07:20:03', '66.249.68.33', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(177, 'g8d4hq724mg37pnm0mqacpka24', '2020-08-14 20:56:59', '2020-08-14 21:16:59', '66.249.68.63', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(178, 'nscqouk85o2ot2h42uf7cm7lk7', '2020-08-15 00:06:10', '2020-08-15 00:26:10', '46.229.168.153', '/sistemas/sispic/projeto/', 'Outros', NULL),
(179, 'd271qktmvou3ahalfielosq8s3', '2020-08-15 03:15:49', '2020-08-15 03:35:49', '66.249.68.33', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(180, 'aspsbnc688vlaemomi9080qjm3', '2020-08-16 02:34:55', '2020-08-16 02:54:55', '66.249.68.33', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(181, 'rp989l460sn6feo9n5cuthnia7', '2020-08-16 12:17:46', '2020-08-16 12:38:39', '191.189.27.90', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(182, 'g6c1pnls5ipv74o2pp72fq0v27', '2020-08-20 16:52:18', '2020-08-20 17:31:07', '191.189.17.55', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(183, 'vv77tj8eu7mvpjrm2icsqn4fg6', '2020-08-23 18:53:39', '2020-08-23 19:13:39', '66.249.73.68', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(184, 'psgjde56k1u9tq6664oi76p1s1', '2020-08-24 23:51:02', '2020-08-25 00:11:02', '66.249.73.95', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(185, '30nudmiq6bp1p2alosqdb2lop3', '2020-08-28 01:20:51', '2020-08-28 01:40:51', '66.249.75.33', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(186, '', '2020-08-28 18:11:48', '2020-08-28 18:31:48', '176.9.139.229', '/sistemas/sispic/projeto/', 'Outros', NULL),
(187, '', '2020-08-28 18:11:52', '2020-08-28 18:31:52', '176.9.139.229', '/sistemas/sispic/gestao/', 'Outros', NULL),
(188, '4iio307snf5j39hr9dt37q3f57', '2020-08-29 00:17:38', '2020-08-29 00:37:38', '66.249.68.36', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(189, '7134gjk2e3uv5n8mtha6d8a2n1', '2020-08-29 06:02:14', '2020-08-29 06:22:14', '46.229.168.147', '/sistemas/sispic/gestao/', 'Outros', NULL),
(190, '1dv37ulot3kbcei8c7tbvri3f7', '2020-08-29 09:44:47', '2020-08-29 10:04:47', '46.229.168.139', '/sistemas/sispic/projeto/', 'Outros', NULL),
(191, 'bqlu7asfrpa3r6rr5puudv1im2', '2020-08-29 10:58:54', '2020-08-29 11:18:54', '66.249.68.63', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(192, 'i6lq0tp0n4ldbi750c9pqi0ru6', '2020-08-31 23:57:15', '2020-09-01 00:17:15', '66.249.68.36', '/sistemas/sispic/projeto/', 'Chrome', NULL),
(193, 'pnmrtk6h5nrp3re2n89t8gqop4', '2020-09-01 05:57:07', '2020-09-01 06:17:07', '46.229.168.133', '/sistemas/sispic/gestao/', 'Outros', NULL),
(194, 'e5bc2t536mq92gr9jdinussfm4', '2020-09-03 01:20:18', '2020-09-03 01:40:18', '66.249.68.33', '/sistemas/sispic/gestao/', 'Chrome', NULL),
(195, 'g8f3crej4fbt6fq46l8repagh4', '2020-09-09 14:50:19', '2020-09-09 15:10:19', '157.55.39.87', '/sistemas/sispic/projeto/', 'Outros', NULL),
(196, 'qit1eie0m6gshqo18oucu19cr4', '2020-09-13 23:40:47', '2020-09-14 00:00:47', '185.191.171.22', '/sistemas/sispic/gestao/', 'Outros', NULL),
(197, 's0i43ji9btp36ss67nmoobabn3', '2020-09-14 02:52:24', '2020-09-14 03:12:24', '185.191.171.6', '/sistemas/sispic/projeto/', 'Outros', NULL),
(198, 'g14tnlnkor7v3h8aocvf1t4n80', '2020-09-17 08:33:25', '2020-09-17 08:53:25', '185.191.171.21', '/sistemas/sispic/gestao/', 'Outros', NULL),
(199, 'mf3npdkufuo7qi12skhqtmilu4', '2020-09-17 11:34:39', '2020-09-17 11:54:39', '185.191.171.3', '/sistemas/sispic/projeto/', 'Outros', NULL),
(200, '5j6a6f8k2pum43v22dhnstbhd4', '2020-09-18 12:02:13', '2020-09-18 12:22:13', '66.249.68.33', '/sistemas/sispic/gestao/', 'Outros', NULL),
(201, '79vp5udu31qqr8l60t9nmt4lu2', '2020-09-18 12:06:30', '2020-09-18 12:26:30', '66.249.68.63', '/sistemas/sispic/projeto/', 'Outros', NULL),
(202, 'r90btadmkgptvt3910t4sujk82', '2020-09-29 02:37:49', '2020-09-29 02:57:49', '40.77.167.88', '/sistemas/sispic/gestao/', 'Outros', NULL),
(203, 'k4evb2mf3t8o5e4s3iodaas007', '2020-10-01 13:02:19', '2020-10-01 13:22:19', '191.189.3.43', '/sistemas/sispic/projeto/', 'Chrome', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `co_orientador`
--
ALTER TABLE `co_orientador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orientador`
--
ALTER TABLE `orientador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ws_siteviews`
--
ALTER TABLE `ws_siteviews`
  ADD PRIMARY KEY (`siteviews_id`),
  ADD KEY `idx_1` (`siteviews_date`);

--
-- Indexes for table `ws_siteviews_agent`
--
ALTER TABLE `ws_siteviews_agent`
  ADD PRIMARY KEY (`agent_id`),
  ADD KEY `idx_1` (`agent_name`);

--
-- Indexes for table `ws_siteviews_online`
--
ALTER TABLE `ws_siteviews_online`
  ADD PRIMARY KEY (`online_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `co_orientador`
--
ALTER TABLE `co_orientador`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT for table `orientador`
--
ALTER TABLE `orientador`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;
--
-- AUTO_INCREMENT for table `ws_siteviews`
--
ALTER TABLE `ws_siteviews`
  MODIFY `siteviews_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `ws_siteviews_agent`
--
ALTER TABLE `ws_siteviews_agent`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ws_siteviews_online`
--
ALTER TABLE `ws_siteviews_online`
  MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
