<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
            parent::__construct();
 
            if(empty($this->session->userdata('id_user'))&&$this->session->userdata('admin_valid') == FALSE) {
                $this->session->set_flashdata('flash_data', 'You don\'t have access!');
                $this->session->set_flashdata('url', $this->uri->uri_string);
                redirect('login');
            }
        }

        public function index()
	{
            redirect("sms");
	}
        
        public function logout() {
            $this->session->sess_destroy();
            redirect('login');
        }
}
