<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_daftar_harga extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function GetSingleharga($id)
    {
      $query = $this->db->get_where('daftar_harga',array('id' => $id, 'delete_status' => 0));
      return $query->result();
    }
    
    public function get_daftar_harga_query()
    {
        $comp = $this->session->userdata('comp');

        $this->db->select('*');
        $this->db->select('daftar_harga.id_barang as item_harga');
        $this->db->from('daftar_harga');
        $this->db->join('tabel_barang', 'tabel_barang.id_barang = daftar_harga.id_barang', 'LEFT');
        $this->db->join('invent_unit', 'invent_unit.unit = daftar_harga.unit_id', 'LEFT');
        $this->db->where('daftar_harga.delete_status =','0');
        $this->db->where('daftar_harga.id_comp =',$comp);
        $this->db->order_by('daftar_harga.id_barang','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_count_harga()
    {
      $item = $this->input->post('id_barang');
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->from('daftar_harga');
      $this->db->where('id_barang',$item);
      $this->db->where('delete_status=','0');
      $this->db->where('id_comp',$comp);
      $query = $this->db->get();

      foreach ($query->result_array() as $item) {
        echo $item['harga'];
      }

      $count = array(
        'harga' =>$item['harga'],
      );
      

      return $count;
    }

    public function GetCountValidasihargaEdit()
    {
      $item = $this->input->post('id_barang');
      $unit = $this->input->post('unit_id');

      $this->db->select('*');
      $this->db->from('daftar_harga');
      $this->db->where('id_barang',$item);
      $this->db->where('unit_id',$unit);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function update($data)
    {
      $this->db->where('id_barang',$data['id_barang']);
      $this->db->where('id_comp',$data['id_comp']);
      $this->db->set('delete_status',0);
      $this->db->update('daftar_harga');
      return TRUE;
    }

    public function update_harga($where, $data)
    {
        $this->db->update('daftar_harga', $data, $where);
        return TRUE;
    }

    public function tambah($data)
    {
      $this->db->insert('daftar_harga',$data);
      return TRUE;
    }

    public function GetDeleteInvetItem()
    {
        $id_item = $this->input->post('id_item');

        $this->db->select('*');
        $this->db->from('daftar_harga');
        $this->db->where('id_barang =',$id_item);
        $this->db->where('delete_status =','0');
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function GetCountInventharga($id_barang, $id_comp)
    {
        $this->db->select('*');
        $this->db->from('daftar_harga');
        $this->db->where('id_barang =',$id_barang);
        $this->db->where('delete_status =','0');
        $this->db->where('id_comp',$id_comp);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    function GethargaItem($id_barang, $id_comp)
    {
      $query = $this->db->get_where('daftar_harga',array('id_barang' => $id_barang, 'id_comp' =>$id_comp));
      $r = '';
      $s = '';
      foreach ($query->result_array() as $row) {
            $r = $row['unit_id'];
            $s = $row['harga'];
          }

          $GetFactor = array(
            'unit_id' =>$r,
            'harga'   =>$s
          );
          
          return $GetFactor;
    }
}
