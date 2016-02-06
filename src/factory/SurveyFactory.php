<?php

/**
 * Description of SurveyFactory
 *
 * @author sowf
 */
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
        if(is_null(self::$instance)) {
            self::$instance = new SurveyFactory();  
        }
        return self::$instance;
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
    
   
    public function createSurvey(Survey $user){
       return parent::create($this->tableName, $user);
    }
    
    protected function toObject($record) {
        return new Survey(
          $record['id'],$record['user'],
          $record['search'],$record['email'],
          $record['percentage']
        );
    }

    protected function toSql($survey) {
         return "(".$survey->getId().",".$survey->getUser().",".$survey->getSearch().",".$survey->getPercentage().")";

    }
}
