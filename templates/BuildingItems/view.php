<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingItem $buildingItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Building Item'), ['action' => 'edit', $buildingItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Building Item'), ['action' => 'delete', $buildingItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $buildingItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Building Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Building Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="buildingItems view content">
            <h3><?= h($buildingItem->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($buildingItem->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Item Code') ?></th>
                    <td><?= h($buildingItem->item_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($buildingItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $buildingItem->status === null ? '' : $this->Number->format($buildingItem->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $buildingItem->is_active === null ? '' : $this->Number->format($buildingItem->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $buildingItem->created_by === null ? '' : $this->Number->format($buildingItem->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $buildingItem->modified_by === null ? '' : $this->Number->format($buildingItem->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($buildingItem->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($buildingItem->modified_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Item Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($buildingItem->item_description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
