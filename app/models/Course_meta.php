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
 * Course_Meta()
 * *
 * The additional Meta-Data used for each Course MODEL
 */
class Course_meta extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "courses_meta";

  protected $afterSelect = [
    'get_lecture',
  ];

  protected $allowedColumns = [
    'course_id',
    'tab',
    'data_type',
    'value',
    'description',
    'unid',
    'disabled',
  ];
  # ---| ./Properties\. | ---

  # -----| AfterSELECT Functions |-----
  protected function get_lecture($rows) {
    $db = new \Database();
    if (!empty($rows[0]->unid)) {
      # ...| TRUE Block
      foreach ($rows as $key => $row) {
        $query = "select * from courses_lectures where unid = :unid";
        $lectures = $db->query($query,['unid'=>$row->unid]);
        if (!empty($lectures)) {
          # ...| TRUE Block
          $rows[$key]->lectures_row = $lectures;
        }
        # ---| ./IF(Category)
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    return $rows;
  } # ---| ./Get_LECTURE() |---
  # ---| ./AfterSELECT Functions\. |---

  # -----| Validate() | -----
  // public function validate($data) {
  //   # -----| Reset Errors Array() | -----
  //   $this->errors = [];
  //   # ---| ./Reset Errors Array()\. | ---

  //   // return false;
  // }
  # ---| ./Validate()\. | ---
}
# -----| ./Course_Meta()
