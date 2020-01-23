<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stock_barang extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function get_count_inv_sum($id_lokasi,$id_barang)
	{

		$this->db->select('*');
		$this->db->from('stock_barang');
		$this->db->where('id_barang',$id_barang);
		$this->db->where('id_lokasi',$id_lokasi);
		$query = $this->db->get();
		$count = $query->num_rows();

		return $count;
	}

	public function get_count_inv_sum_to($location_to,$id_barang)
	{

		$this->db->select('*');
		$this->db->from('stock_barang');
		$this->db->where('id_barang',$id_barang);
		$this->db->where('id_lokasi',$location_to);
		$query = $this->db->get();
		$count = $query->num_rows();

		return $count;
	}

	public function GetStock()
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

    public function get_qty_inv_sum($id_lokasi,$id_barang)
	  {

	      $this->db->select('qty');
	      $this->db->from('stock_barang');
	      $this->db->where('id_barang',$id_barang);
	      $this->db->where('id_lokasi',$id_lokasi);
	      $query = $this->db->get();

	      foreach ($query->result_array() as $row) {
	        echo $row['qty'];
	      }

	      $qty_sum = array(
	        'qty' =>$row['qty']
	      );
	      
	      return $qty_sum;
	  }

	public function getCountQtyTo($location_to,$id_barang)
		{

			$this->db->select('*');
			$this->db->from('stock_barang');
			$this->db->where('id_barang',$id_barang);
			$this->db->where('id_lokasi',$location_to);
			$query = $this->db->get();
			$count = $query->num_rows();

			return $count;
		}

	public function GetStockSingle($id)
	{
		$this->db->select('*');
	    $this->db->from('stock_barang');
	    $this->db->where('id =',$id);

	    $query = $this->db->get();
	    return $query->result();
	}

	public function edit($where, $data)
    {
    	// $loc = $this->input->post('nama_lokasi');
     //  	$group = $this->input->post('group_barang');

      $this->db->select('*');
      $this->db->select('stock_barang.id_barang as id_barang_sum');
      $this->db->select('stock_barang.id_barang as loc_id_sum');
      $this->db->from('stock_barang');
      $this->db->join('tabel_barang','tabel_barang.id_barang = stock_barang.id_barang','LEFT');
      // $this->db->join('m_lokasi','m_lokasi.nama_lokasi = stock_barang.id_barang','LEFT');
      $this->db->where('nama_barang');
      $this->db->join('invent_unit','invent_unit.unit = stock_barang.unit_id','LEFT');

      // $this->db->where('group_barang',$group);
      $query = $this->db->get();
      $count = $query->num_rows();

      $this->db->update('stock_barang',$data,$where);
      return TRUE;
    }

    public function editbarang($id)
    {
    	// $loc = $this->input->post('nama_lokasi');
     //  	$group = $this->input->post('group_barang');

      $this->db->select('*');
      $this->db->select('stock_barang.id_barang as id_barang_sum');
      $this->db->select('stock_barang.id_barang as loc_id_sum');
      $this->db->from('stock_barang');
      $this->db->join('tabel_barang','tabel_barang.id_barang = stock_barang.id_barang','LEFT');
      // $this->db->join('m_lokasi','m_lokasi.nama_lokasi = stock_barang.id_barang','LEFT');
      $this->db->where('nama_barang');
      $this->db->join('invent_unit','invent_unit.unit = stock_barang.unit_id','LEFT');

      // $this->db->where('group_barang',$group);
      $query = $this->db->get();
      $count = $query->num_rows();

      $this->db->update('tabel_barang',$id);
      return TRUE;
    }
    
}