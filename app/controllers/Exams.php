<?php
class Exams extends Controller {
    public function __construct() {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->examModel = $this->model('Exam');
    }

    public function take($id) {
        $exam = $this->examModel->getExamById($id);
        $questions = $this->examModel->getQuestionsByExamId($id);

        $data = [
            'exam' => $exam,
            'questions' => $questions
        ];

        $this->view('exams/take', $data);
    }

    public function submit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $questions = $this->examModel->getQuestionsByExamId($id);
            $score = 0;
            $total_points = 0;

            foreach($questions as $question) {
                $total_points += $question->points;
                $answer_id = $_POST['question_' . $question->id] ?? null;
                
                if ($answer_id) {
                    $options = $question->options;
                    foreach($options as $option) {
                        if ($option->id == $answer_id && $option->is_correct) {
                            $score += $question->points;
                        }
                    }
                }
            }

            $resultData = [
                'student_id' => $_SESSION['user_id'],
                'exam_id' => $id,
                'score' => $score,
                'total_points' => $total_points
            ];

            if ($this->examModel->saveResult($resultData)) {
                flash('exam_message', 'Exam submitted successfully. Your score: ' . $score . '/' . $total_points);
                redirect('dashboard');
            } else {
                die('Something went wrong');
            }
        }
    }
}
