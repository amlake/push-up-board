<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('user_model');
   $this->load->model('pushups_model');
 }

 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
     $data['title'] = 'home';

     $this->load->view('templates/header', $data);
     $this->load->view('home_view', $data);
     $this->load->view('templates/footer');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

 function record()
 {
  $num_pushups = $this->input->post('number');
  $username = $this->input->post('username');
  $this->pushups_model->add_pushups($username, $num_pushups);

  $data['title'] = 'thermometer';
  $data['num_pushups_user'] = $this->pushups_model->count_pushups($username);
  $data['num_pushups_team'] = $this->pushups_model->count_pushups();

  $this->load->view('templates/header', $data);
  $this->load->view('thermometer_view', $data);
  $this->load->view('templates/footer');
 }

 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }

}

?>