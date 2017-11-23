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
					<?php $periode = $this->db->get_where('ref_periode', array('id'=>$record->periode_id))->row_array(); ?>
					<?php if($periode){ ?>
					<?php for($i = $periode['awal']-1; $i <= $periode['akhir']; $i++){ ?>
						<?php if($i == $periode['awal']-1){ ?>
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('target') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Kondisi Awal '.$i,'target');
							$data = array('class'=>'form-control','name'=>'target[]','id'=>'target','type'=>'text','value'=>set_value('target[]'));
							echo form_input($data);
							echo form_error('target') ? form_error('target', '<p class="help-block">','</p>') : '';
							?>
							<input type="hidden" name="tahun[]" value="<?= $i; ?>" />
							</div>
							</div>
							
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw1') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW I ','tw1');
							$data = array('class'=>'form-control','name'=>'tw1[]','id'=>'tw1','type'=>'text','value'=>set_value('tw1[]'));
							echo form_input($data);
							echo form_error('tw1') ? form_error('tw1', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>
							
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw2') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW II ','tw2');
							$data = array('class'=>'form-control','name'=>'tw2[]','id'=>'tw2','type'=>'text','value'=>set_value('tw2[]'));
							echo form_input($data);
							echo form_error('tw2') ? form_error('tw2', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>
							
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw3') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW III ','tw3');
							$data = array('class'=>'form-control','name'=>'tw3[]','id'=>'tw3','type'=>'text','value'=>set_value('tw3[]'));
							echo form_input($data);
							echo form_error('tw3') ? form_error('tw3', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>

							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw4') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW IV ','tw4');
							$data = array('class'=>'form-control','name'=>'tw4[]','id'=>'tw4','type'=>'text','value'=>set_value('tw4[]'));
							echo form_input($data);
							echo form_error('tw4') ? form_error('tw4', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>

							<div class="col-md-2">
							<div class="form-group <?php echo form_error('notasi') ? 'has-error' : null; ?>">
								<?php
								echo form_label('&nbsp','notasi');
								$selected = set_value('notasi[]');
								$opsi = array('>'=>'Jika Nilai > Baik', '<'=>'Jika Nilai < Baik');
								echo form_dropdown('notasi[]', $opsi, $selected, "class='form-control select2' name='notasi' id='notasi'");
								echo form_error('notasi') ? form_error('notasi', '<p class="help-block">','</p>') : '';
								?>
							</div>
							</div>
						<?php }elseif($i == $periode['akhir']){ ?>
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('target') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Target Akhir '.$i,'target');
							$data = array('class'=>'form-control','name'=>'target[]','id'=>'target','type'=>'text','value'=>set_value('target[]'));
							echo form_input($data);
							echo form_error('target') ? form_error('target', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>	

							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw1') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW I ','tw1');
							$data = array('class'=>'form-control','name'=>'tw1[]','id'=>'tw1','type'=>'text','value'=>set_value('tw1[]'));
							echo form_input($data);
							echo form_error('tw1') ? form_error('tw1', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>
							
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw2') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW II ','tw2');
							$data = array('class'=>'form-control','name'=>'tw2[]','id'=>'tw2','type'=>'text','value'=>set_value('tw2[]'));
							echo form_input($data);
							echo form_error('tw2') ? form_error('tw2', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>
							
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw3') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW III ','tw3');
							$data = array('class'=>'form-control','name'=>'tw3[]','id'=>'tw3','type'=>'text','value'=>set_value('tw3[]'));
							echo form_input($data);
							echo form_error('tw3') ? form_error('tw3', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>

							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw4') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW IV ','tw4');
							$data = array('class'=>'form-control','name'=>'tw4[]','id'=>'tw4','type'=>'text','value'=>set_value('tw4[]'));
							echo form_input($data);
							echo form_error('tw4') ? form_error('tw4', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>

							<div class="col-md-2">
							<div class="form-group <?php echo form_error('notasi') ? 'has-error' : null; ?>">
								<?php
								echo form_label('&nbsp','notasi');
								$selected = set_value('notasi[]');
								$opsi = array('>'=>'Jika Nilai > Baik', '<'=>'Jika Nilai < Baik');
								echo form_dropdown('notasi[]', $opsi, $selected, "class='form-control select2' name='notasi' id='notasi'");
								echo form_error('notasi') ? form_error('notasi', '<p class="help-block">','</p>') : '';
								?>
							</div>
							</div>
						<?php }else{ ?>
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('target') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Target '.$i,'target');
							$data = array('class'=>'form-control','name'=>'target[]','id'=>'target','type'=>'text','value'=>set_value('target[]'));
							echo form_input($data);
							echo form_error('target') ? form_error('target', '<p class="help-block">','</p>') : '';
							?>
							<input type="hidden" name="tahun[]" value="<?= $i; ?>" />
							</div>
							</div>

							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw1') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW I ','tw1');
							$data = array('class'=>'form-control','name'=>'tw1[]','id'=>'tw1','type'=>'text','value'=>set_value('tw1[]'));
							echo form_input($data);
							echo form_error('tw1') ? form_error('tw1', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>
							
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw2') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW II ','tw2');
							$data = array('class'=>'form-control','name'=>'tw2[]','id'=>'tw2','type'=>'text','value'=>set_value('tw2[]'));
							echo form_input($data);
							echo form_error('tw2') ? form_error('tw2', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>
							
							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw3') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW III ','tw3');
							$data = array('class'=>'form-control','name'=>'tw3[]','id'=>'tw3','type'=>'text','value'=>set_value('tw3[]'));
							echo form_input($data);
							echo form_error('tw3') ? form_error('tw3', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>

							<div class="col-md-2">
							<div class="form-group <?php echo form_error('tw4') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TW IV ','tw4');
							$data = array('class'=>'form-control','name'=>'tw4[]','id'=>'tw4','type'=>'text','value'=>set_value('tw4[]'));
							echo form_input($data);
							echo form_error('tw4') ? form_error('tw4', '<p class="help-block">','</p>') : '';
							?>
							</div>
							</div>

							<div class="col-md-2">
							<div class="form-group <?php echo form_error('notasi') ? 'has-error' : null; ?>">
								<?php
								echo form_label('&nbsp','notasi');
								$selected = set_value('notasi[]');
								$opsi = array('>'=>'Jika Nilai > Baik', '<'=>'Jika Nilai < Baik');
								echo form_dropdown('notasi[]', $opsi, $selected, "class='form-control select2' name='notasi' id='notasi'");
								echo form_error('notasi') ? form_error('notasi', '<p class="help-block">','</p>') : '';
								?>
							</div>
							</div>
						<?php } ?>
					<?php } ?>
					<?php } ?>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="savebackout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>