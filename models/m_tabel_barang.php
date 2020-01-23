<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tabel_barang extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function GetUnitMasterTable($id_barang)
    {

      $query = $this->db->get_where('tabel_barang',array('id_barang'  =>$id_barang));

      foreach ($query->result_array() as $row) {
        echo $row['inventoryUnit'];
        echo $row['pemakaian_unit'];
      }

      $invUnit = array(
        'inventoryUnit' =>$row['inventoryUnit'],
        'pemakaian_unit' =>$row['pemakaian_unit']
      );
      
      return $invUnit;
    }

     public function GetCountUnitMasterTable($citemId)
    {

      $query = $this->db->get_where('tabel_barang',array('id_barang'  =>$citemId));

      foreach ($query->result_array() as $row) {
        echo $row['inventoryUnit'];
        echo $row['pemakaian_unit'];
      }

      $invUnit = array(
        'inventoryUnit' =>$row['inventoryUnit'],
        'pemakaian_unit' =>$row['pemakaian_unit']
      );
      
      return $invUnit;
    }


    public function GetInventTable()
    {
        $id_comp      = $this->session->userdata('comp');

        $this->db->select('*');
        $this->db->from('tabel_barang');
        $this->db->where('delete_status =','0');
        $this->db->where('id_comp',$id_comp);
        $query = $this->db->get();

        return $query->result();
    }

     public function GetItemId()
    {

      $id_barang = $this->input->post('id_barang');

      $this->db->select('unit_barang');
      $this->db->from('tabel_barang');
      $this->db->where('id_barang',$id_barang);
      $query = $this->db->get();

      foreach ($query->result_array() as $row) {
        echo $row['unit_barang'];
      }

      $inv_id = array(
        'unit_barang' =>$row['unit_barang']
      );
      
      return $inv_id;
    }

    public function GetDeleteItemGroup()
    {
        $group_id = $this->input->post('group_id');

        $this->db->select('*');
        $this->db->from('tabel_barang');
        $this->db->where('group_barang =',$group_id);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

}
