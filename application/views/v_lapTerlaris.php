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
						<form action="<?php echo site_url('Laporan_Terlaris/proses') ?>" method="POST">
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
								<button class="btn pull-right btn-primary" type="submit"><span
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

		<?php if($terlaris != null) { ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					</div>
					<div class="box-body">

						<div class="form-group">
							<form action="<?php echo site_url('laporan_pendapatan/cetak') ?>" method="POST">
								<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
								<span value="<?php echo json_encode($terlaris) ?>" id="pie_chart"></span>
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
		<?php } ?>
	</section>
</div>

<script src="<?php echo base_url('assets/Highcharts/code/highcharts.js')?>"></script>
<script src="<?php echo base_url('assets/Highcharts/code/modules/exporting.js')?>"></script>
<script src="<?php echo base_url('assets/Highcharts/code/modules/export-data.js')?>"></script>

<script type="text/javascript">

var data_chart = <?php echo json_encode($terlaris) ?>;

console.log(data_chart);

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
        data:  data_chart,
    }]
});
		</script>
