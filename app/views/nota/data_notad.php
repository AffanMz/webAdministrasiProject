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
							        			<div class="col">
							        			<button type="button" class="btn btn-success button-cus tombolTambahNot" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/datadata/excelA/data_notad">Simpan Excel</a></li>
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/datadata/cetakA/data_notad">Simpan PDF</a></li>
														  </ul>
														</div>
							        		</div>
							        	<?php } ?>
							        		</div>
							        		<div class="col-4">
							        		<form class="d-flex" role="search" action="<?= BASEURL; ?>/nota/cariA/data_notad" method="POST">
										      	<div class="input-group mb-3">
												  	<input type="text" class="form-control" name="surat" placeholder="Masukkan Nomer Nota" aria-describedby="button-addon2" autocomplete="off" required>
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
									      <th scope="col" style="width: 10%;">Nomer NDUM</th>
									      <th scope="col" style="width: 10%;">Pengajuan</th>
									      <th scope="col" style="width: 5%;">Uraian</th>
									      <th scope="col" style="width: 10%;">Nominal</th>
									      <th scope="col" style="width: 10%;">Nilai LPJ</th>
									      <th scope="col" style="width: 10%;">No JJK</th>
									      <th scope="col" style="width: 10%;">Status</th>
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
									  		foreach ($data['data'] as $tag) {
									  	 ?>
									    <tr>
									      <th scope="row"><?= $no; $no++; ?></th>
									      <td class="style-font"><?= substr($tag['no_ndum'], 0, 15) ?></td>
									      <td class="style-font"><?= $tag['tgl_ajuan'] ?></td>
									      <td class="style-font"><?= substr($tag['uraian'], 0, 17) ?>..</td>
									      <td class="style-font"><?= rupiah($tag['nominal']) ?></td>
									      <td class="style-font"><?= rupiah($tag['nilai_lpj'])?></td>
									      <td class="style-font"><?= substr($tag['no_jjk'], 0, 15)?>..</td>
									      <td class="style-font"><?= substr($tag['status'], 0, 15) ?></td>
									      <td>
											<!-- Button trigger modal -->
											<a href="<?= BASEURL; ?>/nota/editA/<?= $tag['id_data'] ?>" type="button" class="btn btn-primary minimize tampilModalNot" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?=$tag['id_data']; ?>" data-tab="data_notad">
											  <span class="material-symbols-outlined icon-cus">
												edit
												</span>
											</a>
											<a href="<?= BASEURL; ?>/nota/hapusA/data_notad/<?= $tag['id_data'] ?>" class="btn btn-danger minimize" onclick="return confirm('Yakin hapus?');">
											  <span class="material-symbols-outlined icon-cus">
												delete
												</span>
											</a>
											<a href="<?= BASEURL; ?>/nota/cetakD/data_notad/<?= $tag['id_data'] ?>" class="btn btn-warning minimize">
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
										    	<li><a class="dropdown-item" href="<?= BASEURL; ?>/nota/data_notad/0">20</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/nota/data_notad/0/50">50</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/nota/data_notad/0/100">100</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/nota/data_notad/0/200">200</a></li>
										    </ul>
										  </div>
									  </div>


									  <div class="p-2">
									  	<nav aria-label="Page navigation example">
											  <ul class="pagination cus-pagie">
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "disabled";?>"  href="<?= BASEURL; ?>/nota/data_notad/<?= $data['urut']-$data['tamp']; ?>/<?= $data['tamp']; ?>">
											    		Previous
											    	</a>
											  	</li>
											  	<li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "active";?>" href="<?= BASEURL; ?>/nota/data_notad/0/<?= $data['tamp']; ?>">1
											    	</a>
											    </li>
											  	<?php
											  		$awalA = $data['tamp'];
											  		$awal = $data['tamp'];
											  		for ($i=2; $i < ($data['limit']+1) ; $i++) {
											  	?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($awal == $data['urut']) echo "active";?>" href="<?= BASEURL; ?>/nota/data_notad/<?= $awal; ?>/<?= $data['tamp']; ?>"><?=$i ?>
											    	</a>
											    </li>
											    <?php 
											    		$awal = $awal+$awalA;
											    	}
											     ?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] == ($awal-$data['tamp'])) echo "disabled";?>" href="<?= BASEURL; ?>/nota/data_notad/<?= $data['urut']+$data['tamp']; ?>/<?= $data['tamp']; ?>">Next
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
      <form action="<?= BASEURL; ?>/nota/tambahA" method="POST">
      <input type="hidden" name="view" id="view" value="data_notad">
      <input type="hidden" name="tab" id="tab" value="data_notad">
      <input type="hidden" name="id" id="id">
      <div class="modal-body">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="no_ndum" id="no_ndum" placeholder="NO ND UM">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Tanggal Pengajuan</span>
					  <input type="date" class="form-control" name="tgl_ajuan" id="tgl_ajuan" placeholder="Tanggal Dokumen">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="uraian" id="uraian" placeholder="Uraian">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Tanggal Pelaksana</span>
					  <input type="date" class="form-control" name="tgl_pel" id="tgl_pel" placeholder="Tanggal Dokumen">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Nominal Rp. </span>
					  <input type="number" class="form-control" id="nominal" value="" placeholder="Satuan" name="nominal" >
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Nilai LPJ Rp. </span>
					  <input type="number" class="form-control" id="nilai_lpj" value="" placeholder="Satuan" name="nilai_lpj" >
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Profit</span>
					  <input type="number" class="form-control" id="profit" value="" placeholder="Satuan" name="profit" >
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="no_jjk" id="no_jjk" placeholder="Nomer JJK">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="no_lpjum" id="no_lpjum" placeholder="No LPJUM">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Tanggal LPJ</span>
					  <input type="date" class="form-control" name="tgl_lpj" id="tgl_lpj" placeholder="Tanggal LPJ">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="PIC" id="PIC" placeholder="PIC">
					</div>
					<div class="input-group mb-3">
					  <input type="textbox" class="form-control" name="bukti_trans" id="bukti_trans" placeholder="Bukti Transfer">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Status</span>
					  <select class="form-select" name="status" aria-label="Default select example">
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