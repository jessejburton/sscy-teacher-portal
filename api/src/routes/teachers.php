<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get All Teachers
$app->get('/teachers', function (Request $request, Response $response) {

    $sql = "SELECT 
            teacher_id, bio, CONCAT(a.name_first, ' ', a.name_last) AS name, a.email, a.account_id
        FROM room_tbl r
        INNER JOIN account_tbl a ON a.account_id = r.account_id
        WHERE is_active = 1";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $class = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($class);

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

