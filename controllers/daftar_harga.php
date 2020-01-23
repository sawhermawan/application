<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_harga extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->model('M_invent_item');
		$this->load->model('M_daftar_harga');
		$this->load->model('M_history');
		$this->load->model('M_tabel_barang');
		$this->load->model('M_invent_unit');

	}


	public function index()
	{
		$data['m_daftar_harga'] = $this->M_daftar_harga->get_daftar_harga_query();
		$data['m_invent_item']	= $this->M_invent_item->GetInventTable();
		$data['m_invent_unit']		= $this->M_invent_unit->get_invent_unit_query();
		$this->template->load('admin/Static','admin/daftar_harga',$data);
	}

	public function tambah()
	{
		$comp = $this->session->userdata('comp');
		$harga = $this->input->post('item_harga');
		$harga_conv = str_replace(",", "", $harga);

	    $data = array(
	    	'id_barang'		=> $this->input->post('id_barang'),
	        'harga'			=> $harga_conv,
	        'unit_id'		=> $this->input->post('unit_id'),
	        'id_comp'		=> $comp
	    );
	    if ($this->M_daftar_harga->get_count_harga() < 0) {
			
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Item ID And Unit Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	
		}else{

			$this->M_daftar_harga->tambah($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}

			redirect('daftar_harga');
	}

	public function update()
	{
		$harga = $this->input->post('item_harga');
		$harga_conv = str_replace(",", "", $harga);
		$id_barang = $this->input->post('id_barang');

		$id = $this->input->post('id');
		$GetUnitItem = $this->M_daftar_harga->GetSingleharga($id);
		foreach ($GetUnitItem as $harga) {
			$unit = $harga->unit_id;
			$item = $harga->id_barang;
		}

	    $data = array(
	    	'harga'		=> $harga_conv,
	    	'unit_id'	=> $this->input->post('unit_id')
	    );

	    $this->M_daftar_harga->update_harga(array('id' => $this->input->post('id')), $data);
    	$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	    
    	redirect('daftar_harga');

	    // if ($item == $id_barang && $unit == $data['unit_id']) {
	    	
	    // 	$this->m_daftar_harga->update_harga(array('id' => $this->input->post('id')), $data);
	    // 	$this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	    
	    // 	redirect('daftar_harga');

	    // }elseif ($this->m_daftar_harga->GetCountValidasihargaEdit() > 0) {
	   		
	   	// 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Item ID And Unit Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

	   	// 	redirect('daftar_harga');

	    // }else{

	    // 	$this->m_daftar_harga->update_harga(array('id' => $this->input->post('id')), $data);
	    // 	$this->session->set_flashdata('notif','<div class="alert alert-info" role="alert"> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	    
	    // 	redirect('daftar_harga');
	    // }

	    	
	}

	public function delete()
	{

		// $countTransItem = $this->M_history->GetDeleteInvetItem();

		// if ($countTransItem > 0) {
		// 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Invent harga Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	 //    	redirect('daftar_harga');
		// }else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_daftar_harga->update_harga(array('id' => $this->input->post('id_harga')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('daftar_harga');
		// }

	}
}
