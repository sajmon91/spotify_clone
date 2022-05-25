-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2022 at 10:12 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotify_clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Wu-Tang Hits', 2, 11, 'assets/images/artwork/8cewu.jpg'),
(2, 'Until the End of Time', 1, 3, 'assets/images/artwork/Untiltheend.jpg'),
(3, 'All Eyez on Me', 1, 3, 'assets/images/artwork/Alleyezonme.jpg'),
(4, 'Nobody Is Not Loved', 3, 10, 'assets/images/artwork/Solomun-Nobody-is-not-Loved-album-cover-art.jpg'),
(5, 'Moment of Truth', 4, 11, 'assets/images/artwork/Gangstarrmomentoftruth.jpg'),
(9, 'Space Diver', 8, 14, 'assets/images/artwork/artworks-000664055602-2l0uso-t500x500.jpg'),
(10, 'Exodus', 6, 9, 'assets/images/artwork/artworks-000178406505-4sjjjg-t500x500.jpg'),
(11, 'Californication', 7, 1, 'assets/images/artwork/230a2376cd09c21a460873a14b18da3c.jpg'),
(12, 'Illmatic', 5, 11, 'assets/images/artwork/IllmaticNas.jpg'),
(13, 'Endless', 11, 14, 'assets/images/artwork/71-Fn9COSDL._SL1200_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `artistPic` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `artistPic`) VALUES
(1, '2pac', 'assets/images/artists/2pac.jpg'),
(2, 'Wu-Tang Clan', 'assets/images/artists/wutangclan_tuc.jpg'),
(3, 'Solomun', 'assets/images/artists/klot_Solomun.jpg'),
(4, 'Gang Starr', 'assets/images/artists/gangstarr.jpg'),
(5, 'Nas', 'assets/images/artists/nass.jpeg'),
(6, 'Bob Marley', 'assets/images/artists/bob_marley_by_jamesf63-d4za6s2.jpg'),
(7, 'Red Hot Chili Peppers', 'assets/images/artists/red-hot-chili-peppers-band.jpg'),
(8, 'Boris Brejcha', 'assets/images/artists/Boris-Brejcha.jpg'),
(11, 'Tale Of Us', 'assets/images/artists/tale.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Rap'),
(4, 'R&B'),
(5, 'Classical'),
(6, 'Techno'),
(7, 'Jazz'),
(8, 'Country'),
(9, 'Reggae'),
(10, 'House'),
(11, 'Hip-Hop'),
(12, 'Heavy Metal'),
(14, 'Trance');

-- --------------------------------------------------------

--
-- Table structure for table `likedplaylists`
--

DROP TABLE IF EXISTS `likedplaylists`;
CREATE TABLE IF NOT EXISTS `likedplaylists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likedplaylists`
--

INSERT INTO `likedplaylists` (`id`, `userId`, `playlistId`) VALUES
(8, 1, 3),
(3, 2, 6),
(4, 2, 1),
(9, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likedsongs`
--

DROP TABLE IF EXISTS `likedsongs`;
CREATE TABLE IF NOT EXISTS `likedsongs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_song` int(11) NOT NULL,
  `dateLiked` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likedsongs`
--

INSERT INTO `likedsongs` (`id`, `id_user`, `id_song`, `dateLiked`) VALUES
(32, 1, 7, '2021-12-24 10:28:29'),
(28, 1, 14, '2021-12-22 12:07:04'),
(8, 1, 1, '2021-12-10 00:00:00'),
(39, 1, 23, '2022-01-09 16:05:29'),
(12, 1, 2, '2021-12-22 04:00:00'),
(31, 1, 6, '2021-12-24 10:27:56'),
(18, 2, 2, '2021-12-22 00:00:00'),
(34, 3, 15, '2021-12-29 18:49:29'),
(38, 1, 11, '2022-01-06 13:58:07'),
(23, 1, 15, '2021-12-22 14:00:00'),
(26, 1, 13, '2021-12-22 16:00:00'),
(30, 1, 5, '2021-12-24 10:27:09'),
(33, 2, 13, '2021-12-29 18:39:37'),
(40, 2, 38, '2022-01-10 10:52:51'),
(41, 1, 42, '2022-01-10 10:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
CREATE TABLE IF NOT EXISTS `playlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `playlistImg` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '246x0w.png',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `userId`, `dateCreated`, `playlistImg`) VALUES
(1, 'my playlist', 1, '2021-12-20', 'unnamed.jpg'),
(5, 'new playlist', 2, '2021-12-21', '246x0w.png'),
(3, 'demo play', 2, '2021-12-20', 'Maxomatic-Covid-Playlist-Cover-WEB.jpg'),
(14, 'bb', 1, '2022-01-03', 'unCover.jpg'),
(17, 'pp', 21, '2022-01-10', 'cfbd763e30cdc5612a74c5234892dd40.jpg'),
(18, 'deep', 3, '2022-01-10', '2ffad0bcb495250c6a3b873daf207bbb07c630c8_hq.jpg'),
(19, 'ss', 3, '2022-01-10', 'Infinity-by-Wolfclub.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

DROP TABLE IF EXISTS `playlistsongs`;
CREATE TABLE IF NOT EXISTS `playlistsongs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(1, 12, 1, 1),
(2, 13, 1, 2),
(3, 14, 1, 3),
(7, 5, 1, 4),
(8, 6, 1, 5),
(18, 1, 1, 11),
(11, 9, 1, 6),
(12, 11, 1, 7),
(17, 15, 1, 10),
(15, 2, 1, 9),
(16, 1, 3, 1),
(19, 14, 3, 2),
(20, 13, 5, 1),
(27, 45, 14, 3),
(28, 46, 14, 4),
(26, 15, 14, 2),
(25, 14, 14, 1),
(29, 47, 14, 5),
(30, 27, 14, 6),
(31, 24, 14, 7),
(32, 25, 14, 8),
(33, 26, 14, 9),
(34, 13, 14, 10),
(35, 12, 14, 11);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`, `video`) VALUES
(1, 'C.R.E.A.M.', 2, 1, 11, '4:01', 'assets/music/Wu-Tang Clan - C.R.E.A.M..mp3', 1, 126, 'https://www.youtube.com/embed/PBwAxmrE194'),
(2, 'Back In The Game', 2, 1, 11, '3:34', 'assets/music/Wu-Tang Clan - Back In The Game.mp3', 2, 99, NULL),
(3, 'Until the end of time', 1, 2, 3, '4:27', 'assets/music/2Pac - Until the end of time.mp3', 1, 81, NULL),
(4, 'Letter 2 My Unborn', 1, 2, 3, '3:55', 'assets/music/2Pac - Letter 2 My Unborn.mp3', 2, 103, 'https://www.youtube.com/embed/SPmNQmmMZ84'),
(5, 'Gravel Pit', 2, 1, 11, '4:30', 'assets/music/Wu-Tang Clan - Gravel Pit.mp3', 3, 88, 'https://www.youtube.com/embed/Of-lpfsBR8U'),
(6, 'Lesson Learned', 2, 1, 11, '3:22', 'assets/music/Wu-Tang Clan - Lesson Learned.mp3', 4, 102, 'https://www.youtube.com/embed/dy1dlm__GdY'),
(7, 'People Say', 2, 1, 11, '4:44', 'assets/music/Wu-Tang Clan - People Say ft. Redman.mp3', 5, 116, 'https://www.youtube.com/embed/iBViC-fEdm0'),
(8, 'Life Goes On', 1, 3, 3, '5:02', 'assets/music/2Pac - Life Goes On.mp3', 1, 10, NULL),
(9, 'Only God Can Judge Me', 1, 3, 3, '4:57', 'assets/music/2Pac - Only God Can Judge Me.mp3', 2, 13, NULL),
(10, 'California Love', 1, 3, 3, '4:45', 'assets/music/California Love (Original Version).mp3', 3, 19, 'https://www.youtube.com/embed/mwgZalAFNhM'),
(11, 'All Eyez On Me', 1, 3, 3, '5:08', 'assets/music/2Pac - All Eyez On Me.mp3', 4, 16, NULL),
(12, 'Around', 3, 4, 10, '6:59', 'assets/music/Solomun - Around [Solomun Vox Mix].mp3', 1, 18, NULL),
(13, 'The Way Back', 3, 4, 10, '7:26', 'assets/music/Solomun - The way back.mp3', 2, 25, NULL),
(14, 'Friends', 3, 4, 10, '9:07', 'assets/music/Solomun - Friends.mp3', 3, 27, NULL),
(15, 'Late Night', 3, 4, 10, '8:24', 'assets/music/Solomun - Late Night.mp3', 4, 40, NULL),
(17, 'Full Clip', 4, 5, 11, '3:41', 'assets/music/Gang Starr - Full Clip.mp3', 1, 3, 'https://www.youtube.com/embed/qmj1q67NDAk'),
(18, 'Moment Of Truth', 4, 5, 11, '4:07', 'assets/music/Moment Of Truth.mp3', 2, 1, NULL),
(22, 'Discipline', 4, 5, 11, '4:23', 'assets/music/Gang Starr, Total - Discipline.mp3', 3, 2, 'https://www.youtube.com/embed/Gs35GZEvXPc'),
(23, 'Family and Loyalty', 4, 5, 11, '4:34', 'assets/music/Gang Starr - Family and Loyalty (feat. J.Cole) [Official Audio].mp3', 4, 2, 'https://www.youtube.com/embed/iMsdzxuldQM'),
(24, 'Take it Smart', 8, 9, 14, '7:18', 'assets/music/Take It Smart.mp3', 1, 3, ''),
(25, 'Gravity', 8, 9, 14, '3:37', 'assets/music/Boris Brejcha - Gravity feat. Laura Korinth (Visualizer Video) [Ultra Music].mp3', 2, 3, ''),
(26, 'Space Diver', 8, 9, 14, '6:37', 'assets/music/Space Diver.mp3', 3, 3, ''),
(27, 'Purple Noise', 8, 9, 14, '8:55', 'assets/music/Boris Brejcha - Purple Noise (Original Mix).mp3', 4, 4, ''),
(28, 'Could You Be Loved', 6, 10, 9, '3:55', 'assets/music/Bob Marley - Could You Be Loved (HQ).mp3', 1, 3, ''),
(29, 'Exodus', 6, 10, 9, '7:25', 'assets/music/Bob Marley - Exodus [HQ Sound].mp3', 2, 1, ''),
(30, 'Is This Love', 6, 10, 9, '3:51', 'assets/music/Bob Marley - Is This Love.mp3', 3, 1, 'https://www.youtube.com/embed/69RdQFDuYPI'),
(31, 'One Love', 6, 10, 9, '2:45', 'assets/music/Bob Marley - One Love.mp3', 4, 1, ''),
(32, 'Jammin', 6, 10, 9, '3:20', 'assets/music/Bob Marley Jammin.mp3', 5, 2, ''),
(33, 'Three Little Birds', 6, 10, 9, '3:01', 'assets/music/Bob Marley- Three Little Birds (With Lyrics!).mp3', 6, 2, ''),
(34, 'Under The Bridge', 7, 11, 1, '4:27', 'assets/music/Red Hot Chili Peppers - Under The Bridge [Official Music Video].mp3', 1, 2, 'https://www.youtube.com/embed/GLvohMXgcBo'),
(35, 'Can\'t Stop', 7, 11, 1, '4:38', 'assets/music/Red Hot Chili Peppers - Can\'t Stop [Official Music Video].mp3', 2, 1, 'https://www.youtube.com/embed/8DyziWtkfBw'),
(36, 'Otherside', 7, 11, 1, '4:16', 'assets/music/Red Hot Chili Peppers - Otherside [Official Music Video].mp3', 3, 1, 'https://www.youtube.com/embed/rn_YodiJO6k'),
(37, 'Scar Tissue', 7, 11, 1, '3:41', 'assets/music/Red Hot Chili Peppers - Scar Tissue [Official Music Video].mp3', 4, 1, 'https://www.youtube.com/embed/mzJj5-lubeM'),
(38, 'Californication', 7, 11, 1, '5:21', 'assets/music/Red Hot Chili Peppers - Californication [Official Music Video].mp3', 5, 2, 'https://www.youtube.com/embed/YlUKcNNmywk'),
(39, 'N.Y. State of Mind', 5, 12, 11, '4:56', 'assets/music/Nas - N.Y. State of Mind (Official Audio).mp3', 1, 1, ''),
(40, 'Nas Is Like', 5, 12, 11, '3:58', 'assets/music/Nas - Nas Is Like (Official Video).mp3', 2, 1, 'https://www.youtube.com/embed/VC4ORS5n9Hg'),
(41, 'If I Ruled the World', 5, 12, 11, '4:44', 'assets/music/Nas - If I Ruled the World (Imagine That) (Official Audio) ft. Lauryn Hill.mp3', 3, 1, ''),
(42, 'The Message', 5, 12, 11, '3:54', 'assets/music/Nas - The Message.mp3', 4, 3, ''),
(43, 'The World Is Yours', 5, 12, 11, '4:08', 'assets/music/Nas - The World Is Yours (Official HD Video).mp3', 5, 2, 'https://www.youtube.com/embed/e5PnuIRnJW8'),
(44, 'Notte senza fine', 11, 13, 14, '6:28', 'assets/music/Notte senza fine (Kiasmos Remix).mp3', 1, 3, ''),
(45, 'Mystery', 11, 13, 14, '7:05', 'assets/music/Mystery (Tale Of Us & Mathame Remix).mp3', 2, 3, ''),
(46, 'Swallow', 11, 13, 14, '7:26', 'assets/music/Swallow (Tale Of Us Remix).mp3', 3, 3, ''),
(47, 'Hold Me To The Light', 11, 13, 14, '6:39', 'assets/music/Hold Me To The Light (Tale Of Us Remix).mp3', 4, 2, ''),
(48, 'Astral', 11, 13, 14, '6:43', 'assets/music/Tale Of Us & Mind Against - Astral.mp3', 5, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signUpDate` date NOT NULL,
  `profilePic` text COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`, `role`) VALUES
(1, 'sajmon91', 'Stefan', 'Simonovic', 'stefan.sajmon@gmail.com', '$2y$10$JYDiGUzEhcI6x2Dwf6WTceRRd9ZH2lxQB4LgyT8feNiSmKsUfrCqq', '2021-12-04', 'stefan.jpeg', 'admin'),
(2, 'demo1', 'Stefan', 'Demo', 'demo@gmail.com', '$2y$10$n7L1X7Douz5pwn4yCPX7X.IAPR.6s4irD.ZFI/2uA9AyFAOzpnWIm', '2021-12-04', 'image-placeholder.jpg', 'user'),
(3, 'demo10', 'Sara', 'Saric', 'demo10@gmail.com', '$2y$10$ovGieRfEiuM/7XyVHjXnQu1fUjQ8XOFD6sD7pSbz0pZRvyAy4Ut0u', '2021-12-04', 'michael-dam-mEZ3PoFGs_k-unsplash.jpg', 'user'),
(21, 'perica', 'Pera', 'PeriÄ‡', 'pera@gmail.com', '$2y$10$76S1NfXqYfJRn46pnbiK1uvH5zwtO0vMIhxS9XIHzCEmU/diLWLyi', '2022-01-10', 'user.png', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
