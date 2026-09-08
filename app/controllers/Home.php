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

use \Model\Auth;
use \Model\Slider;
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
    $rows = $course->where(['approved'=>1,'published'=>1], 'desc', 10);
    $data['rows'] = array_reverse($rows);

    # -----| Load Slider Images | -----
    $slider = new Slider();
    $slider->order = 'asc';
    $data['images'] = $slider->where(['disabled'=>0]);
    # ---| ./Load Slider Images\. | ---

    $this->view('home',$data);
  }
  # ---| ./Index()\. | ---
}
# -----| ./Home()
