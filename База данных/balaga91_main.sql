-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 31 2018 г., 15:01
-- Версия сервера: 5.7.20-19-beget-5.7.20-20-1-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `balaga91_main`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--
-- Создание: Мар 21 2018 г., 03:54
-- Последнее обновление: Мар 29 2018 г., 20:57
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(9) NOT NULL,
  `login` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `pass`) VALUES
(1, 'vadim', '0b221b903496747461afb38ee6604978');

-- --------------------------------------------------------

--
-- Структура таблицы `call_db`
--
-- Создание: Мар 19 2018 г., 14:16
-- Последнее обновление: Мар 31 2018 г., 12:00
--

DROP TABLE IF EXISTS `call_db`;
CREATE TABLE `call_db` (
  `id` int(9) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `type` varchar(32) NOT NULL,
  `data` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `call_db`
--

INSERT INTO `call_db` (`id`, `phone`, `ip`, `type`, `data`, `date`) VALUES
(72, '1', '145.255.21.136', 'call', 'Заявка на звонок!', '2018-03-31'),
(73, '1', '145.255.21.136', 'reserve', 'Отечественный автомобиль|suntek|0.5|Передние боковые стёкла', '2018-03-31');

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio`
--
-- Создание: Мар 17 2018 г., 13:00
-- Последнее обновление: Мар 31 2018 г., 11:50
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE `portfolio` (
  `id` int(9) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `name`) VALUES
(2, '3.jpg'),
(3, '4a7b214s-960.jpg'),
(4, '960.jpg'),
(5, '33689650.eqgf7a1zi9.900x1000.jpg'),
(6, '127050124.jpg'),
(7, 'd6effbes-960.jpg'),
(8, 'dedc2c8s-960.jpg'),
(9, 'Image185.jpg'),
(10, 'kartinkijane.ru-15021.jpg'),
(11, 'tonirovka-5.jpg'),
(12, 'wksrekskifyv2.jpg'),
(34, '5abe71c833895.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `price`
--
-- Создание: Мар 19 2018 г., 15:58
-- Последнее обновление: Мар 31 2018 г., 10:43
--

DROP TABLE IF EXISTS `price`;
CREATE TABLE `price` (
  `id` int(9) NOT NULL,
  `data` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `price`
--

INSERT INTO `price` (`id`, `data`) VALUES
(1, '1800,1600,1800,2000,2000,2500|400,800,800,800,800,800|1400,1400,1600,2000,2200,2200|1400,1400,1600,2000,2200,2200|1600,1600,1800,2000,2000,2000'),
(2, '1600,1600,1800,2000,2000,2500|800,800,800,800,800,800|800,1400,1600,2000,2200,2200|1250,1400,1600,2000,2200,2200|1250,1600,1800,2000,2000,2000'),
(3, '0,0,0,0,0,0|0,0,0,0,0,0|1200,0,0,0,0,0|0,0,0,0,0,0|1400,1400,0,0,0,0'),
(4, '0,0,0,0,0,0|0,0,0,0,0,0|1200,0,0,0,0,0|0,0,0,0,0,0|1400,1400,0,0,0,0'),
(5, '1600,1500,1800,1800,1800,2200|800,800,800,800,800,800|1200,1300,1500,1800,2000,2000|1200,1300,1500,1800,2000,2000|1500,1500,1800,1800,1800,1800'),
(6, '500,800');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--
-- Создание: Мар 17 2018 г., 07:18
-- Последнее обновление: Мар 27 2018 г., 12:43
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` int(9) NOT NULL,
  `id_order` int(9) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `img` varchar(32) NOT NULL,
  `name` varchar(128) NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `id_order`, `ip`, `img`, `name`, `text`, `date`, `status`) VALUES
(32, 52, '46.191.254.120', '5aacd4eb90533.jpg', 'Вечяслав', 'Бронировали стекла по кругу. Сделали скидку. За ценой не бежал, в приоритете было качество. Студией не ошибся. Все сделали на уровне', '2018-03-17', 1),
(33, 346, '46.191.254.120', '5aacd62a8d4f2.jpg', 'Константин', 'Спасибо большое. Все сделали быстро и качественно. Еще дали скидку 10% за заявку онлайн. Вообщем всем советую.', '2018-03-17', 1),
(34, 74, '46.191.254.120', 'none_img.jpg', 'Анастасия', 'Приехала, выбрала тонировку. Все сделали, очень довольна.', '2018-03-17', 1),
(35, 63, '46.191.254.120', 'none_img.jpg', 'Игорь', 'Обслуживание на высоте. Тонировали передние боковые стекла атермальной пленкой, остался  доволен. Даже показали на стенде, насколько сильно она защищает от тепловых и ультрафиолетовых лучей. ', '2018-03-17', 1),
(36, 54, '46.191.254.120', '5aacd6b38404d.jpg', 'Дмитрий ', 'Ребята очень оперативные, все сделали по высшему классу. Делал архитектурное тонирование.', '2018-03-17', 1),
(37, 436, '46.191.254.120', '5aacd6d30717a.jpg', 'Вадим', 'Молодцы. Делают свое дело качественно и быстро. Советую всем своим друзьям.', '2018-03-17', 1),
(38, 36, '46.191.254.120', '5aacd7108e232.jpg', 'Виктор', 'Ребята знают свое дело. Сделали скидку, о которой я даже не знал. Советую.', '2018-03-17', 1),
(43, 0, '188.162.196.222', 'none_img.jpg', 'Швед', 'Нелврбнлу', '2018-03-20', 1),
(44, 2, '145.255.21.66', '5aba3c8e1c4d5.jpg', '1', '3', '2018-03-27', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `call_db`
--
ALTER TABLE `call_db`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `call_db`
--
ALTER TABLE `call_db`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT для таблицы `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `price`
--
ALTER TABLE `price`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
