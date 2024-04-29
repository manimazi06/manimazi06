<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFundDetail $projectFundDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Project Fund Detail'), ['action' => 'edit', $projectFundDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Project Fund Detail'), ['action' => 'delete', $projectFundDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectFundDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Project Fund Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project Fund Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectFundDetails view content">
            <h3><?= h($projectFundDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectFundDetail->has('project_work') ? $this->Html->link($projectFundDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectFundDetail->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail') ?></th>
                    <td><?= $projectFundDetail->has('project_work_subdetail') ? $this->Html->link($projectFundDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectFundDetail->project_work_subdetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Request Amount') ?></th>
                    <td><?= h($projectFundDetail->request_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received Amount') ?></th>
                    <td><?= h($projectFundDetail->received_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectFundDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $projectFundDetail->status === null ? '' : $this->Number->format($projectFundDetail->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Amount Received') ?></th>
                    <td><?= $this->Number->format($projectFundDetail->is_amount_received) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectFundDetail->is_active === null ? '' : $this->Number->format($projectFundDetail->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectFundDetail->created_by === null ? '' : $this->Number->format($projectFundDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectFundDetail->modified_by === null ? '' : $this->Number->format($projectFundDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Request Date') ?></th>
                    <td><?= h($projectFundDetail->request_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received Date') ?></th>
                    <td><?= h($projectFundDetail->received_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectFundDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectFundDetail->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
