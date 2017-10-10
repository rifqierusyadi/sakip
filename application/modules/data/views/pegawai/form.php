<div class="row">
	<div class="col-md-12">
		<div id="message"></div>
		<div class="box box-success box-solid">
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
						<div id="smartwizard">
						<ul>
							<li><a href="#step-1">Step 1<br /><small>Biodata Diri</small></a></li>
							<li><a href="#step-2">Step 2<br /><small>Kedudukan Pegawai</small></a></li>
							<li><a href="#step-3">Step 3<br /><small>Informasi Tambahan</small></a></li>
							<li><a href="#step-4">Step 4<br /><small>Kepemilikan Kartu</small></a></li>
						</ul>
						
						<div>
							<div id="step-1" class="">
								<h2>Step 1 - Biodata Diri</h2>
								
							</div>
							<div id="step-2" class="">
								<h2>Step 2 - Kedudukan Pegawai</h2>
								<div>:)</div>
							</div>
							<div id="step-3" class="">
								<h2>Step 3 - Informasi Tambahan</h2>
								:)
							</div>
							<div id="step-4" class="">
								<h2>Step 4 - Kepemilikan Kartu</h2>
								:)
							</div>
						</div>
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