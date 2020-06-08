<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Disassembly_model extends CI_Model {

<<<<<<< HEAD
	function freeze(){
		$kd_plant = $this->session->userdata['ADMIN']['plant'];
		$this->db->select('freeze, am_approved, rm_approved');
		$this->db->from('t_opname_header');
		$this->db->where('plant',$kd_plant);
		$this->db->order_by('id_opname_header','desc');
		$this->db->limit(1);
		
		$query = $this->db->get();
	
		if(($query)&&($query->num_rows() > 0)){
		  return $query->row_array();
		}else{
		  return FALSE;
		}
	}

	public function getDataWoVendor_Header($fromDate='', $toDate='', $status=''){
		$arr 		=	array();
		$kd_plant = $this->session->userdata['ADMIN']['plant'];
		$this->db->select('a.*,
		b.doc_issue,
		(SELECT admin_realname FROM d_admin WHERE admin_id = a.id_user_input)created_by,
		(SELECT admin_realname FROM d_admin WHERE admin_id = a.id_user_approved)approved_by');
		$this->db->from('t_disassembly_header a');
		$this->db->join('t_disassembly_detail b', 'a.id_disassembly_header = b.id_disassembly_header');
		$this->db->where('a.plant', $kd_plant);
		
		if((!empty($fromDate)) || (!empty($toDate))){
			if( (!empty($fromDate)) || (!empty($toDate)) ) {
				$this->db->where("posting_date BETWEEN '$fromDate' AND '$toDate'");
			} else if( (!empty($fromDate))) {
				$this->db->where("posting_date >= '$fromDate'");
			} else if( (!empty($toDate))) {
				$this->db->where("posting_date <= '$toDate'");
			}
		}

		if((!empty($status))){
			$this->db->where('status', $status);
		}
		$this->db->group_by('a.id_disassembly_header');
		$this->db->group_by('a.id_disassembly_plant');
		$this->db->group_by('a.posting_date');
		$this->db->group_by('a.disassembly_no');
		$this->db->group_by('a.plant');
		$this->db->group_by('a.plant_name');
		$this->db->group_by('a.storage_location');
		$this->db->group_by('a.storage_location_name');
		$this->db->group_by('a.created_date');
		$this->db->group_by('a.kode_paket');
		$this->db->group_by('a.nama_paket');
		$this->db->group_by('a.qty_paket');
		$this->db->group_by('a.status');
		$this->db->group_by('a.id_user_input');
		$this->db->group_by('a.id_user_cancel');
		$this->db->group_by('a.id_user_approved');
		$this->db->group_by('a.filename');
		$this->db->group_by('a.lastmodified');
		$this->db->group_by('a.num');
		$this->db->group_by('a.uom_paket');
		$this->db->group_by('a.back');
		$this->db->group_by('a.disassembly_no1');
		$this->db->group_by('a.doc_issue');
		$this->db->group_by('b.doc_issue');
		$this->db->order_by('a.id_disassembly_header', 'DESC');

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
  
	function disassembly_header_delete($id_wo_header){
		$data = $this->disassembly_header_select($id_wo_header);
		$status = $data['status'];
		if ($status!=2) {
			if($this->disassembly_details_delete($id_wo_header)){
				$this->db->where('id_disassembly_header', $id_wo_header);
				if($this->db->delete('t_disassembly_header'))
					return TRUE;
				else
					return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	
	function disassembly_details_delete($id_wo_header) {
		$this->db->where('id_disassembly_header', $id_wo_header);
		if($this->db->delete('t_disassembly_detail'))
			return TRUE;
		else
			return FALSE;
	}

	function disassembly_header_select($id_disassembly_header){
		$arr 	=	array();
		$this->db->from('t_disassembly_header');
		$this->db->where('id_disassembly_header', $id_disassembly_header);
		$query = $this->db->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->row_array();
		}else{
		return FALSE;
		}
	}
	
	function disassembly_detail_valid($material_no){
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select('OITM.validFor,OITB.DecreasAc');
		$SAP_MSI->from('OITM');
		$SAP_MSI->join('OITB','OITM.ItmsGrpCod = OITB.ItmsGrpCod');
		$SAP_MSI->where('ItemCode',$material_no);
		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
  
	function disassembly_detail_onhand($material_no){
		$kd_plant = $this->session->userdata['ADMIN']['plant'];
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select("OnHand,MinStock");
		$SAP_MSI->from('OITW');
		$SAP_MSI->where('ItemCode',$material_no);
		$SAP_MSI->where('WhsCode',$kd_plant);
		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
  
	function disassembly_detail_itemcodebom($kode_paket,$material_no){
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->distinct();
		$SAP_MSI->select("T1.U_SubsName as NAME,T1.U_ItemCodeBOM,T1.U_SubsQty,T1.U_SubsCode,T1.Code,T1.U_SubsUOM");
		$SAP_MSI->from('@MSI_ALT_ITM_HDR T0');
		$SAP_MSI->join('@MSI_ALT_ITM_DTL T1','T1.Code = T0.Code');
		$SAP_MSI->where('T0.Code',$kode_paket);
		$SAP_MSI->where('T1.U_ItemCodeBOM',$material_no);
		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	} 
	
	function disassembly_detail_openqty($material_no){
		$kd_plant = $this->session->userdata['ADMIN']['plant'];
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select("SUM(OpenQty) as OpenQty");
		$SAP_MSI->from('WTQ1');
		$SAP_MSI->where('ItemCode',$material_no);
		$SAP_MSI->where('WhsCode',$kd_plant);
		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
  
	function disassembly_detail_item(){
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select('ItemCode as MATNR, ItemName as MAKTX');
		$SAP_MSI->from('OITM');

		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
	
	function disassembly_detail_uom($material_no){
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select('InvntryUom as UNIT');
		$SAP_MSI->from('OITM');

		if($material_no != ''){
			$SAP_MSI->where('ItemCode',$material_no);
		}
		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
  
	function disassembly_detail_ucaneditqty($kode_paket,$material_no){
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select("U_CanEditQty as CanEditQty");
		$SAP_MSI->from('ITT1');
		$SAP_MSI->where('Code',$material_no);
		$SAP_MSI->where('Father',$kode_paket);
		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}

	function sap_disassembly_select_locked($material_no){
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select("U_Locked");
		$SAP_MSI->from('OITT');
		$SAP_MSI->where('Code', $material_no);
		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
  
	function sap_disassembly_headers_select_by_item($material_no=''){
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select("T0.Code, T1.ItemName, T0.U_Locked, T1.InvntryUom, T1.OnHand");
		$SAP_MSI->from('OITT T0');
		$SAP_MSI->join('OITM T1','T1.ItemCode = T0.Code');
		$SAP_MSI->where('T0.U_disassembly',"Y");

		if($material_no != ''){
			$SAP_MSI->where('T0.Code',$material_no);
		}
		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
  
	function wo_detail_select($id_wo_header){
		$this->db->from('t_produksi_detail');
		$this->db->where('id_produksi_header', $id_wo_header);
		$this->db->order_by('id_produksi_detail');
		$query = $this->db->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}

	function wo_detail_quantity($kode_paket,$material_no){
		$kd_plant = $this->session->userdata['ADMIN']['plant'];
		$this->db->select('quantity,quantity_paket');
		$this->db->from('m_mpaket_detail');
		$this->db->join('m_mpaket_header','m_mpaket_detail.id_mpaket_header = m_mpaket_header.id_mpaket_header');
		$this->db->where('m_mpaket_header.kode_paket', $kode_paket);
		$this->db->where('m_mpaket_header.plant', $kd_plant);
		$this->db->where('m_mpaket_detail.material_no', $material_no);
		$query = $this->db->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
  
	function disassembly_details_input_select($kode_paket){
		$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
		$SAP_MSI->select("a.Father id_mpaket_header,a.ChildNum id_mpaket_h_detail, a.Code material_no, b.ItemName material_desc, a.Quantity quantity, b.InvntryUom uom");
		$SAP_MSI->from('ITT1 a');
		$SAP_MSI->join('OITM b','a.Code = b.ItemCode');
		$SAP_MSI->where('a.Father', $kode_paket);

		$query = $SAP_MSI->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}
  
	function posting_date_select_max() {
		$kd_plant = $this->session->userdata['ADMIN']['plant'];
		$this->db->select_max('posting_date');
		$this->db->from('t_posinc_header');
		$this->db->where('plant', $kd_plant);
		$this->db->where('status', 2);

		$query = $this->db->get();
		if ($query) {
		$posting_date = $query->row_array();
		}
		if(!empty($posting_date['posting_date'])) {
			$oneday = 60 * 60 * 24;
				$posting_date = date("Y-m-d H:i:s", strtotime($posting_date['posting_date'])+ $oneday);
				return $posting_date;
		}	else {
			return date("Y-m-d H:i:s");
		}
	}
=======
  public function getDataWoVendor_Header($fromDate='', $toDate='', $status=''){
	  $arr 		=	array();
	  $kd_plant = $this->session->userdata['ADMIN']['plant'];
	  $this->db->select('a.*,
	  b.doc_issue,
	  (SELECT admin_realname FROM d_admin WHERE admin_id = a.id_user_input)created_by,
	  (SELECT admin_realname FROM d_admin WHERE admin_id = a.id_user_approved)approved_by');
	  $this->db->from('t_disassembly_header a');
	  $this->db->join('t_disassembly_detail b', 'a.id_disassembly_header = b.id_disassembly_header');
	  $this->db->where('a.plant', $kd_plant);
	  
      if((!empty($fromDate)) || (!empty($toDate))){
          if( (!empty($fromDate)) || (!empty($toDate)) ) {
			  $this->db->where("posting_date BETWEEN '$fromDate' AND '$toDate'");
		  } else if( (!empty($fromDate))) {
			  $this->db->where("posting_date >= '$fromDate'");
		  } else if( (!empty($toDate))) {
			  $this->db->where("posting_date <= '$toDate'");
		  }
	  }

	  if((!empty($status))){
		  $this->db->where('status', $status);
	  }
	  $this->db->group_by('a.id_disassembly_header');
	  $this->db->order_by('a.id_disassembly_header', 'DESC');

	  $query = $this->db->get();

	  if($query->num_rows() > 0){
		  return $query->result_array();
	  }else{
		  return FALSE;
	  }
  }
  
  function disassembly_header_delete($id_wo_header){
    if($this->disassembly_details_delete($id_wo_header)){
		$this->db->where('id_disassembly_header', $id_wo_header);
		if($this->db->delete('t_disassembly_header'))
			return TRUE;
		else
			return FALSE;
    }
  }
  
  function disassembly_details_delete($id_wo_header) {
	$this->db->where('id_disassembly_header', $id_wo_header);
	if($this->db->delete('t_disassembly_detail'))
		return TRUE;
	else
		return FALSE;
  }

  
  function disassembly_header_select($id_disassembly_header){
	$arr 	=	array();
    $this->db->from('t_disassembly_header');
    $this->db->where('id_disassembly_header', $id_disassembly_header);
    $query = $this->db->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->row_array();
    }else{
      return FALSE;
    }
  }
  
  function disassembly_detail_valid($material_no){
	$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
	$SAP_MSI->select('OITM.validFor,OITB.DecreasAc');
	$SAP_MSI->from('OITM');
	$SAP_MSI->join('OITB','OITM.ItmsGrpCod = OITB.ItmsGrpCod');
	$SAP_MSI->where('ItemCode',$material_no);
	$query = $SAP_MSI->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }
  
  function disassembly_detail_onhand($material_no){
	$kd_plant = $this->session->userdata['ADMIN']['plant'];
	$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
	$SAP_MSI->select("OnHand,MinStock");
	$SAP_MSI->from('OITW');
	$SAP_MSI->where('ItemCode',$material_no);
	$SAP_MSI->where('WhsCode',$kd_plant);
	$query = $SAP_MSI->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }
  
  function disassembly_detail_itemcodebom($kode_paket,$material_no){
	$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
	$SAP_MSI->distinct();
	$SAP_MSI->select("T1.U_SubsName as NAME,T1.U_ItemCodeBOM,T1.U_SubsQty,T1.U_SubsCode,T1.Code");
	$SAP_MSI->from('@MSI_ALT_ITM_HDR T0');
	$SAP_MSI->join('@MSI_ALT_ITM_DTL T1','T1.Code = T0.Code');
	$SAP_MSI->where('T0.Code',$kode_paket);
	$SAP_MSI->where('T1.U_ItemCodeBOM',$material_no);
	$query = $SAP_MSI->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  } 
  
  function disassembly_detail_openqty($material_no){
	$kd_plant = $this->session->userdata['ADMIN']['plant'];
	$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
	$SAP_MSI->select("SUM(OpenQty) as OpenQty");
	$SAP_MSI->from('WTQ1');
	$SAP_MSI->where('ItemCode',$material_no);
	$SAP_MSI->where('WhsCode',$kd_plant);
	$query = $SAP_MSI->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }
  
  function disassembly_detail_item(){
	$this->db->select('MATNR,MAKTX');
	$this->db->from('m_item');
	$query = $this->db->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }
  
  function disassembly_detail_uom($material_no){
	$this->db->select('UNIT');
	$this->db->from('m_item');
	$this->db->where('MATNR', $material_no);
	$query = $this->db->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }
  
  function disassembly_detail_ucaneditqty($kode_paket,$material_no){
	$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
	$SAP_MSI->select("U_CanEditQty as CanEditQty");
	$SAP_MSI->from('ITT1');
	$SAP_MSI->where('Code',$material_no);
	$SAP_MSI->where('Father',$kode_paket);
	$query = $SAP_MSI->get();


    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }

  function sap_disassembly_select_locked($material_no){
	$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
	$SAP_MSI->select("U_Locked");
	$SAP_MSI->from('OITT');
	$SAP_MSI->where('Code', $material_no);
	$query = $SAP_MSI->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }
  
  function sap_disassembly_headers_select_by_item($material_no=''){
	$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
	$SAP_MSI->select("T0.Code,T1.ItemName,T0.U_Locked, T1.BuyUnitMsr");
	$SAP_MSI->from('OITT T0');
	$SAP_MSI->join('OITM T1','T1.ItemCode = T0.Code');

	if($material_no != ''){
		$SAP_MSI->where('T0.Code',$material_no);
	}
	//$SAP_MSI->where('T0.U_Locked !=', NULL);
	$query = $SAP_MSI->get();
	// echo $SAP_MSI->last_query();
	// die();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }
  
  function wo_detail_select($id_wo_header){
	$this->db->from('t_produksi_detail');
    $this->db->where('id_produksi_header', $id_wo_header);
	$this->db->order_by('id_produksi_detail');
	$query = $this->db->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }

  function wo_detail_quantity($kode_paket,$material_no){
	$kd_plant = $this->session->userdata['ADMIN']['plant'];
	$this->db->select('quantity,quantity_paket');
	$this->db->from('m_mpaket_detail');
	$this->db->join('m_mpaket_header','m_mpaket_detail.id_mpaket_header = m_mpaket_header.id_mpaket_header');
	$this->db->where('m_mpaket_header.kode_paket', $kode_paket);
	$this->db->where('m_mpaket_header.plant', $kd_plant);
	$this->db->where('m_mpaket_detail.material_no', $material_no);
	$query = $this->db->get();

    if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
    }else{
      return FALSE;
    }
  }
  
  function disassembly_details_input_select($kode_paket){
	$SAP_MSI = $this->load->database('SAP_MSI', TRUE);
	$SAP_MSI->select("a.Father id_mpaket_header,a.ChildNum id_mpaket_h_detail, a.Code material_no, b.ItemName material_desc, a.Quantity quantity, b.InvntryUom uom");
	$SAP_MSI->from('ITT1 a');
	$SAP_MSI->join('OITM b','a.Code = b.ItemCode');
	$SAP_MSI->where('a.Father', $kode_paket);

	$query = $SAP_MSI->get();

	if(($query)&&($query->num_rows() > 0)){
		return $query->result_array();
	}else{
	return FALSE;
	}
}
  
  function posting_date_select_max() {
	$kd_plant = $this->session->userdata['ADMIN']['plant'];
    $this->db->select_max('posting_date');
    $this->db->from('t_posinc_header');
    $this->db->where('plant', $kd_plant);
    $this->db->where('status', 2);

    $query = $this->db->get();
    if ($query) {
      $posting_date = $query->row_array();
    }
    if(!empty($posting_date['posting_date'])) {
        $oneday = 60 * 60 * 24;
            $posting_date = date("Y-m-d H:i:s", strtotime($posting_date['posting_date'])+ $oneday);
            return $posting_date;
    }	else {
          return date("Y-m-d H:i:s");
    }
  }
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
  
	function id_produksi_plant_new_select($id_outlet,$posting_date="",$id_produksi_header="") {

        if (empty($posting_date))
<<<<<<< HEAD
		   $posting_date=$this->posting_date_select_max();
		   $posting_date = strtotime($posting_date);
		   $posting_date = date("Y-m-d", $posting_date);
=======
           $posting_date=$this->posting_date_select_max();
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
        if (empty($id_outlet))
           $id_outlet=$this->session->userdata['ADMIN']['plant'];

		$this->db->select_max('id_disassembly_plant');
		$this->db->from('t_disassembly_header');
		$this->db->where('plant', $id_outlet);
<<<<<<< HEAD
		$this->db->where('posting_date', $posting_date);
=======
		$this->db->where('DATE(posting_date)', $posting_date);
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
        if (!empty($id_produksi_header)) {
    	  $this->db->where('id_disassembly_header <> ', $id_produksi_header);
        }

		$query = $this->db->get();

		if(($query)&&($query->num_rows() > 0)) {
			$produksi = $query->row_array();
			$id_produksi_outlet = $produksi['id_disassembly_plant'] + 1;
		}	else {
			$id_produksi_outlet = 1;
		}

		return $id_produksi_outlet;
	}
  
<<<<<<< HEAD
	function disassembly_details_select($id_wo_header,$kode_paket,$qty_paket){
		$arr 	=	array();
		$this->db->from('t_disassembly_detail');
		$this->db->where('id_disassembly_header', $id_wo_header);
		$this->db->order_by('id_disassembly_detail');
		$query = $this->db->get();
		$ret = $query->result_array();
		return $ret;
	}
=======
  function disassembly_details_select($id_wo_header,$kode_paket,$qty_paket){
	$arr 	=	array();
	$this->db->from('t_disassembly_detail');
    $this->db->where('id_disassembly_header', $id_wo_header);
	$this->db->order_by('id_disassembly_detail');
	$query = $this->db->get();
	$ret = $query->result_array();
	return $ret;
  }
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3

	function disassembly_header_batch($item,$whs){
		$this->db->select('*');
		$this->db->from('m_batch');
		$this->db->where('ItemCode', $item);
		$this->db->where('Whs', $whs);
		$query = $this->db->get();

		if(($query)&&($query->num_rows() > 0)){
			return $query->result_array();
		}else{
		return FALSE;
		}
	}

	function disassembly_detail_insert($data) {
		if($this->db->insert('t_disassembly_detail', $data))
			return $this->db->insert_id();
		else
			return FALSE;
	}

	function disassembly_header_insert($data) {
		if($this->db->insert('t_disassembly_header', $data))
			return $this->db->insert_id();
		else
			return FALSE;
	}

	function update_disassembly_header($disassembly_header){
<<<<<<< HEAD
		$update = array(
			'status' => $disassembly_header['status'],
			'id_user_approved' => $disassembly_header['id_user_approved']
		);
		$this->db->where('id_disassembly_header', $disassembly_header['id_disassembly_header']);
        if($this->db->update('t_disassembly_header', $update))
=======
		$this->db->where('id_disassembly_header', $disassembly_header['id_disassembly_header']);
        if($this->db->update('t_disassembly_header', $disassembly_header))
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
			return TRUE;
		else
			return FALSE;
	}

<<<<<<< HEAD
	function sap_item($itemNo = ''){
		$kd_plant = $this->session->userdata['ADMIN']['plant'];
        $SAP_MSI = $this->load->database('SAP_MSI', TRUE);
        $SAP_MSI->select('t0.ItemCode as MATNR,t0.ItemName as MAKTX,t0.ItmsGrpCod as DISPO,t0.InvntryUom as UNIT,t1.ItmsGrpNam as DSNAM');
        $SAP_MSI->from('OITM  t0');
        $SAP_MSI->join('oitb t1','t1.ItmsGrpCod = t0.ItmsGrpCod','inner');
        $SAP_MSI->where('validFor', 'Y');
		$SAP_MSI->where('t0.InvntItem', 'Y');

		if($itemNo != ''){
			$SAP_MSI->where('ItemCode', $itemNo);
		}
		
		$query = $SAP_MSI->get();
        
        if(($query)&&($query->num_rows() > 0)) {
            return $query->result_array();
        }else {
            return FALSE;
        }
	}
=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3

}