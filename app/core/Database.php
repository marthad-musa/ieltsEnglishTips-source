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
  # -----| Connect() |-----
  private function connect() {
    $str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
    return new PDO($str,DBUSER,DBPASS);
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
        `bio` varchar(2048) NULL,
        `company` varchar(100) NULL,
        `job` varchar(100) NULL,
        `country` varchar(100) NULL,
        `address` varchar(1024) NULL,
        `phone` varchar(12) NULL,
        `password` varchar(255) NOT NULL,
        `role` int(11) NOT NULL DEFAULT '1',
        `language` varchar(4) NULL,
        `date` date DEFAULT NULL,
        `image` varchar(1024) NULL,
        `twitter_link` varchar(1024) NULL,
        `facebook_link` varchar(1024) NULL,
        `instagram_link` varchar(1024) NULL,
        `linkedin_link` varchar(1024) NULL,
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
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `price` (`price`),
        KEY `disabled` (`disabled`),
        KEY `name` (`name`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /** ---|INSERTING INTO PRICES TABLE|--- **/
    $query = "INSERT INTO `prices` (`id`, `name`, `price`, `disabled`) VALUES (1, 'Free', '0', '0');";
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
      ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /** ---|INSERTING INTO CURRENCIES TABLE|--- **/
    $query = "INSERT INTO `currencies` (`id`, `currency`, `symbol`, `disabled`) VALUES (NULL, 'US Dollar', '$', 0), (NULL, 'EU Euro', '¥', 0)";
    $this->query($query);

    /**
     * -------------------
     * | LANGUAGES Table |
     * -------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `languages` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `symbol` VARCHAR(10) NOT NULL,
        `language` varchar(30) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /** ---|INSERTING INTO LANGUAGES TABLE|--- **/
    $query = "INSERT INTO `languages` (`id`, `symbol`, `language`, `disabled`) VALUES (Null, 'en_US', 'English (US)', 0), (Null, 'ar_AR', 'العربية', 0), (Null, 'fr_FR', 'Français (France)', 0), (Null, 'es_ES', 'Español (España)', 0)";
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
    $query = "INSERT INTO `course_levels` (`id`, `level`, `disabled`) VALUES (NULL, 'Beginner Level', 0), (NULL, 'Intermediate Level', 0), (NULL, 'Expert Level', 0), (NULL, 'All Levels', 0)";
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
      ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
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
      ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
    ";

    $this->query($query);

    /**
     * -------------------
     * | CATEGORIES Table |
     * -------------------
     */
    $query = "
      CREATE TABLE IF NOT EXISTS `categories` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `category` varchar(30) NOT NULL,
        `slug` VARCHAR(100) NOT NULL,
        `disabled` tinyint(1) NOT NULL DEFAULT 0,
        KEY `category` (`category`),
        KEY `disabled` (`disabled`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

    /** ---|INSERTING INTO CATEGORIES TABLE|--- **/
    // $query = "INSERT INTO `categories` (`id`, `category`, `disabled`) VALUES (NULL, 'Development', '0'), (NULL, 'Business', '0'), (NULL, 'Finance & Accounting', '0'), (NULL, 'IT & Software', '0'), (NULL, 'Office Productivity', '0'), (NULL, 'Personal Development', '0'), (NULL, 'Design', '0'), (NULL, 'Marketing', '0'), (NULL, 'Lifestyle', '0'), (NULL, 'Photography & Video', '0'), (NULL, 'Health & Fitness', '0'), (NULL, 'Music', '0'), (NULL, 'Teaching & Academics', '0'), (NULL, 'I don\'t know yet', '0')";
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
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

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
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
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
      ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
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
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ";

    $this->query($query);

  }
  # ---| ./CREATE Tables()\. | ---
}
# -----|  ./DATABASE()
