<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SmsContent extends CI_Model{

	function __construct() {
        parent::__construct();
    }

	private $THANKS_MESSAGE = "Selamat pagi bapak/ibu. Terima kasih telah mengentry data Anda. Berikut adalah rekap dari hasil data entry entry Anda kemarin: on-time submission xxx %.";
	private $REMINDER_MESSAGE = "Selamat sore bapak/ibu. SMS ini merupakan SMS dari sistem. SMS ini sebagai pengingat bapak/ibu untuk mengentry data  dari pelayanan hari ini. Bila bapak/ibu sudah melakukan pengentryan, mohon mensinkronkan aplikasi. Terimakasih.";
	private $TTD_BIDAN = " Tertanda, Bidan Koordinator";
	private $TTD_GIZI = " Tertanda, Kepala Puskesmas";
	private $TTD_VAKSIN = " Tertanda, Koordinator P2P";

	public function getREMINDER_MESSAGE($fhw){
		if($fhw=="bidan"){
			return $this->REMINDER_MESSAGE.$this->TTD_BIDAN;
		}elseif($fhw=="gizi"){
			return $this->REMINDER_MESSAGE.$this->TTD_GIZI;
		}elseif($fhw=="vaksinator"){
			return $this->REMINDER_MESSAGE.$this->TTD_VAKSIN;
		}else{
			return $this->REMINDER_MESSAGE;
		}
	}

	public function getTHANKS_MESSAGE($fhw){
		if($fhw=="bidan"){
			return $this->THANKS_MESSAGE.$this->TTD_BIDAN;
		}elseif($fhw=="gizi"){
			return $this->THANKS_MESSAGE.$this->TTD_GIZI;
		}elseif($fhw=="vaksinator"){
			return $this->THANKS_MESSAGE.$this->TTD_VAKSIN;
		}else{
			return $this->THANKS_MESSAGE;
		}
	}
}