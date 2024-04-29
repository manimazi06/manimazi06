<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingType $buildingType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Building Type'), ['action' => 'edit', $buildingType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Building Type'), ['action' => 'delete', $buildingType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $buildingType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Building Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Building Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="buildingTypes view content">
            <h3><?= h($buildingType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($buildingType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($buildingType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Flag') ?></th>
                    <td><?= $buildingType->order_flag === null ? '' : $this->Number->format($buildingType->order_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $buildingType->is_active === null ? '' : $this->Number->format($buildingType->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $buildingType->created_by === null ? '' : $this->Number->format($buildingType->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $buildingType->modified_by === null ? '' : $this->Number->format($buildingType->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($buildingType->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($buildingType->modified_date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Project Works') ?></h4>
                <?php if (!empty($buildingType->project_works)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Department Type') ?></th>
                            <th><?= __('Department Id') ?></th>
                            <th><?= __('Financial Year Id') ?></th>
                            <th><?= __('Project Code') ?></th>
                            <th><?= __('Project Name') ?></th>
                            <th><?= __('Project Description') ?></th>
                            <th><?= __('Project Amount') ?></th>
                            <th><?= __('Building Type Id') ?></th>
                            <th><?= __('File Upload') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($buildingType->project_works as $projectWorks) : ?>
                        <tr>
                            <td><?= h($projectWorks->id) ?></td>
                            <td><?= h($projectWorks->department_type) ?></td>
                            <td><?= h($projectWorks->department_id) ?></td>
                            <td><?= h($projectWorks->financial_year_id) ?></td>
                            <td><?= h($projectWorks->project_code) ?></td>
                            <td><?= h($projectWorks->project_name) ?></td>
                            <td><?= h($projectWorks->project_description) ?></td>
                            <td><?= h($projectWorks->project_amount) ?></td>
                            <td><?= h($projectWorks->building_type_id) ?></td>
                            <td><?= h($projectWorks->file_upload) ?></td>
                            <td><?= h($projectWorks->is_active) ?></td>
                            <td><?= h($projectWorks->created_by) ?></td>
                            <td><?= h($projectWorks->created_date) ?></td>
                            <td><?= h($projectWorks->modified_by) ?></td>
                            <td><?= h($projectWorks->modified_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ProjectWorks', 'action' => 'view', $projectWorks->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ProjectWorks', 'action' => 'edit', $projectWorks->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProjectWorks', 'action' => 'delete', $projectWorks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectWorks->id)]) ?>
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
