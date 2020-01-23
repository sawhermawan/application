<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_inv_user extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_stock_barang');
		$this->load->model('M_history');
	}


	public function index()
	{
		$data['m_stock_barang'] = $this->M_stock_barang->GetStock();
		$this->template->load('staff/Static_staff','staff/Stock_inv_user',$data);
	}

	public function ViewDetailStock_inv_user()
	{
		$id = $this->uri->segment(3);

		$GetSingle = $this->M_stock_barang->GetStockSingle($id);

		foreach ($GetSingle as $stock) {
			$id_barang = $stock->id_barang;
			$loc_id = $stock->id_lokasi;
		}

		$data['m_history'] = $this->M_history->GetAllTransactionSingle($id_barang, $loc_id);
		$this->template->load('staff/Static_staff','staff/ViewDetailStock_inv_user',$data);
	}

	public function edit()
	{
		$data = array(
			// 'nama_lokasi'	=> $this->input->post('nama_lokasi'),
			'nama_barang'	=> $this->input->post('nama_barang'),
			'qty'			=> $this->input->post('qty'),
			// 'description'	=> $this->input->post('description'),
			// 'group_barang'	=> $this->input->post('group_barang')
			
		);

		$this->M_stock_barang->edit(array('id' => $this->input->post('id')),$data);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Stock_inv_user');

	    $this->M_stock_barang->editbarang(array('id' => $this->input->post('id')),$id);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Stock_inv_user');
	}
}
