-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 24 2025 г., 01:38
-- Версия сервера: 5.7.24
-- Версия PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `Id_company` int(255) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Img_path` varchar(100) NOT NULL,
  `Info` text NOT NULL,
  `Id_author` int(255) UNSIGNED NOT NULL,
  `Trust` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `companies`
--

INSERT INTO `companies` (`Id_company`, `Name`, `Img_path`, `Info`, `Id_author`, `Trust`) VALUES
(1, 'WebCanape', 'WebCanape.png', 'Мы – компания, которая старается искать новые решения и предлагать рынку новые продукты в привычном для покупателя сегменте. Если мы не находим новых решений, тогда строим новую технологию, позволяющую создавать привычные продукты быстрее, лучше и дешевле.&#13;&#10;ТОП-30 Лучших студий Рунета&#13;&#10;ТОП-5 в России по количеству сайтов для малого бизнеса&#13;&#10;Сертифицированное агентство Яндекс. Директ&#13;&#10;Одна из главных наших ценностей — это команда. Сделать что-то действительно новое, полезное для общества — всегда сложно, а одному практически нереально. Человек так устроен, что в одиночку он подвержен своему настроению, а в команде — здравому смыслу. Люди в команде поддерживают друг друга, заряжают на работу. Одна из главных наших ценностей — это команда. Команда, в которой рождаются идеи и желание притворять их в жизнь.&#13;&#10;Мы используем свои возможности и создаем возможности для других. Мы смотрим, что происходит в мире и принимать в этом участие. Растем и развиваемся. Вместе с нами развиваются наши сотрудники. Присоединяйтесь', 1, 1),
(2, 'Ростелеком', 'rostelecom.png', '', 1, 1),
(3, 'Газпром', 'gasprom.png', '', 1, 1),
(4, '1С', '1c.png', '', 1, 1),
(5, 'Роснефть', 'Rusoil.png', '', 1, 1),
(6, 'Сбер', 'Sber.png', '', 1, 1),
(7, 'Фосагро', 'Phosagro.png', '', 1, 1),
(11, 'Лукойл', 'Лукойл.png', 'ssd', 1, 1),
(12, 'Магнит', 'Магнит.png', '1111', 1, 1),
(13, 'Норильский никель', 'НорильскийНикель.png', '1', 1, 1),
(14, 'Новатэк', 'Новатэк.png', '1111', 1, 1),
(15, 'Web', 'WebCanape.png', '11111', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `Id_review` int(255) UNSIGNED NOT NULL,
  `Id_user` int(255) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Id_company` int(255) UNSIGNED NOT NULL,
  `Review` text NOT NULL,
  `Trust` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`Id_review`, `Id_user`, `Name`, `Id_company`, `Review`, `Trust`) VALUES
(4, 5, 'David1', 1, 'да', 0),
(6, 1, 'David', 1, 'новое сообщение', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Id_user` int(255) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id_user`, `Name`, `Login`, `Password`, `Email`, `Role`) VALUES
(1, 'David', 'admin', '05ca786fa20027ea19d0ba0fdc131b5c', 'admin@mail.ru', 'admin'),
(5, 'David1', 'admin1', '05ca786fa20027ea19d0ba0fdc131b5c', 'admin@gmail.com', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`Id_company`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD KEY `Id_author` (`Id_author`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Id_review`),
  ADD KEY `Id_company` (`Id_company`),
  ADD KEY `Id_user` (`Id_user`),
  ADD KEY `Name` (`Name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_user`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `companies`
--
ALTER TABLE `companies`
  MODIFY `Id_company` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `Id_review` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id_user` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_ibfk_1` FOREIGN KEY (`Id_author`) REFERENCES `users` (`Id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_4` FOREIGN KEY (`Id_company`) REFERENCES `companies` (`Id_company`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_5` FOREIGN KEY (`Id_user`) REFERENCES `users` (`Id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_6` FOREIGN KEY (`Name`) REFERENCES `users` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
