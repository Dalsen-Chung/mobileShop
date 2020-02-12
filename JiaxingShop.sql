/*
 Navicat Premium Data Transfer

 Source Server         : 本机
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : jiaxingshop

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 12/02/2020 17:33:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jx_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `jx_admin_user`;
CREATE TABLE `jx_admin_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表数据主键',
  `account` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '账号',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '管理员昵称',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `right_id` tinyint(1) NULL DEFAULT NULL COMMENT '权限资源ID',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '账号状态，0禁用，1正常',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '管理员用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jx_admin_user
-- ----------------------------
INSERT INTO `jx_admin_user` VALUES (1, 'admin', '许铭聪', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1581403417);
INSERT INTO `jx_admin_user` VALUES (2, 'admin1', '管理员222', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 1581403426);
INSERT INTO `jx_admin_user` VALUES (3, '3', '3', '3', 3, 1, 1581403426);
INSERT INTO `jx_admin_user` VALUES (4, '3', '3', '3', 3, 1, 1581403426);

-- ----------------------------
-- Table structure for jx_brand
-- ----------------------------
DROP TABLE IF EXISTS `jx_brand`;
CREATE TABLE `jx_brand`  (
  `id` int(11) NOT NULL COMMENT '品牌ID',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '品牌名称',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '品牌图标Url',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jx_category
-- ----------------------------
DROP TABLE IF EXISTS `jx_category`;
CREATE TABLE `jx_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品分类ID',
  `fid` int(11) NULL DEFAULT NULL COMMENT '父级分类ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称',
  `introduction` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类简介',
  `icon_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类图标Url',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jx_order
-- ----------------------------
DROP TABLE IF EXISTS `jx_order`;
CREATE TABLE `jx_order`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `order_sn` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '订单编号',
  `uid` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '价格',
  `product_num` int(11) NULL DEFAULT NULL COMMENT '商品数量',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '订单状态，0待支付，1支付成功，2已发货，3已退货，4已取消',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jx_product
-- ----------------------------
DROP TABLE IF EXISTS `jx_product`;
CREATE TABLE `jx_product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `cid` int(11) NULL DEFAULT NULL COMMENT '分类ID',
  `brand_id` int(11) NULL DEFAULT NULL COMMENT '品牌ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品名称',
  `intro` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '广告语',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '商品单价',
  `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品列表图片Url',
  `photo_list` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '商品详情图片组，按英文逗号分隔',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '商品详情',
  `stock` int(11) NULL DEFAULT NULL COMMENT '商品库存量',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态，0下架，1上架',
  `is_hot` tinyint(1) NULL DEFAULT NULL COMMENT '是否热卖，0否，1是',
  `updatetime` int(12) NULL DEFAULT NULL COMMENT '修改时间',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jx_product_spec
-- ----------------------------
DROP TABLE IF EXISTS `jx_product_spec`;
CREATE TABLE `jx_product_spec`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品规格ID',
  `pid` int(11) NULL DEFAULT NULL COMMENT '商品ID',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品规格描述',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品规格表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jx_shopping_car
-- ----------------------------
DROP TABLE IF EXISTS `jx_shopping_car`;
CREATE TABLE `jx_shopping_car`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '购物车数据id',
  `uid` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `pid` int(11) NULL DEFAULT NULL COMMENT '商品ID',
  `spec_id` int(11) NULL DEFAULT NULL COMMENT '商品规格ID',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '商品单价',
  `num` int(11) NULL DEFAULT NULL COMMENT '商品数量',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '购物车表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jx_user
-- ----------------------------
DROP TABLE IF EXISTS `jx_user`;
CREATE TABLE `jx_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户唯一ID',
  `account` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户账号',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户昵称',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户密码',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户头像Url',
  `tel` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `sex` tinyint(1) NULL DEFAULT 1 COMMENT '性别，1男，2女',
  `balance` int(11) NULL DEFAULT NULL COMMENT '用户余额',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '状态，0禁用，1正常',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jx_user_address
-- ----------------------------
DROP TABLE IF EXISTS `jx_user_address`;
CREATE TABLE `jx_user_address`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户收货地址ID',
  `uid` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `receiver` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收货人',
  `tel` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收货人电话',
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '地址详情',
  `postcode` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮编',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户收货地址表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jx_user_return
-- ----------------------------
DROP TABLE IF EXISTS `jx_user_return`;
CREATE TABLE `jx_user_return`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '退货记录ID',
  `order_sn` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '退货订单号',
  `reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '退货原因',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '状态，0待处理，1已退款',
  `addtime` int(12) NULL DEFAULT NULL COMMENT '退货申请时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户退货记录表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
