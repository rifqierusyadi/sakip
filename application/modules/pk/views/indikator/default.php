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
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<a class="btn btn-sm btn-flat btn-success" onclick="add_data();" href="<?= site_url('pk/sasaran'); ?>"><i class="glyphicon glyphicon-list"></i> Kinerja Utama/ Sasaran</a>
						<button class="btn btn-sm btn-flat btn-danger" onclick="deleted_all();"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
						<button class="btn btn-sm btn-flat btn-default" data-toggle="tooltip" title="Reload Data" data-placement="right" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload Data</button>
						<span id="key" style="display: none;"><?= $this->security->get_csrf_hash(); ?></span>
						<table id="tableIDX" class="table table-striped table-bordered responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th width="5px"><input type="checkbox" id="check-all"></th>
									<th>Tingkat Jabatan</th>
									<th>Sasaran/Kinerja Utama</th>
									<th>Indikator Sasaran</th>
									<th>Satuan Indikator</th>
									<th>Periode</th>
									<th width="90px">Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
		</div>
	</div>
</div>