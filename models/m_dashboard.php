<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function Needstock()
    {
      $query="SELECT nama_barang, qty, unit_id FROM stock_barang as sb JOIN tabel_barang as tb ON sb.id_barang = tb.id_barang JOIN kategori_barang as kb ON sb.id_kategori = kb.id_kategori ORDER BY qty";

      $infostock = $this->db->query($query);
      return $infostock;
    }

    public function AlatTulis()
    {
      $this->db->select('*');
      $this->db->from('stock_barang as sb');
      $this->db->join('tabel_barang as tb','tb.id_barang = sb.id_barang','LEFT');
      $this->db->join('kategori_barang as kb','sb.id_kategori = kb.id_kategori','LEFT');
      $this->db->where('kb.id_kategori','AT');
      $this->db->order_by('qty');

      $query = $this->db->get();
      return $query->result();

    }

    public function KategoriBuku()
    {
      $query="SELECT nama_barang, qty, unit_id FROM stock_barang as sb JOIN tabel_barang as tb ON sb.id_barang = tb.id_barang JOIN kategori_barang as kb ON sb.id_kategori = kb.id_kategori WHERE kb.id_kategori='KB'";

      $infobuku = $this->db->query($query);
      return $infobuku;

    }

    public function KategoriKertas()
    {
      $query="SELECT nama_barang, qty, unit_id FROM stock_barang as sb JOIN tabel_barang as tb ON sb.id_barang = tb.id_barang JOIN kategori_barang as kb ON sb.id_kategori = kb.id_kategori WHERE kb.id_kategori='KK'";

      $infokertas = $this->db->query($query);
      return $infokertas;

    }

    public function KategoriUmum()
    {
      $query="SELECT nama_barang, qty, unit_id FROM stock_barang as sb JOIN tabel_barang as tb ON sb.id_barang = tb.id_barang JOIN kategori_barang as kb ON sb.id_kategori = kb.id_kategori WHERE kb.id_kategori = 'UM'  ";

      $infoumum = $this->db->query($query);
      return $infoumum;

    }

    public function FileOrganizer()
    {
      $query="SELECT nama_barang, qty, unit_id FROM stock_barang as sb JOIN tabel_barang as tb ON sb.id_barang = tb.id_barang JOIN kategori_barang as kb ON sb.id_kategori = kb.id_kategori WHERE kb.id_kategori= 'FO'  ";
      $fileoranizer = $this->db->query($query);
      return $fileoranizer;

    }


    
    
}