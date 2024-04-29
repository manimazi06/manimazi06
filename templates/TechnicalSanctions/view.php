<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalSanction $technicalSanction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Technical Sanction'), ['action' => 'edit', $technicalSanction->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Technical Sanction'), ['action' => 'delete', $technicalSanction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $technicalSanction->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Technical Sanctions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Technical Sanction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="technicalSanctions view content">
            <h3><?= h($technicalSanction->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $technicalSanction->has('project_work') ? $this->Html->link($technicalSanction->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $technicalSanction->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($technicalSanction->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $this->Number->format($technicalSanction->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $this->Number->format($technicalSanction->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($technicalSanction->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($technicalSanction->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $technicalSanction->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Detailed Estimate Upload') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($technicalSanction->detailed_estimate_upload)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($technicalSanction->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
