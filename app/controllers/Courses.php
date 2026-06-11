<?php
class Courses extends Controller {
    public function __construct() {
        $this->courseModel = $this->model('Course');
    }

    public function index() {
        $courses = $this->courseModel->getCourses();
        $data = [
            'title' => 'Courses',
            'courses' => $courses
        ];
        $this->view('courses/index', $data);
    }

    public function show($id) {
        $course = $this->courseModel->getCourseById($id);
        $sections = $this->courseModel->getSectionsByCourseId($id);
        
        foreach($sections as $section) {
            $section->lessons = $this->courseModel->getLessonsBySectionId($section->id);
        }

        $data = [
            'title' => $course->title,
            'course' => $course,
            'sections' => $sections
        ];

        $this->view('courses/show', $data);
    }

    // AJAX endpoint for courses
    public function get_courses_ajax() {
        $courses = $this->courseModel->getCourses();
        echo json_encode($courses);
    }
}
