<?php
class Enrollment {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Enroll student in course
    public function enroll($data) {
        $this->db->query('INSERT INTO enrollments (student_id, course_id, status) VALUES (:student_id, :course_id, :status)');
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Check if enrolled
    public function isEnrolled($student_id, $course_id) {
        $this->db->query('SELECT * FROM enrollments WHERE student_id = :student_id AND course_id = :course_id AND status = "active"');
        $this->db->bind(':student_id', $student_id);
        $this->db->bind(':course_id', $course_id);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    // Process Payment
    public function processPayment($data) {
        $this->db->query('INSERT INTO payments (user_id, enrollment_id, amount, currency, gateway, transaction_id, status) VALUES (:user_id, :enrollment_id, :amount, :currency, :gateway, :transaction_id, :status)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':enrollment_id', $data['enrollment_id']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':currency', $data['currency']);
        $this->db->bind(':gateway', $data['gateway']);
        $this->db->bind(':transaction_id', $data['transaction_id']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            // Update enrollment status
            $this->db->query('UPDATE enrollments SET status = "active" WHERE id = :enrollment_id');
            $this->db->bind(':enrollment_id', $data['enrollment_id']);
            $this->db->execute();
            return true;
        } else {
            return false;
        }
    }
}
