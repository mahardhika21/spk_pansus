<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo $url .'/assets/css/bootstrap.min.css'; ?>" rel="stylesheet">
<link href="<?php echo $url .'/assets/css/bootstrap-responsive.min.css'; ?>" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $url .'/assets/css/font-awesome.css'; ?>" rel="stylesheet">
<link href="<?php echo $url .'/assets/css/style.css'; ?>" rel="stylesheet">
<link href="<?php echo $url .'/assets/css/pages/dashboard.css'; ?>" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
</head>
<style type="text/css">

</style>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">Gizi Panti </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> admin <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="{{@$url}}/logout">Logout</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->

<div class="subnavbar">



  {!!$part['header']!!}
  <!-- /subnavbar-inner --> 
  <?php $csrfToken = csrf_token(); ?>
</div>


<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">

         {!!$part['menu']!!}
          <!-- /widget -->
         <!-- /widget -->
          
          <!-- /widget -->
        </div>
        <!-- /span6 --> 

        <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> 
              <h3> Data Keckupan Gizi</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                
                <div class="widget-content" style="margin: 12px;">
                  <a type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addGizi">Tambah Data Kecukupan Gizi</a>
                              <?php 
                                     $msg = Session::get('msg');
                                    if(!empty($msg)){  ?>
                                              <div class="alert alert-{{@$msg['code']}}" style="margin-top: 2px;">
                                                    <strong>{{@$msg['status']}}</strong> {{ @$msg['message']}}
                                               </div>
                                       <?php } ?>
                                       
                                      <div class="table-responsive">
                                                            <table class="table" id="table-gizi" style="margin: 12px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>kalori minimum</th>
                                                                        <th>protein minimu</th>
                                                                        <th>Lemak Minimum</th>
                                                                        <th>Karbo Minimum</th>
                                                                        <th>Range age</th>
                                                                        <th>Option</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                      </div> 
                  
                </div>
                
              </div>
            </div>
          </div>
           
        </div>
        
      </div>
       
    </div>
    
  </div>
   
</div>

<div id="addGizi" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/kecukupan_gizi_crud/insert_data'; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data Kecukupan Gizi</h4>
      </div>
      <div class="modal-body">
                    <div class="control-group">                     
                      <label class="control-label" >Kalori Minimum</label>
                      <div class="controls">
                        <input type="hidden" name="type_pangan" value="lauk">
                        <input type="text" class="span4" id="nama_pangan_ins" name="kalori_minimum" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label">Protein Minimum</label>
                      <div class="controls">
                        <input type="text" class="span4" id="kalori_pangan_ins" name="protein_minimum" value="" required="">
                         <small style="color: red;">satuan KKL (KKL)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Lemak Minimum</label>
                      <div class="controls">
                        <input type="text" class="span4" id="protein_pangan_ins" name="lemak_minimum" value="" required="">
                         <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Karbohitrat Minimum</label>
                      <div class="controls">
                        <input type="text" class="span4" id="lemak_pangan_ins" name="karbo_minimum" value="" required="">
                         <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div>
                     <div class="control-group">                     
                      <label class="control-label" >Range Usia</label>
                      <div class="controls">
                        <input type="hidden" name="_token" value="<?php echo $csrfToken; ?>">
                        <input type="text" class="span4" id="karbo_pangan_ins" name="range_age" value="" required="">
                         <small style="color: red;">example 10 - 12 Tahun</small>
                      </div>        
                    </div>
                   
      </div>
      <div class="modal-footer">
        <a class="btn btn-info" id="insData">Tambah Data Lauk</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>



<div id="updateGizi" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/kecukupan_gizi_crud/update_data'; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Perbarui Data Kecukupan Gizi</h4>
      </div>
      <div class="modal-body">
                  <div class="control-group">                     
                      <label class="control-label" >Kalori Minimum</label>
                      <div class="controls">
                        <input type="hidden" name="id_kecukupan_gizi" id="id_kecukupan_gizi_up" value="">
                        <input type="text" class="span4" id="kalori_minimum_up" name="kalori_minimum" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label">Protein Minimum</label>
                      <div class="controls">
                        <input type="text" class="span4" id="protein_minimum_up" name="protein_minimum" value="" required="">
                         <small style="color: red;">satuan KKL (KKL)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Lemak Minimum</label>
                      <div class="controls">
                        <input type="text" class="span4" id="lemak_minimum_up" name="lemak_minimum" value="" required="">
                         <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Karbohitrat Minimum</label>
                      <div class="controls">
                        <input type="text" class="span4" id="karbo_minimum_up" name="karbo_minimum" value="" required="">
                         <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div>
                     <div class="control-group">                     
                      <label class="control-label" >Range Usia</label>
                      <div class="controls">
                        <input type="hidden" name="_token" value="<?php echo $csrfToken; ?>">
                        <input type="text" class="span4" id="range_age_up" name="range_age" value="" required="">
                         <small style="color: red;">example 10 - 12 Tahun</small>
                      </div>        
                    </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" type="submit">Update Data</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>



<script src="<?php echo $url .'/assets/js/jquery-1.7.2.min.js'; ?>"></script> 
<script src="<?php echo $url .'/assets/js/excanvas.min.js'; ?>"></script> 
<script src="<?php echo $url.'/assets/js/chart.min.js'; ?>" type="text/javascript"></script> 
<script src="<?php echo $url .'/assets/js/bootstrap.js'; ?>"></script>
<script src="<?php echo $url .'/assets/js/base.js'; ?>"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
  $(function(){
      var baseUrl = '<?php echo $url; ?>';
      var table = $('#table-gizi').DataTable({
          processing : true,
          serverside : true,
          seraching  : true,
          ajax       : 'data/list_gizi_json',
          columns    : [
                          {data : 'id_kecukupan_gizi',name : 'id_kecukupan_gizi'},
                          {data : 'kalori_minimum', name : 'kalori_minimum'},
                          {data : 'protein_minimum', name : 'protein_minimum'},
                          {data : 'lemak_minimum',name : 'lemak_minimum'},
                          {data : 'karbo_minimum', name : 'karbo_minimum'},
                          {data : 'range_age', name : 'range_age'},
                          {render : function(data, type, full, meta)
                            {
                                return  "<button id='btnDelete' href='ss'  data-id_kecukupan_gizi="+full.id_kecukupan_gizi+"  class='btn btn-danger btnDetails'>Hapus Data</button>"+ "<button id='btnUpdate' style='margin-top : 2px;' href='#' data-id_kecukupan_gizi="+full.id_kecukupan_gizi+" data-kalori_minimum="+full.kalori_minimum+" data-protein_minimum="+full.protein_minimum+"  data-lemak_minimum="+full.lemak_minimum+"  data-karbo_minimum="+full.karbo_minimum+"  data-range_age="+full.range_age+" data-nominal_satuan="+full.nominal_satuan+" data-harga_pangan="+full.harga_pangan+"   class='btn btn-info'>Perbaharui Data</button>";
                            }
                        }
                       ]

      });

      table.on('order.dt search.dt',function(){
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                });
      }).draw();

        $('#table-gizi').on('click','[id=btnDelete]', function(){
                let id    = $(this).data('id_kecukupan_gizi');

                let token = '<?php echo $csrfToken; ?>';

                cnf = confirm("Apakah Anda Yakin Menghapus Data Kecukupan Gizi ?" );
                if(cnf)
                {
                    $.ajax({
                            url      : baseUrl + '/admin/backend/kecukupan_gizi_crud/delete_data/',
                            type     : 'POST',
                            dataType : 'JSON',
                            data     : {id:id,_token:token}, 
                            success  : function(resp)
                            {
                                    if(resp.message == 'true')
                                    {
                                        alert(resp.message);
                                        window.location.reload();
                                    }
                                    else
                                    {
                                        alert(resp.message);
                                        window.location.reload();
                                    }
                            },error : function(resp)
                            {
                                  alert('Kesalahan, jaringan');
                                  window.location.reload();
                            }
                    });
                }
           });


        $('#table-gizi').on('click','[id=btnUpdate]', function(){     
             $('#id_kecukupan_gizi_up').val($(this).data('id_kecukupan_gizi'));
             $('#kalori_minimum_up').val($(this).data('kalori_minimum'));
             $('#protein_minimum_up').val($(this).data('protein_minimum'));
             $('#lemak_minimum_up').val($(this).data('lemak_minimum'));
             $('#karbo_minimum_up').val($(this).data('karbo_minimum'));
             $('#range_age_up').val($(this).data('range_age'));
          

             $('#updateGizi').modal('show');


        });


        $('#insData').on('click', function(){
                $('#form-add-user').submit();
        });

  });



</script>

</body>
</html>
