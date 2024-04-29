<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WorkStage $workStage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Work Stage'), ['action' => 'edit', $workStage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Work Stage'), ['action' => 'delete', $workStage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workStage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Work Stages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Work Stage'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="workStages view content">
            <h3><?= h($workStage->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($workStage->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($workStage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Flag') ?></th>
                    <td><?= $workStage->order_flag === null ? '' : $this->Number->format($workStage->order_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $workStage->created_by === null ? '' : $this->Number->format($workStage->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $workStage->modified_by === null ? '' : $this->Number->format($workStage->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($workStage->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($workStage->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $workStage->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
