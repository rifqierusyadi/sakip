<div class="title">
	<div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
	<div class="judul"><h4><?= isset($head) ? $head : ''; ?> PEMERINTAH PROVINSI KALIMANTAN SELATAN</h4></div>
</div>
<div class="tabel">
<table class="print table table-striped" id="tableID" style="width:100%">
<thead>
<tr>
	<th>KINERJA<br>UTAMA</th>
	<th>INDIKATOR<br>KINERJA<br>UTAMA</th>
	<th>TARGET</th>
	<th>SATUAN</th>
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
	<td style="text-align:center;"><?php echo $row->target; ?></td>
	<td><?php echo satuan($row->satuan_id); ?></td>
	</tr>
	<?php ++$i; ?>
	<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
<p>&nbsp;</p>
<table class="print table table-striped table-bordered" id="tableID" style="width:50%">
	<thead>
		<tr>
			<th>No</th>
			<th>Program / Kegiatan</th>
			<th>Anggaran</th>
		</tr>
	</thead>
<tbody>
<?php if($proker): ?>
<?php $no = 1; $total = 0; ?>
<?php foreach($proker as $z): ?>
	<tr>
	<td width="1%"><?= $no; ?></td>
	<td width="59%"><?= $z->proker; ?></td>
	<td width="40%" style="text-align:right;"><?= rupiah($z->total); ?></td>
	</tr>
<?php ++$no; $total += $z->total; ?>
<?php endforeach; ?>
<?php endif; ?>
</tbody>
<tfoot>
	<tr>
		<th></th>
		<th></th>
		<th style="text-align:right;"><?= rupiah($total); ?></th>
	</tr>
</tfoot>
	</table>
<p>&nbsp;</p>
	<table class="table" id="tableID" style="width:100%">
	<tr>
	<td width="33.33%"></td>
	<td width="33.33%"></td>
	<td width="33.33%" style="text-align:center;">
	<?php echo $jabatan['jabatan']; ?>
	<br><br><br><br><br>
	<?php echo $jabatan['nama']; ?><br>
	<?php echo $jabatan['nip']; ?>
	</td>
	</tr>
	</table>
</div>