<?php
    // Database connection
    include_once 'credentials.php';

    // Get datas from form
    $query = $pdo->query("SELECT value FROM devchart_dilution");
    $dilutions = $query->fetchAll(PDO::FETCH_COLUMN);

    // JSON Format
    echo json_encode($dilutions);

    // Close Database connection
    $pdo = null;
?>