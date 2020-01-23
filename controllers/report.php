<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('Dompdf_gen');
		$this->load->model('M_login');
		$this->load->model('M_report');
	}

	public function index()
	{
		$data['m_login'] = $this->M_login->getTechnician();
		$this->template->load('admin/Static','admin/Report',$data);
	}
	public function stock()
	{
		$data['title'] = 'Report Receipt Inventory';
		$data['m_report'] = $this->M_report->GetReportAllInventoryTrans();
		$this->load->view('admin/Report_all_history',$data);
		$paper_size  = 'LEGAL'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
 
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Receipt Inventory.pdf", array('Attachment'=>0));
	}

	// public function ReportTeknisi()
	// {
	// 	$data['title'] = 'Cetak PDF Technician'; //judul title
	// 	$data['from'] = $this->input->post('from_date');
	// 	$data['to'] = $this->input->post('to_date');
	// 	$data['teknisi'] = $this->M_report->GetReportTeknisiName();
 //        $data['m_report'] = $this->M_report->GetReportTeknisi(); //query model semua barang
 //        $this->load->view('admin/Report_logbook_teknisi',$data);
 
 //        $paper_size  = 'LEGAL'; //paper size
 //        $orientation = 'landscape'; //tipe format kertas
 //        $html = $this->output->get_output();
 
 //        $this->dompdf->set_paper($paper_size, $orientation);
 //        //Convert to PDF
 //        $this->dompdf->load_html($html);
 //        $this->dompdf->render();
 //        $this->dompdf->stream("Logbook Technician.pdf", array('Attachment'=>0));
	// }

	// public function ReportAllLogbook()
	// {
	// 	$data['title'] = 'Cetak PDF Technician'; //judul title
	// 	$data['from'] = $this->input->post('from_date');
	// 	$data['to'] = $this->input->post('to_date');
 //        $data['m_report'] = $this->M_report->GetReportAllLogbook(); //query model semua barang
 //        $this->load->view('admin/Report_all_logbook',$data);
 
 //        $paper_size  = 'LEGAL'; //paper size
 //        $orientation = 'landscape'; //tipe format kertas
 //        $html = $this->output->get_output();
 
 //        $this->dompdf->set_paper($paper_size, $orientation);
 //        //Convert to PDF
 //        $this->dompdf->load_html($html);
 //        $this->dompdf->render();
 //        $this->dompdf->stream("Logbook Technician.pdf", array('Attachment'=>0));
	// }

	public function ReportReceiptInvent()
	{
		$data['title'] = 'Report Receipt Inventory'; //judul title
		$data['from'] = $this->input->post('from_date');
		$data['to'] = $this->input->post('to_date');
        $data['m_report'] = $this->M_report->GetReportReceiptInventory(); //query model semua barang
        $this->load->view('admin/Report_receipt_invent',$data);
 
        $paper_size  = 'LEGAL'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
 
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Receipt Inventory.pdf", array('Attachment'=>0));
	}

	public function ReportShippingInvent()
	{
		$data['title'] = 'Report Shipping Inventory'; //judul title
		$data['from'] = $this->input->post('from_date');
		$data['to'] = $this->input->post('to_date');
        $data['m_report'] = $this->M_report->GetReportShippingInventory(); //query model semua barang
        $this->load->view('admin/Report_shipping_invent',$data);
 
        $paper_size  = 'LEGAL'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
 
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Shipping Inventory.pdf", array('Attachment'=>0));
	}

	public function ReportTransferInvent()
	{
		$data['title'] = 'Report Transfer Inventory'; //judul title
		$data['from'] = $this->input->post('from_date');
		$data['to'] = $this->input->post('to_date');
        $data['m_report'] = $this->M_report->GetReportTransferInventory(); //query model semua barang
        $this->load->view('admin/Report_transfer_invent',$data);
 
        $paper_size  = 'LEGAL'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
 
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Transfer Inventory.pdf", array('Attachment'=>0));
	}

	public function ReportAllInventTrans()
	{
		$data['title'] = 'Report All Inventory Transaction'; //judul title
		// $data['from'] = $this->input->post('from_date');
		// $data['to'] = $this->input->post('to_date');
        $data['m_report'] = $this->M_report->GetReportAllInventoryTrans(); //query model semua barang
        $this->load->view('admin/Report_all_history',$data);
 
        $paper_size  = 'LEGAL'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
 
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("All Inventory Transaction.pdf", array('Attachment'=>0));
	}
}
