<!DOCTYPE html>
<html lang="en">
	<head>
		<title>LAPORAN MATRIKS RPJMD</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  		<?= isset($style) ? $this->load->view($style) : ''; ?>
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
	<div class="row text-muted well well-sm no-shadow panel">
		<div class="col-md-10">
			<?php
			echo form_label('Periode');
			echo form_dropdown('periode', $periode, '', "class='form-control select2' name='periode' id='periode'");
			?>
		</div>
		<div class="col-md-2">
			<?php
			echo form_label('&nbsp;');
			$data = array(
				'name'          => 'filter',
				'id'            => 'filter',
				'type'          => 'button',
				'content'       => '<i class="fa fa-search"></i> Filter',
				'class'			=> 'form-control'
			);
			echo form_button($data);
			?>
		</div>
	</div>
	
	<div id="hasil">
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
	</div>
<?= isset($js) ? $this->load->view($js) : ''; ?>
</body>
</html>