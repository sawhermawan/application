<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_employee');
		$this->load->model('M_unit');
		$this->load->model('m_lokasi');
		$this->load->model('M_company');
	}


	public function index()
	{
		$data['m_employee'] = $this->M_employee->get_employee_query();
		$data['m_company'] = $this->M_company->get_company_query();
		$data['m_lokasi'] = $this->m_lokasi->get_location_query();
		$data['m_unit'] = $this->M_unit->get_unit_query();
		$this->template->load('admin/Static','admin/Employee',$data);
	}

	public function tambah()
	{
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$fullname = $firstname . " " . $lastname;

	    $data = array(
	        'id_comp'			=> $this->input->post('company'),
	        'nip'				=> $this->input->post('nip'),
	        'firstname'			=> $this->input->post('firstname'),
	        'lastname'			=> $this->input->post('lastname'),
	        'fullname'			=> $fullname,
	        'alamat_user'		=> $this->input->post('address'),
	        'gender_user'		=> $this->input->post('gender'),
	        // 'ip_address'		=> $this->input->post('ip_address'),
	        'email'				=> $this->input->post('email'),
	        'phone_user'		=> $this->input->post('phone'),
	        'dateofbirth_user'	=> $this->input->post('date_birth'),
	        'joined'			=> $this->input->post('join'),
	        'id_lokasi'		=> $this->input->post('location'),
	        'profpic_user'		=> 'images/user.png',
	        'id_unit'			=> $this->input->post('unit')
	    );
	    $this->M_employee->tambah($data);
	    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Employee');
	}

	public function edit(){
		$id_user = $this->uri->segment(3);
		$data['m_company'] = $this->M_company->get_company_query();
		$data['m_lokasi'] = $this->m_lokasi->get_location_query();
		$data['m_unit'] = $this->M_unit->get_unit_query();
		$data['m_employee'] = $this->M_employee->GetEmployeeSingle($id_user)->result();
		$this->template->load('admin/Static','admin/Edit_employee',$data);
	}

	public function update()
	{
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$fullname = $firstname . " " . $lastname;

	    $data = array(
	        'id_comp'			=> $this->input->post('company'),
	        'nip'				=> $this->input->post('nip'),
	        'firstname'			=> $this->input->post('firstname'),
	        'lastname'			=> $this->input->post('lastname'),
	        'fullname'			=> $fullname,
	        'alamat_user'		=> $this->input->post('address'),
	        'gender_user'		=> $this->input->post('gender'),
	        // 'ip_address'		=> $this->input->post('ip_address'),
	        'email'				=> $this->input->post('email'),
	        'phone_user'		=> $this->input->post('phone'),
	        'dateofbirth_user'	=> $this->input->post('date_birth'),
	        'joined'			=> $this->input->post('join'),
	        'id_lokasi'		=> $this->input->post('location'),
	        'profpic_user'		=> 'images/user.png',
	        'id_unit'			=> $this->input->post('unit')
	    );
	    $this->M_employee->update(array('id_user' => $this->input->post('id_user')), $data);
	    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Employee');

	}

	public function login_akses()
	{
		$access = $this->M_employee->get_count_login_access();
		$data_login_access = $this->M_employee->get_login_access();
		foreach ($data_login_access as $login) {
			$access_login = $login->count;
		}
		$firstname = $this->input->post('firstname');

		$get_name = $firstname.$access_login;

		if ($access > 0) {

			 $data = array(
		        'id_user'		=> $this->input->post('id_user'),
		        'name'			=> $this->input->post('fullname'),
		        'username'		=> $get_name,
		        'thumbnails'	=> 'user.png',
		        'count'			=> '0',
		        'id_comp'		=> $this->input->post('id_comp')
	    	);

			 $data2 = array(
		        'count'		=> $access_login + 1
	    	);

			$this->M_employee->update_login_access($data ,$data2);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		    redirect('login_akses');
		}else{
			 $data = array(
		        'id_user'		=> $this->input->post('id_user'),
		        'name'			=> $this->input->post('fullname'),
		        'username'		=> $this->input->post('firstname'),
		        'thumbnails'	=> 'user.png',
		        'count'			=> '1',
		        'id_comp'		=> $this->input->post('id_comp')
	    	);

			$this->M_employee->tambah_login($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		    redirect('login_akses');
		}
	}
}
