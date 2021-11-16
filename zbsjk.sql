-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2021-10-24 19:59:50
-- 服务器版本： 5.6.50-log
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uap339qk03.bt`
--

-- --------------------------------------------------------

--
-- 表的结构 `eztv_movie`
--

CREATE TABLE IF NOT EXISTS `eztv_movie` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `api` text,
  `state` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `eztv_movie`
--

INSERT INTO `eztv_movie` (`id`, `name`, `api`, `state`) VALUES
(0, 'OK资源网', 'https://cj.okzy.tv/inc/api1s_subname.php', '1'),
(1, '最大资源网', 'http://www.zdziyuan.com/inc/api.php', '1'),
(2, '八戒资源网', 'http://cj.bajiecaiji.com/inc/api.php', '1'),
(3, '605资源网', 'http://www.605zy.co/inc/api.php', '1');

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_admin`
--

CREATE TABLE IF NOT EXISTS `luo2888_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `psw` varchar(32) NOT NULL,
  `showcounts` tinyint(1) NOT NULL DEFAULT '20',
  `author` tinyint(1) NOT NULL DEFAULT '0',
  `useradmin` tinyint(1) NOT NULL DEFAULT '0',
  `ipcheck` tinyint(1) NOT NULL DEFAULT '0',
  `epgadmin` tinyint(1) NOT NULL DEFAULT '0',
  `mealsadmin` tinyint(1) NOT NULL DEFAULT '0',
  `channeladmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `luo2888_admin`
--

INSERT INTO `luo2888_admin` (`id`, `name`, `psw`, `showcounts`, `author`, `useradmin`, `ipcheck`, `epgadmin`, `mealsadmin`, `channeladmin`) VALUES
(1, 'admin', '8114c88b2062d554b895f92bd3d7b9b8', 20, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_adminrec`
--

CREATE TABLE IF NOT EXISTS `luo2888_adminrec` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `loc` varchar(32) DEFAULT NULL,
  `time` varchar(64) NOT NULL,
  `func` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `luo2888_adminrec`
--

INSERT INTO `luo2888_adminrec` (`id`, `name`, `ip`, `loc`, `time`, `func`) VALUES
(1, 'admin', '36.113.112.127', '中国江苏，电信', '2021-06-26 21:34:55', '输入错误密码'),
(2, 'admin', '36.113.112.127', '中国江苏，电信', '2021-06-26 21:35:09', '用户登入'),
(3, 'admin', '36.113.101.41', '江苏南京，电信', '2021-06-30 21:25:59', '用户登入'),
(4, 'admin', '125.110.206.161', '浙江温州，电信', '2021-07-01 07:09:53', '输入错误密码'),
(5, 'admin', '125.110.206.161', '浙江温州，电信', '2021-07-01 07:10:10', '输入错误密码'),
(6, 'admin', '125.110.206.161', '浙江温州，电信', '2021-07-01 07:10:23', '用户登入'),
(7, 'admin', '125.110.232.167', '浙江温州，电信', '2021-07-11 10:17:48', '输入错误密码'),
(8, 'admin', '125.110.232.167', '浙江温州，电信', '2021-07-11 10:18:02', '输入错误密码'),
(9, 'admin', '125.110.232.167', '浙江温州，电信', '2021-07-11 10:18:28', '用户登入'),
(10, 'admin', '60.181.28.60', '浙江温州，电信', '2021-10-08 19:26:57', '输入错误密码'),
(11, 'admin', '60.181.28.60', '浙江温州，电信', '2021-10-08 19:27:19', '输入错误密码'),
(12, 'admin', '60.181.28.60', '浙江温州，电信', '2021-10-08 19:27:30', '用户登入'),
(13, 'admin', '60.181.28.60', '浙江温州，电信', '2021-10-08 19:47:19', '用户登入'),
(14, 'admin', '60.181.28.60', '浙江温州，电信', '2021-10-08 19:53:29', '用户登入'),
(15, 'admin', '122.97.175.4', '江苏南京，联通/基站WiFi', '2021-10-08 20:36:20', '输入错误密码'),
(16, 'admin', '122.97.175.4', '江苏南京，联通/基站WiFi', '2021-10-08 20:36:36', '用户登入'),
(17, 'admin', '60.181.30.99', '浙江温州，电信', '2021-10-09 21:59:13', '用户登入'),
(18, 'admin', '60.181.30.99', '浙江温州，电信', '2021-10-11 07:27:35', '用户登入'),
(19, 'admin', '60.181.30.99', '浙江温州，电信', '2021-10-11 12:43:29', '用户登入'),
(20, 'admin', '60.181.30.99', '浙江温州，电信', '2021-10-11 13:05:37', '用户登入'),
(21, 'admin', '60.181.30.99', '浙江温州，电信', '2021-10-11 20:58:37', '用户登入'),
(22, 'admin', '60.181.30.99', '浙江温州，电信', '2021-10-11 21:31:31', '用户登入'),
(23, 'admin', '60.181.30.99', '浙江温州，电信', '2021-10-12 06:48:47', '用户登入'),
(24, 'admin', '60.181.30.99', '浙江温州，电信', '2021-10-12 20:53:21', '用户登入');

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_category`
--

CREATE TABLE IF NOT EXISTS `luo2888_category` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  `psw` varchar(16) DEFAULT NULL,
  `type` varchar(16) NOT NULL DEFAULT 'default',
  `url` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `luo2888_category`
--

INSERT INTO `luo2888_category` (`id`, `name`, `enable`, `psw`, `type`, `url`) VALUES
(3, 'Sason', 1, '', 'default', 'https://raw.githubusercontent.com/sasoncheung/iptv/master/all.txt'),
(59, '上海', 1, '', 'province', NULL),
(66, '云南', 1, '', 'province', NULL),
(70, '内蒙古', 1, '', 'province', NULL),
(71, '北京', 1, '', 'province', NULL),
(2, '卫视直播', 1, '', 'default', 'https://gitee.com/homenet6/list/raw/master/nj.txt'),
(61, '吉林', 1, '', 'province', NULL),
(78, '四川', 1, '', 'province', NULL),
(58, '天津', 1, '', 'province', NULL),
(1, '央视直播', 1, '', 'default', NULL),
(69, '宁夏', 1, '', 'province', NULL),
(55, '安徽', 1, '', 'province', NULL),
(77, '山东', 1, '', 'province', NULL),
(60, '山西', 1, '', 'province', NULL),
(52, '广东', 1, '', 'province', NULL),
(73, '广西', 1, '', 'province', NULL),
(76, '新疆', 1, '', 'province', NULL),
(62, '江苏', 1, '', 'province', NULL),
(56, '江西', 1, '', 'province', NULL),
(54, '河北', 1, '', 'province', NULL),
(51, '河南', 1, '', 'province', NULL),
(75, '浙江', 1, '', 'province', NULL),
(64, '海南', 1, '', 'province', NULL),
(53, '湖北', 1, '', 'province', NULL),
(72, '湖南', 1, '', 'province', NULL),
(74, '甘肃', 1, '', 'province', NULL),
(63, '福建', 1, '', 'province', NULL),
(68, '西藏', 1, '', 'province', NULL),
(65, '贵州', 1, '', 'province', NULL),
(50, '重庆', 1, '', 'province', NULL),
(67, '陕西', 1, '', 'province', NULL),
(250, '隐藏频道', 1, '12345', 'vip', NULL),
(57, '黑龙江', 1, '', 'province', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_channels`
--

CREATE TABLE IF NOT EXISTS `luo2888_channels` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(1024) DEFAULT NULL,
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `luo2888_channels`
--

INSERT INTO `luo2888_channels` (`id`, `name`, `url`, `category`) VALUES
(2, '测试', 'http://127.0.0.1', '隐藏频道'),
(147, 'CETV-1', 'http://39.134.38.133:80/PLTV/88888888/224/3221226282/index.m3u8', '卫视直播'),
(148, '安徽卫视', 'http://39.134.135.33:80/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226223/1.m3u8', '卫视直播'),
(149, '北京卫视', 'http://39.134.168.71/PLTV/1/224/3221225524/index.m3u8', '卫视直播'),
(150, '东南卫视', 'http://39.134.134.28/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226406/1.m3u8', '卫视直播'),
(151, '广东卫视', 'http://111.13.111.242/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226238/1.m3u8', '卫视直播'),
(152, '河北卫视', 'http://live01.hebtv.com:80/channels/hebtv/video_channel_04/m3u8:2000k/live', '卫视直播'),
(153, '黑龙卫视', 'http://111.13.111.242/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226239/1.m3u8', '卫视直播'),
(154, '湖北卫视', 'http://111.13.111.242/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226240/1.m3u8', '卫视直播'),
(155, '湖南卫视', 'http://39.134.168.76/PLTV/1/224/3221225518/index.m3u8', '卫视直播'),
(156, '江苏卫视', 'http://39.134.168.76/PLTV/1/224/3221225514/index.m3u8', '卫视直播'),
(157, '江西卫视', 'http://111.13.111.242/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226243/1.m3u8', '卫视直播'),
(158, '浙江卫视', 'http://111.56.125.231/PLTV/1/224/3221225520/index.m3u8', '卫视直播'),
(159, '深圳卫视', 'http://111.13.111.242/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226245/1.m3u8', '卫视直播'),
(160, '东方卫视', 'http://39.134.168.76/PLTV/1/224/3221225506/index.m3u8', '卫视直播'),
(161, '天津卫视', 'http://111.13.111.242/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226246/1.m3u8', '卫视直播'),
(162, '山东卫视', 'http://39.134.134.57/otttv.bj.chinamobile.com/PLTV/88888888/224/3221226244/1.m3u8', '卫视直播'),
(163, '辽宁卫视', 'http://112.50.243.8/PLTV/88888888/224/3221225947/1.m3u8', '卫视直播'),
(164, '四川卫视', 'http://scgctvshow.sctv.com/scgc/sctv1deu5453w/1.m3u8', '卫视直播'),
(165, '重庆卫视', 'http://qxlmlive.cbg.cn:1935/app_2/ls_67.stream/chunklist.m3u8', '卫视直播'),
(166, '贵州卫视', 'http://101.71.255.229:6610/zjhs/2/10015/index.m3u8?virtualDomain=zjhs.live_hls.zte.com&tid=6Y1VNBZQTNW1U6PYSQFNXMCZ5T03&ts=1550812363', '卫视直播'),
(167, '青海卫视', 'http://live.geermurmt.com/qhws/sd/live.m3u8', '卫视直播'),
(168, '南国都市   4K', 'https://aplays.gztv.com/sec/shenghuo.m3u8?auth_key=1591880348-0-0-252b667f10b9c1d596766f7ce3b2e17e', '卫视直播'),
(169, '云南卫视', 'http://edge1.yntv.cn:80/channels/yntv/ynws/m3u8:sd', '卫视直播'),
(170, '吉林卫视', 'http://stream4.jlntv.cn:80/test2/sd/live.m3u8', '卫视直播'),
(171, '河南卫视', 'http://183.232.184.143/outlivecloud-cdn.ysp.cctv.cn/cctv/2000296103.m3u8', '卫视直播'),
(172, '河南卫视', 'http://101.71.255.229:6610/zjhs/2/10018/index.m3u8?virtualDomain=zjhs.live_hls.zte.com', '卫视直播'),
(173, '四川康巴', 'http://stream.kangbatv.com/test/playlist.m3u8', '卫视直播'),
(174, '海南卫视', 'http://101.71.255.229:6610/zjhs/2/10034/index.m3u8?virtualDomain=zjhs.live_hls.zte.com', '卫视直播'),
(175, '宁夏卫视', 'http://111.13.111.242/otttv.bj.chinamobile.com/PLTV/88888888/224/3221225892/1.m3u8', '卫视直播'),
(176, '广西卫视标清', 'http://101.71.255.229:6610/zjhs/2/10014/index.m3u8?virtualDomain=zjhs.live_hls.zte.com', '卫视直播'),
(177, '厦门卫视', 'http://112.50.243.4/PLTV/88888888/224/3221226781/1.m3u8', '卫视直播'),
(178, '延边卫视', 'http://live.ybtvyun.com:80/video/s10006-44f040627ca1/index.m3u8', '卫视直播'),
(179, '海峡卫视标清', 'http://118.123.60.12:8114/LIVES/Fsv_otype=1&FvSeid=&Fsv_filetype=mull&Fsv_chan_hls_se_idx=024&Provider_id=&Pcontent_id=index.m3u8', '卫视直播'),
(180, '冬奥纪实', 'http://httpdvb.slave.ttcatv.tv:13164/playurl?playtype=live&protocol=hls&playtoken=ABCDEFGH&auth=no&accesstoken=R5E9FE370U3092A010K778CA548IADC3EE73PBM3233DA7V1044EZ33519WE7045A44701&programid=4200000314', '卫视直播'),
(181, '香港卫视标清', 'http://zhibo.hkstv.tv:80/livestream/mutfysrq/playlist.m3u8?wsSession=f47cb31c8f634374a17959ef-158753727344846&wsIPSercert=97451408bc9167c21b7938bc63ebacd1&wsMonitor=0', '卫视直播'),
(182, '兵团卫视标清', 'http://v.btzx.com.cn:1935/live/weishi.stream/chunklist_w73664786.m3u8', '卫视直播'),
(183, '甘肃卫视', 'https://hls.gstv.com.cn/g5971p/0292k0.m3u8', '卫视直播'),
(184, '内蒙卫视标清', 'http://ivi.bupt.edu.cn/hls/nmtv.m3u8', '卫视直播'),
(185, '山西卫视标清', 'http://liveplay-kk.rtxapp.com:80/live/program/live/shanxiws/1300000/mnf.m3u8', '卫视直播'),
(186, '西藏卫视标清', 'http://ivi.bupt.edu.cn/hls/xztv.m3u8', '卫视直播'),
(187, '新疆卫视标清', 'http://ivi.bupt.edu.cn/hls/xjtv.m3u8', '卫视直播'),
(188, '农林卫视标清', 'http://39.130.215.158:6610/gitv_live/G_NONGLIN/G_NONGLIN.m3u8?IASHttpSessionId=OTT2468020200512222753009906', '卫视直播'),
(189, '三沙卫视标清', 'http://ivi.bupt.edu.cn/hls/sstv.m3u8', '卫视直播'),
(190, '中国天气标清', 'http://hls.weathertv.cn/tslslive/qCFIfHB/hls/live_sd.m3u8', '卫视直播'),
(191, '中国教育2台', 'http://cctvalih5ca.v.myalicdn.com/cstv/cetv2_2/index.m3u8', '卫视直播'),
(192, '中国教育3台', 'http://cctvalih5ca.v.myalicdn.com/cstv/cetv3_2/index.m3u8', '卫视直播'),
(193, '中国教育4台', 'http://cctvalih5ca.v.myalicdn.com/cstv/cetv4_2/index.m3u8', '卫视直播'),
(194, '山东教育标清', 'http://111.13.111.242/otttv.bj.chinamobile.com/PLTV/88888888/224/3221225908/1.m3u8', '卫视直播'),
(247, 'CCTV-1', 'http://39.135.138.58:18890/PLTV/88888888/224/3221225642/index.m3u8,', '央视直播'),
(248, 'CCTV-2', 'http://39.135.138.58:18890/PLTV/88888888/224/3221225643/index.m3u8', '央视直播'),
(249, 'CCTV-3', 'http://39.134.65.175/PLTV/88888888/224/3221225799/index.m3u8', '央视直播'),
(250, 'CCTV-3', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-3/1.m3u8', '央视直播'),
(251, 'CCTV-4', 'http://39.134.65.175/PLTV/88888888/224/3221225797/index.m3u8', '央视直播'),
(252, 'CCTV-4', 'http://cctvcnch5ca.v.wscdns.com/live/cctv4_2/10793.m3u8', '央视直播'),
(253, 'CCTV-4', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-4/1.m3u8', '央视直播'),
(254, 'CCTV-5', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-5/1.m3u8', '央视直播'),
(255, 'CCTV-6', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-6/1.m3u8', '央视直播'),
(256, 'CCTV-7', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-7/1.m3u8', '央视直播'),
(257, 'CCTV-8', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-8/1.m3u8', '央视直播'),
(258, 'CCTV-9', 'http://111.40.196.35/wh7f454c46tw3640300029_615820538/PLTV/88888888/224/3221225502/index.m3u8', '央视直播'),
(259, 'CCTV-10', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-10/1.m3u8', '央视直播'),
(260, 'CCTV-11', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-11/1.m3u8', '央视直播'),
(261, 'CCTV-12', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-12/1.m3u8', '央视直播'),
(262, 'CCTV-13', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-13/1.m3u8', '央视直播'),
(263, 'CCTV-14', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-14/1.m3u8', '央视直播'),
(264, 'CCTV-15', 'http://117.169.124.36:6610/ysten-businessmobile/live/cctv-15/1.m3u8', '央视直播'),
(265, 'CCTV-17', 'http://39.135.138.58:18890/PLTV/88888888/224/3221225907/index.m3u8', '央视直播'),
(266, 'CCTV-5+', 'http://117.169.124.46:6410/ysten-businessmobile/live/hdcctv05plus/1.m3u8', '央视直播'),
(267, 'CGTN', 'http://39.134.65.162/PLTV/88888888/224/3221225510/index.m3u8', '央视直播');

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_config`
--

CREATE TABLE IF NOT EXISTS `luo2888_config` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `value` text
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `luo2888_config`
--

INSERT INTO `luo2888_config` (`id`, `name`, `value`) VALUES
(1, 'adinfo', ''),
(2, 'adtext', ''),
(3, 'appurl', 'https://127.0.0.1/tv.apk'),
(4, 'appurl_sdk14', 'https://127.0.0.1/tv_sdk14.apk'),
(5, 'appver', '1.0'),
(6, 'appver_sdk14', '1.0'),
(7, 'app_appname', '梦亿TV'),
(8, 'app_packagename', 'cn.tv.player'),
(9, 'app_sign', '12315'),
(10, 'autoupdate', '1'),
(11, 'buffTimeOut', '30'),
(12, 'dataver', '1'),
(13, 'decoder', '1'),
(14, 'epg_api_chk', '0'),
(15, 'ipcount', '2'),
(16, 'ipchk', '1'),
(17, 'max_sameip_user', '5'),
(18, 'needauthor', '1'),
(19, 'randkey', '6d7caa26b6de5941e3b24fd7c573d0bb'),
(20, 'secret_key', NULL),
(21, 'setver', '3'),
(22, 'showtime', '120'),
(23, 'showinterval', '5'),
(24, 'showwea', '0'),
(25, 'tipepgerror_1000', '1000_EPG接口验证失败!如有疑问请联系公众号客服：luo2888的工作室'),
(26, 'tipepgerror_1001', '1001_EPG接口验证失败系!如有疑问请联系公众号客服：luo2888的工作室'),
(27, 'tipepgerror_1002', '1002_EPG接口验证失败!如有疑问请联系公众号客服：luo2888的工作室'),
(28, 'tipepgerror_1003', '1003_EPG接口验证失败!如有疑问请联系公众号客服：luo2888的工作室'),
(29, 'tipepgerror_1004', '1004_EPG接口验证失败!如有疑问请联系公众号客服：luo2888的工作室'),
(30, 'tipepgerror_1005', '1005_EPG接口验证失败!如有疑问请联系公众号客服：luo2888的工作室'),
(31, 'tiploading', '正在连接，请稍后 ...'),
(32, 'tipuserexpired', '账号已到期，请联系公众号客服续费。'),
(33, 'tipuserforbidden', '账号已禁用，请联系公众号客服。'),
(34, 'tipusernoreg', '未被授权使用，请联系公众号客服，@luo2888的工作室。'),
(35, 'trialdays', '-999'),
(36, 'updateinterval', '10'),
(37, 'up_size', '0.0M'),
(38, 'up_sets', '0'),
(39, 'up_text', '1.公告测试'),
(40, 'weaapi_id', NULL),
(41, 'weaapi_key', NULL),
(42, 'alipay_appid', NULL),
(43, 'alipay_privatekey', NULL),
(44, 'alipay_publickey', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_epg`
--

CREATE TABLE IF NOT EXISTS `luo2888_epg` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remarks` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `luo2888_epg`
--

INSERT INTO `luo2888_epg` (`id`, `name`, `content`, `status`, `remarks`) VALUES
(1, 'cntv-cctv1', 'CCTV-1', 1, NULL),
(2, 'cntv-cctv2', 'CCTV-2', 1, NULL),
(3, 'cntv-cctv3', 'CCTV-3', 1, NULL),
(4, 'cntv-cctv4', 'CCTV-4', 1, NULL),
(5, 'cntv-cctv5', 'CCTV-5', 1, NULL),
(6, 'cntv-cctv5plus', 'CCTV-5Plus', 1, NULL),
(7, 'cntv-cctv6', 'CCTV-6', 1, NULL),
(8, 'cntv-cctv7', 'CCTV-7', 1, NULL),
(9, 'cntv-cctv8', 'CCTV-8', 1, NULL),
(10, 'cntv-cctvjilu', 'CCTV-9', 1, NULL),
(11, 'cntv-cctv10', 'CCTV-10', 1, NULL),
(12, 'cntv-cctv11', 'CCTV-11', 1, NULL),
(13, 'cntv-cctv12', 'CCTV-12', 1, NULL),
(14, 'cntv-cctv13', 'CCTV-13', 1, NULL),
(15, 'cntv-cctvchild', 'CCTV-14', 1, NULL),
(16, 'cntv-cctv15', 'CCTV-15', 1, NULL),
(17, 'cntv-cctv17', 'CCTV-17', 1, NULL),
(18, 'cntv-cetv1', 'CETV-1', 1, NULL),
(19, 'cntv-cetv2', 'CETV-2', 1, NULL),
(20, 'cntv-cetv3', 'CETV-3', 1, NULL),
(21, 'cntv-cetv4', 'CETV-4', 1, NULL),
(22, 'cntv-cctv4k', 'CCTV 4K超高清', 1, NULL),
(23, 'tvmao-ZJTV-ZJTV1', '浙江卫视', 1, NULL),
(24, 'tvmao-JSTV-JSTV1', '江苏卫视', 1, NULL),
(25, 'tvmao-HUNANTV-HUNANTV1', '湖南卫视', 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_meals`
--

CREATE TABLE IF NOT EXISTS `luo2888_meals` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `amount` int(4) NOT NULL DEFAULT '0',
  `days` int(4) NOT NULL DEFAULT '0',
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `luo2888_meals`
--

INSERT INTO `luo2888_meals` (`id`, `name`, `amount`, `days`, `content`, `status`) VALUES
(1000, '试看套餐', 1, 30, '央视直播_卫视直播', 1),
(1002, '会员套餐', 7, 999, 'HomeNET_Sason_重庆_河南_广东_湖北_河北_安徽_江西_黑龙江_天津_上海_山西_吉林_江苏_福建_海南_贵州_云南_陕西_西藏_宁夏_内蒙古_北京_湖南_广西_甘肃_浙江_新疆_山东_四川_隐藏频道', 1);

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_payment`
--

CREATE TABLE IF NOT EXISTS `luo2888_payment` (
  `userid` bigint(20) NOT NULL,
  `order_id` varchar(128) NOT NULL,
  `meal` int(4) NOT NULL,
  `days` int(4) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `luo2888_users`
--

CREATE TABLE IF NOT EXISTS `luo2888_users` (
  `id` int(11) NOT NULL,
  `name` bigint(20) NOT NULL,
  `mac` varchar(32) NOT NULL,
  `deviceid` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `region` varchar(32) DEFAULT NULL,
  `exp` bigint(20) NOT NULL,
  `vpn` tinyint(5) NOT NULL DEFAULT '0',
  `idchange` tinyint(5) NOT NULL DEFAULT '0',
  `author` varchar(16) DEFAULT NULL,
  `authortime` bigint(20) NOT NULL DEFAULT '0',
  `status` int(4) NOT NULL DEFAULT '-1',
  `lasttime` bigint(20) NOT NULL,
  `marks` varchar(16) DEFAULT NULL,
  `meal` int(11) NOT NULL DEFAULT '1000'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `luo2888_users`
--

INSERT INTO `luo2888_users` (`id`, `name`, `mac`, `deviceid`, `model`, `ip`, `region`, `exp`, `vpn`, `idchange`, `author`, `authortime`, `status`, `lasttime`, `marks`, `meal`) VALUES
(1, 198769, 'e0:dc:ff:f9:e1:97', '33fe270b3f075adc', 'Mi9 Pro 5G', '60.181.27.98', '浙江温州，电信', 1625932800, 0, 1, 'admin', 1624714947, 999, 1635074554, '已授权', 1000),
(2, 882815, '00:04:4b:84:12:1d', '621dbbad489bd3f7', 'SHIELD Android TV', '80.251.221.251', '北美洲，美国', 1634140800, 0, 0, 'admin', 1634043223, 1, 1634122453, '已授权', 1000),
(3, 796357, '90:17:c8:24:87:f4', 'fd59987d417aab64', 'LIO-AN00', '36.28.212.8', '浙江杭州，电信', 1634140800, 0, 0, 'admin', 1634043581, 1, 1634052689, '已授权', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eztv_movie`
--
ALTER TABLE `eztv_movie`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `luo2888_admin`
--
ALTER TABLE `luo2888_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luo2888_adminrec`
--
ALTER TABLE `luo2888_adminrec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luo2888_category`
--
ALTER TABLE `luo2888_category`
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `luo2888_channels`
--
ALTER TABLE `luo2888_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luo2888_config`
--
ALTER TABLE `luo2888_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luo2888_epg`
--
ALTER TABLE `luo2888_epg`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `luo2888_meals`
--
ALTER TABLE `luo2888_meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luo2888_users`
--
ALTER TABLE `luo2888_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mac` (`mac`,`deviceid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eztv_movie`
--
ALTER TABLE `eztv_movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `luo2888_admin`
--
ALTER TABLE `luo2888_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `luo2888_adminrec`
--
ALTER TABLE `luo2888_adminrec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `luo2888_channels`
--
ALTER TABLE `luo2888_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=268;
--
-- AUTO_INCREMENT for table `luo2888_config`
--
ALTER TABLE `luo2888_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `luo2888_epg`
--
ALTER TABLE `luo2888_epg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `luo2888_meals`
--
ALTER TABLE `luo2888_meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1003;
--
-- AUTO_INCREMENT for table `luo2888_users`
--
ALTER TABLE `luo2888_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
