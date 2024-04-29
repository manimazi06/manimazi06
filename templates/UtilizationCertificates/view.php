<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UtilizationCertificate $utilizationCertificate
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Utilization Certificate'), ['action' => 'edit', $utilizationCertificate->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Utilization Certificate'), ['action' => 'delete', $utilizationCertificate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $utilizationCertificate->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Utilization Certificates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Utilization Certificate'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="utilizationCertificates view content">
            <h3><?= h($utilizationCertificate->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $utilizationCertificate->has('project_work') ? $this->Html->link($utilizationCertificate->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $utilizationCertificate->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail') ?></th>
                    <td><?= $utilizationCertificate->has('project_work_subdetail') ? $this->Html->link($utilizationCertificate->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $utilizationCertificate->project_work_subdetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($utilizationCertificate->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $utilizationCertificate->is_active === null ? '' : $this->Number->format($utilizationCertificate->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $utilizationCertificate->created_by === null ? '' : $this->Number->format($utilizationCertificate->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $utilizationCertificate->modified_by === null ? '' : $this->Number->format($utilizationCertificate->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Certificated Date') ?></th>
                    <td><?= h($utilizationCertificate->certificated_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($utilizationCertificate->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($utilizationCertificate->modified_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Remarks') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($utilizationCertificate->remarks)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Certificate Upload') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($utilizationCertificate->certificate_upload)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
