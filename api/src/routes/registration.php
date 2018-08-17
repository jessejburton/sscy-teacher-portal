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
                r.registration_id, r.date_added, r.checked_in, r.paid, r.is_ky, r.is_pr,
                r.email, r.name_first, r.name_last
            FROM registration_tbl r
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

// Add Registrant
$app->put('/registration/add', function (Request $request, Response $response) {

    $name_first = $request->getParam('name_first');
    $name_last = $request->getParam('name_last');
    $email = $request->getParam('email');
    $is_pr = +$request->getParam('is_pr');
    $is_ky = +$request->getParam('is_ky');
    $checked_in = +$request->getParam('checked_in');
    $paid = $request->getParam('paid');
    $registration_date = $request->getParam('registration_date');
    $class_id = $request->getParam('class_id');

    // Add the Registration
    $sql =  "INSERT INTO registration_tbl (name_first, name_last, email, is_pr, is_ky, paid, date_class, class_id, checked_in) 
             VALUES (:name_first, :name_last, :email, :is_pr, :is_ky, :paid, :registration_date, :class_id, :checked_in)";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        // Handle Class Insert
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':name_first', $name_first);
        $stmt->bindParam(':name_last', $name_last);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':is_pr', $is_pr);
        $stmt->bindParam(':is_ky', $is_ky);
        $stmt->bindParam(':paid', $paid);
        $stmt->bindParam(':checked_in', $checked_in);
        $stmt->bindParam(':registration_date', $registration_date);
        $stmt->bindParam(':class_id', $class_id);

        $stmt->execute();
        $registration_id = $db->lastInsertId();

        // return message
        echo '{"success": true, "type": "success","text": "Registration has been added.","registration_id":' . $registration_id . '}';

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Update Registration
$app->put('/registration/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $is_ky = +$request->getParam('is_ky');
    $is_pr = +$request->getParam('is_pr');
    $checked_in = +$request->getParam('checked_in');
    $paid = $request->getParam('paid'); 

    // Update the class table
    $sql =  "UPDATE registration_tbl SET
                is_ky = :is_ky,
                is_pr = :is_pr,
                checked_in = :checked_in,
                paid = :paid 
            WHERE registration_id = $id";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        // Handle Class Update
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':is_ky', $is_ky);
        $stmt->bindParam(':is_pr', $is_pr);
        $stmt->bindParam(':checked_in', $checked_in);
        $stmt->bindParam(':paid', $paid);

        $stmt->execute();

        // return message
        echo '{"success": true, "type": "success","text": "Registration has been saved."}';

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});