<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
	}


	public function index()
	{
		if ($this->session->userdata('isiLogin')== TRUE) {
		$this->template->load('staff/Static_staff','staff/Dashboard_staff');
			//$this->load->view('admin/static');
		}else{
			redirect('Login');
		}
		//$this->load->view('admin/static');
		// $this->template->load('admin/static','admin/dashboard');
	}
}

