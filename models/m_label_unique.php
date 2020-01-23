<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_label_unique extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function GetDeleteType()
    {
        $id_type = $this->input->post('id_type');

        $this->db->select('*');
        $this->db->from('label_unique');
        $this->db->where('id_type =',$id_type);
        $this->db->where('delete_status =',0);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }
}