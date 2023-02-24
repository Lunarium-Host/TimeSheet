/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 101003
 Source Host           : localhost:3306
 Source Schema         : lun.busydoc

 Target Server Type    : MariaDB
 Target Server Version : 101003
 File Encoding         : 65001

 Date: 24/02/2023 10:05:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Уникальный код',
  `active` int(1) NOT NULL DEFAULT 0 COMMENT 'Aктивный ( 1 - Активный, 0 - неактивный )',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'Имя',
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Описание',
  `phone` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'Номер телефона',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'e-mail',
  `price` float(6, 0) NOT NULL DEFAULT 0 COMMENT 'Цена для клиента',
  `startdate` datetime(0) NOT NULL COMMENT 'Дата добавления',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `code`(`code`) USING BTREE COMMENT 'Уникальный код',
  INDEX `active`(`active`) USING BTREE COMMENT 'Aктивный ( 1 - Активный, 0 - неактивный )'
) ENGINE = InnoDB COMMENT = 'Компании' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for period
-- ----------------------------
DROP TABLE IF EXISTS `period`;
CREATE TABLE `period`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `idCompany` int(10) NOT NULL COMMENT 'Идентификатор компании',
  `datetime` datetime(0) NOT NULL COMMENT 'Дата окончания периода',
  `payed` float(8, 2) NOT NULL DEFAULT 0 COMMENT 'Оплата',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idCompany`(`idCompany`) USING BTREE COMMENT 'Индекс идентификатора компании',
  CONSTRAINT `fk_period_company` FOREIGN KEY (`idCompany`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT = 'Периоды' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `idCompany` int(11) NOT NULL COMMENT 'Идентификатор клиента',
  `active` int(1) NOT NULL DEFAULT 0 COMMENT 'Активный ( 0 - неактивный, 1 - активный )',
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Код проекта',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Наименование',
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Описание',
  `startdate` datetime(0) NULL DEFAULT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `codeIdCompany`(`code`, `idCompany`) USING BTREE COMMENT 'Код проекта у клиента не повторяется',
  INDEX `idClient`(`idCompany`) USING BTREE COMMENT 'Идентификатор клиента',
  INDEX `active`(`active`) USING BTREE COMMENT 'Активный ( 0 - неактивный, 1 - активный )',
  CONSTRAINT `FK_project_company` FOREIGN KEY (`idCompany`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COLLATE = utf8mb4_unicode_ci COMMENT = 'Проекты' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session`  (
  `id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Идентификатор сессии',
  `idUser` int(11) NULL DEFAULT NULL COMMENT 'Идентификатор пользователя',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Данные сессии',
  `startdate` datetime(0) NOT NULL COMMENT 'Дата создания сессии',
  `lastdate` datetime(0) NOT NULL COMMENT 'Дата последней активности',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `session_id`(`id`) USING BTREE COMMENT 'Идентификатор сессии',
  INDEX `session_startdate`(`startdate`) USING BTREE COMMENT 'Дата добавления',
  INDEX `session_lastDate`(`lastdate`) USING BTREE COMMENT 'Дата последнего обновления',
  INDEX `session_idUser`(`idUser`) USING BTREE COMMENT 'Идентификатор пользователя',
  CONSTRAINT `FK_session_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT = 'Сессии' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `active` int(1) NOT NULL DEFAULT 0 COMMENT 'Активный ( 0 - неактивный, 1 - активный )',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Наименование',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `active`(`active`) USING BTREE COMMENT 'Активный ( 0 - неактивный, 1 - активный )'
) ENGINE = InnoDB COMMENT = 'Статусы задач' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `idProject` int(11) NOT NULL COMMENT 'Идентификатор проекта',
  `idPeriod` int(11) NULL DEFAULT NULL COMMENT 'Идентификатор периода',
  `idStatus` int(11) NULL DEFAULT NULL COMMENT 'Идентификатор статуса',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Наименование',
  `about` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Описание',
  `spend` float(3, 1) NULL DEFAULT NULL COMMENT 'Количество оцененных/потраченных часов',
  `createdate` datetime(0) NULL DEFAULT NULL COMMENT 'Дата создания',
  `startdate` datetime(0) NULL DEFAULT NULL COMMENT 'Дата начала задачи',
  `enddatePlan` datetime(0) NULL DEFAULT NULL COMMENT 'Дата планируемого окончания задачи',
  `enddate` datetime(0) NULL DEFAULT NULL COMMENT 'Дата окончания задачи',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idProject`(`idProject`) USING BTREE COMMENT 'Идентификатор проекта',
  INDEX `idStatus`(`idStatus`) USING BTREE COMMENT 'Идентификатор статуса',
  INDEX `createdate`(`createdate`) USING BTREE COMMENT 'Дата создания',
  INDEX `startdate`(`startdate`) USING BTREE COMMENT 'Дата начала задачи',
  INDEX `enddatePlan`(`enddatePlan`) USING BTREE COMMENT 'Дата планируемого окончания задачи',
  INDEX `enddate`(`enddate`) USING BTREE COMMENT 'Дата окончания задачи',
  INDEX `idPeriod`(`idPeriod`) USING BTREE COMMENT 'Идентификатор периода',
  CONSTRAINT `FK_task_period` FOREIGN KEY (`idPeriod`) REFERENCES `period` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_task_project` FOREIGN KEY (`idProject`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_task_status` FOREIGN KEY (`idStatus`) REFERENCES `status` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT = 'Задачи' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `idCompany` int(11) NOT NULL COMMENT 'Идентификатор компании',
  `admin` int(1) NOT NULL DEFAULT 0 COMMENT 'Администратор компании ( 0 - не является, 1 - в пределах организации, 2 - в пределах приложения)',
  `active` int(1) NOT NULL DEFAULT 0 COMMENT 'Активный ( 0 - неактивный, 1 - активный )',
  `login` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Логин',
  `pass` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Пароль',
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Имя пользователя',
  `surтame` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Отчество пользователя',
  `lastтame` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Фамилия пользователя',
  `lastdate` datetime(0) NOT NULL COMMENT 'Последняя дата посещения',
  `startdate` datetime(0) NOT NULL COMMENT 'Дата добавления',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `login`(`login`) USING BTREE COMMENT 'Логин',
  INDEX `pass`(`pass`) USING BTREE COMMENT 'Пароль',
  INDEX `active`(`active`) USING BTREE COMMENT 'Активный ( 0 - неактивный, 1 - активный )',
  INDEX `startdate`(`startdate`) USING BTREE COMMENT 'Дата добавления',
  INDEX `idCompany`(`idCompany`) USING BTREE COMMENT 'Идентификатор компании',
  CONSTRAINT `fk_user_company` FOREIGN KEY (`idCompany`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB COMMENT = 'Пользователи системы' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Triggers structure for table area
-- ----------------------------
DROP TRIGGER IF EXISTS `area_insert_sort`;
delimiter ;;
CREATE TRIGGER `area_insert_sort` BEFORE INSERT ON `area` FOR EACH ROW BEGIN
  SET new.sort = CASE WHEN new.sort IS NULL OR new.sort = 0 THEN ( SELECT ( count( id )+1 ) * 10 from `area` where idProject = new.idProject ) ELSE new.sort END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table area
-- ----------------------------
DROP TRIGGER IF EXISTS `area_insert_eventdate`;
delimiter ;;
CREATE TRIGGER `area_insert_eventdate` BEFORE INSERT ON `area` FOR EACH ROW BEGIN
  SET new.eventdate = CASE WHEN new.eventdate IS NULL THEN NOW() ELSE new.eventdate END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table areagroup
-- ----------------------------
DROP TRIGGER IF EXISTS `areaGroup_insert_sort`;
delimiter ;;
CREATE TRIGGER `areaGroup_insert_sort` BEFORE INSERT ON `areagroup` FOR EACH ROW BEGIN
  SET new.sort = CASE WHEN new.sort IS NULL OR new.sort = 0 THEN ( SELECT ( count( id )+1 ) * 10 from `areaGroup` where idArea = new.idArea ) ELSE new.sort END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table areaoption
-- ----------------------------
DROP TRIGGER IF EXISTS `areaOption_insert_sort`;
delimiter ;;
CREATE TRIGGER `areaOption_insert_sort` BEFORE INSERT ON `areaoption` FOR EACH ROW BEGIN 
  SET new.sort = CASE WHEN new.sort IS NULL OR new.sort = 0 THEN ( SELECT ( count( id )+1 ) * 10 from `areaOption` where idAreaGroup = new.idAreaGroup ) ELSE new.sort END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table company
-- ----------------------------
DROP TRIGGER IF EXISTS `company_insert_datetime`;
delimiter ;;
CREATE TRIGGER `company_insert_datetime` BEFORE INSERT ON `company` FOR EACH ROW BEGIN
	SET new.startdate = CASE WHEN new.startdate IS NULL THEN NOW() ELSE new.startdate END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table period
-- ----------------------------
DROP TRIGGER IF EXISTS `period_insert_datetime`;
delimiter ;;
CREATE TRIGGER `period_insert_datetime` BEFORE INSERT ON `period` FOR EACH ROW BEGIN
  SET new.datetime = CASE WHEN new.datetime IS NULL THEN NOW() ELSE new.datetime END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table project
-- ----------------------------
DROP TRIGGER IF EXISTS `project_insert_startdate`;
delimiter ;;
CREATE TRIGGER `project_insert_startdate` BEFORE INSERT ON `project` FOR EACH ROW BEGIN
	SET new.startdate = CASE WHEN new.startdate IS NULL THEN NOW() ELSE new.startdate END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table session
-- ----------------------------
DROP TRIGGER IF EXISTS `session_insert_startdate`;
delimiter ;;
CREATE TRIGGER `session_insert_startdate` BEFORE INSERT ON `session` FOR EACH ROW BEGIN
  SET new.startdate = CASE WHEN new.startdate IS NULL THEN NOW() ELSE new.startdate END,
      new.lastdate = CASE WHEN new.lastdate  IS NULL THEN new.startdate ELSE new.lastdate  END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table task
-- ----------------------------
DROP TRIGGER IF EXISTS `task_insert_startdate`;
delimiter ;;
CREATE TRIGGER `task_insert_startdate` BEFORE INSERT ON `task` FOR EACH ROW BEGIN
  SET new.createdate = CASE WHEN new.createdate IS NULL THEN NOW() ELSE new.createdate END;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table user
-- ----------------------------
DROP TRIGGER IF EXISTS `user_insert_startdate`;
delimiter ;;
CREATE TRIGGER `user_insert_startdate` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
	SET new.startdate = CASE WHEN new.startdate IS NULL THEN NOW() ELSE new.startdate END,
	     new.lastDate = CASE WHEN new.lastdate  IS NULL THEN new.startdate    ELSE new.lastdate  END;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO company SET active=1, name="Моя компания";
SET @idCompany = ( SELECT LAST_INSERT_ID() ) ;
INSERT INTO user SET idCompany=@idCompany, active=1,  admin=2, login="admin", pass=PASSWORD("admin"); 