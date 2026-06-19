-- USERS Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL /*SLUG*/,
  `bio` varchar(2048) NULL,
  `company` varchar(100) NULL,
  `job` varchar(100) NULL,
  `country` varchar(100) NULL,
  `address` varchar(1024) NULL,
  `phone` varchar(12) NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `language_id` varchar(11) NOT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(1024) NULL,
  `facebook_link` varchar(1024) NULL,
  `instagram_link` varchar(1024) NULL,
  `twitter_link` varchar(1024) NULL,
  `tiktok_link` varchar(1024) NULL,
  -- INDEXES
  KEY `firstname` (`firstname`),
  KEY `lastname` (`lastname`),
  KEY `email` (`email`),
  KEY `username` (`username`),
  KEY `bio` (`bio`),
  KEY `company` (`company`),
  KEY `job` (`job`),
  KEY `country` (`country`),
  KEY `address` (`address`),
  KEY `role` (`role`),
  KEY `phone` (`phone`),
  KEY `language` (`language`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Admin USER INSERTION
-- INSERT INTO `users` (
--   `firstname`, `lastname`, `email`, `username`, `password`, `role`, `language`
-- ) VALUES (
--   'Mohammed', 'Abbo', 'mohammedabbo52@gmail.com', 'mohammedabbo52', 'c4360ba73372fdad73a62dad3ef8a5a9', /*md5('Mo2@011152')*/ '3', '1'
-- );

-- COURSES Table
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `price_id` int(11) DEFAULT NULL,
  `promo_link` varchar(1024) DEFAULT NULL,
  `course_image` varchar(1024) DEFAULT NULL,
  `course_image_tmp` varchar(1024) NOT NULL,
  `course_promo_video` varchar(1024) DEFAULT NULL,
  `primary_subject` varchar(100) DEFAULT NULL,
  `course_duration` varchar(100) DEFAULT NULL,
  `total_student` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `tags` varchar(2048) DEFAULT NULL,
  `congratulations_message` varchar(2048) DEFAULT NULL,
  `welcome_message` varchar(2048) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `subtitle` varchar(100) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `csrf_code` varchar(32) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `trending` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(100) NOT NULL,
  KEY `title` (`title`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  KEY `sub_category_id` (`sub_category_id`),
  KEY `level_id` (`level_id`),
  KEY `language_id` (`language_id`),
  KEY `price_id` (`price_id`),
  KEY `course_duration` (`course_duration`),
  KEY `primary_subject` (`primary_subject`),
  KEY `total_student` (`total_student`),
  KEY `create_date` (`create_date`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`),
  KEY `approved` (`approved`),
  KEY `published` (`published`),
  KEY `views` (`views`),
  KEY `trending` (`trending`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- CATERGORIES Table
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `slug` VARCHAR(100) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `category` (`category`),
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- INSERTING INTO CATEGORIES
-- INSERT INTO `categories` (`category`, `slug`, `disabled`) VALUES
-- ('IELTS', 'ielts', '0'),
-- ('English', 'english', '0'),
-- ('IT & Software', 'it_software', '0');

-- PRICES TABLE
CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `price` (`price`),
  KEY `name` (`name`),
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- INSERTING INTO PRICES
-- INSERT INTO `prices` (`name`, `price`, `disabled`) VALUES ('Free', '0', '0');

-- COURSE_LEVELS Table
CREATE TABLE IF NOT EXISTS `course_levels` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `level` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- INSERTING INTO COURSE_LEVEL
-- INSERT INTO `course_levels` (`id`, `level`, `disabled`) VALUES
-- (NULL, 'Beginner Level', 0),
-- (NULL, 'Intermediate Level', 0),
-- (NULL, 'Expert Level', 0),
-- (NULL, 'All Levels', 0);

-- CURRENCIES Table
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `currency` varchar(20) NOT NULL,
  `symbol` varchar(4) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- INSERTING INTO CURRENCIES TABLE
-- INSERT INTO `currencies` (`currency`, `symbol`, `disabled`) VALUES
-- ('EGP', '£', 0),
-- ('SDG', '£', 0),
-- ('USD', '$', 0);

-- LANGUAGES Table
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `symbol` VARCHAR(10) NOT NULL,
  `language` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- INSERTING INTO LANGUAGES
-- INSERT INTO `languages` (`symbol`, `language`, `disabled`) VALUES
-- ('en_US', 'English (US)', 0),
-- ('ar_AR', 'العربية', 0);

-- ROLES & PERMISSIONS Table
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- INSERTING INTO `roles` TABLE
-- INSERT INTO `roles` (`role`, `disabled`) VALUES
-- ('student', 0),
-- ('teacher', 0),
-- ('admin', 0);

-- *** To adjust the ID AUTO-INCREMENT issue
-- ALTER TABLE `<db_name>`.`<table_name>` AUTO_INCREMENT = 1;
-- Best applied on an empty table ***
-- ALTER TABLE `erudite_db`.`categories` AUTO_INCREMENT = 1;
-- ALTER TABLE `erudite_db`.`courses` AUTO_INCREMENT = 1;
-- ALTER TABLE `erudite_db`.`course_levels` AUTO_INCREMENT = 1;
-- ALTER TABLE `erudite_db`.`currencies` AUTO_INCREMENT = 1;
-- ALTER TABLE `erudite_db`.`languages` AUTO_INCREMENT = 1;
-- ALTER TABLE `erudite_db`.`prices` AUTO_INCREMENT = 1;
-- ALTER TABLE `erudite_db`.`roles` AUTO_INCREMENT = 1;
-- ALTER TABLE `erudite_db`.`slider_images` AUTO_INCREMENT = 1;
-- ALTER TABLE `erudite_db`.`users` AUTO_INCREMENT = 1;

-- SLIDER_IMAGES Table
CREATE TABLE IF NOT EXISTS `slider_images` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `image` varchar(2048) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- PERMISSIONS MAP Table
CREATE TABLE IF NOT EXISTS `permissions_map` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission` varchar(100) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `role_id` (`role_id`),
  KEY `permission` (`permission`),
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `erudite_db`.`permissions_map` AUTO_INCREMENT = 1;

-- INSERTING INTO PERMISSIONS MAP Table (Admin_id=>2)
-- INSERT INTO `permissions_map` (`id`, `role_id`, `permission`, `disabled`) VALUES
-- (1, 2, 'view_admin_area', 0),
-- (2, 2, 'add_admin_area', 0),
-- (3, 2, 'edit_admin_area', 0),
-- (4, 2, 'delete_admin_area', 0),
-- (5, 2, 'view_dashboard', 0),
-- (6, 2, 'add_dashboard', 0),
-- (7, 2, 'edit_dashboard', 0),
-- (8, 2, 'delete_dashboard', 0),
-- (9, 2, 'view_all_courses', 0),
-- (10, 2, 'add_all_courses', 0),
-- (11, 2, 'edit_all_courses', 0),
-- (12, 2, 'delete_all_courses', 0),
-- (13, 2, 'view_my_courses', 0),
-- (14, 2, 'add_my_courses', 0),
-- (15, 2, 'edit_my_courses', 0),
-- (16, 2, 'delete_my_courses', 0),
-- (17, 2, 'view_categories', 0),
-- (18, 2, 'add_categories', 0),
-- (19, 2, 'edit_categories', 0),
-- (20, 2, 'delete_categories', 0),
-- (21, 2, 'view_enrolled', 0),
-- (22, 2, 'add_enrolled', 0),
-- (23, 2, 'edit_enrolled', 0),
-- (24, 2, 'delete_enrolled', 0),
-- (25, 2, 'view_history', 0),
-- (26, 2, 'add_history', 0),
-- (27, 2, 'edit_history', 0),
-- (28, 2, 'delete_history', 0),
-- (29, 2, 'view_permissions', 0),
-- (30, 2, 'add_permissions', 0),
-- (31, 2, 'edit_permissions', 0),
-- (32, 2, 'delete_permissions', 0),
-- (33, 2, 'view_roles', 0),
-- (34, 2, 'add_roles', 0),
-- (35, 2, 'edit_roles', 0),
-- (36, 2, 'delete_roles', 0),
-- (37, 2, 'view_material', 0),
-- (38, 2, 'add_material', 0),
-- (39, 2, 'edit_material', 0),
-- (40, 2, 'delete_material', 0),
-- (41, 2, 'view_quiz', 0),
-- (42, 2, 'add_quiz', 0),
-- (43, 2, 'edit_quiz', 0),
-- (44, 2, 'delete_quiz', 0),
-- (45, 2, 'view_score', 0),
-- (46, 2, 'add_score', 0),
-- (47, 2, 'edit_score', 0),
-- (48, 2, 'delete_score', 0),
-- (49, 2, 'view_final_score', 0),
-- (50, 2, 'add_final_score', 0),
-- (51, 2, 'edit_final_score', 0),
-- (52, 2, 'delete_final_score', 0),
-- (53, 2, 'view_users', 0),
-- (54, 2, 'add_users', 0),
-- (55, 2, 'edit_users', 0),
-- (56, 2, 'delete_users', 0),
-- (57, 2, 'view_admins', 0),
-- (58, 2, 'add_admins', 0),
-- (59, 2, 'edit_admins', 0),
-- (60, 2, 'delete_admins', 0),
-- (61, 2, 'view_mgr', 0),
-- (62, 2, 'add_mgr', 0),
-- (63, 2, 'edit_mgr', 0),
-- (64, 2, 'delete_mgr', 0),
-- (65, 2, 'view_instructor', 0),
-- (66, 2, 'add_instructor', 0),
-- (67, 2, 'edit_instructor', 0),
-- (68, 2, 'delete_instructor', 0),
-- (69, 2, 'view_student', 0),
-- (70, 2, 'add_student', 0),
-- (71, 2, 'edit_student', 0),
-- (72, 2, 'delete_student', 0),
-- (73, 2, 'view_slider_images', 0),
-- (74, 2, 'add_slider_images', 0),
-- (75, 2, 'edit_slider_images', 0),
-- (76, 2, 'delete_slider_images', 0),
-- (77, 2, 'view_sales', 0),
-- (78, 2, 'edit_sales', 0),
-- (79, 2, 'delete_sales', 0),
-- (80, 2, 'view_receipt', 0),
-- (81, 2, 'add_receipt', 0),
-- (82, 2, 'edit_receipt', 0),
-- (83, 2, 'delete_receipt', 0),
-- (84, 2, 'view_income', 0),
-- (85, 2, 'add_income', 0),
-- (86, 2, 'edit_income', 0),
-- (87, 2, 'delete_income', 0);

-- COURSE META Table
CREATE TABLE IF NOT EXISTS `courses_meta` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `tab` varchar(50) NOT NULL,
  `data_type` varchar(100) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `unid` bigint(20) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `course_id` (`course_id`),
  KEY `data_type` (`data_type`),
  KEY `tab` (`tab`),
  KEY `unid` (`unid`),
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- COURSES LECTURES Table
CREATE TABLE IF NOT EXISTS `courses_lectures` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `unid` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `file` varchar(1024) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `unid` (`unid`),
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- EXAM Table
CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exam_title` varchar(250) NOT NULL,
  `exam_datetime` datetime NULL,
  `exam_duration` varchar(30) NULL,
  `total_question` int(5) NULL,
  `right_answer_mark` varchar(30) NULL,
  `wrong_answer_mark` varchar(30) NULL,
  `exam_created_on` datetime NOT NULL,
  `exam_status` enum('Pending','Created','Started','Completed') NOT NULL,
  `csrf_code` varchar(100) NULL,
  `course_id` int(11) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `exam_title` (`exam_title`),
  KEY `exam_datetime` (`exam_datetime`),
  KEY `exam_duration` (`exam_duration`),
  KEY `total_question` (`total_question`),
  KEY `exam_created_on` (`exam_created_on`),
  KEY `exam_status` (`exam_status`),
  KEY `course_id` (`course_id`),
  KEY `csrf_code` (`csrf_code`),
  KEY `disabled` (`disabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 

-- USER EXAM ANSWER Table
CREATE TABLE IF NOT EXISTS `user_exam_answer` (
  `answer_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer_option` enum('0','1','2','3','4') NOT NULL,
  `marks` varchar(20) NOT NULL,
  KEY `answer_id` ( `answer_id`),
  KEY `user_id` ( `user_id`),
  KEY `exam_id` ( `exam_id`),
  KEY `question_id` ( `question_id`),
  KEY `user_answer_option` ( `user_answer_option`),
  KEY `marks` ( `marks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Course Enroll Table
CREATE TABLE IF NOT EXISTS `course_enroll` (
  `course_enroll_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  -- `attendance_status` enum('Absent','Present') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Exam Ernoll Table
CREATE TABLE IF NOT EXISTS `exam_enroll` (
  `exam_enroll_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `attendance_status` enum('Absent','Present') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- QUESTION Table
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `question_title` text NOT NULL,
  `answer_option` enum('1','2','3','4') NOT NULL,
  KEY `exam_id` ( `exam_id`),
  KEY `question_title` ( `question_title`),
  KEY `answer_option` ( `answer_option`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- OPTION Table
CREATE TABLE IF NOT EXISTS `question_option` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_number` int(2) NOT NULL,
  `option_title` varchar(250) NOT NULL,
  KEY `question_id` (`question_id`),
  KEY `option_number` (`option_number`),
  KEY `option_title` (`option_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 

-- INSTITUTE Info Table
-- CREATE TABLE IF NOT EXISTS `` (
--   KEY `` ( ``),
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 

