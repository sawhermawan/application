        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inventory <small>Order</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Management</a></li>
                  <li><a href="#">Inventory</a></li>
                  <li class="active">Order</li>
                </ol>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="row">
                      <div class="col-lg-6">
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalReceipt"><i class="fa fa-plus"></i></button><b>Order</b>
                      </div>

                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                <!-- modal add new receipt -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalReceipt" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">New Order</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/pembelian/tambah')?>" method="post" enctype="multipart/form-data" role="form">

                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control has-feedback-left" name="pembelian_date" id="pembelian_date" placeholder="Receipt Date" required="pembelian_date">
                                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                  <!-- <select class="text-center form-control" name="id_lokasi" required="id_lokasi">
                                      <option value="">Select Location</option>
                                      <?php foreach ($m_lokasi as $loc): ?>
                                        <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->nama_lokasi?></option>
                                      <?php endforeach ?>
                                    </select> -->

                                    <select id="basic" class="selectpicker show-tick form-control" name="id_lokasi" required="id_lokasi" data-live-search="true">
                                      <option value="">Pilih Lokasi</option>
                                      <?php foreach ($m_lokasi as $loc): ?>
                                        <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->nama_lokasi?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control has-feedback-left" name="no_po_ax" placeholder="No PO " required="no_po_ax">
                                  <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control" name="no_product_receipt_ax" placeholder="No Product Receipt " required="no_product_receipt_ax">
                                  <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                                </div>

                               <!--  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control has-feedback-left" name="receipt_ax_date" id="receipt_ax_date" placeholder="AX Date" required="receipt_ax_date">
                                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>
 -->
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                  <select id="basic" class="selectpicker show-tick form-control" name="receipt_type" required="receipt_type" data-live-search="true">
                                      <option value="Order">Order</option>
                                      <option value="Return">Return</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select id="basic" class="selectpicker show-tick form-control" name="id_suplayer" required="id_suplayer" data-live-search="true">
                                      <option value="">Pilih Suplayer</option>
                                      <?php foreach ($m_suplayer as $sup): ?>
                                        <option value="<?php echo $sup->id_suplayer;?>"><?php echo $sup->nama_suplayer?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                  <select name="group_barang" class="text-center form-control" required>
                                        <option value="">Pilih Group Barang</option>
                                      <?php foreach ($m_group_barang as $group): ?>
                                        <option value="<?php echo $group->group_id;?>"><?php echo $group->group_barang;?></option>
                                      <?php endforeach ?>
                                  </select>
                                </div>

                              </div>
                              <!-- <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <textarea class="form-control" type="text" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
                                  </div>
                                </div>
                              </div> -->
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end modal add new receipt-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>No</th>
                          <th>ID Pembelian</th>
                          <th>No PO</th>
                          <th>Tgl Pembelian</th>
                          <th style="width: 20%">Suplayer</th>
                          <th>Location</th>
                          <th>Order/Return</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 0; ?>
                        <?php foreach ($m_receipt as $rec): ?>
                        <?php $no++; ?>
                          <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $rec->pembelian_id;?></td>
                          <td><?php echo $rec->no_po_ax;?></td>
                          <td><?php echo $rec->pembelian_date;?></td>
                           <td><?php echo $rec->nama_suplayer;?></td>                          <!-- <td>
                            <?php 
                              $rec_desc =  $rec->nama_suplayer;
                              $rec_desc = substr($rec_desc, 0, 60);
                              echo $rec_desc;
                            ?>
                          </td> --> 
                          <td><?php echo $rec->nama_lokasi;?></td>
                          <td><?php echo $rec->receipt_type;?></td>
                          <td><?php echo $rec->status;?></td>
                          <td class="text-center">
                            <?php if($rec->status == 'Open'): ?>
                              <a id="edit" title="Click to Edit" data-toggle="modal" data-target="#myModalEditReceipt" data-id="<?php echo $rec->id;?>" data-rec="<?php echo $rec->pembelian_id;?>" data-rdate="<?php echo $rec->pembelian_date;?>" data-location="<?php echo $rec->id_lokasi;?>" data-noax="<?php echo $rec->no_po_ax;?>" data-axr="<?php echo $rec->no_product_receipt_ax;?>" data-axdate="<?php echo $rec->receipt_ax_date;?>" data-desc="<?php echo $rec->description;?>" data-group="<?php echo $rec->group_barang;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a>

                              <a href="<?php echo base_url('index.php/pembelian/view/'.$rec->pembelian_id)?>" title="Click to View Detail" class="btn btn-info"><i class="fa fa-eye"></i></a>

                              <a href="<?php echo base_url('index.php/pembelian/cetak/'.$rec->pembelian_id)?>" title="Click to Print" class="btn btn-dark"><i class="fa fa-print"></i></a>
                              <a id="delete" title="Click to Delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $rec->id;?>" data-rec="<?php echo $rec->pembelian_id;?>">
                              <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </a>
                            <?php else: ?>
                              <a id="edit" title="Click to Edit" data-toggle="modal" data-target="#myModalEditReceiptPosted" data-id="<?php echo $rec->id;?>" data-rec="<?php echo $rec->pembelian_id;?>" data-rdate="<?php echo $rec->pembelian_date;?>" data-location="<?php echo $rec->id_lokasi;?>" data-noax="<?php echo $rec->no_po_ax;?>" data-axr="<?php echo $rec->no_product_receipt_ax;?>" data-axdate="<?php echo $rec->receipt_ax_date;?>" data-desc="<?php echo $rec->description;?>" data-group="<?php echo $rec->group_barang;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a>

                              <a href="<?php echo base_url('index.php/pembelian/view/'.$rec->pembelian_id)?>" title="Click to View Detail" class="btn btn-info"><i class="fa fa-eye"></i></a>
                              
                              <a href="<?php echo base_url('index.php/pembelian/cetak/'.$rec->pembelian_id)?>" title="Click to Print" class="btn btn-dark"><i class="fa fa-print"></i></a>
                              <a id="delete" title="Click to Delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $rec->id;?>" data-rec="<?php echo $rec->pembelian_id;?>">
                              <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </a>
                              
                            <?php endif; ?>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
          <script type="text/javascript">
            $(document).ready(function(){
              var table = $('#datatable-checkbox').DataTables({
                "order":[
                  [0,"desc"],
                ]
              })
            })
            
          </script>
        <!-- /page content -->

        <!-- modal edit receipt -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditReceipt" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Order</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/pembelian/edit')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left"  id="pembelian_id" name="pembelian_id" placeholder="Receipt ID" required="pembelian_id">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                              <select id="id_lokasi" name="id_lokasi" required="id_lokasi" class="selectpicker show-tick form-control" data-live-search="true">
                                  <option value="">Select Location</option>
                                  <?php foreach ($m_lokasi as $loc): ?>
                                    <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->nama_lokasi?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" name="pembelian_date" id="rdate" placeholder="Receipt Date" required="pembelian_date">
                              <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control" id="no_po_ax" name="no_po_ax" placeholder="No PO " required="no_po_ax">
                              <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" id="no_product_receipt_ax" name="no_product_receipt_ax" placeholder="No Product Order " required="no_product_receipt_ax">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control" name="receipt_ax_date" id="ax_date" placeholder="Order Date" required="receipt_ax_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" id="id" name="id">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <select name="group_barang" id="group_barang" class="text-center form-control" required>
                                    <option value="">Select Item Group</option>
                                  <?php foreach ($m_group_barang as $group): ?>
                                    <option value="<?php echo $group->group_id;?>"><?php echo $group->group_barang;?></option>
                                  <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                          <!-- <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <textarea class="form-control" type="text" id="desc" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
                              </div>
                            </div>
                          </div> -->
                        </div>  
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        </div>
                          </form>
                      </div>
                  </div>
              </div>
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#edit", function() {
                    var id                    =  $(this).data('id');
                    var pembelian_id            =  $(this).data('rec');
                    var rdate                 =  $(this).data('rdate');
                    var id_lokasi           =  $(this).data('location');
                    var no_po_ax              =  $(this).data('noax');
                    var no_product_receipt_ax =  $(this).data('axr');
                    // var ax_date               =  $(this).data('axdate');
                    var desc                  =  $(this).data('desc');
                    var group_barang            =  $(this).data('group');
                    $("#modal-edit #id").val(id);
                    $("#modal-edit #pembelian_id").val(pembelian_id);
                    $("#modal-edit #rdate").val(rdate);
                    $('#modal-edit #id_lokasi').selectpicker('val',id_lokasi);
                    $("#modal-edit #no_po_ax").val(no_po_ax);
                    $("#modal-edit #no_product_receipt_ax").val(no_product_receipt_ax);
                    // $("#modal-edit #ax_date").val(ax_date);
                    $("#modal-edit #desc").val(desc);
                    $("#modal-edit #group_barang").val(group_barang);
                  })
                </script>
          </div>
        <!--end modal edit receipt-->

        <!-- modal edit receipt Posted -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditReceiptPosted" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Order</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/pembelian/edit')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left"  id="pembelian_id" name="pembelian_id" placeholder="Receipt ID" required="pembelian_id">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="id_lokasi"  name="id_lokasi" required="id_lokasi">
                                  <option value="">Select Location</option>
                                  <?php foreach ($m_lokasi as $loc): ?>
                                    <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->nama_lokasi?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left"  name="pembelian_date" id="rdate" placeholder="Receipt Date" required="pembelian_date">
                              <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control" id="no_po_ax"  name="no_po_ax" placeholder="No PO " required="no_po_ax">
                              <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left"  id="no_product_receipt_ax" name="no_product_receipt_ax" placeholder="No Product Receipt " required="no_product_receipt_ax">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control" name="receipt_ax_date"  id="ax_date" placeholder="AX Date" required="receipt_ax_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div> -->
                            <input type="hidden" id="id" name="id">

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <select name="group_barang" id="group_barang" class="text-center form-control" required>
                                    <option value="">Select Item Group</option>
                                  <?php foreach ($m_group_barang as $group): ?>
                                    <option value="<?php echo $group->group_id;?>"><?php echo $group->group_barang;?></option>
                                  <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                          <!-- <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <textarea class="form-control" type="text" id="desc" name="desc" rows="3"  placeholder="Description" style="resize: none;"></textarea>
                              </div>
                            </div>
                          </div> -->
                        </div>  
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        </div>
                          </form>
                      </div>
                  </div>
              </div>
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#edit", function() {
                    var id                    =  $(this).data('id');
                    var pembelian_id            =  $(this).data('rec');
                    var rdate                 =  $(this).data('rdate');
                    var id_lokasi           =  $(this).data('location');
                    var no_po_ax              =  $(this).data('noax');
                    var no_product_receipt_ax =  $(this).data('axr');
                    var ax_date               =  $(this).data('axdate');
                    var desc                  =  $(this).data('desc');
                    var group_barang            =  $(this).data('group');
                    $("#modal-edit #id").val(id);
                    $("#modal-edit #pembelian_id").val(pembelian_id);
                    $("#modal-edit #rdate").val(rdate);
                    $("#modal-edit #id_lokasi").val(id_lokasi);
                    $("#modal-edit #no_po_ax").val(no_po_ax);
                    $("#modal-edit #no_product_receipt_ax").val(no_product_receipt_ax);
                    $("#modal-edit #ax_date").val(ax_date);
                    $("#modal-edit #desc").val(desc);
                    $("#modal-edit #group_barang").val(group_barang);
                  })
                </script>
          </div>
        <!--end modal edit receipt Posted-->

        <!-- modal Delete Receipt -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Order</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/pembelian/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_receipt" name="id_receipt">
                            <input type="hidden" id="rec_id" name="rec_id">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Receipt you check?.</p>
                            </div>

                          </div>
                        </div>  
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> No</button>
                        </div>
                          </form>
                      </div>
                  </div>
              </div>
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#delete", function() {
                    var id_receipt        =  $(this).data('id');
                    var rec_id        =  $(this).data('rec');
                    $("#modal-delete #id_receipt").val(id_receipt);
                    $("#modal-delete #rec_id").val(rec_id);
                  })
                </script>
          </div>
        <!--end modal Delete Receipt-->