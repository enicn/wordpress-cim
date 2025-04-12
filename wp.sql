/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80027
 Source Host           : localhost:3306
 Source Schema         : wordpress

 Target Server Type    : MySQL
 Target Server Version : 80027
 File Encoding         : 65001

 Date: 13/04/2025 02:50:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for wp_term_relationships
-- ----------------------------
DROP TABLE IF EXISTS `wp_term_relationships`;
CREATE TABLE `wp_term_relationships`  (
  `object_id` bigint UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`object_id`, `term_taxonomy_id`) USING BTREE,
  INDEX `term_taxonomy_id`(`term_taxonomy_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of wp_term_relationships
-- ----------------------------
INSERT INTO `wp_term_relationships` VALUES (1, 1, 0);
INSERT INTO `wp_term_relationships` VALUES (61, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (11, 8, 0);
INSERT INTO `wp_term_relationships` VALUES (12, 9, 0);
INSERT INTO `wp_term_relationships` VALUES (15, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (59, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (60, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (48, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (53, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (50, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (54, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (58, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (57, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (56, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (62, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (63, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (64, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (65, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (66, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (67, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (68, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (69, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (70, 2, 0);
INSERT INTO `wp_term_relationships` VALUES (71, 2, 0);

-- ----------------------------
-- Table structure for wp_term_taxonomy
-- ----------------------------
DROP TABLE IF EXISTS `wp_term_taxonomy`;
CREATE TABLE `wp_term_taxonomy`  (
  `term_taxonomy_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` bigint UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_taxonomy_id`) USING BTREE,
  UNIQUE INDEX `term_id_taxonomy`(`term_id`, `taxonomy`) USING BTREE,
  INDEX `taxonomy`(`taxonomy`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wp_term_taxonomy
-- ----------------------------
INSERT INTO `wp_term_taxonomy` VALUES (1, 1, 'category', '', 0, 1);
INSERT INTO `wp_term_taxonomy` VALUES (2, 2, 'nav_menu', '', 0, 21);
INSERT INTO `wp_term_taxonomy` VALUES (11, 11, 'category', '', 20, 0);
INSERT INTO `wp_term_taxonomy` VALUES (12, 12, 'category', '', 19, 0);
INSERT INTO `wp_term_taxonomy` VALUES (13, 13, 'category', '', 19, 0);
INSERT INTO `wp_term_taxonomy` VALUES (8, 8, 'wp_theme', '', 0, 1);
INSERT INTO `wp_term_taxonomy` VALUES (9, 9, 'wp_theme', '', 0, 1);
INSERT INTO `wp_term_taxonomy` VALUES (10, 10, 'category', '', 20, 0);
INSERT INTO `wp_term_taxonomy` VALUES (14, 14, 'category', '', 19, 0);
INSERT INTO `wp_term_taxonomy` VALUES (15, 15, 'category', '', 19, 0);
INSERT INTO `wp_term_taxonomy` VALUES (16, 16, 'category', '', 19, 0);
INSERT INTO `wp_term_taxonomy` VALUES (17, 17, 'category', '', 19, 0);
INSERT INTO `wp_term_taxonomy` VALUES (18, 18, 'category', '', 19, 0);
INSERT INTO `wp_term_taxonomy` VALUES (19, 19, 'category', '', 0, 0);
INSERT INTO `wp_term_taxonomy` VALUES (20, 20, 'category', '', 0, 0);
INSERT INTO `wp_term_taxonomy` VALUES (21, 21, 'category', '', 0, 0);
INSERT INTO `wp_term_taxonomy` VALUES (22, 22, 'category', '', 21, 0);
INSERT INTO `wp_term_taxonomy` VALUES (23, 23, 'category', '', 21, 0);
INSERT INTO `wp_term_taxonomy` VALUES (24, 24, 'category', '', 21, 0);
INSERT INTO `wp_term_taxonomy` VALUES (25, 25, 'category', '', 21, 0);
INSERT INTO `wp_term_taxonomy` VALUES (26, 26, 'category', '', 21, 0);
INSERT INTO `wp_term_taxonomy` VALUES (27, 27, 'category', '', 21, 0);
INSERT INTO `wp_term_taxonomy` VALUES (28, 28, 'category', '', 0, 0);
INSERT INTO `wp_term_taxonomy` VALUES (29, 29, 'category', '', 0, 0);

-- ----------------------------
-- Table structure for wp_termmeta
-- ----------------------------
DROP TABLE IF EXISTS `wp_termmeta`;
CREATE TABLE `wp_termmeta`  (
  `meta_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` bigint UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL DEFAULT NULL,
  `meta_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NULL,
  PRIMARY KEY (`meta_id`) USING BTREE,
  INDEX `term_id`(`term_id`) USING BTREE,
  INDEX `meta_key`(`meta_key`(191)) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wp_termmeta
-- ----------------------------

-- ----------------------------
-- Table structure for wp_terms
-- ----------------------------
DROP TABLE IF EXISTS `wp_terms`;
CREATE TABLE `wp_terms`  (
  `term_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`) USING BTREE,
  INDEX `slug`(`slug`(191)) USING BTREE,
  INDEX `name`(`name`(191)) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_520_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wp_terms
-- ----------------------------
INSERT INTO `wp_terms` VALUES (1, '未分类', 'uncategorized', 0);
INSERT INTO `wp_terms` VALUES (2, 'Default', 'default', 0);
INSERT INTO `wp_terms` VALUES (11, 'SUCCESS STORIES', 'stories', 0);
INSERT INTO `wp_terms` VALUES (12, 'CWI', 'cwi', 0);
INSERT INTO `wp_terms` VALUES (8, 'twentytwentyfive', 'twentytwentyfive', 0);
INSERT INTO `wp_terms` VALUES (9, 'twentytwentyfour', 'twentytwentyfour', 0);
INSERT INTO `wp_terms` VALUES (10, 'NEWS', 'news', 0);
INSERT INTO `wp_terms` VALUES (13, 'WCO', 'wco', 0);
INSERT INTO `wp_terms` VALUES (14, 'CCO', 'cco', 0);
INSERT INTO `wp_terms` VALUES (15, 'TIC', 'tic', 0);
INSERT INTO `wp_terms` VALUES (16, 'CERAMIC', 'ceramic', 0);
INSERT INTO `wp_terms` VALUES (17, 'COATING', 'coating', 0);
INSERT INTO `wp_terms` VALUES (18, 'ADDITIVE MANUFACTURING', 'manufacturing', 0);
INSERT INTO `wp_terms` VALUES (19, 'TECHNOLOGIES', 'technologies', 0);
INSERT INTO `wp_terms` VALUES (20, 'ABOUT US', 'about-us', 0);
INSERT INTO `wp_terms` VALUES (21, 'PRODUCTS', 'product', 0);
INSERT INTO `wp_terms` VALUES (22, 'GET ATTACHMENT', 'get-attachment', 0);
INSERT INTO `wp_terms` VALUES (23, 'CRUSHER SYSTEM', 'crusher-system', 0);
INSERT INTO `wp_terms` VALUES (24, 'LINERS', 'liners', 0);
INSERT INTO `wp_terms` VALUES (25, 'WEAR SPOOLS', 'wear-spools', 0);
INSERT INTO `wp_terms` VALUES (26, 'SLURRY PUMPS / VALVES / WEAR RINGS', 'slurry-pumps-valves-wear-rings', 0);
INSERT INTO `wp_terms` VALUES (27, 'WEAR BLOCKS', 'wear-blocks', 0);
INSERT INTO `wp_terms` VALUES (28, 'CAREERS', 'careers', 0);
INSERT INTO `wp_terms` VALUES (29, 'CONTACT US', 'contact-us', 0);

SET FOREIGN_KEY_CHECKS = 1;
