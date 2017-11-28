<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EcOnTimeSubmissionModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('AnalyticsEcTableModel','Table');
    }
    
    public function getOnTimeSubmission($mode="",$range="",$fhw){
        if($mode=="daily"){
            return $this->getDailyOnTime($range,$fhw);
        }else{
            return $this->getWeeklyOnTime($range,$fhw);
        }
    }
    
    public function getDailyOnTime($range="",$fhw){
        $location = $this->LocationEcModel->getIntLocId($fhw);
        $result_data = array();
        $detail = $this->getOnTimeFormByDate($range,$fhw);
        foreach ($detail as $x=>$d){
            $result_data[$x] = $d;
        }
        return $result_data;
    }
    
    public function getWeeklyOnTime($range="",$fhw){
        $location = $this->LocationEcModel->getIntLocId($fhw);
        $result_data = array();
        $detail = $this->getOnTimeForm("weekly",$range,$fhw);
        foreach ($detail as $x=>$d){
            $result_data[$x] = $d;
        }
        return $result_data;
    }
    
    public function getDailyOnTimeDesa($location="",$range="",$fhw){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('Tables_in_ec_analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable($fhw);
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
        
        $locations = $this->LocationEcModel->getLocIdQuery($location);
        
        $ontime = 0;
        $total = 0;
        
        foreach ($tables as $table=>$legend){
            //query tha data
            $query = $analyticsDB->query("SELECT * from ".$table." where ($locations) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."'");
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->locationId, $location)){
                    if($this->isOnTime($table,$datas,$fhw)){
                        $ontime +=1;
                    }
                    $total +=1;
                }
                
            }
        }
        
        if($total==0) return 0;
        else return (float)number_format(100*$ontime/$total,2);
    }
    
    
    private function isOnTime($table,$data,$fhw){
        $clientdate = explode(" ",$data->clientVersionSubmissionDate);
        $cdate = date_create($clientdate[0]);
        if($fhw=='bidan'){
            if($table=='event_bidan_kohort_kunjungan_bayi_perbulan'||$table=='event_bidan_kunjungan_balita'||$table=='event_bidan_kunjungan_neonatal'){
                $eventdate = explode(" ",$data->tanggalKunjunganBayiPerbulan);
            }elseif($table=='event_bidan_kohort_pelayanan_kb'){
                $eventdate = explode(" ",$data->tanggalkunjungan);
            }elseif($table=='event_bidan_kunjungan_anc'){
                $eventdate = explode(" ",$data->ancDate);
            }elseif($table=='event_bidan_kunjungan_pnc'){
                $eventdate = explode(" ",$data->PNCDate);
            }elseif($table=='event_bidan_tambah_bayi'){
                $eventdate = explode(" ",$data->tanggalPendaftaran);
            }elseif($table=='event_bidan_tambah_kb'){
                $eventdate = explode(" ",$data->tanggalPeriksa);
            }elseif($table=='event_bidan_kunjungan_anc_integrasi'||$table=='event_bidan_kunjungan_anc_lab_test'||$table=='event_bidan_tambah_anc'){
                $eventdate = explode(" ",$data->referenceDate);
            }else{
                $eventdate = explode(" ",$data->dateCreated);
            }
        }
        elseif($fhw=='gizi'){
            if($table=='event_gizi_kunjungan_gizi'){
                $eventdate = explode(" ",$data->tanggalPenimbangan);
            }else{
                $eventdate = explode(" ",$data->dateCreated);
            }
        }
        elseif($fhw=='vaksinator'){
            if($table=='event_bidan_kohort_pelayanan_kb'){
                $eventdate = explode(" ",$data->tanggalkunjungan);
            }else{
                $eventdate = explode(" ",$data->dateCreated);
            }
        }
        if($eventdate[0]=="NULL") return false;
        $evdate = date_create($eventdate[0]);
        $diff = date_diff($cdate,$evdate);
        if($diff->days<=1) return true;
        return false;
    }
    
    public function getWeeklyOnTimeDesa($location="",$range="",$fhw){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable($fhw);
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
        
        $locations = $this->LocationEcModel->getLocIdQuery($location);
        
        $ontime = 0;
        $total = 0;
        
        foreach ($tables as $table=>$legend){
            //query tha data
            $query = $analyticsDB->query("SELECT * from ".$table." where ($locations) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."'");
            
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->locationId, $location)){
                    if($this->isWeeklyOnTime($table,$datas,$fhw)){
                        $ontime +=1;
                    }
                    $total +=1;
                }
                
            }
        }
        
        if($total==0) return 0;
        else return (float)number_format(100*$ontime/$total,2);
    }
    
    private function isWeeklyOnTime($table,$data,$fhw){
        $clientdate = explode(" ",$data->clientVersionSubmissionDate);
        $cdate = date_create($clientdate[0]);
        if($fhw=='bidan'){
            if($table=='event_bidan_kohort_kunjungan_bayi_perbulan'||$table=='event_bidan_kunjungan_balita'||$table=='event_bidan_kunjungan_neonatal'){
                $eventdate = explode(" ",$data->tanggalKunjunganBayiPerbulan);
            }elseif($table=='event_bidan_kohort_pelayanan_kb'){
                $eventdate = explode(" ",$data->tanggalkunjungan);
            }elseif($table=='event_bidan_kunjungan_anc'){
                $eventdate = explode(" ",$data->ancDate);
            }elseif($table=='event_bidan_kunjungan_pnc'){
                $eventdate = explode(" ",$data->PNCDate);
            }elseif($table=='event_bidan_tambah_bayi'){
                $eventdate = explode(" ",$data->tanggalPendaftaran);
            }elseif($table=='event_bidan_tambah_kb'){
                $eventdate = explode(" ",$data->tanggalPeriksa);
            }elseif($table=='event_bidan_kunjungan_anc_integrasi'||$table=='event_bidan_kunjungan_anc_lab_test'||$table=='event_bidan_tambah_anc'){
                $eventdate = explode(" ",$data->referenceDate);
            }else{
                $eventdate = explode(" ",$data->dateCreated);
            }
        }
        elseif($fhw=='gizi'){
            if($table=='event_gizi_kunjungan_gizi'){
                $eventdate = explode(" ",$data->tanggalPenimbangan);
            }else{
                $eventdate = explode(" ",$data->dateCreated);
            }
        }
        elseif($fhw=='vaksinator'){
            if($table=='event_bidan_kohort_pelayanan_kb'){
                $eventdate = explode(" ",$data->tanggalkunjungan);
            }else{
                $eventdate = explode(" ",$data->dateCreated);
            }
        }
        if($eventdate[0]=="NULL") return false;
        $evdate = date_create($eventdate[0]);
        $diff = date_diff($cdate,$evdate);
        if($diff->days<=7) return true;
        return false;
    }
    
    //buat desa
    public function getOnTimeForm($mode="",$range="",$fhw){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable($fhw);
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
        
        $locId = $this->LocationEcModel->getIntLocId($fhw);$location = $this->LocationEcModel->getLocIdQuery($locId);
        
        //make result array from the tables name
        $result_data = array();
        $result_data['daily'] = array();
        foreach ($locId as $user=>$desa){
            $result_data['daily'][$desa] = 0;
            $data = array();
            foreach ($table_default as $t=>$tn){
                $data[$tn] = 0;
            }
            $result_data[$desa] = $data;
        }
        
        $deno = $result_data;
        
        foreach ($tables as $table=>$legend){
            //query tha data
            $query = $analyticsDB->query("SELECT * from ".$table." where ($location) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."'");
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->locationId, $locId)){
                    $data_count                  = $result_data[$locId[$datas->locationId]];
                    $data_count2                 = $deno[$locId[$datas->locationId]];
                    if($mode=='daily'){
                        if($this->isOnTime($table,$datas,$fhw)){
                            $result_data['daily'][$locId[$datas->locationId]] +=1;
                            $data_count[$table_default[$table]] +=1;
                        }
                    }else{
                        if($this->isWeeklyOnTime($table,$datas,$fhw)){
                            $result_data['daily'][$locId[$datas->locationId]] +=1;
                            $data_count[$table_default[$table]] +=1;
                        }
                    }
                    
                    $data_count2[$table_default[$table]] +=1;
                    $deno['daily'][$locId[$datas->locationId]] +=1;
                    $result_data[$locId[$datas->locationId]] = $data_count;
                    $deno[$locId[$datas->locationId]] = $data_count2;
                }
                
            }
        }
        
        foreach ($result_data as $desa=>$res){
            foreach ($res as $date=>$value){
                if($deno[$desa][$date]==0)continue;
                $result_data[$desa][$date] = (float)number_format(100*$result_data[$desa][$date]/$deno[$desa][$date],2);
            }
        }
        
        return $result_data;
    }
    
    public function getOnTimeFormByDate($range="",$fhw){
        date_default_timezone_set("Asia/Makassar"); 
        $end = new DateTime($range[1]);
        $end = $end->modify( '+1 day' );
        $period = new DatePeriod(
             new DateTime($range[0]),
             new DateInterval('P1D'),
             $end
        );
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable($fhw);
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
        
        $locId = $this->LocationEcModel->getIntLocId($fhw);$location = $this->LocationEcModel->getLocIdQuery($locId);
        
        //make result array from the tables name
        $result_data = array();
        $result_data['daily'] = array();
        foreach ($locId as $user=>$desa){
            $result_data['daily'][$desa] = 0;
            foreach (iterator_to_array($period) as $date){
                $result_data[$desa][$date->format("Y-m-d")] = 0;
            }
        }
        
        $deno = $result_data;
        
        foreach ($tables as $table=>$legend){
            //query tha data
            $query = $analyticsDB->query("SELECT * from ".$table." where ($location) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."'");
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->locationId, $locId)){
                    if($this->isOnTime($table,$datas,$fhw)){
                        $result_data['daily'][$locId[$datas->locationId]] +=1;
                        $result_data[$locId[$datas->locationId]][$datas->dateCreated] +=1;
                    }
                    
                    $deno['daily'][$locId[$datas->locationId]] +=1;
                    $deno[$locId[$datas->locationId]][$datas->dateCreated] +=1;
                }
                
            }
        }
        
        foreach ($result_data as $desa=>$res){
            foreach ($res as $date=>$value){
                if($deno[$desa][$date]==0)continue;
                $result_data[$desa][$date] = (float)number_format(100*$result_data[$desa][$date]/$deno[$desa][$date],2);
            }
        }
        
        return $result_data;
    }
    
    public function getOnTimeFormDesa($desa,$range,$fhw){
        date_default_timezone_set("Asia/Makassar"); 
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $query  = $analyticsDB->query("SHOW TABLES FROM ec_analytics");
        
        $table_default = $this->Table->getTable($fhw);
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
        $locId = $this->LocationEcModel->getLocIdAndDesabyDesa($desa);
        $location = $this->LocationEcModel->getLocIdQuery($locId);
        
        //make result array from the tables name
        $result_data = array();
        foreach ($locId as $user=>$desa){
            $data = array();
            foreach ($table_default as $t=>$tn){
                $data[$tn] = 0;
            }
            $result_data = $data;
        }
        $deno = $result_data;
        
        $result_data = array();
        foreach ($locId as $user=>$desa){
            $data = array();
            foreach ($table_default as $t=>$tn){
                $data[$tn] = 0;
            }
            $result_data['daily'] = $data;
            $result_data['weekly'] = $data;
        }
        
        foreach ($tables as $table=>$legend){
            //query tha data
            $query = $analyticsDB->query("SELECT * from ".$table." where ($location) AND dateCreated >= '".$range[0]."' AND dateCreated <= '".$range[1]."'");
            
            foreach ($query->result() as $datas){
                if(array_key_exists($datas->locationId, $locId)){
                    $data_daily                  = $result_data['daily'];
                    $data_weekly                 = $result_data['weekly'];
                    $data_denum                  = $deno;
                    
                    if($this->isOnTime($table,$datas,$fhw)){
                        $data_daily[$table_default[$table]] +=1;
                    }
                    if($this->isWeeklyOnTime($table,$datas,$fhw)){
                        $data_weekly[$table_default[$table]] +=1;
                    }
                    
                    $data_denum[$table_default[$table]] +=1;
                    $result_data['daily'] = $data_daily;
                    $result_data['weekly'] = $data_weekly;
                    $deno = $data_denum;
                }
                
            }
        }
        
        foreach ($result_data as $mode=>$res){
            foreach ($res as $form=>$value){
                if($deno[$form]==0)continue;
                $result_data[$mode][$form] = (float)number_format(100*$result_data[$mode][$form]/$deno[$form],2);
            }
        }
        
        return $result_data;
    }
}