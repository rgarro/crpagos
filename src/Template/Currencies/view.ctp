<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Currency'), ['action' => 'edit', $currency->CurrencyID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Currency'), ['action' => 'delete', $currency->CurrencyID], ['confirm' => __('Are you sure you want to delete # {0}?', $currency->CurrencyID)]) ?> </li>
        <li><?= $this->Html->link(__('List Currencies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Currency'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="currencies view large-9 medium-8 columns content">
    <h3><?= h($currency->CurrencyID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('CurrencySymbol') ?></th>
            <td><?= h($currency->CurrencySymbol) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CurrencyName') ?></th>
            <td><?= h($currency->CurrencyName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CurrencyID') ?></th>
            <td><?= $this->Number->format($currency->CurrencyID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('VPOSCurCode') ?></th>
            <td><?= $this->Number->format($currency->VPOSCurCode) ?></td>
        </tr>
    </table>
</div>
