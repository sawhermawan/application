        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>harga <small></small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Master</a></li>
                  <li><a href="#">Master Inventory</a></li>
                  <li class="active">harga</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalharga"><i class="fa fa-plus"></i></button><b>harga</b>
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

                  <form action="<?php echo base_url('index.php/Import_excel/MasterInventharga')?>" method="post" enctype="multipart/form-data">
                     <!--  <div class="row">

                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <input type="file" name="file">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <button type="submit"><i class="fa fa-upload"></i> Upload</button>
                        </div>
                         
                      </div> -->
                  </form>
                </div>

              <!-- modal add new Inventory harga -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalharga" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add harga</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/daftar_harga/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="id_barang" required="id_barang">
                                      <option value=""> Pilih Barang</option>
                                      <?php foreach($m_invent_item as $item): ?>
                                        <option value="<?php echo $item->id_barang;?>"><?php echo $item->nama_barang; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="unit_id" required="unit_id">
                                      <option value=""> Pilih Unit</option>
                                      <?php foreach($m_invent_unit as $unit): ?>
                                        <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" name="item_harga" placeholder="Harga Barang" onkeyup="this.value=numberWithCommas(this.value);" id="tbNumbers" onkeypress="javascript:return isNumber(event)" required="item_harga">
                                    <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
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
              <!--end modal add new Inventory harga-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>harga</th>
                          <th>Unit</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $no = 0; ?>
                      <?php foreach($m_daftar_harga as $harga): ?>
                      <?php $no++; ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $harga->nama_barang;?></td>
                          <td><?php echo number_format($harga->harga);?></td>
                          <td><?php echo $harga->unit;?></td>
                          <td class="text-center">
                            <a id="edit_harga" data-toggle="modal" data-target="#myModalhargaEdit" data-id="<?php echo $harga->id; ?>" data-nama="<?php echo $harga->nama_barang; ?>" data-iditem="<?php echo $harga->item_harga; ?>" data-harga="<?php echo $harga->harga; ?>" data-unit="<?php echo $harga->unit_id; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $harga->id; ?>" data-item="<?php echo $harga->id_barang; ?>">
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
          <script type="text/javascript">
            function numberWithCommas(n){
                n = n.replace(/,/g, "");
                var s=n.split('.')[1];
                (s) ? s="."+s : s="";
                n=n.split('.')[0];
                while(n.length>3){
                    s=","+n.substr(n.length-3,3)+s;
                    n=n.substr(0,n.length-3)
                }
                return n+s;
            }
          </script>
          <script>
              // WRITE THE VALIDATION SCRIPT IN THE HEAD TAG.
              function isNumber(evt) {
                  var iKeyCode = (evt.which) ? evt.which : evt.keyCode
                  if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                      return false;

                  return true;
              }    
          </script>

          <!-- modal add new Inventory harga -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalhargaEdit" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit harga</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/daftar_harga/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" disabled="disabled" id="id_barang" name="item" placeholder="Item Id" required="item">
                              <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                              <span class="fa fa-archive form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="id_barang" id="id_item">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="item_harga" name="item_harga" placeholder="Item harga" onkeyup="this.value=numberWithCommas(this.value);" id="tbNumbers" onkeypress="javascript:return isNumber(event)" required="item_harga">
                              <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="unit_id" name="unit_id" required="unit_id">
                                <option value=""> Select Unit</option>
                                <?php foreach($m_invent_unit as $unit): ?>
                                  <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
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
                  <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
                  <script type="text/javascript">
                    $(document).on("click","#edit_harga", function() {
                      var id          =  $(this).data('id');
                      var name        =  $(this).data('nama');
                      var harga       =  $(this).data('harga');
                      var unit        =  $(this).data('unit');
                      var id_item     =  $(this).data('iditem');
                      $("#modal-edit #id").val(id);
                      $("#modal-edit #id_barang").val(name);
                      $("#modal-edit #item_harga").val(harga);
                      $("#modal-edit #unit_id").val(unit);
                      $("#modal-edit #id_item").val(id_item);
                    })
                  </script>
            </div>
          <!--end modal add new Inventory harga-->

        <!-- modal Delete Inventory harga -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete harga</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/daftar_harga/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_harga" name="id_harga">
                            <input type="hidden" id="id_item" name="id_item">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the harga you check?.</p>
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
                    var id_harga        =  $(this).data('id');
                    var id_item        =  $(this).data('item');
                    $("#modal-delete #id_harga").val(id_harga);
                    $("#modal-delete #id_item").val(id_item);
                  })
                </script>
          </div>
        <!--end modal Delete Inventory harga-->