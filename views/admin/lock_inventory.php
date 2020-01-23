<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lock Inventory</h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Setup</a></li>
                  <li><a href="#">Inventory</a></li>
                  <li class="active">Lock Inventory</li>
                </ol>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <?php foreach ($m_inventory_header as $lock_inv): ?>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo base_url('index.php/Lock_inventory/update')?>" method="post">
                      <span class="section">Date Lock Inventory</span>
                      <div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input class="text-center form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="date_loc_inv" id="pembelian_date" value="<?php echo $lock_inv->date_lock_inv; ?>"  placeholder="Lock Inventory Date" type="text">
                        </div>
                        <input type="hidden" name="id_lock_inv" value="<?php echo $lock_inv->id_lock_inv;?>">
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
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
        <!-- /page content -->