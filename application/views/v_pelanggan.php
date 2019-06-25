<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Data pelanggan
			<small></small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">

						<table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataPelanggan">
							<thead>
								<tr>
									<th width="20px">No. </th>
									<th>
										<center>ID Pelanggan</center>
									</th>
									<th>
										<center>Nama Pelanggan</center>
									</th>
                  <th>
										<center>No. Telepon</center>
									</th>
                  <th>
										<center>Alamat</center>
									</th>
									<th width="100px">
										<center>Action</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach($pelanggan as $plg) { ?>
								<tr>
									<td>
										<center><?php echo $no++ ?></center>
									</td>
									<td>
										<center><?php echo $plg->kd_pelanggan ?></center>
									</td>
									<td>
										<center><?php echo $plg->nm_pelanggan ?></center>
									</td>
                  <td>
										<center><?php echo $plg->no_telp ?></center>
									</td>
                  <td>
										<center><?php echo $plg->alamat ?></center>
									</td>
									<td>
										<center>
											<button class="btn btn-warning btnEditPelanggan" data-toggle="modal"
												data-kd_pelanggan="<?php echo $plg->kd_pelanggan ?>"
												data-nm_pelanggan="<?php echo $plg->nm_pelanggan ?>"
                        data-alamat="<?php echo $plg->alamat ?>"
                        data-no_telp="<?php echo $plg->no_telp ?>"><i class="fa fa-edit"></i></button>
											<button class="btn btn-danger btnHapusPelanggan"
												data-kd_pelanggan="<?php echo $plg->kd_pelanggan ?>"><i class="fa fa-trash"></i></button>
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


<!-- MODAL EDIT -->
<div class="modal fade" id="modalEditPelanggan" tabindex="-1" role="dialog" aria-labelledby="largeModal"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="modal-title" id="myModalLabel">Ubah Pelanggan</h3>
			</div>
			<form class="form-horizontal">
				<div class="modal-body">

					<div class="form-group">
						<label class="control-label col-xs-3">ID Pelanggan</label>
						<div class="col-xs-9">
							<input name="kd_pelanggan_edit" readonly class="form-control" type="text" placeholder="Kode Kategori"
								style="width:335px;" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-3">Nama Pelanggan</label>
						<div class="col-xs-9">
							<input name="nm_pelanggan_edit" class="form-control" type="text" placeholder="Nama Pelanggan"
								style="width:335px;" required>
						</div>
					</div>
          
          <div class="form-group">
						<label class="control-label col-xs-3">No. Telepon</label>
						<div class="col-xs-9">
							<input name="no_telp_edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" type="text" placeholder="Nomor Telepon"
								style="width:335px;" required>
						</div>
					</div>

          <div class="form-group">
						<label class="control-label col-xs-3">No. Telepon</label>
						<div class="col-xs-9">
							<textarea name="alamat_edit" class="form-control" style="width:335px;"></textarea>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>
						Tutup</button>
					<button class="btn btn-primary" type="button" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL EDIT-->

<script type="text/javascript">
	$(document).ready(function () {

		$('#dataPelanggan').dataTable();

		//Untuk menampilkan data ke modal
		$("#dataPelanggan").on("click", ".btnEditPelanggan", function () {
			var kd_pelanggan = $(this).data("kd_pelanggan");
			var nm_pelanggan = $(this).data("nm_pelanggan");
      var no_telp = $(this).data("no_telp");
			var alamat = $(this).data("alamat");
			try {
				$('[name="kd_pelanggan_edit"]').val(kd_pelanggan);
				$('[name="nm_pelanggan_edit"]').val(nm_pelanggan);
        $('[name="no_telp_edit"]').val(no_telp);
				$('[name="alamat_edit"]').val(alamat);
				$("#modalEditPelanggan").modal("show");
			} catch (e) {
				console.log(e);
			}
		});

		//Update Barang
		$('#btn_update').on('click', function () {

			var kd_pelanggan = $('[name="kd_pelanggan_edit"]').val();
			var nm_pelanggan = $('[name="nm_pelanggan_edit"]').val();
      var no_telp = $('[name="no_telp_edit"]').val();
			var alamat = $('[name="alamat_edit"]').val();

			if (nm_pelanggan == "") {
				swal({
					title: "Nama Pelanggan Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			} else if (no_telp == "") {
				swal({
					title: "No. Telepon Tidak Boleh Kosong",
					icon: "error",
					button: "Ok",
				});
			}

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Pelanggan/ubah')?>",
				dataType: "JSON",
				data: {
					kd_pelanggan: kd_pelanggan,
					nm_pelanggan: nm_pelanggan,
          no_telp: no_telp,
          alamat: alamat,
				},
				success: function (data) {
					console.log(data);
					if (data == "sukses") {
						$('#modalEditPelanggan').modal('hide');
            $('[name="kd_pelanggan_edit"]').val("");
            $('[name="nm_pelanggan_edit"]').val("");
            $('[name="no_telp_edit"]').val("");
            $('[name="alamat_edit"]').val("");
						swal({
							icon: "success",
							title: "Berhasil",
							text: "Data Berhasil Diubah",
							timer: 3000
						}).then(function () {
							window.location = "Pelanggan";
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
		$("#dataPelanggan").on("click", ".btnHapusPelanggan", function () {
			var kd_pelanggan = $(this).data("kd_pelanggan");
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
                url: "<?php echo base_url('Pelanggan/hapus')?>",
                dataType: "JSON",
                data: {
                  kd_pelanggan: kd_pelanggan,
                },
								success: function (data) {
									if (data == "sukses") {
                    swal({
                      icon: "success",
                      title: "Berhasil",
                      text: "Data Berhasil Dihapus",
                      timer: 3000
                    }).then(function () {
                      window.location = "Pelanggan";
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