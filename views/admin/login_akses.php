        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Login <small>Akses</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Login Akses</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalmodul"><i class="fa fa-plus"></i></button><b>Akses</b>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                 <!-- modal add new pelajaran -->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalmodul" class="modal fade">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header alert-success">
                                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                  <h4 class="modal-title">Tambah Akses</h4>
                              </div>
                              <form class="form-horizontal" action="<?php echo base_url('index.php/login_akses/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                          <input type="text" class="form-control text-center has-feedback-left" name="username" placeholder="Username" required="name">
                                          <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                          <input type="password" class="form-control text-center" name="password" placeholder="Password" required="name">
                                          <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                          <input type="text" class="form-control text-center has-feedback-left" name="name" placeholder="Full Name" required="name">
                                          <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                          <select class="text-center form-control" required="required" name="loginakses">
                                            <option value="">Select Login Type</option>
                                            <?php foreach ($login_type as $type): ?>
                                              <option value="<?php echo $type->id_logintype;?>"><?php echo $type->logintype?></option>
                                            <?php endforeach ?>
                                          </select>
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
                <!--end modal add new pelajaran-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th width="20px">No</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 0; ?>
                        <?php foreach ($m_login_akses as $akses): ?>
                        <?php $no++; ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $akses->fullname; ?></td>
                            <td><?php echo $akses->status; ?></td>
                            <td class="text-center">
                            <a id="edit_item" data-toggle="modal" data-target="#myModaleditUnit" data-id="<?php echo $akses->id_loginakses; ?>" data-name="<?php echo $akses->fullname; ?>" data-username="<?php echo $akses->username; ?>" data-password="<?php echo $akses->password; ?>" data-logintype="<?php echo $akses->id_logintype; ?>" data-status="<?php echo $akses->status; ?>">
                              <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                            </a>
                            <a id="delete" data-toggle="modal" data-target="#myModalDeleteUnit" data-id="<?php echo $akses->id_loginakses; ?>">
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
                  [0,"asc"],
                ]
              })
            })
            
          </script>
        <!-- /page content -->

        <!-- modal edit akses login -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModaleditUnit" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert-info">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Akses Login</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/login_akses/update')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left"  id="username" name="username" placeholder="Username" required="username">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="password" class="form-control text-center has-feedback-left" id="password" name="password" placeholder="Password" required="password">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="form-control text-center has-feedback-left" id="fullname" name="name" placeholder="Fullname" required="name">
                              <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <select class="text-center form-control" id="id_logintype" name="loginakses">
                                <option value="">Select Login Type</option>
                                <?php foreach ($login_type as $type): ?>
                                  <option value="<?php echo $type->id_logintype;?>"><?php echo $type->logintype?></option>
                                <?php endforeach ?>
                              </select>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" >
                              <select class="text-center form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="ACTIVE" > ACTIVE </option>
                                <option value="INACTIVE"> INACTIVE </option>
                              </select>
                            </div>
                            <input type="hidden" id="id_loginakses" name="id_loginakses">
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
                    var id_loginakses     =  $(this).data('id');
                    var id_logintype      =  $(this).data('logintype');
                    var username          =  $(this).data('username');
                    var password          =  $(this).data('password');
                    var fullname          =  $(this).data('name');
                    var status            =  $(this).data('status');
                    $("#modal-edit #id_loginakses").val(id_loginakses);
                    $("#modal-edit #id_logintype").val(id_logintype);
                    $("#modal-edit #username").val(username);
                    $("#modal-edit #password").val(password);
                    $("#modal-edit #fullname").val(fullname);
                    $("#modal-edit #status").val(status);
                  })
                </script>
          </div>
        <!--end modal edit akses login-->

        <!-- modal Delete unit -->
           <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalDeleteUnit" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-danger">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Delete Room</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/login_akses/delete')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">

                            <input type="hidden" id="id_loginakses" name="id_loginakses">
                            <div class="alert alert-info">
                              <p>Are you sure you want to delete the Room you check?.</p>
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
                    var id_loginakses        =  $(this).data('id');
                    $("#modal-delete #id_loginakses").val(id_loginakses);
                  })
                </script> 
        <!--end modal Delete unit-->