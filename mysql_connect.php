<?php

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'sscy_internal');


$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
OR die('Could not connect to MySQL ' . mysqli_connect_error());

$query = "SELECT * FROM account_tbl";

$response = @mysqli_query($dbc, $query);

if($response){

    while($row = mysqli_fetch_array($response)){
        echo $row['name_first'] . ' ' . $row['name_last'] . '<br />';
    }

}

mysqli_close($dbc);

?>