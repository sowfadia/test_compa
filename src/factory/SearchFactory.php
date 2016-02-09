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
        return parent::create($search);
    }

    protected function toObject($record) {
        return new Search(
                $record['id'],
                $record['iduser'],
                $record['brand'],
                $record['pricemin'],
                $record['pricemax'], 
                $record['warranty'],
                $record['waterproof'], 
                $record['screendefinition'],
                $record['screenresolutionmin'],
                $record['screenresolutionmax'],
                $record['screensizemin'],
                $record['screensizemax'],
                $record['screenpanel'],
                $record['cpumodel'], 
                $record['cpufrequencymin'], 
                $record['cpufrequencymax'],
                $record['cpucoremin'],
                $record['cpucoremax'],
                $record['rammin'],
                $record['rammax'],
                $record['cameraresolutionmin'], 
                $record['cameraresolutionmax'],
                $record['frontcameraresolutionmin'],
                $record['frontcameraresolutionmax'],
                $record['flash'],
                $record['sizeheighmin'],
                $record['sizeheighmax'],
                $record['sizewidthmin'], 
                $record['sizewidthmax'], 
                $record['sizethicknessmin'], 
                $record['sizethicknessmax'],
                $record['weightmin'],
                $record['weightmax'],
                $record['batterycapacitymin'],
                $record['batterycapacitymax'],
                $record['storagemin'], 
                $record['storagemax'],
                $record['externalstorage'],
                $record['software'],
                $record['dateinsert']
        );
    }

    protected function toSql($search) {
        if(!is_null($search) && ($search instanceof Search)){
            return "insert into ".$this->tableName."(\"iduser\",\"brand\",\"pricemin\",\"pricemax\","
                    ."\"warranty\",\"waterproof\",\"screendefinition\",\"screenresolutionmin\",\"screenresolutionmax\","
                    . "\"screensizemin\",\"screensizemax\",\"screenpanel\",\"cpumodel\",\"cpufrequencymin\",\"cpufrequencymax\","
                    . "\"cpucoremin\",\"cpucoremax\",\"rammin\",\"rammax\",\"cameraresolutionmin\",\"cameraresolutionmax\",\"frontcameraresolutionmin\",\"frontcameraresolutionmax\","
                    . "\"flash\",\"sizeheighmin\",\"sizeheighmax\",\"sizewidthmin\",\"sizewidthmax\",\"sizethicknessmin\",\"sizethicknessmax\",\"weightmin\",\"weightmax\","
                    . "\"batterycapacitymin\",\"batterycapacitymax\",\"storagemin\",\"storagemax\",\"externalstorage\",\"software\") values ("
                    .$this->paramToSql($search->getUser()).","
                    .$this->paramToSql($search->getBrand()).","
                    .$this->paramToSql($search->getPriceMin()).","
                    .$this->paramToSql($search->getPriceMax()).","
                    .$this->paramToSql($search->getWarranty()).","
                    .$this->paramToSql($search->getWaterproof()).","
                    .$this->paramToSql($search->getScreenDefinition()).","
                    .$this->paramToSql($search->getScreenResolutionMin()).","
                    .$this->paramToSql($search->getScreenResolutionMax()).","
                    .$this->paramToSql($search->getScreenSizeMin()).","
                    .$this->paramToSql($search->getScreenSizeMax()).","
                    .$this->paramToSql($search->getScreenPanel()).","
                    .$this->paramToSql($search->getCPUModel()).","
                    .$this->paramToSql($search->getCPUFrequencyMin()).","
                    .$this->paramToSql($search->getCPUFrequencyMax()).","
                    .$this->paramToSql($search->getCPUCoreMin()).","
                    .$this->paramToSql($search->getCPUCoreMax()).","
                    .$this->paramToSql($search->getRAMMin()).","
                    .$this->paramToSql($search->getRAMMax()).","
                    .$this->paramToSql($search->getCameraResolutionMin()).","
                    .$this->paramToSql($search->getCameraResolutionMax()).","
                    .$this->paramToSql($search->getFrontCameraResolutionMin()).","
                    .$this->paramToSql($search->getFrontCameraResolutionMax()).","
                    .$this->paramToSql($search->getFlash()).","
                    .$this->paramToSql($search->getSizeHeighMin()).","
                    .$this->paramToSql($search->getSizeHeighMax()).","
                    .$this->paramToSql($search->getSizeWidthMin()).","
                    .$this->paramToSql($search->getSizeWidthMax()).","
                    .$this->paramToSql($search->getSizeThicknessMin()).","
                    .$this->paramToSql($search->getSizeThicknessMax()).","
                    .$this->paramToSql($search->getWeightMin()).","
                    .$this->paramToSql($search->getWeightMax()).","
                    .$this->paramToSql($search->getBatteryCapacityMin()).","
                    .$this->paramToSql($search->getBatteryCapacityMax()).","
                    .$this->paramToSql($search->getStorageMin()).","
                    .$this->paramToSql($search->getStorageMax()).","
                    .$this->paramToSql($search->getExternalStorage()).","
                    .$this->paramToSql($search->getSoftware()).")";
     }
        throw new Exception("the parameter is not an instantance of Device ", null, null);
   }
   
   public function findByCriteriaImpl($criterias){
        $criteriaString="";
        $nbfields = count($criterias);
        foreach ($criterias as $key => $value) {
          $criteriaString .= $key." = ".$this->paramToSql($value)."";
          $nbfields --;
          if($nbfields > 0) {
              $criteriaString .= " and "; 
          }
        }
        return parent::findByCriteria($this->tableName, $criteriaString);
    }

}
