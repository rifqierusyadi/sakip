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
			<input type="hidden" name="periode_idx" id="periode_idx" value="<?= set_value('periode_id', $record->periode_id)  ?>" />
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
						<div class="form-group <?php echo form_error('eselon_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tingkat Jabatan','eselon_id');
							$selected = set_value('eselon_id', $record->eselon_id);
							echo form_dropdown('eselon_id', $eselon, $selected, "class='form-control select2' name='eselon_id' id='eselon_id'");
							echo form_error('eselon_id') ? form_error('eselon_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('parent_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Sasaran Kinerja Induk','parent_id');
							echo form_dropdown('visi_id', array(''=>'Pilih Sasaran Kinerja Induk'), '', "class='form-control select2' name='parent_id' id='parent_id'");
							echo form_error('parent_id') ? form_error('parent_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="field-wrapper">
							<div class="child">
							<div class="form-group <?php echo form_error('sasaran') ? 'has-error' : null; ?>">
								<?php
									echo form_label('Sasaran Kinerja Utama','sasaran');
								?>
								<div class="input-group input-group">  
								  <?php
								  $data = array('class'=>'form-control','name'=>'sasaran[]','id'=>'sasaran','type'=>'text','value'=>set_value('sasaran[]'));
								  echo form_input($data);
								  ?>
								  <div class="input-group-btn">
									<button class="btn btn-info btn-flat add-button" type="button"><i class="fa fa-plus"></i></button>
								  </div>
								</div>
								<?php
								  echo form_error('sasaran') ? form_error('sasaran', '<p class="help-block">','</p>') : '';
								?>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="tujuan" id="tujuan"></div>
					</div>
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