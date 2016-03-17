<?php

/**
 * Description of Survey
 *
 * @author sowf
 */
class Survey {
    private $id;
    private $user;
    private $search;
    private $percentage;
    
    function __construct($id, $user, $search, $percentage) {
       $this->id=$id;
        $this->user = $user;
        $this->search = $search;
        $this->percentage = $percentage;
    }
    
    function getId() {
        return $this->id;
    }
    
    function getUser() {
        return $this->user;
    }

    function getSearch() {
        return $this->search;
    }

    function getPercentage() {
        return $this->percentage;
    }
    
}
