<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_invent_unit extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_invent_unit_query()
    {

        $query = $this->db->get_where('invent_unit',array('delete_status' => 0));
        return $query->result();
    }

    public function GetSingleUnit($id_unit)
    {
      $query = $this->db->get_where('invent_unit',array('id_unit' => $id_unit, 'delete_status' => 0));
      return $query->result();
    }

    public function GetCountUnitValidasiAdd()
    {
      $unit = strtoupper($this->input->post('unit'));

      $this->db->select('*');
      $this->db->from('invent_unit');
      $this->db->where('delete_status =','0');
      $this->db->where('unit',$unit);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetCountUnitValidasiEdit($gUnit)
    {

      $this->db->select('*');
      $this->db->from('tabel_barang');
      $this->db->where('pembelian_unit',$gUnit);
      $this->db->or_where('pemakaian_unit',$gUnit);
      $this->db->or_where('inventoryUnit',$gUnit);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function update($data)
    {
      $this->db->where('unit',$data['unit']);
      $this->db->set('delete_status',0);
      $this->db->update('invent_unit');
      return TRUE;
    }

   public function update_unit($where, $data)
    {
        $this->db->update('invent_unit', $data, $where);
        return TRUE;
    }

    public function tambah($data)
    {
      $this->db->insert('invent_unit',$data);
      return TRUE;
    }

    public function GetDeleteInvetUnit()
    {
        $unit = strtoupper($this->input->post('unit'));

        $this->db->select('*');
        $this->db->from('tabel_barang');
        $this->db->where('pembelian_unit',$unit);
        $this->db->or_where('pemakaian_unit',$unit);
        $this->db->or_where('inventoryUnit',$unit);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }
}
