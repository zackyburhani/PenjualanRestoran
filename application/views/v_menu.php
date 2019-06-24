<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Data Menu
			<small></small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<button class="btn btn-info" data-toggle="modal" href="#" data-target="#ModalTambahMenu"><i
								class="fa fa-plus"></i> Tambah Data Menu</button>
					</div>
					<div class="panel-body">

						<table style="table-layout:fixed" class="table table-striped table-bordered table-hover"
							id="dataMenu">
							<thead>
								<tr>
									<th width="5%">No. </th>
									<th width="150px">
										<center>ID Menu</center>
									</th>
									<th width="150px">
										<center>Nama Menu</center>
									</th>
									<th width="100px">
										<center>Action</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach($menu as $kat) { ?>
								<tr>
									<td>
										<center><?php echo $no++ ?></center>
									</td>
									<td>
										<center><?php echo $kat->kd_menu ?></center>
									</td>
									<td>
										<center><?php echo $kat->nm_menu ?></center>
									</td>
									<td>
										<center>
                                            <button class="btn btn-info btnDetailMenu"
												data-kd_menu="<?php echo $kat->kd_menu ?>"
												data-nm_menu="<?php echo $kat->nm_menu ?>"
                                                data-harga="<?php echo $kat->harga ?>"
                                                data-kd_kategori="<?php echo $kat->kd_kategori ?>"><i
													class="fa fa-folder-open"></i></button>
											<button class="btn btn-warning btnEditMenu" data-toggle="modal"
												data-kd_menu="<?php echo $kat->kd_menu ?>"
												data-nm_menu="<?php echo $kat->nm_menu ?>"
                                                data-harga="<?php echo $kat->harga ?>"
                                                data-kd_kategori="<?php echo $kat->kd_kategori ?>"><i
													class="fa fa-edit"></i></button>
											<button class="btn btn-danger btnHapusMenu"
												data-kd_menu="<?php echo $kat->kd_menu ?>"><i
													class="fa fa-trash"></i></button>
										</center>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="ModalTambahMenu" tabindex="-1" role="dialog" aria-labelledby="largeModal"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Menu</h3>
			</div>
			<form class="form-horizontal">
				<div class="modal-body">

					<div class="form-group">
						<label class="control-label col-xs-3">ID Menu</label>
						<div class="col-xs-9">
							<input name="kd_menu_simpan" readonly class="form-control" type="text"
								placeholder="Kode Menu" value="<?php echo $kd_menu ?>" style="width:335px;"
								required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-3">Nama Menu</label>
						<div class="col-xs-9">
							<input name="nm_menu_simpan" class="form-control" type="text"
								placeholder="Nama Menu" style="width:335px;" required>
						</div>
					</div>

                    <div class="form-group">
						<label class="control-label col-xs-3">Harga</label>
						<div class="col-xs-9">
							<input name="harga_simpan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" type="number"
								placeholder="Harga" style="width:335px;" required>
						</div>
					</div>

                    <div class="form-group">
                        <label class="control-label col-xs-3">Kategori</label>
                        <div class="col-xs-9">
                            <select style="width:335px;" class="form-control" name="kd_kategori_simpan">
                                <?php foreach($kategori as $kate) { ?>
                                <option value="<?php echo $kate->kd_kategori ?>"><?php echo $kate->nm_kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>
						Tutup</button>
					<button class="btn btn-primary" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEditMenu" tabindex="-1" role="dialog" aria-labelledby="largeModal"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="modal-title" id="myModalLabel">Ubah Menu</h3>
			</div>
			<form class="form-horizontal">
				<div class="modal-body">

					<div class="form-group">
						<label class="control-label col-xs-3">ID Menu</label>
						<div class="col-xs-9">
							<input name="kd_menu_edit" readonly class="form-control" type="text"
								placeholder="Kode Menu" style="width:335px;" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-3">Nama Menu</label>
						<div class="col-xs-9">
							<input name="nm_menu_edit" class="form-control" type="text" placeholder="Nama Menu"
								style="width:335px;" required>
						</div>
					</div>

                    <div class="form-group">
						<label class="control-label col-xs-3">Harga</label>
						<div class="col-xs-9">
							<input name="harga_edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" type="number"
								placeholder="Harga" style="width:335px;" required>
						</div>
					</div>

                    <div class="form-group">
                        <label class="control-label col-xs-3">Kategori</label>
                        <div class="col-xs-9">
                            <select style="width:335px;" class="form-control" name="kd_kategori_edit">
                                <?php foreach($kategori as $kate) { ?>
                                <option value="<?php echo $kate->kd_kategori ?>"><?php echo $kate->nm_kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
					</div>

				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>
						Tutup</button>
					<button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL EDIT-->

<!-- MODAL DETAIL -->
<div class="modal fade" id="modalDetailMenu" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Detail Menu</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">
           <table class="table table-responsive table-bordered" border="0">
              <tbody>
                <tr>
                  <td width="120px">ID Menu</td>
                  <td width="20px">:</td>
                  <td><b><span id="kd_menu_detail"></span></b></td>
                </tr>
                <tr>
                  <td>Nama Menu</td>
                  <td>:</td>
                  <td><span id="nm_menu_detail"></span></td>
                </tr>
                <tr>
                  <td>Harga</td>
                  <td>:</td>
                  <td><span id="harga_detail"></span></td>
                </tr>
                <tr>
                  <td>Kategori</td>
                  <td>:</td>
                  <td><span id="kd_kategori_detail"></span></td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL DETAIL-->

<script type="text/javascript">
	$(document).ready(function () {

		$('#dataMenu').dataTable();

		//Simpan Barang
		$('#btn_simpan').on('click', function () {
			var kd_menu = $('[name="kd_menu_simpan"]').val();
			var nm_menu = $('[name="nm_menu_simpan"]').val();
            var harga = $('[name="harga_simpan"]').val();
			var kd_kategori = $('[name="kd_kategori_simpan"]').val();

			if (nm_menu == "") {
				swal({
					title: "Nama Menu Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			} else if (harga == "") {
				swal({
					title: "Harga Menu Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			} else if (kd_kategori == "") {
				swal({
					title: "Kategori Menu Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			} else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Menu/simpan')?>",
                    dataType: "JSON",
                    data: {
                        kd_menu : kd_menu,
                        nm_menu : nm_menu,
                        harga : harga,
                        kd_kategori : kd_kategori
                    },
                    success: function (data) {
                        if (data == "sukses") {
                            $('#ModalTambahMenu').modal('hide');
                            $('[name="nm_menu_simpan"]').val("");
                            swal({
                                icon: "success",
                                title: "Berhasil",
                                text: "Data Berhasil disimpan",
                                timer: 3000
                            }).then(function () {
                                window.location = "Menu";
                            });
                        } else if (data == "gagal") {
                            swal({
                                icon: "info",
                                title: "Required",
                                text: data.errors,
                                timer: 3000
                            });
                        } else {
                            swal({
                                icon: "error",
                                title: "Error",
                                text: "Data Gagal Disimpan",
                                timer: 3000
                            })
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
			return false;
		});

		//Untuk menampilkan data ke modal
		$("#dataMenu").on("click", ".btnEditMenu", function () {
			var kd_menu = $(this).data("kd_menu");
			var nm_menu = $(this).data("nm_menu");
            var harga = $(this).data("harga");
			var kd_kategori = $(this).data("kd_kategori");

			try {
				$('[name="kd_menu_edit"]').val(kd_menu);
				$('[name="nm_menu_edit"]').val(nm_menu);
                $('[name="harga_edit"]').val(harga);
                $('[name="kd_kategori_edit"]').val(kd_kategori);
				$("#modalEditMenu").modal("show");
			} catch (e) {
				console.log(e);
			}
		});

        //Untuk menampilkan data detail
		$("#dataMenu").on("click", ".btnDetailMenu", function () {
			var kd_menu = $(this).data("kd_menu");
			var nm_menu = $(this).data("nm_menu");
            var harga = $(this).data("harga");
			var kd_kategori = $(this).data("kd_kategori");

			try {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Menu/getKategori')?>",
                    dataType: "JSON",
                    data: {
                        kd_kategori : kd_kategori
                    },
                    success: function (data) {

                        var har = harga;
                        var reverse = har.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');

                        $('#kd_menu_detail').text(kd_menu);
                        $('#nm_menu_detail').text(nm_menu);
                        $('#harga_detail').text(ribuan);
                        $('#kd_kategori_detail').text(data.nm_kategori);
                        $("#modalDetailMenu").modal("show");
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
			} catch (e) {
				console.log(e);
			}
		});

		//Update Barang
		$('#btn_update').on('click', function () {
			var kd_menu = $('[name="kd_menu_edit"]').val();
			var nm_menu = $('[name="nm_menu_edit"]').val();
            var harga = $('[name="harga_edit"]').val();
			var kd_kategori = $('[name="kd_kategori_edit"]').val();

			if (nm_menu == "") {
				swal({
					title: "Nama Menu Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			} else if (harga == "") {
				swal({
					title: "Harga Menu Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			} else if (kd_kategori == "") {
				swal({
					title: "Kategori Menu Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			} else {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Menu/ubah')?>",
                    dataType: "JSON",
                    data: {
                        kd_menu : kd_menu,
                        nm_menu : nm_menu,
                        harga : harga,
                        kd_kategori : kd_kategori,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == "sukses") {
                            $('#modalEditMenu').modal('hide');
                            $('[name="nm_menu_edit"]').val("");
                            $('[name="harga_edit"]').val("");
                            $('[name="kd_kategori_edit"]').val("");
                            swal({
                                icon: "success",
                                title: "Berhasil",
                                text: "Data Berhasil Diubah",
                                timer: 3000
                            }).then(function () {
                                window.location = "Menu";
                            });
                        } else if (data == "gagal") {
                            swal({
                                icon: "info",
                                title: "Required",
                                text: data.errors,
                                timer: 3000
                            });
                        } else {
                            swal({
                                icon: "error",
                                title: "Error",
                                text: "Data Gagal Diubah",
                                timer: 3000
                            })
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
			return false;
		});

		//Hapus
		$("#dataMenu").on("click", ".btnHapusMenu", function () {
			var kd_menu = $(this).data("kd_menu");
			try {
				swal({
						title: "Yakin Hapus Data ?",
						text: "",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								type: "POST",
								url: "<?php echo base_url('Menu/hapus')?>",
								dataType: "JSON",
								data: {
									kd_menu : kd_menu,
								},
								success: function (data) {
									if (data == "sukses") {
										swal({
											icon: "success",
											title: "Berhasil",
											text: "Data Berhasil Dihapus",
											timer: 3000
										}).then(function () {
											window.location = "Menu";
										});
									} else if (data == "gagal") {
										swal({
											icon: "info",
											title: "Required",
											text: data.errors,
											timer: 3000
										});
									} else {
										swal({
											icon: "error",
											title: "Error",
											text: "Data Gagal Diubah",
											timer: 3000
										});
									}
								},
							});
						} else {
							swal.close();
						}
					});
			} catch (e) {
				console.log(e);
			}
		});

	});
</script>