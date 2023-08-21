function total() {
		var vol = parseInt(document.getElementById('jumlah_vol').value);
		var satuan = parseInt(document.getElementById('jumlah_satuan').value);

		var jumlah_sb_pjk = vol * satuan;
		var jumlah_ppn = (jumlah_sb_pjk * 10) / 100;
		var jumlah_ttl_ppn = jumlah_sb_pjk + jumlah_ppn;
		var jumlah_pph = (jumlah_sb_pjk * 2) / 100;
		var jumlah_ttl = jumlah_ttl_ppn - jumlah_pph;

		document.getElementById('jml_sb').value = jumlah_sb_pjk;
		document.getElementById('jml_ppn').value = jumlah_ppn;
		document.getElementById('jml_ttl_ppn').value = jumlah_ttl_ppn;
		document.getElementById('jml_pph').value = jumlah_pph;
		document.getElementById('jml_ttl').value = jumlah_ttl;
		}

function totad() {
		var vol = parseInt(document.getElementById('jumlah_vol').value);
		var satuan = parseInt(document.getElementById('jumlah_satuan').value);
		var tambah = parseInt(document.getElementById('jumlah_biayat').value);

		var jumlah_sb_pjkd = (vol * satuan) + tambah;
		var jumlah_ppnd = (jumlah_sb_pjkd * 10) / 100;
		var jumlah_ttld = jumlah_sb_pjkd - jumlah_ppnd;

		document.getElementById('jml_sb').value = jumlah_sb_pjkd;
		document.getElementById('jml_ttl_pjk').value = jumlah_ppnd;
		document.getElementById('jml_ttl').value = jumlah_ttld;
		}