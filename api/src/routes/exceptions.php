<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get Class Exceptions
$app->get('/exceptions/{classid}', function (Request $request, Response $response) {
    $classid = $request->getAttribute('classid');

    $sql = "SELECT 
            exception_id, teacher_id, room_id, e.exception_type_id, exception_date, message,
            e.type 
        FROM class_exception_tbl ce
        INNER JOIN exception_type_tbl e ON e.exception_type_id = ce.exception_type_id
        WHERE class_id = $classid
        AND exception_date > now()";

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

