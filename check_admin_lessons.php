<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ieltsenglishtips_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "--- course_enroll sample ---\n";
    $rows = $pdo->query('SELECT ce.course_enroll_id, ce.user_id, ce.course_id, c.title FROM course_enroll ce LEFT JOIN courses c ON ce.course_id = c.id LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
    if (!$rows) {
        echo "No enrollments found.\n";
    } else {
        foreach ($rows as $row) {
            echo json_encode($row) . "\n";
        }
    }

    echo "\n--- lecture sections sample ---\n";
    $rows = $pdo->query('SELECT DISTINCT cm.unid, cm.course_id, c.title AS course_title FROM courses_meta cm LEFT JOIN courses c ON cm.course_id = c.id WHERE cm.disabled = 0 ORDER BY c.title ASC LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
    if (!$rows) {
        echo "No lecture sections found.\n";
    } else {
        foreach ($rows as $row) {
            echo json_encode($row) . "\n";
        }
    }

    echo "\n--- lecture rows sample ---\n";
    $rows = $pdo->query('SELECT cl.id, cl.unid, cl.title, cl.description, cl.file, cm.course_id FROM courses_lectures cl LEFT JOIN courses_meta cm ON cl.unid = cm.unid GROUP BY cl.id ORDER BY cl.id DESC LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
    if (!$rows) {
        echo "No lecture rows found.\n";
    } else {
        foreach ($rows as $row) {
            echo json_encode($row) . "\n";
        }
    }

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
    exit(1);
}
