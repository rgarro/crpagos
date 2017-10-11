<?php
$session = $this->request->session();
?>
<ul class="nav navbar-top-links navbar-right">
  <li>
    <img src="<?= $_SESSION['Company']['CurrentLogo']?>" height="50"/>
  </li>
  <li>
    <?php echo $this->element('Admin/companyswitch'); ?>
  </li>
    <!-- /.dropdown -->
    <!-- /.dropdown -->
  <li><a href="/dashboard/changelang?Lang=eng_us"><img src="/img/usa.png" width="22"/> </a></li>
  <li><a href="/dashboard/changelang?Lang=spa_cr"><img src="/img/cr.gif" width="22"/> </a>  </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <?= $session->read('User.FullName')?> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
          <li><a href="#/MyProfile/"><i class="fa fa-user fa-fw"></i> <?= __("MyProfile")?></a>
          </li>
            <li class="divider"></li>
            <li><a href="/dashboard/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
