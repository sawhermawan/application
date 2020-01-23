        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Kategori <small>Barang</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Kategori Barang</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalCategory"><i class="fa fa-plus"></i></button><b>Kategori</b>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <form action="<?php echo base_url('index.php/Import_excel/MasterCategory')?>" method="post" enctype="multipart/form-data">
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

                <!-- modal add new product type -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalCategory" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header alert alert-success">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Add Kategori Barang</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/category_item_inv/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                              <div class="modal-body">
                                <div class="row">

                                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="group_barang" required="group_barang">
                                      <option value=""> Select Item Group</option>
                                      <?php foreach($m_group_barang as $group): ?>
                                        <option value="<?php echo $group->group_id; ?>"><?php echo $group->group_barang; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="id_kategori" onkeypress="return (event.keyCode != 32&&event.which!=32)" placeholder="Id Kategori" required="id_kategori">
                                    <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" name="nama_kategori" placeholder="Nama Kategori" required="nama_kategori">
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
                          <th>Id Kategori</th>
                          <th>Nama Kategori</th>
                          <th>Group Barang</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 0; ?>
                        <?php foreach($m_category as $category): ?>
                          <?php $no++; ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $category->id_kategori; ?></td>
                            <td><?php echo $category->nama_kategori; ?></td>
                            <td><?php echo $category->id_group_barang; ?></td>
                            <td class="text-center">
                              <a id="edit_category" data-toggle="modal" data-target="#myModalcategoryEdit" data-id="<?php echo $category->id; ?>" data-name="<?php echo $category->nama_kategori; ?>" data-group="<?php echo $category->id_group_barang; ?>" data-category="<?php echo $category->id_kategori; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                              </a>

                              <a id="delete" data-toggle="modal" data-target="#myModalDelete" data-id="<?php echo $category->id; ?>" data-category="<?php echo $category->id_kategori; ?>">
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
                  [0,"desc"],
                ]
              })
            })
            
          </script>

          <!-- modal edit invent Unit -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalcategoryEdit" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Category</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/category_item_inv/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" name="group_barang" id="group_id" required="group_barang">
                                <option value=""> Select Item Group</option>
                                <?php foreach($m_group_barang as $group): ?>
                                  <option value="<?php echo $group->group_id; ?>"><?php echo $group->group_barang; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="id_kategori" name="id_kategori" onkeypress="return (event.keyCode != 32&&event.which!=32)" placeholder="Id Kategori" required="id_kategori">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori" required="nama_kategori">
                              <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>

                            <input type="hidden" id="id" name="id">

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
                     $(document).on("click","#edit_category", function() {
                        var id             =  $(this).data('id');
                        var id_kategori    =  $(this).data('category');
                        var nama_kategori  =  $(this).data('name');
                        var group_id       =  $(this).data('group');
                        $("#modal-edit #id").val(id);
                        $("#modal-edit #id_kategori").val(id_kategori);
                        $("#modal-edit #nama_kategori").val(nama_kategori);
                        $("#modal-edit #group_id").val(group_id);
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
                              <h4 class="modal-title">Delete Category</h4>
                          </div>
                          <form class="form-horizontal" action="<?php echo base_url('index.php/category_item_inv/delete')?>" method="post" enctype="multipart/form-data" role="form">
                            <div class="modal-body" id="modal-delete">
                              <div class="row">

                                <input type="hidden" id="id" name="id">
                                <input type="hidden" id="id_kategori" name="id_kategori">
                                <div class="alert alert-info">
                                  <p>Are you sure you want to delete the Category Item you check?.</p>
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
                        var id             =  $(this).data('id');
                        var id_kategori    =  $(this).data('category');
                        $("#modal-delete #id").val(id);
                        $("#modal-delete #id_kategori").val(id_kategori);
                      })
                    </script>
              </div>
            <!--end modal Delete Inventory unit-->