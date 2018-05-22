<?php

DEFINE ('DB_USER', 'saltspri_web');
DEFINE ('DB_PASSWORD', 'Baba1272*rc');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'saltspri_internal');

$sscy_database = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
OR die('Could not connect to MySQL ' . mysqli_connect_error());

?>