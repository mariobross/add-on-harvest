<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Goodissue extends CI_Controller {
    public function __construct(){
        parent::__construct();

        $this->load->library('auth');  
		if(!$this->auth->is_logged_in()) {
			redirect(base_url());
        }
        // load model
        $this->load->model('transaksi1/goodissue_model', 'gi_model');
<<<<<<< HEAD
        $this->load->model('transaksi1/stock_model', 'st_model');
=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
        $this->load->library('form_validation');
        $this->load->library('l_general');
    }

    public function index(){
        $object['opname_header']['freeze'] = $this->st_model->freeze();
        $arr_ids = explode(", ",$this->session->userdata['ADMIN']['admin_perm_grup_ids']);
        $ids = '';
        foreach($arr_ids as $val){
            if($val == 14){
                $ids = $val;
            }elseif($val == 10064){
                $ids = $val;
            }
        }
        $object['opname_header']['ids'] = $ids;
        $this->load->view('transaksi1/eksternal/goodissue/list_view', $object);
    }

    public function showAllData(){
        $fromDate = $this->input->post('fDate');
        $toDate = $this->input->post('tDate');
        $status = $this->input->post('stts');

        $date_from2;
        $date_to2;

		$status_string='';
        $data = array();

        if($fromDate != '') {
			$year = substr($fromDate, 6);
			$month = substr($fromDate, 3,2);
			$day = substr($fromDate, 0,2);
			$date_from2 = $year.'-'.$day.'-'.$month.' 00:00:00';
        }else{
            $date_from2='';
        }

        if($toDate != '') {
			$year = substr($toDate, 6);
			$month = substr($toDate, 3,2);
			$day = substr($toDate, 0,2);
			$date_to2 = $year.'-'.$day.'-'.$month.' 23:59:59';
        }else{
            $date_to2='';
        }

        $gi = $this->gi_model->getDataGI_Header($date_from2, $date_to2, $status);

        foreach ($gi as $val) {
            if($val['status'] =='1'){
				$status_string= 'Not Approved';
			}elseif($val['status'] =='2'){
				$status_string= 'Approved';
			}else{
				$status_string= 'Cancel';
            }
<<<<<<< HEAD

            if ($val['back']=='1' && $val['material_doc_no'] == '') {
                $log = 'Not Integrated';
            } else {
                $log = 'Integrated';
            }
            $giData = array();
            $giData['id_issue_header'] = $val['id_issue_header'];
            $giData['material_doc_no'] = $val['material_doc_no'];
            $giData['posting_date'] = date("d-m-Y",strtotime($val['posting_date']));
            $giData['status'] = $val['status'];
            $giData['status_string'] = $status_string; 
            $giData['log'] = $log; 
            $data[] = $giData;
        }
 
        $json_data = array(
            "recordsTotal"    => 10, 
            "recordsFiltered" => 12,
            "data"            => $data 
        );
        echo json_encode($json_data);
=======
            $giData = array();
            $giData['id_issue_header'] = $val['id_issue_header'];
            $giData['posting_date'] = date("d-m-Y",strtotime($val['posting_date']));
            $giData['status'] = $val['status'];
            $giData['status_string'] = $status_string; 
            $data[] = $giData;
        }
        // $dt= array(
        //     array(
        //         "no" => "7225",
        //         "action" => "7225",
        //         "id" => "7225",
        //         "issue_no" => "71121",
        //         "posting_date"=>"01-08-2018",
        //         "status"=> "Approved",
        //         "log"=>"Integrated"
        //     ),
        //     array(
        //         "no" => "7225",
        //         "action" => "7225",
        //         "id" => "7225",
        //         "issue_no" => "71121",
        //         "posting_date"=>"01-08-2018",
        //         "status"=> "Approved",
        //         "log"=>"Integrated"
        //     ),
        //     array(
        //         "no" => "7225",
        //         "action" => "7225",
        //         "id" => "7225",
        //         "issue_no" => "71121",
        //         "posting_date"=>"01-08-2018",
        //         "status"=> "Approved",
        //         "log"=>"Integrated"
        //     ),
        //     array(
        //         "no" => "7225",
        //         "action" => "7225",
        //         "id" => "7225",
        //         "issue_no" => "71121",
        //         "posting_date"=>"01-08-2018",
        //         "status"=> "Approved",
        //         "log"=>"Integrated"
        //     ),
        //     array(
        //         "no" => "7225",
        //         "action" => "7225",
        //         "id" => "7225",
        //         "issue_no" => "71121",
        //         "posting_date"=>"01-08-2018",
        //         "status"=> "Approved",
        //         "log"=>"Integrated"
        //     )
        //  ); 
 
         $json_data = array(
            "recordsTotal"    => 10, 
            "recordsFiltered" => 12,
            "data"            => $data 
         );
         echo json_encode($json_data);
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
     }

     public function add(){
        $object['plant'] = $this->session->userdata['ADMIN']['plant']; 
        $object['plant_name'] = $this->session->userdata['ADMIN']['plant_name'];
        $object['storage_location'] = $this->session->userdata['ADMIN']['storage_location']; 
        $object['storage_location_name'] = $this->session->userdata['ADMIN']['storage_location_name'];
        $object['cost_center'] = $this->session->userdata['ADMIN']['cost_center']; 
        $object['cost_center_name'] = $this->session->userdata['ADMIN']['cost_center_name'];
        $object['matrialGroup'] = $this->gi_model->showMatrialGroup();

        $this->load->view('transaksi1/eksternal/goodissue/add_view', $object);
     }

     function getdataDetailMaterial(){
        $item_group_code = $this->input->post('matGroup');
        
        $data = $this->gi_model->getDataMaterialGroup($item_group_code);
        echo json_encode($data);

    }

    function getdataDetailMaterialSelect(){
		$itemSelect = $this->input->post('MATNR');
        
        $dataMatrialSelect = $this->gi_model->getDataMaterialGroupSelect($itemSelect);
      
        echo json_encode($dataMatrialSelect) ;
    }

    function getdataReason(){
        $data = $this->gi_model->showReason();
        echo json_encode($data);

    }

    function getdataReasonRow(){
        $data = $this->gi_model->showReason();
        echo json_encode($data);

    }

    public function addDataDb(){
        $admin_id = $this->session->userdata['ADMIN']['admin_id'];

        if($this->input->post("Plant")!= ''){
            $strPlant = explode("-",$this->input->post("Plant"));
            $plant = trim($strPlant[0]);
            $plant_name = trim($strPlant[1]);
        }else{
            $plant = '';
            $plant_name = '';
        }

        if($this->input->post("costCenter")!= ''){
            $str = explode("-",$this->input->post('costCenter'));
            $cost_center = trim($str[0]);
            $cost_center_name = trim($str[1]);
        }else{
            $cost_center = '';
            $cost_center_name = '';
        }

        if($this->input->post("StorageLoc")!= ''){
            $strStorage = explode("-",$this->input->post("StorageLoc"));
            $storage_location = trim($strStorage[0]);
            $storage_location_name = trim($strStorage[1]);
        }else{
            $storage_location = '';
            $storage_location_name = '';
        }

        $gi_header['posting_date'] = $this->l_general->str_to_date($this->input->post('posting_date'));
        $gi_header['item_group_code'] = $this->input->post('matGroup');
        $gi_header['plant'] = $plant;
        $gi_header['plant_name'] = $plant_name;
        $gi_header['storage_location'] = $storage_location;
        $gi_header['storage_location_name'] = $storage_location_name;
        $gi_header['cost_center'] = $cost_center;
        $gi_header['cost_center_name'] = $cost_center_name;
        $gi_header['id_issue_plant'] = $this->gi_model->id_gi_plant_new_select($gi_header['plant'],$gi_header['posting_date']);
        $gi_header['status'] = $this->input->post('appr')? $this->input->post('appr') : '1';
        $gi_header['id_user_input'] = $admin_id;
        $gi_header['no_acara'] = $this->input->post('Note');
        $gi_header['back'] = 1;
        $gi_header['id_user_approved'] = $this->input->post('appr')? $admin_id : 0;

        $gi_detail['material_no'] = $this->input->post('detMatrialNo');
        $count = count($gi_detail['material_no']);

        if($id_gi_header= $this->gi_model->gi_header_insert($gi_header)){
            $input_detail_success = false;
            for($i =0; $i < $count; $i++){
                $gi_details['id_issue_header'] = $id_gi_header;
                $gi_details['id_issue_h_detail'] = $i+1;
                $gi_details['material_no'] = $this->input->post('detMatrialNo')[$i];
                $gi_details['material_desc'] = $this->input->post('detMatrialDesc')[$i];
                $gi_details['quantity'] = $this->input->post('detQty')[$i];
                $gi_details['uom'] = $this->input->post('detUom')[$i];
                $gi_details['reason_name'] = $this->input->post('detText')[$i];
                $gi_details['ok'] = 0;
                $gi_details['num'] = 0;
                $gi_details['stock'] = $this->input->post('onHand')[$i];

                if($this->gi_model->gi_details_insert($gi_details))
                $input_detail_success = TRUE;
            }

            if($input_detail_success){
                return $this->session->set_flashdata('success', "Good Issue Telah Terbentuk");
            }else{
                return $this->session->set_flashdata('failed', "Good Issue Gagal Terbentuk");
            }
        }
    }

    public function edit(){
        $id_gi_header = $this->uri->segment(4);
        $object['data'] = $this->gi_model->gi_header_select($id_gi_header);

        if($object['data']['status'] == '1'){
            $object['gi_header']['status_string'] = 'Not Approved';                              
        }elseif($object['data']['status'] == '2'){
            $object['gi_header']['status_string'] = 'Approved';
        }else{
            $object['gi_header']['status_string'] = 'Cancel';
        }

        $object['gi_header']['id_gi_header'] = $id_gi_header;
        $object['gi_header']['plant'] = $object['data']['plant'].' - '.$object['data']['plant_name'];
        $object['gi_header']['gi_no'] = $object['data']['material_doc_no'];
        $object['gi_header']['storage_location'] = $object['data']['storage_location'].' - '.$object['data']['storage_location_name'];
        $object['gi_header']['posting_date'] = $object['data']['posting_date'];
        $object['gi_header']['item_group_code'] = $object['data']['item_group_code'];
        $object['gi_header']['status'] = $object['data']['status'];
        $object['gi_header']['cost_center'] = $object["data"]['cost_center'].' - '.$object["data"]['cost_center_name'];
        $object['gi_header']['note'] = $object['data']['no_acara'];
        $object['gi_header']['back'] = $object['data']['back'];

        $this->load->view('transaksi1/eksternal/goodissue/edit_view', $object);
    }

    public function showDataDetailOnEdit(){
        $plant = $this->session->userdata['ADMIN']['plant'];
        $id_gi_header = $this->input->post('id');
        $stts = $this->input->post('status');
        $rs = $this->gi_model->gi_detail_data_select($id_gi_header);
        $gi = array();
        $i = 1;
        if($rs){
            foreach($rs as $key=>$value){
                $inwhs = $this->gi_model->in_whs_qty($plant,$value['material_no']);
                $nestedData=array();
                $nestedData['id_gi_detail'] = $value['id_issue_detail'];
                $nestedData['no'] = $i;
                $nestedData['material_no'] = $value['material_no'];
				$nestedData['material_desc'] = $value['material_desc'];
                $nestedData['gi_quantity'] = $value['quantity'];
                $nestedData['stock'] = ($stts==1 ? ($inwhs['OnHand']!='.000000' ? $inwhs['OnHand'] : 0) : $value['stock']);
                $nestedData['uom'] = $value['uom'];
                $nestedData['reason'] = $value['reason_name'];
                $nestedData['other'] = $value['other_reason'];
                $nestedData['status'] = $stts;
                $gi[] = $nestedData;
                $i++;
            }
        }

        $json_data = array(
            "data" => $gi
        );
        echo json_encode($json_data);
    }

    public function addDataDbUpdate(){
        $admin_id = $this->session->userdata['ADMIN']['admin_id'];

        $id_detail = $this->input->post('id_detail_gi');

        $gi_header['id_issue_header'] = $this->input->post('id_gi');
        $gi_header['status'] = $this->input->post('appr')? $this->input->post('appr') : '1';
        $gi_header['posting_date'] = $this->l_general->str_to_date($this->input->post('posting_date'));
        $gi_header['no_acara'] = $this->input->post('note');
        $gi_header['id_user_approved'] = $admin_id;

        $sum_detail = (count($id_detail));

        $gi_update_header = $this->gi_model->update_gi_header($gi_header);
        $succes_update = false;
        if($gi_update_header){
            if($this->gi_model->gi_details_delete($gi_header['id_issue_header'])){
                for($i=0; $i < $sum_detail; $i++){
                    $gi_details['id_issue_header'] = $this->input->post('id_gi');
                    $gi_details['id_issue_h_detail'] = $i+1;
                    $gi_details['material_no'] = $this->input->post('detMatrialNo')[$i];
                    $gi_details['material_desc'] = $this->input->post('detMatrialDesc')[$i];
                    $gi_details['quantity'] = $this->input->post('detQty')[$i];
                    $gi_details['uom'] = $this->input->post('detUom')[$i];
                    $gi_details['reason_name'] = $this->input->post('detText')[$i];
                    $gi_details['ok'] = 0;
                    $gi_details['num'] = 0;
                    $gi_details['stock'] = $this->input->post('onHand')[$i];
    
                    if($this->gi_model->gi_details_insert($gi_details))
                        $succes_update = true;
                }
            }   
        }

        if($succes_update){
            return $this->session->set_flashdata('success', "Good Issue Telah Berhasil Terupdate");
        }else{
            return $this->session->set_flashdata('failed', "Good Issue Gagal Terupdate");
        }
    }

    public function onCancel(){
        $gi_header_c['id_issue_header'] = $this->input->post('idGi');
        $gi_header_c['cancel'] = $this->input->post('Cancel');
        $gi_header_c['id_user_cancel'] = $this->session->userdata['ADMIN']['admin_id'];

        if($this->gi_model->gi_header_cancel($gi_header_c)){
            $succes_cancel = true;
        }

        if($succes_cancel){
            return $this->session->set_flashdata('success', "Good Issue Berhasil di Cancel");
        }else{
            return $this->session->set_flashdata('failed', "Good Issue Gagal di Cancel");
        } 
    }

    public function printpdf($id =""){

        if($id != ""){
            $data['data'] = $this->gi_model->printPdf($id);
            
            ob_start();
            $content = $this->load->view('transaksi1/eksternal/goodissue/printpdf_view',$data);
            $content = ob_get_clean();		
            require_once(APPPATH.'libraries/html2pdf/html2pdf.class.php');
            try
            {
                $html2pdf = new HTML2PDF('P', 'F4', 'en');
                $html2pdf->setTestTdInOnePage(false);
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
                $html2pdf->Output('print.pdf');
            }
            catch(HTML2PDF_exception $e) {
                echo $e;
                exit;
            }
        }
        
    }

    public function deleteData(){
        $id_gi_header = $this->input->post('deleteArr');
        $deleteData = false;
        foreach($id_gi_header as $id){
            $cek = $this->gi_model->gi_header_delete($id);
            if($cek){
                $deleteData = true;
            }else{
                $deleteData = false;
            }
            
        }
        
        if($deleteData){
            return $this->session->set_flashdata('success', "Good Issue Berhasil dihapus");
        }else{
            return $this->session->set_flashdata('failed', "Good Issue Approved, Gagal dihapus");
        }
    }
}
?>