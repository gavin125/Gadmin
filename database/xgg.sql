-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 08 月 12 日 14:10
-- 服务器版本: 5.6.13
-- PHP 版本: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `xgg`
--
CREATE DATABASE IF NOT EXISTS `xgg` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `xgg`;

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `student_id` int(10) unsigned NOT NULL COMMENT '学生ID',
  `subject_id` int(10) unsigned NOT NULL COMMENT '科目ID',
  `num` int(10) unsigned NOT NULL COMMENT '数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物车' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) unsigned NOT NULL COMMENT 'ID',
  `name` int(11) NOT NULL COMMENT '组名称',
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='班级';

-- --------------------------------------------------------

--
-- 表的结构 `lesson`
--

CREATE TABLE IF NOT EXISTS `lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(60) NOT NULL COMMENT '名称',
  `section_id` int(11) NOT NULL COMMENT '所属章节',
  `video` varchar(255) NOT NULL COMMENT '文件地址',
  `duration` int(11) NOT NULL COMMENT '时长',
  `can_try` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否试听',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='课程' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` varchar(16) NOT NULL COMMENT '编号',
  `state` tinyint(4) NOT NULL COMMENT '状态',
  `reg_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `pay_time` int(10) NOT NULL COMMENT '付款时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `orderinfo`
--

CREATE TABLE IF NOT EXISTS `orderinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(10) unsigned NOT NULL COMMENT '订单ID',
  `subject_id` int(10) unsigned NOT NULL COMMENT '科目ID',
  `price` int(10) unsigned NOT NULL COMMENT '价格',
  `num` int(10) unsigned NOT NULL COMMENT '数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单详情' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pass`
--

CREATE TABLE IF NOT EXISTS `pass` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `subject_id` int(11) NOT NULL COMMENT '科目ID',
  `student_id` int(11) NOT NULL COMMENT '学生ID',
  `group_id` int(11) NOT NULL COMMENT '班级id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='通过' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(60) NOT NULL COMMENT '名称',
  `subject_id` int(11) NOT NULL COMMENT '所属课程',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='章节' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(60) NOT NULL COMMENT '课程名称',
  `price` int(11) NOT NULL COMMENT '价格',
  `teacher_id` int(10) unsigned NOT NULL COMMENT '授课老师',
  `image` varchar(255) NOT NULL COMMENT '课程图片',
  `info` text NOT NULL COMMENT '课程详情',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='科目' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `uadmin`
--

CREATE TABLE IF NOT EXISTS `uadmin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_name` varchar(60) NOT NULL DEFAULT '' COMMENT '账号',
  `pass_word` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮箱',
  `action_list` text NOT NULL COMMENT '权限',
  `reg_time` int(10) NOT NULL COMMENT '注册时间',
  `last_login` int(10) NOT NULL COMMENT '最后登陆时间',
  `last_ip` varchar(15) DEFAULT NULL COMMENT '最后登陆IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `ustudent`
--

CREATE TABLE IF NOT EXISTS `ustudent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) DEFAULT NULL COMMENT '用户名',
  `pass_word` varchar(32) DEFAULT NULL COMMENT '密码',
  `group_id` int(11) NOT NULL COMMENT '用户组',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机',
  `email` varchar(24) DEFAULT NULL COMMENT '邮箱',
  `photo` varchar(255) NOT NULL COMMENT '头像',
  `reg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间',
  `last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登陆时间',
  `last_ip` varchar(15) DEFAULT NULL COMMENT '最后登陆IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学生' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `uteacher`
--

CREATE TABLE IF NOT EXISTS `uteacher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) DEFAULT NULL COMMENT '用户名',
  `pass_word` varchar(32) DEFAULT NULL COMMENT '密码',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机',
  `email` varchar(24) DEFAULT NULL COMMENT '邮箱',
  `state` tinyint(1) NOT NULL COMMENT '状态',
  `reg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间',
  `last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登陆时间',
  `last_ip` varchar(15) DEFAULT NULL COMMENT '最后登陆IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='老师' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
