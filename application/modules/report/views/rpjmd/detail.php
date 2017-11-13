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
	<?php
		$list = array();
		$i = 1;
		foreach($record as $option){
			$visis = $option['visi'];
			$misis = $option['misi'];
			$tujuans = $option['tujuan'];
			$sasarans = $option['sasaran'];
			//$indikators = $option['indikator'];
			//$list[$visis][$misis][$tujuans][$sasarans][$i] = $indikators;
			$list[$visis][$misis][$tujuans][$i] = $sasarans;
			$i++;

		}
		$all= array_chunk($list, 1, TRUE);
	?>
	<table class="print" id="tableID">
		<thead>
		<tr>
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
		<?php foreach($all as $a): ?>
			<?php foreach($a AS $b => $c){ ?>
			<tr>
			<td colspan = "10"><?= $b; ?></td>
			</tr>	
				<?php foreach($c AS $d => $e){ ?>
				<tr>
				<td><?= $d; ?></td>
				</tr>
					<?php foreach($e AS $f => $g){ ?>
					<tr>
						<td><?= $f; ?></td>
					</tr>
					<?php } ?>
				<?php } ?>
			<?php }; ?>
		<?php endforeach; ?>
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