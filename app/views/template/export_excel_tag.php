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
$filename="data_".$data['tab']."-".date('Ymd').".xls";

//header info for browser
header("Content-Type: application/vnd-ms-excel"); 
header('Content-Disposition: attachment; filename="' . $filename . '";');

if ($data['tab'] == 'pelunasan') {
	?>
		<table class="table text-start" border="3px">
		  <thead class="color-style">
		    <tr>
		    <div class="row">
		      <th scope="col" style="width: 5%;">No</th>
		      <th scope="col" style="width: 10%;">Perusahaan</th>
		      <th scope="col" style="width: 10%;">Surat</th>
		      <th scope="col" style="width: 5%;">Vol</th>
		      <th scope="col" style="width: 10%;">Satuan</th>
		      <th scope="col" style="width: 10%;">Jumlah</th>
		      <th scope="col" style="width: 10%;">PPN</th>
		      <th scope="col" style="width: 10%;">Total</th>
		      <th scope="col" style="width: 10%;">PPH</th>
		      <th scope="col" style="width: 10%;">Jumlah Setelah Pajak</th>
		      <th scope="col" style="width: 10%;">Tanggal Pelunasan</th>
		      <th scope="col" style="width: 10%;">Status</th>
		      <th scope="col" style="width: 10%;">NO KU</th>
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
			  	for ($i=1; $i < 5 ; $i++) { 
			  		if ($i == 1) {
			  				$job = 'asesmen';
			  		}	elseif ($i == 2) {
			  				$job = 'diklat';
			  		}	elseif ($i == 3) {
			  				$job = 'psikotes';
			  		}	elseif ($i == 4) {
			  				$job = 'konsultan';
			  		}

			  		if ($data['tagihan'.$i.''] == NULL) {
			  				continue;
			  		}	
		  		foreach ($data['tagihan'.$i.''] as $tag) {
		  	 ?>
		    <tr>
		      <th scope="row"><?= $no; $no++; ?></th>
		      <td class="style-font"><?= $tag['perusahaan'] ?></td>
		      <td class="style-font"><?= $tag['surat'] ?></td>
		      <td class="style-font"><?= $tag['volume'] ?></td>
		      <td class="style-font"><?= rupiah($tag['satuan']) ?></td>
		      <td class="style-font"><?= rupiah($tag['jumlah_blm_pjk'])?></td>
		      <td class="style-font"><?= rupiah($tag['ppn'])?></td>
		      <td class="style-font"><?= rupiah($tag['total_ppn'])?></td>
		      <td class="style-font"><?= rupiah($tag['pph'])?></td>
		      <td class="style-font"><?= rupiah($tag['total_pph'])?></td>
		      <td class="style-font"><?= $tag['tgl_lunas'] ?></td>
		      <td class="style-font"><?= $tag['status'] ?></td>
		      <td class="style-font"><?= $tag['no_ku'] ?></td>
		    </tr>
		    <?php 
		    	}
		     }
		     ?>
		  </tbody>
		</table>
	<?php
} elseif (in_array($data['tab'], ['tagihan_asesmen', 'tagihan_psikotes'])) {
	?>
		<table class="table text-start" border="3px">
		  <thead class="color-style">
		    <tr>
		    <div class="row">
		      <th scope="col" style="width: 5%;">No</th>
		      <th scope="col" style="width: 10%;">Perusahaan</th>
		      <th scope="col" style="width: 10%;">Surat</th>
		      <th scope="col" style="width: 5%;">Vol</th>
		      <th scope="col" style="width: 10%;">Satuan</th>
		      <th scope="col" style="width: 10%;">Jumlah</th>
		      <th scope="col" style="width: 10%;">PPN</th>
		      <th scope="col" style="width: 10%;">Total</th>
		      <th scope="col" style="width: 10%;">PPH</th>
		      <th scope="col" style="width: 10%;">Jumlah Setelah Pajak</th>
		      <th scope="col" style="width: 10%;">Tanggal Pelunasan</th>
		      <th scope="col" style="width: 10%;">Status</th>
		      <th scope="col" style="width: 10%;">NO KU</th>
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
		      <td class="style-font"><?= $tag['volume'] ?></td>
		      <td class="style-font"><?= rupiah($tag['satuan']) ?></td>
		      <td class="style-font"><?= rupiah($tag['jumlah_blm_pjk'])?></td>
		      <td class="style-font"><?= rupiah($tag['ppn'])?></td>
		      <td class="style-font"><?= rupiah($tag['total_ppn'])?></td>
		      <td class="style-font"><?= rupiah($tag['pph'])?></td>
		      <td class="style-font"><?= rupiah($tag['total_pph'])?></td>
		      <td class="style-font"><?= $tag['tgl_lunas'] ?></td>
		      <td class="style-font"><?= $tag['status'] ?></td>
		      <td class="style-font"><?= $tag['no_ku'] ?></td>
		    </tr>
		    <?php 
		    	}
		     ?>
		  </tbody>
		</table>
	<?php 
} elseif (in_array($data['tab'], ['tagihan_diklat', 'tagihan_konsultan'])) {
	?>
		<table class="table text-start" border="3px">
		  <thead class="color-style">
		    <tr>
		    <div class="row">
		      <th scope="col" style="width: 5%;">No</th>
		      <th scope="col" style="width: 10%;">Perusahaan</th>
		      <th scope="col" style="width: 10%;">Surat</th>
		      <th scope="col" style="width: 5%;">Uraian</th>		      
		      <th scope="col" style="width: 5%;">Vol</th>
		      <th scope="col" style="width: 10%;">Satuan</th>
		      <th scope="col" style="width: 10%;">Jumlah</th>
		      <th scope="col" style="width: 10%;">PPN</th>
		      <th scope="col" style="width: 10%;">Total</th>
		      <th scope="col" style="width: 10%;">PPH</th>
		      <th scope="col" style="width: 10%;">Jumlah Setelah Pajak</th>
		      <th scope="col" style="width: 10%;">Tanggal Pelunasan</th>
		      <th scope="col" style="width: 10%;">Status</th>
		      <th scope="col" style="width: 10%;">NO KU</th>
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
		      <td class="style-font"><?= $tag['uraian'] ?></td>
		      <td class="style-font"><?= $tag['volume'] ?></td>
		      <td class="style-font"><?= rupiah($tag['satuan']) ?></td>
		      <td class="style-font"><?= rupiah($tag['jumlah_blm_pjk'])?></td>
		      <td class="style-font"><?= rupiah($tag['ppn'])?></td>
		      <td class="style-font"><?= rupiah($tag['total_ppn'])?></td>
		      <td class="style-font"><?= rupiah($tag['pph'])?></td>
		      <td class="style-font"><?= rupiah($tag['total_pph'])?></td>
		      <td class="style-font"><?= $tag['tgl_lunas'] ?></td>
		      <td class="style-font"><?= $tag['status'] ?></td>
		      <td class="style-font"><?= $tag['no_ku'] ?></td>
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