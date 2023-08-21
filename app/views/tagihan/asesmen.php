		<div class="row">
			<div class="col-3">		
			</div>
			<div class="col-9 up-to-up">
				<div class="container up-to">
					<div class="row align-items-center">
						  <div class="col">
						    <div class="card">
						      <div class="card-body">
						        <h5 class="card-title">Tagihan <?= $data['judul']; ?></h5>
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
														<div class="dropdown">
														  <button class="btn btn-warning button-cus dropdown-togglea" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														    Simpan Data
														    <span class="material-symbols-outlined but-add">
																table_view
																</span>
														  </button>
														  <ul class="dropdown-menu">
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/tagihan/excelA/tagihan_asesmen">Simpan Excel</a></li>
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/tagihan/cetakA/tagihan_asesmen">Simpan PDF</a></li>
														  </ul>
														</div>
													<?php } ?>
							        		</div>
							        		<div class="col-4">
							        		<form class="d-flex" role="search" action="<?= BASEURL; ?>/tagihan/cariA/asesmen" method="POST">
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
									      <th scope="col" style="width: 10%;">Satuan</th>
									      <th scope="col" style="width: 10%;">Jumlah</th>
									      <th scope="col" style="width: 10%;">Tenggat</th>
									      <th scope="col" style="width: 10%;">Pembayaran</th>
									      <th scope="col" style="width: 15%;">Aksi</th>
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
									  		foreach ($data['tagihan'] as $tag) {
									  	 ?>
									    <tr>
									      <th scope="row"><?= $no; $no++; ?></th>
									      <td class="style-font"><?= $tag['perusahaan'] ?></td>
									      <td class="style-font"><?= substr($tag['surat'], 0, 20) ?>...</td>
									      <td class="style-font"><?= $tag['volume'] ?></td>
									      <td class="style-font"><?= rupiah($tag['satuan']) ?></td>
									      <td class="style-font"><?= rupiah($tag['jumlah_blm_pjk'])?></td>
									      <td class="style-font"><?= $tag['tgl_lunas']?></td>
									      <td class="style-font"><?= substr($tag['status'], 0, 11) ?></td>
									      <td>
											<!-- Button trigger modal -->
											<a href="<?= BASEURL; ?>/tagihan/editA/<?= $tag['id_tagihan'] ?>" type="button" class="btn btn-primary minimize tampilModalUbah" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?=$tag['id_tagihan']; ?>" data-tab="tagihan_asesmen">
											  <span class="material-symbols-outlined icon-cus">
												edit
												</span>
											</a>
											<a href="<?= BASEURL; ?>/tagihan/hapusA/asesmen/<?= $tag['id_tagihan'] ?>" class="btn btn-danger minimize" onclick="return confirm('Yakin hapus?');">
											  <span class="material-symbols-outlined icon-cus">
												delete
												</span>
											</a>
											<a href="<?= BASEURL; ?>/tagihan/cetakD/tagihan_asesmen/<?= $tag['id_tagihan'] ?>" class="btn btn-warning minimize">
											  <span class="material-symbols-outlined icon-cus">
												description
												</span>
											</a>
									      </td>
									    </tr>
									    <?php 
									    	}
									     ?>
									  </tbody>
									</table>
									<?php 
										if ($data['status'] == 'cari') {
										} else {
									 ?>
									<div class="d-flex mb-3">
									  <div class="me-auto p-2">
									  	<div class="btn-group btn-group-sm" aria-label="Small button group" role="group">
										    <button type="button" class="btn btn-secondary" disabled>
										      Show entries
										    </button>
										    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
										      <?=$data['tamp'] ?>
										    </button>
										    <ul class="dropdown-menu width-cus">
										    	<li><a class="dropdown-item" href="<?= BASEURL; ?>/tagihan/asesmen/0">20</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/tagihan/asesmen/0/50">50</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/tagihan/asesmen/0/100">100</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/tagihan/asesmen/0/200">200</a></li>
										    </ul>
										  </div>
									  </div>


									  <div class="p-2">
									  	<nav aria-label="Page navigation example">
											  <ul class="pagination cus-pagie">
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "disabled";?>"  href="<?= BASEURL; ?>/tagihan/asesmen/<?= $data['urut']-$data['tamp']; ?>/<?= $data['tamp']; ?>">
											    		Previous
											    	</a>
											  	</li>
											  	<li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "active";?>" href="<?= BASEURL; ?>/tagihan/asesmen/0/<?= $data['tamp']; ?>">1
											    	</a>
											    </li>
											  	<?php
											  		$awalA = $data['tamp'];
											  		$awal = $data['tamp'];
											  		for ($i=2; $i < ($data['limit']+1) ; $i++) {
											  	?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($awal == $data['urut']) echo "active";?>" href="<?= BASEURL; ?>/tagihan/asesmen/<?= $awal; ?>/<?= $data['tamp']; ?>"><?=$i ?>
											    	</a>
											    </li>
											    <?php 
											    		$awal = $awal+$awalA;
											    	}
											     ?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] == ($awal-$data['tamp'])) echo "disabled";?>" href="<?= BASEURL; ?>/tagihan/asesmen/<?= $data['urut']+$data['tamp']; ?>/<?= $data['tamp']; ?>">Next
											    	</a>
											    </li>
											  </ul>
											</nav>
									  </div>
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
        <h1 class="modal-title fs-5 detail-font" id="exampleModalLabel">Tambah Data <?= $data['judul']; ?></h1>
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
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Tanggal Pelunasan</span>
					  <input type="date" class="form-control" name="tgl_lunas" id="tgl_lunas" placeholder="Tanggal Pelunasan">
					</div>					
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Status Pelunasan</span>
					  <select class="form-select" name="status_lunas" aria-label="Default select example">
						  <option value="LUNAS">LUNAS</option>
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