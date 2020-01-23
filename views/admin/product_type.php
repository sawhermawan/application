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
                  <li class="active">Product Type</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalUnit"><i class="fa fa-plus"></i></button><b>Product Type</b>
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
                <!-- modal add new product type -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalUnit" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add New Product Type</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Product_type/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="procut_type" placeholder="Product Type" required="procut_type">
                                    <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="status_type" required="status_type">
                                      <option value=""> Kategori Produk</option>
                                      <option value="Alat Tulis">Alat tulis</option>
                                      <option value="Peralatan Komputer & Printer">Peralatan Komputer & Printer</option>
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
                  <!--end modal add new product type-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>Product Type ID</th>
                          <th>Product Type</th>
                          <th>Category</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($m_asset_type as $asset): ?>
                          <tr>
                          <td><?php echo $asset->code_type;?></td>
                          <td><?php echo $asset->type;?></td>
                          <td><?php echo $asset->status_type;?></td>
                          <td class="text-center">
                            <a id="edit_asset_type" data-toggle="modal" data-target="#myModalAssetType" data-id="<?php echo $asset->code_type; ?>" data-type="<?php echo $asset->type; ?>" data-categori="<?php echo $asset->status_type; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $asset->code_type; ?>">
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

        <!-- modal edit Asset Type -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalAssetType" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Asset Type</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Product_type/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="procut_type" name="procut_type" placeholder="Product Type" required="procut_type">
                              <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" name="code_type" id="code_type">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="status_type" name="status_type" required="status_type">
                                <option value=""> Kategori Produk </option>
                                <option value="Alat Tulis">Alat Tulis</option>
                                <option value="Peralatan Komputer & Printer">Peralatan Komputer & Printer</option>
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
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#edit_asset_type", function() {
                    var code_type    =  $(this).data('id');
                    var procut_type  =  $(this).data('type');
                    var status_type  =  $(this).data('categori');
                    $("#modal-edit #code_type").val(code_type);
                    $("#modal-edit #procut_type").val(procut_type);
                    $("#modal-edit #status_type").val(status_type);
                  })
                </script>
          </div>
        <!--end modal Asset Type -->

        <!-- modal Delete Asset Type -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Product Type</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Product_type/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_type" name="id_type">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Product Type you check?.</p>
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
                    var id_type        =  $(this).data('id');
                    $("#modal-delete #id_type").val(id_type);
                  })
                </script>
          </div>
        <!--end modal Delete Asset Type-->
