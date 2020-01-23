<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_inv_user extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('m_lokasi');
		$this->load->model('M_transfer');
		$this->load->model('M_invent_item');
		$this->load->model('M_inventory_header');
		$this->load->model('M_history');
		$this->load->model('M_tabel_barang');
		$this->load->model('M_stock_barang');
		$this->load->model('M_inventory_detail');
		$this->load->model('M_invent_unit');
		$this->load->model('M_unit_conversion');
		$this->load->model('M_group_barang');
		$this->load->model('M_category');
		$this->load->model('M_daftar_harga');
	}


	public function index()
	{
		$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
		$data['m_lokasi'] = $this->m_lokasi->get_location_query();
		$data['m_transfer'] = $this->M_transfer->getTransferHeader();
		$this->template->load('staff/Static_staff','staff/Transfer_inv_user',$data);
	}

	public function tambah()
	{
		$comp = $this->session->userdata('comp');
		$transfer_date = $this->input->post('transfer_date');
		$date = date('m.y', strtotime($transfer_date));

		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();

		$location_name = $this->m_lokasi->get_Code_location();
		$count_id = $this->M_transfer->getCountTransfer() + 1;
		$count = sprintf("%05s", $count_id);

		$transfer_id = "TRF.".$location_name['codeLocation'].".".$date.".".$count;

		if ($transfer_date <= $lock_date_inv['date_lock_inv']) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Transfer_inv_user');
		}else {

			$data = array(
		        'transfer_id'		=> $transfer_id,
		        'transfer_date'		=> $this->input->post('transfer_date'),
		        'location_from'		=> $this->input->post('id_lokasi'),
		        'location_to'		=> $this->input->post('transfer_to'),
		        'location_transit'	=> '11',
		        'group_barang'		=> $this->input->post('group_barang'),
		        'description'		=> $this->input->post('desc'),
		        'status'			=> 'Open',
		        'id_comp'			=> $comp,
		        'created'			=> $this->session->userdata('id'),
		        'created_date'		=> date('Y-m-d H:i:s'),
		        'modified'			=> $this->session->userdata('id'),
		        'modified_date'		=> date('Y-m-d H:i:s')
		    );

		    $this->M_transfer->tambah($data);
		    redirect('Transfer_inv_user/edit/'.$transfer_id);
			}

	}
	
	public function editTransfer()
	{
		$data = array(
			'transfer_date'		=> $this->input->post('transfer_date'),
			'location_from'		=> $this->input->post('id_lokasi'),
			'location_to'		=> $this->input->post('transfer_to'),
			'group_barang'		=> $this->input->post('group_barang'),
			'description'		=> $this->input->post('desc'),
	        'modified'			=> $this->session->userdata('id'),
	        'modified_date'		=> date('Y-m-d H:i:s')
		);

		$this->M_transfer->editTransfer(array('id' => $this->input->post('id_transfer')),$data);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Transfer_inv_user');
	}

	public function cetak()
	{
		$id = $this->uri->segment(3);

		$data['m_transfer'] = $this->M_transfer->getSingleTransferHeader($id);
		$data['transfer'] = $this->M_transfer->GetTransferSingle($id)->result();
		$this->load->view('staff/Print_transfer_inv_user',$data);

	}

	public function edit()
	{
		$id = $this->uri->segment(3);

		$item_gorup = $this->M_inventory_header->GetStatusTransfer($id)->result();
		foreach ($item_gorup as $trans) {
			$item = $trans->group_barang;
		}

		$data['m_category']	= $this->M_category->GetAllCategoryWhere($item);
		$data['m_invent_unit']	= $this->M_invent_unit->get_invent_unit_query();
		$data['m_invent_item'] = $this->M_invent_item->GetInventTable();
		$data['m_inventory_detail'] = $this->M_inventory_detail->GetCountDetailTrans($id);
		$data['m_inventory_header'] = $this->M_inventory_header->GetStatusTransfer($id)->result();
		$data['m_transfer'] = $this->M_transfer->GetTransferSingle($id)->result();
		$this->template->load('staff/Static_staff','staff/Detail_transfer_inv_user',$data);
	}

	public function GetItemMaster()
	{
		$id_barang = $this->input->post('itemId');

	    $query = $this->M_transfer->GetItemMasterTable();

	    foreach($query->result() as $row)
        { 
        	$unit = $row->inventoryUnit;
        }

        $invent_unit = $this->M_transfer->GetInventUnitWhere($unit);

        echo "<option value='".$unit."'>".$unit."</option>";

        foreach ($invent_unit as $invUnit) {
        echo "<option value='".$invUnit->unit."'>".$invUnit->unit."</option>";
        }
	    
	}

	public function GetItemCategoryMaster()
	{
		$id_barang = $this->input->post('itemId');

	    $query = $this->M_transfer->GetItemCategoryMasterTable();

	    foreach($query->result() as $row)
        { 
        	$id_kategori = $row->id_kategori;
        	$nama_kategori = $row->nama_kategori;
        	$group_barang = $row->group_barang;
        }

        $invent_category = $this->M_transfer->GetInventCategoryWhere($id_kategori,$group_barang);

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

	public function tambahDetail()
	{
		$transfer_id 	= $this->input->post('transfer_id');
		$id_barang		= $this->input->post('id_barang');
		$location_id	= $this->input->post('location_id');
		$qty			= $this->input->post('qty');
		$unit_id		= $this->input->post('unitId');
		$comp 			= $this->session->userdata('comp');

		$itemId = $id_barang;

		$GetInventoryUnitMaster = $this->M_tabel_barang->GetUnitMasterTable($itemId);
		$MasterInventoryUnit = $GetInventoryUnitMaster['inventoryUnit'];

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

		$CountItem = $this->M_transfer->CountItem($itemId, $transfer_id);

		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();

		$transfer_date = $this->M_transfer->GetTransferDate();
		$date_transfer = $transfer_date['transfer_date'];

		$date = date('m.y', strtotime($date_transfer));
		$count_id = $this->M_transfer->getCountTransferDetail($date_transfer) + 1;
		$count = sprintf("%05s", $count_id);

		$id_trans = "TRF.".$date.".".$count;

		$countInvStock = $this->M_stock_barang->get_count_inv_sum($location_id,$id_barang);

		$qty_sum = $this->M_stock_barang->get_qty_inv_sum($location_id,$id_barang);
		$inv_qty_sum = $qty_sum['qty'];

		if ($date_transfer <= $lock_date_inv['date_lock_inv']) {
			$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('Transfer_inv_user/edit/'.$transfer_id);
		}else{
			if ($CountItem > 0) {
				$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Cannot Input The Same Item  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('Transfer_inv_user/edit/'.$transfer_id);
			}else {

				if ($unit_id == $MasterInventoryUnit) {
					if (empty($countInvStock)){

						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));

					}elseif($inv_qty_sum < $qty){

						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else{

						$data = array(
							'id_trans'		=> $id_trans,
					        'transfer_id'	=> $this->input->post('transfer_id'),
							'id_barang'		=> $this->input->post('id_barang'),
							'unit'			=> $this->input->post('unitId'),
							'qty'			=> $this->input->post('qty'),
							'description'	=> $this->input->post('desc'),
							'status'		=> 'Open',
							'transfer_date'	=> $date_transfer,
							'loc_to'		=> $this->input->post('location_to'),
							'id_comp'		=> $comp,
							'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $this->M_transfer->tambahDetail($data);
					    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					    redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}
				}else if ($GetUnitConversion > 0) {
					if (empty($countInvStock)){

						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));

					}elseif($inv_qty_sum < $countFactor){

						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else{

						$data = array(
							'id_trans'		=> $id_trans,
					        'transfer_id'	=> $this->input->post('transfer_id'),
							'id_barang'		=> $this->input->post('id_barang'),
							'unit'			=> $this->input->post('unitId'),
							'qty'			=> $this->input->post('qty'),
							'description'	=> $this->input->post('desc'),
							'status'		=> 'Open',
							'transfer_date'	=> $date_transfer,
							'loc_to'		=> $this->input->post('location_to'),
							'id_comp'		=> $comp,
							'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $this->M_transfer->tambahDetail($data);
					    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					    redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}
				}else if ($GetUnitConversionBack > 0) {
					if (empty($countInvStock)){

						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));

					}elseif($inv_qty_sum < $countFactorBack){

						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else{

						$data = array(
							'id_trans'		=> $id_trans,
					        'transfer_id'	=> $this->input->post('transfer_id'),
							'id_barang'		=> $this->input->post('id_barang'),
							'unit'			=> $this->input->post('unitId'),
							'qty'			=> $this->input->post('qty'),
							'description'	=> $this->input->post('desc'),
							'status'		=> 'Open',
							'transfer_date'	=> $date_transfer,
							'loc_to'		=> $this->input->post('location_to'),
							'id_comp'		=> $comp,
							'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $this->M_transfer->tambahDetail($data);
					    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					    redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}
				}else{
					$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

					redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
				}
			}

		}

				// if (empty($countInvStock)){

				// 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

				// }elseif($inv_qty_sum < $qty){

				// 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Transfer Failed, Not Enough Item to be Shipped <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				// }else{

				// 	$data = array(
				//         'id_barang'		=> $this->input->post('id_barang'),
				//         'history_date'	=> $date_transfer,
				//         'inv_status'	=> 'Transfer',
				//         'qty'			=> $this->input->post('qty'),
				//         'unit_id'		=> $unit_barang,
				//         'status'		=> 'Open',
				//         'id_comp'		=> $comp
				//     );

				//     $this->m_transfer->tambahTrans($data);

				// 	$inv_id = $this->m_history->GetInvTransId();
				// 	$inv_history_id = $inv_id['inv_history_id'];

				//     $data2 = array(
				//         'transfer_id'	=> $transfer_id,
				//         'inv_history_id'	=> $inv_history_id,
				//         'id_comp'		=> $comp
				//     );

				//     $this->m_transfer->tambahDetail($data2);
				//     $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Item Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				// }
	}

	public function editInvTrans()
	{
		$inv_id = $this->m_tabel_barang->GetItemId();
		$inv_table_id = $inv_id['unit_barang'];

		$data = array(
	        'id_barang'		=> $this->input->post('id_barang'),
	        'qty'			=> $this->input->post('qty'),
	        'description'	=> $this->input->post('desc'),
	        'unit'		=> $this->input->post('unit_id'),
	        'modified'		=> $this->session->userdata('id'),
	        'modified_date'	=> date('Y-m-d H:i:s')
	    );

	    $this->M_transfer->update(array('id_trans' => $this->input->post('id_inv')), $data);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diperbarui <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
	}

	public function post()
	{
		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();
		$inv_trans = $this->M_history->GetInvTransfer();

		$posting = array();
		foreach ($inv_trans as $trans) {

			$id_barang = $trans->id_barang;
			$location_id = $trans->location_from;
			$qty = $trans->qty;
			$unit_id = $trans->unit;
			$id_trans = $trans->id_trans;
			$id_comp = $trans->id_comp;
			$transfer_id = $trans->trans_id;
			$status = $trans->stat_detail;
			$transfer_date = $trans->date_transfer;
			$location_to = $trans->location_transit;

			$itemId = $id_barang;

			$GetInventoryUnitMaster = $this->M_tabel_barang->GetUnitMasterTable($itemId);
			$MasterInventoryUnit = $GetInventoryUnitMaster['inventoryUnit'];

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

			$countInvStock = $this->M_stock_barang->get_count_inv_sum($location_id,$id_barang);

			$qty_sum = $this->M_transfer->get_qty_inv_sum($location_id,$id_barang);
			$inv_qty_sum = $qty_sum['qty'];

			if ($transfer_date <= $lock_date_inv['date_lock_inv']) {
				$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('Transfer_inv_user/edit/'.$transfer_id);
			}else {
				if ($unit_id == $MasterInventoryUnit) {
					
					if (empty($countInvStock)) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else if ($inv_qty_sum < $qty) {

						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else {

						$data = array(
					        'status'	=> 'Shipping'
					    );

						$dataTrans = array(
					    	'id_barang'		=> $id_barang,
					    	'history_date'	=> $transfer_date,
					    	'inv_status'	=> 'Transfer',
					    	'qty'			=> $qty,
					    	'status'		=> 'Shipping',
					    	'unit_id'		=> $MasterInventoryUnit,
					    	'id_comp'		=> $id_comp,
					    	'trans_id'		=> $id_trans,
					    	'ref_id_header'	=> $transfer_id,
					    	'trans_from'	=> $location_id,
					    	'trans_to'		=> '11',
					    	'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $dataInvSum = array(
					        'qty' => $inv_qty_sum - $qty
					    );

					    $dataInvSumTo = array(
					        'id_barang'		=> $id_barang,
					        'qty'			=> $qty,
					        'id_lokasi'	=> $location_to,
					        'unit_id'		=> $MasterInventoryUnit,
					        'id_comp'		=> $id_comp
					    );

					    $dataCountInvSumTo = $qty;

					    $posting[] = [
					    	'data'=>$data,
					    	'dataTrans' => $dataTrans,
					    	'dataInvSum' => $dataInvSum,
					    	'dataInvSumTo' => $dataInvSumTo,
					    	'dataCountInvSumTo' => $dataCountInvSumTo,
					    	'location_id' => $location_id,
					    	'location_to' => $location_to,
					    	'id_barang' => $id_barang,
					    	'id_trans' =>$id_trans	

					    ];
					}
				}else if ($GetUnitConversion > 0) {
					
					if (empty($countInvStock)) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else if ($inv_qty_sum < $countFactor) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else {

						$data = array(
					        'status'	=> 'Shipping'
					    );

						$dataTrans = array(
					    	'id_barang'		=> $id_barang,
					    	'history_date'	=> $transfer_date,
					    	'inv_status'	=> 'Transfer',
					    	'qty'			=> $countFactor,
					    	'status'		=> 'Shipping',
					    	'unit_id'		=> $MasterInventoryUnit,
					    	'id_comp'		=> $id_comp,
					    	'trans_id'		=> $id_trans,
					    	'ref_id_header'	=> $transfer_id,
					    	'trans_from'	=> $location_id,
					    	'trans_to'		=> '11',
					    	'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $dataInvSum = array(
					        'qty' => $inv_qty_sum - $countFactor
					    );

					    $dataInvSumTo = array(
					        'id_barang'		=> $id_barang,
					        'qty'			=> $countFactor,
					        'id_lokasi'	=> $location_to,
					        'unit_id'		=> $MasterInventoryUnit,
					        'id_comp'		=> $id_comp
					    );

					    $dataCountInvSumTo = $countFactor;

					    $posting[] = [
					    	'data'=>$data,
					    	'dataTrans' => $dataTrans,
					    	'dataInvSum' => $dataInvSum,
					    	'dataInvSumTo' => $dataInvSumTo,
					    	'dataCountInvSumTo' => $dataCountInvSumTo,
					    	'location_id' => $location_id,
					    	'location_to' => $location_to,
					    	'id_barang' => $id_barang,
					    	'id_trans' => $id_trans	

					    ];
					}
				}else if ($GetUnitConversionBack > 0) {
					
					if (empty($countInvStock)) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else if ($inv_qty_sum < $countFactorBack) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else {

						$data = array(
					        'status'	=> 'Shipping'
					    );

						$dataTrans = array(
					    	'id_barang'		=> $id_barang,
					    	'history_date'	=> $transfer_date,
					    	'inv_status'	=> 'Transfer',
					    	'qty'			=> $countFactorBack,
					    	'status'		=> 'Shipping',
					    	'unit_id'		=> $MasterInventoryUnit,
					    	'id_comp'		=> $id_comp,
					    	'trans_id'		=> $id_trans,
					    	'ref_id_header'	=> $transfer_id,
					    	'trans_from'	=> $location_id,
					    	'trans_to'		=> '11',
					    	'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $dataInvSum = array(
					        'qty' => $inv_qty_sum - $countFactorBack
					    );

					    $dataInvSumTo = array(
					        'id_barang'		=> $id_barang,
					        'qty'			=> $countFactorBack,
					        'id_lokasi'	=> $location_to,
					        'unit_id'		=> $MasterInventoryUnit,
					        'id_comp'		=> $id_comp
					    );

					    $dataCountInvSumTo = $countFactorBack;

					    $posting[] = [
					    	'data'=>$data,
					    	'dataTrans' => $dataTrans,
					    	'dataInvSum' => $dataInvSum,
					    	'dataInvSumTo' => $dataInvSumTo,
					    	'dataCountInvSumTo' => $dataCountInvSumTo,
					    	'location_id' => $location_id,
					    	'location_to' => $location_to,
					    	'id_barang' => $id_barang,
					    	'id_trans' =>$id_trans	

					    ];
					}
				}else {
					$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('Transfer_inv_user/edit/'.$transfer_id);
				}

			}			

		}

		// echo "<pre>";
		// var_dump($posting);
		// die;

		foreach ($posting as $key => $value) {

			$this->M_transfer->updateTransfer($value['data'] ,$value['dataInvSum'] ,$value['dataTrans'] ,$value['location_id'] ,$value['id_barang'], $value['id_trans']);

			$countInvStock_to = $this->M_stock_barang->getCountQtyTo($value['location_to'],$value['id_barang']);

			$qty_sum_to = $this->M_transfer->getQtyInvSumTo($value['location_to'],$value['id_barang']);
			$inv_qty_sum_to = $qty_sum_to['qty'];

			if (empty($countInvStock_to)) {
					$this->M_transfer->ShipTransPost($value['dataInvSumTo']);
				}else {

					$dataPostInvSumTo = array(
						'qty'	=> $inv_qty_sum_to + $value['dataCountInvSumTo']
					);
					$this->M_transfer->UpdateShipTransPost($dataPostInvSumTo ,$value['location_to'] ,$value['id_barang']);
				}	

		}
			
			$dataHeader = array(
			        'status'	=> 'Shipping'
			    );
			$this->M_inventory_header->postTransfer($dataHeader ,$transfer_id);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Transfer Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		
			redirect('Transfer_inv_user');
	}

	public function postReceipt()
	{
		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();
		$inv_trans = $this->M_history->GetInvTransfer();

		$posting = array();
		foreach ($inv_trans as $trans) {

			$id_barang = $trans->id_barang;
			$location_id = $trans->location_transit;
			$qty = $trans->qty;
			$unit_id = $trans->unit;
			$id_trans = $trans->id_trans;
			$id_comp = $trans->id_comp;
			$transfer_id = $trans->trans_id;
			$status = $trans->stat_detail;
			$transfer_date = $trans->date_transfer;
			$location_to = $trans->loc_to;

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

			$countInvStock = $this->M_stock_barang->get_count_inv_sum($location_id,$id_barang);

			$qty_sum = $this->M_transfer->get_qty_inv_sum($location_id,$id_barang);
			$inv_qty_sum = $qty_sum['qty'];

			if ($transfer_date <= $lock_date_inv['date_lock_inv']) {
				$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('Transfer_inv_user/edit/'.$transfer_id);
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

				if ($unit_id == $MasterInventoryUnit) {
					
					if (empty($countInvStock)) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else if ($inv_qty_sum < $qty) {

						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else {

						$data = array(
					        'status'	=> 'Receipt'
					    );

						$dataTrans = array(
					    	'status'		=> 'Receipt',
							'trans_to'		=> $location_to,
							'harga'			=> round($hargaItem, 2),
							'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $dataInvSum = array(
					        'qty' => $inv_qty_sum - $qty
					    );

					    $dataInvSumTo = array(
					        'id_barang'		=> $id_barang,
					        'qty'			=> $qty,
					        'id_lokasi'	=> $location_to,
					        'unit_id'		=> $MasterInventoryUnit,
					        'id_comp'		=> $id_comp
					    );

					    $dataCountInvSumTo = $qty;

					    $posting[] = [
					    	'data'=>$data,
					    	'dataTrans' => $dataTrans,
					    	'dataInvSum' => $dataInvSum,
					    	'dataInvSumTo' => $dataInvSumTo,
					    	'dataCountInvSumTo' => $dataCountInvSumTo,
					    	'location_id' => $location_id,
					    	'location_to' => $location_to,
					    	'id_barang' => $id_barang,
					    	'id_trans' =>$id_trans,
					    	'transfer_id'	=> $transfer_id	

					    ];
					}
				}else if ($GetUnitConversion > 0) {
					
					if (empty($countInvStock)) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else if ($inv_qty_sum < $countFactor) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else {

						$data = array(
					        'status'	=> 'Receipt'
					    );

						$dataTrans = array(
					    	'status'		=> 'Receipt',
							'trans_to'		=> $location_to,
							'harga'			=> round($hargaItem, 2),
							'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $dataInvSum = array(
					        'qty' => $inv_qty_sum - $countFactor
					    );

					    $dataInvSumTo = array(
					        'id_barang'		=> $id_barang,
					        'qty'			=> $countFactor,
					        'id_lokasi'	=> $location_to,
					        'unit_id'		=> $MasterInventoryUnit,
					        'id_comp'		=> $id_comp
					    );

					    $dataCountInvSumTo = $countFactor;

					    $posting[] = [
					    	'data'=>$data,
					    	'dataTrans' => $dataTrans,
					    	'dataInvSum' => $dataInvSum,
					    	'dataInvSumTo' => $dataInvSumTo,
					    	'dataCountInvSumTo' => $dataCountInvSumTo,
					    	'location_id' => $location_id,
					    	'location_to' => $location_to,
					    	'id_barang' => $id_barang,
					    	'id_trans' => $id_trans,
					    	'transfer_id'	=> $transfer_id		

					    ];
					}
				}else if ($GetUnitConversionBack > 0) {
					
					if (empty($countInvStock)) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else if ($inv_qty_sum < $countFactorBack) {
						
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transfer Failed, Not Enough Item to be Transfer <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

						redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
					}else {

						$data = array(
					        'status'	=> 'Receipt'
					    );

						$dataTrans = array(
					    	'status'		=> 'Receipt',
							'trans_to'		=> $location_to,
							'harga'			=> round($hargaItem, 2),
							'created'		=> $this->session->userdata('id'),
					        'created_date'	=> date('Y-m-d H:i:s'),
					        'modified'		=> $this->session->userdata('id'),
					        'modified_date'	=> date('Y-m-d H:i:s')
					    );

					    $dataInvSum = array(
					        'qty' => $inv_qty_sum - $countFactorBack
					    );

					    $dataInvSumTo = array(
					        'id_barang'		=> $id_barang,
					        'qty'			=> $countFactorBack,
					        'id_lokasi'	=> $location_to,
					        'unit_id'		=> $MasterInventoryUnit,
					        'id_comp'		=> $id_comp
					    );

					    $dataCountInvSumTo = $countFactorBack;

					    $posting[] = [
					    	'data'=>$data,
					    	'dataTrans' => $dataTrans,
					    	'dataInvSum' => $dataInvSum,
					    	'dataInvSumTo' => $dataInvSumTo,
					    	'dataCountInvSumTo' => $dataCountInvSumTo,
					    	'location_id' => $location_id,
					    	'location_to' => $location_to,
					    	'id_barang' => $id_barang,
					    	'id_trans' =>$id_trans,
					    	'transfer_id'	=> $transfer_id		

					    ];
					}
				}else {
					$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('Transfer_inv_user/edit/'.$transfer_id);
				}

			}			

		}

		// echo "<pre>";
		// var_dump($posting);
		// die;

		foreach ($posting as $key => $value) {

			$this->M_transfer->updateTransReceiptPost($value['data'] ,$value['dataInvSum'] ,$value['dataTrans'] ,$value['location_id'] ,$value['id_barang'], $value['id_trans'] ,$value['transfer_id']);

			$countInvStock_to = $this->M_stock_barang->getCountQtyTo($value['location_to'],$value['id_barang']);

			$qty_sum_to = $this->M_transfer->getQtyInvSumTo($value['location_to'],$value['id_barang']);
			$inv_qty_sum_to = $qty_sum_to['qty'];

			if (empty($countInvStock_to)) {
					$this->M_transfer->ShipTransPost($value['dataInvSumTo']);
				}else {

					$dataPostInvSumTo = array(
						'qty'	=> $inv_qty_sum_to + $value['dataCountInvSumTo']
					);
					$this->M_transfer->UpdateShipTransPost($dataPostInvSumTo ,$value['location_to'] ,$value['id_barang']);
				}	

		}
			
			$dataHeader = array(
			        'status'	=> 'Receipt'
			    );
			$this->M_inventory_header->postTransfer($dataHeader ,$transfer_id);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Transfer Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		
			redirect('Transfer_inv_user');
	}

	public function deleteDetail()
	{
		$inv_history_id = $this->input->post('inv_history_id');

		$this->M_inventory_header->deleteDetailTrans($inv_history_id);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('Transfer_inv_user/edit/'.$this->input->post('transfer_id'));
	}

	public function delete()
	{

		$countTransDetail = $this->M_inventory_header->GetDeleteTransHeader();

		if ($countTransDetail > 0) {
			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Transfer Id Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Transfer_inv_user');
		}else{

			$id_transfer = $this->input->post('id_transfer');

			$this->M_inventory_header->deleteHeaderTrans($id_transfer);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Transfer_inv_user');
		}

	}
}
