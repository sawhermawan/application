<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	public function __construct(){

		parent:: __construct();
		$this->load->model('m_lokasi');
		$this->load->model('M_employee');
	}


	public function index()
	{
		$data['m_lokasi'] = $this->m_lokasi->get_location_query();
		$this->template->load('admin/Static','admin/Location',$data);
	}

	public function tambah()
	{	   

	    if ($this->m_lokasi->GetCountLocationName() > 0) {

	    	$data = array(
				'delete_status'		=> '0'
			);

			
			$this->m_lokasi->update(array('nama_lokasi' => $this->input->post('name'),'codeLocation' => $this->input->post('location_code')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil dikembalikan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{

			$data = array(
		        'nama_lokasi'		=> $this->input->post('name'),
		        'codeLocation'		=> $this->input->post('location_code'),
		        'thumbnails'		=> ('thumbnails.jpg')
	    	);

		    $this->m_lokasi->tambah($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		
		}

		 redirect('Location');
	}

	public function update()
	{
		$data = array(
			'nama_lokasi'	=> $this->input->post('loc_name'),
			'codeLocation'	=> $this->input->post('loc_code')
		);

		$this->m_lokasi->update(array('id_lokasi' => $this->input->post('id_loc')),$data);
		$this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diUpdate <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('Location');
	}

	public function delete()
	{
		$id_lokasi = $this->input->post('id_loc');

		// $countLocation = $this->M_asset->GetDeleteLocation();
		$countEmployeeloc = $this->M_employee->GetDeleteEmployeeLoc();

		if ($countLocation > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Location Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Location');
		}elseif ($countEmployeeloc > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Location Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Location');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->m_lokasi->update(array('id_lokasi' => $this->input->post('id_loc')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Location');
		}
	}
}
