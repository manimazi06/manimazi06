<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFinancialSanction $projectFinancialSanction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Project Financial Sanction'), ['action' => 'edit', $projectFinancialSanction->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Project Financial Sanction'), ['action' => 'delete', $projectFinancialSanction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectFinancialSanction->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Project Financial Sanctions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project Financial Sanction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectFinancialSanctions view content">
            <h3><?= h($projectFinancialSanction->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectFinancialSanction->has('project_work') ? $this->Html->link($projectFinancialSanction->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectFinancialSanction->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Fs Ref No') ?></th>
                    <td><?= h($projectFinancialSanction->fs_ref_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectFinancialSanction->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sanctioned Amount') ?></th>
                    <td><?= $this->Number->format($projectFinancialSanction->sanctioned_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $this->Number->format($projectFinancialSanction->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectFinancialSanction->modified_by === null ? '' : $this->Number->format($projectFinancialSanction->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sanctioned Date') ?></th>
                    <td><?= h($projectFinancialSanction->sanctioned_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectFinancialSanction->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectFinancialSanction->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectFinancialSanction->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Sanctioned File Upload') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectFinancialSanction->sanctioned_file_upload)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
