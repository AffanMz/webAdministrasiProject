<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data</title>
</head>
<body>
<?php 
// nama file
$filename="data kegiatan-".date('Ymd').".xls";

//header info for browser
header("Content-Type: application/vnd-ms-excel"); 
header('Content-Disposition: attachment; filename="' . $filename . '";');

if ($data['tab'] == 'pelaksanaan') {
	?>
		<table class="table text-start" border="3px">
		  <thead class="color-style">
		    <tr>
		    <div class="row">
		      <th scope="col" style="width: 5%;">No</th>
		      <th scope="col" style="width: 10%;">Job</th>
		      <th scope="col" style="width: 10%;">Surat</th>
		      <th scope="col" style="width: 10%;">Tanggal Dokumen</th>
		      <th scope="col" style="width: 10%;">Tanggal Pelaksanaan</th>
		      <th scope="col" style="width: 5%;">PIC</th>
		      <th scope="col" style="width: 10%;">User</th>
		      <th scope="col" style="width: 10%;">Vendor Kerjasama</th>
		      <th scope="col" style="width: 10%;">Uraian</th>
		      <th scope="col" style="width: 10%;">Jumlah Peserta</th>
		      <th scope="col" style="width: 10%;">Harga Satuan</th>
		      <th scope="col" style="width: 10%;">Biaya Tambahan</th>
		      <th scope="col" style="width: 10%;">Jumlah</th>
		      <th scope="col" style="width: 10%;">Pajak 10%</th>
		      <th scope="col" style="width: 10%;">Total</th>
		      <th scope="col" style="width: 10%;">Status pengerjaan</th>
		      <th scope="col" style="width: 10%;">Nomer Tagihan</th>
		    </div>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
				function rupiah($angka){
					
					$hasil_rupiah = number_format($angka,0,',','.');
					return $hasil_rupiah;
				 
				}
		  		$no = 1;
			  	for ($i=1; $i < 3 ; $i++) { 
			  		if ($i == 1) {
			  				$job = 'diklat';
			  		}	elseif ($i == 2) {
			  				$job = 'konsultan';
			  		}	

			  		if ($data['tagihan'.$i.''] == NULL) {
			  				continue;
			  		}	
		  		foreach ($data['tagihan'.$i.''] as $tag) {
		  	 ?>
		    <tr>
		      <th scope="row"><?= $no; $no++; ?></th>
		      <td class="style-font"><?= $job ?></td>
		      <td class="style-font"><?= $tag['surat'] ?></td>
		      <td class="style-font"><?= $tag['tgl_dok']?></td>
		      <td class="style-font"><?= $tag['tgl_pel']?></td>
		      <td class="style-font"><?= $tag['PIC'] ?></td>
		      <td class="style-font"><?= $tag['perusahaan'] ?></td>
		      <td class="style-font"><?= $tag['vendor_ks'] ?></td>
		      <td class="style-font"><?= $tag['uraian'] ?></td>
		      <td class="style-font"><?= $tag['jml_peserta'] ?></td>
		      <td class="style-font"><?= $tag['satuan'] ?></td>
		      <td class="style-font"><?= $tag['biaya_tambah'] ?></td>
		      <td class="style-font"><?= $tag['ttl_blm_pjk']?></td>
		      <td class="style-font"><?= $tag['pjk']?></td>
		      <td class="style-font"><?= $tag['total']?></td>
		      <td class="style-font"><?= $tag['status']?></td>
		      <td class="style-font"><?= $tag['no_tag']?></td>
		    </tr>
		    <?php 
		    	}
		     }
		     ?>
		  </tbody>
		</table>
	<?php
} elseif ($data['tab'] == 'data_asesmen') {
	?>
		<table class="table text-start" border="3px">
		  <thead class="color-style">
		    <tr>
		    <div class="row">
		      <th scope="col" style="width: 5%;">No</th>
		      <th scope="col" style="width: 10%;">Vendor</th>
		      <th scope="col" style="width: 10%;">Surat</th>
		      <th scope="col" style="width: 10%;">Tanggal Dokumen</th>
		      <th scope="col" style="width: 5%;">PIC</th>
		      <th scope="col" style="width: 10%;">Asesi</th>
		      <th scope="col" style="width: 10%;">Tanggal Pelaksaan</th>
		      <th scope="col" style="width: 10%;">Asesor Asesmen</th>
		      <th scope="col" style="width: 10%;">Asesor Bidang</th>
		      <th scope="col" style="width: 10%;">Asesor Feedback</th>
		      <th scope="col" style="width: 10%;">Role Player</th>
		      <th scope="col" style="width: 10%;">Transport/Pulsa</th>
		    </div>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
				function rupiah($angka){
					
					$hasil_rupiah = number_format($angka,0,',','.');
					return $hasil_rupiah;
				 
				}
		  		$no = 1;
		  		foreach ($data['data'] as $tag) {
		  	 ?>
		    <tr>
		      <th scope="row"><?= $no; $no++; ?></th>
		      <td class="style-font"><?= $tag['perusahaan'] ?></td>
		      <td class="style-font"><?= $tag['surat'] ?></td>
		      <td class="style-font"><?= $tag['tgl_dok']?></td>
		      <td class="style-font"><?= $tag['PIC'] ?></td>
		      <td class="style-font"><?= $tag['asesi'] ?></td>
		      <td class="style-font"><?= $tag['tgl_pel']?></td>
		      <td class="style-font"><?= $tag['asesor_ass']?></td>
		      <td class="style-font"><?= $tag['asesor_bid']?></td>
		      <td class="style-font"><?= $tag['asesor_feed']?></td>
		      <td class="style-font"><?= $tag['rp']?></td>
		      <td class="style-font"><?= $tag['transp_pulsa']?></td>
		    </tr>
		    <?php 
		    	}
		     ?>
		  </tbody>
		</table>
	<?php 
} elseif (in_array($data['tab'], ['data_diklat', 'data_konsultan'])) {
	?>
		<table class="table text-start" border="3px">
		  <thead class="color-style">
		    <tr>
		    <div class="row">
		      <th scope="col" style="width: 5%;">No</th>
		      <th scope="col" style="width: 10%;">Surat</th>
		      <th scope="col" style="width: 10%;">Tanggal Dokumen</th>
		      <th scope="col" style="width: 10%;">Tanggal Pelaksanaan</th>
		      <th scope="col" style="width: 5%;">PIC</th>
		      <th scope="col" style="width: 10%;">User</th>
		      <th scope="col" style="width: 10%;">Vendor Kerjasama</th>
		      <th scope="col" style="width: 10%;">Uraian</th>
		      <th scope="col" style="width: 10%;">Jumlah Peserta</th>
		      <th scope="col" style="width: 10%;">Harga Satuan</th>
		      <th scope="col" style="width: 10%;">Biaya Tambahan</th>
		      <th scope="col" style="width: 10%;">Jumlah</th>
		      <th scope="col" style="width: 10%;">Pajak 10%</th>
		      <th scope="col" style="width: 10%;">Total</th>
		      <th scope="col" style="width: 10%;">Status pengerjaan</th>
		      <th scope="col" style="width: 10%;">Nomer Tagihan</th>
		    </div>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
				function rupiah($angka){
					
					$hasil_rupiah = number_format($angka,0,',','.');
					return $hasil_rupiah;
				 
				}
		  		$no = 1;
		  		foreach ($data['data'] as $tag) {
		  	 ?>
		    <tr>
		      <th scope="row"><?= $no; $no++; ?></th>
		      <td class="style-font"><?= $tag['surat'] ?></td>
		      <td class="style-font"><?= $tag['tgl_dok']?></td>
		      <td class="style-font"><?= $tag['tgl_pel']?></td>
		      <td class="style-font"><?= $tag['PIC'] ?></td>
		      <td class="style-font"><?= $tag['perusahaan'] ?></td>
		      <td class="style-font"><?= $tag['vendor_ks'] ?></td>
		      <td class="style-font"><?= $tag['uraian'] ?></td>
		      <td class="style-font"><?= $tag['jml_peserta'] ?></td>
		      <td class="style-font"><?= $tag['satuan'] ?></td>
		      <td class="style-font"><?= $tag['biaya_tambah'] ?></td>
		      <td class="style-font"><?= $tag['ttl_blm_pjk']?></td>
		      <td class="style-font"><?= $tag['pjk']?></td>
		      <td class="style-font"><?= $tag['total']?></td>
		      <td class="style-font"><?= $tag['status']?></td>
		      <td class="style-font"><?= $tag['no_tag']?></td>
		    </tr>
		    <?php 
		    	}
		     ?>
		  </tbody>
		</table>
	<?php 
} elseif ($data['tab'] == 'data_psikotes') {
 	?>
		<table class="table text-start" border="3px">
		  <thead class="color-style">
		    <tr>
		    <div class="row">
		      <th scope="col" style="width: 5%;">No</th>
		      <th scope="col" style="width: 10%;">User</th>
		      <th scope="col" style="width: 10%;">Surat</th>
		      <th scope="col" style="width: 10%;">Tanggal Dokumen</th>
		      <th scope="col" style="width: 5%;">PIC</th>
		      <th scope="col" style="width: 10%;">Asesi</th>
		      <th scope="col" style="width: 10%;">Tanggal Pelaksaan</th>
		      <th scope="col" style="width: 10%;">Tester</th>
		      <th scope="col" style="width: 10%;">Asesor</th>
		      <th scope="col" style="width: 10%;">Transport/Pulsa</th>
		    </div>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
				function rupiah($angka){
					
					$hasil_rupiah = number_format($angka,0,',','.');
					return $hasil_rupiah;
				 
				}
		  		$no = 1;
		  		foreach ($data['data'] as $tag) {
		  	 ?>
		    <tr>
		      <th scope="row"><?= $no; $no++; ?></th>
		      <td class="style-font"><?= $tag['perusahaan'] ?></td>
		      <td class="style-font"><?= $tag['surat'] ?></td>
		      <td class="style-font"><?= $tag['tgl_dok']?></td>
		      <td class="style-font"><?= $tag['PIC'] ?></td>
		      <td class="style-font"><?= $tag['asesi'] ?></td>
		      <td class="style-font"><?= $tag['tgl_pel']?></td>
		      <td class="style-font"><?= $tag['tester']?></td>
		      <td class="style-font"><?= $tag['asesor']?></td>
		      <td class="style-font"><?= $tag['transp_pulsa']?></td>
		    </tr>
		    <?php 
		    	}
		     ?>
		  </tbody>
		</table>
	<?php 
} elseif ($data['tab'] == 'data_notad') {
 	?>
		<table class="table text-start" border="3px">
		  <thead class="color-style">
		    <tr>
		    <div class="row">
		      <th scope="col" style="width: 5%;">No</th>
		      <th scope="col" style="width: 10%;">Nomer ND UM</th>
		      <th scope="col" style="width: 10%;">Tanggal Pengajuan</th>
		      <th scope="col" style="width: 10%;">Uraian</th>
		      <th scope="col" style="width: 5%;">Tanggal Pelaksanaan</th>
		      <th scope="col" style="width: 5%;">Nominal</th>
		      <th scope="col" style="width: 5%;">Nilai LPJ</th>
		      <th scope="col" style="width: 5%;">Profit</th>
		      <th scope="col" style="width: 5%;">Nomer JJK</th>
		      <th scope="col" style="width: 5%;">Nomer LPJ UM</th>
		      <th scope="col" style="width: 10%;">Tanggal LPJ</th>
		      <th scope="col" style="width: 10%;">PIC</th>
		      <th scope="col" style="width: 10%;">Status</th>
		      <th scope="col" style="width: 10%;">Bukti Transfer</th>
		    </div>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
				function rupiah($angka){
					
					$hasil_rupiah = number_format($angka,0,',','.');
					return $hasil_rupiah;
				 
				}
		  		$no = 1;
		  		foreach ($data['data'] as $tag) {
		  	 ?>
		    <tr>
		      <th scope="row"><?= $no; $no++; ?></th>
		      <td class="style-font"><?= $tag['no_ndum'] ?></td>
		      <td class="style-font"><?= $tag['tgl_ajuan'] ?></td>
		      <td class="style-font"><?= $tag['uraian']?></td>
		      <td class="style-font"><?= $tag['tgl_pel'] ?></td>
		      <td class="style-font"><?= $tag['nominal'] ?></td>
		      <td class="style-font"><?= $tag['nilai_lpj']?></td>
		      <td class="style-font"><?= $tag['profit']?></td>
		      <td class="style-font"><?= $tag['no_jjk']?></td>
		      <td class="style-font"><?= $tag['no_lpjum']?></td>
		      <td class="style-font"><?= $tag['tgl_lpj'] ?></td>
		      <td class="style-font"><?= $tag['PIC'] ?></td>
		      <td class="style-font"><?= $tag['status'] ?></td>
		      <td class="style-font"><?= $tag['bukti_trans'] ?></td>
		    </tr>
		    <?php 
		    	}
		     ?>
		  </tbody>
		</table>
	<?php 
}

	?>  
	
</body>
</html>