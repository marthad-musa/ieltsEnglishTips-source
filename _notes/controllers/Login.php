<?php

# SECURITY CHECK  ---------------
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Login()
 * *
 * The Login Page
 */
class Login extends Controller {
  # -----| Index() | -----
  public function index() {
    # Check if POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->login_user();
      return;
    }
    # ---| ./IF(POST)

    $data['title'] = "Login";
    $this->view('auth/login',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Login_user() | -----
  private function login_user() {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    # Validate inputs
    if (empty($email) || empty($password)) {
      $_SESSION['errors']['login'] = "Email and password are required!";
      redirect('login');
      return;
    }
    # ---| ./IF(empty)

    # Query database for user
    $user = new \Model\User();
    $row = $user->where(['email' => $email]);

    # Check if user exists and password matches
    if (!empty($row)) {
      $user_data = $row[0] ?? null;
      if ($user_data && password_verify($password, $user_data->password)) {
        # Authenticate user
        \Model\Auth::authenticate($user_data);
        redirect('admin');
      } else {
        $_SESSION['errors']['login'] = "Invalid email or password!";
        redirect('login');
      }
    } else {
      $_SESSION['errors']['login'] = "Invalid email or password!";
      redirect('login');
    }
    # ---| ./IF(user exists)
  }
  # ---| ./Login_user()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Login Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Login()
