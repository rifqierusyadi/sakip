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
        fileName: "Matriks RPJMD-<?php echo date('dmy'); ?>",
    });

$('#tableID').DataTable({
    "paging": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive" :true,
    "columnDefs":[{
        targets:[0, 1], visible: false, class:'never'
    }],
	drawCallback: function ( settings ) {
		var api = this.api();
		var rows = api.rows( {page:'current'} ).nodes();
		var last=null;
		var span = document.getElementById('tableID').rows[0].cells.length;

		api.column(0, {page:'current'} ).data().each( function ( kolom, i ) {
			if ( last !== kolom ) {
				$(rows).eq( i ).before(
				'<tr class="bg-light-blue color-palette disabled" ><td colspan="'+span+'"><b>'+kolom+'</b></td></tr>'
				);
				last = kolom;
			}
		});

		api.column(1, {page:'current'} ).data().each( function ( kolom, i ) {
			if ( last !== kolom ) {
				$(rows).eq( i ).before(
				'<tr class="bg-light-blue color-palette disabled" ><td colspan="'+span+'"><b>'+kolom+'</b></td></tr>'
				);
				last = kolom;
			}
		});
	},
});
});

$("#filter").on('click', function(){
	var periode = $("#periode").val();
	if(periode){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('report/rpjmd/result')?>",
				data: {
				   'periode': periode,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#hasil').html(msg);
					e = $("#tableID").tableExport({
					bootstrap: true,
					formats: ["xlsx"],
					position: "bottom",
					fileName: "Matriks RPJMD-<?php echo date('dmy'); ?>",
				});

			$('#tableID').DataTable({
				"paging": false,
				"searching": false,
				"ordering": false,
				"info": false,
				"autoWidth": true,
				"responsive" :true,
				"columnDefs":[{
					targets:[0, 1], visible: false, class:'never'
				}],
				drawCallback: function ( settings ) {
					var api = this.api();
					var rows = api.rows( {page:'current'} ).nodes();
					var last=null;
					var span = document.getElementById('tableID').rows[0].cells.length;

					api.column(0, {page:'current'} ).data().each( function ( kolom, i ) {
						if ( last !== kolom ) {
							$(rows).eq( i ).before(
							'<tr class="bg-light-blue color-palette disabled" ><td colspan="'+span+'"><b>'+kolom+'</b></td></tr>'
							);
							last = kolom;
						}
					});

					api.column(1, {page:'current'} ).data().each( function ( kolom, i ) {
						if ( last !== kolom ) {
							$(rows).eq( i ).before(
							'<tr class="bg-light-blue color-palette disabled" ><td colspan="'+span+'"><b>'+kolom+'</b></td></tr>'
							);
							last = kolom;
						}
					});
				},
			});
		}
		});
	}else{
		alert('Silahkan Periode Terlebih Dahulu');
	}
});
</script>