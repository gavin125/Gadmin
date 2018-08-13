-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-08-13 08:26:11
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xgg`
--
CREATE DATABASE IF NOT EXISTS `xgg` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `xgg`;

-- --------------------------------------------------------

--
-- 表的结构 `answer`
--

CREATE TABLE `answer` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `lesson_id` int(10) UNSIGNED NOT NULL COMMENT '课程ID',
  `student_id` int(10) UNSIGNED NOT NULL COMMENT '学生ID',
  `parent_id` int(10) UNSIGNED DEFAULT NULL COMMENT '回复父级ID',
  `info` text NOT NULL COMMENT '答疑详情'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='答疑';

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `student_id` int(10) UNSIGNED NOT NULL COMMENT '学生ID',
  `subject_id` int(10) UNSIGNED NOT NULL COMMENT '科目ID',
  `num` int(10) UNSIGNED NOT NULL COMMENT '数量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物车';

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE `group` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `name` int(10) UNSIGNED NOT NULL COMMENT '组名称',
  `reg_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='班级';

-- --------------------------------------------------------

--
-- 表的结构 `impower_g`
--

CREATE TABLE `impower_g` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `subject_id` int(10) UNSIGNED NOT NULL COMMENT '科目ID',
  `group_id` int(10) UNSIGNED NOT NULL COMMENT '班级ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='班级授权';

-- --------------------------------------------------------

--
-- 表的结构 `impower_s`
--

CREATE TABLE `impower_s` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `subject_id` int(10) UNSIGNED NOT NULL COMMENT '科目ID',
  `student_id` int(10) UNSIGNED NOT NULL COMMENT '学生ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学生授权';

-- --------------------------------------------------------

--
-- 表的结构 `lesson`
--

CREATE TABLE `lesson` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(60) NOT NULL COMMENT '名称',
  `section_id` int(10) UNSIGNED NOT NULL COMMENT '章节ID',
  `video` varchar(255) NOT NULL COMMENT '视频地址',
  `duration` int(10) UNSIGNED NOT NULL COMMENT '时长',
  `can_try` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否试听',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='课程';

-- --------------------------------------------------------

--
-- 表的结构 `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `student_id` int(10) UNSIGNED NOT NULL COMMENT '学生ID',
  `lesson_id` int(10) UNSIGNED NOT NULL COMMENT '课程ID',
  `time_point` int(10) UNSIGNED NOT NULL COMMENT '时间点',
  `info` text NOT NULL COMMENT '笔记详情'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='笔记';

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `code` varchar(16) NOT NULL COMMENT '编号',
  `state` tinyint(3) UNSIGNED NOT NULL COMMENT '状态',
  `reg_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `pay_time` int(10) UNSIGNED DEFAULT NULL COMMENT '付款时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单';

-- --------------------------------------------------------

--
-- 表的结构 `orderinfo`
--

CREATE TABLE `orderinfo` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `order_id` int(10) UNSIGNED NOT NULL COMMENT '订单ID',
  `subject_id` int(10) UNSIGNED NOT NULL COMMENT '科目ID',
  `price` int(10) UNSIGNED NOT NULL COMMENT '价格',
  `num` int(10) UNSIGNED NOT NULL COMMENT '数量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单详情';

-- --------------------------------------------------------

--
-- 表的结构 `section`
--

CREATE TABLE `section` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(60) NOT NULL COMMENT '名称',
  `subject_id` int(10) UNSIGNED NOT NULL COMMENT '科目ID',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级ID（默认0无父级）',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='章节';

-- --------------------------------------------------------

--
-- 表的结构 `subject`
--

CREATE TABLE `subject` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(60) NOT NULL COMMENT '课程名称',
  `price` int(10) UNSIGNED NOT NULL COMMENT '价格',
  `teacher_id` int(10) UNSIGNED NOT NULL COMMENT '老师ID',
  `image` varchar(255) NOT NULL COMMENT '图片地址',
  `info` text NOT NULL COMMENT '课程详情'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='科目';

-- --------------------------------------------------------

--
-- 表的结构 `uadmin`
--

CREATE TABLE `uadmin` (
  `id` tinyint(3) UNSIGNED NOT NULL COMMENT 'ID',
  `user_name` varchar(60) NOT NULL COMMENT '账号',
  `pass_word` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(60) DEFAULT NULL COMMENT '邮箱',
  `action_list` text NOT NULL COMMENT '权限',
  `reg_time` int(10) UNSIGNED NOT NULL COMMENT '注册时间',
  `last_login` int(10) UNSIGNED DEFAULT NULL COMMENT '最后登陆时间',
  `last_ip` varchar(15) DEFAULT NULL COMMENT '最后登陆IP'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员';

-- --------------------------------------------------------

--
-- 表的结构 `ustudent`
--

CREATE TABLE `ustudent` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `user_name` varchar(30) NOT NULL COMMENT '用户名',
  `pass_word` varchar(32) NOT NULL COMMENT '密码',
  `group_id` int(10) UNSIGNED DEFAULT NULL COMMENT '班级ID',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机',
  `email` varchar(24) DEFAULT NULL COMMENT '邮箱',
  `photo` varchar(255) DEFAULT NULL COMMENT '头像',
  `reg_time` int(10) UNSIGNED NOT NULL COMMENT '注册时间',
  `last_login` int(10) UNSIGNED DEFAULT NULL COMMENT '最后登陆时间',
  `last_ip` varchar(15) DEFAULT NULL COMMENT '最后登陆IP'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学生';

-- --------------------------------------------------------

--
-- 表的结构 `uteacher`
--

CREATE TABLE `uteacher` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `user_name` varchar(30) DEFAULT NULL COMMENT '用户名',
  `pass_word` varchar(32) DEFAULT NULL COMMENT '密码',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机',
  `email` varchar(24) DEFAULT NULL COMMENT '邮箱',
  `photo` varchar(255) NOT NULL COMMENT '头像地址',
  `state` tinyint(3) UNSIGNED NOT NULL COMMENT '状态',
  `reg_time` int(10) UNSIGNED NOT NULL COMMENT '注册时间',
  `last_login` int(10) UNSIGNED DEFAULT NULL COMMENT '最后登陆时间',
  `last_ip` varchar(15) DEFAULT NULL COMMENT '最后登陆IP'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='老师';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impower_g`
--
ALTER TABLE `impower_g`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impower_s`
--
ALTER TABLE `impower_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderinfo`
--
ALTER TABLE `orderinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uadmin`
--
ALTER TABLE `uadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ustudent`
--
ALTER TABLE `ustudent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `uteacher`
--
ALTER TABLE `uteacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `impower_g`
--
ALTER TABLE `impower_g`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `impower_s`
--
ALTER TABLE `impower_s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `orderinfo`
--
ALTER TABLE `orderinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `section`
--
ALTER TABLE `section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `uadmin`
--
ALTER TABLE `uadmin`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `ustudent`
--
ALTER TABLE `ustudent`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `uteacher`
--
ALTER TABLE `uteacher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
