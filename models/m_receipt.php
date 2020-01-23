<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_receipt extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function getSuplay()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->from('header_pembelian');
      $this->db->join('suplayer','suplayer.id_suplayer = header_pembelian.id_suplayer','LEFT');
      $this->db->where('header_pembelian.id_comp =',$comp);
      $this->db->order_by('header_pembelian.id','asc');

      $query = $this->db->get();
      return $query->result();
    }
    
    public function getReceiptHeader()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->from('header_pembelian');
      $this->db->join('m_lokasi','m_lokasi.id_lokasi = header_pembelian.id_lokasi','LEFT');
      $this->db->join('suplayer','suplayer.id_suplayer = header_pembelian.id_suplayer','LEFT');
      // $this->db->join('detail_pembelian','detail_pembelian.id_barang = daftar_harga.id_barang','LEFT');
      // $this->db->where('detail_pembelian.id_comp =',$comp);
      $this->db->where('header_pembelian.id_comp =',$comp);
      $this->db->order_by('header_pembelian.id','asc');

      $query = $this->db->get();
      return $query->result();
    }

    public function GetSingleReceiptHeader($id)
    {
      $this->db->select('*');
      $this->db->from('header_pembelian');
      $this->db->join('m_lokasi','m_lokasi.id_lokasi = header_pembelian.id_lokasi','LEFT');
      $this->db->join('suplayer','suplayer.id_suplayer = header_pembelian.id_suplayer','LEFT');
      $this->db->join('daftar_harga','daftar_harga.id = header_pembelian.id','LEFT');
      $this->db->where('header_pembelian.pembelian_id =',$id);
      $this->db->order_by('header_pembelian.id','asc');

      $query = $this->db->get();
      return $query->result();
    }

    public function getCountReceiptDetail($date_receipt)
    {
      $date = date('m.y', strtotime($date_receipt));

      $this->db->select('*');
      $this->db->from('detail_pembelian');
      $this->db->like('id_beli',$date);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function CountItem($itemId, $pembelian_id)
    {

      $this->db->select('*');
      $this->db->from('detail_pembelian');
      $this->db->where('id_barang',$itemId);
      $this->db->where('pembelian_id',$pembelian_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function edit($where, $data)
    {
      $this->db->update('header_pembelian',$data,$where);
      return TRUE;
    }

    public function updateHeader($where, $data)
    {
        $this->db->update('header_pembelian', $data, $where);
        return TRUE;
    }

    public function get_count_rec()
    {
      $waktu = $this->input->post('pembelian_date');
      $date = date('m.y', strtotime($waktu));

      $this->db->select('*');
      $this->db->from('header_pembelian');
      $this->db->like('pembelian_id',$date);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetItemCategoryMasterTable()
    {
      $id_barang=$this->input->post("itemId");

      $query="SELECT * FROM tabel_barang LEFT JOIN kategori_barang ON kategori_barang.id_kategori = tabel_barang.id_kategori WHERE tabel_barang.id_barang = '$id_barang' && tabel_barang.delete_status = '0'";
      $item_info = $this->db->query($query);
      return $item_info;
    }

    public function GetInventCategoryWhere($id_kategori,$group_barang)
    {

        $this->db->select('*');
        $this->db->from('kategori_barang');
        $this->db->where('id_group_barang =',$group_barang);
        $this->db->where('id_kategori !=',$id_kategori);
        $this->db->where('delete_status =','0');
        $query = $this->db->get();
        return $query->result();
    }

    public function GetItemMasterTable()
    {
      $id_barang=$this->input->post("itemId");

      $query="SELECT * FROM tabel_barang WHERE id_barang = '$id_barang' && delete_status = '0'";
      $item_info = $this->db->query($query);
      return $item_info;
    }

    public function GetInventUnitWhere($unit)
    {

        $this->db->select('*');
        $this->db->from('invent_unit');
        $this->db->where('unit !=',$unit);
        $this->db->where('delete_status =','0');
        $query = $this->db->get();
        return $query->result();
    }

    public function tambah($data)
    {
      $this->db->insert('header_pembelian',$data);
      return TRUE;
    }


    public function GetReceiptSingle($id){

      $this->db->select('*');
      $this->db->from('detail_pembelian');
      $this->db->join('tabel_barang','tabel_barang.id_barang = detail_pembelian.id_barang','LEFT');
      // $this->db->join('history','history.id_barang = detail_pembelian.id_barang','LEFT');
      // $this->db->join('daftar_harga','daftar_harga.id_barang = detail_pembelian.id_barang','LEFT');
      $this->db->where('pembelian_id',$id);
      $this->db->order_by('id_beli','DESC');
      $query = $this->db->get();

      return $query;
    }

    public function GetReceiptSingletot($id){

      $query = "SELECT sum(harga) as total from detail_pembelian";
      $total = $this->db->query($query);

      return $total;
    }



    public function GetReceiptDate()
    {
      $pembelian_id = $this->input->post('pembelian_id');

      $this->db->select('*');
      $this->db->from('header_pembelian');
      $this->db->where('pembelian_id',$pembelian_id);
      $query = $this->db->get();

      foreach ($query->result_array() as $row) {
        echo $row['pembelian_date'];
        echo $row['receipt_type'];
      }

      $receipt = array(
        'pembelian_date' =>$row['pembelian_date'],
        'receipt_type' =>$row['receipt_type']
      );
      
      return $receipt;
      }

      public function tambahTrans($data)
      {
        $this->db->insert('history',$data);
        return TRUE;
      }

      public function tambahDetail($data)
      {
        $this->db->insert('detail_pembelian',$data);
        return TRUE;
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

    public function update($where, $data)
    {
        $this->db->update('detail_pembelian', $data, $where);
        return TRUE;
    }


    public function GetCountReceipt($pembelian_id)
    {

      $this->db->select('*');
      $this->db->from('detail_pembelian');
      $this->db->join('header_pembelian','header_pembelian.pembelian_id = detail_pembelian.pembelian_id','LEFT');
      $this->db->where('detail_pembelian.pembelian_id', $pembelian_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function post($data, $id_beli, $dataTrans, $dataInvSum)
    {
      $this->db->update('detail_pembelian',$data,array('id_beli' => $id_beli));
      $this->db->insert('history',$dataTrans);
      $this->db->insert('stock_barang',$dataInvSum);
      return TRUE;
    }

    public function updatepost($data ,$dataTrans ,$dataInvSum ,$id_lokasi ,$id_barang, $id_beli)
    {

      $this->db->update('detail_pembelian', $data, array('id_beli' => $id_beli));
      $this->db->insert('history',$dataTrans);
      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $id_lokasi));
      
      return TRUE;
    }

    public function post1($data, $id_beli, $dataTrans, $dataInvSum)
    {
      $this->db->update('detail_pembelian',$data,array('id_beli' => $id_beli));
      $this->db->insert('history',$dataTrans);
      $this->db->insert('stock_barang',$dataInvSum);
      return TRUE;
    }

    public function updatepost1($data ,$dataTrans ,$dataInvSum ,$id_lokasi ,$id_barang, $id_beli)
    {

      $this->db->update('detail_pembelian', $data, array('id_beli' => $id_beli));
      $this->db->insert('history',$dataTrans);
      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $id_lokasi));
      
      return TRUE;
    }



    public function GetUnitReceipt($itemId)
    {
      $this->db->select('*');
      $this->db->select('detail_pembelian.pembelian_id as rec_id');
      $this->db->select('detail_pembelian.id_comp as comp_rec');
      $this->db->select('detail_pembelian.status as stat_detail');
      $this->db->from('detail_pembelian');
      $this->db->join('header_pembelian','header_pembelian.pembelian_id = detail_pembelian.pembelian_id','LEFT');
      $this->db->where('detail_pembelian.pembelian_id',$itemId);
      $query = $this->db->get();

      return $query->result();
      
    }

    public function GetReceiptOpen()
    {

      $this->db->select('*');
      $this->db->from('header_pembelian');
      $this->db->like('status','Open');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function getReceiptHeaderOpen()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->from('header_pembelian');
      $this->db->join('m_lokasi','m_lokasi.id_lokasi = header_pembelian.id_lokasi','LEFT');
      $this->db->where('header_pembelian.id_comp =',$comp);
      $this->db->where('status','Open');
      $this->db->order_by('header_pembelian.id','asc');

      $query = $this->db->get();
      return $query->result();
    }

}
