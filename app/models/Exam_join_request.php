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
if (!defined("ROOT")) die ("direct script access denied!");
# ------------|  ./SECURITY CHECK


/**
 * Exam_join_request()
 * *
 * The Exam Join Request MODEL
 */
class Exam_join_request extends Model {
  # -----| Properties |-----
  public $errors = [];
  protected $table = "exam_join_requests";

  protected $afterSelect = [];
  protected $beforeUpdate = [];

  protected $allowedColumns = [
    'id',
    'exam_id',
    'user_id',
    'status',
    'requested_at',
    'approved_by',
    'approved_at',
    'notes',
    'disabled',
  ];
  # ---| ./Properties\. |---
  
  # -----| Validate() |-----
  public function validate($data) {
    # -----| Reset Errors Array() |-----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. |---

    # -----| Error Handler |-----
    # ...| EXAM_ID Block
    if(empty($data['exam_id'])) {
      $this->errors['exam_id'] = "Exam ID is required!";
    }
    # ---| ./IF(EXAM_ID)

    # ...| USER_ID Block
    if(empty($data['user_id'])) {
      $this->errors['user_id'] = "User ID is required!";
    }
    # ---| ./IF(USER_ID)

    # ...| STATUS Block
    if(empty($data['status'])) {
      $this->errors['status'] = "Status is required!";
    }
    # ---| ./IF(STATUS)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(empty($this->errors))

    return false;
  }
  # ---| ./Validate()\. | ---

}
# -----| ./Exam_join_request()
