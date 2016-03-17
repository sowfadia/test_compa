<?php

// Global includes

// Handle PHP errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

require './utils/Connection.php'; 
 
$server = "zdro.fr";
$port = '5432';
$user = "postgres";
$password = "CaucWumIc3";
$dataBase = "postgres";
$dbType = "pgsql";

$connection = new Connection($server, $port, $user, $password, $dataBase,$dbType);

// redirection page
$authorizedPages = array('search', 'test');
if (isset($_GET['page'])) {
    $page = trim($_GET['page'], "/");

    if (in_array($page, $authorizedPages)) {
        require './controller/' . $page . '.php';
    } else {
        require './controller/404.php';
    }
} else {
    require './controller/search.php';
}
?>