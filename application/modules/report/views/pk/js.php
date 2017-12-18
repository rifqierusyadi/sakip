<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/js-xlsx/xlsx.core.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/Blob.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/FileSaver.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/dist/js/tableexport.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/pace/pace.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/select2/select2.full.min.js'); ?>"></script>
<script type="text/javascript">
$(function () {
$('.select2').select2();

e = $("#tableID").tableExport({
        bootstrap: true,
        formats: ["xlsx"],
        position: "bottom",
        fileName: "PK-<?php echo date('dmy'); ?>",
    });

$('#tableID').DataTable({
    "paging": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive" :true
});
});

$("#periode").change(function(){
 var periode = $("#periode").val();
	if(periode){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('report/pk/get_tahun')?>",
				data: {
				   'periode': periode,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
						$('#tahun').html(msg);
				}
		});
	}
});

$("#satker").change(function(){
 var satker = $("#satker").val();
	if(satker){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('report/pk/get_jabatan')?>",
				data: {
				   'satker': satker,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
						$('#jabatan').html(msg);
				}
		});
	}
});

$("#filter").on('click', function(){
	var periode = $("#periode").val();
	var tahun = $("#tahun").val();
	var satker = $("#satker").val();
	var jabatan = $("#jabatan").val();

	if(periode){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('report/pk/result')?>",
				data: {
				   'periode': periode,
				   'tahun': tahun,
				   'satker': satker,
				   'jabatan': jabatan,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#hasil').html(msg);
					e = $("#tableID").tableExport({
					bootstrap: true,
					formats: ["xlsx"],
					position: "bottom",
					fileName: "PK-<?php echo date('dmy'); ?>",
				});

			$('#tableID').DataTable({
				"paging": false,
				"searching": false,
				"ordering": false,
				"info": false,
				"autoWidth": true,
				"responsive" :true
			});
		}
		});
	}else{
		alert('Silahkan Periode Terlebih Dahulu');
	}
});
</script>