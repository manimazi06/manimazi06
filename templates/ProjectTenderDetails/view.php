<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectTenderDetail $projectTenderDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Project Tender Detail'), ['action' => 'edit', $projectTenderDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Project Tender Detail'), ['action' => 'delete', $projectTenderDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectTenderDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Project Tender Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project Tender Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectTenderDetails view content">
            <h3><?= h($projectTenderDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectTenderDetail->has('project_work') ? $this->Html->link($projectTenderDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectTenderDetail->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tender No') ?></th>
                    <td><?= h($projectTenderDetail->tender_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contractor Name') ?></th>
                    <td><?= h($projectTenderDetail->contractor_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contractor Mobile No') ?></th>
                    <td><?= h($projectTenderDetail->contractor_mobile_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Agreement No') ?></th>
                    <td><?= h($projectTenderDetail->agreement_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectTenderDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tender Amount') ?></th>
                    <td><?= $this->Number->format($projectTenderDetail->tender_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $this->Number->format($projectTenderDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectTenderDetail->modified_by === null ? '' : $this->Number->format($projectTenderDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tender Date') ?></th>
                    <td><?= h($projectTenderDetail->tender_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Agreement Date') ?></th>
                    <td><?= h($projectTenderDetail->agreement_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectTenderDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectTenderDetail->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectTenderDetail->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Tender Copy') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectTenderDetail->tender_copy)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Agreement Copy') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectTenderDetail->agreement_copy)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
