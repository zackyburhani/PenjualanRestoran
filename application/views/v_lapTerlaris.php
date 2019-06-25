<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Laporan Menu Terlaris
			<small></small>
		</h1>
	</section>

	<?php if ($this->session->flashdata('pesanGagal') == TRUE) { ?>
	<script>
		setTimeout(function () {
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
			<div class="col-md-8">
				<div class="box box-default">
					<!-- /.box-header -->
					<div class="box-body">
						<form>
							<div class="form-group">
								<label>Tanggal Awal</label>
								<input type="date" name="awal" class="form-control" required>
							</div>

							<div class="form-group">
								<label>Tanggal Akhir</label>
								<input type="date" name="akhir" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Jumlah Data</label>
								<input type="number" name="jumlah"
									oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
									min="1" placeholder="Jumlah Data" class="form-control">
							</div>

							<div class="form-group">
								<button class="btn pull-right btn-primary" id="btn_simpan" type="button"><span
										class="fa fa-pie-chart"></span> Proses</button>
							</div>

						</form>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>

		<div class="row" id="chart_show">
			
		</div>
	</section>
</div>

<script src="<?php echo base_url('assets/Highcharts/code/highcharts.js')?>"></script>
<script src="<?php echo base_url('assets/Highcharts/code/modules/exporting.js')?>"></script>
<script src="<?php echo base_url('assets/Highcharts/code/modules/export-data.js')?>"></script>

<script type="text/javascript">

	$('#btn_simpan').on('click', function () {
		var awal = $('[name="awal"]').val();
		var akhir = $('[name="akhir"]').val();
		var jumlah = $('[name="jumlah"]').val();

		if (awal > akhir) {
			swal({
				title: "Tanggal Tidak Sesuai",
				icon: "error",
				button: "Ok",
			});
		}

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Laporan_Terlaris/proses')?>",
			dataType: "JSON",
			data: {
				awal: awal,
				akhir: akhir,
				jumlah: jumlah
			},
			success: function (data) {
				if (data.length > 0) {
					
					var html = '';
					html +=
						'<div class="col-lg-12">'+
							'<div class="box box-primary">'+
								'<div class="box-header with-border">'+
								'</div>'+
								'<div class="box-body">'+
									'<div class="form-group">'+
										'<form>'+
											'<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>'+
										'</form>'+
									'</div>'+
								'</div>'+
								'<div class="box-footer">'+
									'<form action="<?php echo site_url('Laporan_Terlaris/cetak') ?>" method="post">'+
										'<input type="hidden" name="awal_chart">'+
										'<input type="hidden" name="akhir_chart">'+
										'<input type="hidden" name="jumlah_chart">'+
										'<button class="btn pull-right btn-danger" type="submit"><i class="fa fa-file-pdf-o"></i> PDF</button>'
									'</form>'
								'</div>'+
							'</div>'+
						'</div>';

					$('#chart_show').html(html);
					$('[name="awal_chart"]').val(awal);
					$('[name="akhir_chart"]').val(akhir);
					$('[name="jumlah_chart"]').val(jumlah);
					$('[name="awal"]').val("");
					$('[name="akhir"]').val("");
					$('[name="jumlah"]').val("");
					Highcharts.chart('container', {
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false,
							type: 'pie'
						},
						title: {
							text: 'Persentase Data Menu Terlaris'
						},
						tooltip: {
							pointFormat: '{series.name}: <b>{point.y}</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: true,
									format: '<b>{point.name}</b>: {point.y} ',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									}
								}
							}
						},
						series: [{
							name: 'Total',
							colorByPoint: true,
							data: data,
						}]
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

	// $("#chart_show").on("click", "#cetak_pdf", function () {
		
	// 	var awal = $(this).data("awal");
	// 	var akhir = $(this).data("akhir");
	// 	var jumlah = $(this).data("jumlah");


	// 	if (awal > akhir) {
	// 		swal({
	// 			title: "Tanggal Tidak Sesuai",
	// 			icon: "error",
	// 			button: "Ok",
	// 		});
	// 	}

	// 	window.location.href = "cetak/"+no_nota;

	// 	return false;
	// });

	
</script>