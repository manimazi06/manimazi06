<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseDetailedEstimate $projectwiseDetailedEstimate
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Projectwise Detailed Estimate'), ['action' => 'edit', $projectwiseDetailedEstimate->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Projectwise Detailed Estimate'), ['action' => 'delete', $projectwiseDetailedEstimate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseDetailedEstimate->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Projectwise Detailed Estimates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Projectwise Detailed Estimate'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseDetailedEstimates view content">
            <h3><?= h($projectwiseDetailedEstimate->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectwiseDetailedEstimate->has('project_work') ? $this->Html->link($projectwiseDetailedEstimate->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectwiseDetailedEstimate->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Material') ?></th>
                    <td><?= $projectwiseDetailedEstimate->has('material') ? $this->Html->link($projectwiseDetailedEstimate->material->id, ['controller' => 'Materials', 'action' => 'view', $projectwiseDetailedEstimate->material->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit') ?></th>
                    <td><?= $projectwiseDetailedEstimate->has('unit') ? $this->Html->link($projectwiseDetailedEstimate->unit->name, ['controller' => 'Units', 'action' => 'view', $projectwiseDetailedEstimate->unit->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectwiseDetailedEstimate->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $projectwiseDetailedEstimate->quantity === null ? '' : $this->Number->format($projectwiseDetailedEstimate->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Approved Estimate') ?></th>
                    <td><?= $projectwiseDetailedEstimate->approved_estimate === null ? '' : $this->Number->format($projectwiseDetailedEstimate->approved_estimate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Cost') ?></th>
                    <td><?= $projectwiseDetailedEstimate->total_cost === null ? '' : $this->Number->format($projectwiseDetailedEstimate->total_cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectwiseDetailedEstimate->is_active === null ? '' : $this->Number->format($projectwiseDetailedEstimate->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectwiseDetailedEstimate->created_by === null ? '' : $this->Number->format($projectwiseDetailedEstimate->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectwiseDetailedEstimate->modified_by === null ? '' : $this->Number->format($projectwiseDetailedEstimate->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Submit Date') ?></th>
                    <td><?= h($projectwiseDetailedEstimate->submit_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectwiseDetailedEstimate->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectwiseDetailedEstimate->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
