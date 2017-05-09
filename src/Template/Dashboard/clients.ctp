<?php
$session = $this->request->session();
$this->pageTitle= __('ClientsOf').' '.$session->read('Company.CurrentName');

?>
<div class="panel panel-default">
                        <div class="panel-heading">
                          <i class="fa fa-child fa-fw"></i> <?= __('ClientsOf').' '.$session->read('Company.CurrentName')
                        </div>
                        <div class="panel-body">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs">
                                  <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Home</a>
                                  </li>
                                  <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Profile</a>
                                  </li>
                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                  <div class="tab-pane fade active in" id="home">
                                      <h4>List</h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                  </div>
                                  <div class="tab-pane fade" id="profile">
                                      <h4>New</h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                  </div>
                              </div>
                          </div>
                        <!-- /.panel-body -->
                    </div>
<script>
$(document).ready(function(){
  var cliente = new clientes();
  cliente.loadList();
});
</script>
