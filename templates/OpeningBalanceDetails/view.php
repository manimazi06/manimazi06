<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OpeningBalanceDetail $openingBalanceDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Opening Balance Detail'), ['action' => 'edit', $openingBalanceDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Opening Balance Detail'), ['action' => 'delete', $openingBalanceDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $openingBalanceDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Opening Balance Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Opening Balance Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="openingBalanceDetails view content">
            <h3><?= h($openingBalanceDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Office') ?></th>
                    <td><?= $openingBalanceDetail->has('office') ? $this->Html->link($openingBalanceDetail->office->name, ['controller' => 'Offices', 'action' => 'view', $openingBalanceDetail->office->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Division') ?></th>
                    <td><?= $openingBalanceDetail->has('division') ? $this->Html->link($openingBalanceDetail->division->name, ['controller' => 'Divisions', 'action' => 'view', $openingBalanceDetail->division->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Opening Balance') ?></th>
                    <td><?= h($openingBalanceDetail->opening_balance) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($openingBalanceDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $openingBalanceDetail->created_by === null ? '' : $this->Number->format($openingBalanceDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $openingBalanceDetail->modified_by === null ? '' : $this->Number->format($openingBalanceDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Balance Date') ?></th>
                    <td><?= h($openingBalanceDetail->balance_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($openingBalanceDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($openingBalanceDetail->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $openingBalanceDetail->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
