<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialyearwiseMaterialCostDetail $financialyearwiseMaterialCostDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Financialyearwise Material Cost Detail'), ['action' => 'edit', $financialyearwiseMaterialCostDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Financialyearwise Material Cost Detail'), ['action' => 'delete', $financialyearwiseMaterialCostDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $financialyearwiseMaterialCostDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Financialyearwise Material Cost Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Financialyearwise Material Cost Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="financialyearwiseMaterialCostDetails view content">
            <h3><?= h($financialyearwiseMaterialCostDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Financial Year') ?></th>
                    <td><?= $financialyearwiseMaterialCostDetail->has('financial_year') ? $this->Html->link($financialyearwiseMaterialCostDetail->financial_year->name, ['controller' => 'FinancialYears', 'action' => 'view', $financialyearwiseMaterialCostDetail->financial_year->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($financialyearwiseMaterialCostDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $financialyearwiseMaterialCostDetail->is_active === null ? '' : $this->Number->format($financialyearwiseMaterialCostDetail->is_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $financialyearwiseMaterialCostDetail->created_by === null ? '' : $this->Number->format($financialyearwiseMaterialCostDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $financialyearwiseMaterialCostDetail->modified_by === null ? '' : $this->Number->format($financialyearwiseMaterialCostDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Submit Date') ?></th>
                    <td><?= h($financialyearwiseMaterialCostDetail->submit_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($financialyearwiseMaterialCostDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($financialyearwiseMaterialCostDetail->modified_date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Financialyearwise Material Cost Subdetails') ?></h4>
                <?php if (!empty($financialyearwiseMaterialCostDetail->financialyearwise_material_cost_subdetails)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Financialyearwise Material Cost Detail Id') ?></th>
                            <th><?= __('Building Material Detail Id') ?></th>
                            <th><?= __('Rate') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($financialyearwiseMaterialCostDetail->financialyearwise_material_cost_subdetails as $financialyearwiseMaterialCostSubdetails) : ?>
                        <tr>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->id) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->financialyearwise_material_cost_detail_id) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->building_material_detail_id) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->rate) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->amount) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->is_active) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->created_by) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->created_date) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->modified_by) ?></td>
                            <td><?= h($financialyearwiseMaterialCostSubdetails->modified_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'FinancialyearwiseMaterialCostSubdetails', 'action' => 'view', $financialyearwiseMaterialCostSubdetails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'FinancialyearwiseMaterialCostSubdetails', 'action' => 'edit', $financialyearwiseMaterialCostSubdetails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'FinancialyearwiseMaterialCostSubdetails', 'action' => 'delete', $financialyearwiseMaterialCostSubdetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $financialyearwiseMaterialCostSubdetails->id)]) ?>
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
