<?php
$session = $this->request->session();
$this->pageTitle= $session->read('Company.CurrentName');
?>
<div class="panel panel-primary">
                        <div class="panel-heading">
                          <i class="fa fa-dashboard fa-fw"></i> <?= __('Dashboard')." ".$this->pageTitle ?>
                        </div>
                        <div class="panel-body">

                          <div class="row">
                                          <div class="col-lg-3 col-md-6">
                                              <div class="panel panel-primary">
                                                  <div class="panel-heading">
                                                      <div class="row">
                                                          <div class="col-xs-3">
                                                              <i class="fa fa-clock-o fa-5x"></i>
                                                          </div>
                                                          <div class="col-xs-9 text-right">
                                                              <div class="huge"><?= $pending_invoices ?></div>
                                                              <div><?= __("Pending")?></div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <a href="#">
                                                      <div class="panel-footer">
                                                          <a href="#/Company/"><span class="pull-left"><i class="fa fa-search-plus"></i> <?= __("Invoices")?></span>
                                                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                                          <div class="clearfix"></div>
                                                      </div>
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6">
                                              <div class="panel panel-green">
                                                  <div class="panel-heading">
                                                      <div class="row">
                                                          <div class="col-xs-3">
                                                              <i class="fa fa-truck fa-5x"></i>
                                                          </div>
                                                          <div class="col-xs-9 text-right">
                                                              <div class="huge"><?= $sent_invoices ?></div>
                                                              <div><?= __("Sent")?></div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <a href="#">
                                                      <div class="panel-footer">
                                                        <a href="#/Company/"><span class="pull-left"><i class="fa fa-search-plus"></i> <?= __("Invoices")?></span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                                          <div class="clearfix"></div>
                                                      </div>
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6">
                                              <div class="panel panel-yellow">
                                                  <div class="panel-heading">
                                                      <div class="row">
                                                          <div class="col-xs-3">
                                                              <i class="fa fa-money fa-5x"></i>
                                                          </div>
                                                          <div class="col-xs-9 text-right">
                                                              <div class="huge"><?= $paid_invoices ?></div>
                                                              <div><?= __("Paid")?></div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <a href="#">
                                                      <div class="panel-footer">
                                                        <a href="#/Company/"><span class="pull-left"><i class="fa fa-search-plus"></i> <?= __("Invoices")?></span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                                          <div class="clearfix"></div>
                                                      </div>
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6">
                                              <div class="panel panel-red">
                                                  <div class="panel-heading">
                                                      <div class="row">
                                                          <div class="col-xs-3">
                                                              <i class="fa fa-fire-extinguisher fa-5x"></i>
                                                          </div>
                                                          <div class="col-xs-9 text-right">
                                                              <div class="huge"><?= $void_invoices ?></div>
                                                              <div><?= __('Void') ?></div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <a href="#">
                                                      <div class="panel-footer">
                                                        <a href="#/Company/"><span class="pull-left"><i class="fa fa-search-plus"></i> <?= __("Invoices")?></span>
                                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                                          <div class="clearfix"></div>
                                                      </div>
                                                  </a>
                                              </div>
                                          </div>
                                      </div>


                        </div>
                        <!-- /.panel-body -->
                    </div>
