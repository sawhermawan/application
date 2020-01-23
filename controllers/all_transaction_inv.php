<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_transaction_inv extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_history');
		$this->load->model('M_receipt');
		$this->load->model('M_shipping');
		$this->load->model('M_transfer');
		$this->load->model('m_lokasi');
		$this->load->model('M_group_barang');
		$this->load->model('M_unit');
		$this->load->model('M_employee');
	}


	public function index()
	{
		$data['m_history'] = $this->M_history->GetAllTransaction();
		$this->template->load('logistic/Static_inv','logistic/All_transaction_inv',$data);
	}

	public function ReceiptDetail()
	{
		$id = $this->uri->segment(3);

		$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
		$data['m_lokasi'] = $this->m_lokasi->get_location_query();
		$data['m_receipt'] = $this->M_receipt->GetSingleReceiptHeader($id);
		$this->template->load('logistic/Static_inv','logistic/All_trans_detail_inv',$data);
	}

	public function UsedDetail()
	{
		$id = $this->uri->segment(3);

		$data['m_employee']		= $this->M_employee->get_employee_query();
		$data['m_unit']			= $this->M_unit->get_unit_query();
		$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
		$data['m_lokasi'] = $this->m_lokasi->get_location_query();
		$data['m_shipping'] = $this->M_shipping->GetSingleShippingHeader($id);
		$this->template->load('logistic/Static_inv','logistic/All_trans_detail_ship_inv',$data);
	}

	public function TransferDetail()
	{
		$id = $this->uri->segment(3);

		$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
		$data['m_lokasi'] = $this->m_lokasi->get_location_query();
		$data['m_transfer'] = $this->M_transfer->getSingleTransferHeader($id);
		$this->template->load('logistic/Static_inv','logistic/All_trans_detail_trans_inv',$data);
	}

}
