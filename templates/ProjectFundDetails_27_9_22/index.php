<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFundDetail[]|\Cake\Collection\CollectionInterface $projectFundDetails
 */
?>
<div class="projectFundDetails index content">
    <?= $this->Html->link(__('New Project Fund Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Project Fund Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_subdetail_id') ?></th>
                    <th><?= $this->Paginator->sort('request_date') ?></th>
                    <th><?= $this->Paginator->sort('request_amount') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('is_amount_received') ?></th>
                    <th><?= $this->Paginator->sort('received_amount') ?></th>
                    <th><?= $this->Paginator->sort('received_date') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectFundDetails as $projectFundDetail): ?>
                <tr>
                    <td><?= $this->Number->format($projectFundDetail->id) ?></td>
                    <td><?= $projectFundDetail->has('project_work') ? $this->Html->link($projectFundDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectFundDetail->project_work->id]) : '' ?></td>
                    <td><?= $projectFundDetail->has('project_work_subdetail') ? $this->Html->link($projectFundDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectFundDetail->project_work_subdetail->id]) : '' ?></td>
                    <td><?= h($projectFundDetail->request_date) ?></td>
                    <td><?= h($projectFundDetail->request_amount) ?></td>
                    <td><?= $projectFundDetail->status === null ? '' : $this->Number->format($projectFundDetail->status) ?></td>
                    <td><?= $this->Number->format($projectFundDetail->is_amount_received) ?></td>
                    <td><?= h($projectFundDetail->received_amount) ?></td>
                    <td><?= h($projectFundDetail->received_date) ?></td>
                    <td><?= $projectFundDetail->is_active === null ? '' : $this->Number->format($projectFundDetail->is_active) ?></td>
                    <td><?= $projectFundDetail->created_by === null ? '' : $this->Number->format($projectFundDetail->created_by) ?></td>
                    <td><?= h($projectFundDetail->created_date) ?></td>
                    <td><?= $projectFundDetail->modified_by === null ? '' : $this->Number->format($projectFundDetail->modified_by) ?></td>
                    <td><?= h($projectFundDetail->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectFundDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectFundDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectFundDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectFundDetail->id)]) ?>
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
