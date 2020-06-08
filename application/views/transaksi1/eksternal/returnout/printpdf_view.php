<?php
<<<<<<< HEAD
  $SAP_MSI = $this->load->database('SAP_MSI', TRUE);
  $reck = $data[0]['plant'].' - '.$data[0]['plant_name'];
?>

<style type="text/css">

.style5 {font-size: 10px}
.style7 {
	font-size: 28px;
	font-weight: bold;
}
.style8 {
  font-size: 9px;
  margin-left:100px;
}
.style10 {font-size: 24px}
.style12 {font-size: 18px}
.head {font-size:13px}
.m {margin:10px 10px 0 20px}
.space {margin:10px 10px 15px 20px}

</style>

<table width="300"  align="center">
  <tr>
    <td width="350">
      <img src="<?php echo base_url('/files/');?>assets/images/logo.jpeg" alt="logo-harvest" width="270">
    </td>
    <td colspan="2" align="center"><span class="style7">RETUR OUT</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>PT. Mount Scopus Indonesia</strong></td>
    <td>No.</td>
    <td>:&nbsp;<?php echo $data[0]['gisto_dept_no1'];?></td>
  </tr>
  <tr>
    <td>Plaza Simatupang Lt. 8 - 9</td>
    <td>Date</td>
    <td>:&nbsp;<?php echo date("d-m-Y",strtotime($data[0]['posting_date']));
	?></td>
  </tr>
  <tr>
    <td>Jl. T.B. Simatupang Kav 1S-1</td>
    <td>From</td>
    <td>:&nbsp;<strong><?php echo $reck;?></strong></td>
  </tr>
  <tr>
    <td>Jakarta Selatan, 12310, Indonesia</td>
    <td>To</td>
    <td>:&nbsp;<strong><?php echo $data[0]['receiving_plant'].' - '.$data[0]['receiving_plant_name'];?></strong></td>
  </tr>
  <tr>
    <td>Ph. +62 21 726 06680 / Fax. +62 21 727 971 59</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table style="border-collapse:collapse;" width="450" border="1" align="center">
  <tr class="head">
    <td width="20" align="center"><strong>No.</strong></td>
    <td width="70" align="center"><strong>Item Code</strong></td>
    <td width="50" align="center"><strong>Description</strong></td>
    <td width="30" align="center"><strong>QTY</strong></td>
    <td width="30" align="center"><strong>UOM</strong></td>
    <td width="70" align="center"><strong>Production Code</strong></td>
    <td width="50" align="center"><strong>Check Out</strong></td>
    <td width="50" align="center"><strong>Check In</strong></td>
  </tr>
  <?php
  $no = 1;
  $loop = count($data);
  $for_no = array();
  foreach($data as $row1) {
    $item=$row1['material_no'];
    $po=$row1['gisto_dept_no'];
    $SAP_MSI->select('U_Note');
    $SAP_MSI->from('WTR1');
    $SAP_MSI->where('DocEntry',$po);
    $SAP_MSI->where('ItemCode',$item);
    $query = $SAP_MSI->get();
    $sell= $query->result_array();

    $DistNumber='';
    if(count($sell) > 0){
      $DistNumber = $sell[0]['U_Note'];
    } else {
      $DistNumber = '';
    }
    $for_no[] = 1;
  ?>
  <tr>
    <td align="center" height="15"><?php echo $no++;?></td>
    <td align="center"><?php echo $row1["material_no"];?></td>
    <td>
    <div style="width:300px;">   
    <?php 
    $desc=$row1['material_desc'] ? $row1['material_desc'] : '';
    echo $desc; 
    ?>
    </div>
    </td>
    <td align="right">
    <?php 
    $qty=$row1["gr_quantity"];
    echo substr($qty,0,-2);
    ?>
    </td>
    <td align="right"><?php echo $row1["uom"];?></td>
    <td><?php echo $DistNumber;?></td>
    <td></td>
    <td></td>
  </tr>
  <?php
  }
  if ($loop==array_sum($for_no)) {
    $h = (510-($loop*15));
  ?>
  <tr>
    <td height="<?php echo $h ?>"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <?php
  }
  ?>
</table>
<p class="m">Comments :</p>
<p class="space"><?php echo $data[0]['remark'];?></p>
<table width="600" style="border-collapse:collapse;" border="0" align="center">
  <tr>
    <td width="300">
      <table width="300" border="1" style="border-collapse:collapse;">
        <tr>
          <td colspan="3">Loading</td>
        </tr>
        <tr>
          <td width="100">
            <p>Store</p>
            <p>&nbsp;</p>
          </td>
          <td width="100">
            <p>Loading</p>
            <p>&nbsp;</p
          ></td>
          <td width="100">
            <p>Security</p>
            <p>&nbsp;</p>
          </td>
        </tr>
        <tr>
          <td>Name</td>
          <td>Name</td>
          <td>Name</td>
        </tr>
        <tr>
          <td>Date</td>
          <td>Date</td>
          <td>Date</td>
        </tr>
      </table>
    </td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="300">
      <table width="300" border="1" style="border-collapse:collapse;">
        <tr>
          <td colspan="3">Unloading</td>
        </tr>
        <tr>
          <td width="100">
            <p>Store</p>
            <p>&nbsp;</p>
          </td>
          <td width="100">
            <p>Unloading</p>
            <p>&nbsp;</p>
          </td>
          <td width="100">
            <p>Security</p>
            <p>&nbsp;</p>
          </td>
        </tr>
        <tr>
          <td>Name</td>
          <td>Name</td>
          <td>Name</td>
        </tr>
        <tr>
          <td>Date</td>
          <td>Date</td>
          <td>Date</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
=======
    $SAP_MSI = $this->load->database('SAP_MSI', TRUE);
    // foreach($data as $row) 
    // $plant=$row["plant"];
    // $SAP_MSI->select('WhsName');
    // $SAP_MSI->from('OWHS');
    // $SAP_MSI->where('WhsCode', $plant);
    // $query = $SAP_MSI->get();
    // $temp= $query->result_array();
    // $reck=$temp[0]['WhsName'];
    // $doc=$row["do_no"];

?>
<style type="text/css">

<!--
 .style5 {font-size: 10px}
.style6 {
	font-size: 18px;
	font-weight: bold;
}
.style10 {font-size: 24px}
.style8 {font-size: 9px}
.style12 {font-size: 18px} 
-->
</style>

<p>&nbsp;</p>
<table width="679" align="center">
  <tr>
    <td colspan="2" align="left"><p><u><span class="style10"><span class="style12">_____________</span><br />
            <span class="style6">THE HARVEST</span></span></u><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style8">&nbsp;Partisier &amp; Chocolatier</span></p>
    
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><span class="style6">Retur Out</span></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><span class="style6">(baru template laporan, belum isi nya)</span></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong><?php echo '$reck'; ?></strong></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="320"><strong>PT. Mount Scopus Indonesia</strong></td>
    <td width="347">&nbsp;</td>
  </tr>
  <tr>
    <td>Jl. Wolter Monginsidi No.95 Kebayoran Baru</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Jakarta Selatan 12110, Indonesia</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
      <td>Ph. +62 21 726 06680 / Fax. +62 21 727 971 59</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="650" align="center">
  <tr>
    <td>Retur From</td>
    <td width="9">:</td>
    <td><?php //echo $row["FromPlant"].' - '.$row["OUTLET_NAME1"];?></td>
    <td>Retur To </td>
    <td width="9">:</td>
    <td><?php //echo $row["plant"].' - '.$reck;?></td>
  </tr>
  <tr>
    <td width="129" height="21">Retur Out No.</td>
    <td width="9">:</td>
    <td width="220"><?php //echo $row["do_no"];?></td>
    <td width="99">Delivery Addres</td>
    <td width="5">:</td>
    <td><?php echo '$reck' ;?></td>
  </tr>
  <tr>
    <td>Delivery Date </td>
    <td>:</td>
    <td><?php //$date=$row["delivery"];
	//echo substr($date,0,-8);?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table style="border-collapse:collapse;" border="1" align="center">
  <tr>
    <td width="100%" align="center" bgcolor="#999999"><strong>No</strong></td>
    <td width="100%" align="center" bgcolor="#999999"><strong>Code</strong></td>
    <td width="100%" align="center" bgcolor="#999999"><strong>Description</strong></td>
    <td width="100%" align="center" bgcolor="#999999"><strong>Uom</strong></td>
	  <td width="100%" align="center" bgcolor="#999999"><strong>Qty Retur</strong></td>
    <td width="100%" align="center" bgcolor="#999999"><strong>Qty Receipt</strong></td>
    <td width="100%"  align="center" bgcolor="#999999"><strong>Reason</strong></td>
    <td width="100%"  align="center" bgcolor="#999999">Batch Number</td>
  </tr>
  <?php
  $no = 1;
  foreach($data as $row1) 
    {
  ?>

  <?php 
	  $item=$row1["material_no"];	
    $SAP_MSI->select('OBTN.DistNumber,OBTN.ExpDate');
    $SAP_MSI->from('OITL');
    $SAP_MSI->join('ITL1','OITL.LogEntry = ITL1.LogEntry','inner');
    $SAP_MSI->join('OBTN','ITL1.ItemCode = OBTN.ItemCode and ITL1.SysNumber = OBTN.SysNumber','inner');
    $SAP_MSI->where('DocEntry',$doc);
    $SAP_MSI->where('DocType', 67);
    $SAP_MSI->where('OITL.StockQty >',0);
    $SAP_MSI->where('OITL.ItemCode',$item);
    $query = $SAP_MSI->get();
    $sell= $query->result_array();	
    
    // echo $SAP_MSI->last_query();

    $selExpDate='';
      if(count($sell) > 0){
        $selExpDate = $sell['ExpDate'];
      }
    $DistNumber='';
      if(count($sell) > 0){
        $DistNumber = $sell['DistNumber'];
      }
	?>
  
   
  <tr>
    <td align="center"><?php //echo $no++; ?></td>
    <td>&nbsp;<?php //echo $row1["material_no"]; ?></td>
    <td>&nbsp;<?php //echo $row1["material_desc"]; ?></td>
    <td align="right"><?php //echo $row1["uom"]; ?>&nbsp;</td>
	  <td align="right"><?php $qty=$row1["Qty_Retur"]; //echo substr($qty,0,-2); ?>&nbsp;</td>
    <td align="right"><?php $qty=$row1["gr_quantity"]; //echo substr($qty,0,-2); ?>&nbsp;</td>
    <td>&nbsp;<?php //echo $row1["reason"]; ?></td>
    <td>&nbsp;<?php //echo $DistNumber;?></td>
  </tr>
  <?php
  }
  ?>
  
  <!-- <tr>
    <td height="69" colspan="9" >Remark :</td>
  </tr> -->
</table>
<p>&nbsp;</p>
<table width="491" align="center">
  <tr>
    <td width="161" align="center">Received by :</td>
    <td width="149" align="center">Approved by :</td>
    <td width="159" align="center">Verified by :</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">(User)</td>
    <td align="center">(<?php //echo $row1["nameApproved"];?>)</td>
    <td align="center">(<?php //echo $row1["nameApproved"];?>)</td>
  </tr>
</table>
<p>&nbsp;</p>
<div align="justify"></div>
<table width="640" align="center">
  <tr>
    <td width="10"><span class="style5">1.</span></td>
    <td width="618"><span class="style3 style5"> FILLOUT IN DUPLICATE RETAIL YELLOW COPY FOR YOURFILE</span></td>
  </tr>
  <tr>
    <td><span class="style5">2.</span></td>
    <td><span class="style3 style5"> DEPARTEMENT MANAGERS MUST SIGN PRIOR TO ORDERING</span></td>
  </tr>
  <tr>
    <td><span class="style5">3.</span></td>
    <td><span class="style3 style5"> RECEIVING - RED</span></td>
  </tr>
  <tr>
    <td><span class="style5">4.</span></td>
    <td><span class="style3 style5"> USER - BLUE</span></td>
  </tr>
</table>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
