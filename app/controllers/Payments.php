<?php
class Payments extends Controller {
    public function __construct() {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->enrollmentModel = $this->model('Enrollment');
        $this->courseModel = $this->model('Course');
    }

    public function window($course_id = null) {
        $course = null;
        if ($course_id) {
            $course = $this->courseModel->getCourseById($course_id);
        }

        $data = [
            'course' => $course,
            'title' => 'Payment Window'
        ];

        $this->view('payments/window', $data);
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $course_id = $_POST['course_id'];
            $course = $this->courseModel->getCourseById($course_id);

            // Mock payment processing
            $transaction_id = 'TRANS_' . uniqid();
            
            // 1. Create enrollment as pending
            $enrollmentData = [
                'student_id' => $_SESSION['user_id'],
                'course_id' => $course_id,
                'status' => 'pending'
            ];
            $enrollment_id = $this->enrollmentModel->enroll($enrollmentData);

            if ($enrollment_id) {
                // 2. Save payment and activate enrollment
                $paymentData = [
                    'user_id' => $_SESSION['user_id'],
                    'enrollment_id' => $enrollment_id,
                    'amount' => $course->price,
                    'currency' => 'EGP',
                    'gateway' => $_POST['gateway'],
                    'transaction_id' => $transaction_id,
                    'status' => 'completed'
                ];

                if ($this->enrollmentModel->processPayment($paymentData)) {
                    flash('payment_success', 'Payment successful! You are now enrolled.');
                    redirect('dashboard');
                } else {
                    die('Payment failed');
                }
            } else {
                die('Enrollment failed');
            }
        }
    }
}
