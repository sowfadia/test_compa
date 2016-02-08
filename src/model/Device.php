<?php

/**
 * The class representing a device
 *
 * @author sowf
 */
class Device {
    private $id;
    private $provider;
    private $brand;
    private $model;
    private $price;
    private $warranty;
    private $waterproof;
    private $screenDefinition;
    private $screenResolution;
    private $screenSize;
    private $screenPanel;
    private $CPUModel;
    private $CPUFrequency;
    private $CPUCore;
    private $RAM;
    private $cameraResolution;
    private $frontCameraResolution;
    private $flash;
    private $sizeHeigh;
    private $sizeWidth;
    private $sizeThickness;
    private $weight;
    private $batteryCapacity;
    private $storage;
    private $externalStorage;
    private $software;
    private $image;
    
    function __construct($id, $provider, $brand, $model, $price, $warranty, $waterproof, $screenDefinition,$screenResolution, $screenSize, $screenPanel, $CPUModel, $CPUFrequency, $CPUCore, $RAM, $cameraResolution, $frontCameraResolution, $flash, $sizeHeigh, $sizeWidth, $sizeThickness, $weight, $batteryCapacity, $storage, $externalStorage, $software, $image) {
        $this->id = $id;
        $this->provider = $provider;
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
        $this->warranty = $warranty;
        $this->waterproof = $waterproof;
        $this->screenDefinition = $screenDefinition;
        $this->screenResolution = $screenResolution;
        $this->screenSize = $screenSize;
        $this->screenPanel = $screenPanel;
        $this->CPUModel = $CPUModel;
        $this->CPUFrequency = $CPUFrequency;
        $this->CPUCore = $CPUCore;
        $this->RAM = $RAM;
        $this->cameraResolution = $cameraResolution;
        $this->frontCameraResolution = $frontCameraResolution;
        $this->flash = $flash;
        $this->sizeHeigh = $sizeHeigh;
        $this->sizeWidth = $sizeWidth;
        $this->sizeThickness = $sizeThickness;
        $this->weight = $weight;
        $this->batteryCapacity = $batteryCapacity;
        $this->storage = $storage;
        $this->externalStorage = $externalStorage;
        $this->software = $software;
        $this->image = $image;
    }

    function getId() {
        return $this->id;
    } 

    function getName() {
        return $this->name;
    }

    function getProvider() {
        return $this->provider;
    }

    function getBrand() {
        return $this->brand;
    }

    function getModel() {
        return $this->model;
    }

    function getPrice() {
        return $this->price;
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

    function getScreenResolution() {
        return $this->screenResolution;
    }

    function getScreenSize() {
        return $this->screenSize;
    }

    function getScreenPanel() {
        return $this->screenPanel;
    }

    function getCPUModel() {
        return $this->CPUModel;
    }

    function getCPUFrequency() {
        return $this->CPUFrequency;
    }

    function getCPUCore() {
        return $this->CPUCore;
    }

    function getRAM() {
        return $this->RAM;
    }

    function getCameraResolution() {
        return $this->cameraResolution;
    }

    function getFrontCameraResolution() {
        return $this->frontCameraResolution;
    }

    function getFlash() {
        return $this->flash;
    }

    function getSizeHeigh() {
        return $this->sizeHeigh;
    }

    function getSizeWidth() {
        return $this->sizeWidth;
    }

    function getSizeThickness() {
        return $this->sizeThickness;
    }

    function getWeight() {
        return $this->weight;
    }

    function getBatteryCapacity() {
        return $this->batteryCapacity;
    }

    function getStorage() {
        return $this->storage;
    }

    function getExternalStorage() {
        return $this->externalStorage;
    }

    function getSoftware() {
        return $this->software;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setProvider($provider) {
        $this->provider = $provider;
    }

    function setBrand($brand) {
        $this->brand = $brand;
    }

    function setModel($model) {
        $this->model = $model;
    }

    function setPrice($price) {
        $this->price = $price;
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

    function setScreenResolution($screenResolution) {
        $this->screenResolution = $screenResolution;
    }

    function setScreenSize($screenSize) {
        $this->screenSize = $screenSize;
    }

    function setScreenPanel($screenPanel) {
        $this->screenPanel = $screenPanel;
    }

    function setCPUModel($CPUModel) {
        $this->CPUModel = $CPUModel;
    }

    function setCPUFrequency($CPUFrequency) {
        $this->CPUFrequency = $CPUFrequency;
    }

    function setCPUCore($CPUCore) {
        $this->CPUCore = $CPUCore;
    }

    function setRAM($RAM) {
        $this->RAM = $RAM;
    }

    function setCameraResolution($cameraResolution) {
        $this->cameraResolution = $cameraResolution;
    }

    function setFrontCameraResolution($frontCameraResolution) {
        $this->frontCameraResolution = $frontCameraResolution;
    }

    function setFlash($flash) {
        $this->flash = $flash;
    }

    function setSizeHeigh($sizeHeigh) {
        $this->sizeHeigh = $sizeHeigh;
    }

    function setSizeWidth($sizeWidth) {
        $this->sizeWidth = $sizeWidth;
    }

    function setSizeThickness($sizeThickness) {
        $this->sizeThickness = $sizeThickness;
    }

    function setWeight($weight) {
        $this->weight = $weight;
    }

    function setBatteryCapacity($batteryCapacity) {
        $this->batteryCapacity = $batteryCapacity;
    }

    function setStorage($storage) {
        $this->storage = $storage;
    }

    function setExternalStorage($externalStorage) {
        $this->externalStorage = $externalStorage;
    }

    function setSoftware($software) {
        $this->software = $software;
    }
  
    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }  
}
