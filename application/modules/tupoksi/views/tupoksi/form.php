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
					<div class="form-group <?php echo form_error('jabatan') ? 'has-error' : null; ?>">
						<?php
						echo form_label('Jabatan','jabatan');
						$selected = set_value('jabatan');
						echo form_dropdown('jabatan', $jabatan, $selected, "class='form-control select2' id='jabatan'");
						echo form_error('jabatan') ? form_error('jabatan', '<p class="help-block">','</p>') : '';
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group <?php echo form_error('tugas') ? 'has-error' : null; ?>">
						<?php
						echo form_label('Tugas Pokok','tugas');
						?>
						<textarea class='form-control' name='tugas' id='tugas'><?= set_value('tugas', $record->tugas); ?></textarea>
						<?php
						echo form_error('tugas') ? form_error('tugas', '<p class="help-block">','</p>') : '';
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group <?php echo form_error('fungsi') ? 'has-error' : null; ?>">
						<?php
						echo form_label('Fungsi','fungsi');
						?>
						<textarea class='form-control' name='fungsi' id='fungsi'><?= set_value('fungsi', $record->fungsi); ?></textarea>
						<?php
						echo form_error('fungsi') ? form_error('fungsi', '<p class="help-block">','</p>') : '';
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