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
 * Headway()
 * *
 * The All-Headway Page
 */
class Headway extends Controller {
  # -----| Index() | -----
  public function index($slug = null, $action = null) {
    $course = new \Model\Course();
    $course_meta = new \Model\Course_meta();

    $data['title'] = "Headway";
    $data['action'] = $action;
 
    # ...| READ ALL Courses
    $data['rows'] = $course->where(['approved'=>1,'published'=>1], 'desc');

    # ...| READ The Course Data
    // $data['row'] = $row = $course->first(['slug'=>$slug]);

    # ...| READ ALL Courses Metas
    // $coursesMetas = $course_meta->where(['disabled'=>0,'course_id'=>$row->id ?? null], 'desc');
    // if ($coursesMetas) {
    //   # ...| TRUE Block
    //   $data['coursesMeta'] = $coursesMetas;
    // }
    # ---| ./IF(Courses Metas)

    $this->view('headway',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Courses Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Courses()
