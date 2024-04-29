<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFundRequestDetail[]|\Cake\Collection\CollectionInterface $projectFundRequestDetails
 */
?>
<div class="projectFundRequestDetails index content">
    <?= $this->Html->link(__('New Project Fund Request Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Project Fund Request Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_subdetail_id') ?></th>
                    <th><?= $this->Paginator->sort('fund_status_id') ?></th>
                    <th><?= $this->Paginator->sort('fund_amount') ?></th>
                    <th><?= $this->Paginator->sort('balance_amount') ?></th>
                    <th><?= $this->Paginator->sort('request_date') ?></th>
                    <th><?= $this->Paginator->sort('approval_date') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectFundRequestDetails as $projectFundRequestDetail): ?>
                <tr>
                    <td><?= $this->Number->format($projectFundRequestDetail->id) ?></td>
                    <td><?= $projectFundRequestDetail->has('project_work') ? $this->Html->link($projectFundRequestDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectFundRequestDetail->project_work->id]) : '' ?></td>
                    <td><?= $projectFundRequestDetail->has('project_work_subdetail') ? $this->Html->link($projectFundRequestDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectFundRequestDetail->project_work_subdetail->id]) : '' ?></td>
                    <td><?= $projectFundRequestDetail->has('fund_status') ? $this->Html->link($projectFundRequestDetail->fund_status->name, ['controller' => 'FundStatuses', 'action' => 'view', $projectFundRequestDetail->fund_status->id]) : '' ?></td>
                    <td><?= $projectFundRequestDetail->fund_amount === null ? '' : $this->Number->format($projectFundRequestDetail->fund_amount) ?></td>
                    <td><?= $projectFundRequestDetail->balance_amount === null ? '' : $this->Number->format($projectFundRequestDetail->balance_amount) ?></td>
                    <td><?= h($projectFundRequestDetail->request_date) ?></td>
                    <td><?= h($projectFundRequestDetail->approval_date) ?></td>
                    <td><?= $projectFundRequestDetail->created_by === null ? '' : $this->Number->format($projectFundRequestDetail->created_by) ?></td>
                    <td><?= h($projectFundRequestDetail->created_date) ?></td>
                    <td><?= $projectFundRequestDetail->modified_by === null ? '' : $this->Number->format($projectFundRequestDetail->modified_by) ?></td>
                    <td><?= h($projectFundRequestDetail->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectFundRequestDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectFundRequestDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectFundRequestDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectFundRequestDetail->id)]) ?>
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
