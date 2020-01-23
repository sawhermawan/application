        <script type="text/javascript">
                function ShowGroup(){
                  var element = document.getElementById('group');
                  var str = element.options[element.selectedIndex].text;
                  if(str == 'STATIONERY'){
                    show();
                    hide1();
                  }
                  else{  
                    hide();
                    show1();
                    hideapp();
                    hideapp1();
                  }
                }
                
                function hide(){
                  document.getElementById('atk').style.display='none';
                }
                function show(){
                  document.getElementById('atk').style.display='block';
                }
                function hide1(){
                  document.getElementById('spr').style.display='none';
                }
                function show1(){
                  document.getElementById('spr').style.display='block';
                }

        </script>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inventory <small>Used</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Management</a></li>
                  <li><a href="<?php echo base_url('index.php/All_transaction_inv_user')?>">All Transaction</a></li>
                  <li class="active">Used</li>
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
                      </div>
                      <div class="text-right col-lg-6">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>No</th>
                          <th>Used ID</th>
                          <th>Used Date</th>
                          <th>Used</th>
                          <th>Used To</th>
                          <th style="width: 20%">Description</th>
                          <th>Used/Return</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 0; ?>
                        <?php foreach($m_shipping as $shipping): ?>
                        <?php $no++; ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $shipping->pemakaian_id; ?></td>
                          <td><?php echo $shipping->pemakaian_date; ?></td>
                          <td><?php echo $shipping->location_name; ?></td>
                          <td><?php echo $shipping->fullname; ?><?php echo $shipping->desc_asset; ?></td>
                          <td>
                            <?php 
                              $shipp_desc =  $shipping->desc_shiiping;
                              $shipp_desc = substr($shipp_desc, 0, 60);
                              echo $shipp_desc;
                            ?>
                          </td>
                          <td><?php echo $shipping->shipping_type; ?></td>
                          <td><?php echo $shipping->status_shipping ?></td>
                          <td class="text-center"> 
                            <?php if ($shipping->group_barang == 'STO' && $shipping->status_shipping == 'Open'): ?>
                            <a id="delete" title="Click to Edit" data-toggle="modal" data-target="#myModalEditShipiingATK" data-id="<?php echo $shipping->id_ship;?>" data-ship="<?php echo $shipping->pemakaian_id;?>" data-shidate="<?php echo $shipping->pemakaian_date;?>" data-loc="<?php echo $shipping->location_from;?>" data-user="<?php echo $shipping->id_userShipping;?>" data-asset="<?php echo $shipping->asset_id;?>" data-desc="<?php echo $shipping->desc_shiiping;?>" data-group="<?php echo $shipping->group_barang;?>" data-unit="<?php echo $shipping->unitId_shipping;?>" data-type="<?php echo $shipping->shipping_type;?>">
                              <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                            </a>
                            <?php elseif ($shipping->group_barang == 'SPR' && $shipping->status_shipping == 'Open'): ?>
                              <a id="delete" title="Click to Edit" data-toggle="modal" data-target="#myModalEditShipiing" data-id="<?php echo $shipping->id_ship;?>" data-ship="<?php echo $shipping->pemakaian_id;?>" data-shidate="<?php echo $shipping->pemakaian_date;?>" data-loc="<?php echo $shipping->location_from;?>" data-user="<?php echo $shipping->id_userShipping;?>" data-asset="<?php echo $shipping->asset_id;?>" data-desc="<?php echo $shipping->desc_shiiping;?>" data-group="<?php echo $shipping->group_barang;?>" data-type="<?php echo $shipping->shipping_type;?>" data-unit="<?php echo $shipping->unitId_shipping;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a>
                            <?php elseif($shipping->group_barang == 'STO' && $shipping->status_shipping == 'Posted'): ?>
                              <a id="delete" title="Click to Edit" data-toggle="modal" data-target="#myModalEditShipiingATKPost" data-id="<?php echo $shipping->id_ship;?>" data-ship="<?php echo $shipping->pemakaian_id;?>" data-shidate="<?php echo $shipping->pemakaian_date;?>" data-loc="<?php echo $shipping->location_from;?>" data-user="<?php echo $shipping->id_userShipping;?>" data-asset="<?php echo $shipping->asset_id;?>" data-desc="<?php echo $shipping->desc_shiiping;?>" data-group="<?php echo $shipping->group_barang;?>" data-unit="<?php echo $shipping->unitId_shipping;?>" data-type="<?php echo $shipping->shipping_type;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a>
                            <?php elseif ($shipping->group_barang == 'SPR' && $shipping->status_shipping == 'Posted'): ?>
                              <a id="delete" title="Click to Edit" data-toggle="modal" data-target="#myModalEditShipiingPost" data-id="<?php echo $shipping->id_ship;?>" data-ship="<?php echo $shipping->pemakaian_id;?>" data-shidate="<?php echo $shipping->pemakaian_date;?>" data-loc="<?php echo $shipping->location_from;?>" data-user="<?php echo $shipping->id_userShipping;?>" data-asset="<?php echo $shipping->asset_id;?>" data-desc="<?php echo $shipping->desc_shiiping;?>" data-group="<?php echo $shipping->group_barang;?>" data-type="<?php echo $shipping->shipping_type;?>" data-unit="<?php echo $shipping->unitId_shipping;?>">
                                <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                              </a>
                            <?php endif; ?>


                            <?php if($shipping->status_shipping == 'Open'): ?>
                              <a href="<?php echo base_url('index.php/Shipping_inv_user/edit/'.$shipping->pemakaian_id)?>" title="Click to View Detail" class="btn btn-info"><i class="fa fa-eye"></i></a>

                              <a href="<?php echo base_url('index.php/Shipping_inv_user/cetak/'.$shipping->pemakaian_id)?>" title="Click to Print" class="btn btn-dark"><i class="fa fa-print"></i></a>

                              <a id="delete" title="Click to Delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $shipping->id_ship;?>" data-ship="<?php echo $shipping->pemakaian_id;?>">
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </a>
                            <?php else: ?>
                              <a href="<?php echo base_url('index.php/Shipping_inv_user/edit/'.$shipping->pemakaian_id)?>" title="Click to View Detail" class="btn btn-info"><i class="fa fa-eye"></i></a>

                              <a href="<?php echo base_url('index.php/Shipping_inv_user/cetak/'.$shipping->pemakaian_id)?>" title="Click to Print" class="btn btn-dark"><i class="fa fa-print"></i></a>
                              
                              <a href="#" title="Click to Delete" disabled="disabled" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

        <!-- modal Edit shipping -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditShipiingATK" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Used</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Shipping_inv_user/editUsed')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_shipping" name="id_shipping">
                            <input type="hidden" id="asset_id" name="no_asset">
                          </div>

                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left" disabled="disabled" id="ship_id" name="ship_id" placeholder="Shipping ID" required="ship_id">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control has-feedback-left pemakaian_date" name="pemakaian_date" id="rdate" placeholder="Used Date" required="pemakaian_date">
                                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="ship_type" name="shipping_type">
                                    <option value="Used">Used</option>
                                    <option value="Return">Return</option>
                                  </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="location" name="location">
                                    <option value="">Select Location</option>
                                    <?php foreach ($m_location as $loc): ?>
                                      <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" name="employee" id="employee">
                                    <option value="">Select Employee</option>
                                    <?php foreach ($m_employee as $user): ?>
                                      <option value="<?php echo $user->id_user;?>"><?php echo $user->fullname?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div> 
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" name="id_unit" id="unit_id">
                                    <option value="">Select Unit</option>
                                    <?php foreach ($m_unit as $unit): ?>
                                      <option value="<?php echo $unit->id_unit;?>"><?php echo $unit->nama_unit?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <textarea class="form-control" type="text" id="desc" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
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
                  $(document).on("click","#delete", function() {
                    var id_shipping    =  $(this).data('id');
                    var ship_id        =  $(this).data('ship');
                    var pemakaian_date  =  $(this).data('shidate');
                    var location       =  $(this).data('loc');
                    var id_user        =  $(this).data('user');
                    var asset_id       =  $(this).data('asset');
                    var desc           =  $(this).data('desc');
                    var group          =  $(this).data('group');
                    var unit_id        =  $(this).data('unit');
                    var ship_type      =  $(this).data('type');
                    $("#modal-delete #id_shipping").val(id_shipping);
                    $("#modal-delete #ship_id").val(ship_id);
                    $("#modal-delete .pemakaian_date").val(pemakaian_date);
                    $("#modal-delete #location").val(location);
                    $("#modal-delete #employee").val(id_user);
                    $("#modal-delete #asset_id").val(asset_id);
                    $("#modal-delete #desc").val(desc);
                    $("#modal-delete #group").val(group);
                    $("#modal-delete #unit_id").val(unit_id);
                    $("#modal-delete #ship_type").val(ship_type);
                  })
                </script>
          </div>
        <!--end modal Edit shipping-->

        <!-- modal Edit shipping -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditShipiing" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Used</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Shipping_inv_user/editUsed')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_shipping" name="id_shipping">
                            <input type="hidden" id="employee" name="employee">
                            <input type="hidden" name="id_unit" id="unit_id">
                          </div>

                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left" disabled="disabled" id="ship_id" name="ship_id" placeholder="Shipping ID" required="ship_id">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control has-feedback-left pemakaian_date" name="pemakaian_date" id="ax_date" placeholder="Used Date" required="pemakaian_date">
                                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="ship_type" name="shipping_type">
                                    <option value="Used">Used</option>
                                    <option value="Return">Return</option>
                                  </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="location" name="location">
                                    <option value="">Select Location</option>
                                    <?php foreach ($m_location as $loc): ?>
                                      <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" name="no_asset" id="asset_id">
                                    <option value="">Select Kendaraan</option> 
                                    <?php foreach ($m_asset as $asset): ?>
                                      <option value="<?php echo $asset->id;?>"><?php echo $asset->asset_name;?> || <?php echo $asset->description;?></option>
                                    <?php endforeach ?>       
                                  </select>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <textarea class="form-control" type="text" id="desc" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
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
                  $(document).on("click","#delete", function() {
                    var id_shipping    =  $(this).data('id');
                    var ship_id        =  $(this).data('ship');
                    var pemakaian_date  =  $(this).data('shidate');
                    var location       =  $(this).data('loc');
                    var id_user        =  $(this).data('user');
                    var asset_id       =  $(this).data('asset');
                    var desc           =  $(this).data('desc');
                    var group          =  $(this).data('group');
                    var unit_id        =  $(this).data('unit');
                    var ship_type      =  $(this).data('type');
                    $("#modal-delete #id_shipping").val(id_shipping);
                    $("#modal-delete #ship_id").val(ship_id);
                    $("#modal-delete .pemakaian_date").val(pemakaian_date);
                    $("#modal-delete #location").val(location);
                    $("#modal-delete #employee").val(id_user);
                    $("#modal-delete #asset_id").val(asset_id);
                    $("#modal-delete #desc").val(desc);
                    $("#modal-delete #group").val(group);
                    $("#modal-delete #ship_type").val(ship_type);
                    $("#modal-delete #unit_id").val(unit_id);
                  })
                </script>
          </div>
        <!--end modal Edit shipping-->

        <!-- modal Edit Post shipping -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditShipiingATKPost" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Used</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Shipping_inv_user/editUsed')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_shipping" name="id_shipping">
                            <input type="hidden" id="asset_id" name="no_asset">
                          </div>

                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left" disabled="disabled" id="ship_id" name="ship_id" placeholder="Shipping ID" required="ship_id">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control has-feedback-left pemakaian_date" disabled="disabled" name="pemakaian_date" id="rdate" placeholder="Used Date" required="pemakaian_date">
                                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" id="ship_type" disabled="disabled" name="shipping_type">
                                    <option value="Used">Used</option>
                                    <option value="Return">Return</option>
                                  </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" disabled="disabled" id="location" name="location">
                                    <option value="">Select Location</option>
                                    <?php foreach ($m_location as $loc): ?>
                                      <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" disabled="disabled" name="employee" id="employee">
                                    <option value="">Select Employee</option>
                                    <?php foreach ($m_employee as $user): ?>
                                      <option value="<?php echo $user->id_user;?>"><?php echo $user->fullname?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div> 
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" disabled="disabled" name="id_unit" id="unit_id">
                                    <option value="">Select Unit</option>
                                    <?php foreach ($m_unit as $unit): ?>
                                      <option value="<?php echo $unit->id_unit;?>"><?php echo $unit->nama_unit?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <textarea class="form-control" disabled="disabled" type="text" id="desc" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
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
                  $(document).on("click","#delete", function() {
                    var id_shipping    =  $(this).data('id');
                    var ship_id        =  $(this).data('ship');
                    var pemakaian_date  =  $(this).data('shidate');
                    var location       =  $(this).data('loc');
                    var id_user        =  $(this).data('user');
                    var asset_id       =  $(this).data('asset');
                    var desc           =  $(this).data('desc');
                    var group          =  $(this).data('group');
                    var unit_id        =  $(this).data('unit');
                    var ship_type      =  $(this).data('type');
                    $("#modal-delete #id_shipping").val(id_shipping);
                    $("#modal-delete #ship_id").val(ship_id);
                    $("#modal-delete .pemakaian_date").val(pemakaian_date);
                    $("#modal-delete #location").val(location);
                    $("#modal-delete #employee").val(id_user);
                    $("#modal-delete #asset_id").val(asset_id);
                    $("#modal-delete #desc").val(desc);
                    $("#modal-delete #group").val(group);
                    $("#modal-delete #unit_id").val(unit_id);
                    $("#modal-delete #ship_type").val(ship_type);
                  })
                </script>
          </div>
        <!--end modal Edit Post shipping-->

        <!-- modal Edit SPR POST shipping -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditShipiingPost" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Used</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Shipping_inv_user/editUsed')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_shipping" name="id_shipping">
                            <input type="hidden" id="employee" name="employee">
                            <input type="hidden" name="id_unit" id="unit_id">
                          </div>

                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left" disabled="disabled" id="ship_id" name="ship_id" placeholder="Shipping ID" required="ship_id">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <input type="text" class="text-center form-control has-feedback-left pemakaian_date" disabled="disabled" name="pemakaian_date" id="ax_date" placeholder="Used Date" required="pemakaian_date">
                                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" disabled="disabled" id="ship_type" name="shipping_type">
                                    <option value="Used">Used</option>
                                    <option value="Return">Return</option>
                                  </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" disabled="disabled" id="location" name="location">
                                    <option value="">Select Location</option>
                                    <?php foreach ($m_location as $loc): ?>
                                      <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                  <select class="text-center form-control" disabled="disabled" name="no_asset" id="asset_id">
                                    <option value="">Select Kendaraan</option> 
                                    <?php foreach ($m_asset as $asset): ?>
                                      <option value="<?php echo $asset->id;?>"><?php echo $asset->asset_name;?> || <?php echo $asset->description;?></option>
                                    <?php endforeach ?>       
                                  </select>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <textarea class="form-control" disabled="disabled" type="text" id="desc" name="desc" rows="3" placeholder="Description" style="resize: none;"></textarea>
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
                  $(document).on("click","#delete", function() {
                    var id_shipping    =  $(this).data('id');
                    var ship_id        =  $(this).data('ship');
                    var pemakaian_date  =  $(this).data('shidate');
                    var location       =  $(this).data('loc');
                    var id_user        =  $(this).data('user');
                    var asset_id       =  $(this).data('asset');
                    var desc           =  $(this).data('desc');
                    var group          =  $(this).data('group');
                    var unit_id        =  $(this).data('unit');
                    var ship_type      =  $(this).data('type');
                    $("#modal-delete #id_shipping").val(id_shipping);
                    $("#modal-delete #ship_id").val(ship_id);
                    $("#modal-delete .pemakaian_date").val(pemakaian_date);
                    $("#modal-delete #location").val(location);
                    $("#modal-delete #employee").val(id_user);
                    $("#modal-delete #asset_id").val(asset_id);
                    $("#modal-delete #desc").val(desc);
                    $("#modal-delete #group").val(group);
                    $("#modal-delete #ship_type").val(ship_type);
                    $("#modal-delete #unit_id").val(unit_id);
                  })
                </script>
          </div>
        <!--end modal Edit SPR POST shipping-->

        <!-- modal Delete shipping -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Used</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Shipping_inv_user/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_shipping" name="id_shipping">
                            <input type="hidden" id="ship_id" name="ship_id">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Used you check?.</p>
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
                    var id_shipping        =  $(this).data('id');
                    var ship_id        =  $(this).data('ship');
                    $("#modal-delete #id_shipping").val(id_shipping);
                    $("#modal-delete #ship_id").val(ship_id);
                  })
                </script>
          </div>
        <!--end modal Delete shipping-->

        <script>
          function selectuser()
            {
               var location = $('#location').val();
                
                $.post('<?php echo base_url();?>index.php/Shipping_inv_user/getUser/',
              {
                location:location
                
                },
                function(data) 
                {
                
                $('#employee').html(data);
                }); 
             
            }
        </script>