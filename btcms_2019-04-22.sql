# ************************************************************
# Sequel Pro SQL dump
# Version 5438
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 42.51.155.79 (MySQL 5.6.35-log)
# Database: btcms
# Generation Time: 2019-04-21 16:43:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table pre_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_admin`;

CREATE TABLE `pre_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理编号',
  `admin_salt` char(6) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `admin_account` varchar(64) NOT NULL DEFAULT '' COMMENT '管理账号',
  `admin_passwd` varchar(32) NOT NULL DEFAULT '' COMMENT '管理密码',
  `admin_group` tinyint(3) unsigned NOT NULL COMMENT '权限组',
  `admin_lastlogin` int(10) unsigned NOT NULL COMMENT '最近登录时间',
  `admin_lastip` int(11) unsigned NOT NULL COMMENT '最近登录IP',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_account` (`admin_account`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='管理表';

LOCK TABLES `pre_admin` WRITE;
/*!40000 ALTER TABLE `pre_admin` DISABLE KEYS */;

INSERT INTO `pre_admin` (`admin_id`, `admin_salt`, `admin_account`, `admin_passwd`, `admin_group`, `admin_lastlogin`, `admin_lastip`)
VALUES
	(1,'VESn','admin','c43dad5925dc74a26b29ab1dee8e55e9',0,1555863612,2130706433);

/*!40000 ALTER TABLE `pre_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pre_app
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_app`;

CREATE TABLE `pre_app` (
  `app_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '应用编号',
  `app_name` varchar(64) NOT NULL DEFAULT '' COMMENT '应用名称',
  `app_key` varchar(64) NOT NULL DEFAULT '' COMMENT '通信key',
  `app_salt` varchar(64) NOT NULL DEFAULT '' COMMENT '安全码',
  `app_adate` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加日期',
  `app_edate` int(11) DEFAULT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table pre_app_token
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_app_token`;

CREATE TABLE `pre_app_token` (
  `at_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `at_app_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属应用',
  `at_token` varchar(32) NOT NULL DEFAULT '' COMMENT ' token',
  `at_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '来源IP',
  `at_udate` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最近使用',
  PRIMARY KEY (`at_id`),
  KEY `at_app_id` (`at_app_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;



# Dump of table pre_article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_article`;

CREATE TABLE `pre_article` (
  `article_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `article_title` varchar(128) NOT NULL DEFAULT '' COMMENT '文章标题',
  `article_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属会员',
  `article_points` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '售价',
  `article_cat_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `article_tags` varchar(128) NOT NULL DEFAULT '' COMMENT '标签',
  `article_keyword` varchar(128) NOT NULL DEFAULT '' COMMENT '关键字',
  `article_desc` varchar(128) NOT NULL DEFAULT '' COMMENT '描述',
  `article_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态',
  `article_has_cover` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否存在封面',
  `article_cover` varchar(64) NOT NULL DEFAULT '' COMMENT '封面',
  `article_via` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '来源',
  `article_via_url` varchar(255) NOT NULL DEFAULT '0' COMMENT '来源地址',
  `article_stat_fav` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
  `article_stat_like` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '赞数',
  `article_stat_view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览数',
  `article_stat_comments` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `article_adate` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `article_udate` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`article_id`),
  KEY `article_title` (`article_title`),
  KEY `article_user_id` (`article_user_id`,`article_cat_id`,`article_status`,`article_has_cover`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章表';



# Dump of table pre_article_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_article_detail`;

CREATE TABLE `pre_article_detail` (
  `article_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属文章',
  `article_detail` mediumtext NOT NULL COMMENT '文章详情',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章内容';



# Dump of table pre_article_image
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_article_image`;

CREATE TABLE `pre_article_image` (
  `ai_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片ID',
  `ai_article_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属资讯',
  `ai_url` varchar(128) NOT NULL COMMENT '图片地址',
  `ai_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '图片说明',
  `ai_sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '图片排序',
  PRIMARY KEY (`ai_id`),
  KEY `ai_article_id` (`ai_article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='资讯图片表';



# Dump of table pre_article_purchase
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_article_purchase`;

CREATE TABLE `pre_article_purchase` (
  `ap_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '购买编号',
  `ap_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '购买用户',
  `ap_article_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文章编号',
  `ap_adate` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '购买时间',
  PRIMARY KEY (`ap_id`),
  UNIQUE KEY `ap_user_id` (`ap_user_id`,`ap_article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章购买记录';



# Dump of table pre_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_category`;

CREATE TABLE `pre_category` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `cat_name` char(64) NOT NULL COMMENT '类别名称',
  `cat_parent` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属类别',
  `cat_route` char(32) NOT NULL DEFAULT '' COMMENT '路由hash',
  `cat_py` char(32) NOT NULL DEFAULT '' COMMENT '类别拼音',
  `cat_sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序值',
  `cat_paths` char(255) NOT NULL DEFAULT '#0#' COMMENT '关系路径',
  `cat_level` tinyint(1) unsigned NOT NULL COMMENT '层次级别',
  `cat_type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '分类类型',
  PRIMARY KEY (`cat_id`),
  KEY `cat_path` (`cat_paths`),
  KEY `cat_type` (`cat_type`,`cat_level`,`cat_sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pre_category` WRITE;
/*!40000 ALTER TABLE `pre_category` DISABLE KEYS */;

INSERT INTO `pre_category` (`cat_id`, `cat_name`, `cat_parent`, `cat_route`, `cat_py`, `cat_sort`, `cat_paths`, `cat_level`, `cat_type`)
VALUES
	(1,'印度人看中国',0,'Indians-look-at-China','',0,'#0#',0,1),
	(2,'印度人在中国',0,'Indians-in-China','',0,'#0#',0,1),
	(5,'电脑看',1,'kankan','',0,'#0#1#',1,1);

/*!40000 ALTER TABLE `pre_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pre_comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_comment`;

CREATE TABLE `pre_comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `comment_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人',
  `comment_user_nick` varchar(32) NOT NULL COMMENT '发布人昵称',
  `comment_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发布状态',
  `comment_type` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属频道(参见common_helper)',
  `comment_ref_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '内容ID',
  `comment_detail` text NOT NULL COMMENT '评论内容',
  `comment_adate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布日期',
  `comment_reply_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论对象',
  `comment_stat_like` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '赞数',
  `comment_stat_reply` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `comment_via_client` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '评论来源',
  PRIMARY KEY (`comment_id`),
  KEY `comment_user_id` (`comment_user_id`),
  KEY `comment_status` (`comment_status`),
  KEY `comment_type` (`comment_type`,`comment_ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='评论表';



# Dump of table pre_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_order`;

CREATE TABLE `pre_order` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `order_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单所属用户',
  `order_ref_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属内容',
  `order_type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '订单类型',
  `order_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态',
  `order_fee` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '总费用',
  `order_memo` varchar(64) NOT NULL DEFAULT '' COMMENT '订单备注',
  `order_adate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生成日期',
  `order_udate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新日期',
  PRIMARY KEY (`order_id`),
  KEY `order_status` (`order_status`),
  KEY `order_user_id` (`order_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pre_order_pay
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_order_pay`;

CREATE TABLE `pre_order_pay` (
  `pay_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录ID',
  `pay_trade_no` char(32) NOT NULL DEFAULT '' COMMENT '记录编号',
  `pay_out_no` char(64) NOT NULL DEFAULT '' COMMENT '外部编号',
  `pay_amount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付金额',
  `pay_type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '支付方式',
  `pay_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属用户',
  `pay_desc` varchar(64) NOT NULL DEFAULT '' COMMENT '支付备注',
  `pay_adate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生成日期',
  `pay_status` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态',
  `pay_ddate` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '到账日期',
  PRIMARY KEY (`pay_id`),
  KEY `pay_trade_no` (`pay_trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付记录';



# Dump of table pre_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_user`;

CREATE TABLE `pre_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_nick` varchar(64) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `user_account` varchar(64) NOT NULL DEFAULT '' COMMENT '会员账号',
  `user_passwd` varchar(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `user_salt` varchar(16) NOT NULL DEFAULT '' COMMENT '随机盐值',
  `user_points` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户积分',
  `user_email` varchar(64) NOT NULL COMMENT '用户邮箱',
  `user_mobile` varchar(16) NOT NULL DEFAULT '' COMMENT '手机号码',
  `user_wechat` varchar(16) NOT NULL DEFAULT '' COMMENT '用户微信',
  `user_qq` varchar(16) NOT NULL DEFAULT '' COMMENT '用户QQ',
  `user_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `user_adate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册日期',
  `user_ldate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `user_avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `user_level` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '用户等级',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_account` (`user_account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表';



# Dump of table pre_user_sns
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pre_user_sns`;

CREATE TABLE `pre_user_sns` (
  `sns_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `sns_type` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '登录类型',
  `sns_key` varchar(64) NOT NULL DEFAULT '' COMMENT '用户标识',
  PRIMARY KEY (`sns_user_id`,`sns_type`,`sns_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='SNS登录表';




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
