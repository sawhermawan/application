<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lock_inventory extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_inventory_header');
	}


	public function index()
	{
		$data['m_inventory_header'] = $this->M_inventory_header->GetDateLockInv();
		$this->template->load('admin/Static','admin/Lock_inventory',$data);
	}

	public function update()
	{
		$data = array(
			'date_lock_inv'		=> $this->input->post('date_loc_inv')
		);
		$this->M_inventory_header->updateLockInv(array('id_lock_inv' => $this->input->post('id_lock_inv')),$data);
    	redirect('lock_inventory');
	}
}
