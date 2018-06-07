<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get Profile
$app->get('/profile', function (Request $request, Response $response) {
    session_start();

    // Make sure the person is logged in.
    if( !isset($_SESSION['userid']) ){
        echo '{"type": "danger","text": "You muset be logged in to access this page."}';
        return;
    }

    $id = $_SESSION['userid'];

    $sql = "SELECT 
            a.account_id, a.name_first, a.name_last, t.bio, a.email, a.phone, t.photo
            FROM account_tbl a
            INNER JOIN teacher_tbl t ON a.account_id = t.account_id
            WHERE a.account_id = $id";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $profile = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($profile);

    } catch(PDOException $e) {
        echo '{"type": "danger","text": '.$e->getMessage().'"}';
    }
});

// Update Profile
$app->put('/profile/save/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $name_first = $request->getParam('name_first');
    $name_last = $request->getParam('name_last');
    $bio = $request->getParam('bio');
    $email = $request->getParam('email');

    $sql =  "UPDATE account_tbl SET
                name_first = :name_first,
                name_last = :name_last,
                email = :email
            WHERE account_id = $id";

    $sql2 =  "UPDATE teacher_tbl SET
                bio = :bio
            WHERE account_id = $id";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
            $stmt->bindParam(':name_first', $name_first);
            $stmt->bindParam(':name_last', $name_last);
            $stmt->bindParam(':email', $email);
        $stmt->execute();

        $stmt = $db->prepare($sql2);
            $stmt->bindParam(':bio', $bio);
        $stmt->execute();

        echo '{"type": "success","text":"Profile changes have been saved."}';

    } catch(PDOException $e) {
        echo '{"type": "danger","text": '.$e->getMessage().'"}';
    }
});


/* Add Class
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

*/