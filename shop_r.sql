-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 28 2017 г., 22:31
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop_r`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(1, 'КОНСОЛИ', 1, 1),
(2, 'ИГРЫ НА PS4', 2, 1),
(3, 'ИГРЫ НА XBOX-one', 3, 1),
(4, 'ИГРЫ НА Nintendo', 4, 1),
(5, 'ИГРЫ НА PC', 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `availabillity` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '/template/images/home/no-image.jpg',
  `description` text NOT NULL,
  `code` int(11) NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `price`, `availabillity`, `brand`, `image`, `description`, `code`, `is_new`, `is_recommended`, `status`) VALUES
(3, 'PlayStation 4', 1, 666, 1, 'MrCon', '/template/images/home/product2.jpg', 'Console description...', 123, 1, 0, 1),
(4, 'Sims 5', 5, 656, 0, 'MrCon', '/template/images/home/product3.jpg', 'Description of game...', 123, 0, 0, 1),
(5, 'Last of us', 2, 99, 0, 'O&J', '/template/images/home/product4.jpg', 'Description of game...', 0, 0, 0, 1),
(6, 'Uncharted 4', 2, 86, 0, 'Noobus', '/template/images/home/product5.jpg', 'Description of game...', 0, 1, 1, 1),
(7, 'Fable Legends', 3, 49, 0, 'Denix', '/template/images/home/product6.jpg', 'Description of game...', 0, 0, 0, 1),
(8, 'Zelda', 4, 90, 1, 'Nyash', '/template/images/home/recommend1.jpg\r\n', 'Description of game...', 64754, 0, 1, 1),
(9, 'Dragon Age Inquisition', 3, 50, 1, 'Nyash', '/template/images/home/recommend2.jpg', 'Description of game...', 68894, 0, 1, 1),
(10, 'CS GO', 5, 111, 1, 'JapaneseMode', '/template/images/home/recommend3.jpg', 'Description of game...', 21894, 1, 1, 1),
(11, 'GTA 5', 5, 267, 1, 'JapaneseMode', '/template/images/home/girl1.jpg', 'Description of game...', 25754, 0, 1, 1),
(12, 'StarCraft 2', 5, 214, 1, 'JapaneseMode', '/template/images/home/girl2.jpg', 'Description of game...', 65754, 1, 1, 1),
(13, 'Mortal Combat X', 2, 400, 1, 'JapaneseMode', '/template/images/home/girl3.jpg', 'Description of game...', 88754, 1, 0, 1),
(14, 'XBOX one', 1, 19, 1, 'JapaneseMode', '/template/images/home/gallery2.jpg', 'Console description...', 8866754, 0, 0, 1),
(15, 'Until Dawn', 2, 999, 1, 'DolyaChibogangsta', '/template/images/home/15.jpg', 'Description of game...', 78453, 1, 1, 1),
(16, 'Watch Dogs', 5, 439, 1, 'SexShopChina', '/template/images/home/16.jpg', 'Description of game...', 70453, 0, 0, 1),
(17, 'Pacman', 5, 9.99, 1, 'WineChina', '/template/images/home/17.jpg', 'Description of game...', 55553, 0, 0, 1),
(21, 'Watch Dogs 2', 2, 42, 1, 'blka', '/template/images/home/21.jpg', 'Continue of Watch Dogs', 52523, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `products`, `date`, `status`) VALUES
(1, 'Romul', '+79999999900', 'this is test message', 0, '{\"16\":2,\"17\":2,\"12\":5}', '2017-03-21 19:06:25', 1),
(2, 'Bob2', '2345235462324', '222', 1, '{\"13\":2}', '2017-03-21 19:12:57', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Bob2', 'bob@cox.cox', '123456', ''),
(2, 'Jack', 'query@js.prog', 'qwerty', ''),
(3, 'lolka', 'soska@gig.chpok', '12345667', ''),
(9, 'hohol2', 'holr@yu.op', '1234567', ''),
(10, 'Roman', 'roseverov@gmail.com', 'arbuzik', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
