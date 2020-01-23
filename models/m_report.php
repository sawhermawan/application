<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

    // public function GetReportAllLogbook()
    // {
    //     $from_date = $this->input->post('from_date');
    //     $to_date = $this->input->post('to_date');

    //     $this->db->select('*');
    //     $this->db->from('logbook');
    //     $this->db->join('dt_user', 'dt_user.id_user = logbook.id_user', 'LEFT');
    //     $this->db->join('m_lokasi','m_lokasi.id_lokasi = dt_user.id_lokasi','LEFT');
    //     $this->db->join('m_urgent','m_urgent.urgent_id = logbook.urgent_id','LEFT');
    //     $this->db->join('m_application','m_application.app_id = logbook.app_id','LEFT');
    //     $this->db->join('aplikasi_info','aplikasi_info.log_app_id = logbook.log_id','LEFT');
    //     $this->db->join('m_infras','m_infras.infra_id = logbook.infra_id','LEFT');
    //     $this->db->join('infras_info','infras_info.log_infras_id = logbook.log_id','LEFT');
    //     $this->db->join('login_user','login_user.id = logbook.teknisi_id','LEFT');
    //     $this->db->join('m_modul','m_modul.modul_id = logbook.modul_id','LEFT');
    //     $this->db->where('logbook.status =', 'CLOSED');
    //     $this->db->where('logbook.issue_date >=',  $from_date);
    //     $this->db->where('logbook.issue_date <=',  $to_date);
    //     $this->db->order_by('logbook.issue_date','asc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function GetReportTeknisi()
    // {
    //     $id_teknisi = $this->input->post('id_teknisi');
    //     $from_date = $this->input->post('from_date');
    //     $to_date = $this->input->post('to_date');

    //     $this->db->select('*');
    //     $this->db->from('logbook');
    //     $this->db->join('dt_user', 'dt_user.id_user = logbook.id_user', 'LEFT');
    //     $this->db->join('m_lokasi','m_lokasi.id_lokasi = dt_user.id_lokasi','LEFT');
    //     $this->db->join('m_urgent','m_urgent.urgent_id = logbook.urgent_id','LEFT');
    //     $this->db->join('m_application','m_application.app_id = logbook.app_id','LEFT');
    //     $this->db->join('aplikasi_info','aplikasi_info.log_app_id = logbook.log_id','LEFT');
    //     $this->db->join('m_infras','m_infras.infra_id = logbook.infra_id','LEFT');
    //     $this->db->join('infras_info','infras_info.log_infras_id = logbook.log_id','LEFT');
    //     $this->db->join('login_user','login_user.id = logbook.teknisi_id','LEFT');
    //     $this->db->join('m_modul','m_modul.modul_id = logbook.modul_id','LEFT');
    //     $this->db->where('logbook.teknisi_id', $id_teknisi);
    //     $this->db->where('logbook.status =', 'CLOSED');
    //     $this->db->where('logbook.issue_date >=',  $from_date);
    //     $this->db->where('logbook.issue_date <=',  $to_date);
    //     $this->db->order_by('logbook.issue_date','asc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function GetReportTeknisiName()
    // {
    //     $id_teknisi = $this->input->post('id_teknisi');

    //     $query = $this->db->get_where('login_user',array('id' => $id_teknisi));
    //     return $query->result();
    // }

    public function GetReportReceiptInventory()
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $comp = $this->session->userdata('comp');

        $this->db->select('*');
        $this->db->select('history.status as trans_status');
        $this->db->from('header_pembelian');
        $this->db->join('detail_pembelian', 'detail_pembelian.pembelian_id = header_pembelian.pembelian_id', 'LEFT');
        $this->db->join('history', 'history.id_barang = detail_pembelian.id_barang', 'LEFT');
       $this->db->join('tabel_barang', 'tabel_barang.id_barang = history.id_barang', 'LEFT');
        $this->db->join('m_lokasi', 'm_lokasi.id_lokasi = header_pembelian.id_lokasi', 'LEFT');
        $this->db->where('header_pembelian.id_comp', $comp);
        $this->db->where('header_pembelian.pembelian_date >=', $from_date);
        $this->db->where('header_pembelian.pembelian_date <=', $to_date);
        $this->db->order_by('header_pembelian.pembelian_date', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    //  public function GetReportAllInventoryTrans()
    // {
    //     // $from_date = $this->input->post('from_date');
    //     // $to_date = $this->input->post('to_date');
    //     // $comp = $this->session->userdata('comp');

    //     $this->db->select('*');
    //     $this->db->from('tabel_barang'),
    //    $this->db->join('stock_barang', 'stock_barang.id_barang = history.id_barang', 'LEFT');
    //     $this->db->join('m_lokasi', 'm_lokasi.id_lokasi = stock_barang.id_lokasi', 'LEFT');
    //     $this->db->where('stock_barang.id_barang ');
    //     // $this->db->where('header_pembelian.pembelian_date <=', $to_date);
    //     $this->db->order_by('stock_barang.id_barang', 'asc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function GetReportAllInventoryTrans()
    {
      $comp = $this->session->userdata('comp');

      // $this->db->select('*');
      // $this->db->select('stock_barang.id_barang as id_barang_sum');
      // $this->db->select('stock_barang.id_lokasi as loc_id_sum');
      // $this->db->from('stock_barang');
      // $this->db->join('tabel_barang','tabel_barang.id_barang = stock_barang.id_barang','LEFT');
      // $this->db->join('m_lokasi','m_lokasi.id_lokasi = stock_barang.id_lokasi','LEFT');
      // $this->db->join('invent_unit','invent_unit.unit = stock_barang.unit_id','LEFT');
      // $this->db->where('stock_barang.id_lokasi !=','11');
      // $this->db->where('stock_barang.qty !=','0');
      // $this->db->or_where('stock_barang.qty >','0');
      // $this->db->or_where('stock_barang.id_lokasi !=','11');
      // $this->db->where('stock_barang.qty =','0');
      // // $this->db->or_where('stock_barang.id_comp =',$comp);
      // $this->db->order_by('stock_barang.id','desc');

      $this->db->select('*');
      $this->db->select('stock_barang.id_barang as id_barang_sum');
      $this->db->select('stock_barang.id_lokasi as loc_id_sum');
      $this->db->from('stock_barang');
      $this->db->join('tabel_barang','tabel_barang.id_barang = stock_barang.id_barang','LEFT');
      $this->db->join('m_lokasi','m_lokasi.id_lokasi = stock_barang.id_lokasi','LEFT');
      $this->db->join('invent_unit','invent_unit.unit = stock_barang.unit_id','LEFT');
      //$this->db->where('m_lokasi.location_stock =','Yes');
      // $this->db->where('stock_barang.id_lokasi !=','11');
      // $this->db->where('stock_barang.qty !=','0');
      // $this->db->or_where('stock_barang.qty >','0');
      // $this->db->or_where('stock_barang.id_lokasi !=','11');
      // $this->db->where('stock_barang.qty =','0');
      //$this->db->where('stock_barang.id_comp =',$comp);
      // $this->db->order_by('stock_barang.id','desc');

      $query = $this->db->get();
      return $query->result();
    }
}



