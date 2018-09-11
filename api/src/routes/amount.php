<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get amount collected for a class by id and date
$app->get('/amount/{class_id}/{class_date}', function (Request $request, Response $response) {
    $class_id = $request->getAttribute('class_id');
    $class_date = $request->getAttribute('class_date');

    $sql = "SELECT 
                amount
            FROM class_amount_tbl
            WHERE date_class = '$class_date'
            AND class_id = $class_id";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($result);

    } catch(PDOException $e) {
        echo '{"type": "danger","text": "'.$e->getMessage().'"}';
    }
});

// Save Amount
$app->put('/amount/save/{class_id}/{class_date}', function (Request $request, Response $response) {
    $class_id = $request->getAttribute('class_id');
    $class_date = $request->getAttribute('class_date');

    $amount = +$request->getParam('amount');

    // Remove any previous entry
    $sql =  "DELETE FROM class_amount_tbl 
            WHERE date_class = '$class_date'
            AND class_id = $class_id";

    $sql2 = "INSERT INTO class_amount_tbl (class_id, date_class, amount, account_id) 
    VALUES (:class_id, :date_class, :amount, 1)";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();

        // Insert the record
        $stmt2 = $db->prepare($sql2);

        $stmt2->bindParam(':class_id', $class_id);
        $stmt2->bindParam(':date_class', $class_date);
        $stmt2->bindParam(':amount', $amount);

        $stmt2->execute();

        // return message
        echo '{"success": true, "type": "success","text": "Amount collected saved"}';

    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
