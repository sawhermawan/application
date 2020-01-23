<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_shipping extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function getShippingHeader()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->select('header_pemakaian.description as descShip');
      $this->db->select('header_pemakaian.id_user as id_userShipping');
      $this->db->select('header_pemakaian.description as desc_shiiping');
      $this->db->select('header_pemakaian.status as status_shipping');
      $this->db->select('header_pemakaian.unit_id as unitId_shipping');
      $this->db->select('header_pemakaian.id as id_pakai');
      $this->db->from('header_pemakaian');
      $this->db->join('m_lokasi','m_lokasi.id_lokasi = header_pemakaian.location_from','LEFT');
      $this->db->join('dt_user','dt_user.id_user = header_pemakaian.id_user','LEFT');
      $this->db->where('header_pemakaian.id_comp =',$comp);
      $this->db->order_by('header_pemakaian.id','asc');

      $query = $this->db->get();
      return $query->result();
    }

    public function getShippingHeaderOpen()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->select('header_pemakaian.description as descShip');
      $this->db->select('header_pemakaian.id_user as id_userShipping');
      $this->db->select('header_pemakaian.description as desc_shiiping');
      $this->db->select('header_pemakaian.status as status_shipping');
      $this->db->select('header_pemakaian.unit_id as unitId_shipping');
      $this->db->select('header_pemakaian.id as id_pakai');
      $this->db->from('header_pemakaian');
      $this->db->join('m_lokasi','m_lokasi.id_lokasi = header_pemakaian.location_from','LEFT');
      $this->db->join('dt_user','dt_user.id_user = header_pemakaian.id_user','LEFT');
      $this->db->where('header_pemakaian.id_comp =',$comp);
      $this->db->where('header_pemakaian.status','Open');
      $this->db->order_by('header_pemakaian.id','asc');

      $query = $this->db->get();
      return $query->result();
    }

     public function CountItem($itemId, $pemakaian_id)
    {

      $this->db->select('*');
      $this->db->from('detail_pemakaian');
      $this->db->where('id_barang',$itemId);
      $this->db->where('pemakaian_id',$pemakaian_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetSingleShippingHeader($id)
    {

      $this->db->select('*');
      $this->db->select('header_pemakaian.description as desc_shiiping');
      $this->db->select('header_pemakaian.id_user as id_userShipping');
      $this->db->select('header_pemakaian.status as status_shipping');
      $this->db->select('header_pemakaian.unit_id as unitId_shipping');
      $this->db->select('header_pemakaian.id as id_pakai');
      $this->db->from('header_pemakaian');
      $this->db->join('m_lokasi','m_lokasi.id_lokasi = header_pemakaian.location_from','LEFT');
      $this->db->join('dt_user','dt_user.id_user = header_pemakaian.id_user','LEFT');
      $this->db->join('dt_unit','dt_unit.id_unit = header_pemakaian.unit_id','LEFT');
      $this->db->where('header_pemakaian.pemakaian_id =',$id);
      $this->db->order_by('header_pemakaian.id','desc');

      $query = $this->db->get();
      return $query->result();
    }

    public function editUser($where, $data)
    {
      $this->db->update('header_pemakaian',$data,$where);
      return TRUE;
    }

     public function getCountShippingDetail($date_shipping)
    {
      $date = date('m.y', strtotime($date_shipping));

      $this->db->select('*');
      $this->db->from('detail_pemakaian');
      $this->db->like('id_pakai',$date);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }
    
    public function get_count_shi()
    {
      $waktu = $this->input->post('pemakaian_date');
      $date = date('m.y', strtotime($waktu));

      $this->db->select('*');
      $this->db->from('header_pemakaian');
      $this->db->like('pemakaian_id',$date);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function update($where, $data)
    {
        $this->db->update('detail_pemakaian', $data, $where);
        return TRUE;
    }

    public function GetItemCategoryMasterTable()
    {
      $id_barang=$this->input->post("itemId");

      $query="SELECT * FROM tabel_barang LEFT JOIN kategori_barang ON kategori_barang.id_kategori = tabel_barang.id_kategori WHERE tabel_barang.id_barang = '$id_barang' && tabel_barang.delete_status = '0'";
      $item_info = $this->db->query($query);
      return $item_info;
    }

    public function GetInventCategoryWhere($id_kategori,$group_barang)
    {

        $this->db->select('*');
        $this->db->from('kategori_barang');
        $this->db->where('id_group_barang =',$group_barang);
        $this->db->where('id_kategori !=',$id_kategori);
        $this->db->where('delete_status =','0');
        $query = $this->db->get();
        return $query->result();
    }

    public function GetItemMasterTable()
    {
      $id_barang=$this->input->post("itemId");

      $query="SELECT * FROM tabel_barang WHERE id_barang = '$id_barang' && delete_status = '0'";
      $item_info = $this->db->query($query);
      return $item_info;
    }

    public function GetInventUnitWhere($unit)
    {

        $this->db->select('*');
        $this->db->from('invent_unit');
        $this->db->where('unit !=',$unit);
        $this->db->where('delete_status =','0');
        $query = $this->db->get();
        return $query->result();
    }

    public function tambah($data)
    {
      $this->db->insert('header_pemakaian',$data);
      return TRUE;
    }

    public function tambahTrans($data)
      {
        $this->db->insert('history',$data);
        return TRUE;
      }

    public function tambahDetail($data)
      {
        $this->db->insert('detail_pemakaian',$data);
        return TRUE;
      }

    public function GetShippingSingle($id)
    {

      $this->db->select('*');
      $this->db->from('detail_pemakaian');
      $this->db->join('tabel_barang','tabel_barang.id_barang = detail_pemakaian.id_barang','LEFT');
      $this->db->where('pemakaian_id',$id);
      $this->db->order_by('id_pakai','DESC');
      $query = $this->db->get();

      return $query;
    }

    public function GetShippingDate()
    {
      $pemakaian_id = $this->input->post('pemakaian_id');

      $this->db->select('pemakaian_date');
      $this->db->from('header_pemakaian');
      $this->db->where('pemakaian_id',$pemakaian_id);
      $query = $this->db->get();

      foreach ($query->result_array() as $row) {
        echo $row['pemakaian_date'];
      }

      $shipping = array(
        'pemakaian_date' =>$row['pemakaian_date']
      );
      
      return $shipping;
      }

      public function get_qty_inv_sum($id_lokasi,$id_barang)
      {

          $this->db->select('qty');
          $this->db->from('stock_barang');
          $this->db->where('id_barang',$id_barang);
          $this->db->where('id_lokasi',$id_lokasi);
          $query = $this->db->get();

          foreach ($query->result_array() as $row) {
            echo $row['qty'];
          }

          $qty_sum = array(
            'qty' =>$row['qty']
          );
          
          return $qty_sum;
      }

      public function get_qty_inv_sum_count($cid_lokasi,$cid_barang)
      {

          $this->db->select('qty');
          $this->db->from('stock_barang');
          $this->db->where('id_barang',$cid_barang);
          $this->db->where('id_lokasi',$cid_lokasi);
          $query = $this->db->get();

          foreach ($query->result_array() as $row) {
            echo $row['qty'];
          }

          $qty_sum = array(
            'qty' =>$row['qty']
          );
          
          return $qty_sum;
      }

    public function GetCountShipping($cpemakaian_id)
    {

      // $this->db->select('*');
      // $this->db->from('history');
      // $this->db->join('detail_pemakaian','detail_pemakaian.inv_history_id = history.inv_history_id','LEFT');
      // $this->db->join('header_pemakaian','header_pemakaian.pemakaian_id = detail_pemakaian.pemakaian_id','LEFT');
      // $this->db->where('detail_pemakaian.pemakaian_id', $pemakaian_id);
      // $query = $this->db->get();
      // $count = $query->num_rows();

      // return $count;

      $this->db->select('*');
      $this->db->from('detail_pemakaian');
      $this->db->join('header_pemakaian','header_pemakaian.pemakaian_id = detail_pemakaian.pemakaian_id','LEFT');
      $this->db->where('detail_pemakaian.pemakaian_id', $cpemakaian_id);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetShippingOpen()
    {

      $this->db->select('*');
      $this->db->from('header_pemakaian');
      $this->db->like('status','Open');
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }
}
