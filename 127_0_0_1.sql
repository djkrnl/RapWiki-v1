-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Sty 2022, 11:36
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `klienci`
--
CREATE DATABASE IF NOT EXISTS `klienci` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `klienci`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Nazwisko` varchar(40) NOT NULL,
  `Wiek` tinyint(3) UNSIGNED NOT NULL,
  `Panstwo` enum('Polska','Niemcy','Rosja','Szwecja') NOT NULL DEFAULT 'Polska',
  `Email` varchar(50) NOT NULL,
  `Zamowienie` set('C','CPP','Java','C#','HTML','CSS','XML','PHP','JavaScript') NOT NULL DEFAULT 'PHP',
  `Platnosc` enum('eurocard','visa','przelew') NOT NULL DEFAULT 'visa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`Id`, `Nazwisko`, `Wiek`, `Panstwo`, `Email`, `Zamowienie`, `Platnosc`) VALUES
(1, 'Szarapajew', 21, 'Polska', 'kornel.szarapajew@pollub.edu.pl', 'PHP', 'visa'),
(2, 'Szarapajew2', 43, 'Niemcy', 'kornel.2@pollub.edu.pl', 'HTML,CSS,XML', 'przelew'),
(12, 'Dfsfsfdf', 43, 'Polska', 'sdfs@fsdfsf.fdf', 'C#,CSS,XML', 'przelew');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logged_in_users`
--

CREATE TABLE `logged_in_users` (
  `sessionId` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `userName`, `fullName`, `email`, `passwd`, `status`, `date`) VALUES
(9, 'djkrnl', 'Kornel Szarapajew', 'kornel.szarapajew@pollub.edu.pl', '$2y$10$h1kjpndhSAGnypbjOrotjOKML7uysMXniY4dgA4JGmfRV0BS0QW9.', 1, '2021-11-26 00:00:00'),
(10, 'djkrnl2', 'Kornel Szarapajeww', 'kornel.2@pollub.edu.pl', '$2y$10$mqRmQwiMdzuOEy2qNvFaqusjczRAiTXGMUgJt9OQJZ0FPe7urI44u', 1, '2021-11-26 00:00:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  ADD PRIMARY KEY (`sessionId`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`,`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Baza danych: `laravel`
--
CREATE DATABASE IF NOT EXISTS `laravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `laravel`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `album_name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_date` date NOT NULL,
  `type` enum('album','ep','single') COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` set('trap','boombap','underground','abstract','jazz','lofi','experimental','industrial','drumless','gangsta','westcoast','eastcoast','emo','rock','cloud','house','hyphy','hardcore') COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `albums`
--

INSERT INTO `albums` (`id`, `user_id`, `album_name`, `release_date`, `type`, `genre`, `label`, `studio`, `description`, `created_at`, `updated_at`) VALUES
(15, 4, 'What a Time to Be Alive', '2015-09-20', 'album', 'trap', 'Young Money, Cash Money', NULL, 'What a Time to Be Alive to kolaboracyjny komercyjny mixtape autorstwa kanadyjskiego rapera Drake\'a i amerykańskiego rapera Future. Został wydany 20 września 2015 roku przez Young Money Entertainment, Cash Money Records, Republic Records, Epic Records, A1 Records i Freebandz. Mixtape został wyprodukowany wykonawczo przez Metro Boomin, który również wyprodukował lub współprodukował osiem z jego 11 piosenek. Dodatkowymi producentami są Southside, Allen Ritter, Boi-1da, 40 i inni. Został wydany w iTunes Store i Apple Music i zadebiutował na pierwszym miejscu amerykańskiego Billboard 200.', '2022-01-26 13:52:28', '2022-01-26 13:52:56');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `album_rapper`
--

CREATE TABLE `album_rapper` (
  `album_id` bigint(20) UNSIGNED NOT NULL,
  `rapper_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `album_rapper`
--

INSERT INTO `album_rapper` (`album_id`, `rapper_id`) VALUES
(15, 21),
(15, 22);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `album_tracks`
--

CREATE TABLE `album_tracks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `album_id` bigint(20) UNSIGNED NOT NULL,
  `track_nr` int(11) NOT NULL,
  `track_name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `track_length` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `album_tracks`
--

INSERT INTO `album_tracks` (`id`, `album_id`, `track_nr`, `track_name`, `track_length`, `created_at`, `updated_at`) VALUES
(170, 15, 1, 'Digital Dash', '3:51', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(171, 15, 2, 'Big Rings', '3:37', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(172, 15, 3, 'Live from the Gutter', '3:31', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(173, 15, 4, 'Diamonds Dancing', '5:14', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(174, 15, 5, 'Scholarships', '3:29', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(175, 15, 6, 'Plastic Bag', '3:22', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(176, 15, 7, 'I\'m The Plug', '3:00', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(177, 15, 8, 'Change Locations', '3:40', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(178, 15, 9, 'Jumpman', '3:25', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(179, 15, 10, 'Jersey', '3:08', '2022-01-26 13:52:57', '2022-01-26 13:52:57'),
(180, 15, 11, '30 for 30 Freestyle', '4:13', '2022-01-26 13:52:57', '2022-01-26 13:52:57');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, '(brak)', 'AA', NULL, NULL),
(2, 'Afganistan', 'AF', NULL, NULL),
(3, 'Albania', 'AL', NULL, NULL),
(4, 'Algeria', 'DZ', NULL, NULL),
(5, 'Andora', 'AD', NULL, NULL),
(6, 'Angola', 'AO', NULL, NULL),
(7, 'Anguilla', 'AI', NULL, NULL),
(8, 'Antarktyka', 'AQ', NULL, NULL),
(9, 'Antigua i Barbuda', 'AG', NULL, NULL),
(10, 'Arabia Saudyjska', 'SA', NULL, NULL),
(11, 'Argentyna', 'AR', NULL, NULL),
(12, 'Armenia', 'AM', NULL, NULL),
(13, 'Aruba', 'AW', NULL, NULL),
(14, 'Australia', 'AU', NULL, NULL),
(15, 'Austria', 'AT', NULL, NULL),
(16, 'Azerbejdżan', 'AZ', NULL, NULL),
(17, 'Bahamy', 'BS', NULL, NULL),
(18, 'Bahrajn', 'BH', NULL, NULL),
(19, 'Bangladesz', 'BD', NULL, NULL),
(20, 'Barbados', 'BB', NULL, NULL),
(21, 'Belgia', 'BE', NULL, NULL),
(22, 'Belize', 'BZ', NULL, NULL),
(23, 'Benin', 'BJ', NULL, NULL),
(24, 'Bermudy', 'BM', NULL, NULL),
(25, 'Bhutan', 'BT', NULL, NULL),
(26, 'Białoruś', 'BY', NULL, NULL),
(27, 'Boliwia', 'BO', NULL, NULL),
(28, 'Bonaire, Sint Eustatius i Saba', 'BQ', NULL, NULL),
(29, 'Botswana', 'BW', NULL, NULL),
(30, 'Bośnia i Hercegowina', 'BA', NULL, NULL),
(31, 'Brazylia', 'BR', NULL, NULL),
(32, 'Brunei Darussalam', 'BN', NULL, NULL),
(33, 'Brytyjskie Terytorium Oceanu Indyjskiego', 'IO', NULL, NULL),
(34, 'Brytyjskie Wyspy Dziewicze', 'VG', NULL, NULL),
(35, 'Burkina Faso', 'BF', NULL, NULL),
(36, 'Burundi', 'BI', NULL, NULL),
(37, 'Bułgaria', 'BG', NULL, NULL),
(38, 'Chile', 'CL', NULL, NULL),
(39, 'Chiny', 'CN', NULL, NULL),
(40, 'Chorwacja', 'HR', NULL, NULL),
(41, 'Curaçao', 'CW', NULL, NULL),
(42, 'Cypr', 'CY', NULL, NULL),
(43, 'Czad', 'TD', NULL, NULL),
(44, 'Czarnogóra', 'ME', NULL, NULL),
(45, 'Czechy', 'CZ', NULL, NULL),
(46, 'Dalekie Wyspy Mniejsze Stanów Zjednoczonych', 'UM', NULL, NULL),
(47, 'Dania', 'DK', NULL, NULL),
(48, 'Demokratyczna Republika Konga', 'CD', NULL, NULL),
(49, 'Dominika', 'DM', NULL, NULL),
(50, 'Dominikana', 'DO', NULL, NULL),
(51, 'Dżibuti', 'DJ', NULL, NULL),
(52, 'Egipt', 'EG', NULL, NULL),
(53, 'Ekwador', 'EC', NULL, NULL),
(54, 'Erytrea', 'ER', NULL, NULL),
(55, 'Estonia', 'EE', NULL, NULL),
(56, 'Eswatini', 'SZ', NULL, NULL),
(57, 'Etiopia', 'ET', NULL, NULL),
(58, 'Falklandy', 'FK', NULL, NULL),
(59, 'Fidżi', 'FJ', NULL, NULL),
(60, 'Filipiny', 'PH', NULL, NULL),
(61, 'Finlandia', 'FI', NULL, NULL),
(62, 'Francja', 'FR', NULL, NULL),
(63, 'Francuskie Terytoria Południowe i Antarktyczne', 'TF', NULL, NULL),
(64, 'Gabon', 'GA', NULL, NULL),
(65, 'Gambia', 'GM', NULL, NULL),
(66, 'Georgia Południowa i Sandwich Południowy', 'GS', NULL, NULL),
(67, 'Ghana', 'GH', NULL, NULL),
(68, 'Gibraltar', 'GI', NULL, NULL),
(69, 'Grecja', 'GR', NULL, NULL),
(70, 'Grenada', 'GD', NULL, NULL),
(71, 'Grenlandia', 'GL', NULL, NULL),
(72, 'Gruzja', 'GE', NULL, NULL),
(73, 'Guam', 'GU', NULL, NULL),
(74, 'Guernsey', 'GG', NULL, NULL),
(75, 'Gujana Francuska', 'GF', NULL, NULL),
(76, 'Gujana', 'GY', NULL, NULL),
(77, 'Gwadelupa', 'GP', NULL, NULL),
(78, 'Gwatemala', 'GT', NULL, NULL),
(79, 'Gwinea Bissau', 'GW', NULL, NULL),
(80, 'Gwinea Równikowa', 'GQ', NULL, NULL),
(81, 'Gwinea', 'GN', NULL, NULL),
(82, 'Haiti', 'HT', NULL, NULL),
(83, 'Hiszpania', 'ES', NULL, NULL),
(84, 'Holandia', 'NL', NULL, NULL),
(85, 'Honduras', 'HN', NULL, NULL),
(86, 'Hong Kong', 'HK', NULL, NULL),
(87, 'Indie', 'IN', NULL, NULL),
(88, 'Indonezja', 'ID', NULL, NULL),
(89, 'Irak', 'IQ', NULL, NULL),
(90, 'Iran', 'IR', NULL, NULL),
(91, 'Irlandia', 'IE', NULL, NULL),
(92, 'Islandia', 'IS', NULL, NULL),
(93, 'Izrael', 'IL', NULL, NULL),
(94, 'Jamajka', 'JM', NULL, NULL),
(95, 'Japonia', 'JP', NULL, NULL),
(96, 'Jemen', 'YE', NULL, NULL),
(97, 'Jersey', 'JE', NULL, NULL),
(98, 'Jordan', 'JO', NULL, NULL),
(99, 'Kajmany', 'KY', NULL, NULL),
(100, 'Kambodża', 'KH', NULL, NULL),
(101, 'Kamerun', 'CM', NULL, NULL),
(102, 'Kanada', 'CA', NULL, NULL),
(103, 'Katar', 'QA', NULL, NULL),
(104, 'Kazachstan', 'KZ', NULL, NULL),
(105, 'Kenia', 'KE', NULL, NULL),
(106, 'Kirgistan', 'KG', NULL, NULL),
(107, 'Kiribati', 'KI', NULL, NULL),
(108, 'Kolumbia', 'CO', NULL, NULL),
(109, 'Komory', 'KM', NULL, NULL),
(110, 'Kongo', 'CG', NULL, NULL),
(111, 'Korea Południowa', 'KR', NULL, NULL),
(112, 'Korea Północna', 'KP', NULL, NULL),
(113, 'Kostaryka', 'CR', NULL, NULL),
(114, 'Kuba', 'CU', NULL, NULL),
(115, 'Kuwejt', 'KW', NULL, NULL),
(116, 'Laos', 'LA', NULL, NULL),
(117, 'Lesotho', 'LS', NULL, NULL),
(118, 'Liban', 'LB', NULL, NULL),
(119, 'Liberia', 'LR', NULL, NULL),
(120, 'Libia', 'LY', NULL, NULL),
(121, 'Lichtenstein', 'LI', NULL, NULL),
(122, 'Litwa', 'LT', NULL, NULL),
(123, 'Luksemburg', 'LU', NULL, NULL),
(124, 'Łotwa', 'LV', NULL, NULL),
(125, 'Macedonia', 'MK', NULL, NULL),
(126, 'Madagaskar', 'MG', NULL, NULL),
(127, 'Majotta', 'YT', NULL, NULL),
(128, 'Makao', 'MO', NULL, NULL),
(129, 'Malawi', 'MW', NULL, NULL),
(130, 'Malediwy', 'MV', NULL, NULL),
(131, 'Malezja', 'MY', NULL, NULL),
(132, 'Mali', 'ML', NULL, NULL),
(133, 'Malta', 'MT', NULL, NULL),
(134, 'Mariany Północne', 'MP', NULL, NULL),
(135, 'Maroko', 'MA', NULL, NULL),
(136, 'Martynika', 'MQ', NULL, NULL),
(137, 'Mauretania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Meksyk', 'MX', NULL, NULL),
(140, 'Mikronezja', 'FM', NULL, NULL),
(141, 'Mjanma', 'MM', NULL, NULL),
(142, 'Monako', 'MC', NULL, NULL),
(143, 'Mongolia', 'MN', NULL, NULL),
(144, 'Montserrat', 'MS', NULL, NULL),
(145, 'Mozambik', 'MZ', NULL, NULL),
(146, 'Mołdawia', 'MD', NULL, NULL),
(147, 'Namibia', 'NA', NULL, NULL),
(148, 'Nauru', 'NR', NULL, NULL),
(149, 'Nepal', 'NP', NULL, NULL),
(150, 'Niemcy', 'DE', NULL, NULL),
(151, 'Niger', 'NE', NULL, NULL),
(152, 'Nigeria', 'NG', NULL, NULL),
(153, 'Nikaragua', 'NI', NULL, NULL),
(154, 'Niue', 'NU', NULL, NULL),
(155, 'Norwegia', 'NO', NULL, NULL),
(156, 'Nowa Kaledonia', 'NC', NULL, NULL),
(157, 'Nowa Zelandia', 'NZ', NULL, NULL),
(158, 'Oman', 'OM', NULL, NULL),
(159, 'Pakistan', 'PK', NULL, NULL),
(160, 'Palau', 'PW', NULL, NULL),
(161, 'Palestyna', 'PS', NULL, NULL),
(162, 'Panama', 'PA', NULL, NULL),
(163, 'Papua Nowa Guinea', 'PG', NULL, NULL),
(164, 'Paragwaj', 'PY', NULL, NULL),
(165, 'Peru', 'PE', NULL, NULL),
(166, 'Pitcairn', 'PN', NULL, NULL),
(167, 'Polinezja Francuska', 'PF', NULL, NULL),
(168, 'Polska', 'PL', NULL, NULL),
(169, 'Portoryko', 'PR', NULL, NULL),
(170, 'Portugalia', 'PT', NULL, NULL),
(171, 'Republika Południowej Afryki', 'ZA', NULL, NULL),
(172, 'Republika Zielonego Przylądka', 'CV', NULL, NULL),
(173, 'Republika Środkowej Afryki', 'CF', NULL, NULL),
(174, 'Reunion', 'RE', NULL, NULL),
(175, 'Rosja', 'RU', NULL, NULL),
(176, 'Rumunia', 'RO', NULL, NULL),
(177, 'Rwanda', 'RW', NULL, NULL),
(178, 'Sahara Zachodnia', 'EH', NULL, NULL),
(179, 'Saint Kitts i Nevis', 'KN', NULL, NULL),
(180, 'Saint Lucia', 'LC', NULL, NULL),
(181, 'Saint Vincent i Grenadyny', 'VC', NULL, NULL),
(182, 'Saint-Barthélemy', 'BL', NULL, NULL),
(183, 'Saint-Martin', 'MF', NULL, NULL),
(184, 'Saint-Pierre i Miquelon', 'PM', NULL, NULL),
(185, 'Salwador', 'SV', NULL, NULL),
(186, 'Samoa Amerykańskie', 'AS', NULL, NULL),
(187, 'Samoa', 'WS', NULL, NULL),
(188, 'San Marino', 'SM', NULL, NULL),
(189, 'Senegal', 'SN', NULL, NULL),
(190, 'Serbia', 'RS', NULL, NULL),
(191, 'Seszele', 'SC', NULL, NULL),
(192, 'Sierra Leone', 'SL', NULL, NULL),
(193, 'Singapur', 'SG', NULL, NULL),
(194, 'Sint Maarten', 'SX', NULL, NULL),
(195, 'Somalia', 'SO', NULL, NULL),
(196, 'Sri Lanka', 'LK', NULL, NULL),
(197, 'Stany Zjednoczone', 'US', NULL, NULL),
(198, 'Sudan Południowy', 'SS', NULL, NULL),
(199, 'Sudan', 'SD', NULL, NULL),
(200, 'Surinam', 'SR', NULL, NULL),
(201, 'Svalbard i Jan Mayen', 'SJ', NULL, NULL),
(202, 'Syria', 'SY', NULL, NULL),
(203, 'Szwajcaria', 'CH', NULL, NULL),
(204, 'Szwecja', 'SE', NULL, NULL),
(205, 'Słowacja', 'SK', NULL, NULL),
(206, 'Słowenia', 'SI', NULL, NULL),
(207, 'Tadżykistan', 'TJ', NULL, NULL),
(208, 'Tajlandia', 'TH', NULL, NULL),
(209, 'Tajwan', 'TW', NULL, NULL),
(210, 'Tanzania', 'TZ', NULL, NULL),
(211, 'Timor Wschodni', 'TL', NULL, NULL),
(212, 'Togo', 'TG', NULL, NULL),
(213, 'Tokelau', 'TK', NULL, NULL),
(214, 'Tonga', 'TO', NULL, NULL),
(215, 'Trynidad i Tobago', 'TT', NULL, NULL),
(216, 'Tunezja', 'TN', NULL, NULL),
(217, 'Turcja', 'TR', NULL, NULL),
(218, 'Turkmenistan', 'TM', NULL, NULL),
(219, 'Turks i Caicos', 'TC', NULL, NULL),
(220, 'Tuvalu', 'TV', NULL, NULL),
(221, 'Uganda', 'UG', NULL, NULL),
(222, 'Ukraina', 'UA', NULL, NULL),
(223, 'Urugwaj', 'UY', NULL, NULL),
(224, 'Uzbekistan', 'UZ', NULL, NULL),
(225, 'Vanuatu', 'VU', NULL, NULL),
(226, 'Wallis i Futuna', 'WF', NULL, NULL),
(227, 'Watykan', 'VA', NULL, NULL),
(228, 'Wenezuela', 'VE', NULL, NULL),
(229, 'Wielka Brytania', 'GB', NULL, NULL),
(230, 'Wietnam', 'VN', NULL, NULL),
(231, 'Wybrzeże Kości Słoniowej', 'CI', NULL, NULL),
(232, 'Wyspa Bouveta', 'BV', NULL, NULL),
(233, 'Wyspa Bożego Narodzenia', 'CX', NULL, NULL),
(234, 'Wyspa Man', 'IM', NULL, NULL),
(235, 'Wyspa Norfolk', 'NF', NULL, NULL),
(236, 'Wyspa Świętej Heleny, Wyspa Wniebowstąpienia i Tristan da Cunha', 'SH', NULL, NULL),
(237, 'Wyspy Alandzkie', 'AX', NULL, NULL),
(238, 'Wyspy Cooka', 'CK', NULL, NULL),
(239, 'Wyspy Dziewicze Stanów Zjednoczonych', 'VI', NULL, NULL),
(240, 'Wyspy Heard i McDonalda', 'HM', NULL, NULL),
(241, 'Wyspy Kokosowe', 'CC', NULL, NULL),
(242, 'Wyspy Marshalla', 'MH', NULL, NULL),
(243, 'Wyspy Owcze', 'FO', NULL, NULL),
(244, 'Wyspy Salomona', 'SB', NULL, NULL),
(245, 'Wyspy Świętego Tomasza i Książęca', 'ST', NULL, NULL),
(246, 'Węgry', 'HU', NULL, NULL),
(247, 'Włochy', 'IT', NULL, NULL),
(248, 'Zambia', 'ZM', NULL, NULL),
(249, 'Zimbabwe', 'ZW', NULL, NULL),
(250, 'Zjednoczone Emiraty Arabskie', 'AE', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 2),
(14, '2019_08_19_000000_create_failed_jobs_table', 2),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(20, '2022_01_06_200227_create_countries_table', 3),
(25, '2022_01_04_222345_create_rappers_table', 4),
(35, '2022_01_11_145819_create_albums_table', 5),
(40, '2022_01_11_181810_create_album_tracks_table', 6),
(41, '2022_01_11_190322_create_album_rapper_table', 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rappers`
--

CREATE TABLE `rappers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rapper_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `birth_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_country` bigint(20) UNSIGNED NOT NULL,
  `death_date` date DEFAULT NULL,
  `death_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `death_country` bigint(20) UNSIGNED NOT NULL,
  `country` bigint(20) UNSIGNED NOT NULL,
  `occupation` set('rapper','producer','songwriter') COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` set('trap','boombap','underground','abstract','jazz','lofi','experimental','industrial','drumless','gangsta','westcoast','eastcoast','emo','rock','cloud','house','hyphy','hardcore') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('single','relationship','married','unknown') COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `rappers`
--

INSERT INTO `rappers` (`id`, `user_id`, `rapper_name`, `full_name`, `birth_date`, `birth_city`, `birth_country`, `death_date`, `death_city`, `death_country`, `country`, `occupation`, `genre`, `status`, `website`, `description`, `created_at`, `updated_at`) VALUES
(19, 1, '2Pac', 'Tupac Amaru Shakur', '1971-06-16', 'Nowy Jork', 199, '1996-09-13', 'Las Vegas', 197, 197, 'rapper,producer', 'boombap,lofi,industrial,drumless,gangsta,westcoast', 'single', NULL, 'Tupac Amaru Shakur, również 2Pac i Makaveli (ur. 16 czerwca 1971 w Nowym Jorku, zm. 13 września 1996 w Las Vegas) – amerykański raper, poeta, aktor i aktywista społeczny. W oficjalnych dokumentach został zapisany jako Lesane Parish Crooks. Dopiero gdy jego matka, Alice Faye Williams (po ślubie Afeni Shakur), poślubiła Lumumbę Abdula Shakura, otrzymał nowe imię Tupac Amaru (zob. Tupac Amaru II). Według Black Entertainment Television był najbardziej wpływowym raperem w historii, natomiast magazyn Rolling Stone umieścił go na 86. miejscu wśród 100 największych artystów wszech czasów.', '2022-01-25 14:06:03', '2022-01-26 15:48:35'),
(20, 2, 'Nas', 'Nasir bin Olu Dara Jones', '1973-09-14', 'Nowy Jork', 197, NULL, NULL, 1, 197, 'rapper', 'boombap,jazz,eastcoast', 'single', 'http://www.nasirjones.com/', 'Nas, również Nasty Nas lub Escobar, właśc. Nasir bin Olu Dara Jones (ur. 14 września 1973 w Nowym Jorku) – amerykański raper i aktor. Był członkiem zespołu The Firm. Słowo Nasir (jęz. arabski نصير) oznacza Wojownik.\r\n\r\nWspółpracował z takimi wykonawcami jak Lil Jon & the East Side Boyz, Wu-Tang Clan, Eminem Ja Rule, Ashanti, Jay-Z, Ludacris, Game, Busta Rhymes, Mary J. Blige, Jennifer Lopez, AZ, Foxy Brown, DJ Premier, Kelis, Puff Daddy, Dr. Dre, 50 Cent, DMX, Aaliyah, Olu Dara, Quan, Capone-N-Noreaga, Mobb Deep, Large Professor, R. Kelly, Damian Marley, K\'naan, Lauryn Hill, Rakim, Chris Brown, Amy Winehouse czy Korn.\r\n\r\n8 czerwca 2007 Nas wystąpił po raz pierwszy w Polsce w warszawskiej \"Stodole\".', '2022-01-26 13:30:46', '2022-01-26 13:30:46'),
(21, 2, 'Drake', 'Aubrey Drake Graham', '1986-10-24', 'Toronto', 102, NULL, NULL, 1, 197, 'rapper', 'trap', 'married', 'http://drakerelated.com/', 'Aubrey Drake Graham (ur. 24 października 1986) – kanadyjski raper, piosenkarz i aktor.\r\n\r\nRozpoczął karierę aktorską rolą Jimmy’ego Brooksa w serialu Degrassi: Nowe pokolenie. Przez długi czas był blisko związany z Young Money Entertainment, aż do czerwca 2009, kiedy to podpisał oficjalny kontrakt z wytwórnią. 15 czerwca 2010 ukazał się jego pierwszy album studyjny pt. Thank Me Later, który zadebiutował na szczycie Billboard 200, rozchodząc się w pierwszym tygodniu w 447 tys. kopii na terenie Stanów Zjednoczonych.\r\n\r\nZa minialbum So Far Gone otrzymał dwie nominacje do nagród Grammy. Podczas gali przyznano mu jedną statuetkę spośród przydzielonych mu nominacji. W 2013 zdobył nagrodę Grammy w kategorii „Najlepszy album rap/hip-hop” za płytę pt. Take Care.\r\n\r\nWspółpracował z wieloma artystami, takimi jak m.in. DJ Khaled, Young Money, Jay-Z, Kanye West, Eminem, Young Jeezy, Mary J. Blige, Timbaland, Birdman, Trey Songz czy Jamie Foxx. Poza tym był autorem tekstów do piosenek Jazza Cartiera, Bishopa Brigante\'a, Alicii Keys i Dr. Dre.', '2022-01-26 13:40:55', '2022-01-26 13:40:55'),
(22, 4, 'Future', 'Nayvadius DeMun Wilburn', '1983-11-20', 'Atlanta', 197, NULL, NULL, 1, 197, 'rapper,producer,songwriter', 'trap', 'married', 'http://futurefreebandz.com/', 'Future, właściwie Nayvadius DeMun Wilburn (ur. 20 listopada 1983 w Atlancie) – amerykański raper, piosenkarz, autor tekstów i producent muzyczny.', '2022-01-26 13:46:51', '2022-01-26 13:46:51'),
(23, 1, 'Raper', 'Raper Raper', '2022-01-01', NULL, 61, NULL, NULL, 1, 94, 'rapper,producer', 'jazz,lofi,gangsta,westcoast,cloud', 'relationship', NULL, 'fdgdfgdfggdfg', '2022-01-26 15:52:02', '2022-01-26 15:52:02');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'djkrnl', 'kornel.szarapajew@pollub.edu.pl', NULL, '$2y$10$3xaO4yy36ZPk7.A9lyQZFORop6gkUuamwEuYvgeTX7FXRki2mgK5S', NULL, '2022-01-04 20:00:24', '2022-01-25 13:08:54'),
(2, 'djkrnl2', 'krnlbeats@gmail.com', NULL, '$2y$10$z4MY8bamXCye7ioBd9MgneVg7499xKkq3pJbSNEidiGVgLMxZ2Vvm', NULL, '2022-01-09 16:17:18', '2022-01-09 16:17:18'),
(4, 'djkrnl3', 'krnl75313@gmail.com', NULL, '$2y$10$BjPZOk1QbDmEnOEmgvlRweIVlDiaSQ5pCo3HnCH3gmO8l9ammzfEq', NULL, '2022-01-26 13:44:23', '2022-01-26 13:44:23');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_foreign` (`user_id`);

--
-- Indeksy dla tabeli `album_rapper`
--
ALTER TABLE `album_rapper`
  ADD KEY `album_rapper_album_id_foreign` (`album_id`),
  ADD KEY `album_rapper_rapper_id_foreign` (`rapper_id`);

--
-- Indeksy dla tabeli `album_tracks`
--
ALTER TABLE `album_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_tracks_album_id_foreign` (`album_id`);

--
-- Indeksy dla tabeli `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeksy dla tabeli `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeksy dla tabeli `rappers`
--
ALTER TABLE `rappers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rappers_user_id_foreign` (`user_id`),
  ADD KEY `rappers_birth_country_foreign` (`birth_country`),
  ADD KEY `rappers_death_country_foreign` (`death_country`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `album_tracks`
--
ALTER TABLE `album_tracks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT dla tabeli `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT dla tabeli `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `rappers`
--
ALTER TABLE `rappers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `album_rapper`
--
ALTER TABLE `album_rapper`
  ADD CONSTRAINT `album_rapper_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `album_rapper_rapper_id_foreign` FOREIGN KEY (`rapper_id`) REFERENCES `rappers` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `album_tracks`
--
ALTER TABLE `album_tracks`
  ADD CONSTRAINT `album_tracks_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `rappers`
--
ALTER TABLE `rappers`
  ADD CONSTRAINT `rappers_birth_country_foreign` FOREIGN KEY (`birth_country`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rappers_death_country_foreign` FOREIGN KEY (`death_country`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rappers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Baza danych: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Zrzut danych tabeli `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"laravel\",\"table\":\"users\"},{\"db\":\"laravel\",\"table\":\"rappers\"},{\"db\":\"laravel\",\"table\":\"albums\"},{\"db\":\"laravel\",\"table\":\"album_tracks\"},{\"db\":\"laravel\",\"table\":\"album_rapper\"},{\"db\":\"laravel\",\"table\":\"album_track\"},{\"db\":\"laravel\",\"table\":\"countries\"},{\"db\":\"klienci\",\"table\":\"klienci\"},{\"db\":\"laravel\",\"table\":\"comments\"},{\"db\":\"laravel\",\"table\":\"personal_access_tokens\"}]');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Zrzut danych tabeli `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2022-01-27 10:36:21', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"pl\"}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indeksy dla tabeli `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indeksy dla tabeli `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indeksy dla tabeli `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indeksy dla tabeli `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indeksy dla tabeli `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indeksy dla tabeli `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indeksy dla tabeli `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indeksy dla tabeli `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indeksy dla tabeli `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indeksy dla tabeli `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indeksy dla tabeli `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indeksy dla tabeli `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indeksy dla tabeli `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indeksy dla tabeli `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indeksy dla tabeli `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indeksy dla tabeli `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indeksy dla tabeli `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Baza danych: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
