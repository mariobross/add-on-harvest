<!DOCTYPE html>
<html lang="en">
	<head>
		<?php  $this->load->view("_template/head.php")?>
		<style>
			th{
				text-align:center;
			}
			td{
				text-align:center;
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

                    <form action="#" method="POST">
					<input type="hidden" value="" id="rr" name="rr">
					<div class="card">
                        <div class="card-body">
                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset>
                                            <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i>Tambah Purchase Request (PR)</legend>
                                            <div class="form-group row">

												<label class="col-lg-3 col-form-label">ID Transaksi</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="ID Transaksi" readOnly>
												</div>
											</div>
											
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Purchase Request (PR) Number	</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="(Auto Number after Posting to SAP)" readOnly>
												</div>
											</div>
											
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Outlet</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" value="<?= $plant ?>" readOnly>
												</div>
											</div>
											
											<div class="form-group row" hidden>
												<label class="col-lg-3 col-form-label">Storage Location</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" value="<?= $storage_location ?>" readOnly>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Status</label>
												<div class="col-lg-9">
													<input type="hidden" class="form-control" value="1" id="status">
													<input type="text" class="form-control" value="Not Approved" readOnly>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Material Group</label>
												<div class="col-lg-9">
													<select class="form-control form-control-select2" data-live-search="true" id="materialGroup" name="materialGroup" onchange="showMatrialDetail(this.value)">
														<option value="">Select Item</option>
														<option value="all">All</option>
														<?php foreach($matrialGroup as $key=>$val):?>
															<option value="<?=$val['ItmsGrpNam']?>"><?=$val['ItmsGrpNam']?></option>
														<?php endforeach;?>
													</select>
												</div>
											</div>

										<div id='form1' style="display:none">
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Delivery Date</label>
												<div class="col-lg-9 input-group date">
													<input type="text" class="form-control" id="postDate" readOnly>
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

                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary" name="save" id="save" onclick="addDatadb()">Save <i class="icon-pencil5 ml-2"></i></button>
												<?php if ($this->auth->is_have_perm('auth_approve')) : ?>
												<button type="button" class="btn btn-success" name="approve" id="approve" onclick="addDatadb(2)">Approve SAP<i class="icon-paperplane ml-2"></i></button>
												<?php endif;?>
                                            </div>

                                        </fieldset>
                                    </div>
                                </div>
								</div>
								</div>
								
								<div id='form2' style="display:none">
								<div class="card">
                        		<div class="card-body">
                            
								<div class="row">
								<legend class="font-weight-semibold"><i class="icon-list mr-2"></i>List Item</legend>
								
									<div class="col-md-12" style="overflow: auto">
										<table class="table table-striped" id="tblWhole" id="tblWhole">
											<div class="col-md-12 mb-2">
												<div class="text-left">
													<input type="button" class="btn btn-primary" value="Add" id="addTable" onclick="onAddrow()"> 
													<input type="button" value="Delete" class="btn btn-danger" id="deleteRecord"> 
												</div>
											</div>
											<thead>
												<tr>
													<th></th>
													<th>No</th>
													<th>Material No</th>
													<th>Material Desc</th>
													<th>Quantity</th>
													<th>Last Puchase Price</th>
													<th>Last Vendor</th>
													<th>UOM Purchase</th>
													<th>UOM Inventory</th>
													<th>On Hand</th>
												</tr>
											</thead>
											<tbody>
													<tr>
														<td><input type="checkbox" id="record"/></td>
														<td>1</td>
														<td width="25%">
															<select class="form-control form-control-select2" data-live-search="true" id="matrialGroup" onchange="setValueTable(this.value,1)" >
																<option value="">Select Item</option>
															</select>
														</td>
														<td width="30%"></td>
														<td><input type="text" class="form-control  qty" name="qty[]" id="qty" style="width:100%" autocomplete="off" onchange="setUOM(this.value,1)"></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
												</tbody>
										</table>
									</div>
									
								</div>
								</div>
                    </div> 
                            </form>
                                           
		</div>
				</div>
				<?php  $this->load->view("_template/footer.php")?>
			</div>
		</div>
        <?php  $this->load->view("_template/js.php")?>
		<script>
		$(document).ready(function(){
			var table = $("#tblWhole").DataTable({
				"ordering":false,
				"paging":false,
				drawCallback: function() {
					$('.form-control-select2').select2();
				}
			});

			$("#deleteRecord").click(function(){
				let deleteidArr=[];
				$("input:checkbox[class=check_delete]:checked").each(function(){
					deleteidArr.push($(this).val());
				})

				// mengecek ckeckbox tercheck atau tidak
				if(deleteidArr.length > 0){
					var confirmDelete = confirm("Do you really want to Delete records?");
					if(confirmDelete == true){
						$("input:checked").each(function(){
							table.row($(this).closest("tr")).remove().draw();;
						});
					}
				}
				
			});

			checkcheckbox = () => {
				let totalChecked = 0;
				$(".check_delete").each(function(){
					if($(this).is(":checked")){
						totalChecked += 1;
					}
				});
			}

			const date = new Date();
			const today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
			var optSimple = {
				format: 'dd-mm-yyyy',
				todayHighlight: true,
				orientation: 'bottom right',
				autoclose: true
			};

			$('#postDate').datepicker(optSimple);
		});

		function onAddrow(){
			let getTable = $("#tblWhole").DataTable();
			count = getTable.rows().count() + 1;
			let elementSelect = document.getElementsByClassName(`dt_${count}`);
			const matrialGroup = $('#materialGroup').val();
			
			getTable.row.add({
				"0":`<input type="checkbox" class="check_delete" id="chk_${count}" value="${count}">`,
				"1":count,
				"2":`<select class="form-control form-control-select2 dt_${count} testSelect" data-live-search="true" id="selectDetailMatrial" data-count="${count}">
								<option value="">Select Item</option>
								${showMatrialDetailData(matrialGroup, elementSelect)}
							</select>`,
				"3":"",
				"4":`<input type="text" class="form-control qty qty_${count}" id="gr_qty_${count}" value="" style="width:100%" autocomplete="off">`,
				"5":"",
				"6":"",
				"7":"",
				"8":"",
				"9":""
				}).draw();
				count++;

			tbody = $("#tblWhole tbody");
			tbody.on('change','.testSelect', function(){
				tr = $(this).closest('tr');
				no = tr[0].rowIndex;
				id = $('.dt_'+no).val();
				setValueTable(id,no);
			});
			tbody.on('change','.qty', function(){
				tr = $(this).closest('tr');
				no = tr[0].rowIndex;
				val = $('.qty_'+no).val();
				setUOM(val,no);
			});
		}

		function setValueTable(id,no){
			table = document.getElementById("tblWhole").rows[no].cells;
			$.post(
				"<?php echo site_url('transaksi1/purchase_request/getdataDetailMaterialSelect')?>",{ MATNR:id },(res)=>{
					matSelect = JSON.parse(res);
					matSelect.data.map((val)=>{
						table[3].innerHTML = val.MAKTX;
						table[7].innerHTML = val.UNIT;
						table[8].innerHTML = (1*val.NUM)+' '+val.UNIT1;
						table[9].innerHTML = val.OnHand;
					})
					matSelect.dataLast.map((val)=>{
						table[5].innerHTML = val.LastPrice;
						table[6].innerHTML = val.VendorCode+' - '+val.VendorName;
					})
				}
			)
		}

		function setUOM(val,no){
			table = document.getElementById("tblWhole").rows[no].cells;
			let conversi = table[8].innerHTML.split(' ');
			table[8].innerHTML = (val*conversi[0])+' '+conversi[1];
		}

		function showMatrialDetail(matrialGroup){
			
			const select = $('#matrialGroup');	
			showMatrialDetailData(matrialGroup, select);		

			$("#form1").css('display', '');
			$("#form2").css('display', '');
		}

		function showMatrialDetailData(matrialGroup='',  selectTable){
			const select = selectTable ? selectTable : $('#matrialGroup');
			$.ajax({
				url: "<?php echo site_url('transaksi1/purchase_request/getdataDetailMaterial');?>",
				type: "POST",
				data: {
					matGroup: matrialGroup
				},
				success:function(res) {
					optData = JSON.parse(res);
					if (optData) {
						optData.forEach((val)=>{						
							$("<option />", {value:val.MATNR, text:val.MAKTX +' - '+ val.MATNR+' - '+ ((val.UNIT) ? val.UNIT : val.UNIT1)}).appendTo(select);
						})
					}
				}
			});			
		}

		function addDatadb(id_approve=''){
			if($('#postDate').val() ==''){
				alert('Tanggal Posting harus di isi');
				return false;
			}
			const status= document.getElementById('status').value;
			const requestReason= document.getElementById('rr').value;
			const MatrialGroup= document.getElementById('materialGroup').value;
			const postDate= document.getElementById('postDate').value;
			const remark= document.getElementById('remark').value;
			const approve = id_approve;
			const tbodyTable = $('#tblWhole > tbody');
			let matrialNo =[];
			let matrialDesc =[];
			let qty =[];
			let uom =[]; 
			let onHand = [];
			let validasi = true;
			tbodyTable.find('tr').each(function(i, el){
				let td = $(this).find('td');
				if(td.eq(4).find('input').val() == ''){
					validasi = false;
				}	
				matrialNo.push(td.eq(2).find('select').val()); 
				matrialDesc.push(td.eq(3).text());
				qty.push(td.eq(4).find('input').val());
				uom.push(td.eq(7).text());
				onHand.push(td.eq(9).text());
			})
			if(!validasi){
				alert('Quatity Tidak boleh Kosong, Harap isi Quantity');
				return false;
			}

			$.post("<?php echo site_url('transaksi1/purchase_request/addData')?>", {
				appr: approve, stts: status, reqReason:requestReason, matGroup: MatrialGroup, stts: status, posting_date: postDate, Remark:remark, detMatrialNo: matrialNo, detMatrialDesc: matrialDesc, detQty: qty, detUom: uom, OnHand:onHand
			}, function(res){
				location.reload(true);
			}
			);
		}
		</script>
	</body>
</html>