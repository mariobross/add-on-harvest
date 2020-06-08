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
<<<<<<< HEAD
=======
                <!-- <?php  $this->load->view("_template/breadcrumb.php")?> -->
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
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
											<legend class="font-weight-semibold"><i class="icon-reading mr-2"></i>Disassembly</legend>
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">ID Transaksi</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="ID Transaksi" readOnly>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Outlet</label>
												<div class="col-lg-9">
<<<<<<< HEAD
												<input type="text" class="form-control" placeholder="Outlet" value="<?=$plant.' - '.$plant_name?>" readOnly>
=======
													<input type="text" class="form-control" placeholder="Outlet" readOnly>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
												</div>
											</div>

											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Item Disassembly</label>
												<div class="col-lg-9">
													<div id="item1">
														<select class="form-control form-control-select2" data-live-search="true" id="selectItem" onchange="getDataHeader(this.value)">
<<<<<<< HEAD
															<option value="">Select Item</option>
=======
															<option value="">None Selected</option>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
															<?php foreach($wo_code as $key=>$value):?>
																<option value="<?=$key?>" desc="<?=$value?>"><?=$value?></option>
															<?php endforeach;?>
														</select>
													</div>
													<div id="item2" class="hide">
														<input type="text" id="itemSelected" class="form-control" placeholder="" readOnly>
														<input type="hidden" id="wonumber">
														<input type="hidden" id="wodesc">
														<input type="hidden" id="wolocked">
													</div>
												</div>
											</div>

											<div id='form1' class="hide">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Qty Disassembly</label>
													<div class="col-lg-9">
														<input type="text" id="qtyProduksi" class="form-control" placeholder="(Suggest Qty : 1.0000)" >
													</div>
												</div>
											</div>
											
											<div id='form2' class="hide">
												<div class="form-group row">
<<<<<<< HEAD
													<label class="col-lg-3 col-form-label">On Hand</label>
													<div class="col-lg-9">
														<input type="text" id="onHand" class="form-control" readOnly>
													</div>
												</div>
												
												<div class="form-group row">
=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
													<label class="col-lg-3 col-form-label">UOM</label>
													<div class="col-lg-9">
														<input type="text" id="uomProduksi" class="form-control" readOnly>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Posting Date</label>
													<div class="col-lg-9 input-group date">
														<input type="text" class="form-control" id="postDate" readonly autocomplate="off">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon1">
																<i class="icon-calendar"></i>
															</span>
														</div>
													</div>
												</div>

												<div class="text-right" id="btnAction">
													<button type="button" class="btn btn-primary" name="save" id="save" onclick="addDatadb()">Save <i class="icon-pencil5 ml-2"></i></button>
<<<<<<< HEAD
													<?php if ($this->auth->is_have_perm('auth_approve')) : ?>
													<button type="button" class="btn btn-success" name="approve" id="approve" onclick="addDatadb(2)" >Approve <i class="icon-paperplane ml-2" ></input></i>
													<?php endif; ?>
=======
													<button type="button" class="btn btn-success" name="approve" id="approve" onclick="addDatadb(2)" >Approve <i class="icon-paperplane ml-2" ></input></i>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
												</div>
											</div>
											
										</fieldset>
									</div>
								</div>
							</div>
						</div> 
						<div class='hide' id="form3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<legend class="font-weight-semibold"><i class="icon-list mr-2"></i>List Item</legend>
<<<<<<< HEAD
=======
										<div class="col-md-12 mb-2" id="btnAddListItem">
											<div class="text-left">
												<input type="button" class="btn btn-primary" value="Add" id="addTable"> 
												<input type="button" value="Delete" class="btn btn-danger" id="deleteRecord"> 
											</div>
										</div>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
										<div class="col-md-12" style="overflow: auto" >
											<table class="table table-striped" id="tblWhole">
												<thead>
													<tr>
<<<<<<< HEAD
=======
														<th><input type="checkbox" name="checkall" id="checkall"></th>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
														<th>Material No</th>
														<th>Material Desc</th>
														<th>Quantity</th>
														<th>UOM</th>
														<th>On Hand</th>
<<<<<<< HEAD
=======
														<th>Min Stock</th>
														<th>Oustanding Total</th>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
													</tr>
												</thead>
											</table>
										</div>
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
				"paging":false,
				drawCallback: function() {
					$('.form-control-select2').select2();
				}
			});

			$("#checkall").click(function(){
				if($(this).is(':checked')){
					$(".check_delete").prop('checked', true);
				}else{
					$(".check_delete").prop('checked', false);
				}
			});

			$("#deleteRecord").click(function(){
<<<<<<< HEAD
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
=======
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
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
			
			const date = new Date();
			const today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
			var optSimple = {
				format: 'dd-mm-yyyy',
				todayHighlight: true,
				orientation: 'bottom right',
				autoclose: true
			};

			$('#postDate').datepicker(optSimple);

			tbody = $("#tblWhole tbody");
			tbody.on('change','#descmat', function(){
				tr = $(this).closest('tr');
				no = tr[0].rowIndex;
				const qty = $("option:selected", this).attr("matqty");
				const matrial_no = $("option:selected", this).val();
				const rel = $("option:selected", this).attr("rel");
<<<<<<< HEAD
				const onHand = $("option:selected", this).attr("onhand");
				const minStock = $("option:selected", this).attr("minstock");
				const uOm = $("option:selected", this).attr("uOm");
				table = document.getElementById("tblWhole").rows[no].cells;
				table[0].innerHTML = matrial_no;
				table[2].innerHTML = qty;
				table[3].innerHTML = uOm;
				table[4].innerHTML = onHand;
=======
				table = document.getElementById("tblWhole").rows[no].cells;
				table[1].innerHTML = matrial_no;
				table[3].innerHTML = `<input type="text" id="editqty" class="form-control" value="${qty}" ${rel == "N" ? "readonly": ""}>`
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
			});
			
		});
		
		function getDataHeader(woNumber){
			var selectedText = $("#selectItem option:selected").val();
			var desc = $('#selectItem option:selected').attr('desc');
			$("#form1").removeClass('hide');
			$("#item1").addClass('hide');
			$("#item2").removeClass('hide');
			$("#itemSelected").attr('placeholder',desc);
			$("#wonumber").val(woNumber);
			$("#wodesc").val(desc);
			
			$.post("<?php echo site_url('transaksi1/disassembly/disassembly_header_uom');?>",{material_no: woNumber},(data)=>{
				const value = JSON.parse(data);
<<<<<<< HEAD
				if(value.data[0]['U_Locked'] == 'Y'){
					$("#btnAddListItem").addClass('hide');
				}
				$("#uomProduksi").val(value.data[0]['InvntryUom']);
				$('#onHand').val(value.data[0]['OnHand']);
=======
				// console.log(value.data[0]['BuyUnitMsr']);
				if(value.data[0]['U_Locked'] == 'N'){
					$("#btnAddListItem").addClass('hide');
				}
				$("#uomProduksi").val(value.data[0]['BuyUnitMsr']);
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
			});
		}
		
		$('#qtyProduksi').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				event.preventDefault();
				$("#form2").removeClass('hide');
				$("#form3").removeClass('hide');
				const qty = $("#qtyProduksi").val();
				$(this).attr('readonly', true);
				
				let kode_paket = $("#wonumber").val();

				var obj = $('#tblWhole tbody tr').length;

				if(obj>0){
					const tables = $('#tblWhole').DataTable();

					tables.destroy();
					$("#tblWhole > tbody > tr").remove();
				}
				
                dataTable = $("#tblWhole").DataTable({
                    "ordering":false,  "paging": false, "searching":true,
					drawCallback: function() {
					$('.form-control-select2').select2();
					},
                    "ajax": {
                        "url":"<?php echo site_url('transaksi1/disassembly/showDetailInput');?>",
						"data":{  
							kode_paket:kode_paket,
							Qty:qty

						},
                        "type":"POST"
                    },
                    "columns": [
<<<<<<< HEAD
                        {"data":"material_no", "className":"dt-center"},
                        {"data":"material_desc"},
                        {"data":"qty", "className":"dt-center"},
                        {"data":"uom", "className":"dt-center"},
                        {"data":"OnHand", "className":"dt-center"}
=======
                        {"data":"id_mpaket_h_detail", "className":"dt-center", render:function(data, type, row, meta){
                            rr=`<input type="checkbox"  value="dt_${row['no']}" class="check_delete" id="dt_${row['no']}" onclick="checkcheckbox();">`;
                            return rr;
                        }},
                        {"data":"material_no", "className":"dt-center"},
                        {"data":"descolumn"},
                        {"data":"qty", "className":"dt-center"},
                        {"data":"uom", "className":"dt-center"},
                        {"data":"OnHand", "className":"dt-center"},
                        {"data":"MinStock", "className":"dt-center"},
                        {"data":"OpenQty", "className":"dt-center"}
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                    ]
                });
			}
		});

<<<<<<< HEAD
		function onAddrow(){
			let getTable = $("#tblWhole").DataTable();
			count = getTable.rows().count() + 1;
			let elementSelect = document.getElementsByClassName(`dt_${count}`);
			
			getTable.row.add({
				"material_no":"",
				"descolumn":`<select class="form-control form-control-select2 dt_${count} testSelect" data-live-search="true" id="selectDetailMatrial" data-count="${count}">
								<option value="">Select Item</option>
								${showMatrialDetailData(elementSelect)}
							</select>`,
				"qty":`<input type="text" class="form-control qty" id="editqty_${count}" value="" style="width:100%" autocomplete="off">`,
				"uom":"",
				"OnHand":"",
				"MinStock":"",
				"OpenQty":""
				}).draw();
				count++;

			tbody = $("#tblWhole tbody");
			tbody.on('change','.testSelect', function(){
				tr = $(this).closest('tr');
				no = tr[0].rowIndex;
				id = $('.dt_'+no+' option:selected').attr('rel');
				setValueTable(id,no);
			});
		}

		function setValueTable(id,no){
			table = document.getElementById("tblWhole").rows[no].cells;
			$.post(
				"<?php echo site_url('transaksi1/disassembly/getdataDetailMaterialSelect')?>",{ MATNR:id },(res)=>{
					matSelect = JSON.parse(res);
					matSelect.map((val)=>{
						table[0].innerHTML = val.MATNR;
						table[3].innerHTML = val.UNIT;
						table[4].innerHTML = val.OnHand;
					})
				}
			)
		}

		function showMatrialDetailData(select){
			$.ajax({
				url: "<?php echo site_url('transaksi1/disassembly/addItemRow');?>",
				type: "POST",
				success:function(res) {
					optData = JSON.parse(res);
					optData.forEach((val)=>{						
						$("<option />", {value:val.MAKTX, text:val.MAKTX, rel:val.MATNR}).appendTo(select);
					})
				}
			});			
		}

=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
		function addDatadb(id_approve = ''){
			if($('#postDate').val() ==''){
				alert('Posting date harus di isi');
				return false;
			}
			
			woNumber 	= $('#wonumber').val();
			woDesc 		= $('#wodesc').val();
			qtyProd 	= $('#qtyProduksi').val();
			uomProd 	= $('#uomProduksi').val();
			postDate 	= $('#postDate').val();
			approve		= id_approve;

			arr = woDesc.split(' - ');

			table = $('#tblWhole > tbody');
			let matrialNo =[];
			let matrialDesc =[];
			let qty =[];
			let uom =[];
			let onHand =[];
			let minStock =[];
			let outStandTot =[];
			let validasi = true;
			table.find('tr').each(function(i, el){
				let td = $(this).find('td');
				if(td.eq(3).find('input').val() == ''){
						validasi = false;
					}
<<<<<<< HEAD
				matrialNo.push(td.eq(0).text()); 
				matrialDesc.push(td.eq(1).text());
				qty.push(td.eq(2).text());
				uom.push(td.eq(3).text());	
				onHand.push(td.eq(4).text());	
=======
				matrialNo.push(td.eq(1).text()); 
				matrialDesc.push(td.eq(2).find('select').text());
				qty.push(td.eq(3).find('input').val());
				uom.push(td.eq(4).text());	
				onHand.push(td.eq(5).text());	
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
				minStock.push(td.eq(6).text());	
				outStandTot.push(td.eq(7).text());
			});
			if(!validasi){
				alert('Quatity Tidak boleh Kosong, Harap isi Quantity');
				return false;
			}
<<<<<<< HEAD
=======
			// console.log(matrialDesc);
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
			$.post("<?php echo site_url('transaksi1/disassembly/addData')?>",{
				woDesc:arr[1], woNumber:woNumber, qtyProd:qtyProd, uomProd:uomProd, postDate:postDate, approve:approve, matrialNo:matrialNo, matrialDesc:matrialDesc, qty:qty, uom:uom, onHand:onHand, minStock:minStock, outStandTot:outStandTot},
				function(res){
					location.reload(true);
				}
			);
			
		}
		</script>
	</body>
</html>