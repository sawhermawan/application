<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('m_dashboard');

	}


	public function index()
	{
		$data['m_needstock'] = $this->m_dashboard->Needstock();
		$data['m_alat_tulis'] = $this->m_dashboard->AlatTulis();
		$data['m_filo'] = $this->m_dashboard->FileOrganizer();
		$data['m_buku'] = $this->m_dashboard->KategoriBuku();
		$data['m_kertas'] = $this->m_dashboard->KategoriKertas();
		$data['m_umum'] = $this->m_dashboard->KategoriUmum();
		$this->template->load('admin/static','admin/dashboard',$data);
	}



}
