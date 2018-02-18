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
							echo form_label('Periode','periode_id');
							$selected = set_value('periode_id', $record->periode_id);
							echo form_dropdown('periode_id', $periode, $selected, "class='form-control select2' name='periode_id' id='periode_id'");
							echo form_error('periode_id') ? form_error('periode_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
					<div class="form-group <?php echo form_error('tahun') ? 'has-error' : null; ?>">
						<?php
						echo form_label('Tahun','tahun');
						echo form_dropdown('tahun', array(''=>'Pilih Tahun'), '', "class='form-control select2' name='tahun' id='tahun'");
						echo form_error('tahun') ? form_error('tahun', '<p class="help-block">','</p>') : '';
						?>
					</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('kode') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Kode Program / Kegiatan','kode');
							$data = array('class'=>'form-control','name'=>'kode','id'=>'kode','type'=>'text','value'=>set_value('kode', $record->kode), 'readonly'=>'readonly');
							echo form_input($data);
							echo form_error('kode') ? form_error('kode', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('proker') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Program / Kegiatan','proker');
							$data = array('class'=>'form-control','name'=>'proker','id'=>'proker','type'=>'text','value'=>set_value('proker', $record->proker),'readonly'=>'readonly');
							echo form_input($data);
							echo form_error('proker') ? form_error('proker', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('jabatan[]') ? 'has-error' : null; ?>">
							<?php
							if($bidang){
								foreach($bidang as $x){
									$data[] = $x->jabatan; 
								}
							}else{
								$data[] = FALSE;
							}
							
							echo form_label('Penanggung Jawab','jabatan');
							$selected = set_value('jabatan[]', $data);
							echo form_dropdown('jabatan[]', $jabatan, $selected, "disabled class='form-control select2' name='jabatan' id='jabatan' multiple");
							echo form_error('jabatan[]') ? form_error('jabatan[]', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('total') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Total Nilai Program','total');
							$data = array('class'=>'form-control','name'=>'total','id'=>'total','type'=>'text','value'=>set_value('total', $record->total),'readonly'=>'readonly');
							echo form_input($data);
							echo form_error('total') ? form_error('total', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('realisasi') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Realisasi Nilai Program','realisasi');
							$data = array('class'=>'form-control','name'=>'realisasi','id'=>'realisasi','type'=>'text','value'=>set_value('realisasi', $record->realisasi));
							echo form_input($data);
							echo form_error('realisasi') ? form_error('realisasi', '<p class="help-block">','</p>') : '';
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