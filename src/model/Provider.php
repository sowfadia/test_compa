<?php

class Provider {
    private $id;
    private $name;
    private $email;
    private $telephone;
    private $contactpage;
    private $address;
    private $password;
    private $contactpreference;
    private $profil;
    private $description;
    private $urlProducts;
    
    function __construct($id, $name, $email, $telephone, $contactpage, $address, $password, $contactpreference, $profil, $description, $urlProducts) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->contactpage = $contactpage;
        $this->address = $address;
        $this->password = $password;
        $this->contactpreference = $contactpreference;
        $this->profil = $profil;
        $this->description = $description;
        $this->urlProducts = $urlProducts;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getContactpage() {
        return $this->contactpage;
    }

    function getAddress() {
        return $this->address;
    }

    function getPassword() {
        return $this->password;
    }

    function getContactpreference() {
        return $this->contactpreference;
    }

    function getProfil() {
        return $this->profil;
    }

    function getDescription() {
        return $this->description;
    }

    function getUrlProducts() {
        return $this->urlProducts;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setContactpage($contactpage) {
        $this->contactpage = $contactpage;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setContactpreference($contactpreference) {
        $this->contactpreference = $contactpreference;
    }

    function setProfil($profil) {
        $this->profil = $profil;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setUrlProducts($urlProducts) {
        $this->urlProducts = $urlProducts;
    }
}