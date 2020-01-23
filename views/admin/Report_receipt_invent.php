<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Report In/Out Barang</title>
    <style type="text/css">
      .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 30cm;  
 /* height: 30cm;*/ 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-bottom: 1px solid  #5D6975;
  color: #000000;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
}

#project {
  float: left;
  font-size: 18px;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #000000;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
  background-color: #bbc0c9;
}

/*table tr:nth-child(even){
  background-color: #f2f2f2;
}

table th,
table td {
  text-align: left;
}

table th {
  padding: 5px 20px;
  color: #000000;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
  background-color: #bbc0c9;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: left;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}*/

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <h1>Report Receipt Inventory</h1>
      <div id="project">
        <div>From Date : <?php echo $from; ?></div>
        <br>
        <div>To Date : <?php echo $to; ?></div>
      </div>
    </header>
    <br>
      <table border="1" cellpadding="1">
        <thead>
          <tr>
            <th>Receipt Id</th>
            <th>Date</th>
            <th>Location</th>
            <th>Item Id</th>
            <th>Item Name</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($m_report as $receipt): ?>
            <tr>
              <td><?php echo $receipt->pembelian_id;?></td>
              <td><?php echo $receipt->pembelian_date;?></td>
              <td><?php echo $receipt->nama_lokasi;?></td>
              <td><?php echo $receipt->id_barang;?></td>
              <td><?php echo $receipt->nama_barang;?></td> 
              <td style="width: 5%"><?php echo $receipt->qty;?></td>
              <td style="width: 5%"><?php echo $receipt->unit_id;?></td>
              <td style="width: 5%"><?php echo $receipt->trans_status;?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="col-sm-6 invoice-col text-right">
                          <font color="#00000">
                            <b>Admin Inventory, &nbsp;&nbsp;</b>
                            <br><br><br>
                            <br><br><b>(...........................)</b> 
                          </font>
                        </div>
  </body>
</html>