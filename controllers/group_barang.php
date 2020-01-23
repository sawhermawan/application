<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class group_barang extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_group_barang');
		$this->load->model('M_tabel_barang');
		$this->load->model('M_category');
	}


	public function index()
	{
		$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
		$this->template->load('admin/Static','admin/group_barang',$data);
	}

	public function tambah()
	{
		$comp = $this->session->userdata('comp');

	    $data = array(
	    	'group_id'		=> strtoupper($this->input->post('group_id')),
	        'group_barang'	=> strtoupper($this->input->post('group_barang')),
	        'id_comp'		=> $comp
	    );
	    if ($this->M_group_barang->get_count_group_barang() > 0) {
			
			$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Item Group ID Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('group_barang');
		}else{

			$this->M_group_barang->tambah($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Group Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		    redirect('group_barang');
		}
	}

	public function update()
	{
	    // $data = array(
	    // 	'group_id'		=> strtoupper($this->input->post('group_id')),
	    //     'group_barang'	=> strtoupper($this->input->post('group_barang'))
	    // );

	    // $id_group = $this->input->post('id');

	    // $GetItemGroup = $this->M_group_barang->GetSingleItemGroup($id_group);
	    // foreach ($GetItemGroup as $itemGroup) {
	    // 	$group_id = $itemGroup->group_id;
	    // }

	    // if ($group_id == $data['group_id']) {

	    // 	$this->M_group_barang->update_group(array('id' => $this->input->post('id')), $data);
	    // 	$this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	
	    // }elseif ($this->M_group_barang->GetCountGorupValidasiEdit($group_id) > 0){

	    // 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Edit, Group Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    // }

	    // redirect('group_barang');
	    
	    $data = array(
	    	'group_id'		=> strtoupper($this->input->post('group_id')),
	        'group_barang'	=> strtoupper($this->input->post('group_barang'))
	    );

	    	$this->M_group_barang->update_group(array('id' => $this->input->post('id')), $data);
	    	$this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

	    redirect('group_barang');
	
	}

	public function delete()
	{

		$countItemGroup = $this->M_tabel_barang->GetDeleteItemGroup();
		$countCategory = $this->M_category->ValDeleteItemGroup();

		if ($countItemGroup > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Item Group Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('group_barang');
		}else if ($countCategory > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Item Group Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('group_barang');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_group_barang->update_group(array('id' => $this->input->post('id')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('group_barang');
		}

	}
}
