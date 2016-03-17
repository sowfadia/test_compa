<?php

require './factory/DeviceFactory.php';
//require './factory/ProviderFactory.php';

$deviceFactory = DeviceFactory::getInstance();
$deviceFactory->setConnection($connection);

//$providerFactory = ProviderFactory::getInstance();
//$providerFactory->setConnection($connection);
//
// response for a research
if (isset($_GET['search'])) {
//    $criterias = $deviceFactory->getCriterias();
    $criterias = array(array('brand', 'text'), array('price', 'numeric'));

    $checkCriterias = generateArrayCriterias($criterias);

    foreach ($_GET as $key => $value) {
        if ($key != 'page' AND $key != 'search') {
            if (strpos($key, 'prio') !== FALSE) {
                $tab = explode('prio', $key);
                if (isset($tab[1])) {
                    if (key_exists($value, $checkCriterias['priority'])) {
                        $arrayCriterias['priority'][$tab[1]]['prio'] = $value;
                    }
                }
            } else if (strpos($key, 'ord') !== FALSE) {
                $tab = explode('ord', $key);
                if (isset($tab[1])) {
                    if (key_exists('prio' . $tab[1], $_GET) AND key_exists($_GET['prio' . $tab[1]], $checkCriterias['priority'])) {
                        $arrayCriterias['priority'][$tab[1]]['ord'] = $value;
                    }
                }
            } else {
                if (key_exists($key, $checkCriterias['criterias'])) {
                    $arrayCriterias['criterias'][$key] = $value;
                }
            }
        }
    }

//    $resultResearchDevices = $deviceFactory->findByCriteriaImpl($arrayCriterias);
//    if (!is_array($resultResearchDevices)) {
//        echo 'Impossible to retrieve data here';
//    }

    echo '<hr><b>tab GET recupéré via le formulaire</b>';
    var_dump($_GET);
    echo '<hr><b>tab des criteres en db formaté en min max pour text/numeric</b> <br>(methode a crée avec le sql dans le mail, hardcodé provisoirement, ne contient que brand et price)';
    var_dump($checkCriterias);
    echo '<hr><b>tab structuré renvoyé a la couche Model</b><br> vu que le tab des criteres n est pas le reel en db et ne contient que brand et price, screenResolution est pas renvoyé a Model, comme ca le user peut pas mettre n importe quoi dans l url';
    var_dump($arrayCriterias);
}

// no research
else {
    $resultResearchDevices = $deviceFactory->getDevices();
    var_dump($resultResearchDevices);
}

$allBrand = $deviceFactory->getBrands();
$allWaterproof = $deviceFactory->getWaterproofs();
//$allProviders = $deviceFactory->getProviders();
$allWarraties = $deviceFactory->getWarranties();
$allScreenDefinitions = $deviceFactory->getScreenDefinitions();
$allCPUModels = $deviceFactory->getCPUModels();
$allSoftwares = $deviceFactory->getSoftwares();

//require './view/search.php';

function generateArrayCriterias($criterias) {
    $checkCriterias = array();

    foreach ($criterias as $criteria) {
        $name = $criteria[0];
        $type = $criteria[1];

        if ($type == 'numeric') {
            $checkCriterias['criterias'][$name . 'Min'] = NULL;
            $checkCriterias['criterias'][$name . 'Max'] = NULL;
        } else if ($type == 'text') {
            $checkCriterias['criterias'][$name] = NULL;
        }

        $checkCriterias['priority'][$name] = NULL;
    }

    return $checkCriterias;
}

?>
