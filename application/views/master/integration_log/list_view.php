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
				<div class="content">
                    <div class="card">
                        <div class="card-header">
                            <legend class="font-weight-semibold"><i class="icon-list mr-2"></i>List of Integration Log</legend>
                        </div>
                        <div class="card-body">
                            <table id="table-manajemen" class="table table-striped " style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Modul</th>
                                        <th>Message</th>
                                        <th>Error Time</th>
                                        <th>Trans ID</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>                    
				</div>
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
				<?php  $this->load->view("_template/footer.php")?>
			</div>
		</div>
        <?php  $this->load->view("_template/js.php")?>
        <script>
            $(document).ready(function(){
                let freeze = '<?php echo $freeze; ?>';
                let am = '<?php echo $am; ?>';
                let rm = '<?php echo $rm; ?>';
                let ids = '<?php echo $opname_header['ids']; ?>';

                var table = $('#table-manajemen').DataTable({
                    "ordering":false,  "paging": true, "searching":true,
                    "ajax": {
                        "url":"<?php echo site_url('master/integration/showAllData');?>",
                        "type":"POST"
                    },
					"order": [[ 0, 'asc' ]],
                    "columns": [
                        {"data":"modul"},
                        {"data":"modul"},
                        {"data":"message"},
                        {"data":"time_error"},
                        {"data":"id_trans"},
                        {"data":"id_error","className":"dt-center", render:function(data, type, row, meta){
                                rr = freeze=='N' || ids || am==1 || rm==1 ? `<a href='<?php echo site_url('master/integration/edit')?>' ><i class='icon-file-plus2' title="Edit"></i></a>&nbsp;` : '';
                                return rr;
                            }
                        }
                    ]
                });
				table.on( 'order.dt search.dt', function () {
					table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
						cell.innerHTML = i+1;
					} );
				} ).draw();
            });
        </script>
	</body>
</html>