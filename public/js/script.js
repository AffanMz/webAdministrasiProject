$(function(){

	$('.tombolTambahData').on('click', function(){

		$('#exampleModalLabel').html('Tambah Data Tagihan');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/tagihan/tambahA');
		$('#vendor').val('');
		$('#surat').val('');
		$('#ku').val('');
		$('#jumlah_satuan').val('');
		$('#jumlah_vol').val('');
		$('#jml_sb').val('');
		$('#jml_ppn').val('');
		$('#jml_ttl_ppn').val('');
		$('#jml_pph').val('');
		$('#jml_ttl').val('');
		$('#tgl_lunas').val('');
		$('#status_lunas').val('');



	})

	$('.tampilModalUbah').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data Tagihan');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/tagihan/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');


		$.ajax({
			url: 'http://localhost/pds_web/public/tagihan/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#vendor').val(data.perusahaan);
				$('#surat').val(data.surat);
				$('#ku').val(data.no_ku);
				$('#jumlah_satuan').val(data.satuan);
				$('#jumlah_vol').val(data.volume);
				$('#jml_sb').val(data.jumlah_blm_pjk);
				$('#jml_ppn').val(data.ppn);
				$('#jml_ttl_ppn').val(data.total_ppn);
				$('#jml_pph').val(data.pph);
				$('#jml_ttl').val(data.total_pph);
				$('#tgl_lunas').val(data.tgl_lunas);
				$('#status_lunas').val(data.status);
				$('#id').val(data.id_tagihan);



			}
		})

	});

// <=============================BATAS========================>
// <=============================BATAS========================>
// <=============================BATAS========================>


	$('.tombolTambahDik').on('click', function(){

		$('#exampleModalLabel').html('Tambah Data Tagihan');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/tagihan/tambahA');
		$('#vendor').val('');
		$('#surat').val('');
		$('#urai').val('');
		$('#ku').val('');
		$('#jumlah_satuan').val('');
		$('#jumlah_vol').val('');
		$('#jml_sb').val('');
		$('#jml_ppn').val('');
		$('#jml_ttl_ppn').val('');
		$('#jml_pph').val('');
		$('#jml_ttl').val('');
		$('#tgl_lunas').val('');
		$('#status_lunas').val('');		


	})

	$('.tampilModalDik').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data Tagihan');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/tagihan/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');


		$.ajax({
			url: 'http://localhost/pds_web/public/tagihan/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#vendor').val(data.perusahaan);
				$('#surat').val(data.surat);
				$('#urai').val(data.uraian);
				$('#ku').val(data.no_ku);
				$('#jumlah_satuan').val(data.satuan);
				$('#jumlah_vol').val(data.volume);
				$('#jml_sb').val(data.jumlah_blm_pjk);
				$('#jml_ppn').val(data.ppn);
				$('#jml_ttl_ppn').val(data.total_ppn);
				$('#jml_pph').val(data.pph);
				$('#jml_ttl').val(data.total_pph);
				$('#tgl_lunas').val(data.tgl_lunas);
				$('#status_lunas').val(data.status);				
				$('#id').val(data.id_tagihan);



			}
		})

	});

// <=============================BATAS========================>
// <=============================BATAS========================>
// <=============================BATAS========================>

	$('.tombolTambahKon').on('click', function(){

		$('#exampleModalLabel').html('Tambah Data');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/datadata/tambahA');
		
		$('#surat').val('');
		$('#tgl_dok').val('');
		$('#tgl_pel').val('');
		$('#PIC').val('');
		$('#vendor').val('');
		$('#ks').val('');
		$('#urai').val('');
		$('#tag').val('');
		$('#jumlah_vol').val('');
		$('#jumlah_satuan').val('');
		$('#jumlah_biayat').val('');
		$('#jml_sb').val('');
		$('#jml_ttl_pjk').val('');
		$('#jml_ttl').val('');
		$('#inlineRadio').val('');


	})

	$('.tampilModalKon').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/datadata/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');


		$.ajax({
			url: 'http://localhost/pds_web/public/datadata/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#surat').val(data.surat);
				$('#tgl_dok').val(data.tgl_dok);
				$('#tgl_pel').val(data.tgl_pel);
				$('#PIC').val(data.PIC);
				$('#vendor').val(data.perusahaan);
				$('#ks').val(data.vendor_ks);
				$('#urai').val(data.uraian);
				$('#tag').val(data.no_tag);
				$('#jumlah_vol').val(data.jml_peserta);
				$('#jumlah_satuan').val(data.satuan);
				$('#jumlah_biayat').val(data.biaya_tambah);
				$('#jml_sb').val(data.ttl_blm_pjk);
				$('#jml_ttl_pjk').val(data.pjk);
				$('#jml_ttl').val(data.total);
				$('#inlineRadio').val(data.status);
				$('#id').val(data.id_data);



			}
		})

	});


// <=============================BATAS========================>
// <=============================BATAS========================>
// <=============================BATAS========================>

	$('.tombolTambahAss').on('click', function(){

		$('#exampleModalLabel').html('Tambah Data');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/datadata/tambahA');
		
		$('#surat').val('');
		$('#tgl_dok').val('');
		$('#tgl_pel').val('');
		$('#PIC').val('');
		$('#vendor').val('');
		$('#asesi').val('');
		$('#asesor_ass').val('');
		$('#asesor_bid').val('');
		$('#asesor_feed').val('');
		$('#rp').val('');
		$('#transp_pulsa').val('');


	})

	$('.tampilModalAss').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/datadata/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');

		$.ajax({
			url: 'http://localhost/pds_web/public/datadata/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#surat').val(data.surat);
				$('#tgl_dok').val(data.tgl_dok);
				$('#tgl_pel').val(data.tgl_pel);
				$('#PIC').val(data.PIC);
				$('#vendor').val(data.perusahaan);
				$('#asesi').val(data.asesi);
				$('#asesor_ass').val(data.asesor_ass);
				$('#asesor_bid').val(data.asesor_bid);
				$('#asesor_feed').val(data.asesor_feed);
				$('#rp').val(data.rp);
				$('#transp_pulsa').val(data.transp_pulsa);
				$('#id').val(data.id_data);
			}
		})

	});

// <=============================BATAS========================>
// <=============================BATAS========================>
// <=============================BATAS========================>

	$('.tombolTambahPsi').on('click', function(){

		$('#exampleModalLabel').html('Tambah Data');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/datadata/tambahA');
		
		$('#surat').val('');
		$('#tgl_dok').val('');
		$('#tgl_pel').val('');
		$('#PIC').val('');
		$('#vendor').val('');
		$('#asesi').val('');
		$('#asesor').val('');
		$('#tester').val('');
		$('#transp_pulsa').val('');


	})

	$('.tampilModalPsi').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/datadata/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');

		$.ajax({
			url: 'http://localhost/pds_web/public/datadata/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#surat').val(data.surat);
				$('#tgl_dok').val(data.tgl_dok);
				$('#tgl_pel').val(data.tgl_pel);
				$('#PIC').val(data.PIC);
				$('#vendor').val(data.perusahaan);
				$('#asesi').val(data.asesi);
				$('#asesor').val(data.asesor);
				$('#tester').val(data.tester);
				$('#transp_pulsa').val(data.transp_pulsa);
				$('#id').val(data.id_data);
			}
		})

	});


// <=============================BATAS========================>
// <=============================BATAS========================>
// <=============================BATAS========================>

	$('.tombolTambahNot').on('click', function(){

		$('#exampleModalLabel').html('Tambah Data');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/nota/tambahA');
		
		$('#no_ndum').val('');
		$('#tgl_ajuan').val('');
		$('#tgl_pel').val('');
		$('#uraian').val('');
		$('#PIC').val('');
		$('#nominal').val('');
		$('#nilai_lpj').val('');
		$('#profit').val('');
		$('#status').val('');
		$('#no_jjk').val('');
		$('#no_lpjum').val('');
		$('#tgl_lpj').val('');
		$('#bukti_trans').val('');


	})

	$('.tampilModalNot').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/nota/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');

		$.ajax({
			url: 'http://localhost/pds_web/public/nota/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#no_ndum').val(data.no_ndum);
				$('#tgl_ajuan').val(data.tgl_ajuan);
				$('#tgl_pel').val(data.tgl_pel);
				$('#uraian').val(data.uraian);
				$('#PIC').val(data.PIC);
				$('#nominal').val(data.nominal);
				$('#nilai_lpj').val(data.nilai_lpj);
				$('#profit').val(data.profit);
				$('#status').val(data.status);
				$('#no_jjk').val(data.no_jjk);
				$('#no_lpjum').val(data.no_lpjum);
				$('#tgl_lpj').val(data.tgl_lpj);
				$('#bukti_trans').val(data.bukti_trans);
				$('#id').val(data.id_data);
			}
		})

	});

	$('.tampilModalLunas').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/tagihan/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');


		$.ajax({
			url: 'http://localhost/pds_web/public/tagihan/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#vendor').val(data.perusahaan);
				$('#surat').val(data.surat);
				$('#urai').val(data.uraian);
				$('#ku').val(data.no_ku);
				$('#jumlah_satuan').val(data.satuan);
				$('#jumlah_vol').val(data.volume);
				$('#jml_sb').val(data.jumlah_blm_pjk);
				$('#jml_ppn').val(data.ppn);
				$('#jml_ttl_ppn').val(data.total_ppn);
				$('#jml_pph').val(data.pph);
				$('#jml_ttl').val(data.total_pph);
				$('#tgl_lunas').val(data.tgl_lunas);
				$('#status_lunas').val(data.status);
				$('#id').val(data.id_tagihan);
				$('#tab').val(tab);
			}
		})

	});


// <=============================BATAS========================>
// <=============================BATAS========================>
// <=============================BATAS========================>


	$('.tombolTambahUser').on('click', function(){

		$('#exampleModalLabel').html('Tambah Data User');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/dashboard/tambahA');
		$('#nama').val('');
		$('#username').val('');
		$('#pass').val('');
	})

	$('.tampilModalUser').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data User');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/dashboard/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');


		$.ajax({
			url: 'http://localhost/pds_web/public/dashboard/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#nama').val(data.nama);
				$('#username').val(data.username);
				$('#pass').val(data.pass);
				$('#id').val(data.id_admin);
			}
		})

	});

// <=============================BATAS========================>
// <=============================BATAS========================>
// <=============================BATAS========================>


$('.tampilModalLaksana').on('click', function(){

		$('#exampleModalLabel').html('Ubah Data');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-content form').attr('action', 'http://localhost/pds_web/public/datadata/ubahA');

		const id = $(this).data('id');
		const tab = $(this).data('tab');


		$.ajax({
			url: 'http://localhost/pds_web/public/datadata/getUbahA',
			data: {id : id, tab : tab},
			method: 'post',
			dataType: 'json',
			success: function(data) {

				$('#surat').val(data.surat);
				$('#tgl_dok').val(data.tgl_dok);
				$('#tgl_pel').val(data.tgl_pel);
				$('#PIC').val(data.PIC);
				$('#vendor').val(data.perusahaan);
				$('#ks').val(data.vendor_ks);
				$('#urai').val(data.uraian);
				$('#tag').val(data.no_tag);
				$('#jumlah_vol').val(data.jml_peserta);
				$('#jumlah_satuan').val(data.satuan);
				$('#jumlah_biayat').val(data.biaya_tambah);
				$('#jml_sb').val(data.ttl_blm_pjk);
				$('#jml_ttl_pjk').val(data.pjk);
				$('#jml_ttl').val(data.total);
				$('#pengerjaan').val(data.status);
				$('#id').val(data.id_data);
				$('#tab').val(tab);
			}
		})
	});	

});