<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= isset($title) ? $title : 'E-LAKIP KALSEL'; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/select2/select2.min.css'); ?>" />
  <link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.0.2/css/rowGroup.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/datepicker/datepicker3.css'); ?>" />
	<link rel="stylesheet" href="<?= base_url('asset/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/skins/_all-skins.min.css'); ?>">
	<?= isset($style) ? $this->load->view($style) : ''; ?>
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<style>body{font-size: 12px;}.nav-tabs-custom>.nav-tabs>li.active {border-top-color: #00a65a !important;}@media(min-width: 1024px){.main-header{top:0;left: 0;position: fixed;right: 0;z-index: 999;}.content-wrapper{padding-top:50px; padding-bottom:50px;}}.print{font-size: 9px;}.main-footer{bottom:0;left: 0;position: fixed;right: 0;z-index: 999;}</style>
	
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><b>E-</b>SAKIP</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book"></i> RPJMD <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('rpjmd/visi'); ?>"><i class="fa fa-file-text-o"></i> Visi RPJMD</a></li>
								<li><a href="<?= site_url('rpjmd/misi'); ?>"><i class="fa fa-file-text-o"></i> Misi RPJMD</a></li>
								<li><a href="<?= site_url('rpjmd/tujuan'); ?>"><i class="fa fa-file-text-o"></i> Tujuan RPJMD</a></li>
								<li><a href="<?= site_url('rpjmd/sasaran'); ?>"><i class="fa fa-file-text-o"></i> Sasaran/Kinerja Utama</a></li>
								<li><a href="<?= site_url('rpjmd/indikator'); ?>"><i class="fa fa-file-text-o"></i> Indikator Sasaran/Kinerja Utama</a></li>
                <li><a href="<?= site_url('rpjmd/makro'); ?>"><i class="fa fa-file-text-o"></i> Indikator Kinerja Makro</a></li>
								<li><a href="<?= site_url('#'); ?>"><i class="fa fa-file-text-o"></i> OPD Penanggung Jawab</a></li>
              </ul>
            </li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bank"></i> OPD <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('pk/jpt'); ?>"><i class="fa fa-file-text-o"></i> Pohon Kinerja JPT</a></li>
                <li><a href="<?= site_url('pk/admin'); ?>"><i class="fa fa-file-text-o"></i> Pohon Kinerja Administrator</a></li>
                <li><a href="<?= site_url('pk/pengawas'); ?>"><i class="fa fa-file-text-o"></i> Pohon Kinerja Pengawas</a></li>
                <li class="divider"></li>
               	 <li><a href="<?= site_url('kinerja/jpt'); ?>"><i class="fa fa-file-text-o"></i> Data Kinerja JPT</a></li>
                <li><a href="<?= site_url('kinerja/admin'); ?>"><i class="fa fa-file-text-o"></i> Data Kinerja Administrator</a></li>
                <li><a href="<?= site_url('kinerja/pengawas'); ?>"><i class="fa fa-file-text-o"></i> Data Kinerja Pengawas</a></li>
                <li class="divider"></li>
                <li><a href="<?= site_url('realisasi/jpt'); ?>"><i class="fa fa-file-text-o"></i> Realisasi Kinerja JPT</a></li>
                <li><a href="<?= site_url('realisasi/admin'); ?>"><i class="fa fa-file-text-o"></i> Realisasi Kinerja Administrator</a></li>
                <li><a href="<?= site_url('realisasi/pengawas'); ?>"><i class="fa fa-file-text-o"></i> Realisasi Kinerja Pengawas</a></li>
                <li class="divider"></li>
                <li><a href="<?= site_url('sopd/program'); ?>"><i class="fa fa-file-text-o"></i> Anggaran SOPD</a></li>
              </ul>
            </li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-print"></i> Laporan <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#"><i class="fa fa-file-text-o"></i> Matrik RPJMD</a></li>
								<li><a href="#"><i class="fa fa-file-text-o"></i> Pohon Kinerja</a></li>
								<li><a href="#"><i class="fa fa-file-text-o"></i> Indikator Kinerja Utama</a></li>
								<li class="divider"></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Rencana Aksi Tahunan</a></li>
								<li><a href="#"><i class="fa fa-file-text-o"></i> Pengukuran Kinerja Triwulan</a></li>
								<li><a href="#"><i class="fa fa-file-text-o"></i> Analisa Efisiensi/Efektifitas</a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Realisasi Kinerja dan Anggaran</a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Matriks Lakip BAB III</a></li>
              </ul>
            </li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i> Data Master <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('referensi/periode'); ?>"><i class="fa fa-database"></i> Master Periode</a></li>
								<li><a href="<?= site_url('referensi/satker'); ?>"><i class="fa fa-database"></i> Master Satuan Kerja</a></li>
								<li><a href="<?= site_url('referensi/eselon'); ?>"><i class="fa fa-database"></i> Master Tingkat Jabatan</a></li>
								<li><a href="<?= site_url('referensi/jabatan'); ?>"><i class="fa fa-database"></i> Master Jabatan</a></li>
								<li><a href="<?= site_url('referensi/satuan'); ?>"><i class="fa fa-database"></i> Master Jenis Satuan</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('setting/user'); ?>"><i class="fa fa-database"></i> Master Pengguna</a></li>
								<li><a href="<?= site_url('#'); ?>"><i class="fa fa-database"></i> Backup Database</a></li>
							</ul>
            </li>
						<li><a href="<?= site_url('sotk'); ?>"><i class="fa fa-sitemap"></i> SOTK</a></li>
						<li><a href="<?= site_url('logout'); ?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
						<!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('asset/dist/img/avatar5.png'); ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $this->session->userdata('username'); ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?= base_url('asset/dist/img/avatar5.png'); ?>" class="img-circle" alt="User Image">
								  <p>
                    Login E-Sakip
                    <small>Versi Beta 1.0 2017</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= site_url('setting/password/updated/'.$this->session->userdata('userID')); ?>" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Ganti Password</a>
                  </div>
									<div class="pull-right">
                    <a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Log Out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>E-SAKIP KALSEL<small>Beta 1.0</small></h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?= isset($content) ? $this->load->view($content) : ''; ?>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> Beta 1.0
      </div>
      <strong>Copyright &copy; 2017 <a href="#">Biro Organisasi Provinsi Kalimantan Selatan</a>.</strong> All rights
      reserved.
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/treetable/treeTable.js'); ?>"></script>
<script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/fastclick/fastclick.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/extensions/Responsive/js/responsive.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tinymce/tinymce.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/treetable/treeTable.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/number/jquery.number.min.js'); ?>"></script>
<script src="<?= base_url('asset/app.js'); ?>"></script>
<?= isset($js) ? $this->load->view($js) : ''; ?>

</body>
</html>
