		<div class="row">
			<div class="col-3">		
			</div>
			<div class="col-9 up-to-up">
				<div class="container up-to">
					<div class="row align-items-center">
						  <div class="col">
						    <div class="card">
						      <div class="card-body">
						        <h5 class="card-title"><?= $data['judul']; ?></h5>
						        <?php Flasher::flash(); ?>
						        	<hr class="line-height">
						        	<div class="container-fluid">
							        	<div class="row">
							        		<div class="col">
							        			<?php 
															if ($data['status'] == 'cari') {
															} else {
														?>
							        			<button type="button" class="btn btn-success button-cus tombolTambahData" data-bs-toggle="modal" data-bs-target="#exampleModal">
								        		Tambah Data
													  <span class="material-symbols-outlined but-add">
														add_circle
														</span>
														</button>
														<?php } ?>
														<div class="dropdown">
														  <button class="btn btn-warning button-cus dropdown-togglea" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														    Simpan Data
														    <span class="material-symbols-outlined but-add">
																table_view
																</span>
														  </button>
														  <ul class="dropdown-menu">
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/datadata/excelA/pelaksanaan">Simpan Excel</a></li>
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/datadata/cetakA/pelaksanaan">Simpan PDF</a></li>
														  </ul>
														</div>
							        		</div>
							        		<div class="col-4">
							        		<!-- <form class="d-flex" role="search" action="<?= BASEURL; ?>/<?= $data['control'] ?>/cariA/<?= $data['hal'] ?>" method="POST">
										      	<div class="input-group mb-3">
												  	<input type="text" class="form-control" name="surat" placeholder="Masukkan Nomer Surat" aria-describedby="button-addon2" autocomplete="off" required>
													  <button class="btn btn-primary minimize" type="submit" id="button-addon2">
													  	<span class="material-symbols-outlined">
															search
															</span>
													  </button>
												</div>
										    </form> -->
							        		</div>										
							        	</div>
						        	</div>
						        	<table class="table table-striped table-hover text-start">
									  <thead class="color-style">
									    <tr>
									    <div class="row">
									      <th scope="col" style="width: 5%;">No</th>
									      <th scope="col" style="width: 10%;">Job</th>
									      <th scope="col" style="width: 10%;">Surat</th>
									      <th scope="col" style="width: 5%;">Pelakasaan</th>
									      <th scope="col" style="width: 5%;">User</th>
									      <th scope="col" style="width: 15%;">Uraian</th>
									      <th scope="col" style="width: 5%;">Vol</th>
									      <th scope="col" style="width: 10%;">satuan</th>
									      <th scope="col" style="width: 10%;">Total(10%)</th>
									      <th scope="col" style="width: 5%;">Status</th>
									      <th scope="col" style="width: 20%;">Aksi</th>
									    </div>
									    </tr>
									  </thead>
									  <tbody>
									  	<?php
											function rupiah($angka){
												
												$hasil_rupiah = number_format($angka,0,',','.');
												return $hasil_rupiah;
											 
											}
									  		$no = $data['urut']+1;
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
									      <td class="style-font"><?= $job?></td>
									      <td class="style-font"><?= substr($tag['surat'], 0, 10) ?>..</td>
									      <td class="style-font"><?= $tag['tgl_pel']?></td>
									      <td class="style-font"><?= substr($tag['perusahaan'], 0, 5) ?>..</td>
									      <td class="style-font"><?= substr($tag['uraian'], 0, 15)?>..</td>
									      <td class="style-font"><?= rupiah($tag['jml_peserta']) ?></td>
									      <td class="style-font"><?= rupiah($tag['satuan']) ?></td>
									      <td class="style-font"><?= rupiah($tag['total']) ?></td>
									      <td class="style-font"><?= substr($tag['status'], 0, 15) ?></td>
									      <td>
											<!-- Button trigger modal -->
											<a href="<?= BASEURL; ?>/datadata/editA/<?= $tag['id_data'] ?>" type="button" class="btn btn-primary minimize tampilModalLaksana" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?=$tag['id_data']; ?>" data-tab="data_<?= $job ?>">
											  <span class="material-symbols-outlined icon-cus">
												edit
												</span>
											</a>
											<a href="<?= BASEURL; ?>/datadata/hapusA/<?= $job ?>/<?= $tag['id_data'] ?>" class="btn btn-danger minimize" onclick=" return confirm('Yakin hapus?');">
											  <span class="material-symbols-outlined icon-cus">
												delete
												</span>
											</a>
											<a href="<?= BASEURL; ?>/datadata/cetakD/data_<?= $job ?>/<?= $tag['id_data'] ?>" class="btn btn-warning minimize">
											  <span class="material-symbols-outlined icon-cus">
												description
												</span>
											</a>
									      </td>
									    </tr>
									    <?php 
									    	}
									    }
									     ?>
									  </tbody>
									</table>
									<?php 
										if ($data['status'] == 'cari') {
										} else {
									 ?>
									<div class="d-flex justify-content-center">									
								      <nav aria-label="Page navigation example">
											  <ul class="pagination cus-pagie">
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "disabled";?>"  href="<?= BASEURL; ?>/tagihan/asesmen/<?= $data['urut']-$data['tamp']; ?>">
											    		Previous
											    	</a>
											  	</li>
											  	<li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "active";?>" href="<?= BASEURL; ?>/tagihan/asesmen/">1
											    	</a>
											    </li>
											  	<?php
											  		$awalA = $data['tamp'];
											  		$awal = $data['tamp'];
											  		for ($i=2; $i < ($data['limit']+1) ; $i++) {
											  	?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($awal == $data['urut']) echo "active";?>" href="<?= BASEURL; ?>/tagihan/asesmen/<?= $awal; ?>"><?=$i ?>
											    	</a>
											    </li>
											    <?php 
											    		$awal = $awal+$awalA;
											    	}
											     ?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] == ($awal-$data['tamp'])) echo "disabled";?>" href="<?= BASEURL; ?>/tagihan/asesmen/<?= $data['urut']+$data['tamp']; ?>">Next
											    	</a>
											    </li>
											  </ul>
											</nav>
									</div>
									<?php 
										}
									 ?>
						      </div>
							  <div class="card-footer text-center">
							      <small class="text-muted">Sistem Infomasi Universitas Trunojoyo Madura</small>
							  </div>
						    </div>
						  </div>

					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 detail-font" id="exampleModalLabel">Tambah <?= $data['judul']; ?></h1>
      </div>
      <form action="<?= BASEURL; ?>/datadata/tambahA" method="POST">
      <input type="hidden" name="view" id="view" value="data_konsultan">
      <input type="hidden" name="tab" id="tab" value="data_konsultan" onchange="total()">
      <input type="hidden" name="id" id="id">
      <div class="modal-body">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="surat" id="surat" placeholder="Surat">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Tanggal Dokumen</span>
					  <input type="date" class="form-control" name="tgl_dok" id="tgl_dok" placeholder="Tanggal Dokumen">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Tanggal Pelaksana</span>
					  <input type="date" class="form-control" name="tgl_pel" id="tgl_pel" placeholder="Tanggal Dokumen">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="PIC" id="PIC" placeholder="PIC">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="vendor" id="vendor" placeholder="User">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="ks" id="ks" placeholder="Vendor Kerjasama">
					</div>
					<div class="input-group mb-3">
					  <input type="textbox" class="form-control" name="urai" id="urai" placeholder="Uraian">
					</div>
					<div class="input-group mb-3">
					  <input type="textbox" class="form-control" name="tag" id="tag" placeholder="Nomer Tagihan">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Jumlah Peserta</span>
					  <input type="number" class="form-control" id="jumlah_vol"  value="" placeholder="Volume" name="volume" onchange="totad()">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Satuan Rp. </span>
					  <input type="number" class="form-control" id="jumlah_satuan" value="" placeholder="Satuan" name="satuan" onchange="totad()">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Biaya Tamabahan Rp.</span>
					  <input type="number" class="form-control" id="jumlah_biayat" value="" placeholder="Biaya Tambahan" name="jumlah_biayat" onchange="totad()">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Total(non pajak)</span>
					  <input type="number" class="form-control" name="jml_sb" value="0" id="jml_sb" readonly>
					  <span class="input-group-text" id="addon-wrapping">Pajak</span>
					  <input type="number" class="form-control" name="jml_ttl_pjk" value="0" id="jml_ttl_pjk" readonly>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Jumlah Total</span>
					  <input type="number" class="form-control" name="jml_ttl" value="0" id="jml_ttl" readonly>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Status Pengerjaan</span>
					  <select class="form-select" name="status" aria-label="Default select example" id="pengerjaan">
						  <option value="SELESAI">SELESAI</option>
						  <option value="BELUM" selected>BELUM</option>
						</select>
					</div>	
      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
	        <button type="submit" class="btn btn-primary">Tambah</button>
	      </div>
      </form>
    </div>
  </div>
</div>