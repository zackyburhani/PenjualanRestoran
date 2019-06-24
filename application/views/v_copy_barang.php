<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Copy Barang
      <small></small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <button class="btn btn-info" id="tambahBarang" data-toggle="modal" href="#" data-target="#ModalTambahBarang"><i class="fa fa-plus"></i> Tambah Data Copy Barang</button> 
          </div>
          <div class="panel-body">
      
              <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataBarang">
                <thead>
                  <tr>
                    <th width="5%">No. </th>
                    <th width="150px"><center>Nama Barang</center></th>
                    <th width="150px"><center>Size</center></th>
                    <th width="150px"><center>Stok</center></th>
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
  
<!-- MODAL ADD -->
<div class="modal fade" id="ModalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Tambah Barang</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <input type="hidden" id="kd_copy_id">

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Barang</label>
            <div class="col-xs-9">
              <select style="width:335px;" class="form-control select2" name="nm_barang" id="kd_barang_id">
                <?php foreach($barang as $brg) { ?>
                  <option value="<?php echo $brg->id_brg ?>"><?php echo $brg->nm_brg ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Size</label>
            <div class="col-xs-9">
              <select style="width:335px;" class="form-control" id="size_id" name="size">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Stok</label>
            <div class="col-xs-9">
              <input name="stok" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="stok_id" class="form-control" type="number" min="0" placeholder="Stok" style="width:335px;" required>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
          <button class="btn btn-primary" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
<div class="modal fade" id="ModalEditBarang" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Ubah Barang</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <input type="hidden" id="id_copy_edit">

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Barang</label>
            <div class="col-xs-9">
              <select style="width:335px;" class="form-control select2" name="id_barang_edit" id="id_barang_edit">
                <?php foreach($barang as $brg) { ?>
                  <option value="<?php echo $brg->id_brg ?>"><?php echo $brg->nm_brg ?></option>
                <?php } ?>
              </select>
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-xs-3" >Size</label>
            <div class="col-xs-9">
              <select style="width:335px;" class="form-control" id="size_id_edit" name="size">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Stok</label>
            <div class="col-xs-9">
              <input name="stok" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="stok_id_edit" class="form-control" type="number" min="0" placeholder="Stok" style="width:335px;" required>
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
<div class="modal fade" id="ModalHapusBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
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
  tampil_data_barang(); //pemanggilan fungsi tampil barang.
    
  $('#dataBarang').dataTable();
     
  //fungsi tampil barang
  function tampil_data_barang(){
    $.ajax({
      type  : 'ajax',
      url   : "<?php echo base_url('ControllerBarang/data_barang_copy')?>",
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
              '<td>'+data[i].nm_brg+'</td>'+
              '<td align="center">'+data[i].sizes+'</td>'+
              '<td align="center">'+data[i].stok+'</td>'+
              '<td style="text-align:center;">'+
                '<button data-target="javascript:;" class="btn btn-warning barang_edit" data="'+data[i].id_copy+'"><span class="glyphicon glyphicon-edit"></span></button>'+' '+
                '<button data-target="javascript:;" class="btn btn-danger barang_hapus" data="'+data[i].id_copy+'"><span class="glyphicon glyphicon-trash"></span></button>'+
              '</td>'+
            '</tr>';
        }
        $('#show_data').html(html);
      }
    });
  }

  //get Kode
  $("#tambahBarang").click(function(){
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('ControllerBarang/getKode_copy')?>",
      dataType : "JSON",
      success: function(data){
        $.each(data,function(kd_pelanggan){
          $('#ModalTambahBarang').modal('show');
          $('#kd_copy_id').val(data.kd_barang);
        });
      }
    });
    return false;
  });

  //GET UPDATE
  $('#show_data').on('click','.barang_edit',function(){
    var id_copy = $(this).attr('data');
    $.ajax({
      type : "GET",
      url  : "<?php echo base_url('ControllerBarang/get_barang_copy')?>",
      dataType : "JSON",
      data : {id_copy:id_copy},
      success: function(data){
          $('#ModalEditBarang').modal('show');
          $('[name="id_barang_edit"]').val(data.id_brg).trigger('change');
          $('#size_id_edit').val(data.sizes);
          $('#stok_id_edit').val(data.stok);
          $('#id_copy_edit').val(data.id_copy);
      }
    });
    return false;
  });

  //GET HAPUS
  $('#show_data').on('click','.barang_hapus',function(){
    var id = $(this).attr('data');
    $('#ModalHapusBarang').modal('show');
    $('[name="kode"]').val(id);
  });

  //Simpan Barang
  $('#btn_simpan').on('click',function(){
    var id_copy = $('#kd_copy_id').val();
    var id_brg = $('#kd_barang_id').val();
    var stok = $('#stok_id').val();
    var size = $('#size_id').val();
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('ControllerBarang/simpan_copy')?>",
      dataType : "JSON",
      data : {id_copy:id_copy,id_brg:id_brg,stok:stok,size:size},
      success: function(data){
        $('[name="kd_barang"]').val("");
        $('[name="stok"]').val("");
        $('#ModalTambahBarang').modal('hide');
        setTimeout(function() {
            swal("Berhasil Disimpan", "", "success");
        }, 600);
        tampil_data_barang();
      }
    });
    return false;
  });

  //Update Barang
  $('#btn_update').on('click',function(){

    var id_copy = $('#id_copy_edit').val();
    var id_brg = $('#id_barang_edit').val();
    var size = $('#size_id_edit').val();
    var stok = $('#stok_id_edit').val();
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('ControllerBarang/ubah_copy')?>",
      dataType : "JSON",
      data : {id_copy:id_copy,id_brg:id_brg,stok:stok,size:size},
      success: function(data){
        $('[name="kd_barang"]').val("");
        $('[name="stok"]').val("");
        $('#ModalEditBarang').modal('hide');
        setTimeout(function() {
          swal("Berhasil Disimpan", "", "success");
        }, 600);
        tampil_data_barang();
      }
    });
    return false;
  });

  //Hapus Barang
  $('#btn_hapus').on('click',function(){
    var kd_barang = $('#textkode').val();
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('ControllerBarang/hapus_copy')?>",
      dataType : "JSON",
      data : {kd_barang: kd_barang},
      success: function(data){
        $('#ModalHapusBarang').modal('hide');
        tampil_data_barang();
      }
    });
    return false;
  });

});
</script>

 