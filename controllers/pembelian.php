<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_receipt');
		$this->load->model('m_lokasi');
		$this->load->model('M_invent_item');
		$this->load->model('M_history');
		$this->load->model('M_inventory_header');
		$this->load->model('M_tabel_barang');
		$this->load->model('M_stock_barang');
		$this->load->model('M_inventory_detail');
		$this->load->model('M_group_barang');
		$this->load->model('M_invent_unit');
		$this->load->model('M_unit_conversion');
		$this->load->model('M_category');
		$this->load->model('M_daftar_harga');
		$this->load->model('M_suplayer');

	}


	public function index()
	{
		$data['m_receipt'] = $this->M_receipt->getReceiptHeader();
		$data['m_lokasi'] = $this->m_lokasi->get_location_query();
		$data['m_group_barang']	= $this->M_group_barang->get_group_barang_query();
		$data['m_suplayer']	= $this->M_suplayer->GetSuplayerInfo();
		$this->template->load('admin/Static','admin/pembelian',$data);
	}

	public function tambah()
	{
		$comp = $this->session->userdata('comp');
		$pembelian_date = $this->input->post('pembelian_date');
		$date = date('m.y', strtotime($pembelian_date));

		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();
		

		$location_name = $this->m_lokasi->get_Code_location();
		$count_id = $this->M_receipt->get_count_rec() + 1;
		$count = sprintf("%05s", $count_id);

		$pembelian_id = "REC.".$location_name['codeLocation'].".".$date.".".$count;

		{

			$data = array(
	        'pembelian_id'			=> $pembelian_id,
	        'no_po_ax'				=> $this->input->post('no_po_ax'),
	        'no_product_receipt_ax'	=> $this->input->post('no_product_receipt_ax'),
	        'pembelian_date'			=> $this->input->post('pembelian_date'),
	        // 'receipt_ax_date'		=> $this->input->post('receipt_ax_date'),
	        // 'description'			=> $this->input->post('desc'),
	        'id_lokasi'				=> $this->input->post('id_lokasi'),
	        'status'				=> 'Open',
	        'receipt_type'			=> $this->input->post('receipt_type'),
	        'group_barang'			=> $this->input->post('group_barang'),
	        'id_suplayer'			=> $this->input->post('id_suplayer'),
	        'id_comp'       		=> $comp

	        
		    );

		    $this->M_receipt->tambah($data);
			redirect('pembelian/view/'.$pembelian_id);
		}

	}

	public function GetItemMaster()
	{
		$id_barang = $this->input->post('itemId');

	    $query = $this->M_receipt->GetItemMasterTable();

	    foreach($query->result() as $row)
        { 
        	$unit = $row->pembelian_unit;
        }

        $invent_unit = $this->M_receipt->GetInventUnitWhere($unit);

        echo "<option value='".$unit."'>".$unit."</option>";

        foreach ($invent_unit as $invUnit) {
        echo "<option value='".$invUnit->unit."'>".$invUnit->unit."</option>";
        }
	    
	}

	public function GetItemCategoryMaster()
	{
		$id_barang = $this->input->post('itemId');

	    $query = $this->M_receipt->GetItemCategoryMasterTable();

	    foreach($query->result() as $row)
        { 
        	$id_kategori = $row->id_kategori;
        	$nama_kategori = $row->nama_kategori;
        	$group_barang = $row->group_barang;
        }

        $invent_category = $this->M_receipt->GetInventCategoryWhere($id_kategori,$group_barang);

        echo "<option value='".$id_kategori."'>".$nama_kategori."</option>";

        foreach ($invent_category as $invCategory) {
        echo "<option value='".$invCategory->id_kategori."'>".$invCategory->nama_kategori."</option>";
        }
	    
	}

	public function cetak()
	{
		$id = $this->uri->segment(3);

		$data['m_receipt'] = $this->M_receipt->GetSingleReceiptHeader($id);
		$data['receipt'] = $this->M_receipt->GetReceiptSingle($id)->result();
		$data['totbeli'] = $this->M_receipt->GetReceiptSingletot($id)->result();
		// $this->template->load('admin/static','admin/print_shipping',$data);
		$this->load->view('admin/Print_receipt',$data);

	}

	public function GetCategoryItem()
	{

	    $query = $this->M_invent_item->GetCategoryItemAll();

        echo '<option value="">Select Item</option>';

        foreach ($query as $category) {
        echo "<option value='".$category->id_barang."'>".$category->nama_barang."</option>";
        }
	    
	}

	public function edit()
	{
		$data = array(
			'no_po_ax'				=> $this->input->post('no_po_ax'),
	        'no_product_receipt_ax'	=> $this->input->post('no_product_receipt_ax'),
	        'pembelian_date'			=> $this->input->post('pembelian_date'),
	        // 'receipt_ax_date'		=> $this->input->post('receipt_ax_date'),
	        'description'			=> $this->input->post('desc'),
	        'id_lokasi'			=> $this->input->post('id_lokasi'),
	        'group_barang'			=> $this->input->post('group_barang'),
	        'modified'				=> $this->session->userdata('id'),
	        'modified_date'			=> date('Y-m-d H:i:s')
		);

		$this->M_receipt->edit(array('id' => $this->input->post('id')),$data);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Edit Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Pembelian');
	}

	public function view()
	{
		$id = $this->uri->segment(3);

		$item_gorup = $this->M_inventory_header->GetStatusInvent($id)->result();
		foreach ($item_gorup as $receipt) {
			$item = $receipt->group_barang;
		}


		$data['m_category']	= $this->M_category->GetAllCategoryWhere($item);
		$data['m_invent_item'] = $this->M_invent_item->GetInventTableWhere($item);
		$data['m_inventory_detail'] = $this->M_inventory_detail->GetCountDetail($id);
		$data['m_inventory_header'] = $this->M_inventory_header->GetStatusInvent($id)->result();
		$data['m_receipt'] = $this->M_receipt->GetReceiptSingle($id)->result();
		$data['m_invent_unit']		= $this->M_invent_unit->get_invent_unit_query();
		$this->template->load('admin/Static','admin/Detail_receipt',$data);
	}

	public function tambahDetail()
	{

		$id_comp = $this->session->userdata('comp');
		$itemId = $this->input->post('id_barang');
		$pembelian_id = $this->input->post('pembelian_id');

		$GetInventoryUnitMaster = $this->M_tabel_barang->GetUnitMasterTable($itemId);
		$MasterInventoryUnit = $GetInventoryUnitMaster['inventoryUnit'];

		$unitFrom = $this->input->post('unitId');
		$unitTo = $MasterInventoryUnit;

		$CountItem = $this->M_receipt->CountItem($itemId, $pembelian_id);


		$GetUnitConversion = $this->M_unit_conversion->GetUnitConversion($itemId, $unitFrom, $unitTo);
		$GetUnitConversionBack = $this->M_unit_conversion->GetUnitConversionBack($itemId, $unitFrom, $unitTo);

		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();

		$pembelian_date = $this->M_receipt->GetReceiptDate();
		$date_receipt = $pembelian_date['pembelian_date'];

		$harga = $this->M_daftar_harga->get_count_harga();
		$hitung = $harga['harga'];

		$date = date('m.y', strtotime($date_receipt));
		$count_id = $this->M_receipt->getCountReceiptDetail($date_receipt) + 1;
		$count = sprintf("%05s", $count_id);

		$id_beli= "REC.".$date.".".$count;


		if ($date_receipt <= $lock_date_inv['date_lock_inv']) {

			$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{

			if ($CountItem > 0) {

				$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Cannot Input The Same Item  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('pembelian/view/'.$this->input->post('pembelian_id'));
			}else {

				if ($unitFrom == $MasterInventoryUnit) {
					$data = array(
						'id_beli'		=> $id_beli,
						'pembelian_id'	=> $this->input->post('pembelian_id'),
						'id_barang'		=> $this->input->post('id_barang'),
						'unit'			=> $this->input->post('unitId'),
						'qty'			=> $this->input->post('qty'),
						'invoice'		=> $this->input->post('invoice'),
						'status'		=> 'Open',
						'pembelian_date'	=> $date_receipt,
						'id_comp'		=> $id_comp,
						'created'		=> $this->session->userdata('id_loginakses'),
				        'created_date'	=> date('Y-m-d H:i:s'),
				        'modified'		=> $this->session->userdata('id_loginakses'),
				        'modified_date'	=> date('Y-m-d H:i:s'),
				        'harga'			=>	$hitung * $this->input->post('qty')
					);

				    $this->M_receipt->tambahDetail($data);
				    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				    redirect('pembelian/view/'.$this->input->post('pembelian_id'));
				}else if ($GetUnitConversion > 0) {
					$data = array(
						'id_beli'		=> $id_beli,
						'pembelian_id'	=> $this->input->post('pembelian_id'),
						'id_barang'		=> $this->input->post('id_barang'),
						'unit'			=> $this->input->post('unitId'),
						'qty'			=> $this->input->post('qty'),
						'invoice'		=> $this->input->post('invoice'),
						'status'		=> 'Open',
						'pembelian_date'	=> $date_receipt,
						'id_comp'		=> $id_comp,
						'created'		=> $this->session->userdata('id_loginakses'),
				        'created_date'	=> date('Y-m-d H:i:s'),
				        'modified'		=> $this->session->userdata('id_loginakses'),
				        'modified_date'	=> date('Y-m-d H:i:s'),
				        'harga'			=>	$hitung * $this->input->post('qty')
					);

				    $this->M_receipt->tambahDetail($data);
				    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				    redirect('pembelian/view/'.$this->input->post('pembelian_id'));
				}else if ($GetUnitConversionBack > 0) {
					$data = array(
						'id_beli'		=> $id_beli,
						'pembelian_id'	=> $this->input->post('pembelian_id'),
						'id_barang'		=> $this->input->post('id_barang'),
						'unit'			=> $this->input->post('unitId'),
						'qty'			=> $this->input->post('qty'),
						'invoice'		=> $this->input->post('invoice'),
						'status'		=> 'Open',
						'pembelian_date'	=> $date_receipt,
						'id_comp'		=> $id_comp,
						'created'		=> $this->session->userdata('id_loginakses'),
				        'created_date'	=> date('Y-m-d H:i:s'),
				        'modified'		=> $this->session->userdata('id_loginakses'),
				        'modified_date'	=> date('Y-m-d H:i:s'),
				        'harga'			=>	$hitung * $this->input->post('qty')
					);

				    $this->M_receipt->tambahDetail($data);
				    $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Item Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				    redirect('pembelian/view/'.$this->input->post('pembelian_id'));
				}else {
					$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				    redirect('pembelian/view/'.$this->input->post('pembelian_id'));
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
	        'invoice'		=> $this->input->post('invoice'),
	        'unit'			=> $this->input->post('unit_id'),
	        'modified'		=> $this->session->userdata('id'),
	        'modified_date'	=> date('Y-m-d H:i:s')
	    );

	    $this->M_history->update(array('id_beli' => $this->input->post('id_beli')), $data);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Data Berhasil diperbarui <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('pembelian/view/'.$this->input->post('pembelian_id'));
	}

	public function post()
	{
		$lock_date_inv = $this->M_inventory_header->GetFieldDateLockInv();

		$pembelian_date = $this->M_receipt->GetReceiptDate();
		$date_receipt = $pembelian_date['pembelian_date'];
		$receipt_type = $pembelian_date['receipt_type'];


		$inv_trans = $this->M_history->GetInvTrans();

		$posting = array();
		foreach ($inv_trans as $key => $trans) 
		{

			$id_barang = $trans->id_barang;
			$id_lokasi = $trans->id_lokasi;
			$qty = $trans->qty;
			$unit_id = $trans->unit;
			$id_comp = $trans->comp_rec;
			$pembelian_id = $trans->rec_id;
			$receipt_type = $trans->receipt_type;
			$invoice 	= $trans->invoice;
			$id_beli = $trans->id_beli;
			$status = $trans->stat_detail;

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

			$qty_sum = $this->M_receipt->get_qty_inv_sum($id_lokasi,$id_barang);
			$inv_qty_sum = $qty_sum['qty'];

			if ($date_receipt <= $lock_date_inv['date_lock_inv']) {
				$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Transaction Locked <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('pembelian/view/'.$pembelian_id);
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

				if ($receipt_type == 'Order') {
					if ($unit_id == $MasterInventoryUnit) {
						if (empty($countInvStock)) {
							$data = array(
						        	'status'	=> 'Posted'
							    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $qty,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
						    	'unit_id'		=> $unit_id,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );


						    $dataInvSum = array(
						        'id_barang'		=> $id_barang,
						        'qty'			=> $qty,
						        'id_lokasi'	=> $id_lokasi,
						        'unit_id'		=> $unit_id,
						        'id_comp'		=> $id_comp
						    );

						    $posting[] = [
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}else {
							$data = array(
						        	'status'	=> 'Posted'
							    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $qty,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}
					}else if ($GetUnitConversion > 0) {
						if (empty($countInvStock)) {
							$data = array(
						        	'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $countFactor,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
						    	'unit_id'		=> $MasterInventoryUnit,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );


						    $dataInvSum = array(
						        'id_barang'		=> $id_barang,
						        'qty'			=> $countFactor,
						        'id_lokasi'	=> $id_lokasi,
						        'unit_id'		=> $MasterInventoryUnit,
						        'id_comp'		=> $id_comp
						    );

						    $posting[] = [
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}else {
							$data = array(
						        	'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $countFactor,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}
					}else if ($GetUnitConversionBack > 0) {
						if (empty($countInvStock)) {
							$data = array(
						        	'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $countFactorBack,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
						    	'unit_id'		=> $MasterInventoryUnit,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );


						    $dataInvSum = array(
						        'id_barang'		=> $id_barang,
						        'qty'			=> $countFactorBack,
						        'id_lokasi'	=> $id_lokasi,
						        'unit_id'		=> $MasterInventoryUnit,
						        'id_comp'		=> $id_comp
						    );

							$posting[] = [
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}else {
							$data = array(
						        	'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $countFactorBack,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}
					}else {
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			    		redirect('pembelian/view/'.$this->input->post('pembelian_id'));
					}

				}else {

					if ($unit_id == $MasterInventoryUnit) {
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('pembelian/view/'.$this->input->post('pembelian_id'));
						}else {

							if ($inv_qty_sum < $qty) {
								$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, The Number You Put Too Large <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

								redirect('pembelian/view/'.$this->input->post('pembelian_id'));
							}else {

								$data = array(
						        	'status'	=> 'Posted'
							    );

							    $dataTrans = array(
							    	'id_barang'		=> $id_barang,
							    	'history_date'	=> $date_receipt,
							    	'inv_status'	=> 'Pembelian',
							    	'qty'			=> $qty,
							    	'invoice'		=> $invoice,
							    	'status'		=> 'Pengembalian',
							    	'histo_id'		=> $id_beli,
						    		'trans_from'	=> $id_lokasi,
						    		'ref_id_header'	=> $pembelian_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
							}
						}
					}else if ($GetUnitConversion > 0) {
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('pembelian/view/'.$this->input->post('pembelian_id'));
						}else {

							if ($inv_qty_sum < $countFactor) {
								$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, The Number You Put Too Large <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

								redirect('pembelian/view/'.$this->input->post('pembelian_id'));
							}else {
								$data = array(
						        	'status'	=> 'Posted'
							    );

							    $dataTrans = array(
							    	'id_barang'		=> $id_barang,
							    	'history_date'	=> $date_receipt,
							    	'inv_status'	=> 'Receipt',
							    	'qty'			=> $countFactor,
							    	'invoice'		=> $invoice,
							    	'status'		=> 'Pengembalian',
							    	'histo_id'		=> $id_beli,
						    		'trans_from'	=> $id_lokasi,
						    		'ref_id_header'	=> $pembelian_id,
							    	'unit_id'		=> $unit_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
							}
						}
					}else if ($GetUnitConversionBack > 0) {
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('pembelian/view/'.$this->input->post('pembelian_id'));
						}else {
							
							if ($inv_qty_sum < $countFactorBack) {
								$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, The Number You Put Too Large <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

								redirect('pembelian/view/'.$this->input->post('pembelian_id'));
							}else {
								$data = array(
						        	'status'	=> 'Posted'
							    );

							    $dataTrans = array(
							    	'id_barang'		=> $id_barang,
							    	'history_date'	=> $date_receipt,
							    	'inv_status'	=> 'Pembelian',
							    	'qty'			=> $countFactorBack,
							    	'invoice'		=> $invoice,
							    	'status'		=> 'Pengembalian',
							    	'histo_id'		=> $id_beli,
						    		'trans_from'	=> $id_lokasi,
						    		'ref_id_header'	=> $pembelian_id,
							    	'unit_id'		=> $unit_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
							}
						}
					}else {
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			    		redirect('pembelian/view/'.$this->input->post('pembelian_id'));
					}
				}

			}

			
		}

		// echo "<pre>";
		// 	var_dump($posting);
		// 	die;

		foreach ($posting as $key => $value) {
			if (empty($countInvStock)) {
				$this->M_receipt->post($value['data'], $value['id_beli'], $value['dataTrans'], $value['dataInvSum']);
			}else {
				$this->M_receipt->updatepost($value['data'] ,$value['dataTrans'] ,$value['dataInvSum'] ,$value['id_lokasi'] ,$value['id_barang'], $value['id_beli']);
			}
		}

		$dataHeader = array(
	        'status'	=> 'Posted'
	    );
		$this->M_inventory_header->postHeader($dataHeader ,$pembelian_id);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Posting Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('Pembelian');
	}

	public function deleteDetail()
	{
		$id_beli = $this->input->post('id_beli');

		$this->M_inventory_header->deleteDetail($id_beli);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('pembelian/view/'.$this->input->post('pembelian_id'));
	}

	public function delete()
	{

		// $countRecDetail = $this->M_inventory_header->GetDeleteRecHeader();

		// if ($countRecDetail > 0) {
		// 	$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Cannot Delete, Receipt Id Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	 //    	redirect('Pembelian');
		// }else{

		 	$id_receipt = $this->input->post('id_receipt');

			$this->M_inventory_header->deleteHeader($id_receipt);
			$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    	redirect('Pembelian');
		// }

	}

	public function post1()
	{
		$data = array(
			'status'				=> 'posted'
	        
		);

		$this->M_inventory_header->updatepost1(array('id' => $this->input->post('id')),$data);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Saved Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	    redirect('Pembelian');


	    foreach ($inv_trans as $key => $trans) 
		{

			$id_barang = $trans->id_barang;
			$id_lokasi = $trans->id_lokasi;
			$qty = $trans->qty;
			$unit_id = $trans->unit;
			$id_comp = $trans->comp_rec;
			$pembelian_id = $trans->rec_id;
			$receipt_type = $trans->receipt_type;
			$invoice 	= $trans->invoice;
			$id_beli = $trans->id_beli;
			$status = $trans->stat_detail;

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

			$qty_sum = $this->M_receipt->get_qty_inv_sum($id_lokasi,$id_barang);
			$inv_qty_sum = $qty_sum['qty'];

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
			if ($receipt_type == 'Order') {
					if ($unit_id == $MasterInventoryUnit) {
						if (empty($countInvStock)) {
							$data = array(
						        	'status'	=> 'Posted'
							    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $qty,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
						    	'unit_id'		=> $unit_id,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );


						    $dataInvSum = array(
						        'id_barang'		=> $id_barang,
						        'qty'			=> $qty,
						        'id_lokasi'	=> $id_lokasi,
						        'unit_id'		=> $unit_id,
						        'id_comp'		=> $id_comp
						    );

						    $posting[] = [
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}else {
							$data = array(
						        	'status'	=> 'Posted'
							    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $qty,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}
					}else if ($GetUnitConversion > 0) {
						if (empty($countInvStock)) {
							$data = array(
						        	'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $countFactor,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
						    	'unit_id'		=> $MasterInventoryUnit,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );


						    $dataInvSum = array(
						        'id_barang'		=> $id_barang,
						        'qty'			=> $countFactor,
						        'id_lokasi'	=> $id_lokasi,
						        'unit_id'		=> $MasterInventoryUnit,
						        'id_comp'		=> $id_comp
						    );

						    $posting[] = [
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}else {
							$data = array(
						        	'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $countFactor,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}
					}else if ($GetUnitConversionBack > 0) {
						if (empty($countInvStock)) {
							$data = array(
						        	'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $countFactorBack,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
						    	'unit_id'		=> $MasterInventoryUnit,
						    	'id_comp'		=> $id_comp,
						    	'harga'			=> round($hargaItem, 2),
						    	'created'		=> $this->session->userdata('id_loginakses'),
						        'created_date'	=> date('Y-m-d H:i:s'),
						        'modified'		=> $this->session->userdata('id_loginakses'),
						        'modified_date'	=> date('Y-m-d H:i:s')
						    );


						    $dataInvSum = array(
						        'id_barang'		=> $id_barang,
						        'qty'			=> $countFactorBack,
						        'id_lokasi'	=> $id_lokasi,
						        'unit_id'		=> $MasterInventoryUnit,
						        'id_comp'		=> $id_comp
						    );

							$posting[] = [
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}else {
							$data = array(
						        	'status'	=> 'Posted'
						    );

						    $dataTrans = array(
						    	'id_barang'		=> $id_barang,
						    	'history_date'	=> $date_receipt,
						    	'inv_status'	=> 'Receipt',
						    	'qty'			=> $countFactorBack,
						    	'invoice'		=> $invoice,
						    	'status'		=> 'Order',
						    	'histo_id'		=> $id_beli,
						    	'trans_from'	=> $id_lokasi,
						    	'ref_id_header'	=> $pembelian_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
						}
					}else {
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			    		redirect('pembelian/view/'.$this->input->post('pembelian_id'));
					}

				}else {

					if ($unit_id == $MasterInventoryUnit) {
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('pembelian/view/'.$this->input->post('pembelian_id'));
						}else {

							if ($inv_qty_sum < $qty) {
								$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, The Number You Put Too Large <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

								redirect('pembelian/view/'.$this->input->post('pembelian_id'));
							}else {

								$data = array(
						        	'status'	=> 'Posted'
							    );

							    $dataTrans = array(
							    	'id_barang'		=> $id_barang,
							    	'history_date'	=> $date_receipt,
							    	'inv_status'	=> 'Pembelian',
							    	'qty'			=> $qty,
							    	'invoice'		=> $invoice,
							    	'status'		=> 'Pengembalian',
							    	'histo_id'		=> $id_beli,
						    		'trans_from'	=> $id_lokasi,
						    		'ref_id_header'	=> $pembelian_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
							}
						}
					}else if ($GetUnitConversion > 0) {
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('pembelian/view/'.$this->input->post('pembelian_id'));
						}else {

							if ($inv_qty_sum < $countFactor) {
								$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, The Number You Put Too Large <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

								redirect('pembelian/view/'.$this->input->post('pembelian_id'));
							}else {
								$data = array(
						        	'status'	=> 'Posted'
							    );

							    $dataTrans = array(
							    	'id_barang'		=> $id_barang,
							    	'history_date'	=> $date_receipt,
							    	'inv_status'	=> 'Pembelian',
							    	'qty'			=> $countFactor,
							    	'invoice'		=> $invoice,
							    	'status'		=> 'Pengembalian',
							    	'histo_id'		=> $id_beli,
						    		'trans_from'	=> $id_lokasi,
						    		'ref_id_header'	=> $pembelian_id,
							    	'unit_id'		=> $unit_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
							}
						}
					}else if ($GetUnitConversionBack > 0) {
						if (empty($countInvStock)) {
							$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, Item Empty <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							redirect('pembelian/view/'.$this->input->post('pembelian_id'));
						}else {
							
							if ($inv_qty_sum < $countFactorBack) {
								$this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Receipt Failed, The Number You Put Too Large <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

								redirect('pembelian/view/'.$this->input->post('pembelian_id'));
							}else {
								$data = array(
						        	'status'	=> 'Posted'
							    );

							    $dataTrans = array(
							    	'id_barang'		=> $id_barang,
							    	'history_date'	=> $date_receipt,
							    	'inv_status'	=> 'Pembelian',
							    	'qty'			=> $countFactorBack,
							    	'invoice'		=> $invoice,
							    	'status'		=> 'Pengembalian',
							    	'histo_id'		=> $id_beli,
						    		'trans_from'	=> $id_lokasi,
						    		'ref_id_header'	=> $pembelian_id,
							    	'unit_id'		=> $unit_id,
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
						    	'data'			=> $data,
						    	'dataTrans' 	=> $dataTrans,
						    	'dataInvSum' 	=> $dataInvSum,
						    	'id_lokasi'	=> $id_lokasi,
						    	'id_barang' 		=> $id_barang,
						    	'id_beli' 		=> $id_beli	

						    ];
							}
						}
					}else {
						$this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Please Check,Unit Conversion <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			    		redirect('pembelian/view/'.$this->input->post('pembelian_id'));
					}

			}

			foreach ($posting as $key => $value) {
			if (empty($countInvStock)) {
				$this->M_receipt->post($value['data'], $value['id_beli'], $value['dataTrans'], $value['dataInvSum']);
			}else {
				$this->M_receipt->updatepost($value['data'] ,$value['dataTrans'] ,$value['dataInvSum'] ,$value['id_lokasi'] ,$value['id_barang'], $value['id_beli']);
			}
		}

		$dataHeader = array(
	        'status'	=> 'Posted'
	    );
		$this->M_inventory_header->postHeader($dataHeader ,$pembelian_id);
		$this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Posting Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('Pembelian');

			
		}
	}

	public function GetSuplayer()
	{

	    $query = $this->M_suplayer->GetSuplayerInfo();

        echo '<option value="">Select Item</option>';

        foreach ($query as $suplayer) {
        echo "<option value='".$suplayer->id_suplayer."'>".$suplayer->nama_suplayer."</option>";
        }
	    
	}
}
