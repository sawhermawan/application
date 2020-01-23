<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventory_detail extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


    public function GetCountDetail($id)
    {

        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->where('pembelian_id =',$id);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function GetCountDetailShip($id)
    {

        $this->db->select('*');
        $this->db->from('detail_pemakaian');
        $this->db->where('pemakaian_id =',$id);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function GetCountDetailTrans($id)
    {

        $this->db->select('*');
        $this->db->from('transfer_detail');
        $this->db->where('transfer_id =',$id);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

}
