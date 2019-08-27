<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="<?php if($page == 'dashboard'){ echo 'active';} ?>"><a href="<?php echo $url .'/user'; ?>"><i class="fa fa-home fa-lg"></i><span>Dashboard</span> </a> </li>
        <li class="<?php if($page == 'profile'){   echo 'active';} ?>"><a href="<?php echo $url .'/user/profile'; ?>"><i class="fa fa-user fa-lg"></i><span>Profile</span> </a> </li>
        <li class="<?php if($page == 'reset_password'){ echo 'active';} ?>"><a href="<?php echo $url .'/user/reset_password'; ?>"><i class="fa fa-key fa-lg"></i><span>Reset Password</span> </a></li>
      </ul>
    </div>
  </div> 
</div>