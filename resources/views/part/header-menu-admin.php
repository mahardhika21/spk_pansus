<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="<?php if($page == 'dashboard'){echo 'active';} ?>"><a href="<?php echo $url .'/admin'; ?>"><i class="fa fa-home fa-lg"></i><span>Dashboard</span> </a> </li>
        <li class="<?php if($page == 'profile'){echo 'active';} ?>"><a href="<?php echo $url .'/admin/profile'; ?>"><i class="fa fa-user fa-lg"></i><span>Profile</span> </a> </li>
        <li  class="<?php if($page == 'users'){echo 'active';} ?>" ><a href="<?php echo $url .'/admin/users'; ?>"><i class="fa fa-users fa-lg"></i><span>Users</span> </a> </li>
        <li  class="<?php if($page == 'reset_password'){echo 'active';} ?>"><a href="<?php echo $url .'/admin/reset_password'; ?>"><i class="fa fa-key fa-lg"></i><span>Reset Password</span> </a></li>
        <li  class="<?php if($page == 'profile'){echo 'about';} ?>"><a href="<?php echo $url .'/admin/info'; ?>"><i class="fa fa-info fa-lg"></i><span>About</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>