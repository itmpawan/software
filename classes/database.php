<?php 
class database extends db { // inheretance of db class

    public $Query;

    /*
        * Query method to accept all DB queries
    */

    public function queryExecute($query , $param = [] ){
        if(empty($param)){

            /*
            * If we dont have the parameters
            */ 
            $this->Query = $this->db->prepare($query);
            return $this->Query->execute();

        }else{
            /*
               * if we have some parameters
             */ 
           
            $this->Query = $this->db->prepare($query);
            return $this->Query->execute($param);

        }

    }

    /*
        * Count the number of rows
    */ 

    public function countRows(){
       return $this->Query->rowCount();
    }

    /*
       * Fetch all records from specific table
    */ 

    public function fetchAllRecords(){
        return $this->Query->fetchAll(PDO::FETCH_OBJ);
    }

    /*
        * fetch single row from specific table
    */ 

    public function singleRecord(){
        return $this->Query->fetch(PDO::FETCH_OBJ);
    }


}
?>