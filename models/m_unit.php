3<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_unit extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_unit_query()
    {

        $query = $this->db->get_where('dt_unit',array('delete_status' => 0));
        return $query->result();
    }

    // function untuk menambahkan Unit
    public function tambah($data)
    {
       $this->db->insert('dt_unit', $data);
       return TRUE;
    }
    // end function untuk tambahkan unit

   // function untuk edit unit
    public function GetUnitSingle($id_unit){

        $single = $this->db->select('*')
                           ->from('dt_unit')
                           ->where('id_unit', $id_unit)
                           ->get();
        return $single;
    }
   // end function untuk edit unit

    public function update($where, $data)
    {
        $this->db->update('dt_unit', $data, $where);
        return TRUE;
    }

  public function GetCountUnitName()
  {
    $unit_name = $this->input->post('nama');

    $this->db->select('*');
    $this->db->from('dt_unit');
    $this->db->where('nama_unit',$unit_name);
    $query = $this->db->get();
    $count = $query->num_rows();

    return $count;
  }
}
