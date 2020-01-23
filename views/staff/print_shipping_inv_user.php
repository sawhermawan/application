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
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h2 class="text-center">
                            <font color="#00000"><u>SURAT PEMAKAIAN BARANG</u></font>
                          </h2>
                        </div>
                        <!-- /.col -->
                      </div>
                      <br>
                      <?php foreach($m_shipping as $cetak): ?>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                          <font color="#00000">
                            <b>No :</b> <?php echo $cetak->pemakaian_id;?>
                            <br><br><b>Warehouse :</b> <?php echo $cetak->nama_lokasi;?>
                          </font>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col text-right">
                          <font color="#00000">
                            <!-- <?php if (empty($cetak->asset_id)): ?> -->
                              <b>Digunakan Oleh :</b> <?php echo $cetak->fullname;?> || <?php echo $cetak->nama_unit;?>

                           <!--  <?php else: ?>
 -->                             <!--  <b>Used To :</b> <?php echo $cetak->desc_asset;?> -->
                           <!--  <?php endif; ?> -->
                            <br><br><b>Tanggal :</b> <?php echo $cetak->pemakaian_date;?>
                          </font>
                        </div>
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
                              <?php foreach($shipping as $ship): ?>
                                <?php $no++; ?>
                                <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $ship->id_barang; ?></td>
                                  <td><?php echo $ship->nama_barang; ?></td>
                                  <td><?php echo $ship->unit; ?></td>
                                  <td><?php echo $ship->qty; ?></td>
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
                        <div class="col-sm-6 invoice-col">
                          <font color="#00000">
                            <b>Admin Inventory,</b>
                            <br><br><br>
                            <br><br><b>(...........................)</b> 
                          </font>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col text-right">
                          <font color="#00000"><?php foreach($m_shipping as $cetak): ?>
                            <b><?php echo $cetak->fullname;?> &nbsp;&nbsp;</b>
                            <br><br><br>
                            <br><br><b>(...........................)</b> 
                          </font>
                          <?php endforeach; ?>
                        </div>
                      </div>
                      <br><br>


                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button id="printPageButton" class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Print</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="<?php echo base_url('index.php/Shipping_inv_user')?>" id="backButton" title="Click to Edit" class="btn btn-info">Back</a>
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