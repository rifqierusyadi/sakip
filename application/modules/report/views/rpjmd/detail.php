<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= isset($head) ? $head : ''; ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.css'); ?>">
		<link rel="stylesheet" href="<?= base_url('asset/plugins/tableexport/dist/css/tableexport.min.css'); ?>">
  		<link rel="stylesheet" href="<?= base_url('asset/dist/css/print_fullpage.css'); ?>" />
		
		<style>p{margin:0px;}</style>
	</head>
<body>
<div class="book">
    <div class="page">
	<div class="title">
            <div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
            <div class="judul"><h3><?= isset($head) ? $head : ''; ?><br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3></div>
    </div>
	<!-- identitas -->
	<div class="tabel">
	<?php
		// $list = array();
		// $i = 1;
		// foreach($record as $option){
		// 	$visis = $option['visi'];
		// 	$misis = $option['misi'];
		// 	$tujuans = $option['tujuan'];
		// 	$sasarans = $option['sasaran'];
		// 	//$indikators = $option['indikator'];
		// 	//$list[$visis][$misis][$tujuans][$sasarans][$i] = $indikators;
		// 	$list[$visis][$misis][$tujuans][$i] = $sasarans;
		// 	$i++;

		// }
		// $all= array_chunk($list, 1, TRUE);
	?>
	<table class="print" id="tableID">
		<thead>
		<tr>
			<th>VISI</th>
			<th>MISI</th>
			<th>TUJUAN</th>
			<th>SASARAN</th>
			<th>INDIKATOR</th>
			<th>KONDISI AWAL</th>
			<th>2016</th>
			<th>2017</th>
			<th>2018</th>
			<th>2019</th>
			<th>2020</th>
			<th>TARGET AKHIR</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($record as $row): ?>
			<tr>
				<td><?= $row->visi; ?></td>
				<td><?= $row->misi; ?></td>
				<td><?= $row->tujuan; ?></td>
				<td><?= $row->sasaran; ?></td>
				<td><?= $row->indikator; ?></td>
				<td><?= target('2015',$row->indikator_id); ?></td>
				<td><?= target('2016',$row->indikator_id); ?></td>
				<td><?= target('2017',$row->indikator_id); ?></td>
				<td><?= target('2018',$row->indikator_id); ?></td>
				<td><?= target('2019',$row->indikator_id); ?></td>
				<td><?= target('2020',$row->indikator_id); ?></td>
				<td><?= target('2021',$row->indikator_id); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
	<p><?php //echo '<img src="'.site_url('report/pangkat/barcode/0123456789').'">'; ?></p>
</div>
</div>
<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/js-xlsx/xlsx.core.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/Blob.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/FileSaver.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/dist/js/tableexport.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/pace/pace.min.js'); ?>"></script>
<script type="text/javascript">
$(function () {
e = $("#tableID").tableExport({
        bootstrap: true,
        formats: ["xlsx","txt"],
        position: "top",
        fileName: "RPJMD-<?php echo date('dmy'); ?>",
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
</script>
</body>
</html>