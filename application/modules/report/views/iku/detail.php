<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= isset($head) ? $head : ''; ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?= base_url('asset/dist/css/print_fullpage.css'); ?>" />
		<link rel="stylesheet" href="<?= base_url('asset/plugins/tableexport/dist/css/tableexport.min.css'); ?>">
  		<link rel="stylesheet" href="<?= base_url('asset/plugins/pace/themes/blue/pace-theme-loading-bar.css'); ?>" />
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
	<table class="print" id="tableID">
		<thead>
		<tr>
			<th>NO</th>
			<th>SASARAN<br>STRATEGIS</th>
			<th>INDIKATOR<br>KINERJA<br>UTAMA</th>
			<th>PENJELASAN</th>
			<th>PENANGGUNG JAWAB</th>
			<th>SUMBER DATA</th>
		</tr>
		</thead>
		<tbody>
		<?php if($record): ?>
			<?php $i = 1; ?>
			<?php foreach($record as $row): ?>
			<tr>
			<td><?php echo number_format($i); ?></td>
			<td><?php echo $row->sasaran; ?></td>
			<td><?php echo $row->indikator; ?></td>
			<td><?php echo $row->deskripsi; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo $row->sumber; ?></td>
			</tr>
			<?php ++$i; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
</div>
	<p><?php //echo '<img src="'.site_url('report/pangkat/barcode/0123456789').'">'; ?></p>
</div>
</div>
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
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
        fileName: "IKU-<?php echo date('dmy'); ?>",
    });
});
</script>
</body>
</html>