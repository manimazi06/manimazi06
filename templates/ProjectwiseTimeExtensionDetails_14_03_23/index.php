<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseTimeExtensionDetail[]|\Cake\Collection\CollectionInterface $projectwiseTimeExtensionDetails
 */
?>
<div class="projectwiseTimeExtensionDetails index content">
    <?= $this->Html->link(__('New Projectwise Time Extension Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Projectwise Time Extension Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_subdetail_id') ?></th>
                    <th><?= $this->Paginator->sort('extension_date_of_ee') ?></th>
                    <th><?= $this->Paginator->sort('any_notice_issued_by_contractor') ?></th>
                    <th><?= $this->Paginator->sort('any_fine_imposed_for_delay') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectwiseTimeExtensionDetails as $projectwiseTimeExtensionDetail): ?>
                <tr>
                    <td><?= $this->Number->format($projectwiseTimeExtensionDetail->id) ?></td>
                    <td><?= $projectwiseTimeExtensionDetail->has('project_work') ? $this->Html->link($projectwiseTimeExtensionDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectwiseTimeExtensionDetail->project_work->id]) : '' ?></td>
                    <td><?= $projectwiseTimeExtensionDetail->has('project_work_subdetail') ? $this->Html->link($projectwiseTimeExtensionDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectwiseTimeExtensionDetail->project_work_subdetail->id]) : '' ?></td>
                    <td><?= $projectwiseTimeExtensionDetail->extension_date_of_ee === null ? '' : $this->Number->format($projectwiseTimeExtensionDetail->extension_date_of_ee) ?></td>
                    <td><?= $projectwiseTimeExtensionDetail->any_notice_issued_by_contractor === null ? '' : $this->Number->format($projectwiseTimeExtensionDetail->any_notice_issued_by_contractor) ?></td>
                    <td><?= $projectwiseTimeExtensionDetail->any_fine_imposed_for_delay === null ? '' : $this->Number->format($projectwiseTimeExtensionDetail->any_fine_imposed_for_delay) ?></td>
                    <td><?= $this->Number->format($projectwiseTimeExtensionDetail->is_active) ?></td>
                    <td><?= h($projectwiseTimeExtensionDetail->created_date) ?></td>
                    <td><?= $projectwiseTimeExtensionDetail->created_by === null ? '' : $this->Number->format($projectwiseTimeExtensionDetail->created_by) ?></td>
                    <td><?= h($projectwiseTimeExtensionDetail->modified_date) ?></td>
                    <td><?= $projectwiseTimeExtensionDetail->modified_by === null ? '' : $this->Number->format($projectwiseTimeExtensionDetail->modified_by) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectwiseTimeExtensionDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectwiseTimeExtensionDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectwiseTimeExtensionDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseTimeExtensionDetail->id)]) ?>
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
