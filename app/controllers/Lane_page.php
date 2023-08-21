<?php 

class Lane_page extends Controller {

	public function index() {
		if (isset($_SESSION['data'])) {
			$data['judul'] = 'Dashboard';
			$id = $_SESSION['data'];
			$dataU = $this->model('Login_model')->getDataById($id);
			$this->view('template/header', $data);
			$this->view('Dashboard/index', $data);
			$this->view('template/footer', $data);
		} else {
			$this->view('lane_page/index');
		}	
	}

	public function login() {
		if (!isset($_POST['username']) and !isset($_POST['pass'])) {
			header('Location: ' . BASEURL . '/lane_page/index');
		}
		$data = $this->model('Login_model')->configLog($_POST['username'], $_POST['pass']);
		if ($data == 3) {
			header('Location: ' . BASEURL . '/Dashboard/index');
		} elseif ($data == 2) {
			Flasher::setFlashL('Username', 'Password', 'Tidak Sesuai');
			header('Location: ' . BASEURL . '/lane_page/index');
		} else {
			Flasher::setFlashL('Username', '', 'Tidak Ditemukan');
			header('Location: ' . BASEURL . '/lane_page/index');
		}
	}

	public function logout() {
		unset($_SESSION['data']);
		header('Location: ' . BASEURL . '/lane_page/index');

	}
}