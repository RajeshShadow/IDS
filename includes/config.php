<?php

$obj=mysqli_connect("localhost","root","","ids");


function db_connect() {
    static $obj;
    if(!isset($obj)) {
		$db_host = 'localhost';
		$db_database = 'ids';
		$db_user = 'root';
		$db_pass = '';
        $obj = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
    }
    if($obj === false) {
        return mysqli_connect_error(); 
    }
    return $obj;
}

?>