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
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Course-details()
 * *
 * The Single-Course Page
 */
class Course_details extends Controller {
  # -----| Index() | -----
  public function index($slug = null) {
    $course = new \Model\Course();
    $course_meta = new \Model\Course_meta();

    $data['title'] = "Course Details";
 
    # ...| READ ALL Courses
    $data['rows'] = $course->where(['approved'=>1,'published'=>1], 'desc', 10);

    # ...| READ The Course Data
    $data['row'] = $row = $course->first(['slug'=>$slug]);

    # ...| READ ALL Courses Metas
    $coursesMetas = $course_meta->where(['disabled'=>0,'course_id'=>$row->id ?? null], 'desc');
    if ($coursesMetas) {
      # ...| TRUE Block
      $data['coursesMeta'] = $coursesMetas;
    }
    # ---| ./IF(Courses Metas)

    # ...| READ ALL Courses Order by Trending Value
    $query = "select * from courses where approved = 0 order by trending desc limit 5";
    $data['trending'] = $course->query($query);

    if ($data['rows']) {
      # ...| TRUE Block
      $data['first_row'] = $data['rows'][0];
      unset($data['rows'][0]);

      $total_rows = count($data['rows']);
      $half_rows = round($total_rows / 2);

      /**
       * Splice()
       * *
       * a method that split an array() acourding to it's offset
       * and the data it removes will be excluded from the whole array.
       */
      $data['rows1'] = array_splice($data['rows'], 0, $half_rows);
      $data['rows2'] = $data['rows'];
    }
    # ---| ./IF(Rows)

    $this->view('course_details',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Home Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Course-details()
