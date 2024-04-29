<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseQuartersDetail $projectwiseQuartersDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Projectwise Quarters Detail'), ['action' => 'edit', $projectwiseQuartersDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Projectwise Quarters Detail'), ['action' => 'delete', $projectwiseQuartersDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseQuartersDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Projectwise Quarters Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Projectwise Quarters Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseQuartersDetails view content">
            <h3><?= h($projectwiseQuartersDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectwiseQuartersDetail->has('project_work') ? $this->Html->link($projectwiseQuartersDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectwiseQuartersDetail->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail') ?></th>
                    <td><?= $projectwiseQuartersDetail->has('project_work_subdetail') ? $this->Html->link($projectwiseQuartersDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectwiseQuartersDetail->project_work_subdetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Police Designation') ?></th>
                    <td><?= $projectwiseQuartersDetail->has('police_designation') ? $this->Html->link($projectwiseQuartersDetail->police_designation->name, ['controller' => 'PoliceDesignations', 'action' => 'view', $projectwiseQuartersDetail->police_designation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectwiseQuartersDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('No Of Quarters') ?></th>
                    <td><?= $projectwiseQuartersDetail->no_of_quarters === null ? '' : $this->Number->format($projectwiseQuartersDetail->no_of_quarters) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectwiseQuartersDetail->created_by === null ? '' : $this->Number->format($projectwiseQuartersDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectwiseQuartersDetail->modified_by === null ? '' : $this->Number->format($projectwiseQuartersDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectwiseQuartersDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectwiseQuartersDetail->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
