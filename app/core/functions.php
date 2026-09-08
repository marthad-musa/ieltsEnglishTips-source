<?php

/**
 * User: TECH-Tag
 * Date: 11/01/2025
 * Time: 03:30 PM
 * * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package https://marthadmusa.blogger.com
 */

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// defined("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


# -----| Show() | -----
function show($stuff) {
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}
# ---| ./Show()\. | ---

# -----| CSRF() 'Cross Site Request Forgery' | -----
function csrf() {
  $code = md5(time());
  $_SESSION['csrf_code'] = $code;
  echo "<input class='js-csrf_code' id='js-csrf_code' name='csrf_code' type='hidden' value='$code' />";
}
# ---| ./CSRF() 'Cross Site Request Forgery'\. | ---

# -----| Get_Badge() | -----
function get_badge($data) {
  if ($data == 'Created') {
    # ...| CREATED Block
    $badge = 'primary';
  } elseif ($data == 'Pending') {
    # ...| PENDING Block
    $badge = 'warning';
  } elseif ($data == 'Approved') {
    # ...| APPROVED Block
    $badge = 'secondary';
  } elseif ($data == 'Published') {
    # ...| PUBLISHED Block
    $badge = 'info';
  } elseif ($data == 'Rejected') {
    # ...| REJECTED Block
    $badge = 'danger';
  } elseif ($data == 'On Going') {
    # ...| ON GOING Block
    $badge = 'success';
  } else {
    # ...| ELSE Block
    $badge = 'secondary';
  }
  # ---| ./IF/ELSE(Data)

  return $badge;
}
# ---| ./Get_Badge()\. | ---


# -----| Course_Status() | -----
function course_status($course) {
  $approved = isset($course->approved) ? intval($course->approved) : 0;
  $published = isset($course->published) ? intval($course->published) : 0;

  if ($approved === 0 && $published === 0) {
    return 'Created';
  }

  if ($approved === 1 && $published === 0) {
    return 'Approved';
  }

  if ($approved === 0 && $published === 1) {
    return 'Rejected';
  }

  $today = date('Y-m-d');
  $start_date = !empty($course->start_date) ? date('Y-m-d', strtotime($course->start_date)) : null;
  $end_date = !empty($course->end_date) ? date('Y-m-d', strtotime($course->end_date)) : null;

  if (!empty($end_date) && $today > $end_date) {
    return 'Finished';
  }

  if (!empty($start_date)) {
    $future_limit = date('Y-m-d', strtotime('+14 days'));
    if ($start_date > $today && $start_date <= $future_limit) {
      return 'Pending';
    }

    if ($start_date <= $today && (empty($end_date) || $today < $end_date)) {
      return 'On Going';
    }
  }

  return 'Published';
}
# ---| ./Course_Status()\. | ---


# -----| Course_Status_Flags() | -----
function course_status_flags($status) {
  $flags = ['approved' => 0, 'published' => 0];

  switch ($status) {
    case 'Approved':
      $flags = ['approved' => 1, 'published' => 0];
      break;
    case 'Published':
    case 'Pending':
    case 'On Going':
    case 'Finished':
      $flags = ['approved' => 1, 'published' => 1];
      break;
    case 'Rejected':
      $flags = ['approved' => 0, 'published' => 1];
      break;
    case 'Created':
    default:
      $flags = ['approved' => 0, 'published' => 0];
      break;
  }

  return $flags;
}
# ---| ./Course_Status_Flags()\. | ---


# -----| Update_Course_Status_From_Date() | -----
function update_course_status_from_date() {
  $db = new \Database();
  $today = date('Y-m-d');

  $query = "select id, approved, published, start_date, end_date from courses where approved = 1 && published = 1 && start_date <= :today";
  $rows = $db->query($query, ['today' => $today]);

  if (!empty($rows)) {
    foreach ($rows as $row) {
      // No persistent status field exists, so status is derived dynamically.
      // This function is kept for compatibility with controllers that invoke the routine.
    }
  }
}
# ---| ./Update_Course_Status_From_Date()\. | ---


# -----| is_done() | -----
function is_done($data) {
  if ($data == 'Completed') {
    # ...| TRUE Block
    return true;
  }
  # ---|./IF(Done)
}
# ---| ./is_done()\. | ---

# -----| Get_Date() | -----
function get_date($date) {
  return date("d/m/Y",strtotime($date));
}
# ---| ./Get_Date()\. | ---

# -----| SET_VALUE() | -----
function set_value($key, $default = '') {
  if (!empty($_POST[$key])) {
    # ...| TRUE Block
    return $_POST[$key];
  } else
  if (!empty($default)) {
    # ...| TRUE Block
    return $default;
  }
  # ---| ./IF/ELSE-IF

  return '';
}
# ---| ./SET_VALUE()\. | ---

# -----| SET_SELECT() | -----
function set_select($key, $value, $default = '') {
  if (!empty($_POST[$key])) {
    # ...| TRUE Block
    if ($value == $_POST[$key]) {
      # ...| TRUE Block
      return ' selected ';
    }
    # ---| ./IF(VALUE=POST[KEY])
  } else if (!empty($default)) {
    # ...| TRUE Block
    if ($value == $default) {
      # ...| TRUE Block
      return ' selected ';
    }
    # ---| ./IF(VALUE=DEFAULT)
  }
  # ---| ./IF/ELSE_IF(POST[KEY])

  return '';
}
# ---| ./SET_SELECT()\. | ---

# -----| SET_CHECKED() | -----
function set_checked($key, $value, $default = '') {
  if (!empty($_POST[$key])) {
    # ...| TRUE Block
    if ($value == $_POST[$key]) {
      # ...| TRUE Block
      return ' checked="" ';
    }
    # ---| ./IF(VALUE=POST[KEY])
  } else if (!empty($default)) {
    # ...| TRUE Block
    if ($value == $default) {
      # ...| TRUE Block
      return ' checked="" ';
    }
    # ---| ./IF(VALUE=DEFAULT)
  }
  # ---| ./IF/ELSE_IF(POST[KEY])

  return '';
}
# ---| ./SET_CHECKED()\. | ---

# -----| REDIRECT() | -----
// function redirect($link) {
//   header("Location: ".ROOT."/".$link);
//   die;
// }
function redirect(string $link = '', int $status = 302): void {
  if (headers_sent($file, $line)) {
    error_log("Redirect failed: headers already sent in {$file}:{$line}");
    return;
  }

  $location = preg_match('/^https?:\/\//i', $link)
    ? $link
    : rtrim(ROOT, '/') . '/' . ltrim($link, '/');

  header('Location: ' . $location, true, $status);
  exit;
}
# ---| ./REDIRECT()\. | ---

# -----| MESSAGE() | -----
function message($msg = '',$erase = false) {
  if (!empty($msg)) {
    # ...| TRUE Block
    $_SESSION['message'] = $msg;
  } else {
    # ...| FALSE Block
    if (!empty($_SESSION['message'])) {
      # ...| TRUE Block
      $msg = $_SESSION['message'];
      if ($erase) {
        # ...| TRUE Block
        unset($_SESSION['message']);
      }
      # ---| ./IF(ERASE)
      return $msg;
    }
    # ---| ./IF(EMPTY(SESSION))
  }
  # ---| ./IF/ELSE(EMPTY(MESSAGE))

  return false;
}
# ---| ./MESSAGE()\. | ---

# -----| ESCAPE() | -----
function esc($str) {
  return nl2br(htmlspecialchars($str));
}
# ---| ./ESCAPE()\. | ---

# -----| STRING TO URL() | -----
function str_to_url($url) {
  $url = str_replace("'", "", $url);
  $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
  $url = trim($url, "-");
  $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
  $url = strtolower($url);
  $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
  return $url;
}
# ---| ./STRING TO URL()\. | ---

# -----| ReSize_Image() | -----
function resize_image($filename, $max_size = 700) {
  # Properties  ---------------
  // $ext = explode(".", $filename);
  // $ext = strtolower(end($ext));
  $type = mime_content_type($filename);
  # ------------|  ./Properties

  if (file_exists($filename)) {
    # ...| TRUE Block
    switch ($type) {
      case 'image/png':
        $image = imagecreatefrompng($filename);
        break;

      case 'image/gif':
        $image = imagecreatefromgif($filename);
        break;

      case 'image/jpeg':
        $image = imagecreatefromjpeg($filename);
        break;

      default:
        $image = imagecreatefromjpeg($filename);
        break;
    }
    # ---| ./SWITCH(EXTENSION)

    $src_w = imagesx($image);
    $src_h = imagesy($image);

    if ($src_w > $src_h) {
      # ...| TRUE Block
      if ($src_w < $max_size) {
        # ...| TRUE Block
        $max_size = $src_w;
      }
      # ---| ./IF(Width < Max-Size)

      $dst_w = $max_size;
      $dst_h = ($src_h / $src_w) * $max_size;
    } else {
      # ...| FALSE Block
      if ($src_h < $max_size) {
        # ...| TRUE Block
        $max_size = $src_h;
      }
      # ---| ./IF(HEIGHT < Max-Size)

      $dst_w = ($src_w / $src_h) * $max_size;
      $dst_h = $max_size;
    }
    # ---| ./IF/ELSE()

    $dst_image = imagecreatetruecolor($dst_w, $dst_h);

    /**
     * ----------------------
     * | Image Transparency |
     * ----------------------
     * *
     * After creating the destination image, make sure no transparency when uploading a PNG image using these functions:
     * *
     * imageAlphaBlending(GdImage $image, Bool $BlendMode): bool
     * imageSaveAlpha(GdImage $image, Bool $saveflag): bool(false)
     */
    if ($type = 'image/png') {
      # ...| TRUE Block
      imagealphablending($dst_image, false);
      imagesavealpha($dst_image, true);
    }
    # ---| ./IF(PNG)

    imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

    imagedestroy($image);

    /* ----| ImageJPEG(Desination Image, File Name, Image Quality) |---- */
    imagejpeg($dst_image,$filename,90);
    switch ($type) {
      case 'image/png':
        $image = imagepng($dst_image,$filename);
        break;

      case 'image/gif':
        $image = imagegif($dst_image,$filename);
        break;

      case 'image/jpeg':
        $image = imagejpeg($dst_image,$filename,90);
        break;

      default:
        $image = imagejpeg($dst_image,$filename,90);
        break;
    }
    # ---| ./SWITCH(EXTENSION)

    imagedestroy($dst_image);
  }
  # ---| ./IF(Filename Exists)

  return $filename;
}
# ---| ./ReSize_Image()\. | ---

# -----| Slider_Thumb_Path() | -----
function slider_thumb_path($file) {
  if (empty($file)) {
    return "";
  }

  $dir = dirname($file);
  $base = basename($file);
  return $dir . "/thumb_" . $base;
}
# ---| ./Slider_Thumb_Path()\. | ---

# -----| Create_Slider_Thumbnail() | -----
function create_slider_thumbnail($source, $max_width = 1400, $max_height = 900, $quality = 90) {
  if (empty($source) || !file_exists($source)) {
    return false;
  }

  $mime = mime_content_type($source);
  if (!in_array($mime, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
    return false;
  }

  $thumb_path = slider_thumb_path($source);
  if (file_exists($thumb_path)) {
    return $thumb_path;
  }

  switch ($mime) {
    case 'image/png':
      $src_image = imagecreatefrompng($source);
      break;

    case 'image/gif':
      $src_image = imagecreatefromgif($source);
      break;

    case 'image/jpeg':
    case 'image/jpg':
    default:
      $src_image = imagecreatefromjpeg($source);
      break;
  }

  $src_w = imagesx($src_image);
  $src_h = imagesy($src_image);

  $ratio = min($max_width / $src_w, $max_height / $src_h, 1);
  $dst_w = max(1, (int) round($src_w * $ratio));
  $dst_h = max(1, (int) round($src_h * $ratio));

  $dst_image = imagecreatetruecolor($dst_w, $dst_h);

  if ($mime === 'image/png') {
    imagealphablending($dst_image, false);
    imagesavealpha($dst_image, true);
  }

  imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

  switch ($mime) {
    case 'image/png':
      imagepng($dst_image, $thumb_path, 9);
      break;

    case 'image/gif':
      imagegif($dst_image, $thumb_path);
      break;

    case 'image/jpeg':
    case 'image/jpg':
    default:
      imagejpeg($dst_image, $thumb_path, $quality);
      break;
  }

  imagedestroy($src_image);
  imagedestroy($dst_image);

  return $thumb_path;
}
# ---| ./Create_Slider_Thumbnail()\. | ---

# -----| Get_Slider_Image() | -----
function get_slider_image($file) {
  $thumb = slider_thumb_path($file);

  if (!empty($thumb) && file_exists($thumb)) {
    return ROOT . "/" . $thumb;
  }

  return get_image($file);
}
# ---| ./Get_Slider_Image()\. | ---

# -----| Get_IMAGE() | -----
function get_image($file) {
  if (file_exists($file)) {
    # ...| TRUE Block
    return ROOT . "/" . $file;
  }
  # ---| ./IF(File)

  return ROOT . "/" . NoIMAGE;
}
# ---| ./Get_IMAGE()\. | ---

# -----| Get_VIDEO() | -----
function get_video($file) {
  if (file_exists($file)) {
    # ...| TRUE Block
    return ROOT . "/" . $file;
  }
  # ---| ./IF(File)

  return ROOT . "/assets/img/noimage.jpg";
}
# ---| ./Get_VIDEO()\. | ---

# -----| Views_Path() | -----
function views_path($path) {
  return "../app/views/".$path.".view.php";
}
# ---| ./Views_Path()\. | ---

# -----| Controllers_Path() | -----
function controllers_path($path) {
  return ROOT."/../app/controllers/".ucfirst($path).".php";
}
# ---| ./Controllers_Path()\. | ---

# -----| Get_UserID() | -----
function get_uid($id = null) {
  $user = new \Model\User();
  return $user->first(['id'=>$id]);
}
# ---| ./Get_UserID()\. | ---

# -----| Get_Categories() | -----
function get_categories($id = null) {
  $category = new \Model\Category();

  if ($id) {
    # ...| TRUE Block
    $category->order = 'asc';
    $category->limit = 1;
    return $category->where(['disabled'=>0,'id'=>$id]);
  } else {
    # ...| FALSE Block
    $category->order = 'desc';
    $category->limit = 100;
    return $category->where(['disabled'=>0]);
  }
  # ---| ./IF/ELSE(ID)
}
# ---| ./Get_Categories()\. | ---

# -----| USER_Can() -|PERMISSIONS|- | -----
function user_can(string $permission):bool {
  # Properties  ---------------
  $role = \Model\Auth::getRole();
  # ------------|  ./Properties

  if (\Model\Auth::is_admin()) {
    # ...| TRUE Block
    return true;
  }
  # ---| ./IF(ROLE)

  // return true;
  $permission = strtolower($permission);

  $db = new \Database();
  if (\Model\Auth::logged_in()) {
    # ...| TRUE Block
    $query = "select permission from permissions_map where disabled = 0 && role_id = :role";
    $myroles = $db->query($query,['role'=>$role]);

    if ($myroles) {
      # ...| TRUE Block
      $myroles = array_column($myroles, 'permission');
    } else {
      # ...| FALSE Block
      $myroles = [];
    }
    # ---| ./IF/ELSE(MyROLES)

    if (in_array($permission, $myroles)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ROLE)
  }
  # ---| ./IF(LoggedIn())

  return false;
}
# ---| ./USER_Can() -|PERMISSIONS|-\. | ---

# -----| Generate_SLUG() | -----
function generate_slug($str) {
  $str = str_replace("'", "", $str); /* |Removing any 'Single Quout'| */
  $str = preg_replace("/[^a-zA-Z0-9\-]+/", "-", $str); /* ||Replacing every Charactors that is not a letter or a number with a 'dash -' */
  $str = trim($str, "-"); /* |Removing any '-' From Beggining or End of STRING| */
  $str = strtolower($str);

  return $str;
}
# ---| ./Generate_SLUG()\. | ---

# -----| TEMPORARY | -----
/**
 * These Lines are to AUTOMATICALLY Create SLUGS in the Table Using a Table Column
 * *
 * Place the code at the bottom of the INIT.PHP Script sheet and Refresh the main page
 */
// $course = new \Model\Course();
// $rows = $course->query("select * from courses");

// foreach ($rows as $key => $row) {
//   $slug = generate_slug($row->title);

//   $course->query("update courses set slug = :slug where id = :id limit 1",['id'=>$row->id,'slug'=>$slug]);
// } # ---| ./FOREACH(ROWS)
# ---| ./TEMPORARY\. | ---

# -----| ActiveNav | -----
function active_nav($page = null) {
  $target = str_replace('url=','',$_SERVER['QUERY_STRING']);
  if ($target == $page) {
    # ...| TRUE Block
    echo 'active';
  }
  # ---| ./IF(Target)
}
# ---| ./ActiveNav\. | ---


# -----| Show_Role() | -----
function show_role($role = null) {
  if ($role == 1) {
    # ... Student Block
    echo 'secondary';
  } elseif ($role == 2) {
    # ... Teacher Block
    echo 'success';
  } elseif ($role == 3) {
    # ... Admin Block
    echo 'primary';
  } else {
    # ... FALSE Block
    echo 'danger';
  }
  # ---| ./IF/ELSE(Role)
}
# ---| ./Show_Role()\. | ---

# -----| SHOW_DETAILS() | -----
function show_details($detail = null) {
  if (!empty($detail)) {
    # ...| TRUE Block
    echo ucfirst($detail);
  } else {
    # ...| FALSE Block
    echo 'Nothing to show';
  }
}
# ---| ./SHOW_DETAILS()\. | ---

# -----|  | -----
# ---| ./\. | ---

