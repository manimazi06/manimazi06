<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseAbstractDetail[]|\Cake\Collection\CollectionInterface $projectwiseAbstractDetails
 */
?>
<div class="projectwiseAbstractDetails index content">
    <?= $this->Html->link(__('New Projectwise Abstract Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Projectwise Abstract Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_subdetail_id') ?></th>
                    <th><?= $this->Paginator->sort('development_work_id') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectwiseAbstractDetails as $projectwiseAbstractDetail): ?>
                <tr>
                    <td><?= $this->Number->format($projectwiseAbstractDetail->id) ?></td>
                    <td><?= $projectwiseAbstractDetail->has('project_work') ? $this->Html->link($projectwiseAbstractDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectwiseAbstractDetail->project_work->id]) : '' ?></td>
                    <td><?= $projectwiseAbstractDetail->has('project_work_subdetail') ? $this->Html->link($projectwiseAbstractDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectwiseAbstractDetail->project_work_subdetail->id]) : '' ?></td>
                    <td><?= $projectwiseAbstractDetail->has('development_work') ? $this->Html->link($projectwiseAbstractDetail->development_work->name, ['controller' => 'DevelopmentWorks', 'action' => 'view', $projectwiseAbstractDetail->development_work->id]) : '' ?></td>
                    <td><?= $this->Number->format($projectwiseAbstractDetail->is_active) ?></td>
                    <td><?= $projectwiseAbstractDetail->created_by === null ? '' : $this->Number->format($projectwiseAbstractDetail->created_by) ?></td>
                    <td><?= h($projectwiseAbstractDetail->created_date) ?></td>
                    <td><?= $projectwiseAbstractDetail->modified_by === null ? '' : $this->Number->format($projectwiseAbstractDetail->modified_by) ?></td>
                    <td><?= h($projectwiseAbstractDetail->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectwiseAbstractDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectwiseAbstractDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectwiseAbstractDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseAbstractDetail->id)]) ?>
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
