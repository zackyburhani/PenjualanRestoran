<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Laporan Pendapatan
			<small></small>
		</h1>
	</section>

	<?php if ($this->session->flashdata('pesanGagal') == TRUE) { ?>
		<script>
		setTimeout(function() {
			swal({
			title: "<?php echo $this->session->flashdata('pesanGagal') ?>",
			text: "",
			icon: "error",
			button: "Ok !",
			});
		}, 600);
		</script>
	<?php } ?>

	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-warning">
					<div class="box-header with-border">
					</div>
					<div class="box-body">

						<div class="form-group">
							<form action="<?php echo site_url('laporan_pendapatan/cetak') ?>" method="POST">
								<label class="col-sm-2 control-label" style="margin-top: 5px">Tanggal Awal : </label>
								<div class="col-sm-3">
									<input type="date" name="awal" class="form-control" required>
								</div>
								<label class="col-sm-2 control-label" style="margin-top: 5px">Tanggal Akhir : </label>
								<div class="col-sm-3">
									<input type="date" name="akhir" class="form-control" required>
								</div>
								<div class="col-sm-2">
									<button type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> PDF</button>
								</div>
							</form>
						</div>
					</div>
					<div class="box-footer">
						<center>

						</center>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
