<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PT. Terra Concrete Perkasa</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row --><?php foreach($m_transfer as $cetak): ?>
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h2 class="text-center">
                            <font color="#00000"><u>MUTASI ANTAR GUDANG</u></font>
                          </h2>
                        </div>
                        <h4 class="text-center">
                            NO : <?php echo $cetak->transfer_id;?>
                          </h4>
                        <!-- /.col -->
                      </div>
                      <br>
                      
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                          <font color="#00000">
                            <b>Location From :</b> <?php echo $cetak->location_name_from;?>
                            <br><br><b>Location To :</b> <?php echo $cetak->location_name_to;?>
                            <br><br><b>Date :</b> <?php echo $cetak->transfer_date;?>
                          </font>
                        </div>

                        <div class="col-sm-2 invoice-col text-right">
                          <font color="#00000">
                             <b>Keterangan :</b>
                          </font>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <font color="#00000">
                             <p align="Justify"><?php echo $cetak->description; ?></p>
                          </font>
                        </div>
                        <!-- /.col -->
                      </div>
                      <?php endforeach; ?>
                      <!-- /.row -->
                      <br><br>
                      
                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped" rules="rows" border="1">
                            <thead>
                              <tr>
                                <th style="width: 20%">No</th>
                                <th style="width: 20%">Kode Barang</th>
                                <th style="width: 20%">Nama Barang</th>
                                <th style="width: 20%">Satuan</th>
                                <th style="width: 20%">Jumlah</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $no = 0; ?>
                              <?php foreach($transfer as $trans): ?>
                                <?php $no++; ?>
                                <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $trans->id_barang; ?></td>
                                  <td><?php echo $trans->nama_barang; ?></td>
                                  <td><?php echo $trans->unit; ?></td>
                                  <td><?php echo $trans->qty; ?></td>
                                </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <br><br>
                      <!-- /.row -->
                      <div class="row invoice-info">
                        <!-- /.col -->
                        <div class="col-sm-2 invoice-col text-center">
                          <font color="#00000">
                            <b>KA Gudang</b>
                            <br><br><br>
                            <br><br><b>(...........................)</b> 
                          </font>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col text-center">
                          <font color="#00000">
                            <b>Kepala Bagian</b>
                            <br><br><br>
                            <br><br><b>(...........................)</b> 
                          </font>
                        </div>

                        <div class="col-sm-2 invoice-col text-left">
                          <font color="#00000">
                            <b>&nbsp;&nbsp;&nbsp;Pengirim</b>
                            <br><br><br>
                            <br><br><b>(...........................)</b> 
                          </font>
                        </div>

                        <div class="col-sm-2 invoice-col text-center">
                          <font color="#00000">
                            <b>Supir</b>
                            <br><br><br>
                            <br><br><b>(...........................)</b> 
                          </font>
                        </div>

                        <div class="col-sm-3 invoice-col text-center">
                          <font color="#00000">
                            <b>Penerima</b>
                            <br><br><br>
                            <br><br><b>(...........................)</b> 
                          </font>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-11 invoice-col text-right">
                          <p>*Nama jelas & cap</p>
                        </div>
                      </div>
                      <br><br>


                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button id="printPageButton" class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Print</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="<?php echo base_url('index.php/Transfer_inv_user')?>" id="backButton" title="Click to Edit" class="btn btn-info">Back</a>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<style type="text/css">
      @media print {
      #printPageButton {
        display: none;
      }
    }

    </style>

    <style type="text/css">
      @media print {
      #backButton {
        display: none;
      }
    }

    </style>
    <style type="text/css" media="print">
      @page 
      {
          size: auto;
          margin: 0mm;
      }
    </style>