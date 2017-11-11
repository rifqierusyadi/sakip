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
			<input type="hidden" name="visi_idx" id="visi_idx" value="<?= set_value('visi_idx', $record->visi_id)  ?>" />
			<input type="hidden" name="misi_idx" id="misi_idx" value="<?= set_value('misi_idx', $record->misi_id)  ?>" />
			<input type="hidden" name="tujuan_idx" id="tujuan_idx" value="<?= set_value('tujuan_idx', $record->tujuan_id)  ?>" />
			<input type="hidden" name="sasaran_idx" id="sasaran_idx" value="<?= set_value('sasaran_idx', $record->sasaran_id)  ?>" />
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('periode_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Periode RPJMD','periode_id');
							$selected = set_value('periode_id', $record->periode_id);
							echo form_dropdown('periode_id', $periode, $selected, "class='form-control select2' name='periode_id' id='periode_id' disabled='disabled'");
							echo form_error('periode_id') ? form_error('periode_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('visi_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Visi RPJMD','visi_id');
							echo form_dropdown('visi_id', array(''=>'Pilih Visi RPJMD'), '', "class='form-control select2' name='visi_id' id='visi_id' disabled='disabled'");
							echo form_error('visi_id') ? form_error('visi_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('misi_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Misi RPJMD','misi_id');
							echo form_dropdown('misi_id', array(''=>'Pilih Misi RPJMD'), '', "class='form-control select2' name='misi_id' id='misi_id' disabled='disabled'");
							echo form_error('misi_id') ? form_error('misi_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tujuan_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tujuan Misi RPJMD','tujuan_id');
							echo form_dropdown('tujuan_id', array(''=>'Pilih Tujuan Misi RPJMD'), '', "class='form-control select2' name='tujuan_id' id='tujuan_id' disabled='disabled'");
							echo form_error('tujuan_id') ? form_error('tujuan_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('sasaran_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Sasaran Tujuan RPJMD','sasaran_id');
							echo form_dropdown('sasaran_id', array(''=>'Pilih Sasaran Tujuan RPJMD'), '', "class='form-control select2' name='sasaran_id' id='sasaran_id' disabled='disabled'");
							echo form_error('sasaran_id') ? form_error('sasaran_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('indikator') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Indikator','indikator');
							$data = array('class'=>'form-control','name'=>'indikator','id'=>'indikator','type'=>'text','value'=>set_value('indikator', $record->indikator));
							echo form_input($data);
							echo form_error('indikator') ? form_error('indikator', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('satuan_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Satuan Indikator','satuan_id');
							$selected = set_value('satuan_id', $record->satuan_id);
							echo form_dropdown('satuan_id', $satuan, $selected, "class='form-control select2' name='satuan_id' id='satuan_id'");
							echo form_error('satuan_id') ? form_error('satuan_id', '<p class="help-block">','</p>') : '';
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