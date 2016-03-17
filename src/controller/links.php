<?php

require './factory/LinksFactory.php';
$linksFactory = LinksFactory::getInstance();
$linksFactory->setConnection($connection);

if(isset($_GET['idUser']) AND isset($_GET['idProvider']) AND isset($_GET['redirect'])){
  $linkToAdd = new Links(null, $_GET['idUser'], $_GET['idProvider'], 'default');
  $linksFactory->createLink($linkToAdd);
  header("Location: ".$_GET['redirect']);
}
else if (isset($_GET['redirect']) && isset($_GET['idProvider'])){
	$linkToAdd = new Links(null, null, $_GET['idProvider'], 'default');
	$linksFactory->createLink($linkToAdd);
	header("Location: ".$_GET['redirect']);
}
else if (isset($_GET['redirect'])){
	header("Location: ".$_GET['redirect']);
}
else{
  header('Location: /src/?page=search');
}

?>