        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inventory <small>Receipt</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Management</a></li>
                  <li><a href="<?php echo base_url('index.php/All_transaction')?>">All Transaction</a></li>
                  <li class="active">Receipt</li>
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
                      </div>
                      <div class="text-right col-lg-6">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>Receipt ID</th>
                          <th>No PO AX</th>
                          <th>Receipt Date</th>
                          <!-- <th style="width: 20%">Description</th> -->
                          <th>Location</th>
                          <th>Pembelian/Pengembalian</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($m_receipt as $rec): ?>
                          <tr>
                          <td><?php echo $rec->pembelian_id;?></td>
                          <td><?php echo $rec->no_po_ax;?></td>
                          <td><?php echo $rec->pembelian_date;?></td>
                          <!-- <td>
                            <?php 
                              $rec_desc =  $rec->description;
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

                              <a href="<?php echo base_url('index.php/Pembelian/view/'.$rec->pembelian_id)?>" title="Click to View Detail" class="btn btn-info"><i class="fa fa-eye"></i></a>

                              <a href="<?php echo base_url('index.php/Pembelian/cetak/'.$rec->pembelian_id)?>" title="Click to Print" class="btn btn-dark"><i class="fa fa-print"></i></a>
                              <a id="delete" title="Click to Delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $rec->id;?>" data-rec="<?php echo $rec->pembelian_id;?>">
                              <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </a>
                            <?php else: ?>
                              <a id="edit" title="Click to Edit" data-toggle="modal" data-target="#myModalEditReceiptPosted" data-id="<?php echo $rec->id;?>" data-rec="<?php echo $rec->pembelian_id;?>" data-rdate="<?php echo $rec->pembelian_date;?>" data-location="<?php echo $rec->id_lokasi;?>" data-noax="<?php echo $rec->no_po_ax;?>" data-axr="<?php echo $rec->no_product_receipt_ax;?>" data-axdate="<?php echo $rec->receipt_ax_date;?>" data-desc="<?php echo $rec->description;?>" data-group="<?php echo $rec->group_barang;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a>

                              <a href="<?php echo base_url('index.php/Pembelian/view/'.$rec->pembelian_id)?>" title="Click to View Detail" class="btn btn-info"><i class="fa fa-eye"></i></a>
                              
                              <a href="<?php echo base_url('index.php/Pembelian/cetak/'.$rec->pembelian_id)?>" title="Click to Print" class="btn btn-dark"><i class="fa fa-print"></i></a>
                              <a href="#" title="Click to Delete"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
                          <h4 class="modal-title">Edit Receipt</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Pembelian/edit')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left"  id="pembelian_id" name="pembelian_id" placeholder="Receipt ID" required="pembelian_id">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="id_lokasi" name="id_lokasi" required="id_lokasi">
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
                              <input type="text" class="text-center form-control" id="no_po_ax" name="no_po_ax" placeholder="No PO AX" required="no_po_ax">
                              <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" id="no_product_receipt_ax" name="no_product_receipt_ax" placeholder="No Product Receipt " required="no_product_receipt_ax">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control" name="receipt_ax_date" id="ax_date" placeholder="AX Date" required="receipt_ax_date">
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
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <textarea class="form-control" type="text" id="desc" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
                              </div>
                            </div>
                          </div>
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
        <!--end modal edit receipt-->

        <!-- modal edit receipt Posted -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditReceiptPosted" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Receipt</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Pembelian/edit')?>" method="post" enctype="multipart/form-data" role="form">
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
                              <input type="text" class="text-center form-control" id="no_po_ax" name="no_po_ax" placeholder="No PO AX" required="no_po_ax">
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
                              <select name="group_barang" id="group_barang"  class="text-center form-control" required>
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
                                <textarea class="form-control" type="text" id="desc" name="desc" rows="3" disabled="disabled" placeholder="Description" style="resize: none;"></textarea>
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
                          <h4 class="modal-title">Delete Receipt</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Pembelian/delete')?>" method="post" enctype="multipart/form-data" role="form">
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