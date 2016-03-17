<?php

class Search {
    private $id;
    private $iduser;
    private $brand;
    private $priceMin;
    private $priceMax;
    private $warranty;
    private $waterproof;
    private $screenDefinition;
    private $screenResolutionMin;
    private $screenResolutionMax;
    private $screenSizeMin;  		
    private $screenSizeMax;  		
    private $screenPanel;		
    private $CPUModel;		
    private $CPUFrequencyMin;		
    private $CPUFrequencyMax;		
    private $CPUCoreMin;		
    private $CPUCoreMax;		
    private $RAMMin;			
    private $RAMMax;			
    private $cameraResolutionMin;	
    private $cameraResolutionMax;	
    private $frontCameraResolutionMin; 
    private $frontCameraResolutionMax; 
    private $flash;			
    private $sizeHeighMin;		
    private $sizeHeighMax;		
    private $sizeWidthMin;		
    private $sizeWidthMax;		
    private $sizeThicknessMin;	
    private $sizeThicknessMax;	
    private $weightMin;      		
    private $weightMax;      		
    private $batteryCapacityMin;  	
    private $batteryCapacityMax;  	
    private $storageMin;      	
    private $storageMax;      	
    private $externalStorage;		
    private $software;		
    private $dateInsert;
    
    function __construct($id, $user, $brand, $priceMin, $priceMax, $warranty, $waterproof, $screenDefinition, $screenResolutionMin, $screenResolutionMax, $screenSizeMin, $screenSizeMax, $screenPanel, $CPUModel, $CPUFrequencyMin, $CPUFrequencyMax, $CPUCoreMin, $CPUCoreMax, $RAMMin, $RAMMax, $cameraResolutionMin, $cameraResolutionMax, $frontCameraResolutionMin, $frontCameraResolutionMax, $flash, $sizeHeighMin, $sizeHeighMax, $sizeWidthMin, $sizeWidthMax, $sizeThicknessMin, $sizeThicknessMax, $weightMin, $weightMax, $batteryCapacityMin, $batteryCapacityMax, $storageMin, $storageMax, $externalStorage, $software, $dateInsert) {
        $this->id = $id;
        $this->iduser = $user;
        $this->brand = $brand;
        $this->priceMin = $priceMin;
        $this->priceMax = $priceMax;
        $this->warranty = $warranty;
        $this->waterproof = $waterproof;
        $this->screenDefinition = $screenDefinition;
        $this->screenResolutionMin = $screenResolutionMin;
        $this->screenResolutionMax = $screenResolutionMax;
        $this->screenSizeMin = $screenSizeMin;
        $this->screenSizeMax = $screenSizeMax;
        $this->screenPanel = $screenPanel;
        $this->CPUModel = $CPUModel;
        $this->CPUFrequencyMin = $CPUFrequencyMin;
        $this->CPUFrequencyMax = $CPUFrequencyMax;
        $this->CPUCoreMin = $CPUCoreMin;
        $this->CPUCoreMax = $CPUCoreMax;
        $this->RAMMin = $RAMMin;
        $this->RAMMax = $RAMMax;
        $this->cameraResolutionMin = $cameraResolutionMin;
        $this->cameraResolutionMax = $cameraResolutionMax;
        $this->frontCameraResolutionMin = $frontCameraResolutionMin;
        $this->frontCameraResolutionMax = $frontCameraResolutionMax;
        $this->flash = $flash;
        $this->sizeHeighMin = $sizeHeighMin;
        $this->sizeHeighMax = $sizeHeighMax;
        $this->sizeWidthMin = $sizeWidthMin;
        $this->sizeWidthMax = $sizeWidthMax;
        $this->sizeThicknessMin = $sizeThicknessMin;
        $this->sizeThicknessMax = $sizeThicknessMax;
        $this->weightMin = $weightMin;
        $this->weightMax = $weightMax;
        $this->batteryCapacityMin = $batteryCapacityMin;
        $this->batteryCapacityMax = $batteryCapacityMax;
        $this->storageMin = $storageMin;
        $this->storageMax = $storageMax;
        $this->externalStorage = $externalStorage;
        $this->software = $software;
        $this->dateInsert = $dateInsert;
    }

    function getId() {
        return $this->id;
    }

    function getUser() {
        return $this->iduser;
    }

    function getBrand() {
        return $this->brand;
    }

    function getPriceMin() {
        return $this->priceMin;
    }

    function getPriceMax() {
        return $this->priceMax;
    }

    function getWarranty() {
        return $this->warranty;
    }

    function getWaterproof() {
        return $this->waterproof;
    }

    function getScreenDefinition() {
        return $this->screenDefinition;
    }

    function getScreenResolutionMin() {
        return $this->screenResolutionMin;
    }

    function getScreenResolutionMax() {
        return $this->screenResolutionMax;
    }

    function getScreenSizeMin() {
        return $this->screenSizeMin;
    }

    function getScreenSizeMax() {
        return $this->screenSizeMax;
    }

    function getScreenPanel() {
        return $this->screenPanel;
    }

    function getCPUModel() {
        return $this->CPUModel;
    }

    function getCPUFrequencyMin() {
        return $this->CPUFrequencyMin;
    }

    function getCPUFrequencyMax() {
        return $this->CPUFrequencyMax;
    }

    function getCPUCoreMin() {
        return $this->CPUCoreMin;
    }

    function getCPUCoreMax() {
        return $this->CPUCoreMax;
    }

    function getRAMMin() {
        return $this->RAMMin;
    }

    function getRAMMax() {
        return $this->RAMMax;
    }

    function getCameraResolutionMin() {
        return $this->cameraResolutionMin;
    }

    function getCameraResolutionMax() {
        return $this->cameraResolutionMax;
    }

    function getFrontCameraResolutionMin() {
        return $this->frontCameraResolutionMin;
    }

    function getFrontCameraResolutionMax() {
        return $this->frontCameraResolutionMax;
    }

    function getFlash() {
        return $this->flash;
    }

    function getSizeHeighMin() {
        return $this->sizeHeighMin;
    }

    function getSizeHeighMax() {
        return $this->sizeHeighMax;
    }

    function getSizeWidthMin() {
        return $this->sizeWidthMin;
    }

    function getSizeWidthMax() {
        return $this->sizeWidthMax;
    }

    function getSizeThicknessMin() {
        return $this->sizeThicknessMin;
    }

    function getSizeThicknessMax() {
        return $this->sizeThicknessMax;
    }

    function getWeightMin() {
        return $this->weightMin;
    }

    function getWeightMax() {
        return $this->weightMax;
    }

    function getBatteryCapacityMin() {
        return $this->batteryCapacityMin;
    }

    function getBatteryCapacityMax() {
        return $this->batteryCapacityMax;
    }

    function getStorageMin() {
        return $this->storageMin;
    }

    function getStorageMax() {
        return $this->storageMax;
    }

    function getExternalStorage() {
        return $this->externalStorage;
    }

    function getSoftware() {
        return $this->software;
    }

    function getDateInsert() {
        return $this->dateInsert;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser($user) {
        $this->iduser = $user;
    }

    function setBrand($brand) {
        $this->brand = $brand;
    }

    function setPriceMin($priceMin) {
        $this->priceMin = $priceMin;
    }

    function setPriceMax($priceMax) {
        $this->priceMax = $priceMax;
    }

    function setWarranty($warranty) {
        $this->warranty = $warranty;
    }

    function setWaterproof($waterproof) {
        $this->waterproof = $waterproof;
    }

    function setScreenDefinition($screenDefinition) {
        $this->screenDefinition = $screenDefinition;
    }

    function setScreenResolutionMin($screenResolutionMin) {
        $this->screenResolutionMin = $screenResolutionMin;
    }

    function setScreenResolutionMax($screenResolutionMax) {
        $this->screenResolutionMax = $screenResolutionMax;
    }

    function setScreenSizeMin($screenSizeMin) {
        $this->screenSizeMin = $screenSizeMin;
    }

    function setScreenSizeMax($screenSizeMax) {
        $this->screenSizeMax = $screenSizeMax;
    }

    function setScreenPanel($screenPanel) {
        $this->screenPanel = $screenPanel;
    }

    function setCPUModel($CPUModel) {
        $this->CPUModel = $CPUModel;
    }

    function setCPUFrequencyMin($CPUFrequencyMin) {
        $this->CPUFrequencyMin = $CPUFrequencyMin;
    }

    function setCPUFrequencyMax($CPUFrequencyMax) {
        $this->CPUFrequencyMax = $CPUFrequencyMax;
    }

    function setCPUCoreMin($CPUCoreMin) {
        $this->CPUCoreMin = $CPUCoreMin;
    }

    function setCPUCoreMax($CPUCoreMax) {
        $this->CPUCoreMax = $CPUCoreMax;
    }

    function setRAMMin($RAMMin) {
        $this->RAMMin = $RAMMin;
    }

    function setRAMMax($RAMMax) {
        $this->RAMMax = $RAMMax;
    }

    function setCameraResolutionMin($cameraResolutionMin) {
        $this->cameraResolutionMin = $cameraResolutionMin;
    }

    function setCameraResolutionMax($cameraResolutionMax) {
        $this->cameraResolutionMax = $cameraResolutionMax;
    }

    function setFrontCameraResolutionMin($frontCameraResolutionMin) {
        $this->frontCameraResolutionMin = $frontCameraResolutionMin;
    }

    function setFrontCameraResolutionMax($frontCameraResolutionMax) {
        $this->frontCameraResolutionMax = $frontCameraResolutionMax;
    }

    function setFlash($flash) {
        $this->flash = $flash;
    }

    function setSizeHeighMin($sizeHeighMin) {
        $this->sizeHeighMin = $sizeHeighMin;
    }

    function setSizeHeighMax($sizeHeighMax) {
        $this->sizeHeighMax = $sizeHeighMax;
    }

    function setSizeWidthMin($sizeWidthMin) {
        $this->sizeWidthMin = $sizeWidthMin;
    }

    function setSizeWidthMax($sizeWidthMax) {
        $this->sizeWidthMax = $sizeWidthMax;
    }

    function setSizeThicknessMin($sizeThicknessMin) {
        $this->sizeThicknessMin = $sizeThicknessMin;
    }

    function setSizeThicknessMax($sizeThicknessMax) {
        $this->sizeThicknessMax = $sizeThicknessMax;
    }

    function setWeightMin($weightMin) {
        $this->weightMin = $weightMin;
    }

    function setWeightMax($weightMax) {
        $this->weightMax = $weightMax;
    }

    function setBatteryCapacityMin($batteryCapacityMin) {
        $this->batteryCapacityMin = $batteryCapacityMin;
    }

    function setBatteryCapacityMax($batteryCapacityMax) {
        $this->batteryCapacityMax = $batteryCapacityMax;
    }

    function setStorageMin($storageMin) {
        $this->storageMin = $storageMin;
    }

    function setStorageMax($storageMax) {
        $this->storageMax = $storageMax;
    }

    function setExternalStorage($externalStorage) {
        $this->externalStorage = $externalStorage;
    }

    function setSoftware($software) {
        $this->software = $software;
    }

    function setDateInsert($dateInsert) {
        $this->dateInsert = $dateInsert;
    }


}
