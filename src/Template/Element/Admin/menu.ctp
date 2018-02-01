<?php
$session = $this->request->session();
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li>
              <a href="#/Dashboard/"><i class="fa fa-dashboard fa-fw"></i> <?= __('Dashboard') ?></a>
          </li>
            <li>
                <a href="#/Company/"><i class="fa fa-file-o fa-fw"></i> <?= __('Invoices') ?></a>
            </li>

            <li>
                <a href="#/Clients/"><i class="fa fa-child fa-fw"></i> <?= __('listaClients') ?></a>
            </li>
<?php if($session->read('User.AccessLevelID') <= 1){ ?>
            <li>
                <a href="#/Users/"><i class="fa fa-users fa-fw"></i> <?= __('Users') ?></a>
            </li>
            <li>
                <a href="#/MyCompany/"><i class="fa fa-building fa-fw"></i> <?= __('MyCompany') ?></a>
            </li>
            <li>
                <a href="#/MyCompanyLogo/"><i class="fa fa-file-picture-o fa-fw"></i> <?= __('Logo') ?></a>
            </li>
            <li>
                <a href="#/Terms/"><i class="fa fa-book fa-fw"></i> <?= __('Terms') ?></a>
            </li>
<?php } ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
