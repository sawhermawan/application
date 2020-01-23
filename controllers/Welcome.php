<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('m_login');


	}

	public function index()
	{
		if ($this->session->userdata('isiLogin')== TRUE) {

			$data['akses_login']	 = $this->m_login->GetAksesLoginCount();
			$this->template->load('admin/static','admin/dashboard',$data);
		}else{
			redirect('login');
		}
	}

	public function Lock_input_control()
	{
		$this->template->load('admin/static','admin/lock_input_control');
		

	}

}
