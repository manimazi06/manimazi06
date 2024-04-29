<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContractorRegisteredDepartment $contractorRegisteredDepartment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Contractor Registered Department'), ['action' => 'edit', $contractorRegisteredDepartment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contractor Registered Department'), ['action' => 'delete', $contractorRegisteredDepartment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contractorRegisteredDepartment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contractor Registered Departments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contractor Registered Department'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contractorRegisteredDepartments view content">
            <h3><?= h($contractorRegisteredDepartment->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contractorRegisteredDepartment->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contractorRegisteredDepartment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $contractorRegisteredDepartment->is_active === null ? '' : $this->Number->format($contractorRegisteredDepartment->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $contractorRegisteredDepartment->created_by === null ? '' : $this->Number->format($contractorRegisteredDepartment->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $contractorRegisteredDepartment->modified_by === null ? '' : $this->Number->format($contractorRegisteredDepartment->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($contractorRegisteredDepartment->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($contractorRegisteredDepartment->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
