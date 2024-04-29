<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialYear $financialYear
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Financial Year'), ['action' => 'edit', $financialYear->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Financial Year'), ['action' => 'delete', $financialYear->id], ['confirm' => __('Are you sure you want to delete # {0}?', $financialYear->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Financial Years'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Financial Year'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="financialYears view content">
            <h3><?= h($financialYear->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($financialYear->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($financialYear->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Flag') ?></th>
                    <td><?= $financialYear->order_flag === null ? '' : $this->Number->format($financialYear->order_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $financialYear->created_by === null ? '' : $this->Number->format($financialYear->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $financialYear->modified_by === null ? '' : $this->Number->format($financialYear->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($financialYear->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($financialYear->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $financialYear->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
