<?php
// NOT YET FUNCTIONING, STILL ....
defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsEcModel extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->model('AnalyticsEcTableModel','Table');
    }

    public function getSubmissionCount($fhw="",$today=""){
        $yesterday = date("Y-m-d",strtotime($today." -1 day"));
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable($fhw);
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        //make result array from the tables name
        $result_data = [];
        $loc = $this->LocationEcModel->getIntLocId($fhw);
        foreach ($loc as $locId => $name) {
            $result_data[$locId] = 0;
        }
        
        foreach ($table_default as $table=>$legend){
            $query = $analyticsDB->query("SELECT locationId, dateCreated from ".$table." where (dateCreated LIKE '".$today."%' or dateCreated LIKE '".$yesterday."%')");
            foreach ($query->result() as $datas) {
                if(array_key_exists($datas->locationId, $result_data)){
                    $result_data[$datas->locationId]++;
                }
            }
        }
        
        return $result_data;
    }
    
}