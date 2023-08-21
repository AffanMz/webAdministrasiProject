<?php 	

class Dashboard extends Controller {

	public function index() {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		} else {
			$data['judul'] = 'Dashboard';
			$id = $_SESSION['data'];
			$data['tbl'] = 'none';
			$data['admin'] = $this->model('Login_model')->getDataById($id);
			$data['jml_dt'] = [
				'tagihan_asesmen' => 0,
				'tagihan_diklat' => 0,
				'tagihan_psikotes' => 0,
				'tagihan_konsultan' => 0,
				'data_konsultan' => 0,
				'data_notad' => 0,
				'data_diklat' => 0,
				'data_psikotes' => 0,
				'data_asesmen' => 0
			];
			foreach ($data['jml_dt'] as $key => $value) {
				$count_data = $this->model('Data_model')->getCountDataD($key);
				$data['jml_dt'][$key] = $count_data;
			}
			$this->view('template/header', $data);
			$this->view('Dashboard/index', $data);
			$this->view('template/footer', $data);
		}
	}

	public function kelola() {
		if (!isset($_SESSION['data'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		} else {
			$id = $_SESSION['data'];
			$data['admin'] = $this->model('Login_model')->getDataById($id);
			$data['judul'] = 'Data User';
			$data['tbl']= 'data_user';
			$data['status'] = 'cari';
			$data['data'] = $this->model('Data_model')->getDataUser($data['tbl']);
			$this->view('template/header', $data);
			$this->view('Dashboard/kelola', $data);
			$this->view('template/footer', $data);
		}
	}

	public function tambahA() {
		if ($this->model('Data_model')->tambahDataUserA($_POST) > 0) {
			Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
			header('Location: ' . BASEURL . '/dashboard/'. $_POST['view'] .'');
		} else {
			Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
			header('Location: ' . BASEURL . '/dashboard/'. $_POST['view'] .'');
		}
	}

	public function hapusA($tab, $view,$id) {
		if ($this->model('Data_model')->hapusDataUserA($id, $tab) > 0) {
			Flasher::setFlash('Berhasil', 'Dihapus', 'success');
			header('Location: ' . BASEURL . '/dashboard/'. $view .'');
		} else {
			Flasher::setFlash('Gagal', 'Dihapus', 'danger');
			header('Location: ' . BASEURL . '/dashboard/'. $view .'');
		}
	}

	public function ubahA() {
		if ($this->model('Data_model')->ubahDataUserA($_POST) > 0) {
			Flasher::setFlash('Berhasil', 'Diubah', 'success');
			header('Location: ' . BASEURL . '/dashboard/'. $_POST['view'] .'');
		} else {
			Flasher::setFlash('Gagal', 'Diubah', 'danger');
			header('Location: ' . BASEURL . '/dashboard/'. $_POST['view'] .'');
		}
	}

	public function getUbahA() {
		echo json_encode($this->model('Data_model')->getDataByIdUser($_POST['id'],$_POST['tab']));
	}
}