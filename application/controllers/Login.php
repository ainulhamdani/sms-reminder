<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Login.php
 * @author Imron rosdiana
 */
class Login extends CI_Controller
{
 
    function __construct() {
        parent::__construct();
        $this->load->model("login_model", "login");
        if(!empty($_SESSION['id_user']))
            redirect('welcome');
    }
 
    public function index() {
        if($_POST) {
            $result = $this->login->validate_user($_POST);
            if(!empty($result)) {
                $data = [
                    'id_user' => $result->id_user,
                    'username' => $result->username,
                    'location' => $result->location,
                    'level' => $result->level,
                    'tipe' => $result->tipe,
                    'last_login' => $result->last_login,
                    'admin_valid' => true
                ];
 
                $this->session->set_userdata($data);
                $this->db->query("UPDATE users SET last_login=current_timestamp WHERE id_user = '".$result->id_user."'");
                if($this->input->post('url')!=""){
                    redirect($this->input->post('url'));
                }else redirect('welcome');
            } else {
                $this->session->set_flashdata('flash_data', 'Username or password is wrong!');
                redirect('login');
            }
        }
 
        $this->load->view("login");
    }
    
    public function auth(){
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            $this->load->view('errors/error_auth');
        } else {
            $u['username'] = $_SERVER['PHP_AUTH_USER'];
            $u['password'] = $_SERVER['PHP_AUTH_PW'];
            $result = $this->login->validate_user_opensrp($u);
            if(!empty($result)) {
                $data = [
                    'id_user' => $result->id_user,
                    'username' => $result->username,
                    'location' => $result->location,
                    'level' => $result->level,
                    'tipe' => $result->tipe,
                    'last_login' => $result->last_login,
                    'admin_valid' => true
                ];
 
                $this->session->set_userdata($data);
                $this->db->query("UPDATE users SET last_login=current_timestamp WHERE id_user = '".$result->id_user."'");
                if($this->input->post('url')!=""){
                    redirect($this->input->post('url'));
                }else redirect('welcome');
            } else {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                die('Admin access turned off');
            }
        }
    }
}