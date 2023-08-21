<?php 

class About {
	public function index($nama = 'Maulana' , $pekerjaan = 'Dosen') {
		echo "Halo Nama saya, $nama maulana zulakarnain, saya adalah seorang $pekerjaan";
	}
	public function page() {
		echo 'About/page';
	}
}