/*
Navicat MySQL Data Transfer

Source Server         : laragon
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : tesis_sensores

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-04-29 18:53:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2016_09_04_000000_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('4', '2016_09_04_100000_create_role_user_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for registro_estudiantes
-- ----------------------------
DROP TABLE IF EXISTS `registro_estudiantes`;
CREATE TABLE `registro_estudiantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estudiante_id` int(10) unsigned NOT NULL,
  `registro_rutas_id` int(11) NOT NULL,
  `lugar_inicio` varchar(45) DEFAULT NULL,
  `lugar_fin` varchar(45) DEFAULT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_registro_users1_idx` (`estudiante_id`),
  KEY `fk_registros_registro_rutas1_idx` (`registro_rutas_id`),
  CONSTRAINT `fk_registro_users1` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registros_registro_rutas1` FOREIGN KEY (`registro_rutas_id`) REFERENCES `registro_rutas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of registro_estudiantes
-- ----------------------------

-- ----------------------------
-- Table structure for registro_rutas
-- ----------------------------
DROP TABLE IF EXISTS `registro_rutas`;
CREATE TABLE `registro_rutas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rutas_id` int(11) NOT NULL,
  `lugar_inicio` varchar(45) DEFAULT NULL,
  `lugar_fin` varchar(45) DEFAULT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_registro_rutas_rutas1_idx` (`rutas_id`),
  CONSTRAINT `fk_registro_rutas_rutas1` FOREIGN KEY (`rutas_id`) REFERENCES `rutas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of registro_rutas
-- ----------------------------

-- ----------------------------
-- Table structure for rfid
-- ----------------------------
DROP TABLE IF EXISTS `rfid`;
CREATE TABLE `rfid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rfid
-- ----------------------------
INSERT INTO `rfid` VALUES ('1', '123', null, null, null);
INSERT INTO `rfid` VALUES ('2', '321', null, null, null);
INSERT INTO `rfid` VALUES ('3', '312', null, null, null);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Administrador', 'admin', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('2', 'Estudiante', 'estudiante', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('3', 'Super Administrador', 'super-admin', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('4', 'Familiar', 'familiar', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('5', 'Conductor', 'conductor', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('6', 'Rector', 'rector', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', '1', '2017-09-11 00:12:13', '2017-09-11 00:12:13');
INSERT INTO `role_user` VALUES ('5', '3', '5', '2017-09-24 16:48:56', '2017-09-24 16:48:56');
INSERT INTO `role_user` VALUES ('8', '2', '4', '2017-09-27 14:17:55', '2017-09-27 14:17:55');
INSERT INTO `role_user` VALUES ('9', '5', '6', '2018-04-26 10:43:46', '2018-04-26 10:43:46');

-- ----------------------------
-- Table structure for rutas
-- ----------------------------
DROP TABLE IF EXISTS `rutas`;
CREATE TABLE `rutas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `conductor_id` int(10) unsigned NOT NULL,
  `acompañante_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rutas_users1_idx` (`conductor_id`),
  KEY `fk_rutas_users2_idx` (`acompañante_id`),
  CONSTRAINT `fk_rutas_users1` FOREIGN KEY (`conductor_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rutas_users2` FOREIGN KEY (`acompañante_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rutas
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `users_id` int(10) unsigned DEFAULT NULL,
  `rfid_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `rfid_id_UNIQUE` (`rfid_id`),
  KEY `fk_users_users1_idx` (`users_id`),
  KEY `fk_users_rfid1_idx` (`rfid_id`),
  CONSTRAINT `fk_users_rfid1` FOREIGN KEY (`rfid_id`) REFERENCES `rfid` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Alejandro Martinezz', 'lider@lider.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', 'NGR9upXTqMzsolrU4oBLQJB9Ta5uyKE9GLvVjqOKo4p7cdMuAeTDzQs1tnrK', '2017-09-11 00:12:13', '2017-10-21 01:02:26', null, null, '1');
INSERT INTO `users` VALUES ('4', 'Edwin Chapuel', 'ed.ch@gmail.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', 'PKWRpbQLRGz9f71c64ozNJiDAlGeibd7IZOMWuXpHlFFWUA2BP9jE3aztdy2', '2017-09-24 12:47:32', '2018-04-29 12:27:03', null, null, '2');
INSERT INTO `users` VALUES ('5', 'Super Admin', 'admin@admin.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', 'eVXwqiM6oJIUZd4ytvPPleucsKv3Xnvb03ngi3vIxXJOpXVz985OINnY2OTe', null, null, null, null, null);
INSERT INTO `users` VALUES ('6', 'Jose Torres', 'jose.torres@gmail.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', 'NhBxkiPL50OP8ozBW3PaSHDwGlj9UDBvM0Tnjkx1hQVj8GdB1oXIIY1sTaZm', '2018-04-26 10:43:46', '2018-04-26 10:43:46', null, null, '3');
SET FOREIGN_KEY_CHECKS=1;
