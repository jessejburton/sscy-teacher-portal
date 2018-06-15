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

// Add Exception
$app->post('/exception/add', function (Request $request, Response $response) {

   $class_id = $request->getParam("class_id");
   $date = $request->getParam("date");
   $teacher_id = $request->getParam("teacher_id");
   $room_id = $request->getParam("room_id");
   $type = $request->getParam("type");
   $type_id = $request->getParam("type_id");
   $message = $request->getParam("message");

   /***************
    * 
    ADD ERROR TRAPPING
    */

   $sql = "INSERT INTO class_exception_tbl 
            (class_id, teacher_id, room_id, exception_type_id, exception_date, message) 
            VALUES 
            (:class_id, :teacher_id, :room_id, :exception_type_id, :exception_date, :message )";

   try {
       
       // Get DB Object
       $db = new db();
       // Connect
       $db = $db->connect();

       $stmt = $db->prepare($sql);

       $stmt->bindParam(':class_id', $class_id);
       $stmt->bindParam(':teacher_id', $teacher_id);
       $stmt->bindParam(':room_id', $room_id);
       $stmt->bindParam(':exception_type_id', $type_id);
       $stmt->bindParam(':exception_date', $date);
       $stmt->bindParam(':message', $message);

       $stmt->execute();
       //$exception_id = $stmt->lastInsertId();
       // NEED TO FIX THIS TO RETURN THE ID
       $exception_id = 0; 

       echo '{
           "type": "success",
           "text": "Exception has been added.",
           "success":true,
           "exception": {
                "type": "' . $type["type"] . '",
                "date": "' . $date . '",
                "message": "' . $message . '",
                "exception_id": ' . $exception_id . '
           }
        }';

   } catch(PDOException $e) {
      echo '{"succes": false, "type": "danger","text": "'.$e->getMessage().'"}';
   }

});

// Get All Exception Types
$app->get('/exception/types', function (Request $request, Response $response) {

    $sql = "SELECT 
            exception_type_id, type, type_display 
        FROM exception_type_tbl";

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

// Remove an exception
$app->delete('/exception/remove/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    /* ERROR TRAPPING - TODO */
    /* ENSURE THE PERSON LOGGED IN HAS ACCESS TO REMOVE THIS EXCEPTION */

    $sql = "DELETE 
                FROM class_exception_tbl
                WHERE exception_id = $id";

    try {
            
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $db = null;
        
        echo '{"success": true, "type": "success","text": "Exception has been removed."}';

    } catch(PDOException $e) {
        echo '{"succes": false, "type": "danger","text": "'.$e->getMessage().'"}';
    }
});
