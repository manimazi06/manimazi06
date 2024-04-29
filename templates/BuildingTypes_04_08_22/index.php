<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingType[]|\Cake\Collection\CollectionInterface $buildingTypes
 */
?>
<div class="buildingTypes index content">
    <?= $this->Html->link(__('New Building Type'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Building Types') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('order_flag') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buildingTypes as $buildingType): ?>
                <tr>
                    <td><?= $this->Number->format($buildingType->id) ?></td>
                    <td><?= h($buildingType->name) ?></td>
                    <td><?= $buildingType->order_flag === null ? '' : $this->Number->format($buildingType->order_flag) ?></td>
                    <td><?= $buildingType->is_active === null ? '' : $this->Number->format($buildingType->is_active) ?></td>
                    <td><?= $buildingType->created_by === null ? '' : $this->Number->format($buildingType->created_by) ?></td>
                    <td><?= h($buildingType->created_date) ?></td>
                    <td><?= $buildingType->modified_by === null ? '' : $this->Number->format($buildingType->modified_by) ?></td>
                    <td><?= h($buildingType->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $buildingType->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $buildingType->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $buildingType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $buildingType->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
