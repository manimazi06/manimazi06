<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectPlacedToBoardDetail $projectPlacedToBoardDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Project Placed To Board Detail'), ['action' => 'edit', $projectPlacedToBoardDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Project Placed To Board Detail'), ['action' => 'delete', $projectPlacedToBoardDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectPlacedToBoardDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Project Placed To Board Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project Placed To Board Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectPlacedToBoardDetails view content">
            <h3><?= h($projectPlacedToBoardDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectPlacedToBoardDetail->has('project_work') ? $this->Html->link($projectPlacedToBoardDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectPlacedToBoardDetail->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail') ?></th>
                    <td><?= $projectPlacedToBoardDetail->has('project_work_subdetail') ? $this->Html->link($projectPlacedToBoardDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectPlacedToBoardDetail->project_work_subdetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectPlacedToBoardDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectPlacedToBoardDetail->is_active === null ? '' : $this->Number->format($projectPlacedToBoardDetail->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectPlacedToBoardDetail->created_by === null ? '' : $this->Number->format($projectPlacedToBoardDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectPlacedToBoardDetail->modified_by === null ? '' : $this->Number->format($projectPlacedToBoardDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Placed Date') ?></th>
                    <td><?= h($projectPlacedToBoardDetail->placed_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectPlacedToBoardDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectPlacedToBoardDetail->modified_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('File Upload') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectPlacedToBoardDetail->file_upload)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Remarks') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectPlacedToBoardDetail->remarks)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
