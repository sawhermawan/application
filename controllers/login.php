<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('m_login');
	}

	function index()
	{
		switch ($this->session->userdata('isiLogin')) {
			case 'TRUE':
				switch ($this->session->userdata('level')) {
					case '1':
						redirect('dashboard');
						break;
					case '2':
						redirect('logistic');
						break;
					case '3':
						redirect('staff');
						break;					
					default:
						$this->load->view('login');
						break;
				}
				break;
			
			default:
				$this->load->view('login');
				break;
		}
	}

	function do_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->m_login->cek_user($username , md5($password));
		if (count($cek) == 1) {
			foreach ($cek as $cek) {
				$level 			= $cek['id_logintype'];
				$id_loginakses	= $cek['id_loginakses'];
				$fullname		= $cek['fullname'];
				$status 		= $cek['status'];
				$images 		= $cek['images'];
				$comp			= $cek['id_comp'];
			}
			switch ($level) {
				case '1':
					switch ($status) {
						case 'ACTIVE':
							$this->session->set_userdata(array(
								'isiLogin'		=>TRUE, // set data telah login
								'username'		=>$username, // set session username
								'id_logintype'	=>$level, // set session hak akses
								'id_loginakses'	=>$id_loginakses,
								'fullname'		=>$fullname,
								'images'		=>$images,
								'comp'			=>$comp
							));
							redirect('dashboard');
							break;
						case 'INACTIVE':
							$this->session->set_flashdata('gagalLogin','Username atau password salah');
							$this->load->view('login');
							break;
					}
					break;
				case '2':
					switch ($status) {
						case 'ACTIVE':
							$this->session->set_userdata(array(
								'isiLogin'		=>TRUE, // set data telah login
								'username'		=>$username, // set session username
								'id_logintype'	=>$level, // set session hak akses
								'id_loginakses'	=>$id_loginakses,
								'fullname'		=>$fullname,
								'images'		=>$images,
								'comp'			=>$comp
							));
							redirect('admin_inv');
							break;
						case 'INACTIVE':
							$this->session->set_flashdata('gagalLogin','Username Sudah Tidak Dapat di Pergunakan');
							$this->load->view('login');
							break;
					}
					break;
				case '3':
					switch ($status) {
						case 'ACTIVE':
							$this->session->set_userdata(array(
								'isiLogin'		=>TRUE, // set data telah login
								'username'		=>$username, // set session username
								'id_logintype'	=>$level, // set session hak akses
								'id_loginakses'	=>$id_loginakses,
								'fullname'		=>$fullname,
								'images'		=>$images,
								'comp'			=>$comp
							));
							redirect('staff');
							break;
						case 'INACTIVE':
							$this->session->set_flashdata('gagalLogin','Username Sudah Tidak Dapat di Pergunakan');
							$this->load->view('login');
							break;
					}
					break;
			}
		}else{
			$this->session->set_flashdata('gagalLogin','username atau password salah');
			$this->load->view('login');
		}
	}


}
