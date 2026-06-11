<?php
class Language {
    private static $lang_data = [
        'en' => [
            'welcome' => 'Welcome to IELTS English Tips',
            'home' => 'Home',
            'about' => 'About',
            'courses' => 'Courses'
        ],
        'ar' => [
            'welcome' => 'مرحباً بكم في نصائح آيلتس الإنجليزية',
            'home' => 'الرئيسية',
            'about' => 'من نحن',
            'courses' => 'الدورات'
        ]
    ];

    public static function get($key) {
        $lang = $_SESSION['lang'] ?? 'en';
        return self::$lang_data[$lang][$key] ?? $key;
    }

    public static function set($lang) {
        $_SESSION['lang'] = $lang;
    }
}
