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
							        			<!-- <button type="button" class="btn btn-success button-cus tombolTambahData" data-bs-toggle="modal" data-bs-target="#exampleModal">
								        		Tambah Data
													  <span class="material-symbols-outlined but-add">
														add_circle
														</span>
														</button>
														<a href="<?= BASEURL; ?>/tagihan/cetakA/tagihan_asesmen" class="btn btn-warning button-cus">
								        		Cetak laporan
													  <span class="material-symbols-outlined but-add">
														print
														</span> -->
														</a>
							        		</div>
							        		<div class="col-4">
							        		<form class="d-flex" role="search" action="<?= BASEURL; ?>/<?= $data['control'] ?>/cariA/<?= $data['hal'] ?>" method="POST">
										      	<div class="input-group mb-3">
												  	<input type="text" class="form-control" name="surat" placeholder="Masukkan Nomer Surat" aria-describedby="button-addon2" autocomplete="off" required>
													  <button class="btn btn-primary minimize" type="submit" id="button-addon2">
													  	<span class="material-symbols-outlined">
															search
															</span>
													  </button>
												</div>
										    </form>
							        		</div>										
							        	</div>
						        	</div>
						        	<table class="table table-striped table-hover text-start">
									  <thead class="color-style">
									    <tr>
									    <div class="row">
									      <th scope="col" style="width: 5%;">No</th>
									      <th scope="col" style="width: 10%;">Vendor</th>
									      <th scope="col" style="width: 10%;">Surat</th>
									      <th scope="col" style="width: 5%;">Vol</th>
									      <th scope="col" style="width: 10%;">KU</th>
									      <th scope="col" style="width: 15%;">Aksi</th>
									    </div>
									    </tr>
									  </thead>
									  <tbody>
									  </tbody>
									</table>
									<h5 style="text-align: center" >
										Data tidak ditemukan
										<a  style="text-align: center; font-size: 15px;"  href="<?= BASEURL; ?>/<?= $data['control'] ?>/<?= $data['hal'] ?>"><i>klik disini</i></a>
										untuk kembali
									</h5>
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
        <div class="form-check form-switch">
        	<div class="form-check form-switch">
					  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
					  <label class="form-check-label" for="flexSwitchCheckDefault">Status Pelaksanaan</label>
					</div>
				</div>
      </div>
      <form action="<?= BASEURL; ?>/tagihan/tambahA" method="POST">
      <input type="hidden" name="view" id="view" value="asesmen">
      <input type="hidden" name="tab" id="tab" value="tagihan_asesmen">
      <input type="hidden" name="id" id="id">
      <div class="modal-body">
       		<div class="input-group mb-3">
					  <input type="text" class="form-control" name="vendor" id="vendor" placeholder="Vendor">
					</div>
       		<div class="input-group mb-3">
					  <input type="text" class="form-control" name="surat" id="surat" placeholder="Surat">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="ku" id="ku" placeholder="Nomer KU">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Volume</span>
					  <input type="number" class="form-control" id="jumlah_vol"  value="" placeholder="Satuan" name="volume" onchange="total()">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Satuan</span>
					  <input type="number" class="form-control" id="jumlah_satuan" value="" placeholder="Volume" name="satuan" onchange="total()">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Total (non pajak)</span>
					  <input type="number" name="jml_sb" class="form-control" value="0" id="jml_sb" readonly>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">PPN</span>
					  <input type="number" class="form-control" name="jml_ppn" value="0" id="jml_ppn" readonly>
					  <span class="input-group-text" id="addon-wrapping">Total + PPN</span>
					  <input type="number" class="form-control" name="jml_ttl_ppn" value="0" id="jml_ttl_ppn" readonly>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">PPH</span>
					  <input type="number" class="form-control" name="jml_pph" value="0" id="jml_pph" readonly>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Jumlah Total</span>
					  <input type="number" class="form-control" name="jml_ttl" value="0" id="jml_ttl" readonly>
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