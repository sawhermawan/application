<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_invent_item extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function GetSingleItemTable($id_tabel_barang)
    {
      $query = $this->db->get_where('tabel_barang',array('id_tabel_barang' => $id_tabel_barang, 'delete_status' => 0));
      return $query->result();
    }

    public function GetCountItemValidasiEdit($itemId)
    {

      $this->db->select('*');
      $this->db->from('detail_pembelian');
      $this->db->where('id_barang',$itemId);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetCountItemGroup()
    {
      $group_barang = $this->input->post('itemGroup');

      $this->db->select('*');
      $this->db->from('tabel_barang');
      $this->db->where('group_barang',$group_barang);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function GetCountItemGroupCategory()
    {
      $group_barang = $this->input->post('itemGroup');
      $categoryId = $this->input->post('id_kategori');

      $this->db->select('*');
      $this->db->from('tabel_barang');
      $this->db->where('group_barang',$group_barang);
      $this->db->where('id_kategori',$categoryId);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }
    
    public function get_invent_item_query()
    {
        $comp = $this->session->userdata('comp');

        $this->db->select('*');
        $this->db->select('tabel_barang.id_kategori as category_item');
        $this->db->select('tabel_barang.id_barang as itemID');
        $this->db->select('detail_pembelian.id_barang as itemIDRec');
        $this->db->from('tabel_barang');
        $this->db->join('kategori_barang','kategori_barang.id_kategori = tabel_barang.id_kategori','LEFT');
        $this->db->join('detail_pembelian','detail_pembelian.id_barang = tabel_barang.id_barang','LEFT');
        $this->db->where('tabel_barang.delete_status =','0');
        $this->db->where('tabel_barang.id_comp =',$comp);
        $this->db->group_by('tabel_barang.id_barang');
        $query = $this->db->get();
        return $query->result();

        // $this->db->select('*');
        // $this->db->select('c.unit as unitReceipt');
        // $this->db->select('d.unit as unitUsed');
        // $this->db->select('e.unit as unitInventory');
        // $this->db->from('tabel_barang');
        // $this->db->join('invent_group_barang b', 'b.group_id = a.group_barang', 'LEFT');
        // $this->db->join('invent_unit c', 'c.id_unit = a.pembelian_unit', 'LEFT');
        // $this->db->join('invent_unit d', 'd.id_unit = a.pemakaian_unit', 'LEFT');
        // $this->db->join('invent_unit e', 'e.id_unit = a.inventoryUnit', 'LEFT');
        // $this->db->where('delete_status =','0');
        // $this->db->where('id_comp =',$comp);
        // $this->db->order_by('id_barang','desc');
        // $query = $this->db->get();
        // return $query->result();
    }

    public function GetCountItemAddValidasi()
    {
      $id_barang      = strtoupper($this->input->post('id_barang'));
      $id_comp      = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->from('tabel_barang');
      $this->db->where('id_barang',$id_barang);
      $this->db->where('delete_status =','0');
      $this->db->where('id_comp',$id_comp);
      $query = $this->db->get();
      $count = $query->num_rows();

      return $count;
    }

    public function update($data)
      {
        $this->db->where('id_barang',$data['id_barang']);
        $this->db->where('id_comp',$data['id_comp']);
        $this->db->set('delete_status',0);
        $this->db->update('tabel_barang');
        return TRUE;
      }

    public function tambah($data)
      {
        $this->db->insert('tabel_barang',$data);
        return TRUE;
      }

    public function update_item($where, $data)
    {
        $this->db->update('tabel_barang', $data, $where);
        return TRUE;
    }

    public function GetInventTable()
    {
        $id_comp  = $this->session->userdata('comp');

        $this->db->select('*');
        $this->db->from('tabel_barang');
        $this->db->where('delete_status =','0');
        $this->db->where('id_comp',$id_comp);
        $query = $this->db->get();

        return $query->result();
    }

    public function GetCategoryItemAll()
    {
      $id_kategori = strtoupper($this->input->post('category'));

      $this->db->select('*');
      $this->db->from('tabel_barang');
      $this->db->where('delete_status =','0');
      $this->db->where('id_kategori',$id_kategori);
      $query = $this->db->get();

      return $query->result();
    }

    public function GetInventTableWhere($item)
    {
        $id_comp      = $this->session->userdata('comp');

        $this->db->select('*');
        $this->db->from('tabel_barang');
        $this->db->where('delete_status =','0');
        $this->db->where('group_barang',$item);
        $this->db->where('id_comp',$id_comp);
        $query = $this->db->get();

        return $query->result();
    }

     public function GetItemUnit()
    {
      $id_barang = $this->input->post('id_barang');

      $this->db->select('unit_barang');
      $this->db->from('tabel_barang');
      $this->db->where('id_barang',$id_barang);
      $query = $this->db->get();

      foreach ($query->result_array() as $row) {
        echo $row['unit_barang'];
      }

      $inv_table = array(
        'unit_barang' =>$row['unit_barang']
      );
      
      return $inv_table;
      }

    public function GetCategoryWhere()
    {
      $group_barang = $this->input->post('itemGroup');
      $query="SELECT id_kategori,nama_kategori FROM kategori_barang WHERE id_group_barang ='$group_barang' AND delete_status = '0' ";
      $category_info = $this->db->query($query);
      return $category_info;
    }

    public function GetCategoryWhereDetail()
    {
      $group_barang = $this->input->post('group_barang');
      $query="SELECT id_kategori,nama_kategori FROM kategori_barang WHERE id_group_barang ='$group_barang' AND delete_status = '0' ";
      $category_info = $this->db->query($query);
      return $category_info;
    }
}
