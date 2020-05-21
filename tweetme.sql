-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2019 at 08:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tweetme`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  PRIMARY KEY (`user_id1`,`user_id2`),
  KEY `user_id2` (`user_id2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`user_id1`, `user_id2`) VALUES
(4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` varchar(300) DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL,
  `comment_tweet_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_likes` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_tweet_id` (`comment_tweet_id`),
  KEY `comment_user_id` (`comment_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_date`, `comment_tweet_id`, `comment_user_id`, `comment_likes`) VALUES
(1, 'hi fateme ata!\r\nI am neda. do you remember me?:)', '2019-01-23 02:42:25', 3, 4, 0),
(2, 'i like this post. very nice!', '2019-01-23 02:43:23', 2, 4, 0),
(3, 'good luck dear niloofar :)))', '2019-01-23 02:45:06', 7, 8, 0),
(4, 'niloofar it is neda with id 6', '2019-01-23 02:56:39', 7, 6, 0),
(5, 'fateme  ata how are you?\r\nmy id is 6. is it right?', '2019-01-23 02:58:07', 3, 6, 0),
(6, 'welcome dear neda:)', '2019-01-23 02:59:20', 11, 4, 0),
(7, 'comment for myself!', '2019-01-23 03:03:19', 3, 4, 0),
(8, 'I am Happy too!', '2019-01-23 03:12:33', 10, 4, 0),
(9, 'nilooooooofar thank you!', '2019-01-23 03:13:57', 6, 4, 0),
(10, 'i am a computer engineer too', '2019-01-23 03:15:16', 6, 4, 0),
(11, 'hi neda. how is it going?', '2019-01-23 03:17:27', 9, 4, 0),
(12, 'hi hi hi', '2019-01-23 03:17:58', 11, 4, 0),
(13, 'you write you name wrong!', '2019-01-23 03:21:10', 6, 4, 0),
(14, 'reply to niloo', '2019-01-23 03:21:50', 7, 4, 0),
(15, 'hi nilooofar!', '2019-01-23 03:23:02', 7, 4, 0),
(16, 'how much i write here!', '2019-01-23 03:24:22', 7, 4, 0),
(17, 'niloo niloo:)))', '2019-01-23 03:28:36', 7, 4, 0),
(18, 'come on dear! please be correct!', '2019-01-23 03:32:55', 7, 4, 0),
(19, 'i think it is true now!', '2019-01-23 03:33:26', 10, 4, 0),
(20, 'i think it is 8th comment for this post!', '2019-01-23 08:09:39', 7, 4, 1),
(21, 'is it for 7 post id too?', '2019-01-23 08:10:43', 7, 4, 1),
(22, 'this comment is for neda !', '2019-01-23 08:11:26', 11, 4, 0),
(23, 'this post id is 6!', '2019-01-23 08:12:38', 6, 4, 0),
(24, 'this post id is 7!', '2019-01-23 08:13:08', 7, 4, 1),
(25, 'it is 6 too', '2019-01-23 08:13:23', 6, 4, 0),
(26, 'new comment for niloofar in post 7.', '2019-01-23 08:59:50', 7, 4, 1),
(27, 'niloofar I am neda javan:)\r\nhow it going today?', '2019-01-23 09:01:45', 7, 6, 1),
(28, 'hello niloo!', '2019-01-24 12:43:28', 7, 6, 1),
(29, 'this is new comment!', '2019-01-24 03:34:41', 11, 6, 0),
(30, 'I am waiting for you, come soon', '2019-01-27 12:05:52', 12, 10, 3),
(31, 'you are late zeinab\r\n', '2019-01-27 12:07:08', 12, 10, 4),
(32, 'comment1\r\n', '2019-01-29 10:21:33', 34, 4, 1),
(33, 'comment2', '2019-01-29 10:21:45', 34, 4, 1),
(34, 'comment3', '2019-01-29 10:21:52', 34, 4, 1),
(35, 'comment4', '2019-01-29 10:22:00', 34, 4, 1),
(36, 'comment1', '2019-01-29 10:25:20', 12, 4, 0),
(37, 'comment2\r\n', '2019-01-29 10:25:27', 12, 4, 0),
(38, 'comment8', '2019-01-29 10:25:37', 12, 4, 0),
(39, 'comment4\r\n', '2019-01-29 10:26:28', 12, 4, 0),
(40, 'comment9', '2019-01-29 10:26:38', 12, 4, 0),
(41, 'comment10', '2019-01-29 10:26:47', 12, 4, 0),
(42, 'comment5', '2019-01-29 10:27:35', 10, 4, 0),
(43, 'comment6', '2019-01-29 10:27:47', 10, 4, 0),
(44, 'comment7', '2019-01-29 10:27:57', 10, 4, 0),
(45, 'comment5\r\n', '2019-01-29 10:29:12', 11, 4, 0),
(46, 'comment6', '2019-01-29 10:29:19', 11, 4, 0),
(47, 'comment7', '2019-01-29 10:29:26', 11, 4, 0),
(48, 'comment for this post\r\n', '2019-01-30 12:37:13', 45, 4, 0),
(49, 'good luck!', '2019-01-30 12:37:59', 13, 4, 0),
(50, 'goood!\r\n', '2019-01-30 01:24:51', 50, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE IF NOT EXISTS `comment_likes` (
  `comment_id` int(11) NOT NULL,
  `user_liked_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`,`user_liked_id`),
  KEY `user_liked_id` (`user_liked_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_likes`
--

INSERT INTO `comment_likes` (`comment_id`, `user_liked_id`) VALUES
(30, 4),
(31, 4),
(20, 8),
(21, 8),
(24, 8),
(26, 8),
(27, 8),
(28, 8),
(32, 8),
(33, 8),
(34, 8),
(35, 8);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `action_user_id` int(11) NOT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `user_id1` (`user_id1`),
  KEY `user_id2` (`user_id2`),
  KEY `user_action_id` (`action_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follow_id`, `user_id1`, `user_id2`, `action_user_id`) VALUES
(5, 6, 8, 6),
(13, 4, 9, 4),
(15, 8, 7, 8),
(16, 8, 9, 8),
(23, 9, 4, 9),
(28, 9, 8, 9),
(30, 9, 6, 9),
(31, 10, 8, 10),
(33, 10, 6, 10),
(37, 10, 9, 10),
(38, 10, 4, 10),
(39, 8, 6, 8),
(40, 4, 8, 4),
(41, 4, 10, 4),
(45, 11, 6, 11),
(46, 11, 8, 11);

-- --------------------------------------------------------

--
-- Table structure for table `hashtag`
--

CREATE TABLE IF NOT EXISTS `hashtag` (
  `hashtag_id` int(11) NOT NULL AUTO_INCREMENT,
  `hashtag_name` varchar(300) NOT NULL,
  `tweet_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`hashtag_id`),
  KEY `tweet_id` (`tweet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `hashtag`
--

INSERT INTO `hashtag` (`hashtag_id`, `hashtag_name`, `tweet_id`) VALUES
(1, 'id', 3),
(4, 'id', 2),
(10, 'project', 2),
(16, 'ONE', 2),
(22, 'color', 2),
(23, 'hiiiiii', 48),
(24, 'besttttt', 48),
(25, 'like', 49),
(26, 'a', 49),
(27, 'child', 49),
(28, 'beautiful', 50),
(29, 'day', 50),
(30, 'day', 51),
(31, 'now', 51),
(32, 'child', 52),
(33, 'gift', 52),
(34, 'best', 53),
(35, 'salammmm', 53);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `likes_tweet_id` int(11) NOT NULL,
  `likes_user_id` int(11) NOT NULL,
  PRIMARY KEY (`likes_tweet_id`,`likes_user_id`),
  KEY `likes_user_id` (`likes_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likes_tweet_id`, `likes_user_id`) VALUES
(6, 4),
(7, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(34, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 4),
(51, 4),
(52, 4),
(7, 8),
(34, 8),
(6, 10),
(7, 10),
(11, 10),
(12, 10),
(33, 10),
(34, 10),
(45, 10),
(48, 10);

-- --------------------------------------------------------

--
-- Table structure for table `mainhashtag`
--

CREATE TABLE IF NOT EXISTS `mainhashtag` (
  `hashtag_id` int(11) NOT NULL AUTO_INCREMENT,
  `hashtag_name` varchar(300) NOT NULL,
  PRIMARY KEY (`hashtag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `mainhashtag`
--

INSERT INTO `mainhashtag` (`hashtag_id`, `hashtag_name`) VALUES
(6, 'student'),
(7, 'ferdowsi'),
(8, 'hard'),
(9, 'hometown'),
(10, ''),
(11, 'nice'),
(12, 'nice'),
(13, 'Simple'),
(14, 'question'),
(15, 'GOOD'),
(16, 'morning'),
(17, 'honey'),
(18, 'become'),
(19, 'true'),
(20, 'test'),
(21, 'text'),
(22, 'test'),
(23, 'text'),
(24, 'hope'),
(25, 'kind'),
(26, 'success'),
(27, 'failure'),
(28, 'home'),
(29, 'php'),
(30, 'AI');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL,
  `post_content` varchar(500) NOT NULL,
  `post_datetime` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `replys`
--

CREATE TABLE IF NOT EXISTS `replys` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_content` varchar(300) NOT NULL,
  `reply_date` datetime DEFAULT NULL,
  `reply_comment_id` int(11) DEFAULT NULL,
  `reply_user_id` int(11) DEFAULT NULL,
  `reply_depth` int(11) NOT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `reply_comment_id` (`reply_comment_id`),
  KEY `reply_user_id` (`reply_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `replys`
--

INSERT INTO `replys` (`reply_id`, `reply_content`, `reply_date`, `reply_comment_id`, `reply_user_id`, `reply_depth`) VALUES
(1, 'hi fateme ata!', '2019-01-24 01:57:27', 25, 6, 0),
(2, 'hi fateme. thank you for your comment!', '2019-01-24 02:44:54', 22, 6, 0),
(3, 'second reply to fatemeata', '2019-01-24 02:53:30', 22, 6, 0),
(4, 'thanks. thanks:)', '2019-01-24 03:21:21', 6, 6, 0),
(5, 'reply5', '2019-01-29 10:22:13', 35, 4, 0),
(6, 'reply6', '2019-01-29 10:22:23', 35, 4, 0),
(7, 'reply7', '2019-01-29 10:22:34', 33, 4, 0),
(8, 'reply8', '2019-01-29 10:22:59', 34, 4, 0),
(9, 'reply9', '2019-01-29 10:23:09', 33, 4, 0),
(10, 'reply10', '2019-01-29 10:23:22', 32, 4, 0),
(11, 'reply3', '2019-01-29 10:23:57', 31, 4, 0),
(12, 'reply4\r\n', '2019-01-29 10:24:27', 30, 4, 0),
(13, 'reply5', '2019-01-29 10:24:59', 31, 4, 0),
(14, 'reply6', '2019-01-29 10:25:10', 30, 4, 0),
(15, 'reply3', '2019-01-29 10:27:16', 8, 4, 0),
(16, 'reply4', '2019-01-29 10:27:27', 19, 4, 0),
(17, 'reply8', '2019-01-29 10:28:06', 43, 4, 0),
(18, 'reply9', '2019-01-29 10:28:15', 43, 4, 0),
(19, 'reply10', '2019-01-29 10:28:24', 42, 4, 0),
(20, 'reply4', '2019-01-29 10:28:54', 22, 4, 0),
(21, 'reply8', '2019-01-29 10:29:36', 47, 4, 0),
(22, 'reply9', '2019-01-29 10:29:44', 46, 4, 0),
(23, 'reply10', '2019-01-29 10:29:52', 46, 4, 0),
(26, 'thank you so much!!!!!!!!!!!!!!!!:)', '2019-01-29 06:21:13', 3, 8, 0),
(27, 'yessssssss', '2019-01-30 01:25:48', 50, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
  `tweet_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_content` varchar(400) CHARACTER SET utf8mb4 NOT NULL,
  `tweet_date` datetime DEFAULT NULL,
  `tweet_liked` int(11) NOT NULL,
  `tweet_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tweet_id`),
  KEY `tweet_user_id` (`tweet_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`tweet_id`, `tweet_content`, `tweet_date`, `tweet_liked`, `tweet_user_id`) VALUES
(2, 'this is first tweet in new table! yohooo!:)\n#hello', '2019-01-20 03:18:18', 0, 4),
(3, 'hello world.\r\n this is fateme ata:)', '2019-01-20 03:19:44', 0, 4),
(6, 'my name is comata. computer Engineering student! #computer#is#everything', '2019-01-22 11:21:24', 2, 8),
(7, 'now I am program a database for tweetNet\r\n', '2019-01-22 11:22:35', 3, 8),
(9, 'my name is neda\r\nI born in December', '2019-01-22 01:49:06', 1, 6),
(10, 'neda is happy to be here!:))', '2019-01-22 02:02:11', 1, 6),
(11, 'I am here :) #new_user #tweetnet', '2019-01-23 08:18:38', 2, 6),
(12, 'comeback to mashhad tomorrow!:)', '2019-01-25 05:53:42', 2, 9),
(13, 'master student in Ferdowsi university of Mashhad. #student #ferdowsi', '2019-01-26 10:54:15', 0, 10),
(14, 'ramezani new tweet!', '2019-01-26 11:54:34', 0, 10),
(15, 'tweet with hashtag\r\n#master', '2019-01-26 11:55:12', 0, 10),
(16, '#comeon #student #ferdowsi', '2019-01-26 11:56:07', 1, 10),
(17, 'it is a test text \r\n#hard', '2019-01-26 11:56:51', 1, 10),
(18, 'live in mashhad.\r\n#hometown', '2019-01-26 11:57:47', 1, 10),
(19, 'nothing new today.\r\n#boring_day\r\n#tired ', '2019-01-26 01:01:15', 5, 10),
(20, 'new#tweet new#mood', '2019-01-26 01:08:58', 0, 10),
(21, '#hi#friends', '2019-01-26 01:10:11', 0, 10),
(22, '#new#mood', '2019-01-26 01:11:12', 0, 10),
(23, '#boring#mood', '2019-01-26 01:13:26', 0, 10),
(24, 'hi every body!!!', '2019-01-26 01:14:51', 0, 10),
(33, 'niloofar karimi!\r\n#php #developer ', '2019-01-26 06:25:34', 1, 8),
(34, 'work in part software company\r\n#php #developer', '2019-01-26 06:26:16', 3, 8),
(36, 'it is a new test tweet \r\n#tweet \r\n#computer', '2019-01-28 07:31:55', 0, 4),
(37, '#impo #first', '2019-01-28 07:40:05', 0, 4),
(38, '#sec #null', '2019-01-28 07:41:01', 0, 4),
(39, '#id #post', '2019-01-28 07:42:02', 0, 4),
(40, '#ata #com', '2019-01-28 08:05:16', 0, 4),
(41, '#best #salam', '2019-01-28 08:07:00', 0, 4),
(42, '#man #narahatam', '2019-01-28 08:07:54', 0, 4),
(43, '#eye #green', '2019-01-28 08:09:29', 0, 4),
(45, 'tweet #ONE #TWO', '2019-01-28 08:31:53', 1, 4),
(46, '#color #red #blue', '2019-01-28 08:32:59', 1, 4),
(47, ' #salam #hi', '2019-01-29 11:54:25', 1, 4),
(48, 'its new tweet with hashtag\r\n#hiiiiii\r\n#besttttt', '2019-01-29 12:05:00', 2, 4),
(49, '#like #a #child', '2019-01-29 01:27:32', 1, 4),
(50, '#beautiful #day \r\nit is cloudy!', '2019-01-30 12:43:09', 0, 4),
(51, 'have you a great #day ?\r\nwhat are you doing #now?', '2019-01-30 12:44:07', 1, 4),
(52, 'my sister was a great #child today.\r\ni should give a #gift for her', '2019-01-30 12:46:46', 1, 4),
(53, 'new tweet \r\n#best\r\n#salammmm', '2019-01-30 01:19:49', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_mode` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_pquestion` varchar(300) NOT NULL,
  `user_panswer` varchar(300) DEFAULT NULL,
  `user_regdate` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`user_name`),
  UNIQUE KEY `email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_mode`, `user_name`, `user_email`, `user_password`, `user_pquestion`, `user_panswer`, `user_regdate`) VALUES
(4, 1, 'fatemeata', 'fa23.atayi@gmail.com', '4e7b271b4ccdb5cbebed5a6a7c942f79072f34fda0128ad629', 'food', 'pasta', '2019-01-07 13:27:05'),
(5, 0, 'ata23', 'abc@gmail.com', '4e7b271b4ccdb5cbebed5a6a7c942f79072f34fda0128ad629', 'book', 'factfullness', '2019-01-08 20:30:19'),
(6, 0, 'neda93', 'neda@yahoo.com', '4e7b271b4ccdb5cbebf740055cf607b3e307e4e44446a9d5a0', 'book', 'becomeing', '2019-01-09 21:00:03'),
(7, 0, 'comata', 'comata@gmail.com', '4e7b271b4ccdb5cbeb5d93ceb70e2bf5daa84ec3d0cd2c731a', 'book', 'daddy', '2019-01-10 02:07:38'),
(8, 2, 'niloofar', 'n.karimi@gmail.com', '4e7b271b4ccdb5cbebf740055cf607b3e307e4e44446a9d5a0', 'freind', 'neda', '2019-01-10 08:20:10'),
(9, 0, 'zeinab1374', 'z.k.1996@gmail.com', '4e7b271b4ccdb5cbebf740055cf607b3e307e4e44446a9d5a0', 'book', 'fire', '2019-01-25 09:22:29'),
(10, 0, 'fereshte.kalateshadi', 'ramezani@yahoo.com', '4e7b271b4ccdb5cbebed5a6a7c942f79072f34fda0128ad629', 'freind', 'batool', '2019-01-26 10:08:05'),
(11, 0, 'rezaee', 'rezaee@gmail.com', '4e7b271b4ccdb5cbebf740055cf607b3e307e4e44446a9d5a0', 'freind', 'mahnaz', '2019-01-30 01:04:20');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `block_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `block_ibfk_2` FOREIGN KEY (`user_id2`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_tweet_id`) REFERENCES `tweets` (`tweet_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `comment_likes_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`),
  ADD CONSTRAINT `comment_likes_ibfk_2` FOREIGN KEY (`user_liked_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`user_id2`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `follow_ibfk_3` FOREIGN KEY (`action_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `hashtag`
--
ALTER TABLE `hashtag`
  ADD CONSTRAINT `hashtag_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`tweet_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`likes_tweet_id`) REFERENCES `tweets` (`tweet_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`likes_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `replys`
--
ALTER TABLE `replys`
  ADD CONSTRAINT `replys_ibfk_1` FOREIGN KEY (`reply_comment_id`) REFERENCES `comments` (`comment_id`),
  ADD CONSTRAINT `replys_ibfk_2` FOREIGN KEY (`reply_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`tweet_user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
