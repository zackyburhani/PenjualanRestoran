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
						<button class="btn btn-info" onclick="tambahPesan()"><i
								class="fa fa-plus"></i> Tambah Pesanan</button>
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
									<th width="100px">
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
										<center>
											<button class="btn btn-info btnDetailMenu"
												data-no_nota="<?php echo $nta->no_nota ?>"
												data-tgl_nota="<?php echo $nta->tgl_nota ?>"
												data-kd_pelanggan="<?php echo $nta->kd_pelanggan ?>"
												data-kd_wo="<?php echo $nta->kd_wo ?>"><i
													class="fa fa-folder-open"></i></button>
											<button class="btn btn-danger btnHapusMenu"
												data-kd_menu="<?php echo $nta->no_nota ?>"><i
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
				<div class="row" id="detail_order1">

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
					<tbody id="detail_order2">

					</tbody>
				</table>

			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
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

    function tambahPesan(){
        window.location.href = "Nota/tambah_pesan";
    }
</script>