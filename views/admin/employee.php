        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Employee <small>Setup</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Master</a></li>
                  <li class="active">Employee</li>
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
                        <button type="button" class="btn btn-success btn-sm" title="New" data-toggle="modal" data-target="#myModalemployee"><i class="fa fa-plus"></i></button><b>Employee</b>
                      </div>
                      <div class="text-right col-lg-6">
                        <!-- <button type="button" class="btn btn-default btn-lrg ajax" title="Refresh" onclick="location.reload()">
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
                </div>
                <!-- modal add new employee -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalemployee" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Tambah Employee</h4>
                            </div>
                            <form class="form-horizontal" action="<?php echo base_url('index.php/Employee/tambah')?>" method="post" enctype="multipart/form-data" role="form">

                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="company" required="company">
                                      <option value=""> Select Company</option>
                                        <?php foreach ($m_company as $comp): ?>
                                        <option value="<?php echo $comp->id_comp;?>"><?php echo $comp->company_name?></option>
                                        <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" name="nip" placeholder="NIP" required="nip">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="firstname" placeholder="First Name" required="firstname">
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                  </div>
                                </div>  

                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <textarea class="form-control" type="text" name="address" rows="3" placeholder="Address" style="resize: none;" required="address"></textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="gender" required="gender">
                                      <option value=""> Select Gender</option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                    </select>
                                  </div>

                                  <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" name="ip_address" placeholder="IP Address"  data-inputmask="'alias': 'ip'" data-mask>
                                    <span class="fa fa-laptop form-control-feedback right" aria-hidden="true"></span>
                                  </div> -->

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="email" class="form-control has-feedback-left" name="email" placeholder="Email">
                                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" data-inputmask='"mask": "9999-9999-99999"' data-mask>
                                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="date_birth" id="date_birth" placeholder="Date of Birth">
                                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-right" name="join" id="join" placeholder="Joined">
                                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="location" required="location">
                                      <option value=""> Select Location</option>
                                      <?php foreach ($m_location as $loc): ?>
                                        <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->location_name?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select class="text-center form-control" name="unit" required="unit">
                                      <option value=""> Select Unit</option>
                                      <?php foreach ($m_unit as $unit): ?>
                                        <option value="<?php echo $unit->id_unit;?>"><?php echo $unit->nama_unit?></option>
                                      <?php endforeach ?>
                                    </select>
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
                </div>
                  <!--end modal add new employee-->
                
                  <div class="x_content">
                    <?=$this->session->flashdata('notif')?>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          
                          <!-- <th>No</th> -->
                          <th>Nip</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=0; ?>
                         <?php foreach ($m_employee as $user): ?>
                          <?php $no++; ?>
                          <tr>
                          
                          <!-- <td><?php echo $no;?></td> -->
                          <td><?php echo $user->nip;?></td>
                          <td><?php echo $user->fullname;?></td>
                          <td><?php echo $user->email;?></td>
                          <td><?php echo $user->phone_user;?></td>
                          <td class="text-center">
                            <a href="<?php echo base_url('index.php/Employee/edit/'.$user->id_user)?>" title="Click to Edit" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>

                           <!--  <a id="login_access" data-toggle="modal" data-target="#myModalLoginAccess" data-id="<?php echo $user->id_user;?>" data-full="<?php echo $user->fullname;?>" data-firs="<?php echo $user->firstname;?>" data-comp="<?php echo $user->id_comp;?>">
                              <button class="btn btn-success"><i class="fa fa-share-alt"></i> Login Akses</button>
                            </a> --> 
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
                  [1,"desc"],
                ]
              })
            })
            
          </script>
        <!-- /page content -->
        <!-- modal login access -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalLoginAccess" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Login Access</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Employee/login_akses')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-edit">
                          <div class="row">


                            <input type="text" name="id_user" id="id_user">
                            <input type="text" name="fullname" id="fullname">
                            <input type="text" name="firstname" id="firstname">
                            <input type="text" name="id_comp" id="id_comp">

                            <p class="text-center"><h4 class="text-center">Are you sure you want to import employee for login access you check?.</h4></p>

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
                  $(document).on("click","#login_access", function() {
                    var id_user        =  $(this).data('id');
                    var fullname       =  $(this).data('full');
                    var firstname     =  $(this).data('firs');
                    var id_comp     =  $(this).data('comp');
                    $("#modal-edit #id_user").val(id_user);
                    $("#modal-edit #fullname").val(fullname);
                    $("#modal-edit #firstname").val(firstname);
                    $("#modal-edit #id_comp").val(id_comp);
                  })
                </script>
          </div>
        <!--end modal login access -->