<?php
    // Database connection
    include_once 'credentials.php';

    // Get datas from form
    $film = $_POST['film'];
    $developer = $_POST['developer'];
    $iso = $_POST['iso'];
    $time = $_POST['time'];
    $dilution = $_POST['dilution'];

    // Query : Get the Dilution ID
    $queryDilution = $pdo->prepare("SELECT id FROM devchart_dilution WHERE value = :dilution");
    $queryDilution->bindParam(':dilution', $dilution, PDO::PARAM_STR);
    $queryDilution->execute();
    $dilutionId = $queryDilution->fetchColumn();

    // Query : Get all the informations needed
    $query = $pdo->prepare("INSERT INTO devchart_development_times (film_id, iso_id, developer_id, time, dilution_id)
                            VALUES ((SELECT id FROM devchart_films WHERE name = :film),
                                    (SELECT id FROM devchart_iso_values WHERE value = :iso),
                                    (SELECT id FROM devchart_developers WHERE name = :developer),
                                    :time,
                                    :dilutionId)");

    // Bind parameters
    $query->bindParam(':film', $film, PDO::PARAM_STR);
    $query->bindParam(':iso', $iso, PDO::PARAM_INT);
    $query->bindParam(':developer', $developer, PDO::PARAM_STR);
    $query->bindParam(':time', $time, PDO::PARAM_STR);
    $query->bindParam(':dilutionId', $dilutionId, PDO::PARAM_INT);

    // Query execution
    if ($query->execute()) {
        $response = ["success" => true];
    } else {
        $response = ["success" => false];
    }
    // Return JSON response format
    echo json_encode($response);

    // Close Database connection
    $pdo = null;
?>
