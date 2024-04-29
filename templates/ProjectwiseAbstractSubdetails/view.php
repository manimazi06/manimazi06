<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseAbstractSubdetail $projectwiseAbstractSubdetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Projectwise Abstract Subdetail'), ['action' => 'edit', $projectwiseAbstractSubdetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Projectwise Abstract Subdetail'), ['action' => 'delete', $projectwiseAbstractSubdetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseAbstractSubdetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Projectwise Abstract Subdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Projectwise Abstract Subdetail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseAbstractSubdetails view content">
            <h3><?= h($projectwiseAbstractSubdetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Projectwise Abstract Detail') ?></th>
                    <td><?= $projectwiseAbstractSubdetail->has('projectwise_abstract_detail') ? $this->Html->link($projectwiseAbstractSubdetail->projectwise_abstract_detail->id, ['controller' => 'ProjectwiseAbstractDetails', 'action' => 'view', $projectwiseAbstractSubdetail->projectwise_abstract_detail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Building Item') ?></th>
                    <td><?= $projectwiseAbstractSubdetail->has('building_item') ? $this->Html->link($projectwiseAbstractSubdetail->building_item->id, ['controller' => 'BuildingItems', 'action' => 'view', $projectwiseAbstractSubdetail->building_item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Item Code') ?></th>
                    <td><?= h($projectwiseAbstractSubdetail->item_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= h($projectwiseAbstractSubdetail->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectwiseAbstractSubdetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rate') ?></th>
                    <td><?= $projectwiseAbstractSubdetail->rate === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->rate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $projectwiseAbstractSubdetail->amount === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $projectwiseAbstractSubdetail->is_active === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectwiseAbstractSubdetail->created_by === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectwiseAbstractSubdetail->modified_by === null ? '' : $this->Number->format($projectwiseAbstractSubdetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectwiseAbstractSubdetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectwiseAbstractSubdetail->modified_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Item Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectwiseAbstractSubdetail->item_description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
