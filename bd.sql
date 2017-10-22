-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.31-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win64
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных vk17
DROP DATABASE IF EXISTS `vk17`;
CREATE DATABASE IF NOT EXISTS `vk17` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `vk17`;


-- Дамп структуры для таблица vk17.Feedback
DROP TABLE IF EXISTS `Feedback`;
CREATE TABLE IF NOT EXISTS `Feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `task_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FeedbackUser` (`user_id`),
  KEY `FeedbackTask` (`task_id`),
  CONSTRAINT `FeedbackTask` FOREIGN KEY (`task_id`) REFERENCES `Task` (`id`),
  CONSTRAINT `FeedbackUser` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы vk17.Feedback: ~0 rows (приблизительно)
DELETE FROM `Feedback`;
/*!40000 ALTER TABLE `Feedback` DISABLE KEYS */;
INSERT INTO `Feedback` (`id`, `user_id`, `task_id`) VALUES
	(19, 68755234, 1);
/*!40000 ALTER TABLE `Feedback` ENABLE KEYS */;


-- Дамп структуры для таблица vk17.Task
DROP TABLE IF EXISTS `Task`;
CREATE TABLE IF NOT EXISTS `Task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `text` text,
  `date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `people_count` int(11) DEFAULT NULL,
  `take_count` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `TaskUser` (`user_id`),
  CONSTRAINT `TaskUser` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы vk17.Task: ~2 rows (приблизительно)
DELETE FROM `Task`;
/*!40000 ALTER TABLE `Task` DISABLE KEYS */;
INSERT INTO `Task` (`id`, `title`, `text`, `date`, `location`, `people_count`, `take_count`, `point`, `user_id`) VALUES
	(1, 'Какая то нужна помощь', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci, animi doloremque doloribus earum id maiores nam nemo pariatur perspiciatis quae, quam quisquam!', NULL, 'Калининский район', 5, 1, 1, 68755234),
	(2, 'Памагите срочна я витёк', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci, animi doloremque doloribus earum id maiores nam nemo pariatur perspiciatis quae, quam quisquam!', NULL, 'Калининский район', 5, 3, 1, 68755234);
/*!40000 ALTER TABLE `Task` ENABLE KEYS */;


-- Дамп структуры для таблица vk17.User
DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL,
  `completed` int(11) NOT NULL DEFAULT '0',
  `canceled` int(11) NOT NULL DEFAULT '0',
  `rep` int(11) NOT NULL DEFAULT '0',
  `point` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы vk17.User: ~1 rows (приблизительно)
DELETE FROM `User`;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` (`id`, `completed`, `canceled`, `rep`, `point`) VALUES
	(1, 0, 0, 0, 0),
	(68755234, 18, 16, 100, 40);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
