<?php
    // Database connection
    include_once 'credentials.php';

    // Get Data from form
    $film = $_POST['film'];
    $developer = $_POST['developer'];

    // Query : Get all dev time
    $query = $pdo->prepare("SELECT dt.time, dilution.value AS dilution
                            FROM devchart_development_times dt
                            INNER JOIN devchart_films f ON dt.film_id = f.id
                            INNER JOIN devchart_developers d ON dt.developer_id = d.id
                            LEFT JOIN devchart_dilution dilution ON dt.dilution_id = dilution.id
                            WHERE f.name = :film
                            AND d.name = :developer");

    // Bind parameters
    $query->bindParam(':film', $film, PDO::PARAM_STR);
    $query->bindParam(':developer', $developer, PDO::PARAM_STR);

    // Query : execution
    if ($query->execute()) {
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            $response = ["results" => $results];
        } else {
            $response = ["error" => "Aucun résultat trouvé"];
        }
    } else {
        $response = ["error" => "Erreur lors de la requête SQL"];
    }

    // JSON Format
    echo json_encode($response);

    // Close Database connection
    $pdo = null;
?>