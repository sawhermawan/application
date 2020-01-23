<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_inv extends CI_Controller {

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
		if ($this->session->userdata('isiLogin')== TRUE) {

			$data['topReceipt']=$this->M_history->GetTopReceipt();
			$data['topUsed']=$this->M_history->GetTopUsed();
			$data['topTransfer']=$this->M_history->GetTopTransfer();
			$data['topReceiptSPR']=$this->M_history->GetTopReceiptSPR();
			$data['topUsedSPR']=$this->M_history->GetTopUsedSPR();
			$data['topTransferSPR']=$this->M_history->GetTopTransferSPR();
			$data['OpenReceipt'] = $this->M_receipt->GetReceiptOpen();
			$data['OpenUsed'] = $this->M_shipping->GetShippingOpen();
			$data['OpenTransfer'] = $this->M_transfer->GetTransferOpen();
			$data['TransitTransfer'] = $this->M_transfer->GetTransferTransit();
			$this->template->load('logistic/Static_inv','logistic/Dashboard_inv',$data);
			
		}else{
			redirect('Login');
		}
	}

	public function Receipt()
	{
		if ($this->session->userdata('isiLogin')== TRUE) {

			$data['m_receipt'] = $this->M_receipt->getReceiptHeaderOpen();
			$data['m_lokasi'] = $this->m_lokasi->get_location_query();
			$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
			$this->template->load('logistic/Static_inv','logistic/Receipt_inv_Open',$data);
			
		}else{
			redirect('Login');
		}
	}

	public function Shipping()
	{
		if ($this->session->userdata('isiLogin')== TRUE) {

			$data['m_asset']		= $this->M_asset->GetAssetInv();
			$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
			$data['m_lokasi'] 	= $this->m_lokasi->get_location_query();
			$data['m_shipping'] 	= $this->M_shipping->getShippingHeaderOpen();
			$data['m_employee']		= $this->M_employee->get_employee_query();
			$data['m_unit']			= $this->M_unit->get_unit_query();
			$this->template->load('logistic/Static_inv','logistic/Shipping_inv_Open', $data);
			
		}else{
			redirect('Login');
		}
	}

	public function TransOpen()
	{
		if ($this->session->userdata('isiLogin')== TRUE) {

			$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
			$data['m_lokasi'] = $this->m_lokasi->get_location_query();
			$data['m_transfer'] = $this->M_transfer->getTransferHeaderOpen();
			$this->template->load('logistic/Static_inv','logistic/Transfer_inv_Open',$data);
			
		}else{
			redirect('Login');
		}
	}

	public function TransTransit()
	{
		if ($this->session->userdata('isiLogin')== TRUE) {

			$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
			$data['m_lokasi'] = $this->m_lokasi->get_location_query();
			$data['m_transfer'] = $this->M_transfer->getTransferHeaderTransit();
			$this->template->load('logistic/Static_inv','logistic/Transfer_inv_Transit',$data);
			
		}else{
			redirect('Login');
		}
	}
}
