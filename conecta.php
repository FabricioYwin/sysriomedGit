<?php
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);

$serverName = $hostname."\SQLEXPRESS"; 

$connectionInfo = array("Database"=>"medx");

$conn = sqlsrv_connect($serverName, $connectionInfo);