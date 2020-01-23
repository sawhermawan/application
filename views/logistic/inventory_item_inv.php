        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Barang</h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Barang</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalUnit"><i class="fa fa-plus"></i></button><b>Barang</b>
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

                  <form action="<?php echo base_url('index.php/Import_excel/MasterInventItem')?>" method="post" enctype="multipart/form-data">
                      <!-- <input type="file" name="file"/>
                      <input type="submit" value="Upload"/> -->
<!--                       <div class="row">

                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <input type="file" name="file">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <button type="submit"><i class="fa fa-upload"></i> Upload</button>
                        </div>
                         
                      </div> -->
                      
                  </form>
                </div>

              <!-- modal add new Inventory Item -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalUnit" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add Barang</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Inventory_item_inv/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">
                                 <!--  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="id_barang" placeholder="Kode Barang" required="id_barang">
                                    <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                                  </div> -->

                                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <input type="text" class="text-center form-control has-feedback-left" name="nama_barang" placeholder="Nama barang" required="nama_barang">
                                    <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
                                    <span class="fa fa-tasks form-control-feedback right" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="pembelian_unit" required="pembelian_unit">
                                      <option value=""> Select Item Receipt Unit</option>
                                      <?php foreach($m_invent_unit as $unit): ?>
                                        <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="pemakaian_unit" required="pemakaian_unit">
                                      <option value=""> Select Item Used Unit</option>
                                      <?php foreach($m_invent_unit as $unit): ?>
                                        <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="inventoryUnit" required="inventoryUnit">
                                      <option value=""> Select Item Inventory Unit</option>
                                      <?php foreach($m_invent_unit as $unit): ?>
                                        <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" id="itemGroup" name="itemGroup" required="itemGroup" onchange="selectcategory()">
                                      <option value=""> Select Item Group</option>
                                      <?php foreach($m_group_barang as $group): ?>
                                        <option value="<?php echo $group->group_id; ?>"><?php echo $group->group_barang; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                   <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" id="id_kategori" name="id_kategori" required="id_kategori" onchange="selectcategory()">
                                      <option value=""> Select Kategori</option>
                                      <?php foreach($m_category as $category): ?>
                                        <option value="<?php echo $category->id_kategori; ?>"><?php echo $category->nama_kategori; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                 <!-- <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="id_kategori" id="categoryID">
                                      <option value="">Select Kategori</option>
                                    </select>
                                  </div>  --> 
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
              <!--end modal add new Inventory Item-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>No</th>
                          <th>ID Barang</th>
                          <th style="width: 15%">Nama Barang</th>
                          <th>Kategori</th>
                          <th>Group Barang</th>
                          <th>Pembelian Unit</th>
                          <th>Inventory Unit</th>
                          <th>Pemakaian Unit</th>                  
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 0; ?>
                        <?php foreach($m_invent_item as $item): ?>
                          <?php $no++; ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $item->itemID; ?></td>
                          <td><?php echo $item->nama_barang; ?></td>
                          <td><?php echo $item->nama_kategori; ?></td>
                          <td><?php echo $item->group_barang; ?></td>
                          <td><?php echo $item->pembelian_unit; ?></td>
                          <td><?php echo $item->inventoryUnit; ?></td>
                          <td><?php echo $item->pemakaian_unit; ?></td>
                          <td class="text-center">
                            
                              <a id="edit_item" data-toggle="modal" data-target="#myModalItemEdit" data-id="<?php echo $item->id_tabel_barang; ?>" data-item="<?php echo $item->itemID; ?>" data-name="<?php echo $item->nama_barang; ?>" data-unit="<?php echo $item->pembelian_unit; ?>" data-unitused="<?php echo $item->pemakaian_unit; ?>" data-unitinv="<?php echo $item->inventoryUnit; ?>" data-group="<?php echo $item->group_barang; ?>" data-category="<?php echo $item->category_item; ?>">
                                <button class="btn btn-info"><i class="fa fa-edit"></i> edit</button>
                              </a>                         
                            
                            <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $item->id_tabel_barang; ?>" data-item="<?php echo $item->itemID; ?>">
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

          <script>
          function selectcategory()
            {
               var itemGroup = $('#itemGroup').val();
                
                $.post('<?php echo base_url();?>index.php/Inventory_item/getCategory/',
              {
                itemGroup:itemGroup
                
                },
                function(data) 
                {
                
                $('#categoryID').html(data);
                }); 
             
            }

            function selectcategoryDetail()
            {
               var group_barang = $('#group_barang').val();
                
                $.post('<?php echo base_url();?>index.php/Inventory_item/getCategoryDetail/',
              {
                group_barang:group_barang
                
                },
                function(data) 
                {
                
                $('#category_item').html(data);
                }); 
             
            }
        </script>

          <!-- modal edit item group -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalItemEdit" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Item</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Inventory_item_inv/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left"  id="id_barang" name="id_barang" placeholder="Item ID" required="id_barang">
                              <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Item Name" required="nama_barang">
                              <span class="fa fa-tasks form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <input type="hidden" name="id_vnt" id="id_vnt">

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="pembelian_unit" name="pembelian_unit" required="pembelian_unit">
                                <option value=""> Select Receipt Unit</option>
                                <?php foreach($m_invent_unit as $unit): ?>
                                  <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="pemakaian_unit" name="pemakaian_unit" required="pemakaian_unit">
                                <option value=""> Select Used Unit</option>
                                <?php foreach($m_invent_unit as $unit): ?>
                                  <<option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="inventoryUnit" name="inventoryUnit" required="inventoryUnit">
                                <option value=""> Select Inventory Unit</option>
                                <?php foreach($m_invent_unit as $unit): ?>
                                  <option value="<?php echo $unit->unit; ?>"><?php echo $unit->unit; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="group_barang" name="group_barang" onchange="selectcategoryDetail()" required="group_barang">
                                <option value=""> Select Item Group</option>
                                <?php foreach($m_group_barang as $group): ?>
                                  <option value="<?php echo $group->group_id; ?>"><?php echo $group->group_barang; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control category_item" id="category_item" name="id_kategori">
                                <option value=""> Select Category</option>
                                <?php foreach($m_category as $category): ?>
                                  <option value="<?php echo $category->id_kategori; ?>"><?php echo $category->nama_kategori; ?></option>
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
                  $(document).on("click","#edit_item", function() {
                    var id_vnt        =  $(this).data('id');
                    var id_barang       =  $(this).data('item');
                    var nama_barang     =  $(this).data('name');
                    var pembelian_unit   =  $(this).data('unit');
                    var pemakaian_unit      =  $(this).data('unitused');
                    var inventoryUnit =  $(this).data('unitinv');
                    var group_barang    =  $(this).data('group');
                    var category_item =  $(this).data('category');
                    $("#modal-edit #id_vnt").val(id_vnt);
                    $("#modal-edit #id_barang").val(id_barang);
                    $("#modal-edit #nama_barang").val(nama_barang);
                    $("#modal-edit #pembelian_unit").val(pembelian_unit);
                    $("#modal-edit #pemakaian_unit").val(pemakaian_unit);
                    $("#modal-edit #inventoryUnit").val(inventoryUnit);
                    $("#modal-edit #group_barang").val(group_barang);
                    $("#modal-edit .category_item").val(category_item);
                  })
                </script>
          </div>
        <!--end modal edit item group -->


        <!-- modal Delete invent Item -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDelete" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Item</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Inventory_item_inv/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_item" name="id_item">
                            <input type="hidden" id="id_inv" name="id_inv">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Invent Item you check?.</p>
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
                    var id_item        =  $(this).data('item');
                    var id_inv        =  $(this).data('id');
                    $("#modal-delete #id_item").val(id_item);
                    $("#modal-delete #id_inv").val(id_inv);
                  })
                </script>
          </div>
        <!--end modal Delete Invent item-->