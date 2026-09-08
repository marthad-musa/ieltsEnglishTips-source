<?php

/**
 * User: TECH-Tag
 * Date: 11/01/2025
 * Time: 03:30 PM
 * * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package https://marthadmusa.blogger.com
 */

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

/**
 * Class DATABASE()
 * *
 */
class Database {
  private static ?PDO $connection = null;

  # -----| Connect() |-----
  private function connect(): PDO {
    if (self::$connection instanceof PDO) {
      return self::$connection;
    }

    $str = DBDRIVER . ":host=" . DBHOST . ";port=3306;dbname=" . DBNAME . ";charset=utf8mb4";
    self::$connection = new PDO($str, DBUSER, DBPASS, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_PERSISTENT => true,
    ]);

    return self::$connection;
  }
  # ---| ./Connect()\. |---

  # -----| QUERY() | -----
  public function query($query,$data = [],$type = 'object') {
    $con = $this->connect();
    $stm = $con->prepare($query);

    if ($stm) {
      # ...| TRUE Block
      $check = $stm->execute($data);
      if ($check) {
        # ...| TRUE Block
        if ($type == 'object') {
          # ...| TRUE Block
          $type = PDO::FETCH_OBJ;
        } else {
          # ...| FALSE Block
          $type = PDO::FETCH_ASSOC;
        }
        # ...| ./IF/ELSE($type)

        $result = $stm->fetchAll($type);

        if (is_array($result) && count($result) > 0) {
          # ...| TRUE Block | Run AfterSELECT Functions
          if (property_exists($this,'afterSelect')) {
            # ...| TRUE Block
            foreach ($this->afterSelect as $func) {
              $result = $this->$func($result);
            } # ---| ./FOREACH(FUNCTION)
          } # ---| ./IF(Property Exists)
          # ---| ./AfterSELECT Functions\. |---

          return $result;
        }
        # ---| ./IF(is_array())
      }
      # ---| ./IF($check)
    }
    # ---| ./IF($stm)

    return false;
  }
  # ---| ./QUERY()\. | ---

  # -----| CREATE Tables() | -----
  public function create_tables() {
    /**
     * --------------------
     * | CATEGORIES Table |
     * --------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `categories` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `category` varchar(30) NOT NULL,
        `slug` varchar(100) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `category` (`category`),
        KEY `slug` (`slug`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /** ---|INSERTING INTO CATEGORIES TABLE|--- **/
    $query = "INSERT INTO `categories` (`category`, `slug`, `disabled`) VALUES ('IELTS Preparation', 'ielts-preparation', '0'), ('English Course', 'english-course', '0'), ('IT & Software', 'it-software', '0')";

    $this->query($query);

    /**
     * -----------------
     * | COURSES Table |
     * -----------------
     */
    $query = "
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
        `course_duration` int(11) DEFAULT NULL,
        `course_timeline` int(11) DEFAULT NULL,
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
        KEY `slug` (`slug`),
        KEY `course_timeline` (`course_timeline`),
        KEY `tags` (`tags`(1024))
      ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * --------------------------
     * | COURSES_LECTURES Table |
     * --------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `courses_lectures` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `unid` bigint(20) NOT NULL,
        `title` varchar(100) NOT NULL,
        `description` varchar(2048) NOT NULL,
        `file` varchar(1024) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `unid` (`unid`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * ----------------------
     * | COURSES_META Table |
     * ----------------------
     */
    $query = "
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
      ) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * ----------------------------
     * | COURSES Enrollment Table |
     * ----------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `course_enroll` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `course_id` int(11) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 1,
        KEY `user_id` (`user_id`),
        KEY `course_id` (`course_id`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * ------------------------------
     * | COURSE_JOIN_REQUESTS Table |
     * ------------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `course_join_requests` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `course_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `status` varchar(20) NOT NULL DEFAULT 'Pending',
        `requested_at` datetime DEFAULT NULL,
        `approved_by` int(11) DEFAULT NULL,
        `approved_at` datetime DEFAULT NULL,
        `notes` varchar(1024) DEFAULT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `course_id` (`course_id`),
        KEY `user_id` (`user_id`),
        KEY `status` (`status`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * -----------------------
     * | COURSE_LEVELS Table |
     * -----------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `course_levels` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `level` varchar(30) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /** ---|INSERTING INTO COURSE_LEVELS TABLE|--- **/
    $query = "INSERT INTO `course_levels` (`level`, `disabled`) VALUES ('Beginner Level', 0), ('Intermediate Level', 0), ('Expert Level', 0), ('All Levels', 0)";

    $this->query($query);

    /**
     * --------------------
     * | CURRENCIES Table |
     * --------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `currencies` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `currency` varchar(20) NOT NULL,
        `symbol` varchar(4) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * --------------
     * | EXAM Table |
     * --------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `exam` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `exam_title` varchar(250) NOT NULL,
        `exam_description` text DEFAULT NULL,
        `exam_datetime` datetime DEFAULT NULL,
        `exam_duration` varchar(30) DEFAULT NULL,
        `total_question` int(5) DEFAULT NULL,
        `right_answer_mark` varchar(30) DEFAULT NULL,
        `wrong_answer_mark` varchar(30) DEFAULT NULL,
        `exam_created_on` datetime NOT NULL,
        `exam_status` enum('Pending','Created','Started','Completed') NOT NULL,
        `created_by` int(11) NOT NULL DEFAULT 1,
        `csrf_code` varchar(100) DEFAULT NULL,
        `course_id` int(11) NOT NULL,
        `approved` tinyint(1) NOT NULL DEFAULT 0,
        `published` tinyint(1) NOT NULL DEFAULT 0,
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
        KEY `disabled` (`disabled`),
        KEY `created_by` (`created_by`),
        KEY `approved` (`approved`),
        KEY `published` (`published`)
      ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * ----------------------
     * | EXAM_ANSWERS Table |
     * ----------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `exam_answers` (
      `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `exam_id` int(11) NOT NULL,
      `user_id` int(11) NOT NULL,
      `question_id` int(11) NOT NULL,
      `selected_option_id` int(11) DEFAULT NULL,
      `is_correct` tinyint(1) NOT NULL DEFAULT 0,
      `submitted_at` datetime DEFAULT NULL,
      `disabled` tinyint(1) NOT NULL DEFAULT 0,
      KEY `exam_id` (`exam_id`),
      KEY `user_id` (`user_id`),
      KEY `question_id` (`question_id`),
      KEY `is_correct` (`is_correct`),
      KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * -------------------------
     * | EXAM ENROLLMENT Table |
     * -------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `exam_enroll` (
        `exam_enroll_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `exam_id` int(11) NOT NULL,
        `attendance_status` enum('Absent','Present') NOT NULL,
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * ----------------------------
     * | EXAM JOIN REQUESTS Table |
     * ----------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `exam_join_requests` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `exam_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `status` varchar(20) NOT NULL DEFAULT 'Pending',
        `requested_at` datetime DEFAULT NULL,
        `approved_by` int(11) DEFAULT NULL,
        `approved_at` datetime DEFAULT NULL,
        `notes` varchar(1024) DEFAULT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `exam_id` (`exam_id`),
        KEY `user_id` (`user_id`),
        KEY `status` (`status`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * ----------------------
     * | EXAM RESULTS Table |
     * ----------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `exam_results` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `exam_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `score` decimal(5,2) NOT NULL DEFAULT 0.00,
        `percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
        `status` varchar(50) NOT NULL DEFAULT 'Submitted',
        `submitted_at` datetime DEFAULT NULL,
        `reviewed_by` int(11) DEFAULT NULL,
        `approved_at` datetime DEFAULT NULL,
        `retake_allowed` tinyint(1) NOT NULL DEFAULT 0,
        `notes` varchar(1024) DEFAULT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        UNIQUE KEY `unique_exam_user` (`exam_id`,`user_id`),
        KEY `user_id` (`user_id`),
        KEY `status` (`status`),
        KEY `percentage` (`percentage`),
        KEY `submitted_at` (`submitted_at`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * -------------------
     * | LANGUAGES Table |
     * -------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `languages` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `symbol` varchar(10) NOT NULL,
        `language` varchar(30) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /** ---|INSERTING INTO LANGUAGES TABLE|--- **/
    $query = "INSERT INTO `languages` (`symbol`, `language`, `disabled`) VALUES ('en_US', 'English (US)', 0), ('ar_AR', 'العربية', 0);";

    $this->query($query);

    /**
     * -------------------------
     * | PERMISSIONS_MAP Table |
     * -------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `permissions_map` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `role_id` int(11) NOT NULL,
        `permission` varchar(100) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `role_id` (`role_id`),
        KEY `permission` (`permission`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * ----------------
     * | PRICES Table |
     * ----------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `prices` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `name` varchar(30) NOT NULL,
        `price` decimal(10,0) NOT NULL,
        `currency_id` int(11) NOT NULL DEFAULT 1,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `price` (`price`),
        KEY `name` (`name`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /** ---|INSERTING INTO PRICES TABLE|--- **/
    $query = "INSERT INTO `prices` (`id`, `name`, `price`, `disabled`) VALUES (1, 'Free', '0', '0');";

    $this->query($query);

    /** ---|INSERTING INTO CURRENCIES TABLE|--- **/
    $query = "INSERT INTO `currencies` (`currency`, `symbol`, `disabled`) VALUES ('EG Pound', 'EGD', 0), ('SD Pound', 'SDG', 0), ('US Dollar', '$', 0), ('EU Euro', '¥', 0)";

    $this->query($query);

    /** ---|INSERTING INTO COURSES TABLE|--- **/
    // $query = "INSERT INTO courses (title, description, user_id, category_id, sub_category_id, level_id, language_id, price_id, promo_link, course_image, course_image_tmp, course_promo_video, primary_subject, course_duration, course_timeline, total_student, create_date, start_date, end_date, tags, congratulations_message, welcome_message, approved, published, subtitle, currency_id, csrf_code, views, trending, slug) VALUES ('IELTS Intensive Course', 'Boost your score quickly with our intensive preparation course (General Training).', 1, 1, 0, 3, 1, 3, NULL, 'undefined', '', '', 'General Training', 2, NULL, 18, NULL, NULL, NULL, NULL, '', '', 1, 1, 'IELTS Preparation', 1, 'f9e06eaaaf8b5cf1474b504a95848405', 0, 0, 'ielts-intensive-course'), ('Headway Curriculum', 'Get ready for journey in learning the English language.', 1, 2, 0, 4, 1, 2, NULL, '', '', NULL, 'English', 2, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'English Course', 1, '5ffc001e867cf4d767f6f1535ef3b504', 0, 0, 'headway-curriculum'), ('Computer Science', 'Learn how devices work and connect with the rest of the world.', 1, 3, 0, 3, 1, 2, NULL, '', '', NULL, 'MS Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'International Computer Driver Liecense', 1, 'c002421738b0a312095898f34630757f', 0, 0, 'computer-science');";

    // $this->query($query);

    /**
     * -------------------
     * | QUESTIONS Table |
     * -------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `question` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `exam_id` int(11) NOT NULL,
        `question_title` text NOT NULL,
        `answer_option` enum('1','2','3','4') NOT NULL,
        KEY `exam_id` (`exam_id`),
        KEY `question_title` (`question_title`(1024)),
        KEY `answer_option` (`answer_option`)
      ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * --------------------------
     * | QUESTION OPTIONS Table |
     * --------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `question_option` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `question_id` int(11) NOT NULL,
        `option_number` int(2) NOT NULL,
        `option_title` varchar(250) NOT NULL,
        KEY `question_id` (`question_id`),
        KEY `option_number` (`option_number`),
        KEY `option_title` (`option_title`)
      ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * -----------------------------
     * | ROLES & PERMISSIONS Table |
     * -----------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `roles` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `role` varchar(50) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
    ";

    $this->query($query);

    /**
     * -------------------
     * | SLIDER_IMAGES Table |
     * -------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `slider_images` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `image` varchar(2048) NOT NULL,
        `title` varchar(100) DEFAULT NULL,
        `description` varchar(255) DEFAULT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /**
     * ---------------
     * | USERS Table |
     * ---------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `firstname` varchar(30) NOT NULL,
        `lastname` varchar(30) NOT NULL,
        `email` varchar(100) NOT NULL,
        `username` varchar(100) NOT NULL,
        `bio` varchar(2048) DEFAULT NULL,
        `company` varchar(100) DEFAULT NULL,
        `job` varchar(100) DEFAULT NULL,
        `country` varchar(100) DEFAULT NULL,
        `address` varchar(1024) DEFAULT NULL,
        `phone` varchar(12) DEFAULT NULL,
        `password` varchar(255) NOT NULL,
        `role_id` tinyint(1) NOT NULL DEFAULT 1,
        `language_id` tinyint(1) NOT NULL DEFAULT 1,
        `date` datetime DEFAULT NULL,
        `image` varchar(1024) DEFAULT NULL,
        `facebook_link` varchar(1024) DEFAULT NULL,
        `instagram_link` varchar(1024) DEFAULT NULL,
        KEY `firstname` (`firstname`),
        KEY `lastname` (`lastname`),
        KEY `email` (`email`),
        KEY `username` (`username`),
        KEY `bio` (`bio`(1024)),
        KEY `company` (`company`),
        KEY `job` (`job`),
        KEY `country` (`country`),
        KEY `address` (`address`),
        KEY `role` (`role_id`),
        KEY `phone` (`phone`),
        KEY `language` (`language_id`),
        KEY `date` (`date`)
      ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);
    
    /**
     * ---------------------------
     * | USER EXAM ANSWERS Table |
     * ---------------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `user_exam_answer` (
        `answer_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `exam_id` int(11) NOT NULL,
        `question_id` int(11) NOT NULL,
        `user_answer_option` enum('0','1','2','3','4') NOT NULL,
        `marks` varchar(20) NOT NULL,
        KEY `answer_id` (`answer_id`),
        KEY `user_id` (`user_id`),
        KEY `exam_id` (`exam_id`),
        KEY `question_id` (`question_id`),
        KEY `user_answer_option` (`user_answer_option`),
        KEY `marks` (`marks`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);
  }
  # ---| ./CREATE Tables()\. | ---
}
# -----|  ./DATABASE()
