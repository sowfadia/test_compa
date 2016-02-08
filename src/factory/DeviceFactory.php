<?php
require_once ('Factory.php');
require_once (__DIR__.'/../model/Device.php');
/**
 * The factory in charge of managing devices
 *
 * @author sowf
 */
class DeviceFactory extends Factory {

    private $tableName = "compa.device";
  
    /**
     * The single instance of the factory
     */
    protected static $instance;

    /**
     * constructor 
     */
    public function __construct() {}

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new DeviceFactory();
        }
        return self::$instance;
    }

    public function getDevices() {
        return parent::getAll($this->tableName);
    }

    public function getBrands() {
        return parent::getListTextFieldValues($this->tableName,"brand");
    }

    public function getWarranties() {
        return parent::getListTextFieldValues($this->tableName,"warranty");
    }

    public function getWaterproofs() {
        return parent::getListTextFieldValues($this->tableName,"waterproof");
    }

    public function getScreenDefinitions() {
        return parent::getListTextFieldValues($this->tableName,"screenDefinition");
    }

    public function getScreenPanels() {
        return parent::getListTextFieldValues($this->tableName,"screenPanel");
    }

    public function getCPUModels() {
        return parent::getListTextFieldValues($this->tableName,"CPUModel");
    }

    public function getSoftwares() {
        return parent::getListTextFieldValues($this->tableName,"software");
    }
  
    public function getCriterias() {
        return parent::getListTextFieldValuesAndType("compa","device");
    }

    public function findDeviceById($id) {
        return parent::findById($this->tableName, $id);
    }

    public function deleteDevice($id) {
        return parent::delete($this->tableName, $id);
    }

    public function updateDevice($id,$fields) {
        return parent::update($this->tableName, $id, $fields);
    }

    public function createDevice($device) {
        return parent::create($device);
    }

    protected function toObject($record) {
        return new Device(
                $record['id'], $record['idprovider'],
                $record['brand'], $record['model'], 
                $record['price'], $record['warranty'],
                $record['waterproof'], $record['screendefinition'], 
                $record['screenresolution'], $record['screensize'],
                $record['screenpanel'], $record['cpumodel'], 
                $record['cpufrequency'], $record['cpucore'], 
                $record['ram'], $record['cameraresolution'], 
                $record['frontcameraresolution'], $record['flash'],
                $record['sizeheigh'], $record['sizewidth'], 
                $record['sizethickness'], $record['weight'],
                $record['batterycapacity'], $record['storage'], 
                $record['externalstorage'], $record['software'], $record['image']
        );
    }

    protected function toSql($device) {
        if(!is_null($device) && ($device instanceof Device)){
            return "insert into ".$this->tableName."(\"idprovider\",\"brand\",\"model\",\"price\","
                    ."\"warranty\",\"waterproof\",\"screendefinition\",\"screenresolution\","
                    . "\"screensize\",\"screenpanel\",\"cpumodel\",\"cpufrequency\","
                    . "\"cpucore\",\"ram\",\"cameraresolution\",\"frontcameraresolution\","
                    . "\"flash\",\"sizeheigh\",\"sizewidth\",\"sizethickness\",\"weight\","
                    . "\"batterycapacity\",\"storage\",\"externalstorage\",\"software\", \"image\") values ("
                    . $this->paramToSql($device->getProvider()) . "," . $this->paramToSql($device->getBrand()) . ","
                    . $this->paramToSql($device->getModel()) . "," . $this->paramToSql($device->getPrice()) . "," 
                    . $this->paramToSql($device->getWarranty()) . ","
                    . $this->paramToSql($device->getWaterproof()) . "," . $this->paramToSql($device->getScreenDefinition()) . "," 
                    . $this->paramToSql($device->getScreenResolution()) . ","
                    . $this->paramToSql($device->getScreenSize()) . "," . $this->paramToSql($device->getScreenPanel()) . "," 
                    . $this->paramToSql($device->getCPUModel()) . ","
                    . $this->paramToSql($device->getCPUFrequency()) . "," . $this->paramToSql($device->getCPUCore()) . "," 
                    . $this->paramToSql($device->getRAM()) . ","
                    . $this->paramToSql($device->getCameraResolution()) . "," 
                    . $this->paramToSql($device->getFrontCameraResolution()) . "," . $this->paramToSql($device->getFlash()) . ","
                    . $this->paramToSql($device->getSizeHeigh()) . "," . $this->paramToSql($device->getSizeWidth()) . "," 
                    . $this->paramToSql($device->getSizeThickness()) . ","
                    . $this->paramToSql($device->getWeight()) . "," . $this->paramToSql($device->getBatteryCapacity()) . ","
                    . $this->paramToSql($device->getStorage()) . ","
                    . $this->paramToSql($device->getExternalStorage()) . "," 
                    . $this->paramToSql($device->getSoftware()) . "," .$this->paramToSql($device->getImage()).")";
        }
        throw new Exception("the parameter is not an instantance of Device ", null, null);
   }

    /**
     * A function to filter and return matching devices using given criteria
     */
    public function findByCriteriaImpl($criterias, $priorities) {
      
        //$priceMin = (array_key_exists('priceMin', $criterias) ? $criterias['priceMin'] : 0);  
      
        $brand = (array_key_exists('brand', $criterias) ? $criterias['brand'] : '%');
        $warranty = (!array_key_exists('warranty', $criterias) ? '%' :  $criterias['warranty'] );
        $waterproof = (!array_key_exists('waterproof', $criterias) ? '%' :  $criterias['waterproof'] );
        $screenDefinition = (!array_key_exists('screenDefinition', $criterias) ? '%' :  $criterias['screenDefinition'] );
        $screenResolutionMin = (!array_key_exists('screenResolutionMin', $criterias) ? 0 : $criterias['screenResolutionMin'] );
        $screenResolutionMax = (!array_key_exists('screenResolutionMax', $criterias) ? PHP_INT_MAX : $criterias['screenResolutionMax'] );
        $screenSizeMin = (!array_key_exists('screenSizeMin', $criterias) ? 0 : $criterias['screenSizeMin'] );
        $screenSizeMax = (!array_key_exists('screenSizeMax', $criterias) ? PHP_INT_MAX : $criterias['screenSizeMax'] );
        $screenPanel = (!array_key_exists('screenPanel', $criterias) ? '%' :  $criterias['screenPanel'] );
        $CPUModel = (!array_key_exists('CPUModel', $criterias) ? '%' :  $criterias['CPUModel'] );
        $CPUFrequencyMin = (!array_key_exists('CPUFrequencyMin', $criterias) ? 0 : $criterias['CPUFrequencyMin'] );
        $CPUFrequencyMax = (!array_key_exists('CPUFrequencyMax', $criterias) ? PHP_INT_MAX : $criterias['CPUFrequencyMax'] );
        $CPUCoreMin = (!array_key_exists('CPUCoreMin', $criterias) ? 0 : $criterias['CPUCoreMin'] );
        $CPUCoreMax = (!array_key_exists('CPUCoreMax', $criterias) ? PHP_INT_MAX : $criterias['CPUCoreMax'] );
        $RAMMin = (!array_key_exists('RAMMin', $criterias) ? 0 : $criterias['RAMMin'] );
        $RAMMax = (!array_key_exists('RAMMax', $criterias) ? PHP_INT_MAX : $criterias['RAMMax'] );
        $cameraResolutionMin = (!array_key_exists('cameraResolutionMin', $criterias) ? 0 : $criterias['cameraResolutionMin'] );
        $cameraResolutionMax = (!array_key_exists('cameraResolutionMax', $criterias) ? PHP_INT_MAX : $criterias['cameraResolutionMax'] );
        $software = (!array_key_exists('software', $criterias) ? '%' :  $criterias['software'] );
        $frontCameraResolutionMin = (!array_key_exists('frontCameraResolutionMin', $criterias) ? 0 : $criterias['frontCameraResolutionMin'] );
        $sizeHeighMax = (!array_key_exists('sizeHeighMax', $criterias) ? PHP_INT_MAX : $criterias['sizeHeighMax'] );
        $sizeHeighMin = (!array_key_exists('sizeHeighMin', $criterias) ? 0 : $criterias['sizeHeighMin'] );
        $frontCameraResolutionMax = (!array_key_exists('frontCameraResolutionMax', $criterias) ? PHP_INT_MAX : $criterias['frontCameraResolutionMax'] );
        $sizeWidthMin = (!array_key_exists('sizeWidthMin', $criterias) ? 0 : $criterias['sizeWidthMin'] );
        $sizeWidthMax = (!array_key_exists('sizeWidthMax', $criterias) ? PHP_INT_MAX : $criterias['sizeWidthMax'] );
        $sizeThicknessMin = (!array_key_exists('sizeThicknessMin', $criterias) ? 0 : $criterias['sizeThicknessMin'] );
        $sizeThicknessMax = (!array_key_exists('sizeThicknessMax', $criterias) ? PHP_INT_MAX : $criterias['sizeThicknessMax'] );
        $weightMin = (!array_key_exists('weightMin', $criterias) ? 0 : $criterias['weightMin'] );
        $weightMax = (!array_key_exists('weightMax', $criterias) ? PHP_INT_MAX : $criterias['weightMax'] );
        $batteryCapacityMin = (!array_key_exists('batteryCapacityMin', $criterias) ? 0 : $criterias['batteryCapacityMin'] );
        $batteryCapacityMax = (!array_key_exists('batteryCapacityMax', $criterias) ? PHP_INT_MAX : $criterias['batteryCapacityMax'] );
        $storageMin = (!array_key_exists('storageMin', $criterias) ? 0 : $criterias['storageMin'] );
        $storageMax = (!array_key_exists('storageMax', $criterias) ? PHP_INT_MAX : $criterias['storageMax'] );
        $priceMin = (!array_key_exists('priceMin', $criterias) ? 0 : $criterias['priceMin'] );
        $priceMax = (!array_key_exists('priceMax', $criterias) ? PHP_INT_MAX : $criterias['priceMax'] );

        $criteria = " COALESCE(brand, '') like '" . $brand .
                "' and COALESCE(price, 0) >=" . $priceMin .
                " and COALESCE(price, " . PHP_INT_MAX . ") <=" . $priceMax .
                " and COALESCE(warranty, '') like '" . $warranty .
                "' and COALESCE(waterproof, '') like '" . $waterproof .
                "' and COALESCE(screenDefinition, '') like '" . $screenDefinition .
                "' and COALESCE(screenResolution, 0) >= " . $screenResolutionMin .
                " and COALESCE(screenResolution, " . PHP_INT_MAX . ") <= " . $screenResolutionMax .
                " and COALESCE(screenSize, 0) >= " . $screenSizeMin .
                " and COALESCE(screenSize, " . PHP_INT_MAX . ") <= " . $screenSizeMax .
                " and COALESCE(screenPanel, '') like '" . $screenPanel .
                "' and COALESCE(CPUModel, '') like '" . $CPUModel .
                "' and COALESCE(CPUFrequency, 0) >= " . $CPUFrequencyMin .
                " and COALESCE(CPUFrequency, " . PHP_INT_MAX . ") <= " . $CPUFrequencyMax .
                " and COALESCE(CPUCore, 0) >= " . $CPUCoreMin .
                " and COALESCE(CPUCore, " . PHP_INT_MAX . ") <= " . $CPUCoreMax .
                " and COALESCE(RAM, 0) >= " . $RAMMin .
                " and COALESCE(RAM, " . PHP_INT_MAX . ") <= " . $RAMMax .
                " and COALESCE(cameraResolution, 0) >= " . $cameraResolutionMin .
                " and COALESCE(cameraResolution, " . PHP_INT_MAX . ") <= " . $cameraResolutionMax .
                " and COALESCE(frontCameraResolution, 0) >= " . $frontCameraResolutionMin .
                " and COALESCE(frontCameraResolution, " . PHP_INT_MAX . ") <= " . $frontCameraResolutionMax .
                " and COALESCE(sizeHeigh, 0) >= " . $sizeHeighMin .
                " and COALESCE(sizeHeigh, " . PHP_INT_MAX . ") <= " . $sizeHeighMax .
                " and COALESCE(sizeWidth, 0) >= " . $sizeWidthMin .
                " and COALESCE(sizeWidth, " . PHP_INT_MAX . ") <= " . $sizeWidthMax .
                " and COALESCE(sizeThickness, 0) >= " . $sizeThicknessMin .
                " and COALESCE(sizeThickness, " . PHP_INT_MAX . ") <= " . $sizeThicknessMax .
                " and COALESCE(weight, 0) >= " . $weightMin .
                " and COALESCE(weight, " . PHP_INT_MAX . ") <= " . $weightMax .
                " and COALESCE(batteryCapacity, 0) >= " . $batteryCapacityMin .
                " and COALESCE(batteryCapacity, " . PHP_INT_MAX . ") <= " . $batteryCapacityMax .
                " and COALESCE(storage, 0) >= " . $storageMin .
                " and COALESCE(storage, " . PHP_INT_MAX . ") <= " . $storageMax .
                " and COALESCE(software, '') like '" . $software . "'";

        if (array_key_exists('flash', $criterias) and is_bool($criterias['flash'])) {
            $flash = ($criterias['flash']) ? 'true' : 'false';
            $criteria .= " and flash = " . $flash;
        }
        if (array_key_exists('externalStorage', $criterias) and is_bool($criterias['externalStorage'])) {
            $storage = $flash = ($criterias['externalStorage']) ? 'true' : 'false';
            $criteria .= " and externalStorage = " . $storage;
        }
      
      if(!is_null($priorities)){
        $criteria .= " order by ";
        foreach($priorities as $priority){
          $criteria .= $priority["priority"]." ".$priority["order"].", ";
        }
        $criteria = substr($criteria, 0, -2);
      }
        return parent::findByCriteria($this->tableName, $criteria);
    }

}
