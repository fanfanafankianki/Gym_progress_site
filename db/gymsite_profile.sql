CREATE DATABASE IF NOT EXISTS pwrtrckr_profiles;
USE pwrtrckr_profiles;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Kwi 2023, 13:11
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `gymsitedatabase_final3`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `exercises`
--

CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `exercise_name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trainingdetails`
--

CREATE TABLE `trainingdetails` (
  `training_details_id` int(11) NOT NULL,
  `training_history_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `weight` smallint(200) NOT NULL,
  `reps` smallint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `traininghistory`
--

CREATE TABLE `traininghistory` (
  `training_history_id` int(11) NOT NULL,
  `training_with_exercises_id` int(11) NOT NULL,
  `training_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trainings`
--

CREATE TABLE `trainings` (
  `training_id` int(11) NOT NULL,
  `training_name` char(55) NOT NULL,
  `profile_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trainingwithexercises`
--

CREATE TABLE `trainingwithexercises` (
  `training_with_exercises_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `exercise_1` int(11) NOT NULL,
  `exercise_2` int(11) NOT NULL,
  `exercise_3` int(11) NOT NULL,
  `exercise_4` int(11) DEFAULT NULL,
  `exercise_5` int(11) DEFAULT NULL,
  `exercise_6` int(11) DEFAULT NULL,
  `exercise_7` int(11) DEFAULT NULL,
  `exercise_8` int(11) DEFAULT NULL,
  `exercise_9` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userprofiles`
--

CREATE TABLE `userprofiles` (
  `profile_id` int(11) NOT NULL,
  `profile_name` char(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indeksy dla tabeli `trainingdetails`
--
ALTER TABLE `trainingdetails`
  ADD PRIMARY KEY (`training_details_id`),
  ADD KEY `training_history_id` (`training_history_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indeksy dla tabeli `traininghistory`
--
ALTER TABLE `traininghistory`
  ADD PRIMARY KEY (`training_history_id`),
  ADD KEY `training_with_exercises_id` (`training_with_exercises_id`);

--
-- Indeksy dla tabeli `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indeksy dla tabeli `trainingwithexercises`
--
ALTER TABLE `trainingwithexercises`
  ADD PRIMARY KEY (`training_with_exercises_id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `exercise_1` (`exercise_1`),
  ADD KEY `exercise_2` (`exercise_2`),
  ADD KEY `exercise_3` (`exercise_3`),
  ADD KEY `exercise_4` (`exercise_4`),
  ADD KEY `exercise_5` (`exercise_5`),
  ADD KEY `exercise_6` (`exercise_6`),
  ADD KEY `exercise_7` (`exercise_7`),
  ADD KEY `exercise_8` (`exercise_8`),
  ADD KEY `exercise_9` (`exercise_9`);

--
-- Indeksy dla tabeli `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `trainingdetails`
--
ALTER TABLE `trainingdetails`
  MODIFY `training_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `traininghistory`
--
ALTER TABLE `traininghistory`
  MODIFY `training_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `trainings`
--
ALTER TABLE `trainings`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `trainingwithexercises`
--
ALTER TABLE `trainingwithexercises`
  MODIFY `training_with_exercises_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `userprofiles`
--
ALTER TABLE `userprofiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `trainingdetails`
--
ALTER TABLE `trainingdetails`
  ADD CONSTRAINT `trainingdetails_ibfk_1` FOREIGN KEY (`training_history_id`) REFERENCES `traininghistory` (`training_history_id`),
  ADD CONSTRAINT `trainingdetails_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`);

--
-- Ograniczenia dla tabeli `traininghistory`
--
ALTER TABLE `traininghistory`
  ADD CONSTRAINT `traininghistory_ibfk_1` FOREIGN KEY (`training_with_exercises_id`) REFERENCES `trainingwithexercises` (`training_with_exercises_id`);

--
-- Ograniczenia dla tabeli `trainings`
--
ALTER TABLE `trainings`
  ADD CONSTRAINT `trainings_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `userprofiles` (`profile_id`);

--
-- Ograniczenia dla tabeli `trainingwithexercises`
--
ALTER TABLE `trainingwithexercises`
  ADD CONSTRAINT `trainingwithexercises_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`training_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_10` FOREIGN KEY (`exercise_9`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_2` FOREIGN KEY (`exercise_1`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_3` FOREIGN KEY (`exercise_2`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_4` FOREIGN KEY (`exercise_3`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_5` FOREIGN KEY (`exercise_4`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_6` FOREIGN KEY (`exercise_5`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_7` FOREIGN KEY (`exercise_6`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_8` FOREIGN KEY (`exercise_7`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `trainingwithexercises_ibfk_9` FOREIGN KEY (`exercise_8`) REFERENCES `exercises` (`exercise_id`);

--
-- Ograniczenia dla tabeli `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD CONSTRAINT `userprofiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
