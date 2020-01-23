<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_group_barang extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function GetSuplayerInfo()
    {
        // $comp = $this->session->userdata('comp');

        $query = $this->db->get_where('suplayer');
        return $query->result();

    }

    public function GetSingleItemGroup($id_group)
    {
      $query = $this->db->get_where('invent_group_barang',array('id' => $id_group, 'delete_status' => 0));
      return $query->result();
    }

    public function GetCountGorupValidasiEdit($id_group)
    {

      $this->db->select('*');
      $this->db->from('tabel_barang');
      $this->db->where('group_barang',$id_group);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }
    
    public function get_group_barang_query()
    {
        $comp = $this->session->userdata('comp');

        $query = $this->db->get_where('invent_group_barang', array('delete_status' => 0,'id_comp'));
        return $query->result();

        // $this->db->select('*');
        // $this->db->from('group_barang');
        // $this->db->where('delete_status =','0');
        // $this->db->where('id_comp =',$comp);
        // $query = $this->db->get();
        // return $query->result();
    }

    public function get_count_group_barang()
    {
      $group_id   = strtoupper($this->input->post('group_id'));
      $id_comp    = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->from('invent_group_barang');
      $this->db->where('group_id',$group_id);
      $this->db->where('delete_status =','0');
      $this->db->where('id_comp',$id_comp);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

  public function update($data)
  {
    $this->db->where('group_id',$data['group_id']);
    $this->db->where('invent_group_barang',$data['group_barang']);
    $this->db->set('delete_status',0);
    $this->db->update('invent_group_barang');
    return TRUE;
  }

   public function update_group($where, $data)
    {
        $this->db->update('invent_group_barang', $data, $where);
        return TRUE;
    }

  public function tambah($data)
  {
    $this->db->insert('invent_group_barang',$data);
    return TRUE;
  }
}
