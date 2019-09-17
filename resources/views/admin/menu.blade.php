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
<link rel="stylesheet" href="<?php echo $url .'/assets/css/site.css'; ?>">
<link rel="stylesheet" href="<?php echo $url .'/assets/css/pikaday.css'; ?>">
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
              <h3> Data Menu</h3><i class="fa fa-bars"></i>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                
                <div class="widget-content" style="margin: 12px;">

                  <a type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#menu-spk">Tambah Menu</a>
                              <?php 
                                     $msg = Session::get('msg');
                                    if(!empty($msg)){  ?>
                                              <div class="alert alert-{{@$msg['code']}}" style="margin-top: 2px;">
                                                    <strong>{{@$msg['status']}}</strong> {{ @$msg['message']}}
                                               </div>
                                       <?php } ?>
                                       
                                      <div class="table-responsive">
                                                            <table class="table" id="table-menu" style="margin: 12px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Tanggal Menu</th>
                                                                        <th>Hari Menu</th>
                                                                        <th>Harga Menu</th>
                                                                       
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

<div id="menu-spk" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/menu_generate'; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Generate Menu</h4>
      </div>
      <div class="modal-body">
         <div class="control-group">                     
                      <label class="control-label">Tanggal Menu</label>
                      <div class="controls">
                        <input type="date" class="span4" id="tanggal" name="tanggal" >
                      </div>        
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" >Satndar Kecukupan Gizi</label>
                      <div class="controls">
                        <input type="hidden" name="type_pangan" value="lauk">
                        <select class="span4" name="id_kecukupan" id="id_kecukupan_gizi">
                            <?php foreach ($gizi as $dt) { ?>
                            <option value="{{@$dt['id_kecukupan_gizi']}}">{{@$dt['range_age']}}</option>
                          <?php } ?>
                        </select>
                      </div>        
                    </div>
                   
                    
      </div>
      <div class="modal-footer">
        <a class="btn btn-info" id="genearte_menu">Generate Menu</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>


 
</div>




</div>


 <div id="menu-detail" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/menu_generate'; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Menu</h4>
      </div>
      <div class="modal-body">
          <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pokok</th>
      <th scope="col">Lauk</th>
      <th scope="col">Sayur</th>
       <th scope="col">harga</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Makan pagi</th>
      <td id="id_mpagi"></td>
      <td id="id_lpagi">Otto</td>
      <td id="id_spagi">@mdo</td>
      <td id="id_hpagi">@mdo</td>
    </tr>
    <tr>
      <th scope="row">Makan Siang</th>
      <td id="id_msiang"></td>
      <td id="id_lsiang">Thornton</td>
      <td id="id_ssiang">@fat</td>
      <td id="id_hsiang">@mdo</td>
    </tr>
    <tr>
      <th scope="row">Makan Malam</th>
      <td id="id_mmalam">Larry</td>
      <td id="id_lmalam">the Bird</td>
      <td id="id_smalam">@twitter</td>
      <td id="id_hmalam">@mdo</td>
    </tr>
     <tr>
      <td colspan="4" style="text-align: center;"><b>Total Harga</b></td>
      <td id="tt_harga_makan">2</td>
    </tr>
    <tr>
      <td colspan="4" style="text-align: center;"><b>Total Harga</b></td>
      <td id="tt_harga_makan">2</td>
    </tr>
  </tbody>
</table>
                   
                    
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
<script src="<?php echo $url .'/assets/js/jquery-1.7.2.min.js'; ?>"></script> 
<!-- <script src="<?php echo $url .'/simpleks/vendor/jquery/jquery-2.0.2.min.js'; ?>"></script> -->
<script src="<?php echo $url .'/assets/js/excanvas.min.js'; ?>"></script> 
<script src="<?php echo $url.'/assets/js/chart.min.js'; ?>" type="text/javascript"></script> 
<script src="<?php echo $url .'/assets/js/bootstrap.js'; ?>"></script>
<script src="<?php echo $url .'/assets/js/base.js'; ?>"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url .'/simpleks/dist/yasmij.js'; ?>"></script>

<script src="<?php echo $url .'/js/pikaday.js'; ?>"></script>
<script>
  $(function(){
      var baseUrl = '<?php echo $url; ?>';
      var table = $('#table-menu').DataTable({
          processing : true,
          serverside : true,
          // seraching  : true,
          ajax       : 'data/list_menu_json',
          columns    : [
                          {data : 'id_kecukupan_gizi',name : 'id_kecukupan_gizi'},
                          {data : 'tanggal_menu', name : 'tanggal_menu'},
                          {data : 'hari_menu', name : 'hari_menu'},
                         // {data : 'harga_menu',name : 'harga_menu'},
                          {
                            render : function(data, type, full, meta){
                                    return 'Rp. '+full.harga_menu.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                            }
                          },
                          {render : function(data, type, full, meta)
                            {
                                return  "<button id='btnDelete' href='ss'  data-id_menu="+full.id_menu+"  class='btn btn-danger'>Hapus Data</button> "+ " <button id='btnUpdate' style='margin-top : 2px;' href='#' data-id="+full.id_menu+" class='btn btn-info'>Detail Data</button>";
                            }
                        }
                       ]

      });

      table.on('order.dt search.dt',function(){
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                });
      }).draw();

        $('#table-menu').on('click','[id=btnDelete]', function(){
                let id    = $(this).data('id_menu');


                let token = '<?php echo $csrfToken; ?>';

                cnf = confirm("Apakah Anda Yakin Menghapus Data menu ini?");
                if(cnf)
                {
                    $.ajax({
                            url      : baseUrl + '/admin/backend/delete_menu',
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

          $('#table-menu').on('click','[id=btnUpdate]', function(){
                let id    = $(this).data('id');

                let token = '<?php echo $csrfToken; ?>';
             //     alert(id);
             
                    $.ajax({
                            url      : baseUrl + '/admin/backend/get_menu_detail/'+id,
                            type     : 'GET',
                            dataType : 'JSON',
                            data     : {id:id,_token:token}, 
                            success  : function(resp)
                            {

                                  console.log(resp);
                                    if(resp.status == 'true')
                                    {
                                        // alert(resp.message);
                                        $('#id_mpagi').html(resp.list_menu.pagi.mpokok.name+' ('+resp.list_menu.pagi.mpokok.jumlah+'/g)');
                                         $('#id_lpagi').html(resp.list_menu.pagi.lauk.name+' ('+resp.list_menu.pagi.lauk.jumlah+'/g)');
                                          $('#id_spagi').html(resp.list_menu.pagi.sayur.name+' ('+resp.list_menu.pagi.sayur.jumlah+'/g)');
                                           $('#id_hpagi').html('Rp. '+resp.list_menu.pagi.total_harga.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'');

                                            $('#id_msiang').html(resp.list_menu.siang.mpokok.name+' ('+resp.list_menu.siang.mpokok.jumlah+'/g)');
                                         $('#id_lsiang').html(resp.list_menu.siang.lauk.name+' ('+resp.list_menu.siang.lauk.jumlah+'/g)');
                                          $('#id_ssiang').html(resp.list_menu.siang.sayur.name+' ('+resp.list_menu.siang.sayur.jumlah+'/g)');
                                           $('#id_hsiang').html('Rp. '+resp.list_menu.siang.total_harga.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'');

                                            $('#id_mmalam').html(resp.list_menu.malam.mpokok.name+' ('+resp.list_menu.malam.mpokok.jumlah+'/g)');
                                         $('#id_lmalam').html(resp.list_menu.malam.lauk.name+' ('+resp.list_menu.malam.lauk.jumlah+'/g)');
                                          $('#id_smalam').html(resp.list_menu.malam.sayur.name+' ('+resp.list_menu.malam.sayur.jumlah+'/g)');
                                           $('#id_hmalam').html('Rp. '+resp.list_menu.malam.total_harga.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'');

                                          $('#tt_harga_makan').html('Rp. '+resp.list_menu.total_all.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                                          $('#dt_range_usia').html(resp.data[0].range_age+" Tahun");
                                        // window.location.reload();
                                        $('#menu-detail').modal('show');
                                    }
                                    else
                                    {
                                       // alert(resp.message);
                                       // window.location.reload();
                                    }
                            },error : function(resp)
                            {
                                  alert('Kesalahan, jaringan');
                                  //window.location.reload();
                            }
                    });
                
           });


        


       


        $('#insData').on('click', function(){
                $('#form-add-user').submit();
        });

  });



</script>




<script type="text/javascript">
     $(document).ready(function(){
          $('#genearte_menu').on('click', function(){
               let tgl = $('#tanggal').val();
               let id  = $('#id_kecukupan_gizi').val();
               let baseUrl = '<?php echo $url; ?>';
               let token = '<?php echo $csrfToken; ?>';
               alert(tgl + ' '+ id);

               var simpleks = new Object();
                   simpleks.pagi  = {};
                   simpleks.siang = {};
                   simpleks.malam = {};

               $.ajax({
                   url : baseUrl +'/admin/backend/generate_menu',
                   type : 'GET',
                   data : {id:id, tgl:tgl, _token:token},
                   dataType : 'JSON',
                   success  : function(resp)
                   {
                    console.log(resp);

                    if(resp.status == 'false')
                    {
                       alert(resp.message);
                       window.location.reload();
                    }
                    else
                    {
                          for(i=1; i<4; i++)
                    {
                         for(j=1; j<4; j++)
                         {
                            if(i == 1)
                            {

                                if(j==1)
                                {
                                  r1 = resp.menu.pagi.k1.kalori;
                                  r2 = resp.menu.pagi.k1.protein; 
                                  r3 = resp.menu.pagi.k1.lemak; 
                                  r4 = resp.menu.pagi.k1.kalori;
                                   // console.log(dt);

                                   simpleks.pagi.k1 = simpleks_generate(r1,r2,r3,r4);
                                   simpleks.pagi.id_pangan = resp.menu.pagi.k1.id_pangan;
                                }
                                 else if(j==2)
                                {
                                  r1 = resp.menu.pagi.k2.kalori;
                                  r2 = resp.menu.pagi.k2.protein; 
                                  r3 = resp.menu.pagi.k2.lemak; 
                                  r4 = resp.menu.pagi.k2.kalori;
                                   // console.log(dt);
                                    simpleks.pagi.k2 = simpleks_generate(r1,r2,r3,r4);

                                     simpleks.pagi.id_pangan = resp.menu.pagi.k2.id_pangan;
                                    //console.log(simpleks_generate(r1,r2,r3,r4));
                                }
                                else if(j==3)
                                {
                                  r1 = resp.menu.pagi.k3.kalori;
                                  r2 = resp.menu.pagi.k3.protein; 
                                  r3 = resp.menu.pagi.k3.lemak; 
                                  r4 = resp.menu.pagi.k3.kalori;
                                     simpleks.pagi.k3 = simpleks_generate(r1,r2,r3,r4);

                                   simpleks.pagi.id_pangan = resp.menu.pagi.k3.id_pangan;
                                    //console.log(dt);
                                    //console.log(simpleks_generate(r1,r2,r3,r4));
                                }

                            }
                            else if(i == 2)
                            {

                                if(j==1)
                                {
                                  r1 = resp.menu.siang.k1.kalori;
                                  r2 = resp.menu.siang.k1.protein; 
                                  r3 = resp.menu.siang.k1.lemak; 
                                  r4 = resp.menu.siang.k1.kalori;
                                   // console.log(dt);

                                   simpleks.siang.k1 = simpleks_generate(r1,r2,r3,r4);
                                   simpleks.siang.id_pangan = resp.menu.siang.k1.id_pangan;
                                }
                                 else if(j==2)
                                {
                                  r1 = resp.menu.siang.k2.kalori;
                                  r2 = resp.menu.siang.k2.protein; 
                                  r3 = resp.menu.siang.k2.lemak; 
                                  r4 = resp.menu.siang.k2.kalori;
                                   // console.log(dt);
                                    simpleks.siang.k2 = simpleks_generate(r1,r2,r3,r4);

                                     simpleks.siang.id_pangan = resp.menu.siang.k2.id_pangan;
                                    //console.log(simpleks_generate(r1,r2,r3,r4));
                                }
                                else if(j==3)
                                {
                                  r1 = resp.menu.siang.k3.kalori;
                                  r2 = resp.menu.siang.k3.protein; 
                                  r3 = resp.menu.siang.k3.lemak; 
                                  r4 = resp.menu.siang.k3.kalori;
                                     simpleks.siang.k3 = simpleks_generate(r1,r2,r3,r4);

                                   simpleks.siang.id_pangan = resp.menu.siang.k3.id_pangan;
                                    //console.log(dt);
                                    //console.log(simpleks_generate(r1,r2,r3,r4));
                                }

                            }
                             else if(i == 3)
                            {

                                if(j==1)
                                {
                                  r1 = resp.menu.malam.k1.kalori;
                                  r2 = resp.menu.malam.k1.protein; 
                                  r3 = resp.menu.malam.k1.lemak; 
                                  r4 = resp.menu.malam.k1.kalori;
                                   // console.log(dt);

                                   simpleks.malam.k1 = simpleks_generate(r1,r2,r3,r4);
                                   simpleks.malam.id_pangan = resp.menu.malam.k1.id_pangan;
                                }
                                 else if(j==2)
                                {
                                  r1 = resp.menu.malam.k2.kalori;
                                  r2 = resp.menu.malam.k2.protein; 
                                  r3 = resp.menu.malam.k2.lemak; 
                                  r4 = resp.menu.malam.k2.kalori;
                                   // console.log(dt);
                                    simpleks.malam.k2 = simpleks_generate(r1,r2,r3,r4);

                                     simpleks.malam.id_pangan = resp.menu.malam.k2.id_pangan;
                                   
                                }
                                else if(j==3)
                                {
                                  r1 = resp.menu.malam.k3.kalori;
                                  r2 = resp.menu.malam.k3.protein; 
                                  r3 = resp.menu.malam.k3.lemak; 
                                  r4 = resp.menu.malam.k3.kalori;
                                     simpleks.malam.k3 = simpleks_generate(r1,r2,r3,r4);

                                   simpleks.siang.id_pangan = resp.menu.malam.k3.id_pangan;
                                    
                                }

                            }
                            
                            
                         }
                    }



                   console.log(simpleks);
                   save_ajax(JSON.stringify(simpleks),JSON.stringify(resp));
                    }

                   
                    //for()
                   }, error : function(reps)
                   {
                       alert('failed');
                   }

               });
          })
     });


     function simpleks_generate(r1,r2,r3,r4)
     {
          var input = {
              type: 'minimize',
              objective : 'x1 + x2 + x3',
              constraints : [
                String(r1),String(r2),String(r3),String(r4)
              ]
          };

      //console.log(input.constraints);
      let output = YASMIJ.solve( input );

      return output;
     }


     function save_ajax(simpleks, resp)
     {
         let baseUrl = '<?php echo $url; ?>';
         let token   = '<?php echo $csrfToken; ?>';

         $.ajax({
              url : baseUrl +'/admin/backend/save_menu',
              type : 'POST',
              dataType : 'JSON',
              data : {simpleks:simpleks, resp:resp, _token:token},
              success : function(res)
              {
                   if(res.status == 'true')
                   {
                       alert('success generate menu');
                       window.location.reload();
                   }
                   else
                   {
                       alert(res.message);
                       window.location.reload();
                   }
              },
              error : function(res)
              {
                   alert('Kesalahan jaringan');
              }
         });
     }
</script>

</body>
</html>
