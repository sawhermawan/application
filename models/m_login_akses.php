<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login_akses extends CI_Model {


    public function __construct()
    {
        parent:: __construct();
    }


    public function GetAkses()
    {
        $query = $this->db->get('akses_login');
        return $query->result();
    }

    public function GetLoginType()
    {
        $query = $this->db->get('master_logintype');
        return $query->result();
    }

    public function tambah($data)
    {
        $this->db->insert('akses_login', $data);
       return TRUE;
    }

    public function update($where, $data)
    {
        $this->db->update('akses_login',$data,$where);
        return TRUE;
    }

    public function delete($where)
    {
        $this->db->delete('akses_login',$where);
        return TRUE;
    }
}