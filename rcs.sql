/*
Navicat MySQL Data Transfer

Source Server         : 本地mysql
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : rcs

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-06-27 17:32:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rcs_ad
-- ----------------------------
DROP TABLE IF EXISTS `rcs_ad`;
CREATE TABLE `rcs_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `img_url` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `jump_url` varchar(255) DEFAULT NULL COMMENT '跳转地址',
  `type` tinyint(255) DEFAULT '1' COMMENT '类型 1为首页banner图  2为友情链接',
  `status` tinyint(255) DEFAULT '1' COMMENT '状态  1为显示  2为隐藏',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='广告友链表';

-- ----------------------------
-- Records of rcs_ad
-- ----------------------------
INSERT INTO `rcs_ad` VALUES ('1', 'banner1', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide1.jpg', null, '1', '1', null, null, null);
INSERT INTO `rcs_ad` VALUES ('2', 'banner2', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide2.jpg', null, '1', '1', null, null, null);
INSERT INTO `rcs_ad` VALUES ('3', 'banner3', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide3.jpg', null, '1', '1', null, null, null);
INSERT INTO `rcs_ad` VALUES ('4', 'banner4', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide4.jpg', null, '1', '1', null, null, null);
INSERT INTO `rcs_ad` VALUES ('5', '百度', '', 'https://www.baidu.com', '2', '1', null, null, null);
INSERT INTO `rcs_ad` VALUES ('6', '腾讯', null, 'http://qq.com', '2', '1', null, null, null);

-- ----------------------------
-- Table structure for rcs_admin
-- ----------------------------
DROP TABLE IF EXISTS `rcs_admin`;
CREATE TABLE `rcs_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级ID 默认为0',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `secret` varchar(255) NOT NULL COMMENT '密钥',
  `type` tinyint(255) NOT NULL DEFAULT '1' COMMENT '用户类型 (默认 为1)   1为受约束角色 0为超级管理员',
  `status` tinyint(255) NOT NULL DEFAULT '1' COMMENT '状态 0为禁用  1为启用',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- ----------------------------
-- Records of rcs_admin
-- ----------------------------

-- ----------------------------
-- Table structure for rcs_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `rcs_admin_menu`;
CREATE TABLE `rcs_admin_menu` (
  `admin_id` int(11) NOT NULL COMMENT '后台用户ID',
  `menu_id` int(11) NOT NULL COMMENT '菜单ID',
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户权限表';

-- ----------------------------
-- Records of rcs_admin_menu
-- ----------------------------

-- ----------------------------
-- Table structure for rcs_comment
-- ----------------------------
DROP TABLE IF EXISTS `rcs_comment`;
CREATE TABLE `rcs_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL COMMENT '文章ID',
  `comment_man` varchar(100) DEFAULT NULL COMMENT '评论人',
  `comment_time` int(11) DEFAULT NULL COMMENT '评论时间',
  `content` text COMMENT '评论内容',
  `is_top` bit(1) DEFAULT b'0' COMMENT '是否置顶   0为否 1为是',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='资源文章评论记录表';

-- ----------------------------
-- Records of rcs_comment
-- ----------------------------
INSERT INTO `rcs_comment` VALUES ('1', '3', 'adminas', null, '231241', '\0', null, null, null);
INSERT INTO `rcs_comment` VALUES ('2', '3', 'adminas', null, '231241', '\0', null, null, null);
INSERT INTO `rcs_comment` VALUES ('3', '3', 'adminas', null, '231241', '\0', null, null, null);

-- ----------------------------
-- Table structure for rcs_config
-- ----------------------------
DROP TABLE IF EXISTS `rcs_config`;
CREATE TABLE `rcs_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `webname` varchar(255) NOT NULL DEFAULT '' COMMENT '网站名称',
  `webnum` varchar(255) DEFAULT NULL COMMENT '网站备案号',
  `seokey` varchar(255) DEFAULT NULL COMMENT 'SEO关键字',
  `wx_code` varchar(255) DEFAULT NULL COMMENT '微信二维码',
  `qq_num` int(20) DEFAULT NULL COMMENT 'QQ',
  `e_mail` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `announcement` text COMMENT '公告',
  `content` text COMMENT '关于我们',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='网站配置表';

-- ----------------------------
-- Records of rcs_config
-- ----------------------------
INSERT INTO `rcs_config` VALUES ('1', '', null, null, 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQGh8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyM2daSHN1LTlmZDMxMDAwMDAwN18AAgQB2_VZAwQAAAAA', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for rcs_content
-- ----------------------------
DROP TABLE IF EXISTS `rcs_content`;
CREATE TABLE `rcs_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_img` varchar(255) DEFAULT NULL COMMENT '封面图',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `label` varchar(255) NOT NULL COMMENT '标签（关键字）',
  `release_man` varchar(100) NOT NULL COMMENT '发布人',
  `release_time` date NOT NULL COMMENT '发布时间',
  `resources_id` int(11) DEFAULT NULL COMMENT '下载资源ID',
  `click_num` int(11) NOT NULL DEFAULT '0' COMMENT '点击量(阅读量)',
  `is_top` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否置顶 0为否  1为是',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='资源文章内容表';

-- ----------------------------
-- Records of rcs_content
-- ----------------------------
INSERT INTO `rcs_content` VALUES ('1', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide2.jpg', '文章测试', '个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。', '网站 资源', 'admin', '2018-06-23', '0', '0', '\0', null, null, null);
INSERT INTO `rcs_content` VALUES ('2', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide2.jpg', '文章测试3', '个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。', '网站 资源 文章', 'admin', '2018-06-23', '0', '100', '', null, null, null);
INSERT INTO `rcs_content` VALUES ('3', null, '文章测试2', '个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。', '文章', 'admin', '2018-06-23', '0', '1002', '\0', null, null, null);
INSERT INTO `rcs_content` VALUES ('4', null, '文章测试4', '个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。', '文章22', 'admin', '2018-06-24', '0', '1002', '\0', null, null, null);
INSERT INTO `rcs_content` VALUES ('5', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide2.jpg', '文章测试5', '个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。', '网站 资源 文章1', 'admin', '2018-06-26', '0', '100', '\0', null, null, null);
INSERT INTO `rcs_content` VALUES ('6', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide2.jpg', '文章测试6', '个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。', '网站 资源 文章5', 'admin', '2018-06-25', '0', '100', '\0', null, null, null);
INSERT INTO `rcs_content` VALUES ('7', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide2.jpg', '文章测试7', '个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建5343453中。。。个人网站正在建设中。。。个人网站正在建设中。。。3434', '网站 资源 文章6', 'admin', '2018-06-23', '0', '100', '\0', null, null, null);
INSERT INTO `rcs_content` VALUES ('8', 'http://www.17sucai.com/preview/705993/2018-01-18/Blog_html/img/slider/slide2.jpg', '文章测试8', '个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。个人网站正在建设中。。。43个人网站正在建设中。。。个人网站正在建设中。。。', '网站 资源 文章8', 'admin', '2018-06-23', '0', '100', '\0', null, null, null);

-- ----------------------------
-- Table structure for rcs_menu
-- ----------------------------
DROP TABLE IF EXISTS `rcs_menu`;
CREATE TABLE `rcs_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级ID  默认为0',
  `name` varchar(255) NOT NULL COMMENT '菜单名称',
  `icon` varchar(255) NOT NULL COMMENT '菜单图标',
  `url` varchar(255) NOT NULL COMMENT '菜单地址',
  `method` varchar(255) DEFAULT NULL COMMENT ' 限制请求方法，【get，post，put，delete】',
  `display` tinyint(255) NOT NULL DEFAULT '0' COMMENT '显示，【0隐藏，1显示】',
  `sort` int(255) NOT NULL DEFAULT '0' COMMENT '排序',
  `info` text COMMENT '描述',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of rcs_menu
-- ----------------------------

-- ----------------------------
-- Table structure for rcs_msg
-- ----------------------------
DROP TABLE IF EXISTS `rcs_msg`;
CREATE TABLE `rcs_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '留言名称',
  `content` text COMMENT '内容',
  `bbs_time` int(11) DEFAULT NULL COMMENT '留言时间',
  `is_top` bit(1) DEFAULT b'0' COMMENT '是否置顶 0为否  1为是',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言内容表';

-- ----------------------------
-- Records of rcs_msg
-- ----------------------------

-- ----------------------------
-- Table structure for rcs_resources
-- ----------------------------
DROP TABLE IF EXISTS `rcs_resources`;
CREATE TABLE `rcs_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `infos` text COMMENT '描述',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='下载资源表';

-- ----------------------------
-- Records of rcs_resources
-- ----------------------------

-- ----------------------------
-- Table structure for rcs_user
-- ----------------------------
DROP TABLE IF EXISTS `rcs_user`;
CREATE TABLE `rcs_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `secret` varchar(255) NOT NULL COMMENT '密钥',
  `name` varchar(50) NOT NULL COMMENT '昵称',
  `number` int(11) DEFAULT NULL COMMENT '手机号',
  `realname` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `sex` tinyint(4) DEFAULT '0' COMMENT '性别  0为保密 1为男 2为女',
  `qq` int(20) DEFAULT NULL,
  `integral` int(11) DEFAULT NULL COMMENT '积分',
  `e_mail` varchar(100) NOT NULL COMMENT '邮箱',
  `sign` text COMMENT '签名',
  `content` text COMMENT '简介',
  `qq_key` varchar(255) DEFAULT NULL COMMENT 'QQkey(用作一键登录)',
  `login_time` int(11) DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(255) DEFAULT NULL COMMENT '登录IP',
  `status` bit(1) DEFAULT b'1' COMMENT '状态 1为启用  0为禁用',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of rcs_user
-- ----------------------------
