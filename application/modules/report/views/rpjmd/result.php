<div class="title">
	<div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
	<div class="judul"><h4><?= isset($head) ? $head : ''; ?><br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h4></div>
</div>
<div class="tabel">
<table class="print table table-striped" id="tableID" style="width:100%">
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
	<?php if($record): ?>
	<?php $tujuan = null; ?>
	<?php $sasaran = null; ?>
	<?php foreach($record as $row): ?>
		<tr>
			<td><?= $row->visi; ?></td>
			<td><?= $row->misi; ?></td>
			<?php if($tujuan != $row->tujuan): ?>
			<?php $tujuan = $row->tujuan; ?>
			<td><?= '<b>'.$row->tujuan.'</b>'; ?></td>
			<?php else: ?>
			<td></td>
			<?php endif; ?>
			
			<?php if($sasaran != $row->sasaran): ?>
			<?php $sasaran = $row->sasaran; ?>
			<td><?= '<b>'.$row->sasaran.'</b>'; ?></td>
			<?php else: ?>
			<td></td>
			<?php endif; ?>
			
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
	<?php endif; ?>
	</tbody>
</table>
</div>