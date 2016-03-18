<?php

class Survey {
    private $id;
    private $iduser;
    private $idsearch;
    private $note;
    
    function __construct($id, $iduser, $idsearch, $note) {
         $this->id = $id;
         $this->iduser = $iduser;
         $this->idsearch = $idsearch;
         $this->note = $note;
    }
    
    function getIduser() {
         return $this->iduser;
     }
 
     function getIdsearch() {
         return $this->idsearch;
     }
 
     function getNote() {
         return $this->note;
     }
 
     function setId($id) {
         $this->id = $id;
     }
 
     function setIduser($iduser) {
         $this->iduser = $iduser;
     }
     
     function getId() {
         return $this->id;
     }

     function setIdsearch($idsearch) {
         $this->idsearch = $idsearch;
     }

     function setNote($note) {
         $this->note = $note;
     }
}
