<?php

require './factory/UserFactory.php';
$userFactory = UserFactory::getInstance();
$userFactory->setConnection($connection);

require './factory/ProviderFactory.php';
$providerFactory = ProviderFactory::getInstance();
$providerFactory->setConnection($connection);

require './factory/DeviceFactory.php';
$deviceFactory = DeviceFactory::getInstance();
$deviceFactory->setConnection($connection);

require './factory/SearchFactory.php';
$searchFactory = SearchFactory::getInstance();
$searchFactory->setConnection($connection);

require './factory/LinksFactory.php';
$linksFactory = LinksFactory::getInstance();
$linksFactory->setConnection($connection);

require './factory/StatsFactory.php';
$statsFactory = StatsFactory::getInstance();
$statsFactory->setConnection($connection);

if (isset($_SESSION['id']) AND $_SESSION['id'] == '0') {
  
  $nbUsers = count($userFactory->getUsers());
  $nbProviders = count($providerFactory->getProviders());
  $nbDevices = count($deviceFactory->getDevices());
  $nbSearch = $searchFactory->getCountSearch();
  $nbLinks = count($linksFactory->getLinks());
  
  $lastStats = new Stats(null, $nbUsers, $nbProviders, $nbSearch, $nbDevices, $nbLinks);
  
    $result = $statsFactory->getStats();

    if(count($result) >= 1){

      $nbusers = $lastStats->getNbusers() - $result[0]->getNbusers();
      $nbproviders = $lastStats->getNbproviders() - $result[0]->getNbproviders();
      $nbsearch = $lastStats->getNbsearch() - $result[0]->getNbsearch();
      $nbdevices = $lastStats->getNbdevices() - $result[0]->getNbdevices();
      $nblinks = $lastStats->getNblinks() - $result[0]->getNblinks();

      $difStats = new Stats(null, $nbusers, $nbproviders, $nbsearch, $nbdevices, $nblinks);
    }
    else{
      $difStats = NULL;
    }

      require './view/app/stats.php';
  }
?>