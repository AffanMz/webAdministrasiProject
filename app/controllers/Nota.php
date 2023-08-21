<?php 

class Nota extends Controller {

	public function data_notad($barA = 0, $entri = 20) {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$id = $_SESSION['data'];
		$data['admin'] = $this->model('Login_model')->getDataById($id);
		$data['judul'] = 'Data Nota';
		$data['tbl']= 'data_notad';
		$data['tamp'] = $entri;
		$data['urut']= $barA;
		$data['status'] = 'biasa';
		$data['data'] = $this->model('Data_model')->getAllData($data['tbl'], $barA, $data['tamp']);
		$data['limit'] = $this->model('Data_model')->getAllDataL($data['tbl'], $data['tamp']);
		$this->view('template/header', $data);
		$this->view('nota/data_notad', $data);
		$this->view('template/footer', $data);
	}

	public function tambahA() {
		if ($this->model('Data_model')->tambahDataDataA($_POST) > 0) {
			Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
			header('Location: ' . BASEURL . '/nota/'. $_POST['view'] .'');
		} else {
			Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
			header('Location: ' . BASEURL . '/nota/'. $_POST['view'] .'');
		}
	}

	public function hapusA($tab, $id) {
		if ($this->model('Data_model')->hapusDataDataA($id, $tab) > 0) {
			Flasher::setFlash('Berhasil', 'Dihapus', 'success');
			header('Location: ' . BASEURL . '/nota/'. $tab .'');
		} else {
			Flasher::setFlash('Gagal', 'Dihapus', 'danger');
			header('Location: ' . BASEURL . '/nota/'. $tab .'');
		}
	}

	public function ubahA() {
		if ($this->model('Data_model')->ubahDataDataA($_POST) > 0) {
			Flasher::setFlash('Berhasil', 'Diubah', 'success');
			header('Location: ' . BASEURL . '/nota/'. $_POST['view'] .'');
		} else {
			Flasher::setFlash('Gagal', 'Diubah', 'danger');
			header('Location: ' . BASEURL . '/nota/'. $_POST['view'] .'');
		}
	}

	public function getUbahA() {
		echo json_encode($this->model('Data_model')->getDataById($_POST['id'],$_POST['tab']));
	}

	public function cetakA($tab) {
		return $this->model('Data_model')->cetakDataDataA($tab);
	}

	public function cetakD($tab, $id) {
		return $this->model('Data_model')->cetakDataDataD($tab, $id);
	}

	public function cariA($tab) {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$id = $_SESSION['data'];
		$data['admin'] = $this->model('Login_model')->getDataById($id);
		if (in_array($tab, ['tagihan_asesmen', 'tagihan_psikotes', 'tagihan_konsultan', 'tagihan_diklat'])) {
				$data['control'] = 'tagihan';			
			if ($tab == 'tagihan_asesmen') {
				$data['judul'] = 'Tagihan Asesmen';
				$data['hal'] = 'asesmen';
			} elseif ($tab == 'tagihan_diklat') {
				$data['judul'] = 'Tagihan Diklat';
				$data['hal'] = 'diklat';
			} elseif ($tab == 'tagihan_psikotes') {
				$data['judul'] = 'Tagihan Psikotes';
				$data['hal'] = 'psikotes';
			} elseif ($tab == 'tagihan_konsultan') {
				$data['judul'] = 'Tagihan Konsultan';
				$data['hal'] = 'konsultan';
			} 
		} elseif (in_array($tab, ['data_asesmen', 'data_psikotes', 'data_konsultan', 'data_diklat', 'data_notad'])) {
			$data['control'] = 'datadata';
			if ($tab == 'data_asesmen') {
				$data['judul'] = 'Data Asesmen';
				$data['hal'] = 'data_asesmen';
			} elseif ($tab == 'data_diklat') {
				$data['judul'] = 'Data Diklat';
				$data['hal'] = 'data_diklat';
			} elseif ($tab == 'data_psikotes') {
				$data['judul'] = 'Data Psikotes';
				$data['hal'] = 'data_psikotes';
			} elseif ($tab == 'data_konsultan') {
				$data['judul'] = 'Data Konsultan';
				$data['hal'] = 'data_konsultan';
			} elseif ($tab == 'data_notad') {
				$data['control'] = 'nota';
				$data['judul'] = 'Data Nota';
				$data['hal'] = 'data_notad';
			} 
		}
		$data['urut']= 0;
		$page = $tab;
		$data['tbl']= $tab;
		$data['status'] = 'cari';
		$data['data'] = $this->model('Data_model')->cariDataDataA($page);
		if ($data['data'] != 1) {
			$this->view('template/header', $data);
			$this->view('nota/'.$tab.'', $data);
			$this->view('template/footer', $data);
		} else {
			$this->view('template/header', $data);
			$this->view('template/halkos', $data);
			$this->view('template/footer', $data);
		}
		
	}
}