/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.19-MariaDB : Database - blog_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`blog_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `blog_db`;

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `department_id` int(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `courses` */

insert  into `courses`(`id`,`name`,`content`,`department_id`,`created_at`,`updated_at`) values 
(13,'course1','Artistic course. All students must be passed this course.',7,'2021-06-29 06:15:36','2021-06-29 06:15:36'),
(14,'course2','Music course. All students must be  passed this course.',7,'2021-06-29 06:16:06','2021-06-29 06:16:06'),
(15,'course1','Basic course',1,'2021-06-29 09:42:56','2021-06-29 09:42:56'),
(16,'course2','basic course 2',1,'2021-06-29 09:43:10','2021-06-29 09:43:10'),
(17,'course1','physics1',2,'2021-06-29 15:24:12','2021-06-29 15:24:12'),
(18,'course2','physics2',2,'2021-06-29 15:24:21','2021-06-29 15:24:21'),
(19,'course1','football1.',3,'2021-06-29 15:26:10','2021-06-29 15:26:10'),
(20,'course2','Football departmentFootball departmentFootball departmentFootball departmentFootball departmentFootball departmentFootball departmentFootball departmentFootball department',3,'2021-06-29 15:26:19','2021-06-29 15:26:19'),
(21,'course1','History department.History department.History department.History department.History department.',4,'2021-06-29 15:27:49','2021-06-29 15:27:49'),
(22,'course2','History department.History department.History department.History department.History department.History department.',4,'2021-06-29 15:27:55','2021-06-29 15:27:55');

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `university_id` int(255) DEFAULT NULL,
  `faculty_id` int(255) DEFAULT NULL,
  `professors_cnt` int(255) DEFAULT NULL,
  `students_cnt` int(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `departments` */

insert  into `departments`(`id`,`name`,`university_id`,`faculty_id`,`professors_cnt`,`students_cnt`,`description`,`created_at`,`updated_at`) values 
(1,'Department of mathematical analysis',1,1,10,100,'The Department of Mathematical Analysis was founded in 1933 together with the establishment of the Faculty of Mechanics and Mathematics.\r\n\r\nIts first head was Academician of the USSR Academy of Sciences M.A. Lavrentyev, who headed the department from 1933 to 1941.\r\nThen, from 1943 to 1957, the department was headed by A.Ya. Khinchin.\r\nFrom 1957 to 1982, the head of the department was Corresponding Member of the USSR Academy of Sciences N.V. Efimov.\r\nFrom 1982 to the present, the department is headed by Academician of the Russian Academy of Sciences, Rector of Moscow State University Viktor Antonovich Sadovnichy.','2021-06-29 09:43:13','2021-06-29 09:43:13'),
(2,'physics department',2,2,10,400,'physics departmentphysics departmentphysics departmentphysics departmentphysics departmentphysics departmentphysics departmentphysics departmentphysics departmentphysics department','2021-06-29 15:24:24','2021-06-29 15:24:24'),
(3,'Football department',7,3,12,500,'Football departmentFootball departmentFootball departmentFootball departmentFootball departmentFootball departmentFootball departmentFootball departmentFootball department','2021-06-29 15:26:22','2021-06-29 15:26:22'),
(4,'History department',8,4,9,350,'History department.History department.History department.History department.History department.History department.History department.History department.History department.','2021-06-29 15:27:57','2021-06-29 15:27:57');

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `university_id` int(255) DEFAULT NULL,
  `faculty_id` int(255) DEFAULT NULL,
  `department_id` int(255) DEFAULT NULL,
  `majors` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `emp_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `employees` */

insert  into `employees`(`id`,`fullname`,`email`,`phone`,`birthday`,`website`,`university_id`,`faculty_id`,`department_id`,`majors`,`description`,`photo`,`emp_type`,`created_at`,`updated_at`) values 
(1,'Irina','irina98@mail.ru','(754) 587-9789','2021-06-15','app.social-media-builder.com',1,1,1,'Python developer','My name is Irina. I am from Russia.','upload/volunteers/Irina.jpg','student','2021-06-29 03:09:41','2021-06-29 10:09:41'),
(2,'Xia jing','xiajing@gmail.com','(754) 797-9889','2021-06-16','app.social-media-builder.com',1,1,1,'Mathmatics','My name is Xiajing. I am from China.\r\nI hope a lot of help.','upload/professors/Xia jing.jpg','professor','2021-06-29 03:47:56','2021-06-29 10:47:56'),
(3,'Aleksey Leha','aleksey.leha@mail.ru','(746) 798-7897','2021-06-10','app.social-media-builder.com',1,1,1,'C programmer','My name is Aleksey leha. I am from Russia.\r\nI hope a lot of help.','upload/volunteers/Aleksey Leha.jpg','student','2021-06-29 03:09:32','2021-06-29 10:09:32'),
(4,'Mohammed Sharlin','sharling.97@mail.ru','(754) 679-8789','2021-06-09','app.social-media-builder.com',1,1,1,'Website Developer','My name is Mohammed Sharlin. I am from Russia.','upload/professors/Mohammed Sharlin.jpg','professor','2021-06-29 10:42:07','2021-06-29 10:42:07'),
(5,'Sergey Nick','sergey.nick@mail.ru','(754) 679-7987','2021-06-16','app.social-media-builder.com',1,1,1,'Backend developer','My name is Sergey Nick. I am from Russia','upload/professors/Sergey Nick.jpg','professor','2021-06-29 10:43:18','2021-06-29 10:43:18'),
(6,'Alexendr Guova','alexendr.g@mail.ru','(754) 679-8799','2021-06-09','app.social-media-builder.com',1,1,1,'Frontend developer','My name is Alexendr. I am from Russia.','upload/professors/Alexendr Guova.jpg','professor','2021-06-29 10:45:13','2021-06-29 10:45:13'),
(7,'Alexendra Jame','alex.jame@mail.ru','(754) 678-9879','2021-06-10','app.social-media-builder.com',1,1,1,'Mobile Developer','My name is Alexendra Jame. I am from Russia.','upload/volunteers/Alexendra Jame.jpg','student','2021-06-29 10:51:02','2021-06-29 10:51:02'),
(8,'David Sharlin','dav.sharlin@gmail.com','(159) 789-7979','2021-06-02','app.social-media-builder.com',1,1,1,'Full stack developer','My name is David sharlin. I am from India.','upload/volunteers/David Sharlin.jpg','student','2021-06-29 10:52:38','2021-06-29 10:52:38');

/*Table structure for table `faculties` */

DROP TABLE IF EXISTS `faculties`;

CREATE TABLE `faculties` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `university_id` int(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `departments_cnt` int(255) DEFAULT NULL,
  `professors_cnt` int(255) DEFAULT NULL,
  `students_cnt` int(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `faculties` */

insert  into `faculties`(`id`,`name`,`university_id`,`photo`,`departments_cnt`,`professors_cnt`,`students_cnt`,`description`,`created_at`,`updated_at`) values 
(1,'Faculty of Mechanics and Mathematics',1,'upload/faculties/Faculty of Mechanics and Mathematics.jpg',10,100,1500,'History of Mathematics and Mechanics at Moscow University from 1755 to 1932 .\r\n\r\nArticle by Yu.P. Soloviev and A.T. Fomenko on the 70th anniversary of the faculty\r\n\r\nThe Faculty of Mechanics and Mathematics of Moscow State University  was established on May 1, 1933, together with the restoration of the faculty system at Moscow University.\r\n\r\nThe first dean of the  faculty was the famous mathematician and mechanic, professor,   corresponding member of the USSR Academy of Sciences V.V. Golubev  (dean in 1933-1935, 1944-1952).\r\n\r\nOver the years, the following scientists were deans of the faculty:\r\n\r\nProfessor  L.A. Tumarkin  (1935-1939), \r\n\r\nAcademician of the USSR Academy of Sciences  I.G. Petrovsky  (1940–1944), \r\n\r\nProfessor  Yu.N. Rabotnov  (1952-1954), \r\n\r\nAcademician of the USSR Academy of Sciences  A. N. Kolmogorov  (1954 - 1958), \r\n\r\nProfessor  N.A. Slezkin  (1958-1962), \r\n\r\nProfessor  N.V. Efimov  (1962-1969), \r\n\r\nProfessor  P.M. Ogibalov  (1969-1977), \r\n\r\nCorresponding Member of the USSR Academy of Sciences A. I. Kostrikin (1977-1980), \r\n\r\nAcademician of the Russian Academy of Sciences  O.B. Lupanov  (from 1980 to 2006)\r\n\r\nProfessor  V.N. Chubarikov  (from 2006 to 2019)','2021-06-29 09:41:50','2021-06-29 09:41:50'),
(2,'Faculty of Physics',2,'upload/faculties/Faculty of Physics.jpg',12,130,1500,'Faculty of physics.Faculty of physics.Faculty of physics.Faculty of physics.Faculty of physics.Faculty of physics.Faculty of physics.Faculty of physics.Faculty of physics.Faculty of physics.Faculty of physics.','2021-06-29 15:21:31','2021-06-29 15:21:31'),
(3,'Faculty of sport',7,'upload/faculties/Faculty of sport.jpg',15,100,1800,'Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport. Faculty of sport.','2021-06-29 15:22:43','2021-06-29 15:22:43'),
(4,'Faculty of History and Political Studies',8,'upload/faculties/Faculty of History and Political Studies.jpg',10,120,1900,'Faculty of History and Political StudiesFaculty of History and Political StudiesFaculty of History and Political StudiesFaculty of History and Political StudiesFaculty of History and Political StudiesFaculty of History and Political StudiesFaculty of History and Political StudiesFaculty of History and Political StudiesFaculty of History and Political Studies','2021-06-29 15:23:17','2021-06-29 15:23:17');

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `pid` int(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order_num` int(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`title`,`pid`,`description`,`order_num`,`created_at`) values 
(1,'root','Root',0,NULL,0,'2021-06-23 03:35:00'),
(2,'admin','Administrator',1,NULL,0,'2021-06-23 03:35:16'),
(3,'user','User',1,NULL,1,'2021-06-23 03:35:27'),
(4,'management','Management',2,NULL,1,'2021-06-23 08:12:52'),
(5,'users','Users',4,NULL,0,'2021-06-23 03:35:59'),
(9,'volunteering','Volunteering',3,NULL,1,'2021-06-24 06:32:53'),
(10,'professor','Professors',3,NULL,2,'2021-06-24 06:34:25'),
(12,'support','Support',3,NULL,4,'2021-06-24 06:34:35'),
(13,'volunteers','Volunteers',4,NULL,2,'2021-06-24 13:55:55'),
(14,'professors','Professors',4,NULL,3,'2021-06-24 13:56:12'),
(15,'universities','Universities',4,NULL,4,'2021-06-24 13:57:26'),
(16,'faculties','Faculties',4,NULL,5,'2021-06-24 13:57:44'),
(17,'departments','Departments',4,NULL,6,'2021-06-24 13:58:02'),
(18,'volunteering','Volunteering',2,NULL,1,'2021-06-29 02:51:50'),
(19,'professor','Professors',2,NULL,2,'2021-06-29 02:52:07');

/*Table structure for table `universities` */

DROP TABLE IF EXISTS `universities`;

CREATE TABLE `universities` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `founded_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `faculties_cnt` int(255) DEFAULT NULL,
  `professors_cnt` int(255) DEFAULT NULL,
  `students_cnt` int(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `universities` */

insert  into `universities`(`id`,`name`,`location`,`photo`,`founded_date`,`description`,`faculties_cnt`,`professors_cnt`,`students_cnt`,`created_at`,`updated_at`) values 
(1,'Lomonosov Moscow State University','Moscow, Russian Federation','upload/universities/Lomonosov Moscow State University.jpg','1875-06-08','Welcome to Moscow State University, the first Russian University founded in 1755 on the initiative of Mikhail Lomonosov, an outstanding scientist of the Enlightenment, whose unsettled encyclopedic mind and energy gave the inner impetus to the project. From the very beginning, elitism was alien to the very spirit of our community, which determined the University’s long-standing democratic tradition. Students irrespective of their background have been always admitted to University to further become our renowned alumni – famous scientists and scholars. And the students convene here, as they have always done, to study, to research, to push at the frontiers of knowledge.\r\n\r\nToday, the emphasis is on advancing the applied science: new materials, genetics, biomedicine, pharmaceutics, cognitive sciences, ecology, and information technologies. We work hard to preserve our heritage and develop our traditions of a comprehensive approach to higher education and science. Moscow University has a rich academic history. Yet the major commitment remains the same as it has been in centuries: to provide outstanding teaching, scholarship and research. But what makes our University so lively is this intellectual spirit combined with inexhaustible curiosity.\r\n\r\nWe keep open the University doors to anyone who strives for new discoveries, creativity, and self-improvement.',20,1545,1234565,'2021-06-29 09:40:17','2021-06-29 11:02:15'),
(2,'Tomsk State University','Tomsk, Russian Federation','upload/universities/Tomsk State University.jpg','1873-02-10','Welcome to Moscow State University, the first Russian University founded in 1755 on the initiative of Mikhail Lomonosov, an outstanding scientist of the Enlightenment, whose unsettled encyclopedic mind and energy gave the inner impetus to the project. From the very beginning, elitism was alien to the very spirit of our community, which determined the University’s long-standing democratic tradition. Students irrespective of their background have been always admitted to University to further become our renowned alumni – famous scientists and scholars. And the students convene here, as they have always done, to study, to research, to push at the frontiers of knowledge.\r\n\r\nToday, the emphasis is on advancing the applied science: new materials, genetics, biomedicine, pharmaceutics, cognitive sciences, ecology, and information technologies. We work hard to preserve our heritage and develop our traditions of a comprehensive approach to higher education and science. Moscow University has a rich academic history. Yet the major commitment remains the same as it has been in centuries: to provide outstanding teaching, scholarship and research. But what makes our University so lively is this intellectual spirit combined with inexhaustible curiosity.\r\n\r\nWe keep open the University doors to anyone who strives for new discoveries, creativity, and self-improvement.',12,1200,80000,'2021-06-29 12:42:41','2021-06-29 12:56:44'),
(7,'RUSSIAN STATE UNIVERSITY OF PHYSICAL EDUCATION, SPORT, YOUTH AND TOURISM (SCOLIPE)','4, Sireneviy boulevard, Moscow, 105122','upload/universities/RUSSIAN STATE UNIVERSITY OF PHYSICAL EDUCATION, SPORT, YOUTH AND TOURISM (SCOLIPE).jpg','1971-02-03','FSBEI HPO \"Russian State University of Physical Education, Sport, Youth and Tourism (SCOLIPE)\" - the largest in Russia and abroad institution of higher education in the field of physical culture and sports.\r\n\r\nDuring its existence the SCOLIPE established itself as a leading institution for training highly qualified specialists. During its activity the university has prepared more than 50 thousand specialists pof higher qualification, including about 4 thousand foreign professionals from 115 countries.\r\n\r\nAmong the university graduates there are over 140 Olympic, European and World champions, e.g. Lev Yashin, Irina Rodnina, Valeriy Kharlamov, Svetlana Zhurova, Pavel Bure, Alexander Ovechkin, Ilya Kovalchuk, Dmitry Bulykin, Dmitry Sychev, Pavel Pogrebnyak, Dmitry Nosov and many others.\r\n\r\nA leading place of the SCOLIPE among other sports and physical eduaction profile universities is caused by its high scientific potential and participation in the learning process of the highest caliber teaching staff. Among the faculty members there are Honored Workers of Physical Education, Honored Scientists of the Russian Federation, Honored Workers of Culture of the Russian Federation. Classes are taught by more than 60 Doctors and 80 Professors, academicians and corresponding members of RAE, Honored Workers of Higher School of the Russian Federation, Honored Coaches of the USSR and the Russian Federation, Honored Masters of Sports and Masters of Sports of International class.\r\n\r\nThe SCOLIPE specialists conduct important trials on theory and methodology of sports training, optimization of high-class athletes preparation to the Olympic Games, World and European Championships. Research efforts are aimed on identifying and implementing in practice of the most effective means, forms and methods of physical, technical, tactical, psychological and theoretical training of athletes.\r\n\r\nThe scientific team makes a great contribution to the year-round and long-term sports preparation planning rationalization, to the improving of teaching, medical and physiological control during training. Much attention is paid to youth sport, the problems of restoration and increase athletic performance.\r\n\r\nToday the SCOLIPE trains about 5 thousand people, including more than 200 foreign students. The structure is presented of 43 departments and masters, postgraduate and doctoral studies. The SCOLIPE includes the Institute of Sport and Physical Education, the Institute of Humanities, the Institute of tourism, recreation, rehabilitation and fitness, the Institute of Scientific and Pedagogics Education.\r\n\r\nAlso, preparation of specialists is carried out at the Institute of Advanced Training and Professional retraining, the Intersectoral Regional Center of Advanced Training and Professional retraining \"Coach high school\". On the University\'s basis are making their activity the Scientific Research Institute of Sport, the Scientific Research Institute of Sports Medicine and the Sports Historical Museum.\r\n\r\nEmployees of the SCOLIPE Scientific Research Institute of Sport perform work on the integration of science in higher education, develop the innovative methods and technologies and apply them in the field of physical education and sport. In the Scientific Research Institute of Sports Medicine is engaged the introduction of modern technologies in the field of sports medicine to the University educational space.\r\n\r\nPride of the SCOLIPE - Central Branch Scientific Library, one of the largest physical educational and sports libraries in the world. Holdings are more than 650 thousand units. Library is a comprehensive information system aimed at ensuring the educational process and scientific research in the field of physical education and sport, as well as related disciplines.\r\n\r\nSports facilities of the University are unique: 17 specialized halls, track and field arena with artificial turf, 3 shooting galleries, indoor ice rink for ice sports, swimming pool with three tubes, including hopping tube, stadium with a football field and track and field sectors, 10 outdoor and 4 indoor tennis courts, Universal sports and entertainment complex (USEC SCOLIPE), specialized platform for technical sports (racing, motorcycle, bicycle, etc.), climbing wall, Academy of sports and applied arts (ASPE).\r\n\r\nThe SCOLIPE is a dynamically developing university with a rich history and tradition. Collective of university is constantly striving to conquer new peaks. In spring 2007 the SCOLIPE became a winner among universities, introducing innovative educational programs within the priority national project \"Education\".\r\n\r\nFollowing the results of the program in the SCOLIPE have been purchased and deployed a laboratory equipment for the scientific and research complex stands, developed new educational programs, modernized University\'s material and technical base, created multimedia and computer classes, problematic mini-labs etc. All mentioned provides a consistent, comprehensive and qualitative education of the SCOLIPE graduates.\r\n\r\nWith the victory of Sochi in the struggle for the right to host the 2014 Olympic Games for our country have opened great prospects, and in front of the University stood the important and specific tasks. In particular, the SCOLIPE will prepare professionals who become part of the big Olympic team OF athletes, coaches, managers, journalists, etc.\r\n\r\nToday the SCOLIPE cooperates with employers - government, public and commercial organizations representatives. Among them, the Ministry of Sports of Russia, the Russian Olympic Committee, sports federations, fitness clubs («World Class», «Planet fitness», «Gold Gym»), the media (TV, periodicals, radio, Internet - Publishing) , travel agencies, etc.\r\n\r\nHigh theoretical and practical training level of university graduates guarantees them employment on a specialty in a prestigious job.\r\n\r\nThe SCOLIPE graduates are demanded across globe: to this day there is a real fight for our coaches and teachers - they are being waited in any organization.',10,350,12000,'2021-06-29 15:11:08','2021-06-29 15:11:20'),
(8,'Ural Federal University','Ural, Russian Federation','upload/universities/Ural Federal University.jpg','1920-02-03','Ural Federal University (UrFU) is one of the largest and leading higher educational institutions in Russia bringing together fundamental education and innovative approach towards the challenges of modern times.\r\n\r\nUrFU is a world-class university in the heart of Eurasia committed to the complex and sustainable development of research and teaching. \r\nUral Federal University is home to 36 000 students from 101 countries of the world and more than 4 500 faculty members including the top-notch global experts. Our Institutes offer more than 460 Bachelor\'s, Master\'s and Doctoral degree programs in natural sciences, engineering, social sciences, humanities, economics and management taught in Russian and English. The number of UrFU alumni exceeds 380 000.\r\n\r\nBreakthrough studies are pursued in 164 modern research and development laboratoreis and 72 research excellence centres. The university is open to international collaboration having more than 500 partners all over the globe and is an active participant of such initiatives as BRICS Network University, SCO Network University, CIS University, UArctic, Silk Road Universities Network.',15,4800,36200,'2021-06-29 15:15:51','2021-06-29 15:16:10');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `company_site` varchar(255) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `remember_token` varchar(128) DEFAULT NULL,
  `digit_number` int(6) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `permission` int(1) DEFAULT 2,
  `state` int(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`firstname`,`lastname`,`company`,`company_site`,`password`,`remember_token`,`digit_number`,`phone`,`photo`,`permission`,`state`,`created_at`,`updated_at`) values 
(1,'hrm&88662','hrm.2021@outlook.com','HRM','hrm','PUCS','ru.pucs.com','$2y$10$Yq34EwFgkWkD8VVSjOFXIe15XJ8xSlIE2IHjottMadovXqafW.DAu','jo19ZOkIplNlAke5z0PQQS4zvVywylugHmthwg378o5lLR9xtEkswBtCS3ti',803593,'(790) 926-1209','upload/users/hrm&88662_1.jpg',1,1,'2021-06-29 07:04:37','2021-06-24 09:02:39'),
(4,'dmitriy.lotov','d.lotov_7@mail.ru','Dmitiry','Lotov','PUCS','pucs.ru.com','$2y$10$mHrBo3FB/UGq9zKI3hIzke29iDkxxtC5Z9eWzpuXge/ExxsgjLl8q',NULL,308433,'(790) 926-1209','upload/users/dmitriy.lotov_4.jpg',2,1,'2021-06-24 03:20:25','2021-06-24 10:19:36'),
(6,'OHSUNG','oohs0907@outlook.com','OH','SUNG','PUCS','www.pucs.com','$2y$10$Sq50T8zc3fhvVCVrH4tDb./MhMMLdAdM2UXGo35F.hZT2LAO8pRHy','X9Qu2VqARo85ZW3hGlLrSWOKzmcSy7AaOgfEsDG5vLl6xx0Dnsq6Sgp2yihL',444213,'(787) 878-7878','upload/users/OHSUNG_6.jpg',2,1,'2021-06-24 03:20:31','2021-06-24 09:57:34'),
(8,'smallcat','smallcat@mail.ru',NULL,NULL,NULL,NULL,'$2y$10$6GgxWL248ctk6BQiR6/9g.2LKdQ7N8vPJF.nMLamkAnfvnsdVdDoS',NULL,NULL,'(754) 678-7978',NULL,2,0,'2021-06-29 10:56:45','2021-06-29 10:56:45'),
(9,'blackcat','blackcat@mail.ru',NULL,NULL,NULL,NULL,'$2y$10$9hiLA3bVw4p.8Ehm9Qr34um4VHwG1ZL2yzH9HVEp1NYf910HzCWgm',NULL,843331,'(754) 679-8789',NULL,2,0,'2021-06-29 03:58:43','2021-06-29 10:58:43'),
(10,'bluecat','bluecat@mail.ru',NULL,NULL,NULL,NULL,'$2y$10$Q9yAAJ5QXXbojIRmuzddbeda7/dgxU.9JlpUhd95gXRajn.EftMYS',NULL,422954,'(754) 679-7979',NULL,2,1,'2021-06-29 04:01:05','2021-06-29 11:01:05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
