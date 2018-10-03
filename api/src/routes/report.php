<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get all registrants for a class by id and date
$app->get('/report/{year}/{month}/{teacher_id}', function (Request $request, Response $response) {
    $teacher_id = $request->getAttribute('teacher_id');
    $month = $request->getAttribute('month');
    $year = $request->getAttribute('year');

    $sql = "SELECT 
                ca.amount, c.name AS class_name, ca.date_class, COUNT(r.registration_id) AS registrants, rm.name AS room_name, rm.rate
            FROM class_amount_tbl ca
            INNER JOIN class_tbl c ON c.class_id = ca.class_id
            INNER JOIN registration_tbl r ON r.class_id = ca.class_id AND r.date_class = ca.date_class     
            INNER JOIN class_weekly_schedule_tbl cws ON c.class_id = cws.class_id 
            INNER JOIN room_tbl rm ON cws.room_id = rm.room_id
            WHERE   MONTH(ca.date_class) = $month
            AND     YEAR(ca.date_class) = $year
            AND     ca.class_id IN (SELECT class_id FROM class_tbl WHERE teacher_id = $teacher_id)
            GROUP BY ca.class_id, ca.date_class
            ORDER BY c.name";

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
