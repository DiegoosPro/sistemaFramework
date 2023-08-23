/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.28-MariaDB : Database - dbsuper
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbsuper` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;

USE `dbsuper`;

/*Table structure for table `perfiles` */

DROP TABLE IF EXISTS `perfiles`;

CREATE TABLE `perfiles` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `per_nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Data for the table `perfiles` */

insert  into `perfiles`(`per_id`,`per_nombre`) values (1,'Administrador'),(2,'Vendedor'),(3,'Gerente');

/*Table structure for table `tab_categorias` */

DROP TABLE IF EXISTS `tab_categorias`;

CREATE TABLE `tab_categorias` (
  `catego_id` int(11) NOT NULL,
  `catego_descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`catego_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Data for the table `tab_categorias` */

insert  into `tab_categorias`(`catego_id`,`catego_descripcion`) values (1,'Electrodomésticos'),(2,'Alimentos y Bebidas'),(3,'Electrónica'),(4,'Cuidado Personal'),(5,'Hogar y Decoración');

/*Table structure for table `tab_marcas` */

DROP TABLE IF EXISTS `tab_marcas`;

CREATE TABLE `tab_marcas` (
  `marca_id` int(11) NOT NULL,
  `marca_descripcion` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Data for the table `tab_marcas` */

insert  into `tab_marcas`(`marca_id`,`marca_descripcion`) values (1,'Kellogg\'s'),(2,'Coca-Cola'),(3,'Nestlé'),(4,'P&G'),(5,'Unilever');

/*Table structure for table `tab_productos` */

DROP TABLE IF EXISTS `tab_productos`;

CREATE TABLE `tab_productos` (
  `pro_id` int(11) NOT NULL,
  `pro_descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pro_precio_c` decimal(10,2) DEFAULT NULL,
  `pro_precio_v` decimal(10,2) DEFAULT NULL,
  `pro_stock` int(11) DEFAULT 0,
  `pro_fecha_elab` date DEFAULT NULL,
  `pro_nivel_azucar` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pro_aplica_iva` tinyint(1) DEFAULT NULL,
  `pro_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pro_imagen` varchar(30) DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `catego_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `marca_id` (`marca_id`),
  KEY `catego_id` (`catego_id`),
  CONSTRAINT `tab_productos_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `tab_marcas` (`marca_id`),
  CONSTRAINT `tab_productos_ibfk_2` FOREIGN KEY (`catego_id`) REFERENCES `tab_categorias` (`catego_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Data for the table `tab_productos` */

insert  into `tab_productos`(`pro_id`,`pro_descripcion`,`pro_precio_c`,`pro_precio_v`,`pro_stock`,`pro_fecha_elab`,`pro_nivel_azucar`,`pro_aplica_iva`,`pro_especifica`,`pro_imagen`,`marca_id`,`catego_id`) values (4,'Crema Facial Nivea X',9.99,14.99,15,'2023-06-04','M',1,'Hidratante, 50 ml','foto_4.jpeg',2,4),(6,'Cereal Corn Flakes',3.49,5.99,25,'2023-06-10','A',1,'Cereal de maíz, 350g','foto_6.jpeg',3,2),(7,'Samsung Galaxy S22',899.00,1099.99,10,'2023-06-11','N',1,'Pantalla AMOLED de 6.4\", 128GB Almacenamiento','foto_7.jpeg',4,3),(8,'Champú Herbal Essences',6.99,8.99,30,'2023-06-12','A',1,'Con extractos naturales, 300 ml','foto_8.jpeg',5,4),(9,'Set de Utensilios de Cocina',39.99,49.99,8,'2023-06-13','M',1,'Incluye cucharas, espátulas y más','utensilios_cocina.jpeg',2,5),(10,'Pasta Dental Colgate',2.49,3.99,50,'2023-06-14','A',1,'Protección contra caries, 100g','foto_10.jpeg',4,4),(11,'Televisor LED 55',599.00,699.99,5,'2023-06-15','N',1,'Resolución Full HD, Smart TV integrado','foto_11.jpeg',5,3),(12,'Cepillo de Dientes Oral-B',1.99,2.99,40,'2023-06-16','A',1,'Cerdas suaves, paquete de 2','foto_12.jpeg',4,4),(13,'Cafetera Express',89.99,109.99,7,'2023-06-17','N',1,'Prepara espresso y capuchino','foto_13.jpg',5,3),(14,'Pañuelos Kleenex',0.99,1.49,60,'2023-06-18','A',1,'Caja con 100 pañuelos suaves','kleenex_pañuelos.jpeg',3,2),(15,'Aspiradora Robot',149.99,179.99,12,'2023-06-19','M',1,'Limpieza automática programable','foto_15.jpeg',4,5),(777,'FHFJFGH',56.00,87.00,4,'2023-07-20','M',1,'DGGGGD','sinimagen.jpeg',3,4);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_usuario` varchar(10) DEFAULT NULL,
  `user_contra` varchar(15) DEFAULT NULL,
  `user_nombre` varchar(30) DEFAULT NULL,
  `user_activo` tinyint(1) DEFAULT 1,
  `user_create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `per_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `per_id` (`per_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`per_id`) REFERENCES `perfiles` (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`user_id`,`user_usuario`,`user_contra`,`user_nombre`,`user_activo`,`user_create_at`,`per_id`) values (1,'admin','admin','RENE PILATAXI',1,'2023-08-07 17:23:21',1),(2,'pepe','123','JOSE ARIAS',1,'2023-08-07 17:23:47',2),(3,'anita','444','ANITA GAVILANES',1,'2023-08-07 17:24:23',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
