<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
        function __construct() {
            parent::__construct();
            date_default_timezone_set("Asia/Makassar");
            $this->load->model('Rapidpro');
            $this->load->model('HealthPromotion');
            $this->load->model('ServiceAlert','ServiceAlert');
            $this->load->model('SubmissionReminder','SubmissionReminder');
        }
	public function index(){
            $this->load->view('welcome_message');
            //$this->HealthPromotion->broadcast();
	}
        
        public function healthpromotion(){
            $data = $this->HealthPromotion->broadcastsql();
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
            $this->HealthPromotion->broadcastsql();
	}
        
        public function anc(){
            $this->ServiceAlert->alertAnc();
            $this->load->view('etime');
        }
        
        public function ancdue(){
            $this->ServiceAlert->alertAncDue();
            $this->load->view('etime');
        }
        
        public function ancoverdue(){
            $this->ServiceAlert->alertAncOverDue();
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
        
        
        public function ancbumil(){
            $this->ServiceAlert->alertAncBumil();
            $this->load->view('etime');
        }
        
        public function tthb(){
            $this->ServiceAlert->alertTTHB();
            $this->load->view('etime');
        }
        
        public function tthbbumil(){
            $this->ServiceAlert->alertTTHBBumil();
        }
        
        public function pnc(){
            $this->ServiceAlert->alertPnc();
            $this->load->view('etime');
        }
        
        public function pncibu(){
            $this->ServiceAlert->alertPncIbu();
            $this->load->view('etime');
        }
        
        public function imunisasi(){
            $this->ServiceAlert->alertImunisasi();
            $this->load->view('etime');
        }
        
        public function imunisasianak(){
            $this->ServiceAlert->alertImunisasiAnak();
            $this->load->view('etime');
        }
        
        public function kb(){
            $this->ServiceAlert->alertKb();
            $this->load->view('etime');
        }
        
        public function kbibu(){
            $this->ServiceAlert->alertKbIbu();
            $this->load->view('etime');
        }
        
        public function sms(){
            $pesan = 'Hi @contact.name';
            $penerima = ['+6281916029525'];
            $this->Rapidpro->postBroadcasts($pesan,$penerima);
        }

        public function ec_bidan(){
            $this->SubmissionReminder->ec_reminder("bidan","ec");
        }

        public function ec_vaksin(){
            $this->SubmissionReminder->ec_reminder("vaksinator","ec");
        }

        public function ec_gizi(){
            $this->SubmissionReminder->ec_reminder("gizi","ec");
        }

        public function cr_bidan(){
            $this->SubmissionReminder->cr_reminder("bidan","cr");
        }

        public function cr_vaksin(){
            $this->SubmissionReminder->cr_reminder("vaksinator","cr");
        }

        public function cr_gizi(){
            $this->SubmissionReminder->cr_reminder("gizi","cr");
        }
}
