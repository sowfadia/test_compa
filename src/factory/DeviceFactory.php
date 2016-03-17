<?php
require_once ('Factory.php');
require_once (__DIR__.'/../model/Device.php');

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
        if (is_null(static::$instance)) {
            static::$instance = new DeviceFactory();
        }
        return static::$instance;
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

    public function getMinMaxPrice(){
        return parent::getMinMax($this->tableName, "price");
    }
    public function getMinMaxScreenResolution(){
        return parent::getMinMax($this->tableName, "screenresolution");
    }
    public function getMinMaxScreenSize(){
        return parent::getMinMax($this->tableName, "screensize");
    }
    public function getMinMaxCPUFrequency(){
        return parent::getMinMax($this->tableName, "cpufrequency");
    }
    public function getMinMaxCPUCore(){
        return parent::getMinMax($this->tableName, "cpucore");
    }
    public function getMinMaxRAM(){
        return parent::getMinMax($this->tableName, "ram");
    }
    public function getMinMaxCameraResolution(){
        return parent::getMinMax($this->tableName, "cameraresolution");
    }
    public function getMinMaxFrontCameraResolution(){
        return parent::getMinMax($this->tableName, "frontcameraresolution");
    }
    public function getMinMaxSizeHeigh(){
        return parent::getMinMax($this->tableName, "sizeheigh");
    }
    public function getMinMaxSizeWidth(){
        return parent::getMinMax($this->tableName, "sizewidth");
    }
    public function getMinMaxSizeThickness(){
        return parent::getMinMax($this->tableName, "sizethickness");
    }
    public function getMinMaxWeight(){
        return parent::getMinMax($this->tableName, "weight");
    }
    public function getMinMaxBatteryCapacity(){
        return parent::getMinMax($this->tableName, "batterycapacity");
    }
    public function getMinMaxStorage(){
        return parent::getMinMax($this->tableName, "storage");
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
                 $record['externalstorage'], $record['software'], 
                 $record['image'], $record['idfromprovider']
                );
    }

    protected function toSql($device) {
        if(!is_null($device) && ($device instanceof Device)){
            return "insert into ".$this->tableName."(\"idprovider\",\"brand\",\"model\",\"price\","
                    ."\"warranty\",\"waterproof\",\"screendefinition\",\"screenresolution\","
                     . "\"screensize\",\"screenpanel\",\"cpumodel\",\"cpufrequency\","
                     . "\"cpucore\",\"ram\",\"cameraresolution\",\"frontcameraresolution\","
                     . "\"flash\",\"sizeheigh\",\"sizewidth\",\"sizethickness\",\"weight\","
                     . "\"batterycapacity\",\"storage\",\"externalstorage\",\"software\", \"image\", \"idfromprovider\") values ("
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
                     . $this->paramToSql($device->getSoftware()) . "," .$this->paramToSql($device->getImage()). "," .$this->paramToSql($device->getIdFromProvider()).")";
         }
        throw new Exception("the parameter is not an instance of Device ", null, null);
    }


    /**
     * A function to filter and return matching devices using given criteria
     */
    public function findByCriteriaImpl($criterias, $priorities) {
        $brand = (array_key_exists('brand', $criterias) ? $criterias['brand'] : '%');
        $warranty = (!array_key_exists('warranty', $criterias) ? '%' :  $criterias['warranty'] );
        $waterproof = (!array_key_exists('waterproof', $criterias) ? '%' :  $criterias['waterproof'] );
        $screenDefinition = (!array_key_exists('screendefinition', $criterias) ? '%' :  $criterias['screendefinition'] );
        $screenResolutionMin = (!array_key_exists('screenresolutionmin', $criterias) ? 0 : $criterias['screenresolutionmin'] );
        $screenResolutionMax = (!array_key_exists('screenresolutionmax', $criterias) ? PHP_INT_MAX : $criterias['screenresolutionmax'] );
        $screenSizeMin = (!array_key_exists('screensizemin', $criterias) ? 0 : $criterias['screensizemin'] );
        $screenSizeMax = (!array_key_exists('screensizemax', $criterias) ? PHP_INT_MAX : $criterias['screensizemax'] );
        $screenPanel = (!array_key_exists('screenpanel', $criterias) ? '%' :  $criterias['screenpanel'] );
        $CPUModel = (!array_key_exists('cpumodel', $criterias) ? '%' :  $criterias['cpumodel'] );
        $CPUFrequencyMin = (!array_key_exists('cpufrequencymin', $criterias) ? 0 : $criterias['cpufrequencymin'] );
        $CPUFrequencyMax = (!array_key_exists('cpufrequencymax', $criterias) ? PHP_INT_MAX : $criterias['cpufrequencymax'] );
        $CPUCoreMin = (!array_key_exists('cpucoremin', $criterias) ? 0 : $criterias['cpucoremin'] );
        $CPUCoreMax = (!array_key_exists('cpucoremax', $criterias) ? PHP_INT_MAX : $criterias['cpucoremax'] );
        $RAMMin = (!array_key_exists('rammin', $criterias) ? 0 : $criterias['rammin'] );
        $RAMMax = (!array_key_exists('rammax', $criterias) ? PHP_INT_MAX : $criterias['rammax'] );
        $cameraResolutionMin = (!array_key_exists('cameraresolutionmin', $criterias) ? 0 : $criterias['cameraresolutionmin'] );
        $cameraResolutionMax = (!array_key_exists('cameraresolutionmax', $criterias) ? PHP_INT_MAX : $criterias['cameraresolutionmax'] );
        $software = (!array_key_exists('software', $criterias) ? '%' :  $criterias['software'] );
        $frontCameraResolutionMin = (!array_key_exists('frontcameraresolutionmin', $criterias) ? 0 : $criterias['frontcameraresolutionmin'] );
        $sizeHeighMax = (!array_key_exists('sizeheighmax', $criterias) ? PHP_INT_MAX : $criterias['sizeheighmax'] );
        $sizeHeighMin = (!array_key_exists('sizeheighmin', $criterias) ? 0 : $criterias['sizeheighmin'] );
        $frontCameraResolutionMax = (!array_key_exists('frontcameraresolutionmax', $criterias) ? PHP_INT_MAX : $criterias['frontcameraresolutionmax'] );
        $sizeWidthMin = (!array_key_exists('sizewidthmin', $criterias) ? 0 : $criterias['sizewidthmin'] );
        $sizeWidthMax = (!array_key_exists('sizewidthmax', $criterias) ? PHP_INT_MAX : $criterias['sizewidthmax'] );
        $sizeThicknessMin = (!array_key_exists('sizethicknessmin', $criterias) ? 0 : $criterias['sizethicknessmin'] );
        $sizeThicknessMax = (!array_key_exists('sizethicknessmax', $criterias) ? PHP_INT_MAX : $criterias['sizethicknessmax'] );
        $weightMin = (!array_key_exists('weightmin', $criterias) ? 0 : $criterias['weightmin'] );
        $weightMax = (!array_key_exists('weightmax', $criterias) ? PHP_INT_MAX : $criterias['weightmax'] );
        $batteryCapacityMin = (!array_key_exists('batterycapacitymin', $criterias) ? 0 : $criterias['batterycapacitymin'] );
        $batteryCapacityMax = (!array_key_exists('batterycapacitymax', $criterias) ? PHP_INT_MAX : $criterias['batterycapacitymax'] );
        $storageMin = (!array_key_exists('storagemin', $criterias) ? 0 : $criterias['storagemin'] );
        $storageMax = (!array_key_exists('storagemax', $criterias) ? PHP_INT_MAX : $criterias['storagemax'] );
        $priceMin = (!array_key_exists('pricemin', $criterias) ? 0 : $criterias['pricemin'] );
        $priceMax = (!array_key_exists('pricemax', $criterias) ? PHP_INT_MAX : $criterias['pricemax'] );

        $criteria = " COALESCE(brand, '') like '" . $brand .
                "'and COALESCE(price, 0) >=" . $priceMin .
                " and COALESCE(price, " . PHP_INT_MAX . ") <=" . $priceMax .
                " and COALESCE(warranty, '') like '" . $warranty .
                "'and COALESCE(waterproof, '') like '" . $waterproof .
                "'and COALESCE(screenDefinition, '') like '" . $screenDefinition .
                "'and COALESCE(screenResolution, 0) >= " . $screenResolutionMin .
                " and COALESCE(screenResolution, " . PHP_INT_MAX . ") <= " . $screenResolutionMax .
                " and COALESCE(screenSize, 0) >= " . $screenSizeMin .
                " and COALESCE(screenSize, " . PHP_INT_MAX . ") <= " . $screenSizeMax .
                " and COALESCE(screenPanel, '') like '" . $screenPanel .
                "'and COALESCE(CPUModel, '') like '" . $CPUModel .
                "'and COALESCE(CPUFrequency, 0) >= " . $CPUFrequencyMin .
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

         if (array_key_exists('flash', $criterias) && is_bool($criterias['flash'])) {
             $flash = ($criterias['flash']) ? 'true' : 'false';
             $criteria .= " and flash = " . $flash;
        }
        if (array_key_exists('externalStorage', $criterias) && is_bool($criterias['externalStorage'])) {
            $storage = $flash = ($criterias['externalStorage']) ? 'true' : 'false';
            $criteria .= " and externalStorage = " . $storage;
        }
      
      if(sizeof($priorities) != 0){
        $criteria .= " order by ";
         foreach($priorities as $priority){
            $criteria .= $priority["priority"]." ".$priority["order"].", ";
          }
        $criteria = substr($criteria, 0, -2);
      }
        return parent::findByCriteria($this->tableName, $criteria);
    }
}