<?php
require './factory/DeviceFactory.php';

$deviceFactory = DeviceFactory::getInstance();
$deviceFactory->setConnection($connection);


// response for a research
if (isset($_GET['search'])) {
  $tabPrioritiesIndex=1;
  $tabPriorities=array();
    foreach ($_GET as $key => $value) {
        if ($key != 'page' AND $key != 'search') {
          $isPriority = strpos($key, 'priority') !== FALSE;
          $isOrder = strpos($key, 'order') !== FALSE;
          if (!$isPriority AND !$isOrder) {
            //ici recuperation des critères de recherche
          }else{
            if($isPriority){
              $tabPriorities[$tabPrioritiesIndex]['priority'] = $value;
            }else{
              $tabPriorities[$tabPrioritiesIndex]['order'] = $value;
              $tabPrioritiesIndex++;
            }
          }
        }
    }
  //Aremplir en fonction de ce qu'on aura recuperer comme critéres
   $brand = $warranty = $waterproof = $screenDefinition = $screenResolutionMin = $screenResolutionMax = $screenSizeMin = $screenSizeMax = $screenPanel = $CPUModel = $CPUFrequencyMin = $CPUFrequencyMax = $CPUCoreMin = $CPUCoreMax = $RAMMin = $RAMMax = $cameraResolutionMin = $cameraResolutionMax = $frontCameraResolutionMin = $frontCameraResolutionMax = $flash = $sizeHeighMin = $sizeHeighMax = $sizeWidthMin = $sizeWidthMax = $sizeThicknessMin = $sizeThicknessMax = $weightMin = $weightMax = $batteryCapacityMin = $batteryCapacityMax = $storageMin = $storageMax = $externalStorage = $software = $priceMin = $priceMax = NULL;

    $resultResearchDevices = $deviceFactory->findByCriteriaImpl($brand, $warranty, $waterproof, $screenDefinition, $screenResolutionMin, $screenResolutionMax, $screenSizeMin, $screenSizeMax, $screenPanel, $CPUModel, $CPUFrequencyMin, $CPUFrequencyMax, $CPUCoreMin, $CPUCoreMax, $RAMMin, $RAMMax, $cameraResolutionMin, $cameraResolutionMax, $frontCameraResolutionMin, $frontCameraResolutionMax, $flash, $sizeHeighMin, $sizeHeighMax, $sizeWidthMin, $sizeWidthMax, $sizeThicknessMin, $sizeThicknessMax, $weightMin, $weightMax, $batteryCapacityMin, $batteryCapacityMax, $storageMin, $storageMax, $externalStorage, $software, $priceMin, $priceMax,$tabPriorities);

    if (is_array($resultResearchDevices)) {
        $result = array();
        foreach ($resultResearchDevices as $device) {
            //print_r($device);
            //echo '<hr>';
        }
    } else {
        echo 'Impossible to retrieve data here';
    }
}

// no research
else {
    $resultResearchDevices = $deviceFactory->getDevices();

    if (is_array($resultResearchDevices)) {
        $result = array();
        foreach ($resultResearchDevices as $device) {
            //print_r($device);
            //echo '<hr>';
        }
    } else {
        echo 'Impossible to retrieve data';
    }
}


$allBrand = $deviceFactory->getBrands();
$allWarraties = $deviceFactory->getWarranties();
$allWaterproofs = $deviceFactory->getWaterproofs();
$allScreenDefinitions = $deviceFactory->getScreenDefinitions();
$allScreenPanels = $deviceFactory->getScreenPanels();
$allCPUModels = $deviceFactory->getCPUModels();
$allSoftwares = $deviceFactory->getSoftwares();

require './view/search.php';

?>