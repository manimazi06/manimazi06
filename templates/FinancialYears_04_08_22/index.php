<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialYear[]|\Cake\Collection\CollectionInterface $financialYears
 */
?>
<div class="financialYears index content">
    <?= $this->Html->link(__('New Financial Year'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Financial Years') ?></h3>
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
                <?php foreach ($financialYears as $financialYear): ?>
                <tr>
                    <td><?= $this->Number->format($financialYear->id) ?></td>
                    <td><?= h($financialYear->name) ?></td>
                    <td><?= $financialYear->order_flag === null ? '' : $this->Number->format($financialYear->order_flag) ?></td>
                    <td><?= $financialYear->is_active === null ? '' : $this->Number->format($financialYear->is_active) ?></td>
                    <td><?= $financialYear->created_by === null ? '' : $this->Number->format($financialYear->created_by) ?></td>
                    <td><?= h($financialYear->created_date) ?></td>
                    <td><?= $financialYear->modified_by === null ? '' : $this->Number->format($financialYear->modified_by) ?></td>
                    <td><?= h($financialYear->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $financialYear->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $financialYear->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $financialYear->id], ['confirm' => __('Are you sure you want to delete # {0}?', $financialYear->id)]) ?>
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
