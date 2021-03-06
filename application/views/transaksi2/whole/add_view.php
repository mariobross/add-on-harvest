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
					<div class="card">
                        <div class="card-body">
                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset>
                                            <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i>Tambah Cake Cutting</legend>
                                            <div class="form-group row">
												<label class="col-lg-3 col-form-label">ID Transaksi</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="ID Transaksi" id="idWhole" name="idWhole" readOnly>
												</div>
											</div>

                                            <div class="form-group row">
												<label class="col-lg-3 col-form-label">Item Code</label>
												<div class="col-lg-9">
													<select class="form-control form-control-select2" data-live-search="true" id="itemCode" name="itemCode" onchange="setDetail(this)">
														<option value="">Pilih item...</option>
														<?php foreach($items as $key=>$val):?>
															<option value="<?= $val['MATNR']?>"><?= $val['MATNR'].' - '.$val['MAKTX']?></option>
														<?php endforeach?>
													</select>
												</div>
											</div>

                                            <div class="form-group row">
												<label class="col-lg-3 col-form-label">Item Description</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Description Item" id="itemDesc" name="itemDesc" readOnly>
													
												</div>
											</div>

                                            <div class="form-group row">
												<label class="col-lg-3 col-form-label">Quantity</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="0.00" id="qty" name="qty">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-lg-3 col-form-label">On Hand</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="0.00" id="onHand" name="onHand" readonly>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Volume Total</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="0.00" id="volume" readonly>
												</div>
											</div>

											<div class="form-group row hid">
                                                <label class="col-lg-3 col-form-label">Posting Date</label>
                                                <div class="col-lg-9 input-group date">
                                                    <input type="text" class="form-control" id="postDate" autocomplete="off">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="icon-calendar"></i>
                                                        </span>
                                                    </div>
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
								
								<div class="card">
                        		<div class="card-body">
                            
								<div class="row">
								<legend class="font-weight-semibold"><i class="icon-list mr-2"></i>List Item</legend>
									<div class="col-md-12 mb-2">
										<div class="text-left">
											<input type="button" class="btn btn-primary" value="Add" id="addTable" onclick="onAddrow()"> 
											<input type="button" value="Delete" class="btn btn-danger" id="deleteRecord"> 
										</div>
									</div>
									<div class="col-md-12 mb-2">
										<div class="text-left">
											<p>Terpotong : <span id="potong"></span></p>
											<p id="text-sisa">Sisa : <span id="sisa"></span></p>
										</div>
									</div>
									<div class="col-md-12" style="overflow: auto">
										<table class="table table-striped" id="tblWhole">
											<thead>
												<tr>
													<th colspan="7">BOM ITEM</th>
												</tr>
												<tr>
													<th></th>
													<th>No</th>
													<th>Material No</th>
													<th>Material Desc</th>
													<th>Quantity</th>
													<th>UOM</th>
													<th>Volume Potong</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="checkbox" id="record"/></td>
													<td>1</td>
													<td width="35%">
														<select class="form-control form-control-select2" data-live-search="true" id="matrialGroup" onchange="setValueTable(this.value,2)">
															<option value="">Select Item</option>
														</select>
													</td>
													<td width="35%"></td>
													<td><input type="text" class="form-control qty" name="gr_qty_2" id="gr_qty" style="width:100%" autocomplete="off"></td>
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
			count = 1;

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

		function setDetail(item){
			const text = item.options[item.selectedIndex].text;
			const textArr = text.split(' - ');
			const itemCode = textArr[0];
			$('#itemDesc').val(textArr[1]);
			const select = $('#matrialGroup');
			showMatrialDetailData(itemCode, select);
			$.post("<?php echo site_url('transaksi2/whole/getOnHand')?>",{
				item_code:itemCode},
				function(res){
					value = JSON.parse(res);
					$('#onHand').val(value[0].Onhand);
					$('#volume').val(value[0].SVolume);
					$('#qty').change(function(){
						let qty = parseFloat($('#qty').val());
						let vol = parseFloat(value[0].SVolume);
						let potong = $('#potong');
						$('#volume').val(qty*vol);
						potong.text(0);
					})
			});
			
		}

		function showMatrialDetailData(itemCode='', select){
			$.ajax({
				url: "<?php echo site_url('transaksi2/whole/getdataDetailMaterial');?>",
				type: "POST",
				data: {
					item_code: itemCode
				},
				success:function(res) {
					optData = JSON.parse(res);
					optData.forEach((val)=>{						
						$("<option />", {value:val.MATNR1, text:val.MATNR1 +' - '+ val.MAKTX1+' - '+val.UOM}).appendTo(select);
					})
				}
			});			
		}

		function onAddrow(){
			let getTable = $("#tblWhole").DataTable();
			count = getTable.rows().count() + 2;
			let elementSelect = document.getElementsByClassName(`dt_${count}`);
			const itemCode = $('#itemCode').val();
			
			getTable.row.add({
				"0":`<input type="checkbox" class="check_delete" id="chk_${count}" value="${count}">`,
				"1":count -1,
				"2":`<select class="form-control form-control-select2 dt_${count} testSelect" data-live-search="true" id="selectDetailMatrial" data-count="${count}">
								<option value="">Select Item</option>
								${showMatrialDetailData(itemCode, elementSelect)}
							</select>`,
				"3":"",
				"4":`<input type="text" class="form-control qty qty_${count}" id="gr_qty_${count}" value="" style="width:100%" autocomplete="off" onchange="setVolumeSisa(this.value,${count})">`,
				"5":"",
				"6":""
				}).draw();
			count++;

			tbody = $("#tblWhole tbody");
			tbody.on('change','.testSelect', function(){
				tr = $(this).closest('tr');
				no = tr[0].rowIndex;
				id = $('.dt_'+no).val();
				setValueTable(id,no);
			});
		}

		function setValueTable(id,no){
			table = document.getElementById("tblWhole").rows[no].cells;
			const itemCode = $('#itemCode').val();
			
			$.post(
				"<?php echo site_url('transaksi2/whole/getdataDetailMaterial')?>",{ item_code: itemCode, MATNR:id },(res)=>{
					matSelect = JSON.parse(res);
					matSelect.map((val)=>{
						table[3].innerHTML = val.MAKTX1;
						table[4].innerHTML = `<input type="text" class="form-control qty qty_${no}" id="gr_qty_${no}" value="" style="width:100%" autocomplete="off" onchange="setVolumeSisa(this.value,${no},${val.VOL})">`;
						table[5].innerHTML = val.UOM;
						table[6].innerHTML = val.VOL;
					})
				}
			)
		}

		function setVolumeSisa(val,no,vol){
			table = document.getElementById("tblWhole").rows[no].cells;

			let volume = $('#volume').val();
			let potong = $('#potong').text();
			let sisa = $('#sisa');
			let qty_row = table[4].children[0].value;
			let vol_pot = parseFloat(vol);
			let hasilPtgArr = [];

			table[6].innerHTML = qty_row*vol_pot;
			$('#tblWhole tbody tr').each(function() {
				hasilPtgArr.push(parseFloat($(this).find('td').last().text())); 
			});
			let hasilPtg = hasilPtgArr.reduce((a, b) => a + b, 0);
			let hasilSisa = volume - hasilPtg;
			$('#potong').text(hasilPtg);
			$('#sisa').text(hasilSisa);
			if (hasilSisa < 0) {
				$('#text-sisa').addClass('text-danger font-weight-bold');
			} else {
				$('#text-sisa').removeClass('text-danger font-weight-bold');
			}
		}

		function addDatadb(id_approve=''){
			let vol = parseFloat($('#volume').val());
			let potong = parseFloat($('#potong').text());
			if($('.qty').val() ==''){
				alert('Quantity harus di isi');
				return false;
			}

			if($('#postDate').val() ==''){
				alert('Tanggal Posting harus di isi');
				return false;
			}

			if (vol != potong) {
				alert('Total Volume Harus Sama Dengan Volume Loyang');
				return false;
			}

			const itemCode= document.getElementById('itemCode').value;
			const itemDesc= document.getElementById('itemDesc').value;
			const qtyPaket= document.getElementById('qty').value;
			const postDate= document.getElementById('postDate').value;
			const approve = id_approve;
			const tbodyTable = $('#tblWhole > tbody');
			let matrialNo =[];
			let matrialDesc =[];
			let qty =[];
			let uom =[];
			let volD = [];
			tbodyTable.find('tr').each(function(i, el){
				let td = $(this).find('td');
				matrialNo.push(td.eq(2).find('select').val()); 
				matrialDesc.push(td.eq(3).text());
				qty.push(td.eq(4).find('input').val());
				uom.push(td.eq(5).text());
				volD.push((parseFloat(td.eq(6).text())/parseFloat(td.eq(4).find('input').val())));
			})

			$.post("<?php echo site_url('transaksi2/whole/addData')?>", {
				item_code: itemCode, item_desc: itemDesc, qty_paket: qtyPaket, appr: approve, postingDate:postDate, detMatrialNo: matrialNo, detMatrialDesc: matrialDesc, detQty: qty, detUom: uom, Vol:volD
			}, function(res){
				location.reload(true);
			});
		}

		</script>
	</body>
</html>