<?php 

class Data_model {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function getAllData($tbl, $barA = 0, $bat = 10) {

		$this->db->query('SELECT * FROM '. $tbl .' ORDER BY id_data DESC LIMIT '. $barA.', '. $bat.'');
		return $this->db->resultSet();

	}

	public function getCountDataD($tbl) {
		$this->db->query('SELECT * FROM '. $tbl);
		return count($this->db->resultSet());
	}

	public function getDataUser($tbl) {
		$this->db->query('SELECT * FROM '. $tbl);
		return $this->db->resultSet();
	}

	public function getAllDataL($tbl, $bat = 0) {

		$this->db->query('SELECT * FROM '. $tbl);
		return $data = ceil(count($this->db->resultSet()) / $bat);
	}

	public function CetakPdfData($tbl) {
		#ambil data dari DB dan masukkan ke array
		if ($tbl == 'pelaksanaan') {
			$tab = [ 'data_diklat', 'data_konsultan'];
			for ($i=0; $i < count($tab); $i++) { 
				$this->db->query("SELECT * FROM ". $tab[$i]." WHERE status = 'BELUM'");
				if ($i == 0) {
					$data0 = $this->db->resultSet();
				} elseif ($i == 1) {
					$data1 = $this->db->resultSet();
				} 
			}
			$data2 = array();
			$data3 = array();

			//pilihan
			$options = array(
				'filename' => $tbl, //nama file penyimpanan, kosongkan jika output ke browser
				'destinationfile' => 'I', //I=inline browser (default), F=local file, D=download
				'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
				'orientation'=>'L' //orientation: P=portrait, L=landscape
			);
			 
			$tabel = new FPDF_AutoWrapTable($data0, $data1, $data2, $data3, $options, $tbl);
			$tabel->printPDF();	

		} else {
			$data = array();
			$this->db->query('SELECT * FROM '. $tbl);
			$data = $this->db->resultSet();
			 
			//pilihan
			$options = array(
				'filename' => $tbl, //nama file penyimpanan, kosongkan jika output ke browser
				'destinationfile' => 'I', //I=inline browser (default), F=local file, D=download
				'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
				'orientation'=>'L' //orientation: P=portrait, L=landscape
			);
			$data1 = array();
			$data2 = array();
			$data3 = array();
			 
			$tabel = new FPDF_AutoWrapTable($data, $data1, $data2, $data3, $options, $tbl);
			$tabel->printPDF();
		}
		
	}

	public function getDataById($id, $tbl) {

		$this->db->query('SELECT * FROM '. $tbl .' WHERE id_data = :id');
		$this->db->bind('id',$id);
		return $this->db->single();

	}

	public function getDataByIdUser($id, $tbl) {

		$this->db->query('SELECT * FROM '. $tbl .' WHERE id_admin = :id');
		$this->db->bind('id',$id);
		return $this->db->single();

	}

	public function cariDataDataA($tab) {

		if (isset($_POST['surat'])) {
			if ($tab == 'data_notad') {
				$cari = $_POST['surat'];
				$this->db->query('SELECT * FROM '. $tab . ' WHERE no_ndum LIKE :data OR uraian LIKE :data');
				$this->db->bind('data', "%$cari%" );
				$banyak = $this->db->resultSet();
				if (count($banyak) != 0) {
					return $this->db->resultSet();
				}
			} elseif (in_array($tab, ['data_konsultan', 'data_diklat'])) {
				$cari = $_POST['surat'];
				$this->db->query('SELECT * FROM '. $tab . ' WHERE surat LIKE :data OR uraian LIKE :data');
				$this->db->bind('data', "%$cari%" );
				$banyak = $this->db->resultSet();
				if (count($banyak) != 0) {
					return $this->db->resultSet();
				}
			} else {
				$cari = $_POST['surat'];
				$this->db->query('SELECT * FROM '. $tab . ' WHERE surat LIKE :data OR asesi LIKE :data');
				$this->db->bind('data', "%$cari%" );
				$banyak = $this->db->resultSet();
				if (count($banyak) != 0) {
					return $this->db->resultSet();
				}
			} 
		}
		return 1;
	}

	public function cariDataPelaksanaanA($tab) {

			$cari = 'BELUM';
			$this->db->query('SELECT * FROM '. $tab . ' WHERE status LIKE :data');
			$this->db->bind('data', "%$cari%" );
			$banyak = $this->db->resultSet();
			if (count($banyak) != 0) {
				return $this->db->resultSet();
			}
	}

	public function tambahDataDataA($data) {
		$tab = $data['tab'];
		if (in_array($tab, ['data_diklat', 'data_konsultan'])) {
			$query = "INSERT INTO " . $data['tab'] . " 
						VALUES 
						('', :surat, :tgl_dok, :tgl_pel, :PIC, :vendor, :ks, :uraian, :jml_vol, :jumlah_satuan, :jml_biayat, :jml_sb, :jml_ttl_pjk, :jml_ttl, :status, :tag)";
			$this->db->query($query);

			$this->db->bind('surat', $data['surat']);
			$this->db->bind('tgl_dok', $data['tgl_dok']);
			$this->db->bind('tgl_pel', $data['tgl_pel']);
			$this->db->bind('PIC', $data['PIC']);
			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('ks', $data['ks']);
			$this->db->bind('uraian', $data['urai']);
			$this->db->bind('tag', $data['tag']);
			$this->db->bind('jml_vol', $data['volume']);
			$this->db->bind('jumlah_satuan', $data['satuan']);
			$this->db->bind('jml_biayat', $data['jumlah_biayat']);
			$this->db->bind('jml_sb', $data['jml_sb']);
			$this->db->bind('jml_ttl_pjk', $data['jml_ttl_pjk']);
			$this->db->bind('jml_ttl', $data['jml_ttl']);
			$this->db->bind('status', $data['status']);


			$this->db->execute();

			return $this->db->kolCount();

		} elseif ($data['tab'] == 'data_psikotes') {
			$query = "INSERT INTO " . $data['tab'] . " 
						VALUES 
						('', :vendor, :surat, :tgl_dok, :PIC, :asesi, :tgl_pel, :tester, :asesor, :transp_pulsa)";

			$this->db->query($query);

			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('surat', $data['surat']);
			$this->db->bind('tgl_dok', $data['tgl_dok']);
			$this->db->bind('tgl_pel', $data['tgl_pel']);
			$this->db->bind('PIC', $data['PIC']);
			$this->db->bind('asesi', $data['asesi']);		
			$this->db->bind('tester', $data['tester']);		
			$this->db->bind('asesor', $data['asesor']);		
			$this->db->bind('transp_pulsa', $data['transp_pulsa']);

			$this->db->execute();
			return $this->db->kolCount();	


		} elseif ($data['tab'] == 'data_asesmen') {
			$query = "INSERT INTO " . $data['tab'] . " 
						VALUES 
						('', :vendor, :surat, :tgl_dok, :PIC, :asesi, :tgl_pel, :asesor_ass, :asesor_bid, :asesor_feed, :rp, :transp_pulsa)";

			$this->db->query($query);

			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('surat', $data['surat']);
			$this->db->bind('tgl_dok', $data['tgl_dok']);
			$this->db->bind('tgl_pel', $data['tgl_pel']);
			$this->db->bind('PIC', $data['PIC']);
			$this->db->bind('asesi', $data['asesi']);		
			$this->db->bind('asesor_ass', $data['asesor_ass']);
			$this->db->bind('asesor_bid', $data['asesor_bid']);
			$this->db->bind('asesor_feed', $data['asesor_feed']);		
			$this->db->bind('rp', $data['rp']);		
			$this->db->bind('transp_pulsa', $data['transp_pulsa']);

			$this->db->execute();
			return $this->db->kolCount();

		} elseif ($data['tab'] == 'data_notad') {
			$query = "INSERT INTO " . $data['tab'] . " 
						VALUES 
						('', :no_ndum, :tgl_ajuan, :uraian, :tgl_pel, :nominal, :nilai_lpj, :profit, :status, :no_jjk, :no_lpjum, :tgl_lpj, :PIC, :bukti_trans)";

			$this->db->query($query);

			$this->db->bind('no_ndum', $data['no_ndum']);
			$this->db->bind('tgl_ajuan', $data['tgl_ajuan']);
			$this->db->bind('uraian', $data['uraian']);
			$this->db->bind('tgl_pel', $data['tgl_pel']);
			$this->db->bind('nominal', $data['nominal']);
			$this->db->bind('nilai_lpj', $data['nilai_lpj']);		
			$this->db->bind('profit', $data['profit']);
			$this->db->bind('status', $data['status']);
			$this->db->bind('no_jjk', $data['no_jjk']);		
			$this->db->bind('no_lpjum', $data['no_lpjum']);		
			$this->db->bind('tgl_lpj', $data['tgl_lpj']);
			$this->db->bind('PIC', $data['PIC']);
			$this->db->bind('bukti_trans', $data['bukti_trans']);


			$this->db->execute();
			return $this->db->kolCount();
		}
	}

	public function tambahDataUserA($data) {
		$tab = $data['tab'];
		if ($tab == 'data_user') {
			$query = "INSERT INTO " . $data['tab'] . " 
						VALUES 
						('', :nama, :username, :pass)";
			$this->db->query($query);

			$this->db->bind('nama', $data['nama']);
			$this->db->bind('username', $data['username']);
			$this->db->bind('pass', $data['pass']);


			$this->db->execute();

			return $this->db->kolCount();

		} 
	}

	public function ubahDataUserA($data) {
		$tab = $data['tab'];
		if ($tab == 'data_user') {
			$query = "UPDATE ". $data['tab'] ." SET
						 nama = :nama,
						 username = :username,
						 pass = :pass
						 WHERE id_admin = :id";

			$this->db->query($query);

			$this->db->bind('nama', $data['nama']);
			$this->db->bind('username', $data['username']);
			$this->db->bind('pass', $data['pass']);
			$this->db->bind('id', $data['id']);


			$this->db->execute();

			return $this->db->kolCount();

		} 
	}

	public function hapusDataUserA($data, $tb) {
		$query = 'DELETE FROM '. $tb .' WHERE id_admin = :id';
		$this->db->query($query);
		$this->db->bind('id',$data);

		$this->db->execute();

		return $this->db->kolCount();
	}

	public function hapusDataDataA($data, $tb) {
		$query = 'DELETE FROM '. $tb .' WHERE id_data = :id';
		$this->db->query($query);
		$this->db->bind('id',$data);

		$this->db->execute();

		return $this->db->kolCount();
	}

	public function ubahDataDataA($data) {
		if (in_array($data['tab'] , ['data_diklat', 'data_konsultan'])) {
			$query = "UPDATE ". $data['tab'] ." SET
						 surat = :surat,
						 tgl_dok = :tgl_dok,
						 tgl_pel = :tgl_pel,
						 PIC = :PIC,
						 perusahaan = :vendor,
						 vendor_ks = :ks,
						 uraian = :uraian,
						 jml_peserta = :jml_vol,
						 satuan = :jumlah_satuan,
						 biaya_tambah = :jml_biayat,
						 ttl_blm_pjk = :jml_sb,
						 pjk = :jml_ttl_pjk,
						 total = :jml_ttl,
						 status = :status,
						 no_tag = :tag
						 WHERE id_data = :id";

			$this->db->query($query);

			$this->db->bind('surat', $data['surat']);
			$this->db->bind('tgl_dok', $data['tgl_dok']);
			$this->db->bind('tgl_pel', $data['tgl_pel']);
			$this->db->bind('PIC', $data['PIC']);
			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('ks', $data['ks']);
			$this->db->bind('uraian', $data['urai']);
			$this->db->bind('tag', $data['tag']);
			$this->db->bind('jml_vol', $data['volume']);
			$this->db->bind('jumlah_satuan', $data['satuan']);
			$this->db->bind('jml_biayat', $data['jumlah_biayat']);
			$this->db->bind('jml_sb', $data['jml_sb']);
			$this->db->bind('jml_ttl_pjk', $data['jml_ttl_pjk']);
			$this->db->bind('jml_ttl', $data['jml_ttl']);
			$this->db->bind('status', $data['status']);
			$this->db->bind('id', $data['id']);

			$this->db->execute();

			return $this->db->kolCount();

		} elseif ($data['tab'] == 'data_psikotes') {
			$query = "UPDATE ". $data['tab'] ." SET
						 perusahaan = :vendor,
						 surat = :surat,
						 tgl_dok = :tgl_dok,
						 PIC = :PIC,
						 asesi = :asesi,
						 tgl_pel = :tgl_pel,
						 tester = :tester,
						 asesor = :asesor,
						 transp_pulsa = :transp_pulsa
						 WHERE id_data = :id";

			$this->db->query($query);

			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('surat', $data['surat']);
			$this->db->bind('tgl_dok', $data['tgl_dok']);
			$this->db->bind('tgl_pel', $data['tgl_pel']);
			$this->db->bind('PIC', $data['PIC']);
			$this->db->bind('asesi', $data['asesi']);		
			$this->db->bind('tester', $data['tester']);		
			$this->db->bind('asesor', $data['asesor']);		
			$this->db->bind('transp_pulsa', $data['transp_pulsa']);
			$this->db->bind('id', $data['id']);

			$this->db->execute();

			return $this->db->kolCount();

		} elseif ($data['tab'] == 'data_asesmen') {
			$query = "UPDATE ". $data['tab'] ." SET
						 perusahaan = :vendor,
						 surat = :surat,
						 tgl_dok = :tgl_dok,
						 PIC = :PIC,
						 asesi = :asesi,
						 tgl_pel = :tgl_pel,
						 asesor_ass = :asesor_ass,
						 asesor_bid = :asesor_bid,
						 asesor_feed = :asesor_feed,
						 rp = :rp,
						 transp_pulsa = :transp_pulsa
						 WHERE id_data = :id";

			$this->db->query($query);

			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('surat', $data['surat']);
			$this->db->bind('tgl_dok', $data['tgl_dok']);
			$this->db->bind('tgl_pel', $data['tgl_pel']);
			$this->db->bind('PIC', $data['PIC']);
			$this->db->bind('asesi', $data['asesi']);
			$this->db->bind('asesor_ass', $data['asesor_ass']);
			$this->db->bind('asesor_bid', $data['asesor_bid']);
			$this->db->bind('asesor_feed', $data['asesor_feed']);		
			$this->db->bind('rp', $data['rp']);		
			$this->db->bind('transp_pulsa', $data['transp_pulsa']);
			$this->db->bind('id', $data['id']);

			$this->db->execute();

			return $this->db->kolCount();


		} elseif ($data['tab'] == 'data_notad') {
			$query = "UPDATE ". $data['tab'] ." SET
						 no_ndum = :no_ndum,
						 tgl_ajuan = :tgl_ajuan,
						 uraian = :uraian,
						 tgl_pel = :tgl_pel,
						 nominal = :nominal,
						 nilai_lpj = :nilai_lpj,
						 profit = :profit,
						 status = :status,
						 no_jjk = :no_jjk,
						 no_lpjum = :no_lpjum,
						 tgl_lpj = :tgl_lpj,
						 PIC = :PIC,
						 bukti_trans = :bukti_trans
						 WHERE id_data = :id";

			$this->db->query($query);

			$this->db->bind('no_ndum', $data['no_ndum']);
			$this->db->bind('tgl_ajuan', $data['tgl_ajuan']);
			$this->db->bind('uraian', $data['uraian']);
			$this->db->bind('tgl_pel', $data['tgl_pel']);
			$this->db->bind('nominal', $data['nominal']);
			$this->db->bind('nilai_lpj', $data['nilai_lpj']);		
			$this->db->bind('profit', $data['profit']);
			$this->db->bind('status', $data['status']);
			$this->db->bind('no_jjk', $data['no_jjk']);		
			$this->db->bind('no_lpjum', $data['no_lpjum']);		
			$this->db->bind('tgl_lpj', $data['tgl_lpj']);
			$this->db->bind('PIC', $data['PIC']);
			$this->db->bind('bukti_trans', $data['bukti_trans']);
			$this->db->bind('id', $data['id']);

			$this->db->execute();

			return $this->db->kolCount();
		}

	}

	public function cetakDataDataA($tbl) {

		if (in_array($tbl , ['data_diklat', 'data_konsultan'])) {
			function rupiah($angka){		
			$hasil_rupiah = number_format($angka,0,',','.');
			return $hasil_rupiah;
			}
		 
			// intance object dan memberikan pengaturan halaman PDF
			$pdf=new FPDF('L','mm','A4');
			$pdf->AddPage();
			 
			$pdf->SetFont('Times','B',13);
			$pdf->Cell(290,10,'DATA',0,0,'C');
			 
			$pdf->Cell(10,15,'',0,1);
			$pdf->SetFont('Times','B',9);
			$pdf->Cell(10,7,'NO',1,0,'C');
			$pdf->Cell(60,7,'Surat',1,0,'C');
			$pdf->Cell(30,7,'Pengajuan',1,0,'C');
			$pdf->Cell(30,7,'Pelaksanaan' ,1,0,'C');
			$pdf->Cell(25,7,'PIC' ,1,0,'C');
			$pdf->Cell(25,7,'User' ,1,0,'C');
			$pdf->Cell(25,7,'Kerjasama' ,1,0,'C');
			$pdf->Cell(30,7,'Uraian' ,1,0,'C');
			$pdf->Cell(15,7,'Peserta',1,0,'C');
			$pdf->Cell(30,7,'Satuan',1,0,'C');
			$pdf->Cell(30,7,'Biaya Tambahan' ,1,0,'C');
			$pdf->Cell(30,7,'Total (non pajak)',1,0,'C');
			$pdf->Cell(30,7,'Pajak',1,0,'C');
			$pdf->Cell(30,7,'Total (pajak)',1,0,'C');
			$pdf->Cell(30,7,'Status' ,1,0,'C');
			$pdf->Cell(30,7,'Nomer Tagihan',1,0,'C');

			 
			 
			$pdf->Cell(10,7,'',0,1);
			$pdf->SetFont('Times','',10);
			$no=1;
			$this->db->query('SELECT * FROM '. $tbl);
			$data = $this->db->resultSet();
			foreach ($data as $tag) {
			  $pdf->Cell(10,6, $no++,1,0,'C');
			  $pdf->Cell(60,6, $tag['surat'],1,0,'C');
			  $pdf->Cell(30,6, $tag['tgl_dok'],1,0,'C');
			  $pdf->Cell(30,6, $tag['tgl_pel'],1,0,'C');
			  $pdf->Cell(25,6, $tag['PIC'],1,0,'C');
			  $pdf->Cell(25,6, $tag['perusahaan'],1,0,'C');
			  $pdf->Cell(25,6, $tag['vendor_ks'],1,0,'C');
			  $pdf->Cell(30,6, $tag['uraian'],1,0,'C');
			  $pdf->Cell(15,6, $tag['jml_peserta'],1,0,'C');
			  $pdf->Cell(30,6, rupiah($tag['satuan']),1,0,'C');
			  $pdf->Cell(30,6, rupiah($tag['biaya_tambah']),1,0,'C');
			  $pdf->Cell(30,6, rupiah($tag['ttl_blm_pjk']),1,0,'C');
			  $pdf->Cell(30,6, rupiah($tag['pjk']),1,0,'C');
			  $pdf->Cell(30,6, rupiah($tag['total']),1,0,'C');
			  $pdf->Cell(30,6, $tag['status'],1,0,'C');
			  $pdf->Cell(30,6, $tag['no_tag'],1,1,'C');
			}


			$dest = '';
			$name = $tbl;
			 
			return $pdf->Output($dest , $name );
		}
	}

	public function excelDataDataA($tbl) {
		$this->db->query('SELECT * FROM '. $tbl);
		return $this->db->resultSet();
	}

	public function cetakDataDataD($tbl , $id) {

		function rupiah($angka){		
			$hasil_rupiah = number_format($angka,0,',','.');
			return $hasil_rupiah;
			}

		$this->db->query('SELECT * FROM '. $tbl .' WHERE id_data = :id');
		$this->db->bind('id',$id);
		$data = $this->db->single();

		if (in_array($tbl, ['data_diklat', 'data_konsultan'])) {
		 
			// intance object dan memberikan pengaturan halaman PDF
			$pdf=new FPDF('P','mm','A4');
			$pdf->AddPage();
			 
			$pdf->SetFont('Times','B',13);
			$pdf->Cell(210,10,'Data',0,0,'C');
			 
			$pdf->Cell(10,15,'',0,1);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,7,'Nomer Surat',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['surat'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Dokumen' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_dok'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Pelaksanaan' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_pel'].'',0,1,'L');
			$pdf->Cell(40,7,'PIC' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['PIC'].'',0,1,'L');
			$pdf->Cell(40,7,'User' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['perusahaan'].'',0,1,'L');
			$pdf->Cell(40,7,'Vendor Kerjasama' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['vendor_ks'].'',0,1,'L');		
			$pdf->Cell(40,7,'Uraian' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['uraian'].'',0,1,'L');
			$pdf->Cell(40,7,'Jumlah Peserta' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['jml_peserta'].'',0,1,'L');
			$pdf->Cell(40,7,'Satuan' ,0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['satuan']).',00',0,1,'L');
			$pdf->Cell(40,7,'Biaya Tambahan' ,0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['biaya_tambah']).',00',0,1,'L');
			$pdf->Cell(40,7,'Total (non pajak)',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['ttl_blm_pjk']).',00',0,1,'L');
			$pdf->Cell(40,7,'Pajak',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['pjk']).',00',0,1,'L');
			$pdf->Cell(40,7,'Total (pajak)',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['total']).',00',0,1,'L');
			$pdf->Cell(40,7,'Status' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['status'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer Tagihan',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['no_tag'].'',0,1,'L');
			
			$dest = '';
			$name = $data['perusahaan'].'_'.$data['surat']; 
			return $pdf->Output($dest , $name );
		
		} elseif ($tbl == 'data_asesmen') {
		 
			// intance object dan memberikan pengaturan halaman PDF
			$pdf=new FPDF('P','mm','A4');
			$pdf->AddPage();
			 
			$pdf->SetFont('Times','B',13);
			$pdf->Cell(210,10,'Data',0,0,'C');
			 
			$pdf->Cell(10,15,'',0,1);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,7,'User' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['perusahaan'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer Surat',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['surat'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Dokumen' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_dok'].'',0,1,'L');
			$pdf->Cell(40,7,'PIC' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['PIC'].'',0,1,'L');			
			$pdf->Cell(40,7,'Asesi' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['asesi'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Pelaksanaan' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_pel'].'',0,1,'L');
			$pdf->Cell(40,7,'Asesor Asesmen' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['asesor_ass'].'',0,1,'L');
			$pdf->Cell(40,7,'Asesor Bidang' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['asesor_bid'].'',0,1,'L');
			$pdf->Cell(40,7,'Asesor Feedback' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['asesor_feed'].'',0,1,'L');		
			$pdf->Cell(40,7,'Role Player' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['rp'].'',0,1,'L');
			$pdf->Cell(40,7,'Tranport/Pulsa',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['transp_pulsa'].'',0,1,'L');
			
			$dest = '';
			$name = $data['perusahaan'].'_'.$data['surat']; 
			return $pdf->Output($dest , $name );

		} elseif ($tbl == 'data_psikotes') {
		 
			// intance object dan memberikan pengaturan halaman PDF
			$pdf=new FPDF('P','mm','A4');
			$pdf->AddPage();
			 
			$pdf->SetFont('Times','B',13);
			$pdf->Cell(210,10,'Data',0,0,'C');
			 
			$pdf->Cell(10,15,'',0,1);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,7,'User' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['perusahaan'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer Surat',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['surat'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Dokumen' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_dok'].'',0,1,'L');
			$pdf->Cell(40,7,'PIC' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['PIC'].'',0,1,'L');			
			$pdf->Cell(40,7,'Asesi' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['asesi'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Pelaksanaan' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_pel'].'',0,1,'L');
			$pdf->Cell(40,7,'Tester' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tester'].'',0,1,'L');			
			$pdf->Cell(40,7,'Asesor' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['asesor'].'',0,1,'L');
			$pdf->Cell(40,7,'Tranport/Pulsa',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['transp_pulsa'].'',0,1,'L');
			
			$dest = '';
			$name = $data['perusahaan'].'_'.$data['surat']; 
			return $pdf->Output($dest , $name );

		} elseif ($tbl == 'data_notad') {
		 
			// intance object dan memberikan pengaturan halaman PDF
			$pdf=new FPDF('P','mm','A4');
			$pdf->AddPage();
			 
			$pdf->SetFont('Times','B',13);
			$pdf->Cell(210,10,'Data',0,0,'C');
			 
			$pdf->Cell(10,15,'',0,1);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,7,'Nomer ND UM',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['no_ndum'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Pengajuan' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_ajuan'].'',0,1,'L');
			$pdf->Cell(40,7,'Uraian' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['uraian'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Pelaksanaan' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_pel'].'',0,1,'L');
			$pdf->Cell(40,7,'Nominal',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['nominal']).',00',0,1,'L');
			$pdf->Cell(40,7,'Nilai LPJ',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['nilai_lpj']).',00',0,1,'L');
			$pdf->Cell(40,7,'Profit',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['profit']).',00',0,1,'L');
			$pdf->Cell(40,7,'Status' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['status'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer JJK' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['no_jjk'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer LPJUM' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['no_lpjum'].'',0,1,'L');
			$pdf->Cell(40,7,'Tanggal LPJ' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_lpj'].'',0,1,'L');
			$pdf->Cell(40,7,'PIC' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['PIC'].'',0,1,'L');
			$pdf->Cell(40,7,'Bukti Transfer' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['bukti_trans'].'',0,1,'L');
			
			$dest = '';
			$name = $data['no_jjk'].'_'.$data['no_ndum']; 
			return $pdf->Output($dest , $name );
		}
	}

}