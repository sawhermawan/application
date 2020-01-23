        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Asset <small>Master</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Master</a></li>
                  <li><a href="#">Master Asset</a></li>
                  <li class="active">Product Detail</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalDetail"><i class="fa fa-plus"></i></button><b>Product Detail</b>
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
                 <!-- modal add new product detail -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDetail" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add New Product Detail</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Product_detail/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="id_type" required="id_type">
                                      <option value=""> Select Product Type</option>
                                      <?php foreach ($m_asset_type as $type): ?>
                                      <option value="<?php echo $type->code_type;?>"> <?php echo $type->type;?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="numfield" id="numfield" required="numfield">
                                      <option value=""> Select Number of New Field </option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="row" id="new_field_list">
                                  
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
                </div>
                  <!--end modal add new product detail-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>Product Detail ID</th>
                          <th>Product Type</th>
                          <th>Product Detail</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($m_asset_detail as $detail): ?>
                          <tr>
                          <td><?php echo $detail->code_detail;?></td>
                          <td><?php echo $detail->type;?></td>
                          <td><?php echo $detail->field_unique;?></td>
                          <td class="text-center">
                            <a id="new_field" data-toggle="modal" data-target="#myModalNewField" data-id="<?php echo $detail->code_detail; ?>" data-type="<?php echo $detail->type; ?>">
                              <button class="btn btn-success"><i class="fa fa-plus"></i> Field</button>
                            </a>

                            <a id="edit_asset_detail" data-toggle="modal" data-target="#myModalAssetDetail" data-id="<?php echo $detail->code_detail; ?>" data-type="<?php echo $detail->type; ?>" data-field="<?php echo $detail->field_unique; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $detail->id_detail; ?>" data-uni="<?php echo $detail->code_detail; ?>">
                              <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </a>
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
          <script type="text/javascript">
              $(document).ready(function() {
                  $("#numfield").change(function() {
                      var selVal = $(this).val();
                      $("#new_field_list").html('');
                      if(selVal > 0) {
                          for(var i = 1; i<= selVal; i++)
                          {
                            if(i%2==0){
                              var pos = ''
                              var pos2 = 'right'
                            } else {
                              var pos = 'has-feedback-left'
                              var pos2 ='left'
                            }
                              $("#new_field_list").append('<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"><input type="text" class="form-control '+pos+'" name="new_field[]" placeholder="New Field" required/><span class="fa fa-list form-control-feedback '+pos2+'" aria-hidden="true"></span></div>');
                          }
                      }
                  });
              });
          </script>
        <!-- /page content -->

        <!-- modal edit Asset Detail -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalAssetDetail" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Asset Detail</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Product_detail/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" disabled="disabled" class="form-control has-feedback-left" id="procut_type" name="procut_type" placeholder="Product Type" required="procut_type">
                              <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" id="code_detail" name="code_detail">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control" id="procut_detail" name="procut_detail" placeholder="Product Detail" required="procut_detail">
                              <span class="fa fa-list form-control-feedback right" aria-hidden="true"></span>
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
                  $(document).on("click","#edit_asset_detail", function() {
                    var code_detail     =  $(this).data('id');
                    var procut_type     =  $(this).data('type');
                    var procut_detail   =  $(this).data('field');
                    $("#modal-edit #code_detail").val(code_detail);
                    $("#modal-edit #procut_type").val(procut_type);
                    $("#modal-edit #procut_detail").val(procut_detail);
                  })
                </script>
          </div>
        <!--end modal Asset Detail -->

        <!-- modal add new Field -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalNewField" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Add New Field</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Product_detail/tambahField')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-new">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" disabled="disabled" class="form-control has-feedback-left" id="procut_type" name="procut_type" placeholder="Product Type" required="procut_type">
                              <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" id="code_detail" name="code_detail">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control" name="new_field" placeholder="New Field" required="new_field">
                              <span class="fa fa-list form-control-feedback right" aria-hidden="true"></span>
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
                  $(document).on("click","#new_field", function() {
                    var code_detail     =  $(this).data('id');
                    var procut_type     =  $(this).data('type');
                    $("#modal-new #code_detail").val(code_detail);
                    $("#modal-new #procut_type").val(procut_type);
                  })
                </script>
          </div>
        <!--end add new Field -->

        <!-- modal Delete Asset detail -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Product Detail</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Product_detail/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_detail" name="id_type">

                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Product Detail you check?.</p>
                            </div>
                            <input type="hidden" id="id_uni" name="id_uni">
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
                    var id_detail        =  $(this).data('id');
                    var id_uni        =  $(this).data('uni');
                    $("#modal-delete #id_detail").val(id_detail);
                    $("#modal-delete #id_uni").val(id_uni);
                  })
                </script>
          </div>
        <!--end modal Delete Asset detail-->