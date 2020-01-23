        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Group <small>Barang</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Group barang</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalgroup"><i class="fa fa-plus"></i></button><b>Group barang</b>
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

                  <form action="<?php echo base_url('index.php/Import_excel/MasterItemGroup')?>" method="post" enctype="multipart/form-data">
<!--                     <div class="row">

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <input type="file" name="file">
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <button type="submit"><i class="fa fa-upload"></i> Upload</button>
                      </div>
                       
                    </div> -->
                  </form>
                </div>

                <!-- modal add new product type -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalgroup" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add Group barang</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/group_barang/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="group_id" onkeypress="return (event.keyCode != 32&&event.which!=32)" placeholder="Id Group" required="group_id">
                                    <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" name="group_barang" placeholder="Group barang" required="group_barang">
                                    <span class="fa fa-cubes form-control-feedback right" aria-hidden="true"></span>
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
                          <th>No</th>
                          <th>id Group barang</th>
                          <th>Group barang</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 0; ?>
                        <?php foreach($m_group_barang as $group): ?>
                        <?php $no++; ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $group->group_id; ?></td>
                          <td><?php echo $group->group_barang; ?></td>
                          <td class="text-center">
                            <a id="edit_group_barang" data-toggle="modal" data-target="#myModalgroupEdit" data-id="<?php echo $group->id; ?>" data-group="<?php echo $group->group_id; ?>" data-item="<?php echo $group->group_barang; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $group->id; ?>" data-group="<?php echo $group->group_id; ?>">
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
        <!-- /page content -->
        <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
          <script type="text/javascript">
            $(document).ready(function(){
              var table = $('#datatable-checkbox').DataTables({
                "order":[
                  [0,"DESC"],
                ]
              })
            })
            
          </script>
        <!-- modal edit item group -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalgroupEdit" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Group barang</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/group_barang/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="group" onkeypress="return (event.keyCode != 32&&event.which!=32)" name="group_id" placeholder="Group ID" required="group_id">
                              <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control" id="group_barang" name="group_barang" placeholder="Group barang" required="group_barang">
                              <span class="fa fa-cubes form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" name="id" id="id">
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
                  $(document).on("click","#edit_group_barang", function() {
                    var id    =  $(this).data('id');
                    var groupid    =  $(this).data('group');
                    var itemgroup  =  $(this).data('item');
                    $("#modal-edit #id").val(id);
                    $("#modal-edit #group").val(groupid);
                    $("#modal-edit #group_barang").val(itemgroup);
                  })
                </script>
          </div>
        <!--end modal edit item group -->

        <!-- modal Delete Inventory Unit -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Group barang</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/group_barang/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id" name="id">
                            <input type="hidden" id="group_id" name="group_id">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete Group barang ?.</p>
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
                    var id        =  $(this).data('id');
                    var group_id        =  $(this).data('group');
                    $("#modal-delete #id").val(id);
                    $("#modal-delete #group_id").val(group_id);
                  })
                </script>
          </div>
    <!--end modal Delete Inventory unit-->