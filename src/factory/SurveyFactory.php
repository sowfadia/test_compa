<?php

class SurveyFactory extends Factory{
    private $tableName="compa.survey";
    
      /**
     * The single instance of the factory
     */
    protected static $instance;
    
    /**
     * constructor 
     */
    public function __construct() {}
    
    /**
     * gets the unique instance of this factory
     * @return ProviderFactory, the Factory's singleton
     */
    public static function getInstance(){
        if(is_null(static::$instance)) {
            static::$instance = new SurveyFactory();  
        }
        return static::$instance;
    }
    

    public function getSurveys() {
        return parent::getAll($this->tableName);
    }

    
    public function findSurveyById($id) {
        return parent::findById($this->tableName, $id);
    }
    
    
    public function deleteSurvey($id) {
       return parent::delete($this->tableName, $id);
    }
    
    
    public function updateSurvey($id,$fields){
        return parent::update($this->tableName, $id, $fields);
    }
    
   
    public function createSurvey($survey){
       return parent::create($survey);
    }
    
    protected function toObject($record) {
        return new Survey(
          $record['id'],$record['iduser'],
          $record['idsearch'],$record['note']
        );
    }

    protected function toSql($survey) {
          return "insert into ".$this->tableName."(\"iduser\",\"idsearch\",\"note\") values ("
                     . $this->paramToSql($survey->getIduser()).",".$this->paramToSql($survey->getIdSearch()).",".$this->paramToSql($survey->getNote()).")";

    }
    
    public function findByCriteriaImpl($criterias) {
        $criteriaString = "";
        $nbfields = count($criterias);
        foreach ($criterias as $key => $value) {
            $criteriaString .= $key . " = " . $this->paramToSql($value) . "";
            $nbfields --;
            if ($nbfields > 0) {
                $criteriaString .= " and ";
            }
        }
        return parent::findByCriteria($this->tableName, $criteriaString);
    }
}
