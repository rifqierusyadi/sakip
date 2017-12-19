<div class="title">
	<div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
	<div class="judul"><h4><?= isset($head) ? $head : ''; ?><br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h4></div>
</div>
<div class="tabel">
<table class="print table table-striped" id="tableID" style="width:100%">
<thead>
<tr>
	<th>KINERJA<br>UTAMA</th>
	<th>INDIKATOR<br>KINERJA<br>UTAMA</th>
	<th>TARGET</th>
	<th>SATUAN</th>
	<th>REALISASI</th>
	<th>CAPAIAN %</th>
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
	<td><?php echo $row->indikator.' '.$row->indikator_id; ?></td>
	<td>
		<?php 
		if($triwulan == 1){
			$target = $row->tw1;
			echo $target; 
		}elseif($triwulan == 2){
			$target = $row->tw2;
			echo $target;
		}elseif($triwulan == 3){
			$target = $row->tw3;
			echo $target;
		}elseif($triwulan == 4){
			$target = $row->tw4;
			echo $target;
		}else{
			echo $target = null;
		}
		?>
	</td>
	<td><?php echo satuan($row->satuan_id); ?></td>
	<td><?php echo capaian($row->indikator_id, $tahun, $triwulan); ?></td>
	<td><?php echo number_format(rumus(capaian($row->indikator_id, $tahun, $triwulan), $target), 2); ?></td>
	</tr>
	<?php ++$i; ?>
	<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>