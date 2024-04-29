<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseAbstractDetail $projectwiseAbstractDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Projectwise Abstract Detail'), ['action' => 'edit', $projectwiseAbstractDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Projectwise Abstract Detail'), ['action' => 'delete', $projectwiseAbstractDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseAbstractDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Projectwise Abstract Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Projectwise Abstract Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseAbstractDetails view content">
            <h3><?= h($projectwiseAbstractDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectwiseAbstractDetail->has('project_work') ? $this->Html->link($projectwiseAbstractDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectwiseAbstractDetail->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail') ?></th>
                    <td><?= $projectwiseAbstractDetail->has('project_work_subdetail') ? $this->Html->link($projectwiseAbstractDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectwiseAbstractDetail->project_work_subdetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Development Work') ?></th>
                    <td><?= $projectwiseAbstractDetail->has('development_work') ? $this->Html->link($projectwiseAbstractDetail->development_work->name, ['controller' => 'DevelopmentWorks', 'action' => 'view', $projectwiseAbstractDetail->development_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectwiseAbstractDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $this->Number->format($projectwiseAbstractDetail->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectwiseAbstractDetail->created_by === null ? '' : $this->Number->format($projectwiseAbstractDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectwiseAbstractDetail->modified_by === null ? '' : $this->Number->format($projectwiseAbstractDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectwiseAbstractDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectwiseAbstractDetail->modified_date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Projectwise Abstract Subdetails') ?></h4>
                <?php if (!empty($projectwiseAbstractDetail->projectwise_abstract_subdetails)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Projectwise Abstract Detail Id') ?></th>
                            <th><?= __('Building Item Id') ?></th>
                            <th><?= __('Item Code') ?></th>
                            <th><?= __('Item Description') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Rate') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($projectwiseAbstractDetail->projectwise_abstract_subdetails as $projectwiseAbstractSubdetails) : ?>
                        <tr>
                            <td><?= h($projectwiseAbstractSubdetails->id) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->projectwise_abstract_detail_id) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->building_item_id) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->item_code) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->item_description) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->quantity) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->rate) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->amount) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->is_active) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->created_by) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->created_date) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->modified_by) ?></td>
                            <td><?= h($projectwiseAbstractSubdetails->modified_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ProjectwiseAbstractSubdetails', 'action' => 'view', $projectwiseAbstractSubdetails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ProjectwiseAbstractSubdetails', 'action' => 'edit', $projectwiseAbstractSubdetails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProjectwiseAbstractSubdetails', 'action' => 'delete', $projectwiseAbstractSubdetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseAbstractSubdetails->id)]) ?>
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
