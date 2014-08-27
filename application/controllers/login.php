<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
   $data['title'] = 'login';
   $this->load->view('templates/header', $data);
   $this->load->view('login_view');
   $this->load->view('templates/footer');
 }

}
?>