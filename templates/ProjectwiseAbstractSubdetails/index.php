<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseAbstractSubdetail[]|\Cake\Collection\CollectionInterface $projectwiseAbstractSubdetails
 */
?>
<div class="projectwiseAbstractSubdetails index content">
    <?= $this->Html->link(__('New Projectwise Abstract Subdetail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Projectwise Abstract Subdetails') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('projectwise_abstract_detail_id') ?></th>
                    <th><?= $this->Paginator->sort('building_item_id') ?></th>
                    <th><?= $this->Paginator->sort('item_code') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('rate') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectwiseAbstractSubdetails as $projectwiseAbstractSubdetail): ?>
                <tr>
                    <td><?= $this->Number->format($projectwiseAbstractSubdetail->id) ?></td>
                    <td><?= $projectwiseAbstractSubdetail->has('projectwise_abstract_detail') ? $this->Html->link($projectwiseAbstractSubdetail->projectwise_abstract_detail->id, ['controller' => 'ProjectwiseAbstractDetails', 'action' => 'view', $projectwiseAbstractSubdetail->projectwise_abstract_detail->id]) : '' ?></td>
                    <td><?= $projectwiseAbstractSubdetail->has('building_item') ? $this->Html->link($projectwiseAbstractSubdetail->building_item->id, ['controller' => 'BuildingItems', 'action' => 'view', $projectwiseAbstractSubdetail->building_item->id]) : '' ?></td>
                    <td><?= h($projectwiseAbstractSubdetail->item_code) ?></td>
                    <td><?= h($projectwiseAbstractSubdetail->quantity) ?></td>
                    <td><?= $projectwiseAbstractSubdetail->rate === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->rate) ?></td>
                    <td><?= $projectwiseAbstractSubdetail->amount === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->amount) ?></td>
                    <td><?= $projectwiseAbstractSubdetail->is_active === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->is_active) ?></td>
                    <td><?= $projectwiseAbstractSubdetail->created_by === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->created_by) ?></td>
                    <td><?= h($projectwiseAbstractSubdetail->created_date) ?></td>
                    <td><?= $projectwiseAbstractSubdetail->modified_by === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->modified_by) ?></td>
                    <td><?= h($projectwiseAbstractSubdetail->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectwiseAbstractSubdetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectwiseAbstractSubdetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectwiseAbstractSubdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseAbstractSubdetail->id)]) ?>
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
