<?php

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Signup()
 * *
 * The Signup Page
 */
class Signup extends Controller {
  # -----| Index() | -----
  public function index() {
    # Properties  ---------------
    $data['errors'] = [];
    $user = new \Model\User();
    # ------------|  ./Properties

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      # ...| TRUE Block
      if ($user->validate($_POST)) {
        # ...| TRUE Block
        $_POST['date'] = date("Y-m-d H:i:s");
        // $_POST['role'] = 2; /*2=>Admin | 1=>user*/
        $_POST['role'] = 1;
        $_POST['image'] = "uploads/images/noimage.jpg";
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user->insert($_POST);

        message("Your profile was seccessfully created! Please, login.");
        redirect('login');
      }
      # ---| ./IF(VALIDATE)
    }
    # ---| ./IF(POST)

    /**
     * Show FORM INPUTS
     */
    // show($_POST);

    $data['errors'] = $user->errors;
    $data['title'] = "Signup";

    $this->view('auth/signup',$data);
  }
  # ---| ./Index()\. | ---
}
# -----| ./Signup()
