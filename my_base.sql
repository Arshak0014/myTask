-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 20 2020 г., 18:52
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `create_date`, `update_date`) VALUES
(1, 'SmartTV', '2020-03-17', '2020-03-17'),
(2, 'Smartphone', '2020-03-17', '2020-03-17'),
(3, 'Camera', '2020-03-17', '2020-03-17'),
(4, 'Photo apparat', '2020-03-17', '2020-03-17'),
(7, 'Blander', '2020-03-17', '2020-03-17'),
(8, 'Headphones', '2020-03-17', '2020-03-17'),
(9, 'Coffee-machine', '2020-03-17', '2020-03-17'),
(10, 'Micro-wave', '2020-03-17', '2020-03-17'),
(11, 'PC', '2020-03-17', '2020-03-17'),
(12, 'Notebook', '2020-03-17', '2020-03-17'),
(15, 'Laptop', '2020-03-18', '2020-03-18'),
(17, 'Tablet', '2020-03-18', '2020-03-18'),
(18, 'Camera', '2020-03-18', '2020-03-18');

-- --------------------------------------------------------

--
-- Структура таблицы `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `models`
--

INSERT INTO `models` (`id`, `categories_id`, `name`, `create_date`, `update_date`) VALUES
(2, 10, 'Philips', '2020-03-17', '2020-03-17'),
(3, 4, 'Canon', '2020-03-17', '2020-03-17'),
(4, 4, 'Nikon', '2020-03-17', '2020-03-17'),
(5, 2, 'Apple', '2020-03-17', '2020-03-17'),
(7, 2, 'Lenvo', '2020-03-17', '2020-03-17'),
(9, 7, 'Panasonic', '2020-03-17', '2020-03-17'),
(10, 8, 'Xiaomi', '2020-03-17', '2020-03-17'),
(11, 1, 'LG', '2020-03-17', '2020-03-17'),
(12, 1, 'Samsung', '2020-03-17', '2020-03-17'),
(13, 2, 'Samsung', '2020-03-17', '2020-03-17'),
(14, 1, 'Sony', '2020-03-17', '2020-03-17'),
(15, 8, 'Huawei', '2020-03-17', '2020-03-17'),
(16, 10, 'Toshiba', '2020-03-17', '2020-03-17'),
(17, 3, 'LG', '2020-03-17', '2020-03-17'),
(18, 2, 'Nokia', '2020-03-17', '2020-03-17'),
(20, 2, 'Blackberry', '2020-03-17', '2020-03-17'),
(21, 8, 'Apple', '2020-03-17', '2020-03-17'),
(22, 12, 'Xiaomi', '2020-03-17', '2020-03-17'),
(24, 12, 'Lenovo', '2020-03-17', '2020-03-17'),
(25, 11, 'Asus', '2020-03-17', '2020-03-17'),
(26, 8, 'Genius', '2020-03-17', '2020-03-17'),
(27, 2, 'Asus', '2020-03-18', '2020-03-18'),
(28, 2, 'Sony', '2020-03-18', '2020-03-18'),
(29, 15, 'Xiaomi', '2020-03-18', '2020-03-18'),
(30, 2, 'Xiaomi', '2020-03-18', '2020-03-18');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `models_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT NULL,
  `description` text,
  `price` int(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `categories_id`, `models_id`, `name`, `image_path`, `is_new`, `description`, `price`, `create_date`, `update_date`) VALUES
(3, 2, 20, 'Z20', 'Hydrangeas.jpg', 1, 'aaa fff hhh kkk lll', 230000, '2020-03-18', '2020-03-18'),
(5, 11, 7, 'Intel', 'Koala.jpg', 1, 'aaa fff hhh kkk lll', 230000, '2020-03-18', '2020-03-18'),
(9, 8, 27, 'Airdots', 'Hydrangeas.jpg', 1, 'aaa fff hhh kkk lll', 340000, '2020-03-18', '2020-03-18'),
(10, 15, 7, 'Air', 'Desert.jpg', 0, 'aaa fff hhh kkk lll', 50000, '2020-03-18', '2020-03-18'),
(12, 18, 24, 'Iphone X', 'Desert.jpg', 0, 'aaa fff hhh kkk lll', 50000, '2020-03-19', '2020-03-19'),
(17, 18, 4, 'Air', 'Lighthouse.jpg', 1, 'aaa fff hhh kkk lll', 230000, '2020-03-19', '2020-03-19');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `cookieKey` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `cookieKey`) VALUES
(1, 'admin', 'admin', 'j50e18p34y9c68c91k97b');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_id` (`categories_id`),
  ADD KEY `models_id` (`models_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`models_id`) REFERENCES `models` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
