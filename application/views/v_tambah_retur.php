<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Tambah Data Retur
      <small></small>
    </h1>
  </section>

  <tes></tes>

  <section class="content">
    <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-body">
              
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group"><label>Cari Nomor Nota</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="cari_nomor_nota">
                          <span class="input-group-btn">
                            <button type="button" onclick="cari()" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                          </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group"><label>Nomor Nota</label>
                    <input required class="form-control required text-capitalize" placeholder="Nomor Nota" data-placement="top" readonly data-trigger="manual" type="text" name="no_nota">
                  </div>              
                </div>
                <div class="col-md-6">
                  <div class="form-group"><label>Tanggal Nota</label>
                    <input required class="form-control required text-capitalize" placeholder="Tanggal Nota" data-placement="top" readonly data-trigger="manual" type="text" name="tgl_nota">
                    <input required class="form-control required" readonly data-trigger="manual" type="hidden" name="id_pesan">
                  </div>              
                </div>
              </div>

              <hr>

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
           </div>
          </div>
        </div>

  <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <label>Tambah Data Retur</label>
          </div>
          <div class="panel-body">
            <div class="col-md-12">
              <form class="form-horizontal">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-1">
                    <label class="control-label">Barang</label>
                  </div>
                  <div class="col-md-5" >
                    <select class="form-control select2" name="id_brg">
                      <?php foreach($barang as $brg){ ?>

                        <?php 
                          $stok = $brg->stok;
                          $size = $brg->size;
                          $harga = $brg->harga;

                          if($stok == "" || $harga == "" || $size == ""){
                            $stok = '-';
                            $size = '-';
                            $harga = '-';
                          }

                         ?> 

                        <option value="<?php echo $brg->id_copy ?>"><?php echo $brg->nm_brg." / ".$size." / ".$stok." / ".number_format((int)$harga,0,',','.')." / " ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-1">
                    <label class="control-label">Jumlah</label>
                  </div>
                  <div class="col-md-2">
                    <input type="number" name="qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" placeholder="QTY" required class="form-control">
                  </div>
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-md-6">
                        <button class="btn btn-primary btn-md add_cart" type="button"><span class="fa fa-plus"></span> Tambah Data</button>
                      </div>
                      <div class="col-md-6"> 
                        <button type="button" id="btn_proses" data-target="#ModalTambahPesan" data-toggle="modal" class="btn btn-success btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
              
          <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th align="center" width="50px">No. </th>
                <th align="center"><center>Nama Barang</center></th>
                <th align="center"><center>Size</center></th>
                <th align="center"><center>QTY</center></th>
                <th align="center"><center>Harga</center></th>
                <th align="center"><center>Jumlah Harga</center></th>
                <th align="center"><center>Hapus</center></th>
              </tr>
            </thead>
            <tbody id="detail_cart">
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>
</div>

<!--MODAL RETUR-->
<div class="modal fade" id="ModalTambahRetur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="myModalLabel">Retur / <b id="id_rtr"></b></h4>
      </div>
      <form class="form-horizontal">
      
        <div class="modal-body">              
          <input type="hidden" name="kode" id="textkode" value="">
            <p>Apakah anda yakin ingin memproses data ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button class="btn btn-primary" id="btn_simpan">Proses</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!--END MODAL RETUR-->

  <script type="text/javascript">
    $(document).ready(function(){

        $('.add_cart').attr('disabled',true);
        $('#btn_proses').attr('disabled',true);

        $('[name="qty"]').keypress(function (event) {
            if (event.keyCode === 10 || event.keyCode === 13) {
                event.preventDefault();
            }
        });

        $('.add_cart').click(function(e){
            var id_brg = $('[name="id_brg"]').val();
            var qty = $('[name="qty"]').val();

            if (qty == "") {
                swal({
                  title: "QTY Tidak Boleh Kosong",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
                e.preventDefault();
                return false;
            }

            if(qty == 0){
              qty = $('[name="qty"]').val("");              
              return false;
            }

            //cek stok
            $.ajax({
              url : "<?php echo base_url('ControllerRetur/cekStok');?>",
              method : "POST",
              dataType: 'JSON',
              data : {id_brg: id_brg},
              success: function(data){
                var stok = data;
                if(data < qty){
                  swal({
                    title: "Stok Tidak Cukup",
                    text: "",
                    icon: "error",
                    button: "Ok !",
                  });
                  e.preventDefault();
                  return false;
                }

                $.ajax({
                  url : "<?php echo base_url('ControllerRetur/add_to_cart');?>",
                  method : "POST",
                  data : {id_brg: id_brg, qty:qty},
                  success: function(data){

                    //cek stok 2
                    $.ajax({
                      url : "<?php echo base_url('ControllerRetur/cekStok_2');?>",
                      method : "POST",
                      dataType: 'JSON',
                      data : {id_brg: id_brg},
                      success: function(quantity){
            
                        if(quantity > stok){
                          swal({
                            title: "Stok Tidak Cukup",
                            text: "",
                            icon: "error",
                            button: "Ok !",
                          });

                          total = quantity-parseInt(qty);
                          $.ajax({
                            url : "<?php echo base_url('ControllerRetur/add_to_cart');?>",
                            method : "POST",
                            data : {id_brg: id_brg, qty:total},
                            success: function(data){
                              $('[name="qty"]').val("");
                              $('#detail_cart').html(data);
                            }
                          });
                          return false;
                        }
                      }
                    });
                    $('[name="qty"]').val("");
                    $('#detail_cart').html(data);
                  }
                });

              }
            });
        }); 
 
        //Hapus Item Cart
        $(document).on('click','.hapus_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url('ControllerRetur/hapus_cart');?>",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });

        //get Kode
        $("#btn_proses").click(function(){ 

          //untuk validasi tombol simpan
          $.ajax({
            url  : "<?php echo base_url('ControllerRetur/cekCart')?>",
            dataType : "JSON",
            success: function(data){
              if(data == false){
                swal({
                  title: "Tidak Ada Data Yang Diproses",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
                return false;
              } else {

                $.ajax({
                  type : "GET",
                  url  : "<?php echo base_url('retur/getKode')?>",
                  dataType : "JSON",
                  success: function(data){
                    $.each(data,function(id_retur){
                      $('#ModalTambahRetur').modal('show');
                      $('#id_rtr').text(data.id_retur);
                    });
                  }
                });
              }
            }
          });

            return false;
        });

        //Simpan retur
        $('#btn_simpan').on('click',function(){
          var id_retur = $('#id_rtr').text();
          var no_nota = $('[name="no_nota"]').val();
          var id_pesan = $('[name="id_pesan"]').val();

          $.ajax({
            type : "POST",
            url  : "<?php echo base_url('retur/simpan')?>",
            dataType : "JSON",
            data : {id_retur:id_retur, no_nota:no_nota, id_pesan:id_pesan},
            success: function(data){
              $('#ModalTambahRetur').modal('hide');

              $.ajax({
                type : "GET",
                url  : "<?php echo base_url('ControllerRetur/load_detail')?>",
                dataType : "JSON",
                success: function(data){

                  $.each(data,function(index,objek){
                    var id = objek.id;
                    var qty = objek.qty;
                    var price = objek.price;
              
                    $.ajax({
                      type : "POST",
                      url  : "<?php echo base_url('retur/simpan_detail')?>",
                      dataType : "JSON",
                      data : {id_brg:id, id_retur:id_retur, qty:qty, jml_bayar:price},
                    }); 

                  });
                }
              });  

              swal({
                  title: "Berhasil Disimpan",
                  text: "",
                  icon: "success",
                  button: "Ok !",
                }).then(function() {
                  window.location.href = "<?php echo site_url('retur') ?>";
                  $('#detail_cart').load('<?php echo base_url('retur/destroy') ?>');
              });
            }
          });
          return false;
        });
    });

// function dropdown(data)
// {
//   // console.log(data);

//   //ambil data dengan harga yang sama
//   $.ajax({
//     type : "GET",
//     url  : "<?php echo base_url('retur/get_barang')?>",
//     dataType : "JSON",
//     success: function(barang){

//       var i = 0;
//       for(i=0; i<barang.length; i++){
//         // console.log(barang[i].harga);
//         // console.log(data[i]);

//         if(data[i] == undefined){
//           continue;
//         }

//         if(barang[i].harga == data[i].harga){
//           var tmp = [{idBrg : barang[i].id_brg,nmBrg : barang[i].nm_brg}];
//         }
//       }

//       for(var val in data) {
//           $('#taro').append($('<option />', {value: data[val].id_brg, text: data[val].nm_brg}));
          
//       }
      
//     }
//   });
// }

function cari()
{
  var no_nota = $('[name="cari_nomor_nota"]').val();
  $('#detail_cart').load('<?php echo base_url('retur/destroy') ?>');
  $.ajax({
    type : "GET",
    url  : "<?php echo base_url('retur/get_nota')?>",
    dataType : "JSON",
    data : {no_nota:no_nota},
    success: function(data){

      // dropdown(data);

      if(data == null){
        swal({
          title: "Data Tidak Ditemukan",
          text: "",
          icon: "error",
          button: "Ok !",
          });
        $('#detail_order2').html(null);
        $('[name="no_nota"]').val("");
        $('[name="tgl_nota"]').val("");
        $('[name="id_pesan"]').val("");
        return false;
      }

      var html = '';
      var i;
      no = 1;
      for(i=0; i<data.length; i++){

        html += 
        '<tr>'+
          '<td align="center">'+ no++ +'.'+'</td>'+
          '<td align="center">'+data[i].id_brg+'</td>'+
          '<td align="center">'+data[i].nm_brg+'</td>'+
          '<td align="center">'+data[i].sizes+'</td>'+
          '<td align="center">'+data[i].harga+'</td>'+
          '<td align="center">'+data[i].qty+'</td>'+
          '<td align="center">'+data[i].jml_bayar+'</td>'+
          '</td>'+
        '</tr>';

        nta = data[i].no_nota;
        tgl_nta = data[i].tgl_nota;
        id_psn = data[i].id_pesan;
      }
      $('#detail_order2').html(html);
      $('[name="no_nota"]').val(nta);
      $('[name="tgl_nota"]').val(tgl_nta);
      $('[name="id_pesan"]').val(id_psn);
      $('.add_cart').attr('disabled',false);
      $('#btn_proses').attr('disabled',false);

    }
  });

}
</script> 