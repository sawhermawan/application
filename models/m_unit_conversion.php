<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_unit_conversion extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function GetSingleUnitFromTo($id)
    {
      $query = $this->db->get_where('unit_conversion',array('id_conversion' => $id));
      return $query->result();
    }

    function GetConversion($itemId, $unitFrom, $unitTo)
    {
      $query = $this->db->get_where('unit_conversion',array('id_barang' => $itemId, 'unit_from' =>$unitFrom , 'unit_to' => $unitTo));
      $r = '';
      foreach ($query->result_array() as $row) {
            $r = $row['factor'];
          }

          $GetFactor = array(
            'factor' =>$r
          );
          
          return $GetFactor;
    }

    // function GetCounConversion($citemId, $cunitFrom, $cunitTo)
    // {
    //   $query = $this->db->get_where('unit_conversion',array('id_barang' => $citemId, 'unit_from' =>$cunitFrom , 'unit_to' => $cunitTo));
    //   foreach ($query->result_array() as $gconvback) {
    //     echo $gconvback['factor'];
    //   }

    //   $invUnit = array(
    //     'factor' =>$gconvback['factor']
    //   );
      
    //   return $invUnit;
    // }

    // function GetCounConversionBack($citemId, $cunitFrom, $cunitTo)
    // {

    //   $queryBack = $this->db->get_where('unit_conversion',array('id_barang' => $citemId, 'unit_to' =>$cunitFrom , 'unit_from' => $cunitTo));
    //   foreach ($queryBack->result_array() as $rowBack) {
    //     echo $rowBack['factor'];
    //   }

    //   $invUnitBack = array(
    //     'factor' =>$rowBack['factor']
    //   );
      
    //   return $invUnitBack;
    // }

    function GetConversionBack($itemId, $unitFrom, $unitTo)
    {

      $queryBack = $this->db->get_where('unit_conversion',array('id_barang' => $itemId, 'unit_to' =>$unitFrom , 'unit_from' => $unitTo));
      $r ='';
      foreach ($queryBack->result_array() as $rowBack) {
        $r = $rowBack['factor'];
      }

      $invUnitBack = array(
        'factor' =>$r
      );
      
      return $invUnitBack;
    }

    public function GetUnitConversion($itemId, $unitFrom, $unitTo)
    {

      $this->db->select('*');
      $this->db->from('unit_conversion');
      $this->db->where('delete_status =','0');
      $this->db->where('id_barang',$itemId);
      $this->db->where('unit_from',$unitFrom);
      $this->db->where('unit_to',$unitTo);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    // public function GetCounUnitConversion($citemId, $cunitFrom, $cunitTo)
    // {

    //   $this->db->select('*');
    //   $this->db->from('unit_conversion');
    //   $this->db->where('delete_status =','0');
    //   $this->db->where('id_barang',$citemId);
    //   $this->db->where('unit_from',$cunitFrom);
    //   $this->db->where('unit_to',$cunitTo);
    //   $query = $this->db->get();
    //   $count = $query->num_rows();

    //   return $count;
    // }
    // public function GetCounUnitConversionBack($citemId, $cunitFrom, $cunitTo)
    // {

    //   $this->db->select('*');
    //   $this->db->from('unit_conversion');
    //   $this->db->where('delete_status =','0');
    //   $this->db->where('id_barang',$citemId);
    //   $this->db->where('unit_to',$cunitFrom);
    //   $this->db->where('unit_from',$cunitTo);
    //   $query = $this->db->get();
    //   $count = $query->num_rows();

    //   return $count;
    // }

    public function GetUnitConversionBack($itemId, $unitFrom, $unitTo)
    {

      $this->db->select('*');
      $this->db->from('unit_conversion');
      $this->db->where('delete_status =','0');
      $this->db->where('id_barang',$itemId);
      $this->db->where('unit_to',$unitFrom);
      $this->db->where('unit_from',$unitTo);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetCountUnitConversion()
    {
      $unitFrom = $this->input->post('unitFrom');
      $unitTo = $this->input->post('unitTo');
      $itemId = $this->input->post('id_barang');

      $this->db->select('*');
      $this->db->from('unit_conversion');
      $this->db->where('delete_status =','0');
      $this->db->where('id_barang',$itemId);
      $this->db->where('unit_from',$unitFrom);
      $this->db->where('unit_to',$unitTo);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetCountUnitConversionBack()
    {
      $unitFrom = $this->input->post('unitFrom');
      $unitTo = $this->input->post('unitTo');
      $itemId = $this->input->post('id_barang');

      $this->db->select('*');
      $this->db->from('unit_conversion');
      $this->db->where('delete_status =','0');
      $this->db->where('id_barang',$itemId);
      $this->db->where('unit_to',$unitFrom);
      $this->db->where('unit_from',$unitTo);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetUnitConversionAll()
    {
      $id_comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->select('c.unit as unitFrom');
      $this->db->select('d.unit as unitTo');
      $this->db->select('b.id_barang as id_barang_table');
      $this->db->from('unit_conversion a');
      $this->db->join('tabel_barang b', 'b.id_barang = a.id_barang', 'LEFT');
      $this->db->join('invent_unit c', 'c.unit = a.unit_from', 'LEFT');
      $this->db->join('invent_unit d', 'd.unit = a.unit_to', 'LEFT');
      $this->db->where('a.id_comp =',$id_comp);
      $this->db->where('a.delete_status =','0');
      $this->db->order_by('a.id_conversion','asc');
      $query = $this->db->get();
      return $query->result();
    }
    
    public function tambah($data)
    {
      $this->db->insert('unit_conversion',$data);
      return TRUE;
    }

    public function GetUnitConversionTo()
    {
      $unit_from=$this->input->post("unitFrom");

      $query="SELECT * FROM invent_unit WHERE unit != '$unit_from' && delete_status = '0'";
      $unit_info = $this->db->query($query);
      return $unit_info;
    }

    public function update($where, $data)
    {
        $this->db->update('unit_conversion', $data, $where);
        return TRUE;
    }

    public function GetDeleteInvetItemUnitConver()
    {
        $item = $this->input->post('id_barang');

        $this->db->select('*');
        $this->db->from('history');
        $this->db->where('id_barang',$item);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function GethargaUnitConversion($id_barang, $itemhargaUnit, $unit_id)
    {

      $this->db->select('*');
      $this->db->from('unit_conversion');
      $this->db->where('delete_status =','0');
      $this->db->where('id_barang',$id_barang);
      $this->db->where('unit_from',$itemhargaUnit);
      $this->db->where('unit_to',$unit_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GethargaUnitConversionBack($id_barang, $itemhargaUnit, $unit_id)
    {

      $this->db->select('*');
      $this->db->from('unit_conversion');
      $this->db->where('delete_status =','0');
      $this->db->where('id_barang',$id_barang);
      $this->db->where('unit_to',$itemhargaUnit);
      $this->db->where('unit_from',$unit_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    function GethargaConversion($id_barang, $itemhargaUnit, $unit_id)
    {
      $query = $this->db->get_where('unit_conversion',array('id_barang' => $id_barang, 'unit_from' =>$itemhargaUnit , 'unit_to' => $unit_id));
      $r = '';
      foreach ($query->result_array() as $row) {
            $r = $row['factor'];
          }

          $GetFactor = array(
            'factor' =>$r
          );
          
          return $GetFactor;
    }

    function GethargaConversionBack($id_barang, $itemhargaUnit, $unit_id)
    {

      $queryBack = $this->db->get_where('unit_conversion',array('id_barang' => $id_barang, 'unit_to' =>$itemhargaUnit , 'unit_from' => $unit_id));
      $r ='';
      foreach ($queryBack->result_array() as $rowBack) {
        $r = $rowBack['factor'];
      }

      $invUnitBack = array(
        'factor' =>$r
      );
      
      return $invUnitBack;
    }
}
