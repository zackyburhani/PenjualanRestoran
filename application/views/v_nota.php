<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Data Pesanan
			<small></small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="<?php echo site_url('Nota/tambah_pesan'); ?>" class="btn btn-info" ><i class="fa fa-plus"></i> Tambah
							Pesanan</a>
					</div>
					<div class="panel-body">

						<table style="table-layout:fixed" class="table table-striped table-bordered table-hover"
							id="dataNota">
							<thead>
								<tr>
									<th width="5%">No. </th>
									<th width="150px">
										<center>Nomor Nota</center>
									</th>
									<th width="150px">
										<center>Tanggal Nota</center>
									</th>
									<th width="150px">
										<center>ID WO</center>
									</th>
									<th>
										<center>Action</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach($nota as $nta) { ?>
								<tr>
									<td>
										<center><?php echo $no++ ?></center>
									</td>
									<td>
										<center><?php echo $nta->no_nota ?></center>
									</td>
									<td>
										<center><?php echo $nta->tgl_nota ?></center>
									</td>
									<td>
										<center><?php echo $nta->kd_wo ?></center>
									</td>
									<td>
										<center>
											<button class="btn btn-info btnDetailNota"
												data-no_nota="<?php echo $nta->no_nota ?>"
												data-tgl_nota="<?php echo $nta->tgl_nota ?>"
												data-kd_pelanggan="<?php echo $nta->kd_pelanggan ?>"
												data-kd_wo="<?php echo $nta->kd_wo ?>"><i
													class="fa fa-folder-open"></i></button>
											<a href="<?php echo site_url('Nota/cetak_nota/').$nta->no_nota?>" class="btn btn-primary"><i
													class="fa fa-print"></i> Cetak Nota</a>
											<a href="<?php echo site_url('Nota/cetak_wo/').$nta->kd_wo?>" class="btn btn-success"><i
													class="fa fa-print"></i> Cetak WO</a>
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

<!-- MODAL DETAIL -->
<div class="modal fade" id="ModalNotaDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-tag"></i> Detail Pesan</h4>
			</div>
			<div class="modal-body">
				<div class="row" id="detail_pesan1">

				</div>
				<table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th align="center" width="50px">No. </th>
							<th align="center">
								<center>ID Barang</center>
							</th>
							<th align="center">
								<center>Nama Barang</center>
							</th>
							<th align="center">
								<center>keterangan</center>
							</th>
							<th align="center">
								<center>Harga</center>
							</th>
							<th align="center">
								<center>QTY</center>
							</th>
							<th align="center">
								<center>Jumlah Harga</center>
							</th>
						</tr>
					</thead>
					<tbody id="detail_pesan2">

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
<!-- END MODAL DETAIL -->

<script type="text/javascript">
	$(document).ready(function () {
		$('#dataNota').dataTable();
	});

	function sum(total, num) {
		return total+num;
	}

	//Untuk menampilkan data detail
	$("#dataNota").on("click", ".btnDetailNota", function () {
		var no_nota = $(this).data("no_nota");
		var kd_wo = $(this).data("kd_wo");
		var kd_pelanggan = $(this).data("kd_pelanggan");
		var tgl_nota = $(this).data("tgl_nota");

		try {

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Nota/getDetailNota')?>",
				dataType: "JSON",
				data: {
					no_nota: no_nota
				},
				success: function (data) {
					console.log(data);

					var html = '';
					var i;
					no = 1;

					var nm_pelanggan = data[0].nm_pelanggan;
					var alamat = data[0].alamat;
					var no_telp = data[0].no_telp;

					if (nm_pelanggan == null || nm_pelanggan == "") {
						nm_pelanggan = '-';
					}

					if (alamat == null || alamat == "") {
						alamat = '-';
					}

					if (no_telp == null || no_telp == "") {
						no_telp = '-';
					}

					html +=
						'<div class="col-md-6">' +
							'<table style="table-layout:fixed" class="table table-bordered ">' +
								'<tbody>' +
									'<tr>' +
										'<td style="width: 100px">Nama</td>' +
										'<td style="width: 10px">:</td>' +
										'<td>' + nm_pelanggan + '</td>' +
									'</tr>' +
									'<tr>' +
										'<td>Telepon</td>' +
										'<td>:</td>' +
										'<td>' + no_telp + '</td>' +
									'</tr>' +
									'<tr>' +
										'<td>Alamat</td>' +
										'<td>:</td>' +
										'<td>' + alamat + '</td>' +
									'</tr>' +
								'</tbody>' +
							'</table>' +
						'</div>' +
						'<div class="col-md-6">' +
							'<table style="table-layout:fixed" class="table table-bordered ">' +
								'<tbody>' +
									'<tr>' +
										'<td style="width: 150px">Nomor Nota</td>' +
										'<td style="width: 10px">:</td>' +
										'<td><b>' + data[0].no_nota + '</b></td>' +
									'</tr>' +
									'<tr>' +
										'<td style="width: 150px">Tanggal Bayar</td>' +
										'<td style="width: 10px">:</td>' +
										'<td>' + data[0].tgl_nota + '</td>' +
									'</tr>' +
									'<tr>' +
										'<td style="width: 150px">ID WO</td>' +
										'<td style="width: 10px">:</td>' +
										'<td><b>' + data[0].kd_wo + '</b></td>' +
									'</tr>' +
								'</tbody>' +
							'</table>' +
						'</div>';

					$('#detail_pesan1').html(html);

					var html = '';
					var total = [];
					var i;
					no = 1;
					for(i=0; i<data.length; i++){

						if(data[i].keterangan == ""){
							var keterangan = "-";
						} else {
							var keterangan = data[i].keterangan;
						}
						
						html += 
							'<tr>'+
								'<td><center>'+no+++'</center></td>'+
								'<td><center>'+data[i].kd_menu+'</center></td>'+
								'<td><center>'+data[i].nm_menu+'</center></td>'+
								'<td><center>'+keterangan+'</center></td>'+
								'<td><center>'+data[i].harga+'</center></td>'+
								'<td><center>'+data[i].jumlah+'</center></td>'+
								'<td><center>'+data[i].harga_menu+'</center></td>'+
							'</tr>';

							total.push(parseInt(data[i].sum));
						}
						
						
						var print = total.reduce(sum);

						var har = print;
                        var reverse = har.toString().split('').reverse().join(''),
                        ribuan  = reverse.match(/\d{1,3}/g);
                        ribuan  = ribuan.join('.').split('').reverse().join('');

						html +=
						'<tr>'+
							'<td colspan="6"><center><b>TOTAL</b></center></td>'+
							'<td><center><b>'+ribuan+'</b></center></td>'+
						'</tr>';
						$('#detail_pesan2').html(html);
						$("#ModalNotaDetail").modal("show");
				},
				error: function (data) {
					console.log(data);
				}
			});
		} catch (e) {
			console.log(e);
		}
	});
</script>