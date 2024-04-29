<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unit $unit
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Unit'), ['action' => 'edit', $unit->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Unit'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Units'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Unit'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="units view content">
            <h3><?= h($unit->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($unit->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name Code') ?></th>
                    <td><?= h($unit->name_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($unit->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $unit->is_active === null ? '' : $this->Number->format($unit->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Flag') ?></th>
                    <td><?= $unit->order_flag === null ? '' : $this->Number->format($unit->order_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $unit->created_by === null ? '' : $this->Number->format($unit->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $unit->modified_by === null ? '' : $this->Number->format($unit->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($unit->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($unit->modified_date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Projectwise Detailed Estimates') ?></h4>
                <?php if (!empty($unit->projectwise_detailed_estimates)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Project Work Id') ?></th>
                            <th><?= __('Project Work Subdetail Id') ?></th>
                            <th><?= __('Material Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Unit Id') ?></th>
                            <th><?= __('Approved Estimate') ?></th>
                            <th><?= __('Total Cost') ?></th>
                            <th><?= __('Submit Date') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($unit->projectwise_detailed_estimates as $projectwiseDetailedEstimates) : ?>
                        <tr>
                            <td><?= h($projectwiseDetailedEstimates->id) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->project_work_id) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->project_work_subdetail_id) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->material_id) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->quantity) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->unit_id) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->approved_estimate) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->total_cost) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->submit_date) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->is_active) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->created_by) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->created_date) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->modified_by) ?></td>
                            <td><?= h($projectwiseDetailedEstimates->modified_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ProjectwiseDetailedEstimates', 'action' => 'view', $projectwiseDetailedEstimates->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ProjectwiseDetailedEstimates', 'action' => 'edit', $projectwiseDetailedEstimates->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProjectwiseDetailedEstimates', 'action' => 'delete', $projectwiseDetailedEstimates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseDetailedEstimates->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
