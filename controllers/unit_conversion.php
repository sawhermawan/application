<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_conversion extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_invent_unit');
		$this->load->model('M_invent_item');
		$this->load->model('M_unit_conversion');

	}


	public function index()
	{
		$data['m_invent_item']		= $this->M_invent_item->GetInventTable();
		$data['m_invent_unit']		= $this->M_invent_unit->get_invent_unit_query();
		$data['m_unit_conversion'] 	= $this->M_unit_conversion->GetUnitConversionAll();
		$this->template->load('admin/Static','admin/Unit_conversion',$data);
	}

	public function tambah()
	{
		$id_comp = $this->session->userdata('comp');

		$data = array(
			'id_barang'		=> $this->input->post('id_barang'),
			'unit_from'		=> $this->input->post('unitFrom'),
			'unit_to'		=> $this->input->post('unitTo'),
			'factor'		=> $this->input->post('factor'),
			'delete_status'	=> '0',
			'id_comp'		=> $id_comp
		);

		if ($this->M_unit_conversion->GetCountUnitConversion() > 0) {

			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Unit ID Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

		}elseif ($this->M_unit_conversion->GetCountUnitConversionBack() > 0){

			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Unit ID Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

		}else{

			$this->M_unit_conversion->tambah($data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		
	    redirect('Unit_conversion');
	}

	function getUnit()
	{
	    $unit_from = $this->input->post('unitFrom');

	    $query = $this->M_unit_conversion->GetUnitConversionTo();
	    
	    echo '<option value="">Select Unit To </option>';
	        foreach($query->result() as $row)
	        { 
	         echo "<option value='".$row->unit."'>".$row->unit."</option>";
	        }
	}

	public function update()
	{
		$id = $this->input->post('id_conv');
		$GetItemUnitFromTo = $this->M_unit_conversion->GetSingleUnitFromTo($id);
		foreach ($GetItemUnitFromTo as $conver) {
			$item = $conver->id_barang;
			$unitFrom = $conver->unit_from;
			$unitTo = $conver->unit_to;
		}

		$id_item = $this->input->post('id_barang');

		$data = array(
			'unit_from'	=> $this->input->post('unitFrom'),
			'unit_to'	=> $this->input->post('unitTo'),
			'factor'	=> $this->input->post('factor')
		);

		// if ($item == $id_item && $unitFrom == $data['unit_from'] && $unitTo == $data['unit_to']) {
			
			$this->M_unit_conversion->update(array('id_conversion' => $this->input->post('id_conv')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

		// }elseif ($this->M_unit_conversion->GetCountUnitConversion() > 0){

		// 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Edit, Data Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

		// }elseif ($this->M_unit_conversion->GetCountUnitConversionBack() > 0){

		// 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Edit, Data Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		// }
		
	    redirect('Unit_conversion');
	}

	public function delete()
	{
		$countItemUnitConver = $this->M_unit_conversion->GetDeleteInvetItemUnitConver();

		if ($countItemUnitConver > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Unit Conversion Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Unit_conversion');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_unit_conversion->update(array('id_conversion' => $this->input->post('id_conv')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Unit_conversion');
		}
	}
}
