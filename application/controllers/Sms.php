<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {
	function __construct() {
            parent::__construct();
 
            if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
                $this->session->set_flashdata('flash_data', 'You don\'t have access!');
                $this->session->set_flashdata('url', $this->uri->uri_string);
                redirect('login');
            }
        }

	public function index()	{
		$pass['title'] = "Beranda";
		$pass['css'] = [
			'vendors/bootstrap/dist/css/bootstrap.min.css',
			'vendors/font-awesome/css/font-awesome.min.css',
			'vendors/nprogress/nprogress.css',
			'vendors/iCheck/skins/flat/green.css',
			'vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
			'vendors/jqvmap/dist/jqvmap.min.css',
			'vendors/bootstrap-daterangepicker/daterangepicker.css',
			'build/css/custom.css'
		];
		$pass['js'] = [
			'vendors/jquery/dist/jquery.min.js',
			'vendors/bootstrap/dist/js/bootstrap.min.js',
			'vendors/fastclick/lib/fastclick.js',
			'vendors/nprogress/nprogress.js',
			'vendors/Chart.js/dist/Chart.min.js',
			'vendors/gauge.js/dist/gauge.min.js',
			'vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
			'vendors/iCheck/icheck.min.js',
			'vendors/skycons/skycons.js',
			'vendors/Flot/jquery.flot.js',
			'vendors/Flot/jquery.flot.pie.js',
			'vendors/Flot/jquery.flot.time.js',
			'vendors/Flot/jquery.flot.stack.js',
			'vendors/Flot/jquery.flot.resize.js',
			'vendors/flot.orderbars/js/jquery.flot.orderBars.js',
			'vendors/flot-spline/js/jquery.flot.spline.min.js',
			'vendors/flot.curvedlines/curvedLines.js',
			'vendors/DateJS/build/date.js',
			'vendors/jqvmap/dist/jquery.vmap.js',
			'vendors/jqvmap/dist/maps/jquery.vmap.world.js',
			'vendors/jqvmap/examples/js/jquery.vmap.sampledata.js',
			'vendors/moment/min/moment.min.js',
			'vendors/bootstrap-daterangepicker/daterangepicker.js',
			'build/js/custom.js'
		];
		$this->load->view('header',$pass);
		$this->load->view('navigation');
		$this->load->view('overview');
	
		$this->load->view('footer',$pass);
	}

	public function compose()	{
		$pass['title'] = "New Message";
		$pass['css'] = [
			'vendors/bootstrap/dist/css/bootstrap.min.css',
			'vendors/font-awesome/css/font-awesome.min.css',
			'vendors/nprogress/nprogress.css',
			'vendors/iCheck/skins/flat/green.css',
			'vendors/google-code-prettify/bin/prettify.min.css',
			'vendors/select2/dist/css/select2.min.css',
			'vendors/switchery/dist/switchery.min.css',
			'vendors/starrr/dist/starrr.css',
			'build/css/custom.css'
		];
		$pass['js'] = [
			'vendors/jquery/dist/jquery.min.js',
			'vendors/bootstrap/dist/js/bootstrap.min.js',
			'vendors/fastclick/lib/fastclick.js',
			'vendors/nprogress/nprogress.js',
			'vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
			'vendors/iCheck/icheck.min.js',
			'vendors/jquery.hotkeys/jquery.hotkeys.js',
			'vendors/google-code-prettify/src/prettify.js',
			'vendors/jquery.tagsinput/src/jquery.tagsinput.js',
			'vendors/switchery/dist/switchery.min.js',
			'vendors/select2/dist/js/select2.full.min.js',
			'vendors/parsleyjs/dist/parsley.min.js',
			'vendors/autosize/dist/autosize.min.js',
			'vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js',
			'vendors/starrr/dist/starrr.js',
			'build/js/custom.js'
		];
		$this->load->view('header',$pass);
		$this->load->view('navigation');
		$this->load->view('sms/new');
	
		$this->load->view('footer',$pass);
	}

	public function inbox()	{
		$pass['title'] = "Inbox";
		$pass['css'] = [
			'vendors/bootstrap/dist/css/bootstrap.min.css',
			'vendors/font-awesome/css/font-awesome.min.css',
			'vendors/nprogress/nprogress.css',
			'vendors/iCheck/skins/flat/green.css',
			'vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
			'vendors/jqvmap/dist/jqvmap.min.css',
			'vendors/bootstrap-daterangepicker/daterangepicker.css',
			'build/css/custom.css'
		];
		$pass['js'] = [
			'vendors/jquery/dist/jquery.min.js',
			'vendors/bootstrap/dist/js/bootstrap.min.js',
			'vendors/fastclick/lib/fastclick.js',
			'vendors/nprogress/nprogress.js',
			'vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
			'build/js/custom.js'
		];
		$this->load->model('Rapidpro');
		$data['inbox'] = json_decode($this->Rapidpro->getMessages('incoming'));
		$this->load->view('header',$pass);
		$this->load->view('navigation');
		$this->load->view('sms/inbox',$data);
	
		$this->load->view('footer',$pass);
	}

	public function sent()	{
		$pass['title'] = "Sent";
		$pass['css'] = [
			'vendors/bootstrap/dist/css/bootstrap.min.css',
			'vendors/font-awesome/css/font-awesome.min.css',
			'vendors/nprogress/nprogress.css',
			'vendors/iCheck/skins/flat/green.css',
			'vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
			'vendors/jqvmap/dist/jqvmap.min.css',
			'vendors/bootstrap-daterangepicker/daterangepicker.css',
			'build/css/custom.css'
		];
		$pass['js'] = [
			'vendors/jquery/dist/jquery.min.js',
			'vendors/bootstrap/dist/js/bootstrap.min.js',
			'vendors/fastclick/lib/fastclick.js',
			'vendors/nprogress/nprogress.js',
			'vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
			'build/js/custom.js'
		];
		$this->load->model('Rapidpro');
		$data['sent'] = json_decode($this->Rapidpro->getMessages('sent'));
		$this->load->view('header',$pass);
		$this->load->view('navigation');
		$this->load->view('sms/sent',$data);
	
		$this->load->view('footer',$pass);
	}

	public function outbox()	{
		$pass['title'] = "Outbox";
		$pass['css'] = [
			'vendors/bootstrap/dist/css/bootstrap.min.css',
			'vendors/font-awesome/css/font-awesome.min.css',
			'vendors/nprogress/nprogress.css',
			'vendors/iCheck/skins/flat/green.css',
			'vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
			'vendors/jqvmap/dist/jqvmap.min.css',
			'vendors/bootstrap-daterangepicker/daterangepicker.css',
			'build/css/custom.css'
		];
		$pass['js'] = [
			'vendors/jquery/dist/jquery.min.js',
			'vendors/bootstrap/dist/js/bootstrap.min.js',
			'vendors/fastclick/lib/fastclick.js',
			'vendors/nprogress/nprogress.js',
			'vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
			'build/js/custom.js'
		];
		$this->load->model('Rapidpro');
		$data['outbox'] = json_decode($this->Rapidpro->getMessages('outbox'));
		$this->load->view('header',$pass);
		$this->load->view('navigation');
		$this->load->view('sms/outbox',$data);
	
		$this->load->view('footer',$pass);
	}

	public function send(){
		if($_POST){
			if(isset($_POST['numbers'])){
				$numbers = explode(',', $_POST['numbers']);
				$message = $_POST['message'];
				foreach ($numbers as $key => $num) {
					$numbers[$key] = $this->getGlobalNum($num);
				}
				$this->load->model('Rapidpro');
				$result = $this->Rapidpro->postBroadcasts($message,$numbers);
				redirect('sms/outbox');
			}
		}
	}

	private function getGlobalNum($num){
		if($num[0]==0&&$num[0]!="+"){
			$num = "+62".substr($num, 1);
		}elseif ($num[0]!="+") {
			$num = "+".$num;
		}
		return $num;
	}
}
