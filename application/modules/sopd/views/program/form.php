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
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('periode_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Periode RPJMD','periode_id');
							$selected = set_value('periode_id', $record->periode_id);
							echo form_dropdown('periode_id', $periode, $selected, "class='form-control select2' name='periode_id' id='periode_id'");
							echo form_error('periode_id') ? form_error('periode_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('kode') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Kode Program','kode');
							$data = array('class'=>'form-control','name'=>'kode','id'=>'kode','type'=>'text','value'=>set_value('kode', $record->kode));
							echo form_input($data);
							echo form_error('kode') ? form_error('kode', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('program') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Program','program');
							$data = array('class'=>'form-control','name'=>'program','id'=>'program','type'=>'text','value'=>set_value('program', $record->program));
							echo form_input($data);
							echo form_error('program') ? form_error('program', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
					<div class="field-wrapper">
						<div class="child">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group <?php echo form_error('rekening') ? 'has-error' : null; ?>">
									<?php
									echo form_label('Kode Rekening','rekening');
									$data = array('class'=>'form-control','name'=>'rekening[]','id'=>'rekening','type'=>'text','value'=>set_value('rekening[]'));
									echo form_input($data);
									echo form_error('rekening') ? form_error('rekening', '<p class="help-block">','</p>') : '';
									?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group <?php echo form_error('kegiatan') ? 'has-error' : null; ?>">
									<?php
									echo form_label('Kegiatan','kegiatan');
									$data = array('class'=>'form-control','name'=>'kegiatan[]','id'=>'kegiatan','type'=>'text','value'=>set_value('kegiatan[]'));
									echo form_input($data);
									echo form_error('kegiatan') ? form_error('kegiatan', '<p class="help-block">','</p>') : '';
									?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group <?php echo form_error('nilai') ? 'has-error' : null; ?>">
									<?php
										echo form_label('Nilai Kegiatan','nilai');
									?>
									
									<div class="input-group input-group">  
									<?php
									$data = array('class'=>'form-control','name'=>'nilai[]','id'=>'nilai','type'=>'text','value'=>set_value('nilai[]'));
									echo form_input($data);
									?>
									<div class="input-group-btn">
										<button class="btn btn-info btn-flat add-button" type="button"><i class="fa fa-plus"></i></button>
									</div>
									</div>
									<?php
									echo form_error('nilai') ? form_error('nilai', '<p class="help-block">','</p>') : '';
									?>
								</div>
							</div>
						</div>
						</div>
					</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('total') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Total Nilai Program','total');
							$data = array('class'=>'form-control','name'=>'total','id'=>'total','type'=>'text','value'=>set_value('total'));
							echo form_input($data);
							echo form_error('total') ? form_error('total', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-success" onclick="save()"><i class="fa fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="saveout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>