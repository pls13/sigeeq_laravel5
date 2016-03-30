/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : db_sigeeq

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-03-17 21:02:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for equipamentos
-- ----------------------------
DROP TABLE IF EXISTS `equipamentos`;
CREATE TABLE `equipamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unidade_id` int(10) unsigned NOT NULL,
  `tipo_id` int(10) unsigned NOT NULL,
  `local_id` int(10) unsigned NOT NULL,
  `last_user_id` int(10) unsigned NOT NULL,
  `patrimonio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `observacao` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `equipamentos_patrimonio_unique` (`patrimonio`),
  KEY `equipamentos_unidade_id_foreign` (`unidade_id`),
  KEY `equipamentos_tipo_id_foreign` (`tipo_id`),
  KEY `equipamentos_local_id_foreign` (`local_id`),
  KEY `equipamentos_last_user_id_foreign` (`last_user_id`),
  CONSTRAINT `equipamentos_last_user_id_foreign` FOREIGN KEY (`last_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `equipamentos_local_id_foreign` FOREIGN KEY (`local_id`) REFERENCES `local_equipamentos` (`id`),
  CONSTRAINT `equipamentos_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_equipamentos` (`id`),
  CONSTRAINT `equipamentos_unidade_id_foreign` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of equipamentos
-- ----------------------------
INSERT INTO `equipamentos` VALUES ('1', '1', '1', '6', '1', '1234123', 'computador que fica disponível aos professores', '1', '2016-03-17 22:23:46', '2016-03-17 22:23:46');
INSERT INTO `equipamentos` VALUES ('2', '1', '5', '3', '6', '3432423', 'impressora hp 4250', '1', '2016-03-17 22:26:09', '2016-03-17 23:57:27');
INSERT INTO `equipamentos` VALUES ('3', '1', '1', '5', '1', '5646464', 'computador ', '0', '2016-03-17 22:30:45', '2016-03-17 22:30:45');
INSERT INTO `equipamentos` VALUES ('4', '2', '1', '3', '6', '352435', 'obssss', '0', '2016-03-17 23:58:38', '2016-03-17 23:58:38');

-- ----------------------------
-- Table structure for local_equipamentos
-- ----------------------------
DROP TABLE IF EXISTS `local_equipamentos`;
CREATE TABLE `local_equipamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `local_equipamentos_nome_unique` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of local_equipamentos
-- ----------------------------
INSERT INTO `local_equipamentos` VALUES ('1', 'Laboratório Informática', '', '1', '2016-03-17 22:21:46', '2016-03-17 22:21:46');
INSERT INTO `local_equipamentos` VALUES ('2', 'Biblioteca', '', '1', '2016-03-17 22:22:01', '2016-03-17 22:22:01');
INSERT INTO `local_equipamentos` VALUES ('3', 'Recepção', '', '1', '2016-03-17 22:22:13', '2016-03-17 22:22:13');
INSERT INTO `local_equipamentos` VALUES ('4', 'Sala direção', '', '1', '2016-03-17 22:22:22', '2016-03-17 22:22:22');
INSERT INTO `local_equipamentos` VALUES ('5', 'Sala coordenação', '', '1', '2016-03-17 22:22:43', '2016-03-17 22:22:43');
INSERT INTO `local_equipamentos` VALUES ('6', 'Sala dos professores', '', '1', '2016-03-17 22:22:52', '2016-03-17 22:22:52');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2016_03_12_164650_create_orgaos_table', '1');
INSERT INTO `migrations` VALUES ('2016_03_12_164723_create_unidades_table', '1');
INSERT INTO `migrations` VALUES ('2016_03_12_164751_create_tipo_equipamentos_table', '1');
INSERT INTO `migrations` VALUES ('2016_03_12_164802_create_local_equipamentos_table', '1');
INSERT INTO `migrations` VALUES ('2016_03_12_164811_create_equipamentos_table', '1');

-- ----------------------------
-- Table structure for orgaos
-- ----------------------------
DROP TABLE IF EXISTS `orgaos`;
CREATE TABLE `orgaos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orgaos_nome_unique` (`nome`),
  UNIQUE KEY `orgaos_sigla_unique` (`sigla`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orgaos
-- ----------------------------
INSERT INTO `orgaos` VALUES ('1', 'Secretaria de Educação', 'SE', '1', '2016-03-17 22:14:50', '2016-03-17 22:15:02');
INSERT INTO `orgaos` VALUES ('2', 'Secretaria da Saúde', 'SS', '1', '2016-03-17 22:15:24', '2016-03-17 22:15:24');
INSERT INTO `orgaos` VALUES ('3', 'Secretaria de Segurança Pública', 'SSP', '0', '2016-03-17 22:15:45', '2016-03-17 22:15:51');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for tipo_equipamentos
-- ----------------------------
DROP TABLE IF EXISTS `tipo_equipamentos`;
CREATE TABLE `tipo_equipamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo_equipamentos_nome_unique` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipo_equipamentos
-- ----------------------------
INSERT INTO `tipo_equipamentos` VALUES ('1', 'Computador', 'computador tipo gabinete tal', '1', '2016-03-17 22:18:31', '2016-03-17 22:18:39');
INSERT INTO `tipo_equipamentos` VALUES ('2', 'Note Book ', 'notebook', '1', '2016-03-17 22:19:09', '2016-03-17 22:19:09');
INSERT INTO `tipo_equipamentos` VALUES ('3', 'Monitor LCD', '', '1', '2016-03-17 22:19:20', '2016-03-17 22:19:20');
INSERT INTO `tipo_equipamentos` VALUES ('4', 'Monitor CRT', '', '1', '2016-03-17 22:19:41', '2016-03-17 22:19:41');
INSERT INTO `tipo_equipamentos` VALUES ('5', 'Impressora', 'impressora', '1', '2016-03-17 22:19:55', '2016-03-17 22:19:55');
INSERT INTO `tipo_equipamentos` VALUES ('6', 'Data Show', '', '1', '2016-03-17 22:20:25', '2016-03-17 22:20:25');
INSERT INTO `tipo_equipamentos` VALUES ('7', 'Microfone', '', '1', '2016-03-17 22:20:37', '2016-03-17 22:20:37');

-- ----------------------------
-- Table structure for unidades
-- ----------------------------
DROP TABLE IF EXISTS `unidades`;
CREATE TABLE `unidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tecnico_id` int(10) unsigned DEFAULT NULL,
  `orgao_id` int(10) unsigned NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `rua` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_diretor` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unidades_nome_unique` (`nome`),
  UNIQUE KEY `unidades_sigla_unique` (`sigla`),
  KEY `unidades_tecnico_id_foreign` (`tecnico_id`),
  KEY `unidades_orgao_id_foreign` (`orgao_id`),
  CONSTRAINT `unidades_orgao_id_foreign` FOREIGN KEY (`orgao_id`) REFERENCES `orgaos` (`id`),
  CONSTRAINT `unidades_tecnico_id_foreign` FOREIGN KEY (`tecnico_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of unidades
-- ----------------------------
INSERT INTO `unidades` VALUES ('1', '1', '1', 'Escola Municipal Ayrton Senna', 'EMAS', 'rua tal', '223', 'Itapema', '3443-1222', 'Aparecida Grandini', '2016-03-17 22:17:05', '2016-03-17 22:17:05');
INSERT INTO `unidades` VALUES ('2', '1', '2', 'UBS Paese', 'paese', 'rua tal', '453', 'paese', '4234', 'Pedro', '2016-03-17 22:17:54', '2016-03-17 22:17:54');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_unique` (`login`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'root', '', 'pls13web@gmail.com', '$2y$10$pm69HiM.I28a9SGOj8GPB.4ZouA5.MAK7/gdyjOjOTBrtuur1U30.', '1', 'tadmWKKE5tcKdlfAQ8UhpHeCSMLf5ecAKrlgOWNoyuG6przyf1halDYchdIj', '2016-03-17 22:11:10', '2016-03-17 22:32:53');
INSERT INTO `users` VALUES ('6', 'ale', 'pls', 'pls13ig@ig.com.br', '$2y$10$uWinUFOtCTnqfgyxUMSj1esgwo9yVQwOAMSYVug.Kbv2UtvVTY4H.', '1', null, '2016-03-17 23:20:38', '2016-03-17 23:20:38');
