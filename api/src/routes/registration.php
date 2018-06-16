<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get upcoming classes with registrations by teacher ID
$app->get('/registration/classes/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $sql = "SELECT 
                c.class_id, c.name, r.date_class, COUNT(r.registration_id) as registrants
            FROM class_tbl c 
            INNER JOIN registration_tbl r ON r.class_id = c.class_id
            INNER JOIN class_weekly_schedule_tbl cws ON cws.class_id = c.class_id
            WHERE c.teacher_id = (SELECT teacher_id FROM teacher_tbl WHERE account_id = $id)
            AND date_class > now()
            GROUP BY c.class_id, r.date_class";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $classes = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        // Change this in to an array of label and value for use with ng-options
        $return_arr = [];

        foreach($classes as $c){
            $label_str = date("l, F j, Y", strtotime($c->date_class)) . " (" . $c->registrants . ")";
            $value_str = $c->class_id . "/" . $c->date_class;

            $class = (object) ['label' => $label_str, 'value' => $value_str]; ;
            
            array_push($return_arr, $class);
        };

        echo json_encode($return_arr);

    } catch(PDOException $e) {
        echo '{"type": "danger","text": "'.$e->getMessage().'"}';
    }
});

// Get all registrants for a class by id and date
$app->get('/registration/{class_id}/{class_date}', function (Request $request, Response $response) {
    $class_id = $request->getAttribute('class_id');
    $class_date = $request->getAttribute('class_date');

    $sql = "SELECT 
                registration_id, r.date_added, r.checked_in, r.paid, r.is_ky, r.is_pr,
                a.email, a.name_first, a.name_last
            FROM registration_tbl r
            INNER JOIN account_tbl a ON a.account_id = r.account_id
            WHERE date_class = '$class_date'
            AND class_id = $class_id";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $registrants = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($registrants);

    } catch(PDOException $e) {
        echo '{"type": "danger","text": "'.$e->getMessage().'"}';
    }
});
