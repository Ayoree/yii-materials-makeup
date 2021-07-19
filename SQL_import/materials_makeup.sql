-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `materials_makeup`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL COMMENT 'название категории'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Категория 1'),
(2, 'Категория 2'),
(3, 'Категория 3'),
(4, 'Категория 4');

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `id` int NOT NULL,
  `type` int NOT NULL DEFAULT '1' COMMENT 'тип материала',
  `category` int NOT NULL DEFAULT '1' COMMENT 'категория материала',
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'название материала',
  `author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'автор материала',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'описание материала'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id`, `type`, `category`, `name`, `author`, `description`) VALUES
(1, 1, 1, 'Материал с автором и описанием', 'Иванов Иван Иваныч', 'Lorem ipsum dolor sit amet.'),
(2, 2, 2, 'Материал без описания', 'Иванов Иван Иваныч', ''),
(3, 3, 3, 'Материал без автора', '', 'Lorem ipsum dolor sit amet.'),
(4, 3, 4, 'Материал без автора и описания', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `material_link`
--

CREATE TABLE `material_link` (
  `id` int NOT NULL,
  `material_id` int NOT NULL COMMENT 'id материала',
  `link_title` varchar(64) NOT NULL COMMENT 'подпись ссылки',
  `link_url` varchar(128) NOT NULL COMMENT 'url'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `material_link`
--

INSERT INTO `material_link` (`id`, `material_id`, `link_title`, `link_url`) VALUES
(1, 1, 'Ссылка на ВК', 'https://vk.com'),
(2, 1, '', 'https://vk.com'),
(3, 2, 'MVC паттерн (хабр)', 'https://habr.com/ru/post/150267/'),
(4, 2, 'Перепись кода на MVC', 'https://ru.stackoverflow.com/questions/1017034/Как-переписать-код-в-стиле-ООП'),
(5, 3, 'Yii Framework', 'https://www.yiiframework.com/'),
(9, 4, 'YouTube', 'https://www.youtube.com/');

-- --------------------------------------------------------

--
-- Структура таблицы `material_tag`
--

CREATE TABLE `material_tag` (
  `id` int NOT NULL,
  `material_id` int NOT NULL COMMENT 'id материала, к которому привзяан тег',
  `tag_id` int NOT NULL COMMENT 'id тега, который привязан к материалу'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `material_tag`
--

INSERT INTO `material_tag` (`id`, `material_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 10),
(4, 2, 3),
(5, 2, 4),
(6, 2, 10),
(7, 3, 5),
(8, 3, 6),
(9, 3, 10),
(10, 4, 7),
(11, 4, 8),
(12, 4, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название тега'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Тег 1'),
(2, 'Тег 2'),
(3, 'Тег 3'),
(4, 'Тег 4'),
(5, 'Тег 5'),
(6, 'Тег 6'),
(7, 'Тег 7'),
(8, 'Тег 8'),
(9, 'Тег 9'),
(10, 'Тег 10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_link`
--
ALTER TABLE `material_link`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_tag`
--
ALTER TABLE `material_tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `material_link`
--
ALTER TABLE `material_link`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `material_tag`
--
ALTER TABLE `material_tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
