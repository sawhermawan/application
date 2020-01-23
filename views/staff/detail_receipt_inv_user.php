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
                <h3>Receipt <small>Detail</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Management</a></li>
                  <li><a href="#">Inventory</a></li>
                  <li><a href="<?php echo base_url('index.php/Receipt_inv_user')?>">Receipt</a></li>
                  <li class="active">Detail Receipt</li>
                </ol>
              </div>
            </div>
            <div class="clearfix"></div>

            <?php foreach ($m_inventory_header as $header) {
              $status = $header->status;
              $id_receipt = $header->pembelian_id;
            } ?>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="row">
                      <div class="col-lg-6">
                        <?php if(empty($status) || $status == 'Open'): ?>
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#modal_add_receipt"><i class="fa fa-plus"></i></button><b> Item</b>
                        <?php else: ?>
                          <h3>View <small>Receipt Detail</small></h3>
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
                <!-- modal add new item -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal_add_receipt" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">New Item</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Receipt_inv_user/tambahDetail')?>" method="post" enctype="multipart/form-data" role="form">

                            <div class="modal-body">
                              <div class="row">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="category" name="category" onchange="selectitem()" required="category">
                                      <option value="">Select Category</option>
                                      <?php foreach ($m_category as $category): ?>
                                        <option value="<?php echo $category->id_kategori;?>"><?php echo $category->nama_kategori?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="itemId" name="id_barang" required="id_barang">
                                      <option value="">Select Item</option>
                                      <?php foreach ($m_invent_item as $item): ?>
                                        <option value="<?php echo $item->id_barang;?>"><?php echo $item->nama_barang?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>
                                <input type="hidden" value="<?php echo $id_receipt; ?>" name="pembelian_id">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" name="unitId" id="unitId" required="unitId">
                                      <option value="">Select Unit</option>
                                      <?php foreach ($m_invent_unit as $invUnit): ?>
                                        <option value="<?php echo $invUnit->unit;?>"><?php echo $invUnit->unit?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="form-control" onkeypress="return validate(event);" name="qty" placeholder="Quantity" required="qty">
                                  <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                                </div>

                              </div>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <textarea class="form-control" type="text" name="invoice" rows="3" placeholder="No SJ / Invoice" style="resize: none;"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" id="submitModal" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end modal add new item-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <?php if(empty($status) || $status == 'Open'): ?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="success">
                          <th>No</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Unit</th>
                          <th>No SJ / Invoice</th>
                          <th>Trans Date</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=0; ?>
                        <?php foreach ($m_receipt as $rece): ?>
                          <?php $no++; ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                          <td><?php echo $rece->nama_barang;?></td>
                          <td><?php echo $rece->qty;?></td>
                          <td><?php echo $rece->unit;?></td>
                          <td><?php echo $rece->invoice;?></td>
                          <td><?php echo $rece->pembelian_date;?></td>
                          <td><?php echo $rece->status;?></td>
                          <td class="text-center">
                            <a id="edit_detail" data-toggle="modal" data-target="#myModaleditDetail" data-id="<?php echo $rece->id_beli;?>" data-name="<?php echo $rece->id_barang;?>" data-qty="<?php echo $rece->qty;?>" data-unit="<?php echo $rece->unit;?>" data-date="<?php echo $rece->pembelian_date;?>" data-receipt="<?php echo $rece->pembelian_id;?>" data-status="<?php echo $rece->status;?>" data-inv="<?php echo $rece->invoice;?>">
                              <button class="btn btn-info"><i class="fa fa-pencil"></i></button>
                            </a>
                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $rece->id_beli;?>" data-rec="<?php echo $rece->pembelian_id;?>">
                              <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </a>
                            <a id="post1" data-toggle="modal" data-target="#myModalPost1" data-id="<?php echo $rece->id;?>" data-rec="<?php echo $rece->pembelian_id;?>">
                              <button class="btn btn-success"><i class="fa fa-save"></i></button>
                            </a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                      <?php if($m_inventory_detail > 0): ?>
                        <a id="post_detail" data-toggle="modal" data-target="#myModalPost" data-receipt="<?php echo $id_receipt;?>">
                          <button class="btn btn-primary"><i class="fa fa-save"></i> Post</button>
                        </a>
                      <?php else: ?>
                      <?php endif; ?>
                    <?php else: ?>

                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="success">
                          <th>No</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Unit</th>
                          <th>No SJ / Invoice</th>
                          <th>Trans Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=0; ?>
                        <?php foreach ($m_receipt as $rece): ?>
                          <?php $no++; ?>
                          <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $rece->nama_barang;?></td>
                          <td><?php echo $rece->qty;?></td>
                          <td><?php echo $rece->unit;?></td>
                          <td><?php echo $rece->invoice;?></td>
                          <td><?php echo $rece->pembelian_date;?></td>
                          <td><?php echo $rece->status;?></td>
                          <td><a href="<?php echo base_url('index.php/Receipt_inv_user')?>" >
                              <button class="btn btn-square"><i class="fa fa-arrow-circle-left">   Back</i></button>
                            </a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
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
       <!--  <script type="text/javascript">
          function selectitem()
              {
                 var itemId = $('#itemId').val();
                  
                  $.post('<?php echo base_url();?>index.php/receipt/GetItemMaster/',
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
                  url:"<?php echo base_url();?>index.php/Receipt_inv_user/GetCategoryItem/",
                  data:dataString,
                  cache:false,
                 success:function(data){
                    $("#itemId").html(data);
                  //   $.ajax({
                  //     type:"POST",
                  //     url:"<?php echo base_url();?>index.php/all_asset/GetItemMaster/",
                  //     data:dataString,
                  //     cache:false,
                  // });
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
                  url:"<?php echo base_url();?>index.php/Receipt_inv_user/GetItemMaster/",
                  data:dataString,
                  cache:false,
                 success:function(data){
                    $("#unitId").html(data);
                  //   $.ajax({
                  //     type:"POST",
                  //     url:"<?php echo base_url();?>index.php/all_asset/GetItemMaster/",
                  //     data:dataString,
                  //     cache:false,
                  // });
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
                  url:"<?php echo base_url();?>index.php/Receipt_inv_user/GetItemCategoryMaster/",
                  data:dataString,
                  cache:false,
                 success:function(data){
                    $("#category").html(data);
                  //   $.ajax({
                  //     type:"POST",
                  //     url:"<?php echo base_url();?>index.php/all_asset/GetItemMaster/",
                  //     data:dataString,
                  //     cache:false,
                  // });
                  }
                });
              });
            });
          </script>
        <!-- modal edit detail receipt -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModaleditDetail" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Receipt Detail</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Receipt_inv_user/editInvTrans')?>" method="post" enctype="multipart/form-data" role="form">
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

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" name="unit_id" id="unit_id">
                                  <option value="">Select Unit</option>
                                  <?php foreach ($m_invent_unit as $invUnit): ?>
                                    <option value="<?php echo $invUnit->unit;?>"><?php echo $invUnit->unit?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center" disabled="disabled" id="history_date" name="history_date" placeholder="Trans Date" required="history_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>

                           </div>

                           <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <textarea class="form-control" type="text" id="invoice" name="invoice" rows="3" placeholder="No SJ / Invoice" style="resize: none;"></textarea>
                                </div>
                              </div>
                            </div>

                           <div class="row">

                            <input type="hidden" id="id_inv" name="id_beli">
                            <input type="hidden" id="pembelian_id" name="pembelian_id">

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
                    var pembelian_id  =  $(this).data('receipt');
                    var id_barang     =  $(this).data('name');
                    var qty         =  $(this).data('qty');
                    var unit_id     =  $(this).data('unit');
                    var history_date  =  $(this).data('date');
                    var inv_status  =  $(this).data('status');
                    var invoice     =  $(this).data('inv');
                    $("#modal-edit #id_inv").val(id_inv);
                    $("#modal-edit #pembelian_id").val(pembelian_id);
                    $("#modal-edit #id_barang").val(id_barang);
                    $("#modal-edit #qty").val(qty);
                    $("#modal-edit #unit_id").val(unit_id);
                    $("#modal-edit #history_date").val(history_date);
                    $("#modal-edit #inv_status").val(inv_status);
                    $("#modal-edit #invoice").val(invoice);
                  })
                </script>
          </div>
        <!--end modal edit detail receipt-->
        
        <!-- modal post detail receipt -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalPost" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Post Receipt</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Receipt_inv_user/post')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <input type="hidden" id="pembelian_id" name="pembelian_id">

                            <div class="alert alert-info">
                              <p><h5>Are you sure you want to Post Receipt ?.</h5></p>
                            </div>

                          </div>
                        </div>  
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"> Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> No</button>
                        </div>
                          </form>
                      </div>
                  </div>
              </div>
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#post_detail", function() {
                    var pembelian_id  =  $(this).data('receipt');
                    $("#modal-edit #pembelian_id").val(pembelian_id);
                  })
                </script>
          </div>
        <!--end modal post detail receipt-->

          <!-- modal post 1 -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalPost1" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Post Receipt</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Receipt_inv_user/post1')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <input type="text" id="id" name="id">

                            <div class="alert alert-info">
                              <p><h5>Are you sure you want to Post Receipt ?.</h5></p>
                            </div>

                          </div>
                        </div>  
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"> Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> No</button>
                        </div>
                          </form>
                      </div>
                  </div>
              </div>
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#post1", function() {
                    var id  =  $(this).data('id');
                    $("#modal-edit #id").val(id);
                  })
                </script>
          </div>
        <!--end modal post 1-->

        <!-- modal Delete Receipt -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Receipt Detail</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Receipt_inv_user/deleteDetail')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="inv_history_id" name="id_beli">
                            <input type="hidden" id="pembelian_id" name="pembelian_id">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Receipt Detail you check?.</p>
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
                    var inv_history_id        =  $(this).data('id');
                     var pembelian_id        =  $(this).data('rec');
                    $("#modal-delete #inv_history_id").val(inv_history_id);
                    $("#modal-delete #pembelian_id").val(pembelian_id);
                  })
                </script>
          </div>
        <!--end modal Delete Receipt-->