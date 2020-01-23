<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_unit');
		$this->load->model('M_employee');
	}


	public function index()
	{
		$data['m_unit'] = $this->M_unit->get_unit_query();
		$this->template->load('admin/Static','admin/Unit',$data);
	}


	public function tambah()
	{
	    

	    if ($this->M_unit->GetCountUnitName() > 0) {

	    	$data = array(
				'delete_status'		=> '0'
			);

			
			$this->M_unit->update(array('nama_unit' => $this->input->post('nama')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil dikembalikan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{

			$data = array(
	        'nama_unit'		=> $this->input->post('nama')
		    );

		    $this->M_unit->tambah($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		
		}

		redirect('Unit');
	}

	public function edit(){
		$id_unit = $this->uri->segment(3);
		$data['m_unit'] = $this->M_unit->GetUnitSingle($id_unit)->result();
		$this->template->load('admin/Static','admin/Edit_unit',$data);
	}

	public function update()
	{
	    $data = array(
	        'nama_unit'		=> $this->input->post('nama'),
	    );
	    $this->M_unit->update(array('id_unit' => $this->input->post('id_unit')), $data);
	    $this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Unit');
	}

	public function delete()
	{
		$id_unit = $this->input->post('id_unit');

		// $countAsset = $this->M_asset->GetDeleteAsset();
		$countEmployee = $this->M_employee->GetDeleteEmployee();

		if ($countAsset > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Unit Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Unit');
		}elseif ($countEmployee > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Unit Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Unit');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_unit->update(array('id_unit' => $this->input->post('id_unit')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Unit');
		}

	}


	
}
