<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectMonitoringDetail $projectMonitoringDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Project Monitoring Detail'), ['action' => 'edit', $projectMonitoringDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Project Monitoring Detail'), ['action' => 'delete', $projectMonitoringDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectMonitoringDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Project Monitoring Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project Monitoring Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectMonitoringDetails view content">
            <h3><?= h($projectMonitoringDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectMonitoringDetail->has('project_work') ? $this->Html->link($projectMonitoringDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectMonitoringDetail->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Work Stage') ?></th>
                    <td><?= $projectMonitoringDetail->has('work_stage') ? $this->Html->link($projectMonitoringDetail->work_stage->name, ['controller' => 'WorkStages', 'action' => 'view', $projectMonitoringDetail->work_stage->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectMonitoringDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail Id') ?></th>
                    <td><?= $projectMonitoringDetail->project_work_subdetail_id === null ? '' : $this->Number->format($projectMonitoringDetail->project_work_subdetail_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Work Percentage Id') ?></th>
                    <td><?= $projectMonitoringDetail->work_percentage_id === null ? '' : $this->Number->format($projectMonitoringDetail->work_percentage_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $this->Number->format($projectMonitoringDetail->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectMonitoringDetail->created_by === null ? '' : $this->Number->format($projectMonitoringDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectMonitoringDetail->modified_by === null ? '' : $this->Number->format($projectMonitoringDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Monitoring Date') ?></th>
                    <td><?= h($projectMonitoringDetail->monitoring_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectMonitoringDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectMonitoringDetail->modified_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Photo Upload') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectMonitoringDetail->photo_upload)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
