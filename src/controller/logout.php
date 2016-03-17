<?php
session_destroy();
$_SESSION = array();
session_start();
  header('Location: /src/');
?>