<?php

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

use \Model\Auth;
use \Model\User;

/**
 * Home()
 * *
 * The Home Page
 */
class Home extends Controller {
  # -----| Index() | -----
  public function index() {
    $user_id = Auth::getId();

    $user = new User();
    $data['uid'] = $uid = $user->first(['id'=>$user_id]);

    $course = new \Model\Course();
    $category = new \Model\Category();

    $data['title'] = "Home";
 
    # ...| READ ALL Courses
    $data['rows'] = $course->where(['approved'=>0], 'desc', 10);


    $this->view('home',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Home Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Home()
