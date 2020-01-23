<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transfer extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function getTransferHeader()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->select('a.nama_lokasi as nama_lokasi_from', FALSE);
      $this->db->select('b.nama_lokasi as nama_lokasi_to', FALSE);
      $this->db->from('transfer_header');
      $this->db->join('m_lokasi a','a.id_lokasi = transfer_header.location_from','LEFT');
      $this->db->join('m_lokasi b','b.id_lokasi = transfer_header.location_to','LEFT');
      $this->db->where('transfer_header.id_comp =',$comp);
      $this->db->order_by('transfer_header.id','asc');

      $query = $this->db->get();
      return $query->result();
    }

    public function getTransferHeaderOpen()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->select('a.nama_lokasi as nama_lokasi_from', FALSE);
      $this->db->select('b.nama_lokasi as nama_lokasi_to', FALSE);
      $this->db->from('transfer_header');
      $this->db->join('m_lokasi a','a.id_lokasi = transfer_header.location_from','LEFT');
      $this->db->join('m_lokasi b','b.id_lokasi = transfer_header.location_to','LEFT');
      $this->db->where('transfer_header.id_comp =',$comp);
      $this->db->where('transfer_header.status =','Open');
      $this->db->order_by('transfer_header.id','asc');

      $query = $this->db->get();
      return $query->result();
    }

    public function getTransferHeaderTransit()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->select('a.nama_lokasi as nama_lokasi_from', FALSE);
      $this->db->select('b.nama_lokasi as nama_lokasi_to', FALSE);
      $this->db->from('transfer_header');
      $this->db->join('m_lokasi a','a.id_lokasi = transfer_header.location_from','LEFT');
      $this->db->join('m_lokasi b','b.id_lokasi = transfer_header.location_to','LEFT');
      $this->db->where('transfer_header.id_comp =',$comp);
      $this->db->where('transfer_header.status =','Shipping');
      $this->db->order_by('transfer_header.id','asc');

      $query = $this->db->get();
      return $query->result();
    }
    public function editTransfer($where, $data)
    {
      $this->db->update('transfer_header',$data,$where);
      return TRUE;
    }

    public function CountItem($itemId, $transfer_id)
    {

      $this->db->select('*');
      $this->db->from('transfer_detail');
      $this->db->where('id_barang',$itemId);
      $this->db->where('transfer_id',$transfer_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function getCountTransfer()
    {
      $waktu = $this->input->post('transfer_date');
      $date = date('m.y', strtotime($waktu));

      $this->db->select('*');
      $this->db->from('transfer_header');
      $this->db->like('transfer_id',$date);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function update($where, $data)
    {
        $this->db->update('transfer_detail', $data, $where);
        return TRUE;
    }

    public function getCountTransferDetail($date_transfer)
    {
      $date = date('m.y', strtotime($date_transfer));

      $this->db->select('*');
      $this->db->from('transfer_detail');
      $this->db->like('id_trans',$date);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function tambah($data)
    {
      $this->db->insert('transfer_header',$data);
      return TRUE;
    }

    public function getSingleTransferHeader($id)
    {

      $this->db->select('*');
      $this->db->select('a.nama_lokasi as nama_lokasi_from', FALSE);
      $this->db->select('b.nama_lokasi as nama_lokasi_to', FALSE);
      $this->db->from('transfer_header');
      $this->db->join('m_lokasi a','a.id_lokasi = transfer_header.location_from','LEFT');
      $this->db->join('m_lokasi b','b.id_lokasi = transfer_header.location_to','LEFT');
      $this->db->where('transfer_header.transfer_id =',$id);
      $this->db->order_by('transfer_header.id','desc');

      $query = $this->db->get();
      return $query->result();
    }

    public function GetTransferSingle($id)
    {

      $this->db->select('*');
      $this->db->from('transfer_detail');
      $this->db->join('tabel_barang','tabel_barang.id_barang = transfer_detail.id_barang','LEFT');
      $this->db->where('transfer_id',$id);
      $this->db->order_by('id_trans','DESC');
      $query = $this->db->get();

      return $query;
    }

    public function post($data ,$dataInvSum ,$dataTrans, $pembelian_id)
    {

      $this->db->insert('stock_barang',$dataInvSum);
      $this->db->insert('history',$dataTrans);
      $this->db->update('detail_pembelian', $data, array('id_beli' => $id_beli));
      return TRUE;
    }

    public function updateTransfer($data ,$dataInvSum ,$dataTrans ,$id_lokasi ,$id_barang,$id_trans)
    {

      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $id_lokasi));
      $this->db->insert('history',$dataTrans);
      $this->db->update('transfer_detail', $data, array('id_trans' => $id_trans));
      return TRUE;
    }

    public function updateTransfertoReceipt($data ,$dataInvSum ,$dataTrans ,$location_to ,$id_barang,$id_trans,$transfer_id)
    {

      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $location_to));
      $this->db->update('history', $data, array('ref_id_header' => $transfer_id));
      $this->db->update('transfer_detail', $data, array('id_trans' => $id_trans));
      return TRUE;
    }

    public function updateTransferReceipt($data ,$dataInvSum ,$dataTrans,$id_trans,$transfer_id)
    {

      $this->db->insert('stock_barang',$dataInvSum);
      $this->db->update('history', $dataTrans, array('ref_id_header' => $transfer_id));
      $this->db->update('transfer_detail', $data, array('id_trans' => $id_trans));
      return TRUE;
    }

    public function postTransit($dataInvSum)
    {
      $this->db->insert('stock_barang',$dataInvSum);
      return TRUE;
    }

    public function postTransitTo($dataInvSum ,$location_to ,$id_barang)
    {
      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $location_to));
      return TRUE;
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

    public function GetTransferDate()
    {
      $transfer_id = $this->input->post('transfer_id');

      $this->db->select('transfer_date');
      $this->db->from('transfer_header');
      $this->db->where('transfer_id',$transfer_id);
      $query = $this->db->get();

      foreach ($query->result_array() as $row) {
        echo $row['transfer_date'];
      }

      $transfer = array(
        'transfer_date' =>$row['transfer_date']
      );
      return $transfer;
    }

    public function tambahTrans($data)
    {
      $this->db->insert('history',$data);
      return TRUE;
    }

    public function tambahDetail($data)
    {
      $this->db->insert('transfer_detail',$data);
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

    public function get_qty_inv_sum_to($location_to,$id_barang)
    {

        $this->db->select('qty');
        $this->db->from('stock_barang');
        $this->db->where('id_barang',$id_barang);
        $this->db->where('id_lokasi',$location_to);
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
          echo $row['qty'];
        }

        $qty_sum = array(
          'qty' =>$row['qty']
        );
        
        return $qty_sum;
    }

    public function getQtyInvSumTo($location_to,$id_barang)
    {

        $this->db->select('qty');
        $this->db->from('stock_barang');
        $this->db->where('id_barang',$id_barang);
        $this->db->where('id_lokasi',$location_to);
        $query = $this->db->get();

        $r = '';
        foreach ($query->result_array() as $row) {
          $r = $row['qty'];
        }

        $qty_sum = array(
          'qty' =>$r
        );
        
        return $qty_sum;
    }

    public function GetCountTransferHeader($transfer_id)
    {

      $this->db->select('*');
      $this->db->from('transfer_detail');
      $this->db->join('transfer_header','transfer_header.transfer_id = transfer_detail.transfer_id','LEFT');
      $this->db->where('transfer_detail.transfer_id', $transfer_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function ShipTransPost($dataInvSumTo)
    {

      $this->db->insert('stock_barang',$dataInvSumTo);
      return TRUE;
    }

    public function UpdateShipTransPost($dataPostInvSumTo ,$location_to ,$id_barang)
    {

      $this->db->update('stock_barang',$dataPostInvSumTo, array('id_barang' => $id_barang, 'id_lokasi' => $location_to));
      return TRUE;
    }

    public function updateTransReceiptPost($data ,$dataInvSum ,$dataTrans ,$location_to ,$id_barang,$id_trans,$transfer_id)
    {

      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $location_to));
      $this->db->update('history', $dataTrans, array('ref_id_header' => $transfer_id));
      $this->db->update('transfer_detail', $data, array('id_trans' => $id_trans));
      return TRUE;
    }

    public function GetTransferOpen()
    {

      $this->db->select('*');
      $this->db->from('transfer_header');
      $this->db->like('status','Open');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetTransferTransit()
    {

      $this->db->select('*');
      $this->db->from('transfer_header');
      $this->db->like('status','hipping');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

}
