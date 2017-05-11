<?php
$session = $this->request->session();
?>
<ul class="nav navbar-top-links navbar-right">
  <li>
    <?php echo $this->element('Admin/companyswitch'); ?>
  </li>
    <!-- /.dropdown -->
    <li>
        <a href="/clients" >
            <i class="fa fa-plane "></i>
        </a>

        <!-- /.dropdown-tasks -->
    </li>
    <!-- /.dropdown -->
  <li><a href="/dashboard/changelang?Lang=eng_us"><img src="/img/usa.png" width="22"/> </a></li>
  <li><a href="/dashboard/changelang?Lang=spa_cr"><img src="/img/cr.gif" width="22"/> </a>  </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <?= $session->read('User.FullName')?> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="/?logout=yes"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
