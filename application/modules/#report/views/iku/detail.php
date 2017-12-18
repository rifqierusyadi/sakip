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
			<th width="20%">SASARAN<br>STRATEGIS</th>
			<th width="20%">INDIKATOR<br>KINERJA<br>UTAMA</th>
			<th>PENJELASAN</th>
			<th>PENANGGUNG JAWAB</th>
			<th>SUMBER DATA</th>
		</tr>
		</thead>
		<tbody>
		<?php if($record): ?>
			<?php $i = 1; ?>
			<?php $sasaran = null; ?>
			<?php foreach($record as $row): ?>
			<tr>
			<td><?php echo number_format($i); ?></td>
			<?php if($sasaran != $row->sasaran): ?>
			<?php $sasaran = $row->sasaran; ?>
			<td><?= $row->sasaran; ?></td>
			<?php else: ?>
			<td></td>
			<?php endif; ?>

			<td><?php echo $row->indikator; ?></td>
			<td><?php echo strip_tags($row->deskripsi); ?></td>
			<td>
			<?php 
				$data = tanggung_jawab($row->indikator_id, $row->id);
				if($data){
					foreach($data as $x){
						echo ucwords(strtolower(posisi($x->jabatan)));
						echo '; ';
					}
				} 
			?>
			</td>
			<td><?php echo strip_tags($row->sumber); ?></td>
			</tr>
			<?php ++$i; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
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
        formats: ["xlsx"],
        position: "top",
        fileName: "IKU-<?php echo date('dmy'); ?>",
    });
});
</script>
</body>
</html>