-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 04 2021 г., 12:01
-- Версия сервера: 8.0.26-0ubuntu0.20.04.2
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cassoft`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `group_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `sendler_id` varchar(96) NOT NULL,
  `receiver_id` varchar(96) NOT NULL,
  `readed` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `group_id`, `title`, `text`, `sendler_id`, `receiver_id`, `readed`, `date_added`) VALUES
(1, 1, 'Сообщение', 'текст', '1', '2', 1, '2021-10-03 22:30:33'),
(2, 1, 'Message 2', 'sometext', '1', '2', 0, '2021-10-03 22:30:33'),
(3, 2, 'Уведомление', 'Уведомление', '1', '2', 0, '2021-10-03 22:30:33'),
(4, 1, 'Some', '123', '2', '1', 0, '2021-10-04 11:59:09');

-- --------------------------------------------------------

--
-- Структура таблицы `message_group`
--

CREATE TABLE `message_group` (
  `id` int NOT NULL,
  `parent_id` int NOT NULL,
  `group_title` varchar(46) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` int NOT NULL,
  `user_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `message_group`
--

INSERT INTO `message_group` (`id`, `parent_id`, `group_title`, `color`, `user_id`, `receiver_id`, `date_added`) VALUES
(1, 0, 'Основные', 0, 1, 2, '2021-10-03 15:23:51'),
(2, 0, 'Оповещения', 1, 1, 2, '2021-10-03 15:23:51');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(96) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `newsletter` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `status`, `name`, `email`, `phone`, `password`, `newsletter`) VALUES
(1, 1, 'test', 'test@test.ru', '123456', '123', 0),
(2, 1, 'User', 'user@user.ru', '123', '123', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_groups`
--

CREATE TABLE `user_groups` (
  `group_id` int NOT NULL,
  `name` varchar(96) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user_groups`
--

INSERT INTO `user_groups` (`group_id`, `name`, `description`, `user_id`) VALUES
(0, 'Пользователи', 'Простые пользователи', 3),
(1, 'Проверенные', 'Проверенные пользователи', 1),
(3, 'Администратор', 'Администратор', 1),
(4, 'Проверенные\r\n', 'Проверенные пользователи', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message_group`
--
ALTER TABLE `message_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `message_group`
--
ALTER TABLE `message_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `group_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
