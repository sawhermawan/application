<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login_user extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function get_login_user()
	{
		$this->db->select('*');
		$this->db->from('login_user');
		$this->db->join('m_login_type','m_login_type.id_type_login = login_user.login_type','LEFT');
		$this->db->order_by('login_user.id','desc');
		$query = $this->db->get();
		return $query->result();
	}


	public function get_count_login()
	{
		$name = $this->input->post('name_user');
		$login_type =$this->input->post('login_type');

		$this->db->select('*');
		$this->db->from('login_user');
		$this->db->where('name',$name);
		$this->db->where('login_type',$login_type);
		$query = $this->db->get();
		$count = $query->num_rows();

		return $count;
	}

	public function update($where, $data)
    {
        $this->db->update('login_user', $data, $where);
        return TRUE;
    }

}