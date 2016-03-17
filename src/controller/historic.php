<?php

require './factory/SearchFactory.php';
$searchFactory = SearchFactory::getInstance();
$searchFactory->setConnection($connection);

if (isset($_SESSION['id'])) {
    $searchHistoric = $searchFactory->retrieveSearchByUser($_SESSION['id']);

    if (isset($_POST['alert'])) {
        if (isset($_POST['idSearch']) && isset($_POST['frequency']) && $_POST['idSearch'] != '' && $_POST['frequency'] != '') {
            $searchFactory->addAlertToSearch($_SESSION['id'], $_POST['idSearch'], $_POST['frequency']);

            header('Location: /src/?page=historic');
        }
      else {
        echo $_POST['frequency'];
      }
    }

require './view/app/historic.php';

}