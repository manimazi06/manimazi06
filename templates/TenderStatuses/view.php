<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TenderStatus $tenderStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tender Status'), ['action' => 'edit', $tenderStatus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tender Status'), ['action' => 'delete', $tenderStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tenderStatus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tender Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tender Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tenderStatuses view content">
            <h3><?= h($tenderStatus->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($tenderStatus->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tenderStatus->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Flag') ?></th>
                    <td><?= $tenderStatus->order_flag === null ? '' : $this->Number->format($tenderStatus->order_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $tenderStatus->is_active === null ? '' : $this->Number->format($tenderStatus->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $tenderStatus->created_by === null ? '' : $this->Number->format($tenderStatus->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $tenderStatus->modified_by === null ? '' : $this->Number->format($tenderStatus->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($tenderStatus->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($tenderStatus->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
