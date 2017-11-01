<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SubmissionReminder extends CI_Model{

	private $fhw_number = [
		"cr_bidan" => [
         
	];

	function __construct() {
        parent::__construct();
        $this->load->model('Rapidpro');
    }

    private function send_message($msg,$to){
        $status = $this->Rapidpro->postBroadcasts($msg,$to);
        if(!($status[0]!='E')){
            $this->send_message($msg, $to);
        }
        return $status;
    }

    public function ec_reminder($fhw='',$cd)
    {
        $this->load->model('LocationEcModel');
        $loc = $this->LocationEcModel->getIntLocId($fhw);
    	$today = date("Y-m-d");
    	$this->load->model('AnalyticsEcModel');
    	$data = $this->AnalyticsEcModel->getSubmissionCount($fhw,$today);
    	foreach ($loc as $locId => $name) {
    		$count = $data[$locId];
    		if($count == 0){
    			$pesan = "Selamat sore bapak/ibu. SMS ini merupakan SMS dari sistem. SMS ini sebagai pengingat bapak/ibu untuk mengentry data  dari pelayanan hari ini. Bila bapak/ibu sudah melakukan pengentryan, mohon mensinkronkan aplikasi. Terimakasih.";
    			$penerima = $this->fhw_number[$cd.'_'.$fhw][$name]['tel'];
                $status = $this->send_message($pesan,[$penerima]);
                var_dump($status);
    		}
    	}
    }

    public function cr_reminder($fhw='',$cd)
    {
        $this->load->model('LocationModel');
        $loc = $this->LocationModel->getIntLocId($fhw);
    	$today = date("Y-m-d");
    	$this->load->model('AnalyticsModel');
    	$data = $this->AnalyticsModel->getSubmissionCount($fhw,$today);
    	foreach ($loc as $locId => $name) {
    		$count = $data[$locId];
    		if($count == 0){
    			$pesan = "Selamat sore bapak/ibu. SMS ini merupakan SMS dari sistem. SMS ini sebagai pengingat bapak/ibu untuk mengentry data  dari pelayanan hari ini. Bila bapak/ibu sudah melakukan pengentryan, mohon mensinkronkan aplikasi. Terimakasih.";
    			$penerima = $this->fhw_number[$cd.'_'.$fhw][$locId]['tel'];
                $status = $this->send_message($pesan,[$penerima]);
                var_dump($status);
    		}
    	}
    }
    
}
