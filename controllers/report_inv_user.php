<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_inv_user extends CI_Controller {

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
		$this->template->load('staff/Static_staff','staff/Report_inv_user',$data);
	}
	public function stock()
	{
		$data['title'] = 'Report Receipt Inventory';
		$data['m_report'] = $this->M_report->GetReportAllInventoryTrans();
		$this->load->view('staff/Report_all_history_inv_user',$data);
		$paper_size  = 'LEGAL'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
 
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Receipt Inventory.pdf", array('Attachment'=>0));
	}


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





}
