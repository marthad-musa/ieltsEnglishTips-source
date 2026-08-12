<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ieltsenglishtips_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query('SHOW CREATE TABLE course_enroll');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo $row['Create Table'];
    } else {
        echo 'Course_enroll table not found';
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    exit(1);
}
