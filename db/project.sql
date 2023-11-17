/*
 Navicat Premium Data Transfer

 Source Server         : localhost_xammp_nueng
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : project

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 11/10/2023 09:17:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `m_id` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (1, 'admin', '$2y$10$sSWmZhb1qRJ2NBagNAlSvedmqXPXXNtFIZjASrTa.8Yj5n2KzDTyu', 'ศรายุทธ', 'นวะศรี', 'admin', '1400900249352', '2023-09-22 14:02:25', '2023-09-22 14:02:25');
INSERT INTO `member` VALUES (2, 'plan', '$2y$10$rCYWUO8fXvUvT.wU93PEae/rqxGeHx/tCdAuKWKdLxho7g.HyCWbq', 'ผุ้ดูแลแผน', 'แผน', 'plan', '222222222222', '2023-09-22 14:04:54', '2023-09-22 14:04:54');
INSERT INTO `member` VALUES (3, 'finance', '$2y$10$dbFHmh7h9SQlViRsoG0teOTjxo5UOEf.CN5eFdVHxz9Iot7qSQFU2', 'การเงิน', 'เงิน', 'finance', '333333333333', '2023-09-22 14:06:09', '2023-09-22 14:06:09');
INSERT INTO `member` VALUES (4, 'user', '$2y$10$vfxqpDUnE5Vl/abmYx3qGewUVCw0Iyn96Y3I3v15EAzgi2pyBrOi2', 'เจ้าของโครงการ', 'โครงการ', 'member', '4444444444444', '2023-09-22 14:07:10', '2023-09-22 14:07:10');
INSERT INTO `member` VALUES (5, 'user2', '$2y$10$7J.3Xfw8XPSPmHG8dAHPIeGas.pJN07dEWmM.K/1f.voF2t3naXta', 'ทดสอบ', 'ทดสอบ', 'member', '111116161', '2023-09-22 14:20:31', '2023-09-22 14:20:31');

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project`  (
  `project_id` int NOT NULL AUTO_INCREMENT,
  `project_plan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'plan_name',
  `project_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'project_name',
  `project_budget` double NOT NULL COMMENT 'budget',
  `project_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'status',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `plan_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id_import` int NOT NULL,
  `user_id_edit` int NOT NULL,
  PRIMARY KEY (`project_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES (1, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์1', 'คอมพิวเตอร์', 1000000, 'อนุมัติ', '2023-10-05 09:56:09', '2023-10-05 09:56:09', '001', 2, 0);
INSERT INTO `project` VALUES (2, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์2', 'เครื่องปริ้น', 500000, 'อนุมัติ', '2023-10-05 09:56:09', '2023-10-05 09:56:09', '002', 2, 0);
INSERT INTO `project` VALUES (3, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์2', 'ไอแพด', 500000, 'อนุมัติ', '2023-10-05 09:56:09', '2023-10-05 09:56:09', '002', 2, 0);
INSERT INTO `project` VALUES (4, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์3', 'หมึกดำ', 75000, 'อนุมัติ', '2023-10-05 09:56:09', '2023-10-05 09:56:09', '003', 2, 0);
INSERT INTO `project` VALUES (5, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์4', 'หมึกสี', 5000, 'อนุมัติ', '2023-10-05 09:56:09', '2023-10-05 10:01:17', '004', 2, 1);
INSERT INTO `project` VALUES (6, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์5', 'คอมพิวเตอร์', 1000000, 'อนุมัติ', '2023-10-11 09:08:28', '2023-10-11 09:08:28', '005', 2, 0);
INSERT INTO `project` VALUES (7, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์6', 'เครื่องปริ้น', 500000, 'อนุมัติ', '2023-10-11 09:08:28', '2023-10-11 09:08:28', '006', 2, 0);
INSERT INTO `project` VALUES (8, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์6', 'ไอแพด', 500000, 'อนุมัติ', '2023-10-11 09:08:28', '2023-10-11 09:08:28', '006', 2, 0);
INSERT INTO `project` VALUES (9, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์7', 'หมึกดำ', 75000, 'อนุมัติ', '2023-10-11 09:08:28', '2023-10-11 09:08:28', '007', 2, 0);
INSERT INTO `project` VALUES (10, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์8', 'หมึกสี', 5000, 'อนุมัติ', '2023-10-11 09:08:28', '2023-10-11 09:08:28', '008', 2, 0);
INSERT INTO `project` VALUES (11, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์9', 'คอมพิวเตอร์9', 1000000, 'อนุมัติ', '2023-10-11 09:10:40', '2023-10-11 09:10:40', '009', 2, 0);
INSERT INTO `project` VALUES (12, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์10', 'เครื่องปริ้น10', 500000, 'อนุมัติ', '2023-10-11 09:10:40', '2023-10-11 09:10:40', '010', 2, 0);
INSERT INTO `project` VALUES (13, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์10', 'ไอแพด10', 500000, 'อนุมัติ', '2023-10-11 09:10:40', '2023-10-11 09:10:40', '010', 2, 0);
INSERT INTO `project` VALUES (14, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์11', 'หมึกดำ11', 75000, 'อนุมัติ', '2023-10-11 09:10:40', '2023-10-11 09:10:40', '011', 2, 0);
INSERT INTO `project` VALUES (15, 'การจัดซื้อวัสดุ ครุภัณฑ์คอมพิวเตอร์12', 'หมึกสี12', 5000, 'อนุมัติ', '2023-10-11 09:10:40', '2023-10-11 09:10:40', '012', 2, 0);

-- ----------------------------
-- Table structure for project_status
-- ----------------------------
DROP TABLE IF EXISTS `project_status`;
CREATE TABLE `project_status`  (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`status_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of project_status
-- ----------------------------
INSERT INTO `project_status` VALUES (1, 'อนุมัติ');
INSERT INTO `project_status` VALUES (2, 'ไม่อนุมัติ');

-- ----------------------------
-- Table structure for sub_budget
-- ----------------------------
DROP TABLE IF EXISTS `sub_budget`;
CREATE TABLE `sub_budget`  (
  `sub_id` int NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sub_budget` float NOT NULL,
  `sub_created` datetime NOT NULL,
  `sub_modified` datetime NOT NULL,
  `sub_p_plan_id` int NOT NULL,
  `sub_p_name_id` int NOT NULL,
  `sub_date` date NOT NULL,
  `sub_time` time NOT NULL,
  `save_m_id` int NOT NULL,
  `modified_m_id` int NOT NULL,
  `edit_budget_m_id` int NOT NULL,
  PRIMARY KEY (`sub_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_budget
-- ----------------------------
INSERT INTO `sub_budget` VALUES (1, ' คอม', 600000, '2023-10-05 09:57:39', '2023-10-05 09:58:16', 1, 1, '2023-10-05', '09:57:14', 3, 3, 3);
INSERT INTO `sub_budget` VALUES (2, ' เครื่องพิมพ์', 100000, '2023-10-05 09:59:13', '2023-10-05 09:59:13', 2, 2, '2023-10-05', '09:58:52', 3, 3, 0);
INSERT INTO `sub_budget` VALUES (3, ' หมึกดำ', 10000, '2023-10-05 10:00:10', '2023-10-05 10:00:10', 4, 4, '2023-10-05', '09:59:57', 3, 3, 0);

-- ----------------------------
-- Table structure for type_list
-- ----------------------------
DROP TABLE IF EXISTS `type_list`;
CREATE TABLE `type_list`  (
  `type_id` int NOT NULL,
  `type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type_operation` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`type_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type_list
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `key_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'user401149', '480841', '1105639');
INSERT INTO `users` VALUES (2, 'user405053', '260434', '1105639');
INSERT INTO `users` VALUES (3, 'user498181', '665402', '1527718');
INSERT INTO `users` VALUES (4, 'user430021', '814361', '1527718');
INSERT INTO `users` VALUES (5, 'user324349', '476314', '1527718');
INSERT INTO `users` VALUES (6, 'user563788', '121476', '1527718');
INSERT INTO `users` VALUES (7, 'user178313', '795268', '1527718');
INSERT INTO `users` VALUES (8, 'user963275', '965428', '1527718');
INSERT INTO `users` VALUES (9, 'user594955', '824528', '1527718');
INSERT INTO `users` VALUES (10, 'user302754', '472156', '1527718');
INSERT INTO `users` VALUES (11, 'user772473', '394863', '1527718');
INSERT INTO `users` VALUES (12, 'user338940', '953406', '1527718');

SET FOREIGN_KEY_CHECKS = 1;
