<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * CourseDetails()
 * *
 * The CourseDetails Page
 */
class CourseDetails extends Controller {
  # -----| Index() | -----
  public function index() {
    $data['title'] = "CourseDetails";

    $this->view('course-details',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "CourseDetails Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./CourseDetails()
