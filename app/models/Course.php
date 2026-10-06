<?php

/**
 * User: TECH-Tag
 * Date: 08/16/2025
 * Time: 07:37 PM
 * * *
 * @author  Marthad Musa <marthad.musa@gmail.com>
 * @package https://marthadmusa.blogger.com
 */

# NameSpace  ---------------
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Course()
 * *
 * The Courses MODEL
 */
class Course extends Model {
  # -----| Properties |-----
  public $errors = [];
  protected $table = "courses";

  protected $afterSelect = [
    'get_user',
    'get_category',
    'get_sub_category',
    'get_language',
    'get_currency',
    'get_price',
    // 'get_course_enroll',
  ];

  protected $beforeUpdate = [];
  // protected $afterDelete = [];

  protected $allowedColumns = [
    'title',
    'description',
    'user_id',
    'category_id',
    'sub_category_id',
    'language_id',
    'price_id',
    'promo_link',
    'course_image',
    'hero_background_image',
    'course_image_tmp',
    'course_promo_video',
    'primary_subject',
    'course_duration',
    'total_student',
    'create_date',
    'start_date',
    'end_date',
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
    'slug',
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
    $this->errors = [];

    if ($tab_name === "course-landing-page") {
      $text_fields = ['title', 'subtitle', 'description', 'primary_subject'];
      foreach ($text_fields as $field) {
        if (!array_key_exists($field, $data)) {
          continue;
        }

        $value = trim((string)$data[$field]);
        if ($field === 'title' && $value === '') {
          $this->errors[$field] = "Course title is required!";
        } elseif ($value !== '' && !preg_match("/^[a-zA-Z0-9 \-\_\&\!\#\$\%\?\.\(\)\{\}\[\]\'\"\/\,]+$/", $value)) {
          $this->errors[$field] = "Invalid characters!";
        }
      }

      foreach (['language_id', 'currency_id', 'price_id'] as $field) {
        if (array_key_exists($field, $data) && empty($data[$field])) {
          $this->errors[$field] = ucfirst(str_replace('_id', '', $field)) . " is required!";
        }
      }

      if (array_key_exists('category_id', $data) || array_key_exists('sub_category_id', $data)) {
        $current_course = $this->first(['id' => $id]);
        $category_id = $data['category_id'] ?? ($current_course->category_id ?? null);
        $category = false;

        if (!empty($category_id)) {
          $db = new \Database();
          $category = $db->query(
            "SELECT `category` FROM `categories` WHERE `id` = :id AND `disabled` = 0 LIMIT 1",
            ['id' => $category_id]
          );
        }

        if (empty($category)) {
          $this->errors['category_id'] = "Select a valid course category!";
        } else {
          $category_name = strtolower(trim($category[0]->category));
          $allowed_subcategories = [];
          if ($category_name === 'ielts preparation') {
            $allowed_subcategories = ['Academic', 'General Training'];
          } elseif ($category_name === 'english course') {
            $allowed_subcategories = ['Beginner', 'Elementary', 'Pre-Intermediate', 'Intermediate', 'Upper-Intermediate', 'Advance'];
          } elseif ($category_name !== 'it & software') {
            $this->errors['category_id'] = "No course subcategories are configured for this category!";
          }

          $category_changed = !empty($current_course)
            && (int)$category_id !== (int)$current_course->category_id;
          $subcategory_was_submitted = array_key_exists('sub_category_id', $data);
          $subcategory_id = $subcategory_was_submitted
            ? $data['sub_category_id']
            : ($category_changed ? null : ($current_course->sub_category_id ?? null));

          if ($category_name === 'it & software') {
            if ($subcategory_was_submitted && !empty($subcategory_id)) {
              $this->errors['sub_category_id'] = "IT & Software courses do not use a subcategory.";
            }
          } elseif (!empty($allowed_subcategories) && ($subcategory_was_submitted || $category_changed)) {
            $subcategory = false;
            if (!empty($subcategory_id)) {
              $db = $db ?? new \Database();
              $subcategory = $db->query(
                "SELECT `level` FROM `course_levels` WHERE `id` = :id AND `disabled` = 0 LIMIT 1",
                ['id' => $subcategory_id]
              );
            }

            if (empty($subcategory) || !in_array($subcategory[0]->level, $allowed_subcategories, true)) {
              $this->errors['sub_category_id'] = "Select a subcategory that matches the course category!";
            }
          }
        }
      }
    }

    if ($tab_name === "curriculum") {
      $allowed_item_types = ['video', 'reading', 'quiz', 'assignment'];
      foreach ($data as $field => $value) {
        if (preg_match('/^item_type_lecture_[0-9]+_curriculum_[0-9]+$/', $field)
          && !in_array($value, $allowed_item_types, true)) {
          $this->errors['curriculum'] = "Choose a valid curriculum item type.";
          break;
        }

        if (preg_match('/^duration_minutes_lecture_[0-9]+_curriculum_[0-9]+$/', $field)
          && $value !== ''
          && (!ctype_digit((string)$value) || (int)$value > 65535)) {
          $this->errors['curriculum'] = "Enter a valid duration in minutes.";
          break;
        }

        if (preg_match('/^is_preview_lecture_[0-9]+_curriculum_[0-9]+$/', $field)
          && !in_array((string)$value, ['0', '1'], true)) {
          $this->errors['curriculum'] = "Choose whether the curriculum item is available as a preview.";
          break;
        }
      }
    }

    return empty($this->errors);
  }
  # ---| ./EDIT_Validate()\. |---

  # -----| AfterSELECT Functions |-----
  protected function get_user($rows) {
    $db = new \Database();
    if (!empty($rows[0]->user_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select firstname, lastname, role_id, image from users where id = :id limit 1";
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
    $db = new \Database();
    if (!empty($rows[0]->sub_category_id)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from course_levels where id = :id limit 1";
        $subcategory = $db->query($query,['id'=>$row->sub_category_id]);
        if (!empty($subcategory)) {
          # ...| TRUE Block
          $rows[$key]->sub_category_row = $subcategory[0];
          $rows[$key]->level_row = $subcategory[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_SubCATEGORY() |---

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
          // $price[0]->name = $price[0]->name . ' (' . $rows[$key]->currency_row->symbol . $price[0]->price . ') ' . strtoupper($rows[$key]->currency_row->currency);
          $price[0]->name = $price[0]->name . ' (' . $price[0]->price . ') ';
          $rows[$key]->price_row = $price[0];
        }
        # ---| ./IF(USERS)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_PRICE() |---

  // protected function get_course_enroll($rows) {
  //   $db = new \Database();
  //   if (!empty($rows[0]->total_student)) {
  //     # ...| TRUE Block
  //     foreach ($rows as $key => $row) {
  //       $query = "select * from course_enroll where course_id = :course_id";
  //       $enroll = $db->query($query,['course_id'=>$row->id]);
  //       if (!empty($enroll)) {
  //         # ...| TRUE Block
  //         // $enroll[0]->name = $enroll[0]->name . ' (' . $enroll[0]->enroll . ') ';
  //         $rows[$key]->enroll_row = $enroll[0];
  //       }
  //       # ---| ./IF(USERS)
  //     }
  //     # ---| ./FOREACH(ROWS)
  //   }
  //   # ---| ./IF(ROWS)

  //   return $rows;
  // } # ---| ./Get_PRICE() |---
  # ---| ./AfterSELECT Functions\. |---
}
# -----| ./Course()
