<?php

/**
 * The factory managing search class objects
 *
 * @author sowf
 */

class SearchFactory extends Factory{
    private $tableName="compa.search";
    
      /**
     * The single instance of the factory
     */
    protected static $instance;
  
    /**
     * constructor 
     */
    public function __construct() {}
    
  /**
     * gets the unique instance of this factory
     * @return SearchFactory, the Factory's singleton
     */
    public static function getInstance(){
        if(is_null(self::$instance)) {
            self::$instance = new SearchFactory();  
        }
        return self::$instance;
    }

    public function getSearches() {
        return parent::getAll($this->tableName);
    }

    public function findSearchById($id) {
        return parent::findById($this->tableName, $id);
    }
    
    public function findSearchesByUser($userId) {
        $sql="select * from device where user=".$userId;
        $record=$this->connection->executeQuery($sql);
        if($record){
            return $this->createDevice($record[0]);
        }
        return null;
    }
    
    public function deleteSearch($id) {
        return parent::delete($this->tableName, $id);
    }
    
    public function updateSearch($id, $fields) {
        return parent::update($this->tableName, $id, $fields);
    }
    
    public function createSearch(Search $search){
        return parent::create($this->tableName, $object);
    }

    protected function toObject($record) {
        return new Search(
          $record['id'],$record['idUser'],
          $record['brand'],$record['priceMin'],
          $record['priceMax'], $record['warranty'],
          $record['waterproof'], $record['screenDefinition'],
          $record['screenResolutionMin'],$record['screenResolutionMax'],
          $record['screenSizeMin'],$record['screenSizeMax'],$record['screenPanel'],
          $record['CPUModel'], $record['CPUFrequencyMin'], $record['CPUFrequencyMax'],
          $record['CPUCoreMin'],$record['CPUCoreMax'],$record['RAMMin'],$record['RAMMax'],
          $record['cameraResolutionMin'], $record['cameraResolutionMax'],
          $record['frontCameraResolutionMin'],$record['frontCameraResolutionMax'],
          $record['flash'],$record['sizeHeighMin'],$record['sizeHeighMax'],
          $record['sizeWidthMin'], $record['sizeWidthMax'], $record['sizeThicknessMin'], 
          $record['sizeThicknessMax'],$record['weightMin'],$record['weightMax'],
          $record['batteryCapacityMin'],$record['batteryCapacityMax'],
          $record['storageMin'], $record['storageMax'],$record['externalStorage'],
          $record['software'],$record['dateInsert']
        );
    }

    protected function toSql($search) {
       return "(".$search->getId().",".$search->getUser().",".$search->getBrand().",".$search->getPriceMin().","
               .$search->getPriceMax().",".$search->getWarranty().",".$search->getWaterproof().","
               .$search->getScreenDefinition().",".$search->getScreenResolutionMin().",".$search->getScreenResolutionMax().","
               .$search->getScreenSizeMin().",".$search->getScreenSizeMax().",".$search->getScreenPanel().","
                .$search->getCPUModel().",".$search->getCPUFrequencyMin().",".$search->getCPUFrequencyMax().","
                .$search->getCPUCoreMin().",".$search->getCPUCoreMax().",".$search->getRAMMin().","
                .$search->getRAMMax().",".$search->getCameraResolutionMin().",".$search->getCameraResolutionMax().","
                .$search->getFrontCameraResolutionMin().",".$search->getFrontCameraResolutionMax().",".$search->getFlash().","
                .$search->getSizeHeighMin().",".$search->getSizeHeighMax().""
                .$search->getSizeWidthMin().",".$search->getSizeWidthMax().",".$search->getSizeThicknessMin().","
                .$search->getSizeThicknessMax().",".$search->getWeightMin().",".$search->getWeightMax().","
                .$search->getBatteryCapacityMin().",".$search->getBatteryCapacityMax().",".$search->getStorageMin().","
                .$search->getStorageMax().",".$search->getExternalStorage().",".$search->getSoftware().","
                .$search->getDateInsert().")";
    }

}
