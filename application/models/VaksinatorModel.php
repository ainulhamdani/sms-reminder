<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VaksinatorModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    public function getSubmissionCount($fhw="",$today=""){
        $yesterday = date("Y-m-d",strtotime($today." -1 day"));
        $analyticsDB = $this->load->database('vaksinator', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM opensrp_vaksinator");
        $table_default = $this->Table->getTable($fhw);
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_opensrp_vaksinator, $table_default)){
                $tables[$table->Tables_in_opensrp_vaksinator]=$table_default[$table->Tables_in_opensrp_vaksinator];
            }
        }
        //make result array from the tables name
        $result_data = [];
        $loc = $this->LocationModel->getIntLocId($fhw);
        foreach ($loc as $locId => $name) {
            $result_data[$locId] = 0;
        }
        
        foreach ($table_default as $table=>$legend){
            $query = $analyticsDB->query("SELECT userID, DATE(clientVersionSubmissionDate) as dateCreated from ".$table." where (DATE(clientVersionSubmissionDate) LIKE '".$today."%' or DATE(clientVersionSubmissionDate) LIKE '".$yesterday."%')");
            foreach ($query->result() as $datas) {
                if(array_key_exists($datas->userID, $result_data)){
                    $result_data[$datas->userID]++;
                }
            }
        }
        
        return $result_data;
    }
}