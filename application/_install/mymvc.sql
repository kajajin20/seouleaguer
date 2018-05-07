-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-08-14 05:47
-- 서버 버전: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mymvc`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `writer` varchar(20) NOT NULL,
  `wdate` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `title`, `content`, `writer`, `wdate`) VALUES
(1, 'mvc란 무언인가?', 'Model–view–controller (MVC) is a software architectural pattern for implementing user interfaces. It divides a given software application into three interconnected parts, so as to separate internal representations of information from the ways that information is presented to or accepted from the user.', 'mvc tester', '2014-08-14 06:11:22'),
(2, 'Model이란 무엇인가?', 'A model notifies its associated views and controllers when there has been a change in its state. This notification allows the views to produce updated output, and the controllers to change the available set of commands. In some cases an MVC implementation might instead be "passive," so that other components must poll the model for updates rather than being notified.', 'admin', '2014-08-14 03:10:08'),
(3, 'View란 무엇인가?', 'A view requests information from the model that it uses to generate an output representation to the user.', '관리자', '2014-08-14 02:01:05'),
(4, 'Controller란 무엇인가?', 'A controller can send commands to the model to update the model''s state (e.g., editing a document). It can also send commands to its associated view to change the view''s presentation of the model (e.g., by scrolling through a document).', '홍길동', '2014-08-14 02:06:09'),
(5, 'History of MVC pattern', 'MVC was one of the seminal insights in the early development of graphical user interfaces, and one of the first approaches to describe and implement software constructs in terms of their responsibilities.[9]\r\n\r\nTrygve Reenskaug introduced MVC into Smalltalk-76 while visiting Xerox Parc[10][11] in the 1970s. In the 1980s, Jim Althoff and others implemented a version of MVC for the Smalltalk-80 class library. It was only later, in a 1988 article in The Journal of Object Technology, that MVC was expressed as a general concept.[12]\r\n\r\nThe MVC pattern has subsequently evolved,[13] giving rise to variants such as HMVC, MVA, MVP, MVVM, and others that adapted MVC to different contexts.', '프로래머', '2014-08-14 03:13:06'),
(6, 'Search engine optimization', 'Search engine optimization (SEO) is the process of affecting the visibility of a website or a web page in a search engine''s "natural" or un-paid ("organic") search results. In general, the earlier (or higher ranked on the search results page), and more frequently a site appears in the search results list, the more visitors it will receive from the search engine''s users. SEO may target different kinds of search, including image search, local search, video search, academic search,[1] news search and industry-specific vertical search engines.\r\n\r\nAs an Internet marketing strategy, SEO considers how search engines work, what people search for, the actual search terms or keywords typed into search engines and which search engines are preferred by their targeted audience. Optimizing a website may involve editing its content, HTML and associated coding to both increase its relevance to specific keywords and to remove barriers to the indexing activities of search engines. Promoting a site to increase the number of backlinks, or inbound links, is another SEO tactic.\r\n\r\nThe plural of the abbreviation SEO can also refer to "search engine optimizers", those who provide SEO services.', '개발자', '2014-08-14 01:03:13'),
(7, 'What is the Rewrite engine?', 'A rewrite engine is software located in a Web application framework running on a Web server that modifies a web URL''s appearance. Many framework users have come to refer to this feature as a "Router". This modification is called URL rewriting. Rewritten URLs (sometimes known as short, pretty or fancy URLs, search engine friendly - SEF URLs, or slugs) are used to provide shorter and more relevant-looking links to web pages. The technique adds a layer of abstraction between the files used to generate a web page and the URL that is presented to the outside world.', 'Rewriter', '2014-08-14 01:05:18'),
(8, 'What is .htaccess?', 'A .htaccess (hypertext access) file is a directory-level configuration file supported by several web servers, that allows for decentralized management of web server configuration. They are placed inside the web tree, and are able to override a subset of the server''s global configuration for the directory that they are in, and all sub-directories.[1]\r\n\r\nThe original purpose of .htaccess—reflected in its name—was to allow per-directory access control, by for example requiring a password to access the content. Nowadays however, the .htaccess files can override many other configuration settings including content type and character set, CGI handlers, etc.', '아파치', '2014-08-14 03:06:09'),
(9, 'About Apache HTTP Server', 'he Apache HTTP Server, commonly referred to as Apache (/əˈpætʃiː/ ə-pa-chee), is a web server application notable for playing a key role in the initial growth of the World Wide Web.[3] Originally based on the NCSA HTTPd server, development of Apache began in early 1995 after work on the NCSA code stalled. Apache quickly overtook NCSA HTTPd as the dominant HTTP server, and has remained the most popular HTTP server in use since April 1996. In 2009, it became the first web server software to serve more than 100 million websites.[4]\r\n\r\nApache is developed and maintained by an open community of developers under the auspices of the Apache Software Foundation. Most commonly used on a Unix-like system,[5] the software is available for a wide variety of operating systems, including Unix, FreeBSD, Linux, Solaris, Novell NetWare, OS X, Microsoft Windows, OS/2, TPF, OpenVMS and eComStation. Released under the Apache License, Apache is open-source software.', '관리자', '2014-08-14 04:06:27'),
(10, 'What is PHP?', 'PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language. As of January 2013, PHP was installed on more than 240 million websites (39% of those sampled) and 2.1 million web servers.[4] Originally created by Rasmus Lerdorf in 1994,[5] the reference implementation of PHP (powered by the Zend Engine) is now produced by The PHP Group.[6] While PHP originally stood for Personal Home Page,[5] it now stands for PHP: Hypertext Preprocessor, which is a recursive acronym.[7]\r\n\r\nPHP code can be simply mixed with HTML code, or it can be used in combination with various templating engines and web frameworks. PHP code is usually processed by a PHP interpreter, which is usually implemented as a web server''s native module or a Common Gateway Interface (CGI) executable. After the PHP code is interpreted and executed, the web server sends resulting output to its client, usually in form of a part of the generated web page – for example, PHP code can generate a web page''s HTML code, an image, or some other data. PHP has also evolved to include a command-line interface (CLI) capability and can be used in standalone graphical applications.[8]', 'PHP', '2014-08-14 10:05:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
