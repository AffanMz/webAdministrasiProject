<?php 

class Tagihan extends Controller {

	public function asesmen($barA = 0, $entri = 20) {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$id = $_SESSION['data'];
		$data['admin'] = $this->model('Login_model')->getDataById($id);
		$data['judul'] = 'asesmen';
		$data['tbl']= 'tagihan_asesmen';
		$data['tamp'] = $entri;
		$data['urut']= $barA;
		$data['status'] = 'biasa';
		$data['tagihan'] = $this->model('Tagihan_model')->getAllTagihan($data['tbl'], $barA, $data['tamp']);
		$data['limit'] = $this->model('Tagihan_model')->getAllTagihanL($data['tbl'], $data['tamp']);
		$this->view('template/header', $data);
		$this->view('Tagihan/'. $data['judul'] .'', $data);
		$this->view('template/footer', $data);
	}

	public function psikotes($barA = 0, $entri = 20) {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$id = $_SESSION['data'];
		$data['admin'] = $this->model('Login_model')->getDataById($id);
		$data['judul'] = 'psikotes';
		$data['tbl']= 'tagihan_psikotes';
		$data['tamp'] = $entri;
		$data['urut']= $barA;
		$data['status'] = 'biasa';
		$data['tagihan'] = $this->model('Tagihan_model')->getAllTagihan($data['tbl'], $barA, $data['tamp']);
		$data['limit'] = $this->model('Tagihan_model')->getAllTagihanL($data['tbl'], $data['tamp']);
		$this->view('template/header', $data);
		$this->view('Tagihan/'. $data['judul'] .'', $data);
		$this->view('template/footer', $data);
	}

	public function diklat($barA = 0, $entri = 20) {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$id = $_SESSION['data'];
		$data['admin'] = $this->model('Login_model')->getDataById($id);
		$data['judul'] = 'diklat';
		$data['tbl']= 'tagihan_diklat';
		$data['tamp'] = $entri;
		$data['urut']= $barA;
		$data['status'] = 'biasa';
		$data['tagihan'] = $this->model('Tagihan_model')->getAllTagihan($data['tbl'], $barA, $data['tamp']);
		$data['limit'] = $this->model('Tagihan_model')->getAllTagihanL($data['tbl'], $data['tamp']);
		$this->view('template/header', $data);
		$this->view('Tagihan/'. $data['judul'] .'', $data);
		$this->view('template/footer', $data);
	}

	public function konsultan($barA = 0, $entri = 20) {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$id = $_SESSION['data'];
		$data['admin'] = $this->model('Login_model')->getDataById($id);
		$data['judul'] = 'konsultan';
		$data['tbl']= 'tagihan_konsultan';
		$data['tamp'] = $entri;
		$data['urut']= $barA;
		$data['status'] = 'biasa';
		$data['tagihan'] = $this->model('Tagihan_model')->getAllTagihan($data['tbl'], $barA, $data['tamp']);
		$data['limit'] = $this->model('Tagihan_model')->getAllTagihanL($data['tbl'], $data['tamp']);
		$this->view('template/header', $data);
		$this->view('Tagihan/'. $data['judul'] .'', $data);
		$this->view('template/footer', $data);
	}

	public function pelunasan() {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$id = $_SESSION['data'];
		$data['admin'] = $this->model('Login_model')->getDataById($id);
		$data['judul'] = 'Tagihan Jatuh Tempo';
		$data['status'] = 'biasa';
		$data['control'] = 'Dashboard';
		$data['hal'] = 'index';		
		$data['urut']= 0;
		$page1 = 'tagihan_asesmen';
		$page2 = 'tagihan_diklat';
		$page3 = 'tagihan_psikotes';
		$page4 = 'tagihan_konsultan';
		$data['status'] = 'cari';
		$data['tbl'] = 'pelunasan';
		$data['tagihan1'] = $this->model('Tagihan_model')->cariDataPelunasanA($page1);
		$data['tagihan2'] = $this->model('Tagihan_model')->cariDataPelunasanA($page2);
		$data['tagihan3'] = $this->model('Tagihan_model')->cariDataPelunasanA($page3);
		$data['tagihan4'] = $this->model('Tagihan_model')->cariDataPelunasanA($page4);
		if ($data['tagihan1'] != 1 AND $data['tagihan2'] != 1 AND $data['tagihan3'] != 1 AND $data['tagihan4'] != 1) {
			$this->view('template/header', $data);
			$this->view('Tagihan/pelunasan', $data);
			$this->view('template/footer', $data);
		} else {
			$this->view('template/header', $data);
			$this->view('tagihan/halkos', $data);
			$this->view('template/footer', $data);
		}
	}

	public function tambahA() {
		var_dump($_POST);
		if ($this->model('Tagihan_model')->tambahDataTagihanA($_POST) > 0) {
			Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
			header('Location: ' . BASEURL . '/tagihan/'. $_POST['view'] .'');
		} else {
			Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
			header('Location: ' . BASEURL . '/tagihan/'. $_POST['view'] .'');
		}
	}

	public function hapusA($tab, $id) {
		if ($this->model('Tagihan_model')->hapusDataTagihanA($id, $tbl = 'tagihan_'.$tab) > 0) {
			Flasher::setFlash('Berhasil', 'Dihapus', 'success');
			header('Location: ' . BASEURL . '/tagihan/'. $tab .'');
		} else {
			Flasher::setFlash('Gagal', 'Dihapus', 'danger');
			header('Location: ' . BASEURL . '/tagihan/'. $tab .'');
		}
	}

	public function ubahA() {
		if ($this->model('Tagihan_model')->ubahDataTagihanA($_POST) > 0) {
			// var_dump($_POST); exit;
			Flasher::setFlash('Berhasil', 'Diubah', 'success');
			header('Location: ' . BASEURL . '/tagihan/'. $_POST['view'] .'');
		} else {
			Flasher::setFlash('Gagal', 'Diubah', 'danger');
			header('Location: ' . BASEURL . '/tagihan/'. $_POST['view'] .'');
		}
	}

	public function getUbahA() {
		echo json_encode($this->model('Tagihan_model')->getDataById($_POST['id'],$_POST['tab']));
	}

	public function cetakA($tab) {
		return $this->model('Tagihan_model')->CetakPdfTagihan($tab);
	}

	public function excelA($tab) {
		if ($tab == 'pelunasan') {
			$page1 = 'tagihan_asesmen';
			$page2 = 'tagihan_diklat';
			$page3 = 'tagihan_psikotes';
			$page4 = 'tagihan_konsultan';
			$data['tagihan1'] = $this->model('Tagihan_model')->cariDataPelunasanA($page1);
			$data['tagihan2'] = $this->model('Tagihan_model')->cariDataPelunasanA($page2);
			$data['tagihan3'] = $this->model('Tagihan_model')->cariDataPelunasanA($page3);
			$data['tagihan4'] = $this->model('Tagihan_model')->cariDataPelunasanA($page4);
			$data['tab'] = $tab;
			$this->view('template/export_excel_tag', $data);
		} else {
			$data['data'] = $this->model('Data_model')->excelDataDataA($tab);
			$data['tab'] = $tab;
			$this->view('template/export_excel_tag', $data);
		}
	}

	public function cetakD($tab, $id) {
		return $this->model('Tagihan_model')->cetakDataTagihanD($tab, $id);
	}

	public function cariA($tab) {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$id = $_SESSION['data'];
		$page = 'tagihan_'.$tab;
		$data['admin'] = $this->model('Login_model')->getDataById($id);
		if (in_array($page, ['tagihan_asesmen', 'tagihan_psikotes', 'tagihan_konsultan', 'tagihan_diklat'])) {
				$data['control'] = 'tagihan';			
			if ($page == 'tagihan_asesmen') {
				$data['judul'] = 'Tagihan Asesmen';
				$data['hal'] = 'asesmen';
			} elseif ($page == 'tagihan_diklat') {
				$data['judul'] = 'Tagihan Diklat';
				$data['hal'] = 'diklat';
			} elseif ($page == 'tagihan_psikotes') {
				$data['judul'] = 'Tagihan Psikotes';
				$data['hal'] = 'psikotes';
			} elseif ($page == 'tagihan_konsultan') {
				$data['judul'] = 'Tagihan Konsultan';
				$data['hal'] = 'konsultan';
			} 
		} elseif (in_array($page, ['data_asesmen', 'data_psikotes', 'data_konsultan', 'data_diklat', 'data_notad'])) {
			$data['control'] = 'datadata';
			if ($page == 'data_asesmen') {
				$data['judul'] = 'Data Asesmen';
				$data['hal'] = 'data_asesmen';
			} elseif ($page == 'data_diklat') {
				$data['judul'] = 'Data Diklat';
				$data['hal'] = 'data_diklat';
			} elseif ($page == 'data_psikotes') {
				$data['judul'] = 'Data Psikotes';
				$data['hal'] = 'data_psikotes';
			} elseif ($page == 'data_konsultan') {
				$data['judul'] = 'Data Konsultan';
				$data['hal'] = 'data_konsultan';
			} elseif ($page == 'data_notad') {
				$data['control'] = 'nota';
				$data['judul'] = 'Data Nota';
				$data['hal'] = 'data_notad';
			} 
		}
		$data['urut']= 0;
		$data['tbl']= 'tagihan_'.$tab;
		$page = 'tagihan_'.$tab;
		$data['status'] = 'cari';
		$data['tagihan'] = $this->model('Tagihan_model')->cariDataTagihanA($page);
		if ($data['tagihan'] != 1) {
			$this->view('template/header', $data);
			$this->view('Tagihan/'.$tab.'', $data);
			$this->view('template/footer', $data);
		} else {
			$this->view('template/header', $data);
			$this->view('template/halkos', $data);
			$this->view('template/footer', $data);
		}
	}

}