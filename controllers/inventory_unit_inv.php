<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_unit_inv extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_invent_unit');
		$this->load->model('M_history');
	}


	public function index()
	{
		$data['m_invent_unit'] = $this->M_invent_unit->get_invent_unit_query();
		$this->template->load('logistic/Static_inv','logistic/Inventory_unit_inv',$data);
	}

	public function tambah()
	{
	    $data = array(
	        'unit'			=> strtoupper($this->input->post('unit')),
	        'description'	=> strtoupper($this->input->post('deskripsi')),
	    );
	    if ($this->M_invent_unit->GetCountUnitValidasiAdd() > 0) {
			
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Unit ID Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Inventory_unit_inv');
		}else{

			$this->M_invent_unit->tambah($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		    redirect('Inventory_unit_inv');
		}
	}

	public function update()
	{
	    // $data = array(
	    //     'unit'			=> strtoupper($this->input->post('unit')),
	    //     'description'	=> strtoupper($this->input->post('deskripsi')),
	    // );

	    // $id_unit = $this->input->post('id_unit');

	    // $GetUnit = $this->M_invent_unit->GetSingleUnit($id_unit);
	    // foreach ($GetUnit as $unit) {
	    // 	$gUnit = $unit->unit;
	    // }

	    // if ($gUnit == $data['unit']){

	    // 	$this->M_invent_unit->update_unit(array('id_unit' => $this->input->post('id_unit')), $data);
	    // 	$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Update Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

	    // }elseif ($this->M_invent_unit->GetCountUnitValidasiEdit($gUnit) > 0) {

	    // 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Edit, Unit Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    // }

	     $data = array(
	        'unit'			=> strtoupper($this->input->post('unit')),
	        'description'	=> strtoupper($this->input->post('deskripsi')),
	    );

	     $this->M_invent_unit->update_unit(array('id_unit' => $this->input->post('id_unit')), $data);
	    	$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Update Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    
	    redirect('Inventory_unit_inv');
	}

	public function delete()
	{

		$countTransUnit = $this->M_invent_unit->GetDeleteInvetUnit();

		if ($countTransUnit > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Invent Unit Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Inventory_unit_inv');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_invent_unit->update_unit(array('id_unit' => $this->input->post('id_unit')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Inventory_unit_inv');
		}

	}
}
