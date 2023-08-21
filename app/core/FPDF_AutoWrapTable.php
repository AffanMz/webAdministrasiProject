<?php
require_once 'fpdf185/fpdf.php';
class FPDF_AutoWrapTable extends FPDF {
  	private $data = array();
  	private $data1 = array();
  	private $data2 = array();
  	private $data3 = array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => 'I',
  		'paper_size'=>'A4',
  		'orientation'=>'L'
  	);
  	private $tbl = '';
  	
  	function __construct($data = array(), $data1 = array(), $data2 = array(), $data3 = array(), $options = array(), $tbl = 'tagihan_asesmen') {
  		if ($tbl == 'pelunasan') {
  			parent::__construct();
	    	$this->data = $data;
	    	$this->data1 = $data1;
	    	$this->data2 = $data2;
	    	$this->data3 = $data3;
	    	$this->options = $options;
	    	$this->tbl = $tbl;

  		} elseif ($tbl == 'pelaksanaan') {
  			parent::__construct();
	    	$this->data = $data;
	    	$this->data1 = $data1;
	    	$this->options = $options;
	    	$this->tbl = $tbl;
  		} else {
  			parent::__construct();
	    	$this->data = $data;
	    	$this->options = $options;
	    	$this->tbl = $tbl;
  		}
    	
	}
	
	public function rptDetailData () {
		//
		function rupiah($angka){		
			$hasil_rupiah = number_format($angka,0,',','.');
			return $hasil_rupiah;
			}
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;
		
		
		
		if (in_array($this->tbl, ['tagihan_asesmen', 'tagihan_psikotes', 'tagihan_konsultan', 'tagihan_diklat', 'pelunasan', 'pelaksanaan'])) {
			
			//header
			$this->SetFont("", "B", 15);
			$this->MultiCell(0, 12, 'PT. PELINDO DAYA SEJAHTERA');
			$this->Cell(0, 1, " ", "B");
			$this->Ln(10);
			$this->SetFont("", "B", 12);
			$this->SetX($left); $this->Cell(0, 10, 'LAPORAN DATA TAGIHAN', 0, 1,'C');
			$this->Ln(10);

			if ($this->tbl == 'pelunasan') {
				$h = 15;
				$left = 40;
				$top = 80;	
				#tableheader
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'NO',1,0,'L',true);
				$this->SetX($left += 22); $this->Cell(75, $h, 'Vendor', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(75, $h, 'Surat', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(30, $h, 'Vol', 1, 0, 'C',true);
				$this->SetX($left += 30); $this->Cell(75, $h, 'Satuan', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(75, $h, 'Jumlah', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(50, $h, 'PPN', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(75, $h, 'Total', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(50, $h, 'PPH', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(75, $h, 'Jumlah(PJK)', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(60, $h, 'Tenggat', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Pelunasan', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'No KU', 1, 1, 'C',true);
				//$this->Ln(22);
				
				$this->SetFont('Arial','',9);
				$this->SetWidths(array(22,75,75,30,75,75,50,75,50,75,60,60,60));
				$this->SetAligns(array('C','L','L','L','L','L'));
				$no = 1; $this->SetFillColor(255);
				foreach ($this->data as $baris) {
					$this->Row(
						array($no++, 
						$baris['perusahaan'], 
						$baris['surat'],  
						$baris['volume'], 
						rupiah($baris['satuan']), 
						rupiah($baris['jumlah_blm_pjk']),
						rupiah($baris['ppn']), 
						rupiah($baris['total_ppn']), 
						rupiah($baris['pph']), 
						rupiah($baris['total_pph']), 
						$baris['tgl_lunas'],
						$baris['status'],
						$baris['no_ku']
					));
				} foreach ($this->data1 as $baris) {
					$this->Row(
						array($no++, 
						$baris['perusahaan'], 
						$baris['surat'],  
						$baris['volume'], 
						rupiah($baris['satuan']), 
						rupiah($baris['jumlah_blm_pjk']),
						rupiah($baris['ppn']), 
						rupiah($baris['total_ppn']), 
						rupiah($baris['pph']), 
						rupiah($baris['total_pph']), 
						$baris['tgl_lunas'],
						$baris['status'],
						$baris['no_ku']
					));
				} foreach ($this->data2 as $baris) {
					$this->Row(
						array($no++, 
						$baris['perusahaan'], 
						$baris['surat'],  
						$baris['volume'], 
						rupiah($baris['satuan']), 
						rupiah($baris['jumlah_blm_pjk']),
						rupiah($baris['ppn']), 
						rupiah($baris['total_ppn']), 
						rupiah($baris['pph']), 
						rupiah($baris['total_pph']), 
						$baris['tgl_lunas'],
						$baris['status'],
						$baris['no_ku']
					));
				} foreach ($this->data3 as $baris) {
					$this->Row(
						array($no++, 
						$baris['perusahaan'], 
						$baris['surat'],  
						$baris['volume'], 
						rupiah($baris['satuan']), 
						rupiah($baris['jumlah_blm_pjk']),
						rupiah($baris['ppn']), 
						rupiah($baris['total_ppn']), 
						rupiah($baris['pph']), 
						rupiah($baris['total_pph']), 
						$baris['tgl_lunas'],
						$baris['status'],
						$baris['no_ku']
					));
				}
			} elseif ($this->tbl == 'pelaksanaan') {
				$h = 15;
				$left = 40;
				$top = 80;	
				#tableheader
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'NO',1,0,'L',true);
				$this->SetX($left += 22); $this->Cell(50, $h, 'Surat', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(40, $h, 'Dok', 1, 0, 'C',true);
				$this->SetX($left += 40); $this->Cell(40, $h, 'Pel', 1, 0, 'C',true);
				$this->SetX($left += 40); $this->Cell(50, $h, 'PIC', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(50, $h, 'User', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(50, $h, 'KS', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(60, $h, 'Uraian', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(30, $h, 'Vol', 1, 0, 'C',true);
				$this->SetX($left += 30); $this->Cell(60, $h, 'Satuan', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(50, $h, 'Tambah', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(60, $h, 'Jumlah', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'PJK', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Total', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(50, $h, 'status', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(50, $h, 'No Tag', 1, 1, 'C',true);
				//$this->Ln(22);
				
				$this->SetFont('Arial','',9);
				$this->SetWidths(array(22,50,40,40,50,50,50,60,30,60,50,60,60,60,50,50));
				$this->SetAligns(array('C','L','L','L','L','L'));
				$no = 1; $this->SetFillColor(255);
				foreach ($this->data as $baris) {
					$this->Row(
						array($no++, 
						$baris['surat'], 
						$baris['tgl_dok'], 
						$baris['tgl_pel'], 
						$baris['PIC'], 
						$baris['perusahaan'], 
						$baris['vendor_ks'], 
						$baris['uraian'], 
						$baris['jml_peserta'], 
						rupiah($baris['satuan']), 
						rupiah($baris['biaya_tambah']), 
						rupiah($baris['ttl_blm_pjk']),
						rupiah($baris['pjk']), 
						rupiah($baris['total']), 
						$baris['status'],
						$baris['no_tag']
					));
				} foreach ($this->data1 as $baris) {
					$this->Row(
						array($no++, 
						$baris['surat'], 
						$baris['tgl_dok'], 
						$baris['tgl_pel'], 
						$baris['PIC'], 
						$baris['perusahaan'], 
						$baris['vendor_ks'], 
						$baris['uraian'], 
						$baris['jml_peserta'], 
						rupiah($baris['satuan']), 
						rupiah($baris['biaya_tambah']), 
						rupiah($baris['ttl_blm_pjk']),
						rupiah($baris['pjk']), 
						rupiah($baris['total']), 
						$baris['status'],
						$baris['no_tag']
					));
				} 
			} elseif (in_array($this->tbl, ['tagihan_asesmen', 'tagihan_psikotes'])) {
				$h = 15;
				$left = 40;
				$top = 80;	
				#tableheader
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'NO',1,0,'L',true);
				$this->SetX($left += 22); $this->Cell(75, $h, 'Vendor', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(75, $h, 'Surat', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(30, $h, 'Vol', 1, 0, 'C',true);
				$this->SetX($left += 30); $this->Cell(75, $h, 'Satuan', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(75, $h, 'Jumlah', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(50, $h, 'PPN', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(75, $h, 'Total', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(50, $h, 'PPH', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(75, $h, 'Jumlah(PJK)', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(60, $h, 'Tenggat', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Pelunasan', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'No KU', 1, 1, 'C',true);
				//$this->Ln(22);
				
				$this->SetFont('Arial','',9);
				$this->SetWidths(array(22,75,75,30,75,75,50,75,50,75,60,60,60));
				$this->SetAligns(array('C','L','L','L','L','L'));
				$no = 1; $this->SetFillColor(255);
				foreach ($this->data as $baris) {
					$this->Row(
						array($no++, 
						$baris['perusahaan'], 
						$baris['surat'],  
						$baris['volume'], 
						rupiah($baris['satuan']), 
						rupiah($baris['jumlah_blm_pjk']),
						rupiah($baris['ppn']), 
						rupiah($baris['total_ppn']), 
						rupiah($baris['pph']), 
						rupiah($baris['total_pph']), 
						$baris['tgl_lunas'],
						$baris['status'],
						$baris['no_ku']
					));
				}
			} elseif (in_array($this->tbl, ['tagihan_konsultan', 'tagihan_diklat'])) {
				$h = 15;
				$left = 40;
				$top = 80;	
				#tableheader
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'NO',1,0,'L',true);
				$this->SetX($left += 22); $this->Cell(50, $h, 'Vendor', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(60, $h, 'Surat', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(75, $h, 'Uraian', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(30, $h, 'Vol', 1, 0, 'C',true);
				$this->SetX($left += 30); $this->Cell(75, $h, 'Satuan', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(75, $h, 'Jumlah', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(50, $h, 'PPN', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(50, $h, 'Total', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(50, $h, 'PPH', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(75, $h, 'Jumlah(PJK)', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(60, $h, 'Tenggat', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Pelunasan', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'No KU', 1, 1, 'C',true);
				//$this->Ln(22);
				
				$this->SetFont('Arial','',9);
				$this->SetWidths(array(22,50,60,75,30,75,75,50,50,50,75,60,60,60));
				$this->SetAligns(array('C','L','L','L','L','L'));
				$no = 1; $this->SetFillColor(255);
				foreach ($this->data as $baris) {
					$this->Row(
						array($no++, 
						$baris['perusahaan'], 
						$baris['surat'], 
						$baris['uraian'], 
						$baris['volume'], 
						rupiah($baris['satuan']), 
						rupiah($baris['jumlah_blm_pjk']),
						rupiah($baris['ppn']), 
						rupiah($baris['total_ppn']), 
						rupiah($baris['pph']), 
						rupiah($baris['total_pph']), 
						$baris['tgl_lunas'],
						$baris['status'],
						$baris['no_ku']
					));
				}
			}
		} elseif (in_array($this->tbl, ['data_asesmen', 'data_psikotes', 'data_konsultan', 'data_diklat', 'data_notad'])) {

			//header
			$this->SetFont("", "B", 15);
			$this->MultiCell(0, 12, 'PT. PELINDO DAYA SEJAHTERA');
			$this->Cell(0, 1, " ", "B");
			$this->Ln(10);
			$this->SetFont("", "B", 12);
			$this->SetX($left); $this->Cell(0, 10, 'LAPORAN DATA KEGIATAN', 0, 1,'C');
			$this->Ln(10);

			if (in_array($this->tbl, ['data_konsultan', 'data_diklat'])) {
				$h = 15;
				$left = 40;
				$top = 80;	
				#tableheader
				$this->SetFont("", "", 10);
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'NO',1,0,'L',true);
				$this->SetX($left += 22); $this->Cell(50, $h, 'Surat', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(40, $h, 'Dok', 1, 0, 'C',true);
				$this->SetX($left += 40); $this->Cell(40, $h, 'Pel', 1, 0, 'C',true);
				$this->SetX($left += 40); $this->Cell(50, $h, 'PIC', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(50, $h, 'User', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(50, $h, 'Kerjasama', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(60, $h, 'Uraian', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(30, $h, 'Vol', 1, 0, 'C',true);
				$this->SetX($left += 30); $this->Cell(60, $h, 'Satuan', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(50, $h, 'Tambah', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(60, $h, 'Jumlah', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'PJK', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Total', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(50, $h, 'status', 1, 0, 'C',true);
				$this->SetX($left += 50); $this->Cell(50, $h, 'No Tag', 1, 1, 'C',true);
				//$this->Ln(22);

				$this->SetFont('Arial','',9);
				$this->SetWidths(array(22,50,40,40,50,50,50,60,30,60,50,60,60,60,50,50));
				$this->SetAligns(array('C','L','L','L','L','L'));
				$no = 1; $this->SetFillColor(255);
				foreach ($this->data as $baris) {
					$this->Row(
						array($no++, 
						$baris['surat'], 
						$baris['tgl_dok'], 
						$baris['tgl_pel'], 
						$baris['PIC'], 
						$baris['perusahaan'], 
						$baris['vendor_ks'], 
						$baris['uraian'], 
						$baris['jml_peserta'], 
						rupiah($baris['satuan']), 
						rupiah($baris['biaya_tambah']), 
						rupiah($baris['ttl_blm_pjk']),
						rupiah($baris['pjk']), 
						rupiah($baris['total']), 
						$baris['status'],
						$baris['no_tag']
					));
				}
			} elseif ($this->tbl == 'data_asesmen') {
				$h = 15;
				$left = 40;
				$top = 80;	
				#tableheader
				$this->SetFont("", "", 10);
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'NO','LTR',0,'L',true);
				$this->SetX($left += 22); $this->Cell(65, $h, 'User', 'LTR', 0, 'C',true);
				$this->SetX($left += 65); $this->Cell(75, $h, 'Surat', 'LTR', 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(60, $h, 'Dok', 'LTR', 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'PIC', 'LTR', 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(75, $h, 'Asesi', 'LTR', 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(60, $h, 'Pel', 'LTR', 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(225, $h, 'Asesor', 1, 0, 'C',true);
				$this->SetX($left += 225); $this->Cell(60, $h, 'Role Player', 'LTR', 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'T/P', 'LTR', 1, 'C',true);

				$this->SetFont("", "", 10);
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'','LRB',0,'L',true);
				$this->SetX($left += 22); $this->Cell(65, $h, '', 'LRB', 0, 'C',true);
				$this->SetX($left += 65); $this->Cell(75, $h, '', 'LRB', 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(60, $h, '', 'LRB', 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, '', 'LRB', 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(75, $h, '', 'LRB', 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(60, $h, '', 'LRB', 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(75, $h, 'Asesmen', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(75, $h, 'Bidang', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(75, $h, 'Feedback', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(60, $h, '', 'LRB', 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, '', 'LRB', 1, 'C',true);
				//$this->Ln(22);

				$this->SetFont('Arial','',9);
				$this->SetWidths(array(22,65,75,60,60,75,60,75,75,75,60,60));
				$this->SetAligns(array('C','L','L','L','L','L'));
				$no = 1; $this->SetFillColor(255);
				foreach ($this->data as $baris) {
					$this->Row(
						array($no++, 
						$baris['perusahaan'], 
						$baris['surat'], 
						$baris['tgl_dok'], 
						$baris['PIC'], 
						$baris['asesi'], 
						$baris['tgl_pel'], 
						$baris['asesor_ass'], 
						$baris['asesor_bid'], 
						$baris['asesor_feed'], 
						$baris['rp'], 
						$baris['transp_pulsa']
					));
				}
			} elseif ($this->tbl == 'data_psikotes') {
				$h = 15;
				$left = 40;
				$top = 80;	
				#tableheader
				$this->SetFont("", "", 10);
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'',1,0,'L',true);
				$this->SetX($left += 22); $this->Cell(75, $h, 'User', 1, 0, 'C',true);
				$this->SetX($left += 75); $this->Cell(110, $h, 'Surat', 1, 0, 'C',true);
				$this->SetX($left += 110); $this->Cell(60, $h, 'Dokumen', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'PIC', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(110, $h, 'Asesi', 1, 0, 'C',true);
				$this->SetX($left += 110); $this->Cell(60, $h, 'Pelaksana', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(90, $h, 'Tester', 1, 0, 'C',true);
				$this->SetX($left += 90); $this->Cell(90, $h, 'Asesor', 1, 0, 'C',true);
				$this->SetX($left += 90); $this->Cell(90, $h, 'T/P', 1, 1, 'C',true);
				//$this->Ln(22);

				$this->SetFont('Arial','',9);
				$this->SetWidths(array(22,75,110,60,60,110,60,90,90,90));
				$this->SetAligns(array('C','L','L','L','L','L'));
				$no = 1; $this->SetFillColor(255);
				foreach ($this->data as $baris) {
					$this->Row(
						array($no++, 
						$baris['perusahaan'], 
						$baris['surat'], 
						$baris['tgl_dok'], 
						$baris['PIC'], 
						$baris['asesi'], 
						$baris['tgl_pel'],
						$baris['tester'], 
						$baris['asesor'],
						$baris['transp_pulsa']
					));
				}
			} elseif ($this->tbl == 'data_notad') {
				$h = 15;
				$left = 40;
				$top = 80;	
				#tableheader
				$this->SetFont("", "", 10);
				$this->SetFillColor(200,200,200);	
				$left = $this->GetX();
				$this->Cell(22,$h,'',1,0,'L',true);
				$this->SetX($left += 22); $this->Cell(60, $h, 'NO ND UM', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Pengajuan', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(100, $h, 'Uraian', 1, 0, 'C',true);
				$this->SetX($left += 100); $this->Cell(60, $h, 'Pelaksanaan', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Nominal', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Nilai LPJ', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Profit', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'No JJK', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'NO LPJ UM', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Waktu LPJ', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'PIC', 1, 0, 'C',true);
				$this->SetX($left += 60); $this->Cell(60, $h, 'Transfer', 1, 1, 'C',true);

				//$this->Ln(22);

				$this->SetFont('Arial','',9);
				$this->SetWidths(array(22,60,60,100,60,60,60,60,60,60,60,60,60));
				$this->SetAligns(array('C','L','L','L','L','L'));
				$no = 1; $this->SetFillColor(255);
				foreach ($this->data as $baris) {
					$this->Row(
						array($no++, 
						$baris['no_ndum'], 
						$baris['tgl_ajuan'], 
						$baris['uraian'], 
						$baris['tgl_pel'], 
						$baris['nominal'], 
						$baris['nilai_lpj'],
						$baris['profit'], 
						$baris['no_jjk'],
						$baris['no_lpjum'],
						$baris['tgl_lpj'],
						$baris['PIC'],
						$baris['bukti_trans'],
					));
				}
			}	
		}
	}

	public function printPDF () {
				
		if ($this->options['paper_size'] == "F4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a,$b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}
		
	    $this->SetAutoPageBreak(false);
	    $this->AliasNbPages();
	    $this->SetFont("helvetica", "B", 10);
	    //$this->AddPage();
	
	    $this->rptDetailData();
			    
	    $this->Output($this->options['filename'],$this->options['destinationfile']);
  	}
  	

  	
  	private $widths;
	private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=10*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,10,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
} //end of class
?>
