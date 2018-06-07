<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get all classes
$app->get('/classes', function (Request $request, Response $response) {
    session_start();

    // Make sure the person is logged in.
    if( !isset($_SESSION['userid']) ){
        echo '{"type": "danger","text": "You muset be logged in to access this page."}';
        return;
    }

    $userid = $_SESSION['userid'];

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
            WHERE t.account_id = $userid";

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

// Add Class
$app->post('/class/add', function (Request $request, Response $response) {
    $name = $request->getParam('name');
    $description = $request->getParam('description');
    $room_id = $request->getParam('room_id');
    $teacher_id = $request->getParam('teacher_id');

    $sql =  "INSERT INTO class_tbl (name, description, room_id, teacher_id) 
             VALUES (:name, :description, :room_id, :teacher_id)";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':teacher_id', $teacher_id);

        $stmt->execute();

        echo '{"notice": {"text": "Class added"}}';

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
    $teacher_id = $request->getParam('teacher_id');

    $sql =  "UPDATE class_tbl SET
                name = :class_name, 
                description = :class_description, 
                room_id = :room_id, 
                teacher_id = :teacher_id
            WHERE class_id = $id";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':class_name', $name);
        $stmt->bindParam(':class_description', $description);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':teacher_id', $teacher_id);

        $stmt->execute();

        echo '{"notice": {"text": "Class updated"}}';

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete Class
$app->delete('/class/delete/{id}', function (Request $request, Response $response) {
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

