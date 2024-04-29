<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseCompletionReport $projectwiseCompletionReport
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Projectwise Completion Report'), ['action' => 'edit', $projectwiseCompletionReport->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Projectwise Completion Report'), ['action' => 'delete', $projectwiseCompletionReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseCompletionReport->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Projectwise Completion Reports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Projectwise Completion Report'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseCompletionReports view content">
            <h3><?= h($projectwiseCompletionReport->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectwiseCompletionReport->has('project_work') ? $this->Html->link($projectwiseCompletionReport->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectwiseCompletionReport->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail') ?></th>
                    <td><?= $projectwiseCompletionReport->has('project_work_subdetail') ? $this->Html->link($projectwiseCompletionReport->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectwiseCompletionReport->project_work_subdetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Remarks') ?></th>
                    <td><?= h($projectwiseCompletionReport->remarks) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectwiseCompletionReport->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectwiseCompletionReport->created_by === null ? '' : $this->Number->format($projectwiseCompletionReport->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectwiseCompletionReport->modified_by === null ? '' : $this->Number->format($projectwiseCompletionReport->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Completed Date') ?></th>
                    <td><?= h($projectwiseCompletionReport->completed_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectwiseCompletionReport->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectwiseCompletionReport->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectwiseCompletionReport->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('File Upload') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectwiseCompletionReport->file_upload)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
