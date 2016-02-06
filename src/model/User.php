<?php

/**
 * The user class
 *
 * @author sowf
 */
class User {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $telephone;
    private $adresse;
    private $login;
    private $password;
    private $modalite;
    private $dateInsert;
    
    function __construct($id, $firstName, $lastName, $email, $telephone, $adresse,$login, $password,$modalite,$dateInsert) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->$telephone = $telephone;
        $this->adresse = $adresse;
        $this->login=$login;
        $this->password = $password;
        $this->modalite = $modalite;
        $this->dateInsert=$dateInsert;
    }
    
    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function getPassword() {
        return $this->password;
    }

    function getModalite() {
        return $this->modalite;
    }
    function setPassword($password) {
        $this->password = $password;
    }

    function setModalite($modalite) {
        $this->modalite = $modalite;
    }
    
    function getLogin() {
        return $this->login;
    }
    function setLogin($login) {
        $this->login = $login;
    }
    
    function getDateInsert() {
        return $this->dateInsert;
    }

    function setDateInsert($dateInsert) {
        $this->dateInsert = $dateInsert;
    }

}
