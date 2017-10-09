<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GiziEcModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('AnalyticsEcTableModel','Table');
    }
    
    public function getCountPerDay($kecamatan="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
                }
                
            }
        }
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        if($range!=""){
            foreach ($users as $user=>$desa){
                $begin = new DateTime($range[0]);
                $end = new DateTime($range[1]);
                $data = array();
                for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                    $date    = $i->format("Y-m-d");
                    $data[$date] = 0;
                }
                $result_data[$desa] = $data;
            }
        }else{
            foreach ($users as $user=>$desa){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = 0;
                }
                $result_data[$desa] = $data;
            }
        }
        
        
        foreach ($tables as $table=>$legend){
            
            //query tha data
            if($range!=""){
                $query = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where ($location) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."' group by locationId, dateCreated");
            }else{
                $query = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where ($location) AND dateCreated >= '".date("Y-m-d",strtotime("-30 days"))."' AND dateCreated <= '".date("Y-m-d")."' group by locationId, dateCreated");
            }
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $tgl = explode('T', $datas->dateCreated);
                    $tgl = $tgl[0];
                    if(array_key_exists($tgl, $data_count)){
                        $data_count[$tgl] +=$datas->counts;
                    }
                    $result_data[$users[$datas->userid]] = $data_count;
                }
                
            }
        }
        
        
        return $result_data;
    }
    
    public function getCountPerDayByVisitDate($kecamatan="",$mode="",$range=""){
        if($mode!=""){
            return self::getCountPerMode($kecamatan,$mode);
        }
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
                }
                
            }
        }
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        if($range!=""){
            foreach ($users as $user=>$desa){
                $begin = new DateTime($range[0]);
                $end = new DateTime($range[1]);
                $data = array();
                for($i=$begin;$begin<=$end;$i->modify('+1 day')){
                    $date    = $i->format("Y-m-d");
                    $data[$date] = 0;
                }
                $result_data[$desa] = $data;
            }
        }else{
            foreach ($users as $user=>$desa){
                $data = array();
                for($i=1;$i<=30;$i++){
                    $day     = 30-$i;
                    $date    = date("Y-m-d",  strtotime("-".$day." days"));
                    $data[$date] = 0;
                }
                $result_data[$desa] = $data;
            }
        }
        
        
        foreach ($tables as $table=>$legend){
            //query tha data
            if($range!=""){
                $query = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where ($location) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."' group by locationId, dateCreated");
            }else{
                $query = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where ($location) AND dateCreated >= '".date("Y-m-d",strtotime("-30 days"))."' AND dateCreated <= '".date("Y-m-d")."' group by locationId, dateCreated");
            }
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $tgl = explode('T', $datas->dateCreated);
                    $tgl = $tgl[0];
                    if(array_key_exists($tgl, $data_count)){
                        $data_count[$tgl] +=$datas->counts;
                    }
                    $result_data[$users[$datas->userid]] = $data_count;
                }
                
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerMode($kecamatan="",$mode="Mingguan"){
        date_default_timezone_set("Asia/Makassar"); 
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
                }
                
            }
        }
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        $result_data = array();
        $now    = date("Y-m-d");
        foreach ($users as $user=>$desa){
            $data = array();
            
            if($mode=='Mingguan'){
                $data['thisweek'] = array();
                $data['lastweek'] = array();                       
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"-")."-".$days." days"));
                    $day_temp[$date] = 0;
                }
                $data['thisweek'] = $day_temp;
                $day_temp = array();
                for($i=1;$i<=6;$i++){
                    $days     = 6-$i;
                    $date    = date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"last Saturday ":"")."-".$days." days"));
                    $day_temp[$date] = 0;
                }
                $data['lastweek'] = $day_temp;
                
            }elseif($mode=='Bulanan'){
                $data['thisyear'] = array();
                $data['lastyear'] = array();
                $this_month = date("n");
                $month  = array();
                for($i=1;$i<=12;$i++){
                    $date   = date("Y-m",strtotime("+".(-$this_month+$i)." months"));
                    $month[$date]   =   0;
                }
                $data['thisyear'] = $month;
                $month  = array();
                for($i=1;$i<=12;$i++){
                    $date   = date("Y-m",strtotime("+".(-$this_month+$i-12)." months"));
                    $month[$date]   =   0;
                }
                $data['lastyear'] = $month;
            }
            $result_data[$desa] = $data;
        }
        
        
        foreach ($tables as $table=>$legend){
            
            //query tha data
            if($mode=='Mingguan'){
                $query = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where ($location) AND dateCreated >= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 7)?"last Saturday ":"-7 days")."-5 days"))."' AND dateCreated <= '".date("Y-m-d",  strtotime((!(date('N', strtotime($now)) >= 6)?"next Saturday ":"-1 days")))."' group by locationId, dateCreated");
            }elseif($mode=='Bulanan'){
                $query = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where ($location) AND dateCreated >= '".date("Y-m",strtotime("+".(-$this_month-11)." months"))."' AND dateCreated <= '".date("Y-m",strtotime("+".(12-$this_month)." months"))."' group by locationId, dateCreated");
            }
            
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    if($mode=='Mingguan'){
                        $week   =   $result_data[$users[$datas->userid]];
                        $thisweek   = $week['thisweek'];
                        $lastweek   = $week['lastweek'];
                        $tgl = explode('T', $datas->dateCreated);
                        $tgl = $tgl[0];
                        if(array_key_exists($tgl, $thisweek)){
                            $thisweek[$tgl] +=$datas->counts;
                        }
                        if(array_key_exists($tgl, $lastweek)){
                            $lastweek[$tgl] +=$datas->counts;
                        }
                        $week['thisweek'] = $thisweek;
                        $week['lastweek'] = $lastweek;
                        $result_data[$users[$datas->userid]] = $week;
                    }elseif($mode=='Bulanan'){
                        $month = $result_data[$users[$datas->userid]];
                        $thisyear = $month['thisyear'];
                        $lastyear = $month['lastyear'];
                        $tgl = explode('T', $datas->dateCreated);
                        $tgl = $tgl[0];
                        $m = explode('-', $tgl);
                        array_pop($m);
                        $tgl = implode('-',$m);
                        if(array_key_exists($tgl, $thisyear)){
                            $thisyear[$tgl] +=$datas->counts;
                        }
                        if(array_key_exists($tgl, $lastyear)){
                            $lastyear[$tgl] +=$datas->counts;
                        }
                        $month['thisyear'] = $thisyear;
                        $month['lastyear'] = $lastyear;
                        $result_data[$users[$datas->userid]] = $month;
                    }
                }
                
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerForm($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
                }
            }
        }
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($tables as $table=>$legend){
                $table_name = 0;
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        
        foreach ($table_default as $table=>$legend){
            
            //query tha data
            $query = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where ($location) AND dateCreated >= '$start' AND dateCreated <= '$end' group by locationId, dateCreated");
            
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $data_count[$legend]         += $datas->counts;
                    $result_data[$users[$datas->userid]] = $data_count;
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormByVisitDate($kecamatan="",$start,$end){
        $end = date("Y-m-d",  strtotime($end." +1 day"));
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if($table->Tables_in_ec_analytics[0]=='c'||$table->Tables_in_ec_analytics[0]=='_'){
                continue;
            }else {
                if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                    $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
                }
            }
        }
        
        $users = $this->loc->getLocId($kecamatan);$location = $this->loc->getLocIdQuery($users);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            foreach ($tables as $table=>$legend){
                $table_name = 0;
                $data[$legend] = $table_name;
            }
            $result_data[$desa] = $data;
        }
        
        //retrieve all the columns in the table
        $columns = array();
        foreach ($table_default as $table=>$legend){
            $query = $giziDB->query("SHOW COLUMNS FROM ".$table);
            foreach ($query->result() as $column){
                array_push($columns, $column->Field);
            }
            
            //query tha data
            $query = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where ($location) AND dateCreated >= '$start' AND dateCreated <= '$end' group by locationId, dateCreated");
            
            foreach ($query->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$users[$datas->userid]];
                    $data_count[$legend]         += $datas->counts;
                    $result_data[$users[$datas->userid]] = $data_count;
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormForDrill($desa="",$date=""){
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        $tabindex = $this->Table->getTableIndex('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getLocIdAndDesabyDesa(str_replace('_',' ',$desa));
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            $data[$date] = array();
            foreach ($table_default as $table=>$table_name){
                $data[$date]["name"] = $date;
                $data[$date]["id"] = $date;
                $data[$date]["data"] = array();
                foreach ($table_default as $td=>$td_name){
                    array_push($data[$date]["data"], array($td_name,0));
                }
            }
            $result_data = $data;
        }
        
        
        foreach ($tables as $table=>$legend){
            
            //query tha data
            reset($users);
            $query3 = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where dateCreated LIKE '".$date."%' group by locationId, dateCreated");
            foreach ($query3->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$date];
                    if(array_key_exists($table, $table_default)){
                        $data_count["data"][$tabindex[$table]][1]         += $datas->counts;
                    }
                    
                    $result_data[$date] = $data_count;
                }
            }
        }
        
        return $result_data;
    }
    
    public function getCountPerFormByVisitDateForDrill($desa="",$date=""){
        $giziDB = $this->load->database('analytics', TRUE);
        $query  = $giziDB->query("SHOW TABLES FROM ec_analytics");
        $table_default = $this->Table->getTable('gizi');
        $tabindex = $this->Table->getTableIndex('gizi');
        //retrieve the tables name
        $tables = array();
        foreach ($query->result() as $table){
            if(array_key_exists($table->Tables_in_ec_analytics, $table_default)){
                $tables[$table->Tables_in_ec_analytics]=$table_default[$table->Tables_in_ec_analytics];
            }
        }
        
        $users = $this->loc->getLocIdAndDesabyDesa(str_replace('_',' ',$desa));
        
        //make result array from the tables name
        $result_data = array();
        foreach ($users as $user=>$desa){
            $data = array();
            $data[$date] = array();
            foreach ($table_default as $table=>$table_name){
                $data[$date]["name"] = $date;
                $data[$date]["id"] = $date;
                $data[$date]["data"] = array();
                foreach ($table_default as $td=>$td_name){
                    array_push($data[$date]["data"], array($td_name,0));
                }
            }
            $result_data = $data;
        }
        
        foreach ($tables as $table=>$legend){
            //query tha data
            reset($users);
            $query3 = $giziDB->query("SELECT locationId as userid, dateCreated,count(*) as counts from ".$table." where dateCreated LIKE '".$date."%' group by locationId, dateCreated");
            foreach ($query3->result() as $datas){
                $datas->userid = trim($datas->userid);
                if(array_key_exists($datas->userid, $users)){
                    $data_count                  = $result_data[$date];
                    if(array_key_exists($table, $table_default)){
                        $data_count["data"][$tabindex[$table]][1]         += $datas->counts;
                    }
                    
                    $result_data[$date] = $data_count;
                }
            }
        }
        
        return $result_data;
    }
}