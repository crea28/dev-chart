<?php
    // Database connection
    include_once 'credentials.php';

    // Get datas from form
    $query = $pdo->query("SELECT name FROM devchart_developers WHERE validation = 0");
    $developers = $query->fetchAll(PDO::FETCH_COLUMN);

    // JASON "The greek" Format
    echo json_encode($developers);

    // Close Database connection
    $pdo = null;
?>
