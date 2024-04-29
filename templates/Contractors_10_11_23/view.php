<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contractor $contractor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Contractor'), ['action' => 'edit', $contractor->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contractor'), ['action' => 'delete', $contractor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contractor->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contractors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contractor'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contractors view content">
            <h3><?= h($contractor->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Contractor Class') ?></th>
                    <td><?= $contractor->has('contractor_class') ? $this->Html->link($contractor->contractor_class->name, ['controller' => 'ContractorClasses', 'action' => 'view', $contractor->contractor_class->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contractor->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mobile No') ?></th>
                    <td><?= h($contractor->mobile_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($contractor->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gst No') ?></th>
                    <td><?= h($contractor->gst_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Reg No') ?></th>
                    <td><?= h($contractor->reg_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contractor->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $contractor->is_active === null ? '' : $this->Number->format($contractor->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $contractor->created_by === null ? '' : $this->Number->format($contractor->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $contractor->modified_by === null ? '' : $this->Number->format($contractor->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($contractor->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($contractor->modified_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($contractor->address)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
