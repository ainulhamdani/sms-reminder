<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HealthPromotion extends CI_Model{
    
    //private $bidans = [array('user'=>'user1','nama'=>'Dani','tel'=>'+6281916029525'),array('user'=>'user2','nama'=>'Siti','tel'=>'+6287864564295'),array('user'=>'user3','nama'=>'Iqbal','tel'=>'+6283129303996'),array('user'=>'user4','nama'=>'Rana','tel'=>'+6285945005439'),array('user'=>'user5','nama'=>'Eka','tel'=>'+628563452936'),array('user'=>'user6','nama'=>'Ocha','tel'=>'+6285242617161')];
    private $bidans = [array('user'=>'user1'),array('user'=>'user2'),array('user'=>'user3'),array('user'=>'user4'),array('user'=>'user5'),array('user'=>'user6'),array('user'=>'user8'),array('user'=>'user9'),array('user'=>'user10'),array('user'=>'user11'),array('user'=>'user12'),array('user'=>'user13'),array('user'=>'user14')];
    private $bidan_num = [
                       '+6281907679110'=>array('nama'=>'Sri Maryani','tel'=>'+6281907679110'),
                       '+62818364744'=>array('nama'=>'Sumiati','tel'=>'+62818364744'),
                       '+6281936784100'=>array('nama'=>'Hj. Ismayati','tel'=>'+6281936784100'),
                       '+6281907280006'=>array('nama'=>'Indah Kurniawati','tel'=>'+6281907280006'),
                       '+6285934646216'=>array('nama'=>'Suhaeni','tel'=>'+6285934646216'),
                       '+6287864607228'=>array('nama'=>'Tuti Alawiyah','tel'=>'+6287864607228'),
                       '+6281917374736'=>array('nama'=>'Bq. Silvia','tel'=>'+6281917374736'),
                       '+6281805753100'=>array('nama'=>'Erna Kuspitawati','tel'=>'+6281805753100'),
                       '+6281999483435'=>array('nama'=>'Ning Suryaningsih','tel'=>'+6281999483435'),
                       '+6281246158988'=>array('nama'=>'Dwinta','tel'=>'+6281246158988'),
                       '+6281917946598'=>array('nama'=>'Munah','tel'=>'+6281917946598'),
                       '+6281902831937'=>array('nama'=>'Eka Zuryatun','tel'=>'+6281902831937')
    ];
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Makassar"); 
        $this->load->model('Rapidpro');
    }
    
    public function broadcast(){
        $all_data = array();
        $count = 0;
        foreach ($this->bidans as $bidan){
            $data = $this->couchdb->getView('Anc','anc_'.$bidan['user']);
            $all_ibu = $this->couchdb->getView('Kartu_ibu','registration_'.$bidan['user']);
            //var_dump($all_ibu->rows);exit;
            //array_push($all_data,$data);
            $ibu[$bidan['user']] = array();
            foreach ($data->rows as $d){
                $obj = array();
                foreach ($d->value as $value){
                    if(isset($value->value)) $obj[$value->name] = $value->value;
                }
                $anc = (object)$obj;
                $temp = null;
                for($i=0;$i<$all_ibu->total_rows;$i++){
                    if($all_ibu->rows[$i]->key==$anc->kiId){
                        $temp = $all_ibu->rows[$i];
                    }
                }
                //var_dump($temp);
                if($temp==null) continue;
                $obj = array();
                foreach ($temp->value as $value){
                    if(isset($value->value)) $obj[$value->name] = $value->value;
                }
                $temp = (object)$obj;
                if(isset($obj['NomorTelponHp'])&&$obj['NomorTelponHp']!="None"&&$obj['NomorTelponHp']!=""){
                    if(!array_key_exists($temp->NomorTelponHp, $ibu[$bidan['user']])){
                        $ibu[$bidan['user']][$temp->NomorTelponHp] = $temp->namalengkap;
                        $count++;
                    }
                }
            }
//            var_dump($ibu);
        }
        foreach ($ibu as $user=>$data){
            echo $user.":<br>";
            foreach ($data as $num=>$name){
                $num = (string)$num;
                if(substr($num, 0,1)=='0'){
                    $num[0] = '+';
                    $num = str_replace('+',"+62",$num);
                }else{
                    $num[0] = '+';
                    $num = str_replace('+',"+628",$num);
                }
                echo ' '.$num.' - '.$name.'<br>';
            }
        }
        echo "jumlah: ".$count;
        //var_dump($all_data);
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
        $analyticsDB = $this->load->database('analytics', TRUE);
        $allcontacts = $this->getAllcontacts("Ibu");
        $contacts = array();
        foreach ($allcontacts as $contact){
            $contacts[$contact->phone]['name'] = $contact->name;
            $contacts[$contact->phone]['group_num'] = count($contact->groups);
        }
        $all_data = array('user1'=>array(),'user2'=>array(),'user3'=>array(),'user4'=>array(),'user5'=>array(),'user6'=>array(),'user8'=>array(),'user9'=>array(),'user10'=>array(),'user11'=>array(),'user12'=>array(),'user13'=>array(),'user14'=>array());
        $count = 0;
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $query  = $analyticsDB->query("SELECT * FROM kartu_anc_registration GROUP BY motherId");
        
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->motherId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_anc_close")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->motherId] = TRUE;
        }
        
        $query2 = $analyticsDB->query("SELECT kiId,NomorTelponHp,namalengkap FROM kartu_ibu_registration")->result();
        $dataibu = [];
        foreach ($query2 as $q){
            if(array_key_exists($q->kiId, $dataibu)){
                array_push($dataibu[$q->kiId], $q);
            }else{
                $dataibu[$q->kiId] = [];
                array_push($dataibu[$q->kiId], $q);
            }
        }
        
        foreach ($query->result() as $ibuhamil){
            if(array_key_exists($ibuhamil->kiId, $dataibu)){
                foreach ($dataibu[$ibuhamil->kiId] as $ibu){
                    if($ibu->NomorTelponHp!=""&&$ibu->NomorTelponHp!="None"){
                        $num = (string)$ibu->NomorTelponHp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
                        if(array_key_exists($num, $this->bidan_num))continue;
                        $all_data[$ibuhamil->userID][$num]['closed'] = FALSE;
                        $all_data[$ibuhamil->userID][$num]['saved'] = FALSE;
                        $all_data[$ibuhamil->userID][$num]['changed'] = FALSE;
                        if(array_key_exists($num, $contacts)){
                            $all_data[$ibuhamil->userID][$num]['group_num'] = $contacts[$num]['group_num'];
                            $all_data[$ibuhamil->userID][$num]['saved'] = TRUE;
                        }else{
                            $all_data[$ibuhamil->userID][$num]['group_num'] = 0;
                        }
                        $hpht = date("Y-m-d", strtotime($ibuhamil->tanggalHPHT));
                        if($hpht < $batas){
                            $all_data[$ibuhamil->userID][$num]['closed'] = TRUE;
                        }
                        if(array_key_exists($ibuhamil->motherId, $dataclose)){
                            $all_data[$ibuhamil->userID][$num]['closed'] = TRUE;
                        }
                        if(array_key_exists($ibuhamil->motherId, $datapnc)){
                            $all_data[$ibuhamil->userID][$num]['closed'] = TRUE;
                        }
                        if(($all_data[$ibuhamil->userID][$num]['group_num']==4)==$all_data[$ibuhamil->userID][$num]['closed']||$all_data[$ibuhamil->userID][$num]['group_num']==0){
                            $all_data[$ibuhamil->userID][$num]['changed'] = TRUE;
                        }
                        $all_data[$ibuhamil->userID][$num]['name'] = $ibu->namalengkap;
                        $all_data[$ibuhamil->userID][$num]['tglhamil'] = $ibuhamil->tanggalHPHT.' 00:00';
                        $all_data[$ibuhamil->userID][$num]['op'] = $this->cekNomor($num);
                        $count++;
                    }
                }
            }
        }
//        var_dump($contacts);
//        var_dump($all_data);
//        var_dump($count);
        //exit;
                    
        $returndata = array();
        foreach ($all_data as $user=>$data){
            foreach ($data as $num=>$ibu){
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
                            $temp['groups'] = array("Ibu","Ibu Hamil","Pilot","Ibu Hamil Telkomsel");
                        }
                        else{
                            $temp['groups'] = array("Ibu","Ibu Hamil","Pilot","Ibu Hamil XL");
                        }
                    }
                    $temp['fields'] = array("tanggal_kehamilan"=>$ibu['tglhamil']);
                    array_push($returndata, $temp);
                }
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