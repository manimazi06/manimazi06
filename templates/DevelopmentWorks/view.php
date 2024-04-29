<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DevelopmentWork $developmentWork
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Development Work'), ['action' => 'edit', $developmentWork->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Development Work'), ['action' => 'delete', $developmentWork->id], ['confirm' => __('Are you sure you want to delete # {0}?', $developmentWork->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Development Works'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Development Work'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="developmentWorks view content">
            <h3><?= h($developmentWork->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($developmentWork->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($developmentWork->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $developmentWork->status === null ? '' : $this->Number->format($developmentWork->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $developmentWork->is_active === null ? '' : $this->Number->format($developmentWork->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $developmentWork->created_by === null ? '' : $this->Number->format($developmentWork->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $developmentWork->modified_by === null ? '' : $this->Number->format($developmentWork->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($developmentWork->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($developmentWork->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
