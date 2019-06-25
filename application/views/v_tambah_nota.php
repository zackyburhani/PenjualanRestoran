<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Tambah Data Pesan
			<small></small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8">
				<div class="box box-default">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Kategori</label>
							<select class="form-control select2" name="kd_kategori" id="kode_kategori">
								<?php foreach($kategori as $kat){ ?>
								<option value="<?php echo $kat->kd_kategori?>"><?php echo $kat->nm_kategori ?>
								</option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Menu</label>
							<select class="form-control select2" name="kd_menu" id="kode_menu">
								<?php foreach($menu as $mn){ ?>
								<option class="<?php echo $mn->kd_kategori ?>" value="<?php echo $mn->kd_menu?>">
									<?php echo $mn->nm_menu ?>
								</option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Jumlah</label>
							<input type="number" name="jumlah"
								oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
								min="1" placeholder="Jumlah" required class="form-control">
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Keterangan</label>
							<textarea class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
						</div>

						<div class="form-group">
							<button class="btn pull-right btn-primary btn-md add_cart" type="button"><span
									class="fa fa-plus"></span> TambaData</button>
						</div>

					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<br>
					<div class="panel-body">

						<div class="row">
							<div class="col-lg-12">
								<table style="table-layout:fixed"
									class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th align="center" width="50px">No. </th>
											<th align="center">
												<center>Kategori</center>
											</th>
											<th align="center">
												<center>Menu</center>
											</th>
											<th align="center">
												<center>Keterangan</center>
											</th>
											<th align="center">
												<center>Harga</center>
											</th>
											<th align="center" width="100px">
												<center>Jumlah</center>
											</th>
											<th align="center" width="150px">
												<center>Jumlah Harga</center>
											</th>
											<th align="center" width="80px">
												<center>Hapus</center>
											</th>
										</tr>
									</thead>
									<tbody id="detail_cart">

									</tbody>
								</table>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-4 pull-right">
								<button type="button" id="btn_proses" data-target="#ModalTambahPesan"
									data-toggle="modal" class="btn btn-success btn-md btn-block"><span
										class="fa fa-sign-out"></span>
									Proses</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</section>
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="modalTambahNota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-tags"></i> Tambah Data Pesan</h4>
			</div>
			<form id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group"><label>Nomor Nota</label>
								<input required class="form-control required text-capitalize" data-placement="top"
									data-trigger="manual" type="text" value="<?php echo $no_nota ?>"
									name="no_nota_simpan" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group"><label>ID Pelanggan</label>
								<input required class="form-control required text-capitalize" data-placement="top"
									data-trigger="manual" type="text" value="<?php echo $kd_pelanggan ?>"
									name="kd_pelanggan_simpan" readonly>
							</div>
						</div>
					</div>

					<hr>

					<div class="form-group"><label>Nama Pelanggan</label>
						<input required class="form-control required" placeholder="Input Nama Pelanggan"
							data-placement="top" data-trigger="manual" type="text" name="nm_pelanggan_simpan">
					</div>

					<div class="form-group">
						<label class="control-label">Nomor Telepon</label>
						<input name="no_telp_simpan"
							oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
							class="form-control" type="text" placeholder="Input Nomor Telepon" required>
					</div>

					<div class="form-group">
						<label class="control-label">Alamat</label>
						<textarea placeholder="Input Alamat..." rows="4" cols="5" class="form-control"
							name="alamat_simpan"></textarea>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
						Batal</button>
					<button class="btn btn-primary" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL ADD-->

<script type="text/javascript">
	$(document).ready(function () {

		$("#kode_menu").chained("#kode_kategori");

		$('[name="jumlah"]').keypress(function (event) {
			if (event.keyCode === 10 || event.keyCode === 13) {
				event.preventDefault();
			}
		});

		$('.add_cart').click(function (e) {
			var kd_menu = $('[name="kd_menu"]').val();
			var jumlah = $('[name="jumlah"]').val();
			var keterangan = $('[name="keterangan"]').val();

			if (jumlah == "") {
				swal({
					title: "Jumlah Tidak Boleh Kosong",
					text: "",
					icon: "error",
					button: "Ok !",
				});
				e.preventDefault();
				return false;
			}

			if (jumlah == 0) {
				jumlah = $('[name="jumlah"]').val("");
				swal({
					title: "Jumlah Tidak Boleh 0",
					text: "",
					icon: "error",
					button: "Ok !",
				});
				e.preventDefault();
				return false;
			}

			//cart
			$.ajax({
				url: "<?php echo base_url('Nota/add_to_cart');?>",
				method: "POST",
				data: {
					kd_menu: kd_menu,
					jumlah: jumlah,
					keterangan: keterangan
				},
				success: function (data) {
					$('[name="jumlah"]').val("");
					$('[name="keterangan"]').val("");
					$("#btn_proses").show();
					$('#detail_cart').html(data);
				}
			});
		});

		// Load shopping cart
		$('#detail_cart').load("<?php echo base_url('Nota/load_cart');?>");

		//Hapus Item Cart
		$(document).on('click', '.hapus_cart', function () {
			var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
			$.ajax({
				url: "<?php echo base_url('Nota/hapus_cart');?>",
				method: "POST",
				data: {
					row_id: row_id
				},
				success: function (data) {
					$('#detail_cart').html(data);
				}
			});
		});

		//get Kode
		$("#btn_proses").click(function () {

			//untuk validasi tombol simpan
			$.ajax({
				url: "<?php echo base_url('Nota/cekCart')?>",
				dataType: "JSON",
				success: function (data) {
					if (data == false) {
						swal({
							title: "Tidak Ada Data Yang Diproses",
							text: "",
							icon: "error",
							button: "Ok !",
						});
						return false;
					} else {
						$("#modalTambahNota").modal("show");
					}
				}
			});
			return false;
		});

		//Simpan pesan
		$('#btn_simpan').on('click', function () {
			var no_nota = $('[name="no_nota_simpan"]').val();
			var kd_pelanggan = $('[name="kd_pelanggan_simpan"]').val();
			var nm_pelanggan = $('[name="nm_pelanggan_simpan"]').val();
			var no_telp = $('[name="no_telp_simpan"]').val();
			var alamat = $('[name="alamat_simpan"]').val();

			//cek nomor yang sama
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Nota/simpan')?>",
				dataType: "JSON",
				data: {
					no_nota: no_nota,
					kd_pelanggan: kd_pelanggan,
					nm_pelanggan: nm_pelanggan,
					no_telp: no_telp,
					alamat: alamat
				},
				success: function (data) {
					$.ajax({
						type: "GET",
						url: "<?php echo base_url('Nota/load_detail')?>",
						dataType: "JSON",
						success: function (data) {

							$.each(data, function (index, objek) {
								var kd_menu = objek.kd_menu;
								var jumlah = objek.jumlah;
								var harga_menu = objek.harga_menu;
								var keterangan = objek.keterangan;

								$.ajax({
									type: "POST",
									url: "<?php echo base_url('Nota/simpan_detail')?>",
									dataType: "JSON",
									data: {
										kd_menu : kd_menu,
										no_nota : no_nota,
										jumlah : jumlah,
										harga_menu: harga_menu,
										keterangan : keterangan,
									},
								});
							});
						}
					});

					if (data == "sukses") {
						$('#modalTambahNota').modal('hide');
						$('[name="nm_pelanggan_simpan"]').val("");
						$('[name="no_telp_simpan"]').val("");
						$('[name="alamat_simpan"]').val("");
						swal({
							icon: "success",
							title: "Berhasil",
							text: "Data Berhasil disimpan",
							timer: 3000
						}).then(function () {
							$('#detail_cart').load('<?php echo base_url('Nota/destroy') ?>');
							window.location.href = "<?php echo base_url('Nota')?>";
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
	});


	function cari() {
		var no_telp = $('[name="cari_pelanggan"]').val();
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('pesan/get_pelanggan')?>",
			dataType: "JSON",
			data: {
				no_telp: no_telp
			},
			success: function (data) {
				if (data == null) {
					swal({
						title: "Data Tidak Ditemukan",
						text: "",
						icon: "error",
						button: "Ok !",
					});
					$('[name="nm_plg"]').val("");
					$('[name="no_telp"]').val("");
					$('[name="alamat"]').val("");
					return false;
				}

				$('[name="nm_plg"]').val(data.nm_plg);
				$('[name="no_telp"]').val(data.no_telp);
				$('[name="alamat"]').val(data.alamat);
			}
		});

	}
</script>