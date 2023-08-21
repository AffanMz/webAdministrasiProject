<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Lato&family=Lilita+One&family=Montserrat:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/style.css">
	<link rel="shortcut icon" type="image/png"   href="<?= BASEURL; ?>/img/logo_pds.png">

	<title>Login | WEB PDS</title>
</head>
<body class="bg-secondary-subtle">
	<div class="container">
	  <div class="row align-items-center">
	    <div class="col text-start">
	      <p>Web Pendataan Administrasi Proyek</p>
	      <h1>PT PELINDO DAYA</h1>
	      <h1>SEJATERA</h1>
	    </div>
	    <div class="col align-items-start">
	      	<div class="card border-light card-style">
			  <div class="card-body">
			  	<?php Flasher::flashL(); ?>
				<form action="<?= BASEURL; ?>/lane_page/login" method="POST">
				  <div class="mb-3">
				    <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="username">
				  </div>
				  <div class="mb-3">
				    <input type="password" class="form-control" name="pass" placeholder="password">
				  </div>
				  <button type="submit" class="btn btn-primary">Masuk</button>
				</form>
			  </div>
			</div>
	    </div>
	  </div>
	</div>






	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
