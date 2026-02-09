<?php

$con = new mysqli("localhost","root","","db_php_1");

if(!$con) echo '<h1>Failed Connect!'.mysqli_connect_error().'</h1>';

?>