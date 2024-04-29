<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingType $buildingType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Building Type'), ['action' => 'edit', $buildingType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Building Type'), ['action' => 'delete', $buildingType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $buildingType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Building Type'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Building Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="buildingType view content">
            <h3><?= h($buildingType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($buildingType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($buildingType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Flag') ?></th>
                    <td><?= $buildingType->order_flag === null ? '' : $this->Number->format($buildingType->order_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $buildingType->created_by === null ? '' : $this->Number->format($buildingType->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $buildingType->modified_by === null ? '' : $this->Number->format($buildingType->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($buildingType->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($buildingType->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $buildingType->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
