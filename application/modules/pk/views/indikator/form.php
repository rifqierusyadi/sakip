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
			<input type="hidden" name="periode_id" id="periode_id" value="<?= set_value('periode_id', $sasaran->periode_id);  ?>" />
			<input type="hidden" name="sasaran_id" id="sasaran_id" value="<?= set_value('sasaran_id', $sasaran->id);  ?>" />
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
				<div class="col-md-12">
				<?php 
				if($sasaran){
						echo '<button class="btn btn-sm btn-flat btn-danger btn-block btn-social"><i class="fa fa-file-text-o"></i>'.$sasaran->sasaran.'</button><br>';
						echo '<div id="form-wrapper"><div id="child">';
						echo '<div class="input-group input-group"><div class="input-group-btn"><button class="btn btn-info btn-flat add-button" type="button" onclick="tambah()"><i class="fa fa-plus"></i></button></div>';
						echo '<div class="col-md-8">';
						$data = array('class'=>'form-control','name'=>'indikator[]','id'=>'indikator','type'=>'text','value'=>set_value('indikator[]'),'placeholder'=>'Indikator Sasaran Kinerja Utama');
						echo form_input($data);
						echo '</div><div id="satuan"><div class="col-md-4">';
						$selected = set_value('satuan_id');
						echo form_dropdown('satuan_id[]', $satuan, $selected, "class='form-control select2' name='satuan_id[]' id='satuan_id'");
						echo '</div></div></div></div></div><br>';
				}
				?>
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