<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_history extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }


     public function GetInvTransId()
    {

      $this->db->select('inv_history_id');
      $this->db->from('history');
      $this->db->order_by('inv_history_id','desc');
      $this->db->limit(1);
      $query = $this->db->get();

      foreach ($query->result_array() as $row) {
        echo $row['inv_history_id'];
      }

      $inv_id = array(
        'inv_history_id' => $row['inv_history_id']
      );
      
      return $inv_id;
      }

     public function tambahTrans($data)
      {
        $this->db->insert('history',$data);
        return TRUE;
      }

    public function update($where, $data)
    {
        $this->db->update('detail_pembelian', $data, $where);
        return TRUE;
    }

    public function GetInvTrans()
    {
      $pembelian_id = $this->input->post('pembelian_id');

      // $single = $this->db->select('*')
      //                    ->from('history')
      //                    ->join('detail_pembelian','detail_pembelian.inv_history_id = history.inv_history_id','LEFT')
      //                    ->join('header_pembelian','header_pembelian.pembelian_id = detail_pembelian.pembelian_id','LEFT')
      //                    ->where('detail_pembelian.pembelian_id', $pembelian_id)
      //                    ->get();
      //     return $single;
      $this->db->select('*');
      $this->db->select('detail_pembelian.pembelian_id as rec_id');
      $this->db->select('detail_pembelian.id_comp as comp_rec');
      $this->db->select('detail_pembelian.status as stat_detail');
      $this->db->from('detail_pembelian');
      $this->db->join('header_pembelian','header_pembelian.pembelian_id = detail_pembelian.pembelian_id','LEFT');
      $this->db->where('detail_pembelian.pembelian_id',$pembelian_id);
      $query = $this->db->get();

      return $query->result();
    }

    public function GetInvShipping()
    {
      $pemakaian_id = $this->input->post('pemakaian_id');

      $this->db->select('*');
      $this->db->select('detail_pemakaian.pemakaian_id as ship_id');
      $this->db->select('detail_pemakaian.id_comp as comp_ship');
      $this->db->select('detail_pemakaian.status as stat_detail');
      $this->db->select('detail_pemakaian.pemakaian_date as date_shipping');
      $this->db->from('detail_pemakaian');
      $this->db->join('header_pemakaian','header_pemakaian.pemakaian_id = detail_pemakaian.pemakaian_id','LEFT');
      $this->db->where('detail_pemakaian.pemakaian_id',$pemakaian_id);
      $query = $this->db->get();

      return $query->result();
    }

    public function GetInvTransfer()
    {
      $transfer_id = $this->input->post('transfer_id');

      $this->db->select('*');
      $this->db->select('transfer_detail.transfer_id as histo_id');
      $this->db->select('transfer_detail.id_comp as comp_ship');
      $this->db->select('transfer_detail.status as stat_detail');
      $this->db->select('transfer_detail.transfer_date as date_transfer');
      $this->db->from('transfer_detail');
      $this->db->join('transfer_header','transfer_header.transfer_id = transfer_detail.transfer_id','LEFT');
      $this->db->where('transfer_detail.transfer_id',$transfer_id);
      $query = $this->db->get();

      return $query->result();
    }

    public function post($data ,$dataInvSum ,$dataTrans, $pembelian_id)
    {

      $this->db->insert('stock_barang',$dataInvSum);
      $this->db->insert('history',$dataTrans);
      $this->db->update('detail_pembelian', $data, array('id_beli' => $id_beli));
      return TRUE;
    }

    public function updatepost($data ,$dataInvSum ,$dataTrans ,$id_lokasi ,$id_barang, $id_beli)
    {

      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $id_lokasi));
      $this->db->insert('history',$dataTrans);
      $this->db->update('detail_pembelian', $data, array('id_beli' => $id_beli));
      return TRUE;
    }

    public function updatepostTo($data ,$dataInvSum ,$inv_history_id ,$location_to ,$id_barang)
    {

      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $location_to));
      $this->db->update('history', $data, array('inv_history_id' => $inv_history_id));
      return TRUE;
    }

    public function GetAllTransaction()
    {
      $comp = $this->session->userdata('comp');

      $this->db->select('*');
      $this->db->select('a.status as status_trans', FALSE);
      $this->db->select('a.qty as qtyTrans', FALSE);
      $this->db->select('j.nama_lokasi as receipt_location', FALSE);
      $this->db->select('k.nama_lokasi as transfer_location', FALSE);
      $this->db->select('l.nama_lokasi as transfer_location_to', FALSE);
      $this->db->select('m.nama_lokasi as shipping_location', FALSE);
      $this->db->select('p.nama_lokasi as trans_to_nama_lokasi', FALSE);
      $this->db->select('c.description as desc_unit');
      $this->db->from('history a');
      $this->db->join('tabel_barang b','a.id_barang = b.id_barang','LEFT');
      $this->db->join('invent_unit c','a.unit_id = c.unit','LEFT');
      $this->db->join('detail_pembelian d','a.histo_id = d.id_beli','LEFT');
      $this->db->join('transfer_detail e','a.histo_id = e.id_trans','LEFT');
      $this->db->join('detail_pemakaian f','a.histo_id = f.id_pakai','LEFT');
      $this->db->join('header_pembelian g','d.pembelian_id = g.pembelian_id','LEFT');
      $this->db->join('transfer_header h','e.transfer_id = h.transfer_id','LEFT');
      $this->db->join('header_pemakaian i','f.pemakaian_id = i.pemakaian_id','LEFT');
      $this->db->join('m_lokasi j','g.id_lokasi = j.id_lokasi','LEFT');
      $this->db->join('m_lokasi k','h.location_from = k.id_lokasi','LEFT');
      $this->db->join('m_lokasi l','h.location_to = l.id_lokasi','LEFT');
      $this->db->join('m_lokasi m','i.location_from = m.id_lokasi','LEFT');
      $this->db->join('dt_user n','i.id_user = n.id_user','LEFT');
      $this->db->join('m_lokasi p','a.trans_to = p.id_lokasi','LEFT');
      $this->db->where('a.id_comp =',$comp);
      $this->db->order_by('a.inv_history_id','asc');

      $query = $this->db->get();
      return $query->result();
    }

    public function updateShipping($data ,$dataTrans ,$dataInvSum ,$id_lokasi ,$id_barang, $id_pakai)
    {

      $this->db->update('detail_pemakaian', $data, array('id_pakai' => $id_pakai));
      $this->db->insert('history',$dataTrans);
      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $id_lokasi));
      
      return TRUE;
    }

    public function cupdateShipping($data ,$dataTrans ,$dataInvSum ,$cid_lokasi ,$cid_barang, $cid_pakai)
    {

      $this->db->update('detail_pemakaian', $data, array('id_pakai' => $cid_pakai));
      $this->db->insert('history',$dataTrans);
      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $cid_barang, 'id_lokasi' => $cid_lokasi));
      
      return TRUE;
    }

    public function updateTransfer($data ,$dataInvSum ,$inv_history_id ,$id_lokasi ,$id_barang)
    {

      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $id_lokasi));
      $this->db->update('history', $data, array('inv_history_id' => $inv_history_id , 'status' => 'Open'));
      return TRUE;
    }

    public function updateTransferReceipt($data ,$dataInvSum ,$inv_history_id ,$id_lokasi ,$id_barang)
    {

      $this->db->update('stock_barang',$dataInvSum, array('id_barang' => $id_barang, 'id_lokasi' => $id_lokasi));
      $this->db->update('history', $data, array('inv_history_id' => $inv_history_id , 'status' => 'Posted'));
      return TRUE;
    }

    public function GetDeleteInvetItem()
    {
        $id_item = $this->input->post('id_item');

        $this->db->select('*');
        $this->db->from('history');
        $this->db->where('id_barang =',$id_item);
        $query = $this->db->get();
        $count = $query->num_rows();

        return $count;
    }

    public function GetTopReceipt()
    {
      $this->db->select_sum('history.qty');
      $this->db->select('tabel_barang.nama_barang');
      $this->db->from('history');
      $this->db->join('tabel_barang', 'tabel_barang.id_barang = history.id_barang', 'LEFT');
      $this->db->where('history.inv_status =','Receipt');
      $this->db->where('tabel_barang.group_barang','STO');
      $this->db->group_by('history.id_barang');
      $this->db->order_by('qty','desc');
      $this->db->limit(5);
      $query = $this->db->get();
      return $query->result();
    }
    public function GetTopReceiptSPR()
    {
      $this->db->select_sum('history.qty');
      $this->db->select('tabel_barang.nama_barang');
      $this->db->from('history');
      $this->db->join('tabel_barang', 'tabel_barang.id_barang = history.id_barang', 'LEFT');
      $this->db->where('history.inv_status =','Receipt');
      $this->db->where('tabel_barang.group_barang','SPR');
      $this->db->group_by('history.id_barang');
      $this->db->order_by('qty','desc');
      $this->db->limit(5);
      $query = $this->db->get();
      return $query->result();
    }

    public function GetTopUsed()
    {
      $this->db->select_sum('history.qty');
      $this->db->select('tabel_barang.nama_barang');
      $this->db->from('history');
      $this->db->join('tabel_barang', 'tabel_barang.id_barang = history.id_barang', 'LEFT');
      $this->db->where('history.inv_status =','Used');
      $this->db->where('tabel_barang.group_barang','STO');
      $this->db->group_by('history.id_barang');
      $this->db->order_by('qty','desc');
      $this->db->limit(5);
      $query = $this->db->get();
      return $query->result();
    }

    public function GetTopUsedSPR()
    {
      $this->db->select_sum('history.qty');
      $this->db->select('tabel_barang.nama_barang');
      $this->db->from('history');
      $this->db->join('tabel_barang', 'tabel_barang.id_barang = history.id_barang', 'LEFT');
      $this->db->where('history.inv_status =','Used');
      $this->db->where('tabel_barang.group_barang','SPR');
      $this->db->group_by('history.id_barang');
      $this->db->order_by('qty','desc');
      $this->db->limit(5);
      $query = $this->db->get();
      return $query->result();
    }

    public function GetTopTransfer()
    {
      $this->db->select_sum('history.qty');
      $this->db->select('tabel_barang.nama_barang');
      $this->db->from('history');
      $this->db->join('tabel_barang', 'tabel_barang.id_barang = history.id_barang', 'LEFT');
      $this->db->where('history.inv_status =','Transfer');
      $this->db->where('tabel_barang.group_barang','STO');
      $this->db->group_by('history.id_barang');
      $this->db->order_by('qty','desc');
      $this->db->limit(5);
      $query = $this->db->get();
      return $query->result();
    }

     public function GetTopTransferSPR()
    {
      $this->db->select_sum('history.qty');
      $this->db->select('tabel_barang.nama_barang');
      $this->db->from('history');
      $this->db->join('tabel_barang', 'tabel_barang.id_barang = history.id_barang', 'LEFT');
      $this->db->where('history.inv_status =','Transfer');
      $this->db->where('tabel_barang.group_barang','SPR');
      $this->db->group_by('history.id_barang');
      $this->db->order_by('qty','desc');
      $this->db->limit(5);
      $query = $this->db->get();
      return $query->result();
    }


    public function GetAllTransactionSingle($id_barang, $loc_id)
    {

      $this->db->select('*');
      $this->db->select('a.status as status_trans', FALSE);
      $this->db->select('a.qty as qtyTrans', FALSE);
      $this->db->select('j.nama_lokasi as receipt_location', FALSE);
      $this->db->select('k.nama_lokasi as transfer_location', FALSE);
      $this->db->select('l.nama_lokasi as transfer_location_to', FALSE);
      $this->db->select('m.nama_lokasi as shipping_location', FALSE);
      $this->db->select('p.nama_lokasi as trans_to_nama_lokasi', FALSE);
      $this->db->select('c.description as desc_unit');
      $this->db->from('history a');
      $this->db->join('tabel_barang b','a.id_barang = b.id_barang','LEFT');
      $this->db->join('invent_unit c','a.unit_id = c.unit','LEFT');
      $this->db->join('detail_pembelian d','a.histo_id = d.id_beli','LEFT');
      $this->db->join('transfer_detail e','a.histo_id = e.id_trans','LEFT');
      $this->db->join('detail_pemakaian f','a.histo_id = f.id_pakai','LEFT');
      $this->db->join('header_pembelian g','d.pembelian_id = g.pembelian_id','LEFT');
      $this->db->join('transfer_header h','e.transfer_id = h.transfer_id','LEFT');
      $this->db->join('header_pemakaian i','f.pemakaian_id = i.pemakaian_id','LEFT');
      $this->db->join('m_lokasi j','g.id_lokasi = j.id_lokasi','LEFT');
      $this->db->join('m_lokasi k','h.location_from = k.id_lokasi','LEFT');
      $this->db->join('m_lokasi l','h.location_to = l.id_lokasi','LEFT');
      $this->db->join('m_lokasi m','i.location_from = m.id_lokasi','LEFT');
      $this->db->join('dt_user n','i.id_user = n.id_user','LEFT');
      $this->db->join('m_lokasi p','a.trans_to = p.id_lokasi','LEFT');
      $this->db->where('a.id_barang =',$id_barang);
      $this->db->where('a.trans_from =',$loc_id);
      $this->db->or_where('a.id_barang =',$id_barang);
      $this->db->where('a.trans_to =',$loc_id);
      $this->db->order_by('a.inv_history_id','asc');

      $query = $this->db->get();
      return $query->result();
    }


}
