<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecmain extends CI_Controller {
        function __construct() {
            parent::__construct();
            date_default_timezone_set("Asia/Makassar");
            $this->load->model('Rapidpro');
            $this->load->model('EcHealthPromotion');
            $this->load->model('EcServiceAlert','ServiceAlert');
        }
	public function index(){
            $this->load->view('welcome_message');
            //$this->EcHealthPromotion->broadcast();
	}
        
        public function healthpromotion(){
            $data = $this->EcHealthPromotion->broadcastsql();
//            var_dump($data);
            $count = 0;
            set_time_limit(360);
            foreach ($data as $ibu){
                $res = $this->Rapidpro->postContacts($ibu);
                $count++;
                var_dump($res);
            }
            echo 'Total contact saved: '.$count.'<br>';
            $this->load->view('etime');
        }
        
        public function sql(){
            $this->load->view('welcome_message');
            $this->EcHealthPromotion->broadcastsql();
	}
        
        public function ancdue(){
            $this->ServiceAlert->alertAncDue();
            $this->load->view('etime');
        }
        
        public function ancoverdue(){
            $this->ServiceAlert->alertAncOverdue();
            $this->load->view('etime');
        }
        
        public function pncdue(){
            $this->ServiceAlert->alertPncDue();
            $this->load->view('etime');
        }
        
        public function pncoverdue(){
            $this->ServiceAlert->alertPncOverDue();
            $this->load->view('etime');
        }
        
        
        public function sms(){
            $pesan = 'Hi @contact.name';
            $penerima = ['+6281916029525'];
            $this->Rapidpro->postBroadcasts($pesan,$penerima);
        }
}
