/*
SQLyog Ultimate v9.63 
MySQL - 5.6.17 : Database - ci_vetsis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ci_vetsis` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ci_vetsis`;

/*Table structure for table `admin_preferences` */

DROP TABLE IF EXISTS `admin_preferences`;

CREATE TABLE `admin_preferences` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `user_panel` tinyint(1) NOT NULL DEFAULT '0',
  `sidebar_form` tinyint(1) NOT NULL DEFAULT '0',
  `messages_menu` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_menu` tinyint(1) NOT NULL DEFAULT '0',
  `tasks_menu` tinyint(1) NOT NULL DEFAULT '0',
  `user_menu` tinyint(1) NOT NULL DEFAULT '1',
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT '0',
  `transition_page` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `admin_preferences` */

insert  into `admin_preferences`(`id`,`user_panel`,`sidebar_form`,`messages_menu`,`notifications_menu`,`tasks_menu`,`user_menu`,`ctrl_sidebar`,`transition_page`) values (1,0,0,0,0,0,1,0,0);

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id_cliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) NOT NULL,
  `cli_nombre` varchar(100) DEFAULT NULL,
  `cli_sexo` enum('Masculino','Femenino') DEFAULT NULL,
  `cli_doc` varchar(50) NOT NULL,
  `cli_direccion` varchar(200) NOT NULL,
  `cli_localidad` varchar(200) NOT NULL,
  `cli_provincia` varchar(100) NOT NULL,
  `cli_cp` varchar(20) NOT NULL,
  `cli_telefono` varchar(50) DEFAULT NULL,
  `cli_movil` varchar(50) DEFAULT NULL,
  `cli_correo` varchar(200) DEFAULT NULL,
  `cli_fecha_nac` date DEFAULT NULL,
  `cli_created_on` date DEFAULT NULL,
  `cli_tipo` enum('Frecuente','No frecuente') DEFAULT NULL,
  `cli_observaciones` text,
  `cli_lista_precios` tinyint(1) DEFAULT NULL,
  `cli_estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cliente`),
  KEY `SEC` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `clientes` */

insert  into `clientes`(`id_cliente`,`id_empresa`,`cli_nombre`,`cli_sexo`,`cli_doc`,`cli_direccion`,`cli_localidad`,`cli_provincia`,`cli_cp`,`cli_telefono`,`cli_movil`,`cli_correo`,`cli_fecha_nac`,`cli_created_on`,`cli_tipo`,`cli_observaciones`,`cli_lista_precios`,`cli_estado`) values (3,1,'EMilio','Masculino','24551196','Misiones 453','ciudad','mendoza','5500','261-4302103','261-5736006','jaluff@hotmail.com','2016-08-15','1975-07-17','No frecuente',NULL,3,1),(4,1,'alejandro jaluff','Masculino','','','','','','4305040','261-5736078','alejandro@hotmail.com','2016-08-16','1980-08-19','No frecuente',NULL,2,1);

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id_empresa` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `nombre_fantasia` varchar(150) DEFAULT NULL,
  `calle` varchar(200) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `piso` varchar(20) DEFAULT NULL,
  `departamento` varchar(20) DEFAULT NULL,
  `barrio` varchar(150) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `telefono_fijo` varchar(50) DEFAULT NULL,
  `telefono_movil` varchar(50) DEFAULT NULL,
  `telefono_alternativo` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `codigo_postal` varbinary(20) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`),
  CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `clientes` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `empresa_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `tpv` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `empresa` */

insert  into `empresa`(`id_empresa`,`nombre`,`nombre_fantasia`,`calle`,`numero`,`piso`,`departamento`,`barrio`,`localidad`,`provincia`,`pais`,`telefono_fijo`,`telefono_movil`,`telefono_alternativo`,`fax`,`correo_electronico`,`web`,`codigo_postal`) values (1,'De la torre','DLT vet','Adolfo calle ','456',NULL,NULL,NULL,'Ciudad','Mendoza','ARgentina','261-456123',NULL,NULL,NULL,'DLT@hotmail.com',NULL,'5500');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`,`bgcolor`) values (1,'admin','Administrator','#F44336'),(2,'members','General User','#2196F3');

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

/*Table structure for table `mascotas` */

DROP TABLE IF EXISTS `mascotas`;

CREATE TABLE `mascotas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) NOT NULL,
  `mas_nombre` varchar(50) DEFAULT NULL,
  `mas_especie` varchar(50) DEFAULT NULL,
  `mas_raza` varchar(100) DEFAULT NULL,
  `mas_sexo` varchar(20) DEFAULT NULL,
  `mas_peso` int(5) DEFAULT NULL,
  `mas_observaciones` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `SECONDARY` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `mascotas` */

insert  into `mascotas`(`id`,`id_cliente`,`mas_nombre`,`mas_especie`,`mas_raza`,`mas_sexo`,`mas_peso`,`mas_observaciones`) values (1,1,'Branko','Canino','Doberman','Masculino',40,NULL);

/*Table structure for table `public_preferences` */

DROP TABLE IF EXISTS `public_preferences`;

CREATE TABLE `public_preferences` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `transition_page` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `public_preferences` */

insert  into `public_preferences`(`id`,`transition_page`) values (1,0);

/*Table structure for table `tpv` */

DROP TABLE IF EXISTS `tpv`;

CREATE TABLE `tpv` (
  `id_tpv` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(5) DEFAULT NULL,
  `tpv_nombre` varchar(50) DEFAULT NULL,
  `tpv_direccion` varchar(200) DEFAULT NULL,
  `tpv_localidad` varchar(100) DEFAULT NULL,
  `tpv_provincia` varchar(100) DEFAULT NULL,
  `tpv_cp` varchar(50) DEFAULT NULL,
  `tpv_telefono_fijo` varchar(30) DEFAULT NULL,
  `tpv_telefono_movil` varchar(30) DEFAULT NULL,
  `tpv_correo` varchar(200) DEFAULT NULL,
  `tpv_estado` enum('Activo','No activo') DEFAULT NULL,
  `tpv_created_on` date DEFAULT NULL,
  PRIMARY KEY (`id_tpv`),
  KEY `SEC` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tpv` */

insert  into `tpv`(`id_tpv`,`id_empresa`,`tpv_nombre`,`tpv_direccion`,`tpv_localidad`,`tpv_provincia`,`tpv_cp`,`tpv_telefono_fijo`,`tpv_telefono_movil`,`tpv_correo`,`tpv_estado`,`tpv_created_on`) values (1,1,'Palmares','Complejo palmares',NULL,'Mendoza','5500',NULL,NULL,NULL,'Activo','2016-08-09');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) values (1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','','3VOKKnrjzvtfAEPq0bAyZ.018bc664a909b0c8ba',1470933006,'zAhKWH84Ig.4T8lDhRKSYu',1268889823,1471645550,1,'Admin','istrator','ADMIN','0'),(2,'192.168.1.41','','$2y$08$NVor1kMJYGzazMMduT/iB.y7PmAPaf.V4c.zkeyO41ac380aR6xg2',NULL,'jaluff@hotmail.com',NULL,NULL,NULL,NULL,1470933445,1470934833,1,'emilio','jaluff','Dlt veterinaria','2615736006');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values (4,1,1),(3,2,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
