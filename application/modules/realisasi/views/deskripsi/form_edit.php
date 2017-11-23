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
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('deskripsi') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Penjelasan Indikator','deskripsi');
							?>
							<textarea class='form-control' name='deskripsi' id='deskripsi'><?= set_value('deskripsi', $row->deskripsi); ?></textarea>
							<?php
							echo form_error('deskripsi') ? form_error('deskripsi', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('bidang_id[]') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Bidang','bidang_id');
							if($bidang){
								foreach($bidang as $x){
									$data[] = $x->jabatan; 
								}
							}else{
								$data[] = FALSE;
							}
							//$data = array('J0003417','J0003418');
							$selected = set_value('bidang_id[]', $data);
							echo form_dropdown('bidang_id[]', $jabatan, $selected, "class='form-control select2' id='bidang' multiple");
							echo form_error('bidang_id[]') ? form_error('bidang_id[]', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('sumber') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Sumber Data','sumber');
							?>
							<textarea class='form-control' name='sumber' id='sumber'><?= set_value('sumber', $row->sumber); ?></textarea>
							<?php
							echo form_error('sumber') ? form_error('sumber', '<p class="help-block">','</p>') : '';
							?>
						</div>
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