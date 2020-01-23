<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('m_lokasi');
		$this->load->model('M_shipping');
		$this->load->model('M_invent_item');
		$this->load->model('M_inventory_header');
		$this->load->model('M_history');
		$this->load->model('M_tabel_barang');
		$this->load->model('M_stock_barang');
		$this->load->model('M_inventory_detail');
		$this->load->model('M_group_barang');
		$this->load->model('M_employee');
		$this->load->model('M_invent_unit');
		$this->load->model('M_unit_conversion');
		$this->load->model('M_unit');
		$this->load->model('M_category');
		$this->load->model('M_daftar_harga');
	}


	public function index()
	{
		$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
		$data['m_lokasi'] 	= $this->m_lokasi->get_location_query();
		$data['m_shipping'] 	= $this->M_shipping->getShippingHeader();
		$data['m_employee']		= $this->M_employee->get_employee_query();
		$data['m_unit']			= $this->M_unit->get_unit_query();
		$this->template->load('admin/Static','admin/Shipping', $data);
	}

	public function GetItemMaster()
	{
		$id_barang = $this->input->post('itemId');

	    $query = $this->M_shipping->GetItemMasterTable();

	    foreach($query->result() as $row)
        { 
        	$unit = $row->pemakaian_unit;
        }

        $invent_unit = $this->M_shipping->GetInventUnitWhere($unit);

        echo "<option value='".$unit."'>".$unit."</option>";

        foreach ($invent_unit as $invUnit) {
        echo "<option value='".$invUnit->unit."'>".$invUnit->unit."</option>";
        }
	    
	}

	public function GetItemCategoryMaster()
	{
		$id_barang = $this->input->post('itemId');

	    $query = $this->M_shipping->GetItemCategoryMasterTable();

	    foreach($query->result() as $row)
        { 
        	$id_kategori = $row->id_kategori;
        	$nama_kategori = $row->nama_kategori;
        	$group_barang = $row->group_barang;
        }

        $invent_category = $this->M_shipping->GetInventCategoryWhere($id_kategori,$group_barang);

        echo "<option value='".$id_kategori."'>".$nama_kategori."</option>";

        foreach ($invent_category as $invCategory) {
        echo "<option value='".$invCategory->id_kategori."'>".$invCategory->nama_kategori."</option>";
        }
	    
	}

	public function GetCategoryItem()
	{

	    $query = $this->M_invent_item->GetCategoryItemAll();

        echo '<option value="">Select Item</option>';

        foreach ($query as $category) {
        echo "<option value='".$category->id_barang."'>".$category->nama_barang."</option>";
        }
	    
	}

	public function tambah()
	{

		$pemakaian_date = $this->input->post('pemakaian_date');
		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();

		if ($pemakaian_date <= $lock_date_inv['date_lock_inv']) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Shipping');
		}else{

			$group  = $this->input->post('group_barang');
			$comp = $this->session->userdata('comp');
					$pemakaian_date = $this->input->post('pemakaian_date');

					$id_loc = $this->input->post('location');

					$date = date('m.y', strtotime($pemakaian_date));

					$location_name = $this->m_lokasi->getCodeLocation($id_loc);
					$count_id = $this->M_shipping->get_count_shi() + 1;
					$count = sprintf("%05s", $count_id);

					$pemakaian_id = "USE.".$location_name['codeLocation'].".".$date.".".$count;

					$data = array(
				        'pemakaian_id'	=> $pemakaian_id,
				        'pemakaian_date'	=> $this->input->post('pemakaian_date'),
				        'location_from'	=> $this->input->post('location'),
				        'id_user'		=> $this->input->post('employee'),
				        'unit_id'		=> $this->input->post('id_unit'),
				        // 'description'	=> $this->input->post('desc'),
				        'group_barang'	=> $group,
				        'shipping_type'	=> $this->input->post('shipping_type'),
				        'status'		=> 'Open',
				        'id_comp'		=> $comp,
				        'created'		=> $this->session->userdata('id_loginakses'),
				        'created_date'	=> date('Y-m-d H:i:s'),
				        'modified'		=> $this->session->userdata('id_loginakses'),
				        'modified_date'	=> date('Y-m-d H:i:s')
				    );

			// switch ($group) {
			// 	case 'SPR':

			// 		$comp = $this->session->userdata('comp');
			// 		$pemakaian_date = $this->input->post('pemakaian_date');

			// 		$id_loc = $this->input->post('location');

			// 		$date = date('m.y', strtotime($pemakaian_date));

			// 		$location_name = $this->m_lokasi->getCodeLocation($id_loc);
			// 		$count_id = $this->M_shipping->get_count_shi() + 1;
			// 		$count = sprintf("%05s", $count_id);

			// 		$pemakaian_id = "USE.".$location_name['codeLocation'].".".$date.".".$count;

			// 		$data = array(
			// 	        'pemakaian_id'	=> $pemakaian_id,
			// 	        'pemakaian_date'	=> $this->input->post('pemakaian_date'),
			// 	        'location_from'	=> $this->input->post('location'),
			// 	        'id_user'		=> $this->input->post('employee'),
			// 	        'unit_id'		=> $this->input->post('id_unit'),
			// 	        'description'	=> $this->input->post('desc'),
			// 	        'group_barang'	=> $group,
			// 	        'shipping_type'	=> $this->input->post('shipping_type'),
			// 	        'status'		=> 'Open',
			// 	        'id_comp'		=> $comp,
			// 	        'created'		=> $this->session->userdata('id'),
			// 	        'created_date'	=> date('Y-m-d H:i:s'),
			// 	        'modified'		=> $this->session->userdata('id'),
			// 	        'modified_date'	=> date('Y-m-d H:i:s')
			// 	    );
			// 		break;
					
			// 	case 'STO':

			// 		$comp = $this->session->userdata('comp');
			// 		$pemakaian_date = $this->input->post('pemakaian_date');

			// 		$id_loc = $this->input->post('location');

			// 		$date = date('m.y', strtotime($pemakaian_date));

			// 		$location_name = $this->m_lokasi->getCodeLocation($id_loc);
			// 		$count_id = $this->M_shipping->get_count_shi() + 1;
			// 		$count = sprintf("%05s", $count_id);

			// 		$pemakaian_id = "USE.".$location_name['codeLocation'].".".$date.".".$count;

			// 		$data = array(
			// 	        'pemakaian_id'	=> $pemakaian_id,
			// 	        'pemakaian_date'	=> $this->input->post('pemakaian_date'),
			// 	        'location_from'	=> $this->input->post('location'),
			// 	        'id_user'		=> $this->input->post('employee'),
			// 	        'unit_id'		=> $this->input->post('id_unit'),
			// 	        'description'	=> $this->input->post('desc'),
			// 	        'group_barang'	=> $group,
			// 	        'shipping_type'	=> $this->input->post('shipping_type'),
			// 	        'status'		=> 'Open',
			// 	        'id_comp'		=> $comp,
			// 	        'created'		=> $this->session->userdata('id'),
			// 	        'created_date'	=> date('Y-m-d H:i:s'),
			// 	        'modified'		=> $this->session->userdata('id'),
			// 	        'modified_date'	=> date('Y-m-d H:i:s')
			// 	    );
			// 		break;
			// }

			$this->M_shipping->tambah($data);
	    	redirect('Shipping/edit/'.$pemakaian_id);

		}

	}
	public function editUsed()
	{
		$data = array(
			'pemakaian_date'		=> $this->input->post('pemakaian_date'),
			'shipping_type'		=> $this->input->post('shipping_type'),
			'location_from'		=> $this->input->post('location'),
			'id_user'			=> $this->input->post('employee'),
			'unit_id'			=> $this->input->post('id_unit'),
			'description'		=> $this->input->post('desc'),
	        'modified'			=> $this->session->userdata('id'),
	        'modified_date'		=> date('Y-m-d H:i:s')
		);

		$this->M_shipping->editUser(array('id' => $this->input->post('id_pakaiping')),$data);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Shipping');
	}

	public function cetak()
	{
		$id = $this->uri->segment(3);

		$data['m_shipping'] = $this->M_shipping->GetSingleShippingHeader($id);
		$data['shipping'] = $this->M_shipping->GetShippingSingle($id)->result();
		// $this->template->load('admin/static','admin/print_shipping',$data);
		$this->load->view('admin/Print_shipping',$data);

	}

	public function edit()
	{
		$id = $this->uri->segment(3);

		$item_gorup = $this->M_inventory_header->GetStatusShipping($id)->result();
		foreach ($item_gorup as $ship) {
			$item = $ship->group_barang;
		}

		$data['m_category']	= $this->M_category->GetAllCategoryWhere($item);
		$data['m_invent_unit']	= $this->M_invent_unit->get_invent_unit_query();
		$data['m_invent_item'] = $this->M_invent_item->GetInventTableWhere($item);
		$data['m_inventory_detail'] = $this->M_inventory_detail->GetCountDetailShip($id);
		$data['m_inventory_header'] = $this->M_inventory_header->GetStatusShipping($id)->result();
		$data['m_shipping'] = $this->M_shipping->GetShippingSingle($id)->result();
		$this->template->load('admin/Static','admin/Detail_shipping',$data);
	}

	public function tambahDetail()
	{
		$pemakaian_id 	= $this->input->post('pemakaian_id');
		$id_barang		= $this->input->post('id_barang');
		$id_location	= $this->input->post('location_id');
		$qty			= $this->input->post('qty');
		$unit_id		= $this->input->post('unitId');
		$comp 			= $this->session->userdata('comp');
		$type_used 		= $this->input->post('type_used');



		$itemId = $id_barang;

		$GetInventoryUnitMaster = $this->M_tabel_barang->GetUnitMasterTable($id_barang);
		$MasterInventoryUnit = $GetInventoryUnitMaster['inventoryUnit'];

		// var_dump($MasterInventoryUnit);
		// die;
		
		$unitFrom = $unit_id;
		$unitTo = $MasterInventoryUnit;

		$GetUnitConversion = $this->M_unit_conversion->GetUnitConversion($itemId, $unitFrom, $unitTo);
		$GetUnitConversionBack = $this->M_unit_conversion->GetUnitConversionBack($itemId, $unitFrom, $unitTo);

		$GetConversion = $this->M_unit_conversion->GetConversion($itemId, $unitFrom, $unitTo);
		$GetFactor = $GetConversion['factor'];

		$GetConversionBack = $this->M_unit_conversion->GetConversionBack($itemId, $unitFrom, $unitTo);
		$GetFactorBack = $GetConversionBack['factor'];

		$countFactor = $qty*$GetFactor;
		$countFactorBack = $qty*$GetFactorBack;

		$CountItem = $this->M_shipping->CountItem($itemId, $pemakaian_id);

		$countInvStock = $this->M_stock_barang->get_count_inv_sum($id_location,$id_barang);

		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();

		$pemakaian_date = $this->M_shipping->GetShippingDate();
		$date_shipping = $pemakaian_date['pemakaian_date'];

		$date = date('m.y', strtotime($date_shipping));
		$count_id = $this->M_shipping->getCountShippingDetail($date_shipping) + 1;
		$count = sprintf("%05s", $count_id);

		$id_pakai= "USE.".$date.".".$count;

		$qty_sum = $this->M_stock_barang->get_qty_inv_sum($id_location,$id_barang);
		$inv_qty_sum = $qty_sum['qty'];

		if ($date_shipping <= $lock_date_inv['date_lock_inv']) {
			$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('Shipping/edit/'.$pemakaian_id);
		}else{

			if ($CountItem > 0) {
				$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Cannot Input The Same Item  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
			}else {

				if ($type_used == 'Used') {
					if ($unit_id == $MasterInventoryUnit) {
						if (empty($countInvStock)){

							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));

						}elseif($inv_qty_sum < $qty){

							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Not Enough Item to be Used <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else{

							$data = array(
								'id_pakai'		=> $id_pakai,
						        'pemakaian_id'	=> $this->input->post('pemakaian_id'),
								'id_barang'		=> $this->input->post('id_barang'),
								'unit'			=> $this->input->post('unitId'),
								'qty'			=> $this->input->post('qty'),
								// 'description'	=> $this->input->post('desc'),
								'status'		=> 'Open',
								'pemakaian_date'	=> $date_shipping,
								'id_comp'		=> $comp,
								'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $this->M_shipping->tambahDetail($data);
						    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						    redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}
					}else if ($GetUnitConversion > 0) {
						if (empty($countInvStock)){

							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));

						}elseif($inv_qty_sum < $countFactor){

							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Not Enough Item to be Used <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else{

							$data = array(
								'id_pakai'		=> $id_pakai,
						        'pemakaian_id'	=> $this->input->post('pemakaian_id'),
								'id_barang'		=> $this->input->post('id_barang'),
								'unit'			=> $this->input->post('unitId'),
								'qty'			=> $this->input->post('qty'),
								// 'description'	=> $this->input->post('desc'),
								'status'		=> 'Open',
								'pemakaian_date'	=> $date_shipping,
								'id_comp'		=> $comp,
								'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $this->M_shipping->tambahDetail($data);
						    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						    redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}
					}else if ($GetUnitConversionBack > 0) {
						if (empty($countInvStock)){

							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));

						}elseif($inv_qty_sum < $countFactorBack){

							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Not Enough Item to be Used <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else{

							$data = array(
								'id_pakai'		=> $id_pakai,
						        'pemakaian_id'	=> $this->input->post('pemakaian_id'),
								'id_barang'		=> $this->input->post('id_barang'),
								'unit'			=> $this->input->post('unitId'),
								'qty'			=> $this->input->post('qty'),
								// 'description'	=> $this->input->post('desc'),
								'status'		=> 'Open',
								'pemakaian_date'	=> $date_shipping,
								'id_comp'		=> $comp,
								'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $this->M_shipping->tambahDetail($data);
						    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						    redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}
					}else{
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
					}
				}else if ($type_used == 'Return') {
					$data = array(
						'id_pakai'		=> $id_pakai,
				        'pemakaian_id'	=> $this->input->post('pemakaian_id'),
						'id_barang'		=> $this->input->post('id_barang'),
						'unit'			=> $this->input->post('unitId'),
						'qty'			=> $this->input->post('qty'),
						// 'description'	=> $this->input->post('desc'),
						'status'		=> 'Open',
						'pemakaian_date'	=> $date_shipping,
						'id_comp'		=> $comp,
						'created'		=> $this->session->userdata('id_loginakses'),
				        'created_date'	=> date('Y-m-d H:i:s'),
				        'modified'		=> $this->session->userdata('id_loginakses'),
				        'modified_date'	=> date('Y-m-d H:i:s')
				    );

				    $this->M_shipping->tambahDetail($data);
				    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				    redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
		}

					
			}
		}
	}

	public function editInvTrans()
	{
		$inv_id = $this->M_tabel_barang->GetItemId();
		$inv_table_id = $inv_id['unit_barang'];

		$data = array(
	        'id_barang'		=> $this->input->post('id_barang'),
	        'qty'			=> $this->input->post('qty'),
	        // 'description'	=> $this->input->post('desc'),
	        'unit'			=> $this->input->post('unit_id'),
	        'modified'		=> $this->session->userdata('id_loginakses'),
	        'modified_date'	=> date('Y-m-d H:i:s')
	    );

	    $this->M_shipping->update(array('id_pakai' => $this->input->post('id_pakai')), $data);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Update Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
	}

	public function post()
	{
		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();

		$inv_trans = $this->M_history->GetInvShipping();
 	
 	 $posting = array();
		foreach ($inv_trans as $key => $trans) {

			$id_barang = $trans->id_barang;
			$id_lokasi = $trans->location_from;
			$qty = $trans->qty;
			$unit_id = $trans->unit;
			$id_pakai = $trans->id_pakai;
			$id_comp = $trans->comp_ship;
			$pemakaian_id = $trans->ship_id;
			$status = $trans->stat_detail;
			$pemakaian_date = $trans->date_shipping;
			$shipping_type = $trans->shipping_type;

			$itemId = $id_barang;

			$GetInventoryUnitMaster = $this->M_tabel_barang->GetUnitMasterTable($itemId);
			$MasterInventoryUnit = $GetInventoryUnitMaster['inventoryUnit'];

			$CountItemharga = $this->M_daftar_harga->GetCountInventharga($id_barang, $id_comp);
			$GetItemharga = $this->M_daftar_harga->GethargaItem($id_barang, $id_comp);
			$itemhargaUnit = $GetItemharga['unit_id'];
			$itemharga = $GetItemharga['harga'];

			$GethargaUnitConversion = $this->M_unit_conversion->GethargaUnitConversion($id_barang, $itemhargaUnit, $unit_id);
			$GethargaUnitConversionBack = $this->M_unit_conversion->GethargaUnitConversionBack($id_barang, $itemhargaUnit, $unit_id);

			$GethargaConversion = $this->M_unit_conversion->GethargaConversion($id_barang, $itemhargaUnit, $unit_id);
			$GetFactorharga = $GethargaConversion['factor'];

			$GethargaConversionBack = $this->M_unit_conversion->GethargaConversionBack($id_barang, $itemhargaUnit, $unit_id);
			$GetFactorhargaBack = $GethargaConversionBack['factor'];

			$unitFrom = $unit_id;
			$unitTo = $MasterInventoryUnit;

			$GetUnitConversion = $this->M_unit_conversion->GetUnitConversion($itemId, $unitFrom, $unitTo);
			$GetUnitConversionBack = $this->M_unit_conversion->GetUnitConversionBack($itemId, $unitFrom, $unitTo);

			$GetConversion = $this->M_unit_conversion->GetConversion($itemId, $unitFrom, $unitTo);
			$GetFactor = $GetConversion['factor'];

			$GetConversionBack = $this->M_unit_conversion->GetConversionBack($itemId, $unitFrom, $unitTo);
			$GetFactorBack = $GetConversionBack['factor'];

			$countFactor = $qty*$GetFactor;
			$countFactorBack = $qty*$GetFactorBack;

			$countInvStock = $this->M_stock_barang->get_count_inv_sum($id_lokasi,$id_barang);

			$qty_sum = $this->M_shipping->get_qty_inv_sum($id_lokasi,$id_barang);
			$inv_qty_sum = $qty_sum['qty'];

			if ($pemakaian_date <= $lock_date_inv['date_lock_inv']) {

				$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('Shipping/edit/'.$pemakaian_id);

			}else {

				if ($CountItemharga > 0) {

					if ($unit_id == $itemhargaUnit) {
						$hargaItem = $itemharga * $qty;
					}else if ($GethargaUnitConversion > 0) {
						$hargaItem = $itemharga / $GetFactorharga * $qty;
					}else if ($GethargaUnitConversionBack > 0) {
						$hargaItem = $itemharga / $GetFactorhargaBack * $qty;
					}
				}else {

					$hargaItem = $itemharga;
				}

				if ($shipping_type == 'Used') {
					
					if ($unit_id == $MasterInventoryUnit) {
					
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else if ($inv_qty_sum < $qty) {
							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Not Enough Item to be Used <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else {
							$data = array(
						        'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $pemakaian_date,
						    	'inv_status'	=> 'Used',
						    	'qty'			=> $qty,
						    	'status'		=> 'Used',
						    	'histo_id'		=> $id_pakai,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pemakaian_id,
						    	'unit_id'		=> $unit_id,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $dataInvSum = array(
						        'qty'			=> $inv_qty_sum-$qty
						    );
						    $posting[] = [
						    	'data'=>$data,
						    	'dataTrans' => $dataTrans,
						    	'dataInvSum' => $dataInvSum,
						    	'id_lokasi' => $id_lokasi,
						    	'id_barang' => $id_barang,
						    	'id_pakai' =>$id_pakai	

						    ];
						}
					}else if ($GetUnitConversion > 0) {
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else if ($inv_qty_sum < $countFactor) {
							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Not Enough Item to be Used <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else {
							$data = array(
						        'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $pemakaian_date,
						    	'inv_status'	=> 'Used',
						    	'qty'			=> $countFactor,
						    	'status'		=> 'Used',
						    	'histo_id'		=> $id_pakai,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pemakaian_id,
						    	'unit_id'		=> $MasterInventoryUnit,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $dataInvSum = array(
						        'qty'			=> $inv_qty_sum-$countFactor
						    );

						    $posting[] = [
						    	'data'=>$data,
						    	'dataTrans' => $dataTrans,
						    	'dataInvSum' => $dataInvSum,
						    	'id_lokasi' => $id_lokasi,
						    	'id_barang' => $id_barang,
						    	'id_pakai' =>$id_pakai	

						    ];
						}
					}else if ($GetUnitConversionBack > 0) {
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else if ($inv_qty_sum < $countFactorBack) {
							$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Used Failed, Not Enough Item to be Used <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

							redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
						}else {
							$data = array(
						        'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $pemakaian_date,
						    	'inv_status'	=> 'Used',
						    	'qty'			=> $countFactorBack,
						    	'status'		=> 'Used',
						    	'histo_id'		=> $id_pakai,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pemakaian_id,
						    	'unit_id'		=> $MasterInventoryUnit,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $dataInvSum = array(
						        'qty'			=> $inv_qty_sum-$countFactorBack
						    );

						    $posting[] = [
						    	'data'=>$data,
						    	'dataTrans' => $dataTrans,
						    	'dataInvSum' => $dataInvSum,
						    	'id_lokasi' => $id_lokasi,
						    	'id_barang' => $id_barang,
						    	'id_pakai' =>$id_pakai	

						    ];
						}
					}else {
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
					}

				}else {

					if ($unit_id == $MasterInventoryUnit) {
					
							$data = array(
						        'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $pemakaian_date,
						    	'inv_status'	=> 'Used',
						    	'qty'			=> $qty,
						    	'status'		=> 'Return',
						    	'histo_id'		=> $id_pakai,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pemakaian_id,
						    	'unit_id'		=> $unit_id,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $dataInvSum = array(
						        'qty'			=> $inv_qty_sum+$qty
						    );
						    $posting[] = [
						    	'data'=>$data,
						    	'dataTrans' => $dataTrans,
						    	'dataInvSum' => $dataInvSum,
						    	'id_lokasi' => $id_lokasi,
						    	'id_barang' => $id_barang,
						    	'id_pakai' =>$id_pakai	

						    ];
						
					}else if ($GetUnitConversion > 0) {

							$data = array(
						        'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $pemakaian_date,
						    	'inv_status'	=> 'Used',
						    	'qty'			=> $countFactor,
						    	'status'		=> 'Return',
						    	'histo_id'		=> $id_pakai,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pemakaian_id,
						    	'unit_id'		=> $MasterInventoryUnit,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $dataInvSum = array(
						        'qty'			=> $inv_qty_sum+$countFactor
						    );

						    $posting[] = [
						    	'data'=>$data,
						    	'dataTrans' => $dataTrans,
						    	'dataInvSum' => $dataInvSum,
						    	'id_lokasi' => $id_lokasi,
						    	'id_barang' => $id_barang,
						    	'id_pakai' =>$id_pakai	

						    ];
						
					}else if ($GetUnitConversionBack > 0) {

							$data = array(
						        'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $pemakaian_date,
						    	'inv_status'	=> 'Used',
						    	'qty'			=> $countFactorBack,
						    	'status'		=> 'Return',
						    	'histo_id'		=> $id_pakai,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pemakaian_id,
						    	'unit_id'		=> $MasterInventoryUnit,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );

						    $dataInvSum = array(
						        'qty'			=> $inv_qty_sum+$countFactorBack
						    );

						    $posting[] = [
						    	'data'=>$data,
						    	'dataTrans' => $dataTrans,
						    	'dataInvSum' => $dataInvSum,
						    	'id_lokasi' => $id_lokasi,
						    	'id_barang' => $id_barang,
						    	'id_pakai' =>$id_pakai	

						    ];
						
					}else {
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
					}
				}
			}			

		}

		// echo "<pre>";
		// 	var_dump($posting);
		// 	die;

		foreach ($posting as $key => $value) {
			// echo "<pre>";
			// var_dump($value);
			// die;

			$this->M_history->updateShipping($value['data'] ,$value['dataTrans'] ,$value['dataInvSum'] ,$value['id_lokasi'] ,$value['id_barang'], $value['id_pakai']);
		}
			
			$dataHeader = array(
			        'status'	=> 'Posted'
			    );
			$this->M_inventory_header->postShipping($dataHeader ,$pemakaian_id);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Posting Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			// error_reporting(0);
			redirect('Shipping');

	}

	public function deleteDetail()
	{
		$id_pakai = $this->input->post('id_pakai');

		$this->M_inventory_header->deleteDetailShip($id_pakai);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('Shipping/edit/'.$this->input->post('pemakaian_id'));
	}

	public function delete()
	{

		// $countShipDetail = $this->M_inventory_header->GetDeleteShippHeader();

		// if ($countShipDetail > 0) {
		// 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Used Id Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	 //    	redirect('Shipping');
		// }else{

			$id_pakaiping = $this->input->post('id_pakaiping');

			$this->M_inventory_header->deleteHeaderShip($id_pakaiping);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Shipping');
		// }

	}

	function getUser()
	{
	    $location = $this->input->post('location');
	    $query = $this->M_inventory_header->get_user_info();
	    
	    echo '<option value="">Select Employee </option>';
	        foreach($query->result() as $row)
	        { 
	         echo "<option value='".$row->id_user."'>".$row->fullname."</option>";
	        }
	}

}

