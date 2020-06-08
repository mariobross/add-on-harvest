<?php
    $this->DB_SAP = $this->load->database('SAP_MSI', TRUE);
    foreach($data->result() as $row)

    $plant=$row->plant;
    $doc=$row->do_no;
    $remark = $row->remark;

    $this->DB_SAP->select('WhsName,City');
    $this->DB_SAP->from('OWHS');
    $this->DB_SAP->where('WhsCode',$plant);

    $query = $this->DB_SAP->get();
    $result = $query->result_array();

    if (empty($result)) {
        $reck='NAMA PLANT (DEFAULT)';
        $reck_loc='LOKASI PLANT (DEFAULT)';
    } else {
        $reck=$result[0]['WhsName'];
        $reck_loc=$result[0]['City'];
    }
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
    <td colspan="2" align="center"><span class="style7">GR From CK SENTUL</span></td>
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
    <td>Transfer Slip No.</td>
    <td>:&nbsp;<?php echo $row->do_no1;?></td>
  </tr>
  <tr>
    <td>Plaza Simatupang Lt. 8 - 9</td>
    <td>Good Receipt No.</td>
    <td>:&nbsp;<?php echo $row->grpodlv_no1;?></td>
  </tr>
  <tr>
    <td>Jl. T.B. Simatupang Kav 1S-1</td>
    <td>Date</td>
    <td>:&nbsp;<?php echo $row->posting_date;?></td>
  </tr>
  <tr>
    <td>Jakarta Selatan, 12310, Indonesia</td>
    <td>Delivery Date</td>
    <td>:&nbsp;<?php echo $row->lastmodified;?></td>
  </tr>
  <tr>
    <td>Ph. +62 21 726 06680 / Fax. +62 21 727 971 59</td>
    <td>Delivery</td>
    <td>:&nbsp;<strong><?php echo $reck;?></strong></td>
  </tr>
</table>

<p>&nbsp;</p>
<<<<<<< HEAD
<table style="border-collapse:collapse;" width="450" border="1" align="center">
    <tr class="head">
        <td width="20" align="center"><strong>No.</strong></td>
        <td width="70" align="center"><strong>Item Code</strong></td>
        <td width="50" align="center"><strong>Description</strong></td>
        <td width="30" align="center"><strong>UOM</strong></td>
        <td width="70" align="center"><strong>SR QTY</strong></td>
        <td width="60" align="center"><strong>TF QTY</strong></td>
        <td width="60" align="center"><strong>GR QTY</strong></td>
=======


<table style="border-collapse:collapse;" width="47%" border="1" align="center">
    <tr>
        <td width="22" align="center" bgcolor="#999999"><strong>No</strong></td>
        <td width="65" align="center" bgcolor="#999999"><strong>Code</strong></td>
        <td width="178" align="center" bgcolor="#999999"><strong>Description</strong></td>
        <td width="35" align="center" bgcolor="#999999"><strong>Uom</strong></td>
        <td width="80" align="center" bgcolor="#999999"><strong>Qty Request</strong></td>
        <td width="83" align="center" bgcolor="#999999"><strong>Qty From CK</strong></td>
        <td width="76"  align="center" bgcolor="#999999"><strong>Qty Receipt</strong></td>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
    </tr>
    <?php 
        $no=1;
        $loop = count($data->result_array());
        $for_no = array();
        foreach($data->result() as $row1) {
            $tf_qty=$row1->Tf_Qty;
            $sr_qty=$row1->Sr_Qty; 
            $gr_qty=$row1->gr_quantity;
            $for_no[]=1;
    ?>
    <tr>
        <td align="center" height="15"><?php echo $no++;?></td>
        <td align="center"><?php echo $row1->material_no;?></td>
        <td>
        <div style="width:300px;">   
        <?php 
        $desc=$row1->material_desc ? $row1->material_desc : '';
        echo $desc; 
        ?>
        </div>
        </td>
        <td align="right"><?php echo $row1->uom;?></td>
        <td align="right"><?php echo substr($sr_qty,0,-2);?></td>
        <td align="right"><?php echo substr($tf_qty,0,-2);?></td>
        <td align="right"><?php echo substr($gr_qty,0,-2);?></td>
    </tr>
    <?php 
    }
    if ($loop==array_sum($for_no)) {
      $h = (510-($loop*19));
    ?>
    <tr>
      <td height="<?php echo $h; ?>"></td>
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
<p class="space"><?php echo $remark;?></p>
<table width="600" border="1"   style="border-collapse:collapse;" align="center">
  <tr>
    <td width="120" align="center" scope="col">Checked By :</td>
    <td width="120" align="center" scope="col">Shipped By (Driver):</td>
    <td width="120" align="center" scope="col">Verified By (Security):</td>
    <td width="120" align="center" scope="col">Verified By (QC):</td>
    <td width="120" align="center" scope="col">Approved By (Manager):</td>
    <td width="120" align="center" scope="col">Posted By (Admin):</td>
  </tr>
  <tr>
    <td height="100" align="left" valign="bottom">(Name)</td>
    <td align="left" valign="bottom">(Name)</td>
    <td align="left" valign="bottom">(Name)</td>
    <td align="left" valign="bottom">(Name)</td>
    <td align="left" valign="bottom">(Name)</td>
    <td align="left" valign="bottom">(Name)</td>
  </tr>
  <tr>
    <td align="left" valign="bottom">(Date)</td>
    <td align="left" valign="bottom">(Date)</td>
    <td align="left" valign="bottom">(Date)</td>
    <td align="left" valign="bottom">(Date)</td>
    <td align="left" valign="bottom">(Date)</td>
    <td align="left" valign="bottom">(Date)</td>
  </tr>
</table>
