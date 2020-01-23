        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Unit <small></small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Master</a></li>
                  <li><a href="#">Master Inventory</a></li>
                  <li class="active">Unit</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalUnit"><i class="fa fa-plus"></i></button><b>Unit</b>
                      </div>
                      <!-- <div class="text-right col-lg-6">
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

                  <form action="<?php echo base_url('index.php/Import_excel/MasterInventUnit')?>" method="post" enctype="multipart/form-data">
                    <!-- <div class="row">

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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalUnit" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add New Unit</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Inventory_unit_inv/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="unit" onkeypress="return (event.keyCode != 32&&event.which!=32)" placeholder="Unit" required="unit">
                                    <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" name="deskripsi" placeholder="Description" required="deskripsi">
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
                <!--end modal add new product type-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>No</th>
                          <th>Unit</th>
                          <th>Description</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 0; ?>
                        <?php foreach($m_invent_unit as $unit): ?>
                        <?php $no++; ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $unit->unit; ?></td>
                          <td><?php echo $unit->description; ?></td>
                          <td class="text-center">
                            <a id="edit_unit" data-toggle="modal" data-target="#myModalUnitEdit" data-id="<?php echo $unit->id_unit; ?>" data-unit="<?php echo $unit->unit; ?>" data-description="<?php echo $unit->description; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $unit->id_unit; ?>" data-unit="<?php echo $unit->unit; ?>">
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
                  [0,"desc"],
                ]
              })
            })
            
          </script>

<!-- modal edit invent Unit -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalUnitEdit" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                  <h4 class="modal-title">Edit Unit</h4>
              </div>
              <form class="form-horizontal" action="<?php echo base_url('index.php/Inventory_unit_inv/update')?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body" id="modal-edit">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" class="form-control has-feedback-left" id="unit" name="unit" placeholder="Unit" required="unit">
                      <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" class="form-control" id="desc" name="deskripsi" placeholder="Description" required="deskripsi">
                      <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                    </div>
                    <input type="hidden" name="id_unit" id="id_unit">
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
             $(document).on("click","#edit_unit", function() {
                var idunit    =  $(this).data('id');
                var namaunit  =  $(this).data('unit');
                var descunit  =  $(this).data('description');
                $("#modal-edit #id_unit").val(idunit);
                $("#modal-edit #unit").val(namaunit);
                $("#modal-edit #desc").val(descunit);
             })
           </script>
      </div>
    <!--end modal edit invent Unit-->

    <!-- modal Delete Inventory Unit -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Unit</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Inventory_unit_inv/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_unit" name="id_unit">
                            <input type="hidden" id="unit" name="unit">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Invent Unit you check?.</p>
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
                    var id_unit        =  $(this).data('id');
                    var unit        =  $(this).data('unit');
                    $("#modal-delete #id_unit").val(id_unit);
                    $("#modal-delete #unit").val(unit);
                  })
                </script>
          </div>
    <!--end modal Delete Inventory unit-->