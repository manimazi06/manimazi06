<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectTenderDetail[]|\Cake\Collection\CollectionInterface $projectTenderDetails
 */
?>
<div class="projectTenderDetails index content">
    <?= $this->Html->link(__('New Project Tender Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Project Tender Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('tender_no') ?></th>
                    <th><?= $this->Paginator->sort('tender_date') ?></th>
                    <th><?= $this->Paginator->sort('tender_amount') ?></th>
                    <th><?= $this->Paginator->sort('contractor_name') ?></th>
                    <th><?= $this->Paginator->sort('contractor_mobile_no') ?></th>
                    <th><?= $this->Paginator->sort('agreement_no') ?></th>
                    <th><?= $this->Paginator->sort('agreement_date') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectTenderDetails as $projectTenderDetail): ?>
                <tr>
                    <td><?= $this->Number->format($projectTenderDetail->id) ?></td>
                    <td><?= $projectTenderDetail->has('project_work') ? $this->Html->link($projectTenderDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectTenderDetail->project_work->id]) : '' ?></td>
                    <td><?= h($projectTenderDetail->tender_no) ?></td>
                    <td><?= h($projectTenderDetail->tender_date) ?></td>
                    <td><?= $this->Number->format($projectTenderDetail->tender_amount) ?></td>
                    <td><?= h($projectTenderDetail->contractor_name) ?></td>
                    <td><?= h($projectTenderDetail->contractor_mobile_no) ?></td>
                    <td><?= h($projectTenderDetail->agreement_no) ?></td>
                    <td><?= h($projectTenderDetail->agreement_date) ?></td>
                    <td><?= h($projectTenderDetail->is_active) ?></td>
                    <td><?= $this->Number->format($projectTenderDetail->created_by) ?></td>
                    <td><?= h($projectTenderDetail->created_date) ?></td>
                    <td><?= $projectTenderDetail->modified_by === null ? '' : $this->Number->format($projectTenderDetail->modified_by) ?></td>
                    <td><?= h($projectTenderDetail->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectTenderDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectTenderDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectTenderDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectTenderDetail->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
