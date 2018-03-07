<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SubmissionReminder extends CI_Model{

	private $fhw_number = [
		"cr_bidan" => [
         
	];

	function __construct() {
        parent::__construct();
        $this->load->model('Rapidpro');
        $this->load->model('SmsContent');
    }

    private function send_message($msg,$to){
        $status = $this->Rapidpro->postBroadcasts($msg,$to);
        if(!($status[0]!='E')){
            $this->send_message($msg, $to);
        }
        return $status;
    }

    public function ec_reminder($fhw='',$cd,$type)
    {
        $this->load->model('LocationEcModel');
        $loc = $this->LocationEcModel->getIntLocId($fhw);
    	$today = date("Y-m-d");
        $yesterday = date("Y-m-d", strtotime($today." -1 day"));
    	$this->load->model('AnalyticsEcModel');
    	$data = $this->AnalyticsEcModel->getSubmissionCount($fhw,$today);
        $this->load->model('EcOnTimeSubmissionModel');
        $ontime = $this->EcOnTimeSubmissionModel->getOnTimeFormByDate([$yesterday,$yesterday],$fhw);
    	foreach ($loc as $locId => $name) {
    		$count = $data[$locId];
    		if($count == 0){
                if($type=="reminder"){
                    $pesan = $this->SmsContent->getREMINDER_MESSAGE($fhw);
                    $penerima = $this->fhw_number[$cd.'_'.$fhw][$name]['tel'];
                    $status = $this->send_message($pesan,[$penerima]);
                    var_dump($status);
                }
    		}else{
                if($type=="thank"){
                    $pesan = $this->SmsContent->getTHANKS_MESSAGE($fhw);
                    $pesan = str_replace('xxx', $ontime['daily'][$name], $pesan);
                    $penerima = $this->fhw_number[$cd.'_'.$fhw][$name]['tel'];
                    $status = $this->send_message($pesan,[$penerima]);
                    var_dump($status);
                }
            }
    	}
    }

    public function cr_reminder($fhw='',$cd,$type)
    {
        $this->load->model('LocationModel');
        $loc = $this->LocationModel->getIntLocId($fhw);
    	$today = date("Y-m-d");
        $yesterday = date("Y-m-d", strtotime($today." -1 day"));
    	$this->load->model('AnalyticsModel');
    	$data = $this->AnalyticsModel->getSubmissionCount($fhw,$today);
        $this->load->model('OnTimeSubmissionModel');
        $ontime = $this->OnTimeSubmissionModel->getOnTimeFormByDate([$yesterday,$yesterday],$fhw);
    	foreach ($loc as $locId => $name) {
    		$count = $data[$locId];
    		if($count == 0){
                if($type=="reminder"){
                    $pesan = $this->SmsContent->getREMINDER_MESSAGE($fhw);
                    $penerima = $this->fhw_number[$cd.'_'.$fhw][$locId]['tel'];
                    $status = $this->send_message($pesan,[$penerima]);
                    var_dump($status);
                }
    		}else{
                if($type=="thank"){
                    $pesan = $this->SmsContent->getTHANKS_MESSAGE($fhw);
                    $pesan = str_replace('xxx', $ontime['daily'][$name], $pesan);
                    $penerima = $this->fhw_number[$cd.'_'.$fhw][$locId]['tel'];
                    $status = $this->send_message($pesan,[$penerima]);
                    var_dump($status);
                }
            }
    	}
    }
    
}
