        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inventory <small>Stock</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Management</a></li>
                  <li><a href="#">Inventory</a></li>
                  <li class="active">Stock</li>
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
                        <h3>Stock</h3>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                
                  <div class="x_content">
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>Location</th>
                          <th>Item</th>
                          <th>Quantity</th>
                          <th>Unit</th>
                          <th>Item Group</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($m_stock_barang as $stock): ?>  
                        <tr>
                          <td><?php echo $stock->nama_lokasi; ?></td>
                          <td><?php echo $stock->nama_barang; ?></td>
                          <td><?php echo $stock->qty; ?></td>
                          <td><?php echo $stock->description; ?></td>
                          <td><?php echo $stock->group_barang; ?></td>
                          <td class="text-center">
                            <!-- <a id="edit" title="Click to Edit" data-toggle="modal" data-target="#myModalEditStock" data-id="<?php echo $stock->id;?>" data-lokasi="<?php echo $stock->nama_lokasi;?>" data-barang="<?php echo $stock->nama_barang;?>" data-quantity="<?php echo $stock->qty;?>" data-desc="<?php echo $stock->description;?>" data-axr="data-group="<?php echo $stock->group_barang;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a> -->
                            <a href="<?php echo base_url('index.php/Stock_inv/ViewDetailStock_inv/'.$stock->id)?>" title="Click to View Detail" class="btn btn-info"><i class="fa fa-eye"></i> View Detail</a>
                          </td> 
                        </tr>
                      <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->
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
          <!-- modal edit receipt -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditStock" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Stock</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/stock_inv/edit')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left"  id="id" name="id" >
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                              <select id="id_lokasi" name="id_lokasi" class="selectpicker show-tick form-control" data-live-search="true">
                                  <option value="">Select Location</option>
                                  <?php foreach ($m_lokasi as $loc): ?>
                                    <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->nama_lokasi?></option>
                                  <?php endforeach ?>
                                </select>
                            </div> -->
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" name="nama_barang" id="nama_barang" placeholder="nama barang">
                              <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control" id="qty" name="qty" placeholder="Quantity ">
                              <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>

                           <!--  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" id="description" name="description" placeholder="Deskripsi " >
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div> -->

                           <!--  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control" name="receipt_ax_date" id="ax_date" placeholder="Order Date" required="receipt_ax_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div> -->
                            <input type="text" id="id" name="id">
                            <!-- <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <select name="group_barang" id="group_barang" class="text-center form-control">
                                    <option value="">Select Item Group</option>
                                  <?php foreach ($m_group_barang as $group): ?>
                                    <option value="<?php echo $group->group_id;?>"><?php echo $group->group_barang;?></option>
                                  <?php endforeach ?>
                              </select>
                            </div> -->
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
                    // var nama_lokasi            =  $(this).data('lokasi');
                    var nama_barang                 =  $(this).data('barang');
                    var qty                   =  $(this).data('quantity');
                    // var description              =  $(this).data('desc');
                    // var group_barang            =  $(this).data('group');
                    $("#modal-edit #id").val(id);
                    // $("#modal-edit #nama_lokasi").val(nama_lokasi);
                    $("#modal-edit #nama_barang").val(nama_barang);
                    $("#modal-edit #qty").val(qty);
                    // $("#modal-edit #desc").val(desc);
                    // $("#modal-edit #group_barang").val(group_barang);
                  })
                </script>
          </div>
        <!--end modal edit receipt-->