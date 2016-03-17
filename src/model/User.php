<?php

class User {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $dateInsert;
    
    function __construct($id, $firstName, $lastName, $email, $password, $dateInsert) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->dateInsert = $dateInsert;
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

    function getPassword() {
        return $this->password;
    }

    function getDateInsert() {
        return $this->dateInsert;
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

    function setPassword($password) {
        $this->password = $password;
    }

    function setDateInsert($dateInsert) {
        $this->dateInsert = $dateInsert;
    }
}
