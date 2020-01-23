<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <?php foreach ($m_employee as $user): ?>
                          <img class="img-responsive avatar-view" src="<?php echo base_url();?>images/<?php echo $user->profpic_user;?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?php echo strtoupper($user->fullname);?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $user->nama_lokasi;?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $user->nama_unit;?>
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-envelope user-profile-icon"></i> <?php echo $user->email;?>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                  <form  class="form-horizontal form-label-left" action="<?php echo base_url('index.php/Employee/update')?>" method="post">

                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="company">Company</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <select id="company"  name="company" class="form-control col-md-7 col-xs-12">
                            <option value="<?php echo $user->id_comp;?>"><?php echo $user->company_name;?></option>
                            <?php foreach ($m_company as $comp): ?>
                              <option value="<?php echo $comp->id_comp;?>"><?php echo $comp->company_name;?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="nip">Nip <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input id="nip" class="form-control col-md-7 col-xs-12"  name="nip" value="<?php echo $user->nip;?>" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="firstname">Firstname <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input id="firstname" class="form-control col-md-7 col-xs-12"  name="firstname" value="<?php echo $user->firstname;?>" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="lastname">Lastname <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input id="lastname" class="form-control col-md-7 col-xs-12"  name="lastname" value="<?php echo $user->lastname;?>"  type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="address">Address</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <textarea class="form-control col-md-7 col-xs-12" rows="5" id="address" name="address" style="resize: none;"><?php echo $user->alamat_user;?></textarea>
                        </div>
                      </div>
                      <!-- <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="ip_address">IP Address</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input id="ip_address" class="form-control col-md-7 col-xs-12"  name="ip_address" value="<?php echo $user->ip_address;?>" required="required" type="text" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
                      </div> -->
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="gender">Gender</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <select id="gender"  name="gender" class="form-control col-md-7 col-xs-12">
                            <option value="<?php echo $user->gender_user;?>"><?php echo $user->gender_user;?></option>
                            <option value='Male'>Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="phone">Phone</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="tel" id="phone" name="phone" value="<?php echo $user->phone_user;?>" class="form-control col-md-7 col-xs-12" data-inputmask='"mask": "9999-9999-99999"' data-mask>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="email">Email</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="email" id="email" name="email" value="<?php echo $user->email;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="date_birth">Date of Birth</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="text" id="date_birth" name="date_birth" value="<?php echo $user->dateofbirth_user;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="join">Joined Date</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <input type="text" id="join" name="join" value="<?php echo $user->joined;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="location">Location</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <select id="location"  name="location" class="form-control col-md-7 col-xs-12">
                            <option value="<?php echo $user->id_lokasi;?>"><?php echo $user->nama_lokasi;?></option>
                            <?php foreach ($m_lokasi as $loc): ?>
                              <option value="<?php echo $loc->id_lokasi;?>"><?php echo $loc->nama_lokasi;?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-1 col-xs-12" for="unit">Unit</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <select id="unit"  name="unit" class="form-control col-md-7 col-xs-12">
                            <option value="<?php echo $user->id_unit;?>"><?php echo $user->nama_unit;?></option>
                            <?php foreach ($m_unit as $unit): ?>
                              <option value="<?php echo $unit->id_unit;?>"><?php echo $unit->nama_unit;?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                          <input type="hidden" name="id_user" value="<?php echo $user->id_user;?>">
                          <button id="save" name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <?php endforeach ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->