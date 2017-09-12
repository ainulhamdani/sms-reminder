<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EcHealthPromotion extends CI_Model{
    
    private $bidan_num = [
                       '+6281916097333'=>array('nama'=>'Yani Sasmarani','tel'=>'+6281916097333'),
                       '+6287765681750'=>array('nama'=>'Bq. Wardatul Jannah','tel'=>'+6287765681750'),
                       '+6281803648244'=>array('nama'=>'Sylvia Puspita','tel'=>'+6281803648244'),
                       '+6281907802238'=>array('nama'=>'Laelaturahmi','tel'=>'+6281907802238'),
                       '+6287763442828'=>array('nama'=>'Bq. Nurhayati','tel'=>'+6287763442828'),
                       '+6287765981625'=>array('nama'=>'Nini Marsini','tel'=>'+6287765981625'),
                       '+6287864198845'=>array('nama'=>'Khairani','tel'=>'+6287864198845'),
                       '+6281907341641'=>array('nama'=>'Eri Sulistiani','tel'=>'+6281907341641'),
                       '+6281998961032'=>array('nama'=>'Lisa Isnaeni','tel'=>'+6281998961032'),
                       '+6281805778989'=>array('nama'=>'Sulhani','tel'=>'+6281805778989')];
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->load->model('Rapidpro');
    }
    
    private function getAllcontacts($group,$page=''){
        $all = [];
        $contact = json_decode($this->Rapidpro->getContacts($group,$page));
        $all = array_merge($all,$contact->results);
        if($contact->next!=null){
            $page = explode("page=", $contact->next);
            $contact = $this->getAllcontacts($group, $page[1]);
            $all = array_merge($all,$contact);
        }
        return $all;
    }
    
    public function broadcastsql(){
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $allcontacts = $this->getAllcontacts("Ibu");
        $contacts = array();
        foreach ($allcontacts as $contact){
            $contacts[$contact->phone]['name'] = $contact->name;
            $contacts[$contact->phone]['group_num'] = count($contact->groups);
        }
        $all_data = array();
        $count = 0;
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $query  = $analyticsDB->query("SELECT * FROM event_bidan_tambah_anc GROUP BY baseEntityId");
        
        $query2 = $analyticsDB->query("SELECT baseEntityId FROM event_bidan_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->baseEntityId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT baseEntityId FROM event_bidan_penutupan_anc")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->baseEntityId] = TRUE;
        }
        
        $query2 = $analyticsDB->query("SELECT event_bidan_identitas_ibu.baseEntityId,NomorTelponHp,client_ibu.namaLengkap FROM event_bidan_identitas_ibu LEFT JOIN client_ibu ON event_bidan_identitas_ibu.baseEntityId=client_ibu.baseEntityId")->result();
        $dataibu = [];
        foreach ($query2 as $q){
            if(array_key_exists($q->baseEntityId, $dataibu)){
                array_push($dataibu[$q->baseEntityId], $q);
            }else{
                $dataibu[$q->baseEntityId] = [];
                array_push($dataibu[$q->baseEntityId], $q);
            }
        }
        
        foreach ($query->result() as $ibuhamil){
            if(array_key_exists($ibuhamil->baseEntityId, $dataibu)){
                foreach ($dataibu[$ibuhamil->baseEntityId] as $ibu){
                    if($ibu->NomorTelponHp!=""&&$ibu->NomorTelponHp!="NULL"){
                        $num = (string)$ibu->NomorTelponHp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
                        if(array_key_exists($num, $this->bidan_num))continue;
                        $all_data[$num]['closed'] = FALSE;
                        $all_data[$num]['saved'] = FALSE;
                        $all_data[$num]['changed'] = FALSE;
                        if(array_key_exists($num, $contacts)){
                            $all_data[$num]['group_num'] = $contacts[$num]['group_num'];
                            $all_data[$num]['saved'] = TRUE;
                        }else{
                            $all_data[$num]['group_num'] = 0;
                        }
                        $hpht = date("Y-m-d", strtotime($ibuhamil->tanggalHPHT));
                        if($hpht < $batas){
                            $all_data[$num]['closed'] = TRUE;
                        }
                        if(array_key_exists($ibuhamil->baseEntityId, $dataclose)){
                            $all_data[$num]['closed'] = TRUE;
                        }
                        if(array_key_exists($ibuhamil->baseEntityId, $datapnc)){
                            $all_data[$num]['closed'] = TRUE;
                        }
                        if(($all_data[$num]['group_num']==4)==$all_data[$num]['closed']||$all_data[$num]['group_num']==0){
                            $all_data[$num]['changed'] = TRUE;
                        }
                        $all_data[$num]['name'] = $ibu->namaLengkap;
                        $all_data[$num]['tglhamil'] = $ibuhamil->tanggalHPHT.' 00:00';
                        $all_data[$num]['op'] = $this->cekNomor($num);
                        $count++;
                    }
                }
            }
        }
//        var_dump($contacts);
//        var_dump($all_data);
//        var_dump($count);
//        exit;
                    
        $returndata = array();
        foreach ($all_data as $num=>$ibu){
            if($ibu['changed']){
                $temp = array();
                $temp['name'] = $ibu['name'];
                $temp['saved'] = $ibu['saved'];
                $temp['group_num'] = $ibu['group_num'];
                $temp['tel'] = array($num);
                if($ibu['closed']){
                    $temp['groups'] = array("Ibu");
                }else{
                    if($ibu['op']=="Telkomsel"){
                        $temp['groups'] = array("Ibu","Ibu Hamil","Intervention","Ibu Hamil Telkomsel");
                    }
                    else{
                        $temp['groups'] = array("Ibu","Ibu Hamil","Intervention","Ibu Hamil XL");
                    }
                }
                $temp['fields'] = array("tanggal_kehamilan"=>$ibu['tglhamil']);
                array_push($returndata, $temp);
            }
        }
        return $returndata;
    }
    
    private function cekNomor($num){
        $tel = ["11"=>TRUE,"12"=>TRUE,"13"=>TRUE,"21"=>TRUE,"22"=>TRUE,"23"=>TRUE,"52"=>TRUE,"53"=>TRUE,"51"=>TRUE];
        $temp = explode("+628", $num);
        $pre = substr($temp[1], 0,2);
        if(array_key_exists($pre, $tel)){
            return "Telkomsel";
        }else{
            return "XL";
        }
    }
}