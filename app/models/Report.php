<?php
class Report {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getTotalUsers() {
        $this->db->query('SELECT COUNT(*) as count FROM users');
        return $this->db->single()->count;
    }

    public function getTotalRevenue() {
        $this->db->query('SELECT SUM(amount) as total FROM payments WHERE status = "completed"');
        return $this->db->single()->total ?? 0;
    }

    public function getLatestPayments() {
        $this->db->query('SELECT payments.*, users.full_name FROM payments JOIN users ON payments.user_id = users.id ORDER BY created_at DESC LIMIT 5');
        return $this->db->resultSet();
    }

    public function getTrafficStats() {
        $this->db->query('SELECT COUNT(*) as count, DATE(created_at) as date FROM logs GROUP BY DATE(created_at) ORDER BY date DESC LIMIT 7');
        return $this->db->resultSet();
    }

    public function getPendingEnrollments() {
        $this->db->query('SELECT enrollments.*, users.full_name, courses.title FROM enrollments JOIN users ON enrollments.student_id = users.id JOIN courses ON enrollments.course_id = courses.id WHERE enrollments.status = "pending"');
        return $this->db->resultSet();
    }

    public function getCoursesByTeacher($teacher_id) {
        $this->db->query('SELECT * FROM courses WHERE teacher_id = :teacher_id');
        $this->db->bind(':teacher_id', $teacher_id);
        return $this->db->resultSet();
    }

    public function getStudentPerformanceReport() {
        $this->db->query('SELECT results.*, users.full_name, exams.title FROM results JOIN users ON results.student_id = users.id JOIN exams ON results.exam_id = exams.id ORDER BY results.taken_at DESC');
        return $this->db->resultSet();
    }

    public function getStudentEnrollments($student_id) {
        $this->db->query('SELECT enrollments.*, courses.title FROM enrollments JOIN courses ON enrollments.course_id = courses.id WHERE student_id = :student_id');
        $this->db->bind(':student_id', $student_id);
        return $this->db->resultSet();
    }

    public function getResultsByStudent($student_id) {
        $this->db->query('SELECT results.*, exams.title FROM results JOIN exams ON results.exam_id = exams.id WHERE student_id = :student_id');
        $this->db->bind(':student_id', $student_id);
        return $this->db->resultSet();
    }

    // Logging function
    public function logAction($user_id, $action, $details = null) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->db->query('INSERT INTO logs (user_id, action, details, ip_address) VALUES (:user_id, :action, :details, :ip)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':action', $action);
        $this->db->bind(':details', $details);
        $this->db->bind(':ip', $ip);
        $this->db->execute();
    }
}
