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
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">Bootstrap Admin Template </a>
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
                                                            <table class="table" id="table-user" style="margin: 12px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>nama pangan</th>
                                                                        <th>kalori pangan</th>
                                                                        <th>Protein pangan</th>
                                                                        <th>Lemak pangan</th>
                                                                        <th>Satuan Pangan</th>
                                                                        <th>Nominal Pangan</th>
                                                                        <th>Harga pangan</th>
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
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/lauk_crud/insert_data'; ?>">
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
                    <div class="control-group">                     
                      <label class="control-label">Kalori Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="kalori_pangan_ins" name="kalori_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Protein Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="protein_pangan_ins" name="protein_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Lemak Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="lemak_pangan_ins" name="lemak_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Satuan Pangan</label>
                      <div class="controls">
                        <input type="text" class="span4" id="satuan_pangan_ins" name="satuan_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Nominal Satuan</label>
                      <div class="controls">
                        <input type="text" class="span4" id="nominal_satuan_ins" name="nominal_satuan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Harga Pangan</label>
                      <div class="controls">
                        <input type="text" class="span4" id="harga_pangan_ins" name="harga_pangan" value="" required="">
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
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/pangan_crud/insert_data'; ?>">
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
                        <input type="text" class="span4" id="nama_pangan_up" name="nama_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Kalori Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="kalori_pangan_up" name="kalori_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Protein Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="protein_pangan_up" name="protein_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Lemak Lauk</label>
                      <div class="controls">
                        <input type="text" class="span4" id="lemak_pangan_up" name="lemak_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Satuan Pangan</label>
                      <div class="controls">
                        <input type="text" class="span4" id="satuan_pangan_up" name="satuan_pangan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Nominal Satuan</label>
                      <div class="controls">
                        <input type="text" class="span4" id="nominal_satuan_up" name="nominal_satuan" value="" required="">
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label">Harga Pangan</label>
                      <div class="controls">
                        <input type="text" class="span4" id="harga_pangan_up" name="harga_pangan" value="" required="">
                      </div>        
                    </div> 
      </div>
      <div class="modal-footer">
        <a class="btn btn-info" id="upData">Tambah Data Lauk</a>
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
      var table = $('#table-user').DataTable({
          processing : true,
          serverside : true,
          seraching  : true,
          ajax       : 'data/list_pangan_json/lauk',
          columns    : [
                          {data : 'id_pangan',name : 'id_pangan'},
                          {data : 'nama_pangan', name : 'nama_pangan'},
                          // {data : 'type_pangan', name : 'type_pangan'},
                          {data : 'kalori_pangan', name : 'kalori_pangan'},
                          {data : 'protein_pangan',name : 'protein_pangan'},
                          {data : 'lemak_pangan', name : 'lemak_pangan'},
                          {data : 'satuan_pangan', name : 'satuan_pangan'},
                          {data : 'nominal_satuan', name : 'nominal_satuan'},
                          {data : 'harga_pangan', name : 'nominal_satuan'},
                          {render : function(data, type, full, meta)
                            {
                                return  "<button id='btnDelete' href='ss'  data-id="+full.id_pangan+" class='btn btn-danger btnDetails'>Delete Data</button>"+ "<button id='btnUpdate' href='#' data-id_pangan="+full.id_pangan+" class='btn btn-info'>Update Data</button>";
                            }
                        }
                       ]

      });

      table.on('order.dt search.dt',function(){
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                });
      }).draw();

        $('#table-user').on('click','[id=btnDelete]', function(){
                let uname = $(this).data('id');
                let level = $(this).data('level');
                let token = '<?php echo $csrfToken; ?>';

                cnf = confirm("Apakah Anda Yakin Menghapus Data "+ level +" dengan username "+ uname +" ?");
                if(cnf)
                {
                    $.ajax({
                            url      : baseUrl + '/admin/backend/users_crud/delete_data/',
                            type     : 'POST',
                            dataType : 'JSON',
                            data     : {uname:uname,_token:token}, 
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


        $('#insData').on('click', function(){
                $('#form-add-user').submit();
        });

  });



</script>

</body>
</html>
