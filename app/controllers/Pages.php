<?php
class Pages extends Controller {
    public function __construct() {
        
    }

    public function index() {
        $data = [
            'title' => 'IELTS English Tips',
            'description' => 'Your Path to IELTS Success Starts Here'
        ];

        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'About Us'
        ];

        $this->view('pages/about', $data);
    }

    public function contact() {
        $data = [
            'title' => 'Contact Us'
        ];

        $this->view('pages/contact', $data);
    }
}
