-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-08-28 16:36:31
-- 服务器版本： 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xiaoguge`
--

-- --------------------------------------------------------

--
-- 表的结构 `xgg_article`
--

CREATE TABLE `xgg_article` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ID',
  `group_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类',
  `title` varchar(128) NOT NULL DEFAULT '' COMMENT '标题',
  `content` longtext NOT NULL COMMENT '详情',
  `src` varchar(256) NOT NULL DEFAULT '' COMMENT '图片',
  `click` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点击',
  `key_word` varchar(128) NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(256) NOT NULL DEFAULT '' COMMENT '描述',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品';

--
-- 转存表中的数据 `xgg_article`
--

INSERT INTO `xgg_article` (`id`, `group_id`, `title`, `content`, `src`, `click`, `key_word`, `description`, `add_time`, `sort`) VALUES
(1, 1, '这是标题', '这是一条新闻的内容，这是一条新闻的内容', '20130514acunau_thumb.jpg', 5, '关键词', '描述', 1509980132, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xgg_article_group`
--

CREATE TABLE `xgg_article_group` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `parent_id` smallint(5) DEFAULT NULL COMMENT '父级ID',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='页面';

--
-- 转存表中的数据 `xgg_article_group`
--

INSERT INTO `xgg_article_group` (`id`, `name`, `parent_id`, `sort`) VALUES
(1, '公司动态', NULL, 0),
(2, '行业新闻', NULL, 0),
(3, '公司公告', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xgg_carousel`
--

CREATE TABLE `xgg_carousel` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '名称',
  `link` varchar(256) NOT NULL DEFAULT '' COMMENT '链接',
  `src` varchar(256) NOT NULL COMMENT '图片',
  `type` varchar(8) NOT NULL COMMENT '类型（PC|H5）',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '50' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='轮播图';

--
-- 转存表中的数据 `xgg_carousel`
--

INSERT INTO `xgg_carousel` (`id`, `name`, `link`, `src`, `type`, `sort`) VALUES
(1, 'banner1', 'http://www.baidu.com', 'banner/1.jpg', 'PC', 10),
(2, 'banner2', 'http://www.163.com', 'banner/2.jpg', 'PC', 20);

-- --------------------------------------------------------

--
-- 表的结构 `xgg_case`
--

CREATE TABLE `xgg_case` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ID',
  `group_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类',
  `name` varchar(150) NOT NULL DEFAULT '' COMMENT '名称',
  `content` longtext NOT NULL COMMENT '详情',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `click` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点击',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `add_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '添加时间',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='案例';

--
-- 转存表中的数据 `xgg_case`
--

INSERT INTO `xgg_case` (`id`, `group_id`, `name`, `content`, `image`, `click`, `keywords`, `description`, `add_time`, `sort`) VALUES
(1, 0, '小古哥 个人APP案例', '小古哥 个人APP案例', '4.jpg', 0, '小古哥 个人APP案例', '小古哥 个人APP案例', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xgg_case_group`
--

CREATE TABLE `xgg_case_group` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `parent_id` smallint(5) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='页面';

-- --------------------------------------------------------

--
-- 表的结构 `xgg_config`
--

CREATE TABLE `xgg_config` (
  `id` tinyint(4) NOT NULL COMMENT 'ID（1PC|2H5）',
  `on_off` varchar(8) DEFAULT 'on' COMMENT '开关：on|off',
  `title` varchar(32) NOT NULL COMMENT '标题',
  `keywords` varchar(128) NOT NULL COMMENT '关键词',
  `description` varchar(256) NOT NULL COMMENT '描述',
  `logo` varchar(64) DEFAULT NULL COMMENT 'LOGO图',
  `address` varchar(64) DEFAULT NULL COMMENT '地址',
  `icp` varchar(32) DEFAULT NULL COMMENT '备案号',
  `tel` varchar(32) DEFAULT NULL COMMENT '电话',
  `email` varchar(32) DEFAULT NULL COMMENT '邮箱',
  `code` varchar(256) DEFAULT NULL COMMENT '脚本代码',
  `display` varchar(256) NOT NULL COMMENT '显示设置'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `xgg_config`
--

INSERT INTO `xgg_config` (`id`, `on_off`, `title`, `keywords`, `description`, `logo`, `address`, `icp`, `tel`, `email`, `code`, `display`) VALUES
(1, 'on', '小古哥-全栈工程师', '小古哥 全栈工程师 网站开发建设 网站定制开发 HTML5 H5游戏 APP开发 Android IOS', '全栈开发工程师，先后从事美术设计与技术开发等相关工作，熟练掌握多种设计软件和编程语言。对常见互联网产品的用户体验和研发流程有深入理解，精通各类网站/H5/小程序/APP的制作与开发。', 'upload/1535361342.jpg', '上海浦东新区杨高南路799号', '沪ICP备17025818号-1', '15000902705', 'gulei125@163.com', '1233567', '{\"w\":\"415\",\"h\":300,\"artSize\":6,\"artNum\":4,\"proSize\":5,\"proNum\":3}'),
(2, 'on', '小古哥M1-全栈工程师', '小古哥 全栈工程师 网站开发建设 网站定制开发 HTML5 H5游戏 APP开发 Android IOS', '全栈开发工程师，先后从事美术设计与技术开发等相关工作，熟练掌握多种设计软件和编程语言。对常见互联网产品的用户体验和研发流程有深入理解，精通各类网站/H5/小程序/APP的制作与开发。', 'upload/1535363556.png', NULL, NULL, NULL, NULL, NULL, '{\"artSize\":\"6\",\"artNum\":\"4\",\"proSize\":\"5\",\"proNum\":3}');

-- --------------------------------------------------------

--
-- 表的结构 `xgg_link`
--

CREATE TABLE `xgg_link` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '名称',
  `link` varchar(256) NOT NULL DEFAULT '' COMMENT '链接',
  `src` varchar(256) NOT NULL COMMENT '图片',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '50' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接';

--
-- 转存表中的数据 `xgg_link`
--

INSERT INTO `xgg_link` (`id`, `name`, `link`, `src`, `sort`) VALUES
(1, '百度', 'http://www.baidu.com', 'link/1.png', 10),
(2, '网易', 'http://www.163.com', 'link/2.png', 10);

-- --------------------------------------------------------

--
-- 表的结构 `xgg_log`
--

CREATE TABLE `xgg_log` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `add_time` int(10) UNSIGNED NOT NULL COMMENT '时间',
  `action` varchar(255) NOT NULL COMMENT '动作',
  `user_id` tinyint(3) UNSIGNED NOT NULL COMMENT '管理员ID',
  `last_ip` varchar(15) NOT NULL COMMENT 'IP'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='日志';

--
-- 转存表中的数据 `xgg_log`
--

INSERT INTO `xgg_log` (`id`, `add_time`, `action`, `user_id`, `last_ip`) VALUES
(1, 1535092861, '管理员登录成功', 1, '::1'),
(2, 1535093846, '管理员登录成功', 1, '::1'),
(3, 1535254266, '管理员登录成功', 1, '::1'),
(4, 1535360899, '管理员登录成功', 1, '::1'),
(5, 1535361259, '编辑PC配置', 1, '::1'),
(6, 1535361284, '编辑PC配置', 1, '::1'),
(7, 1535361342, '编辑PC配置', 1, '::1'),
(8, 1535361641, '编辑PC配置', 1, '::1'),
(9, 1535362031, '编辑PC配置', 1, '::1'),
(10, 1535362043, '编辑PC配置', 1, '::1'),
(11, 1535363504, '编辑H5配置', 1, '::1'),
(12, 1535363519, '编辑H5配置', 1, '::1'),
(13, 1535363556, '编辑H5配置', 1, '::1'),
(14, 1535364732, '编辑PC配置', 1, '::1'),
(15, 1535364740, '编辑PC配置', 1, '::1'),
(16, 1535365622, '管理员登录成功', 1, '192.168.2.52');

-- --------------------------------------------------------

--
-- 表的结构 `xgg_manager`
--

CREATE TABLE `xgg_manager` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'ID',
  `user_name` varchar(32) NOT NULL COMMENT '账号',
  `pass_word` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(60) DEFAULT NULL COMMENT '邮箱',
  `action_list` text NOT NULL COMMENT '权限',
  `add_time` int(10) UNSIGNED NOT NULL COMMENT '注册时间',
  `last_login` int(10) UNSIGNED DEFAULT NULL COMMENT '最后登录时间',
  `last_ip` varchar(15) DEFAULT NULL COMMENT '最后登录IP'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员';

--
-- 转存表中的数据 `xgg_manager`
--

INSERT INTO `xgg_manager` (`id`, `user_name`, `pass_word`, `email`, `action_list`, `add_time`, `last_login`, `last_ip`) VALUES
(1, 'admin', '04eb952966a62f2c777e416846b14f04', '1', 'ALL', 1509980132, 1535365622, '192.168.2.52'),
(2, 'gavin', '04eb952966a62f2c777e416846b14f04', '2', 'ALL', 1534746630, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `xgg_nav`
--

CREATE TABLE `xgg_nav` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(64) NOT NULL COMMENT '名称',
  `site` varchar(8) NOT NULL DEFAULT 'main' COMMENT '位置：top|main|bottom|mobile',
  `link` varchar(256) NOT NULL COMMENT '链接',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导航栏';

--
-- 转存表中的数据 `xgg_nav`
--

INSERT INTO `xgg_nav` (`id`, `parent_id`, `name`, `site`, `link`, `sort`) VALUES
(7, 0, '首页1', 'main', 'index.html', 0),
(2, 0, '产品中心', 'main', 'product.html', 0),
(3, 0, '联系我们', 'main', 'contact.html', 0),
(4, 0, '产品中心1', 'top', 'product.html', 0),
(5, 0, '产品中心2', 'bottom', 'product.html', 0),
(6, 0, '产品中心3', 'mobile', 'product.html', 0),
(8, 0, '首页2', 'main', 'index.html', 0);

-- --------------------------------------------------------

--
-- 表的结构 `xgg_page`
--

CREATE TABLE `xgg_page` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL COMMENT '名称',
  `src` varchar(256) NOT NULL COMMENT 'banner',
  `content` longtext NOT NULL COMMENT '页面内容',
  `keywords` varchar(128) NOT NULL DEFAULT '',
  `description` varchar(256) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='页面';

--
-- 转存表中的数据 `xgg_page`
--

INSERT INTO `xgg_page` (`id`, `name`, `src`, `content`, `keywords`, `description`) VALUES
(1, '公司介绍', '20130514acunau_thumb.jpg', '这里是公司的详细介绍信息，这里是公司的详细介绍信息，这里是公司的详细介绍信息，这里是公司的详细介绍信息，', '介绍信息', '这里是公司的详细介绍信息'),
(2, '联系我们', '20130514acunau_thumb.jpg', '这里是详细的联系方式信息，这里是详细的联系方式信息，这里是详细的联系方式信息，这里是详细的联系方式信息，这里是详细的联系方式信息，', '联系方式信息', '这里是详细的联系方式信息');

-- --------------------------------------------------------

--
-- 表的结构 `xgg_product`
--

CREATE TABLE `xgg_product` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT 'ID',
  `group_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类',
  `name` varchar(150) NOT NULL DEFAULT '' COMMENT '名称',
  `content` longtext NOT NULL COMMENT '详情',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `key_word` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `add_time` varchar(50) DEFAULT NULL COMMENT '添加时间',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品';

--
-- 转存表中的数据 `xgg_product`
--

INSERT INTO `xgg_product` (`id`, `group_id`, `name`, `content`, `image`, `key_word`, `description`, `add_time`, `sort`) VALUES
(1, 0, '企业网站定制', '根据企业的所属行业、产品特点、网站结构、审美需要等量身定制，界面设计和功能开发上有很大的灵活性。', '1.jpg', '企业网站定制', '根据企业的所属行业、产品特点、网站结构、审美需要等量身定制，界面设计和功能开发上有很大的灵活性。', NULL, 0),
(2, 0, '高级前端开发', '专注各类前端技术，熟悉常用前端框架，可配合开发PC端或移动端的各类界面交互，活动游戏等。', '2.jpg', '高级前端开发', '专注各类前端技术，熟悉常用前端框架，可配合开发PC端或移动端的各类界面交互，活动游戏等。', NULL, 0),
(3, 0, 'APP开发', '采用MUI框架，一次开发即可多端发布，轻松解决高频应用的移动客户端需求。', '3.jpg', 'APP开发', '采用MUI框架，一次开发即可多端发布，轻松解决高频应用的移动客户端需求。', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xgg_product_group`
--

CREATE TABLE `xgg_product_group` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `parent_id` smallint(5) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='页面';

--
-- 转存表中的数据 `xgg_product_group`
--

INSERT INTO `xgg_product_group` (`id`, `name`, `parent_id`, `sort`) VALUES
(1, '解决方案', 0, 0),
(2, '定制开发', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xgg_article`
--
ALTER TABLE `xgg_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_article_group`
--
ALTER TABLE `xgg_article_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_carousel`
--
ALTER TABLE `xgg_carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_case`
--
ALTER TABLE `xgg_case`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_case_group`
--
ALTER TABLE `xgg_case_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_config`
--
ALTER TABLE `xgg_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_link`
--
ALTER TABLE `xgg_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_log`
--
ALTER TABLE `xgg_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_manager`
--
ALTER TABLE `xgg_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_nav`
--
ALTER TABLE `xgg_nav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_page`
--
ALTER TABLE `xgg_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_product`
--
ALTER TABLE `xgg_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xgg_product_group`
--
ALTER TABLE `xgg_product_group`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `xgg_article`
--
ALTER TABLE `xgg_article`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `xgg_article_group`
--
ALTER TABLE `xgg_article_group`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `xgg_carousel`
--
ALTER TABLE `xgg_carousel`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `xgg_case`
--
ALTER TABLE `xgg_case`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `xgg_case_group`
--
ALTER TABLE `xgg_case_group`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `xgg_config`
--
ALTER TABLE `xgg_config`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ID（1PC|2H5）', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `xgg_link`
--
ALTER TABLE `xgg_link`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `xgg_log`
--
ALTER TABLE `xgg_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `xgg_manager`
--
ALTER TABLE `xgg_manager`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `xgg_nav`
--
ALTER TABLE `xgg_nav`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `xgg_page`
--
ALTER TABLE `xgg_page`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `xgg_product`
--
ALTER TABLE `xgg_product`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `xgg_product_group`
--
ALTER TABLE `xgg_product_group`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
