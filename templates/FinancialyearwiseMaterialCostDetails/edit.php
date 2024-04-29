<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialyearwiseMaterialCostDetail $financialyearwiseMaterialCostDetail
 * @var string[]|\Cake\Collection\CollectionInterface $financialYears
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $financialyearwiseMaterialCostDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $financialyearwiseMaterialCostDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Financialyearwise Material Cost Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="financialyearwiseMaterialCostDetails form content">
            <?= $this->Form->create($financialyearwiseMaterialCostDetail) ?>
            <fieldset>
                <legend><?= __('Edit Financialyearwise Material Cost Detail') ?></legend>
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
