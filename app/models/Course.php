<?php
class Course {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Get all published courses
    public function getCourses() {
        $this->db->query('SELECT courses.*, users.full_name as teacher_name FROM courses JOIN users ON courses.teacher_id = users.id WHERE courses.status = "published" ORDER BY courses.created_at DESC');
        return $this->db->resultSet();
    }

    // Get course by ID
    public function getCourseById($id) {
        $this->db->query('SELECT courses.*, users.full_name as teacher_name FROM courses JOIN users ON courses.teacher_id = users.id WHERE courses.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get sections by course ID
    public function getSectionsByCourseId($course_id) {
        $this->db->query('SELECT * FROM sections WHERE course_id = :course_id ORDER BY sort_order ASC');
        $this->db->bind(':course_id', $course_id);
        return $this->db->resultSet();
    }

    // Get lessons by section ID
    public function getLessonsBySectionId($section_id) {
        $this->db->query('SELECT * FROM lessons WHERE section_id = :section_id ORDER BY sort_order ASC');
        $this->db->bind(':section_id', $section_id);
        return $this->db->resultSet();
    }

    // Add Course
    public function addCourse($data) {
        $this->db->query('INSERT INTO courses (title, description, category, price, thumbnail, teacher_id, status) VALUES (:title, :description, :category, :price, :thumbnail, :teacher_id, :status)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':thumbnail', $data['thumbnail']);
        $this->db->bind(':teacher_id', $data['teacher_id']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Update Course
    public function updateCourse($data) {
        $this->db->query('UPDATE courses SET title = :title, description = :description, category = :category, price = :price, thumbnail = :thumbnail, status = :status WHERE id = :id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':thumbnail', $data['thumbnail']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    // Add Section
    public function addSection($data) {
        $this->db->query('INSERT INTO sections (course_id, title, sort_order) VALUES (:course_id, :title, :sort_order)');
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':sort_order', $data['sort_order']);
        return $this->db->execute();
    }

    // Add Lesson
    public function addLesson($data) {
        $this->db->query('INSERT INTO lessons (section_id, title, video_url, pdf_file, audio_file, content, sort_order) VALUES (:section_id, :title, :video_url, :pdf_file, :audio_file, :content, :sort_order)');
        $this->db->bind(':section_id', $data['section_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':video_url', $data['video_url']);
        $this->db->bind(':pdf_file', $data['pdf_file']);
        $this->db->bind(':audio_file', $data['audio_file']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':sort_order', $data['sort_order']);
        return $this->db->execute();
    }

    // Delete Course
    public function deleteCourse($id) {
        $this->db->query('DELETE FROM courses WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Get courses by teacher ID
    public function getCoursesByTeacher($teacher_id) {
        $this->db->query('SELECT * FROM courses WHERE teacher_id = :teacher_id');
        $this->db->bind(':teacher_id', $teacher_id);
        return $this->db->resultSet();
    }
}
