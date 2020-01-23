<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_type extends CI_Controller {

	public function __construct(){

		parent:: __construct();
		$this->load->model('M_asset_type');
		$this->load->model('M_asset');
		$this->load->model('M_label_unique');
		$this->load->model('M_asset_name');
	}


	public function index()
	{
		$data['m_asset_type'] = $this->M_asset_type->GetProductType();
		$this->template->load('admin/Static','admin/Product_type',$data);
	}

	public function tambah()
	{
		$data = $this->M_asset_type->get_count_type();
		$type_count = $data['id_type'] + 1;

		$data = array(
			'code_type'			=> 'PT'.$type_count,
			'type'				=> $this->input->post('procut_type'),
			'status_type'		=> $this->input->post('status_type')
		);

		if ($this->M_asset_type->get_count_nametype() > 0) {
			
			$this->M_asset_type->updatetype($data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil dikembalikan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('product_type');
		}else{

		
			$this->M_asset_type->tambahtype($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		    redirect('Product_type');
		}
	}

	public function update()
	{
	    $data = array(
	    	'type'	=> $this->input->post('procut_type'),
	        'status_type'	=> $this->input->post('status_type')
	    );
	    $this->M_asset_type->update_type(array('code_type' => $this->input->post('code_type')), $data);
	    $this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Product_type');
	}

	public function delete()
	{

		$countType = $this->M_asset->GetDeleteProductType();
		$countTypeUnique = $this->M_label_unique->GetDeleteType();
		$countTypeAssetName = $this->M_asset_name->GetDeleteTypeName();

		if ($countTypeAssetName > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Product Type Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Product_type');
		}elseif ($countTypeUnique > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Product Type Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Product_type');
		}elseif ($countType > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Product Type Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Product_type');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_asset_type->update_type(array('code_type' => $this->input->post('id_type')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Product_type');
		}

	}
}
