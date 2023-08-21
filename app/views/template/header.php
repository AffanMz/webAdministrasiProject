<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="http://localhost/pds_web/public/css/bootstrap.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato&family=Lilita+One&family=Montserrat:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/style-tbl.css">
	<title><?= $data['judul'] ?></title>
	<link rel="shortcut icon" type="image/png"   href="<?= BASEURL; ?>/img/logo_pds.png">
</head>
<body class="bg-secondary-subtle bg-drop">
	<?php
		$tab = ['tagihan_asesmen', 'tagihan_psikotes', 'tagihan_konsultan', 'tagihan_diklat'];
		for ($i=0; $i < count($tab); $i++) { 
			$dba = new Database;
			$dba->query("SELECT * FROM ". $tab[$i]." WHERE status = 'BELUM'");
			if ($i == 0) {
				$data0 = count($dba->resultSet());
			} elseif ($i == 1) {
				$data1 = count($dba->resultSet());
			} elseif ($i == 2) {
				$data2 = count($dba->resultSet());
			} elseif ($i == 3) {
				$data3 = count($dba->resultSet());
			}
		}

		$table = ['data_konsultan', 'data_diklat'];
		for ($i=0; $i < count($table); $i++) { 
			$dba = new Database;
			$dba->query("SELECT * FROM ". $table[$i]." WHERE status = 'BELUM'");
			if ($i == 0) {
				$datai0 = count($dba->resultSet());
			} elseif ($i == 1) {
				$datai1 = count($dba->resultSet());
			}
		}

		$juma = $datai0+$datai1;

		$jum = $data0+$data1+$data2+$data3;

		$jumb = $juma + $jum;

		$status_link = 'active';
		$status_col = 'collapsed';
		$status_bool = 'false';
		$status_drop = '';
		$cont_pageD = ['data_asesmen','data_psikotes','data_diklat','data_konsultan','data_notad', 'data_user'];
		for ($i=0; $i < count($cont_pageD); $i++) { 
			if ($data['tbl'] == $cont_pageD[$i]) {
				$status_link = '';
				if ($data['tbl'] == 'data_asesmen') {
					$status_asesD = 'active';
					$status_psikoD = '';
					$status_konsD = '';
					$status_notad = '';
					$status_diklD = '';
				}elseif ($data['tbl'] == 'data_psikotes') {
					$status_asesD = '';
					$status_psikoD = 'active';
					$status_konsD = '';
					$status_notaD = '';
					$status_diklD = '';
				}elseif ($data['tbl'] == 'data_diklat') {
					$status_asesD = '';
					$status_psikoD = '';
					$status_konsD = '';
					$status_notaD = '';
					$status_diklD = 'active';
				}elseif ($data['tbl'] == 'data_konsultan') {
					$status_asesD = '';
					$status_psikoD = '';
					$status_konsD = 'active';
					$status_notaD = '';
					$status_diklD = '';
				}elseif ($data['tbl'] == 'data_notad') {
					$status_asesD = '';
					$status_psikoD = '';
					$status_konsD = '';
					$status_diklD = '';
					$status_notaD = 'active';
				}elseif ($data['tbl'] == 'data_user') {
					$status_link = '';
					$status_asesD = '';
					$status_psikoD = '';
					$status_konsD = '';
					$status_diklD = '';
					$status_notaD = '';
				}
			}
		}
		$cont_page = ['tagihan_asesmen','tagihan_psikotes','tagihan_diklat','tagihan_konsultan', 'pelunasan'];
		for ($i=0; $i < count($cont_page); $i++) { 
			if ($data['tbl'] == $cont_page[$i]) {
				$status_link = '';
				$status_col = '';
				$status_bool = 'true';
				$status_drop = 'show';
				if ($data['tbl'] == 'tagihan_asesmen') {
					$status_ases = 'active';
					$status_psiko = '';
					$status_kons = '';
					$status_dikl = '';
				}elseif ($data['tbl'] == 'tagihan_psikotes') {
					$status_ases = '';
					$status_psiko = 'active';
					$status_kons = '';
					$status_dikl = '';
				}elseif ($data['tbl'] == 'tagihan_diklat') {
					$status_ases = '';
					$status_psiko = '';
					$status_kons = '';
					$status_dikl = 'active';
				}elseif ($data['tbl'] == 'tagihan_konsultan') {
					$status_ases = '';
					$status_psiko = '';
					$status_kons = 'active';
					$status_dikl = '';
				}elseif ($data['tbl'] == 'pelunasan') {
					$status_bool = 'false';
					$status_col = 'collapsed';
					$status_link = '';
					$status_drop = '';
					$status_ases = '';
					$status_psiko = '';
					$status_kons = '';
					$status_dikl = '';
				}
			}
		}
	?>
	<div class="container-fluid">
		<div class="row past-now">
			<div class="col-3 col-cus fixed-top">
				<h1>PT PDS</h1>
				<div class="list-group">
				<a href="<?= BASEURL; ?>/dashboard" class="list-group-item list-group-item-action group-1 <?= $status_link; ?>" aria-current="true">Dashboard</a>
				<a href="<?= BASEURL; ?>/nota/data_notad" class="list-group-item list-group-item-action group-1  <?= $status_notaD; ?>">Nota UMLPJUM</a>
				<div class="accordion" id="accordionPanelsStayOpenExample">
				  <div class="accordion-item">
				    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
				      <button class="accordion-button <?= $status_col; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="<?= $status_bool; ?>" aria-controls="panelsStayOpen-collapseOne">
				        Tagihan
				      </button>
				    </h2>
				    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse <?= $status_drop; ?>" aria-labelledby="panelsStayOpen-headingOne">
						<div class="list-group">
						  <a href="<?= BASEURL; ?>/tagihan/asesmen" class="list-group-item list-group-item-action <?= $status_ases; ?>">Asesmen</a>
						  <a href="<?= BASEURL; ?>/tagihan/psikotes" class="list-group-item list-group-item-action <?= $status_psiko; ?>">Psikotes</a>
						  <a href="<?= BASEURL; ?>/tagihan/diklat" class="list-group-item list-group-item-action <?= $status_dikl; ?>">Diklat</a>
						  <a href="<?= BASEURL; ?>/tagihan/konsultan" class="list-group-item list-group-item-action <?= $status_kons; ?>">Konsultan</a>					  
						</div>
				    </div>
				  </div>
				  <a href="<?= BASEURL; ?>/datadata/data_asesmen" class="list-group-item list-group-item-action group-1 <?= $status_asesD; ?>">Data Asesmen</a>
				  <a href="<?= BASEURL; ?>/datadata/data_psikotes" class="list-group-item list-group-item-action group-1 <?= $status_psikoD; ?>">Data Psikotes</a>
				  <a href="<?= BASEURL; ?>/datadata/data_diklat" class="list-group-item list-group-item-action group-1 <?= $status_diklD; ?>">Data Diklat</a>
				  <a href="<?= BASEURL; ?>/datadata/data_konsultan" class="list-group-item list-group-item-action group-1 <?= $status_konsD; ?>">Data Konsultan</a>
				  <!-- <div class="accordion-item">
				    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
				      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
				        Nota UMLPJUM
				      </button>
				    </h2>
				    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
				      <div class="accordion-body">
				      </div>
				    </div>
				  </div>
				  <div class="accordion-item">
				    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
				      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
				        Konsultan
				      </button>
				    </h2>
				    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
				      <div class="accordion-body">
				      </div>
				    </div>
				  </div> -->
				</div>
				</div>
				<div class="fixed-bottom">
					<p class="custom-a">Web Pendataan Administrasi Proyek</p>
					<p class="custom">PT PELINDO DAYA SEJAHTERA</p>

				</div>
			</div>
			<div class="col-9 style-top">
				<nav class="navbar bg-body-tertiary">
				  <div class="container-fluid">
				    <p class="navbar-brand">Selamat Datang, <?= $data['admin']['nama']; ?></p>
				    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
				      <span class="navbar-toggler-icon"></span>
				      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
					    <?= $jumb ?>
					    <span class="visually-hidden">unread messages</span>
					  </span>
				    </button>
				    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
				      <div class="offcanvas-header">
				        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?= $data['admin']['nama']; ?></h5>
				        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				      </div>
				      <div class="offcanvas-body">
				        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
				          <li class="nav-item">
				            <a class="nav-link font-style-2" href="<?= BASEURL; ?>/dashboard/kelola">Kelola Data User</a>
				          </li>
				          <li class="nav-item">
				            <a class="nav-link font-style-2" href="<?= BASEURL; ?>/tagihan/pelunasan">Tagihan Jatuh Tempo
				            	<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cus-pill bg-danger">
								    <?= $jum ?>
							      <span class="visually-hidden">unread messages</span>
							    </span>
				            </a>
				          </li>
				          <li class="nav-item">
				            <a class="nav-link font-style-2" href="<?= BASEURL; ?>/datadata/pelaksanaan">Kegiatan Belum Terlaksana
				            	<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cus-pila bg-danger">
								    <?= $juma ?>
							      <span class="visually-hidden">unread messages</span>
							    </span>
				            </a>
				          </li>
				          <li class="nav-item">
				            <a class="nav-link font-style-2" href="<?= BASEURL; ?>/lane_page/logout">Keluar</a>
				          </li>
				        </ul>
				      </div>
				    </div>
				  </div>
				</nav>  	
			</div>
		</div>