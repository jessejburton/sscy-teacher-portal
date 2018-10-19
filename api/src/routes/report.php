<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get all registrants for a class by id and date
$app->get('/report/{year}/{month}/{teacher_id}', function (Request $request, Response $response) {
    $teacher_id = $request->getAttribute('teacher_id');
    $month = $request->getAttribute('month');
    $year = $request->getAttribute('year');

    $sql = "SELECT 
                c.name, r.class_id, r.date_class, COUNT(registration_id) AS registrants, rm.name AS room_name, rm.rate, ifNull((SELECT amount FROM class_amount_tbl ca WHERE ca.class_id = r.class_id AND ca.date_class = r.date_class),0) AS amount, IF((SELECT amount FROM class_amount_tbl ca WHERE ca.class_id = r.class_id AND ca.date_class = r.date_class) > 50, rm.rate, 0) AS charge, c.teacher_id
            FROM registration_tbl r 
            INNER JOIN class_tbl c ON c.class_id = r.class_id
            INNER JOIN room_tbl rm ON c.room_id = rm.room_id
            WHERE   MONTH(date_class) = $month
            AND     YEAR(date_class) = $year
            AND 	c.teacher_id = $teacher_id
            GROUP BY class_id, date_class";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($results);

    } catch(PDOException $e) {
        echo '{"type": "danger","text": "'.$e->getMessage().'"}';
    }
});
