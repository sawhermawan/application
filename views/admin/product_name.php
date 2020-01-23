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
                  <li class="active">Product Name</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalUnit"><i class="fa fa-plus"></i></button><b>Product Name</b>
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
                  <!-- modal add new product name -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalUnit" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add New Product Name</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Product_name/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="procut_name" placeholder="Product Name" required="procut_name">
                                    <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="id_type" required="id_type">
                                      <option value=""> Select Product Type</option>
                                      <?php foreach ($m_asset_type as $type): ?>
                                      <option value="<?php echo $type->code_type;?>"> <?php echo $type->type;?></option>
                                      <?php endforeach ?>
                                    </select>
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
                </div>
                  <!--end modal add new product name-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>Product Name ID</th>
                          <th>Product name</th>
                          <th>Product Type</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($m_asset_name as $name): ?>
                          <tr>
                          <td><?php echo $name->code_name;?></td>
                          <td><?php echo $name->asset_name;?></td>
                          <td><?php echo $name->type;?></td>
                          <td class="text-center">
                            <a id="edit_asset_name" data-toggle="modal" data-target="#myModalAssetName" data-id="<?php echo $name->code_name; ?>" data-name="<?php echo $name->asset_name; ?>" data-type="<?php echo $name->code_type; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $name->code_name; ?>">
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
        <!-- /page content -->

        <!-- modal edit Asset Name -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalAssetName" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Asset Name</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Product_name/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="procut_name" name="procut_name" placeholder="Product Name" required="procut_name">
                              <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" id="code_name" name="code_name">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="id_type" name="id_type" required="id_type">
                                <option value=""> Select Product Type</option>
                                <?php foreach ($m_asset_type as $type): ?>
                                <option value="<?php echo $type->code_type;?>"> <?php echo $type->type;?></option>
                                <?php endforeach ?>
                              </select>
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
                  <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                  <script type="text/javascript">
                    $(document).on("click","#edit_asset_name", function() {
                      var code_name    =  $(this).data('id');
                      var procut_name  =  $(this).data('name');
                      var id_type      =  $(this).data('type');
                      $("#modal-edit #code_name").val(code_name);
                      $("#modal-edit #procut_name").val(procut_name);
                      $("#modal-edit #id_type").val(id_type);
                    })
                  </script>
              </div>
                
        <!--end modal Asset Name -->

        <!-- modal Delete Asset Name -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Product Name</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Product_name/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_name" name="id_name">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Product Name you check?.</p>
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
                    var id_name        =  $(this).data('id');
                    $("#modal-delete #id_name").val(id_name);
                  })
                </script>
          </div>
        <!--end modal Delete Asset Name-->