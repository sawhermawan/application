<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_item_inv extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_group_barang');
		$this->load->model('M_invent_unit');
		$this->load->model('M_invent_item');
		$this->load->model('M_daftar_harga');
		$this->load->model('M_history');
		$this->load->model('M_category');
	}


	public function index()
	{
		$data['m_category'] 	= $this->M_category->GetAllCategory();
		$data['m_invent_item']	= $this->M_invent_item->get_invent_item_query();
		$data['m_invent_unit']	= $this->M_invent_unit->get_invent_unit_query();
		$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
		$this->template->load('logistic/Static_inv','logistic/Inventory_item_inv',$data);
	}

	public function tambah()
	{
		$comp = $this->session->userdata('comp');
		$group_barang = $this->input->post('itemGroup');
		$categoryId = $this->input->post('id_kategori');
		$countItemGroup = $this->M_invent_item->GetCountItemGroupCategory() + 1;
		$str = sprintf("%04s", $countItemGroup);
		$itemId = $group_barang.".".$categoryId.".".$str;


	    $data = array(
	    	'id_barang'		=> $itemId,
	        'nama_barang'		=> strtoupper($this->input->post('nama_barang')),
	        'pembelian_unit'	=> $this->input->post('pembelian_unit'),
	        'pemakaian_unit'		=> $this->input->post('pemakaian_unit'),
	        'inventoryUnit'	=> $this->input->post('inventoryUnit'),
	        'group_barang'	=> $group_barang,
	        'id_kategori'	=> $categoryId,
	        'id_comp'       => 'TCP'
	    );

	    if ($this->M_invent_item->GetCountItemAddValidasi() > 0) {
			
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Item ID Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Inventory_item_inv');
		}else{

			$this->M_invent_item->tambah($data);
		    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		    redirect('Inventory_item_inv');
		}
	}

	public function update()
	{
	    $data = array(
	    	'id_barang'		=> strtoupper($this->input->post('id_barang')),
	        'nama_barang'		=> strtoupper($this->input->post('nama_barang')),
	        'pembelian_unit'	=> $this->input->post('pembelian_unit'),
	        'pemakaian_unit'		=> $this->input->post('pemakaian_unit'),
	        'InventoryUnit'	=> $this->input->post('inventoryUnit'),
	        'group_barang'	=> $this->input->post('group_barang'),
	        'id_kategori'	=> $this->input->post('id_kategori'),
	        'id_comp'       => 'TCP'
	    );

	    $id_tabel_barang = $this->input->post('id_vnt');
	    $GetItemId = $this->M_invent_item->GetSingleItemTable($id_tabel_barang);
	    foreach ($GetItemId as $itemTable) {
	    	$itemId = $itemTable->id_barang;
	    }

	    if ($itemId == $data['id_barang']) {
	    	$this->M_invent_item->update_item(array('id_tabel_barang' => $this->input->post('id_vnt')), $data);
	    	$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

	    }elseif ($this->M_invent_item->GetCountItemValidasiEdit($itemId) > 0){

	    	$this->session->set_flashdata('notif','<div class="alert alert-Waring" role="alert"> Cannot Edit, Item Id Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    }else{

	    	$this->M_invent_item->update_item(array('id_tabel_barang' => $this->input->post('id_vnt')), $data);
	    	$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    }
	    redirect('Inventory_item_inv');
	}

	public function updateDisable()
	{
		$data = array(
			'id_kategori'	=> $this->input->post('id_kategori')
		);

		$this->M_invent_item->update_item(array('id_tabel_barang' => $this->input->post('id_vnt')), $data);
	    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

	    redirect('Inventory_item_inv');
	}

	public function delete()
	{
		$itemId = $this->input->post('id_item');

		$countTransItem = $this->M_invent_item->GetCountItemValidasiEdit($itemId);
		$countInvItem = $this->M_daftar_harga->GetDeleteInvetItem();

		if ($countTransItem > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Invent Item Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Inventory_item_inv');
		}elseif ($countInvItem > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Invent Item Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Inventory_item_inv');
		}else{

			$data = array(
				'delete_status'		=> '1'
			);

			$this->M_invent_item->update_item(array('id_tabel_barang' => $this->input->post('id_inv')), $data);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Inventory_item_inv');
		}

	}

	function getCategory()
	{
	    $query = $this->M_invent_item->GetCategoryWhere();
	    
	    echo '<option value="">Select Category </option>';
	        foreach($query->result() as $row)
	        { 
	         echo "<option value='".$row->id_kategori."'>".$row->nama_kategori."</option>";
	        }
	}

	function getCategoryDetail()
	{
	    $query = $this->M_invent_item->GetCategoryWhereDetail();
	    
	    echo '<option value="">Select Category </option>';
	        foreach($query->result() as $row)
	        { 
	         echo "<option value='".$row->id_kategori."'>".$row->nama_kategori."</option>";
	        }
	}
}
