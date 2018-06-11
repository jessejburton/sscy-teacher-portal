<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Check user login
$app->post('/login', function (Request $request, Response $response) {

    $username = $request->getParam("username");
    $password = $request->getParam("password");

    // If either are blank return an error message
    if(strlen($username) == 0 || strlen($password) == 0){
        return '{"type": "danger","message": "Please enter a username and password."}';
    }

    // hash the password to compare
    $hashed_password = md5($password);

    // Query to get record based on username and password
    $sql = "SELECT account_id, username, concat(name_first, ' ', name_last) AS name
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

        // if no user record is returned the password must be incorrect
        if(!$user){
            echo '{"success": false,"type": "danger","text": "Your username and password don\'t match our records."}';
        } else {
            // Log the user in
            session_start();

            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user->name;
            $_SESSION['user_id'] = $user->account_id;
            echo '{"success": true,"type": "success","text": "Welcome to the site!"}';
        };

    } catch(PDOException $e) {
        echo '{"type": "danger","text": '.$e->getMessage().'"}';
    }
});
