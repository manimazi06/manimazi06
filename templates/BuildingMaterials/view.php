<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingMaterial $buildingMaterial
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Building Material'), ['action' => 'edit', $buildingMaterial->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Building Material'), ['action' => 'delete', $buildingMaterial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $buildingMaterial->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Building Materials'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Building Material'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="buildingMaterials view content">
            <h3><?= h($buildingMaterial->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($buildingMaterial->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($buildingMaterial->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $buildingMaterial->status === null ? '' : $this->Number->format($buildingMaterial->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $buildingMaterial->is_active === null ? '' : $this->Number->format($buildingMaterial->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $buildingMaterial->created_by === null ? '' : $this->Number->format($buildingMaterial->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $buildingMaterial->modified_by === null ? '' : $this->Number->format($buildingMaterial->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($buildingMaterial->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($buildingMaterial->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
