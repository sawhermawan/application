<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_lokasi extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_location_query()
	{
		$query = $this->db->get_where('m_lokasi',array('delete_status' => 0));
		return $query->result();
	}

	public function tambah($data)
    {
       $this->db->insert('m_lokasi', $data);
       return TRUE;
    }

    public function get_name_location()
	{
		$name_location = $this->input->post('id_lokasi');
		$this->db->select('nama_lokasi');
		$this->db->from('m_lokasi');
		$this->db->where('id_lokasi',$name_location);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			echo $row['nama_lokasi'];
		}

		$loc = array(
			'nama_lokasi' =>$row['nama_lokasi']
		);
		
		return $loc;
	}

	public function get_Code_location()
	{
		$name_location = $this->input->post('id_lokasi');
		$this->db->select('codeLocation');
		$this->db->from('m_lokasi');
		$this->db->where('id_lokasi',$name_location);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			echo $row['codeLocation'];
		}

		$loc = array(
			'codeLocation' =>$row['codeLocation']
		);
		
		return $loc;
	}

	public function getCodeLocation($id_loc)
	{
		$this->db->select('codeLocation');
		$this->db->from('m_lokasi');
		$this->db->where('id_lokasi',$id_loc);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			echo $row['codeLocation'];
		}

		$loc = array(
			'codeLocation' =>$row['codeLocation']
		);
		
		return $loc;
	}

	public function GetCountLocationName()
	  {
	    $nama_lokasi = $this->input->post('name');
	    $location_code = $this->input->post('location_code');

	    $this->db->select('*');
	    $this->db->from('m_lokasi');
	    $this->db->where('nama_lokasi',$nama_lokasi);
	    $this->db->where('codeLocation',$location_code);
	    $query = $this->db->get();
	    $count = $query->num_rows();

	    return $count;
	  }

	  public function update($where, $data)
    {
        $this->db->update('m_lokasi', $data, $where);
        return TRUE;
    }
}
