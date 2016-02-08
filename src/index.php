<?php

// Global includes

// Handle PHP errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

require './utils/Connection.php'; 
require_once(__DIR__.'/config/config.php'); 

$connection = new Connection(DB_HOST, DB_PORT, DB_USER, DB_PASSWORD, DB_DATABASE,DB_TYPE);

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