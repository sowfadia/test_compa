<?php

require './factory/DeviceFactory.php';
$deviceFactory = DeviceFactory::getInstance();
$deviceFactory->setConnection($connection);

require './factory/SearchFactory.php';
$searchFactory = SearchFactory::getInstance();
$searchFactory->setConnection($connection);

// response for a research
if (isset($_GET['search'])) {
    $criterias = $deviceFactory->getCriterias();
    $checkCriterias = generateArrayCriterias($criterias);

    $arrayCriterias = array();

    foreach ($_GET as $key => $value) {
        if ($key != 'page' AND $key != 'search') {
            if (strpos($key, 'prio') !== FALSE) {
                $tab = explode('prio', $key);
                if (isset($tab[1])) {
                    if (key_exists('ord' . $tab[1], $_GET) AND key_exists($_GET['prio' . $tab[1]], $checkCriterias['priority'])) {
                        $arrayCriterias['priority'][$tab[1]]['priority'] = $value;
                    }
                }
            } else if (strpos($key, 'ord') !== FALSE) {
                $tab = explode('ord', $key);
                if (isset($tab[1])) {
                    if (key_exists('prio' . $tab[1], $_GET) AND key_exists($_GET['prio' . $tab[1]], $checkCriterias['priority'])) {
                        $arrayCriterias['priority'][$tab[1]]['order'] = $value;
                    }
                }
            } else {
                if (key_exists($key, $checkCriterias['criterias'])) {
                    $arrayCriterias['criterias'][$key] = $value;
                }
            }
        }
    }

    if (key_exists('priority', $arrayCriterias) && key_exists('criterias', $arrayCriterias)) {
        $resultResearchDevices = $deviceFactory->findByCriteriaImpl($arrayCriterias['criterias'], $arrayCriterias['priority']);
    } else if (key_exists('priority', $arrayCriterias)) {
        $resultResearchDevices = $deviceFactory->findByCriteriaImpl(array(), $arrayCriterias['priority']);
    } else if (key_exists('criterias', $arrayCriterias)) {
        $resultResearchDevices = $deviceFactory->findByCriteriaImpl($arrayCriterias['criterias'], array());
    } else {
        $resultResearchDevices = array();
    }

    if (!is_array($resultResearchDevices)) {
        echo 'Impossible to retrieve data here';
    }



    if (isset($_SESSION['id'])) {
        $searchFactory->insertSearch($_SESSION['id'], $_SERVER['REQUEST_URI']);
        $searchHistoric = $searchFactory->retrieveSearchByUser($_SESSION['id']);
    }
}

// no research
else {
    $resultResearchDevices = array();
}

$allBrand = $deviceFactory->getBrands();
$allWarraties = $deviceFactory->getWarranties();
$allWaterproofs = $deviceFactory->getWaterproofs();
$allScreenDefinitions = $deviceFactory->getScreenDefinitions();
$allScreenPanels = $deviceFactory->getScreenPanels();
$allCPUModels = $deviceFactory->getCPUModels();
$allSoftwares = $deviceFactory->getSoftwares();

$minMaxPrice = $deviceFactory->getMinMaxPrice();
$minMaxScreenResolution = $deviceFactory->getMinMaxScreenResolution();
$minMaxScreenSize = $deviceFactory->getMinMaxScreenSize();
$minMaxCPUFrequency = $deviceFactory->getMinMaxCPUFrequency();
$minMaxCPUCore = $deviceFactory->getMinMaxCPUCore();
$minMaxRAM = $deviceFactory->getMinMaxRAM();
$minMaxCameraResolution = $deviceFactory->getMinMaxCameraResolution();
$minMaxFrontCameraResolution = $deviceFactory->getMinMaxFrontCameraResolution();
$minMaxSizeHeigh = $deviceFactory->getMinMaxSizeHeigh();
$minMaxSizeWidth = $deviceFactory->getMinMaxSizeWidth();
$minMaxSizeThickness = $deviceFactory->getMinMaxSizeThickness();
$minMaxWeight = $deviceFactory->getMinMaxWeight();
$minMaxBatteryCapacity = $deviceFactory->getMinMaxBatteryCapacity();
$minMaxStorage = $deviceFactory->getMinMaxStorage();

array_unshift($allBrand, null);
array_unshift($allWarraties, null);
array_unshift($allWaterproofs, null);
array_unshift($allScreenDefinitions, null);
array_unshift($allScreenPanels, null);
array_unshift($allCPUModels, null);
array_unshift($allSoftwares, null);

function generateArrayCriterias($criterias) {
    $checkCriterias = array();
    $checkCriterias['criteria'] = null;
    $checkCriterias['priority'] = null;
    foreach ($criterias as $criteria) {
        $name = $criteria[0];
        $type = $criteria[1];

        if ($type == 'numeric') {
            $checkCriterias['criterias'][$name . 'min'] = NULL;
            $checkCriterias['criterias'][$name . 'max'] = NULL;
        } else if ($type == 'text') {
            $checkCriterias['criterias'][$name] = NULL;
        }

        $checkCriterias['priority'][$name] = NULL;
    }

    return $checkCriterias;
}

require './view/app/search.php';
?>
