<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContractorClassLevel $contractorClassLevel
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Contractor Class Level'), ['action' => 'edit', $contractorClassLevel->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contractor Class Level'), ['action' => 'delete', $contractorClassLevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contractorClassLevel->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contractor Class Levels'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contractor Class Level'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contractorClassLevels view content">
            <h3><?= h($contractorClassLevel->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contractorClassLevel->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contractorClassLevel->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $contractorClassLevel->is_active === null ? '' : $this->Number->format($contractorClassLevel->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $contractorClassLevel->created_by === null ? '' : $this->Number->format($contractorClassLevel->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $contractorClassLevel->modified_by === null ? '' : $this->Number->format($contractorClassLevel->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($contractorClassLevel->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($contractorClassLevel->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
