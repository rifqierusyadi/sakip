<div class="title">
	<div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
	<div class="judul"><h4><?= isset($head) ? $head : ''; ?><br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h4></div>
</div>
<div class="tabel">
<table class="print table" style="width:100%">
<tr>
	<td width="19%">INSTANSI</td>
	<td width="1%">:</td>
	<td><?= $data['satker']; ?></td>
</tr>
<tr>
	<td>TUGAS</td>
	<td>:</td>
	<td><?= $data['tugas']; ?></td>
</tr>
<tr>
	<td>FUNGSI</td>
	<td>:</td>
	<td><?= $data['fungsi']; ?></td>
</tr>
</table>
<p>&nbsp</p>
<table class="print table table-striped" id="tableID" style="width:100%">
<thead>
<tr>
	<th>KINERJA<br>UTAMA</th>
	<th>INDIKATOR<br>KINERJA<br>UTAMA</th>
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