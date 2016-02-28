<script src="http://127.0.0.1/CI/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="http://127.0.0.1/CI/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://127.0.0.1/CI/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
if(count($raw_data)>0){
  echo"
  <script type=\"text/javascript\">

  function refresh_tabel_t(table, data) {
    table.clear().draw();
    var check_box;
    var debet_kredit;
    for(var i=0; i<data.length; i++){
        if(data[i].jenis_transaksi=='DEBET')table.row.add( [data[i].id,'',data[i].tanggal,data[i].kode+' '+data[i].mata_anggaran,data[i].uraian,data[i].jumlah_dana,0] ).draw( false );
      else table.row.add( [data[i].id,'<input type=\"checkbox\" name=\"id_kasir[]\" value=\"'+data[i].id+'_'+data[i].tahun_anggaran+'_'+data[i].bagian+'\">',data[i].tanggal,data[i].kode+' '+data[i].mata_anggaran,data[i].uraian,0,data[i].jumlah_dana] ).draw( false );
    }
  }

  function refresh_multi_tabel_t( table, data) {
    switch (table) {
  ";
    for($j=0;$j<count($raw_data);$j++){
    echo"
        case '".$raw_data[$j]->id."':
          refresh_tabel_t(t_".$raw_data[$j]->id.", data);
        break;
    ";
    }
    echo"
    }
  } 

  function MyFunction(value){
  ";
  $js_array = json_encode($raw_data);
  echo "var raw_data = ".$js_array.";
  $('#l_get_id_bagian').text(raw_data[value].bagian);
  $('#get_id_master_tahun_anggaran').val(raw_data[value].id);
  ";
  
  echo"
    

  }
  ";
  for($j=0;$j<count($raw_data);$j++){
    echo"
    var t_".$raw_data[$j]->id." = $('#tabel_kasir_".$raw_data[$j]->id."').DataTable({
        \"autoWidth\": false,
        \"columnDefs\": [
            { \"width\": \"3%\", sClass: \"dt-head-center dt-body-center\", \"bSortable\": false, \"targets\": 1 },
            { \"width\": \"12%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 2 },
            { \"width\": \"15%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 3 },
            { \"width\": \"30%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 4 },
            { \"width\": \"20%\", sClass: \"dt-head-center dt-body-right\", \"type\": \"num-fmt\", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), \"targets\": 5 },
            { \"width\": \"20%\", sClass: \"dt-head-center dt-body-right\", \"type\": \"num-fmt\", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), \"targets\": 6 }
          ]
    }); 
    ";
  }

  echo"

  </script>
  <script type=\"text/javascript\">
      $(document).ready(function(){

  ";
  for($j=0;$j<count($raw_data);$j++){
  echo"   
        t_".$raw_data[$j]->id.".order( [ 0, 'desc' ] ).draw(false);
        t_".$raw_data[$j]->id.".column(0).visible( false );
        $(function(){
        $.ajax({
            type:\"POST\",
              url:\"Kasir/Tabel%20Kasir\",                          
              data:\"id_tahun_anggaran_terkini=".$raw_data[$j]->id."\", 
              dataType: \"json\",                         
                success: function(data){
                  refresh_tabel_t(t_".$raw_data[$j]->id.", data);
            }
          })
        }); 
  ";
  }
  echo"
        $(\"#tambah_form\").click(function(){     
          var id_tahun_anggaran_terkini = $('#get_id_master_tahun_anggaran').val();
          $.ajax({
            type:\"POST\",
            url:\"Kasir/Tambah%20Data%20Kasir%20Form\",
            data:\"id_tahun_anggaran_terkini=\"+id_tahun_anggaran_terkini,
            success:function(data){
              $(\"#pop_up_add\").html(data);
            }
          })
        });  

         $(\"#ubah_form\").click(function(){    
          var id_tahun_anggaran_terkini = $('#get_id_master_tahun_anggaran').val(); 
          var idArray = new Array();
          var tmp;
          $('input[name=\"id_kasir[]\"]:checked').each(function() {
            idArray.push($(this).val());
          });
          if(idArray.length>0){
            $.ajax({
              type:\"POST\",
              url:\"Kasir/Ubah%20Data%20Kasir%20Form\",
              data:\"id_tahun_anggaran_terkini=\"+id_tahun_anggaran_terkini+\"&idArray=\"+idArray,
              success:function(data){
                $(\"#pop_up_edit\").html(data);
              }
            })
          }else{
            alert('Anda belum memilih data!');
            return false;
          }
        }); 

        $(\"#hapus_form\").click(function(){     
          var id_tahun_anggaran_terkini = $('#get_id_master_tahun_anggaran').val(); 
          var idArray = new Array();
          var tmp;
          $('input[name=\"id_kasir[]\"]:checked').each(function() {
            idArray.push($(this).val());
          });
          if(idArray.length>0){
            $.ajax({
              type:\"POST\",
              url:\"Kasir/Hapus%20Data%20Kasir%20Form\",
              data:\"id_tahun_anggaran_terkini=\"+id_tahun_anggaran_terkini+\"&idArray=\"+idArray,
              success:function(data){
                $(\"#pop_up_delete\").html(data);
              }
            })
          }else{
            alert('Anda belum memilih data!');
            return false;
          }
        }); 

        $(\"#simpan\").click(function(){
          var detail_detail_kasir_tanggal = $('input[name=\"detail_detail_kasir_tanggal\"]').val();
          var detail_detail_kasir_mata_anggaran = $('select[name=\"detail_detail_kasir_mata_anggaran\"]').val();
          var detail_detail_kasir_uraian = $('input[name=\"detail_detail_kasir_uraian\"]').val();
          var detail_detail_kasir_jumlah_dana = $('input[name=\"detail_detail_kasir_jumlah_dana\"]').autoNumeric('get');
          var detail_detail_kasir_id_tahun_anggaran_terkini = $('input[name=\"detail_detail_kasir_id_tahun_anggaran_terkini\"]').val();
          
          $.ajax({
            type:\"POST\",
            url:\"Kasir/Tambah%20Data%20Kasir%20Action\",
            contentType: false,
            processData: false,   
            dataType: \"json\",  
            data: function() {
              var data = new FormData();
              data.append(\"detail_detail_kasir_tanggal\", detail_detail_kasir_tanggal);
              data.append(\"detail_detail_kasir_mata_anggaran\", detail_detail_kasir_mata_anggaran);
              data.append(\"detail_detail_kasir_uraian\", detail_detail_kasir_uraian);
              data.append(\"detail_detail_kasir_jumlah_dana\", detail_detail_kasir_jumlah_dana);
              data.append(\"detail_detail_kasir_id_tahun_anggaran_terkini\", detail_detail_kasir_id_tahun_anggaran_terkini);
              return data;
            }(),
            success:function(data){
            refresh_multi_tabel_t(detail_detail_kasir_id_tahun_anggaran_terkini , data);
            }
          })
        });

        $(\"#ubah\").click(function(){
          var edit_detail_kasir_id_transaksi_pengajuan_anggaran = new Array(); 
          var edit_detail_kasir_tanggal = new Array();
          var edit_detail_kasir_id = new Array();
          var edit_detail_kasir_mata_anggaran = new Array();
          var edit_detail_kasir_uraian = new Array();
          var edit_detail_kasir_jumlah_dana = new Array();
          
          $('input[name=\"edit_detail_kasir_id_transaksi_pengajuan_anggaran[]\"]').each(function() {
            edit_detail_kasir_id_transaksi_pengajuan_anggaran.push($(this).val());
          });   

          $('input[name=\"edit_detail_kasir_tanggal[]\"]').each(function() {
            edit_detail_kasir_tanggal.push($(this).val());
          });   

          $('input[name=\"edit_detail_kasir_id[]\"]').each(function() {
            edit_detail_kasir_id.push($(this).val());
          });  

          $('select[name=\"edit_detail_kasir_mata_anggaran[]\"]').each(function() {
            edit_detail_kasir_mata_anggaran.push($(this).val());
          });  

          $('input[name=\"edit_detail_kasir_uraian[]\"]').each(function() {
            edit_detail_kasir_uraian.push($(this).val());
          });  

          $('input[name=\"edit_detail_kasir_jumlah_dana[]\"]').each(function() {
            edit_detail_kasir_jumlah_dana.push($(this).autoNumeric('get'));
          });  

          $.ajax({
            type:\"POST\",
            url:\"Kasir/Ubah%20Data%20Kasir%20Action\",
            contentType: false,
            processData: false,   
            dataType: \"json\",  
            data: function() {
              var data = new FormData();
              data.append(\"edit_detail_kasir_id_transaksi_pengajuan_anggaran\", edit_detail_kasir_id_transaksi_pengajuan_anggaran);
              data.append(\"edit_detail_kasir_tanggal\", edit_detail_kasir_tanggal);
              data.append(\"edit_detail_kasir_id\", edit_detail_kasir_id);
              data.append(\"edit_detail_kasir_mata_anggaran\", edit_detail_kasir_mata_anggaran);
              data.append(\"edit_detail_kasir_uraian\", edit_detail_kasir_uraian);
              data.append(\"edit_detail_kasir_jumlah_dana\", edit_detail_kasir_jumlah_dana);
              return data;
            }(),
            success:function(data){
              refresh_multi_tabel_t(edit_detail_kasir_id_transaksi_pengajuan_anggaran[0] , data);
              alert(\"Data berhasil diubah!\");
            }
          })
        });

        $(\"#hapus\").click(function(){
          var detail_detail_kasir_id_transaksi_pengajuan_anggaran = new Array(); 
          var detail_detail_kasir_id = new Array();
          var detail_detail_kasir_mata_anggaran = new Array();   

          $('input[name=\"detail_detail_kasir_id_transaksi_pengajuan_anggaran[]\"]').each(function() {
            detail_detail_kasir_id_transaksi_pengajuan_anggaran.push($(this).val());
          });   

          $('input[name=\"detail_detail_kasir_id[]\"]').each(function() {
            detail_detail_kasir_id.push($(this).val());
          });  

          $('input[name=\"detail_detail_kasir_mata_anggaran[]\"]').each(function() {
            detail_detail_kasir_mata_anggaran.push($(this).val());
          });  
          
          $.ajax({
            type:\"POST\",
            url:\"Kasir/Hapus%20Data%20Kasir%20Action\",
            contentType: false,
            processData: false,   
            dataType: \"json\",  
            data: function() {
              var data = new FormData();
              data.append(\"detail_detail_kasir_id_transaksi_pengajuan_anggaran\", detail_detail_kasir_id_transaksi_pengajuan_anggaran);
              data.append(\"detail_detail_kasir_id\", detail_detail_kasir_id);
              data.append(\"detail_detail_kasir_mata_anggaran\", detail_detail_kasir_mata_anggaran);
              return data;
            }(),
            success:function(data){
             refresh_multi_tabel_t(detail_detail_kasir_id_transaksi_pengajuan_anggaran[0] , data);
             alert(\"Data berhasil dihapus!\");
            }
          })
        });    

      });
  </script> 
  ";


  echo" 
    <div class=\"row\">
      <div class=\"col-xs-12\">
        <!-- box box-primary -->
        <div class=\"box box-primary\">
  ";

  echo"
  <div class=\"box-header with-border\">
    <div class=\"modal-body\">
        <div class=\"form-group\">
            <label for=\"info\">Tahun anggaran</label>&nbsp;:&nbsp;<label for=\"info\">".$raw_data[0]->tahun_anggaran."</label>
          </div>
      <div class=\"form-group\">
              <label for=\"info\">Bagian</label>&nbsp;:&nbsp;<label for=\"info_long\" id=\"l_get_id_bagian\">".$raw_data[0]->bagian."</label>
              <input type=\"hidden\" class=\"form-control\" id=\"get_id_master_tahun_anggaran\" value=\"".$raw_data[0]->id."\">  
          </div>
    </div>
    <button class=\"btn btn-primary \" id=\"tambah_form\" data-toggle=\"modal\" data-target=\"#mymodaladd\"><i class=\"fa fa-plus\"></i>Tambah pengeluaran</button>
    <button class=\"btn btn-success\" id=\"ubah_form\" data-toggle=\"modal\" data-target=\"#mymodaledit\"><i class=\"fa fa-pencil-square-o\"></i>Ubah</button>
    <button class=\"btn btn-danger\" id=\"hapus_form\" data-toggle=\"modal\" data-target=\"#mymodaldelete\"><i class=\"fa fa-trash\"></i>Hapus</button>
    <br><br>
            <div class=\"modal fade\" id=\"mymodaladd\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
              <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                  <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\" id=\"myModalLabel\">Tambah Data Pengeluaran</h4>
                  </div>
                  <div class=\"modal-body\">
                    <div id=\"pop_up_add\">
                    </div>
                  </div>
                  <div class=\"modal-footer\">
                    <button class=\"btn btn-primary \" id=\"simpan\" data-dismiss=\"modal\">Simpan</button>
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
            <div class=\"modal fade\" id=\"mymodaledit\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
              <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                  <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\" id=\"myModalLabel\">Ubah Data Pengeluaran</h4>
                  </div>
                  <div class=\"modal-body\">
                    <div id=\"pop_up_edit\">
                    </div>
                  </div>
                  <div class=\"modal-footer\">
                    <button class=\"btn btn-success \" id=\"ubah\" data-dismiss=\"modal\">Ubah</button>
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
            <div class=\"modal fade\" id=\"mymodaldelete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
              <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                  <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\" id=\"myModalLabel\">Hapus Data Pengeluaran</h4>
                  </div>
                  <div class=\"modal-body\">
                    <div id=\"pop_up_delete\">
                    </div>
                  </div>
                  <div class=\"modal-footer\">
                    <button class=\"btn btn-success \" id=\"hapus\" data-dismiss=\"modal\">Hapus</button>
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
  ";
  echo"
          <div class=\"nav-tabs-custom\">
            <ul class=\"nav nav-tabs\">
    ";
    for($j=0;$j<count($raw_data);$j++){
    echo"
              <li ";
    if($j==0) echo"class=\"active\"";
    echo"
          ><a href=\"#tab_$j\" data-toggle=\"tab\" onclick=\"MyFunction($j);\">".$raw_data[$j]->bagian."</a></li>
    ";
  }
    echo"   </ul>
            <div class=\"tab-content\">
    ";

  for($j=0;$j<count($raw_data);$j++){
      echo"        
            <div class=\"tab-pane 
        ";
        if($j==0) echo"active"; 
        echo"\" id=\"tab_$j\">
        <table id=\"tabel_kasir_".$raw_data[$j]->id."\" class=\"table table-bordered table-striped\">
              <thead>
                  <tr>
                      <th></th>
                      <th></th>
                      <th>Tanggal</th>
                      <th>No. MA</th>
                      <th>Uraian</th>
                      <th>Debet</th>
                      <th>Kredit</th>
                  </tr>
              </thead>
              <tfoot>
              </tfoot>
                </table> 
            </div>
      ";
  }
    echo"
            </div>
          </div>
        </div>  
  ";
  echo"
        </div>
      </div>
    </div>
    ";  

  /*
  for($j=0;$j<count($raw_data);$j++){
  echo" 
    <div class=\"row\">
      <div class=\"col-xs-12\">
        <!-- box box-primary -->
        <div class=\"box box-primary\">
          <!-- box-header -->
          <div class=\"box-header with-border\">
            <div class=\"modal-body\">
              <div class=\"form-group\">
                          <label for=\"info\">Tahun anggaran</label>&nbsp;:&nbsp;<label for=\"info\">".$raw_data[$j]->tahun_anggaran."</label>
                        </div>
              <div class=\"form-group\">
                            <label for=\"info\">Bagian</label>&nbsp;:&nbsp;<label for=\"info_long\">".$raw_data[$j]->bagian."</label>
                        </div>
            </div>
            <button class=\"btn btn-primary \" id=\"tambah_form_".$j."\" data-toggle=\"modal\" data-target=\"#mymodaladd\"><i class=\"fa fa-plus\"></i>Tambah pengeluaran</button>
            <button class=\"btn btn-success\" id=\"ubah_form_".$j."\" data-toggle=\"modal\" data-target=\"#mymodaledit\"><i class=\"fa fa-pencil-square-o\"></i>Ubah</button>
            <button class=\"btn btn-danger\" id=\"hapus_form_".$j."\" data-toggle=\"modal\" data-target=\"#mymodaldelete\"><i class=\"fa fa-trash\"></i>Hapus</button>
            <div class=\"modal fade\" id=\"mymodaladd\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
              <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                  <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\" id=\"myModalLabel\">Tambah Data Pengeluaran</h4>
                  </div>
                  <div class=\"modal-body\">
                    <div id=\"pop_up_add_".$j."\">
                    </div>
                  </div>
                  <div class=\"modal-footer\">
                    <button class=\"btn btn-primary \" id=\"simpan\" data-dismiss=\"modal\">Simpan</button>
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
            <div class=\"modal fade\" id=\"mymodaledit\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
              <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                  <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\" id=\"myModalLabel\">Ubah Data Pengeluaran</h4>
                  </div>
                  <div class=\"modal-body\">
                    <div id=\"pop_up_edit_".$j."\">
                    </div>
                  </div>
                  <div class=\"modal-footer\">
                    <button class=\"btn btn-success \" id=\"ubah\" data-dismiss=\"modal\">Ubah</button>
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
            <div class=\"modal fade\" id=\"mymodaldelete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
              <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                  <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\" id=\"myModalLabel\">Hapus Data Pengeluaran</h4>
                  </div>
                  <div class=\"modal-body\">
                    <div id=\"pop_up_delete_".$j."\">
                    </div>
                  </div>
                  <div class=\"modal-footer\">
                    <button class=\"btn btn-success \" id=\"hapus\" data-dismiss=\"modal\">Hapus</button>
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
                  <div class=\"box-body\">
          <table id=\"tabel_kasir_".$j."\" class=\"table table-bordered table-striped\">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Tanggal</th>
                        <th>No. MA</th>
                        <th>Uraian</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                  </table>                   
                  </div>
        </div>
      </div>
    </div>
    ";        
  }
  */
}else{
  echo "Anda belum mengisi data anggaran tahun ini.";
}
?>