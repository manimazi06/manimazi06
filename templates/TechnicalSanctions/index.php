<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalSanction[]|\Cake\Collection\CollectionInterface $technicalSanctions
 */
?>
<div class="technicalSanctions index content">
    <?= $this->Html->link(__('New Technical Sanction'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Technical Sanctions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($technicalSanctions as $technicalSanction): ?>
                <tr>
                    <td><?= $this->Number->format($technicalSanction->id) ?></td>
                    <td><?= $technicalSanction->has('project_work') ? $this->Html->link($technicalSanction->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $technicalSanction->project_work->id]) : '' ?></td>
                    <td><?= h($technicalSanction->is_active) ?></td>
                    <td><?= $this->Number->format($technicalSanction->created_by) ?></td>
                    <td><?= h($technicalSanction->created_date) ?></td>
                    <td><?= $this->Number->format($technicalSanction->modified_by) ?></td>
                    <td><?= h($technicalSanction->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $technicalSanction->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $technicalSanction->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $technicalSanction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $technicalSanction->id)]) ?>
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
