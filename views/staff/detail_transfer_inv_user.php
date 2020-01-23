        <script type="text/javascript">
          function validate(event) {
              var key = window.event ? event.keyCode : event.which;

            if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode >= 96 && event.keyCode <= 105) {
                return true;
            }
            else if ( key < 48 || key > 57 ) {
                return false;
            }
            else return true;
          };
        </script>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Transfer <small>Detail</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Management</a></li>
                  <li><a href="#">Inventory</a></li>
                  <li><a href="<?php echo base_url('index.php/Transfer_inv_user')?>">Transfer</a></li>
                  <li class="active">Detail Transfer</li>
                </ol>
              </div>
            </div>
            <div class="clearfix"></div>

            <?php foreach ($m_inventory_header as $header) {
                  $status = $header->status;
                  $id_transfer = $header->transfer_id;
                  $id_lokasi = $header->location_from;
                  $location_to = $header->location_to;
                } ?>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="row">
                      <div class="col-lg-6">
                        <?php if(empty($status) || $status == 'Open'): ?>
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#modal_add_transfer"><i class="fa fa-plus"></i></button><b> Item</b>
                        <?php else: ?>
                          <h3>View <small>Transfer Detail</small></h3>
                        <?php endif; ?>
                      </div>
                      <div class="text-right col-lg-6">
                        <button type="button" class="btn btn-default btn-lrg ajax" title="Refresh" onclick="location.reload()">
                          <i class="fa fa-spin fa-refresh"></i></button>
                            <script type="text/javascript">
                               function reload(){
                                location.reload();
                               }
                            </script>
                        <button type="button" class="btn btn-primary btn-lrg ajax" title="Help"><i class="fa fa-question-circle"></i></button>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>

                <!-- modal add new receipt -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal_add_transfer" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">New Item</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv_user/tambahDetail')?>" method="post" enctype="multipart/form-data" role="form">

                            <div class="modal-body">
                              <div class="row">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="category" name="category" onchange="selectitem()" required="category">
                                      <option value="">Select Category</option>
                                      <?php foreach ($m_category as $category): ?>
                                        <option value="<?php echo $category->id_kategori;?>"><?php echo $category->category_name?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="itemId" name="id_barang"  required="id_barang">
                                      <option value="">Select Item</option>
                                      <?php foreach ($m_invent_item as $item): ?>
                                        <option value="<?php echo $item->id_barang;?>"><?php echo $item->nama_barang?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" name="unitId" id="unitId" required="unitId">
                                      <option value="">Select Unit</option>
                                      <?php foreach ($m_invent_unit as $unit): ?>
                                        <option value="<?php echo $unit->unit;?>"><?php echo $unit->unit?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>
                                <input type="hidden" value="<?php echo $id_transfer; ?>" name="transfer_id">
                                <input type="hidden" value="<?php echo $id_lokasi; ?>" name="location_id">
                                <input type="hidden" value="<?php echo $location_to; ?>" name="location_to">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="form-control" onkeypress="return validate(event);" name="qty" placeholder="Quantity" required="qty">
                                  <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                                </div>

                              </div>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <textarea class="form-control" type="text" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
                                  </div>
                                </div>
                              </div>
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
                    <?php if(empty($status) || $status == 'Open' || $status == 'Shipping'): ?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="success">
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Unit</th>
                          <th>Trans Date</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($m_transfer as $transfer): ?>
                        <tr>
                          <td><?php echo $transfer->nama_barang; ?></td>
                          <td><?php echo $transfer->qty; ?></td>
                          <td><?php echo $transfer->unit; ?></td>
                          <td><?php echo $transfer->transfer_date; ?></td>
                          <td><?php echo $transfer->description; ?></td>
                          <td><?php echo $transfer->status; ?></td>
                          <td class="text-center">
                          <?php if($transfer->status == 'Open'): ?>
                            <a id="edit_detail" data-toggle="modal" data-target="#myModaleditDetail" data-id="<?php echo $transfer->id_trans;?>" data-name="<?php echo $transfer->id_barang;?>" data-qty="<?php echo $transfer->qty;?>" data-unit="<?php echo $transfer->unit;?>" data-date="<?php echo $transfer->transfer_date;?>" data-transfer="<?php echo $transfer->transfer_id;?>" data-status="<?php echo $transfer->status;?>" data-desc="<?php echo $transfer->description;?>">
                              <button class="btn btn-info"><i class="fa fa-pencil"></i></button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $transfer->id_trans;?>" data-trans="<?php echo $transfer->transfer_id;?>">
                              <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </a>
                          <?php else: ?>
                            <a id="edit_detail" data-toggle="modal" data-target="#myModaleditDetailPosting" data-id="<?php echo $transfer->id_trans;?>" data-name="<?php echo $transfer->id_barang;?>" data-qty="<?php echo $transfer->qty;?>" data-unit="<?php echo $transfer->unit;?>" data-date="<?php echo $transfer->transfer_date;?>" data-transfer="<?php echo $transfer->transfer_id;?>" data-status="<?php echo $transfer->status;?>" data-desc="<?php echo $transfer->description;?>">
                              <button class="btn btn-info"><i class="fa fa-pencil"></i></button>
                            </a>

                            <a href="#" title="Click to Barcode" disabled="disabled" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                      </tbody>
                    </table>

                      <?php if($m_inventory_detail > 0 && $status == 'Open'): ?>
                        <a id="post_detail" data-toggle="modal" data-target="#myModalPost" data-transfer="<?php echo $id_transfer;?>">
                          <button class="btn btn-primary"><i class="fa fa-save"></i> Post</button>
                        </a>
                      <?php else: ?>
                      <?php endif; ?>

                      <?php if($status == 'Shipping'): ?>
                        <a id="post_detail" data-toggle="modal" data-target="#myModalPostReceipt" data-transfer="<?php echo $id_transfer;?>">
                          <button class="btn btn-primary"><i class="fa fa-save"></i> Receipt</button>
                        </a>
                      <?php else: ?>
                      <?php endif; ?>

                    <?php else: ?>

                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="success">
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Unit</th>
                          <th>Trans Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($m_transfer as $transfer): ?>
                        <tr>
                          <td><?php echo $transfer->nama_barang; ?></td>
                          <td><?php echo $transfer->qty; ?></td>
                          <td><?php echo $transfer->unit; ?></td>
                          <td><?php echo $transfer->transfer_date; ?></td>
                          <td><?php echo $transfer->status; ?></td>
                        </tr>
                      <?php endforeach ?>
                      </tbody>
                    </table>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->

        <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <!-- <script type="text/javascript">
          function selectitem()
              {
                 var itemId = $('#itemId').val();
                  
                  $.post('<?php echo base_url();?>index.php/transfer/GetItemMaster/',
                {
                  itemId:itemId
                  
                  },
                  function(data) 
                  {
                  
                  $('#unitId').html(data);
                  }); 
               
              }   
        </script> -->

         <script type="text/javascript">

            $(document).ready(function(){
              $("#category").change(function(){
                var category = $(this).val();
                var dataString = 'category='+category;
                $.ajax({
                  type:"POST",
                  url:"<?php echo base_url();?>index.php/Transfer_inv_user/GetCategoryItem/",
                  data:dataString,
                  cache:false,
                 success:function(data){
                    $("#itemId").html(data);
                  }
                });
              });
            });

            $(document).ready(function(){
              $("#itemId").change(function(){
                var itemId = $(this).val();
                var dataString = 'itemId='+itemId;
                $.ajax({
                  type:"POST",
                  url:"<?php echo base_url();?>index.php/Transfer_inv_user/GetItemMaster/",
                  data:dataString,
                  cache:false,
                 success:function(data){
                    $("#unitId").html(data);
                  }
                });
              });
            });

            $(document).ready(function(){
              $("#itemId").change(function(){
                var itemId = $(this).val();
                var dataString = 'itemId='+itemId;
                $.ajax({
                  type:"POST",
                  url:"<?php echo base_url();?>index.php/Transfer_inv_user/GetItemCategoryMaster/",
                  data:dataString,
                  cache:false,
                 success:function(data){
                    $("#category").html(data);
                  }
                });
              });
            });
          </script>
        <!-- modal edit detail transfer -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModaleditDetail" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Transfer Detail</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv_user/editInvTrans')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="id_barang" name="id_barang">
                                  <option value="">Select Item</option>
                                  <?php foreach ($m_invent_item as $item): ?>
                                    <option value="<?php echo $item->id_barang;?>"><?php echo $item->nama_barang?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center" id="qty" name="qty" onkeypress="return validate(event);" placeholder="Quantity" required="qty">
                              <span class="fa fa-gg form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" name="unit_id" id="unit_id" required="unit_id">
                                  <option value="">Select Unit</option>
                                  <?php foreach ($m_invent_unit as $invUnit): ?>
                                    <option value="<?php echo $invUnit->unit;?>"><?php echo $invUnit->unit?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-lg-12">
                              <div class="form-group">
                                <textarea class="form-control" type="text" id="desc" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
                              </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left" disabled="disabled" id="inv_status" name="inv_status" placeholder="Status" required="inv_status">
                              <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center" disabled="disabled" id="history_date" name="history_date" placeholder="Trans Date" required="history_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <input type="hidden" id="id_inv" name="id_inv">
                            <input type="hidden" id="transfer_id" name="transfer_id">

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
                  $(document).on("click","#edit_detail", function() {
                    var id_inv      =  $(this).data('id');
                    var transfer_id =  $(this).data('transfer');
                    var id_barang     =  $(this).data('name');
                    var qty         =  $(this).data('qty');
                    var unit_id     =  $(this).data('unit');
                    var history_date  =  $(this).data('date');
                    var inv_status  =  $(this).data('status');
                    var desc        =  $(this).data('desc');
                    $("#modal-edit #id_inv").val(id_inv);
                    $("#modal-edit #transfer_id").val(transfer_id);
                    $("#modal-edit #id_barang").val(id_barang);
                    $("#modal-edit #qty").val(qty);
                    $("#modal-edit #unit_id").val(unit_id);
                    $("#modal-edit #history_date").val(history_date);
                    $("#modal-edit #inv_status").val(inv_status);
                    $("#modal-edit #desc").val(desc);
                  })
                </script>
          </div>
        <!--end modal edit detail transfer-->

        <!-- modal posting detail transfer -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModaleditDetailPosting" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">View Transfer Detail</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv_user/editInvTrans')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" disabled="disabled" id="id_barang" name="id_barang">
                                  <option value="">Select Item</option>
                                  <?php foreach ($m_invent_item as $item): ?>
                                    <option value="<?php echo $item->id_barang;?>"><?php echo $item->nama_barang?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center" disabled="disabled" id="qty" name="qty" onkeypress="return validate(event);" placeholder="Quantity" required="qty">
                              <span class="fa fa-gg form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <div class="col-lg-12">
                              <div class="form-group">
                                <textarea class="form-control" type="text" disabled="disabled" id="desc" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
                              </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left" disabled="disabled" id="unit_id" name="unit_id" placeholder="Unit" required="unit_id">
                              <span class="fa fa-server form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center" disabled="disabled" id="history_date" name="history_date" placeholder="Trans Date" required="history_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <input type="hidden" id="id_inv" name="id_inv">
                            <input type="hidden" id="transfer_id" name="transfer_id">

                          </div>
                        </div>  
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        </div>
                          </form>
                      </div>
                  </div>
              </div>
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#edit_detail", function() {
                    var id_inv      =  $(this).data('id');
                    var transfer_id =  $(this).data('transfer');
                    var id_barang     =  $(this).data('name');
                    var qty         =  $(this).data('qty');
                    var unit_id     =  $(this).data('unit');
                    var history_date  =  $(this).data('date');
                    var inv_status  =  $(this).data('status');
                    var desc        =  $(this).data('desc');
                    $("#modal-edit #id_inv").val(id_inv);
                    $("#modal-edit #transfer_id").val(transfer_id);
                    $("#modal-edit #id_barang").val(id_barang);
                    $("#modal-edit #qty").val(qty);
                    $("#modal-edit #unit_id").val(unit_id);
                    $("#modal-edit #history_date").val(history_date);
                    $("#modal-edit #inv_status").val(inv_status);
                    $("#modal-edit #desc").val(desc);
                  })
                </script>
          </div>
        <!--end modal posting detail transfer-->

        <!-- modal post shipping detail transfer -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalPost" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Post Shipping Transfer</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv_user/post')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <input type="hidden" id="transfer_id" name="transfer_id">
                            <div class="alert alert-info">
                              <p><h5>Are you sure you want to Post Shipping Transfer from Inventory you check?.</h5></p>
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
                  $(document).on("click","#post_detail", function() {
                    var transfer_id  =  $(this).data('transfer');
                    $("#modal-edit #transfer_id").val(transfer_id);
                  })
                </script>
          </div>
        <!--end modal post shipping detail Transfer-->

        <!-- modal post receipt detail transfer -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalPostReceipt" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Post Receipt Transfer</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv_user/postReceipt')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <input type="hidden" id="transfer_id" name="transfer_id">
                            <div class="alert alert-info">
                              <p><h5>Are you sure you want to Post Receipt Transfer from Inventory you check?.</h5></p>
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
                  $(document).on("click","#post_detail", function() {
                    var transfer_id  =  $(this).data('transfer');
                    $("#modal-edit #transfer_id").val(transfer_id);
                  })
                </script>
          </div>
        <!--end modal post receipt detail Transfer-->

        <!-- modal Delete transfer -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Transfer Detail</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv_user/deleteDetail')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_trans" name="id_trans">
                            <input type="hidden" id="transfer_id" name="transfer_id">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Transfer Detail you check?.</p>
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
                  $(document).on("click","#delete", function() {
                    var id_trans        =  $(this).data('id');
                     var transfer_id        =  $(this).data('trans');
                    $("#modal-delete #id_trans").val(id_trans);
                    $("#modal-delete #transfer_id").val(transfer_id);
                  })
                </script>
          </div>
        <!--end modal Delete tarasnfer-->

