<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Division $division
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Division'), ['action' => 'edit', $division->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Division'), ['action' => 'delete', $division->id], ['confirm' => __('Are you sure you want to delete # {0}?', $division->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Divisions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Division'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="divisions view content">
            <h3><?= h($division->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($division->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($division->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $division->created_by === null ? '' : $this->Number->format($division->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Flag') ?></th>
                    <td><?= $division->order_flag === null ? '' : $this->Number->format($division->order_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $division->modified_by === null ? '' : $this->Number->format($division->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($division->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($division->modified_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $division->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Districts') ?></h4>
                <?php if (!empty($division->districts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Division Id') ?></th>
                            <th><?= __('Orderflag') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($division->districts as $districts) : ?>
                        <tr>
                            <td><?= h($districts->id) ?></td>
                            <td><?= h($districts->name) ?></td>
                            <td><?= h($districts->division_id) ?></td>
                            <td><?= h($districts->orderflag) ?></td>
                            <td><?= h($districts->is_active) ?></td>
                            <td><?= h($districts->created_by) ?></td>
                            <td><?= h($districts->created_date) ?></td>
                            <td><?= h($districts->modified_by) ?></td>
                            <td><?= h($districts->modified_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Districts', 'action' => 'view', $districts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Districts', 'action' => 'edit', $districts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Districts', 'action' => 'delete', $districts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $districts->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($division->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Role Id') ?></th>
                            <th><?= __('District Id') ?></th>
                            <th><?= __('Division Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Mobile No') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Order Flag') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($division->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->role_id) ?></td>
                            <td><?= h($users->district_id) ?></td>
                            <td><?= h($users->division_id) ?></td>
                            <td><?= h($users->name) ?></td>
                            <td><?= h($users->username) ?></td>
                            <td><?= h($users->password) ?></td>
                            <td><?= h($users->mobile_no) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->address) ?></td>
                            <td><?= h($users->order_flag) ?></td>
                            <td><?= h($users->is_active) ?></td>
                            <td><?= h($users->created_date) ?></td>
                            <td><?= h($users->created_by) ?></td>
                            <td><?= h($users->modified_date) ?></td>
                            <td><?= h($users->modified_by) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
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
