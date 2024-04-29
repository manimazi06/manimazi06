<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectMonitoringDetail[]|\Cake\Collection\CollectionInterface $projectMonitoringDetails
 */
?>
<div class="projectMonitoringDetails index content">
    <?= $this->Html->link(__('New Project Monitoring Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Project Monitoring Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_subdetail_id') ?></th>
                    <th><?= $this->Paginator->sort('work_stage_id') ?></th>
                    <th><?= $this->Paginator->sort('monitoring_date') ?></th>
                    <th><?= $this->Paginator->sort('work_percentage_id') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectMonitoringDetails as $projectMonitoringDetail): ?>
                <tr>
                    <td><?= $this->Number->format($projectMonitoringDetail->id) ?></td>
                    <td><?= $projectMonitoringDetail->has('project_work') ? $this->Html->link($projectMonitoringDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectMonitoringDetail->project_work->id]) : '' ?></td>
                    <td><?= $projectMonitoringDetail->project_work_subdetail_id === null ? '' : $this->Number->format($projectMonitoringDetail->project_work_subdetail_id) ?></td>
                    <td><?= $projectMonitoringDetail->has('work_stage') ? $this->Html->link($projectMonitoringDetail->work_stage->name, ['controller' => 'WorkStages', 'action' => 'view', $projectMonitoringDetail->work_stage->id]) : '' ?></td>
                    <td><?= h($projectMonitoringDetail->monitoring_date) ?></td>
                    <td><?= $projectMonitoringDetail->work_percentage_id === null ? '' : $this->Number->format($projectMonitoringDetail->work_percentage_id) ?></td>
                    <td><?= $this->Number->format($projectMonitoringDetail->is_active) ?></td>
                    <td><?= $projectMonitoringDetail->created_by === null ? '' : $this->Number->format($projectMonitoringDetail->created_by) ?></td>
                    <td><?= h($projectMonitoringDetail->created_date) ?></td>
                    <td><?= $projectMonitoringDetail->modified_by === null ? '' : $this->Number->format($projectMonitoringDetail->modified_by) ?></td>
                    <td><?= h($projectMonitoringDetail->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectMonitoringDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectMonitoringDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectMonitoringDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectMonitoringDetail->id)]) ?>
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
