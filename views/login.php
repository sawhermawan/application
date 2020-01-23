<!DOCTYPE html>
<html lang="en">
<head>
  <title>Terra Conrete Perkasa</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>Login_V2/css/main.css">
<!--===============================================================================================-->
</head>
<body class="login">


  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form role="form" action="<?php echo base_url('index.php/Login/do_login');?>" method="post">
          <span class="login100-form-title p-b-26">
            Akses Login
          </span>
          <span class="login100-form-title p-b-48">
            <i class="zmdi zmdi-library"></i>
          </span>

          <div>
            <input type="text" class="form-control" name="username" placeholder="Username" required="username" />
              </div>
          <div>
            <input type="password" class="form-control" name="password" placeholder="Password" required="password" />
              </div>
<br>
            
              
              <?php echo $this->session->flashdata('gagalLogin')?>
 
            
<br>
            <button type="submit" class="btn btn-lg btn-info btn-block"><i class="fa fa-sign-in"></i> Login</button>
          

        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>Login_V2/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>Login_V2/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>Login_V2/vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo base_url();?>Login_V2/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>Login_V2/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>Login_V2/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?php echo base_url();?>Login_V2/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>Login_V2/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>Login_V2/js/main.js"></script>

</body>
</html>