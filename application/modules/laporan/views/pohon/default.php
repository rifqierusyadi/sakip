<!DOCTYPE html>
<html lang="en">
	<head>
		<title>LAPORAN POHON KINERJA</title>
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
		<div class="col-md-5">
			<?php
			echo form_label('Periode');
			echo form_dropdown('periode', $periode, '', "class='form-control select2' name='periode' id='periode'");
			?>
		</div>
		<div class="col-md-5">
			<?php
			echo form_label('Satuan Kerja');
			echo form_dropdown('satker', $satker, '', "class='form-control select2' name='satker' id='satker'");
			?>
		</div>
		<div class="col-md-1">
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
		<div class="col-md-1">
			<?php
			echo form_label('&nbsp;');
			$data = array(
				'name'          => 'print',
				'id'            => 'print',
				'type'          => 'button',
				'content'       => '<i class="fa fa-print"></i> Print',
				'class'			=> 'form-control',
				'onclick'		=> 'window.print()'
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
		<div id="basicdiagram" style="width: 100%; height: 750px; border-style: dotted; border-width: 1px;" />
	</div>
<?= isset($js) ? $this->load->view($js) : ''; ?>
</body>
</html>