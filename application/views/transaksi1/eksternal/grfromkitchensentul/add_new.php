<!DOCTYPE html>
<html lang="en">
	<head>
		<?php  $this->load->view("_template/head.php")?>
		<style>
		.hide{
			display: none;
		}
		</style>
	</head>
	<body>
	<?php  $this->load->view("_template/nav.php")?>
		<div class="page-content">
			<?php  $this->load->view("_template/sidebar.php")?>
			<div class="content-wrapper">
				<div class="content">

				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif; ?>
				<?php if ($this->session->flashdata('failed')): ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $this->session->flashdata('failed'); ?>
					</div>
				<?php endif; ?>

						<div class="card">
							<div class="card-body">
								
								<div class="row">
									<div class="col-md-12">
										<fieldset>
											<legend class="font-weight-semibold"><i class="icon-reading mr-2"></i>GR from Central Kitchen Sentul</legend>
											
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">ID Transaksi</label>
												<div class="col-lg-9"><input type="text" class="form-control" readonly=""></div>
											</div>
											
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Transfer Slip Number</label>
												<div class="col-lg-9">
													<select class="form-control form-control-select2" data-live-search="true" name="slipNumberEntry" id="slipNumberEntry" onchange="getDataHeader(this.value)">
														<option value="" selected>Select Item</option>
														<?php foreach($do_no as $index=>$value):?>
															<option value="<?php echo $index; ?>">
																<?php echo $value; ?>
															</option>
														<?php endforeach;?>
													</select>
												</div>
											</div>
											
											<div id='form1' style="display:none">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Goods Receipt Number</label>
													<div class="col-lg-9"><input type="text" class="form-control" readonly="" value="(Auto Number after Posting to SAP)">
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Delivery Date</label>
													<div class="col-lg-9">
														<input type="text" id="DeliveryDate" class="form-control" readonly="" value="04-12-2019">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Outlet From</label>
													<div class="col-lg-9">
														<input type="text" id="OutletFrom" class="form-control" readonly="" >
														<input type="hidden" id="plant" class="form-control" readonly="" >
													</div>
												</div>
												
												<div class="form-group row" hidden>
													<label class="col-lg-3 col-form-label">Store Location</label>
													<div class="col-lg-9">
														<input type="text" id="StoreLocation" class="form-control" readonly="" >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Status</label>
													<div class="col-lg-9">
														<input type="text" id="StatusHeader" class="form-control" readonly="" value="Not Approved">
														<input type="hidden" id="U_DocNum" class="form-control" readonly="">
														<input type="hidden" id="to_plant" class="form-control" readonly="">
													</div>
												</div>
											
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Material Group</label>
													<div class="col-lg-9">
														
														<select class="form-control form-control-select2" data-live-search="true" name="material_group" id="material_group" onchange="getListData(this.value)">
															
														</select>
													</div>
												</div>
											</div>
											
											<div class='hide' id="form2">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Posting Date</label>
													<div class="col-lg-9 input-group date">
														<input type="text" class="form-control" id="postingDate" autocomplete="off">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon1">
																<i class="icon-calendar"></i>
															</span>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Remarks</label>
													<div class="col-lg-9 input-group date">
														<textarea id="remark" cols="30" rows="3" class="form-control"></textarea>
													</div>
												</div>
												
												<div class="form-group row">
													<div class="col-lg-12 text-right">
														<div class="text-right">
															
															<button class="btn btn-primary" onclick="btnSave()" id="btnSubmitOnclick">
																Save <i class="icon-pencil5 ml-2"></i>
															</button>
															<?php if ($this->auth->is_have_perm('auth_approve')) : ?>
															<button type="submit" class="btn btn-success" onclick="btnSave(2)" id="btnSubmitOnclick2">
																Approve <i class="icon-paperplane ml-2"></i>
															</button>
															<?php endif;?>

														</div>
													</div>
												</div>											
										</fieldset>
									</div>
								</div>	
							</div>	
						</div>	
								

						<div class='hide' id="form3">
							<div class="card">
							<ul class="nav nav-tabs ">
									<li class="nav-item">
										<a href="#gr_list" class="nav-link font-size-sm text-uppercase active" data-toggle="tab" data-tab-remote="">
											GR List
										</a>
									</li>

									<li class="nav-item">
										<a href="#sr_list" class="nav-link font-size-sm text-uppercase" data-toggle="tab" data-tab-remote="<?php echo base_url()?>transaksi1/grfromkitchensentul/showDataSr" data-tab="1">
										Not Send
										</a>
									</li>

									<li class="nav-item">
										<a href="#sr_list_now" class="nav-link font-size-sm text-uppercase" data-toggle="tab" data-tab-remote="<?php echo base_url()?>transaksi1/grfromkitchensentul/showDataGrSend" data-tab="2">
										Not In Request
										</a>
									</li>
								</ul>
								<div class="card-header">
									<legend class="font-weight-semibold"><i class="icon-list mr-2"></i>List Item</legend>
								</div>
								<div class="tab-content  card-body">
									<div class="tab-pane fade active show" id="gr_list">
										<table id="tblWhole" class="table table-striped " style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Material No</th>
													<th>Material Desc</th>
													<th>SR Qty</th>
													<th>TF Qty</th>
													<th>GR Qty</th>
													<th>Uom</th>
													
												</tr>
											</thead>
						
										</table>				
									</div>
									<div class="tab-pane" id="sr_list">
										<table id="tblStore" class="table table-striped " style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Material No</th>
													<th>Material Desc</th>
													<th>Quantity</th>
													<th>Uom</th>
													
												</tr>
											</thead>
						
										</table>				
									</div>
									<div class="tab-pane" id="sr_list_now">
										<table id="tblStoreNow" class="table table-striped " style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Material No</th>
													<th>Material Desc</th>
													<th>Quantity</th>
													<th>Uom</th>
													
												</tr>
											</thead>
						
										</table>				
									</div>
									
								</div>
							</div>
						</div>
						
					</form>

				</div>
				<?php  $this->load->view("_template/footer.php")?>
			</div>
		</div>
		<?php  $this->load->view("_template/js.php")?>
		<script>

			$(document).ready(function(){
				
				table = $("#tblWhole").DataTable({
					"ordering":false,  
                    "paging": false, 
                    "searching":false,
				});

				tableStore = $("#tblStore").DataTable({
					"ordering":false,  
                    "paging": false, 
                    "searching":false,
				});

				tableStoreNow = $("#tblStoreNow").DataTable({
					"ordering":false,  
                    "paging": false, 
                    "searching":false,
				});

			});

			function btnSave(id_approve=''){
				if ($('#postingDate').val()=='') {
					alert('Posting Date Harus di Isi');
					return false;
				}
				document.getElementById("btnSubmitOnclick").disabled = true;
				document.getElementById("btnSubmitOnclick2").disabled = true;
				
				const donoLong= document.getElementById('slipNumberEntry');
				const Text = donoLong.options[donoLong.selectedIndex].text;
				const Arr = Text.split(' - ');
				
				let grHeader = {
					do_no: document.getElementById('slipNumberEntry').value, 
					do_no1: Arr[0], 
					delivery_date: document.getElementById('DeliveryDate').value,
					plant: 'T.DFRHTM',
					storage_location: document.getElementById('StoreLocation').value,
					posting_date: document.getElementById('postingDate').value,
					id_user_input: 99999,
					item_group_code:  document.getElementById('material_group').value,
					remark:  document.getElementById('remark').value,
					status: id_approve,
					to_plant: document.getElementById('to_plant').value
				}

				table = $('#tblWhole > tbody');

				let grDetail=[];
				let urut = 1;
				let item = 0;
				table.find('tr').each(function(i, el){
					
					let td = $(this).find('td');
					
					const det = {
						id_grpodlv_h_detail: urut,
						item:td.eq(0).find('input').val(),
						material_no: td.eq(1).text(), 
						material_desc: td.eq(2).text(), 
						sr_qty: td.eq(3).text(), 
						tf_qty: td.eq(4).text(), 
						gr_qty: td.eq(5).find('input').val(),
						uom: td.eq(6).text()
					}
					grDetail.push(det);
					urut++;
					item++;
					
				})	

				$.post("<?php echo site_url('transaksi1/grfromkitchensentul/saveDataGR');?>",{
						Header: grHeader,
						Detail: grDetail
					},
					(res)=>{
						location.reload(true);
					}
				)
			}	


			function getListData(ItmsGrpNam){
				
				let getTable = $("#tblWhole").DataTable();
				
				count = getTable.rows().count() + 1;
				
				if(count > 1) {
					getTable.clear();
				}
				let elementSelect = document.getElementsByClassName(`dt_${count}`);
				const u_doc = document.getElementById('slipNumberEntry').value;
				const plant = document.getElementById('plant').value;

				$.post("<?php echo site_url('transaksi1/grfromkitchensentul/getDataListHeader');?>",{ItmsGrpNam: ItmsGrpNam, U_DocNum: u_doc, Plant: plant},(data)=>{
					const res = JSON.parse(data);
					if(res.hasOwnProperty('data')){

						let i=0;
						for(let key in res.data){ 
							i++;
							var tf_qty = res.data[key].TF_QTY;							

							getTable.row.add({ 
								"0":`<input type='hidden' min='1' class='form-control' value="${res.data[key].Item}" />${i}`,
								"1":`${res.data[key].Material_Code}`,
								"2":`${res.data[key].Material_Desc}`,
								"3":`${res.data[key].SRQUANTITY}`,
								"4":`${tf_qty}`,
								"5":`<input type='number' min='1' class='form-control' value="" /></td>`,
								"6":`${res.data[key].UOM}`,
							}).draw();
						}
					}
					

				})
			}

			function getDataHeader(slipNumber){
				$('#material_group').text('');

				$.post("<?php echo site_url('transaksi1/grfromkitchensentul/getDataslipHeader');?>",{slipNumberHeader: slipNumber},(data)=>{
					
					const value = JSON.parse(data);
					if (value){

						$("#form1").css('display', '');
						$("#form2").removeClass('hide');
						$("#form3").removeClass('hide');
						document.getElementById('DeliveryDate').value = value.data[1].DELIV_DATE
						document.getElementById('OutletFrom').value = value.data[1].PLANT + ' - ' + value.data[1].Outlet;
						document.getElementById('StoreLocation').value = value.data[1].Filler;
						document.getElementById('plant').value = value.data[1].PLANT;
						document.getElementById('U_DocNum').value = value.data[1].VBELN1;
						document.getElementById('to_plant').value = value.data[1].Filler;

						let lengthMaterialGroups = value.dataOption;
						
						if(value.hasOwnProperty('dataOption')){

							$('#material_group').append('<option value="">Select Item</option><option value="all">--ALL--</option>');
							for(let key in lengthMaterialGroups){
								$('#material_group').append('<option value="'+lengthMaterialGroups[key]+'">'+lengthMaterialGroups[key]+'</option>');
							}
						}

					}

				})
			}
            $(document).ready(function(){

				const date = new Date();
				const today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
				var optSimple = {
					format: 'dd-mm-yyyy',
					todayHighlight: true,
					orientation: 'bottom right',
					autoclose: true
				};
				$('#postingDate').datepicker(optSimple);
				$('#delivDate').datepicker(optSimple);

				$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				var target = $(e.target).attr('href');
				var obj = $(this).attr('data-tab-remote');
				var dataTab = $(this).attr('data-tab');
				let getTableStore = $("#tblStore").DataTable();
				let getTableStoreNow = $("#tblStoreNow").DataTable();
				countNow = getTableStoreNow.rows().count() + 1;
				count = getTableStore.rows().count() + 1;

				const noSR = document.getElementById('U_DocNum').value;

				if(dataTab == 1){
					if(count > 1) {
						getTableStore.clear();
					}

					$.post(obj,{SrNumber:noSR},(data)=>{
					const res = JSON.parse(data);
					if(res.hasOwnProperty('data')){

						let i=0;
						for(let key in res.data){ 
							i++;
							
							getTableStore.row.add({ 
								"0":`${i}`,
								"1":`${res.data[key].ItemCode}`,
								"2":`${res.data[key].Dscription}`,
								"3":`${res.data[key].Quantity}`,
								"4":`${res.data[key].UOM}`,
							}).draw();
						}
					}
				})
				}else{
					if(countNow > 1) {
						getTableStoreNow.clear();
					}

					$.post(obj,{SrNumber:noSR},(data)=>{
					const res = JSON.parse(data);
					if(res.hasOwnProperty('data')){

						let i=0;
						for(let key in res.data){ 
							i++;
							
							getTableStoreNow.row.add({ 
								"0":`${i}`,
								"1":`${res.data[key].ItemCode}`,
								"2":`${res.data[key].Dscription}`,
								"3":`${res.data[key].Quantity}`,
								"4":`${res.data[key].UOM}`,
							}).draw();
						}
					}
				})
				}

				})

			})

        </script>
	</body>
</html>