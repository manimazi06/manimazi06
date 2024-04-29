<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectHandoverDetail $projectHandoverDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Project Handover Detail'), ['action' => 'edit', $projectHandoverDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Project Handover Detail'), ['action' => 'delete', $projectHandoverDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectHandoverDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Project Handover Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project Handover Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectHandoverDetails view content">
            <h3><?= h($projectHandoverDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectHandoverDetail->has('project_work') ? $this->Html->link($projectHandoverDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectHandoverDetail->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail') ?></th>
                    <td><?= $projectHandoverDetail->has('project_work_subdetail') ? $this->Html->link($projectHandoverDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectHandoverDetail->project_work_subdetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Remarks') ?></th>
                    <td><?= h($projectHandoverDetail->remarks) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectHandoverDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectHandoverDetail->created_by === null ? '' : $this->Number->format($projectHandoverDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectHandoverDetail->modified_by === null ? '' : $this->Number->format($projectHandoverDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Handover Date') ?></th>
                    <td><?= h($projectHandoverDetail->handover_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectHandoverDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectHandoverDetail->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectHandoverDetail->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('File Upload') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectHandoverDetail->file_upload)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
