<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialyearwiseMaterialCostDetail[]|\Cake\Collection\CollectionInterface $financialyearwiseMaterialCostDetails
 */
?>
<div class="financialyearwiseMaterialCostDetails index content">
    <?= $this->Html->link(__('New Financialyearwise Material Cost Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Financialyearwise Material Cost Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('financial_year_id') ?></th>
                    <th><?= $this->Paginator->sort('submit_date') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($financialyearwiseMaterialCostDetails as $financialyearwiseMaterialCostDetail): ?>
                <tr>
                    <td><?= $this->Number->format($financialyearwiseMaterialCostDetail->id) ?></td>
                    <td><?= $financialyearwiseMaterialCostDetail->has('financial_year') ? $this->Html->link($financialyearwiseMaterialCostDetail->financial_year->name, ['controller' => 'FinancialYears', 'action' => 'view', $financialyearwiseMaterialCostDetail->financial_year->id]) : '' ?></td>
                    <td><?= h($financialyearwiseMaterialCostDetail->submit_date) ?></td>
                    <td><?= $financialyearwiseMaterialCostDetail->is_active === null ? '' : $this->Number->format($financialyearwiseMaterialCostDetail->is_active) ?></td>
                    <td><?= $financialyearwiseMaterialCostDetail->created_by === null ? '' : $this->Number->format($financialyearwiseMaterialCostDetail->created_by) ?></td>
                    <td><?= h($financialyearwiseMaterialCostDetail->created_date) ?></td>
                    <td><?= $financialyearwiseMaterialCostDetail->modified_by === null ? '' : $this->Number->format($financialyearwiseMaterialCostDetail->modified_by) ?></td>
                    <td><?= h($financialyearwiseMaterialCostDetail->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $financialyearwiseMaterialCostDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $financialyearwiseMaterialCostDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $financialyearwiseMaterialCostDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $financialyearwiseMaterialCostDetail->id)]) ?>
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
