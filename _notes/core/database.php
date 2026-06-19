<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

/**
 * Class DATABASE()
 * *
 */
class database {
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
          # ...| TRUE Code
          $type = PDO::FETCH_OBJ;
        } else {
          # ...| FALSE Block
          $type = PDO::FETCH_ASSOC;
        }
        # ...| ./IF/ELSE($type)

        $result = $stm->fetchAll($type);

        if (is_array($result) && count($result) > 0) {
          # ...| TRUE Block
          return $result;
        } # ---| ./IF(is_array())
      } # ---| ./IF($check)
    } # ---| ./IF($stm)
    return false;
  }
  # ---| ./QUERY()\. | ---

  # -----| CREATE Tables() | -----
  public function create_tables() {
    /**
     * -----------
     * USERS Table
     * -----------
     */
    $query = "
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
        `role` enum('owner', 'admin', 'teacher', 'student') NOT NULL DEFAULT 'owner',
        `language` enum('en', 'ar') NOT NULL DEFAULT 'en',
        `date` date DEFAULT NULL,
        `image` varchar(1024) NULL,
        `facebook_link` varchar(1024) NULL,
        `instagram_link` varchar(1024) NULL,
        `twitter_link` varchar(1024) NULL,
        `tiktok_link` varchar(1024) NULL,
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
  }
  # ---| ./CREATE Tables()\. | ---
}
# -----|  ./DATABASE()
