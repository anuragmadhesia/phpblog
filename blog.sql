-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2021 at 11:05 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `articleId` int(30) NOT NULL,
  `articleTitle` varchar(300) DEFAULT NULL,
  `articleSlug` text NOT NULL,
  `articleDescription` text DEFAULT NULL,
  `articleContent` longtext DEFAULT NULL,
  `articleDate` datetime DEFAULT NULL,
  `articleTags` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`articleId`, `articleTitle`, `articleSlug`, `articleDescription`, `articleContent`, `articleDate`, `articleTags`) VALUES
(2, 'The Boys Best Web Series', 'The-Boys-Best-Web-Series', 'The Boys is an American superhero streaming television series developed by Eric Kripke for Amazon Prime Video. Based on the comic book of the same name', '<h3><strong>They hate sups&nbsp;</strong></h3>\r\n<h6><strong>The Boys is an American superhero streaming television series developed by Eric Kripke for Amazon Prime Video. Based on the comic book of the same name</strong></h6>\r\n<p>&nbsp;</p>\r\n<p><em>The Boys is an American superhero streaming television series developed by Eric Kripke for Amazon Prime Video. Based on the comic book of the same nameThe Boys is an American superhero streaming television series developed by Eric Kripke for Amazon Prime Video. Based on the comic book of the same nameThe Boys is an American superhero streaming television series developed by Eric Kripke for Amazon Prime Video. Based on the comic book of the same nameThe Boys is an American superhero streaming television series developed by Eric Kripke for Amazon Prime Video. Based on the comic book of the same name</em></p>', '2021-06-03 17:05:19', 'boys,web series'),
(3, 'Karl-Heinz Urban a New Zealand actor.', 'Karl-Heinz-Urban-a-New-Zealand-actor', 'Karl-Heinz Urban (born 7 June 1972) is a New Zealand actor. His career began with appearances in New Zealand films and TV series such as Xena: Warrior Princess. His first Hollywood role was in the 2002 horror film Ghost Ship. Since then, he has appeared in many high-profile movies, including the second and third installments of The Lord of the Rings trilogy in the role of Éomer. He has also portrayed Leonard McCoy in the Star Trek reboot film series, Vaako in the Riddick film series, Judge Dredd in Dredd, and Skurge in Thor: Ragnarok. In 2013, he starred in the sci-fi series Almost Human. Since 2019, he has starred as Billy Butcher in Amazon\'s streaming television series The Boys.', '<p><strong>Karl-Heinz Urban</strong>&nbsp;(born 7 June 1972) is a&nbsp;<a title=\"New Zealand\" href=\"https://en.wikipedia.org/wiki/New_Zealand\">New Zealand</a>&nbsp;actor. His career began with appearances in New Zealand films and TV series such as&nbsp;<em><a title=\"The Lord of the Rings (film series)\" href=\"https://en.wikipedia.org/wiki/Xena:_Warrior_Princess\">Xena: Warrior Princess</a></em>. His first Hollywood role was in the 2002 horror film&nbsp;<em><a title=\"Ghost Ship (2002 film)\" href=\"https://en.wikipedia.org/wiki/Ghost_Ship_(2002_film)\">Ghost Ship</a></em>. Since then, he has appeared in many high-profile movies, including the second and third installments of&nbsp;<em><a title=\"\" href=\"https://en.wikipedia.org/wiki/The_Lord_of_the_Rings_(film_series)\">The Lord of the Rings</a></em>&nbsp;trilogy in the role of&nbsp;<a title=\"&Eacute;omer\" href=\"https://en.wikipedia.org/wiki/%C3%89omer\">&Eacute;omer</a>. He has also portrayed&nbsp;<a title=\"Leonard McCoy\" href=\"https://en.wikipedia.org/wiki/Leonard_McCoy\">Leonard McCoy</a>&nbsp;in the&nbsp;<a class=\"mw-redirect\" title=\"Star Trek (film series)\" href=\"https://en.wikipedia.org/wiki/Star_Trek_(film_series)\"><em>Star Trek</em>&nbsp;reboot film series</a>, Vaako in the&nbsp;<a title=\"\" href=\"https://en.wikipedia.org/wiki/The_Chronicles_of_Riddick_(franchise)\"><em>Riddick</em>&nbsp;film series</a>,&nbsp;<a title=\"Judge Dredd\" href=\"https://en.wikipedia.org/wiki/Judge_Dredd\">Judge Dredd</a>&nbsp;in&nbsp;<em><a title=\"Dredd\" href=\"https://en.wikipedia.org/wiki/Dredd\">Dredd</a></em>, and&nbsp;<a class=\"mw-redirect\" title=\"Skurge\" href=\"https://en.wikipedia.org/wiki/Skurge\">Skurge</a>&nbsp;in&nbsp;<em><a title=\"Thor: Ragnarok\" href=\"https://en.wikipedia.org/wiki/Thor:_Ragnarok\">Thor: Ragnarok</a></em>. In 2013, he starred in the sci-fi series&nbsp;<em><a title=\"Almost Human (TV series)\" href=\"https://en.wikipedia.org/wiki/Almost_Human_(TV_series)\">Almost Human</a></em>. Since 2019, he has starred as&nbsp;<a title=\"Billy Butcher\" href=\"https://en.wikipedia.org/wiki/Billy_Butcher\">Billy Butcher</a>&nbsp;in&nbsp;<a class=\"mw-redirect\" title=\"Prime Video\" href=\"https://en.wikipedia.org/wiki/Prime_Video\">Amazon\'s</a>&nbsp;<a title=\"Streaming television\" href=\"https://en.wikipedia.org/wiki/Streaming_television\">streaming television</a>&nbsp;series&nbsp;<em><a title=\"The Boys (2019 TV series)\" href=\"https://en.wikipedia.org/wiki/The_Boys_(2019_TV_series)\">The Boys</a></em>.<strong>Karl-Heinz Urban</strong>&nbsp;(born 7 June 1972) is a&nbsp;<a title=\"New Zealand\" href=\"https://en.wikipedia.org/wiki/New_Zealand\">New Zealand</a>&nbsp;actor. His career began with appearances in New Zealand films and TV series such as&nbsp;<em><a title=\"The Lord of the Rings (film series)\" href=\"https://en.wikipedia.org/wiki/Xena:_Warrior_Princess\">Xena: Warrior Princess</a></em>. His first Hollywood role was in the 2002 horror film&nbsp;<em><a title=\"Ghost Ship (2002 film)\" href=\"https://en.wikipedia.org/wiki/Ghost_Ship_(2002_film)\">Ghost Ship</a></em>. Since then, he has appeared in many high-profile movies, including the second and third installments of&nbsp;<em><a title=\"\" href=\"https://en.wikipedia.org/wiki/The_Lord_of_the_Rings_(film_series)\">The Lord of the Rings</a></em>&nbsp;trilogy in the role of&nbsp;<a title=\"&Eacute;omer\" href=\"https://en.wikipedia.org/wiki/%C3%89omer\">&Eacute;omer</a>. He has also portrayed&nbsp;<a title=\"Leonard McCoy\" href=\"https://en.wikipedia.org/wiki/Leonard_McCoy\">Leonard McCoy</a>&nbsp;in the&nbsp;<a class=\"mw-redirect\" title=\"Star Trek (film series)\" href=\"https://en.wikipedia.org/wiki/Star_Trek_(film_series)\"><em>Star Trek</em>&nbsp;reboot film series</a>, Vaako in the&nbsp;<a title=\"\" href=\"https://en.wikipedia.org/wiki/The_Chronicles_of_Riddick_(franchise)\"><em>Riddick</em>&nbsp;film series</a>,&nbsp;<a title=\"Judge Dredd\" href=\"https://en.wikipedia.org/wiki/Judge_Dredd\">Judge Dredd</a>&nbsp;in&nbsp;<em><a title=\"Dredd\" href=\"https://en.wikipedia.org/wiki/Dredd\">Dredd</a></em>, and&nbsp;<a class=\"mw-redirect\" title=\"Skurge\" href=\"https://en.wikipedia.org/wiki/Skurge\">Skurge</a>&nbsp;in&nbsp;<em><a title=\"Thor: Ragnarok\" href=\"https://en.wikipedia.org/wiki/Thor:_Ragnarok\">Thor: Ragnarok</a></em>. In 2013, he starred in the sci-fi series&nbsp;<em><a title=\"Almost Human (TV series)\" href=\"https://en.wikipedia.org/wiki/Almost_Human_(TV_series)\">Almost Human</a></em>. Since 2019, he has starred as&nbsp;<a title=\"Billy Butcher\" href=\"https://en.wikipedia.org/wiki/Billy_Butcher\">Billy Butcher</a>&nbsp;in&nbsp;<a class=\"mw-redirect\" title=\"Prime Video\" href=\"https://en.wikipedia.org/wiki/Prime_Video\">Amazon\'s</a>&nbsp;<a title=\"Streaming television\" href=\"https://en.wikipedia.org/wiki/Streaming_television\">streaming television</a>&nbsp;series&nbsp;<em><a title=\"The Boys (2019 TV series)\" href=\"https://en.wikipedia.org/wiki/The_Boys_(2019_TV_series)\">The Boys</a></em>.</p>', '2021-06-04 07:54:27', ''),
(4, 'we use', 'we-use-hhghjghj', 'We used another function to convert the title into an SEO friendly', '<p>We used another function to convert the title into SEO friendlyWe used another function to convert the title into SEO friendlyWe used another function to convert the title into SEO friendlyWe used another function to convert the title into SEO friendlyWe used another function to convert the title into SEO friendlyWe used another function to convert the title into SEO friendly</p>', '2021-06-04 15:07:02', NULL),
(5, 'son and father', 'son-and-father', 'the test div', '<p>n the code above . we created a demo list of blog recent post, categories and tags. We will add these thinks in later tutorials.<br />The sidebar file is ready.<br />Now, include the sidebar file in the index and show.php file of the blog folder.<br />Open the index file and add the line above the footer file (at line 50, inside the container div block)<br />Check the code below &ndash;n the code above . we created a demo list of blog recent post, categories and tags. We will add th<br />Now, include the sidebar file in the index and show.php file of the blog folder.<br />Open the index file and add the line above the footer file (at line 50, inside the container div block)<br />Check the code below &ndash;n the code above . we created a demo list of blog recent post, categories and tags. We will add these thinks in lathow.php file of the blog folder.<br />Open the index file and add the line above the footer file (at line 50, inside the container div block)<br />Check the code below &ndash;n the code above . we created a demo list of blog recent post, categories and tags. We will add these thinks in later tutorials.<br />The sidebar file is ready.<br />The sidebar file is ready.<br />Now, include the sidebar file in the index and show.php file of the blog folder.<br />Open the index file and add the line above the footer file (at line 50, inside the container div block)<br />Check the code below &ndash;n the code above . we created a demo list of blog recent post, categories and tags. We will add these thinks in later tutorials.<br />The sidebar file is ready.<br />Now, include the sidebar file in the index and show.php file of the blog folder.<br />Open the index file and add the line above the footer file (at line 50, inside the container div block)<br />Check the code below &ndash;</p>', '2021-06-04 18:08:40', 'my_life,the untold story,success'),
(6, 'Now, fetch and display the blog category in the HTML form', 'now-fetch-and-display-the-blog-category-in-the-html-form', 'Now, fetch and display the blog category in the HTML form.\r\nNow, fetch and display the blog category in the HTML form.\r\n', '<p>Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.<br />Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML form.Now, fetch and display the blog category in the HTML </p>', '2021-06-05 11:48:44', 'son and father,son,father');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(30) NOT NULL,
  `categoryName` varchar(300) NOT NULL,
  `categorySlug` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `categorySlug`) VALUES
(1, 'story', 'story'),
(2, 'poem', 'poem'),
(3, 'fact', 'fact');

-- --------------------------------------------------------

--
-- Table structure for table `cat_links`
--

CREATE TABLE `cat_links` (
  `Id` int(30) NOT NULL,
  `articleId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat_links`
--

INSERT INTO `cat_links` (`Id`, `articleId`, `categoryId`) VALUES
(20, 6, 1),
(22, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pageId` int(30) NOT NULL,
  `pageTitle` varchar(300) DEFAULT NULL,
  `pageSlug` varchar(300) DEFAULT NULL,
  `pageDescription` text DEFAULT NULL,
  `pageContent` text DEFAULT NULL,
  `pageKeywords` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageId`, `pageTitle`, `pageSlug`, `pageDescription`, `pageContent`, `pageKeywords`) VALUES
(1, 'page', 'page', 'page des', '<h3>page content</h3>', 'first,page');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(30) NOT NULL,
  `username` varchar(300) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`) VALUES
(1, 'admin', '0,6Rbsehdf.9I', 'admin@gmail.com'),
(3, 'abhi', '0,9BHzIAEyWN6', 'abhi_nahi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`articleId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `cat_links`
--
ALTER TABLE `cat_links`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `articleId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cat_links`
--
ALTER TABLE `cat_links`
  MODIFY `Id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pageId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
