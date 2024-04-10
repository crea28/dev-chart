<?php
    // Database connection
    include_once 'credentials.php';

    // Get datas from form
    $query = $pdo->query("SELECT name FROM devchart_films where validation=0");
    $films = $query->fetchAll(PDO::FETCH_COLUMN);

    // JSON Format
    echo json_encode($films);

    // Close Database connection
    $pdo = null;
?>
