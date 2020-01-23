<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_detail extends CI_Controller {


	public function __construct(){

		parent:: __construct();
		$this->load->model('M_asset_detail');
		$this->load->model('M_asset_type');
		$this->load->model('M_asset');
	}


	public function index()
	{
		$data['m_asset_type'] = $this->M_asset_type->GetProductType();
		$data['m_asset_detail'] = $this->M_asset_detail->GetProductDetail();
		$this->template->load('admin/Static','admin/Product_detail',$data);
	}

	public function tambah()
	{
		$data = $this->M_asset_detail->get_count_detail();
		$detail_count =  $data['id_unique'] + 1;

		$new_field = $this->input->post('new_field');

		$field_str = implode('#',$new_field);

		$data = array(
			'code_detail'	=> 'PD'.$detail_count,
			'field_unique'	=> $field_str,
			'id_type'		=> $this->input->post('id_type')
		);

		if ($this->M_asset_detail->get_count_detailName() > 0) {
			
			$this->M_asset_detail->update($data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil dikembalikan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Product_detail');
		}else{

		
			$this->M_asset_detail->tambah($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		    redirect('Product_detail');
		}
	}

	public function update()
	{
	    $data = array(
	    	'field_unique'	=> $this->input->post('procut_detail')
	    );
	    $this->M_asset_detail->update_detail(array('code_detail' => $this->input->post('code_detail')), $data);
	    $this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Product_detail');
	}

	public function tambahField()
	{
		$get_field = $this->M_asset_detail->Getfield();
		$new_field = $this->input->post('new_field');

		foreach ($get_field as $get) {
			$field = $get->field_unique;
		}

		$arr1 = array($new_field);
		$arr2 = array($field);
		$arr3 = array_merge($arr2,$arr1);
		$field_str = implode("#",$arr3);

	    $data = array(
	    	'field_unique'	=> $field_str
	    );
	    $this->M_asset_detail->update_new_field(array('code_detail' => $this->input->post('code_detail')), $data);
	    $this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Product_detail');
	}

	public function delete()
	{

		$countDetail = $this->m_asset->GetDeleteProductType();

		if ($countDetail > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Product Detail Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Product_detail');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_asset_detail->update_new_field(array('code_detail' => $this->input->post('id_uni')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Product_detail');
		}

	}
}

