<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}


	function cek_user($username="",$password="")
	{
		$query = $this->db->get_where('akses_login',array('username'=> $username, 'password'=> $password));
		$query = $query->result_array();
		return $query;
	}

    function getTechnician()
    {
            $query = $this->db->get('akses_login');
        return $query->result();
    }

	public function GetAksesLogin()
	{
		$query = $this->db->get('akses_login');

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

    public function MasterLoginType()
    {
    	$query = $this->db->get('master_logintype');

		return $query->result();
    }

     public function GetAksesLoginCount()
    {

        $this->db->select('id_loginakses');
        $this->db->from('akses_login');
        $this->db->where('status =','Active');
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

}