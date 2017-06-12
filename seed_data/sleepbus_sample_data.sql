-- MySQL dump 10.16  Distrib 10.1.23-MariaDB, for Linux (x86_64)
--
-- Host: 172.17.0.4    Database: scrubbus
-- ------------------------------------------------------
-- Server version	10.1.23-MariaDB-1~jessie

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about_section`
--

DROP TABLE IF EXISTS `about_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `page_heading` varchar(300) NOT NULL,
  `intro_text` text NOT NULL,
  `description` text NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_quality` varchar(25) NOT NULL,
  `image_alt_title_text` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `page_type` enum('1','2') NOT NULL COMMENT 'Page type 1 stands for a separate page will be created and its content will be taken from this table and page type 2 stands for page will be sent to internal or external ulr',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_section`
--

LOCK TABLES `about_section` WRITE;
/*!40000 ALTER TABLE `about_section` DISABLE KEYS */;
INSERT INTO `about_section` VALUES (1,'2015-12-29 21:10:00','Page1','page heading','<p>asfas</p>','','','','','page1','2015-12-28 20:40:17','zeemoadmin',1,'1','1');
/*!40000 ALTER TABLE `about_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accessories`
--

DROP TABLE IF EXISTS `accessories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accessories_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessories`
--

LOCK TABLES `accessories` WRITE;
/*!40000 ALTER TABLE `accessories` DISABLE KEYS */;
INSERT INTO `accessories` VALUES (1,'Accessories 2 is displayed now','<p>&nbsp;asdfa asdf asdf</p>','','2013-03-07 17:36:00','zeemoadmin',2,'1'),(2,'adf as fasfdasdf','<p>&nbsp;asdf asdf asd f</p>','','2013-03-07 17:36:00','zeemoadmin',1,'1');
/*!40000 ALTER TABLE `accessories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accessories_brochures`
--

DROP TABLE IF EXISTS `accessories_brochures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessories_brochures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `accessories_id` int(11) NOT NULL,
  `brochure_file` varchar(255) NOT NULL,
  `brochure_title` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessories_brochures`
--

LOCK TABLES `accessories_brochures` WRITE;
/*!40000 ALTER TABLE `accessories_brochures` DISABLE KEYS */;
INSERT INTO `accessories_brochures` VALUES (1,'2013-03-08 06:06:59',2,'Rajesh_Ranjan.docx','Brochure1','1',1,'2013-03-07 17:38:38','zeemoadmin'),(2,'2013-03-08 06:07:35',1,'Rajesh_Ranjan1.docx','asdf asdfasdfasdf','1',1,'2013-03-07 17:38:32','zeemoadmin'),(3,'2013-03-08 06:08:12',1,'test.pdf',' asdfasdfasdf','1',2,'2013-03-07 17:38:31','zeemoadmin');
/*!40000 ALTER TABLE `accessories_brochures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_type`
--

DROP TABLE IF EXISTS `account_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_type`
--

LOCK TABLES `account_type` WRITE;
/*!40000 ALTER TABLE `account_type` DISABLE KEYS */;
INSERT INTO `account_type` VALUES (3,'2016-04-15 00:00:00','Individual',1,'1','2016-06-09 05:05:49','admin'),(4,'2016-06-04 00:00:00','Company',2,'1','2016-06-04 10:42:06','zeemoadmin'),(5,'2016-06-04 00:00:00','School',3,'1','2016-06-04 10:42:10','zeemoadmin');
/*!40000 ALTER TABLE `account_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_levels`
--

DROP TABLE IF EXISTS `admin_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_levels`
--

LOCK TABLES `admin_levels` WRITE;
/*!40000 ALTER TABLE `admin_levels` DISABLE KEYS */;
INSERT INTO `admin_levels` VALUES (1,'All','1','2013-01-24 16:09:53','admin','2012-12-10 19:53:15'),(2,'Admin Level','1','2016-08-03 05:13:38','zeemoadmin','2015-12-03 21:58:51');
/*!40000 ALTER TABLE `admin_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_modules`
--

DROP TABLE IF EXISTS `admin_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  `module_name` varchar(511) NOT NULL,
  `url` text NOT NULL,
  `home_page_icon` varchar(255) NOT NULL,
  `header_icon` varchar(255) NOT NULL,
  `left_menu_icon` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `help_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_modules`
--

LOCK TABLES `admin_modules` WRITE;
/*!40000 ALTER TABLE `admin_modules` DISABLE KEYS */;
INSERT INTO `admin_modules` VALUES (1,0,'2012-11-16 12:18:40','2016-04-29 20:24:12','zeemoadmin','Admin User','user','user.png','user.png','users.png','1',23,''),(6,0,'2012-11-16 15:24:10','2016-04-29 20:24:17','zeemoadmin','General Pages','generalpages','cms.png','cms.png','cms.png','1',2,''),(7,6,'2012-11-16 15:46:35','2014-05-22 20:52:44','zeemoadmin','Home Page','generalpages/homepage','','','','1',1,''),(8,0,'2012-11-16 17:40:57','2016-06-03 03:46:28','zeemoadmin','Common Settings','commonsettings','setting.png','common-settings.png','setting.png','1',14,''),(12,0,'2012-11-19 14:02:08','2016-04-29 20:24:12','zeemoadmin','Modules','modules','modules-home.png','modules-top.png','modules-left.png','1',24,''),(13,12,'2012-11-19 14:06:10','2014-05-20 23:35:06','zeemoadmin','Manage Modules','modules/manage','','','','1',1,''),(14,12,'2012-11-20 02:39:50','2014-05-20 23:35:06','zeemoadmin','Manage Submodules','modules/managesubmodules','','','','1',1,''),(15,1,'2012-11-25 14:11:44','2014-05-20 23:35:06','zeemoadmin','Add / Edit Level','user/addlevel','','','','1',1,''),(16,1,'2012-11-25 14:12:53','2014-05-20 23:35:06','zeemoadmin','Manage Levels','user/managelevels','','','','1',1,''),(17,1,'2012-11-25 14:13:40','2014-05-20 23:35:06','zeemoadmin','Add / Edit User','user/adduser','','','','1',1,''),(18,1,'2012-11-25 14:14:15','2014-05-20 23:35:06','zeemoadmin','Manage Users','user/manageusers','','','','1',1,''),(19,1,'2012-12-05 17:11:10','2014-05-20 23:35:06','zeemoadmin','Superadmin Section','user/superadmin','','','','1',1,''),(21,6,'2012-12-06 16:43:04','2015-12-10 20:27:58','zeemoadmin','Static Pages','generalpages/pagecontent','','','','1',2,''),(22,6,'2012-12-06 16:43:52','2016-03-30 17:23:21','zeemoadmin','Contact','generalpages/contact','','','','0',2,'<p>&nbsp;zcvZXczcAAsdasdSDASFDASD</p>'),(23,8,'2012-12-10 16:18:25','2014-12-04 17:03:00','zeemoadmin','Common Settings','commonsettings/setting','','','','1',1,''),(25,8,'2012-12-10 16:20:09','2016-03-30 17:24:11','zeemoadmin','Page Headings','commonsettings/pageheadings','','','','0',2,''),(26,0,'2012-12-12 10:36:40','2016-06-03 03:46:28','zeemoadmin','Manage Banners','banners','manage-banners-home.png','manage-banners-top.png','manage-bannersleft.png','0',9,''),(27,26,'2012-12-12 11:21:31','2014-05-20 23:35:06','zeemoadmin','Banner at a Glance','banners/banner-in-a-glance','','','','1',1,'<p><span style=\"color: rgb(128, 0, 0);\"><span style=\"background-color: rgb(255, 255, 255);\"><strong>You can manage your home page banners from this section</strong></span></span></p>\r\n<p>ROME: Google avoided about $2 billion in worldwide  <a href=\"http://economictimes.indiatimes.com/topic/income-taxes\" pg=\"asTopicL1\">income taxes</a> in 2011 by shifting $9.8 billion in revenues into a  <a href=\"http://economictimes.indiatimes.com/topic/Bermuda\" pg=\"asTopicL1\">Bermuda</a> shell company, almost double the total from three years before, filings show.</p>\r\n<p>By legally funneling profits from overseas subsidiaries into Bermuda,  which doesn\'t have a corporate income tax, Google cut its overall tax  rate almost to half. The amount moved to Bermuda is equivalent to about  80% of Google\'s total pretax profit in 2011.<br />\r\n<br />\r\nThe increase in  Google\'s revenues routed to Bermuda, disclosed in a November 21 filing  by a subsidiary in the Netherlands, could fuel the outrage spreading  across Europe and in the US over corporate tax dodging. Governments in  France, the UK, Italy and Australia are probing Google\'s tax avoidance  as they seek to boost revenue during economic doldrums.<br />\r\n<br />\r\nLast week, the European Union\'s executive body, the  <a href=\"http://economictimes.indiatimes.com/topic/European-Commission\" pg=\"asTopicL1\">European Commission</a>,  advised member states to create blacklists of tax havens and adopt  anti-abuse rules. Tax evasion and avoidance, which cost the  <a href=\"http://economictimes.indiatimes.com/topic/EU\" pg=\"asTopicL1\">EU</a>  e1 trillion ($1.3 trillion) a year, are &quot;scandalous&quot; and &quot;an attack on  the fundamental principle of fairness,&quot; Algirdas Semeta, the EC\'s  commissioner for  <a href=\"http://economictimes.indiatimes.com/topic/taxation\" pg=\"asTopicL1\">taxation</a>, said at a press conference in Brussels.<br />\r\n<br />\r\n&quot;The tax strategy of Google and other multinationals is a deep  embarrassment to governments around Europe,&quot; said Richard Murphy, an  accountant and director of Tax Research LLP in Norfolk, England. &quot;The  political awareness now being created in the UK, and to a lesser degree  elsewhere in Europe, is: It\'s us or them. People understand that if  Google doesn\'t pay, somebody else has to pay or services get cut.&quot;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Assange said to cheers from around 100 supporters that despite  spending half of 2012 holed up in the building it had been a &quot;huge year&quot;  in which his anti-secrecy website had released documents about Syria  and other topics.&nbsp;&quot;Next year will be equally busy. WikiLeaks has already  over one million documents being prepared to be released, documents  that affect every country in the world -- every country in this world,&quot;  he said to applause.</p>\r\n<p>&nbsp;</p>\r\n<p>The Australian former computer hacker thanked Ecuadorian president  Rafael Correa for granting him asylum and hit out at the United States  and other Western governments.&nbsp;&quot;True democracy is not the White House,  true democracy is not cameras, true democracy is the resistance of  people armed with the truth against lies from Tahrir to London,&quot; he  said.&nbsp;But the 41-year-old added that &quot;the door is open, and the door has  always been open, for anyone who wishes to speak to me&quot; to resolve the  situation.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>'),(28,0,'2012-12-13 14:51:44','2016-04-29 20:29:21','zeemoadmin','News','news','news.png','news.png','news.png','0',4,''),(29,28,'2012-12-13 14:52:35','2014-05-20 23:35:06','zeemoadmin','Add / Edit News','news/addnews','','','','1',1,''),(30,28,'2012-12-13 14:53:47','2014-05-20 23:35:06','zeemoadmin','Manage News','news/managenews','','','','1',1,''),(31,0,'2012-12-17 12:43:11','2016-04-29 20:24:12','zeemoadmin','Testimonials','testimonials','now-showing-home.png','now-showing-top.png','now-showing-left.png','0',22,''),(32,31,'2012-12-17 12:56:16','2014-05-20 23:35:06','zeemoadmin','Add Testimonial','testimonials/addtestimonial','','','','1',1,''),(33,31,'2012-12-17 12:57:40','2014-05-20 23:35:06','zeemoadmin','Manage Testimonials','testimonials/managetestimonials','','','','1',1,''),(35,0,'2012-12-18 12:54:48','2016-04-29 20:24:12','zeemoadmin','Meta / Title Tags','metatags','meta.png','meta.png','meta.png','1',17,''),(36,35,'2012-12-18 12:58:09','2016-04-04 18:06:57','zeemoadmin','Single Page Metas','metatags/single-page-metas','','','','1',2,''),(39,35,'2012-12-18 13:00:46','2016-04-04 18:06:53','zeemoadmin','News','metatags/news-metas','','','','0',3,''),(40,1,'2012-12-21 12:46:22','2014-05-20 23:35:06','zeemoadmin','Update Personal Account','user/updateaccount','','','','1',1,''),(41,28,'2013-01-21 10:35:19','2014-05-21 23:14:48','zeemoadmin','Manage Images','news/manageimages','','','','1',1,''),(42,28,'2013-01-21 10:36:12','2014-05-21 23:14:50','zeemoadmin','Manage Downloads','news/managedownloads','','','','1',1,''),(51,0,'2013-01-28 15:26:19','2016-04-29 20:24:12','zeemoadmin','Downloads','downloads','download.png','download.png','download.png','0',20,''),(52,51,'2013-01-28 15:26:59','2014-05-20 23:35:06','zeemoadmin','Categories','downloads/categories','','','','1',1,''),(53,51,'2013-01-28 15:27:51','2014-05-20 23:35:06','zeemoadmin','Manage Downloads','downloads/managedownloads','','','','1',1,''),(54,6,'2013-01-29 16:17:12','2016-03-30 17:23:25','zeemoadmin','Manage Images','generalpages/manageimages','','','','0',3,''),(55,6,'2013-01-29 16:17:50','2016-03-30 17:23:29','zeemoadmin','Manage Downloads','generalpages/managedownloads','','','','0',4,''),(63,26,'2013-02-05 14:08:58','2014-12-03 15:08:57','zeemoadmin','Services Banner','banners/service-banner','','','','0',1,''),(65,26,'2013-02-05 14:15:26','2014-12-03 15:08:59','zeemoadmin','Products Banner','banners/products-default-banner','','','','0',1,''),(66,0,'2013-02-05 15:41:10','2016-04-29 20:29:21','zeemoadmin','Products','products','product.png','product.png','product.png','0',5,'this is product section'),(67,66,'2013-02-05 15:47:10','2014-05-20 23:35:06','zeemoadmin','Add / Edit Category','products/add-category','','','','1',1,'add category section'),(68,66,'2013-02-05 15:47:55','2014-05-20 23:35:06','zeemoadmin','Manage Categories','products/manage-categories','','','','1',1,'this is manage categories section'),(70,26,'2013-02-07 10:54:13','2014-12-03 15:09:07','zeemoadmin','News Banner','banners/news-banner','','','','0',1,''),(71,35,'2013-02-07 14:39:57','2016-04-04 18:06:57','zeemoadmin','Products','metatags/product-default-metas','','','','0',4,''),(72,26,'2013-02-12 12:15:04','2014-05-20 23:35:06','zeemoadmin','Home Page Banners','banners/homepage','','','','1',1,''),(73,66,'2013-02-13 17:13:08','2014-05-20 23:35:06','zeemoadmin','Manage Products','products/manage-products','','','','1',1,'manage product section'),(75,66,'2013-02-26 15:53:36','2014-05-20 23:35:06','zeemoadmin','Copy Move Products','products/copy-move-products','','','','1',1,''),(76,8,'2013-03-05 15:51:36','2015-12-28 20:41:11','zeemoadmin','Lead Types','commonsettings/form-lead-types','','','','1',3,''),(78,66,'2013-03-07 15:55:15','2014-05-20 23:35:06','zeemoadmin','Top Text','products/toptext','','','','1',1,''),(80,0,'2013-03-11 10:30:27','2016-04-29 20:24:12','zeemoadmin','Leads Report','leads','leads-report.png','leads-report.png','leads-report.png','1',21,''),(81,80,'2013-03-11 10:31:44','2016-04-07 15:35:09','zeemoadmin','Leads Report','leads/leads-report','','','','1',1,''),(82,80,'2013-03-11 10:32:35','2016-04-07 15:35:07','zeemoadmin','Leads Source','leads/leads-source','','','','1',2,''),(83,0,'2013-05-03 15:52:05','2016-04-29 20:24:12','zeemoadmin','Blog Section','blogs','blogs.png','blogs.png','blogs.png','1',16,''),(84,83,'2013-05-03 15:55:29','2016-04-11 16:39:45','zeemoadmin','Add Blog','blogs/add-blog','','','','1',2,''),(85,83,'2013-05-03 15:56:08','2016-04-11 16:39:45','zeemoadmin','Manage Blogs','blogs/manage-blogs','','','','1',3,''),(86,83,'2013-05-03 15:56:56','2016-04-11 16:39:45','zeemoadmin','Add Category','blogs/add-category','','','','1',3,''),(87,83,'0000-00-00 00:00:00','2016-04-11 16:39:45','zeemoadmin','Add Blogger','blogs/add-blogger','','','','1',3,''),(88,35,'2013-05-06 10:22:04','2016-04-04 18:06:57','zeemoadmin','Blogs','metatags/blog-default-metas','','','','1',6,''),(89,8,'2013-09-26 16:33:18','2016-03-30 17:24:10','zeemoadmin','Social Media Icons','commonsettings/social-media-icon','','','','0',4,''),(90,0,'2014-03-14 15:49:55','2016-04-29 20:24:12','zeemoadmin','Zeemo Settings','zeemosettings','setting.png','common-settings.png','setting.png','1',25,''),(91,90,'2014-03-14 15:53:40','2015-06-04 18:47:50','zeemoadmin','Resource','zeemosettings/resource','','','','1',2,''),(96,0,'2014-05-22 18:43:04','2016-04-29 20:24:12','zeemoadmin','Manage CTA','cta','cta-home.png','cta.png','cta-left.png','1',15,''),(97,96,'2014-05-22 18:45:56','2016-04-04 18:02:48','zeemoadmin','Add / Edit CTA','cta/icon-setting','','','','1',2,''),(98,96,'2014-05-22 18:46:31','2016-04-04 18:02:13','zeemoadmin','Single Pages','cta/single-pages','','','','1',4,''),(99,96,'2014-05-22 18:54:26','2016-04-04 18:02:48','zeemoadmin','Blog Pages','cta/blog-default-cta','','','','1',6,''),(100,96,'2014-05-22 18:55:03','2016-04-04 18:02:48','zeemoadmin','News','cta/news-default-cta','','','','0',7,''),(101,96,'2014-05-22 18:55:26','2016-04-04 18:02:48','zeemoadmin','Products','cta/product-default-cta','','','','0',8,''),(102,0,'2014-05-23 15:19:27','2016-04-29 20:24:12','zeemoadmin','FAQ','faq','service1.png','service_2.png','service1.png','0',18,''),(103,102,'2014-05-23 15:20:07','2014-05-22 16:50:58','zeemoadmin','Add / Edit FAQ','faq/add-faq','','','','1',1,''),(104,102,'2014-05-23 15:20:48','2014-05-22 16:50:58','zeemoadmin','Manage FAQs','faq/manage-faqs','','','','1',2,''),(105,6,'2014-05-23 18:42:24','2016-03-30 17:23:23','zeemoadmin','Our Expertise','generalpages/more-info-section','','','','0',2,''),(107,8,'2014-05-23 19:49:10','2015-12-28 20:41:11','zeemoadmin','Footer Text','commonsettings/footer-text','','','','1',2,''),(108,0,'2014-12-03 19:42:34','2016-04-29 20:24:12','zeemoadmin','Email Notification Center','notification','ebooks1.png','ebooks2.png','ebooks3.png','1',19,''),(109,108,'2014-12-03 19:43:26','2014-12-02 20:39:07','zeemoadmin','Setup Email Messages','notification/email-messages','','','','1',1,''),(110,108,'2014-12-03 19:44:36','2014-12-04 17:38:10','zeemoadmin','Setup Thank Messages','notification/thankyou-messages','','','','1',2,''),(111,108,'2014-12-03 19:45:19','2014-12-02 20:39:07','zeemoadmin','Email Sender Information','notification/sender-information','','','','1',2,''),(112,108,'2014-12-03 21:05:26','2014-12-04 17:38:10','zeemoadmin','Auto Email Notification (Cron Job)','notification/setup-email-notification','','','','0',2,''),(113,90,'2015-06-05 17:17:50','2015-06-04 18:47:50','zeemoadmin','Common Settings','zeemosettings/common-settings','','','','1',1,''),(114,0,'2015-12-04 20:56:35','2016-04-29 20:24:17','zeemoadmin','Manage Landing Pages','landingpages','landing-home.png','landing-top.png','landing-left.png','1',3,''),(115,114,'2015-12-04 20:57:07','2015-12-03 20:27:32','zeemoadmin','Manage Landing Pages','landingpages/manage-landing-pages','','','','1',2,''),(116,114,'2015-12-04 20:57:32','2015-12-03 20:27:32','zeemoadmin','Add Landing Page','landingpages/add-landing-page','','','','1',1,''),(117,35,'2015-12-04 21:44:03','2016-04-04 18:06:56','zeemoadmin','About Section Meta','metatags/about-section-metas','','','','1',1,''),(118,96,'2015-12-04 22:01:27','2016-04-04 18:02:13','zeemoadmin','About Section CTA','cta/about-section-cta','','','','1',3,''),(119,96,'2015-12-04 22:01:45','2016-04-04 18:02:48','zeemoadmin','Landing Page CTA','cta/landing-page-cta','','','','1',1,''),(120,0,'2015-12-29 21:03:24','2016-04-29 20:24:17','zeemoadmin','About Section','about','about.png','about.png','about.png','0',1,''),(121,120,'2015-12-29 21:04:15','2015-12-28 20:34:24','zeemoadmin','Add Page','about/add-page','','','','1',2,''),(122,120,'2015-12-29 21:04:25','2015-12-28 20:34:25','zeemoadmin','Manage Pages','about/manage-pages','','','','1',1,''),(123,0,'2016-04-01 15:19:34','2016-04-29 20:29:21','zeemoadmin','Completed Projects','projects','project-home.png','project-top.png','project1.png','1',6,''),(124,123,'2016-04-01 15:21:09','2016-03-31 14:52:45','zeemoadmin','Top Text','projects/toptext','','','','1',1,''),(125,123,'2016-04-01 15:21:40','2016-03-31 14:52:45','zeemoadmin','Add / Edit Project','projects/add-project','','','','1',2,''),(126,123,'2016-04-01 15:21:55','2016-03-31 14:52:45','zeemoadmin','Manage Projects','projects/manage-projects','','','','1',3,''),(127,123,'2016-04-01 15:22:19','2016-03-31 14:52:41','zeemoadmin','Manage Images','projects/manage-images','','','','1',4,''),(128,0,'2016-04-04 21:06:29','2016-06-03 03:46:28','zeemoadmin','Corporate Support','support','company-home.png','company1.png','company-left.png','1',12,''),(129,128,'2016-04-04 21:07:01','2016-04-03 22:45:15','zeemoadmin','Top Text','support/toptext','','','','1',1,''),(130,128,'2016-04-04 21:08:54','2016-04-03 22:45:19','zeemoadmin','Our Support Text','support/support-text','','','','1',2,''),(131,128,'2016-04-04 21:09:13','2016-04-03 22:45:19','zeemoadmin','Add / Edit Item','support/add-item','','','','1',3,''),(132,128,'2016-04-04 21:09:24','2016-04-03 22:45:18','zeemoadmin','Manage Items','support/manage-items','','','','1',4,''),(133,96,'2016-04-05 16:32:13','2016-04-04 18:02:48','zeemoadmin','Completed Projects','cta/project-default-cta','','','','1',5,''),(134,35,'2016-04-05 16:36:53','2016-04-04 18:06:57','zeemoadmin','Completed Projects','metatags/project-default-metas','','','','1',5,''),(135,80,'2016-04-08 14:05:07','2016-04-07 15:35:10','zeemoadmin','Newsletter Subcribers','leads/newsletter-subscribers','','','','1',3,''),(136,83,'2016-04-12 15:09:45','2016-04-11 16:39:45','zeemoadmin','Top Text','blogs/toptext','','','','1',1,''),(137,0,'2016-04-12 19:02:21','2016-06-03 03:46:28','zeemoadmin','In The Media','media','website-live1.png','website-live1.png','website-live1.png','1',11,''),(138,137,'2016-04-12 19:03:01','2016-04-11 20:55:10','zeemoadmin','Add / Edit Item','media/add-item','','','','1',3,''),(139,137,'2016-04-12 19:03:14','2016-04-11 20:55:10','zeemoadmin','Manage Items','media/manage-items','','','','1',4,''),(140,137,'2016-04-12 19:03:56','2016-04-11 20:55:13','zeemoadmin','Top Content','media/toptext','','','','1',1,''),(141,137,'2016-04-12 19:25:10','2016-04-11 20:55:13','zeemoadmin','Bottom Text','media/bottom-text','','','','1',2,''),(142,0,'2016-04-13 20:26:38','2016-06-03 03:46:28','zeemoadmin','Sleepbus Toolbox','toolbox','investor-home.png','investor-top.png','modules-left1.png','1',13,''),(143,142,'2016-04-13 20:26:56','2016-04-12 21:58:40','zeemoadmin','Top Text','toolbox/toptext','','','','1',1,''),(144,142,'2016-04-13 20:27:24','2016-04-12 21:58:43','zeemoadmin','Branding Content','toolbox/branding-content','','','','1',2,''),(145,142,'2016-04-13 20:27:42','2016-04-12 21:58:49','zeemoadmin','Videos','toolbox/videos','','','','1',3,''),(146,142,'2016-04-13 20:28:08','2016-04-12 21:58:49','zeemoadmin','Facebook timeline photos','toolbox/facebook-timeline','','','','1',4,''),(147,142,'2016-04-13 20:28:37','2016-04-12 21:58:48','zeemoadmin','Twitter Backgrounds','toolbox/twitter-backgrounds','','','','1',5,''),(148,0,'2016-04-15 20:04:02','2016-06-03 03:46:28','zeemoadmin','Manage User Accounts','account','friends-home1.png','friends-top1.png','friends-left1.png','1',10,''),(149,148,'2016-04-15 20:04:25','2016-05-05 02:22:01','zeemoadmin','Headings / Subheadings','account/pageheadings','','','','1',1,''),(150,148,'2016-04-15 20:04:42','2016-05-05 02:22:01','zeemoadmin','Account Types','account/account-type','','','','1',2,''),(151,0,'2016-04-15 20:59:06','2016-04-29 20:29:21','zeemoadmin','Campaign','campaign','investor-home1.png','investor-top1.png','modules-left2.png','1',7,''),(152,151,'2016-04-15 20:59:48','2016-04-24 15:48:27','zeemoadmin','Campaign Types','campaign/campaign-type','','','','1',2,''),(153,151,'2016-04-15 21:01:05','2016-04-24 15:48:27','zeemoadmin','Campaign Images','campaign/manage-images','','','','1',3,''),(154,151,'2016-04-15 21:01:16','2016-04-24 15:48:27','zeemoadmin','Headings / Subheadings','campaign/pageheadings','','','','1',1,''),(155,151,'2016-04-22 21:14:25','2016-04-24 15:48:27','zeemoadmin','Pledge Content','campaign/pledge-content','','','','1',4,''),(156,151,'2016-04-25 14:18:24','2016-04-24 16:16:28','zeemoadmin','Common Settings','campaign/setting','','','','1',5,''),(157,0,'2016-04-30 14:24:12','2016-06-03 03:46:28','zeemoadmin','Donation & Reporting','donation','reporting-home1.png','reporting-heading1.jpg','reporting-left-icon1.png','1',8,''),(158,157,'2016-04-30 14:25:31','2016-05-05 22:20:49','zeemoadmin','Donate','donation/donate','','','','1',1,''),(159,157,'2016-04-30 14:27:30','2016-05-05 22:20:49','zeemoadmin','One Year Safe Sleep','donation/one-year-safe-sleep','','','','1',2,''),(160,148,'2016-05-05 20:21:59','2016-05-05 02:22:01','zeemoadmin','Manage Users','account/manageusers','','','','1',3,''),(161,157,'2016-05-06 16:20:12','2016-05-05 22:20:49','zeemoadmin','Donation Report','donation/reporting','','','','1',3,'');
/*!40000 ALTER TABLE `admin_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrators` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `level_id` varchar(250) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  `password_recovery` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
INSERT INTO `administrators` VALUES (1,'zeemoadmin','LMPTKIZGNZGVJNKIPHAXPWWYQSFGRKNOGYZSLFHDUGUASZATHXQAGBITARRTBOAC','berniece@huel.net','Caleb','Harber',1,'1','2017-05-23 17:37:41','zeemoadmin','cc03e747a6afbbcbf8be7668acfebee5','2012-12-26 15:44:31'),(2,'admin','ICGHKGDOXSFTOMMBKUUGHQMVRGWDPEHBFLVVUCSGKOZBWVUGEGHIQVMUNKGXREGP','louie@feeney.net','Charlotte','Hickle',1,'2','2017-05-23 17:37:41','admin','ac47e536d60bc11922e4dfd9b7c78211','2015-12-03 21:59:32');
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auto_email_notification`
--

DROP TABLE IF EXISTS `auto_email_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auto_email_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `remaining_days` text NOT NULL,
  `sender_email` varchar(512) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_email_notification`
--

LOCK TABLES `auto_email_notification` WRITE;
/*!40000 ALTER TABLE `auto_email_notification` DISABLE KEYS */;
INSERT INTO `auto_email_notification` VALUES (1,'2014-10-10 12:53:27','30 Days Before','asdf@asdf.sdf','sdfsdafasd','<p>asf sadfasdf</p>','2014-12-03 17:44:23','zeemoadmin'),(2,'2014-10-10 12:53:41','15 Days Before','','','','2014-12-02 20:44:33','admin'),(3,'2014-10-10 12:54:38','7 Days Before','','','','2014-12-02 20:44:33','admin'),(4,'2014-10-10 12:54:45','2 Days Before','','','','2014-10-09 12:27:04','zeemoadmin'),(5,'2014-10-10 12:55:04','1 Day Before','','','','2014-10-09 12:27:04','zeemoadmin'),(6,'2014-10-10 12:55:29','Subscription Expired','','','','2014-12-02 20:44:33','admin');
/*!40000 ALTER TABLE `auto_email_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner_intervals`
--

DROP TABLE IF EXISTS `banner_intervals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner_intervals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) NOT NULL,
  `time_interval` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner_intervals`
--

LOCK TABLES `banner_intervals` WRITE;
/*!40000 ALTER TABLE `banner_intervals` DISABLE KEYS */;
INSERT INTO `banner_intervals` VALUES (1,'Home Page',5,'2013-03-06 16:15:43','zeemoadmin');
/*!40000 ALTER TABLE `banner_intervals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_alt_title_text` varchar(512) NOT NULL,
  `image_quality` varchar(25) NOT NULL,
  `details` text NOT NULL,
  `url` text NOT NULL,
  `page_type` varchar(255) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'2013-02-05 14:18:05','banner.jpg','','','<h2>Park and Smile</h2>\r\n<p><br />\r\nAre you still searching, or do you already park in a KLAUS Multiparking system?</p>\r\n<p>KLAUS Multiparking has been one of the leading manufacturers of parking systems in Germany for almost 50 years. We have representations in over 65 countries worldwide. Our headquarters is in the south of Germany close to the Lake of Constance.</p>','http://www.google.com','default','Default Banner',0,'1','2013-02-21 21:06:56','zeemoadmin'),(3,'2013-02-05 14:30:25','toputk7.jpg','asdfasf','80','<p>&nbsp;asfasfd</p>','http://asdfasd','page','Builders',2,'1','2014-12-03 17:04:25','zeemoadmin'),(4,'2013-02-05 14:36:26','','88 KB','50','<p>asdfafasf</p>','','page','Architects',3,'1','2014-12-02 22:13:46','zeemoadmin'),(5,'2013-02-05 14:46:18','banner214.jpg','','','<h2><span style=\"color: rgb(255, 102, 0);\"><big><strong>Contact Us</strong></big></span></h2>','','contact','Contact',0,'1','2013-02-21 21:41:42','zeemoadmin'),(6,'2013-02-05 14:47:17','','','','<p>dafa</p>','','testimonials','Testimonials',0,'1','2015-09-17 23:06:54','zeemoadmin'),(7,'2013-02-05 14:48:32','banner26.jpg','','','<h1 style=\"text-align: right;\"><strong><span style=\"font-family: Arial;\"><span style=\"color: rgb(255, 102, 0);\"><big>Park and Smile</big></span></span></strong></h1>','','news','',0,'1','2013-02-06 16:30:46','zeemoadmin'),(8,'2013-02-05 14:59:04','','','','','','downloads','Downloads',0,'0','2014-12-02 22:24:24','zeemoadmin'),(10,'2013-02-05 15:04:38','','','','','','company','Company Profile',2,'1','2013-02-04 21:34:38','zeemoadmin'),(11,'2013-02-05 15:13:18','banner13.jpg','','','<h1><big><strong><span style=\"color: rgb(255, 102, 0);\"><span style=\"font-family: Arial;\">&nbsp;Blog Page</span></span></strong></big></h1>','','blog','Blog',3,'1','2013-05-05 18:24:47','zeemoadmin'),(12,'2013-02-05 15:14:41','','','','','','company','Quality',4,'1','2013-02-04 20:15:19','zeemoadmin'),(13,'2013-02-05 15:15:28','','','','','','company','Press',5,'1','2013-02-04 21:34:30','zeemoadmin'),(18,'2013-02-06 11:08:11','banner42.jpeg','','','<h1><span style=\"color: rgb(255, 153, 0);\"><span style=\"font-family: Arial;\"><strong><big>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </big><span style=\"color: rgb(255, 102, 0);\"><big>Park and Smile</big></span></strong></span></span></h1>\r\n<h2 style=\"margin-top: 0px; padding-top: 0px; color: rgb(112, 112, 112); font-size: 19px; line-height: 23px; width: 460px; font-family: Arial,Helvetica,Geneva,sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: rgb(255, 255, 255);\"><font><font>More space on the same grounds with intelligent parking solutions for the client.</font></font></h2>','','services','',0,'0','2013-02-11 15:55:23','zeemoadmin'),(19,'2013-02-06 11:25:14','banner43.jpeg','','','<h1 style=\"text-align: right;\"><big><strong><span style=\"color: rgb(255, 153, 0);\"><span style=\"color: rgb(255, 102, 0);\"><span style=\"font-family: Arial;\">Park and Smile</span></span></span></strong></big></h1>\r\n<h2 style=\"margin-top: 0px; padding-top: 0px; color: rgb(112, 112, 112); font-size: 19px; line-height: 23px; width: 460px; font-family: Arial,Helvetica,Geneva,sans-serif; text-align: right;\">Still looking for, or you just park on a KLAUS Multiparker?</h2>\r\n<p style=\"margin-top: 0px; padding-top: 0px; width: 460px; color: rgb(112, 112, 112); font-family: Arial,Helvetica,Geneva,sans-serif; line-height: 19px; text-align: right;\"><font><font>KLAUS Multiparking is a leading manufacturer of parking systems and&nbsp;</font></font><br />\r\n<font><font>double parkers in Germany and has been for nearly 50 years.&nbsp;</font></font><br />\r\n<font><font>We are represented in more than 65 countries.&nbsp;</font><font>Our headquarters is located in&nbsp;</font></font></p>\r\n<p style=\"text-align: right;\">&nbsp;</p>','','services','',10,'1','2013-02-06 18:59:31','zeemoadmin'),(20,'2013-02-07 03:48:31','banner25.jpg','','','<h1 style=\"text-align: right;\"><span style=\"color: rgb(255, 153, 0);\"><span style=\"font-family: Arial;\"><big>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </big><span style=\"color: rgb(255, 102, 0);\"><big>Berlin. London. Sydney.</big></span></span></span></h1>\r\n<h2 style=\"color: rgb(112, 112, 112); text-align: right;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;KLAUS Multiparking solves parking space<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;problems for customers all over the world</h2>','','services','',13,'1','2013-02-06 16:31:25','zeemoadmin'),(21,'2013-02-07 04:11:19','banner44.jpeg','','','<h1 style=\"text-align: right;\"><span style=\"color: rgb(255, 102, 0);\"><span style=\"font-family: Arial;\"><big><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Park and Smile</strong></big></span></span></h1>','','references','',0,'1','2013-02-06 16:31:08','zeemoadmin'),(23,'2013-02-07 04:53:26','banner1.jpg','','','<h1>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<big><strong><span style=\"color: rgb(255, 102, 0);\"><span style=\"font-family: Arial;\">Park and Smile</span></span></strong></big></h1>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;News page</p>','','news','',0,'0','2014-12-03 15:08:41','zeemoadmin'),(24,'2013-02-08 07:33:17','banner27.jpg','','','<p>&nbsp;asdfasdf</p>','','services','',12,'1','2013-02-07 19:03:17','zeemoadmin'),(27,'2013-02-19 05:03:06','banner47.jpeg','','','<p style=\"text-align: right;\">&nbsp;Product Default Banner</p>','','products','',0,'1','2013-04-07 20:15:03','zeemoadmin'),(37,'2013-02-20 04:10:42','banner212.jpg','','','<p style=\"text-align: right;\">ZdAS</p>','','news','',7,'1','2013-02-19 15:40:52','zeemoadmin'),(38,'2013-02-22 10:09:35','banner210.jpg','','','<h2><big><span style=\"color: rgb(255, 153, 0);\">&nbsp;Contact Us</span></big></h2>','','contact','',1,'1','2013-02-21 21:39:35','zeemoadmin'),(40,'2013-03-06 12:48:11','','','','','','search','Search',0,'1','2013-03-05 17:48:43','zeemoadmin');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `birthday_pledge`
--

DROP TABLE IF EXISTS `birthday_pledge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `birthday_pledge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(555) NOT NULL,
  `email` varchar(555) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_reminder` varchar(228) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `birthday_pledge`
--

LOCK TABLES `birthday_pledge` WRITE;
/*!40000 ALTER TABLE `birthday_pledge` DISABLE KEYS */;
INSERT INTO `birthday_pledge` VALUES (1,'2016-04-29 19:08:16',8,'Rajeev Kumar','rajeev@infinitewebsolutions.in','1980-01-31','2016-06-06 11:07:11',''),(2,'2016-04-30 18:01:11',2,'Neet','nitinkulshreshtha30@gmail.com','1987-08-11','2016-06-06 11:07:18',''),(3,'2016-04-30 19:09:49',2,'Rakesh','suprit@infinitewebsolutions.in','1984-11-08','2016-06-06 11:07:24',''),(4,'2016-05-03 18:39:36',2,'Rajeev','rajeev@infinitewebsolutions.in','1987-11-08','2016-06-06 11:07:31',''),(5,'2016-05-05 19:26:01',2,'Suprit','suprit@infinitewebsolutions.in','1987-11-08','2016-06-06 11:07:38',''),(6,'2016-05-06 16:55:34',11,'Rakesh','design@infinitewebsolutions.in','1987-11-08','2016-06-06 11:06:50',''),(7,'2016-05-11 18:31:00',2,'vijay','design@infinitewebsolutions.in','1987-11-08','2016-06-06 11:06:50',''),(8,'2016-05-25 14:30:12',2,'Anoop','anoop@infinitewebsolutions.in','1987-11-08','2016-06-06 11:06:50',''),(9,'2016-05-25 14:38:21',2,'nitin','nitinkulshreshtha30@gmail.com','1987-05-26','2016-06-06 11:06:50',''),(10,'2016-05-26 09:43:45',1,'Simon Rowe','simon@sleepbus.org','1973-02-20','2016-06-06 11:06:50',''),(11,'2016-05-27 14:11:26',2,'Anne Mehla','annemehla@me.com','1981-09-07','2016-06-06 11:06:50',''),(12,'2016-05-27 16:00:21',1,'Ethan Rowe','ethanrowe12@gmail.com','2000-01-07','2016-06-06 11:06:50',''),(13,'2016-05-27 16:03:03',3,'Ethan Rowe','ethanrowe12@gmail.com','2000-01-07','2016-06-06 11:06:50',''),(14,'2016-06-02 21:40:55',4,'Annie McCutcheon','annemehla@me.com','1980-09-07','2016-06-06 11:06:50',''),(15,'2016-07-07 15:18:35',5,'Nitin','nitinkulshreshtha30@gmail.com','1987-08-11','2016-07-07 05:18:35',''),(16,'2016-07-15 13:24:42',6,'James Wright','hello@ejameswright.com','1982-09-01','2016-07-15 03:24:42',''),(17,'2016-08-18 22:46:16',12,'Sarah','creative@sleepbus.org','1984-08-07','2016-08-18 12:46:16',''),(18,'2016-09-14 13:39:55',16,'Andrew Peel','dotandpixel@gmail.com','1978-01-19','2016-09-14 03:39:55',''),(19,'2016-09-29 12:05:37',21,'Pedita van Hees','pedita.vanhees@bendigoadelaide.com.au','1987-05-25','2016-09-29 02:05:37',''),(20,'2016-10-24 21:57:59',23,'Christian Brown','cmbrown7@hotmail.com','1971-02-02','2016-10-24 10:57:59',''),(21,'2016-11-30 08:53:37',34,'Dianne Sheridan','fishiesbeach@gmail.com','1951-10-28','2016-11-29 21:53:37',''),(22,'2016-12-24 04:44:47',38,'Lina Mbirkou','Lina.mbirkou@gmail.com','1975-12-25','2016-12-23 17:44:47','');
/*!40000 ALTER TABLE `birthday_pledge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_notifications`
--

DROP TABLE IF EXISTS `blog_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_notifications` (
  `blog_to_emailid` text NOT NULL,
  `blog_cc_emailid` text NOT NULL,
  `blog_bcc_emailid` varchar(255) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_notifications`
--

LOCK TABLES `blog_notifications` WRITE;
/*!40000 ALTER TABLE `blog_notifications` DISABLE KEYS */;
INSERT INTO `blog_notifications` VALUES ('rajeev@infinitewebsolutions.in','rajeev@infinitewebsolutions.in','rajeev@infinitewebsolutions.in','2013-05-05 18:17:28','zeemoadmin');
/*!40000 ALTER TABLE `blog_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogger`
--

DROP TABLE IF EXISTS `blogger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogger` (
  `id` int(23) NOT NULL AUTO_INCREMENT,
  `blogger_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `url` varchar(250) NOT NULL,
  `position` int(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogger`
--

LOCK TABLES `blogger` WRITE;
/*!40000 ALTER TABLE `blogger` DISABLE KEYS */;
INSERT INTO `blogger` VALUES (35,'Simon',1,'rajeev',1,'2016-03-31 20:50:36','2016-08-04 23:18:26','admin');
/*!40000 ALTER TABLE `blogger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cat_id` int(20) DEFAULT NULL,
  `blog_name` varchar(250) DEFAULT NULL,
  `intro_text` text NOT NULL,
  `description` text,
  `banner_image_text` text NOT NULL,
  `blogger_id` int(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `position` int(100) NOT NULL,
  `url` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_display` varchar(111) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(100) NOT NULL,
  `display_on_home` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (52,33,'Dear sleepbus family','<div class=\"blogboxhover\">\r\n<p><span>an update</span></p>\r\n\r\n<h2>Dear sleepbus family.</h2>\r\n</div>\r\n\r\n<figure><img alt=\"\" src=\"https://www.sleepbus.org/images/img22.jpg\" /></figure>\r\n\r\n<div class=\"redmore\">\r\n<p>&nbsp;</p>\r\n</div>','<p>Dear sleepbus Family,</p>\r\n\r\n<p>Here are some stats;</p>\r\n\r\n<p>- Sleepbus reached its first $20,000 goal in only 7 days (on March 4). Funds raised were used to purchase the first ever Sleepbus.</p>\r\n\r\n<p>- Sleepbus reached its second $50,000 goal in 47 days (on April 13). Funds raised are being used to pay for the fit-out of the bus.</p>\r\n\r\n<p>- Sleepbus reached its third $85,000 goal in 63 days (on April 29). Funds raised will be used to to cover part of the operating costs for the 90 day pilot program to test the sleepbus operational procedures and gain feedback from guests.</p>\r\n\r\n<p>I am amazed at the support received so far, this coming from a guy that has just 78 Facebook friends. Hahaha. It just goes to show what is truly possible if we come together. The people and businesses that have contacted me over the past 63 days have been so moved by sleepbus and so compelled to help; it is this help and support that has made our first bus possible.</p>\r\n\r\n<p>It truly will be the first bus of many, of this I have no doubt.</p>\r\n\r\n<p>I could never have imagined that this idea would resonate so strongly with you all, but I&#39;m so proud and happy that it has. This bus will change lives. That&rsquo;s so powerful. Nothing seems impossible with the support of the best family a little charity could ever hope for.</p>\r\n\r\n<p>Money that is not used for the pilot program will go towards our second bus, which we have waiting to be purchased. This bus and a third will be used for our second phase pilot program in Melbourne CBD. 100% of public donations go to sleepbus projects. I rely on corporate and future government support to fund the &quot;business&quot; of running sleepbus. 3 buses on the road will provide 24,090 safe sleeps per year...now that&rsquo;s a big number.</p>\r\n\r\n<p>Thank you again for your support. Couldn&#39;t do it without you.</p>\r\n\r\n<p>Simon</p>','<div class=\"blogdetailbox\" style=\"background:url(https://www.sleepbus.org/images/img25.jpg) no-repeat center top;\">\r\n<div class=\"container\">\r\n<p>Did you know?</p>\r\n\r\n<h1>100% of your donation gets people off the street and provides safe sleeps.</h1>\r\n</div>\r\n</div>',35,1,2,'blog2','2016-03-31 00:00:00','2016-06-10 11:00:29','2017-02-27 00:00:29','admin','0'),(53,33,'100% funds sleepbus projects and gets people off the street 2','<div class=\"blogboxhover\">\r\n<p><span>latest campaign</span></p>\r\n\r\n<h2>100% funds sleepbus projects and gets people off the street.</h2>\r\n</div>\r\n\r\n<figure><img alt=\"\" src=\"https://www.sleepbus.org/images/img3.jpg\" /></figure>\r\n\r\n<div class=\"redmore\">Read more</div>','<p>asdf af sad</p>','<p>banner content</p>',35,0,3,'blog3','2016-03-31 00:00:00','2016-03-31 03:28:24','2017-02-14 18:40:11','admin','0'),(54,33,'100% funds sleepbus projects and gets people off the street 3','<div class=\"blogboxhover\">\r\n<p><span>latest campaign</span></p>\r\n\r\n<h2>100% funds sleepbus projects and gets people off the street.</h2>\r\n</div>\r\n\r\n<figure><img alt=\"\" src=\"https://www.sleepbus.org/images/img23.jpg\" /></figure>\r\n\r\n<div class=\"redmore\">Read more</div>','<p>De</p>','<p>Banner Content</p>',35,0,4,'100-funds-sleepbus-projects-and-gets-people-off-the-street-3','2016-04-12 00:00:00','2016-04-12 03:29:32','2017-02-14 18:40:11','admin','0'),(55,33,'100% funds sleepbus projects and gets people off the street 4','<div class=\"blogboxhover\">\r\n<p><span>latest campaign</span></p>\r\n\r\n<h2>100% funds sleepbus projects and gets people off the street.</h2>\r\n</div>\r\n\r\n<figure><img alt=\"\" src=\"https://www.sleepbus.org/images/img24.jpg\" /></figure>\r\n\r\n<div class=\"redmore\">Read more</div>','<p>Des</p>','<p>Banner Content</p>',35,0,5,'100-funds-sleepbus-projects-and-gets-people-off-the-street','2016-04-12 00:00:00','2016-04-12 03:32:45','2017-02-14 18:40:11','admin','0');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs_categories`
--

DROP TABLE IF EXISTS `blogs_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs_categories` (
  `id` int(23) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `url` varchar(250) NOT NULL,
  `position` int(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs_categories`
--

LOCK TABLES `blogs_categories` WRITE;
/*!40000 ALTER TABLE `blogs_categories` DISABLE KEYS */;
INSERT INTO `blogs_categories` VALUES (33,'Sleep Bus Blog',1,'category',1,'2016-03-31 20:49:48','2016-04-28 01:24:30','admin');
/*!40000 ALTER TABLE `blogs_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_comments`
--

DROP TABLE IF EXISTS `campaign_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text NOT NULL,
  `campaign_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_comments`
--

LOCK TABLES `campaign_comments` WRITE;
/*!40000 ALTER TABLE `campaign_comments` DISABLE KEYS */;
INSERT INTO `campaign_comments` VALUES (8,'2016-06-02 11:53:24','I\'m so cool.',5),(9,'2016-06-08 01:37:01','Anne is posting an update. Will it show up?',8),(10,'2016-06-09 01:58:26','Anne is doing great raising funds!',9),(11,'2016-06-10 06:50:27','',3),(13,'2016-07-15 04:39:10','The election may be over, but every day it is possible to create a shift and change in society towards a better and more integrated community.\r\n\r\nSo I am making my next goal to reduce the number of people sleeping rough each night in my community of the Northern rivers by 50% in the next 18 months.\r\n\r\nI heard about some brilliant humans Nic Marchesi & Lucas Patchett at http://www.orangeskylaundry.com.au/ and their initiative to help wash the clothes of the needy and homeless.\r\n\r\nI then thought what if we could transform sleeper buses into short term accommodation for those sleeping rough ?\r\nAfter some research, I found Simon Rowe and www.sleepbus.org and they have a plan already underway! I have contacted Simon and sleepbus.org and hope to extend his program to the Northern Rivers very soon.\r\n\r\nThey are currently raising 120K to get the pilot program off the ground and are only 9k away from their goal.\r\nSo in the meantime share this campaign, create your own and get everyone to donate to this super important program that can help to transform our society.\r\n\r\nAs long members of our local community are sleeping rough, how can we sleep at peace ourselves ?\r\n\r\n1st September is the goal !\r\n\r\nJ.',15),(14,'2016-07-20 11:58:00','Founders Story.\r\n\r\nIn 1993, I fell behind in my rent and was evicted. I had a job, but for the next 4 months I lived in my car while I saved up enough money for a months bond and a months rent on another place. I would park in a car park near my old place for the night, and in the mornings, drive to a caravan park near by, sneak in, have a shower and go to work.\r\n\r\nSince then, I have made a good living for years as a Chef, and Entrepreneur, for the most part living selfishly and not giving a second thought to those sleeping rough. \r\n\r\n In May 2015, I was walking along Carlisle street in St. Kilda East, Melbourne, to my local Coles supermarket. As I approached the brand new Bank of Melbourne I see a   bright, white doona crumpled up in the   tiny alcove of an unused doorway. As I got   closer I noticed there was a man curled up in the doona, on the hard concrete floor,   trying to get some sleep… at lunch time. \r\n\r\n So many people were walking past, looking, but moving on with their day, as I have probably done since 1993. This time I couldn’t walk past, I stopped and asked   him if he was ok… he said “yeah mate,   thanks, just trying to get some sleep”. He   looked so tired. I said, “here mate” and   gave him the $20 I had in my pocket. His eyes lit up, he smiled and was so grateful. He shook my hand, thanked me again with a smile and curled back up under the doona. When I got home, I told my family what had happened and tears rolled down my face. \r\n\r\nThat man, trying to sleep on a concrete floor, in the middle of the day, on a busy city street affected me in a profound way. And that’s a mild story; for many sleeping on the streets are being subjected to terrible weather, harassment, bullying, being robbed and worse. No one should have to live like that. \r\n\r\nCharity. For me, charity is practical. It\'s the ability to use one\'s position of influence, relative wealth and power to affect lives for the better.\r\n\r\nI’m not a religious person, but there\'s a story in the bible about a man beaten near death by robbers. He\'s stripped naked and lying on the roadside. Most people pass him by, but one man stops. He picks him up and bandages his wounds. He puts him on his horse and walks alongside until they reach an inn. He checks him in and throws down his Amex. \"Whatever he needs until he gets better.”\r\n\r\nBecause he could.\r\n\r\nThe dictionary defines charity as simply the act of giving voluntarily to those in need.\r\n\r\nUsing my 20+ years of business experience, I set about developing a simple solution with a mission; to provide people sleeping “rough”, a safe overnight place to sleep. The more I developed and researched a solution, the more I discovered what a good nights sleep can do for a persons physical and mental health. Just being able to sleep through the night, warm and safe can give a person a whole new outlook on life. \r\n\r\nSleep Bus is distinct, yet complementary, to existing efforts from other organisations supporting Australians experiencing or at risk of ending up on the streets. Our work aims to fill a ‘gap’, rather than overlapping or replicating activities that support the urgent needs of people in Australia. \r\n\r\nThe least we can do is provide safe overnight accommodation to people sleeping rough in Australia, until they get back on their feet.',16),(15,'2016-07-20 11:59:25','Dear sleepbus Family.\r\n\r\nWe need to talk. It’s been 10 months since the idea of sleepbus was born and on the surface it looks like not much has happened, but the reality of setting up a Charity properly and for the long term takes time and more red-tape than I care to mention. That’s said, they are important steps and given our 100% model where all public donations go to sleepbus projects, it was important to make sure we did everything right from the start. \r\n\r\nSo what’s been happening. Well let me take you through the list. \r\n\r\nBus Design: Completed and is ready to go. The bus design includes 22 individual sleep pods, 2 toilets, 22 personal items lockers, under bus storage, 8 pet kennels, security system, lighting system inside & out and intercom system for family sleep pods with parental control locks. The toilet’s have been strategically located at the front of the bus to assist with the safety of guests within the bus.\r\n\r\nSleep Pods: Each sleep pods comes with single bed inner spring mattress, pillows, sheets and blankets (washed daily). The pod has USB charging for mobile phones, personal light, lockable roller door, climate control and Television with auxiliary channel running adverts for available services in the area to help with pathways out of homelessness. Each pod can be adapted for families, with parents able to control their child’s door lock and intercom for communication between designated family members only. Various sizes have been tested. I’ve slept in a pod every night for 3 weeks or so and found it very comfortable and cosy, which is important. Even the kids had a go. \r\n\r\nsleepbus Brand: A complete brand has been developed including, various logos, our vision, mission and essence, all developed and documented. \r\n\r\nOur Vison: To end the need for people sleeping rough in Australia.\r\n\r\nOur Mission: To provide safe overnight accommodation for people sleeping rough in Australia.\r\n\r\nOur Mantra: sleep changes everything. \r\n\r\nWe have two major fundraising and awareness events designed and planned to run each year and these are aimed at two very different target audiences. Sleep Bus Ltd has been registered (ABN 15 609 317 937),\r\ncharity constitution completed and register, Charity status lodged and awaiting our Deductable Gift Recipient status which takes several months. Two separate bank accounts have been setup to manage our 100% Model; one account is for public donations; this money will all go to sleepbus projects; the second account is for corporate donations to assist with the costs of running sleepbus. Money can be transferred from the corporate account to the public donations account to assist with projects, but can never be transferred from the public account to the corporate account. This is even written into our constitution.\r\n\r\nWebsite: Thanks to a very generous donation from Zeemo.com.au , we have a basic website up and running while the Zeemo team build our larger and more robust site for the future. Zeemo has also completed all the final logo designs and other branding, all of this is very time consuming and expensive work, but they were the first corporate to join the sleepbus family and do everything for free. Amazing. \r\n\r\nVolunteers: sleepbus has been inundated with offers of support; Zeemo as mentioned, all the legal work has been donated, a company has offered to clean all our buses for free once we’re up and going and Belinda Jane Video.com has offered their assistance to video the story of sleepbus from idea to birth and more. This will help you, our family, see everything that goes into building sleepbus, getting people off the street and provide safe sleeps. We have had many many other offers of help from individuals via our Facebook page . I can’t express how amazing it feels to not only have people love and support an idea, but to also know, we’re not on our own, there is plenty of help at our disposal. \r\n\r\nSo where are we now and what’s next.\r\n\r\nWe have all the legal & Charity paperwork/red-tape done. \r\n\r\nThe bank accounts and tracking system is done.\r\n\r\nWebsite stage one is up and the big bad boy of a site is underway and will be ready for launch this Winter. \r\n\r\nWe have media interest.\r\n\r\nWe have plans, designs, costings and material list done.\r\n\r\nWe have operational guidelines, checklists and manuals done. \r\n\r\nWe have our eye on several buses. \r\n\r\nSo all that is ready, and now sleepbus is ready to ask for donations to build the first of many buses and get people off the street. We want at least one bus on the road by this coming Winter. That one bus will provide 8,030 safe sleeps per year and can last up to 10 years before it needs major work or replacement. One bus costs approximately $50,000 to buy and build. \r\n\r\nWe have had significant interest from corporate organisations, but until now, two things have held us back, one; we weren’t prepared to do any deals or accept any money from anyone, until we were registered and everything was in order / two; corporates need to see proof of concept.  What does that mean? They want to see the first bus up and running before they commit. \r\n\r\n And fair enough. Talk is cheap. And I am expecting significant investment from our future corporate partners. After all, we have a goal for 300+ buses to build and operate across the country, we’ll need there help in a big way to reach our goals and provide enough safe sleeps across Australia. \r\n\r\n But for now, its up to us, the sleepbus family. I really need your help. Winter is fast approaching, and we must have a bus built and ready to go by then. We need to stop doing paperwork now and begin the important work of getting people off the street and provide safe sleeps. One bus will provide 8,030 safe sleeps per year…just one bus. \r\n\r\nWhat can you do to help;\r\n\r\nShare the sleepbus story & concept with everyone and anyone you know. \r\n\r\nIntroduce us to corporates that are interested in what we’re doing.\r\n\r\nStart a campaign, at work or at home and raise funds for the first bus.\r\n\r\nDonate; money & or goods to build the first bus\r\n\r\nDonate your professional skills to the sleepbus cause; we need an accounting firm to complete our books and auditing requirements; we need ongoing legal support; we need material suppliers; we need a bus supplier; we need trades; electrical, plumbing, carpentry, welding/metal work, auto electrical, mechanic, sign writer, auto spray painting.\r\n\r\nIntroductions within local council addressing homelessness right now.\r\n\r\nAbove all else, we need to get a bus. So sleepbus Family, if you were ever going to get involved now is the time. We have set ourselves a launch date. We have media wanting to run our story. Its time. \r\n\r\nIf you believe in what we’re doing; if you want to do something about people sleeping on the street this winter; if you want to be a part of sleepbus history as a founding donor of the very first bus that starts it all. \r\n\r\nDonate Now. \r\n\r\nRaise Money Now. \r\n\r\nSpeak to people Now. \r\n\r\nEvery bit will help. Every cent will go to buying, building & operating the first bus. 100% Model. You will be able to find your name on the first bus, plus your name and generous donation will be forever immortalised in sleepbus history and we look forward to meeting you all at our sleepbus launch. \r\n\r\nCome on sleepbus family, lets make this happen. \r\n\r\nThank you.',16),(16,'2016-07-20 12:00:07','Simon Rowe\r\nFounder',16),(17,'2016-07-20 12:01:49','https://www.youtube.com/watch?v=AmstRv7DSks',16),(18,'2016-07-20 12:02:38','https://www.youtube.com/watch?v=aCoJWoviYwQ',16),(19,'2016-07-20 12:03:10','https://www.youtube.com/watch?v=lb01EJ9KP84',16),(20,'2016-07-20 12:03:39','https://www.youtube.com/watch?v=GhzZRQKVurw',16),(21,'2016-12-18 09:31:39','',25),(22,'2017-02-27 07:37:10','This is a test comment',31);
/*!40000 ALTER TABLE `campaign_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_images`
--

DROP TABLE IF EXISTS `campaign_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `image_title` varchar(555) NOT NULL,
  `image_file` varchar(555) NOT NULL,
  `description` text NOT NULL,
  `image_alt_title_text` varchar(555) NOT NULL,
  `image_quality` varchar(20) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_images`
--

LOCK TABLES `campaign_images` WRITE;
/*!40000 ALTER TABLE `campaign_images` DISABLE KEYS */;
INSERT INTO `campaign_images` VALUES (6,'2016-04-24 02:42:33',2,'','img4511.jpg','','','',4,'1','2016-04-29 20:41:23','admin'),(7,'2016-04-24 02:42:43',2,'','img451.jpg','','','',3,'1','2016-04-29 21:14:40','admin'),(8,'2016-04-24 02:44:45',1,'','Social-Banners6.jpg','','','',3,'1','2016-08-31 05:12:17','admin'),(9,'2016-04-24 02:44:48',1,'Bus','BannerBus.jpg','','','',4,'1','2016-08-31 05:12:17','admin'),(10,'2016-04-30 02:41:21',2,'','img451_2.jpg','','','',2,'1','2016-04-29 20:41:23','admin'),(11,'2016-04-30 02:41:23',2,'','img451_1.jpg','','','',1,'1','2016-04-29 20:41:23','admin'),(12,'2016-04-30 02:45:21',3,'','img451_11.jpg','','','',1,'0','2016-04-29 21:25:02','admin'),(15,'2016-06-08 11:25:43',4,'','BannerBus2.jpg','','','',4,'1','2016-08-31 05:20:26','admin'),(16,'2016-06-08 11:26:36',5,'','BannerBus1.jpg','','','',4,'1','2016-08-31 05:21:05','admin'),(17,'2016-06-08 11:26:49',6,'','BannerBus3.jpg','','','',4,'1','2016-08-31 05:22:15','admin'),(18,'2016-06-08 11:26:59',7,'','BannerBus4.jpg','','','',4,'1','2016-08-31 05:22:48','admin'),(19,'2016-06-08 11:27:11',8,'','BannerBus5.jpg','','','',4,'1','2016-11-09 05:41:16','admin'),(20,'2016-06-08 11:27:20',9,'','BannerBus6.jpg','','','',4,'1','2016-08-31 05:34:30','admin'),(21,'2016-06-10 10:35:42',4,'','Social-Banners.jpg','','','',3,'1','2016-08-31 05:20:26','admin'),(22,'2016-06-10 10:35:54',5,'','Social-Banners1.jpg','','','',3,'1','2016-08-31 05:21:05','admin'),(23,'2016-06-10 10:36:05',6,'','Social-Banners2.jpg','','','',3,'1','2016-08-31 05:22:15','admin'),(24,'2016-06-10 10:36:16',7,'','Social-Banners3.jpg','','','',3,'1','2016-08-31 05:22:48','admin'),(25,'2016-06-10 10:36:25',8,'','Social-Banners4.jpg','','','',3,'1','2016-11-09 05:41:16','admin'),(26,'2016-06-10 10:36:36',9,'','Social-Banners5.jpg','','','',3,'1','2016-08-31 05:34:30','admin'),(30,'2016-08-31 03:06:50',1,'Birthday Gift Box','birthday_1_FINAL-01.jpg','','','',2,'1','2016-08-31 05:12:17','admin'),(31,'2016-08-31 03:12:17',1,'Birthday Cupcake','birthday_2_FINAL-01.jpg','','','',1,'1','2016-08-31 05:12:27','admin'),(32,'2016-08-31 03:20:12',4,'','Campaign_1_FINAL-01.jpg','','','',2,'1','2016-08-31 05:20:26','admin'),(33,'2016-08-31 03:20:26',4,'','Campaign_2_FINAL-01.jpg','','','',1,'1','2016-08-31 05:20:26','admin'),(34,'2016-08-31 03:21:04',5,'','Campaign_1_FINAL-011.jpg','','','',2,'1','2016-08-31 05:21:05','admin'),(35,'2016-08-31 03:21:05',5,'','Campaign_2_FINAL-011.jpg','','','',1,'1','2016-08-31 05:21:05','admin'),(36,'2016-08-31 03:21:35',10,'','Campaign_1_FINAL-012.jpg','','','',2,'1','2016-08-31 05:21:36','admin'),(37,'2016-08-31 03:21:36',10,'','Campaign_2_FINAL-012.jpg','','','',1,'1','2016-08-31 05:21:36','admin'),(38,'2016-08-31 03:22:15',6,'','Campaign_1_FINAL-013.jpg','','','',2,'1','2016-08-31 05:22:15','admin'),(39,'2016-08-31 03:22:15',6,'','Campaign_2_FINAL-013.jpg','','','',1,'1','2016-08-31 05:22:15','admin'),(40,'2016-08-31 03:22:47',7,'','Campaign_1_FINAL-014.jpg','','','',2,'1','2016-08-31 05:22:48','admin'),(41,'2016-08-31 03:22:48',7,'','Campaign_2_FINAL-014.jpg','','','',1,'1','2016-08-31 05:22:48','admin'),(42,'2016-08-31 03:33:53',8,'','Campaign_1_FINAL-015.jpg','','','',2,'1','2016-11-09 05:41:16','admin'),(43,'2016-08-31 03:33:54',8,'','Campaign_2_FINAL-015.jpg','','','',1,'1','2016-11-09 05:41:16','admin'),(44,'2016-08-31 03:34:28',9,'','Campaign_1_FINAL-016.jpg','','','',2,'1','2016-08-31 05:34:30','admin'),(45,'2016-08-31 03:34:30',9,'','Campaign_2_FINAL-016.jpg','','','',1,'1','2016-08-31 05:34:30','admin'),(47,'2016-11-09 07:50:35',11,'','Campaign_Byron_Bay_3-01.jpg','','Byron Bay','',2,'1','2016-12-02 05:15:49','admin'),(48,'2016-12-02 04:15:17',11,'Perth','Campaign_Perth.jpg','','','',1,'1','2016-12-02 05:15:27','admin'),(49,'2017-02-27 04:15:17',11,'Qlik','Qlik_Campaign_Header.jpeg','','','',3,'1','2017-02-27 07:28:34','admin');
/*!40000 ALTER TABLE `campaign_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_settings`
--

DROP TABLE IF EXISTS `campaign_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `common_banner` varchar(255) NOT NULL,
  `campaign_logo` varchar(255) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_settings`
--

LOCK TABLES `campaign_settings` WRITE;
/*!40000 ALTER TABLE `campaign_settings` DISABLE KEYS */;
INSERT INTO `campaign_settings` VALUES (1,'img457.jpg','campaign_default_icon2.jpg','2016-11-09 23:53:46','admin');
/*!40000 ALTER TABLE `campaign_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_type`
--

DROP TABLE IF EXISTS `campaign_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `mission_statement` text NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_type`
--

LOCK TABLES `campaign_type` WRITE;
/*!40000 ALTER TABLE `campaign_type` DISABLE KEYS */;
INSERT INTO `campaign_type` VALUES (1,'2016-04-23 00:00:00','Birthday Pledge','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',8,'1','2016-11-09 05:42:32','zeemoadmin'),(4,'2016-06-04 00:00:00','Individual','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',2,'1','2016-11-09 05:42:32','zeemoadmin'),(5,'2016-06-04 00:00:00','Family','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',3,'1','2016-11-09 05:42:32','zeemoadmin'),(6,'2016-06-04 00:00:00','Workplace','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',5,'1','2016-11-09 05:42:32','zeemoadmin'),(7,'2016-06-04 00:00:00','School','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',6,'1','2016-11-09 05:42:32','zeemoadmin'),(8,'2016-06-04 00:00:00','Community Group','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',7,'1','2016-11-09 05:42:32','zeemoadmin'),(9,'2016-06-04 00:00:00','Other','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',9,'1','2016-11-09 05:42:32','zeemoadmin'),(10,'2016-06-28 00:00:00','Friends','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',4,'1','2016-11-09 05:42:32','zeemoadmin'),(11,'2016-11-09 00:00:00','Campaign for a specific town','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.',1,'1','2016-11-09 05:42:32','admin');
/*!40000 ALTER TABLE `campaign_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_alt_title_text` varchar(512) NOT NULL,
  `image_quality` varchar(25) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,0,'category2','asdfasd','now-showing-left.png','','','category2','1',5,0,'2013-05-09 21:09:48','2014-12-02 21:40:47','zeemoadmin'),(5,4,'cat22','asdf','12086081318NGci5.jpg','','','cat22','1',4,1,'2013-07-04 20:03:06','2014-12-02 21:40:47','zeemoadmin'),(6,5,'cat221','asdf','Black-forest-1680x1050.jpg','','','cat221','1',3,2,'2013-07-04 20:03:24','2014-12-02 21:40:47','zeemoadmin'),(7,6,'cat222','assadf','toputk8.jpg','','','cat222','1',2,3,'2013-08-08 21:37:11','2014-12-02 21:40:47','zeemoadmin'),(8,0,'category1','asdfasdf','','','','category1','1',1,0,'2014-12-03 22:10:47','2014-12-02 21:40:47','zeemoadmin');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_to_products`
--

DROP TABLE IF EXISTS `category_to_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_to_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `status` enum('1','0') NOT NULL,
  `position` smallint(6) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `url` varchar(300) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_to_products`
--

LOCK TABLES `category_to_products` WRITE;
/*!40000 ALTER TABLE `category_to_products` DISABLE KEYS */;
INSERT INTO `category_to_products` VALUES (58,4,5,'1',3,'2013-05-09 17:21:13','asdfas-1','2014-12-30 19:45:25','zeemoadmin'),(62,4,7,'1',2,'2013-10-04 15:44:47','saddfasfd','2013-10-07 20:48:38','zeemoadmin'),(63,4,8,'1',1,'2013-10-08 21:18:38','dwe','2013-10-07 20:48:38','zeemoadmin'),(64,5,6,'1',1,'2013-12-11 16:48:14','asfasdf-1','2013-12-10 21:48:14','zeemoadmin');
/*!40000 ALTER TABLE `category_to_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_alt_title_text` varchar(512) NOT NULL,
  `image_quality` varchar(25) NOT NULL,
  `clients_title` varchar(255) NOT NULL,
  `url` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'2014-12-04 03:42:02','button.png','','','asdasd','','1',0,'2014-12-03 15:12:02','zeemoadmin');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_settings`
--

DROP TABLE IF EXISTS `cms_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `right_logo_image_file` varchar(255) NOT NULL,
  `right_logo_image_title` varchar(255) NOT NULL,
  `right_logo_image_alt_title_text` varchar(512) NOT NULL,
  `right_logo_image_quality` varchar(512) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_settings`
--

LOCK TABLES `cms_settings` WRITE;
/*!40000 ALTER TABLE `cms_settings` DISABLE KEYS */;
INSERT INTO `cms_settings` VALUES (1,'black-logo_(1).png','','','','2016-05-05 01:43:55','zeemoadmin');
/*!40000 ALTER TABLE `cms_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `common_settings`
--

DROP TABLE IF EXISTS `common_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `common_settings` (
  `website_logo` varchar(255) NOT NULL,
  `unit_fund` varchar(30) NOT NULL,
  `website_svg_logo` varchar(555) NOT NULL,
  `member_icon1` varchar(255) NOT NULL,
  `icon_url1` text NOT NULL,
  `member_icon2` varchar(255) NOT NULL,
  `icon_url2` text NOT NULL,
  `sender_email` varchar(1024) NOT NULL,
  `sender_name` varchar(1024) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `common_settings`
--

LOCK TABLES `common_settings` WRITE;
/*!40000 ALTER TABLE `common_settings` DISABLE KEYS */;
INSERT INTO `common_settings` VALUES ('logo.png','55','sleepbus.svg','member-11.png','http://www.agra.com.au','member-2.png','http://www.google.com','simon@sleepbus.org','sleepbus','2016-07-07 06:16:59','admin');
/*!40000 ALTER TABLE `common_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `image` enum('0','1') NOT NULL,
  `pdf` enum('0','1') NOT NULL,
  `content` text,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,0,'Company','company',1,'0','0','0','<p>&nbsp;Company</p>','2013-03-10 21:48:52','zeemoadmin'),(2,0,'Profile','company-profile',2,'1','1','1','<p>&nbsp;Company Profile</p>','2013-03-10 22:23:22','zeemoadmin'),(3,0,'Philosophy','philosophy',3,'1','1','1','<p>&nbsp;Philosophy</p>','2013-02-24 20:32:42','zeemoadmin'),(4,0,'Quality','quality',4,'1','1','1','<p>&nbsp;Quality</p>','2013-02-24 20:32:42','zeemoadmin'),(5,0,'Press','press',5,'1','0','0',NULL,'2013-02-24 20:32:42',''),(6,0,'Here we are !','here-we-are',6,'1','0','0','http://www.google.com','2013-02-24 21:07:43','zeemoadmin'),(7,0,'PSG Architects','psg-architects',7,'1','0','0','http://www.doodle.com','2013-02-24 21:07:59','zeemoadmin');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_brochures`
--

DROP TABLE IF EXISTS `company_brochures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_brochures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `brochure_file` varchar(255) NOT NULL,
  `brochure_title` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_brochures`
--

LOCK TABLES `company_brochures` WRITE;
/*!40000 ALTER TABLE `company_brochures` DISABLE KEYS */;
INSERT INTO `company_brochures` VALUES (1,'2013-02-01 10:14:34',3,'Rajesh_Ranjan4.docx','356etdsfasdf','1',1,'2013-03-07 15:06:36','zeemoadmin'),(3,'2013-02-01 10:25:47',3,'Rajesh_Ranjan1.docx','aerfwe','1',1,'2013-03-07 15:06:47','zeemoadmin');
/*!40000 ALTER TABLE `company_brochures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_images`
--

DROP TABLE IF EXISTS `company_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_images`
--

LOCK TABLES `company_images` WRITE;
/*!40000 ALTER TABLE `company_images` DISABLE KEYS */;
INSERT INTO `company_images` VALUES (1,'2013-02-04 03:04:34',1,'pic2.jpg','asdasasdf','1',7,'2013-03-07 14:33:51','zeemoadmin'),(2,'2013-03-08 03:03:10',1,'grey-3d-apple-wallpaper-1280-800-6496.jpg','afdadfas','1',6,'2013-03-07 14:33:51','zeemoadmin'),(3,'2013-03-08 03:03:17',1,'IMG_3071ps1_1280x800.jpg','sgsfsdf','1',5,'2013-03-07 14:33:51','zeemoadmin'),(4,'2013-03-08 03:03:25',1,'2302.jpg','tuiy]uiyui','1',4,'2013-03-07 14:33:51','zeemoadmin'),(5,'2013-03-08 03:03:32',1,'Wallpapers-room_com___MofC_wallpaper_by_alexiuss_1280x800.jpg','hjktyuty','1',3,'2013-03-07 14:33:51','zeemoadmin'),(6,'2013-03-08 03:03:41',1,'Wallpapers-room_com___MofC_wallpaper_by_alexiuss_1280x8001.jpg','ou;oipiop','1',2,'2013-03-07 14:33:51','zeemoadmin'),(7,'2013-03-08 03:03:51',1,'Wallpapers-room_com___Vortex_blackapple_purple_by_mgilchuk_1920x1200.jpg','8697=98789','1',1,'2013-03-07 14:33:51','zeemoadmin');
/*!40000 ALTER TABLE `company_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `address` text NOT NULL,
  `other_details` text NOT NULL,
  `phone` varchar(25) NOT NULL,
  `phone2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Got any question? please don\'t hestitate to contact us by filling this form and our staff will get in touch with you','Klaus Multiparking','648 Glenhuntly Road\r\nSouth Caulfield\r\nVIC 3162','03 9505 3085','1800MULTIPARK 1800685847','','03 9532 9690','2015-07-06 13:01:15','zeemoadmin');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cta`
--

DROP TABLE IF EXISTS `cta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `page_type` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `cta` varchar(244) NOT NULL,
  `cta_status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cta`
--

LOCK TABLES `cta` WRITE;
/*!40000 ALTER TABLE `cta` DISABLE KEYS */;
INSERT INTO `cta` VALUES (1,'2014-05-22 08:19:01','BLOGS_ARCHIVE','May 2013','4,3','1','2014-05-21 22:26:56','zeemoadmin'),(3,'2014-05-22 08:42:20','NEWS','11','6,5,4','1','2014-05-21 22:12:20','zeemoadmin'),(4,'2014-05-22 08:52:57','PRODUCTS','0','4,3','1','2014-05-21 22:22:57','zeemoadmin'),(5,'2014-05-22 08:53:05','CATEGORIES','4','4,3','1','2014-05-21 22:23:05','zeemoadmin'),(6,'2014-05-22 08:53:17','CATEGORIES','5','5,4','1','2014-05-21 22:23:17','zeemoadmin'),(7,'2014-05-22 08:53:50','PRODUCTS','64','4,3','1','2014-05-21 22:23:50','zeemoadmin'),(8,'2014-05-22 08:56:42','BLOGS','0','','1','2016-04-11 16:52:37','zeemoadmin'),(11,'2014-05-22 08:57:35','SINGLE_PAGE','5','','1','2016-04-26 19:46:58','admin'),(12,'2014-12-03 10:55:26','SINGLE_PAGE','4','7','1','2016-05-04 22:39:45','zeemoadmin'),(13,'2014-12-03 10:57:45','SINGLE_PAGE','1','8','1','2016-04-04 22:38:18','admin'),(14,'2014-12-03 10:58:32','PRODUCTS','61','4,3','1','2014-12-02 22:28:32','zeemoadmin'),(15,'2015-12-04 10:12:30','NEWS','0','5,4','1','2015-12-03 21:42:35','zeemoadmin'),(16,'2015-12-04 10:12:42','LANDING_PAGE','4','5,4','1','2015-12-03 21:42:42','zeemoadmin'),(17,'2015-12-04 10:12:50','ABOUT_SECTION','3','5,4','1','2015-12-03 21:42:50','zeemoadmin'),(18,'2015-12-04 10:13:01','ABOUT_SECTION','2','5,4','1','2015-12-03 21:43:01','zeemoadmin'),(19,'2015-12-04 10:13:05','ABOUT_SECTION','0','5','1','2015-12-03 21:43:09','zeemoadmin'),(20,'2016-04-05 04:23:09','BLOGS','52','8','1','2016-04-28 21:52:55','admin'),(21,'2016-04-05 04:23:13','BLOGS','53','','1','2016-04-04 17:53:13','admin'),(22,'2016-04-05 04:23:24','BLOGS_ARCHIVE','March 2016','5','1','2016-04-04 17:53:24','admin'),(23,'2016-04-05 04:23:33','BLOGS_CATEGORIES','33','','1','2016-04-11 17:55:29','admin'),(24,'2016-04-05 04:33:07','PROJECTS','0','8','1','2016-04-27 03:02:09','admin'),(25,'2016-04-05 04:33:17','PROJECTS','2','6,5,4','1','2016-04-04 18:03:17','admin'),(26,'2016-04-12 01:25:44','SINGLE_PAGE','17','','1','2016-04-11 15:22:00','admin'),(27,'2016-04-26 02:09:05','SINGLE_PAGE','15','8','1','2016-04-25 20:09:05','admin'),(29,'2016-04-27 09:01:57','PROJECTS','3','8','1','2016-04-28 20:38:35','admin'),(30,'2016-05-05 03:40:52','SINGLE_PAGE','32','','1','2016-05-04 21:41:40','zeemoadmin'),(31,'2016-05-05 08:04:15','SINGLE_PAGE','38','7','1','2016-05-05 02:04:15','zeemoadmin');
/*!40000 ALTER TABLE `cta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` date NOT NULL,
  `donation_type` varchar(255) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `payer_email` varchar(555) NOT NULL,
  `status` varchar(555) NOT NULL,
  `comment` text NOT NULL,
  `anonymous` varchar(37) NOT NULL,
  `registered_user_id` varchar(55) NOT NULL,
  `profile_id` varchar(255) NOT NULL,
  `profile_status` varchar(255) NOT NULL,
  `correlation_id` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `build` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donations`
--

LOCK TABLES `donations` WRITE;
/*!40000 ALTER TABLE `donations` DISABLE KEYS */;
INSERT INTO `donations` VALUES (1,'2016-05-30','campaign',1,'2016-05-30 09:25:25','GTWUGTJLFWXDCLKVH','2.06','Mr. Giles Welch','heidi@leannon.name','Completed','','','1','GHYZXHMQHXHBIY','','','',''),(2,'2016-06-07','one-time-donation',0,'2016-06-07 20:50:05','WAKMODTZDHFMOPLAM','12.67','Laurence Lakin','lillie@kuphal.org','Completed','','','','IFMIULQSPPDPQP','','','',''),(3,'2016-07-07','one-time-donation',0,'2016-07-07 19:19:21','LQTMPMSOMUVMBSCYC','59.84','Beryl Fritsch','omari@bechtelar.org','Completed','','','','GLRMTNPFGLAABB','','','',''),(4,'2016-07-10','one-time-donation',0,'2016-07-10 15:55:54','DDLKUSOUJZGTGQGAA','94.66','Mrs. Alexzander Berge','burley.olson@sauer.info','Completed','','','','WSPKPQBZBGTBLD','','','',''),(5,'2016-07-14','one-time-donation',0,'2016-07-14 07:06:36','UYFOPODYYWBKVDLUI','15.33','Ryann Gutkowski I','rowena@mcdermott.org','completed','','','','LRXJZCSBTMULCJ','','','',''),(6,'2016-07-18','campaign',16,'2016-07-18 23:04:22','BZMVGPQCWBXBOYSXB','67.63','Margaret Conn','abe@mosciski.org','completed','','','7','KCBHJOJIXGOFWD','','','',''),(7,'2016-07-18','campaign',0,'2016-07-18 23:04:29','GJJFBAFTKUDGHZLBN','99.58','Isac Gerhold','paige.lind@corkerymcglynn.io','','','','7','SCIKMJIBVGJMSC','','','',''),(8,'2016-07-19','campaign',17,'2016-07-19 18:51:40','NFVOVXOJSDNUIAUEZ','1.05','Nathen Emard I','marlene@balistreri.net','completed','','','9','HSBMUKMYEBHIRE','','','',''),(9,'2016-07-19','campaign',16,'2016-07-19 19:57:02','YBHHOXBYOZXUYDBLX','57.53','Willow Farrell','kennedy@walker.com','completed','','yes','','IIPDIHEGSCUGZR','','','',''),(10,'2016-07-24','monthly',0,'2016-07-23 19:58:04','USDFOAHNEEEEMRYUX','71.6','Evans Kreiger','grayson@mccullough.com','Completed','','','','EIAGLFLPCYOMUK','ActiveProfile','a2d1dfc092c15','64','22386173'),(11,'2016-07-24','one-time-donation',0,'2016-07-24 16:27:22','PUBKXQDTLIKYCCITL','6.36','Damaris Goldner','emile@fisherratke.co','completed','','','','WXBHOZQFKKPYJU','','','',''),(12,'2016-07-27','campaign',17,'2016-07-27 23:51:14','MISXUCFFIAJQENROH','64.05','Dr. Julia Hayes','erik.lueilwitz@parisian.co','completed','','','','JHUHUNELTRBFAD','','','',''),(13,'2016-08-03','one-time-donation',0,'2016-08-03 15:49:22','WDRWRTFGNKJIWWEIU','98.31','Mrs. Damian Beatty','sienna_bins@roberts.co','Completed','','','','DUBMIODKKRITTE','','','',''),(14,'2016-08-19','campaign',17,'2016-08-19 10:14:36','NJDGQOVBTDJZSEEGW','34.74','Dr. Anthony Dooley','zola_sawayn@purdy.biz','Completed','','','','PJGHLTOZXUQUBP','','','',''),(15,'2016-08-29','campaign',18,'2016-08-29 22:36:00','CJGLVWGYEFFJREILC','48.38','Luella Medhurst','agustin@rathankunding.co','Completed','','yes','12','OZVRPVQRIKOHLU','','','',''),(16,'2016-08-30','campaign',17,'2016-08-30 08:42:16','WFIZEWDCDVREHKSKB','37.3','Nelda Lindgren','liza@runolfsdottir.net','Completed','','','','NMODRQFBCGBFMO','','','',''),(17,'2016-08-31','campaign',16,'2016-08-31 22:04:51','ORPLZXZWIBFNMNYKE','37.55','Anahi O\'Reilly','constantin@sengerwalker.info','Completed','','','','YYVMQVYCWMDASI','','','',''),(18,'2016-09-07','campaign',17,'2016-09-07 07:52:11','ODPNFNXSQDLYRQMCH','49.22','Miracle Kuhlman','yolanda_bechtelar@grahamrosenbaum.com','Completed','','','','PKPSXQYRDYQHGK','','','',''),(19,'2016-09-09','monthly',0,'2016-09-09 02:40:23','VJADJLDJLDYQHICEU','12.73','Mrs. Faye Ward','constantin@graham.net','Completed','','','','VSOZDZZPFVOFAC','ActiveProfile','b5cd296859900','64','000000'),(20,'2016-09-12','campaign',17,'2016-09-12 17:45:06','GDUNSUKLOMHUXBGWM','12.72','Dr. Tressie Halvorson','haie@vandervort.io','Completed','','','','KCHZOESXFQQGYY','','','',''),(21,'2016-09-14','monthly',0,'2016-09-14 03:51:24','QIUMKOLCAUPDOGBVB','32.75','Mr. Dion Stiedemann','aida.mcglynn@dubuque.net','Completed','','','','AQVRBRRARCQZPM','ActiveProfile','aa0ff4dfed6d5','64','000000'),(22,'2016-09-16','monthly',0,'2016-09-16 06:31:02','VIZJFDHWHYWDBHYWK','63.2','Rebeka Denesik','dovie@bayersteuber.org','Completed','','','','CTODYWZYBDNYKD','ActiveProfile','66bbdabd113d6','64','000000'),(23,'2016-09-19','one-time-donation',0,'2016-09-19 18:12:44','INIOBIWBHWNGWHSQH','33.55','Mr. Hermina Bins','demario@walsh.name','','','','','CAOASPTCKHCBVY','','','',''),(24,'2016-09-21','campaign',17,'2016-09-21 17:41:55','DZGRTVBDRHIZEFFGB','23.47','Chelsie Keeling','bettye@bartolettihomenick.biz','Completed','','','','RMIKZRWOSBTXHX','','','',''),(25,'2016-09-27','monthly',0,'2016-09-27 04:20:08','XNTKVSVOTSKPEURDY','11.25','Theo Emmerich','magdalena@stiedemanntorp.net','Completed','','','','XLAPSSOGAAZUSQ','ActiveProfile','7ca22c3a731a3','64','000000'),(26,'2016-09-29','one-time-donation',0,'2016-09-29 13:14:00','BUPOZRTYUTJXRRGXN','77.67','Lauretta Pagac','dashawn@collier.com','','','','','ASCKWXMLUTQOLN','','','',''),(27,'2016-09-29','one-time-donation',0,'2016-09-29 15:39:35','GWKEPSEVTAOBSMOWX','21.48','Luna Graham PhD','arden_ortiz@hamillschowalter.name','','','','','BRUWEMIIDJMULL','','','',''),(28,'2016-09-29','one-time-donation',0,'2016-09-29 15:41:37','SYMBQFSUQRFRPAOHG','29.33','Orie Hilll','camron_beer@kuhicmitchell.co','Completed','','','','ANWLHHTHRCJJBU','','','',''),(29,'2016-09-30','one-time-donation',0,'2016-09-30 16:51:00','SBESUBAGYZIMRDIXU','39.8','Davion Brekke MD','ibrahim@faycorwin.com','','','','','RNHFVVMXQFPQCD','','','',''),(30,'2016-09-30','one-time-donation',0,'2016-09-30 16:54:17','EJUODVMBHCRUKBEQF','11.48','Mr. Ronaldo Parisian','karli@lockman.biz','Completed','','','','HSGHTVLKTCSNXH','','','',''),(31,'2016-09-30','one-time-donation',0,'2016-09-30 16:54:37','DKJTFEEIOFHWXADJF','57.92','Agustina Kshlerin II','amari_jakubowski@okon.co','','','','','SKKEYRKBTDJMBD','','','',''),(32,'2016-10-03','campaign',17,'2016-10-03 18:06:36','XTOEOZXQIHHBSSHGU','27.16','Amparo Pagac','magdalena@okongoyette.name','Completed','','','','ZEKUYJXUFMJZZL','','','',''),(33,'2016-10-12','campaign',16,'2016-10-12 05:11:12','IRTQLCBMHNJTMBJZW','76.65','Marco Keebler IV','garrett@hoeger.biz','Completed','','yes','','WZRKAPVNPWXPJA','','','',''),(34,'2016-10-13','campaign',17,'2016-10-13 14:53:17','YHZYEDTNSLFABEFXI','71.15','Dr. Tina Sanford','vaughn.damore@kilback.net','Completed','','','','REGSDUUNONMTZQ','','','',''),(35,'2016-10-19','one-time-donation',0,'2016-10-19 06:34:40','VHNIQCOVFJZAGRENE','96.55','Dr. Zetta Thiel','pearlie@moendooley.net','Completed','','','','TMUUOYJNFWBDSM','','','',''),(36,'2016-10-21','campaign',17,'2016-10-21 18:00:47','PDWKEJTMTOIWFIQSZ','78.04','Cristopher Mraz','brandt.barrows@fritschcollins.co','Completed','','','','KOYIHTHHIOSXTH','','','',''),(37,'2016-10-24','one-time-donation',0,'2016-10-24 23:06:29','MLLJZMKLJUUULSJGA','44.56','Marlin Reichel','abraham_heel@dickens.biz','Completed','','','24','MWJTOUZSMZAPAE','','','',''),(38,'2016-10-26','monthly',0,'2016-10-26 10:50:06','QREHDUPBEGIAOKCAL','92.04','Alice Bode','nathen@wyman.name','Completed','','','','JLSNPBPZLEHCZF','ActiveProfile','b3e21094c6e17','64','24616352'),(39,'2016-10-26','monthly',0,'2016-10-26 11:35:06','UTZZNHHYVMUAXSUOB','56.3','Lavonne Bechtelar','schuyler.ruecker@mraz.info','Completed','','','','CJXJNKSXZJBEKZ','ActiveProfile','f169c860e79fa','64','24616352'),(40,'2016-10-26','monthly',0,'2016-10-26 11:58:57','MPVWTDNHDOKWDJDOF','58.25','Lea Bosco','johanna@lowe.biz','Completed','','','','MLCMOHEGTTYMLZ','ActiveProfile','ef1eee70bb8c4','64','24616352'),(41,'2016-10-28','campaign',17,'2016-10-28 22:50:45','VDCVMZIRDKMKABSYT','13.24','Jamarcus Toy','ludie.lockman@abernathy.io','Completed','','','','DRUXPVARYVPHCP','','','',''),(42,'2016-10-29','monthly',0,'2016-10-29 03:34:34','TKWEASZTGMKRDHWKL','28.93','Torrey Beer','noble@johns.net','Completed','','','','RSYQISYBGDHINA','ActiveProfile','455474c77133b','64','24616352'),(43,'2016-10-29','campaign',17,'2016-10-29 16:14:53','XIMBLBTTZAZKWPJAH','44.31','Pietro Lakin','cale.okon@robel.name','Completed','','','','WETYJUSAIDXBHN','','','',''),(44,'2016-11-09','one-time-donation',0,'2016-11-09 04:19:46','XJIIRVWXZEHZFRRXO','15.58','Lily Wilkinson','graciela@kohlerkrajcik.org','Completed','','','','OPPNNNGVJHSMRL','','','',''),(45,'2016-11-10','campaign',17,'2016-11-10 14:24:27','TKHYJORBKVKDURUGH','25.96','Kristopher Mann','kaylie.harvey@heel.co','Completed','','','','ZHFWEQIGHJIGGL','','','',''),(46,'2016-11-11','campaign',24,'2016-11-11 10:18:31','CBOSXWHCSOVAFIZXS','34.94','Jeramy Bosco','antonetta@dickinson.biz','Completed','','','','BAQWWXHPLKTDIN','','','',''),(47,'2016-11-11','campaign',24,'2016-11-11 11:15:22','PODSUFPHOIPKULLLU','84.64','Mrs. Hester Greenholt','ari@jacobson.net','Completed','','','','AZEJGJGBREJBQR','','','',''),(48,'2016-11-11','campaign',24,'2016-11-11 19:11:17','WMEXQFCORHDQOMQOY','22.99','Eileen Rau II','jimmy_ortiz@stiedemann.name','','','','','IZUHKYOPAGFUWO','','','',''),(49,'2016-11-13','campaign',24,'2016-11-13 10:33:35','BRZTGJKXYUFKGRAGP','7.05','Citlalli Raynor','wiley@nicolasjenkins.net','Completed','','','','WGMZTMXVAXQCEY','','','',''),(50,'2016-11-15','campaign',24,'2016-11-15 09:47:50','KGCMWCWKGXPXSNYTR','97.06','Lelah Lubowitz','kaylee_ratke@eichmann.com','Completed','','','','KGYPXLOQVYFYTV','','','',''),(51,'2016-11-25','campaign',24,'2016-11-25 12:41:43','ASLXVEQOVOHDLZHXC','83.53','Cora Rempel','dawn.welch@daniel.name','Completed','','','','PIQDJUADPEICBF','','','',''),(52,'2016-11-25','campaign',24,'2016-11-25 12:45:55','AELCGTAXQKUYNIBWQ','44.68','Cicero VonRueden','abdul.muller@okuneva.name','Completed','','','','MHIWFGEUCWLLPP','','','',''),(53,'2016-11-26','one-time-donation',0,'2016-11-26 14:26:50','KLUYMYYRDXOWNTXTO','99.38','Elias Douglas','kenyon@bins.co','Completed','','','31','WMRXUKIANROVPO','','','',''),(54,'2016-11-28','campaign',17,'2016-11-28 13:31:40','FOXHZZPQVZODZYJIU','72.15','Kiera Block','deonte_west@feil.info','Completed','','','','ACBHJFPSJDWGFT','','','',''),(55,'2016-12-02','campaign',27,'2016-12-02 16:21:35','MBAGFQJDBBVWVHFMT','16.52','Shany Lang','adriel@erdman.net','Completed','','','12','BLFZDTTNZIOCZJ','','','',''),(56,'2016-12-04','campaign',25,'2016-12-04 09:47:44','JBRHEAVWCEDFVREEN','16.18','Ottis Schaefer','austen_wolff@little.co','Completed','','','','MDTDHBNKCPDEBM','','','',''),(57,'2016-12-06','one-time-donation',0,'2016-12-06 17:01:04','LSECUBXZMEZNPZVSB','95.11','Bettye Fay','maximo@corwin.info','Completed','','','','OZNDOJJBIUBHNK','','','',''),(58,'2016-12-06','campaign',27,'2016-12-06 22:00:13','XNEHOJPZKBNJTQZDC','25.36','Kristin Zieme','fredy@fadel.org','Completed','','','','VTECNRDNBLYWVF','','','',''),(59,'2016-12-08','campaign',27,'2016-12-08 01:22:45','UGIIJNXLORYHXLWAF','39.14','Colten Roberts DDS','izaiah_smitham@lockmanohara.net','Completed','','','','IKTXJDNSSNZKMX','','','',''),(60,'2016-12-12','campaign',17,'2016-12-12 13:53:41','YJLMUAELKVZIJGRUN','74.23','Ms. Kayden Ondricka','hosea_nader@rennerweimann.io','Completed','','','','ONSHMTZOEDQSPS','','','',''),(61,'2016-12-12','one-time-donation',0,'2016-12-12 20:43:31','POERGKHNSYGEZIVCL','50.24','Antonetta Tremblay','jairo.upton@becker.co','Completed','','','','PJJQOJLWDBRYFA','','','',''),(62,'2016-12-13','one-time-donation',0,'2016-12-13 12:47:30','UYCGNIPGTYLVEJAHN','24.53','Royal Price','johnnie@boyerflatley.io','Completed','','','','ELZNDTNLUAULXZ','','','',''),(63,'2016-12-14','one-time-donation',0,'2016-12-14 17:54:05','SPXTLXATCXSRJUMYH','26.02','Janet Conroy','ronny@ebert.name','Completed','','','','QBVIOVVBPVYXAE','','','',''),(64,'2016-12-15','monthly',0,'2016-12-14 23:18:13','ZKHRXGGTQEPVINHQS','88.41','Dr. Karlie Denesik','shakira@stanton.net','Completed','','','','SDZFHEFOOGNWZT','ActiveProfile','98c307baef6f8','64','24616352'),(65,'2016-12-17','one-time-donation',0,'2016-12-17 10:19:29','PNPNQBANJOVRFWIFA','90.73','Barbara Fay','damien@carroll.info','Completed','','','','BXOWAJVDCCXQLA','','','',''),(66,'2016-12-17','campaign',27,'2016-12-17 21:31:31','EDCNZMHGTVZEWQHPY','83.83','Hank Hilpert','wendell@price.org','Completed','','yes','','ZPOMGZLABSWZZK','','','',''),(67,'2016-12-18','campaign',27,'2016-12-18 14:11:59','GLGRHIDYGRRERKOOF','97.21','Vern Stiedemann PhD','osvaldo@donnellystamm.org','Completed','','yes','','SMLRAOWTNSNAVR','','','',''),(68,'2016-12-18','campaign',25,'2016-12-18 20:23:11','LQXPGZLGNODYCPDXM','23.1','Bessie Wolff','kiana@ruelbarton.com','Completed','','','33','CHHMSPQKRTBAUO','','','',''),(69,'2016-12-19','campaign',27,'2016-12-19 13:33:59','MFVPDPAORICQGEROI','47.6','Shawna Abbott V','helga@keeling.io','Completed','','','','VZGRFTEFNIRZIE','','','',''),(70,'2016-12-19','campaign',27,'2016-12-19 23:50:00','HBUGOWSEWKYCQIAGK','39.0','Wendell Bosco','telly@donnelly.info','Completed','','','','LJPBKATCFWNISA','','','',''),(71,'2016-12-20','monthly',0,'2016-12-19 23:45:12','TBFPGACQLXDHIAJFX','10.94','Boyd Langosh','newell_cain@spinka.io','Completed','','','','PFSBIPLBGHMKYG','ActiveProfile','d93cf9cec54d','64','24616352'),(72,'2016-12-20','campaign',27,'2016-12-20 23:54:54','DTEOTVPXASAFMCMIM','39.25','Cooper Baumbach','margarita.wuckert@christiansen.biz','Completed','','','','GNLUYDWPQOOLYH','','','',''),(73,'2016-12-22','one-time-donation',0,'2016-12-22 00:59:53','EYNGDNEQWSXXMZPIH','45.8','August Bergstrom','katherine.okuneva@purdy.org','Completed','','','','MAYCXMEAISFWKV','','','',''),(74,'2016-12-22','one-time-donation',0,'2016-12-22 00:59:53','QCWNCIUPMLUYOSURJ','7.1','Ericka Roberts','gabriella@nicolasfeeney.io','Completed','','','','GRTFMWZEGQLLAI','','','',''),(75,'2016-12-22','one-time-donation',0,'2016-12-22 08:36:04','MNXACFFLCJCOROQGW','23.44','Eloy Sawayn','alyon.hirthe@konopelski.biz','Completed','','','','FLFIBDMQHVOWZF','','','',''),(76,'2016-12-22','one-time-donation',0,'2016-12-22 18:08:35','ZAGELCRGOFPJGUJSD','40.58','Clemens Stokes','kristofer@nicolasbins.io','Completed','','','','AZDPZEAZRXONLR','','','',''),(77,'2016-12-24','one-time-donation',0,'2016-12-24 20:05:32','GGUJVAAGHCSRJSOHP','20.44','Agustina Williamson','lennie@bodelindgren.name','Completed','','','','LGFOAKJDNTFQMX','','','',''),(78,'2016-12-24','one-time-donation',0,'2016-12-24 20:15:29','RXVQTPGTEKUBHBBIU','57.42','Giovani Greenfelder','edna@keebler.info','Completed','','','','FNYQGXHDARJGWK','','','',''),(79,'2016-12-25','campaign',17,'2016-12-25 12:07:00','ZSOYVUBYUPHPOSXXH','55.71','Blanche Pacocha','dayana_botsford@runolfsdottirheidenreich.co','Completed','','','','UZPRGVCTZZUYKQ','','','',''),(80,'2016-12-25','one-time-donation',0,'2016-12-25 12:52:51','OWOCKJFLRSQVIOYEM','25.79','Ena Bode','marina@bergekreiger.org','Completed','','','','LWIHBHZUFGHSFP','','','',''),(81,'2016-12-26','campaign',17,'2016-12-26 21:03:05','IUQIXDDLCRDWTBGDD','58.85','Willis Herzog','cecile@adams.io','Completed','','','','NABYJOJMMBRDBG','','','',''),(82,'2016-12-27','one-time-donation',0,'2016-12-27 10:41:23','KSRJECRFFPNNTWIMU','5.13','Julius Mills','brooklyn_oreilly@collierhaley.name','Completed','','','','MOZSXORXPQCZBF','','','',''),(83,'2016-12-28','campaign',17,'2016-12-28 13:33:54','YTJRYPYBMAXVEREZD','51.37','Misael Beier','shakira@windler.com','Completed','','','','SPPONXCXQIBEPT','','','',''),(84,'2016-12-29','one-time-donation',0,'2016-12-29 18:11:33','NDGIVPQKWJEKXRDPG','66.51','Kelton Lebsack','keyon@wilderman.org','Completed','','','','ZRPRDCTVJPUMDQ','','','',''),(85,'2016-12-30','one-time-donation',0,'2016-12-30 15:18:59','TXXGJPDGMRQWQXJAO','79.83','Chad Hartmann','lola.vandervort@hahn.com','Completed','','','','HPLMFZZYTEMHSC','','','',''),(86,'2017-01-07','campaign',17,'2017-01-07 12:51:25','BZLPYXPMVEMMOFQYB','31.83','Barney Halvorson','taya.schmeler@dachhaag.co','Completed','','','','DINQGENOGGDSCO','','','',''),(87,'2017-01-07','campaign',17,'2017-01-07 12:52:18','XBGPYVGXZKMKDLQAF','39.09','Leif Murazik IV','dawson.bosco@runolfon.com','Completed','','','','YSDCBKELTYLFBR','','','',''),(88,'2017-01-09','campaign',27,'2017-01-09 18:13:04','RMEXRHVVSUKJFWARB','11.86','Antonio Koepp Jr.','hester@champlin.name','Completed','','yes','','WBSJWIESGBEPGE','','','',''),(89,'2017-01-09','campaign',0,'2017-01-09 18:13:04','EKTJUTJOQDMLJXKZK','59.08','Chaim Murray','mark@wolff.biz','Completed','','','','WIBPSCNGSYRLOM','','','',''),(90,'2017-01-09','campaign',27,'2017-01-09 20:26:33','TCSOVMZTEZMXLDJXD','11.77','Lorna Veum','ed.funk@bechtelar.com','Completed','','yes','','CFOSRFDCPUGIJZ','','','',''),(91,'2017-01-09','campaign',0,'2017-01-09 20:26:33','KZENXNDCYYONSQEIA','92.77','Idell Gleichner','andre_nolan@mitchell.name','Completed','','','','OKABVPHURNBZCS','','','',''),(92,'2017-01-09','campaign',27,'2017-01-09 22:22:16','WXLVNSFLDRRGICGVC','61.72','Norma Hoppe','caandre@monahan.info','Completed','','yes','','QYZPNAAYMZCCTO','','','',''),(93,'2017-01-09','campaign',27,'2017-01-09 23:42:48','YAJMMSNOOEENFLEDP','51.73','Eleonore Flatley','adolfo.fadel@ward.net','Completed','','','','LCPAKWREKWPHMD','','','',''),(94,'2017-01-10','one-time-donation',0,'2017-01-10 02:33:25','FEYFSAHCFORLDYBNK','80.69','Jan Altenwerth','ruthe@ziemannnader.name','Completed','','','','CJQPELJMQRCWXI','','','',''),(95,'2017-01-20','campaign',17,'2017-01-20 10:48:17','RZUAKBROJYRGJEQOD','40.54','Drew Hermiston V','hester@schulist.name','Completed','','','','WHDZNZZQNVYBGO','','','',''),(96,'2017-01-24','one-time-donation',0,'2017-01-24 19:33:49','DLTOWRDUYGYFODHJB','45.0','Arden Sanford II','brianne.tillman@mcculloughtoy.info','Completed','','','','DYNYEYZJQCAADS','','','',''),(97,'2017-01-26','campaign',27,'2017-01-26 11:31:31','CBGHWDZFSXNQKGOZG','62.47','Bert Smith PhD','ryder@legros.com','Completed','','','','VZXSGIGWITMCYM','','','',''),(98,'2017-02-08','one-time-donation',0,'2017-02-08 09:37:22','XAPKQNIMTVXFFTBCY','25.91','Winston Little','neva@auer.co','Completed','','','','ARVJXBYJNXTCJD','','','',''),(99,'2017-02-11','one-time-donation',0,'2017-02-11 09:11:56','XTSGNHQRGGNDYNJNU','13.24','Eulalia Greenfelder III','layne@wuckertfay.io','Completed','','','','IWJAUJHUQETLKL','','','',''),(100,'2017-02-11','one-time-donation',0,'2017-02-11 11:01:27','USKSRSMTFANRQIBWT','12.0','Jimmie Schneider','lorna@ratke.biz','Completed','','','','FAMPJBTITAFZUX','','','',''),(101,'2017-02-12','one-time-donation',0,'2017-02-12 13:16:33','WWBAJGRSWTMDZJRRA','64.45','Sasha Wisoky','elza@langoshprohaska.net','Completed','','','','DUVQRTKOWJKCAC','','','',''),(102,'2017-02-21','one-time-donation',0,'2017-02-21 20:06:01','JILYTAPSWBDGYOANX','15.66','Miss Santina Friesen','maynard@sawayn.biz','Completed','','','','JPJWFVCGFITCFB','','','',''),(103,'2017-02-24','one-time-donation',0,'2017-02-24 23:39:44','OSVGULVCOXHMMZHBV','50.05','Malvina Kutch','lindsey@daughertyharber.io','Completed','','','','WQUKCBLMMPASVE','','','',''),(104,'2017-02-25','one-time-donation',0,'2017-02-25 10:38:54','HABTQYIHNKWZQSHZD','5.64','Dane Wolff','eleazar.weinat@sengerarmstrong.net','Completed','','','','JVHVHHEFVWMJIU','','','',''),(105,'2017-02-26','campaign',24,'2017-02-26 21:00:49','JQODJBKSEMTLYNPSS','34.98','Mark Wolff','corrine@bednardicki.io','Completed','','yes','','WBBNAMWGAJFMNB','','','',''),(106,'2017-02-27','one-time-donation',0,'2017-02-27 21:58:07','PCYQGPOJQPCQFVJTC','96.71','Maya Marvin','vida@connellysimonis.com','Completed','','','','WJOGZBOCVUHVKS','','','',''),(107,'2017-03-02','one-time-donation',0,'2017-03-02 14:17:55','NPDLFSACVATOZVKJT','62.05','Hailie Stracke','coby@bosco.co','Completed','','','','MLUDNZLACZNEQV','','','',''),(108,'2017-03-03','campaign',33,'2017-03-03 19:05:16','NUVPPNDEJNZBRMNQO','37.82','Tillman Daniel','elenor_feeney@murray.info','Completed','','','','QHROWCZUTLIJUY','','','',''),(109,'2017-03-03','monthly',0,'2017-03-03 09:25:58','DQLLSEVMVITBWJNAS','52.08','Beatrice Tremblay','luciano@lindjohnston.org','Completed','','','','XSSYAYHQGOTYCM','ActiveProfile','7811138995bfa','64','25237094'),(110,'2017-03-03','campaign',24,'2017-03-03 08:25:58','YLYQCLCQBPDHOKFKB','86.31','Abdiel Runolfsson','francis.rippin@hammes.info','Completed','','','','GFKPDRRPTXAFPF','ActiveProfile','','',''),(111,'2017-03-05','campaign',17,'2017-03-05 21:45:02','KVKAVEUZMZLQWAJON','14.38','Adele Kohler','cole@ortizquigley.org','Completed','','','','ZSSHQEHOYSIGJT','','','',''),(112,'2017-03-05','campaign',17,'2017-03-03 08:25:58','GDJNPJFBJIWIHGFYB','71.01','Florian Erdman','jonathan_stanton@zemlak.io','Completed','','','','TIROYSWSETTIJL','','','',''),(113,'2017-03-05','campaign',17,'2017-03-03 08:25:58','FELDCDAWRNLGENWYD','67.56','Dane Wintheiser','guido@fisher.co','Completed','','','','UFVDKLKQFFWGYH','','','',''),(114,'2017-03-10','campaign',27,'2017-03-10 09:27:35','NQZEGQJDTRUBJTRND','22.33','Ophelia Kling','camille_pagac@pouros.org','Completed','','','','BGFJQTMRHQKKUC','','','',''),(115,'2017-03-14','one-time-donation',0,'2017-03-14 01:35:50','KPKXETACVWKUWUVIC','31.15','Ms. Kian O\'Hara','shana_dare@baumbachturner.co','Completed','','','','WVBFQQAUGPYFYG','','','',''),(116,'2017-03-14','campaign',34,'2017-03-14 15:52:14','CVXGEAOUGNYNNIBOD','54.8','Lola Abshire','freddie@sporerblick.io','Completed','','','12','YJVGZHGSLHFXUF','','','',''),(117,'2017-03-14','campaign',34,'2017-03-14 15:56:27','GHNXSEEYKDHSMVFZL','97.74','Nickolas Harber DVM','angelo@uptonstehr.com','Completed','','','','VLOGTPWSXHHHDH','','','',''),(118,'2016-08-06','campaign',17,'2016-08-06 08:25:58','NZBGPPUEMBBLACCLA','43.63','Kayla Braun','dorian_lubowitz@windler.io','Completed','','','','CFXEJGNEHDIFOP','','','',''),(119,'2016-10-09','campaign',17,'2016-10-09 08:25:58','VCUHFTCKZHCHNUOPL','75.2','Khalid Boyle','juvenal_dickinson@krajcikheel.name','Completed','','','','XYAVMCEOYEPZRT','','','',''),(120,'2017-03-15','campaign',17,'2017-03-15 17:11:03','XYVWRRMVDSUZFGFUU','50.04','Anastacio Hoppe','elenora.larkin@mueller.info','Completed','','','','CHHYLPBUQSYGLR','','','',''),(121,'2017-03-15','campaign',34,'2017-03-15 21:20:13','XFMGIZODBKWSARVJR','82.75','Linnea Mills','albertha@simonis.info','Completed','','yes','','VEBFSPJJINTQPP','','','',''),(122,'2017-03-16','campaign',34,'2017-03-16 00:00:00','QRMMWTYPCXBMWTTQP','69.35','Eula O\'Hara','robyn@torphyboyer.net','Completed','','','','GPFUZTVIMDKDZR','','','',''),(123,'2017-03-17','one-time-donation',0,'2017-03-17 13:04:51','QDNMZKAIOBKGSIVDM','44.44','Miss Nyasia Hickle','shawna@veumstoltenberg.net','Completed','','','','JFTEUZZMVKLFCI','','','',''),(124,'2017-03-18','one-time-donation',0,'2017-03-18 17:49:03','YLXERHHWZUDDKHJUB','35.14','Christ Nitzsche','karianne.schuppe@strosin.org','Completed','','','','MILKNAWAVYVRJQ','','','',''),(125,'2017-03-19','campaign',34,'2017-03-19 20:07:46','GYMVEUZMUJEPHEKRR','9.78','Twila O\'Conner II','berry@schmidt.name','Completed','','','','QXIQGDRUXYYMXC','','','',''),(126,'2017-03-19','campaign',34,'2017-03-19 20:12:22','DPFZDHTTGCZWANHMJ','41.82','Jed VonRueden','lizzie@doyle.biz','Completed','','','','VWSWCGJDSBJQWE','','','',''),(127,'2017-03-21','one-time-donation',0,'2017-03-21 17:06:31','DLFOLKFIKADOAFXNL','19.99','Dr. Camden Green','gia.davis@quitzon.org','Completed','','','','FFQNKSSKQADUAS','','','',''),(128,'2017-03-24','one-time-donation',0,'2017-03-24 13:52:08','TNMBMRIBHXLFLCBEJ','31.54','Rylan Walker','vicente@deckowharvey.info','Completed','','','','CLNOILHOXBDJSU','','','',''),(129,'2017-03-29','campaign',33,'2017-03-29 19:48:01','KLPEFXIKWGPQCGDSV','35.38','Ian Dooley','maddison.koch@thiel.biz','Completed','','','','PYFVPUJGASFCAT','','','',''),(130,'2017-03-30','campaign',24,'2017-03-30 07:51:27','TNZKGYNRWTCGXDBYL','99.14','Ali Romaguera','percival_kerluke@damorepollich.net','Completed','','yes','','ZYGVMWPYWGMQSK','','','',''),(131,'2017-03-31','one-time-donation',0,'2017-03-31 15:58:30','JOQDLKFFRESHWLQQC','50.97','Karelle Kessler Sr.','golda_bahringer@bartell.io','Completed','','','','DGCCJBKZDGHEBL','','','',''),(132,'2017-04-01','one-time-donation',0,'2017-04-01 10:57:50','YRABYMSGVPCFJWVAU','53.03','Reina Nienow','connie_ruel@krajcikwaelchi.biz','Completed','','','','OERMIWBTJDQSFJ','','','',''),(133,'2017-04-01','one-time-donation',0,'2017-04-01 10:57:54','AFTGZHNUUQPGAEJQG','75.48','Bella Kub','tabitha@fisherfarrell.name','Completed','','','','QZLUWRNVKDUFJU','','','',''),(134,'2017-04-01','one-time-donation',0,'2017-04-01 11:12:22','XDDDOIWSQLYQXLDTQ','33.15','Miss Dominique Hintz','myrtle@schroeder.co','Completed','','','','FTETTBFOZDLTED','','','',''),(135,'2017-04-01','one-time-donation',0,'2017-04-01 11:24:38','DKOBZAMHANVSYEXRK','84.66','Miss Minerva Collier','bennett@robel.io','Completed','','','','OKNVUSDATKNABK','','','',''),(136,'2017-04-01','one-time-donation',0,'2017-04-01 11:28:46','UPFTBKLEEFAFYVMDU','74.73','Melisa Kiehn','savion_kutch@gibson.info','Completed','','','','JSTGPWQWWDXVDS','','','',''),(137,'2017-04-01','one-time-donation',0,'2017-04-01 11:32:58','ENVAWTYEUMOVQGPTQ','22.7','Mr. Eddie Friesen','bo.barton@hirthedonnelly.org','Completed','','','','DLWQUJTOZLZPNW','','','',''),(138,'2017-04-01','one-time-donation',0,'2017-04-01 11:43:52','MZFPHKFNVXKOCDLGT','61.17','Schuyler Bartoletti','lolita.reilly@wisozk.co','Completed','','','','TXWDHLAFCLPCVC','','','',''),(139,'2017-04-01','one-time-donation',0,'2017-04-01 11:51:00','RZHCJZOQMIPVUOUTU','21.24','Britney Koss','aubrey@konopelskideckow.io','Completed','','','','BCJRVAEWDCFYVS','','','',''),(140,'2017-04-01','one-time-donation',0,'2017-04-01 12:12:25','FDNFWTUNCXAWWGPGG','20.36','Karli Howe Sr.','lula_schmidt@walter.io','Completed','','','','QTXNIEKGAAVTTC','','','',''),(141,'2017-04-01','one-time-donation',0,'2017-04-01 12:17:28','ZNOAINVTLHYRFRIFP','94.82','Meta Marquardt','kale@bergnaumjacobs.biz','Completed','','','','YJRUHXONATKBDQ','','','',''),(142,'2017-04-01','one-time-donation',0,'2017-04-01 12:27:36','MGEDDMXTZAJLWHWIC','20.77','Omer Olson','tavares.volkman@hoppe.org','Completed','','','','WNFDZZUMRNEIRV','','','',''),(143,'2017-04-01','one-time-donation',0,'2017-04-01 12:46:51','LPYQSUDATTNEMHCDK','50.44','Rosetta Hilpert','vallie@upton.co','Completed','','','','PVWNMLKAGFNAMW','','','',''),(144,'2017-04-01','one-time-donation',0,'2017-04-01 13:13:02','UOHRQJDRKPJMJUOOE','15.4','Leta Gleason','tavares_steuber@willmspfannerstill.com','Completed','','','','KPIDWEWLTGFASJ','','','',''),(145,'2017-04-01','one-time-donation',0,'2017-04-01 17:18:15','RNXNKSZPMFVMMXHFR','10.59','Ms. Ursula Kuhic','buford_beer@bodedare.biz','Completed','','','','BGLPCBHWZLBWWF','','','',''),(146,'2017-04-01','one-time-donation',0,'2017-04-01 18:35:42','KKQRZSAHBWMXUSRQI','64.48','Jocelyn Gaylord','lamont.jones@hoegerdubuque.info','Completed','','','','TPUAJNFPJOYTPU','','','',''),(147,'2017-04-01','one-time-donation',0,'2017-04-01 23:13:43','CEZTHJHPSPYSVQXXZ','17.43','Norene Hand','max.koch@treutel.org','Completed','','','','VYQRHTPQGWRRDJ','','','',''),(148,'2017-04-02','one-time-donation',0,'2017-04-02 14:07:56','RMONPNROGWKWWDSFW','42.48','Beau Dibbert','leonie@heidenreichbogisich.com','Completed','','','','EDBFNSZQOFQJHT','','','',''),(149,'2017-04-03','one-time-donation',0,'2017-04-03 10:31:14','HMMNVKLEXSBHYDUOM','63.74','Mrs. Ettie Koss','trevor.pagac@wizaemard.net','Completed','','','','ZBQRTEEZATHJOR','','','',''),(150,'2017-04-03','campaign',33,'2017-04-03 11:31:08','EFWWLPKBKMVHRIUUZ','71.51','Katlyn Nikolaus','anastasia.reynolds@okunevaokon.info','Completed','','','','DZLGXDDMOTAOOD','','','',''),(151,'2017-04-03','campaign',33,'2017-04-03 14:31:08','XUKYWCCZCJBQXODZN','58.41','Kaleb Kemmer I','ludie@harveyhoeger.com','Completed','','','','QSPQAMEZTAOEPL','','','',''),(152,'2017-04-03','campaign',17,'2017-04-03 13:38:11','VUZUYAWTWFOIXLVIQ','98.39','Emanuel Lynch Jr.','reanna@olson.net','Completed','','','','UNVAVQAORIICIZ','','','',''),(153,'2017-04-04','campaign',34,'2017-04-04 18:31:59','ANGWVFADVZZWCFSHX','27.92','Lelah Mann','addie@huel.biz','Completed','','','','YPLUKFMTGMEOHZ','','','',''),(154,'2017-04-07','campaign',24,'2017-04-07 07:51:27','PWIRMYNAWAJYSNAHE','37.77','Tianna Ziemann Sr.','vincenzo_weber@zulauf.com','Completed','','','','KCEHLSZAKGVTPK','','','',''),(156,'2017-04-08','one-time-donation',0,'2017-04-08 14:11:04','QEVQFZLMARWCXGUWJ','79.26','Henriette Gerlach III','emory@wisozk.com','Completed','','','','EQXMZOWHVBKROG','','','',''),(157,'2017-04-13','campaign',34,'2017-04-13 17:25:25','TFLRXKNAKCJHBBQHV','45.14','Buster Miller','raegan.pacocha@wuckert.org','Completed','','','','ODMWNCHGIEKLXB','','','',''),(158,'2017-04-13','campaign',34,'2017-04-13 17:26:27','NQKMVURNCBTVSKSXU','57.97','Trenton Emmerich','alba@towne.io','Completed','','','','KEAQUVNRHYUJIT','','','',''),(159,'2017-04-13','campaign',34,'2017-04-13 18:14:18','ZPCXIZSDZVTVPFPRG','37.17','Maximilian Farrell','kristy@williamson.net','Completed','','','','NCXKHBLOBEEZTS','','','',''),(160,'2017-04-13','campaign',34,'2017-04-13 18:59:27','ZERXMZNGLAVNCLRER','55.29','Rozella Franecki','lia.jerde@strosindach.com','Completed','','','','RFMTKCTYIIVGWQ','','','',''),(161,'2017-04-13','campaign',34,'2017-04-13 19:00:56','GRFIONTEGRNKPJQWI','45.79','Miss Raven Mann','margarita_graham@reilly.com','Completed','','','','ZZEXNUOMHJVXXD','','','',''),(162,'2017-04-13','campaign',34,'2017-04-13 20:01:28','PAJVRJZZCANWCYEOZ','20.42','Geovanny Jacobi I','frederik@konopelski.info','Completed','','','','EQAHOUUNVJEIAO','','','',''),(163,'2017-04-14','one-time-donation',0,'2017-04-14 10:00:53','CWUBKAJUVGNZBOOIP','49.75','Fernando Hartmann','timmy_adams@brakus.info','Completed','','','','CNBXMOJWMFZGWM','','','',''),(164,'2017-04-14','campaign',34,'2017-04-14 22:23:45','CKISFQSAFHAJETXSH','88.22','Rowena Schulist','dariana_welch@ryan.net','Completed','','','','PKKCMFDDMKRKLE','','','',''),(165,'2017-04-18','campaign',34,'2017-04-18 20:57:56','QGKNFDFVZKBCXCRUQ','18.09','Miss Macey Fahey','jaren@bahringer.co','Completed','','','','ZAWGSKFCGPEFKL','','','',''),(166,'2017-04-19','campaign',34,'2017-04-19 09:52:55','RAEYPARZDTBSZCICF','77.78','Dr. Destini Schumm','vincenza.wolf@lakin.info','Completed','','','','NYWJMWDYGVVFHN','','','',''),(167,'2017-04-19','campaign',34,'2017-04-19 09:58:32','YXFZEEJJDASDUGWRG','38.23','Margie Gutkowski','lane.lesch@feeney.co','Completed','','','','ISJFMJRVMYSXOE','','','',''),(168,'2017-04-19','campaign',34,'2017-04-19 10:05:56','UAWIOQVKYTUDFNFDH','9.73','Mrs. Alexanne Buckridge','tina@botsfordcasper.org','Completed','','','','OVMKDNCDYCLPYO','','','',''),(169,'2017-04-19','campaign',34,'2017-04-19 10:08:26','XJWCQERJOJKVDRGEW','40.82','Mrs. Oswald Denesik','greyson_bechtelar@schuppe.org','Completed','','yes','','XVTWNGTVNLSANE','','','',''),(170,'2017-04-20','campaign',24,'2017-04-20 07:39:53','YBULSORWWRRKPZUHR','46.64','Madyson Welch','friedrich_wisozk@rice.io','Completed','','','','PGHFSZQQPFYIVN','','','',''),(171,'2017-04-20','campaign',33,'2017-04-20 18:15:35','NVMDPOJHPVGONENNI','7.98','Amely Mitchell','karli@wehner.net','Completed','','','','QCYZOMAJHQXKCT','','','',''),(172,'2017-04-20','campaign',33,'2017-04-20 22:19:09','OXBRFKZGBAXTKZSCA','26.77','Norene Waters MD','alexane_heathcote@hodkiewiczdubuque.info','Completed','','','','SUQAKFSKKZHTYL','','','',''),(173,'2017-04-20','campaign',33,'2017-04-20 22:19:07','QBVUJIDMFGYHCBMRX','27.32','Megane Bechtelar II','trey@lowe.org','Completed','','','','JIEFHANZEANJOI','','','',''),(174,'2017-04-21','campaign',33,'2017-04-21 09:07:50','YMFKNFPPTJCDOPJSO','77.16','Erin Dibbert','edythe.hilll@blickstoltenberg.net','Completed','','','','LVQPBPFBNKHOGU','','','',''),(175,'2017-04-21','campaign',34,'2017-04-21 19:02:35','TSXDLDKABOTYABXOX','71.93','Evan Ziemann PhD','greta@homenick.biz','Completed','','','','UKUJLBDQTZGFFN','','','',''),(176,'2017-04-21','campaign',34,'2017-04-21 19:03:36','GVHWMPJGMXJAYRDWZ','84.2','Dr. Alex Hermiston','lavada.mcglynn@ondricka.org','Completed','','','','ITTMABRSDHTNUF','','','',''),(177,'2017-04-21','campaign',34,'2017-04-21 19:04:31','MTFZAMQBPMIZCBRUX','41.73','Chanelle Swift','ralph.ebert@walshrohan.org','Completed','','','','VTSCTTUWTKOSGQ','','','',''),(178,'2017-04-21','campaign',34,'2017-04-21 19:05:22','MSMLXIJDQKCSKWQEN','33.93','Clementina Bernhard','gielle@starkdibbert.com','Completed','','','','QBNKIXOAUHGQNB','','','',''),(179,'2017-04-24','campaign',33,'2017-04-24 15:08:00','MSUBLBBSDPEOMSIZZ','68.19','Miss Avis Carroll','nakia_fisher@ruelschaden.biz','Completed','','','','GPJVBIPFFZJVRD','','','',''),(180,'2017-04-26','campaign',33,'2017-04-26 09:59:46','OYCUCKSMFATBKTJSX','1.56','Zella Torphy V','sandy@reichert.io','Completed','','','','RJGVUCZWHPPRGV','','','',''),(181,'2017-04-28','campaign',17,'2017-04-28 15:06:46','KZQJDWTSAKNMSHHTI','49.53','Percy Hoeger','tre.hettinger@klocko.co','Completed','','','','CXTVPAKDMQYXJX','','','',''),(182,'2017-04-28','campaign',17,'2017-04-28 15:31:00','SJHHZRRIMSQFYIHKP','39.86','Dr. Henri Eichmann','rodrick@haley.name','Completed','','','','JPUSPHSVJFHNYT','','','',''),(183,'2017-05-04','campaign',33,'2017-05-04 15:39:41','SOPKBSGRTOQEXDTYW','14.12','Dr. Zion Moore','winnifred.feil@rathwelch.co','Completed','','yes','','CSDLXYWPQRBTBL','','','',''),(184,'2017-05-08','one-time-donation',0,'2017-05-08 10:07:50','ODORAQGERUKKBRUYJ','67.88','Durward Kohler','dortha_satterfield@boyle.io','Completed','','','','TSMBQCMIYLQYPQ','','','',''),(185,'2017-05-09','campaign',0,'2017-05-09 20:46:21','VUCOQZKYGEFJJXLMN','27.29','Mr. Sylvan Franecki','jakayla_nicolas@stokesconn.name','Completed','','','','HHRKCMCJOGYAZB','','','',''),(186,'2017-05-11','one-time-donation',0,'2017-05-11 16:03:15','KKQNWRVYHBHJCSPQC','2.48','Omer Klocko MD','cary.torphy@metzlittel.io','Completed','','','','HHRYROPQLMWFWV','','','',''),(187,'2017-05-14','one-time-donation',0,'2017-05-14 16:03:47','YQPWTILARASHOPZSG','22.22','Kelli Rau IV','lester_ruel@kutch.biz','Completed','','','','WFTHSBNTRMSFRA','','','',''),(188,'2017-05-15','one-time-donation',0,'2017-05-15 15:22:00','OKMJWZSHKEDZOJCLA','28.16','Coleman Wisoky','aurelia_harber@lynchkerluke.io','Completed','','','','OAWBUVYQTKXOPP','','','',''),(189,'2017-05-16','one-time-donation',0,'2017-05-16 10:06:15','YDMPTATFPJIDAWTHG','46.86','Junius Leffler','lysanne_tremblay@trompschaden.biz','Completed','','','','LJTHKIJLXBCEBG','','','',''),(190,'2017-05-18','campaign',33,'2017-05-18 11:57:57','WWHPMODPOYCWOVGBA','88.39','Clint Larkin','devyn@cormiernicolas.com','Completed','','','','USCNJGWKLZLGJN','','','',''),(191,'2017-05-22','one-time-donation',0,'2017-05-22 12:43:50','CMKJUFOYQPEROQMQR','70.04','Marilie Cassin','zoila@heller.io','Completed','','','','IHZFMVCSGWCETK','','','',''),(192,'2017-05-22','campaign',33,'2017-05-22 14:33:05','GLFMAEZXRZBGTMOJP','96.8','Marjorie Reichel','cloyd.goldner@kozey.biz','Completed','\'It works on my machine\' always holds true for Chuck Norris.','','','ZXDPZWFEHCLJDG','','','','');
/*!40000 ALTER TABLE `donations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `download_categories`
--

DROP TABLE IF EXISTS `download_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `download_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` date NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download_categories`
--

LOCK TABLES `download_categories` WRITE;
/*!40000 ALTER TABLE `download_categories` DISABLE KEYS */;
INSERT INTO `download_categories` VALUES (5,'2013-02-22','Brochure Park & Smile','','1',1,'2013-03-11 22:41:45','zeemoadmin');
/*!40000 ALTER TABLE `download_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brochure_file` varchar(255) NOT NULL,
  `brochure_title` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads`
--

LOCK TABLES `downloads` WRITE;
/*!40000 ALTER TABLE `downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_messages`
--

DROP TABLE IF EXISTS `email_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` text NOT NULL,
  `dateadded` datetime NOT NULL,
  `subject` text NOT NULL,
  `sender_email` varchar(1024) NOT NULL,
  `sender_name` varchar(1024) NOT NULL,
  `receiver_to_emails` text NOT NULL,
  `receiver_cc_emails` text NOT NULL,
  `receiver_bcc_emails` text NOT NULL,
  `receiver` enum('1','0') NOT NULL,
  `message` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_messages`
--

LOCK TABLES `email_messages` WRITE;
/*!40000 ALTER TABLE `email_messages` DISABLE KEYS */;
INSERT INTO `email_messages` VALUES (1,'Connect','2014-12-03 00:00:00','Connect | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','edmond.senger@torpkaulke.org','','','1','<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(2,'Speaker Request','2016-04-05 00:00:00','Request | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','marguerite_aufderhar@mosciski.co','','','1','<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(3,'User Signup [Message to Admin]','2016-04-16 11:38:40','Signup | Sleepbus','sendmail@testingsleepbus.org','Sleep Bus','shyann@schambergerkoch.name','','','1','<p>A new user signed up with following informaiton</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(4,'User Signup [Message to User]','2016-04-16 11:38:33','Thank you for signing up to sleepbus','sendmail@testingsleepbus.org','Sleep Bus','dino@robel.info','','','0','<p>Hi&nbsp;<span style=\"line-height: 1.6em;\">[[USER FULL NAME]],</span></p>\r\n\r\n<p>Thanks for signing up to sleepbus. Your login details are listed below. You can sign in to your account at any time <a href=\"https://www.sleepbus.org/signin\">here</a>.</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(5,'Reset Password Message [Forgot Password : Message to User]','2016-04-19 12:17:32','sleepbus: Password Oops','sendmail@testingsleepbus.org','Sleep Bus','mable@kuvalis.net','','','0','<p>Oops, forgot your password? Don&#39;t worry, it happens to us all. Let&#39;s get you a new one.</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(6,'Birthday Pledge [Message to Admin]','2016-04-28 00:00:00','Birthday Pledge | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','georgette_bergstrom@millerturcotte.name','','','1','<p>A new birthday pledge has been created by a user with following information.</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(7,'Birthday Pledge [Message to User]','2016-04-28 00:00:00','Your birthday is about to changes lives. Here\'s how.','sendmail@testingsleepbus.org','Sleep Bus','ian.glover@schinner.com','','','0','<p>You pledged your birthday for safe sleeps! What does that mean, exactly? It means that you&#39;ve decided to celebrate your birthday by raising money to provide safe sleeps for people sleeping rough. Maybe you&#39;ll throw a party and ask for contributions at the door. Or offer to do something outrageous if friends donate. Or simply ask for donations to safe sleeps instead of gifts. We&#39;ll remind you when your birthday is closer, or <a href=\"https://www.sleepbus.org/signin\">start now</a>.</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(8,'Birthday Reminder  Cron Job [Message to User]','2016-04-28 00:00:00','It\'s time for your birthday to change lives. Let\'s Go!','sendmail@testingsleepbus.org','sleepbus','willard@price.org','','','0','<p>It&#39;s time to take action. You pledged your birthday for safe sleeps! What does that mean, exactly? It means that you decided to celebrate your birthday by raising money to provide safe sleeps for people sleeping rough. Have you decided what you are going to do. Maybe throw a party and ask for contributions at the door. Are you doing something outrageous if friends donate?&nbsp;Or, are you simply asking for donations to safe sleeps instead of gifts?&nbsp;Have fun!</p>','2017-05-23 17:37:42','admin'),(9,'Fundraise Form [Message to Admin]\n','2016-04-28 00:00:00','New Campaign | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','dalton_schuster@roob.biz','','','1','<p>A new campaign has been created by a user with following information given below:</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(10,'Fundraise Form [Message to User]\n','2016-04-28 00:00:00','You\'re awesome. Thank you','sendmail@testingsleepbus.org','Sleep Bus','otis@erdman.net','','','0','<p>Hey, thank you so much for starting a campaign for sleepbus. Truly appreciated. We can&#39;t wait to see what you get up to. Make sure you share your campaign with everyone you know and we wish you the best of luck. Have fun&nbsp;:)</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(11,'Message to Donors When User Update And Comments','2016-04-28 00:00:00','sleepbus: News Flash','sendmail@testingsleepbus.org','Sleep Bus','remington_breitenberg@parkergrimes.net','','','0','<p>Hey, new information is now available on the sleepbus campaign you&#39;re supporting. Login in now to see whats happening.</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(12,'One Time Donation [Message to Admin]\n','2016-04-28 00:00:00','New Donation | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','grayson@gusikowskikutch.com','','','1','<p>A new donation is made on website. Please follow the information given below:</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(13,'One Time Donation [Message to User]\n','2016-04-28 00:00:00','Donation | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','vallie@dare.net','','','0','<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(14,'Recurring/Monthly Donation [Message to Admin ]\n','2016-04-28 00:00:00','New Recurring Donation | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','jeika@fay.com','','','1','<p>A new recurring profile has been created on <strong>Paypal</strong> for donation to the Sleep Bus. Profile details are given below.</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(15,'Recurring/Monthly Donation  [Message to User]','2016-04-28 00:00:00','Recurring Donation Profile Created | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','myrtie.lemke@feil.io','','','0','<p>Hi,<br />\r\nA new recurring donation account has been created on <strong>PayPal </strong>with the following information.</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(18,'Campaign Donation [Message to Admin]\n','2016-04-28 00:00:00','Campaign Donation | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','ruel.gibson@stamm.name','','','1','<p>Hi,</p>\r\n\r\n<p>A new donation has been made. Please follow the information below</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(19,'Campaign Donation [Message to Creator]\n\n','2016-04-28 00:00:00','New Donation has been made to your campaign','sendmail@testingsleepbus.org','Sleep Bus','natalia@will.biz','','','0','<p>Hi,<br />\r\nA new donation has been made for your campaign. Please follow the information given below.<br />\r\n&nbsp;</p>\r\n\r\n<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(20,'Campaign Donation [Message to User]\n\n','2016-04-28 00:00:00','Campaign Donation | Sleep Bus','sendmail@testingsleepbus.org','Sleep Bus','sammy_bernhard@schmidt.io','','','0','<p>[[BODY]]</p>','2017-05-23 17:37:42','admin'),(21,'Campaign Expiration Cron Job on End Date [Message to Campaign Creator] ','2016-04-28 00:00:00','Campaign Expired | Sleepbus','sendmail@testingsleepbus.org','sleepbus','alexanne_crist@gerhold.net','','','0','<p>Hi [[CAMPAIGN_CREATER]],</p>\r\n\r\n<p>Your campaign [[CAMPAIGN_NAME]] created on [[CREATION_DATE]] has been expired.</p>\r\n\r\n<p>&nbsp;</p>','2017-05-23 17:37:42','admin');
/*!40000 ALTER TABLE `email_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `date_entered` date NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` VALUES (1,'How a website improve your marketting values?','<p>Website not only advertise but also saw the relevant information about our business to our customer</p>','2014-05-23','1',1,'2014-12-03 14:34:38','zeemoadmin');
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage_banners`
--

DROP TABLE IF EXISTS `homepage_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homepage_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_quality` varchar(25) NOT NULL,
  `image_alt_title_text` varchar(512) NOT NULL,
  `details` text NOT NULL,
  `url` text NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage_banners`
--

LOCK TABLES `homepage_banners` WRITE;
/*!40000 ALTER TABLE `homepage_banners` DISABLE KEYS */;
INSERT INTO `homepage_banners` VALUES (2,'0000-00-00 00:00:00','banner51.jpg','','','<h2><a href=\"#\">Park and Smile</a><br />\r\nAre you still searching, or do you already park in a KLAUS Multiparking system?</h2>\r\n\r\n<p>KLAUS Multiparking has been one of the leading manufacturers of parking systems in Germany for almost 50 years. We have representations in over 65 countries worldwide. Our headquarters is in the south of Germany close to the Lake of Constance.</p>\r\n','','1',10,'2015-09-17 23:47:41','zeemoadmin'),(12,'0000-00-00 00:00:00','Screen_Shot_2015-09-12_at_10_29_33_am.png','','','<p>asdfasdf</p>\r\n','','1',9,'2015-09-17 23:47:41','zeemoadmin'),(13,'0000-00-00 00:00:00','Screen_Shot_2015-09-12_at_10_38_34_am_-_Copy.png','','','<p>asdfasdf</p>\r\n','','1',8,'2015-09-17 23:47:41','zeemoadmin'),(14,'0000-00-00 00:00:00','fitout3.jpg','','','<p>asdfasfd</p>\r\n','','1',6,'2015-09-17 23:47:41','zeemoadmin'),(15,'0000-00-00 00:00:00','404_65.png','','','<p>asdfasdf</p>\r\n','','1',2,'2015-09-17 23:47:41','zeemoadmin'),(16,'0000-00-00 00:00:00','404_611.png','','','<p>asdfasdf</p>\r\n','','1',1,'2015-09-17 23:47:41','zeemoadmin');
/*!40000 ALTER TABLE `homepage_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `icon_settings`
--

DROP TABLE IF EXISTS `icon_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `icon_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_icon_name` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `hover_image` varchar(512) NOT NULL,
  `intro_text` text NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `icon_settings`
--

LOCK TABLES `icon_settings` WRITE;
/*!40000 ALTER TABLE `icon_settings` DISABLE KEYS */;
INSERT INTO `icon_settings` VALUES (4,'Why Us','http://devs/ci-application/','img4.png','img5.png','<p>CTA content including icon, title and intro text</p>\r\n',6,'1','2016-05-25 06:26:03','zeemoadmin','2014-05-22 00:00:00'),(5,'Expertise','http://devs/ci-application/','img51.png','img6.png','<p>CTA main content</p>\r\n',5,'1','2016-05-25 06:26:03','zeemoadmin','2014-05-22 00:00:00'),(7,'Donate page CTA','','','','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"container\">\r\n<div class=\"row donateh2\">\r\n<h2>Other ways you can get involved</h2>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome cta4home\">\r\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon2.png\" /></div>\r\n\r\n<p>Pledge your next Birthday for safe sleeps.</p>\r\n<a class=\"btn btn-success\" href=\"https://www.sleepbus.org/pledge\">PLEDGE</a></div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome cta4home\">\r\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon3.png\" /></div>\r\n\r\n<p>Do something crazy or creative to raise money.</p>\r\n<a class=\"btn btn-info\" href=\"https://www.sleepbus.org/fundraise\">FUNDRAISE</a></div>\r\n</div>\r\n</div>\r\n</div>',4,'1','2017-02-14 18:40:18','zeemoadmin','2016-04-05 00:00:00'),(8,'Three ways you can get involved','','','','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\n<div class=\"container\">\n<div class=\"row donateh2\">\n<h2>Here are three ways you can get involved</h2>\n\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome cta4home\">\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon1.png\" /></div>\n\n<p>For $27.50 you can give a good night&rsquo;s sleep.</p>\n<a class=\"btn btn-primary\" href=\"https://www.sleepbus.org/donate\">Donate</a></div>\n\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome cta4home\">\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon2.png\" /></div>\n\n<p>Pledge your next Birthday for safe sleeps.</p>\n<a class=\"btn btn-success\" href=\"https://www.sleepbus.org/pledge\">PLEDGE</a></div>\n\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome cta4home\">\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon3.png\" /></div>\n\n<p>Do something crazy or creative to raise money.</p>\n<a class=\"btn btn-info\" href=\"https://www.sleepbus.org/fundraise\">FUNDRAISE</a></div>\n</div>\n</div>\n</div>',3,'1','2017-02-14 18:40:18','zeemoadmin','2016-04-05 00:00:00'),(9,'Mission','','','','<div class=\"projectcolorbox\">To achieve our mission we need 300+ buses providing 2,000,000 safe sleeps per year in Australia.</div>\r\n',2,'1','2016-05-25 06:26:03','admin','2016-04-27 00:00:00'),(10,'LIke what you see','','','','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"container\">\r\n<div class=\"row donateh2\">\r\n<h2>Like what you see?<br />\r\nHere&#39;s three ways you can get involved</h2>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome cta4home\">\r\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon1.png\" /></div>\r\n\r\n<p>For $27.50 you can give a good night&rsquo;s sleep.</p>\r\n<a class=\"btn btn-primary\" href=\"#\">Donate</a></div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome cta4home\">\r\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon2.png\" /></div>\r\n\r\n<p>Pledge your next Birthday for safe sleeps.</p>\r\n<a class=\"btn btn-success\" href=\"#\">PLEDGE</a></div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome cta4home\">\r\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon3.png\" /></div>\r\n\r\n<p>Do something crazy or creative to raise money.</p>\r\n<a class=\"btn btn-info\" href=\"#\">FUNDRAISE</a></div>\r\n</div>\r\n</div>\r\n</div>',1,'1','2017-02-14 18:40:18','zeemoadmin','2016-04-27 00:00:00');
/*!40000 ALTER TABLE `icon_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landingpages`
--

DROP TABLE IF EXISTS `landingpages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landingpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `page_heading` varchar(300) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `dateadded` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landingpages`
--

LOCK TABLES `landingpages` WRITE;
/*!40000 ALTER TABLE `landingpages` DISABLE KEYS */;
INSERT INTO `landingpages` VALUES (4,'Competition','page heading2','competition','<p>Landing page content</p>','','','',NULL,'2017-03-21 10:14:14','admin',1,'1'),(5,'Landing page2','this is landing page1 heading2','landing-page2','<p>adf</p>','','','','2015-12-29 09:18:39','2016-08-03 04:47:41','admin',2,'0');
/*!40000 ALTER TABLE `landingpages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_sources`
--

DROP TABLE IF EXISTS `lead_sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_sources`
--

LOCK TABLES `lead_sources` WRITE;
/*!40000 ALTER TABLE `lead_sources` DISABLE KEYS */;
INSERT INTO `lead_sources` VALUES (1,'Google','1',6,'2013-02-21 16:20:02','2016-06-02 12:38:52','zeemoadmin'),(2,'In the news','1',1,'2013-02-21 16:20:26','2016-06-02 12:38:55','admin'),(3,'Other','1',7,'2015-08-18 00:00:00','2016-06-02 12:38:52','admin'),(5,'From a friend','1',3,'2016-05-05 00:00:00','2016-06-02 12:38:52','admin'),(6,'Facebook','1',4,'2016-05-05 00:00:00','2016-06-02 12:38:52','zeemoadmin'),(7,'Twitter','1',5,'2016-05-05 00:00:00','2016-06-02 12:38:52','zeemoadmin'),(8,'On \"The Project\"','1',2,'2016-06-02 00:00:00','2016-06-02 12:38:55','admin');
/*!40000 ALTER TABLE `lead_sources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `message` text NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` VALUES (1,'Contact-Enquiry','Madalyn Carter','Joesph Kilback','anne.lebsack@block.org','328.377.5253 x9409','','','2017-05-23 17:37:42'),(2,'Contact-Enquiry','Mr. Sean Smith','Halle Carroll','jeff@zboncak.co','1-172-046-6674 x9836','','','2017-05-23 17:37:42'),(3,'speaker-request','Trisha Nikolaus','Miss Mark Schimmel','elia_ratke@rutherford.com','(150) 220-3615','','','2017-05-23 17:37:42'),(4,'Contact-Enquiry','Marcel Ebert','Julia Johnson','efrain_pouros@kobednar.net','401-360-2457 x5156','','','2017-05-23 17:37:42'),(5,'Contact-Enquiry','Frederik Hodkiewicz','Mariana Brekke MD','haylee.douglas@emard.io','1-711-460-3497 x732','','','2017-05-23 17:37:42'),(6,'Contact-Enquiry','Dr. Fern Spencer','Carmela Jacobi','gillian@koelpin.org','(432) 210-7602 x1435','','','2017-05-23 17:37:42'),(7,'Contact-Enquiry','Miss Logan Botsford','Darian Schimmel PhD','dasia@jacobs.info','268.632.0081 x5953','','','2017-05-23 17:37:42'),(8,'Contact-Enquiry','Obie Bogisich','Dr. Bettie Hane','reynold_treutel@cormier.com','(353) 888-9667 x24856','','','2017-05-23 17:37:42'),(9,'Contact-Enquiry','Cicero Barrows','Raul Toy','vivienne.hintz@bartoletti.net','(488) 336-3470','','','2017-05-23 17:37:42'),(10,'Contact-Enquiry','Maude Altenwerth Jr.','Hettie Feil','floy_yost@mcglynnrippin.com','576-570-3184','','','2017-05-23 17:37:42'),(11,'Contact-Enquiry','Amber Romaguera','Nella Zboncak','sean.goldner@sanford.net','283.549.3107','','','2017-05-23 17:37:42'),(12,'Contact-Enquiry','Carmelo Corkery','Armando Torphy','erna_huels@streich.io','505.270.2514','','','2017-05-23 17:37:43'),(13,'Contact-Enquiry','Ms. Lucio Treutel','Gennaro Schuster','beulah_heathcote@hayes.biz','(704) 851-2684','','','2017-05-23 17:37:43'),(14,'Contact-Enquiry','Isabel Fahey','Giuseppe Funk IV','modesta@funkbayer.io','776-625-6876','','','2017-05-23 17:37:43'),(15,'Contact-Enquiry','Mr. Abagail Mante','Libby Kiehn','evangeline.bruen@mraz.name','399-281-1305 x09538','','','2017-05-23 17:37:43'),(16,'Contact-Enquiry','Patrick Hamill II','Andrew Dare','nyah.trantow@heller.biz','834-538-7015 x082','','','2017-05-23 17:37:43'),(17,'speaker-request','Charlie Schoen','Erica Hand','lavada_schowalter@pouros.com','898.427.8359 x894','','','2017-05-23 17:37:43'),(18,'Contact-Enquiry','Kristy Weissnat','Americo Batz','dax@spinka.name','(281) 808-1371','','','2017-05-23 17:37:43'),(19,'Contact-Enquiry','Emmanuelle Towne','Martine Hamill','bradly@kaulke.org','387.765.1755 x121','','','2017-05-23 17:37:43'),(20,'Contact-Enquiry','Watson Gutmann PhD','Jesse Schulist','felicity.crist@quigleyherman.io','(889) 803-9301','','','2017-05-23 17:37:43'),(21,'Contact-Enquiry','Edwina Lemke','Keely Ortiz','zetta.hills@reingerbogisich.org','621-216-1829','','','2017-05-23 17:37:43'),(22,'Contact-Enquiry','Mrs. Brant Kerluke','Dane Conroy','bette@oconnellwiza.biz','1-972-529-2024','','','2017-05-23 17:37:43'),(23,'Contact-Enquiry','Dr. Ari Kilback','Favian Koepp DVM','friedrich@roberts.name','833-680-3754 x295','','','2017-05-23 17:37:43'),(24,'Contact-Enquiry','Ismael Lemke','Leopold Lind','idell_parker@dickens.biz','336-866-1127 x61679','','','2017-05-23 17:37:43'),(25,'Contact-Enquiry','D\'angelo Howe','Ms. Samson Becker','malika_heel@pfannerstill.org','336-426-0983','','','2017-05-23 17:37:43'),(26,'Contact-Enquiry','Cole Crooks','Leola Toy','laria@hyatt.net','715.750.7056','','','2017-05-23 17:37:43'),(27,'Contact-Enquiry','Charlie Huel','Magdalen Feil','conrad@hickle.com','206.050.9305 x453','','','2017-05-23 17:37:43'),(28,'Contact-Enquiry','Hailee Dibbert','Rebeka Upton','maya_larkin@mullermoriette.com','1-315-904-1537 x994','','','2017-05-23 17:37:43'),(29,'Contact-Enquiry','Else Runte','Juliana Grimes DVM','sonia.stanton@prohaska.name','1-130-173-1949 x3097','','','2017-05-23 17:37:43'),(30,'Contact-Enquiry','Ashtyn Stroman','Vinnie Altenwerth','schuyler@simonis.biz','346-218-4471 x48210','','','2017-05-23 17:37:43'),(31,'Contact-Enquiry','Rashawn Lubowitz','Suzanne Daugherty MD','joanne.kirlin@okeefe.name','987-631-0682 x64578','','','2017-05-23 17:37:43'),(32,'Contact-Enquiry','Charley Koelpin MD','Ms. Erica Cremin','georgianna@millchinner.org','227.527.9904','','','2017-05-23 17:37:43'),(33,'Contact-Enquiry','Kris Nolan','Ruth Auer I','britney@wuckert.info','241.971.5609 x51687','','','2017-05-23 17:37:43'),(34,'Contact-Enquiry','Mrs. Karlie King','Isaac Osinski','maxine.oreilly@bergnaumjerde.io','1-744-605-3362 x535','','','2017-05-23 17:37:43'),(35,'Contact-Enquiry','Elliot Predovic','Mr. Nestor Hamill','verna.thompson@erdmandicki.co','(327) 249-3212','','','2017-05-23 17:37:43'),(36,'Contact-Enquiry','Celestino Ward','Vella Von','jacquelyn_rodriguez@nicolas.net','156-507-7607','','','2017-05-23 17:37:43'),(37,'Contact-Enquiry','Queenie Kuvalis','Rafael Tillman','silas_baumbach@mccluredonnelly.biz','1-369-128-3666 x6932','','','2017-05-23 17:37:43'),(38,'Contact-Enquiry','Roxanne Beatty DDS','Sanford Dietrich','niko@welch.org','196.609.9239 x894','','','2017-05-23 17:37:43'),(39,'Contact-Enquiry','Mrs. Dexter Roob','Clementina Kunde','mohammed_cormier@veum.name','679-876-1857 x1120','','','2017-05-23 17:37:43'),(40,'Contact-Enquiry','Jaden Ankunding','Jadon Conn','keyshawn.cormier@kirlinkeler.biz','470-292-8505 x118','','','2017-05-23 17:37:43'),(41,'Contact-Enquiry','Pietro Fadel','Imani Hane','bridget_rempel@haagbeier.com','(762) 041-2062 x96513','','','2017-05-23 17:37:43'),(42,'Contact-Enquiry','Shaina Wiza IV','Dr. Shaniya Murazik','leone_corkery@bechtelar.net','785-177-3412','','','2017-05-23 17:37:43'),(43,'Contact-Enquiry','Mr. Ryann Larson','Newell Koch','vernon_olson@schaden.com','1-890-792-9810 x558','','','2017-05-23 17:37:43'),(44,'Contact-Enquiry','Eudora Greenholt DVM','Naomi Cormier','lillie.brakus@kihn.net','1-224-827-2039 x1748','','','2017-05-23 17:37:43'),(45,'Contact-Enquiry','Odessa Hand','Garnet Pacocha','branson.bradtke@gleichner.info','756.975.8364 x5393','','','2017-05-23 17:37:43'),(46,'Contact-Enquiry','Jermey King','Ms. Karley Leannon','joan@champlin.biz','1-209-587-2581 x35040','','','2017-05-23 17:37:43'),(47,'Contact-Enquiry','Miss Coleman Jacobs','Titus Ward','lexie.kihn@pfeffer.net','763.217.3598 x322','','','2017-05-23 17:37:43'),(48,'Contact-Enquiry','Annette Hirthe','Jadyn Murazik','danielle_effertz@kreiger.name','866-255-3012','','','2017-05-23 17:37:43'),(49,'Contact-Enquiry','Dr. Rosa Gerhold','Heber Haley','luna@oreilly.biz','1-224-139-2406 x82409','','','2017-05-23 17:37:43'),(50,'Contact-Enquiry','Celine Rolfson','Vinnie Zieme','sherman@kuvaliatterfield.io','(780) 913-6817 x08894','','','2017-05-23 17:37:43'),(51,'Contact-Enquiry','Maye Eichmann MD','Madison Little','ru@feeney.info','443-213-6666','','','2017-05-23 17:37:43'),(52,'Contact-Enquiry','Joesph Waelchi','Nyasia Stark','elnora.rice@kohoeger.info','1-650-883-2370','','','2017-05-23 17:37:43'),(53,'Contact-Enquiry','Savannah Upton','Frank VonRueden MD','kaylie_carroll@schmidt.biz','610.124.4502','','','2017-05-23 17:37:43'),(54,'Contact-Enquiry','Merl Bosco','Holly Towne','katrina@fisherwolf.info','(608) 811-8763 x210','','','2017-05-23 17:37:43'),(55,'Contact-Enquiry','Rahsaan Gottlieb Sr.','Mr. Devon Feest','hester_hauck@heathcotetrantow.net','1-171-880-4363 x134','','','2017-05-23 17:37:43'),(56,'Contact-Enquiry','Jackson McClure','Kristoffer Kris','marjorie_wyman@vandervortlegros.co','603-431-4780','','','2017-05-23 17:37:43'),(57,'Contact-Enquiry','Bonita Anderson','Delores Morissette DVM','anibal@gerhold.org','403.549.1943 x60986','','','2017-05-23 17:37:43'),(58,'Contact-Enquiry','Frida Aufderhar','Letha Purdy','jeramy@kuhlman.name','(796) 571-3412','','','2017-05-23 17:37:43'),(59,'Contact-Enquiry','Dr. Isaias Lind','Marcelo Collins','cesar@wolffdach.org','402.032.1886 x587','','','2017-05-23 17:37:43'),(60,'Contact-Enquiry','Miss Dayne Parker','Colt Hauck','mertie@herzog.org','1-601-668-9172 x58351','','','2017-05-23 17:37:43'),(61,'Contact-Enquiry','Queen Dicki','Robin Homenick','roscoe@ortiz.net','(616) 013-9435 x630','','','2017-05-23 17:37:43'),(62,'Contact-Enquiry','Alexander Rau','Francis Kemmer','darius.mayer@stokes.org','(996) 645-8157 x808','','','2017-05-23 17:37:43'),(63,'Contact-Enquiry','Jacquelyn Rath','Dr. Odie Grady','conner@lehner.org','770.750.4070 x202','','','2017-05-23 17:37:43'),(64,'Contact-Enquiry','Haleigh Goyette','Mr. Graciela Schaefer','jaleel_anderson@robel.io','724.599.1777','','','2017-05-23 17:37:43'),(65,'speaker-request','Sienna Lang','Marilou Fahey','burnice.larkin@lubowitz.net','(464) 716-3637','','','2017-05-23 17:37:43'),(66,'Contact-Enquiry','Vernon Weber I','Alexandre Pagac V','roxane_kovacek@rodriguez.co','413-037-0034 x9831','','','2017-05-23 17:37:43'),(67,'Contact-Enquiry','Demetrius Green','Verna Hyatt','sonya.flatley@brekkecarter.info','1-468-227-7425','','','2017-05-23 17:37:43'),(68,'Contact-Enquiry','Sabina Will','Santiago Purdy','vicky.schuster@ernser.name','1-631-366-1705 x367','','','2017-05-23 17:37:43'),(69,'Contact-Enquiry','Aurelio Maggio','Dorcas McCullough','jerad.cremin@mccullough.biz','1-384-992-8682 x809','','','2017-05-23 17:37:43'),(70,'Contact-Enquiry','Elva Hayes','Darryl Hansen','pearlie_heller@moriettekautzer.com','993-145-7996','','','2017-05-23 17:37:43'),(71,'Contact-Enquiry','Deborah Kuphal Jr.','Prince Gutmann','stacy@bruen.info','1-877-656-8804 x4587','','','2017-05-23 17:37:43'),(72,'Contact-Enquiry','Gracie Olson','Hank O\'Reilly','kolby@huels.net','(117) 062-2925','','','2017-05-23 17:37:43'),(73,'Contact-Enquiry','Rowena Raynor','Cleveland Reilly','monique@johnsonbreitenberg.info','235-014-6397','','','2017-05-23 17:37:43'),(74,'Contact-Enquiry','Lindsay Jast V','Jaylin Feeney','adeline_kunze@carterohara.co','378.538.2391 x75983','','','2017-05-23 17:37:43'),(75,'Contact-Enquiry','Wilhelmine Dickens','Antonina Luettgen','kieran@white.biz','(128) 150-2441','','','2017-05-23 17:37:43'),(76,'Contact-Enquiry','Jaycee Jast','Ms. Rudy Torp','ruthe_kihn@ondricka.io','(586) 563-6079','','','2017-05-23 17:37:43'),(77,'Contact-Enquiry','Priscilla Nitzsche','Anita Swaniawski','vita_price@koch.com','613.524.8589 x628','','','2017-05-23 17:37:43'),(78,'Contact-Enquiry','Maurice Trantow','Alberta Wisozk V','lillian@legros.name','842.011.4089 x8994','','','2017-05-23 17:37:43'),(79,'Contact-Enquiry','Mathilde Brekke','Jose Anderson III','christine@shields.info','1-705-860-2042 x633','','','2017-05-23 17:37:43'),(80,'Contact-Enquiry','Rolando Harris III','Lenna Harris','sven_boyer@jenkins.co','(663) 260-9832 x1169','','','2017-05-23 17:37:43'),(81,'Contact-Enquiry','Keenan Ullrich','Shany Murray','kara@ferry.name','1-635-282-8030 x34059','','','2017-05-23 17:37:43'),(82,'Contact-Enquiry','Mr. Vanessa Bartoletti','Susanna Yost','rose.beahan@bayer.io','(899) 237-7634 x93616','','','2017-05-23 17:37:43'),(83,'Contact-Enquiry','Alicia Waters PhD','Lawrence Yundt','ania.kemmer@lemke.org','1-295-480-6868 x37823','','','2017-05-23 17:37:43'),(84,'Contact-Enquiry','Lea Effertz II','Addison Wolf','pascale_ruecker@gerlach.co','(305) 282-3490','','','2017-05-23 17:37:43'),(85,'Contact-Enquiry','Carissa Ziemann','Wilber Rau','donnell@mccullough.biz','148-278-4896 x9448','','','2017-05-23 17:37:43'),(86,'Contact-Enquiry','Brett Hoppe III','Otho Franecki','liza@okonheaney.name','225.788.7476 x8301','','','2017-05-23 17:37:43'),(87,'Contact-Enquiry','Noelia Cummings','Kendall Jerde','erin_reynolds@kunze.net','607.637.5423','','','2017-05-23 17:37:43'),(88,'Contact-Enquiry','Miss Angelo Jacobs','Merlin Nader','charley@grant.io','1-733-116-2007','','','2017-05-23 17:37:43'),(89,'Contact-Enquiry','Arlene Pollich','Martin Rolfson','nona@mann.name','291.469.1885 x74000','','','2017-05-23 17:37:43'),(90,'Contact-Enquiry','Brando Rodriguez','Ethan Legros','dan_blick@anderson.com','1-626-531-3811','','','2017-05-23 17:37:43');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level_to_modules`
--

DROP TABLE IF EXISTS `level_to_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level_to_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1077 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level_to_modules`
--

LOCK TABLES `level_to_modules` WRITE;
/*!40000 ALTER TABLE `level_to_modules` DISABLE KEYS */;
INSERT INTO `level_to_modules` VALUES (1006,6,2),(1007,114,2),(1008,123,2),(1009,151,2),(1010,157,2),(1011,148,2),(1012,137,2),(1013,128,2),(1014,142,2),(1015,8,2),(1016,96,2),(1017,83,2),(1018,108,2),(1019,80,2),(1020,1,2),(1021,7,2),(1022,21,2),(1023,116,2),(1024,115,2),(1025,124,2),(1026,125,2),(1027,126,2),(1028,127,2),(1029,154,2),(1030,152,2),(1031,153,2),(1032,155,2),(1033,156,2),(1034,158,2),(1035,159,2),(1036,161,2),(1037,149,2),(1038,150,2),(1039,160,2),(1040,140,2),(1041,141,2),(1042,138,2),(1043,139,2),(1044,129,2),(1045,130,2),(1046,131,2),(1047,132,2),(1048,143,2),(1049,144,2),(1050,145,2),(1051,146,2),(1052,147,2),(1053,23,2),(1054,107,2),(1055,76,2),(1056,97,2),(1057,98,2),(1058,133,2),(1059,99,2),(1060,136,2),(1061,84,2),(1062,85,2),(1063,86,2),(1064,87,2),(1065,109,2),(1066,110,2),(1067,111,2),(1068,81,2),(1069,82,2),(1070,135,2),(1071,15,2),(1072,16,2),(1073,17,2),(1074,18,2),(1075,19,2),(1076,40,2);
/*!40000 ALTER TABLE `level_to_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_items`
--

DROP TABLE IF EXISTS `media_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `media_title` varchar(555) NOT NULL,
  `publication` varchar(555) NOT NULL,
  `url` text NOT NULL,
  `date_display` date NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_items`
--

LOCK TABLES `media_items` WRITE;
/*!40000 ALTER TABLE `media_items` DISABLE KEYS */;
INSERT INTO `media_items` VALUES (3,'2016-04-13 14:29:27','This Australian guy is buying 300 charter buses for an incredible reason.','Upworthy','http://www.upworthy.com/this-australian-guy-is-buying-300-charter-buses-for-an-incredible-reason','2016-04-29',1,'1','2016-07-07 05:31:16','zeemoadmin'),(4,'2016-04-13 16:11:38','Former homeless man raises $58,000 to buy a \'Sleep Bus\'','The Age','http://www.theage.com.au/victoria/former-homeless-mans-sleep-bus-dream-coming-true-20160421-gobwj8.html','2016-04-22',2,'1','2016-07-07 05:31:16','zeemoadmin'),(5,'2016-04-13 16:11:57','Sleepbus: Entrepreneur to convert old buses into shelters for homeless people','The Independent','http://www.independent.co.uk/news/world/australasia/sleepbus-entrepreneur-to-convert-old-buses-into-shelters-for-homeless-people-a6921006.html','2016-03-10',4,'1','2016-07-07 05:31:16','zeemoadmin'),(6,'2016-04-13 16:12:50','Melbourne Entrepreneur to Launch SleepBus','Pro bono Australia','http://probonoaustralia.com.au/news/2016/03/melbourne-entrepreneur-to-launch-sleepbus/','2016-03-03',5,'1','2016-07-07 05:31:16','zeemoadmin'),(8,'2016-04-27 16:18:27','Sleepbus – The Bus Providing Shelter For The Homeless (And Their Pooches)','The Vocal','http://www.thevocal.com.au/sleepbus-bus-providing-shelter-homeless-pooches/','2016-04-23',3,'1','2016-07-07 05:31:16','zeemoadmin');
/*!40000 ALTER TABLE `media_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_single_pages`
--

DROP TABLE IF EXISTS `meta_single_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta_single_pages` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `position` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_single_pages`
--

LOCK TABLES `meta_single_pages` WRITE;
/*!40000 ALTER TABLE `meta_single_pages` DISABLE KEYS */;
INSERT INTO `meta_single_pages` VALUES (1,'Home',1),(4,'connect',2),(5,'Speaker Request',7),(6,'About Us',4),(7,'Meet The Board',6),(12,'Error 404',34),(13,'eNewsletter Signup Form',9),(14,'Connect Thanks Page',3),(15,'Why Sleep',5),(16,'Speaker Request Thanks Page',8),(17,'Corporate Support',10),(18,'Sitemap',13),(19,'Simon Story',11),(20,'In The Media',12),(21,'Sleepbus Toolbox',14),(22,'Sign In',15),(23,'Sign Up',16),(24,'Forgot Password',17),(25,'User Home Page',18),(26,'User Profile Setting Page',19),(27,'Reset Password',20),(28,'User Update Profile Page',21),(29,'Birthday pledge',22),(30,'Campaign Form',23),(31,'User Campaign Page',24),(32,'Donate for campaign',25),(33,'Campaign Donation Success Page 	',26),(34,'One Time Donation Success Page',27),(35,'Monthly Donation Success Page',28),(36,'Donation Cancel Page',29),(37,'Donation Unsuccess Page',30),(38,'Donate Page',31),(39,'One Year Safe Sleep Page',32),(40,'Privacy Policy',33);
/*!40000 ALTER TABLE `meta_single_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_tags`
--

DROP TABLE IF EXISTS `meta_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `page_type` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `json_code` text NOT NULL,
  `meta_description` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_tags`
--

LOCK TABLES `meta_tags` WRITE;
/*!40000 ALTER TABLE `meta_tags` DISABLE KEYS */;
INSERT INTO `meta_tags` VALUES (1,'2014-05-22 08:06:19','BLOGS_ARCHIVE','May 2013','May 2013 - Demo Site','','','','2014-05-21 21:36:19','zeemoadmin'),(2,'2014-12-29 11:04:14','NEWS','10','New news - Demo Site','','','','2014-12-28 22:34:14','zeemoadmin'),(3,'2015-12-04 09:55:02','ABOUT_SECTION','0','About Section - Demo Site','about section keyword','about section json code','about section description','2015-12-03 21:25:02','zeemoadmin'),(4,'2015-12-04 09:55:28','ABOUT_SECTION','2','Blog - Demo Site--updated','about blog keyword','about blog json','about blog desc','2015-12-03 21:25:28','zeemoadmin'),(5,'2016-04-05 04:33:43','BLOGS_CATEGORIES','33','Category - sleepbus','','','','2016-06-28 04:17:53','zeemoadmin'),(6,'2016-04-05 04:43:41','PROJECTS','0','Project - Sleep Bus','','','','2016-04-04 18:13:41','zeemoadmin'),(7,'2016-04-05 04:43:45','PROJECTS','2','Project 1 - Sleep Bus','','','','2016-04-04 18:13:45','zeemoadmin');
/*!40000 ALTER TABLE `meta_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `more_info_section`
--

DROP TABLE IF EXISTS `more_info_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `more_info_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `info_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_quality` varchar(25) NOT NULL,
  `image_alt_title_text` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `more_info_section`
--

LOCK TABLES `more_info_section` WRITE;
/*!40000 ALTER TABLE `more_info_section` DISABLE KEYS */;
/*!40000 ALTER TABLE `more_info_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_entered` date NOT NULL,
  `date_display` varchar(111) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `intro_text` text NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (7,'Panasonic to hire 3500 people for its Haryana plant by 2018','panasonic-to-hire-3500-people-for-its-haryana-plant-by-2018','<p>&nbsp;asdfasdf</p>','2013-02-04','2013-02-04 10:53:21','1','asdfasdf',5,'2014-05-21 23:14:22','zeemoadmin'),(8,'df','df','<p>fdf</p>','2013-02-19','2013-02-19 05:45:42','1','sd',3,'2014-05-21 23:14:22','zeemoadmin'),(9,'Live Blog: No hike in railway passenger fares, Bansal says','live-blog-no-hike-in-railway-passenger-fares-bansal-says','<p>&nbsp;<span style=\"font-family: Arial; font-size: 13px;\">Railways will introduce 67 new express trains, 27 new passenger trains and run of 58 trains will be extended, Pawan Bansal said.</span></p>\r\n<div><span style=\"font-family: Arial; font-size: 13px;\">Railways will introduce 67 new express trains, 27 new passenger trains and run of 58 trains will be extended, Pawan Bansal said.</span></div>','2013-02-26','2013-02-26 07:31:27','1','Railways will introduce 67 new express trains, 27 new passenger trains and run of 58 trains will be extended, Pawan Bansal said.',4,'2014-05-21 23:14:22','zeemoadmin'),(10,'New news','new-news','<p>asdf aasdfsad</p>','2013-02-26','2014-03-14 10:23:52','1','asdfasdf',1,'2014-05-21 23:14:22','zeemoadmin'),(11,'Watch This Space! ','asdfas-asdfasdf','<p>asdf asdfasdf</p>\r\n<p><style type=\"text/css\">            img.imageResizerActiveClass{cursor:nw-resize !important;outline:1px dashed black !important;}            img.imageResizerChangedClass{z-index:300 !important;max-width:none !important;max-height:none !important;}            img.imageResizerBoxClass{margin:auto; z-index:99999 !important; position:fixed; top:0; left:0; right:0; bottom:0; border:1px solid white; outline:1px solid black;}        </style></p>','2013-02-26','2013-01-18 08:23:50','1','asdf sadf',2,'2014-05-21 23:14:22','zeemoadmin');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_brochures`
--

DROP TABLE IF EXISTS `news_brochures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_brochures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `news_id` int(11) NOT NULL,
  `brochure_file` varchar(255) NOT NULL,
  `brochure_title` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_brochures`
--

LOCK TABLES `news_brochures` WRITE;
/*!40000 ALTER TABLE `news_brochures` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_brochures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_images`
--

DROP TABLE IF EXISTS `news_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `news_id` int(11) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_alt_title_text` varchar(512) NOT NULL,
  `image_quality` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_images`
--

LOCK TABLES `news_images` WRITE;
/*!40000 ALTER TABLE `news_images` DISABLE KEYS */;
INSERT INTO `news_images` VALUES (20,'2013-02-19 09:07:10',8,'8.jpg','','','','','1',4,'2013-02-26 19:58:21','zeemoadmin'),(21,'2013-02-19 09:22:33',8,'81.jpg','','','','Description11','1',3,'2013-02-26 19:58:21','zeemoadmin'),(23,'2013-02-27 08:28:05',8,'9.jpg','df images','','','this is df images. this is df images. this is df images. this is df images. this is df images. this is df images. this is df images. this is df images. this is df images.this is df images. this is df.','1',2,'2013-02-26 19:58:21','zeemoadmin'),(24,'2013-02-27 08:28:22',8,'10.jpg','dfsshgsdf','','','this is df images. this is df images. this is df images. this is df images. this is df images. this is df images. this is df images. this is df images. this is df images.this is df images. this is df.','1',1,'2013-02-26 19:58:22','zeemoadmin'),(25,'2014-05-22 10:01:58',10,'product1.jpg','Image 1','','','asdf asf asdf','1',2,'2014-05-21 23:47:26','zeemoadmin'),(26,'2014-05-22 10:05:50',10,'logo1.png','afasdfasfd','asdfasdfasf','','asdfasfd','1',1,'2014-05-21 23:47:26','zeemoadmin');
/*!40000 ALTER TABLE `news_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_subscribers_groups`
--

DROP TABLE IF EXISTS `newsletter_subscribers_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_subscribers_groups` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `subscriber_id` int(20) NOT NULL,
  `group_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_subscribers_groups`
--

LOCK TABLES `newsletter_subscribers_groups` WRITE;
/*!40000 ALTER TABLE `newsletter_subscribers_groups` DISABLE KEYS */;
INSERT INTO `newsletter_subscribers_groups` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,1),(11,11,1),(12,12,1),(13,13,1),(14,14,1),(15,15,1),(16,16,1),(17,17,1),(18,18,1),(19,19,1),(20,20,1),(21,21,1),(22,22,1),(23,23,1),(24,24,1),(25,25,1),(26,26,1),(27,27,1),(28,28,1),(29,29,1),(30,30,1),(31,31,1),(32,32,1),(33,33,1),(34,34,1),(35,35,1),(36,36,1),(37,37,1),(38,38,1),(39,39,1),(40,40,1),(41,41,1),(42,42,1),(43,43,1),(44,44,1),(45,45,1),(46,46,1),(47,47,1),(48,48,1),(49,49,1),(50,50,1),(51,51,1),(52,52,1),(53,53,1),(54,54,1),(55,55,1),(56,56,1),(57,57,1),(58,58,1),(59,59,1),(60,60,1),(61,61,1),(62,62,1),(63,63,1),(64,64,1),(65,65,1),(66,66,1),(67,67,1),(68,68,1),(69,69,1),(70,70,1),(71,71,1),(72,72,1),(73,73,1),(74,74,1),(75,75,1),(76,76,1),(77,77,1),(78,78,1),(79,79,1),(80,80,1),(81,81,1),(82,82,1),(83,83,1),(84,84,1),(85,85,1),(86,86,1),(87,87,1),(88,88,1),(89,89,1),(90,90,1),(91,91,1),(92,92,1),(93,93,1),(94,94,1),(95,95,1),(96,96,1),(97,97,1),(98,98,1),(99,99,1),(100,100,1),(101,101,1),(102,102,1),(103,103,1),(104,104,1),(105,105,1),(106,106,1),(107,107,1);
/*!40000 ALTER TABLE `newsletter_subscribers_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters_groups`
--

DROP TABLE IF EXISTS `newsletters_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters_groups` (
  `id` int(23) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `admin_id` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters_groups`
--

LOCK TABLES `newsletters_groups` WRITE;
/*!40000 ALTER TABLE `newsletters_groups` DISABLE KEYS */;
INSERT INTO `newsletters_groups` VALUES (1,'Website Contact',1,1);
/*!40000 ALTER TABLE `newsletters_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters_subscribers`
--

DROP TABLE IF EXISTS `newsletters_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters_subscribers` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `mname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email1` varchar(250) DEFAULT NULL,
  `email2` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `zip` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `fax` varchar(250) DEFAULT NULL,
  `cell_phone` varchar(250) DEFAULT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `job_title` varchar(250) DEFAULT NULL,
  `business_phone` varchar(250) DEFAULT NULL,
  `business_fax` varchar(250) DEFAULT NULL,
  `business_address` varchar(250) DEFAULT NULL,
  `business_city` varchar(250) DEFAULT NULL,
  `business_state` varchar(250) DEFAULT NULL,
  `business_zip` varchar(250) DEFAULT NULL,
  `business_country` varchar(250) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `extra1` varchar(250) DEFAULT NULL,
  `extra2` varchar(250) DEFAULT NULL,
  `extra3` varchar(250) DEFAULT NULL,
  `unsubscribed` enum('No','Yes') NOT NULL,
  `unsubscribed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters_subscribers`
--

LOCK TABLES `newsletters_subscribers` WRITE;
/*!40000 ALTER TABLE `newsletters_subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_brochures`
--

DROP TABLE IF EXISTS `page_brochures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_brochures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `page_id` int(11) NOT NULL,
  `brochure_file` varchar(255) NOT NULL,
  `brochure_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_brochures`
--

LOCK TABLES `page_brochures` WRITE;
/*!40000 ALTER TABLE `page_brochures` DISABLE KEYS */;
INSERT INTO `page_brochures` VALUES (4,'2013-01-31 08:38:21',2,'test.pdf','sfdadsfasdf','','1',1,'2013-01-31 21:51:23','zeemoadmin');
/*!40000 ALTER TABLE `page_brochures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_heading`
--

DROP TABLE IF EXISTS `page_heading`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_heading` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_heading` text NOT NULL,
  `sub_heading` enum('0','1') NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_heading`
--

LOCK TABLES `page_heading` WRITE;
/*!40000 ALTER TABLE `page_heading` DISABLE KEYS */;
INSERT INTO `page_heading` VALUES (1,0,'Signup','Signup','0',1,'1','2016-04-14 21:40:21','admin'),(2,1,'Signup','Sign up','0',1,'1','2016-04-18 15:54:49','admin'),(3,0,'Signin','Signin','0',2,'1','2016-04-14 21:42:50','admin'),(4,3,'Signin','Sign in','0',1,'1','2016-04-18 15:53:47','admin'),(5,0,'Forgot Password','Forgot Password','0',3,'1','2016-04-18 15:56:03','admin'),(6,5,'Forgot Password','<h1>It happens to the best of us.</h1>\r\n\r\n<h2>We&rsquo;ll email you a reset link.</h2>','1',1,'1','2016-04-18 15:57:05','admin'),(7,0,'Reset Password','Reset Password','0',4,'1','2016-04-18 22:12:00','admin'),(8,7,'Reset Password','Reset Password','0',1,'1','2016-04-18 22:12:00','admin'),(9,0,'Fundraise','Fundraise','0',5,'1','2016-04-21 22:38:00','admin'),(10,9,'Compaign form [Heading]','<h1>Let&rsquo;s go!</h1>\r\n\r\n<div class=\"fundraise-subheading\">Start a fundraising campaign of your own for safe sleeps. You can do anything from hosting&nbsp;a dinner party&nbsp;to doing something crazy. Just have fun!</div>','1',1,'1','2016-06-08 00:54:09','admin'),(11,0,'Birthday Pledge','Birthday Pledge','0',6,'1','2016-04-21 22:39:26','admin'),(12,11,'Birthday pledge [Form Heading]','<h1>Birthday pledge</h1>\r\n\r\n<div class=\"birthdayboximg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon26.png\" /></div>\r\n\r\n<p>This year ask for donations instead of gifts</p>','1',1,'1','2017-02-14 18:40:26','admin'),(13,9,'Edit Campaign Form','Edit Campaign','0',2,'1','2016-04-27 19:37:48','admin'),(14,9,'Donate for campaign [Form]','You\'re giving to','0',3,'1','2016-04-27 19:37:48','admin');
/*!40000 ALTER TABLE `page_heading` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_images`
--

DROP TABLE IF EXISTS `page_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `page_id` int(11) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_alt_title_text` varchar(512) NOT NULL,
  `image_quality` varchar(512) NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_images`
--

LOCK TABLES `page_images` WRITE;
/*!40000 ALTER TABLE `page_images` DISABLE KEYS */;
INSERT INTO `page_images` VALUES (6,'2013-01-31 08:36:50',2,'97607268-10-jpg_114421.jpg','gads asdfasdf','','','','1',11,'2013-12-01 16:38:31','zeemoadmin'),(7,'2013-02-01 10:20:59',2,'red-rose-amp-lips-HD_wallpapers.jpg','asdfasdf','beautiful','80','','1',10,'2013-12-01 16:38:31','zeemoadmin'),(8,'2013-02-19 09:23:23',2,'11.jpg','Image2','','','','1',8,'2013-12-01 16:38:31','zeemoadmin'),(9,'2013-02-22 07:30:07',2,'sonakshi-sinha-20a.jpg','','','60','','1',9,'2013-12-01 16:38:31','zeemoadmin'),(10,'2013-02-23 04:25:41',2,'sonakshi-sinha-9a.jpg','image345','','70','','1',4,'2013-12-01 16:38:31','zeemoadmin'),(15,'2013-02-28 07:36:40',2,'image2.jpg','','','','','1',7,'2013-12-01 16:38:31','zeemoadmin'),(16,'2013-02-28 07:37:27',2,'2.jpg','','','','','1',6,'2013-12-01 16:38:31','zeemoadmin'),(17,'2013-02-28 07:38:13',2,'lederderg-r-renae-ayres.jpg','','','','','1',5,'2013-12-01 16:38:31','zeemoadmin'),(18,'2013-09-25 10:34:27',2,'sonakshi-sinha-4a.jpg','asdfasdf','349','90','','1',3,'2013-12-01 16:38:31','zeemoadmin'),(19,'2013-10-08 09:24:19',2,'nota8.jpg','asdf','asddfasdf','80','','1',2,'2013-12-01 16:38:31','zeemoadmin'),(20,'2013-12-02 05:08:31',2,'nota81.jpg','fawf','','','','1',1,'2013-12-01 16:38:31','zeemoadmin');
/*!40000 ALTER TABLE `page_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_heading` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `image` enum('0','1') NOT NULL,
  `pdf` enum('0','1') NOT NULL,
  `text_only` enum('1','0') NOT NULL,
  `content` text,
  `intro_text` text NOT NULL,
  `banner_content` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,0,'Home','Home',1,'1','0','0','1','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 row-centered\">\r\n<div class=\"container sleepbushometext\">\r\n<div class=\"col-lg-9 col-md-10 col-sm-12 col-xs-12 col-centered\">\r\n<p><img alt=\"\" src=\"https://www.sleepbus.org/images/sleepbus.png\" /> &nbsp;is a non profit organisation on a mission to end the need for people to sleep rough in Australia. With the support of people like you, we can get people off the street and into a safe bed for the night. With a good nights sleep, we hope that the pathways out of homelessness will be a little easier to find and that&#39;s why we believe that &lsquo;sleep changes everything&rsquo;.</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 ideabold\">\r\n<div class=\"ideaboldimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon6.png\" /></div>\r\n\r\n<h2>A Bold idea. Always use 100%</h2>\r\n\r\n<p>100% of your donation is allocated to a sleepbus project; that&rsquo;s our 100% Model promise to you. When you donate or fundraise, every dollar goes to building and maintaining a sleepbus project. Private donors fund our Charity operating costs, so 100% of your money can go towards getting people off the street.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 ideabold\">\r\n<div class=\"ideaboldimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon7.png\" /></div>\r\n\r\n<h2>We prove everything</h2>\r\n\r\n<p>We prove exactly where your money goes. Once your donation is allocated to a project, you will receive photos of YOUR bus and its nightly service location, then you can go to see your bus personally if you wish and when you do, you&rsquo;ll see your name on it as one of its supporters.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"containerin\">\r\n<div class=\"row sleepchanges\">\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 sleepchangesleft\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img2.jpg\" />\r\n<div class=\"sleepchangeslefttext\">\r\n<h2><img alt=\"\" src=\"https://www.sleepbus.org/images/icon5.png\" /></h2>\r\n\r\n<p>When a person is without a home and forced to spend a night on the street, finding a safe place to sleep changes everything. It can help protect a persons mental and physical health and safety and we believe that with a safe sleep and a clear head, the pathways out of homelessness will be a little easier to see. Sleep changes everything.</p>\r\n<a class=\"btn btn-default\" href=\"https://www.sleepbus.org/why-sleep\">LEARN MORE</a></div>\r\n</div>\r\n\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 sleepchangesright\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Mental_Physical_Safety_Icons2(1).jpeg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n','<div>This year ask for donations instead of gifts and <a href=\"https://www.sleepbus.org/pledge\">pledge</a> your birthday for safe sleeps!</div>\r\n','<div class=\"dexpothomebanner\">\r\n<div class=\"homebannerbox\">\r\n<h2>Give safe sleeps</h2>\r\n\r\n<h3>You can provide two safe sleeps for just</h3>\r\n[[ONE_TIME_DONATION_FORM]]\r\n\r\n<p><a href=\"https://www.sleepbus.org/donate\">or make a monthly donation</a></p>\r\n</div>\r\n</div>\r\n','2017-03-03 08:44:49','admin'),(2,0,'About Us',NULL,2,'1','0','0','1','<div class=\"innerheaderbox\">\n<div class=\"whyboxbg2\">\n<div class=\"innerheaderboxin\">\n<h1>Here&rsquo;s what we&rsquo;re about</h1>\n\n<div class=\"rwo\">\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12\">\n<div class=\"abouthedtext\">\n<h2>our<span>mantra</span></h2>\n\n<p>Sleep changes everything.</p>\n</div>\n</div>\n\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12\">\n<div class=\"abouthedtext\">\n<h2>our<span>mission</span></h2>\n\n<p>Is to bring safe overnight accommodation to people sleeping rough in Australia.</p>\n</div>\n</div>\n\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12\">\n<div class=\"abouthedtext\">\n<h2>our<span>vision</span></h2>\n\n<p>Is to end the need for people to sleep rough in Australia.</p>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\n<div class=\"container\">\n<div class=\"row\">\n<div class=\"aboutbord\">\n<div class=\"projectcolorbox\">To achieve our vision; we will build 319+ buses which will provide more than 2,000,000 safe sleeps per year right around Australia.</div>\n\n<h2>So why provide safe overnight accommodation for those sleeping rough on the street&hellip; on a Bus?</h2>\n\n<div class=\"aboutbordbus\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/WebsiteBus.jpg\" style=\"width: 700px;\" /></div>\n\n<p>It wasn&rsquo;t the first idea raised as a solution to this problem, however after much research and talking with people who are homeless and/or those working with the homeless, our other idea&rsquo;s were either not practical, or required cutting through a lot of red tape and not sustainable.</p>\n\n<p>Our key criteria was&hellip; we need to be where the people we want to help are. Sounds simple enough, but as many Homeless Shelters have found, renting or purchasing real estate to do this is massively prohibitive and expensive to maintain. The cities, in particular the CBD, is where the people who need the help are and like any business, it&#39;s all about location, location, location.</p>\n</div>\n\n<div class=\"programbox\">\n<h2>Pilot Program</h2>\n\n<h3>Suburban Metro Council Pilot - The bus that starts it all.</h3>\n\n<p>To test the sleepbus operations under controlled conditions in a suburban council area with a small homeless persons community. The first bus, that will forever be, a part of sleepbus history.</p>\n\n<h3>C.B.D. Pilot - The buses that test it all.</h3>\n\n<p>To take two buses and test sleepbus operations under semi-controlled conditions in a CBD environment with a large scale homeless persons community.</p>\n\n<h3>The Big Launch - The buses that show them all.</h3>\n\n<p>sleepbus plans to build the required number of buses that will END the need for people sleeping rough in a highly visible location: a full, in the field, launch of sleepbus to show what can be achieved. Like our facebook page to keep posted on this big event.</p>\n\n<div class=\"programfb\"><a href=\"https://www.facebook.com/sleepbusaustralia\" target=\"_blank\"><img alt=\"\" src=\"https://www.sleepbus.org/images/fb2.png\" /></a></div>\n</div>\n</div>\n</div>\n</div>\n\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\n<div class=\"container\">\n<div class=\"row donateh2\">\n<h2>Here&rsquo;s three ways you can get involved</h2>\n\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome\">\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon1.png\" style=\"height: 127px; width: 100px;\" /></div>\n\n<p>For $27.50 you can give a good night&rsquo;s sleep.</p>\n<a class=\"btn btn-primary\" href=\"https://www.sleepbus.org/donate\">Donate</a></div>\n\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome\">\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon2.png\" style=\"height: 139px; width: 100px;\" /></div>\n\n<p>Pledge your next Birthday for safe sleeps.</p>\n<a class=\"btn btn-success\" href=\"https://www.sleepbus.org/pledge\">pledge</a></div>\n\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome\">\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/fundraise(1).jpg\" style=\"width: 100px; height: 148px;\" /></div>\n\n<p>Do something crazy or creative to raise money.</p>\n<a class=\"btn btn-info\" href=\"https://www.sleepbus.org/fundraise\">Fundraise</a></div>\n</div>\n</div>\n</div>\n\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\n<div class=\"container\">\n<div class=\"findoutmore2\"><a href=\"https://www.sleepbus.org/meet-the-board\">meet our board &nbsp; <img alt=\"\" src=\"https://www.sleepbus.org/images/arrowleft.png\" /></a></div>\n</div>\n</div>','','','2017-02-14 18:40:26','admin'),(3,0,'Why Sleep',NULL,3,'1','1','1','1','<div class=\"innerheaderbox2\">\r\n<div class=\"whyboxbg\">\r\n<div class=\"innerheaderboxin\">\r\n<h1>Why sleep?</h1>\r\n\r\n<div class=\"abouthedtextp\">The facts on homelessness in Australia.</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 mrtop\">\r\n<div class=\"mrtopimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon20.png\" /></div>\r\n\r\n<p>On any given night in Australia <span>105,000</span> people are homeless.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 mrtop\">\r\n<div class=\"mrtopimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon21.png\" /></div>\r\n\r\n<p>Of those, <span>6,314</span> are sleeping rough.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 mrtop\">\r\n<div class=\"mrtopimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon22.png\" /></div>\r\n\r\n<p>And <span>1,073</span> of those are under 12.</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"abouthedtextp\">Of people who sleep rough:</div>\r\n\r\n<div class=\"abouthedtextp2\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon18.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon18.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon18.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon18.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon18.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon18.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon18.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon19.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon19.png\" /> <img alt=\"\" src=\"https://www.sleepbus.org/images/icon19.png\" /></div>\r\n\r\n<div class=\"abouthedtextp2\">67.6% Male <span>32.4% Female</span></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"aboutbord\">\r\n<p>At sleepbus we have a simple focus; provide safe overnight accommodation to those sleeping rough in Australia. Our accommodation is not a long term solution; we don&rsquo;t offer counseling; we don&rsquo;t provide money; we don&rsquo;t provide the Ritz.</p>\r\n\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<p>sleepbus is distinct, yet complementary to existing efforts from other organisations supporting Australians experiencing, or at risk of homelessness. Our work aims to fill a &lsquo;gap&rsquo;, rather than overlapping or replicating activities that support the urgent needs of people in Australia.</p>\r\n</div>\r\n\r\n<div class=\"programbox2\">\r\n<h2><img alt=\"\" src=\"https://www.sleepbus.org/images/icon14.png\" /></h2>\r\n\r\n<p>Sleep plays a vital role in good health and wellbeing; and getting enough quality sleep can help protect a person&rsquo;s mental and, physical health, and ultimately their safety. For those sleeping rough, getting a good nights sleep is virtually impossible and can contribute to long-term homelessness and more.</p>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 changebox\">\r\n<div class=\"changeboximg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon15.png\" /></div>\r\n\r\n<h2>Mental Health</h2>\r\n\r\n<p>Sleep deficiency can harm a person&rsquo;s mental health over time; Low self-esteem, social isolation, and the exacerbation or development of specific mental health disorders including schizophrenia, depression, bipolar disorder and post-traumatic stress disorder.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 changebox\">\r\n<div class=\"changeboximg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon16.png\" /></div>\r\n\r\n<h2>Physical Health</h2>\r\n\r\n<p>Sleep deficiency can harm a person&rsquo;s physical health over time. For example, ongoing sleep deficiency can raise the risk for some chronic health problems such as, Diabetes, Heart Health, Breathing Problems and Breast Cancer.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 changebox\">\r\n<div class=\"changeboximg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon17.png\" /></div>\r\n\r\n<h2>Safety</h2>\r\n\r\n<p>Many sleeping on the street are subjected to terrible weather, harassment, bullying, being robbed and worse. Those sleeping on the street also run a high risk of drug and alcohol abuse, further affecting their safety and wellbeing.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>','','','2017-02-14 18:40:26','admin'),(4,0,'Meet The Board',NULL,4,'1','0','0','1','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"funding\">\r\n<h1>Meet the board</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>We&rsquo;re a passionate group of determined and creative problem solvers who want to make a difference. Our vision is to end the need for people to sleep rough in Australia.</h2>\r\n</div>\r\n\r\n<div class=\"projectcolorbox\">To achieve our vision; we will build 319+ buses which will provide more than 2,000,000 safe sleeps per year right around Australia.</div>\r\n\r\n<div class=\"aboutus\">\r\n<h2>Get to know us a little&nbsp;bit&nbsp;better.</h2>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"row aboutusmr\">\r\n<div class=\"col-lg-4 col-md-5 col-sm-6 col-xs-12 aboutboxleft\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img12.jpg\" /></div>\r\n\r\n<div class=\"col-lg-8 col-md-7 col-sm-6 col-xs-12 aboutboxright\">\r\n<h2>Simon Rowe</h2>\r\n\r\n<h3>CEO/Founder</h3>\r\n\r\n<p>Entrepreneurial spirit. Problem solver. Hawthorn supporter. Father. Coach. sleepbus founder.</p>\r\n\r\n<p>Simon has more than 20 year&rsquo;s experience as a business owner (his first business at age 17) and working will various companies in operations roles; solving problems, performance and profitability issues. He&rsquo;s the &ldquo;fix it guy&rdquo;, the guy you call in when your company has a problem and he&rsquo;ll find a solution that gets results. Its this same skill and determined attitude now being used to solve the serious problem of people sleeping rough in Australia.</p>\r\n\r\n<p>Read Simon&rsquo;s story &amp; the birth of sleepbus.</p>\r\n<a class=\"btn btn-primary\" href=\"https://www.sleepbus.org/simon-story\">simon&rsquo;s story</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 aboutboxthree\">\r\n<div class=\"aboutboxthreeimg\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/birgitte.jpg\" style=\"width: 300px;\" /></div>\r\n\r\n<h2>Birgitte Snelson</h2>\r\n\r\n<h3>Chairperson</h3>\r\n\r\n<p>Head of Procurement at Village Roadshow, Birgitte is responsible for the sourcing of all spend categories including marketing, media, print, corporate services, IT&amp;T, food &amp; beverage etc. Birgitte was nominated for Telstra Business Woman of the Year 2013 and has volunteered her procurement skills for organisations such as Kids Under Cover and Ovarian Cancer Australia. Birgitte has an MBA from Copenhagen Business School with studies at both Rensselaer Polytechnic Institute in New York and London School of Economics. &nbsp; <a class=\"SeeMore2\" data-toggle=\"collapse\" href=\"#collapseTwo1\">Read More</a></p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 aboutboxthree\">\r\n<div class=\"aboutboxthreeimg\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/roger.jpg\" style=\"width: 300px;\" /></div>\r\n\r\n<h2>Roger Simpson</h2>\r\n\r\n<h3>Board Member</h3>\r\n\r\n<p>Roger Simpson, CEO, The Retail Solution, has worked in retail for over 35 years. His company focuses on helping clients to improve their service and sales through better focus on service standards, sales techniques, measurement and follow up.<span class=\"accordion-body collapse\" id=\"collapseTwo2\">&nbsp;Roger is passionate about the customer experience leaving a positive impression. </span>&nbsp; <a class=\"SeeMore2\" data-toggle=\"collapse\" href=\"#collapseTwo2\">Read More</a></p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 aboutboxthree\">\r\n<div class=\"aboutboxthreeimg\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/alison.jpg\" style=\"width: 300px;\" /></div>\r\n\r\n<h2>Alison Coughlan</h2>\r\n\r\n<h3>Advisor</h3>\r\n\r\n<p>Former CEO of Ovarian Cancer Australia. Alison is an accomplished consultant and leader with over 20 years&#39; experience in the research, health and community sectors. Alison works with individuals and organisations to build their capabilities, grow their reach and optimise their impact.<span class=\"accordion-body collapse\" id=\"collapseTwo\">&nbsp;Alison holds a Master of Public Health in Epidemiology and Biostatistics and an&nbsp;Honours Degree in Science (Immunology). She has deep and rich insights developed from working with over 50 for-purpose organisations in roles from technician, leader and consultant to Board Director. </span>&nbsp; <a class=\"SeeMore2\" data-toggle=\"collapse\" href=\"#collapseTwo\">Read More</a></p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"findoutmore\"><a href=\"https://www.sleepbus.org/about-us\">find out more about our buses</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>','','','2017-03-14 05:26:07','admin'),(5,0,'Connect',NULL,6,'1','0','0','1','<h1>Connect</h1>\r\n\r\n<p>Keep up to date with the latest sleepbus news here</p>\r\n\r\n<div class=\"contactfbbox\"><a href=\"https://www.facebook.com/sleepbusaustralia\" target=\"_blank\"><img alt=\"\" src=\"https://www.sleepbus.org/images/fb-hover.png\" /></a> <a href=\"https://twitter.com/sleepbus\" target=\"_blank\"><img alt=\"\" src=\"https://www.sleepbus.org/images/twitter-hover.png\" /></a></div>\r\n\r\n<p>Or, if you have any queries please get in touch.</p>','','','2017-02-14 18:40:26','admin'),(6,0,'Speaker Request',NULL,7,'1','0','0','1','<h1>Speaker request</h1>\r\n\r\n<p>Would you like sleepbus to visit your school or business?<br />\r\nPlease complete your details below and we will be in touch.</p>\r\n\r\n<div class=\"contactfbbox2\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon13.png\" /></div>','','','2017-02-14 18:40:26','admin'),(7,0,'eNewsletter Signup Form',NULL,8,'1','0','0','1','<h1>Sign up to our eNews</h1>\r\n\r\n<p>Sign up to receive awesome updates from sleepbus.<br />\r\nThey&rsquo;re worthwhile. We&nbsp;promise.</p>\r\n\r\n<div class=\"contactfbbox2\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon12.png\" /></div>','','','2017-02-14 18:40:26','admin'),(8,0,'Sitemap',NULL,9,'1','0','0','1',NULL,'','','2016-04-07 15:49:28','admin'),(9,0,'Oops Page',NULL,11,'1','0','0','1','<div class=\"aboutbordbus\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/WebsiteBus.jpg\" style=\"width: 500px;\" /></div>\r\n\r\n<p>We are really sorry but the page you requested is not available. Let&#39;s bus it&nbsp;back to the <a href=\"https://www.sleepbus.org/\">start</a>.</p>','','','2017-02-14 18:40:26','admin'),(10,0,'Simon Story',NULL,5,'1','0','0','1','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"funding\">\r\n<h1>Simon&rsquo;s story</h1>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-3 col-md-4 col-sm-5 col-xs-12 simonleft\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img16.jpg\" /></div>\r\n\r\n<div class=\"col-lg-9 col-md-8 col-sm-7 col-xs-12 simonright\">\r\n<p><strong>In 1993,</strong> I fell&nbsp;behind in my rent and was evicted. I had a job, but for the next 4 months I&nbsp;lived in my car while I saved up enough money&nbsp;for a monthsbond and a months&nbsp;rent on another place. I would park in a car park near my old place for the&nbsp;night, and in the mornings,&nbsp;drive to a caravan park near by, sneak in, have a&nbsp;shower and go to work.</p>\r\n\r\n<p>Since then, I have&nbsp;made a good living for years as a Chef, and Entrepreneur, for the most part&nbsp;living selfishly and not giving a second&nbsp;thought to homelessness.</p>\r\n\r\n<p>In May 2015, I was&nbsp;walking along Carlisle Street in St. Kilda East, Melbourne, to my local Coles&nbsp;supermarket. As I approached the brand&nbsp;new Bank of Melbourne I see a bright,&nbsp;white doona crumpled up in the tiny alcove of an unused doorway. As I got closer&nbsp;I noticed there&nbsp;was a man curled up in the doona, on the hard concrete floor, trying&nbsp;to get some sleep&hellip; at lunch time.</p>\r\n\r\n<p>So many people were&nbsp;walking past, looking, but moving on with their day, as I have probably done&nbsp;since 1993.</p>\r\n\r\n<h2>This time I couldn&rsquo;t walk&nbsp;past, I stopped and asked&nbsp;him if he was ok&hellip;</h2>\r\n\r\n<p>he said &ldquo;yeah mate, thanks,&nbsp;just trying to get some sleep&rdquo;. He looked so tired. I said, &ldquo;here mate&rdquo; and gave&nbsp;him the $20 I had in my pocket.</p>\r\n\r\n<h2>His eyes&nbsp;lit up, he smiled and was so grateful.&nbsp;</h2>\r\n\r\n<p>He shook my hand, thanked me again with a smile and curled back up under the&nbsp;doona. When I got home, I told my family what&nbsp;had happened and tears rolled&nbsp;down my face.</p>\r\n\r\n<p>That man, trying to&nbsp;sleep on a concrete floor, in the middle of the day, on a busy city street&nbsp;affected me in a profound way. And that&rsquo;s a&nbsp;mild story, for many sleeping on&nbsp;the streets are being subjected to terrible weather, harassment, bullying,&nbsp;being robbed and worse. No&nbsp;one should have to live like that.</p>\r\n\r\n<h3>What is charity?</h3>\r\n\r\n<p>For me, charity is&nbsp;practical. It&#39;s the ability to use one&#39;s position of influence, relative wealth&nbsp;and power to affect lives for the better.</p>\r\n\r\n<p>I&rsquo;m not a religious&nbsp;person, but there&#39;s a story in the bible about a man beaten near death by&nbsp;robbers. He&#39;s stripped naked and lying on&nbsp;the roadside. Most people pass him&nbsp;by, but one man stops. He picks him up and bandages his wounds. He puts him on&nbsp;his horse and&nbsp;walks alongside until they reach an inn. He checks him in and&nbsp;throws down his Amex. &quot;Whatever he needs until he gets better.&rdquo;</p>\r\n\r\n<p>Because he could.</p>\r\n\r\n<p>The dictionary&nbsp;defines charity as simply:</p>\r\n\r\n<h2>The act of giving voluntarily to those in need.</h2>\r\n\r\n<p>Using my 20+ years of&nbsp;business experience, I set about developing a sustainable business model with a&nbsp;simple mission; to provide those&nbsp;sleeping &ldquo;rough&rdquo;, a safe overnight place to&nbsp;sleep. The more I developed and researched a solution, the more I discovered&nbsp;what a good&nbsp;nights sleep can do for a persons physical and mental health.&nbsp;Just being able to sleep through the night,&nbsp;warm and safe can give a person a whole new outlook on life.</p>\r\n\r\n<p><strong style=\"font-size:18px;\">sleep<span>bus</span></strong> is distinct,&nbsp;yet complementary, to existing efforts from other organisations supporting&nbsp;Australians experiencing or at risk of&nbsp;homelessness. Our work aims to fill a&nbsp;&lsquo;gap&rsquo;, rather than overlapping or replicating activities that support the&nbsp;urgent needs of people in&nbsp;Australia.</p>\r\n\r\n<p>No other Australian&nbsp;organisation has this focus.</p>\r\n\r\n<p>The least we can do&nbsp;is&nbsp;bring safe overnight accommodation&nbsp;to people sleeping rough in Australia&nbsp;until they get back on their feet.</p>\r\n\r\n<p><b>Simon Rowe</b><br />\r\n<bdo dir=\"ltr\">Winter&nbsp;2015</bdo></p>\r\n\r\n<p><a href=\"https://www.sleepbus.org/meet-the-board\">&lt; Back to Meet the board</a></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>','','','2017-02-14 18:40:26','admin'),(11,0,'Privacy Policy','Privacy Policy',11,'1','0','0','1','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"privacy\">\r\n<h1>Privacy Policy for sleepbus</h1>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Our Commitment to Privacy</h2>\r\n\r\n<p>sleepbus knows that you care how information about you is used and shared, and we appreciate you trusting that we will do so carefully and sensibly. To better protect your privacy, we provide this Privacy Policy explaining our practices and the choices you can make about the way your information is collected and used by sleepbus. The information below explains our policy regarding your privacy, both online and offline. By visiting <a href=\"https://www.sleepbus.org\">www.sleepbus.org</a> or sharing personal information with sleepbus you are accepting the practices described in this Privacy Notice.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">What personally identifiable information is collected by sleepbus?</h2>\r\n\r\n<p>When you visit our website or make a donation online or offline, you may provide us with personal information (such as name, address, email address, telephone numbers and/or credit/debit card information) that you knowingly choose to disclose, which is collected on an individual basis for various purposes. These purposes include registering to receive email newsletters or other materials, requesting further information from us about projects and services, donating to us, ordering merchandise, making requests, submitting a form on our website, or simply asking a question. We receive and store any information you enter on our website or give us in any other way, whether it is online or offline. We ask for personal information so that we can fulfill your request and return your message. This information is retained and used in accordance with existing laws, rules, regulations, and other policies. sleepbus does not collect personal information from you unless you provide it to us. If you choose not to provide any of that information, we may not be able to fulfill your request or complete your order, but you will still be free to browse the other sections of the websites owned and administered by sleepbus. This means that you can visit our site without telling us who you are or revealing any personally identifiable information about yourself.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">The way we use information</h2>\r\n\r\n<p>When you supply information about yourself for a specific purpose, we use the information for only that purpose (such as to provide the service or information you have requested). For example, you may be asked to give us individual information to receive information, to make a donation, to purchase merchandise, or to apply for a job. Similarly, we use information you provide about yourself or someone else when placing a merchandise order only to ship the merchandise and to confirm delivery. We do not share this information with outside parties except to the extent necessary to complete that order.</p>\r\n\r\n<p>You can register with our website if you would like to receive updates on our new projects and services or on our merchandise. Information you submit on our website or over the phone will not be used for this purpose unless a registration form is filled out.</p>\r\n\r\n<p>We use return email addresses to answer the email we receive. Such addresses are not used for any other purpose and are not shared with outside parties.</p>\r\n\r\n<p>sleepbus does not sell, rent, give-away or share its email addresses or other personal contact information with outside sources. sleepbus also does not send mailings on behalf of other organisations.</p>\r\n\r\n<p>Should any material changes be made to the ways in which we use personally identifiable information, sleepbus will take commercially reasonable measures to obtain written or email consent from you. We will also post the changes to our use of personally identifiable information on our website at least 30 days prior to a change.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Our commitment to data security</h2>\r\n\r\n<p>Personally identifiable information is stored on our server and is not publicly accessible. Further, personally identifiable information is only accessed by sleepbus personnel on a &quot;need to know&quot; basis. To prevent unauthorized access, maintain data accuracy, and ensure the correct use of information, we have put in place appropriate physical, electronic, and managerial procedures to safeguard and secure the information we collect online. Additionally, sensitive data such as credit card numbers are encrypted using SSL and other industry standard measures, to provide an additional level of security.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Choice/Opt-out</h2>\r\n\r\n<p>If you have registered to receive communications from us and later change your mind, you may contact us to have your name and contact information removed from our distribution lists. You have the following options to do this:</p>\r\n\r\n<p>You can send an email to: <a href=\"mailto:support@sleepbus.org\" style=\"line-height: 20.8px;\">support@sleepbus.org</a></p>\r\n\r\n<p>You can send mail to the following address:</p>\r\n\r\n<p>sleepbus 22 Gourlay Street, St Kilda East, Victoria, 3183</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Correct/Update</h2>\r\n\r\n<p>If you would like to verify the data we have received from you or to make corrections to it, you may contact us directly at the email and mail addresses provided above.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">What anonymous information is collected by sleepbus?</h2>\r\n\r\n<p>Anonymous information is collected for every donor and visitor to this site. This includes pages viewed, date and time, and browser type. IP numbers are not stored, but are temporarily used to determine domain type and in some cases, geographic region. We do not make any association between this information and a donor or visitor&#39;s identity.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Automatic information</h2>\r\n\r\n<p>When you visit our website, our servers make a log of basic information corresponding to the sites and pages you have visited. This information is stored primarily to track the effectiveness of our website and individual sections and pages within them.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">How does this site use cookies?</h2>\r\n\r\n<p>Cookies are simple text files stored by your web browser that provide a method of distinguishing among donors and visitors to the website. sleepbus uses cookies to identify your browser as you visit pages on the sleepbus website or sites in the sleepbus media network. Cookies created on your computer by using our website do not contain personally identifiable information and do not compromise your privacy or security. Cookies allow sleepbus to gather anonymous information. Cookies also allow sleepbus to provide more relevant, targeted content as you travel through sites in the sleepbus media network as appropriate and are used on our ordering website to keep track of the items in your shopping cart.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Online or offline registration information</h2>\r\n\r\n<p>You will provide us with information about yourself and your organisation when you register for fundraising, donations, and list services or to buy products. This information is not used for any other purpose than to fulfill your request and is not shared with outside parties. However, donors and visitors should be aware that information collected online or offline may be subject to examination and inspection if such information is a public record or not otherwise protected from disclosure.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Links</h2>\r\n\r\n<p>This website may contain links to other websites. Please note that when you click on one of these links, you are entering another site. We encourage you to read the privacy statements of these linked websites as their privacy policy may differ from ours.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Email Links</h2>\r\n\r\n<p>We use email links located on this site to allow you to contact us directly via email. We use the information provided in your email to respond to your questions or comments. We may also store your comments for future reference.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Email communications</h2>\r\n\r\n<p>We publish an e-newsletter that is sent periodically to persons on a listserv. The e-newsletter is distributed by email, although back issues may also be viewed on our website. You may subscribe to or unsubscribe from the email listserv at any time. Occasionally we may send announcements about sleepbus events or merchandise to the mailing listserv. This email address is being protected from spambots. You need JavaScript enabled to view it.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Changes to this privacy statement</h2>\r\n\r\n<p>Changing business practices and circumstances may require that we make changes to this privacy policy from time to time. Any changes will be reflected on this website. sleepbus reserves the right to modify its website and/or this Privacy Policy at any time and donors and visitors are deemed to be apprised of and bound by any such modifications. Our goal is to provide all services to donors or visitors in an accessible, efficient and friendly manner while maintaining their privacy. If you have comments or questions regarding privacy, please contact us.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">Legal Disclaimer</h2>\r\n\r\n<p>We may disclose personal information when required by law or in the good-faith belief that such action is necessary in order to conform to the edicts of the law or comply with legal process served on sleepbus.</p>\r\n\r\n<h2 style=\"text-align: left;padding: 0px;\">For more information</h2>\r\n\r\n<p>If you have any questions, concerns or comments about your privacy, please send us a description of your concern via email to <a href=\"mailto:support@sleepbus.org\">support@sleepbus.org</a></p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"fundingtoptext\">\r\n<p><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus%20updated(1).jpg\" style=\"height: 216px; width: 300px;\" /></p>\r\n</div>','','','2017-02-14 18:40:26','zeemoadmin');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_brochures`
--

DROP TABLE IF EXISTS `product_brochures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_brochures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `product_id` int(11) NOT NULL,
  `brochure_file` varchar(255) NOT NULL,
  `brochure_title` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_brochures`
--

LOCK TABLES `product_brochures` WRITE;
/*!40000 ALTER TABLE `product_brochures` DISABLE KEYS */;
INSERT INTO `product_brochures` VALUES (1,'2013-10-08 09:33:02',8,'Decoration_Options.xls','eaaer','1',1,'2013-10-07 21:03:02','zeemoadmin');
/*!40000 ALTER TABLE `product_brochures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_quality` varchar(25) NOT NULL,
  `image_alt_title_text` varchar(512) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `position` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  `main_image` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (2,'2013-10-03 03:00:22',6,'7.jpg','','','','1',1,'2013-10-02 16:30:22','zeemoadmin','1');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `intro_text` text NOT NULL,
  `description` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (5,'asdfas','asdfa\'asdf','<p>&nbsp;asdfasfd</p>\r\n','2013-05-09 09:51:13','2013-10-07 20:49:24','zeemoadmin'),(6,'asfasdf','asdfas','<p>asdfasdf</p>\r\n','2013-09-26 20:34:43','2013-09-25 22:04:43','zeemoadmin'),(7,'saddfasfd','asdf','<p>asddf</p>\r\n','2013-10-04 15:44:47','2013-10-03 17:14:47','zeemoadmin'),(8,'dWE','wSD','<p>asdASD</p>\r\n','2013-10-08 21:18:38','2013-10-07 20:48:38','zeemoadmin');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_images`
--

DROP TABLE IF EXISTS `project_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `image_title` varchar(555) NOT NULL,
  `image_file` varchar(555) NOT NULL,
  `description` text NOT NULL,
  `image_alt_title_text` varchar(555) NOT NULL,
  `image_quality` varchar(20) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_images`
--

LOCK TABLES `project_images` WRITE;
/*!40000 ALTER TABLE `project_images` DISABLE KEYS */;
INSERT INTO `project_images` VALUES (2,'2016-04-04 04:08:54',1,'','growth-project.png','','','',4,'1','2016-04-03 22:13:01','admin'),(3,'2016-04-04 04:08:54',1,'','feasability-study-b.png','','','',2,'1','2016-04-04 15:41:31','admin'),(5,'2016-04-04 04:49:16',1,'','environment-b.png','','','',1,'1','2016-04-03 22:13:01','admin'),(9,'2016-04-04 07:58:28',1,'','our-vision.png','','','',3,'1','2016-04-04 15:41:31','admin'),(10,'2016-04-08 09:21:14',3,'','satyam.jpg','','','',2,'0','2016-07-07 05:42:09','admin'),(11,'2016-04-08 09:21:25',3,'','satyam1.jpg','','','',1,'1','2016-07-07 05:42:09','admin'),(12,'2016-04-28 03:12:18',4,'','satyam11.jpg','','','',1,'1','2016-04-27 21:21:27','admin');
/*!40000 ALTER TABLE `project_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `project_title` varchar(555) NOT NULL,
  `intro_text` text NOT NULL,
  `description` text NOT NULL,
  `url` varchar(555) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (2,'2016-04-05 14:58:28','Our first sleepbus launches in Melbourne CBD 2','<div class=\"completedboxhover\">\r\n<p><span>31 may 2016</span></p>\r\n\r\n<h2>Our first sleepbus launches in Melbourne CBD</h2>\r\n</div>\r\n\r\n<figure><img alt=\"\" src=\"https://www.sleepbus.org/images/img4.jpg\" /></figure>','<div class=\"row project-detail\">\r\n<div class=\"projectdate\">17 March 2016</div>\r\n\r\n<p>At sleepbus we have a simple focus; provide safe overnight accommodation to those sleeping rough in Australia. Our accommodation is not a long term solution; we don&rsquo;t offer counseling; we don&rsquo;t provide money; we don&rsquo;t provide the Ritz.</p>\r\n\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<h2>Subheading</h2>\r\n\r\n<ul>\r\n	<li>Proin vel enim a leo auctor convallis sed ut enim.</li>\r\n	<li>Phasellus aliquam felis eu urna aliquam, nec iaculis nulla fermentum.</li>\r\n	<li>Vivamus molestie leo eu erat elementum, sed tristique tortor elementum.</li>\r\n	<li>Aenean vehicula nisl at turpis sagittis, nec bibendum ante cursus.</li>\r\n	<li>Praesent auctor mauris eget condimentum euismod.</li>\r\n</ul>\r\n<img align=\"right\" src=\"https://www.sleepbus.org/images/img7.jpg\" />\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<div class=\"completeback\"><a href=\"[[BACK_URL]]\">&lt; Back to completed projects </a></div>\r\n\r\n<div class=\"projectcolorbox\">To achieve our mission we need 300+ buses providing 2,000,000 safe sleeps per year in Australia.</div>\r\n</div>','project-1',2,'0','2017-02-14 18:40:29','admin'),(3,'2016-04-08 20:27:52','Our first sleepbus launches in Melbourne CBD','<div class=\"completedboxhover\">\r\n<p><span>31 may 2016</span></p>\r\n\r\n<h2>Our first sleepbus launches in Melbourne CBD</h2>\r\n</div>\r\n\r\n<figure><img alt=\"\" src=\"https://www.sleepbus.org/images/img3.jpg\" /></figure>','<div class=\"row project-detail\">\r\n<div class=\"projectdate\">17 March 2016</div>\r\n\r\n<p>At sleepbus we have a simple focus; provide safe overnight accommodation to those sleeping rough in Australia. Our accommodation is not a long term solution; we don&rsquo;t offer counseling; we don&rsquo;t provide money; we don&rsquo;t provide the Ritz.</p>\r\n\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<h2>Subheading</h2>\r\n\r\n<ul>\r\n	<li>Proin vel enim a leo auctor convallis sed ut enim.</li>\r\n	<li>Phasellus aliquam felis eu urna aliquam, nec iaculis nulla fermentum.</li>\r\n	<li>Vivamus molestie leo eu erat elementum, sed tristique tortor elementum.</li>\r\n	<li>Aenean vehicula nisl at turpis sagittis, nec bibendum ante cursus.</li>\r\n	<li>Praesent auctor mauris eget condimentum euismod.</li>\r\n</ul>\r\n<img align=\"right\" src=\"https://www.sleepbus.org/images/img7.jpg\" />\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<div class=\"completeback\"><a href=\"[[BACK_URL]]\">&lt; Back to completed projects </a></div>\r\n\r\n<div class=\"projectcolorbox\">To achieve our mission we need 300+ buses providing 2,000,000 safe sleeps per year in Australia.</div>\r\n</div>','our-first-sleepbus-launches-in-melbourne-cbd',1,'0','2017-02-14 18:40:29','admin'),(4,'2016-04-08 20:30:18','Our first sleepbus launches in Melbourne CBD 3','<div class=\"completedboxhover\">\r\n<p><span>31 may 2016</span></p>\r\n\r\n<h2>Our first sleepbus launches in Melbourne CBD</h2>\r\n</div>\r\n\r\n<figure><img alt=\"\" src=\"https://www.sleepbus.org/images/img5.jpg\" /></figure>','<div class=\"row project-detail\">\r\n<div class=\"projectdate\">17 March 2016</div>\r\n\r\n<p>At sleepbus we have a simple focus; provide safe overnight accommodation to those sleeping rough in Australia. Our accommodation is not a long term solution; we don&rsquo;t offer counseling; we don&rsquo;t provide money; we don&rsquo;t provide the Ritz.</p>\r\n\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<h2>Subheading</h2>\r\n\r\n<ul>\r\n	<li>Proin vel enim a leo auctor convallis sed ut enim.</li>\r\n	<li>Phasellus aliquam felis eu urna aliquam, nec iaculis nulla fermentum.</li>\r\n	<li>Vivamus molestie leo eu erat elementum, sed tristique tortor elementum.</li>\r\n	<li>Aenean vehicula nisl at turpis sagittis, nec bibendum ante cursus.</li>\r\n	<li>Praesent auctor mauris eget condimentum euismod.</li>\r\n</ul>\r\n<img align=\"right\" src=\"https://www.sleepbus.org/images/img7.jpg\" />\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<div class=\"completeback\"><a href=\"[[BACK_URL]]\">&lt; Back to completed projects </a></div>\r\n\r\n<div class=\"projectcolorbox\">To achieve our mission we need 300+ buses providing 2,000,000 safe sleeps per year in Australia.</div>\r\n</div>','our-first-sleepbus-launches-in-melbourne-cbd-3',3,'0','2017-02-14 18:40:29','admin'),(5,'2016-04-08 20:31:02','Our first sleepbus launches in Melbourne CBD 4','<div class=\"completedboxhover\">\r\n<p><span>31 may 2016</span></p>\r\n\r\n<h2>Our first sleepbus launches in Melbourne CBD</h2>\r\n</div>\r\n\r\n<figure><img alt=\"\" src=\"https://www.sleepbus.org/images/img6.jpg\" /></figure>','<div class=\"row project-detail\">\r\n<div class=\"projectdate\">17 March 2016</div>\r\n\r\n<p>At sleepbus we have a simple focus; provide safe overnight accommodation to those sleeping rough in Australia. Our accommodation is not a long term solution; we don&rsquo;t offer counseling; we don&rsquo;t provide money; we don&rsquo;t provide the Ritz.</p>\r\n\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<h2>Subheading</h2>\r\n\r\n<ul>\r\n	<li>Proin vel enim a leo auctor convallis sed ut enim.</li>\r\n	<li>Phasellus aliquam felis eu urna aliquam, nec iaculis nulla fermentum.</li>\r\n	<li>Vivamus molestie leo eu erat elementum, sed tristique tortor elementum.</li>\r\n	<li>Aenean vehicula nisl at turpis sagittis, nec bibendum ante cursus.</li>\r\n	<li>Praesent auctor mauris eget condimentum euismod.</li>\r\n</ul>\r\n<img align=\"right\" src=\"https://www.sleepbus.org/images/img7.jpg\" />\r\n<p>What we do provide is a comfortable and safe place to sleep for the night. We leave the long term solutions and counseling to the many other organisations already doing this vital work. We just want people off the street, where they can enjoy a long nights sleep in safety; we believe, that a safe nights sleep is vital to finding pathways out of homelessness.</p>\r\n\r\n<div class=\"completeback\"><a href=\"[[BACK_URL]]\">&lt; Back to completed projects </a></div>\r\n\r\n<div class=\"projectcolorbox\">To achieve our mission we need 300+ buses providing 2,000,000 safe sleeps per year in Australia.</div>\r\n</div>','our-first-sleepbus-launches-in-melbourne-cbd-4',4,'0','2017-02-14 18:40:29','admin');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_media_icons`
--

DROP TABLE IF EXISTS `social_media_icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_media_icons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon_title` varchar(512) NOT NULL,
  `url` text NOT NULL,
  `image_file` varchar(512) NOT NULL,
  `hover_image` varchar(255) NOT NULL,
  `dateadded` datetime NOT NULL,
  `image_alt_title_text` varchar(512) NOT NULL,
  `hover_image_alt_title_text` varchar(512) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  `alt_title_text` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_media_icons`
--

LOCK TABLES `social_media_icons` WRITE;
/*!40000 ALTER TABLE `social_media_icons` DISABLE KEYS */;
INSERT INTO `social_media_icons` VALUES (1,'qweqew','http://asdfsadf','close-uploader.png','img42.jpg','2015-08-18 15:57:58','asfsadf','',1,'1','2015-08-17 17:53:16','zeemoadmin','');
/*!40000 ALTER TABLE `social_media_icons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_page_urls`
--

DROP TABLE IF EXISTS `static_page_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `static_page_urls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_page_urls`
--

LOCK TABLES `static_page_urls` WRITE;
/*!40000 ALTER TABLE `static_page_urls` DISABLE KEYS */;
INSERT INTO `static_page_urls` VALUES (1,'Aboutus'),(2,'meet-the-board'),(3,'downloads'),(4,'builders'),(5,'architects'),(6,'products'),(7,'services'),(8,'accessories'),(9,'references'),(10,'connect'),(11,'search'),(12,'home');
/*!40000 ALTER TABLE `static_page_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `superadmin_password`
--

DROP TABLE IF EXISTS `superadmin_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `superadmin_password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `superadmin_password`
--

LOCK TABLES `superadmin_password` WRITE;
/*!40000 ALTER TABLE `superadmin_password` DISABLE KEYS */;
INSERT INTO `superadmin_password` VALUES (1,'GKXAPNHOHAJOGJUNCLSYMBYCLZBGCIQMHJGTUUEQEILCFEGWCVIBQBPOJKGQRZGJ','2017-05-23 17:37:41','admin'),(2,'ZNALCFWFGNEOBQBHOXXMNPZSMOXLSGNTNWTSMJSQDPEKSXKLRPVSKJJABWLVFPDK','2017-05-23 17:37:41','zeemoadmin');
/*!40000 ALTER TABLE `superadmin_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supports`
--

DROP TABLE IF EXISTS `supports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `support_title` varchar(555) NOT NULL,
  `intro_text` text NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supports`
--

LOCK TABLES `supports` WRITE;
/*!40000 ALTER TABLE `supports` DISABLE KEYS */;
INSERT INTO `supports` VALUES (1,'2016-04-13 16:28:18','Zeemo','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"https://www.sleepbus.org/images/zeemologo.png\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Zeemo<sup>TM</sup> was the first corporate to come onboard. They custom built our entire website from scratch. Amazing!</p>\r\n\r\n			<p><a href=\"https://www.zeemo.com.au/\" target=\"_blank\">www.zeemo.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',14,'1','2017-02-14 18:40:30','admin'),(2,'2016-04-13 16:31:47','Ultimate Shutter','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Ultimate_Shutters_Logo_Final_2.jpg\" style=\"width: 200px; height: 187px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Ultimate specialises in manufacturing &amp; installation of Window Roller Shutters &amp; donated all the roller shutters for the first bus &amp; safe sleeps.</p>\r\n\r\n			<p><a href=\"http://www.ultimateshutter.com.au\" rel=\"nofollow\" target=\"_blank\">www.ultimateshutter.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',9,'1','2016-12-29 10:18:51','admin'),(4,'2016-04-27 15:13:25','Ecosa','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/ecosa.jpg\" style=\"width: 200px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Ecosa was born to help people sleep better, and they generously provide sleepbus with all our mattresses.</p>\r\n\r\n			<p><a href=\"http://www.ecosa.com.au/\" rel=\"nofollow\" target=\"_blank\">www.ecosa.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',4,'1','2016-12-29 10:18:51','admin'),(5,'2016-04-27 15:14:09','Truck & Bus Sales','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/truck-bus-sales.jpg\" style=\"width: 300px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Bill sells used buses and coaches around Australia and kindly donated a welder &amp; bus work platform/ladder..</p>\r\n\r\n			<p><a href=\"http://www.truckandbussales.com.au/\" rel=\"nofollow\" target=\"_blank\">www.truckandbussales.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',15,'0','2016-12-29 10:19:24','admin'),(6,'2016-05-05 16:02:47','Tontine','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/tontine.jpg\" style=\"width: 300px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Tontine is Australia&#39;s leading manufacturer and wholesaler of bedding accessories and provided us with comfy pillows, sheets, pillow cases, quilts and quilt covers for the very first sleepbus.</p>\r\n\r\n			<p><a href=\"http://www.tontine.com.au/\" rel=\"nofollow\" target=\"_blank\">www.tontine.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',5,'1','2016-12-29 10:18:51','admin'),(7,'2016-05-05 16:04:18','Westernport Road Lines','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/westernport.jpg\" style=\"width: 300px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Westernport Road Lines supplied sleepbus&reg; with our very first bus &amp; continues to service &amp; maintain it for us.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',6,'1','2016-12-29 10:18:51','admin'),(8,'2016-08-24 13:37:38','The Blind Factory','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/tbflogosm.jpg\" style=\"width: 300px; height: 150px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>The Blind Factory, along with Citi-Con, generously cover our founders wages each month so he can continue the work of getting more sleepbus on the road to provide safe sleeps across Australia.&nbsp;Amazing!</p>\r\n\r\n			<p><a href=\"http://www.theblindfactory.com.au\" rel=\"nofollow\" target=\"_blank\">www.theblindfactory.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',3,'1','2016-12-29 10:18:51','admin'),(9,'2016-08-24 13:52:33','Citi-Con','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Citi-Con.PNG\" style=\"width: 280px; height: 180px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Ivan from Citi-Con contacted our founder (Simon) as he wanted to find a way he could help sleepbus. Simon was self funded, so Ivan and his business partner Brendon rang Brett from The Blind Factory, and all decided to generously cover Simon&#39;s wage each month so he can carry on without worry. How cool is that?</p>\r\n\r\n			<p><a href=\"http://www.citicon.com.au\" rel=\"nofollow\" target=\"_blank\">www.citicon.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',2,'1','2016-12-29 10:18:51','admin'),(11,'2016-12-24 17:24:25','Ribgy Cooke Lawyers','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/RigbyCookLawyers.jpg\" style=\"width: 400px; height: 60px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>The pro bono team that made it all possible.</p>\r\n\r\n			<p><a href=\"https://www.rigbycooke.com.au/\" target=\"_blank\">www.rigbycooke.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',1,'1','2016-12-29 10:18:51','admin'),(12,'2016-12-24 17:32:53','Kayden Electrical','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Kayden%20Electrical%20logo.jpeg\" style=\"width: 300px; height: 70px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>The passionate electrician!</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',7,'1','2016-12-29 10:18:51','admin'),(13,'2016-12-24 17:36:52','DES Electrical','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/des%20logo.jpg\" style=\"width: 300px; height: 199px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>The passionate electrician&#39;s mate that turned the lights on.</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',8,'1','2016-12-29 10:18:51','admin'),(14,'2016-12-24 17:40:18','Bendigo Bank','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/bendigoBankLogo.jpg\" style=\"width: 300px; height: 161px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Proud supporters of &#39;community&#39;.</p>\r\n\r\n			<p><a href=\"https://www.bendigobank.com.au/\" target=\"_blank\">www.bendigobank.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',12,'1','2016-12-29 10:18:51','admin'),(15,'2016-12-24 17:49:54','GoFundMe','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/gofundme.jpg\" style=\"width: 285px; height: 91px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>Loved sleepbus&reg; so much that they paid for a PR Agency to help. Noice!</p>\r\n\r\n			<p><a href=\"https://www.gofundme.com/sleepbus\" target=\"_blank\">www.gofundme.com/sleepbus</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',10,'1','2016-12-29 10:18:51','admin'),(16,'2016-12-24 17:52:06','Illumin8 Accounting','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Illumin8logo1.png\" style=\"width: 300px; height: 86px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>The ones that make the transparent books make sense.</p>\r\n\r\n			<p><a href=\"https://www.illumin8.com.au/\" target=\"_blank\">www.illumin8.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',11,'1','2016-12-29 10:18:51','admin'),(17,'2016-12-29 21:18:44','Action Bookkeeping','<div class=\"crclogo\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Action%20Bookkeeping%20for%20web(1).jpg\" style=\"width: 250px; height: 105px;\" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div class=\"crclogotext\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td valign=\"middle\">\r\n			<p>The backbone of a transparent organisation&#39;s books.</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>',13,'1','2016-12-29 10:18:51','admin');
/*!40000 ALTER TABLE `supports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testimonials_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'test 1','','2014-05-18 18:13:57','zeemoadmin',1,'1');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thank_messages`
--

DROP TABLE IF EXISTS `thank_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thank_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `page_name` varchar(1024) NOT NULL,
  `message` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thank_messages`
--

LOCK TABLES `thank_messages` WRITE;
/*!40000 ALTER TABLE `thank_messages` DISABLE KEYS */;
INSERT INTO `thank_messages` VALUES (1,'2014-12-05 00:00:00','Connect','<h1>Thanks!</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>Thank you for connecting with sleepbus. We will be in touch with you shortly.</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepicon.jpg\" style=\"width: 280px; height: 280px;\" /></p>\r\n</div>','2016-05-10 22:44:07','zeemoadmin'),(2,'2016-04-05 00:00:00','Speaker Request','<h1>Thanks!</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>Thank you for connecting with sleepbus. We will be in touch with you shortly.</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepicon.jpg\" style=\"width: 280px; height: 280px;\" /></p>\r\n</div>','2016-05-10 22:45:59','zeemoadmin'),(3,'2016-04-06 00:00:00','eNewsletter Signup','<h1>Thank You</h1>\r\n\r\n<h2>You have been successfully subscribed to receive sleepbus emails.</h2>','2016-06-02 12:44:59','admin'),(4,'2016-04-19 12:23:35','Forgot Password','<h1>Forgot Password!</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>We have sent a reset password link straight to your inbox. Please check your email.</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepicon.jpg\" style=\"width: 280px; height: 280px;\" /></p>\r\n</div>','2016-06-02 12:45:38','admin'),(5,'2016-04-19 00:00:00','Reset Password','<h1>Password changed!</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>Woohoo, you&#39;ve got yourself a new password. Now you can <a href=\"https://www.sleepbus.org/signin\">sign in</a>.</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepicon.jpg\" style=\"width: 280px; height: 280px;\" /></p>\r\n</div>','2017-02-14 18:40:30','admin'),(6,'2016-04-28 00:00:00','Birthday Pledge','<div>Your birthday pledge has been created successfully. Continue&nbsp;to a create a campaign by filing out this form.&nbsp;</div>','2016-06-02 12:46:35','admin'),(7,'2016-04-28 00:00:00','Create Campaign','<div>Congratulations!&nbsp;You have successfully&nbsp;created a campaign.</div>','2016-06-02 12:46:54','admin'),(8,'2016-04-28 00:00:00','Posting a Comment For a Campaign By User','<p>Your comment has been successfully updated.</p>','2016-06-02 12:47:14','admin'),(9,'2016-04-28 00:00:00','Update Profile','<p>Your profile has been successfully updated.</p>','2016-06-02 12:47:28','admin'),(10,'2016-04-28 00:00:00','Thanks Message For Campaign Donation','<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-12\" id=\"activecampaigns\">\r\n<h2 style=\"text-align: center; color: rgb(0, 201, 251);\">Active Campaigns</h2>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.sleepbus.org/byronshire\" target=\"_blank\">Byron Shire</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/perth\" target=\"_blank\">Perth Community</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/qlik\" target=\"_blank\">Qlik</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/stroll-to-the-shack-for-sleepbus\" target=\"_blank\">Stroll to the shack</a></li>\r\n	<li><a href=\"http://www.sleepbus.org/belinda-jane-staff-friends\" target=\"_blank\">Belinda Jane</a></li>\r\n</ul>\r\n</div>\r\n\r\n<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-12\">\r\n<p style=\"text-align:center;\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Simon_Bitmoji_Thank_You_no_logo.jpeg\" /></p>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2 style=\"text-align: center;\">Thank you so much for your donation. Truly appreciated. You not only made a decision to help get people off the street and provide safe sleeps, but you took action. You&rsquo;re Awesome!</h2>\r\n</div>\r\n</div>','2017-03-17 00:59:22','admin'),(11,'2016-04-28 00:00:00','One Time Donation','<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-12\" id=\"activecampaigns2\"><a href=\"https://www.sleepbus.org/pledge\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Pledge_advert_for_web_600_button.jpg\" /></a></div>\r\n\r\n<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-12\">\r\n<div class=\"fundingtoptext\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Simon_Bitmoji_Thank_You_no_logo.jpeg\" />\r\n<h2>Thank you so much for your donation and support. Once your funds have been allocated to a project&nbsp;we will let you know which one so you can follow its progress. Thanks again for your support&nbsp;:)</h2>\r\n</div>\r\n</div>','2017-03-27 19:53:29','admin'),(12,'2016-04-28 00:00:00','Recurring Donation','<h1>Wow!</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>Thank you so much for your monthly donation and ongoing support. Once your funds have been allocated to a project&nbsp;we will let you know which one so you can follow its progress. Thanks again for your support and for providing safe sleeps to people in need&nbsp;:)</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepicon.jpg\" style=\"width: 280px; height: 280px;\" /></p>\r\n</div>','2016-06-02 12:48:34','admin'),(13,'2016-04-28 00:00:00','Donation Cancel Page','<h1>Donation Cancelled</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>Sorry!&nbsp;Your donation has been cancelled. Please try again.</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/WebsiteBus.jpg\" style=\"width: 300px; height: 216px;\" /></p>\r\n</div>','2016-06-04 10:53:05','zeemoadmin'),(14,'2016-04-28 00:00:00','Donation Unsuccess Page','<h1>Donation Unsuccessful</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>Sorry!&nbsp;Your last transaction was unsuccessful. Please try again.&nbsp;</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/WebsiteBus.jpg\" style=\"width: 300px; height: 216px;\" /></p>\r\n</div>','2016-06-04 10:53:38','zeemoadmin');
/*!40000 ALTER TABLE `thank_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top_text`
--

DROP TABLE IF EXISTS `top_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top_text`
--

LOCK TABLES `top_text` WRITE;
/*!40000 ALTER TABLE `top_text` DISABLE KEYS */;
INSERT INTO `top_text` VALUES (1,'Footer text','<div class=\"container\">\r\n<div class=\"col-lg-6 col-md-8 col-sm-6 leftfooter\">\r\n<div class=\"row\">\r\n<ul>\r\n	<li>Get to know us</li>\r\n	<li><a href=\"https://www.sleepbus.org/why-sleep\">Why sleep?</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/about-us\">About us</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/meet-the-board\">Meet the board</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/completed-projects\">Projects</a></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Resources</li>\r\n	<li><a href=\"https://www.sleepbus.org/sleepbus-toolbox\">sleepbus toolbox</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/in-the-media\">In the media</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/speaker-request\">Speaker request</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/blog\">Blog</a></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Get involved</li>\r\n	<li><a href=\"https://www.sleepbus.org/donate\">Donate</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/pledge\">Pledge</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/fundraise\">Fundraise</a></li>\r\n	<li><a href=\"https://www.sleepbus.org/corporate-supporters\">Corporate support</a></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.sleepbus.org/connect\">Connect</a></li>\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-2 col-md-4 col-sm-6 col-xs-12 rightfooter\" id=\"charitylogo\"><img alt=\"ACNC Registered Charity\" src=\"https://www.sleepbus.org/images/ACNC-Registered-Charity-Logo_reverse_300.png\" /></div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-12 rightfooter\">\r\n<div class=\"awesomeemails\"><a href=\"https://www.sleepbus.org/enewsletter-signup\">get our awesome emails</a></div>\r\n\r\n<div class=\"footerfbbox\"><a class=\"fb\" href=\"https://www.facebook.com/sleepbusaustralia\" target=\"_blank\"><span>fb</span></a> <a class=\"twitter\" href=\"https://twitter.com/sleepbus\" target=\"_blank\"><span>twitter</span></a> <a class=\"youtube\" href=\"https://www.youtube.com/channel/UCsfnzxuWrjMsKxjdZyFdXEA\" target=\"_blank\"><span>youtube</span></a></div>\r\n\r\n<p><span style=\"color:#fff\">Registered DGR | All Donations over $2 are Tax Deductible </span><a href=\"https://www.sleepbus.org/privacy-policy\">Privacy policy.</a> © 2016</p>\r\n</div>\r\n</div>\r\n','2017-02-17 00:46:45','admin'),(2,'Project Page','<h1>Projects</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>sleepbus One Under Construction - The first sleepbus will be on the road soon!</h2>\r\n\r\n<div class=\"aboutbordbus\" style=\"margin-top:-60px; margin-bottom:10px;\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-project-under-construction.jpg\" /></div>\r\n\r\n</div>\r\n','2016-06-23 02:43:56','admin'),(3,'Corporate Support Top Text','<h1>Corporate support</h1>\r\n\r\n<div class=\"fundingtoptext\">We partner with corporations for matching programs, public campaigns, employee engagement and other fundraising ideas tailored to the business&#39; market and brand. It is this support that makes it possible for sleepbus to do the work that needs to be done and allows us to always use 100% of public donations to fund sleepbus projects.</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"row\">\r\n<div class=\"fundingboxone\">\r\n<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-12 fundingboxleft\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon9.png\" /></div>\r\n\r\n<div class=\"col-lg-9 col-md-9 col-sm-7 col-xs-12 fundingboxright\">\r\n<h2>sleepbus Investor</h2>\r\n\r\n<p>Our sleepbus Investors are donors that recognise the impact of a major gift to our operational expenses. Like any startup business, we need investors who believe in, and support our business model. The 100% Model. But we can&rsquo;t offer stock options or the promise of a big buyout; so instead, our investors ROI is measured in the amount of safe sleeps we provide; one sleepbus can provide 8,030 safe sleeps per year and our aim is 300+ buses providing more than 2,000,000 safe sleeps and ending the need for people to sleep rough in Australia.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"row\">\r\n<div class=\"fundingboxtwo\">\r\n<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-12 fundingboxleft\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon10.png\" /></div>\r\n\r\n<div class=\"col-lg-9 col-md-9 col-sm-7 col-xs-12 fundingboxright\">\r\n<h2>Bus Fuel</h2>\r\n\r\n<p>Membership Program</p>\r\n\r\n<p>Our goal for the 100% program model is ambitious. To support our growth, we bring together a like-minded community of business people and philanthropists to fund our operating budget on a regular&nbsp;basis. Bus Fuel is a membership program where donors give a set amount to our operating costs each year. Their support paves the way for us to continue doing what many will say is impossible: scale the organisation using our 100% model and end the need for people to sleep rough in Australia.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"row\">\r\n<div class=\"fundingboxthree\">\r\n<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-12 fundingboxleft\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon11.png\" /></div>\r\n\r\n<div class=\"col-lg-9 col-md-9 col-sm-7 col-xs-12 fundingboxright\">\r\n<h2>Gifts in kind</h2>\r\n\r\n<p>We are in need of various items, from technologies to supplies; office space to office furniture; bus depot location to workshop facilities and tools. Much of what we have has been donated by generous businesses already and we are truly grateful to those that provide equipment and materials to help us get the job done with quality and style.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"fundingbottomtext\">Get your Company on board: <a href=\"mailto:corporategiving@sleepbus.org\">corporategiving@sleepbus.org</a></div>\r\n','2017-02-14 18:40:31','zeemoadmin'),(4,'Our Support Top Text','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 fundingboxfour\">\r\n<div class=\"row\">\r\n<h2>Our supporters</h2>\r\n\r\n<div class=\"fundingtoptext2\">In-kind donations from our donors and partners allow sleepbus to pass 100% of public donations straight to sleepbus projects. We are deeply grateful for those who have surprised us with their generosity. A big thanks to the following companies and people who have helped make sleepbus possible:</div>\r\n[[OUR_SUPPORT_ITEMS]]</div>\r\n</div>\r\n','2016-06-28 05:00:28','zeemoadmin'),(5,'Blog Landing Page','<h1>Blog</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>Stories and updates from our team, partners, and supporters</h2>\r\n</div>\r\n','2016-04-28 21:34:41','admin'),(6,'In the media','<div class=\"inthemediabox\" style=\"background:url(https://www.sleepbus.org/images/img26.jpg) no-repeat center top;\">\r\n<div class=\"container\">\r\n<h1>In the media</h1>\r\n\r\n<p>Check out all the hype sleepbus is creating around the world!</p>\r\n</div>\r\n</div>\r\n','2017-02-14 18:40:31','zeemoadmin'),(7,'In the media bottom text','<div class=\"enquirieslink\">Media enquiries: <a href=\"mailto:info@sleepbus.org\">info@sleepbus.org</a></div>\r\n','2016-06-20 23:30:36','admin'),(8,'Media Toolbox Top Text','<h1>sleepbus toolbox</h1>\r\n\r\n<h2>Branding</h2>\r\n\r\n<p>We love our brand. Please treat it with care.<br />\r\nFor guidelines on everything from logos to language, take a look at our <a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus_Brand_Book_V1.pdf\">Brand Book</a>.</p>\r\n','2016-06-23 02:52:34','admin'),(9,'Branding Content','<div class=\"timelineboxlogo\">\r\n<div class=\"col-lg-5 col-md-5 col-sm-5 col-xs-12\">\r\n<div class=\"col-lg-12 timelineboxlogoone\"><a data-target=\"#branding1\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-horz.jpg\" /> </a>\r\n\r\n<p>Download <a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus-download-hor-white.zip\">JPG</a> - <a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus-horizontal-org.zip\">EPS</a></p>\r\n\r\n<div class=\"modal fade\" id=\"branding1\" role=\"dialog\">\r\n<div class=\"modal-dialog\">\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-download-hor-white(2).jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 timelineboxlogoone\"><a data-target=\"#branding2\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-horz2.jpg\" /> </a>\r\n\r\n<p>Download <a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus-download-hor.zip\">JPG</a> - <a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus-horizontal-org-2.zip\">EPS</a></p>\r\n\r\n<div class=\"modal fade\" id=\"branding2\" role=\"dialog\">\r\n<div class=\"modal-dialog\">\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-download-hor.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-7 col-md-7 col-sm-7 col-xs-12\">\r\n<div class=\"col-xs-6 timelineboxlogotwo\"><a data-target=\"#branding3\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-ver.jpg\" /> </a>\r\n\r\n<p>Download <a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus-download-vertical-white.zip\">JPG</a> - <a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus-vertical-org.zip\">EPS</a></p>\r\n\r\n<div class=\"modal fade\" id=\"branding3\" role=\"dialog\">\r\n<div class=\"modal-dialog\">\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-download-vertical-white.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-xs-6 timelineboxlogotwo\"><a data-target=\"#branding4\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-ver2.jpg\" /></a>\r\n\r\n<p>Download<a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus-vertical-download-black.zip\">JPG</a> - <a href=\"/application/third_party/ckfinder/userfiles/files/sleepbus-vertical-org2.zip\">EPS</a></p>\r\n\r\n<div class=\"modal fade\" id=\"branding4\" role=\"dialog\">\r\n<div class=\"modal-dialog\">\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/sleepbus-vertical-download-black(1).jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n','2016-06-28 04:27:54','zeemoadmin'),(10,'Toolbox Videos','<h2>Videos</h2>\r\n\r\n<p>The easiest way to share our videos is directly from our channel on youtube.</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 toolboxvideoimg\"><a data-target=\"#video1\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img27.jpg\" /></a>\r\n\r\n<div class=\"modal fade\" id=\"video1\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><iframe allowfullscreen=\"\" frameborder=\"0\" height=\"360\" src=\"//www.youtube.com/embed/nLgIkmQ_BVo\" width=\"640\"></iframe></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<p><a href=\"https://www.youtube.com/watch?v=nLgIkmQ_BVo\" target=\"_blank\">SHARE VIDEO</a></p>\r\n</div>\r\n\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 toolboxvideoimg\"><a data-target=\"#video2\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img28.jpg\" /></a>\r\n\r\n<div class=\"modal fade\" id=\"video2\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><iframe allowfullscreen=\"\" frameborder=\"0\" height=\"360\" src=\"//www.youtube.com/embed/nLgIkmQ_BVo\" width=\"640\"></iframe></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<p><a href=\"#\">SHARE VIDEO</a></p>\r\n</div>\r\n\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 toolboxvideoimg\"><a data-target=\"#video3\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img29.jpg\" /></a>\r\n\r\n<div class=\"modal fade\" id=\"video3\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img29.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<p><a href=\"#\">SHARE VIDEO</a></p>\r\n</div>\r\n\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 toolboxvideoimg\"><a data-target=\"#video4\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img30.jpg\" /></a>\r\n\r\n<div class=\"modal fade\" id=\"video4\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"https://www.sleepbus.org/images/img30.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<p><a href=\"#\">SHARE VIDEO</a></p>\r\n</div>\r\n</div>','2017-02-14 18:40:31','admin'),(11,'Toolbox Facebook Timeline Content','<h2>Facebook timeline photos</h2>\r\n\r\n<p>Show your friends that you care about sleepbus.</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#facebook1\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/FB%20Banner-01.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/FB%20Banner-01.zip\">download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"facebook1\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/FB%20Banner-01.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#facebook2\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/FB%20Banner-02.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/FB%20Banner-02.zip\">download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"facebook2\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/FB%20Banner-02.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#facebook3\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/FB%20Banner-03.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/FB%20Banner-03.zip\">download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"facebook3\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/FB%20Banner-03.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#facebook4\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/FB%20Banner-04.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/FB%20Banner-04.zip\">download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"facebook4\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/FB%20Banner-04.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n','2017-02-14 18:40:31','zeemoadmin'),(12,'Toolbox Twitter  Background','<h2>Twitter backgrounds</h2>\r\n\r\n<p>Don&#39;t just change your background, remember to tweet your support too!</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#twitter1\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-01.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Twitter-01.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"twitter1\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-01.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#twitter2\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-02.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Twitter-02.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"twitter2\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-02.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#twitter3\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-03.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Twitter-03.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"twitter3\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-03.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#twitter4\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-04.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Twitter-04.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"twitter4\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-04.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#twitter5\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-05.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Twitter-05.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"twitter5\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Twitter-05.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<h2>Instagram Downloads</h2>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#insta1\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-01.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Instagram-01.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"insta1\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-01.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#insta2\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-02.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Instagram-02.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"insta2\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-02.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#insta3\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-03.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Instagram-03.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"insta3\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-03.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#insta4\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-04.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Instagram-04(1).zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"insta4\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-04.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 toolboxvideoimg\">\r\n<div class=\"modalimgbox\"><a data-target=\"#insta5\" data-toggle=\"modal\" href=\"#\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-05.jpg\" /></a>\r\n\r\n<div class=\"modalimgboxsearch\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon32.png\" /></div>\r\n</div>\r\n\r\n<p><a href=\"/application/third_party/ckfinder/userfiles/files/Instagram-05.zip\">Download</a></p>\r\n\r\n<div class=\"modal fade\" id=\"insta5\" role=\"dialog\">\r\n<div class=\"modal-dialog\"><!-- Modal content-->\r\n<div class=\"modal-content\">\r\n<div class=\"modal-header\"><button class=\"close\" data-dismiss=\"modal\" type=\"button\">&times;</button></div>\r\n\r\n<div class=\"modal-body\"><img alt=\"\" src=\"/application/third_party/ckfinder/userfiles/images/Instagram-05.jpg\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n','2017-02-14 18:40:31','zeemoadmin'),(13,'Birthday pledge','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 fundraise\" id=\"page-content\">\r\n<div class=\"container positionrelative\">\r\n<div class=\"arrow4\"><img height=\"54\" id=\"scroll-down\" src=\"https://www.sleepbus.org/images/arrow4.png\" width=\"83\" /></div>\r\n\r\n<div class=\"row\">\r\n<h2>How does it work?</h2>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome\">\r\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon23.png\" /></div>\r\n\r\n<h2>Pledge your birthday</h2>\r\n\r\n<p>The first step is simple - just pledge your birthday by using the form above, and share your pledge to let the world know you&rsquo;re serious.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome\">\r\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon24.png\" /></div>\r\n\r\n<h2>Setup a campaign</h2>\r\n\r\n<p>Once you have pledged your Birthday for safe sleeps, setup your campaign. We&#39;ll remind you to start fundraising when we get closer to your big day.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 donatehome\">\r\n<div class=\"donatehomeimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon25.png\" /></div>\r\n\r\n<h2>Always use 100%</h2>\r\n\r\n<p>We&rsquo;ll use 100% of the money you raise to fund sleepbus projects. You&rsquo;ll receive photos of the bus your funds support and its location so you can go and see it for yourself. There&rsquo;s no better present than getting people off the street and providing safe sleeps.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 fundraisecolor\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<h2>Australian birthday facts</h2>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 fundraisecolorbox\">\r\n<h2>66,000</h2>\r\n\r\n<p>birthdays are celebrated in Australia everyday.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 fundraisecolorbox\">\r\n<h2>$770</h2>\r\n\r\n<p>average amount raised by a person&rsquo;s birthday campaign.</p>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12 fundraisecolorbox\">\r\n<h2>28 People</h2>\r\n\r\n<p>have a safe sleep as a result of an average birthday campaign</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n','2017-02-14 18:40:31','admin'),(14,'Donate Content','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"funding\">\r\n<div class=\"fundingicon\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon31.png\" /></div>\r\n\r\n<h1>Donate</h1>\r\n\r\n<div class=\"fundingtoptext\">\r\n<h2>100% of your money will fund sleepbus projects.<br />\r\nGive people safe sleeps and get them off our streets.</h2>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 completedmainbox\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 completedbox2\">\r\n<div class=\"dontebox dontecolorone\">\r\n<h2>Give safe sleeps</h2>\r\n\r\n<h3>One safe sleep is just $55.00</h3>\r\n\r\n<p>100% funds sleepbus projects.</p>\r\n[[ONE_TIME_DONATION_FORM]]</div>\r\n<img alt=\"\" src=\"https://www.sleepbus.org/images/img17.jpg\" /></div>\r\n\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 completedbox2\">\r\n<div class=\"dontebox dontecolorone\">\r\n<h2>Give monthly</h2>\r\n\r\n<h3>Give safe sleeps all year long.</h3>\r\n\r\n<p>100% of your donation gets people off the street and provides safe sleeps.</p>\r\n[[MONTHLY_DONATION_FORM]]</div>\r\n<img alt=\"\" src=\"https://www.sleepbus.org/images/img18.jpg\" /></div>\r\n\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 completedbox2\">\r\n<div class=\"dontebox dontecolorone\">\r\n<h2>Provide one year of safe sleeps</h2>\r\n\r\n<h3>Have an impact. Make a difference.</h3>\r\n\r\n<p>100% funds sleepbus projects.</p>\r\n\r\n<div class=\"findoutmore3\"><a href=\"https://www.sleepbus.org/one-year-safe-sleep\">find out more</a></div>\r\n</div>\r\n<img alt=\"\" src=\"https://www.sleepbus.org/images/img19.jpg\" /></div>\r\n\r\n<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12 completedbox2\">\r\n<div class=\"dontebox dontecolorone\">\r\n<h2>Corporate support</h2>\r\n\r\n<h3>Provide the fuel that keeps sleepbus rolling.</h3>\r\n\r\n<p>Our promise of 100% of public donations fund sleepbus projects is ambitious and we need investors to help. sleepbus investors are donors that recognise the impact of a major gift to our operational expenses. Like any startup business, we need investors who believe in, and support our business model. The 100% Model.</p>\r\n\r\n<div class=\"findoutmore3\"><a href=\"https://www.sleepbus.org/corporate-supporters\">help us get people off the street</a></div>\r\n</div>\r\n<img alt=\"\" src=\"https://www.sleepbus.org/images/img20.jpg\" /></div>\r\n</div>\r\n</div>\r\n','2017-02-14 18:40:31','admin'),(15,'One Year Safe Sleep Banner Content','<div class=\"innerheaderbox\">\r\n<div class=\"whyboxbg3\">\r\n<div class=\"container\">\r\n<h1>Provide one year of safe sleeps</h1>\r\n\r\n<div class=\"homebannerbox\">\r\n<h3>100% funds sleepbus projects.</h3>\r\n\r\n<p>It costs approximately $27.50 per night to provide someone on the street a safe sleep on sleepbus.</p>\r\n\r\n<p>$10,037.50 will provide one safe sleep every night for a year and we believe that with a good night&rsquo;s sleep the pathways out of homelessness will be a little easier to see.</p>\r\n[[ONE_TIME_DONATION_FORM]]</div>\r\n</div>\r\n</div>\r\n</div>\r\n','2016-05-04 17:57:28','zeemoadmin'),(16,'One Year Safe Sleep Page Content','<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"container\">\r\n<div class=\"row provideyearbox\">\r\n<h2>Have an impact. Make a difference.</h2>\r\n\r\n<p>Like our founder, you&rsquo;ve clearly decided that you can no longer walk past and do nothing. You have decided that you want to have a serious impact on the issue of people sleeping rough in Australia and your generous donation can make a huge difference to the lives of those doing it tough, forced out of their homes and into the street.</p>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 provideboxmain\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-12 provideboxinner\">\r\n<div class=\"provideimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon34.png\" /></div>\r\n\r\n<h3>Provide one safe sleep every night for a year</h3>\r\n\r\n<p>365 safe sleeps.</p>\r\n\r\n<h4>Donate $10,037.50</h4>\r\n</div>\r\n\r\n<div class=\"clearboth\">&nbsp;</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-12 provideboxinner\">\r\n<div class=\"provideimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon35.png\" /></div>\r\n\r\n<h3>Buy a bus</h3>\r\n\r\n<p>We&rsquo;ll convert it into a sleepbus.</p>\r\n\r\n<h4>Donate $20,000</h4>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-12 provideboxinner\">\r\n<div class=\"provideimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon36.png\" /></div>\r\n\r\n<h3>Build out a bus</h3>\r\n\r\n<p>Help us build out a sleepbus for safe sleeps.</p>\r\n\r\n<h4>Donate $30,000</h4>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-12 provideboxinner\">\r\n<div class=\"provideimg\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon37.png\" /></div>\r\n\r\n<h3>Buy &amp; Build a sleepbus</h3>\r\n\r\n<p>Help provide 8,030 safe sleeps per year.</p>\r\n\r\n<h4>Donate $50,000</h4>\r\n</div>\r\n</div>\r\n\r\n<div class=\"otherwaysbox\">\r\n<h2>Other ways you can have an impact &amp; make a difference</h2>\r\n\r\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12\">\r\n<div class=\"provideimg\"><a href=\"https://www.sleepbus.org/corporate-supporters\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon38.png\" /></a></div>\r\n\r\n<h3>Investor</h3>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12\">\r\n<div class=\"provideimg\"><a href=\"https://www.sleepbus.org/corporate-supporters\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon39.png\" /></a></div>\r\n\r\n<h3>Bus fuel</h3>\r\n</div>\r\n\r\n<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12\">\r\n<div class=\"provideimg\"><a href=\"https://www.sleepbus.org/corporate-supporters\"><img alt=\"\" src=\"https://www.sleepbus.org/images/icon40.png\" /></a></div>\r\n\r\n<h3>Gifts in kind</h3>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n','2017-02-14 18:40:31','zeemoadmin');
/*!40000 ALTER TABLE `top_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_campaigns`
--

DROP TABLE IF EXISTS `user_campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_name` varchar(555) NOT NULL,
  `campaign_goal` varchar(255) NOT NULL,
  `campaign_end_date` date NOT NULL,
  `campaign_type` int(11) NOT NULL,
  `campaign_image` int(11) NOT NULL,
  `url` varchar(555) NOT NULL,
  `statement` text NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_campaigns`
--

LOCK TABLES `user_campaigns` WRITE;
/*!40000 ALTER TABLE `user_campaigns` DISABLE KEYS */;
INSERT INTO `user_campaigns` VALUES (1,'2016-05-26 09:43:46',1,'Simon\'s Birthday','2000','2017-02-20',1,9,'simon-s-birthday','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-07-07 06:34:24'),(2,'2016-05-27 14:11:27',2,'Annes Test Campaign','275.00','2016-08-03',1,9,'anne-s-test-campaign','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-06-09 04:32:32'),(3,'2016-05-27 16:00:23',1,'Ethans Birthday','1000','2017-01-07',1,9,'ethan-s-birthday','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-06-09 04:03:06'),(4,'2016-05-27 16:03:05',3,'Ethan\'s Birthday','500','2017-01-07',1,0,'ethan-s-birthday-1','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-06-09 04:03:10'),(5,'2016-06-02 21:40:55',4,'Anne is kinda cool','500','2016-09-04',1,9,'anne-is-cool','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-06-09 04:03:14'),(6,'2016-06-08 11:01:34',4,'Annie Test #2','2000.00','2016-10-10',4,0,'annie-test-2','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-06-09 04:03:21'),(7,'2016-06-08 11:24:13',4,'Annie does White Castle','20.00','2016-08-03',5,0,'annie-does-white-castle','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-06-09 04:03:26'),(8,'2016-06-08 11:28:32',4,'Missy Moo','30','2016-12-15',4,15,'missy-moo','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-06-09 04:03:30'),(9,'2016-06-09 11:58:00',4,'Bruno','400','2017-06-12',6,17,'bruno','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!<br /> But too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.<br /> I started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.<br /> Please donate to my campaign -- anything you can give is a huge help.<br /> 100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.<br />','1','2016-06-09 04:07:56'),(10,'2016-06-10 17:08:27',1,'test 3','2750','2017-01-07',4,21,'test-3','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2016-06-10 07:08:27'),(11,'2016-06-10 19:12:18',1,'this is a very long campaign name but does it fit?','1250','2016-09-07',4,21,'this-is-a-very-long-campaign-name-but-does-it-fit','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2016-06-10 09:12:18'),(12,'2016-06-21 09:35:38',2,'questions marks 43 numbers!!!@#$','275.00','2017-09-23',5,16,'hksdf-asdf-asdlkfl-skdf-lksadl-fka-sdkf-laskdfl-aksdl-fkasldfkklklfklskdf-lkasdlfkkla-sdlfk-asdfasdfasdf','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help. Blah b;ahg\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2016-06-29 01:16:42'),(13,'2016-07-07 14:56:38',5,'Test campaign','300','2016-07-07',5,22,'test-campaign','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2016-07-07 08:05:40'),(14,'2016-07-06 15:18:37',5,'test birthday','200','2016-07-07',1,9,'test-birthday','','1','2016-07-07 08:05:44'),(15,'2016-07-15 13:24:43',6,'This year my Birthday Wish is to help get 20 people of the street for the night.','550','2016-09-02',1,9,'this-year-my-birthday-wish-is-to-help-get-20-people-of-the-street-for-the-night','','1','2016-07-15 03:24:43'),(16,'2016-07-18 10:43:33',7,'Paws  Pals-Living Ruff in SA  SPSF loves Sleepbus for SA','25000','2017-02-01',8,19,'paws-pals-living-ruff-in-sa-spsf-loves-sleepbus-for-sa','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.\r\n\r\nSleepbus will compliment Paws & Pals- Living Ruff in SA (pop up Vet for homeless) & Safe Pets Safe Families (fostering for people in Dv, homelessness & other crisis situations)','1','2016-07-18 10:57:39'),(17,'2016-07-19 18:48:14',9,'Belinda Jane Staff and Friends','3000','2016-12-31',6,17,'belinda-jane-staff-friends','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. Sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nThe staff at Belinda Jane Video have started this fundraising campaign to help sleepbus build and operate buses, all over Australia and I\'m looking for anyone who can help.\r\n\r\nPlease donate to our campaign -- anything you can give is a huge help.\r\n\r\nWe have an in-house coffee machine, and are paying $1 per coffee each and also $1 per small packet of chips or fruit that we have.  All the money raised is going directly to sleepbus.  The past 3 weeks, we have raised $120 just from those small donations.  You can do it too.  \r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.\r\n\r\n*****   IMPORTANT NOTICE: When making your donation, you MUST click on \"RETURN TO MERCHANT\" after the PayPal transaction otherwise your donation won\'t be registered to this campaign.    *****','1','2017-04-03 02:03:59'),(18,'2016-08-18 22:46:17',12,'O\'Toole Birthday pledge','27.50','2016-08-30',1,9,'o-toole-birthday-pledge','','1','2016-08-18 12:46:17'),(19,'2016-09-14 13:39:56',16,'SleepBus Birthday Pledge FUN-draiser','275','2017-01-26',1,9,'sleepbus-birthday-pledge-fun-draiser','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2016-09-14 03:47:23'),(20,'2016-09-29 12:05:39',21,'30th Birthday Bypass','600','2017-05-25',1,31,'30th-birthday-bypass','','1','2016-09-29 02:05:39'),(21,'2016-10-24 21:58:01',23,'Brownies Birthday','275','2017-02-08',1,8,'brownies-birthday','','1','2016-10-24 10:58:01'),(22,'2016-10-27 10:30:47',26,'SAFE PLACE HAVEN','275.00','2016-11-27',6,17,'safe-place-haven','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2016-10-26 23:30:47'),(23,'2016-11-06 17:09:00',28,'Helping the homeless','10000','2017-06-15',4,33,'helping-the-homeless','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2016-11-06 06:11:06'),(24,'2016-11-09 19:53:14',12,'Byron Shire Fundraising','100000','2017-06-30',11,47,'byronshire','**IMPORTANT NOTICE: When making your donation, you MUST return to this webpage after the PayPal transaction otherwise your donation won\'t be registered to this campaign. **\r\n\r\n\r\n\r\nDear sleepbus Family and the Byron Shire Community, \r\n\r\nMany of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of temporary overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nA few weeks ago I was approached by residents of Byron Shire, the Chamber of Commerce and the Mayor, about the possibility of a sleepbus in Byron Shire. During the discussions, I was made aware of the issues facing the Byron Shire community with regards to housing affordability and those forced to sleep rough. \r\n\r\nThose forced to sleep rough are exposed to major physical and mental health issues and lets face it, sleeping outside isn\'t safe. The reason why I developed the sleepbus solution was to provide safe sleeps, a temporary solution, until a long term solution program can be realised. \r\n\r\nI came to Byron Shire (8/11/16) at the request of various community members and the Byron Bay Chamber of Commerce to discuss a sleepbus for Byron Shire... we decided we were going to make it happen! We need your help.  \r\n\r\nWe have started this fundraising campaign to help sleepbus build and operate one bus to start, which will provide 8,030 safe sleeps per year, and I\'m looking for the Byron Shire community to help make this happen.\r\n\r\nPlease donate to the Byron Shire Campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for the Byron Shire sleepbus project, and when we reach our goal, the bus will be built, delivered and begin operations in Byron Shire. We want this to be by winter 2017. I look forward to you seeing exactly how we are helping to provide safe sleeps and making Byron Shire the best place for all of us. \r\n\r\nThank you\r\n\r\nSimon\r\nsleepbus Founder\r\n\r\nsleepbus is a registered Australian charity | All donations are TAX DEDUCTIBLE.','1','2017-04-06 05:29:58'),(25,'2016-11-28 20:37:05',33,'Sleep 50 for my 50th please','1375.00','2016-12-20',4,21,'sleep-50-for-my-50th-please','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2016-12-03 23:01:27'),(26,'2016-11-30 08:53:38',34,'A warm safe bed.','275','2017-10-28',1,31,'a-warm-safe-bed','','1','2016-11-29 21:53:38'),(27,'2016-12-02 16:17:03',12,'Perth Community Fundraising','100000','2017-03-31',11,48,'perth','**IMPORTANT NOTICE: When making your donation, you MUST return to this webpage after the PayPal transaction otherwise your donation won\'t be registered to this campaign. **\r\n\r\n\r\n\r\nMany of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nMichelle was a 34 year old Mum of 2. She made a promise to her kids a few years ago about getting better and returning home to them. She never completed that promise as she died in the bushes of Rockingham in a diabetic coma - homeless. \r\n\r\nSimon Rowe, the founder of sleepbus, has consented that the first bus we bring to WA will be named MICHELLE in her honour. \r\n\r\nWe are hoping to raise $100,000 before March 2017 to try and have our bus here by winter. This is bus number 1 for WA and we know that bus 2 and 3 will not be far behind.  We would love to see you get behind this campaign either in spirit or financially. Share this campaign with as many in WA as you can. \r\n\r\nEach bus sleeps 22 people who require accommodation for the night. That\'s 8,030 safe sleeps per year from one sleepbus. \r\n\r\nIf we had sleepbus over here back in May 2014, Michelle might be alive today, snuggled up with her children in safety. \r\n\r\n #bringmichellehome\r\n\r\n\r\n\r\nsleepbus is a registered Australian charity | All donations are TAX DEDUCTIBLE.','1','2016-12-07 05:51:53'),(28,'2016-12-24 04:44:48',38,'Sleepbus','300','2017-01-25',1,31,'sleepbus','','1','2016-12-23 17:44:48'),(29,'2017-01-20 14:13:51',42,'Slumber party for Sleepbus','500','2017-02-20',10,37,'slumber-party-for-sleepbus','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2017-01-20 03:13:51'),(30,'2017-02-09 20:53:26',44,'Grace Sleepbus','550','2018-02-09',9,20,'grace-sleepbus','<div>Testing HTML</div>\r\nMany of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2017-02-09 09:56:01'),(31,'2017-02-12 08:04:43',45,'Testing Campaign After Migration','5500','2017-12-31',8,42,'testing-campaign-after-migration','Many of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nI started this fundraising campaign to help sleepbus build and operate buses, and I\'m looking for anyone who can help me.\r\n\r\nPlease donate to my campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2017-02-11 21:04:43'),(33,'2017-02-27 18:09:30',47,'Qlik','100000','2017-12-25',11,49,'qlik','***NOTE: PLEASE CLICK \"RETURN TO MERCHANT\" AFTER YOUR DONATION TO HAVE IT ALLOCATED TO THIS CAMPAIGN.***\r\n\r\n\r\n\r\nAt Qlik, we\'re all about the story, the whole story. We\'re all about making Sense of the chaos. What we do best is provide solutions to our clients problems and make everything clear so they can see the whole story in their data with Qlik Sense. \r\n\r\nsleepbus is a powerful story. A story about not walking by, about not ignoring the problem, a story about taking action. Taking action can change the world and that’s what we want to do.\r\n\r\nWhat sleepbus does is provide safe sleeps for those doing it tough, but it\'s so much more than that. They provide clarity in the chaos. They provide their clients with safety, with piece of mind and a moment of clarity to work out a strategy to move forward and find their pathway out of homelessness. This is why Qlik and sleepbus are so very well aligned – clarity, direction, peace of mind moving forward.\r\n\r\nQlik doesn\'t want to just help sleepbus, we want to take action. We want to BUY a sleepbus. We want to raise $100,000 to build a whole sleepbus, that will provide 8,030 safe sleeps per year. \r\n\r\nThe founder of sleepbus, Simon, refers to sleepbus supporters as \"the sleepbus family\". He says;\r\n\r\n\"When people work together, their strengths magnify. Family bestows them with a collective power to withstand all kinds of hardship.\r\n\r\nThis is why the sleepbus family is extremely important to ending the need for people to sleep rough.\"\r\n\r\nQlik family. We can do it. We can do it together.\r\n\r\nFundraise and donate to this campaign and let\'s buy, build and launch a sleepbus for safe sleeps; together we can help end the need for people to sleep rough in Australia.','1','2017-05-19 01:17:03'),(34,'2017-03-14 14:05:26',12,'Stroll to the shack for sleepbus','300.00','2017-05-31',4,15,'stroll-to-the-shack-for-sleepbus','This Good Friday, Sarah and Stacey are going to do a 15km walk through the hills and bends between Campbell\'s Creek and Glenluce. This will take approximately 3-4 hours and believe it\'s going to be quite a challenge for us - but all for a good cause, sleepbus®.\r\n\r\nMany of us have no idea what it\'s like to sleep rough. We have a roof over our heads and a comfy bed to sleep in each night!\r\n\r\nBut too many people around Australia don’t have that luxury. Every night, about 6,314 people are sleeping rough, and that number is growing. But it doesn’t have to be that way. sleepbus offers a simple solution of safe overnight accommodation to help provide safe sleeps to those in need around the country.\r\n\r\nWe started this fundraising campaign to help sleepbus build and operate buses, and we are looking for anyone who can help us.\r\n\r\nPlease donate to our campaign -- anything you can give is a huge help.\r\n\r\n100% of the money will be used for sleepbus projects, and when they’re complete, sleepbus will send us photos and locations so we can see exactly how we are helping to provide safe sleeps.','1','2017-04-21 04:44:33');
/*!40000 ALTER TABLE `user_campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateadded` datetime NOT NULL,
  `full_name` varchar(555) NOT NULL,
  `email` varchar(555) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `other_type` varchar(255) NOT NULL,
  `phone` varchar(24) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  `'modified_by_user` varchar(225) NOT NULL,
  `reset_link` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2016-05-26 09:43:43','Mr. Milford McKenzie','ryan.farrell@crooks.name','XQHLKOIGNNDUGSXWLVOKRNTTPTYWMIBQLBKBJJRDBMCFRLBHZDIBLDFGKXNVMQOV','3','','764.044.7382','0','2017-05-23 17:37:40','admin','',''),(2,'2016-05-27 02:11:24','Trevion Beier Sr.','orville@spencer.org','YHMHQGRDODILODIWZOOAHLAJFCOCEEUZRZKRNHPUPQJVPBLYVQUMLXAWIQOVUBBF','3','','510-756-8516 x2186','1','2017-05-23 17:37:40','','',''),(3,'2016-05-27 04:01:07','Keshawn Sawayn DDS','hallie@franecki.info','MBYBSWXRFKICRAAJGTANNHLTPDUCMUSXZZYEZECAKJYLVQFDGBGJGBSDNZWWQZUV','3','','(956) 564-3933','0','2017-05-23 17:37:40','admin','',''),(4,'2016-06-02 09:40:53','Kyleigh Kertzmann','rocky.collins@abshiregraham.io','JDXALGKONONXENKJNDFSGFZMYOYABFUHVQQQSLXTMZXNFWAMGGCYNESPLQKXYLFW','3','','(683) 704-5538 x03411','1','2017-05-23 17:37:40','user','',''),(5,'2016-07-07 02:56:36','Miss Carmella Upton','alisha@gislasonlesch.biz','UNBPNEZUYXCCNEZHTLCFFWXGGRELBPBCYRPMNQVBXPUHRVEAKXGUFGGFDBQJJEAX','4','','370.912.0576 x19282','0','2017-05-23 17:37:40','admin','',''),(6,'2016-07-15 01:24:40','Odell Walker','delilah@leffler.biz','GFUXAGZUEPCKFNMNYITOOMLHQBPIVPROTBEIOOGVTREJOREIVUWSMJFEARYQJMNL','3','','820.448.1372 x76466','1','2017-05-23 17:37:40','','',''),(7,'2016-07-18 10:43:30','Tatum Durgan','cory@gislason.info','WDBISNXJGRHTMOHPDZVOBKTNPMISORIMKMMQFMQILSKVHCAYOPTRTONVEBGXGKAK','other','Not for profit organisation','415.241.8915 x1569','1','2017-05-23 17:37:40','user','',''),(8,'2016-07-18 08:15:15','Bell Little','era@yundthuels.org','CIZMJRQVILQHPEJHAZEJRWIYYSLOZCJOJFYKYABILIPTOUYLWQOHVODKXCWDOMBM','3','','1-241-441-3033 x74291','1','2017-05-23 17:37:40','','',''),(9,'2016-07-19 06:48:13','Mrs. Sydnie Murazik','xander@mraz.com','XLZSTBXMTBKYZLDXTHKFYVHVAZMVULSASKHMJHFBMVDMUWZOBOGGJWXHNQLVRDMV','4','','(541) 939-9806 x453','1','2017-05-23 17:37:40','user','',''),(10,'2016-08-05 09:09:09','Mr. Amya O\'Kon','oma_bartoletti@adamscasper.name','ULHDBWUCDPAWODNMGCZLJUTFFQJKQLMDKETEQPBUYZQPJDAWDJZKCLVRSIXSUDRW','3','','217-152-5043','1','2017-05-23 17:37:40','','',''),(11,'2016-08-12 09:49:52','Mrs. Ed Olson','merle.leuschke@quitzon.biz','ROXWLRSGDWKLNCAYJJMMRWNLDIWVTUIBAZQEVITLLNUOJXNBWUUTQARDYFMXFNCX','3','','963.152.8396 x1240','1','2017-05-23 17:37:41','','',''),(12,'2016-08-18 10:46:14','Rosetta Langworth','marina@mcclurewaelchi.biz','EHHCLKTORZWCTVHFJNLRTVXJGJBLSFGDEDGPOXXSKFIRWIGTGDVSDQPSVIXOGHSQ','3','','1-860-268-9758','1','2017-05-23 17:37:41','user','',''),(13,'2016-09-03 04:58:20','Mr. Rosemarie Jones','dedrick@mcglynn.info','NGYTFFWINMVSDKXIOKFHIQRGFYCATDBPGGBIOWLTVMRSHEEHPCXGWDCZBECLFJJV','3','','1-494-318-1639','1','2017-05-23 17:37:41','','',''),(14,'2016-09-08 12:16:29','Maximilian Goodwin','devyn@herzog.co','UUAILDBSPKWQAJIKBEIRSUXGXVJZHUJUWUXQOXGLQINXUNGNEMYDBBDKMRXIRXDT','3','','(391) 972-2401','1','2017-05-23 17:37:41','','',''),(15,'2016-09-09 12:32:13','Miss Sally Brekke','janelle.friesen@luettgen.info','AMAGZVWVNGADHAWWQNAOZEGJUDCLAGVSILFJXRBUJXYNFJMYFFRABACAHYQHQTAH','3','','331-484-6512 x2643','1','2017-05-23 17:37:41','','',''),(16,'2016-09-14 01:39:54','Marilie Becker','bernadine.pouros@baileywaelchi.name','QSXDGYLQWCTDUKWERWLVDOAQSLRFQYJEAFSGWNYNBWGRICVLYOCASGJJTKNDEOXF','3','','230-758-1370 x0924','1','2017-05-23 17:37:41','','',''),(17,'2016-09-16 04:12:53','Elsie McKenzie DDS','jamey_connelly@boehm.co','KCJYRPNUKKWTWTVBHIYXWFCXBBUMUYBMMQBUONPGCKQQUBSTBXOHFHZVWGVBTZOP','3','','749-276-1301','1','2017-05-23 17:37:41','','',''),(18,'2016-09-23 12:49:51','Mr. Samanta Kilback','jairo_friesen@glovercollins.biz','MXYKPJLINRKGPWDCGOIXJVZDCCZGNXBZVOJCNALSMTZKCBCFBRKVOJJKUQRUSEVZ','3','','268-437-0403 x28575','1','2017-05-23 17:37:41','','',''),(19,'2016-09-25 01:56:56','Nestor Gerhold Jr.','shanna_champlin@prosacco.info','IRPYXJNEFWSENJIHYBVXKTXTSPMAZOIFEPNZDLBVTPSLFWHZXLPKEZIKOAIAAWHJ','3','','1-781-832-8157','1','2017-05-23 17:37:41','','',''),(20,'2016-09-28 03:39:39','Rex Ryan','anita_carroll@johnsonhand.name','RYYIPRLSALZJSKMADMMRXIYYECFAKRXXPERYLZPLCURNZNKEHEXZVZYAQNJHLDVX','3','','1-326-794-0489','1','2017-05-23 17:37:41','','',''),(21,'2016-09-29 12:05:36','Patsy Watsica','reed.swaniawski@wolffspencer.info','MPNABLSSSSJOGXVMVWGDOVYXKNVPMEPUPUSTZBWOKPGJQEOMJTOUPPKRJKHBRICO','3','','1-650-296-5700 x417','1','2017-05-23 17:37:41','','',''),(22,'2016-10-14 01:47:48','Mrs. Myrtice Metz','ruby.heathcote@kertzmann.com','ZEBGBXYQOGUOUIRXGODPMGTTUKAKHQRXRTEKRBVCVEPQBFUTOKKTKVOYXBUFDEAN','3','','906.628.8298','1','2017-05-23 17:37:41','','',''),(23,'2016-10-24 09:57:57','Ernestine Ullrich','karine@kuhlmansimonis.net','XOBCWAFZIJZCZDCMUJKGCHEOTVKFPPZIALBLATXHIEMHYGSEOVQTVAFETBLUBMDU','3','','163-575-9650','1','2017-05-23 17:37:41','user','',''),(24,'2016-10-24 11:04:47','Charles Gusikowski','darius.strosin@hamillschmidt.co','BUREDPAYRYADNZHXMEXTUUSSTBWSJKFALWJEDCPPGMAPPPYVTHXQUQBJUMMRXYEZ','3','','1-935-100-6335 x237','1','2017-05-23 17:37:41','','',''),(25,'2016-10-26 09:31:23','Dr. Rashawn Ebert','darrion.spinka@bayerturcotte.com','ZROYOGFUOAFGKRNYYEJGRTUIYTGVJLCGSDKZOLGRJYCTMFPEWXQZBHEIGVYPKDQG','3','','788-982-5708','1','2017-05-23 17:37:41','','',''),(26,'2016-10-27 10:24:51','Shania Dietrich','blake@bashirian.info','PIBTXISABANVVVTIVTJYEOLSUKONYAJBPXZEHJVTWDSXQSUCUOQPIBUWQWTPFPMC','4','','1-567-179-8093 x8600','1','2017-05-23 17:37:41','','',''),(27,'2016-11-01 09:13:59','Genesis Waters DDS','maybell_herman@bode.co','LUXAYQZSLHFOFBXTCYNILWAUVVONWMNHZMTGYTBMOLVNPAOAEOUNODHIOWSCFBKL','3','','(372) 261-7926 x92116','1','2017-05-23 17:37:41','','',''),(28,'2016-11-06 05:08:58','Alia Pouros','walter@roberts.biz','PTNLHQHBBHRVLCMKNUOGBYRUNFRFZSQKTGWBQXDKGBERFBHFXYPZNXKNFDTFPGPZ','3','','419.027.1479 x34216','1','2017-05-23 17:37:41','','',''),(29,'2016-11-09 03:48:31','Willy Kuvalis IV','giovanny@skiles.info','FBUZQXPUAKQDHHHHZWOBQAJLHBQATCLVVWUSECVCTNCKBEDWDMBNTBGDBYJFXWNM','3','','394-776-0647 x63553','1','2017-05-23 17:37:41','user','',''),(30,'2016-11-20 06:40:17','Ken Stehr V','trudie@olson.io','AQHZOFCLWGNJGWQOWQIBBUTYQJZLEEBIRGQWETFPWFGBVYYRTYFSVYIHMPMMHXCA','3','','541.252.0109 x82021','1','2017-05-23 17:37:41','','',''),(31,'2016-11-26 02:22:56','Geo Boehm','aaron.nader@gerhold.io','PGZMGSBCGEOCWKCIIKUUZPQZYYBUMYZWKZZTYMCLMJIAHLKHKFXLRUEFLWVXEVPA','3','','1-525-919-6813','1','2017-05-23 17:37:41','','',''),(32,'2016-11-28 06:35:27','Cody Howell','rosalind@durganortiz.co','COTJWQDGZXTQFXVGOYURAUEYDOBESQFPANHHNRMYXJZQDPGSJGBWFAVABPLFWFYX','3','','549-073-5258','1','2017-05-23 17:37:41','','',''),(33,'2016-11-28 08:22:53','Foster Metz','joanny_ruel@pacocha.io','BRDRUCXSKQQUSRNZWYNHZAVXNZSTJJRILOKRSBNPAATRZYBMASXYWTAVXHPLEHUM','3','','(172) 274-7668','1','2017-05-23 17:37:41','','',''),(34,'2016-11-30 08:53:35','Mr. Grover Little','jonatan@luettgenfeest.info','RYXOTABPILAFJSSLEMAGIKBPCEBZEXJWKMWKWVAYVSBAIEQVQADLSIQAFKIGURBO','3','','(953) 372-5388 x7279','1','2017-05-23 17:37:41','','',''),(35,'2016-12-01 12:14:24','Rosie Medhurst','mara.medhurst@kulasledner.io','FUXHWDAAWWVPJGXZDLPAPAHUECXKHJKNDIVFTEKQDOSETYBZHDODKJQXMDOWLKYG','other','Community Group','190-380-6508 x20566','1','2017-05-23 17:37:41','','',''),(36,'2016-12-19 08:21:59','Jodie Reynolds','patience@mertz.org','GNPCOCIJEYPDTPVMCTTTDTGHTMTSVSXJQAXGBCHTYPNBQWIOURIMQQHBIECGTSJI','3','','1-837-828-9565 x99135','1','2017-05-23 17:37:41','','',''),(37,'2016-12-20 10:45:53','Kyra Kerluke','jordon_barrows@murphy.com','PBDAZMPUAEKVHCLJHROSCDAAWSFEXSCNSQFTIMAXSERFZVKQZMZFNZLEGNYWZVAZ','3','','684.554.4974 x14348','1','2017-05-23 17:37:41','','',''),(38,'2016-12-24 04:44:44','Paige Gerlach IV','justina@murphy.co','HEFODLEKHBDTWNUEUPQYUQSXMNZIUYANRXCNEMKNAEQFRRQGPTOMVXXEQAKALIGO','4','','357-782-1707 x4266','1','2017-05-23 17:37:41','','',''),(39,'2016-12-29 10:36:00','Marta Zemlak','tracy@sipes.info','NRNTPHAUHIBNXBLNLWVTOBRVUKDWWWELHBCCZZIFBPBCQATNXKGYYBLXSTWORSXQ','5','','(517) 650-9409 x79711','1','2017-05-23 17:37:41','','',''),(40,'2017-01-14 05:20:38','Mrs. Olin Krajcik','ernestine_walter@kertzmann.com','CWHKAKISYZRHUOZMXDPIEJFWCJYJVBVNDYSSTIKSOEAFCUHONKDZASGQGYLPZUGI','3','','1-790-154-2401','1','2017-05-23 17:37:41','','',''),(41,'2017-01-19 10:10:56','Filomena Tromp','alysa.weinat@gloverrenner.com','HFOUUNXUKVKRZCTITHGAHNIOPPBZZJMMSKWSSBZVEHMQMKNGLUJFPGJMIFEWYMVH','3','','1-761-258-3373','1','2017-05-23 17:37:41','','',''),(42,'2017-01-20 02:13:49','Eileen Schulist MD','elia_kirlin@kovacekking.co','ZTXBNNUFXBPOKRAZRFEHMMSKYURGQJRMKAUXGPEBMRIBLATIUJYBWWTMLMTALQUX','3','','(608) 386-1533','1','2017-05-23 17:37:41','','',''),(43,'2017-01-20 02:15:30','Dr. Kyler Veum','hershel.gibson@kertzmann.io','XVAXSKHBQEBHIHEWZNEBLORVQJQOBDMKQDUYBUVEYVCRFLSMJQLLBMYIBBHONPTU','3','','(917) 465-3314 x215','1','2017-05-23 17:37:41','','',''),(44,'2017-02-09 08:53:24','Leopold Shields','merle.hane@bartell.co','CARMWYZFNEYNCCBEEKTQTHQIRLQMWCAOZPFQRCKDSBQVZOOOXBBZMHNUSZOGOXWP','4','','148-000-5379 x17758','1','2017-05-23 17:37:41','','',''),(45,'2017-02-12 08:01:10','Stan Senger','hallie_weber@brakus.co','NQCJIJDSJSFCXSNKYKXLYKUWRQZGXFZSXGERYCJVBKWDMZODFOMHGSRTJEJSPOER','3','','594.212.4999 x06491','1','2017-05-23 17:37:41','','',''),(46,'2017-02-12 05:08:23','Mckenna Steuber MD','marge@thompson.info','LZOGTMIAZZOQEBFCCPAZEHTRWGAFMJKQOZFWZAFWFCPAVXIDWENGTKHEJUMJHJZL','3','','(665) 260-9331','1','2017-05-23 17:37:41','','',''),(47,'2017-02-27 02:54:29','Miss Zachary Kunze','daron@mullereichmann.biz','OIAVBTQKCASHUNKUKQOHACZZPZOCCQKVRGEXAVIDYIHCKICTKZBDEMBOPPBHOEXU','other','Workplace','519-084-1265 x027','1','2017-05-23 17:37:41','','',''),(48,'2017-03-02 02:02:17','Malika Barrows','austin.walker@borer.com','UWLHYNPSBBQKPFWHOXNZENBAQQSPIGKMXZACZUOLKISZVUSFPAKCYUYWVAXLJCER','3','','1-963-685-5128','1','2017-05-23 17:37:41','','',''),(49,'2017-03-08 06:26:27','Kayli Hauck','andres@kuvalis.co','BKUNNPVKOSSOLEIDRUKDKILZUIGKQOZLYHYFGCPNHGHRWKKCIKZJASLMFHYDICJR','3','','1-920-161-9777','1','2017-05-23 17:37:41','','',''),(50,'2017-03-13 04:55:22','Hester Fahey MD','jennings.corkery@bailey.biz','RIDDFPMDLDIFSXICLZGQPFNDYKALTSNBVCIBLWDEYZUBSWSXHLANJKKWYBWQFTHN','3','','462.487.8531 x191','1','2017-05-23 17:37:41','','',''),(51,'2017-04-01 04:25:15','Felicity Kuvalis','janea@wiegand.io','IEITEBKWAOMNOMBXCXWDHFSMIEMBDGUPZOPZIZNAKUFEKUHKKLDHNMXKJUOEQUYY','3','','1-911-234-8146','1','2017-05-23 17:37:41','','',''),(52,'2017-04-02 07:15:48','Emma Kub','oran.waters@cruickshank.biz','MAOKJLDZJUXCPZJKOHFMGEPJDWIQRSWTZCHWVGRBLFSWACXNAHSDUQQVBYRJQXWD','3','','442.382.9061 x45043','1','2017-05-23 17:37:41','','',''),(53,'2017-04-18 07:40:32','Elda Mayert IV','violette@hoeger.net','CGXURONKCFUOZYCBUZQWDTSKZPTCDBGUYGDNZETGDJGFLQVAQADKDFRZVAFAUVEB','3','','(240) 856-2043','1','2017-05-23 17:37:41','','',''),(54,'2017-04-21 01:05:54','Shayna Goldner','mariah@weimannhowell.net','UEUCHOUENGJZKCSZHFGHKJBCSFKUENWGIBXXTJZPDWOGWACRXXFRYNJFAUIHCNFH','4','','1-575-728-2606 x3293','1','2017-05-23 17:37:41','','',''),(55,'2017-05-02 11:57:15','Ron Schiller Jr.','katelynn@schaden.name','RVCBVYWGQFLHIGLBJNIMHGWPXHKYYESIPQLAHAUFRKNEDWXEMQNJLJPSVKJZMGQG','3','','616-266-2229 x005','1','2017-05-23 17:37:41','user','',''),(56,'2017-05-18 02:01:31','Dorcas Zulauf','anthony_bauch@huelsmcclure.info','ZHOJDPCCTDFCZKYGRGXCYKZOIONRBKECHAFCSHXCNKXDPVHTVXIQFJLUOMUHRXIN','other','Idk','218.460.3500','1','2017-05-23 17:37:41','','',''),(57,'2017-05-19 02:25:41','Talon Predovic','otho.schultz@shanahan.info','YNYMYONPEWOECDFWVLUGXSXNPAIJIAAOSCCUAIBUHYFADUTCYORGKEYBBLVOHZXJ','3','','1-765-034-7787 x6283','1','2017-05-23 17:37:41','','',''),(58,'2017-05-19 03:39:09','Cara MacGyver','louie_kuvalis@nitzschenicolas.info','DICJAMJYUFUBGBXZUYUEICPGJYIBMGBCCVRJXJPWXSZNIXAZFPZSTXSDVPXXAUHE','4','','244.916.3743 x03824','1','2017-05-23 17:37:41','','','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zeemo_resource`
--

DROP TABLE IF EXISTS `zeemo_resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zeemo_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_heading` varchar(255) NOT NULL,
  `breadcrumb` varchar(255) NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `json_code` text NOT NULL,
  `content` text NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zeemo_resource`
--

LOCK TABLES `zeemo_resource` WRITE;
/*!40000 ALTER TABLE `zeemo_resource` DISABLE KEYS */;
INSERT INTO `zeemo_resource` VALUES (1,'Resource3','Resource3','Resource - hasmow.com.in','251rwDF','asdf srhrgfy','asdfas','<p>asdfasdf adsf</p>','2014-03-13 22:08:36','zeemoadmin');
/*!40000 ALTER TABLE `zeemo_resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zeemo_settings`
--

DROP TABLE IF EXISTS `zeemo_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zeemo_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `google_analytics_code` text NOT NULL,
  `canonical_link` text NOT NULL,
  `modified_by_user` varchar(555) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zeemo_settings`
--

LOCK TABLES `zeemo_settings` WRITE;
/*!40000 ALTER TABLE `zeemo_settings` DISABLE KEYS */;
INSERT INTO `zeemo_settings` VALUES (1,'<p>asdfasdf</p>','<p>asdfasdf</p>','zeemoadmin','2015-06-22 20:55:56');
/*!40000 ALTER TABLE `zeemo_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-24  5:39:30
