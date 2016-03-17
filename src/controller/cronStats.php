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

if(isset($_GET['token']) AND $_GET['token'] == 'ascft'){
  $nbUsers = count($userFactory->getUsers());
  $nbProviders = count($providerFactory->getProviders());
  $nbDevices = count($deviceFactory->getDevices());
  $nbSearch = $searchFactory->getCountSearch();
  $nbLinks = count($linksFactory->getLinks());
  
  $newStat = new Stats(null, $nbUsers, $nbProviders, $nbSearch, $nbDevices, $nbLinks);
  $statsFactory->addStats($newStat);
}
?>