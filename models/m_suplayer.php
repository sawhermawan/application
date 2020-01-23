<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_suplayer extends CI_Model {


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

    public function getSuplay()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->from('header_pembelian');
      $this->db->join('suplayer','suplayer.id_suplayer = header_pembelian.id_suplayer','LEFT');
      $this->db->where('header_pembelian.id_comp =',$comp);
      $this->db->order_by('header_pembelian.id','asc');

      $query = $this->db->get();
      return $query->result();
    }
    
}
