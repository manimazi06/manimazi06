<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OldProjectWorkDetail $oldProjectWorkDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Old Project Work Detail'), ['action' => 'edit', $oldProjectWorkDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Old Project Work Detail'), ['action' => 'delete', $oldProjectWorkDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $oldProjectWorkDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Old Project Work Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Old Project Work Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="oldProjectWorkDetails view content">
            <h3><?= h($oldProjectWorkDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('District') ?></th>
                    <td><?= $oldProjectWorkDetail->has('district') ? $this->Html->link($oldProjectWorkDetail->district->name, ['controller' => 'Districts', 'action' => 'view', $oldProjectWorkDetail->district->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Division') ?></th>
                    <td><?= $oldProjectWorkDetail->has('division') ? $this->Html->link($oldProjectWorkDetail->division->name, ['controller' => 'Divisions', 'action' => 'view', $oldProjectWorkDetail->division->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Circle') ?></th>
                    <td><?= $oldProjectWorkDetail->has('circle') ? $this->Html->link($oldProjectWorkDetail->circle->name, ['controller' => 'Circles', 'action' => 'view', $oldProjectWorkDetail->circle->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Work Stage') ?></th>
                    <td><?= h($oldProjectWorkDetail->work_stage) ?></td>
                </tr>
                <tr>
                    <th><?= __('Financial Year') ?></th>
                    <td><?= $oldProjectWorkDetail->has('financial_year') ? $this->Html->link($oldProjectWorkDetail->financial_year->name, ['controller' => 'FinancialYears', 'action' => 'view', $oldProjectWorkDetail->financial_year->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Department') ?></th>
                    <td><?= $oldProjectWorkDetail->has('department') ? $this->Html->link($oldProjectWorkDetail->department->name, ['controller' => 'Departments', 'action' => 'view', $oldProjectWorkDetail->department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Ref No') ?></th>
                    <td><?= h($oldProjectWorkDetail->ref_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($oldProjectWorkDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Work Completed') ?></th>
                    <td><?= $this->Number->format($oldProjectWorkDetail->work_completed) ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Name') ?></th>
                    <td><?= $this->Number->format($oldProjectWorkDetail->project_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $this->Number->format($oldProjectWorkDetail->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $this->Number->format($oldProjectWorkDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $this->Number->format($oldProjectWorkDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($oldProjectWorkDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($oldProjectWorkDetail->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
