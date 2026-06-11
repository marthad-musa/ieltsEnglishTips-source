<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'full_name' => trim($_POST['full_name']),
                'dob' => trim($_POST['dob']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role' => 'student',
                'token' => bin2hex(random_bytes(16)),
                'full_name_err' => '',
                'dob_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate Name
            if (empty($data['full_name'])) {
                $data['full_name_err'] = 'Please enter name';
            }

            // Validate DOB
            if (empty($data['dob'])) {
                $data['dob_err'] = 'Please enter date of birth';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['full_name_err']) && empty($data['dob_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated
                
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->register($data)) {
                    // Send Email Authentication (Simulated)
                    // In a real app, you'd use mail() or a library like PHPMailer
                    
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'full_name' => '',
                'dob' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'full_name_err' => '',
                'dob_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'title' => 'Register'
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
                'title' => 'Login'
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                // User not found
                $data['email_err'] = 'No user found';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }

        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
                'title' => 'Login'
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->full_name;
        $_SESSION['user_role'] = $user->role;
        $_SESSION['user_status'] = $user->status;
        
        // Check if profile is complete
        $profile = $this->userModel->getProfileByUserId($user->id);
        if (empty($profile->city)) {
            redirect('users/complete_profile');
        } else {
            redirect('dashboard');
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_status']);
        session_destroy();
        redirect('users/login');
    }

    public function complete_profile() {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'city' => trim($_POST['city']),
                'state' => trim($_POST['state']),
                'country' => trim($_POST['country']),
                'mobile' => trim($_POST['mobile']),
                'facebook' => trim($_POST['facebook']),
                'instagram' => trim($_POST['instagram']),
                'twitter' => trim($_POST['twitter']),
                'tiktok' => trim($_POST['tiktok']),
                'subject_to_teach' => isset($_POST['subject_to_teach']) ? trim($_POST['subject_to_teach']) : '',
                'city_err' => '',
                'state_err' => '',
                'country_err' => '',
                'mobile_err' => ''
            ];

            // Validate
            if (empty($data['city'])) $data['city_err'] = 'Please enter city';
            if (empty($data['state'])) $data['state_err'] = 'Please enter state';
            if (empty($data['country'])) $data['country_err'] = 'Please enter country';
            if (empty($data['mobile'])) $data['mobile_err'] = 'Please enter mobile';

            if (empty($data['city_err']) && empty($data['state_err']) && empty($data['country_err']) && empty($data['mobile_err'])) {
                if ($this->userModel->updateProfile($data)) {
                    flash('profile_message', 'Profile updated');
                    if ($_SESSION['user_role'] == 'student') {
                        redirect('payments/window');
                    } else {
                        redirect('dashboard');
                    }
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('users/complete_profile', $data);
            }

        } else {
            $profile = $this->userModel->getProfileByUserId($_SESSION['user_id']);
            $data = [
                'city' => $profile->city,
                'state' => $profile->state,
                'country' => $profile->country,
                'mobile' => $profile->mobile,
                'facebook' => $profile->facebook,
                'instagram' => $profile->instagram,
                'twitter' => $profile->twitter,
                'tiktok' => $profile->tiktok,
                'subject_to_teach' => $profile->subject_to_teach,
                'title' => 'Complete Profile'
            ];

            $this->view('users/complete_profile', $data);
        }
    }
}
