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
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<span id="key" style="display: none;"><?= $this->security->get_csrf_hash(); ?></span>
						<table id="tableIDY" class="table table-striped table-bordered responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Periode</th>
									<th>Tahun</th>
									<!-- <th width="10px">Aksi</th> -->
								</tr>
							</thead>
							<tbody>
							<?php if($record): ?>
								<?php foreach($record as $row): ?>
								<tr>
									<td><?= $row->periode; ?></td>
									<td>
									<?php 
									for($i = $row->awal; $i <= $row->akhir; $i++){
										if(realisasi($row->id, $i)){
											$indikator[] = '<a class="btn btn-xs btn-flat btn-success" href="'.site_url('report/realisasi/detail/'.$this->uri->segment(4).'/'.$i).'" data-toggle="tooltip" title="Target">'.$i.'</a>';
										}else{
											$indikator[] = '<a class="btn btn-xs btn-flat btn-danger" href="" data-toggle="tooltip" title="Target">'.$i.'</a>';
							
										}
									}
									echo $indikator ? implode(" ", $indikator) : '-';
									?>
									</td>
								</tr>
								<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
		</div>
	</div>
</div>