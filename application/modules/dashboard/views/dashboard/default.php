<div class="row">
	<div class="col-md-12">
		<?php if($this->session->flashdata('flashconfirm')): ?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-check"></i> Sukses! <?php echo $this->session->flashdata('flashconfirm'); ?>.
		</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('flasherror')): ?>
		<div class="alert alert-info alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-info"></i> Perhatian! <?php echo $this->session->flashdata('flasherror'); ?>.
		</div>
		<?php endif; ?>
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
						<p>Selamat datang pada e-sakip versi Beta 1.0</p>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			
			<div class="box-footer">
				<div class="row">
					<div class="col-md-12">
						<?php if($record): ?>
						<?php
							$list = array();
							$i = 1;
							foreach($record as $option){
								$visis = $option['visi'];
								$misis = $option['misi'];
								$tujuans = $option['tujuan'];
								$sasarans = $option['sasaran'];
								$list[$visis][$misis][$tujuans][$i] = $sasarans;
								$i++;
							}
						?>
						<?php
							$all= array_chunk($list, 1, TRUE);
							//var_dump($list);
							foreach($all as $a){
						?>
							<ul>
								<?php
								foreach($a as $b => $c){
									echo '<p><b>'.$b.'</b></p>';
									foreach($c as $d => $e){
										echo '<dt><u>'.$d.'</u></dt>';
										foreach($e as $f => $g){
											echo '<dd><i>'.$f.'</i></dd>';
											foreach($g as $h => $i){
												echo '<li>'.$i.'</li>';
											}
										}
									}
								}
								?>
							</ul>
						<?php
							}
						?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>