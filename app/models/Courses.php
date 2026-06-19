<?php

# NameSpace  ---------------
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Courses()
 * *
 * The Courses MODEL
 */
class Courses extends Model {
  # -----| Properties |-----
  public $errors = [];
  protected $table = "courses";

  protected $afterSelect = [
    'get_user',
    'get_category',
    'get_sub_category',
    'get_level',
    'get_language',
    'get_currency',
    'get_price',
  ];

  protected $beforeUpdate = [];
  // protected $afterDelete = [];

  protected $allowedColumns = [
    'title',
    'description',
    'user_id',
    'category_id',
    'sub_category_id',
    'level_id',
    'language_id',
    'price_id',
    'promo_link',
    'course_image',
    'course_image_tmp',
    'course_promo_video',
    'primary_subject',
    'date',
    'tags',
    'congratulations_message',
    'welcome_message',
    'approved',
    'published',
    'subtitle',
    'currency_id',
    'csrf_code',
    'views',
    'trending',
  ];
  # ---| ./Properties\. |---
  
  # -----| Validate() |-----
  public function validate($data) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler |-----
    # ...| TITLE Block
    if(empty($data['title'])) {
      $this->errors['title'] = "Course title is required!";
    } else
    if(!preg_match("/^[a-zA-Z \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['title']))) {
      $this->errors['title'] = "Invalid Charactors!";
    }
    # ---| ./IF/ELSE(TITLE)

    # ...| Primary-Subject Block
    if(empty($data['primary_subject'])) {
      $this->errors['primary_subject'] = "Course primary_subject is required!";
    } else
    if(!preg_match("/^[a-zA-Z \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['primary_subject']))) {
      $this->errors['primary_subject'] = "Invalid Charactors!";
    }
    # ---| ./IF/ELSE(Primary-Subject)

    # ...| Category_ID Block
    if(empty($data['category_id'])) {
      $this->errors['category_id'] = "Course category is required!";
    }
    # ---| ./IF(Category_ID)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. |---

  # -----| EDIT_Validate() |-----
  public function edit_validate($data,$id = null,$tab_name = null) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler Depending on TAB-Names |-----
    if($tab_name == "course-landing-page") {
      # ...| TITLE Block
      if(empty($data['title'])) {
        $this->errors['title'] = "Course title is required!";
      } else
      if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['title']))) {
        $this->errors['title'] = "Invalid Charactors!";
      }
      # ---| ./IF/ELSE(TITLE)

      # ...| SUBTITLE Block
      if(empty($data['subtitle'])) {
        $this->errors['subtitle'] = "Course subtitle is required!";
      } else
      if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['subtitle']))) {
        $this->errors['subtitle'] = "Invalid Charactors!";
      }
      # ---| ./IF/ELSE(SUBTITLE)

      # ...| DESCRIPTION Block
      if(empty($data['description'])) {
        $this->errors['description'] = "Course description is required!";
      } else
      if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['description']))) {
        $this->errors['description'] = "Invalid Charactors!";
      }
      # ---| ./IF/ELSE(DESCRIPTION)

      # ...| Language_ID Block
      if(empty($data['language_id'])) {
        $this->errors['language_id'] = "Course Language is required!";
      }
      # ---| ./IF(Language_ID)

      # ...| Level_ID Block
      if(empty($data['level_id'])) {
        $this->errors['level_id'] = "Course Level is required!";
      }
      # ---| ./IF(Level_ID)

      # ...| Category_ID Block
      if(empty($data['category_id'])) {
        $this->errors['category_id'] = "Course category is required!";
      }
      # ---| ./IF(Category_ID)

      # ...| Sub_Category_ID Block
      // if(empty($data['sub_category_id'])) {
      //   $this->errors['sub_category_id'] = "Course Subcategory is required!";
      // }
      # ---| ./IF(Sub_Category_ID)

      # ...| Currency_ID Block
      if(empty($data['currency_id'])) {
        $this->errors['currency_id'] = "Price Currency is required!";
      }
      # ---| ./IF(Currency_ID)

      # ...| Price_ID Block
      if(empty($data['price_id'])) {
        $this->errors['price_id'] = "Course Price is required!";
      }
      # ---| ./IF(Price_ID)

      # ...| Primary-Subject Block
      if(empty($data['primary_subject'])) {
        $this->errors['primary_subject'] = "Course primary_subject is required!";
      } else
      if(!preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", trim($data['primary_subject']))) {
        $this->errors['primary_subject'] = "Invalid Charactors!";
      }
      # ---| ./IF/ELSE(Primary-Subject)
    } else
    if ($tab_name == "course-messages") {
      # ...| Welcome Message Block
      # ...| Congratulations Message Block
    }
    # ---| ./IF/ELSE/IF(Tab_Name Error Handling)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./EDIT_Validate()\. |---

  # -----| AfterSELECT Functions |-----
  protected function get_user($rows) {
    $db = new \Database();
    if (!empty($rows[0]->user_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select firstname, lastname, role, image from users where id = :id limit 1";
        $user = $db->query($query,['id'=>$row->user_id]);
        if (!empty($user)) {
          # ...| TRUE Block
          $user[0]->name = $user[0]->firstname . ' ' . $user[0]->lastname;
          $rows[$key]->user_row = $user[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_USER() |---

  protected function get_category($rows) {
    $db = new \Database();
    if (!empty($rows[0]->category_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from categories where id = :id limit 1";
        $cat = $db->query($query,['id'=>$row->category_id]);
        if (!empty($cat)) {
          # ...| TRUE Block
          $rows[$key]->category_row = $cat[0];
        }
        # ---| ./IF(Category)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_CATEGORY() |---

  protected function get_sub_category($rows) {
    return $rows;
  } # ---| ./Get_SubCATEGORY() |---

  protected function get_level($rows) {
    $db = new \Database();
    if (!empty($rows[0]->level_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from course_levels where id = :id limit 1";
        $level = $db->query($query,['id'=>$row->level_id]);
        if (!empty($level)) {
          # ...| TRUE Block
          $rows[$key]->level_row = $level[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_LEVEL() |---

  protected function get_language($rows) {
    $db = new \Database();
    if (!empty($rows[0]->language_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from languages where id = :id limit 1";
        $lang = $db->query($query,['id'=>$row->language_id]);
        if (!empty($lang)) {
          # ...| TRUE Block
          $rows[$key]->language_row = $lang[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_LANGUAGE() |---

  protected function get_currency($rows) {
    $db = new \Database();
    if (!empty($rows[0]->currency_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from currencies where id = :id limit 1";
        $currency = $db->query($query,['id'=>$row->currency_id]);
        if (!empty($currency)) {
          # ...| TRUE Block
          $rows[$key]->currency_row = $currency[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_CURRENCY() |---

  protected function get_price($rows) {
    $db = new \Database();
    if (!empty($rows[0]->price_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from prices where id = :id limit 1";
        $price = $db->query($query,['id'=>$row->price_id]);
        if (!empty($price)) {
          # ...| TRUE Block
          $price[0]->name = $price[0]->name . ' (' . $rows[$key]->currency_row->symbol . $price[0]->price . ') ' . strtoupper($rows[$key]->currency_row->currency);
          $rows[$key]->price_row = $price[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_PRICE() |---
  # ---| ./AfterSELECT Functions\. |---
}
# -----| ./Courses()
