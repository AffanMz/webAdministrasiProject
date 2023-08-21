<?php 

class Flasher {

	public static function setFlash($pesan , $aksi, $type) {
		$_SESSION['flash'] = [
			'pesan' => $pesan,
			'aksi' => $aksi,
			'type' => $type
		];
	}

	public static function setFlashL($pesan , $aksi, $type) {
		$_SESSION['flashL'] = [
			'pesan' => $pesan,
			'aksi' => $aksi,
			'type' => $type
		];
	}

	public static function flash () {
		if (isset($_SESSION['flash'])) {
			echo '<div class="alert alert-'. $_SESSION['flash']['type'] .' alert-dismissible fade show" role="alert">
					  <strong>Data '. $_SESSION['flash']['pesan'] .'</strong> '. $_SESSION['flash']['aksi'] .'
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';	
			unset($_SESSION['flash']);
		}
	}

	public static function flashL () {
		if (isset($_SESSION['flashL'])) {
			echo '<div class="alert alert-danger" role="alert">
					  Login Gagal!! '. $_SESSION['flashL']['pesan'] .' & Password '. $_SESSION['flashL']['type'] .'
					</div>';	
			unset($_SESSION['flashL']);
		}
	}
}