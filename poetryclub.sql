/*
 Navicat Premium Data Transfer

 Source Server         : boolmall
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : poetryclub

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 01/30/2017 20:57:53 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `cat`
-- ----------------------------
DROP TABLE IF EXISTS `cat`;
CREATE TABLE `cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `cat_name` varchar(255) NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
--  Records of `cat`
-- ----------------------------
BEGIN;
INSERT INTO `cat` VALUES ('1', '先秦'), ('7', '两汉'), ('13', '魏晋'), ('19', '南北朝'), ('25', '隋代'), ('33', '唐代'), ('39', '五代'), ('45', '宋代'), ('53', '金朝'), ('59', '元代'), ('65', '明代'), ('73', '清代');
COMMIT;

-- ----------------------------
--  Table structure for `collect`
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `poem_id` int(11) NOT NULL COMMENT '诗文ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '收藏状态：0-未收藏 10-已收藏',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`poem_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='诗文收藏表';

-- ----------------------------
--  Records of `collect`
-- ----------------------------
BEGIN;
INSERT INTO `collect` VALUES ('21', '12', '12', '0', '1483363990', '1483756283'), ('22', '12', '4', '0', '1483364003', '1483432964'), ('23', '12', '11', '0', '1483364008', '1483435939'), ('24', '12', '3', '0', '1483364314', '1484716860'), ('25', '12', '7', '0', '1483364324', '1483435930'), ('26', '12', '10', '0', '1483364329', '1483859772'), ('27', '12', '9', '0', '1483427655', '1483531675'), ('28', '12', '6', '0', '1483427661', '1483435965'), ('29', '12', '8', '10', '1483428231', '1483435951'), ('30', '12', '5', '0', '1483433209', '1483435303'), ('31', '1', '12', '10', '1483438103', '1483438103'), ('32', '1', '10', '10', '1483438108', '1483438108'), ('33', '12', '2', '10', '1483531704', '1483531704');
COMMIT;

-- ----------------------------
--  Table structure for `feed`
-- ----------------------------
DROP TABLE IF EXISTS `feed`;
CREATE TABLE `feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `poem_id` int(11) DEFAULT NULL COMMENT '文章ID',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `parise_num` int(11) DEFAULT NULL COMMENT '赞的数量',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='聊天信息表';

-- ----------------------------
--  Records of `feed`
-- ----------------------------
BEGIN;
INSERT INTO `feed` VALUES ('1', '1', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '2', '1482228677'), ('2', '12', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '2', '1482228677'), ('3', '1', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '3', '1482228677'), ('4', '12', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '4', '1482228677'), ('5', '1', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '5', '1482228677'), ('6', '1', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '1', '1482228677'), ('10', '12', '11', '啊啊阿嘎哇啊', null, '1482737663'), ('11', '12', '12', 'a ', null, '1482751166'), ('12', '12', '10', 'ds\n', null, '1483756257'), ('13', '12', '12', '阿发', null, '1484623565'), ('14', '12', '12', '是的撒', null, '1484623568');
COMMIT;

-- ----------------------------
--  Table structure for `feedpraise`
-- ----------------------------
DROP TABLE IF EXISTS `feedpraise`;
CREATE TABLE `feedpraise` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `feed_id` int(11) NOT NULL COMMENT '诗文评论ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '赞的状态：0-未赞 10-已赞',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`feed_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='诗文用户评论赞表';

-- ----------------------------
--  Table structure for `poem`
-- ----------------------------
DROP TABLE IF EXISTS `poem`;
CREATE TABLE `poem` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `summary` varchar(255) NOT NULL COMMENT '摘要',
  `content` text NOT NULL COMMENT '内容',
  `label_img` varchar(255) DEFAULT NULL COMMENT '标签图',
  `cat_id` int(11) NOT NULL COMMENT '分类ID',
  `author_name` varchar(255) NOT NULL COMMENT '作者',
  `author_id` int(11) NOT NULL COMMENT '作者ID',
  `is_valid` tinyint(1) NOT NULL DEFAULT '10' COMMENT '是否有效：0-未发布 10-已发布',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idx_cat_valid` (`cat_id`,`is_valid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='文章主表';

-- ----------------------------
--  Records of `poem`
-- ----------------------------
BEGIN;
INSERT INTO `poem` VALUES ('1', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('2', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('3', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('4', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('5', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('6', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('7', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('8', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('9', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('10', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('11', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677'), ('12', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '吴文英', '1', '10', '1482228677', '1482228677');
COMMIT;

-- ----------------------------
--  Table structure for `poem_extend`
-- ----------------------------
DROP TABLE IF EXISTS `poem_extend`;
CREATE TABLE `poem_extend` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `poem_id` int(11) NOT NULL COMMENT '文章ID',
  `page_view` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `uesr_view` int(11) NOT NULL DEFAULT '0' COMMENT '访问量',
  `collect` int(11) NOT NULL DEFAULT '0' COMMENT '收藏量',
  `praise` int(11) NOT NULL DEFAULT '0' COMMENT '点赞',
  `comment` int(11) NOT NULL DEFAULT '0' COMMENT '评论量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='文章扩展表';

-- ----------------------------
--  Records of `poem_extend`
-- ----------------------------
BEGIN;
INSERT INTO `poem_extend` VALUES ('59', '12', '27', '0', '2', '0', '2'), ('60', '3', '8', '0', '0', '0', '0'), ('61', '11', '14', '0', '0', '0', '0'), ('62', '10', '24', '0', '1', '1', '1'), ('63', '4', '4', '0', '0', '0', '0'), ('64', '7', '3', '0', '0', '0', '0'), ('65', '9', '9', '0', '0', '0', '0'), ('66', '6', '2', '0', '0', '0', '0'), ('67', '8', '11', '0', '1', '0', '0'), ('68', '5', '2', '0', '0', '0', '0'), ('69', '2', '1', '0', '1', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `poempraise`
-- ----------------------------
DROP TABLE IF EXISTS `poempraise`;
CREATE TABLE `poempraise` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `poem_id` int(11) NOT NULL COMMENT '诗文ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '赞的状态：0-未赞 10-已赞',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`poem_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='诗文赞表';

-- ----------------------------
--  Records of `poempraise`
-- ----------------------------
BEGIN;
INSERT INTO `poempraise` VALUES ('3', '12', '12', '10', '1482746277', '1483756237'), ('4', '12', '11', '10', '1482750663', '1482750663'), ('5', '12', '8', '10', '1482755966', '1482755966'), ('6', '12', '4', '10', '1482903699', '1482903699'), ('7', '12', '10', '10', '1483756242', '1483859771');
COMMIT;

-- ----------------------------
--  Table structure for `relation_poem_status`
-- ----------------------------
DROP TABLE IF EXISTS `relation_poem_status`;
CREATE TABLE `relation_poem_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `poem_id` int(11) NOT NULL COMMENT '原创诗文ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `poem_id` (`poem_id`,`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `relation_poem_status`
-- ----------------------------
BEGIN;
INSERT INTO `relation_poem_status` VALUES ('24', '2', '12'), ('15', '3', '12'), ('17', '4', '12'), ('18', '5', '12'), ('21', '6', '12'), ('20', '7', '12'), ('13', '8', '12'), ('16', '9', '12'), ('23', '10', '1'), ('19', '10', '12'), ('14', '11', '12'), ('22', '12', '1'), ('12', '12', '12');
COMMIT;

-- ----------------------------
--  Table structure for `relation_poem_tag`
-- ----------------------------
DROP TABLE IF EXISTS `relation_poem_tag`;
CREATE TABLE `relation_poem_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `poem_id` int(11) NOT NULL COMMENT '文章ID',
  `tag_id` int(11) NOT NULL COMMENT '标签ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `poem_id` (`poem_id`,`tag_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='文章和标签关联表';

-- ----------------------------
--  Records of `relation_poem_tag`
-- ----------------------------
BEGIN;
INSERT INTO `relation_poem_tag` VALUES ('1', '1', '1'), ('2', '5', '7'), ('3', '5', '13'), ('4', '5', '19'), ('5', '9', '25'), ('6', '9', '33'), ('7', '9', '39'), ('8', '9', '45'), ('9', '11', '53'), ('10', '12', '59'), ('11', '12', '65'), ('12', '12', '73');
COMMIT;

-- ----------------------------
--  Table structure for `relation_upoem_status`
-- ----------------------------
DROP TABLE IF EXISTS `relation_upoem_status`;
CREATE TABLE `relation_upoem_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `upoem_id` int(11) NOT NULL COMMENT '原创诗文ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `upoem_id` (`upoem_id`,`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `relation_upoem_status`
-- ----------------------------
BEGIN;
INSERT INTO `relation_upoem_status` VALUES ('13', '3', '12'), ('14', '4', '12'), ('16', '5', '12'), ('17', '6', '12'), ('15', '7', '12'), ('12', '8', '12'), ('11', '9', '12'), ('19', '10', '1'), ('10', '10', '12'), ('9', '11', '12'), ('18', '12', '1'), ('8', '12', '12');
COMMIT;

-- ----------------------------
--  Table structure for `relation_upoem_tag`
-- ----------------------------
DROP TABLE IF EXISTS `relation_upoem_tag`;
CREATE TABLE `relation_upoem_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `upoem_id` int(11) NOT NULL COMMENT '原创诗文ID',
  `tag_id` int(11) NOT NULL COMMENT '标签ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `upoem_id` (`upoem_id`,`tag_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `relation_upoem_tag`
-- ----------------------------
BEGIN;
INSERT INTO `relation_upoem_tag` VALUES ('1', '1', '1'), ('2', '5', '7'), ('3', '5', '13'), ('4', '5', '19'), ('5', '9', '25'), ('6', '9', '33'), ('7', '9', '39'), ('8', '9', '45'), ('9', '11', '53'), ('10', '12', '59'), ('11', '12', '65'), ('12', '12', '73');
COMMIT;

-- ----------------------------
--  Table structure for `tag`
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tag_name` varchar(255) NOT NULL COMMENT '标签名字',
  `poem_num` int(11) DEFAULT NULL COMMENT '关联文章数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`tag_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
--  Records of `tag`
-- ----------------------------
BEGIN;
INSERT INTO `tag` VALUES ('1', '先秦', null), ('7', '两汉', null), ('13', '魏晋', null), ('19', '南北朝', null), ('25', '隋代', null), ('33', '唐代', null), ('39', '五代', null), ('45', '宋代', null), ('53', '金朝', null), ('59', '元代', null), ('65', '明代', null), ('73', '清代', null);
COMMIT;

-- ----------------------------
--  Table structure for `ucenter`
-- ----------------------------
DROP TABLE IF EXISTS `ucenter`;
CREATE TABLE `ucenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `alias` varchar(255) DEFAULT NULL COMMENT '昵称',
  `gender` tinyint(1) DEFAULT '0' COMMENT '性别 0未填 1男 2 女',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `signature` varchar(255) DEFAULT NULL COMMENT '个性签名',
  `city` varchar(255) DEFAULT NULL COMMENT '城市',
  `position` varchar(255) DEFAULT NULL COMMENT '职位',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户中心表';

-- ----------------------------
--  Records of `ucenter`
-- ----------------------------
BEGIN;
INSERT INTO `ucenter` VALUES ('6', '12', '陈龙飞', '1', '1996-07-21', 'asdasd', 'dasdsad', 'asdsa', '1482737681', '1482737681'), ('7', '1', 'sadsa', '0', '1996-07-21', 'sadas', 'sadas', 'asdas', '1482833300', '1482833300');
COMMIT;

-- ----------------------------
--  Table structure for `ucollect`
-- ----------------------------
DROP TABLE IF EXISTS `ucollect`;
CREATE TABLE `ucollect` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `upoem_id` int(11) NOT NULL COMMENT '原创诗文ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '收藏状态：0-未收藏 10-已收藏',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='原创诗文收藏表';

-- ----------------------------
--  Records of `ucollect`
-- ----------------------------
BEGIN;
INSERT INTO `ucollect` VALUES ('14', '12', '12', '0', '1483367052', '1484314181'), ('15', '12', '10', '10', '1483436160', '1483436160'), ('16', '12', '6', '10', '1483436165', '1483436165'), ('17', '12', '5', '0', '1483436169', '1483436178'), ('18', '12', '3', '0', '1483436190', '1483436767'), ('19', '12', '4', '10', '1483436194', '1484644780'), ('20', '12', '7', '10', '1483436199', '1483531725'), ('21', '1', '12', '10', '1483438095', '1483438095'), ('22', '1', '10', '10', '1483438099', '1483438099'), ('23', '12', '11', '10', '1483531680', '1483531680');
COMMIT;

-- ----------------------------
--  Table structure for `ufeed`
-- ----------------------------
DROP TABLE IF EXISTS `ufeed`;
CREATE TABLE `ufeed` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `upoem_id` int(11) NOT NULL COMMENT '原创诗文ID',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `praise_num` int(11) DEFAULT NULL COMMENT '赞的数量',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='原创诗文聊天信息表';

-- ----------------------------
--  Records of `ufeed`
-- ----------------------------
BEGIN;
INSERT INTO `ufeed` VALUES ('1', '1', '11', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '2', '1482228677'), ('2', '12', '11', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '2', '1482228677'), ('3', '1', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '3', '1482228677'), ('4', '12', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '4', '1482228677'), ('5', '1', '10', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '5', '1482228677'), ('6', '1', '11', '七月流火，九月授衣。一之日觱发，二之日栗烈。无衣无褐，何以卒岁。三之日于耜，四之日举趾。同我妇子，馌彼南亩，田畯至喜。七月流火，九月授衣。', '1', '1482228677'), ('10', '12', '12', 'aaaaa', null, '1482750613'), ('11', '12', '11', '你很撒啊啊', null, '1482757301'), ('12', '12', '12', 'aaa', null, '1482758972'), ('13', '12', '11', '大飞哥帅 哦！', null, '1482916694'), ('14', '12', '12', '123123', null, '1484314188'), ('15', '12', '12', '21312', null, '1484314191'), ('16', '12', '12', '12312', null, '1484314194'), ('17', '12', '12', 'asfas', null, '1484984917');
COMMIT;

-- ----------------------------
--  Table structure for `ufeedpraise`
-- ----------------------------
DROP TABLE IF EXISTS `ufeedpraise`;
CREATE TABLE `ufeedpraise` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `ufeed_id` int(11) NOT NULL COMMENT '原创诗文评论ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '赞的状态：0-未赞 10-已赞',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='原创诗文用户评论赞表';

-- ----------------------------
--  Table structure for `upoem`
-- ----------------------------
DROP TABLE IF EXISTS `upoem`;
CREATE TABLE `upoem` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `summary` varchar(255) NOT NULL COMMENT '摘要',
  `content` text NOT NULL COMMENT '内容',
  `label_img` varchar(255) DEFAULT NULL COMMENT '标签图',
  `cat_id` int(11) NOT NULL COMMENT '分类ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `user_name` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `is_valid` tinyint(1) NOT NULL DEFAULT '10' COMMENT '是否有效：0-未发布 10-已发布',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idx_cat_valid` (`cat_id`,`is_valid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='原创诗文表';

-- ----------------------------
--  Records of `upoem`
-- ----------------------------
BEGIN;
INSERT INTO `upoem` VALUES ('1', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '1', 'DragonFly', '10', '1482228677', '1482228677'), ('2', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '12', '陈龙飞', '10', '1482228677', '1482228677'), ('3', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '1', 'DragonFly', '10', '1482228677', '1482228677'), ('4', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '12', '陈龙飞', '10', '1482228677', '1482228677'), ('5', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '1', 'DragonFly', '10', '1482228677', '1482228677'), ('6', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '12', '陈龙飞', '10', '1482228677', '1482228677'), ('7', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '1', 'DragonFly', '10', '1482228677', '1482228677'), ('8', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '12', '陈龙飞', '10', '1482228677', '1482228677'), ('9', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '1', 'DragonFly', '10', '1482228677', '1482228677'), ('10', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '12', '陈龙飞', '10', '1482228677', '1482228677'), ('11', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '1', 'DragonFly', '10', '1482228677', '1482228677'), ('12', '风入松·听风听雨过清明', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。', '听风听雨过清明。愁草瘗花铭。楼前绿暗分携路，一丝柳、一寸柔情。料峭春寒中酒，交加晓梦啼莺。 \n<br />西园日日扫林亭。依旧赏新晴。黄蜂频扑秋千索，有当时、纤手香凝。惆怅双鸳不到，幽阶一夜苔生。', null, '1', '12', '陈龙飞', '10', '1482228677', '1482228677');
COMMIT;

-- ----------------------------
--  Table structure for `upoem_extend`
-- ----------------------------
DROP TABLE IF EXISTS `upoem_extend`;
CREATE TABLE `upoem_extend` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `upoem_id` int(11) NOT NULL COMMENT '原创诗文ID',
  `page_view` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `user_view` int(11) NOT NULL DEFAULT '0' COMMENT '访问量',
  `collect` int(11) NOT NULL DEFAULT '0' COMMENT '收藏量',
  `praise` int(11) NOT NULL DEFAULT '0' COMMENT '赞',
  `comment` int(11) NOT NULL DEFAULT '0' COMMENT '评论量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COMMENT='原创诗文扩展表';

-- ----------------------------
--  Records of `upoem_extend`
-- ----------------------------
BEGIN;
INSERT INTO `upoem_extend` VALUES ('55', '12', '23', '0', '1', '0', '4'), ('56', '10', '3', '0', '2', '0', '0'), ('57', '6', '1', '0', '1', '0', '0'), ('58', '5', '1', '0', '0', '0', '0'), ('59', '3', '1', '0', '0', '0', '0'), ('60', '4', '11', '0', '1', '1', '0'), ('61', '7', '2', '0', '1', '0', '0'), ('62', '11', '1', '0', '1', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `upoempraise`
-- ----------------------------
DROP TABLE IF EXISTS `upoempraise`;
CREATE TABLE `upoempraise` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `upoem_id` int(11) NOT NULL COMMENT '原创诗文ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '赞的状态：0-未赞 10-已赞',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='原创诗文赞表';

-- ----------------------------
--  Records of `upoempraise`
-- ----------------------------
BEGIN;
INSERT INTO `upoempraise` VALUES ('3', '12', '5', '10', '1482743680', '1482743680'), ('4', '12', '12', '10', '1482746357', '1484314180'), ('5', '12', '11', '10', '1482749061', '1482749061'), ('6', '12', '4', '10', '1484644772', '1484644773');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email_validate_token` varchar(255) DEFAULT NULL COMMENT '邮箱验证token',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `phone` char(11) DEFAULT NULL COMMENT '手机号',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `vip_lv` int(11) NOT NULL DEFAULT '1' COMMENT 'vip等级',
  `login_time` int(11) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'DragonFly', 'tc-2vRqJYtNS9DyAh-UDadHyyGfN2TBD', '$2y$13$4iPGtHd7wWDBzTZ6m2VMCOXjpRqTW4KcFKpUQk/EgEfJ.7iFb9KLG', null, null, '1043531795@qq.com', '17774004877', '10', '10', null, '1', '1483438092', '1482831827', '1482228677', '1483438092'), ('12', '陈龙飞', 'tc-2vRqJYtNS9DyAh-UDadHyyGfN2TBD', '$2y$13$4iPGtHd7wWDBzTZ6m2VMCOXjpRqTW4KcFKpUQk/EgEfJ.7iFb9KLG', null, null, '1043531795@qq.com', '17774004877', '10', '10', null, '1', '1484716891', '1484623535', '1482228677', '1484716891');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
