        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Report</li>
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
                          <h3>Report <small>View</small></h3>
                        </div>
                        <div class="text-right col-lg-6">
                          <button type="button" class="btn btn-primary btn-lrg ajax" title="Help"><i class="fa fa-question-circle"></i></button>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="x_panel fixed_height_320">
                        <div class="x_title">
                          <h2>Report <small>Stock Barang</small></h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="dashboard-widget-content">
                            <ul class="quick-list"><!-- 
                              <li><a data-toggle="modal" data-target="#myModalPembelian"><button class="btn btn-link"><i class="fa fa-book"></i>In/Out Barang</button></a></li> -->
                              <li><a data-toggle="modal" data-target="#myModalPengeluaranBarang"><button class="btn btn-link"><i class="fa fa-user"></i>Stock</button></a></li> 
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
        <!-- /page content -->



        <!-- modal All Logbook -->
          <!-- <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalPembelian" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-info">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Report Logbook</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/report/ReportReceiptInvent')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control has-feedback-left" name="from_date" id="allfrom" placeholder="From Date" required="from_date">
                              <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="text" class="text-center form-control" name="to_date" id="allto" placeholder="To Date" required="to_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                          </div>
                        </div>  
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        </div>
                          </form>
                      </div>
                  </div>
              </div> -->
        <!--end modal All Logbook-->

        <!-- modal All Logbook -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalPengeluaranBarang" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-info">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Report Stock</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/report_inv_user/stock')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body" id="modal-delete">
                          <div class="row">
                            <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="date" class="text-center form-control has-feedback-left" name="from_date" id="shipfrom" placeholder="From Date" required="from_date">
                              <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                              <input type="date" class="text-center form-control" name="to_date" id="shipto" placeholder="To Date" required="to_date">
                              <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div> -->
                          </div>
                        </div>  
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        </div>
                          </form>
                      </div>
                  </div>
              </div>
        <!--end modal All Logbook-->