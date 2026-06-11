<?php
class ManageCourses extends Controller {
    public function __construct() {
        if (!isLoggedIn() || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'teacher' && $_SESSION['user_role'] != 'owner')) {
            redirect('users/login');
        }
        $this->courseModel = $this->model('Course');
    }

    public function index() {
        if ($_SESSION['user_role'] == 'teacher') {
            $courses = $this->courseModel->getCoursesByTeacher($_SESSION['user_id']);
        } else {
            $courses = $this->courseModel->getCourses();
        }

        $data = [
            'courses' => $courses
        ];

        $this->view('manage_courses/index', $data);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'category' => trim($_POST['category']),
                'price' => trim($_POST['price']),
                'teacher_id' => $_SESSION['user_id'],
                'status' => 'draft',
                'thumbnail' => '',
                'title_err' => '',
                'category_err' => '',
                'price_err' => ''
            ];

            // Validate
            if (empty($data['title'])) $data['title_err'] = 'Please enter title';
            if (empty($data['category'])) $data['category_err'] = 'Please enter category';
            if (empty($data['price'])) $data['price_err'] = 'Please enter price';

            if (empty($data['title_err']) && empty($data['category_err']) && empty($data['price_err'])) {
                if ($this->courseModel->addCourse($data)) {
                    flash('course_message', 'Course Added');
                    redirect('manage_courses');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('manage_courses/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'description' => '',
                'category' => '',
                'price' => '',
                'title_err' => '',
                'category_err' => '',
                'price_err' => ''
            ];

            $this->view('manage_courses/add', $data);
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'category' => trim($_POST['category']),
                'price' => trim($_POST['price']),
                'status' => $_POST['status'],
                'thumbnail' => '',
                'title_err' => '',
                'category_err' => '',
                'price_err' => ''
            ];

            // Validate
            if (empty($data['title'])) $data['title_err'] = 'Please enter title';
            if (empty($data['category'])) $data['category_err'] = 'Please enter category';
            if (empty($data['price'])) $data['price_err'] = 'Please enter price';

            if (empty($data['title_err']) && empty($data['category_err']) && empty($data['price_err'])) {
                if ($this->courseModel->updateCourse($data)) {
                    flash('course_message', 'Course Updated');
                    redirect('manage_courses');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('manage_courses/edit', $data);
            }
        } else {
            $course = $this->courseModel->getCourseById($id);

            // Check for owner
            if ($course->teacher_id != $_SESSION['user_id'] && $_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'owner') {
                redirect('manage_courses');
            }

            $data = [
                'id' => $id,
                'title' => $course->title,
                'description' => $course->description,
                'category' => $course->category,
                'price' => $course->price,
                'status' => $course->status,
                'title_err' => '',
                'category_err' => '',
                'price_err' => ''
            ];

            $this->view('manage_courses/edit', $data);
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $course = $this->courseModel->getCourseById($id);

            // Check for owner
            if ($course->teacher_id != $_SESSION['user_id'] && $_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'owner') {
                redirect('manage_courses');
            }

            if ($this->courseModel->deleteCourse($id)) {
                flash('course_message', 'Course Removed');
                redirect('manage_courses');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('manage_courses');
        }
    }
}
