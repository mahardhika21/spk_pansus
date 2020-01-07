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
              <h3> Data Lauk</h3><i class="fa fa-cutlery"></i>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                
                <div class="widget-content" style="margin: 12px;">

                  <a type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addLauk">Tambah Data Lauk</a>
                              <?php 
                                     $msg = Session::get('msg');
                                    if(!empty($msg)){  ?>
                                              <div class="alert alert-{{@$msg['code']}}" style="margin-top: 2px;">
                                                    <strong>{{@$msg['status']}}</strong> {{ @$msg['message']}}
                                               </div>
                                       <?php } ?>
                                       
                                      <div class="table-responsive">
                                                            <table class="table" id="table-lauk" style="margin: 12px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>nama pangan</th>
                                                                       <!--  <th>kalori pangan</th> -->
                                                                        <th>Protein pangan</th>
                                                                        <th>Lemak pangan</th>
                                                                        <th>karbohidrat pangan</th>
                                                                        <th>Harga pangan</th>
                                                                        <th>Option</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td></td>
                                                                     <!--    <td></td> -->
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

<div id="addLauk" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/pangan_crud/insert_data_pangan'; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data Lauk</h4>
      </div>
      <div class="modal-body">
                    <div class="control-group">                     
                      <label class="control-label" >Nama Lauk</label>
                      <div class="controls">
                        <input type="hidden" name="type_pangan" value="lauk">
                        <input type="text" class="span4" id="nama_pangan_ins" name="nama_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group" style="display: none;">                     
                      <label class="control-label">Kalori Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="kalori_pangan_ins" name="kalori_pangan" value="2.1" required="">
                         <small style="color: red;">satuan KKL (KKL)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Protein Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="protein_pangan_ins" name="protein_pangan" value="" required="">
                         <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Lemak Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="lemak_pangan_ins" name="lemak_pangan" value="" required="">
                         <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div>
                     <div class="control-group">                     
                      <label class="control-label" >Karbohidrat Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="karbo_pangan_ins" name="karbo_pangan" value="" required="">
                         <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Harga Pangan</label>
                      <div class="controls">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="text" class="span4" id="harga_pangan_ins" name="harga_pangan" value="" required="">
                         <small style="color: red;">Harga Per-Kg</small>
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



<div id="updateLauk" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/pangan_crud/update_data_pangan'; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Data Lauk</h4>
      </div>
      <div class="modal-body">
                    <div class="control-group">                     
                      <label class="control-label" >Nama Lauk</label>
                      <div class="controls">
                        <input type="hidden"  id="id_pangan_up" name="id_pangan" value="">
                        <input type="hidden" name="type_pangan" value="lauk">
                        <input type="text" class="span4" id="nama_pangan_up" name="nama_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" style="display: none;">Kalori Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="kalori_pangan_up" name="kalori_pangan" value="" required="">
                        <small style="color: red;">satuan kkal (KKL)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Protein Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="protein_pangan_up" name="protein_pangan" value="" required="">
                        <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Lemak Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="lemak_pangan_up" name="lemak_pangan" value="" required="">
                        <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div> 
                     <div class="control-group">                     
                      <label class="control-label" >karbohitrat Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="lemak_pangan_up" name="karbo_pangan" value="" required="">
                         <small style="color: red;">satuan gram (g)</small>
                      </div>        
                    </div> 
                    <div class="control-group">                     
                      <label class="control-label">Harga Pangan</label>
                      <div class="controls">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="text" class="span4" id="harga_pangan_up" name="harga_pangan" value="" required="">
                         <small style="color: red;">harga per-KG</small>
                      </div>        
                    </div> 
      </div>
      <div class="modal-footer">
       <!--  <a class="btn btn-info" id="upData">Tambah Data Lauk</a> -->
       <button class="btn btn-info" type="submit">Update Data Lauk</button>
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
      var table = $('#table-lauk').DataTable({
          processing : true,
          serverside : true,
          seraching  : true,
          ajax       : 'data/list_pangan_json/lauk',
          columns    : [
                          {data : 'id_pangan',name : 'id_pangan'},
                          {data : 'nama_pangan', name : 'nama_pangan'},
                          {data : 'kalori_pangan', name : 'kalori_pangan'},
                          // {data : 'protein_pangan',name : 'protein_pangan'},
                          {data : 'lemak_pangan', name : 'lemak_pangan'},
                          {data : 'karbo_pangan', name : 'karbo_pangan'},
                          {data : 'harga_pangan', name : 'nominal_satuan'},
                          {render : function(data, type, full, meta)
                            {
                                return  "<button id='btnDelete' href='ss'  data-id_pangan="+full.id_pangan+" data-nama_pangan="+full.nama_pangan+" class='btn btn-danger btnDetails'>Hapus Data</button>"+ "<button id='btnUpdate' style='margin-top : 2px;' href='#' data-id_pangan="+full.id_pangan+" data-nama_pangan="+full.nama_pangan+" data-kalori_pangan="+full.kalori_pangan+"  data-protein_pangan="+full.protein_pangan+"  data-lemak_pangan="+full.lemak_pangan+"  data-satuan_pangan="+full.satuan_pangan+" data-nominal_satuan="+full.nominal_satuan+" data-harga_pangan="+full.harga_pangan+"   class='btn btn-info'>Perbaharui Data</button>";
                            }
                        }
                       ]

      });

      table.on('order.dt search.dt',function(){
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                });
      }).draw();

        $('#table-lauk').on('click','[id=btnDelete]', function(){
                let id    = $(this).data('id_pangan');
                let nama  = $(this).data('nama_pangan');

                let token = '<?php echo $csrfToken; ?>';

                cnf = confirm("Apakah Anda Yakin Menghapus Data " + nama );
                if(cnf)
                {
                    $.ajax({
                            url      : baseUrl + '/admin/backend/pangan_crud/delete_data_pangan/',
                            type     : 'POST',
                            dataType : 'JSON',
                            data     : {id_pangan:id,_token:token}, 
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


        $('#table-lauk').on('click','[id=btnUpdate]', function(){
            // let id_pangan        = $(this).data('id_pangan');
            // let nama_pangan      = $(this).data('nama_pangan');
            // let kalori_pangan    = $(this).data('kalori_pangan');
            // let protein_pangan   = $(this).data('protein_pangan');
            // let lemak_pangan     = $(this).data('lemak_pangan');
            // let satuan_pangan    = $(this).data('satuan_pangan');
            // let nominal_satuan   = $(this).data('nominal_satuan');
            // let harga_pangan     = $(this).data('harga_pangan');
             
             $('#id_pangan_up').val($(this).data('id_pangan'));
             $('#nama_pangan_up').val($(this).data('nama_pangan'));
             $('#kalori_pangan_up').val($(this).data('kalori_pangan'));
             $('#protein_pangan_up').val($(this).data('protein_pangan'));
             $('#lemak_pangan_up').val($(this).data('lemak_pangan'));
             $('#satuan_pangan_up').val($(this).data('satuan_pangan'));
             $('#nominal_satuan_up').val($(this).data('nominal_satuan'));
             $('#harga_pangan_up').val($(this).data('harga_pangan'));

             $('#updateLauk').modal('show');


        });


        $('#insData').on('click', function(){
                $('#form-add-user').submit();
        });

  });



</script>

</body>
</html>
