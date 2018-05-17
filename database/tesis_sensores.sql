/*
Navicat MySQL Data Transfer

Source Server         : laragon
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : tesis_sensores

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-17 16:06:16
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of registro_estudiantes
-- ----------------------------
INSERT INTO `registro_estudiantes` VALUES ('7', '8', '2', null, null, null, null, '0', '2018-05-17 15:31:44', '2018-05-17 15:31:48', null);
INSERT INTO `registro_estudiantes` VALUES ('8', '4', '2', null, null, null, null, '0', '2018-05-17 15:31:55', '2018-05-17 15:55:40', null);
INSERT INTO `registro_estudiantes` VALUES ('9', '4', '3', null, null, null, null, '0', '2018-05-17 15:58:23', '2018-05-17 15:58:38', null);
INSERT INTO `registro_estudiantes` VALUES ('10', '8', '3', null, null, null, null, '0', '2018-05-17 15:58:32', '2018-05-17 15:58:35', null);
INSERT INTO `registro_estudiantes` VALUES ('11', '4', '4', null, null, null, null, '0', '2018-05-17 16:04:05', '2018-05-17 16:04:15', null);
INSERT INTO `registro_estudiantes` VALUES ('12', '8', '4', null, null, null, null, '0', '2018-05-17 16:04:10', '2018-05-17 16:04:19', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of registro_rutas
-- ----------------------------
INSERT INTO `registro_rutas` VALUES ('2', '1', null, null, '2018-05-13 22:04:34', null, '0', '2018-05-13 22:04:34', '2018-05-17 15:53:21', null);
INSERT INTO `registro_rutas` VALUES ('3', '1', null, null, '2018-05-17 15:54:00', null, '0', '2018-05-17 15:54:00', '2018-05-17 15:58:43', null);
INSERT INTO `registro_rutas` VALUES ('4', '1', null, null, '2018-05-17 16:03:16', null, '0', '2018-05-17 16:03:16', '2018-05-17 16:04:28', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rfid
-- ----------------------------
INSERT INTO `rfid` VALUES ('1', '1', null, null, null);
INSERT INTO `rfid` VALUES ('2', '2', null, null, null);
INSERT INTO `rfid` VALUES ('3', '3', null, null, null);
INSERT INTO `rfid` VALUES ('4', '4', null, null, null);
INSERT INTO `rfid` VALUES ('5', '5', null, null, null);
INSERT INTO `rfid` VALUES ('6', '6', null, null, null);
INSERT INTO `rfid` VALUES ('7', '7', null, null, null);
INSERT INTO `rfid` VALUES ('8', '8', null, null, null);
INSERT INTO `rfid` VALUES ('9', '9', null, null, null);
INSERT INTO `rfid` VALUES ('10', '10', null, null, null);
INSERT INTO `rfid` VALUES ('11', '11', null, null, null);
INSERT INTO `rfid` VALUES ('12', '12', null, null, null);
INSERT INTO `rfid` VALUES ('13', '13', null, null, null);
INSERT INTO `rfid` VALUES ('14', '14', null, null, null);
INSERT INTO `rfid` VALUES ('15', '15', null, null, null);
INSERT INTO `rfid` VALUES ('16', '16', null, null, null);
INSERT INTO `rfid` VALUES ('17', '17', null, null, null);
INSERT INTO `rfid` VALUES ('18', '18', null, null, null);
INSERT INTO `rfid` VALUES ('19', '19', null, null, null);
INSERT INTO `rfid` VALUES ('20', '20', null, null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Administrador', 'admin', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('2', 'Estudiante', 'estudiante', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('3', 'Super Administrador', 'super-admin', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('4', 'Familiar', 'familiar', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('5', 'Conductor', 'conductor', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('6', 'Rector', 'rector', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');
INSERT INTO `roles` VALUES ('7', 'Profesor', 'profesor', null, 'default', '2018-04-26 09:23:52', '2018-04-26 09:23:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', '1', '2017-09-11 00:12:13', '2017-09-11 00:12:13');
INSERT INTO `role_user` VALUES ('5', '3', '5', '2017-09-24 16:48:56', '2017-09-24 16:48:56');
INSERT INTO `role_user` VALUES ('8', '2', '4', '2017-09-27 14:17:55', '2017-09-27 14:17:55');
INSERT INTO `role_user` VALUES ('9', '5', '6', '2018-04-26 10:43:46', '2018-04-26 10:43:46');
INSERT INTO `role_user` VALUES ('10', '4', '7', '2018-05-13 14:59:41', '2018-05-13 14:59:41');
INSERT INTO `role_user` VALUES ('11', '2', '8', '2018-05-13 15:00:20', '2018-05-13 15:00:20');
INSERT INTO `role_user` VALUES ('12', '4', '9', '2018-05-13 15:10:32', '2018-05-13 15:10:32');
INSERT INTO `role_user` VALUES ('13', '7', '10', '2018-05-13 16:49:26', '2018-05-13 16:49:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rutas
-- ----------------------------
INSERT INTO `rutas` VALUES ('1', '101', '6', '10', '2018-05-13 16:49:43', '2018-05-13 16:49:43', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Alejandro Martinezz', 'ale@ale.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', 'NGR9upXTqMzsolrU4oBLQJB9Ta5uyKE9GLvVjqOKo4p7cdMuAeTDzQs1tnrK', '2017-09-11 00:12:13', '2017-10-21 01:02:26', null, null, '1');
INSERT INTO `users` VALUES ('4', 'Edwin Chapuel', 'ed.ch@gmail.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', 'PKWRpbQLRGz9f71c64ozNJiDAlGeibd7IZOMWuXpHlFFWUA2BP9jE3aztdy2', '2017-09-24 12:47:32', '2018-05-13 16:28:35', null, '9', '2');
INSERT INTO `users` VALUES ('5', 'Super Admin', 'admin@admin.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', 'KZfa9VAcZoZrXp11oAiaIPAntLUIHNd92WKVdpzOW79RKHve4L7MxOWO2a5O', null, null, null, null, null);
INSERT INTO `users` VALUES ('6', 'Jose Torres', 'jose.torres@gmail.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', 'UKpRBn215YlbwcO5OQIjG7TtZ02PooLoyi1GUQO3U7XYANfweasUx6LQq1ya', '2018-04-26 10:43:46', '2018-04-26 10:43:46', null, null, '3');
INSERT INTO `users` VALUES ('7', 'Harold', 'harold@harold.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', null, '2018-05-13 14:59:41', '2018-05-13 14:59:41', null, null, '4');
INSERT INTO `users` VALUES ('8', 'Estudiante2', 'est2@est2.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', null, '2018-05-13 15:00:20', '2018-05-13 16:28:11', null, '7', '5');
INSERT INTO `users` VALUES ('9', 'Familiar 2', 'fam2@fam2.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', null, '2018-05-13 15:10:32', '2018-05-13 15:10:32', null, null, '6');
INSERT INTO `users` VALUES ('10', 'Carlos Arenas', 'car@car.com', '602bdc204140db016bee5374895e5568ce422fabe17e064061d80097', null, '2018-05-13 16:49:26', '2018-05-13 16:49:26', null, null, '7');
SET FOREIGN_KEY_CHECKS=1;
