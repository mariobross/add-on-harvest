<!DOCTYPE html>
<html lang="en">
	<head>
		<?php  $this->load->view("_template/head.php")?>
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
                    <div class="card">
                        <div class="card-header">
                            <legend class="font-weight-semibold"><i class="icon-search4 mr-2"></i>Search of Disassembly</legend>  
                        </div>
                        <div class="card-body">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Dari Tanggal</label>
                                        <div class="col-lg-3 input-group date">
                                            <input type="text" class="form-control" id="fromDate">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="icon-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <label class="col-lg-2 col-form-label">Sampai Tanggal</label>
                                        <div class="col-lg-4 input-group date">
                                            <input type="text" class="form-control" id="toDate">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="icon-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

<<<<<<< HEAD
=======

>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Status</label>
                                        <div class="col-lg-9">
                                            <select class="form-control form-control-select2" name="status" id="status" data-live-search="true">
<<<<<<< HEAD
                                                <option value="">-- All --</option>
=======
                                                <option value="">none selected</option>
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                                                <option value="2">Approved</option>
                                                <option value="1">Not Approved</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" onclick="search()">Search<i class="icon-search4  ml-2"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>                        
                    </div> 
<<<<<<< HEAD
                    <?php
                    if ($opname_header['freeze']){
                        $freeze = $opname_header['freeze']['freeze'];
                        $am = $opname_header['freeze']['am_approved'];
                        $rm = $opname_header['freeze']['rm_approved'];
                    } else {
                        $freeze = 'N';
                        $am = 0;
                        $rm = 0;
                    }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <legend class="font-weight-semibold"><i class="icon-list mr-2"></i>List of Disassembly</legend>
                            <?php if ($freeze=='N' && !$opname_header['ids']):?>
                            <a href="<?php echo site_url('transaksi1/disassembly/add') ?>" class="btn btn-primary"> Add New</a>
                            <input type="button" value="Delete" class="btn btn-danger" id="deleteRecord">  
                            <?php endif; ?>
=======
                    <div class="card">
                        <div class="card-header">
                            <legend class="font-weight-semibold"><i class="icon-list mr-2"></i>List of Disassembly</legend>
                            <a href="<?php echo site_url('transaksi1/disassembly/add') ?>" class="btn btn-primary"> Add New</a>
                            <input type="button" value="Delete" class="btn btn-danger" id="deleteRecord">  
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="overflow:auto">
                                    <table id="tableWhole" class="table table-striped" >
                                        <thead>
                                            <tr>
                                                <th style="text-align: left"><input type="checkbox" name="checkall" id="checkall"></th>
                                                <th style="text-align: center">Action</th>
                                                <th style="text-align: center">ID</th>
                                                <th style="text-align: center">Item No</th>
                                                <th style="text-align: center">Item Description</th>
<<<<<<< HEAD
                                                <th style="text-align: center">Quantity Produksi</th>
=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                                                <th style="text-align: center">Posting Date</th>
                                                <th style="text-align: center">Status</th>
                                                <th style="text-align: center">Created by</th>
                                                <th style="text-align: center">Approved by</th>
                                                <th style="text-align: center">Last Modified</th>
                                                <th style="text-align: center">Receipt Number</th>
                                                <th style="text-align: center">Issue Number</th>
                                                <th style="text-align: center">Log</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>                   
				</div>
				<?php  $this->load->view("_template/footer.php")?>
			</div>
		</div>
        <?php  $this->load->view("_template/modal_delete.php")?>
        <?php  $this->load->view("_template/js.php")?>
        <script>
			
<<<<<<< HEAD
=======
			
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
            function search(){
                const fromDate = $('#fromDate').val();
                const toDate = $('#toDate').val();
                const status = $('#status').val();
				showDataList();
            };

            function showDataList(){
                const obj = $('#tableWhole tbody tr').length;

                if(obj > 0){
                    const dataTable = $('#tableWhole').DataTable();
                    dataTable.destroy();
                    $('#tableWhole > tbody > tr').remove();
                    
                }
                
<<<<<<< HEAD
                const fromDate = $('#fromDate').val();
                const toDate = $('#toDate').val();
                const status = $('#status').val();      

                let freeze = '<?php echo $freeze; ?>';
                let am = '<?php echo $am; ?>';
                let rm = '<?php echo $rm; ?>';
                let ids = '<?php echo $opname_header['ids']; ?>';     

                dataTable = $('#tableWhole').DataTable({
                    "ordering":true,  "paging": true, "searching":true,
=======

                const fromDate = $('#fromDate').val();
                const toDate = $('#toDate').val();
                const status = $('#status').val();           

                dataTable = $('#tableWhole').DataTable({
                    "ordering":false,  "paging": true, "searching":true,
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                    "ajax": {
                        "url":"<?php echo site_url('transaksi1/disassembly/showListData');?>",
                        "type":"POST",
                        "data":{fDate: fromDate, tDate: toDate, stts: status}
                    },
                    "columns": [
                        {"data":"id_disassembly_header", "className":"dt-center", render:function(data, type, row, meta){
                            rr=`<input type="checkbox" class="check_delete" id="chk_${data}" value="${data}" onclick="checkcheckbox();">`;
                            return rr;
                        }},
                        {"data":"id_disassembly_header", "className":"dt-center", render:function(data, type, row, meta){
                            rr = `<div style="width:100px">
<<<<<<< HEAD
                                    ${freeze=='N' || ids || am==1 || rm==1 ? `<a href='<?php echo site_url('transaksi1/disassembly/edit/')?>${data}' ><i class='icon-file-plus2' title="Edit"></i></a>&nbsp;` : ''}
                                </div>`;
=======
                                    <a href='<?php echo site_url('transaksi1/disassembly/edit/')?>${data}' ><i class='icon-file-plus2' title="Edit"></i></a>&nbsp;
                                    </div>`;
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                            return rr;
                        }},
                        {"data":"id_disassembly_header", "className":"dt-center"},
                        {"data":"kode_paket", "className":"dt-center"},
                        {"data":"nama_paket", "className":"dt-center"},
<<<<<<< HEAD
                        {"data":"qty_paket", "className":"dt-center"},
=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                        {"data":"posting_date"},
                        {"data":"status"},
                        {"data":"created_by"},
                        {"data":"approved_by"},
						{"data":"lastmodified"},
						{"data":"disassembly_no"},
                        {"data":"issue"},
                        {"data":"back"}
                    ]
                });
            }

            $(function(){
                
                $('#fromDate').datepicker({autoclose:true});
                $('#toDate').datepicker({autoclose:true});

                showDataList();
                
                // untuk check all
                $("#checkall").click(function(){
                    if($(this).is(':checked')){
                        $(".check_delete").prop('checked', true);
                    }else{
                        $(".check_delete").prop('checked', false);
                    }
                });
<<<<<<< HEAD

=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                // end check all
                $("#deleteRecord").click(function(){
                    let deleteidArr=[];
                    let getTable = $("#tableWhole").DataTable();
                    $("input:checkbox[class=check_delete]:checked").each(function(){
                        deleteidArr.push($(this).val());
                    })
<<<<<<< HEAD

=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                    // mengecek ckeckbox tercheck atau tidak
                    if(deleteidArr.length > 0){
                        var confirmDelete = confirm("Do you really want to Delete records?");
                        if(confirmDelete == true){
                            $.ajax({
                                url:"<?php echo site_url('transaksi1/disassembly/deleteData');?>", //masukan url untuk delete
                                type: "post",
                                data:{deleteArr: deleteidArr},
                                success:function(res) {
                                    location.reload(true);
                                    getTable.row($(this).closest("tr")).remove().draw();
                                }
                            });
                        }
                    }
                });
<<<<<<< HEAD

=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                // ini adalah function versi ES6
                checkcheckbox = () => {
                    
                    const lengthcheck = $(".check_delete").length;
                    
                    let totalChecked = 0;
                    $(".check_delete").each(function(){
                        if($(this).is(":checked")){
                            totalChecked += 1;
                        }
                    });
                    if(totalChecked == lengthcheck){
                        $("#checkall").prop('checked', true);
                    }else{
                        $("#checkall").prop('checked', false);
                    }
                }
<<<<<<< HEAD

=======
>>>>>>> 8281b7891b2d52ae86f2a0749f32dd848350def3
                deleteConfirm = (url)=>{
                    $('#btn-delete').attr('href', url);
	                $('#deleteModal').modal();
                }
        });
        
        </script>
	</body>
</html>