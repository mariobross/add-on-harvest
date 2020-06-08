<?php
  $SAP_MSI = $this->load->database('SAP_MSI', TRUE);
  foreach($data as $row) 
    $plant=$row["plant"];
    $SAP_MSI->select('WhsName');
    $SAP_MSI->from('OWHS');
    $SAP_MSI->where('WhsCode', $plant);
    $query = $SAP_MSI->get();
    $temp= $query->result_array();
    $reck=$temp[0]['WhsName'];
    $doc=$row["do_no"];
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
    <td colspan="2" align="center"><span class="style7">RETUR IN</span></td>
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
    <td>:&nbsp;<?php echo $row['retin_no1'];?></td>
  </tr>
  <tr>
    <td>Plaza Simatupang Lt. 8 - 9</td>
    <td>Date</td>
    <td>:&nbsp;<?php echo date("d-m-Y",strtotime($row['posting_date']));
	?></td>
  </tr>
  <tr>
    <td>Jl. T.B. Simatupang Kav 1S-1</td>
    <td>From</td>
    <td>:&nbsp;<strong><?php echo $row["FromPlant"].' - '.$row["OUTLET_NAME1"];?></strong></td>
  </tr>
  <tr>
    <td>Jakarta Selatan, 12310, Indonesia</td>
    <td>To</td>
    <td>:&nbsp;<strong><?php echo $row["plant"].' - '.$reck;?></strong></td>
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
    $item=$row1["material_no"];	
    $SAP_MSI->select('U_Note');
    $SAP_MSI->from('WTR1');
    $SAP_MSI->where('DocEntry',$doc);
    $SAP_MSI->where('ItemCode',$item);
    $query = $SAP_MSI->get();
    $sell= $query->result_array();

    $DistNumber='';
    if(count($sell) > 0){
      $DistNumber = $sell[0]['U_Note'];
    } else {
      $DistNumber = '';
    }
    $for_no[]=1;
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
    <td height="<?php echo $h;?>"></td>
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

