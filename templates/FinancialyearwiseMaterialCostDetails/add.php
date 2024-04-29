<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialyearwiseMaterialCostDetail $financialyearwiseMaterialCostDetail
 * @var \Cake\Collection\CollectionInterface|string[] $financialYears
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Financialyearwise Material Cost Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="financialyearwiseMaterialCostDetails form content">
            <?= $this->Form->create($financialyearwiseMaterialCostDetail) ?>
            <fieldset>
                <legend><?= __('Add Financialyearwise Material Cost Detail') ?></legend>
                <?php
                    echo $this->Form->control('financial_year_id', ['options' => $financialYears, 'empty' => true]);
                    echo $this->Form->control('submit_date');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_date', ['empty' => true]);
                    echo $this->Form->control('modified_by');
                    echo $this->Form->control('modified_date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
