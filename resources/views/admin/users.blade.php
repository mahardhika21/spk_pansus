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
        <div class="span4">

         {!!$part['menu']!!}
          <!-- /widget -->
         <!-- /widget -->
          
          <!-- /widget -->
        </div>
        <!-- /span6 --> 

        <div class="span8">
          <div class="widget widget-nopad">
            <div class="widget-header"> 
              <h3> User Data</h3><i class="fa fa-users"></i>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                
                <div class="widget-content" style="margin: 12px;">

                  <a type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addUser">Tambah Data User</a>

                   
                              <?php 
     $msg = Session::get('msg');

    if(!empty($msg)){  ?>
              <div class="alert alert-{{@$msg['code']}}" style="margin-top: 2px;">
                    <strong>{{@$msg['status']}}</strong> {{ @$msg['message']}}
               </div>
       <?php } ?>
                                                            <table class="table" id="table-user" style="margin: 12px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Username</th>
                                                                        <th>Level</th>
                                                                        <th>email</th>
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
                <!-- /widget-content --> 
              </div>
            </div>
          </div>
          
          <!-- /widget -->
          
          <!-- /widget --> 
        </div>
        <!-- /span6 -->

        
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>

<div id="addUser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form id="form-add-user" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/users_crud/insert_data'; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data User</h4>
      </div>
      <div class="modal-body">
         
                  <fieldset>
                    <div class="control-group">                     
                      <label class="control-label" for="firstname">username</label>
                      <div class="controls">
                        <input type="text" class="span4" id="username" name="username" value="" required="">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                      
                    
                    <div class="control-group">                     
                      <label class="control-label" for="lastname">Level</label>
                      <div class="controls">
                        <select class="span4" id="level_user" name="level">
                          <option value="admin">Admin</option>
                          <option value="user">User</option>
                        </select>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    <div class="control-group">                     
                      <label class="control-label" for="email">Email Address</label>
                      <div class="controls">
                        <input type="hidden" name="_token" value="<?php echo $csrfToken; ?>">
                        <input type="email" class="span4" id="email" name="email" value="" required="">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->      
                     <br> 
                  </fieldset>
      </div>
      <div class="modal-footer">
        <a class="btn btn-info" id="insData">tambah user</a>
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
          ajax       : 'data/list_users_json',
          columns    : [
                          {data : 'id_user',name : 'id_user'},
                          {data : 'username', name : 'username'},
                          {data : 'level', name : 'level'},
                          {data : 'email', name : 'email'},
                          {render : function(data, type, full, meta)
                            {
                                return  " <button id='btnDelete' href='ss' data-level="+full.level+" data-id="+full.username+" class='btn btn-danger btnDetails'>Delete Data</button>";
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
