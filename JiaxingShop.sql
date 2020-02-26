/*
 Navicat Premium Data Transfer

 Source Server         : 本机mysql
 Source Server Type    : MySQL
 Source Server Version : 80016
 Source Host           : localhost:3306
 Source Schema         : JiaxingShop

 Target Server Type    : MySQL
 Target Server Version : 80016
 File Encoding         : 65001

 Date: 26/02/2020 23:19:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jx_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `jx_admin_user`;
CREATE TABLE `jx_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表数据主键',
  `account` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '账号',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员昵称',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '密码',
  `status` tinyint(1) DEFAULT NULL COMMENT '账号状态，0禁用，1正常',
  `addtime` int(12) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员用户表';

-- ----------------------------
-- Records of jx_admin_user
-- ----------------------------
BEGIN;
INSERT INTO `jx_admin_user` VALUES (1, 'admin', '许铭聪', '21232f297a57a5a743894a0e4a801fc3', 1, 1581403417);
INSERT INTO `jx_admin_user` VALUES (2, 'admin1', '管理员2', '21232f297a57a5a743894a0e4a801fc3', 0, 1581403426);
INSERT INTO `jx_admin_user` VALUES (3, '3', '3', '202cb962ac59075b964b07152d234b70', 1, 1581403426);
INSERT INTO `jx_admin_user` VALUES (4, '3', '3', '3', 1, 1581403426);
COMMIT;

-- ----------------------------
-- Table structure for jx_brand
-- ----------------------------
DROP TABLE IF EXISTS `jx_brand`;
CREATE TABLE `jx_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '品牌名称',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '品牌图标Url',
  `addtime` int(12) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品品牌表';

-- ----------------------------
-- Records of jx_brand
-- ----------------------------
BEGIN;
INSERT INTO `jx_brand` VALUES (1, 'IPhone', 'images/brand/2020-02-16/5e48e6d04bdd4.jpg', 1581783787);
INSERT INTO `jx_brand` VALUES (2, 'Samsung', 'images/brand/2020-02-16/5e48f4eb36f32.jpg', 1581839835);
INSERT INTO `jx_brand` VALUES (4, '小米', 'images/brand/2020-02-17/5e4a3c2e95771.jpg', 1581923379);
COMMIT;

-- ----------------------------
-- Table structure for jx_category
-- ----------------------------
DROP TABLE IF EXISTS `jx_category`;
CREATE TABLE `jx_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品分类ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '分类名称',
  `introduction` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '分类简介',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '分类图标Url',
  `addtime` int(12) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品分类表';

-- ----------------------------
-- Records of jx_category
-- ----------------------------
BEGIN;
INSERT INTO `jx_category` VALUES (1, '全面屏手机', '全面屏是手机业界对于超高屏占比手机设计的一个比较宽泛的定义。从字面上解释就是手机的正面全部都是屏幕，手机的四个边框位置都是采用无边框设计，追求接近100%的屏占比。', 'images/category/2020-02-16/5e492d60951b8.jpeg', 1581853834);
COMMIT;

-- ----------------------------
-- Table structure for jx_order
-- ----------------------------
DROP TABLE IF EXISTS `jx_order`;
CREATE TABLE `jx_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `order_sn` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '订单编号',
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `product_num` int(11) DEFAULT NULL COMMENT '商品数量',
  `status` tinyint(1) DEFAULT NULL COMMENT '订单状态，1支付成功，2已发货，3已取消',
  `addtime` int(12) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='订单表';

-- ----------------------------
-- Records of jx_order
-- ----------------------------
BEGIN;
INSERT INTO `jx_order` VALUES (1, '20200226111603179084', 1, 8888.00, 1, 1, 1582686963);
INSERT INTO `jx_order` VALUES (2, '20200226112049549734', 1, 15554.00, 2, 3, 1582687249);
COMMIT;

-- ----------------------------
-- Table structure for jx_order_product
-- ----------------------------
DROP TABLE IF EXISTS `jx_order_product`;
CREATE TABLE `jx_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '中间表数据id',
  `order_sn` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '订单号',
  `pid` int(11) DEFAULT NULL COMMENT '商品ID',
  `price` decimal(10,2) DEFAULT NULL COMMENT '商品单价',
  `num` int(11) DEFAULT NULL COMMENT '商品数量',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='订单与商品中间表';

-- ----------------------------
-- Records of jx_order_product
-- ----------------------------
BEGIN;
INSERT INTO `jx_order_product` VALUES (1, '20200226111603179084', 2, 8888.00, 1);
INSERT INTO `jx_order_product` VALUES (2, '20200226112049549734', 1, 6666.00, 1);
INSERT INTO `jx_order_product` VALUES (3, '20200226112049549734', 2, 8888.00, 1);
COMMIT;

-- ----------------------------
-- Table structure for jx_product
-- ----------------------------
DROP TABLE IF EXISTS `jx_product`;
CREATE TABLE `jx_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `cid` int(11) DEFAULT NULL COMMENT '分类ID',
  `brand_id` int(11) DEFAULT NULL COMMENT '品牌ID',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商品名称',
  `intro` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '广告语',
  `price` decimal(10,2) DEFAULT NULL COMMENT '商品单价',
  `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商品列表图片Url',
  `photo_list` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '商品详情图片组，按英文逗号分隔',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '商品详情',
  `stock` int(11) DEFAULT NULL COMMENT '商品库存量',
  `sales` int(11) DEFAULT '0' COMMENT '销量',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态，0下架，1上架',
  `is_hot` tinyint(1) DEFAULT NULL COMMENT '是否热卖，0否，1是',
  `updatetime` int(12) DEFAULT NULL COMMENT '修改时间',
  `addtime` int(12) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品表';

-- ----------------------------
-- Records of jx_product
-- ----------------------------
BEGIN;
INSERT INTO `jx_product` VALUES (1, 1, 1, 'Iphonexxxxx', '这是广告语', 6666.00, 'images/cover/2020-02-17/5e4a49ec66672.jpg', 'images/cover/2020-02-17/5e4aa6b2c9330.jpg,images/cover/2020-02-17/5e4aa6b2c9775.jpg', '这是商品详情', 1000, 34, 1, 1, 1581950645, 1581926923);
INSERT INTO `jx_product` VALUES (2, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (3, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (4, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (5, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (6, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (7, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (8, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (9, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (10, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
INSERT INTO `jx_product` VALUES (11, 1, 1, 'iPhone XS', '这是广告语', 8888.00, 'images/cover/2020-02-17/5e4aa697efca4.jpeg', 'images/cover/2020-02-17/5e4a4a7138aed.jpg', '这是商品详情', 2000, 29, 1, 1, 1581950617, 1581927029);
COMMIT;

-- ----------------------------
-- Table structure for jx_shopping_car
-- ----------------------------
DROP TABLE IF EXISTS `jx_shopping_car`;
CREATE TABLE `jx_shopping_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '购物车数据id',
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `pid` int(11) DEFAULT NULL COMMENT '商品ID',
  `price` decimal(10,2) DEFAULT NULL COMMENT '商品单价',
  `num` int(11) DEFAULT '1' COMMENT '商品数量',
  `addtime` int(12) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='购物车表';

-- ----------------------------
-- Records of jx_shopping_car
-- ----------------------------
BEGIN;
INSERT INTO `jx_shopping_car` VALUES (18, 2, 2, 8888.00, 1, 1582730089);
COMMIT;

-- ----------------------------
-- Table structure for jx_user
-- ----------------------------
DROP TABLE IF EXISTS `jx_user`;
CREATE TABLE `jx_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户唯一ID',
  `account` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户账号',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户昵称',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户密码',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户头像Url',
  `tel` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '电话',
  `sex` tinyint(1) DEFAULT '1' COMMENT '性别，1男，2女',
  `balance` decimal(11,2) DEFAULT '0.00' COMMENT '用户余额',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态，0禁用，1正常',
  `addtime` int(12) DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of jx_user
-- ----------------------------
BEGIN;
INSERT INTO `jx_user` VALUES (1, 'test', '测试用户11', '202cb962ac59075b964b07152d234b70', 'images/avatar/2020-02-23/5e527eb74b44c.jpg', '13511111111', 1, 14453.50, 1, 1582464695);
INSERT INTO `jx_user` VALUES (2, 'ceshi', 'ceshi', '202cb962ac59075b964b07152d234b70', 'images/avatar/2020-02-26/5e566f3cca065.jpg', '13511111111', 1, 0.00, 1, 1582722876);
COMMIT;

-- ----------------------------
-- Table structure for jx_user_address
-- ----------------------------
DROP TABLE IF EXISTS `jx_user_address`;
CREATE TABLE `jx_user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户收货地址ID',
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `receiver` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '收货人',
  `tel` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '收货人电话',
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '地址详情',
  `postcode` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '邮编',
  `addtime` int(12) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户收货地址表';

-- ----------------------------
-- Records of jx_user_address
-- ----------------------------
BEGIN;
INSERT INTO `jx_user_address` VALUES (2, 1, '小明', '13511111111', '上海浦东区', '241131', 1582640667);
COMMIT;

-- ----------------------------
-- Table structure for jx_user_return
-- ----------------------------
DROP TABLE IF EXISTS `jx_user_return`;
CREATE TABLE `jx_user_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '退货记录ID',
  `order_sn` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '退货订单号',
  `reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '退货原因',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态，0待处理，1已退款',
  `addtime` int(12) DEFAULT NULL COMMENT '退货申请时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户退货记录表';

SET FOREIGN_KEY_CHECKS = 1;
