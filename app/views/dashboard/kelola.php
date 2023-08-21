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
							        			<button type="button" class="btn btn-success button-cus tombolTambahUser" data-bs-toggle="modal" data-bs-target="#exampleModal">
								        		Tambah Data
													  <span class="material-symbols-outlined but-add">
														add_circle
														</span>
														</button>
														<!-- <div class="dropdown">
														  <button class="btn btn-warning button-cus dropdown-togglea" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														    Simpan Data
														    <span class="material-symbols-outlined but-add">
																table_view
																</span>
														  </button>
														  <ul class="dropdown-menu">
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/datadata/excelA/data_user">Simpan Excel</a></li>
														    <li><a class="dropdown-item font-style-2" href="<?= BASEURL; ?>/datadata/cetakA/data_user">Simpan PDF</a></li>
														  </ul>
														</div> -->
							        		</div>
							        		<div class="col-4">
							        		<!-- <form class="d-flex" role="search" action="<?= BASEURL; ?>/datadata/cariA/data_user" method="POST">
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
									      <th scope="col" style="width: 10%;">Nama</th>
									      <th scope="col" style="width: 10%;">Username</th>
									      <th scope="col" style="width: 5%;">Password</th>
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
									  		$no = 1;
									  		foreach ($data['data'] as $tag) {
									  	 ?>
									    <tr>
									      <th scope="row"><?= $no; $no++; ?></th>
									      <td class="style-font"><?= substr($tag['nama'], 0, 15) ?></td>
									      <td class="style-font"><?= $tag['username'] ?></td>
									      <td class="style-font"><?= md5(substr($tag['pass'], 0, 15)) ?></td>
									      <td>
											<!-- Button trigger modal -->
											<a href="<?= BASEURL; ?>/dashboard/editA/<?= $tag['id_admin'] ?>" type="button" class="btn btn-primary minimize tampilModalUser" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?=$tag['id_admin']; ?>" data-tab="data_user">
											  <span class="material-symbols-outlined icon-cus">
												edit
												</span>
											</a>
											<a href="<?= BASEURL; ?>/dashboard/hapusA/data_user/kelola/<?= $tag['id_admin'] ?>" class="btn btn-danger minimize" onclick="return confirm('Yakin hapus?');">
											  <span class="material-symbols-outlined icon-cus">
												delete
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
										    	<li><a class="dropdown-item" href="<?= BASEURL; ?>/datadata/data_user/0">20</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/datadata/data_user/0/50">50</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/datadata/data_user/0/100">100</a></li>
										      <li><a class="dropdown-item" href="<?= BASEURL; ?>/datadata/data_user/0/200">200</a></li>
										    </ul>
										  </div>
									  </div>


									  <div class="p-2">
									  	<nav aria-label="Page navigation example">
											  <ul class="pagination cus-pagie">
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "disabled";?>"  href="<?= BASEURL; ?>/datadata/data_user/<?= $data['urut']-$data['tamp']; ?>/<?= $data['tamp']; ?>">
											    		Previous
											    	</a>
											  	</li>
											  	<li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] < $data['tamp']) echo "active";?>" href="<?= BASEURL; ?>/datadata/data_user/0/<?= $data['tamp']; ?>">1
											    	</a>
											    </li>
											  	<?php
											  		$awalA = $data['tamp'];
											  		$awal = $data['tamp'];
											  		for ($i=2; $i < ($data['limit']+1) ; $i++) {
											  	?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($awal == $data['urut']) echo "active";?>" href="<?= BASEURL; ?>/datadata/data_user/<?= $awal; ?>/<?= $data['tamp']; ?>"><?=$i ?>
											    	</a>
											    </li>
											    <?php 
											    		$awal = $awal+$awalA;
											    	}
											     ?>
											    <li class="page-item">
											    	<a class="page-link <?php if ($data['urut'] == ($awal-$data['tamp'])) echo "disabled";?>" href="<?= BASEURL; ?>/datadata/data_user/<?= $data['urut']+$data['tamp']; ?>/<?= $data['tamp']; ?>">Next
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
      <form action="<?= BASEURL; ?>/datadata/tambahA" method="POST">
      <input type="hidden" name="view" id="view" value="kelola">
      <input type="hidden" name="tab" id="tab" value="data_user">
      <input type="hidden" name="id" id="id">
      <div class="modal-body">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
					</div>
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="username" id="username" placeholder="Username">
					</div>
					<div class="input-group mb-3">
					  <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
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