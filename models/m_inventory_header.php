<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventory_header extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


    public function GetStatusInvent($id){

    $single = $this->db->select('*')
                       ->from('header_pembelian')
                       ->where('pembelian_id', $id)
                       ->get();
        return $single;
    }

    public function GetStatusShipping($id){

    $single = $this->db->select('*')
                       ->from('header_pemakaian')
                       ->where('pemakaian_id', $id)
                       ->get();
        return $single;
    }

    public function GetStatusTransfer($id){

    $single = $this->db->select('*')
                       ->from('transfer_header')
                       ->where('transfer_id', $id)
                       ->get();
        return $single;
    }

    public function postHeader($dataHeader ,$pembelian_id)
    {

      $this->db->update('header_pembelian', $dataHeader, array('pembelian_id' => $pembelian_id));
      return TRUE;
    }

    public function postShipping($dataHeader ,$pemakaian_id)
    {

      $this->db->update('header_pemakaian', $dataHeader, array('pemakaian_id' => $pemakaian_id));
      return TRUE;
    }

    public function postTransfer($dataHeader ,$transfer_id)
    {

      $this->db->update('transfer_header', $dataHeader, array('transfer_id' => $transfer_id));
      return TRUE;
    }

    public function GetCountReceiptDetail($cpemakaian_id)
    {

      $this->db->select('*');
      $this->db->from('detail_pembelian');
      $this->db->join('header_pembelian','header_pembelian.pembelian_id = detail_pembelian.pembelian_id','LEFT');
      $this->db->where('detail_pembelian.pembelian_id', $cpemakaian_id);
      $this->db->where('detail_pembelian.status', 'Posted');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetCountShipDetail($pemakaian_id)
    {

      // $this->db->select('*');
      // $this->db->from('history');
      // $this->db->join('detail_pemakaian','detail_pemakaian.inv_history_id = history.inv_history_id','LEFT');
      // $this->db->join('header_pemakaian','header_pemakaian.pemakaian_id = detail_pemakaian.pemakaian_id','LEFT');
      // $this->db->where('detail_pemakaian.pemakaian_id', $pemakaian_id);
      // $this->db->where('history.status', 'Posted');
      // $query = $this->db->get();
      // $count = $query->num_rows();

      // return $count;

      $this->db->select('*');
      $this->db->from('detail_pemakaian');
      $this->db->join('header_pemakaian','header_pemakaian.pemakaian_id = detail_pemakaian.pemakaian_id','LEFT');
      $this->db->where('detail_pemakaian.pemakaian_id', $pemakaian_id);
      $this->db->where('detail_pemakaian.status', 'Posted');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetCountTransferDetail($transfer_id)
    {

      // $this->db->select('*');
      // $this->db->from('history');
      // $this->db->join('transfer_detail','transfer_detail.inv_history_id = history.inv_history_id','LEFT');
      // $this->db->join('transfer_header','transfer_header.transfer_id = transfer_detail.transfer_id','LEFT');
      // $this->db->where('transfer_detail.transfer_id', $transfer_id);
      // $this->db->where('history.status', 'Shipping');
      // $query = $this->db->get();
      // $count = $query->num_rows();

      // return $count;

      $this->db->select('*');
      $this->db->from('transfer_detail');
      $this->db->join('transfer_header','transfer_header.transfer_id = transfer_detail.transfer_id','LEFT');
      $this->db->where('transfer_detail.transfer_id', $transfer_id);
      $this->db->where('transfer_detail.status', 'Shipping');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetCountTransferDetailReceipt($transfer_id)
    {

      $this->db->select('*');
      $this->db->from('transfer_detail');
      $this->db->join('transfer_header','transfer_header.transfer_id = transfer_detail.transfer_id','LEFT');
      $this->db->where('transfer_detail.transfer_id', $transfer_id);
      $this->db->where('transfer_detail.status', 'Receipt');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function deleteDetail($id_beli)
    {
      $this->db->delete('detail_pembelian', array('id_beli' => $id_beli));
      return TRUE;
    }

    public function deleteDetailShip($id_pakai)
    {
      $this->db->delete('detail_pemakaian', array('id_pakai' => $id_pakai));

      return TRUE;
    }

    public function deleteDetailTrans($id_trans)
    {
      $this->db->delete('transfer_detail', array('id_trans' => $id_trans));

      return TRUE;
    }


    public function GetDeleteRecHeader()
    {
        $rec_id = $this->input->post('rec_id');

        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->where('pembelian_id =',$rec_id);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function deleteHeader($pembelian_id)
    {
      $this->db->delete('header_pembelian', array('id' => $pembelian_id));

      return TRUE;
    }

    public function GetDeleteShippHeader()
    {
        $ship_id = $this->input->post('ship_id');

        $this->db->select('*');
        $this->db->from('detail_pemakaian');
        $this->db->where('pemakaian_id =',$ship_id);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function deleteHeaderShip($id_pakaiping)
    {
      $this->db->delete('header_pemakaian', array('id' => $id_pakaiping));

      return TRUE;
    }

    public function GetDeleteTransHeader()
    {
        $histo_id = $this->input->post('histo_id');

        $this->db->select('*');
        $this->db->from('transfer_detail');
        $this->db->where('transfer_id =',$histo_id);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function deleteHeaderTrans($id_transfer)
    {
      $this->db->delete('transfer_header', array('id' => $id_transfer));

      return TRUE;
    }

    public function GetDateLockInv()
    {
      $query = $this->db->get('lock_inventory');

      return $query->result();
    }

    public function updateLockInv($where ,$data)
    {

      $this->db->update('lock_inventory', $data, $where);
      return TRUE;
    }

  public function GetFieldDateLockInv()
  {

    $query = $this->db->get('lock_inventory');

    foreach ($query->result_array() as $row) {
      echo $row['date_lock_inv'];
    }

    $lock_inv = array(
      'date_lock_inv' =>$row['date_lock_inv']
    );
    
    return $lock_inv;
  }

  public function get_user_info()
 {
    $location=$this->input->post("location");
    $query="SELECT id_user,fullname FROM dt_user WHERE id_lokasi ='$location' ";
    $user_info = $this->db->query($query);
    return $user_info;
  }
  public function updatepost1($where ,$data)
    {

      $this->db->update('detail_pembelian', $data, $where);
      return TRUE;
    }

   

}
