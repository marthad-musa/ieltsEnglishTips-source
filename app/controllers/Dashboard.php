<?php
class Dashboard extends Controller {
    public function __construct() {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->courseModel = $this->model('Course');
        $this->userModel = $this->model('User');
        $this->examModel = $this->model('Exam');
        $this->reportModel = $this->model('Report');
    }

    public function index() {
        $role = $_SESSION['user_role'];
        
        switch ($role) {
            case 'owner':
                $this->ownerDashboard();
                break;
            case 'admin':
                $this->adminDashboard();
                break;
            case 'teacher':
                $this->teacherDashboard();
                break;
            default:
                $this->studentDashboard();
                break;
        }
    }

    private function ownerDashboard() {
        $data = [
            'title' => 'Owner Dashboard',
            'total_users' => $this->reportModel->getTotalUsers(),
            'total_revenue' => $this->reportModel->getTotalRevenue(),
            'latest_payments' => $this->reportModel->getLatestPayments(),
            'traffic_report' => $this->reportModel->getTrafficStats()
        ];
        $this->view('dashboard/owner', $data);
    }

    private function adminDashboard() {
        $data = [
            'title' => 'Admin Dashboard',
            'pending_enrollments' => $this->reportModel->getPendingEnrollments(),
            'recent_results' => $this->examModel->getLatestResults()
        ];
        $this->view('dashboard/admin', $data);
    }

    private function teacherDashboard() {
        $data = [
            'title' => 'Teacher Dashboard',
            'my_courses' => $this->reportModel->getCoursesByTeacher($_SESSION['user_id']),
            'student_performance' => $this->reportModel->getStudentPerformanceReport()
        ];
        $this->view('dashboard/teacher', $data);
    }

    private function studentDashboard() {
        $data = [
            'title' => 'Student Dashboard',
            'my_enrollments' => $this->reportModel->getStudentEnrollments($_SESSION['user_id']),
            'my_results' => $this->reportModel->getResultsByStudent($_SESSION['user_id'])
        ];
        $this->view('dashboard/student', $data);
    }
}
