<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_company extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_company_query()
    {

        $query = $this->db->get_where('m_company',array('delete_status' => 0));
        return $query->result();
    }

}
