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
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * App()
 * *
 * Every page view in the Project will be rerouted by this Class
 */
class App {
  # -----| PROPERTIES | -----
  protected $controller = '_404';
  public static $page = '_404';
  protected $method = 'index';
  # ---| ./PROPERTIES\. | ---

  # -----| CONSTRUCTOR | -----
  function __construct() {
    $arr = $this->getURL();

    // $filename = "../app/controllers/".ucfirst($arr[0]).".php";
    $filename = __DIR__ . '/../controllers/' . ucfirst($arr[0]) . '.php';
    if (file_exists($filename)) {
      # ...| TRUE Block
      require $filename;
      $this->controller = $arr[0];
      self::$page = $arr[0];
      unset($arr[0]);
    } else {
      # ...| FALSE Block
      // require "../app/controllers/".$this->controller.".php";
      require __DIR__ . '/../controllers/' . $this->controller . '.php';
    }
    # ---| ./IF/ELSE

    $mycontroller = new ("Controller\\".$this->controller)();
    $mymethod = $arr[1] ?? $this->method;
    $mymethod = str_replace("-", "_", $mymethod);

    if (!empty($arr[1])) {
      # ...| TRUE Block
      if (method_exists($mycontroller, strtolower($mymethod))) {
        # ...| TRUE Block
        $this->method = strtolower($mymethod);
        unset($arr[1]);
      }
      # ---| IF
    }
    # ---| IF

    $arr = array_values($arr);
    call_user_func_array([$mycontroller, $this->method], $arr);
  }
  # ---| ./CONSTRUCTOR\. | ---

  /**
   * GetURL()
   * *
   * This Method should focus solely on getting whatevere is written in the URL
   */
  private function getURL() {
    $url = $_GET['url'] ?? 'home';
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $arr = explode("/", $url);
    return $arr;
  }
  # ---| ./getURL()\. | ---
}
# -----| ./App()

