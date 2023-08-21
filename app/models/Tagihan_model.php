<?php 

class Tagihan_model {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function getAllTagihan($tbl, $barA = 0, $bat = 10) {

		$this->db->query('SELECT * FROM '. $tbl .' ORDER BY id_tagihan DESC LIMIT '. $barA.', '. $bat.'');
		return $this->db->resultSet();

	}

	public function CetakPdfTagihan($tbl) {
		#ambil data dari DB dan masukkan ke array
		if ($tbl == 'pelunasan') {
			$tab = ['tagihan_asesmen', 'tagihan_psikotes', 'tagihan_konsultan', 'tagihan_diklat'];
			for ($i=0; $i < count($tab); $i++) { 
				$this->db->query("SELECT * FROM ". $tab[$i]." WHERE status = 'BELUM'");
				if ($i == 0) {
					$data0 = $this->db->resultSet();
				} elseif ($i == 1) {
					$data1 = $this->db->resultSet();
				} elseif ($i == 2) {
					$data2 = $this->db->resultSet();
				} elseif ($i == 3) {
					$data3 = $this->db->resultSet();
				}
			}

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

	public function getAllTagihanL($tbl, $bat = 0) {

		$this->db->query('SELECT * FROM '. $tbl);
		return $data = ceil(count($this->db->resultSet()) / $bat);
	}

	public function getDataById($id, $tbl) {

		$this->db->query('SELECT * FROM '. $tbl .' WHERE id_tagihan = :id');
		$this->db->bind('id',$id);
		return $this->db->single();

	}

	public function cariDataTagihanA($tab) {

		if (isset($_POST['surat'])) {
			if (in_array($tab, ['tagihan_asesmen', 'tagihan_psikotes'])) {
				$cari = $_POST['surat'];
				$this->db->query('SELECT * FROM '. $tab . ' WHERE surat LIKE :data');
				$this->db->bind('data', "%$cari%" );
				$banyak = $this->db->resultSet();
				if (count($banyak) != 0) {
					return $this->db->resultSet();
				}
			} else {
				$cari = $_POST['surat'];
				$this->db->query('SELECT * FROM '. $tab . ' WHERE surat LIKE :data OR uraian LIKE :data');
				$this->db->bind('data', "%$cari%" );
				$banyak = $this->db->resultSet();
				if (count($banyak) != 0) {
					return $this->db->resultSet();
				}
			}
		}
		return 1;
	}

	public function cariDataPelunasanA($tab) {

			$cari = 'BELUM';
			$this->db->query('SELECT * FROM '. $tab . ' WHERE status LIKE :data');
			$this->db->bind('data', "%$cari%" );
			$banyak = $this->db->resultSet();
			if (count($banyak) != 0) {
				return $this->db->resultSet();
			}
	}

	public function tambahDataTagihanA($data) {
		$tab = $data['tab'];
		if (in_array($tab, ['tagihan_asesmen', 'tagihan_psikotes'])) {
			$query = "INSERT INTO " . $data['tab'] . " 
						VALUES 
						('', :vendor, :surat, :volume, :satuan, :jml_bs, :jml_ppn, :jml_ttl_ppn, :jml_pph, :jml_ttl, :tgl_lunas, :status,  :ku)";
			$this->db->query($query);

			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('surat', $data['surat']);
			$this->db->bind('volume', $data['volume']);
			$this->db->bind('satuan', $data['satuan']);
			$this->db->bind('jml_bs', $data['jml_sb']);
			$this->db->bind('jml_ppn', $data['jml_ppn']);
			$this->db->bind('jml_ttl_ppn', $data['jml_ttl_ppn']);
			$this->db->bind('jml_pph', $data['jml_pph']);
			$this->db->bind('jml_ttl', $data['jml_ttl']);
			$this->db->bind('tgl_lunas', $data['tgl_lunas']);
			$this->db->bind('status', $data['status_lunas']);
			$this->db->bind('ku', $data['ku']);

			$this->db->execute();

			return $this->db->kolCount();

		} elseif (in_array($tab, ['tagihan_diklat', 'tagihan_konsultan'])) {
			$query = "INSERT INTO " . $data['tab'] . " 
						VALUES 
						('', :vendor, :uraian, :surat, :volume, :satuan, :jml_bs, :jml_ppn, :jml_ttl_ppn, :jml_pph, :jml_ttl, :tgl_lunas, :status, :ku)";
			$this->db->query($query);

			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('uraian', $data['urai']);
			$this->db->bind('surat', $data['surat']);
			$this->db->bind('volume', $data['volume']);
			$this->db->bind('satuan', $data['satuan']);
			$this->db->bind('jml_bs', $data['jml_sb']);
			$this->db->bind('jml_ppn', $data['jml_ppn']);
			$this->db->bind('jml_ttl_ppn', $data['jml_ttl_ppn']);
			$this->db->bind('jml_pph', $data['jml_pph']);
			$this->db->bind('jml_ttl', $data['jml_ttl']);
			$this->db->bind('tgl_lunas', $data['tgl_lunas']);
			$this->db->bind('status', $data['status_lunas']);			
			$this->db->bind('ku', $data['ku']);

			$this->db->execute();

			return $this->db->kolCount();
		}
	}

	public function hapusDataTagihanA($data, $tb) {
		$query = 'DELETE FROM '. $tb .' WHERE id_tagihan = :id';
		$this->db->query($query);
		$this->db->bind('id',$data);

		$this->db->execute();

		return $this->db->kolCount();
	}

	public function ubahDataTagihanA($data) {
		if (in_array($data['tab'] , ['tagihan_asesmen', 'tagihan_psikotes'])) {
			$query = "UPDATE ". $data['tab'] ." SET
						 perusahaan = :vendor,
						 surat = :surat,
						 volume = :volume,
						 satuan = :satuan,
						 jumlah_blm_pjk = :jml_bs,
						 ppn = :jml_ppn,
						 total_ppn = :jml_ttl_ppn,
						 pph = :jml_pph,
						 total_pph = :jml_ttl,
						 tgl_lunas = :tgl_lunas,
						 status = :status,
						 no_ku = :ku
						 WHERE id_tagihan = :id";



			$this->db->query($query);

			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('surat', $data['surat']);
			$this->db->bind('volume', $data['volume']);
			$this->db->bind('satuan', $data['satuan']);
			$this->db->bind('jml_bs', $data['jml_sb']);
			$this->db->bind('jml_ppn', $data['jml_ppn']);
			$this->db->bind('jml_ttl_ppn', $data['jml_ttl_ppn']);
			$this->db->bind('jml_pph', $data['jml_pph']);
			$this->db->bind('jml_ttl', $data['jml_ttl']);
			$this->db->bind('tgl_lunas', $data['tgl_lunas']);
			$this->db->bind('status', $data['status_lunas']);
			$this->db->bind('ku', $data['ku']);
			$this->db->bind('id', $data['id']);

			$this->db->execute();

			return $this->db->kolCount();

		} elseif (in_array($data['tab'] , ['tagihan_diklat', 'tagihan_konsultan'])) {
			$query = "UPDATE ". $data['tab'] ." SET
						 perusahaan = :vendor,
						 uraian = :urai,
						 surat = :surat,
						 volume = :volume,
						 satuan = :satuan,
						 jumlah_blm_pjk = :jml_bs,
						 ppn = :jml_ppn,
						 total_ppn = :jml_ttl_ppn,
						 pph = :jml_pph,
						 total_pph = :jml_ttl,
						 tgl_lunas = :tgl_lunas,
						 status = :status,
						 no_ku = :ku
						 WHERE id_tagihan = :id";

			$this->db->query($query);

			$this->db->bind('vendor', $data['vendor']);
			$this->db->bind('surat', $data['surat']);
			$this->db->bind('urai', $data['urai']);			
			$this->db->bind('volume', $data['volume']);
			$this->db->bind('satuan', $data['satuan']);
			$this->db->bind('jml_bs', $data['jml_sb']);
			$this->db->bind('jml_ppn', $data['jml_ppn']);
			$this->db->bind('jml_ttl_ppn', $data['jml_ttl_ppn']);
			$this->db->bind('jml_pph', $data['jml_pph']);
			$this->db->bind('jml_ttl', $data['jml_ttl']);
			$this->db->bind('tgl_lunas', $data['tgl_lunas']);
			$this->db->bind('status', $data['status_lunas']);
			$this->db->bind('ku', $data['ku']);
			$this->db->bind('id', $data['id']);

			$this->db->execute();

			// var_dump($data['id']); exit;
			// var_dump($data['urai']); exit;

			return $this->db->kolCount();
		}

	}
	
	public function excelDataDataA($tbl) {
		$this->db->query('SELECT * FROM '. $tbl);
		return $this->db->resultSet();
	}

	public function cetakDataTagihanA($tbl) {

		function rupiah($angka){		
			$hasil_rupiah = number_format($angka,0,',','.');
			return $hasil_rupiah;
			}
		 
		// intance object dan memberikan pengaturan halaman PDF
		$pdf=new FPDF('L','mm','A4');
		$pdf->AddPage();
		 
		$pdf->SetFont('Times','B',13);
		$pdf->Cell(290,10,'DATA TAGIHAN ASESMEN',0,0,'C');
		 
		$pdf->Cell(10,15,'',0,1);
		$pdf->SetFont('Times','B',9);
		$pdf->Cell(10,7,'NO',1,0,'C');
		$pdf->Cell(30,7,'Vendor' ,1,0,'C');
		$pdf->Cell(50,7,'Surat',1,0,'C');
		$pdf->Cell(15,7,'Volume',1,0,'C');
		$pdf->Cell(20,7,'Satuan',1,0,'C');
		$pdf->Cell(30,7,'Total (non pajak)',1,0,'C');
		$pdf->Cell(20,7,'PPN',1,0,'C');
		$pdf->Cell(20,7,'PPH',1,0,'C');
		$pdf->Cell(30,7,'Total (pajak)',1,0,'C');
		$pdf->Cell(50,7,'Nomer KU',1,0,'C');

		 
		 
		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Times','',10);
		$no=1;
		$this->db->query('SELECT * FROM '. $tbl);
		$data = $this->db->resultSet();
		foreach ($data as $tag) {
		  $pdf->Cell(10,6, $no++,1,0,'C');
		  $pdf->Cell(30,6, $tag['perusahaan'],1,0,'C');
		  $pdf->Cell(50,6, $tag['surat'],1,0,'C');  
		  $pdf->Cell(15,6, $tag['volume'],1,0,'C');
		  $pdf->Cell(20,6, rupiah($tag['satuan']),1,0,'C');
		  $pdf->Cell(30,6, rupiah($tag['jumlah_blm_pjk']),1,0,'C');
		  $pdf->Cell(20,6, rupiah($tag['ppn']),1,0,'C');
		  $pdf->Cell(20,6, rupiah($tag['pph']),1,0,'C');
		  $pdf->Cell(30,6, rupiah($tag['total_pph']),1,0,'C');
		  $pdf->Cell(50,6, $tag['no_ku'],1,1,'C');
		}


		$dest = '';
		$name = $tbl;
		 
		return $pdf->Output($dest , $name );

	}

	public function cetakDataTagihanD($tbl , $id) {

		function rupiah($angka){		
			$hasil_rupiah = number_format($angka,0,',','.');
			return $hasil_rupiah;
			}

		$this->db->query('SELECT * FROM '. $tbl .' WHERE id_tagihan = :id');
		$this->db->bind('id',$id);
		$data = $this->db->single();
		
		if (in_array($tbl, ['tagihan_asesmen', 'tagihan_psikotes'])) {

			// intance object dan memberikan pengaturan halaman PDF
			$pdf=new FPDF('P','mm','A4');
			$pdf->AddPage();
			 
			$pdf->SetFont('Times','B',13);
			$pdf->Cell(210,10,'TAGIHAN',0,0,'C');
			 
			$pdf->Cell(10,15,'',0,1);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,7,'Vendor' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['perusahaan'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer Surat',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['surat'].'',0,1,'L');
			$pdf->Cell(40,7,'Volume',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['volume'].'',0,1,'L');
			$pdf->Cell(40,7,'Satuan',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['satuan']).',00',0,1,'L');
			$pdf->Cell(40,7,'Total (non pajak)',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['jumlah_blm_pjk']).',00',0,1,'L');
			$pdf->Cell(40,7,'PPN',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['ppn']).',00',0,1,'L');
			$pdf->Cell(40,7,'PPH',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['pph']).',00',0,1,'L');
			$pdf->Cell(40,7,'Total (pajak)',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['total_pph']).',00',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Pelunasan',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_lunas'].'',0,1,'L');
			$pdf->Cell(40,7,'Pembayaran',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['status'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer KU',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['no_ku'].'',0,1,'L');
			
			$dest = '';
			$name = $data['perusahaan'].'_'.$data['surat']; 
			return $pdf->Output($dest , $name );

		} elseif (in_array($tbl, ['tagihan_diklat', 'tagihan_konsultan'])) {

			// intance object dan memberikan pengaturan halaman PDF
			$pdf=new FPDF('P','mm','A4');
			$pdf->AddPage();
			 
			$pdf->SetFont('Times','B',13);
			$pdf->Cell(210,10,'TAGIHAN',0,0,'C');
			 
			$pdf->Cell(10,15,'',0,1);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,7,'Vendor' ,0,0,'L');
			$pdf->Cell(40,7, ': '.$data['perusahaan'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer Surat',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['surat'].'',0,1,'L');
			$pdf->Cell(40,7,'Volume',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['volume'].'',0,1,'L');
			$pdf->Cell(40,7,'Satuan',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['satuan']).',00',0,1,'L');
			$pdf->Cell(40,7,'Total (non pajak)',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['jumlah_blm_pjk']).',00',0,1,'L');
			$pdf->Cell(40,7,'PPN',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['ppn']).',00',0,1,'L');
			$pdf->Cell(40,7,'PPH',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['pph']).',00',0,1,'L');
			$pdf->Cell(40,7,'Total (pajak)',0,0,'L');
			$pdf->Cell(40,7, ': Rp. '.rupiah($data['total_pph']).',00',0,1,'L');
			$pdf->Cell(40,7,'Tanggal Pelunasan',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['tgl_lunas'].'',0,1,'L');
			$pdf->Cell(40,7,'Pembayaran',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['status'].'',0,1,'L');
			$pdf->Cell(40,7,'Nomer KU',0,0,'L');
			$pdf->Cell(40,7, ': '.$data['no_ku'].'',0,1,'L');
			
			$dest = '';
			$name = $data['perusahaan'].'_'.$data['surat']; 
			return $pdf->Output($dest , $name );
		}
	}

}