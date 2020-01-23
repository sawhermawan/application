<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_category extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function GetCountCategoryItem()
    {

      $this->db->select('*');
      $this->db->from('kategori_barang');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function ValDeleteItemGroup()
    {
      $group_id = $this->input->post('group_id');

      $this->db->select('id_group_barang');
      $this->db->from('kategori_barang');
      $this->db->where('id_group_barang', $group_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }


    public function GetAllCategory()
    {
      $comp = $this->session->userdata('comp');

      $query = $this->db->get_where('kategori_barang',array('delete_status' => 0,'id_comp' =>$comp));
      return $query->result();
    }

    public function GetAllCategoryWhere($item)
    {
      $comp = $this->session->userdata('comp');

      $query = $this->db->get_where('kategori_barang',array('delete_status' => 0,'id_comp' => $comp,'id_group_barang' => $item));
      return $query->result();
    }

    public function tambah($data)
    {
      $this->db->insert('kategori_barang',$data);
      return TRUE;
    }

    public function GetCountCategory()
    {
      $id_kategori = strtoupper($this->input->post('id_kategori'));

      $this->db->select('*');
      $this->db->from('kategori_barang');
      $this->db->where('delete_status =','0');
      $this->db->where('id_kategori',$id_kategori);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetSingleCategory($id)
    {
      $query = $this->db->get_where('kategori_barang',array('id' => $id, 'delete_status' => 0));
      return $query->result();
    }

    public function update($where, $data)
    {
      $this->db->update('kategori_barang',$data,$where);
      return TRUE;
    }

    public function GetCountCategoryValidasi($GCategory)
    {

      $this->db->select('*');
      $this->db->from('tabel_barang');
      $this->db->where('id_kategori',$GCategory);
      $this->db->where('delete_status', '0');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }
}
