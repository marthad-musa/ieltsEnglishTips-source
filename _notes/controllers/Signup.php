<?php

# SECURITY CHECK  ---------------
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
    # Check if POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->create_user();
      return;
    }
    # ---| ./IF(POST)

    $data['title'] = "Signup";
    $this->view('auth/signup',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Create_user() | -----
  private function create_user() {
    $user = new \Model\User();

    # Prepare data
    $data = [
      'firstname' => $_POST['firstname'] ?? '',
      'lastname' => $_POST['lastname'] ?? '',
      'email' => $_POST['email'] ?? '',
      'username' => $_POST['username'] ?? '',
      'password' => $_POST['password'] ?? '',
      'language' => $_POST['language'] ?? 'en_US',
    ];

    # Validate using User model
    if (!$user->validate($data)) {
      $_SESSION['errors'] = $user->errors;
      redirect('signup');
      return;
    }
    # ---| ./IF(validation fails)

    # Hash password
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $data['role'] = 'user';
    $data['date'] = date('Y-m-d H:i:s');

    # Insert user
    $user->insert($data);

    # Get the newly created user and authenticate
    $new_user = $user->where(['email' => $data['email']]);
    if (!empty($new_user)) {
      \Model\Auth::authenticate($new_user[0]);
      redirect('admin');
    } else {
      $_SESSION['errors']['signup'] = "Account created but login failed. Please try logging in.";
      redirect('login');
    }
    # ---| ./IF(user created)
  }
  # ---| ./Create_user()\. | ---

  # -----| Constructor |-----
  // function __construct() {
  //   echo "Signup Page";
  // }
  # ---| ./Constructor\. |---
}
# -----| ./Signup()
