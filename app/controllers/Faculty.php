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
use \Model\User;

/**
 * Faculty()
 * *
 * The Faculty Page
 */
class Faculty extends Controller {
  # -----| Index() | -----
  public function index() {
    $user_id = Auth::getId();

    $user = new User();
    $data['uid'] = $uid = $user->first(['id'=>$user_id]);

    $course = new \Model\Course();
    $category = new \Model\Category();

    $data['title'] = "Faculty";
 
    # ...| READ ALL Courses
    $data['rows'] = $course->where(['approved'=>1,'published'=>1], 'desc', 10);

    # ...| READ ALL Courses Order by Trending Value
    $query = "select * from courses where approved = 1 and published = 1 order by trending desc limit 5";
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

    $this->view('faculty',$data);
  }
  # ---| ./Index()\. | ---
}
# -----| ./Faculty()
