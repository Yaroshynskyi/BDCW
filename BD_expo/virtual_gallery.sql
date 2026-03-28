-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Бер 28 2026 р., 03:57
-- Версія сервера: 10.4.32-MariaDB
-- Версія PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `virtual_gallery`
--

-- --------------------------------------------------------

--
-- Структура таблиці `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `years_of_life` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `artists`
--

INSERT INTO `artists` (`id`, `name`, `years_of_life`, `country`, `biography`, `image`) VALUES
(1, 'Леонардо да Вінчі', '1452 - 1519', 'Італія', 'Видатний італійський художник, вчений, винахідник епохи Високого Відродження.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Francesco_Melzi_-_Portrait_of_Leonardo.png/400px-Francesco_Melzi_-_Portrait_of_Leonardo.png'),
(2, 'Вінсент ван Гог', '1853 - 1890', 'Нідерланди', 'Нідерландський художник-постімпресіоніст, який є однією з найвідоміших і найвпливовіших фігур в історії західного мистецтва.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Vincent_van_Gogh_-_Self-Portrait_-_Google_Art_Project.jpg/400px-Vincent_van_Gogh_-_Self-Portrait_-_Google_Art_Project.jpg'),
(3, 'Клод Моне', '1840 - 1926', 'Франція', 'Один із засновників імпресіонізму, який присвятив життя передачі світла і повітря на полотні. Саме від його картини пішла назва всього стилю.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Claude_Monet_1899_Nadar_crop.jpg/400px-Claude_Monet_1899_Nadar_crop.jpg'),
(4, 'Сальвадор Далі', '1904 - 1989', 'Іспанія', 'Один з найвидатніших представників сюрреалізму, відомий своїми химерними, парадоксальними та сноподібними образами.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Salvador_Dal%C3%AD_1939.jpg/400px-Salvador_Dal%C3%AD_1939.jpg'),
(5, 'Пабло Пікассо', '1881 - 1973', 'Іспанія', 'Видатний іспанський художник, скульптор, один із засновників кубізму. За життя створив десятки тисяч робіт.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Pablo_picasso_1.jpg/400px-Pablo_picasso_1.jpg'),
(6, 'Міура Кентаро', '1966 - 2021', 'Японія', 'Видатний ілюстратор, майстер деталізованої графіки. Його роботи відрізняються неперевершеним рівнем штрихування, динаміки та глибоким опрацюванням темного фентезі.', 'https://upload.wikimedia.org/wikipedia/uk/3/3f/Kentaromiura.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `painting_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `painting_id`, `added_at`) VALUES
(9, 2, 2, '2026-03-28 01:47:43'),
(10, 2, 1, '2026-03-28 01:47:45');

-- --------------------------------------------------------

--
-- Структура таблиці `paintings`
--

CREATE TABLE `paintings` (
  `id` int(11) NOT NULL,
  `style_id` int(11) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `year_created` varchar(50) DEFAULT NULL,
  `technique` varchar(100) DEFAULT NULL,
  `dimensions` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `paintings`
--

INSERT INTO `paintings` (`id`, `style_id`, `artist_id`, `title`, `description`, `year_created`, `technique`, `dimensions`, `image`) VALUES
(1, 1, 1, 'Мона Ліза', 'Один з найвідоміших творів живопису у світі.', '1503-1519', 'Олія по дереву', '77 × 53 см', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg/400px-Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg'),
(2, 3, 2, 'Зоряна ніч', 'Один з найвідоміших творів Ван Гога, що зображує вид з вікна його кімнати в лікарні.', '1889', 'Олія на полотні', '73.7 × 92.1 см', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg/600px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg'),
(3, 2, 3, 'Враження. Схід сонця', 'Саме ця картина дала назву художньому напрямку \"імпресіонізм\". Моне зобразив порт Гавра в ранковому тумані.', '1872', 'Олія на полотні', '48 × 63 см', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/Monet_-_Impression%2C_Sunrise.jpg/600px-Monet_-_Impression%2C_Sunrise.jpg'),
(4, 5, 4, 'Постійність пам\'яті', 'Знамениті \"м\'які годинники\" Далі, що плавляться на тлі пустельного пейзажу. Вони символізують відносність часу та теорію Епштейна, яка надихнула художника.', '1931', 'Олія на полотні', '24 × 33 см', 'https://historia-arte.com/_/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpbSI6WyJcL2FydHdvcmtcL2ltYWdlRmlsZVwvbnljLTItMjY4LmpwZyIsInJlc2l6ZSwxNTAwfGZvcm1hdCx3ZWJwIl19.QS0RudqedbRUixY0Z0mD5kka__rAwLVT2U4XTH-dgFk.webp'),
(5, 4, 5, 'Герніка', 'Монументальне полотно, що відображає жахи війни та бомбардування іспанського міста Герніка. Написана в монохромній гамі.', '1937', 'Олія на полотні', '349 × 776 см', 'https://d7hftxdivxxvm.cloudfront.net/?height=2000&quality=80&resize_to=fit&src=https%3A%2F%2Fd32dm0rphc51dk.cloudfront.net%2Fxv2Kv6g8nocq9xATLvS3Vw%2Fnormalized.jpg&width=2000'),
(6, 7, 6, 'Гатс (Чорний Мечник)', 'Культова ілюстрація з твору \"Berserk\". Демонструє фірмовий стиль автора з філігранним опрацюванням обладунків, тіней та експресії головного героя.', '1989', 'Туш, перо, папір', 'Формат B4', 'https://upload.wikimedia.org/wikipedia/ru/b/b7/Berserk_Vol._1.png');

-- --------------------------------------------------------

--
-- Структура таблиці `styles`
--

CREATE TABLE `styles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `styles`
--

INSERT INTO `styles` (`id`, `name`) VALUES
(1, 'Відродження (Ренесанс)'),
(2, 'Імпресіонізм'),
(3, 'Постімпресіонізм'),
(4, 'Кубізм'),
(5, 'Сюрреалізм'),
(6, 'Романтизм'),
(7, 'Графіка та ілюстрація');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'user',
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`, `firstName`, `lastName`) VALUES
(1, 'Admin', 'admin', 'admin', 'Головний', 'Кукатор'),
(2, 'bert007', '1234', 'user', 'Бертольд', 'Палітрофарбович');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `painting_id` (`painting_id`);

--
-- Індекси таблиці `paintings`
--
ALTER TABLE `paintings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `style_id` (`style_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Індекси таблиці `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `paintings`
--
ALTER TABLE `paintings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`painting_id`) REFERENCES `paintings` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `paintings`
--
ALTER TABLE `paintings`
  ADD CONSTRAINT `paintings_ibfk_1` FOREIGN KEY (`style_id`) REFERENCES `styles` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `paintings_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
