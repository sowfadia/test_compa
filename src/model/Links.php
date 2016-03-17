<?php

class Links {
    private $id;
    private $iduser;
    private $idprovider;
    private $dateinsert;
    
    function __construct($id, $iduser, $idprovider, $dateinsert) {
        $this->id = $id;
        $this->iduser = $iduser;
        $this->idprovider = $idprovider;
        $this->dateinsert = $dateinsert;
    }
    
    function getId() {
        return $this->id;
    }

    function getIdUser() {
        return $this->iduser;
    }
    function getIdProvider() {
        return $this->idprovider;
    }
    function getDateinsert() {
        return $this->dateinsert;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setIduser($iduser) {
        $this->iduser = $iduser;
    }
    function setIdprovder($idprovder) {
        $this->idprovider = $idprovider;
    }
    function setDateinsert($dateinsert) {
        $this->dateinsert = $dateinsert;
    }
}
