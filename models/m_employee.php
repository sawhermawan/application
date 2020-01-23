<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_employee extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_employee_query()
    {
        $this->db->select('*');
        $this->db->from('dt_user');
        $this->db->order_by('fullname', 'asc');
        $query = $this->db->get();

        $query = $this->db->get('dt_user');
        return $query->result();
    }

    public function tambah($data)
    {
       $this->db->insert('dt_user', $data);
       return TRUE;
    }

    public function GetEmployeeSingle($id_user){

        $single = $this->db->select('*')
                           ->from('dt_user')
                           ->join('dt_unit', 'dt_unit.id_unit = dt_user.id_unit', 'LEFT')
                           ->join('m_lokasi', 'm_lokasi.id_lokasi = dt_user.id_lokasi', 'LEFT')
                           ->join('m_company', 'm_company.id_comp = dt_user.id_comp', 'LEFT')
                           ->where('id_user', $id_user)
                           ->get();
        return $single;
    }

    public function update($where, $data)
    {
        $this->db->update('dt_user', $data, $where);
        return TRUE;
    }

    public function get_count_login_access()
    {
      $firstname = $this->input->post('firstname');

      $this->db->select('*');
      $this->db->from('login_user');
      $this->db->where('username',$firstname);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function get_login_access()
    {
        $firstname = $this->input->post('firstname');

        $query = $this->db->get_where('login_user', array('username' => $firstname));
        return $query->result();
    }

    public function update_login_access($data, $data2)
    {

      $firstname = $this->input->post('firstname');

      $this->db->insert('akses_login',$data);
      $this->db->update('login_user',$data2, array('username' => $firstname));
      return TRUE;
    }

   public function tambah_login($data)
    {
       $this->db->insert('login_user', $data);
       return TRUE;
    }

    public function get_login_type()
    {

        $query = $this->db->get('m_login_type');
        return $query->result();
    }

    public function GetDeleteEmployee()
    {
        $id_uni = $this->input->post('id_unit');

        $this->db->select('*');
        $this->db->from('dt_user');
        $this->db->where('id_unit =',$id_uni);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function GetDeleteEmployeeLoc()
    {
        $id_lokasi = $this->input->post('id_loc');

        $this->db->select('*');
        $this->db->from('dt_user');
        $this->db->where('id_lokasi =',$id_lokasi);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function change_pic($data, $data2, $id_user)
    {

      $this->db->update('login_user',$data, array('id_user' => $id_user));
      $this->db->update('dt_user',$data2, array('id_user' => $id_user));
      return TRUE;
    }
}
