<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get all classes
$app->get('/classes/{id}', function (Request $request, Response $response) use ($app) {
    $id = $request->getAttribute('id');

    // Make sure the person is logged in.
    if( !isset($_SESSION['user_id']) ){
        echo '{"type": "danger","text": "You muset be logged in to access this page."}';
        return;
    }

    $sql = "SELECT 
                c.class_id, c.name, c.description, cs.room_id, c.teacher_id, 
                cs.days_of_week AS days, cs.start_time, cs.end_time,
                cs.date_from, cs.date_until,
                t.teacher_id, t.account_id, t.default_price, t.waiver, 
                CONCAT(a.name_first, ' ', a.name_last) AS teacher_name, 
                r.name AS room_name, r.photo AS room_photo, r.description AS room_description
            FROM class_weekly_schedule_tbl cs 
            INNER JOIN class_tbl c ON c.class_id = cs.class_id
            INNER JOIN teacher_tbl t ON c.teacher_id = t.teacher_id 
            INNER JOIN account_tbl a ON t.account_id = a.account_id 
            INNER JOIN room_tbl r ON r.room_id = cs.room_id
            WHERE t.account_id = $id
            AND (cs.date_until IS NULL
            OR cs.date_until > NOW())
            ORDER BY days_of_week";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $records = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        // Loop through the classes and get the schedules and exceptions
        $return_arr = [];

        foreach($records as $record){
            
            // Make sure the record exists 
            if(!isset($return_arr[$record->name])){
                // Create the main object
                $return_arr[$record->name] = (object) [
                    'name'=> $record->name, 
                    'class_id' => $record->class_id, 
                    'description' => $record->description,
                    'date_from' => $record->date_from,
                    'date_until' => $record->date_until
                ];

                // Create the schedule and exception arrays
                $return_arr[$record->name]->schedules = [];
                $return_arr[$record->name]->exceptions = [];
            }

            // Schedules
            $schedule =  (object) [
                'room_id'=> $record->room_id, 
                'room_name' => $record->room_name,
                'start_time' => $record->start_time,
                'end_time' => $record->end_time,
                'teacher_id' => $record->teacher_id,
                'teacher' => $record->teacher_name,
                'days' => $record->days
            ];
            array_push($return_arr[$record->name]->schedules, $schedule);

            // Exceptions
            $sql2 = "SELECT 
                    exception_id, teacher_id, room_id, e.exception_type_id, exception_date as date, message,
                    e.type 
                FROM class_exception_tbl ce
                INNER JOIN exception_type_tbl e ON e.exception_type_id = ce.exception_type_id
                WHERE class_id = $record->class_id
                AND exception_date > NOW()";

            try {
                    
                // Get DB Object
                $db2 = new db();
                // Connect
                $db2 = $db2->connect();

                $stmt = $db2->query($sql2);
                $exceptions = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db2 = null;
                
                $return_arr[$record->name]->exceptions = $exceptions;

            } catch(PDOException $e) {
                echo '{"error": {"text": '.$e->getMessage().'}';
            }

        }

        echo json_encode($return_arr);

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Class
$app->get('/class/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $sql = "SELECT 
            c.class_id AS id, c.name, c.description, c.room_id, c.teacher_id, 
            cs.days_of_week AS days, cs.start_time, cs.end_time,
            t.teacher_id, t.account_id, t.default_price, t.waiver, 
            a.name_first, a.name_last, 
            r.name AS room_name, r.photo AS room_photo, r.description AS room_description
        FROM class_weekly_schedule_tbl cs 
        LEFT JOIN class_tbl c ON c.class_id = cs.class_id
        LEFT JOIN teacher_tbl t ON c.teacher_id = t.teacher_id 
        LEFT JOIN account_tbl a ON t.account_id = a.account_id 
        LEFT JOIN room_tbl r ON r.room_id = c.room_id
        WHERE c.class_id = $id";

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

// Get Classes on a Specific Day
$app->get('/class/date/{date}', function (Request $request, Response $response) {
    $date = $request->getAttribute('date');
    $day = date("w", strtotime($date));

    $sql = "SELECT 
            c.class_id, c.name, c.description, c.teacher_id, 
            cs.start_time, cs.end_time, cs.room_id,
            t.teacher_id, t.account_id, t.default_price, t.waiver, 
            a.name_first, a.name_last, 
            r.name AS room_name, r.photo AS room_photo, r.description AS room_description
        FROM class_weekly_schedule_tbl cs 
        INNER JOIN class_tbl c ON c.class_id = cs.class_id
        INNER JOIN teacher_tbl t ON c.teacher_id = t.teacher_id 
        INNER JOIN account_tbl a ON t.account_id = a.account_id 
        INNER JOIN room_tbl r ON r.room_id = cs.room_id
        WHERE cs.days_of_week = $day";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $classes = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($classes);

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Add Class
$app->put('/class/add', function (Request $request, Response $response) {

    $name = $request->getParam('name');
    $description = $request->getParam('description');
    $room_id = $request->getParam('room_id');
    $days_of_week = $request->getParam('day');
    $date_from = $request->getParam('date_from');
    $date_to = $request->getParam('date_to');
    $start_time = $request->getParam('start_time');
    $end_time = $request->getParam('end_time');
    $teacher_id = $request->getParam('teacher_id');

    // Check Dates
    if(strlen($date_from) == 0) $date_from = NULL;
    if(strlen($date_to) == 0) $date_to = NULL;

    // Add the Class
    $sql =  "INSERT INTO class_tbl (name, description, teacher_id) 
             VALUES (:name, :description, :teacher_id)";

    // Add the schedule
    $sql2 = "INSERT INTO class_weekly_schedule_tbl
                (
                    days_of_week,
                    room_id,
                    date_from,
                    date_until,
                    start_time,
                    end_time,
                    class_id
                ) VALUES (
                    :days_of_week,
                    :room_id,
                    :date_from,
                    :date_until,
                    :start_time,
                    :end_time,
                    :class_id
                )
            ";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        // Handle Class Insert
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':teacher_id', $teacher_id);

        $stmt->execute();
        $class_id = $db->lastInsertId();

        // Handle Schedule Insert
        $stmt = $db->prepare($sql2);

        $stmt->bindParam(':days_of_week', $days_of_week);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':date_from', $date_from, PDO::PARAM_STR);  // Need the PDO to handle NULLS
        $stmt->bindParam(':date_until', $date_to, PDO::PARAM_STR);      // Need the PDO to handle NULLS
        $stmt->bindParam(':start_time', $start_time);
        $stmt->bindParam(':end_time', $end_time);
        $stmt->bindParam(':class_id', $class_id);

        $stmt->execute();

        // return message
        echo '{"success": true, "type": "success","text": "Class has been added."}';

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Update Class
$app->put('/class/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $name = $request->getParam('name');
    $description = $request->getParam('description');
    $room_id = $request->getParam('room_id');
    $days_of_week = $request->getParam('day');
    $date_from = $request->getParam('date_from');
    $date_to = $request->getParam('date_to');
    $start_time = $request->getParam('start_time');
    $end_time = $request->getParam('end_time');
    //$teacher_id = $request->getParam('teacher_id'); // *** FUTURE - Need to add ability to change teachers

    // Check Dates
    if(strlen($date_from) == 0) $date_from = NULL;
    if(strlen($date_to) == 0) $date_to = NULL;

    // Update the class table
    $sql =  "UPDATE class_tbl SET
                name = :class_name, 
                description = :class_description
            WHERE class_id = $id";

    // Update the schedule
    $sql2 = "UPDATE class_weekly_schedule_tbl SET
            days_of_week = :days_of_week,
            room_id = :room_id, 
            date_from = :date_from,
            date_until = :date_to,
            start_time = :start_time,
            end_time = :end_time        
            WHERE class_id = $id";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        // Handle Class Update
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':class_name', $name);
        $stmt->bindParam(':class_description', $description);

        $stmt->execute();

        // Handle Schedule Update
        $stmt = $db->prepare($sql2);

        $stmt->bindParam(':days_of_week', $days_of_week);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $stmt->bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $end_time, PDO::PARAM_STR);

        $stmt->execute();

        // return message
        echo '{"success": true, "type": "success","text": "Class has been saved."}';

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete exception
$app->delete('/class/delete/{id}', function (Request $request, Response $response) use ($app) {
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM class_tbl WHERE class_id = $id";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $db = null;
        
        echo '{"notice": {"text": "Class removed."}';

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

