<?php

/**
 * The research class
 *
 * @author sowf
 */
class Search {
    private $id;
    private $iduser;
    private $frequency;	
    private $dateInsert;
    private $url;
    
    function __construct($id, $iduser, $frequency, $dateInsert, $url) {
        $this->id = $id;
        $this->iduser = $iduser;
        $this->frequency = $frequency;
        $this->dateInsert = $dateInsert;
        $this->url = $url;
    }

    
    function getDateInsert() {
        return $this->dateInsert;
    }

    function getUrl() {
        return $this->url;
    }

    function setDateInsert($dateInsert) {
        $this->dateInsert = $dateInsert;
    }

    function setUrl($url) {
        $this->url = $url;
    }
    
    function getId() {
        return $this->id;
    }

    function getIduser() {
        return $this->iduser;
    }

    function getFrequency() {
        return $this->frequency;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIduser($iduser) {
        $this->iduser = $iduser;
    }

    function setFrequency($frequency) {
        $this->frequency = $frequency;
    }
}
