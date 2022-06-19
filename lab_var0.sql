-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 19 2022 г., 15:09
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lab_var0`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `ID_Authors` int(10) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`ID_Authors`, `name`) VALUES
(1, 'Рэй Брэдбери'),
(2, 'Джордж Оруэлл'),
(3, 'Газет Журнальный');

-- --------------------------------------------------------

--
-- Структура таблицы `book_authors`
--

CREATE TABLE `book_authors` (
  `FID_book` int(10) NOT NULL,
  `FID_Authors` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `book_authors`
--

INSERT INTO `book_authors` (`FID_book`, `FID_Authors`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `literature`
--

CREATE TABLE `literature` (
  `ID_Book` int(10) NOT NULL,
  `title` text DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `ISBN` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `number` text DEFAULT NULL,
  `publisher` text DEFAULT NULL,
  `literate` enum('Book','Journal','Newspaper') NOT NULL,
  `Fid_resourse` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `literature`
--

INSERT INTO `literature` (`ID_Book`, `title`, `quantity`, `ISBN`, `date`, `year`, `number`, `publisher`, `literate`, `Fid_resourse`) VALUES
(1, '451 градус по фарангейту', 250, '1-1-1-1-1-1', NULL, 1953, NULL, 'Ballantine Books', 'Book', 1),
(2, '1984', 250, '1-1-1-1-1-1', NULL, 1948, NULL, 'Секер та Ворберг', 'Book', 1),
(3, 'Какая-то газета', 5, '1-1-1-1-1-1', '2005-12-31', NULL, '1', 'Издательство', 'Newspaper', 3),
(4, 'Какой-то журнал', 15, '1-1-1-1-1-1', '2006-01-06', NULL, '1', 'Издательство', 'Journal', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `resourse`
--

CREATE TABLE `resourse` (
  `id_resourse` int(10) NOT NULL,
  `title_resourse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `resourse`
--

INSERT INTO `resourse` (`id_resourse`, `title_resourse`) VALUES
(1, 'Site'),
(2, 'MP4'),
(3, 'MP3'),
(1, 'Site'),
(2, 'MP4'),
(3, 'MP3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`ID_Authors`);

--
-- Индексы таблицы `literature`
--
ALTER TABLE `literature`
  ADD PRIMARY KEY (`ID_Book`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
