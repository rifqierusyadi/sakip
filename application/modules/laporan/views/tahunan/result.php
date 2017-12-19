<div class="title">
	<div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
	<div class="judul"><h4><?= isset($head) ? $head : ''; ?><br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h4></div>
</div>
<div class="tabel">
<table class="print table table-striped" id="tableID" style="width:100%">
<thead>
<tr>
	<th rowSpan="2">KINERJA<br>UTAMA</th>
	<th rowSpan="2">INDIKATOR<br>KINERJA<br>UTAMA</th>
	<th rowSpan="2">CAPAIAN<br>TAHUN LALU</th>
	<th rowSpan="2">SATUAN</th>
	<th colSpan="3">TARGET DAN CAPAIAN</th>
	<th rowSpan="2">TARGET AKHIR</th>
	<th rowSpan="2">CAPAIAN TERHADAP<br>TARGET AKHIR</th>
</tr>
<tr>
	<th>TARGET</th>
	<th>REALISASI</th>
	<th>CAPAIAN</th>
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
	<td><?php echo $row->target; ?></td>
	<td><?php echo satuan($row->satuan_id); ?></td>
	<td><?php echo $row->target; ?></td>
	<td><?php echo capaian($row->indikator_id, $tahun, 4); ?></td>
	<td><?php echo number_format(rumus(capaian($row->indikator_id, $tahun, 4), $row->target), 2); ?></td>
	<td></td>
	<td></td>
	</tr>
	<?php ++$i; ?>
	<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>