<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentwiseWorkType $departmentwiseWorkType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Departmentwise Work Type'), ['action' => 'edit', $departmentwiseWorkType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Departmentwise Work Type'), ['action' => 'delete', $departmentwiseWorkType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentwiseWorkType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Departmentwise Work Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Departmentwise Work Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="departmentwiseWorkTypes view content">
            <h3><?= h($departmentwiseWorkType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Department') ?></th>
                    <td><?= $departmentwiseWorkType->has('department') ? $this->Html->link($departmentwiseWorkType->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentwiseWorkType->department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($departmentwiseWorkType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($departmentwiseWorkType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $departmentwiseWorkType->is_active === null ? '' : $this->Number->format($departmentwiseWorkType->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Flag') ?></th>
                    <td><?= $departmentwiseWorkType->order_flag === null ? '' : $this->Number->format($departmentwiseWorkType->order_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $departmentwiseWorkType->created_by === null ? '' : $this->Number->format($departmentwiseWorkType->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $departmentwiseWorkType->modified_by === null ? '' : $this->Number->format($departmentwiseWorkType->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($departmentwiseWorkType->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($departmentwiseWorkType->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
