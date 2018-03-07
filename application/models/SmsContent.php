<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SmsContent extends CI_Model{

	public $THANKS_MESSAGE = "Selamat pagi bapak/ibu. Terima kasih telah mengentry data Anda. Berikut adalah rekap dari hasil data entry entry Anda kemarin: on-time submission xxx %.";
	public $REMINDER_MESSAGE = "Selamat sore bapak/ibu. SMS ini merupakan SMS dari sistem. SMS ini sebagai pengingat bapak/ibu untuk mengentry data  dari pelayanan hari ini. Bila bapak/ibu sudah melakukan pengentryan, mohon mensinkronkan aplikasi. Terimakasih.";
	public $TTD_BIDAN = " Tertanda, Bidan Koordinator";
	public $TTD_GIZI = " Tertanda, Kepala Puskesmas";
	public $TTD_VAKSIN = " Tertanda, Koordinator P2P";

	public function getREMINDER_MESSAGE($fhw){
		if($fhw=="bidan"){
			return $REMINDER_MESSAGE.$TTD_BIDAN;
		}elseif($fhw=="gizi"){
			return $REMINDER_MESSAGE.$TTD_GIZI;
		}elseif($fhw=="vaksinator"){
			return $REMINDER_MESSAGE.$TTD_VAKSIN;
		}else{
			return $REMINDER_MESSAGE;
		}
	}

	public function getTHANKS_MESSAGE($fhw){
		if($fhw=="bidan"){
			return $THANKS_MESSAGE.$TTD_BIDAN;
		}elseif($fhw=="gizi"){
			return $THANKS_MESSAGE.$TTD_GIZI;
		}elseif($fhw=="vaksinator"){
			return $THANKS_MESSAGE.$TTD_VAKSIN;
		}else{
			return $THANKS_MESSAGE;
		}
	}
}