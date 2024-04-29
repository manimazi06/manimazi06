<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PoliceDesignation $policeDesignation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Police Designation'), ['action' => 'edit', $policeDesignation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Police Designation'), ['action' => 'delete', $policeDesignation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $policeDesignation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Police Designations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Police Designation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="policeDesignations view content">
            <h3><?= h($policeDesignation->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($policeDesignation->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($policeDesignation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $policeDesignation->is_active === null ? '' : $this->Number->format($policeDesignation->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $policeDesignation->created_by === null ? '' : $this->Number->format($policeDesignation->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $policeDesignation->modified_by === null ? '' : $this->Number->format($policeDesignation->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($policeDesignation->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($policeDesignation->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
