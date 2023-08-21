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
							        			<button type="button" class="btn btn-success button-cus tombolTambahPsi" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/datadata/excelA/data_psikotes">Simpan Excel</a></li>
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/datadata/cetakA/data_psikotes">Simpan PDF</a></li>
														  </ul>
														</div>
													<?php } ?>
							        		</div>
							        		<div class="col-4">
							        		<form class="d-flex" role="search" action="<?= BASEURL; ?>/datadata/cariA/data_psikotes" method="POST">
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
									      <th scope="col" style="width: 5%;">PIC</th>
									      <th scope="col" style="width: 10%;">Asesi</th>
									      <th scope="col" style="width: 10%;">Pelaksaan</th>
									      <th scope="col" style="width: 10%;">Asesor</th>
									      <th scope="col" style="width: 10%;">Tester</th>
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
									      <td class="style-font"><?= $tag['perusahaan'] ?></td>
									      <td class="style-font"><?= substr($tag['surat'], 0, 15) ?>...</td>
									      <td class="style-font"><?= substr($tag['PIC'], 0, 15) ?></td>
									      <td class="style-font"><?= substr($tag['asesi'], 0, 15) ?>..</td>
									      <td class="style-font"><?= $tag['tgl_pel']?></td>
									      <td class="style-font"><?= substr($tag['asesor'], 0, 15)?>..</td>
									      <td class="style-font"><?= substr($tag['tester'], 0, 20) ?></td>
									      <td>
											<!-- Button trigger modal -->
											<a href="<?= BASEURL; ?>/datadata/editA/<?= $tag['id_data'] ?>" type="button" class="btn btn-primary minimize tampilModalPsi" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?=$tag['id_data']; ?>" data-tab="data_psikotes">
											  <span class="material-symbols-outlined icon-cus">
												edit
												</span>
											</a>
											<a href="<?= BASEURL; ?>/datadata/hapusA/data_psikotes/<?= $tag['id_data'] ?>" class="btn btn-danger minimize" onclick="return confirm('Yakin hapus?');">
											  <span class="material-symbols-outlined icon-cus">
												delete
												</span>
											</a>
											<a href="<?= BASEURL; ?>/datadata/cetakD/data_psikotes/<?= $tag['id_data'] ?>" class="btn btn-warning minimize">
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
										    	<li><a class="dropdown-item" href="<?= BASEURL; ?>/datadata/data_psikotes/0">20</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/datadata/data_psikotes/0/50">50</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/datadata/data_psikotes/0/100">100</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/datadata/data_psikotes/0/200">200</a></li>
										    </ul>
										  </div>
									  </div>


									  <div class="p-2">
									  	<nav aria-label="Page navigation example">
											  <ul class="pagination cus-pagie">
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "disabled";?>"  href="<?= BASEURL; ?>/datadata/data_psikotes/<?= $data['urut']-$data['tamp']; ?>/<?= $data['tamp']; ?>">
											    		Previous
											    	</a>
											  	</li>
											  	<li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "active";?>" href="<?= BASEURL; ?>/datadata/data_psikotes/0/<?= $data['tamp']; ?>">1
											    	</a>
											    </li>
											  	<?php
											  		$awalA = $data['tamp'];
											  		$awal = $data['tamp'];
											  		for ($i=2; $i < ($data['limit']+1) ; $i++) {
											  	?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($awal == $data['urut']) echo "active";?>" href="<?= BASEURL; ?>/datadata/data_psikotes/<?= $awal; ?>/<?= $data['tamp']; ?>"><?=$i ?>
											    	</a>
											    </li>
											    <?php 
											    		$awal = $awal+$awalA;
											    	}
											     ?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] == ($awal-$data['tamp'])) echo "disabled";?>" href="<?= BASEURL; ?>/datadata/data_psikotes/<?= $data['urut']+$data['tamp']; ?>/<?= $data['tamp']; ?>">Next
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
        <div class="form-check form-switch">
        	<div class="form-check form-switch">
					  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
					  <label class="form-check-label" for="flexSwitchCheckDefault">Status Pelaksanaan</label>
					</div>
				</div>
      </div>
      <form action="<?= BASEURL; ?>/datadata/tambahA" method="POST">
      <input type="hidden" name="view" id="view" value="data_psikotes">
      <input type="hidden" name="tab" id="tab" value="data_psikotes">
      <input type="hidden" name="id" id="id">
      <div class="modal-body">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="vendor" id="vendor" placeholder="Vendor">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="surat" id="surat" placeholder="Surat">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Tanggal Dokumen</span>
					  <input type="date" class="form-control" name="tgl_dok" id="tgl_dok" placeholder="Tanggal Dokumen">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="PIC" id="PIC" placeholder="PIC">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="asesi" id="asesi" placeholder="Asesi">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="addon-wrapping">Tanggal Pelaksana</span>
					  <input type="date" class="form-control" name="tgl_pel" id="tgl_pel" placeholder="Tanggal Pelaksana">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="tester" id="tester" placeholder="Tester">
					</div>
					<div class="input-group mb-3">
					  <input type="textbox" class="form-control" name="asesor" id="asesor" placeholder="Asesor">
					</div>
					<div class="input-group mb-3">
					  <input type="textbox" class="form-control" name="transp_pulsa" id="transp_pulsa" placeholder="Transport Pulsa">
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