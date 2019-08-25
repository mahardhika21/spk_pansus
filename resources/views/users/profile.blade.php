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

<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
              <li><a href="">Profile</a></li>
              <li><a href="">Logout</a></li>
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
<?php //echo '<pre>'.print_r($profile, true) .'</pre>';
    // echo $profile[0]['name'];
 ?>
        <div class="span8">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="fa fa-user fa-lg"></i>
              <h3> Update Profile Admin</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  
                    <form id="edit-profile" method="post" class="form-horizontal" style="margin-top: 12px;" action="<?php echo $url.'/admin/backend/profile_crud/update_profile'; ?>">
                  <fieldset>
                    <div class="controls">
                         <?php 
                    $msg = Session::get('msg');
                    if(!empty($msg)){  ?>
                              <div class="alert alert-{{@$msg['code']}}">
                                    <strong>{{@$msg['status']}}</strong> {{ @$msg['message']}}
                               </div>
                       <?php } ?>
                          </div>
                    <div class="control-group">                     
                      <label class="control-label" for="firstname">username</label>
                      <div class="controls">
                        <input type="text" class="span4" id="firstname" name="username" value="<?php echo $profile[0]['username']; ?>" readonly>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                      
                    
                    <div class="control-group">                     
                      <label class="control-label" for="lastname">Name</label>
                      <div class="controls">
                        <input type="text" class="span4" id="name_user" name="name"  value="<?php echo $profile[0]['name']; ?>" required="">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    <div class="control-group">                     
                      <label class="control-label" for="lastname">Phone Number</label>
                      <div class="controls">
                        <input type="text" class="span4" id="phone" name="phone"  required="" value="<?php echo $profile[0]['phone']; ?>">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                    
                    <div class="control-group">                     
                      <label class="control-label" for="email">Email Address</label>
                      <div class="controls">
                        <input type="email" class="span4" id="email" name="email" value="<?php echo $profile[0]['email']; ?>" required="">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                                
                     <br>  
                    <div class="form-actions">
                      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                      <button type="submit" class="btn btn-primary">Submit</button> 
                      <button class="btn">Cancel</button>
                    </div> <!-- /form-actions -->
                  </fieldset>
                </form>
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



<!-- <div class="footer fixed">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2013 <a href="http://www.egrappler.com/">Bootstrap Responsive Admin Template</a>. </div>
       
      </div>
    </div>
    
  </div>
  
</div>
 -->

<script src="<?php echo $url .'/assets/js/jquery-1.7.2.min.js'; ?>"></script> 
<script src="<?php echo $url .'/asset/js/excanvas.min.js'; ?>"></script> 
<script src="js/chart.min.js" type="text/javascript"></script> 
<script src="<?php echo $url .'/assets/js/bootstrap.js'; ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo $url .'/asset/js/full-calendar/fullcalendar.min.js'; ?>"></script>
 
<script src="<?php echo $url .'/assets/js/base.js'; ?>"></script> 

</body>
</html>
