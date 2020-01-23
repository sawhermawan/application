<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_name extends CI_Controller {


	public function __construct(){

		parent:: __construct();
		$this->load->model('M_asset_name');
		$this->load->model('M_asset_type');
		$this->load->model('M_asset');
	}


	public function index()
	{
		$data['m_asset_name'] = $this->M_asset_name->GetProductName();
		$data['m_asset_type'] = $this->M_asset_type->GetProductType();
		$this->template->load('admin/Static','admin/Product_name',$data);
	}


	public function tambah()
	{
		$data = $this->M_asset_name->get_count_name();
		$name_count =  $data['id_asset_name'] + 1;

		$data = array(
			'code_name'		=> 'PN'.$name_count,
			'asset_name'	=> $this->input->post('procut_name'),
			'id_type'		=> $this->input->post('id_type')
		);

		if ($this->M_asset_name->get_count_ProductName() > 0) {
			
			$this->M_asset_name->update($data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil dikembalikan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Product_name');
		}else{

		
			$this->M_asset_name->tambah($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		    redirect('Product_name');
		}
	}

	public function update()
	{
	    $data = array(
	    	'asset_name'	=> $this->input->post('procut_name'),
	        'id_type'		=> $this->input->post('id_type')
	    );
	    $this->M_asset_name->update_name(array('code_name' => $this->input->post('code_name')), $data);
	    $this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Product_name');
	}

	public function delete()
	{

		$countName = $this->M_asset->GetDeleteProductName();

		if ($countName > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Product Type Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Product_name');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_asset_name->update_name(array('code_name' => $this->input->post('id_name')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Product_name');
		}

	}
}

