        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Location <small>Setup</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="<?php echo base_url(); ?>index.php/welcome"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/location">Location</a></li>
                  <li class="active">Location</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalLocation"><i class="fa fa-plus"></i></button><b>Location</b>
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
                <!-- modal add new Unit -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalLocation" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add Location</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Location/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="name" placeholder="Location Name" required="name">
                                        <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                      </div>

                                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control" name="location_code" placeholder="Location Code" required="location_code">
                                        <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
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
                          <th>ID Lokasi</th>
                          <th>Nama Lokasi</th>
                          <th>Kode Lokasi</th>
                          <th width="25%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($m_lokasi as $loc): ?>
                          <tr>
                          <td><?php echo $loc->id_lokasi;?></td>
                          <td><?php echo $loc->nama_lokasi;?></td>
                          <td><?php echo $loc->codeLocation; ?></td>
                          <td class="text-center">
                            <a id="edit_loc" data-toggle="modal" data-target="#myModaleditLocation" data-id="<?php echo $loc->id_lokasi; ?>" data-name="<?php echo $loc->nama_lokasi; ?>" data-code="<?php echo $loc->codeLocation; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $loc->id_lokasi; ?>">
                              <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </a>
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
          <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
          <script type="text/javascript">
            $(document).ready(function(){
              var table = $('#datatable-checkbox').DataTables({
                "order":[
                  [0,"asc"],
                ]
              })
            })
            
          </script>
        <!-- /page content -->

        <!-- modal edit Location -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModaleditLocation" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Location</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Location/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="loc_name" name="loc_name" placeholder="Location Name" required="loc_name">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control" id="loc_code" name="loc_code" placeholder="Location Code" required="loc_code">
                              <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" id="id_loc" name="id_loc">
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
                  $(document).on("click","#edit_loc", function() {
                    var id_loc        =  $(this).data('id');
                    var loc_name      =  $(this).data('name');
                    var loc_code      =  $(this).data('code');
                    $("#modal-edit #id_loc").val(id_loc);
                    $("#modal-edit #loc_name").val(loc_name);
                    $("#modal-edit #loc_code").val(loc_code);
                  })
                </script>
          </div>
        <!--end modal edit Location-->

        <!-- modal Delete Location -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Location</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Location/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_loc" name="id_loc">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Location you check?.</p>
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
                    var id_loc        =  $(this).data('id');
                    $("#modal-delete #id_loc").val(id_loc);
                  })
                </script>
          </div>
        <!--end modal Delete Location-->