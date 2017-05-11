<?php
$session = $this->request->session();
	$this->pageTitle= $session->read('Company.CurrentName');
  ?>
  <h4><i class="fa fa-users"></i> <?php echo $this->pageTitle; ?></h4>
<div class="panel panel-primary">
                        <div class="panel-heading">
                          <i class="fa fa-building fa-fw"></i> <?= $this->pageTitle ?>
                        </div>
                        <div class="panel-body">
                        soon
                        </div>
                        <!-- /.panel-body -->
                    </div>
