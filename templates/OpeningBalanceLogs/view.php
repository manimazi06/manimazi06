<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OpeningBalanceLog $openingBalanceLog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Opening Balance Log'), ['action' => 'edit', $openingBalanceLog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Opening Balance Log'), ['action' => 'delete', $openingBalanceLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $openingBalanceLog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Opening Balance Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Opening Balance Log'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="openingBalanceLogs view content">
            <h3><?= h($openingBalanceLog->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Office') ?></th>
                    <td><?= $openingBalanceLog->has('office') ? $this->Html->link($openingBalanceLog->office->name, ['controller' => 'Offices', 'action' => 'view', $openingBalanceLog->office->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Division') ?></th>
                    <td><?= $openingBalanceLog->has('division') ? $this->Html->link($openingBalanceLog->division->name, ['controller' => 'Divisions', 'action' => 'view', $openingBalanceLog->division->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Opening Balance') ?></th>
                    <td><?= h($openingBalanceLog->opening_balance) ?></td>
                </tr>
                <tr>
                    <th><?= __('Balance Date') ?></th>
                    <td><?= h($openingBalanceLog->balance_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Info') ?></th>
                    <td><?= h($openingBalanceLog->payment_info) ?></td>
                </tr>
                <tr>
                    <th><?= __('Request Amount') ?></th>
                    <td><?= h($openingBalanceLog->request_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received Amount') ?></th>
                    <td><?= h($openingBalanceLog->received_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($openingBalanceLog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Amount Receive Id') ?></th>
                    <td><?= $openingBalanceLog->is_amount_receive_id === null ? '' : $this->Number->format($openingBalanceLog->is_amount_receive_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $openingBalanceLog->created_by === null ? '' : $this->Number->format($openingBalanceLog->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $openingBalanceLog->modified_by === null ? '' : $this->Number->format($openingBalanceLog->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Request Date') ?></th>
                    <td><?= h($openingBalanceLog->request_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received Date') ?></th>
                    <td><?= h($openingBalanceLog->received_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($openingBalanceLog->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($openingBalanceLog->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $openingBalanceLog->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
