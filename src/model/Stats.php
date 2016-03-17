<?php

class Stats {
    private $id;
    private $nbusers;
    private $nbproviders;
    private $nbsearch;
    private $nbdevices;
    private $nblinks;
    private $dateinsert;
    
    function __construct($id, $nbusers, $nbproviders, $nbsearch, $nbdevices, $nblinks) {
        $this->id = $id;
        $this->nbusers = $nbusers;
        $this->nbproviders = $nbproviders;
        $this->nbsearch = $nbsearch;
        $this->nbdevices = $nbdevices;
        $this->nblinks = $nblinks;
    }

    function getId() {
        return $this->id;
    } 

    function getNbusers() {
        return $this->nbusers;
    } 

    function getNbproviders() {
        return $this->nbproviders;
    } 

    function getNbsearch() {
        return $this->nbsearch;
    } 

    function getNbdevices() {
        return $this->nbdevices;
    } 

    function getNblinks() {
        return $this->nblinks;
    } 

    function getDateinsert() {
        return $this->dateinsert;
    } 
    
    function setId($id) {
        $this->id = $id;
    }

    function setNbusers($nbusers) {
        $this->nbusers = $nbusers;
    }

    
    function setNbproviders($nbproviders) {
        $this->nbproviders = $nbproviders;
    }

    
    function setNbsearch($nbsearch) {
        $this->nbsearch = $nbsearch;
    }

    
    function setNbdevices($nbdevices) {
        $this->nbdevices = $nbdevices;
    }

    
    function setNblinks($nblinks) {
        $this->nblinks = $nblinks;
    }

    
    function setDateinsert($dateinsert) {
        $this->dateinsert = $dateinsert;
    }

}