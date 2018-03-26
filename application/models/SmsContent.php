<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SmsContent extends CI_Model{

	function __construct() {
        parent::__construct();
    }

    private $KOORDINATOR = [
    	"bidan" => [
    		"Darek"=> "Ruhun",
            "Pengadang"=> "Naning",
            "Kopang"=> "Deni Arisandi",
            "Mantang"=> "Hj. Siti Fatmah",
            "Mujur"=> "",
            "Puyung"=> "Zohriah",
            "Ubung"=> "Ni Wayan Sumerti Armi",
            "Janapria"=> "Astuti Mulyani",
            "Sengkol"=> "Erna Juliani"
    	],
    	"gizi" => [
    		"Darek"=> "S. Jumiarti",
            "Pengadang"=> "L. Istiqlal Anjaswari",
            "Kopang"=> "Heri Riady",
            "Mantang"=> "Hidayaturrahmi",
            "Mujur"=> "",
            "Puyung"=> "Lale Reny Marliandini",
            "Ubung"=> "Bq. Ery Hartini S",
            "Janapria"=> "Budi Hidayat",
            "Sengkol"=> ""
        ],
    	"vaksinator" => [
    		"Darek"=> "Bq. Sumaiyah",
            "Pengadang"=> "Mustiari",
            "Kopang"=> "Mrr. Sri Nandini",
            "Mantang"=> "Agus Jayadi",
            "Mujur"=> "",
            "Puyung"=> "Bq. Ririn Andriyani",
            "Ubung"=> "Ns. Abdul Hasim",
            "Janapria"=> "Putroma Sanjaya",
            "Sengkol"=> "Saptiarta Budi"
        ]
    ];

	private $THANKS_MESSAGE = "Selamat pagi bapak/ibu. Terima kasih telah mengentry data Anda. Berikut adalah rekap dari hasil data entry entry Anda kemarin: on-time submission xxx %.";
	private $REMINDER_MESSAGE = "Selamat sore bapak/ibu. SMS ini merupakan SMS dari sistem. SMS ini sebagai pengingat bapak/ibu untuk mengentry data  dari pelayanan hari ini. Bila bapak/ibu sudah melakukan pengentryan, mohon mensinkronkan aplikasi. Terimakasih.";
	private $TTD = " Tertanda, ";
	private $TTD_BIDAN = "Koordinator Bidan";
	private $TTD_GIZI = "Koordinator Gizi";
	private $TTD_VAKSIN = "Koordinator P2P";

	public function getREMINDER_MESSAGE($fhw,$loc=""){
		$msg = $this->REMINDER_MESSAGE.$this->TTD;
		if($loc!=""){
			$msg .= $this->KOORDINATOR[$fhw][$loc].", ";
		}
		if($fhw=="bidan"){
			$msg .= $this->TTD_BIDAN;
		}elseif($fhw=="gizi"){
			$msg .= $this->TTD_GIZI;
		}elseif($fhw=="vaksinator"){
			$msg .= $this->TTD_VAKSIN;
		}
		return $msg;
	}

	public function getTHANKS_MESSAGE($fhw,$loc=""){
		$msg = $this->THANKS_MESSAGE.$this->TTD;
		if($loc!=""){
			$msg .= $this->KOORDINATOR[$fhw][$loc].", ";
		}
		if($fhw=="bidan"){
			$msg .= $this->TTD_BIDAN;
		}elseif($fhw=="gizi"){
			$msg .= $this->TTD_GIZI;
		}elseif($fhw=="vaksinator"){
			$msg .= $this->TTD_VAKSIN;
		}
		return $msg;
	}
}