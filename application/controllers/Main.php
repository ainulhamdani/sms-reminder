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

        public function ec_submission($type="reminder"){
            $this->ec_bidan($type);
            $this->ec_vaksin($type);
            $this->ec_gizi($type);
        }

        public function cr_submission($type="reminder"){
            $this->cr_bidan($type);
            $this->cr_vaksin($type);
            $this->cr_gizi($type);
        }

        private function ec_bidan($type){
            $this->SubmissionReminder->ec_reminder("bidan","ec",$type);
        }

        private function ec_vaksin($type){
            $this->SubmissionReminder->ec_reminder("vaksinator","ec",$type);
        }

        private function ec_gizi($type){
            $this->SubmissionReminder->ec_reminder("gizi","ec",$type);
        }

        private function cr_bidan($type){
            $this->SubmissionReminder->cr_reminder("bidan","cr",$type);
        }

        private function cr_vaksin($type){
            $this->SubmissionReminder->cr_reminder("vaksinator","cr",$type);
        }

        private function cr_gizi($type){
            $this->SubmissionReminder->cr_reminder("gizi","cr",$type);
        }
}
