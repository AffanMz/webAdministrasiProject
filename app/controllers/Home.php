<?php 

class Home extends Controller {

	public function index($nama = 'sandika', $umur = '32', $pekerjaan = 'Dosen')
	{
		$data['nama'] = $nama;
		$data['pekerjaan'] = $pekerjaan;
		$data['umur'] = $umur;
		$this->view('home/index', $data);
	}
}