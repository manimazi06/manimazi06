<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFinancialSanction[]|\Cake\Collection\CollectionInterface $projectFinancialSanctions
 */
?>
<div class="projectFinancialSanctions index content">
    <?= $this->Html->link(__('New Project Financial Sanction'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Project Financial Sanctions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('fs_ref_no') ?></th>
                    <th><?= $this->Paginator->sort('sanctioned_amount') ?></th>
                    <th><?= $this->Paginator->sort('sanctioned_date') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectFinancialSanctions as $projectFinancialSanction): ?>
                <tr>
                    <td><?= $this->Number->format($projectFinancialSanction->id) ?></td>
                    <td><?= $projectFinancialSanction->has('project_work') ? $this->Html->link($projectFinancialSanction->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectFinancialSanction->project_work->id]) : '' ?></td>
                    <td><?= h($projectFinancialSanction->fs_ref_no) ?></td>
                    <td><?= $this->Number->format($projectFinancialSanction->sanctioned_amount) ?></td>
                    <td><?= h($projectFinancialSanction->sanctioned_date) ?></td>
                    <td><?= h($projectFinancialSanction->is_active) ?></td>
                    <td><?= h($projectFinancialSanction->created_date) ?></td>
                    <td><?= $this->Number->format($projectFinancialSanction->created_by) ?></td>
                    <td><?= h($projectFinancialSanction->modified_date) ?></td>
                    <td><?= $projectFinancialSanction->modified_by === null ? '' : $this->Number->format($projectFinancialSanction->modified_by) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectFinancialSanction->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectFinancialSanction->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectFinancialSanction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectFinancialSanction->id)]) ?>
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
