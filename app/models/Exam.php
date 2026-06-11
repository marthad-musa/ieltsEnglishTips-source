<?php
class Exam {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Get Exam by ID
    public function getExamById($id) {
        $this->db->query('SELECT * FROM exams WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get Questions for an Exam
    public function getQuestionsByExamId($exam_id) {
        $this->db->query('SELECT * FROM questions WHERE exam_id = :exam_id');
        $this->db->bind(':exam_id', $exam_id);
        $questions = $this->db->resultSet();

        foreach($questions as $question) {
            $question->options = $this->getOptionsByQuestionId($question->id);
        }

        return $questions;
    }

    // Get Options for a Question
    public function getOptionsByQuestionId($question_id) {
        $this->db->query('SELECT * FROM options WHERE question_id = :question_id');
        $this->db->bind(':question_id', $question_id);
        return $this->db->resultSet();
    }

    // Save Exam Result
    public function saveResult($data) {
        $this->db->query('INSERT INTO results (student_id, exam_id, score, total_points) VALUES (:student_id, :exam_id, :score, :total_points)');
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':exam_id', $data['exam_id']);
        $this->db->bind(':score', $data['score']);
        $this->db->bind(':total_points', $data['total_points']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get Results for Announcement
    public function getLatestResults() {
        $this->db->query('SELECT results.*, users.full_name, exams.title as exam_title FROM results JOIN users ON results.student_id = users.id JOIN exams ON results.exam_id = exams.id ORDER BY results.taken_at DESC LIMIT 10');
        return $this->db->resultSet();
    }
}
