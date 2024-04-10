<?php
    // Database connection
    include_once 'credentials.php';

    // Get datas from form
    $query = $pdo->query("SELECT value FROM devchart_iso_values");
    $isoValues = $query->fetchAll(PDO::FETCH_COLUMN);

    // JSON format
    echo json_encode($isoValues);

    // Close Database connection
    $pdo = null;
?>
