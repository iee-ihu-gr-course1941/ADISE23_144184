-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 03:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ludo_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `game_sessions`
--

CREATE TABLE `game_sessions` (
  `session_id` varchar(255) NOT NULL,
  `data` text DEFAULT NULL,
  `last_access` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_sessions`
--

INSERT INTO `game_sessions` (`session_id`, `data`, `last_access`) VALUES
('38rr4ajif0l13e81rc27epkeoq', 'redBoxArea|a:6:{i:0;s:4:\"0208\";i:1;s:4:\"0308\";i:2;s:4:\"0408\";i:3;s:4:\"0508\";i:4;s:4:\"0608\";i:5;s:4:\"0708\";}yellowBoxArea|a:6:{i:0;s:4:\"0908\";i:1;s:4:\"1008\";i:2;s:4:\"1108\";i:3;s:4:\"1208\";i:4;s:4:\"1308\";i:5;s:4:\"1408\";}redFirstPosition|s:4:\"0105\";yellowFirstPosition|s:4:\"1511\";redpieceNotInGame|a:0:{}yellowpieceNotInGame|a:0:{}redPositionsToMove|a:58:{i:0;s:4:\"0105\";i:1;s:4:\"0205\";i:2;s:4:\"0305\";i:3;s:4:\"0405\";i:4;s:4:\"0504\";i:5;s:4:\"0503\";i:6;s:4:\"0502\";i:7;s:4:\"0501\";i:8;s:4:\"0601\";i:9;s:4:\"0701\";i:10;s:4:\"0801\";i:11;s:4:\"0901\";i:12;s:4:\"1001\";i:13;s:4:\"1101\";i:14;s:4:\"1102\";i:15;s:4:\"1103\";i:16;s:4:\"1104\";i:17;s:4:\"1205\";i:18;s:4:\"1305\";i:19;s:4:\"1405\";i:20;s:4:\"1505\";i:21;s:4:\"1506\";i:22;s:4:\"1507\";i:23;s:4:\"1508\";i:24;s:4:\"1509\";i:25;s:4:\"1510\";i:26;s:4:\"1511\";i:27;s:4:\"1411\";i:28;s:4:\"1311\";i:29;s:4:\"1211\";i:30;s:4:\"1112\";i:31;s:4:\"1113\";i:32;s:4:\"1114\";i:33;s:4:\"1115\";i:34;s:4:\"1015\";i:35;s:4:\"0915\";i:36;s:4:\"0815\";i:37;s:4:\"0715\";i:38;s:4:\"0615\";i:39;s:4:\"0515\";i:40;s:4:\"0515\";i:41;s:4:\"0514\";i:42;s:4:\"0513\";i:43;s:4:\"0512\";i:44;s:4:\"0411\";i:45;s:4:\"0311\";i:46;s:4:\"0211\";i:47;s:4:\"0111\";i:48;s:4:\"0110\";i:49;s:4:\"0109\";i:50;s:4:\"0108\";i:51;s:4:\"0208\";i:52;s:4:\"0308\";i:53;s:4:\"0408\";i:54;s:4:\"0508\";i:55;s:4:\"0608\";i:56;s:4:\"0708\";i:57;s:2:\"-1\";}yellowPositionsToMove|a:57:{i:0;s:4:\"1511\";i:1;s:4:\"1411\";i:2;s:4:\"1311\";i:3;s:4:\"1211\";i:4;s:4:\"1112\";i:5;s:4:\"1113\";i:6;s:4:\"1114\";i:7;s:4:\"1115\";i:8;s:4:\"1015\";i:9;s:4:\"0915\";i:10;s:4:\"0815\";i:11;s:4:\"0715\";i:12;s:4:\"0615\";i:13;s:4:\"0515\";i:14;s:4:\"0514\";i:15;s:4:\"0513\";i:16;s:4:\"0512\";i:17;s:4:\"0411\";i:18;s:4:\"0311\";i:19;s:4:\"0211\";i:20;s:4:\"0111\";i:21;s:4:\"0110\";i:22;s:4:\"0109\";i:23;s:4:\"0108\";i:24;s:4:\"0107\";i:25;s:4:\"0106\";i:26;s:4:\"0105\";i:27;s:4:\"0205\";i:28;s:4:\"0305\";i:29;s:4:\"0405\";i:30;s:4:\"0504\";i:31;s:4:\"0503\";i:32;s:4:\"0502\";i:33;s:4:\"0501\";i:34;s:4:\"0601\";i:35;s:4:\"0701\";i:36;s:4:\"0801\";i:37;s:4:\"0901\";i:38;s:4:\"1001\";i:39;s:4:\"1101\";i:40;s:4:\"1102\";i:41;s:4:\"1103\";i:42;s:4:\"1104\";i:43;s:4:\"1205\";i:44;s:4:\"1305\";i:45;s:4:\"1405\";i:46;s:4:\"1505\";i:47;s:4:\"1506\";i:48;s:4:\"1507\";i:49;s:4:\"1508\";i:50;s:4:\"1408\";i:51;s:4:\"1308\";i:52;s:4:\"1208\";i:53;s:4:\"1108\";i:54;s:4:\"1008\";i:55;s:4:\"0908\";i:56;s:2:\"-1\";}last_result|i:2;turn|i:0;red1LatestPosition|s:4:\"1015\";yellow1LatestPosition|s:4:\"1511\";yellow2LatestPosition|s:4:\"0305\";red4LatestPosition|s:2:\"-1\";yellow4LatestPosition|s:0:\"\";yellow3LatestPosition|s:4:\"0106\";red2LatestPosition|s:0:\"\";player1score|i:11;player2score|i:1;', '2023-12-17 14:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `ludo_game_state`
--

CREATE TABLE `ludo_game_state` (
  `id` int(11) NOT NULL,
  `key_name` varchar(50) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ludo_game_state`
--

INSERT INTO `ludo_game_state` (`id`, `key_name`, `value`, `last_updated`) VALUES
(1, 'redBoxArea', 'a:6:{i:0;s:4:\"0208\";i:1;s:4:\"0308\";i:2;s:4:\"0408\";i:3;s:4:\"0508\";i:4;s:4:\"0608\";i:5;s:4:\"0708\";}', '2023-12-15 17:01:07'),
(2, 'yellowBoxArea', 'a:6:{i:0;s:4:\"0908\";i:1;s:4:\"1008\";i:2;s:4:\"1108\";i:3;s:4:\"1208\";i:4;s:4:\"1308\";i:5;s:4:\"1408\";}', '2023-12-15 17:01:08'),
(3, 'redFirstPosition', 's:4:\"0105\";', '2023-12-15 17:01:08'),
(4, 'yellowFirstPosition', 's:4:\"1511\";', '2023-12-15 17:01:08'),
(5, 'redpieceNotInGame', 'a:0:{}', '2023-12-15 17:01:09'),
(6, 'yellowpieceNotInGame', 'a:0:{}', '2023-12-15 17:01:09'),
(7, 'redPositionsToMove', 'a:58:{i:0;s:4:\"0105\";i:1;s:4:\"0205\";i:2;s:4:\"0305\";i:3;s:4:\"0405\";i:4;s:4:\"0504\";i:5;s:4:\"0503\";i:6;s:4:\"0502\";i:7;s:4:\"0501\";i:8;s:4:\"0601\";i:9;s:4:\"0701\";i:10;s:4:\"0801\";i:11;s:4:\"0901\";i:12;s:4:\"1001\";i:13;s:4:\"1101\";i:14;s:4:\"1102\";i:15;s:4:\"1103\";i:16;s:4:\"1104\";i:17;s:4:\"1205\";i:18;s:4:\"1305\";i:19;s:4:\"1405\";i:20;s:4:\"1505\";i:21;s:4:\"1506\";i:22;s:4:\"1507\";i:23;s:4:\"1508\";i:24;s:4:\"1509\";i:25;s:4:\"1510\";i:26;s:4:\"1511\";i:27;s:4:\"1411\";i:28;s:4:\"1311\";i:29;s:4:\"1211\";i:30;s:4:\"1112\";i:31;s:4:\"1113\";i:32;s:4:\"1114\";i:33;s:4:\"1115\";i:34;s:4:\"1015\";i:35;s:4:\"0915\";i:36;s:4:\"0815\";i:37;s:4:\"0715\";i:38;s:4:\"0615\";i:39;s:4:\"0515\";i:40;s:4:\"0515\";i:41;s:4:\"0514\";i:42;s:4:\"0513\";i:43;s:4:\"0512\";i:44;s:4:\"0411\";i:45;s:4:\"0311\";i:46;s:4:\"0211\";i:47;s:4:\"0111\";i:48;s:4:\"0110\";i:49;s:4:\"0109\";i:50;s:4:\"0108\";i:51;s:4:\"0208\";i:52;s:4:\"0308\";i:53;s:4:\"0408\";i:54;s:4:\"0508\";i:55;s:4:\"0608\";i:56;s:4:\"0708\";i:57;s:2:\"-1\";}', '2023-12-15 17:01:09'),
(8, 'yellowPositionsToMove', 'a:57:{i:0;s:4:\"1511\";i:1;s:4:\"1411\";i:2;s:4:\"1311\";i:3;s:4:\"1211\";i:4;s:4:\"1112\";i:5;s:4:\"1113\";i:6;s:4:\"1114\";i:7;s:4:\"1115\";i:8;s:4:\"1015\";i:9;s:4:\"0915\";i:10;s:4:\"0815\";i:11;s:4:\"0715\";i:12;s:4:\"0615\";i:13;s:4:\"0515\";i:14;s:4:\"0514\";i:15;s:4:\"0513\";i:16;s:4:\"0512\";i:17;s:4:\"0411\";i:18;s:4:\"0311\";i:19;s:4:\"0211\";i:20;s:4:\"0111\";i:21;s:4:\"0110\";i:22;s:4:\"0109\";i:23;s:4:\"0108\";i:24;s:4:\"0107\";i:25;s:4:\"0106\";i:26;s:4:\"0105\";i:27;s:4:\"0205\";i:28;s:4:\"0305\";i:29;s:4:\"0405\";i:30;s:4:\"0504\";i:31;s:4:\"0503\";i:32;s:4:\"0502\";i:33;s:4:\"0501\";i:34;s:4:\"0601\";i:35;s:4:\"0701\";i:36;s:4:\"0801\";i:37;s:4:\"0901\";i:38;s:4:\"1001\";i:39;s:4:\"1101\";i:40;s:4:\"1102\";i:41;s:4:\"1103\";i:42;s:4:\"1104\";i:43;s:4:\"1205\";i:44;s:4:\"1305\";i:45;s:4:\"1405\";i:46;s:4:\"1505\";i:47;s:4:\"1506\";i:48;s:4:\"1507\";i:49;s:4:\"1508\";i:50;s:4:\"1408\";i:51;s:4:\"1308\";i:52;s:4:\"1208\";i:53;s:4:\"1108\";i:54;s:4:\"1008\";i:55;s:4:\"0908\";i:56;s:2:\"-1\";}', '2023-12-15 17:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `session_data`
--

CREATE TABLE `session_data` (
  `id` int(11) NOT NULL,
  `session_id` varchar(128) NOT NULL,
  `data_key` varchar(128) NOT NULL,
  `data_value` text DEFAULT NULL,
  `last_access` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_data`
--

INSERT INTO `session_data` (`id`, `session_id`, `data_key`, `data_value`, `last_access`) VALUES
(11, '3kfq2v146fb9ukekfdv9j4sh2l', 'turn', '1', '2023-12-16 09:21:09'),
(12, '3kfq2v146fb9ukekfdv9j4sh2l', 'last_result', '6', '2023-12-16 09:21:09'),
(25, '3lsmc6rod8sep8blemkq484t9i', 'turn', '1', '2023-12-16 09:26:25'),
(26, '3lsmc6rod8sep8blemkq484t9i', 'last_result', '6', '2023-12-16 09:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Player1', '12345678'),
(3, 'Player2', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_sessions`
--
ALTER TABLE `game_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `ludo_game_state`
--
ALTER TABLE `ludo_game_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_data`
--
ALTER TABLE `session_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_session_data` (`session_id`,`data_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ludo_game_state`
--
ALTER TABLE `ludo_game_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `session_data`
--
ALTER TABLE `session_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
