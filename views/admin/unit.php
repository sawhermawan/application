        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inventory <small>Master</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="<?php echo base_url(); ?>index.php/welcome"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Inventory Item</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalUnit"><i class="fa fa-plus"></i></button><b>Divisi</b>
                      </div>
<!--                       <div class="text-right col-lg-6">
                        <button type="button" class="btn btn-default btn-lrg ajax" title="Refresh" onclick="location.reload()">
                          <i class="fa fa-spin fa-refresh"></i></button>
                            <script type="text/javascript">
                               function reload(){
                                location.reload();
                               }
                            </script>
                        <button type="button" class="btn btn-primary btn-lrg ajax" title="Help"><i class="fa fa-question-circle"></i></button>
                      </div> -->
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                <!-- modal add new Unit -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalUnit" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Tambah Data</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Unit/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control text-center has-feedback-left" name="nama" placeholder="Unit Name" required="nama">
                                    <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
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
                  <!--end modal add new Unit-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>Unit ID</th>
                          <th>Nama Unit</th>
                          <th width="25%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($m_unit as $unit): ?>
                          <tr>
                          <td><?php echo $unit->id_unit;?></td>
                          <td><?php echo $unit->nama_unit;?></td>
                          <td class="text-center">
                            <a id="edit_item" data-toggle="modal" data-target="#myModaleditUnit" data-id="<?php echo $unit->id_unit; ?>" data-name="<?php echo $unit->nama_unit; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $unit->id_unit; ?>">
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
        <!-- modal edit unit -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModaleditUnit" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Unit</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Unit/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left" id="unit_name" name="nama" placeholder="Unit Name" required="nama">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" id="id_unit" name="id_unit">
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
                  $(document).on("click","#edit_item", function() {
                    var id_unit        =  $(this).data('id');
                    var unit_name      =  $(this).data('name');
                    $("#modal-edit #id_unit").val(id_unit);
                    $("#modal-edit #unit_name").val(unit_name);
                  })
                </script>
          </div>
        <!--end modal edit unit-->

        <!-- modal Delete unit -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Unit</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Unit/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_unit" name="id_unit">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Unit you check?.</p>
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
                    var id_unit        =  $(this).data('id');
                    $("#modal-delete #id_unit").val(id_unit);
                  })
                </script>
        <!--end modal Delete unit-->