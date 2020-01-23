        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Unit <small>Konversi</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Master</a></li>
                  <li><a href="#">Master Inventory</a></li>
                  <li class="active">Unit Konversi</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalConversion"><i class="fa fa-plus"></i></button><b>Konversi</b>
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
                  <form action="<?php echo base_url('index.php/Import_excel/MasterUnitConversion')?>" method="post" enctype="multipart/form-data">
                      <!-- <input type="file" name="file"/>
                      <input type="submit" value="Upload"/> -->
     <!--                  <div class="row">

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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalConversion" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add Unit Conversion</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Unit_conversion/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="id_barang" required="id_barang">
                                      <option value=""> Select Item ID</option>
                                      <?php foreach($m_invent_item as $item): ?>
                                        <option value="<?php echo $item->id_barang; ?>"><?php echo $item->id_barang; ?> || <?php echo $item->nama_barang; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" id="unitFrom" name="unitFrom" onchange="selectunitfrom()" required="unitFrom">
                                      <option value=""> Select Unit From</option>
                                      <?php foreach($m_invent_unit as $unit): ?>
                                        <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" id="unitTo" name="unitTo" required="unitTo">
                                      <option value=""> Select Unit To</option>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" onkeypress="javascript:return isNumber(event)" name="factor" placeholder="Factor" required="factor">
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
                          <th>ID Barang</th>
                          <th>Unit From</th>
                          <th>Unit To</th>
                          <th>Factor</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 0; ?>
                        <?php foreach($m_unit_conversion as $conver): ?>
                        <?php $no++; ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $conver->nama_barang; ?></td>
                            <td><?php echo $conver->unitFrom; ?></td>
                            <td><?php echo $conver->unitTo; ?></td>
                            <td><?php echo $conver->factor; ?></td>
                            <td class="text-center">
                              <a id="edit_conversion" data-toggle="modal" data-target="#myModalUnitConver" data-id="<?php echo $conver->id_conversion; ?>" data-item="<?php echo $conver->id_barang_table; ?>" data-from="<?php echo $conver->unitFrom; ?>" data-to="<?php echo $conver->unitTo; ?>" data-factor="<?php echo $conver->factor; ?>">
                                <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                              </a>
                              <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $conver->id_conversion; ?>" data-item="<?php echo $conver->id_barang_table; ?>">
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

        <script>
              // WRITE THE VALIDATION SCRIPT IN THE HEAD TAG.
              function isNumber(evt) {
                  var iKeyCode = (evt.which) ? evt.which : evt.keyCode
                  if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                      return false;

                  return true;
              } 

              function selectunitfrom()
              {
                 var unitFrom = $('#unitFrom').val();
                  
                  $.post('<?php echo base_url();?>index.php/Unit_conversion/getUnit/',
                {
                  unitFrom:unitFrom
                  
                  },
                  function(data) 
                  {
                  
                  $('#unitTo').html(data);
                  }); 
               
              }   
          </script>

          <!-- modal edit invent Unit -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalUnitConver" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Unit Conversion</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Unit_conversion/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <!-- <select class="text-center form-control"  id="id_barang" name="item" required="item">
                                <option value=""> Select Item ID</option>
                                <?php foreach($m_invent_item as $item): ?>
                                  <option value="<?php echo $item->id_barang; ?>"><?php echo $item->id_barang; ?></option>
                                <?php endforeach ?>
                              </select> -->
                              <input type="text" class="form-control" id="id_barang"  name="id_barang" placeholder="Factor" required="factor">
                              <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" name="id_conv" id="id_conv">
                            <input type="hidden" name="id_barang" id="id_barang">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="unitfrom" name="unitFrom" required="unitFrom">
                                <option value=""> Select Unit From</option>
                                <?php foreach($m_invent_unit as $unit): ?>
                                  <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="unitto" name="unitTo" required="unitTo">
                                <option value=""> Select Unit To</option>
                                <?php foreach($m_invent_unit as $unit): ?>
                                  <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control" id="factor" onkeypress="javascript:return isNumber(event)" name="factor" placeholder="Factor" required="factor">
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
                  <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                   <script type="text/javascript">
                     $(document).on("click","#edit_conversion", function() {
                        var id_conv    =  $(this).data('id');
                        var id_barang    =  $(this).data('item');
                        var unitfrom   =  $(this).data('from');
                        var unitto     =  $(this).data('to');
                        var factor     =  $(this).data('factor');
                        $("#modal-edit #id_conv").val(id_conv);
                        $("#modal-edit #id_barang").val(id_barang);
                        $("#modal-edit #unitfrom").val(unitfrom);
                        $("#modal-edit #unitto").val(unitto);
                        $("#modal-edit #factor").val(factor);
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
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Unit_conversion/delete')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body" id="modal-delete">
                                <div class="row">

                                  <input type="hidden" id="id_conv" name="id_conv">
                                  <input type="hidden" id="id_barang" name="id_barang">
                                  <div class="alert alert-info">
                                    <p>Are you sure you want to delete the Unit Conversion you check?.</p>
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
                          var id_conv        =  $(this).data('id');
                          var id_barang        =  $(this).data('item');
                          $("#modal-delete #id_conv").val(id_conv);
                          $("#modal-delete #id_barang").val(id_barang);
                        })
                      </script>
                </div>
            <!--end modal Delete Inventory unit-->