<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectAdministrativeSanction[]|\Cake\Collection\CollectionInterface $projectAdministrativeSanctions
 */
?>
<div class="projectAdministrativeSanctions index content">
    <?= $this->Html->link(__('New Project Administrative Sanction'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Project Administrative Sanctions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('go_no') ?></th>
                    <th><?= $this->Paginator->sort('go_date') ?></th>
                    <th><?= $this->Paginator->sort('sanctioned_amount') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectAdministrativeSanctions as $projectAdministrativeSanction): ?>
                <tr>
                    <td><?= $this->Number->format($projectAdministrativeSanction->id) ?></td>
                    <td><?= $projectAdministrativeSanction->has('project_work') ? $this->Html->link($projectAdministrativeSanction->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectAdministrativeSanction->project_work->id]) : '' ?></td>
                    <td><?= h($projectAdministrativeSanction->go_no) ?></td>
                    <td><?= h($projectAdministrativeSanction->go_date) ?></td>
                    <td><?= $this->Number->format($projectAdministrativeSanction->sanctioned_amount) ?></td>
                    <td><?= h($projectAdministrativeSanction->is_active) ?></td>
                    <td><?= $this->Number->format($projectAdministrativeSanction->created_by) ?></td>
                    <td><?= h($projectAdministrativeSanction->created_date) ?></td>
                    <td><?= $projectAdministrativeSanction->modified_by === null ? '' : $this->Number->format($projectAdministrativeSanction->modified_by) ?></td>
                    <td><?= h($projectAdministrativeSanction->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectAdministrativeSanction->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectAdministrativeSanction->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectAdministrativeSanction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectAdministrativeSanction->id)]) ?>
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
