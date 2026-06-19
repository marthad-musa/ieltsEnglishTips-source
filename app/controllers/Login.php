<?php

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

use \Model\Auth;
use \Model\User;

/**
 * Login()
 * *
 * The Login Page
 */
class Login extends Controller {
  # -----| Index() | -----
  public function index() {
    # Properties  ---------------
    $data['errors'] = [];
    $user = new User();
    # ------------|  ./Properties
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      # ...| TRUE Block - VALIDATE
      $row = $user->first([
        'email'=>$_POST['email'],
      ]);

      if ($row) {
        # ...| TRUE Block
        if (password_verify($_POST['password'], $row->password)) {
          # ...| TRUE Block -----| Get User ROLE Name |-----
          $query = "select role from roles where id = :id limit 1";
          $id = $row->role;

          $role = $user->query($query,['id'=>$id]);
          if ($role) {
            # ...| TRUE Block
            $row->role_name = $role[0]->role;
          } else {
            # ...| FALSE Block
            $row->role_name = '';
          }
          # ---| ./IF/ELSE(Role)

          # -----| AUTHENTICATE |-----
          Auth::authenticate($row);
          // if ($row->role == 1) {
          //   # ...| USER/STUDENT Block
          //   message("Login seccessful!");
          //   redirect('user/dashboard');
          // } else if ($row->role == 2 || $row->role == 3 || $row->role == 4) {
          //   # ...| ADMIN/MGR/INSTRUCTOR Block
            message("Login seccessful!");
            redirect('admin/dashboard');
          // } else if ($row->role == '') {
          //   # ...| Unknown Block
          //   message("Something went wrong!");
          //   redirect('logout');
          // }
          // # ---| ./IF/ELSE/IF(Role Name)          
        }
        # ---| ./IF(Password)
      }
      # ---| ./IF($Row)

      $data['errors']['email'] = "Wrong E-mail or Password!";
    }
    # ---| ./IF(POST)
    
    $data['title'] = "Login";

    $this->view('auth/login',$data);
  }
  # ---| ./Index()\. | ---
}
# -----| ./Login()
