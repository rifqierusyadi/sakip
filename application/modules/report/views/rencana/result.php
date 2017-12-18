<div class="title">
	<div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
	<div class="judul"><h4><?= isset($head) ? $head : ''; ?><br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h4></div>
</div>
<div class="tabel">
<table class="print table table-striped" id="tableID" style="width:100%">
<thead>
<tr>
	<th rowSpan="2">SASARAN<br>STRATEGIS</th>
	<th rowSpan="2">INDIKATOR<br>KINERJA<br>UTAMA</th>
	<th colspan='4'>TARGET</th>
	<th rowSpan="2">SATUAN</th>
</tr>
<tr>
	<th>TW.I</th>
	<th>TW.II</th>
	<th>TW.III</th>
	<th>TW.IV</th>
</tr>
</thead>
<tbody>
<?php if($record): ?>
	<?php $i = 1; ?>
	<?php $sasaran = null; ?>
	<?php foreach($record as $row): ?>
	<tr>
	<?php if($sasaran != $row->sasaran): ?>
	<?php $sasaran = $row->sasaran; ?>
	<td><?= $row->sasaran; ?></td>
	<?php else: ?>
	<td></td>
	<?php endif; ?>
	<td><?php echo $row->indikator; ?></td>
	<td><?php echo $row->tw1; ?></td>
	<td><?php echo $row->tw2; ?></td>
	<td><?php echo $row->tw3; ?></td>
	<td><?php echo $row->tw4; ?></td>
	<td><?php echo satuan($row->satuan_id); ?></td>
	</tr>
	<?php ++$i; ?>
	<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>