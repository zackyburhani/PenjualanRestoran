<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Retur
      <small></small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <a href="<?php echo site_url('retur/tambah_retur') ?>" class="btn btn-info" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Data Retur</a> 
            </div>
            <div class="panel-body">
      
              <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataRetur">
                <thead>
                  <tr>
                    <th width="5%">No. </th>
                    <th width="150px"><center>ID Retur</center></th>
                    <th width="150px"><center>Tanggal Retur</center></th>
                    <th width="150px"><center>Nomor Nota</center></th>
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
<div class="modal fade" id="ModalReturDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tag"></i> Detail Retur</h4>
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
              <th align="center"><center>Size</center></th>
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

  $('[name="qty"]').keypress(function (event) {
    if (event.keyCode === 10 || event.keyCode === 13) {
      event.preventDefault();
    }
  });

  tampil_data_retur(); //pemanggilan fungsi tampil barang.
    
  $('#dataRetur').dataTable();
     
    //fungsi tampil barang
    function tampil_data_retur(){
        $.ajax({
            type  : 'ajax',
            url   : "<?php echo base_url('retur/data_retur')?>",
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
                        '<td align="center">'+data[i].id_retur+'</td>'+
                        '<td align="center">'+data[i].tgl_retur+'</td>'+
                        '<td align="center">'+data[i].no_nota+'</td>'+
                        '<td style="text-align:center;">'+
                          '<button data-target="javascript:;" class="btn btn-info retur_detail" data="'+data[i].no_nota+'"><span class="glyphicon glyphicon-folder-open"></span></button>'+' '+
                          '<a href="<?php echo site_url('retur/cetak/') ?>'+data[i].no_nota+'" target="_blank" class="btn btn-danger"><span class="fa fa-file-pdf-o"></span></a>'+ 
                        '</td>'+
                    '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }


    $('#show_data').on('click','.retur_detail',function(){
          var no_nota = $(this).attr('data');
            $.ajax({
              type : "GET",
              url  : "<?php echo base_url('retur/get_retur')?>",
              dataType : "JSON",
              data : {no_nota:no_nota},
              success: function(data){
                  var html = '';
                  html += 
                        '<div class="col-md-6">'+
                        '<table style="table-layout:fixed" class="table table-bordered ">'+
                          '<tbody>'+
                            '<tr>'+
                              '<td style="width: 100px">Nama</td>'+
                              '<td style="width: 10px">:</td>'+
                              '<td>'+data.nm_plg+'</td>'+
                            '</tr>'+
                            '<tr>'+
                              '<td>Telepon</td>'+
                              '<td>:</td>'+
                              '<td>'+data.no_telp+'</td>'+
                            '</tr>'+
                            '<tr>'+
                              '<td>Alamat</td>'+
                              '<td>:</td>'+
                              '<td>'+data.alamat+'</td>'+
                            '</tr>'+
                          '</tbody>'+
                        '</table>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                          '<table style="table-layout:fixed" class="table table-bordered ">'+
                          '<tbody>'+
                            '<tr>'+
                              '<td style="width: 150px">Nomor Retur</td>'+
                              '<td style="width: 10px">:</td>'+
                              '<td>'+data.id_retur+'</td>'+
                            '</tr>'+
                            '<tr>'+
                              '<td style="width: 150px">Nomor Nota</td>'+
                              '<td style="width: 10px">:</td>'+
                              '<td>'+data.no_nota+'</td>'+
                            '</tr>'+
                            '<tr>'+
                              '<td style="width: 150px">Tanggal Bayar</td>'+
                              '<td style="width: 10px">:</td>'+
                              '<td>'+data.tgl_retur+'</td>'+
                            '</tr>'+
                          '</tbody>'+
                        '</table>'+
                      '</div>';
                    $('#detail_order1').html(html);

                    $.ajax({
                        type : "GET",
                        url  : "<?php echo base_url('retur/get_detail_retur')?>",
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
                                  '<td><center>'+data[i].sizes+'</center></td>'+
                                  '<td><center>'+data[i].harga+'</center></td>'+
                                  '<td><center>'+data[i].qty+'</center></td>'+
                                  '<td><center>'+data[i].jml_harga+'</center></td>'+
                                '</tr>';
                              total = data[i].total;
                          }
                          $('#detail_order2').html(html);

                        }
                      });

                  $('#ModalReturDetail').modal('show');
              }
            });
            return false;
        });

});
</script> 