<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseDetailedEstimate[]|\Cake\Collection\CollectionInterface $projectwiseDetailedEstimates
 */
?>
<div class="projectwiseDetailedEstimates index content">
    <?= $this->Html->link(__('New Projectwise Detailed Estimate'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Projectwise Detailed Estimates') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('material_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('unit_id') ?></th>
                    <th><?= $this->Paginator->sort('approved_estimate') ?></th>
                    <th><?= $this->Paginator->sort('total_cost') ?></th>
                    <th><?= $this->Paginator->sort('submit_date') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectwiseDetailedEstimates as $projectwiseDetailedEstimate): ?>
                <tr>
                    <td><?= $this->Number->format($projectwiseDetailedEstimate->id) ?></td>
                    <td><?= $projectwiseDetailedEstimate->has('project_work') ? $this->Html->link($projectwiseDetailedEstimate->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectwiseDetailedEstimate->project_work->id]) : '' ?></td>
                    <td><?= $projectwiseDetailedEstimate->has('material') ? $this->Html->link($projectwiseDetailedEstimate->material->id, ['controller' => 'Materials', 'action' => 'view', $projectwiseDetailedEstimate->material->id]) : '' ?></td>
                    <td><?= $projectwiseDetailedEstimate->quantity === null ? '' : $this->Number->format($projectwiseDetailedEstimate->quantity) ?></td>
                    <td><?= $projectwiseDetailedEstimate->has('unit') ? $this->Html->link($projectwiseDetailedEstimate->unit->name, ['controller' => 'Units', 'action' => 'view', $projectwiseDetailedEstimate->unit->id]) : '' ?></td>
                    <td><?= $projectwiseDetailedEstimate->approved_estimate === null ? '' : $this->Number->format($projectwiseDetailedEstimate->approved_estimate) ?></td>
                    <td><?= $projectwiseDetailedEstimate->total_cost === null ? '' : $this->Number->format($projectwiseDetailedEstimate->total_cost) ?></td>
                    <td><?= h($projectwiseDetailedEstimate->submit_date) ?></td>
                    <td><?= $projectwiseDetailedEstimate->is_active === null ? '' : $this->Number->format($projectwiseDetailedEstimate->is_active) ?></td>
                    <td><?= $projectwiseDetailedEstimate->created_by === null ? '' : $this->Number->format($projectwiseDetailedEstimate->created_by) ?></td>
                    <td><?= h($projectwiseDetailedEstimate->created_date) ?></td>
                    <td><?= $projectwiseDetailedEstimate->modified_by === null ? '' : $this->Number->format($projectwiseDetailedEstimate->modified_by) ?></td>
                    <td><?= h($projectwiseDetailedEstimate->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $projectwiseDetailedEstimate->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectwiseDetailedEstimate->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectwiseDetailedEstimate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseDetailedEstimate->id)]) ?>
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
