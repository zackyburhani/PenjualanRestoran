<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Nota
      <small></small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataOrder">
              <thead>
                <tr>
                  <th width="20px">No. </th>
                  <th width="80px"><center>Nomor Nota</center></th>
                  <th width="80px"><center>Tanggal Nota</center></th>
                  <th width="80px"> <center>ID Pesan</center> </th>
                  <th width="100px"> <center>Action</center> </th>
                </tr>
              </thead>
              <tbody id="show_data">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="ModalPesanDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
              <th align="center"><center>ID Barang</center></th>
              <th align="center"><center>Nama Barang</center></th>
              <th align="center"><center>Harga</center></th>
              <th align="center"><center>QTY</center></th>
              <th align="center"><center>Jumlah Harga</center></th>
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
$(document).ready(function(){
  tampil_data_order();
  $('#dataOrder').dataTable();
        
  //fungsi tampil jasa
  function tampil_data_order(){ 
    $.ajax({
      type  : 'ajax',
      url   : "<?php echo base_url('pesan/data_pesan')?>",
      async : false,
      dataType : 'json',
      success : function(data){
        var html = '';
        var i;
        no = 1;
        for(i=0; i<data.length; i++){
          html += 
            '<tr>'+
              '<td align="center">'+ no++ +'.'+'</td>'+
              '<td align="center">'+data[i].no_nota+'</td>'+
              '<td align="center">'+data[i].tgl_nota+'</td>'+
              '<td align="center">'+data[i].id_pesan+'</td>'+
              '<td style="text-align:center;">'+
                '<button data-target="javascript:;" class="btn btn-info pesan_detail" data="'+data[i].no_nota+'"><span class="fa fa-folder-open"></span></button>'+' '+
                '<a href="<?php echo site_url('pesan/cetak/') ?>'+data[i].no_nota+'" target="_blank" class="btn btn-danger"><span class="fa fa-file-pdf-o"></span></a>'+ 
              '</td>'+
            '</tr>';
        }
        $('#show_data').html(html);
      }
    });
  }

  $('#show_data').on('click','.pesan_detail',function(){
    var no_nota = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('pesan/get_pesan')?>",
      dataType : "JSON",
      data : {no_nota:no_nota},
      success: function(data){
        var html = '';
        var i;
        no = 1;
        for(i=0; i<data.length; i++){

          var nm_plg = data[i].nm_plg;
          var alamat = data[i].alamat;
          var no_telp = data[i].no_telp;
          var diskon = data[i].diskon;
          
          if(nm_plg == null || nm_plg == ""){
            nm_plg = '-';
          }

          if(alamat == null || alamat == ""){
            alamat = '-';
          }

          if(no_telp == null || no_telp == ""){
            no_telp = '-';
          }

          if(diskon == 0){
            diskon = '-';
          }

          html += 
            '<div class="col-md-6">'+
              '<table style="table-layout:fixed" class="table table-bordered ">'+
                '<tbody>'+
                  '<tr>'+
                    '<td style="width: 100px">Nama</td>'+
                    '<td style="width: 10px">:</td>'+
                    '<td>'+nm_plg+'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td>Telepon</td>'+
                    '<td>:</td>'+
                    '<td>'+no_telp+'</td>'+
                    '</tr>'+
                  '<tr>'+
                    '<td>Alamat</td>'+
                    '<td>:</td>'+
                    '<td>'+alamat+'</td>'+
                  '</tr>'+
                '</tbody>'+
              '</table>'+
            '</div>'+
            '<div class="col-md-6">'+
              '<table style="table-layout:fixed" class="table table-bordered ">'+
                '<tbody>'+
                  '<tr>'+
                    '<td style="width: 150px">Nomor Nota</td>'+
                    '<td style="width: 10px">:</td>'+
                    '<td><b>'+data[i].no_nota+'</b></td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td style="width: 150px">Tanggal Bayar</td>'+
                    '<td style="width: 10px">:</td>'+
                    '<td>'+data[i].tgl_bayar+'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td style="width: 150px">Diskon</td>'+
                    '<td style="width: 10px">:</td>'+
                    '<td>'+diskon+'</td>'+
                  '</tr>'+
                '</tbody>'+
              '</table>'+
            '</div>';
        }
        
        $('#detail_order1').html(html);

        $.ajax({
          type : "GET",
          url  : "<?php echo base_url('pesan/get_detail_pesan')?>",
          dataType : "JSON",
          data : {no_nota:no_nota},
          success: function(data){
            var html = '';
            var total = '';
            var i;
            no = 1;
            for(i=0; i<data.length; i++){
              html += 
                '<tr>'+
                  '<td><center>'+no++ +'.'+'</center></td>'+
                  '<td><center>'+data[i].id_brg+'</center></td>'+
                  '<td><center>'+data[i].nm_brg+'</center></td>'+
                  '<td><center>'+data[i].harga+'</center></td>'+
                  '<td><center>'+data[i].qty+'</center></td>'+
                  '<td><center>'+data[i].jml_bayar+'</center></td>'+
                '</tr>';
              total = data[i].total;
              var diskons = data[i].diskon;
            }

            html +=
              '<tr>'+
                '<td colspan="5"><center><b>Diskon</b></center></td>'+
                '<td><center><b style="color:red">'+diskons+'</b></center></td>'+
              '</tr>'+
              '<tr>'+
                '<td colspan="5"><center><b>TOTAL</b></center></td>'+
                '<td><center><b>'+total+'</b></center></td>'+
                '</tr>';
                $('#detail_order2').html(html);
          }
        });
        $('#ModalPesanDetail').modal('show');
      }
    });
    return false;
  });
});
</script> 