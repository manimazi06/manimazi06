<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContractorType $contractorType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Contractor Type'), ['action' => 'edit', $contractorType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contractor Type'), ['action' => 'delete', $contractorType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contractorType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contractor Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contractor Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contractorTypes view content">
            <h3><?= h($contractorType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contractorType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contractorType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $contractorType->is_active === null ? '' : $this->Number->format($contractorType->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $contractorType->created_by === null ? '' : $this->Number->format($contractorType->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $contractorType->modified_by === null ? '' : $this->Number->format($contractorType->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($contractorType->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($contractorType->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
