<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct(){
		parent:: __construct();
		//$this->load->model('m_about');
	}

	public function index()
	{
		$this->session->sess_destroy();
		redirect('Login','Refresh');
	}
}
