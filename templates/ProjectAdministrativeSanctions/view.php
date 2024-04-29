<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectAdministrativeSanction $projectAdministrativeSanction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Project Administrative Sanction'), ['action' => 'edit', $projectAdministrativeSanction->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Project Administrative Sanction'), ['action' => 'delete', $projectAdministrativeSanction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectAdministrativeSanction->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Project Administrative Sanctions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project Administrative Sanction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectAdministrativeSanctions view content">
            <h3><?= h($projectAdministrativeSanction->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectAdministrativeSanction->has('project_work') ? $this->Html->link($projectAdministrativeSanction->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectAdministrativeSanction->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Go No') ?></th>
                    <td><?= h($projectAdministrativeSanction->go_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectAdministrativeSanction->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sanctioned Amount') ?></th>
                    <td><?= $this->Number->format($projectAdministrativeSanction->sanctioned_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $this->Number->format($projectAdministrativeSanction->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectAdministrativeSanction->modified_by === null ? '' : $this->Number->format($projectAdministrativeSanction->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Go Date') ?></th>
                    <td><?= h($projectAdministrativeSanction->go_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectAdministrativeSanction->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectAdministrativeSanction->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectAdministrativeSanction->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Go File Upload') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectAdministrativeSanction->go_file_upload)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
