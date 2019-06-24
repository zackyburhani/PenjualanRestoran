<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Data Kategori
			<small></small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<button class="btn btn-info" data-toggle="modal" href="#" data-target="#ModalTambahKategori"><i
								class="fa fa-plus"></i> Tambah Data Kategori</button>
					</div>
					<div class="panel-body">

						<table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataKategori">
							<thead>
								<tr>
									<th width="5%">No. </th>
									<th width="150px">
										<center>ID Kategori</center>
									</th>
									<th width="150px">
										<center>Nama Kategori</center>
									</th>
									<th width="100px">
										<center>Action</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach($kategori as $kat) { ?>
								<tr>
									<td>
										<center><?php echo $no++ ?></center>
									</td>
									<td>
										<center><?php echo $kat->kd_kategori ?></center>
									</td>
									<td>
										<center><?php echo $kat->nm_kategori ?></center>
									</td>
									<td>
										<center>
											<button class="btn btn-warning btnEditKategori" data-toggle="modal"
												data-kd_kategori="<?php echo $kat->kd_kategori ?>"
												data-nm_kategori="<?php echo $kat->nm_kategori ?>"><i class="fa fa-edit"></i></button>
											<button class="btn btn-danger btnHapusKategori"
												data-kd_kategori="<?php echo $kat->kd_kategori ?>"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="ModalTambahKategori" tabindex="-1" role="dialog" aria-labelledby="largeModal"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="modal-title" id="myModalLabel">Tambah Kategori</h3>
			</div>
			<form class="form-horizontal">
				<div class="modal-body">

					<div class="form-group">
						<label class="control-label col-xs-3">ID Kategori</label>
						<div class="col-xs-9">
							<input name="kd_kategori_simpan" readonly class="form-control" type="text" placeholder="Kode Kategori"
								value="<?php echo $id_kategori ?>" style="width:335px;" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-3">Nama Kategori</label>
						<div class="col-xs-9">
							<input name="nm_kategori_simpan" class="form-control" type="text" placeholder="Nama Kategori"
								style="width:335px;" required>
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
<div class="modal fade" id="modalEditKategori" tabindex="-1" role="dialog" aria-labelledby="largeModal"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="modal-title" id="myModalLabel">Ubah Barang</h3>
			</div>
			<form class="form-horizontal">
				<div class="modal-body">

					<div class="form-group">
						<label class="control-label col-xs-3">ID Kategori</label>
						<div class="col-xs-9">
							<input name="kd_kategori_edit" readonly class="form-control" type="text" placeholder="Kode Kategori"
								style="width:335px;" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-3">Nama Kategori</label>
						<div class="col-xs-9">
							<input name="nm_kategori_edit" class="form-control" type="text" placeholder="Nama Kategori"
								style="width:335px;" required>
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

<script type="text/javascript">
	$(document).ready(function () {

		$('#dataKategori').dataTable();

		//Simpan Barang
		$('#btn_simpan').on('click', function () {
			var kd_kategori = $('[name="kd_kategori_simpan"]').val();
			var nm_kategori = $('[name="nm_kategori_simpan"]').val();

			if (nm_kategori == "") {
				swal({
					title: "Nama Kategori Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			}

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Kategori/simpan')?>",
				dataType: "JSON",
				data: {
					kd_kategori: kd_kategori,
					nm_kategori: nm_kategori,
				},
				success: function (data) {
					if (data == "sukses") {
						$('#ModalTambahKategori').modal('hide');
						$('[name="nm_kategori_simpan"]').val("");
						swal({
							icon: "success",
							title: "Berhasil",
							text: "Data Berhasil disimpan",
							timer: 3000
						}).then(function () {
							window.location = "Kategori";
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
			return false;
		});

		//Untuk menampilkan data ke modal
		$("#dataKategori").on("click", ".btnEditKategori", function () {
			var kd_kategori = $(this).data("kd_kategori");
			var nm_kategori = $(this).data("nm_kategori");
			try {
				$('[name="kd_kategori_edit"]').val(kd_kategori);
				$('[name="nm_kategori_edit"]').val(nm_kategori);
				$("#modalEditKategori").modal("show");
			} catch (e) {
				console.log(e);
			}
		});

		//Update Barang
		$('#btn_update').on('click', function () {

			var kd_kategori = $('[name="kd_kategori_edit"]').val();
			var nm_kategori = $('[name="nm_kategori_edit"]').val();

			if (nm_kategori == "") {
				swal({
					title: "Nama Kategori Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			}

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Kategori/ubah')?>",
				dataType: "JSON",
				data: {
					kd_kategori: kd_kategori,
					nm_kategori: nm_kategori,
				},
				success: function (data) {
					console.log(data);
					if (data == "sukses") {
						$('#modalEditKategori').modal('hide');
						$('[name="nm_kategori_edit"]').val("");
						swal({
							icon: "success",
							title: "Berhasil",
							text: "Data Berhasil Diubah",
							timer: 3000
						}).then(function () {
							window.location = "Kategori";
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
			return false;
		});

		//Hapus Barang
		$("#dataKategori").on("click", ".btnHapusKategori", function () {
			var kd_kategori = $(this).data("kd_kategori");
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
                url: "<?php echo base_url('Kategori/hapus')?>",
                dataType: "JSON",
                data: {
                  kd_kategori: kd_kategori,
                },
								success: function (data) {
									if (data == "sukses") {
                    swal({
                      icon: "success",
                      title: "Berhasil",
                      text: "Data Berhasil Dihapus",
                      timer: 3000
                    }).then(function () {
                      window.location = "Kategori";
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