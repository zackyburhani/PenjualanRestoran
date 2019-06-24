  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Pelanggan
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
                    <th width="50px">No. </th>
                    <th><center>Nama Pelanggan</center></th>
                    <th width="150px"><center>Telepon</center></th>
                    <th><center>Alamat</center></th>
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

<!-- MODAL EDIT -->
<div class="modal fade" id="ModalEditPelanggan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Ubah Pelanggan</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label col-xs-3" >Kode Pelanggan</label>
            <div class="col-xs-9">
              <input name="kd_pelanggan_edit" id="kd_pelanggan_id_edit" class="form-control" type="text" placeholder="Kode Pelanggan" style="width:335px;" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Pelanggan</label>
            <div class="col-xs-9">
              <input name="nm_pelanggan_edit" id="nm_pelanggan_id_edit" class="form-control" type="text" placeholder="Nama Pelanggan" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nomor Telepon</label>
            <div class="col-xs-9">
              <input name="no_telp_edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="no_telp_id_edit" class="form-control" type="text" placeholder="Nomor Telepon" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Alamat</label>
            <div class="col-xs-9">
              <textarea name="alamat_edit" rows="4" cols="5" id="alamat_id_edit" class="form-control"></textarea>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
          <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL EDIT-->

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapusPelanggan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Pelanggan</h4>
      </div>
      <form class="form-horizontal">
      
        <div class="modal-body">              
          <input type="hidden" name="kode" id="textkode" value="">
            <p>Apakah Anda yakin mau menghapus ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!--END MODAL HAPUS-->

<script type="text/javascript">
  $(document).ready(function(){
  tampil_data_pelanggan(); //pemanggilan fungsi tampil pelanggan.
    
  $('#dataPelanggan').dataTable();
     
  //fungsi tampil barang
  function tampil_data_pelanggan(){
    $.ajax({
      type  : 'ajax',
      url   : "<?php echo base_url('pelanggan/data_pelanggan')?>",
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
              '<td>'+data[i].nm_plg+'</td>'+
              '<td>'+data[i].no_telp+'</td>'+
              '<td>'+data[i].alamat+'</td>'+
              '<td style="text-align:center;">'+
              '<button data-target="javascript:;" class="btn btn-warning pelanggan_edit" data="'+data[i].id_plg+'"><span class="glyphicon glyphicon-edit"></span></button>'+' '+
              '<button data-target="javascript:;" class="btn btn-danger pelanggan_hapus" data="'+data[i].id_plg+'"><span class="glyphicon glyphicon-trash"></span></button>'+
              '</td>'+
            '</tr>';
          }
        $('#show_data').html(html);
      }
    });
  }

    //GET UPDATE
    $('#show_data').on('click','.pelanggan_edit',function(){
      var kd_pelanggan = $(this).attr('data');
        $.ajax({
          type : "GET",
          url  : "<?php echo base_url('pelanggan/get_pelanggan')?>",
          dataType : "JSON",
          data : {id_plg:kd_pelanggan},
          success: function(data){
            $.each(data,function(id_plg, nm_plg, no_telp, alamat){
              $('#ModalEditPelanggan').modal('show');
              $('[name="kd_pelanggan_edit"]').val(data.id_plg);
              $('[name="nm_pelanggan_edit"]').val(data.nm_plg);
              $('[name="no_telp_edit"]').val(data.no_telp);
              $('[name="alamat_edit"]').val(data.alamat);
            });
          }
        });
        return false;
    });

    //GET HAPUS
    $('#show_data').on('click','.pelanggan_hapus',function(){
      var id = $(this).attr('data');
      $('#ModalHapusPelanggan').modal('show');
      $('[name="kode"]').val(id);
    });

    //Update Barang
    $('#btn_update').on('click',function(){
      var id_plg = $('#kd_pelanggan_id_edit').val();
      var nm_plg = $('#nm_pelanggan_id_edit').val();
      var no_telp = $('#no_telp_id_edit').val();
      var alamat = $('#alamat_id_edit').val();
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('pelanggan/ubah')?>",
        dataType : "JSON",
        data : {id_plg:id_plg , nm_plg:nm_plg, no_telp:no_telp, alamat:alamat},
        success: function(data){
          $('[name="kd_pelanggan_edit"]').val("");
          $('[name="nm_pelanggan_edit"]').val("");
          $('[name="no_telp_edit"]').val("");
          $('[name="no_alamat_edit"]').val("");
          $('#ModalEditPelanggan').modal('hide');
          setTimeout(function() {
              swal("Berhasil Disimpan", "", "success");
                  }, 600);
          tampil_data_pelanggan();
        }
      });
      return false;
    });

    //Hapus Barang
    $('#btn_hapus').on('click',function(){
      var kd_pelanggan = $('#textkode').val();
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('pelanggan/hapus')?>",
        dataType : "JSON",
        data : {kd_pelanggan: kd_pelanggan},
        success: function(data){
          $('#ModalHapusPelanggan').modal('hide');
          tampil_data_pelanggan();
        }
      });
      return false;
    });

  });
</script>

 