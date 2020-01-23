<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_item_inv extends CI_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->model('M_category');
        $this->load->model('M_group_barang');
    }

        public function index()
        {
                $data['m_category'] = $this->M_category->GetAllCategory();
                $data['m_group_barang'] = $this->M_group_barang->get_group_barang_query();
                $this->template->load('logistic/Static_inv','logistic/category_item_inv',$data);
        }

       public function tambah()
        {
                $id_comp = $this->session->userdata('comp');
                // $group_barang = $this->input->post('group_barang');

                // $count = $this->m_category->GetCountCategoryItem() + 1;

                // $id_kategori = $group_barang.".".$count;

                $data = array(
                        'id_kategori'   => strtoupper($this->input->post('id_kategori')),
                        'nama_kategori' => strtoupper($this->input->post('nama_kategori')),
                        'id_group_barang' => $this->input->post('group_barang'),
                        'delete_status' => '0',
                        'id_comp'       => $id_comp
                );

                if ($this->M_category->GetCountCategory() > 0) {
                        $this->session->set_flashdata('notif','<div class="alert alert-danger" role="alert"> Category ID Already Exists <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('category_item_inv');
                }else{
                        $this->M_category->tambah($data);
                        $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Add Category Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('category_item_inv');
                }
        }

        public function update()
        {
                // $id_kategori = $this->input->post('id_kategori');
                
                // $data = array(
                //         'nama_kategori' => strtoupper($this->input->post('nama_kategori')),
                //         'id_group_barang' => $this->input->post('group_barang'),
                //         'id_kategori' => $this->input->post('id_kategori')
                // );

                // $id = $this->input->post('id');
                // $GetCategory = $this->M_category->GetSingleCategory($id);

                // foreach ($GetCategory as $category) {
                // $GCategory = $category->id_kategori;
                // }

                // if ($GCategory == $id_kategori) {
                //         $this->M_category->update(array('id' => $this->input->post('id')),$data);
                //         $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Update Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                //         redirect('kategori_barang');

                // }else if ($this->M_category->GetCountCategoryValidasi($GCategory) > 0) {
                //         $this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Cannot Edit, Category Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                //         redirect('kategori_barang');
                // }
            $data = array(
            'nama_kategori' => strtoupper($this->input->post('nama_kategori')),
            'id_group_barang' => $this->input->post('group_barang'),
            'id_kategori' => $this->input->post('id_kategori')

        );

            $this->M_category->update(array('id' => $this->input->post('id')),$data);
                 $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Update Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
               redirect('category_item_inv');

        redirect('category_item_inv');
    
    
        }

        public function delete()
        {
                $GCategory = $this->input->post('id_kategori');

                $countCategory = $this->M_category->GetCountCategoryValidasi($GCategory);

                if ($countCategory > 0) {
                        $this->session->set_flashdata('notif','<div class="alert alert-warning" role="alert"> Cannot Delete, Category Item Still Exists in Another Transaction <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('kategori_barang');
                }else{
                        $data = array(
                                'delete_status'         => '1'
                        );

                        $this->M_category->update(array('id' => $this->input->post('id')), $data);
                        $this->session->set_flashdata('notif','<div class="alert alert-success" role="alert"> Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('category_item_inv');
                }
        }
}
