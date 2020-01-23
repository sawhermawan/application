        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inventory <small>All Transaction</small></h3>
              </div>

              <div class="pull-right">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Management</a></li>
                  <li><a href="<?php echo base_url('index.php/Stock_inv_user')?>">Stock</a></li>
                  <li class="active">View Detail Stock</li>
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
                        <h3>View Detail Stock</h3>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                
                  <div class="x_content">
                    <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."> -->
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr class="info">
                          <th>No</th>
                          <th>Trans ID</th>
                          <th>Trans Date</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Item</th>
                          <th>Unit</th>
                          <th>Qty</th>
                          <th>Trans Type</th>
                          <th>Trans Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $no = 0; ?>
                      <?php foreach($m_history as $all_trans): ?>
                      <?php $no++; ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td>
                            <?php
                              if($all_trans->inv_status == 'Receipt')
                                echo $all_trans->pembelian_id;
                              else if($all_trans->inv_status == 'Transfer')
                                echo $all_trans->transfer_id;
                              else if($all_trans->inv_status == 'Used')
                                echo $all_trans->pemakaian_id;
                            ?>  
                          </td>
                          <td><?php echo $all_trans->history_date; ?></td>
                          <td>
                            <?php
                              if($all_trans->inv_status == 'Receipt')
                                echo $all_trans->receipt_location;
                              else if($all_trans->inv_status == 'Transfer')
                                echo $all_trans->transfer_location;
                              else if($all_trans->inv_status == 'Used')
                                echo $all_trans->shipping_location;
                            ?> 
                          </td>
                          <td>
                            <?php
                              if($all_trans->inv_status == 'Transfer') 
                                echo $all_trans->trans_to_Location_name; 
                              else if($all_trans->inv_status == 'Used')
                                echo $all_trans->fullname;
                            ?> 
                          </td>
                          <td><?php echo $all_trans->nama_barang; ?></td>
                          <td><?php echo $all_trans->desc_unit; ?></td>
                          <td><?php echo $all_trans->qtyTrans; ?></td>
                          <td><?php echo $all_trans->inv_status; ?></td>
                          <td><?php echo $all_trans->status_trans; ?></td>
                          <td class="text-center">
                          <!-- <?php if($all_trans->inv_status == 'Receipt'): ?>
                            <a href="<?php echo base_url('index.php/Receipt/view/'.$all_trans->pembelian_id)?>" title="Click to Edit" class="btn btn-info"><i class="fa fa-edit"></i> View Detail</a>
                          <?php elseif($all_trans->inv_status == 'Transfer'): ?>
                            <a href="<?php echo base_url('index.php/Transfer/edit/'.$all_trans->transfer_id)?>" title="Click to Edit" class="btn btn-info"><i class="fa fa-edit"></i> View Detail</a>
                          <?php else: ?>
                            <a href="<?php echo base_url('index.php/Shipping/edit/'.$all_trans->pemakaian_id)?>" title="Click to Edit" class="btn btn-info"><i class="fa fa-edit"></i> View Detail</a>
                          <?php endif; ?> -->

                          <?php if($all_trans->inv_status == 'Receipt'): ?>
                            <a href="<?php echo base_url('index.php/All_transaction/ReceiptDetail/'.$all_trans->pembelian_id)?>" title="Click to Edit" class="btn btn-info"><i class="fa fa-edit"></i> View Detail</a>
                          <?php elseif($all_trans->inv_status == 'Transfer'): ?>
                            <a href="<?php echo base_url('index.php/All_transaction/TransferDetail/'.$all_trans->transfer_id)?>" title="Click to Edit" class="btn btn-info"><i class="fa fa-edit"></i> View Detail</a>
                          <?php else: ?>
                            <a href="<?php echo base_url('index.php/All_transaction/UsedDetail/'.$all_trans->pemakaian_id)?>" title="Click to Edit" class="btn btn-info"><i class="fa fa-edit"></i> View Detail</a>
                          <?php endif; ?>
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

         <!--  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("datatable-checkbox");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script> -->