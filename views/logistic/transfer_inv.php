        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inventory <small>Transfer</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Management</a></li>
                  <li><a href="#">Inventory</a></li>
                  <li class="active">Transfer</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalTransfer"><i class="fa fa-plus"></i></button><b> Transfer</b>
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

                <!-- modal add new transfer -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalTransfer" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">New Transfer</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv/tambah')?>" method="post" enctype="multipart/form-data" role="form">

                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control has-feedback-left" name="transfer_date" id="pembelian_date" placeholder="Transfer Date" required="transfer_date">
                                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" name="id_lokasi" required="id_lokasi">
                                      <option value="">Select Location From</option>
                                      <?php foreach ($m_lokasi as $loc): ?>
                                        <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" name="transfer_to">
                                      <option value="">Select Location To</option>
                                      <?php foreach ($m_lokasi as $loc): ?>
                                        <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                  <select name="group_barang" id="group" class="text-center form-control"  required>
                                        <option value="">Select Item Group</option>
                                      <?php foreach ($m_group_barang as $group): ?>
                                        <option value="<?php echo $group->group_id;?>"><?php echo $group->group_barang;?></option>
                                      <?php endforeach ?>
                                  </select>
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
                <!--end modal add new transfer-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>Transfer ID</th>
                          <th>Transfer Date</th>
                          <th>Location From</th>
                          <th>Location To</th>
                          <th style="width: 20%">Description</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($m_transfer as $transfer): ?>
                        <tr>
                          <td><?php echo $transfer->transfer_id; ?></td>
                          <td><?php echo $transfer->transfer_date; ?></td>
                          <td><?php echo $transfer->location_name_from; ?></td>
                          <td><?php echo $transfer->location_name_to; ?></td>
                          <td>
                            <?php 
                              $trans_desc =  $transfer->description;
                              $trans_desc = substr($trans_desc, 0, 60);
                              echo $trans_desc;
                            ?>
                          </td>
                          <td><?php echo $transfer->status ?></td>
                          <td class="text-center">
                            <?php if($transfer->status == 'Open'):?>
                              <a id="edit" data-toggle="modal" data-target="#myModalTransferEdit" data-id="<?php echo $transfer->id;?>" data-trans="<?php echo $transfer->transfer_id;?>" data-locfrom="<?php echo $transfer->location_from;?>" data-locto="<?php echo $transfer->location_to;?>" data-group="<?php echo $transfer->group_barang;?>" data-desc="<?php echo $transfer->description;?>" data-date="<?php echo $transfer->transfer_date;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a>
                            <?php else: ?>
                              <a id="edit" data-toggle="modal" data-target="#myModalTransferEditPost" data-id="<?php echo $transfer->id;?>" data-trans="<?php echo $transfer->transfer_id;?>" data-locfrom="<?php echo $transfer->location_from;?>" data-locto="<?php echo $transfer->location_to;?>" data-group="<?php echo $transfer->group_barang;?>" data-desc="<?php echo $transfer->description;?>" data-date="<?php echo $transfer->transfer_date;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a>
                            <?php endif; ?>
                            <a href="<?php echo base_url('index.php/Transfer_inv/edit/'.$transfer->transfer_id)?>" title="Click to Edit" class="btn btn-info"><i class="fa fa-eye"></i></a>

                            <a href="<?php echo base_url('index.php/Transfer_inv/cetak/'.$transfer->transfer_id)?>" title="Click to Edit" class="btn btn-dark"><i class="fa fa-print"></i></a>

                            <?php if($transfer->status == 'Open'): ?>
                              <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $transfer->id;?>" data-trans="<?php echo $transfer->transfer_id;?>">
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </a>
                            <?php else: ?>
                              <a href="#" title="Click to Barcode" disabled="disabled" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            <?php endif; ?>
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

        <!-- modal edit Transfer -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalTransferEdit" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Transfer</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv/editTransfer')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <input type="hidden" id="id_transfer" name="id_transfer">
                            <input type="hidden" id="histo_id" name="histo_id">
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" disabled="disabled" name="id_trans" id="histo_id" placeholder="Transfer Id" required="id_trans">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control history_date" name="transfer_date" id="from2" placeholder="Transfer Date" required="transfer_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="locfrom" name="id_lokasi" required="id_lokasi">
                                  <option value="">Select Location From</option>
                                  <?php foreach ($m_lokasi as $loc): ?>
                                    <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="locto" name="transfer_to">
                                  <option value="">Select Location To</option>
                                  <?php foreach ($m_lokasi as $loc): ?>
                                    <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <select name="group_barang" id="group" class="text-center form-control"  required>
                                    <option value="">Select Item Group</option>
                                  <?php foreach ($m_group_barang as $group): ?>
                                    <option value="<?php echo $group->group_id;?>"><?php echo $group->group_barang;?></option>
                                  <?php endforeach ?>
                              </select>
                            </div>

                          </div>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <textarea class="form-control" id="desc" type="text" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
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
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#edit", function() {
                    var id_transfer        =  $(this).data('id');
                    var histo_id           =  $(this).data('trans');
                    var locfrom            =  $(this).data('locfrom');
                    var locto              =  $(this).data('locto');
                    var history_date         =  $(this).data('date');
                    var id_group           =  $(this).data('group');
                    var desc               =  $(this).data('desc');
                    $("#modal-edit #id_transfer").val(id_transfer);
                    $("#modal-edit #histo_id").val(histo_id);
                    $("#modal-edit #locfrom").val(locfrom);
                    $("#modal-edit #locto").val(locto);
                    $("#modal-edit .history_date").val(history_date);
                    $("#modal-edit #group").val(id_group);
                    $("#modal-edit #desc").val(desc);
                  })
                </script>
          </div>
        <!--end modal edit Transfer-->

        <!-- modal edit post Transfer -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalTransferEditPost" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Transfer</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv/editTransfer')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <input type="hidden" id="id_transfer" name="id_transfer">
                            <input type="hidden" id="histo_id" name="histo_id">
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" disabled="disabled" name="id_trans" id="histo_id" placeholder="Transfer Id" required="id_trans">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control history_date" disabled="disabled" name="transfer_date" id="from2" placeholder="Transfer Date" required="transfer_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="locfrom" disabled="disabled" name="id_lokasi" required="id_lokasi">
                                  <option value="">Select Location From</option>
                                  <?php foreach ($m_lokasi as $loc): ?>
                                    <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="locto" disabled="disabled" name="transfer_to">
                                  <option value="">Select Location To</option>
                                  <?php foreach ($m_lokasi as $loc): ?>
                                    <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <select name="group_barang" id="group" class="text-center form-control" disabled="disabled" required>
                                    <option value="">Select Item Group</option>
                                  <?php foreach ($m_group_barang as $group): ?>
                                    <option value="<?php echo $group->group_id;?>"><?php echo $group->group_barang;?></option>
                                  <?php endforeach ?>
                              </select>
                            </div>

                          </div>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <textarea class="form-control" id="desc" disabled="disabled" type="text" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
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
                <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                <script type="text/javascript">
                  $(document).on("click","#edit", function() {
                    var id_transfer        =  $(this).data('id');
                    var histo_id           =  $(this).data('trans');
                    var locfrom            =  $(this).data('locfrom');
                    var locto              =  $(this).data('locto');
                    var history_date         =  $(this).data('date');
                    var id_group           =  $(this).data('group');
                    var desc               =  $(this).data('desc');
                    $("#modal-edit #id_transfer").val(id_transfer);
                    $("#modal-edit #histo_id").val(histo_id);
                    $("#modal-edit #locfrom").val(locfrom);
                    $("#modal-edit #locto").val(locto);
                    $("#modal-edit .history_date").val(history_date);
                    $("#modal-edit #group").val(id_group);
                    $("#modal-edit #desc").val(desc);
                  })
                </script>
          </div>
        <!--end modal edit post Transfer-->

        <!-- modal Delete Transfer -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Transfer</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Transfer_inv/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_transfer" name="id_transfer">
                            <input type="hidden" id="histo_id" name="histo_id">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Transfer you check?.</p>
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
                    var id_transfer        =  $(this).data('id');
                    var histo_id        =  $(this).data('trans');
                    $("#modal-delete #id_transfer").val(id_transfer);
                    $("#modal-delete #histo_id").val(histo_id);
                  })
                </script>
          </div>
        <!--end modal Delete Transfer-->