<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Check user login
$app->post('/login', function (Request $request, Response $response) {

    $username = $request->getParam("username");
    $password = $request->getParam("password");

    $hashed_password = md5($password);

    // Check the database
    $sql = "SELECT username, account_id, email, concat(name_first, ' ', name_last) AS name
            FROM account_tbl 
            WHERE username = '$username'
            AND password = '$hashed_password'";

    try {
        
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;

        if( !$user ) {
            echo '{"success":false,"type":"danger","text":"Sorry, that username or password is incorrect."}';
        } else {
            // User login successful, create the session
            session_start();

            $_SESSION['userid'] = $user->account_id;
            $_SESSION['name'] = $user->name;

            echo '{"success":true,"type":"success","text":"Welcome to the site!"}';            
        }

    } catch(PDOException $e) {
        echo '{"success":false,"type":"danger","text":"' . $e->getMessage() . '"}';
    }
});
