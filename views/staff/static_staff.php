<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Terra Concrete Perkasa</title>

    <link href="<?php echo base_url();?>assets/build/css/bootstrap-select.css">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url();?>assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url();?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url();?>assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url();?>assets/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Bootstrap Select -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">
    <!-- Ion.RangeSlider -->
    <link href="<?php echo base_url();?>assets/vendors/normalize-css/normalize.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/build/css/custom.css" rel="stylesheet">

    <!-- <script type="text/javascript">
        function Show(){
          var element = document.getElementById('series');
          var str = element.options[element.selectedIndex].text;
          if(str == 'Application'){
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
          document.getElementById('appli').style.display='none';
        }
        function show(){
          document.getElementById('appli').style.display='block';
        }
        function hide1(){
          document.getElementById('infras').style.display='none';
        }
        function show1(){
          document.getElementById('infras').style.display='block';
        }
        function hideapp(){
          document.getElementById('aa').style.display='none';
        }
        function hideapp1(){
          document.getElementById('bb').style.display='none';
        }

    </script> -->

</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><center><span>Terra Concrete Perkasa</span></center></a>
          </div>

          <!-- <div class="clearfix"></div> -->

          <!-- menu profile quick info -->
           <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo base_url();?>images/<?php echo $this->session->userdata('images'); ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $this->session->userdata('fullname'); ?></h2>
            </div>
            <hr>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="<?php echo base_url();?>index.php/staff"><i class="fa fa-home"></i>Home</a></li>

                <!-- Dashboard Management -->
              <li><a><i class="fa fa-share"></i>Invetory Management <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <!-- <li><a href="<?php echo base_url(); ?>index.php/Receipt_inv_user">Order</a></li> -->
                    <li><a href="<?php echo base_url(); ?>index.php/Shipping_inv_user">Used</a></li>
                    <!-- <li><a href="<?php echo base_url(); ?>index.php/Transfer_inv_user">Transfer</a></li> -->
                    <li><a href="<?php echo base_url(); ?>index.php/Stock_inv_user">Stock</a></li>
                    <!-- <li><a href="<?php echo base_url(); ?>index.php/All_transaction_inv_user">History</a></li> -->
                  </ul>
                </li>
                <!-- end Dashboard Management -->
                <!-- dashboard inventaris -->
              <li><a href="<?php echo base_url(); ?>/index.php/report_inv_user"><i class="fa fa-list-alt"></i>Report</a></li>
                <!-- end dashboard inventaris -->
                <!-- Dashboard Report -->

                <!-- end Dashboard Report -->
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url();?>images/<?php echo $this->session->userdata('images'); ?>" alt=""><?php echo $this->session->userdata('name'); ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="<?php echo base_url('index.php/View_profile') ?>"> Profile</a></li>
                  <li><a data-toggle="modal" data-target="#myModalPicture"> Change Picture</a></li>
                  <li><a data-toggle="modal" data-target="#myModalPass"> Change Password</a></li>
                  <li><a href="<?php echo base_url('index.php/Logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green"></span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <a>
                      <span class="image"><img src="<?php echo base_url();?>assets/images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="<?php echo base_url();?>assets/images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="<?php echo base_url();?>assets/images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="<?php echo base_url();?>assets/images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- modal Change Picture -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalPicture" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Change Picture</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Welcome/change_pic')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body">
                          <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label class="form-group col-md-6 col-sm-1">Browse Your Picture</label>
                              <input type="file" name="picture" class="input-large" required>
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
        <!--end modal Change Picture-->
        <!-- modal Change pass -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalPass" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header alert alert-success">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Change Password</h4>
                      </div>
                      <form class="form-horizontal" action="<?php echo base_url('index.php/Welcome/change_pass')?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-12">
                              <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                              <input type="password" name="current_password" id="password" required class="text-center col-md-7 col-xs-8" placeholder="Current Password">
                            </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-lg-12">
                              <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                              <input type="password" name="new_password" id="password" required class="text-center col-md-7 col-xs-8" placeholder="New Password">
                            </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-lg-12">
                              <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                              <input type="password" name="retype_password" id="password" required class="text-center col-md-7 col-xs-8" placeholder="Re-type Password">
                            </div>
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
        <!--end modal Change pass-->

<?php echo $contents;?>

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          <b>Version</b> 2.0
        </div>
        <strong><font color="blue">PT. Terra Concrete Perkasa</font></a>.</strong> 
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>
  
   <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url();?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?php echo base_url();?>assets/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url();?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url();?>assets/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo base_url();?>assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="<?php echo base_url();?>assets/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url();?>assets/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="<?php echo base_url();?>assets/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="<?php echo base_url();?>assets/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo base_url();?>assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="<?php echo base_url();?>assets/vendors/starrr/dist/starrr.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Ion.RangeSlider -->
    <script src="<?php echo base_url();?>assets/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <!-- jquery.inputmask -->
    <script src="<?php echo base_url();?>assets/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- jQuery Knob -->
    <script src="<?php echo base_url();?>assets/vendors/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- Bootstrap Select -->
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- <script type="text/javascript">
            $(document).ready(function(){
              var table = $('#datatable-checkbox').DataTable({
                "order":[
                  [1,"DESC"],
                ]
              })
            })
            
          </script> -->
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/build/js/custom.js"></script>

    <script type="text/javascript">
      $('#date_birth').datetimepicker({
          format: 'YYYY-MM-DD'
       },function(start, end, label) {
       console.log(start.toISOString(), end.toISOString(), label);
      });

      $('#join').datetimepicker({
          format: 'YYYY-MM-DD'
       },function(start, end, label) {
       console.log(start.toISOString(), end.toISOString(), label);
      });

      $('#issue_date').datetimepicker({
          format: 'YYYY-MM-DD'
       },function(start, end, label) {
       console.log(start.toISOString(), end.toISOString(), label);
      });

      $('#dodate').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#fixing_date').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#m_y_purch').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#pembelian_date').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#rdate').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#receipt_ax_date').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#ax_date').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#from').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#to').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#allfrom').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#allto').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#from1').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#to1').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#from2').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#to2').datetimepicker({
          format: 'YYYY-MM-DD',
       });
       $('#from3').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#to3').datetimepicker({
          format: 'YYYY-MM-DD',
       });
       $('#from4').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#to4').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#start_date').datetimepicker({
          format: 'YYYY-MM-DD',
       });
      $('#end_date').datetimepicker({
          format: 'YYYY-MM-DD',
       });
    </script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
    </script>




    <!-- Initialize datetimepicker -->
    <!-- <script>
    $('#myDatepicker').datetimepicker();
    
    $('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
    });
    
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    $('#datetimepicker6').datetimepicker();
    
    $('#datetimepicker7').datetimepicker({
        useCurrent: false
    });
    
    $("#datetimepicker6").on("dp.change", function(e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    
    $("#datetimepicker7").on("dp.change", function(e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });

    $(document).ready(function(e){
      $(document).on('click','.btn-save',function(e){
        e.preventDefault();
        console.log('dsd')
        var form = $(this).parents('form').serialize();
        console.log(form);  
        });
    })



    </script> -->


</body>
</html>