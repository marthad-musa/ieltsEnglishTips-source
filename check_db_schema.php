<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ieltsenglishtips_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
    echo "TABLES:\n";
    foreach ($tables as $table) {
        echo "- $table\n";
    }
    $targets = ['courses','courses_meta','courses_lectures','exam','enrollments'];
    foreach ($targets as $target) {
        echo "\nCREATE TABLE $target:\n";
        $stmt = $pdo->query("SHOW CREATE TABLE `$target`");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            echo $row['Create Table'] . "\n";
        } else {
            echo "(table not found)\n";
        }
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
    exit(1);
}
