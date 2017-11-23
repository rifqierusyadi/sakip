<div class="row">
	<div class="col-md-12">
		<div id="message"></div>
		<div class="box box-primary box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?= isset($head) ? $head : ''; ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<form id="formID" role="form" action="" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input type="hidden" name="indikator_id" value="<?= $record->id; ?>" />
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="alert bg-light-blue color-palette alert-dismissible">
						<dl class="dl-horizontal">
							<dt>PERIODE</dt>
							<dd class="besar"><?= $record->periode; ?></dd>
							<dt>SASARAN</dt>
							<dd class="besar"><?= $record->sasaran; ?></dd>
							<dt>INDIKATOR</dt>
							<dd class="besar"><?= $record->indikator; ?></dd>
							<dt>SATUAN</dt>
							<dd class="besar"><?= $record->satuan; ?></dd>
						</dl>
						</div>
					</div>
					<?php 
						$i = null;
						if($target){ 
						$i = $target->tahun;
					?>
						
						<div class="col-md-2">
						<div class="form-group <?php echo form_error('targetx') ? 'has-error' : null; ?>">
						<?php
						echo form_label('Target '.$i,'targetx');
						$data = array('class'=>'form-control','name'=>'targetx','id'=>'targetx','type'=>'text','value'=>set_value('targetx', $target->target),'disabled'=>'disabled');
						echo form_input($data);
						echo form_error('targetx') ? form_error('targetx', '<p class="help-block">','</p>') : '';
						?>
						<input type="hidden" name="tahun" value="<?= $i; ?>" />
						</div>
						</div>
						
						<div class="col-md-2">
						<div class="form-group <?php echo form_error('tw1x') ? 'has-error' : null; ?>">
						<?php
						echo form_label('TW I ','tw1x');
						$data = array('class'=>'form-control','name'=>'tw1x','id'=>'tw1x','type'=>'text','value'=>set_value('tw1x', $target->tw1),'disabled'=>'disabled');
						echo form_input($data);
						echo form_error('tw1x') ? form_error('tw1x', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>
						
						<div class="col-md-2">
						<div class="form-group <?php echo form_error('tw2x') ? 'has-error' : null; ?>">
						<?php
						echo form_label('TW II ','tw2x');
						$data = array('class'=>'form-control','name'=>'tw2x','id'=>'tw2x','type'=>'text','value'=>set_value('tw2x', $target->tw2),'disabled'=>'disabled');
						echo form_input($data);
						echo form_error('tw2x') ? form_error('tw2x', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>
						
						<div class="col-md-2">
						<div class="form-group <?php echo form_error('tw3x') ? 'has-error' : null; ?>">
						<?php
						echo form_label('TW III ','tw3x');
						$data = array('class'=>'form-control','name'=>'tw3x','id'=>'tw3x','type'=>'text','value'=>set_value('tw3x',$target->tw3),'disabled'=>'disabled');
						echo form_input($data);
						echo form_error('tw3x') ? form_error('tw3x', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>

						<div class="col-md-2">
						<div class="form-group <?php echo form_error('tw4x') ? 'has-error' : null; ?>">
						<?php
						echo form_label('TW IV ','tw4x');
						$data = array('class'=>'form-control','name'=>'tw4x','id'=>'tw4x','type'=>'text','value'=>set_value('tw4x', $target->tw4),'disabled'=>'disabled');
						echo form_input($data);
						echo form_error('tw4x') ? form_error('tw4x', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>

						<div class="col-md-2">
						<div class="form-group <?php echo form_error('empty') ? 'has-error' : null; ?>">
						<?php
						echo form_label('&nbsp ');
						$data = array('class'=>'form-control','name'=>'','id'=>'','type'=>'text','value'=>set_value(''),'disabled'=>'disabled');
						echo form_input($data);
						echo form_error('empty') ? form_error('empty', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>
					<?php }else{
						echo '<div class="col-md-12">';
						echo '<h5>Belum ada target indikator yang dibuat. Silahkan Buat Terlebih Dahulu.</h5>';
						echo '</div>';
					} ?>

					<?php $periode = TRUE; ?>
					<?php if($detail){ ?>
						<div class="col-md-2">
						<div class="form-group <?php echo form_error('target') ? 'has-error' : null; ?>">
						<?php
						echo form_label('Realisasi '.$i,'realisasi');
						$data = array('class'=>'form-control','name'=>'realisasi','id'=>'realisasi','type'=>'text','value'=>set_value('realisasi', $detail->realisasi));
						echo form_input($data);
						echo form_error('realisasi') ? form_error('realisasi', '<p class="help-block">','</p>') : '';
						?>
						<input type="hidden" name="tahunx" value="<?= $i; ?>" />
						</div>
						</div>
						
						<div class="col-md-2">
						<div class="form-group <?php echo form_error('tw1') ? 'has-error' : null; ?>">
						<?php
						echo form_label('TW I ','tw1');
						$data = array('class'=>'form-control','name'=>'tw1','id'=>'tw1','type'=>'text','value'=>set_value('tw1', $detail->tw1));
						echo form_input($data);
						echo form_error('tw1') ? form_error('tw1', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>
						
						<div class="col-md-2">
						<div class="form-group <?php echo form_error('tw2') ? 'has-error' : null; ?>">
						<?php
						echo form_label('TW II ','tw2');
						$data = array('class'=>'form-control','name'=>'tw2','id'=>'tw2','type'=>'text','value'=>set_value('tw2', $detail->tw2));
						echo form_input($data);
						echo form_error('tw2') ? form_error('tw2', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>
						
						<div class="col-md-2">
						<div class="form-group <?php echo form_error('tw3') ? 'has-error' : null; ?>">
						<?php
						echo form_label('TW III ','tw3');
						$data = array('class'=>'form-control','name'=>'tw3','id'=>'tw3','type'=>'text','value'=>set_value('tw3', $detail->tw3));
						echo form_input($data);
						echo form_error('tw3') ? form_error('tw3', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>

						<div class="col-md-2">
						<div class="form-group <?php echo form_error('tw4') ? 'has-error' : null; ?>">
						<?php
						echo form_label('TW IV ','tw4');
						$data = array('class'=>'form-control','name'=>'tw4','id'=>'tw4','type'=>'text','value'=>set_value('tw4', $detail->tw4));
						echo form_input($data);
						echo form_error('tw4') ? form_error('tw4', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>

						<div class="col-md-2">
						<div class="form-group <?php echo form_error('empty') ? 'has-error' : null; ?>">
						<?php
						echo form_label('&nbsp ');
						$data = array('class'=>'form-control','name'=>'','id'=>'','type'=>'text','value'=>set_value(''),'disabled'=>'disabled');
						echo form_input($data);
						echo form_error('empty') ? form_error('empty', '<p class="help-block">','</p>') : '';
						?>
						</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="saveout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>